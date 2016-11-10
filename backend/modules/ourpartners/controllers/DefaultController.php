<?php

namespace backend\modules\ourpartners\controllers;

use yii\web\Controller;
use backend\modules\ourpartners\models\Ourpartners;
use yii\data\ActiveDataProvider;
use yii;
use yii\web\UploadedFile;
/**
 * Default controller for the `ourpartners` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	if (\Yii::$app->user->getIsGuest()) {
            return $this->redirect(['/site/login']);
        };
        $dataProvider = new ActiveDataProvider(['query' => Ourpartners::find()]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }


    public function actionCreate()
    {
        $ourpartners = new Ourpartners();
        $flag = true;
        $messages = [];
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['/ourpartners']);
        }

        if (Yii::$app->request->isPost) {
            $ourpartners->load(Yii::$app->request->post());
            $ourpartners->file = UploadedFile::getInstance($ourpartners,'file');
            echo $ext = substr(strrchr($ourpartners->file,'.'),1);
            die();
            if($ext != null)
            {                
               $newfname = time().'.'.$ext;
               $ourpartners->file->saveAs(Yii::getAlias('@webroot') .'/uploads/ourpartners/' .$ourpartners->file = $newfname);
            } 
            if ($ourpartners->validate()) {
                $ourpartners->save();
                \Yii::$app->getSession()->setFlash('success', 'Data added successfully.');
                $messages['message'] = 'Data added successfully';
                $messages['redirect_url'] = \Yii::$app->urlManager->createUrl(['/ourpartners/index']);
                $messages['flag'] = $flag;
                echo json_encode($messages);
                exit;
            } else {
                $flag = false;
                $messages['message'] = $ourpartners->errors;
                $messages['flag'] = $flag;
                echo json_encode($messages);
                exit;
            }
        }

        return $this->renderAjax('create', ['ourpartners' => $ourpartners]);
    }

    public function actionUpdate($id)
    {
        $ourpartners = Ourpartners::find()->where(['id' => $id])->one();
        $flag = true;
        $messages = [];

        if (!Yii::$app->request->isAjax) {
            return $this->redirect([
                '/ourpartners',
            ]);
        }
        if (Yii::$app->request->isPost) {
            $ourpartners->load(Yii::$app->request->post());
            if ($ourpartners->validate()) {
                $ourpartners->save();
                \Yii::$app->getSession()->setFlash('success', 'ourpartners updated successfully.');
                $messages['message'] = 'Data updated successfully';
                $messages['redirect_url'] = \Yii::$app->urlManager->createUrl(['/ourpartners/index']);
                $messages['flag'] = $flag;
                echo json_encode($messages);
                exit;
            } else {
                $flag = false;
                $messages['message'] = $ourpartners->errors;
                $messages['flag'] = $flag;
                echo json_encode($messages);
                exit;
            }
        } else {
            return $this->renderAjax('update', ['ourpartners' => $ourpartners]);
        }
    }

    public function actionDelete($id)
    {
        $ourpartners = Ourpartners::find()->where(['id' => $id])->one();
        $flag = true;
        $messages = [];

        if (!\Yii::$app->request->isAjax || \Yii::$app->request->isGet) {
            return $this->redirect(['/ourpartners']);
        }

        $ourpartners->delete();

        return $this->redirect(['index']);
    }


}
