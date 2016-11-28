<?php

namespace frontend\modules\postad\controllers;

use yii\web\Controller;
use frontend\modules\postad\models\PostAd;
use frontend\modules\postad\models\PostAdContactInfo;
use backend\modules\categories\models\Categories;
use backend\modules\categories_attribute\models\CategoriesAttributes;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use Yii;
use yii\db\Query;
use frontend\modules\postad\models\PostAdAttributes;
/**
 * Default controller for the `postad` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionSearch()
    {
    	if (Yii::$app->user->isGuest) {
            return $this->redirect('user/login');
        }
        $q = Yii::$app->request->post('title');
	    $query = new Query;
	    $query->select('*')
	        ->from('categories')
	        ->where('name LIKE "%' . $q .'%"')
	        ->andwhere('parent != 0')
	        ->limit(10)
	        ->orderBy('name');
	    $command = $query->createCommand();
	    $data = $command->queryAll();
	    $out = [];
	    foreach ($data as $d) {
	        $maincat = Categories::find()->where(['uid'=>$d['parent']])->one();
	        $cname = $maincat['name'];
	        $subcat = Categories::find()->where(['uid'=>$maincat['parent']])->one();
	        if(!empty($subcat)){
	        	$sname = $subcat['name'];
	        } else {
	        	$sname = "";
	        }
	        $out[] = ['value' => $d['name'],'id' => $d['uid'],'cname' => $cname,'sname' => $sname,'cid'=>$maincat['uid'],'sid'=>$subcat['uid']];
	    }
	    echo Json::encode($out);
    }

    /**
     * Renders the category view for the module
     * @return string
     */
    public function actionIndex()
    {
    	if (Yii::$app->user->isGuest) {
            return $this->redirect('../../user/login');
        }
    	$model = new PostAd();
    	$cattribute = new PostAdAttributes();
    	$info = new PostAdContactInfo();
    	$Categories = Categories::find()->where(['parent'=>0])->orderBy(['name' => SORT_ASC])->all();
    	$catList=ArrayHelper::map($Categories,'uid','name');
    	$userId = Yii::$app->user->getId();
    	$query = new Query;
    	$query	->select(['user.email AS email', 'profile.fname as fname', 'profile.lname as lname', 'profile.phone as phone', 'profile.zipcode as zipcode', 'profile.street as street'])  
		->from('user')
		->leftJoin('profile', 'profile.user_id = user.id')
		->where(['profile.user_id'=>$userId]);
	    $command = $query->createCommand();
	    $uerprofile = $command->queryAll();
    	if(Yii::$app->request->isPost){
    		$post = Yii::$app->request->post();
    		if(empty($post['PostAd'])) {
    			$category_id = $post['category_id'];
    			$subcat_id = $post['subcat_id'];
    			$subsubcat_id = $post['subsubcat_id'];
    		} else {
    			$category_id = $post['PostAd']['category_id'];
    			$subcat_id = $post['PostAd']['subcat_id'];
    			$subsubcat_id = $post['PostAd']['subsubcat_id'];
    		}

    		$cname = Categories::find()->where(['uid'=>$category_id])->one();
    		$main_cat_name = $cname['name'];
    		if(!empty($subcat_id)){
	        	$sname = Categories::find()->where(['uid'=>$subcat_id])->one();
	        	$sub_cat_name = $sname['name'];
	        } else {
	        	$sub_cat_name = "";
	        }
    		$ssub_name = Categories::find()->where(['uid'=>$subsubcat_id])->one();
    		$sub_sub_cat_name = $ssub_name['name'];

    		$attributes = self::getAttributes($category_id);
    		
    		return $this->render('ad-description', ['model'=>$model, 'catList'=>$catList, 'info'=>$info, 'cname'=>$main_cat_name, 'sname'=>$sub_cat_name, 'ssname'=>$sub_sub_cat_name, 'attributes'=>$attributes, 'uerprofile'=>$uerprofile, 'cattribute'=>$cattribute]);

    	} else {

    		return $this->render('index', ['model'=>$model, 'catList'=>$catList]);
    	
    	}
    }

    public function actionAdCategory(){
    	$model = new PostAd;

    	return $this->render('ad-description', ['model'=>$model]);
    }

    /** 
	 * controller action to fetch the list
	 */
	public function actionCategoryList($q = null) {
	    $query = new Query;
	    
	    $query->select('*')
	        ->from('categories')
	        ->where('name LIKE "%' . $q .'%"')
	        ->orderBy('name');
	    $command = $query->createCommand();
	    $data = $command->queryAll();
	    $out = [];
	    foreach ($data as $d) {
	        $out[] = ['value' => $d['name']];
	    }
	    echo Json::encode($out);
	}

	public function actionSubcategories() {
	    $out = [];
	    if (isset($_POST['depdrop_parents'])) {
	        $parents = $_POST['depdrop_parents'];
	        if ($parents != null) {
	            $cat_id = $parents[0];
	            $out = self::getSubCatList($cat_id);
	            echo Json::encode(['output'=>$out, 'selected'=>'']);
	            return;
	        }
	    }
	    echo Json::encode(['output'=>'', 'selected'=>'']);
	}
	
	public function actionSubsubcategories() {
	    $out = [];
	    if (isset($_POST['depdrop_parents'])) {
	        $parents = $_POST['depdrop_parents'];
	        if ($parents != null) {
	            $cat_id = $parents[0];
	            $out = self::getSubCatList($cat_id);
	            echo Json::encode(['output'=>$out, 'selected'=>'']);
	            return;
	        }
	    }
	    echo Json::encode(['output'=>'', 'selected'=>'']);
	}

	public function getSubCatList($cat_id)
	{
		$data=Categories::find()->where(['parent'=>$cat_id])->select(['uid As id','name AS name' ])->asArray()->all();
    	return $data;
	}

	public function getSubsubCatList($subcat_id)
	{
		$data=Categories::find()->where(['parent'=>$subcat_id])->select(['uid As id','name AS name' ])->asArray()->all();
    	return $data;
	}

	public function getAttributes($category_id)
	{
		$data=CategoriesAttributes::find()->where(['category_id'=>$category_id, 'type'=>'property', 'parent'=>0])->all();
    	return $data;
	}


	public function getSubAttributes($category_id)
	{
		$data=CategoriesAttributes::find()->where(['parent'=>$category_id, 'type'=>'value', 'category_id'=>0])->all();
    	return $data;
	}

	/*public function getAttributes($category_id) {
        $attributesArray = [];
        $attribute = CategoriesAttributes::find()->where(['category_id'=>$category_id, 'type'=>'property', 'parent'=>0])->all();
        $maincat = [];
        foreach ($attribute as $key => $value) {
        	//$attributesArray['parent'][]= $value->name;
        	$attribute_child = CategoriesAttributes::find()->where(['parent'=>$value->uid, 'type'=>'value', 'category_id'=>0])->all();
        	$child_attribute = [];
        	if(empty($attribute_child)) {
        		$attributesArray[$key]['parent'][$key][$value->name] = $value->name;
        	} else {
        		foreach ($attribute_child as $keyc => $valuec) {
        			$attributesArray[$key]['parent'][$key][$value->name]['child'][] = $valuec->name;
        		}
        	}
        	
        }
        //print("<pre>".print_r($attributesArray,true)."</pre>");
        foreach ($attributesArray as $key => $value) {
        	print("<pre>".print_r($value['parent'][$key],true)."</pre>");
        	//echo $value['parent'];
        	foreach ($value as $main_value) {
        		# code...
        	}
        }
        die();
    }


    public function getAttributes($category_id, $selected_category_id, $level_string) 
    {
        $select_str =[];
        if(!$level_string)
	      {
	          $level_string='';
	      }

        if ($cat_arr = CategoriesAttributes::find()->where(['category_id'=>$category_id, 'type'=>'property', 'parent'=>0])->all()) {
            foreach ($cat_arr as $keyv => $cat) {
                $select_str[]=$cat->name;
            }
        }
        else
        {
            return false;
        }
       
        return $select_str;
        print("<pre>".print_r($select_str,true)."</pre>");
        die();
    }

    public function getSubAttributes($uid, $selected_category_id, $level_string) 
    {
        $data =[];
        if ($cat_arr = CategoriesAttributes::find()->where(['parent'=>$uid, 'type'=>'value', 'category_id'=>0])->all()) {
            foreach ($cat_arr as $cat) {
                $data[]= "-----".$cat->name."<br />";
            }
        }
        else
        {
            return false;
        }
        return $data;
    }*/

}
