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
use yii\helpers\Url;
use yii\db\Query;
use frontend\modules\postad\models\PostAdAttributes;
use backend\modules\adformattribute\models\AdFormAttribute;
use backend\modules\platforms\models\Platforms;
use frontend\modules\postad\models\PostedAd;
use frontend\modules\postad\models\Files;
use yii\web\UploadedFile;
use frontend\modules\postad\models\PostedAdStatus;
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
        /** get main categories **/
    	$Categories = Categories::find()->where(['parent'=>0])->orderBy(['name' => SORT_ASC])->all();
    	$catList=ArrayHelper::map($Categories,'uid','name');
        /** get user data **/
    	$userId = Yii::$app->user->getId();
    	$query = new Query;
    	$query	->select(['user.email AS email', 'profile.fname as fname', 'profile.lname as lname', 'profile.phone as phone', 'profile.zipcode as zipcode', 'profile.street as street'])  
		->from('user')
		->leftJoin('profile', 'profile.user_id = user.id')
		->where(['profile.user_id'=>$userId]);
	    $command = $query->createCommand();
	    $uerprofile = $command->queryAll();

        /** if post data **/
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
	        	$m_s_price = $sname['price'];
	        } else {
	        	$sub_cat_name = "";
	        	$m_s_price = 0;
	        }
    		$ssub_name = Categories::find()->where(['uid'=>$subsubcat_id])->one();
    		$sub_sub_cat_name = $ssub_name['name'];

    		/** Price Calculation **/
    		$m_price = $cname['price'];
    		$m_s_price;
    		$m_s_s_price = $ssub_name['price'];

    		if($m_s_s_price>0) {
    			$finalPrice = $m_s_s_price;
    		} elseif ($m_s_price>0) {
    			$finalPrice = $m_price;
    		} elseif ($m_price>0) {
    			$finalPrice = $m_price;
    		} else {
    			$finalPrice = 0;
    		}

            /** attributes main category **/
    		$attributes = self::getAttributes($category_id);

    		/** attributes Sub category **/
    		$attributes_sub = self::getAttributes($subcat_id);

    		/** attributes Sub category **/
    		$attributes_sub_sub = self::getAttributes($subsubcat_id);
    		//print_r($attributes);
    		/** form fields **/
            $formfeilds = AdFormAttribute::find()->where(['status'=>0])->all();

            /** Get platforms **/
            $platforms = Platforms::find()->where(['status'=>0])->all();
            //$platformsList=ArrayHelper::map($platforms,'id','name');

            /** Post data page step one **/
    		return $this->render('post-ad-steps', ['model'=>$model, 'catList'=>$catList, 'info'=>$info, 'cname'=>$main_cat_name, 'sname'=>$sub_cat_name, 'ssname'=>$sub_sub_cat_name, 'attributes'=>$attributes, 'attributes_sub'=>$attributes_sub, 'attributes_sub_sub'=>$attributes_sub_sub, 'uerprofile'=>$uerprofile, 'cattribute'=>$cattribute, 'formfeilds'=>$formfeilds, 'platforms'=>$platforms, 'finalPrice'=>$finalPrice]);

    	} else {

    		return $this->render('index', ['model'=>$model, 'catList'=>$catList]);
    	
    	}
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
	            echo Json::encode(['output'=>$out, 'selected'=>'', 'disabled'=>true]);
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

	public function actionAdpost()
	{
		$PostedAd = new PostedAd;
		$Files = new Files;
		$model = new PostAd();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            //print_r($post); die();
            $uploads = Yii::getAlias('@frontend').'/web/images/ad/';
            $model->files = UploadedFile::getInstances($model, 'files');
            $PostedAd->date = date("m-d-Y H:i:s");
            $PostedAd->data = json_encode($post);
            $PostedAd->save();
            $pid = $PostedAd->id;
            foreach ($model->files as $file) {
            	$Files->posted_ad_id = $pid;
            	$imageName = rand(9999, 999999);
	            $Files->filename = $imageName . '.' . $file->extension;
	            $file->saveAs($uploads.$Files->filename);
	            $Files->url = Url::home('http').'images/ad/'.$Files->filename;
	            if(!empty($Files->filename) && $Files->validate()) {
                  $Files->save();
            	}
            }
            $platforms = array_filter($post['PostAd']['platforms']);
			foreach ($platforms as $key => $value) {
				echo $value;
			}
			$source_xml = self::XMLForAanbodpagina($post,$pid);
			$out = self::postOnAanbodpagina($source_xml,$pid);
            return $this->redirect(Url::to(['/postad/default/progress']));
        }
    }

    public function postOnAanbodpagina($source_xml,$pid)
    {
    	//$xml = file_get_contents($source_xml);
    	$PostedAdStatus = new PostedAdStatus;
    	$PostedAdStatus->posted_ad_id = $pid;
    	$xml = $source_xml;
		$url = 'http://api.aanbodpagina.nl/VerkopenAPI.aspx';
		$post_data = array("xml" => $xml);
		$stream_options = array(
		    'http' => array(
		       'method'  => 'POST',
		       'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		       'content' => http_build_query($post_data),
		    ),
		);
		$context  = stream_context_create($stream_options);
		$response = file_get_contents($url, null, $context);
		if (strpos($response,'successfully') !== false) {
		    $ad_status = 1;

		} else {
			$ad_status = 0;
		}
		$PostedAdStatus->user_id = Yii::$app->user->getId();
		$PostedAdStatus->platform = "Aanbodpagina.nl";
    	$PostedAdStatus->payment_status = 0;
    	$PostedAdStatus->api_response = $ad_status;
    	if ($PostedAdStatus->validate()) {
    		$PostedAdStatus->save();
    	} else {
    		print_r($PostedAdStatus->errors);
    	}
		return $ad_status;
    }


    public function XMLForAanbodpagina($post,$pid)
    {
    	$files = Files::find()->where(['posted_ad_id'=>$pid])->all();
    	$xml = '<?xml version="1.0" encoding="utf-8"?>
				<Ads>
				<Ad action="save">
				<AdID>NL6</AdID>
				<AdDate>'.date("Y-d-m H:i:s").'</AdDate>
				<Title>'.$post['Ad_Title'].'</Title>
				<Description>
				<![CDATA['.addslashes($post['Ad_Text']).']]>
				</Description>
				<SubCategoryID>1031</SubCategoryID>
				<Price>10.00</Price>
				<PriceSort>Bieden</PriceSort>
				<AllowBids>true</AllowBids>
				<AdType>Aangeboden</AdType>
				<Url></Url>
				<UrlContact></UrlContact>
				<ItemState>nieuw</ItemState>
				<Images>';
				foreach ($files as $key => $value) {
				$xml .='<Image url="'.$value->url.'" />';
				}
				$xml .='</Images>
				<User>
				<UserID>NL12</UserID>
				<UserType>particulier</UserType>
				<Firstname>'.$post['PostAdContactInfo']['name_at_ad'].'</Firstname>
				<Lastname>'.$post['PostAdContactInfo']['name_at_ad'].'</Lastname>
				<Email>'.$post['PostAdContactInfo']['email_address'].'</Email>
				<City>Breukelen</City>
				<Zip>'.$post['PostAdContactInfo']['zip_code'].'</Zip>
				<Street>'.$post['PostAdContactInfo']['location'].'</Street>
				<Province>Noord-Brabant</Province>
				<Country>NL</Country>
				<Phone>09004900900</Phone>
				<IP>'.Yii::$app->getRequest()->getUserIP().'</IP>
				<LastUpdate>'.date("Y-d-m H:i:s").'</LastUpdate>
				<url>'.$post['Website'].'</url>
				</User>
				</Ad>
				</Ads>';
		return $xml;
    }


    public function actionProgress()
    {
    	$userId = Yii::$app->user->getId();
    	$ads = PostedAdStatus::find()->where(['user_id'=>$userId])->all();
    	return $this->render('progress', ['ads'=>$ads]);
    }
}
