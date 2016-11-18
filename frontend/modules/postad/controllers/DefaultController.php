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
    /*public function actionIndex()
    {
    	if (Yii::$app->user->isGuest) {
            return $this->redirect('user/login');
        }
    	$model = new PostAd();
    	$info = new PostAdContactInfo();
    	$Categories = Categories::find()->where(['SubCategoryID'=>0])->all();
    	$catList=ArrayHelper::map($Categories,'CategoryID','Name');
        return $this->render('index', ['model'=>$model, 'info'=>$info, 'catList'=>$catList]);
    }*/

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
    	$Categories = Categories::find()->where(['SubCategoryID'=>0])->all();
    	$catList=ArrayHelper::map($Categories,'CategoryID','Name');

    	if(Yii::$app->request->isPost){
    		$post = Yii::$app->request->post();
    		if(!empty($post['search_subcat_id'])) {
    			$cat_id = Categories::find()->where(['Name'=>$post['search_subcat_id']])->one();
    			$category_id = $cat_id['CategoryID'];
    			$subcat_id = $cat_id['SubCategoryID'];	
    		} else {
    			$category_id = $post['PostAd']['category_id'];
    			$subcat_id = $post['PostAd']['subcat_id'];	
    		}
    		$cat_name = Categories::find()->where(['SubCategoryID'=>$subcat_id])->one();
    		return $this->render('ad-description', ['model'=>$model, 'catList'=>$catList, 'info'=>$info, 'cname'=>$cat_name['Name']]);
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
	        ->where('Name LIKE "%' . $q .'%"')
	        ->orderBy('Name');
	    $command = $query->createCommand();
	    $data = $command->queryAll();
	    $out = [];
	    foreach ($data as $d) {
	        $out[] = ['value' => $d['Name']];
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
	        $ids = $_POST['depdrop_parents'];
	        $cat_id = empty($ids[0]) ? null : $ids[0];
	        $subcat_id = empty($ids[1]) ? null : $ids[1];
	        if ($cat_id != null) {
	           $data = self::getSubsubCatList($cat_id, $subcat_id);
	           echo Json::encode(['output'=>$data]);
	           return;
	        }
	    }
	    echo Json::encode(['output'=>'', 'selected'=>'']);
	}


	public function getSubCatList($cat_id)
	{
		$data=Categories::find()->where(['CategoryID'=>$cat_id])->select(['SubCategoryID As id','Name AS name' ])->asArray()->all();
    	return $data;
	}

	public function getSubsubCatList($subcat_id)
	{
		$data=Categories::find()->where(['CategoryID'=>$subcat_id])->select(['CategoryID As id','Name AS name' ])->asArray()->all();
    	return $data;
	}

}
