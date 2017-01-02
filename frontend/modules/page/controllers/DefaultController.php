<?php

namespace frontend\modules\page\controllers;

use yii\web\Controller;
use backend\modules\contents\models\Contents;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use Yii;
use yii\helpers\Url;
use yii\db\Query;
/**
 * Default controller for the `page` module
 */
class DefaultController extends Controller
{
    

    /**
     * Renders the category view for the module
     * @return string
     */
    public function actionIndex($id)
    {
    	$model = Contents::find()->where(['id'=>$id])->asArray()->One();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
