<?php

namespace frontend\modules\postad\controllers;

use yii\web\Controller;
use frontend\modules\postad\models\PostAd;
use frontend\modules\postad\models\PostAdContactInfo;
use backend\modules\categories\models\Categories;
use yii\helpers\ArrayHelper;

/**
 * Default controller for the `postad` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	$model = new PostAd();
    	$info = new PostAdContactInfo();
    	$Categories = Categories::find()->where(['SubCategoryID'=>0])->all();
    	$catList=ArrayHelper::map($Categories,'CategoryID','Name');
        return $this->render('index', ['model'=>$model, 'info'=>$info, 'catList'=>$catList]);
    }

	public function actionSubcategories() {
	    $out = [];
	    if (isset($_POST['depdrop_parents'])) {
	        $parents = $_POST['depdrop_parents'];
	        if ($parents != null) {
	            $cat_id = $parents[0];
	            $out = self::getSubCatList($cat_id); 
	            // the getSubCatList function will query the database based on the
	            // cat_id and return an array like below:
	            // [
	            //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
	            //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
	            // ]
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
	           $data = self::getProdList($cat_id, $subcat_id);
	            /**
	             * the getProdList function will query the database based on the
	             * cat_id and sub_cat_id and return an array like below:
	             *  [
	             *      'out'=>[
	             *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
	             *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
	             *       ],
	             *       'selected'=>'<prod-id-1>'
	             *  ]
	             */
	           
	           echo Json::encode(['output'=>$data['out'], 'selected'=>$data['selected']]);
	           return;
	        }
	    }
	    echo Json::encode(['output'=>'', 'selected'=>'']);
	}



}
