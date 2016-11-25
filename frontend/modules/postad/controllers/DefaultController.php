<?php

namespace frontend\modules\postad\controllers;

use yii\web\Controller;
use frontend\modules\postad\models\PostAd;
use frontend\modules\postad\models\PostAdContactInfo;
use backend\modules\categories\models\Categories;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use Yii;
use yii\db\Query;

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
    	$info = new PostAdContactInfo();
    	$Categories = Categories::find()->where(['parent'=>0])->orderBy(['name' => SORT_ASC])->all();
    	$catList=ArrayHelper::map($Categories,'uid','name');

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
    		
    		return $this->render('ad-description', ['model'=>$model, 'catList'=>$catList, 'info'=>$info, 'cname'=>$main_cat_name, 'sname'=>$sub_cat_name, 'ssname'=>$sub_sub_cat_name]);

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

}
