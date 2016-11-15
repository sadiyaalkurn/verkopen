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

        if (Yii::$app->request->isPost) {
            $ourpartners->load(Yii::$app->request->post());
            $ourpartners->file = UploadedFile::getInstance($ourpartners,'file');
            $ext = substr(strrchr($ourpartners->file,'.'),1);
            if($ext != null)
            {                
               $newfname = time().'.'.$ext;
               $ourpartners->file->saveAs(Yii::getAlias('@webroot') .'/uploads/ourpartners/' .$ourpartners->file = $newfname);
            }
            if ($ourpartners->validate()) {
                $ourpartners->save();
                \Yii::$app->getSession()->setFlash('success', 'Data added successfully.');
                return $this->redirect('index');
            } else {
                print_r($ourpartners->errors);
                die();
            }
        }

        return $this->renderAjax('create', ['ourpartners' => $ourpartners]);
    }

    public function actionUpdate($id)
    {
        $ourpartners = Ourpartners::find()->where(['id' => $id])->one();
        $flag = true;
        $messages = [];
        $imageold = $ourpartners->file;
        
        if (Yii::$app->request->isPost) {
            $ourpartners->load(Yii::$app->request->post());
            $ourpartners->file = UploadedFile::getInstance($ourpartners,'file');
            $ext = substr(strrchr($ourpartners->file,'.'),1);
            if($ext != null)
            {
               $imagepath = Yii::getAlias('@webroot') .'/uploads/ourpartners/' .$imageold;
               unlink($imagepath);
               $newfname = time().'.'.$ext;
               $ourpartners->file->saveAs(Yii::getAlias('@webroot') .'/uploads/ourpartners/' .$ourpartners->file = $newfname);
            } else {
                $ourpartners->file = $imageold;
            }
            if ($ourpartners->validate()) {
                $ourpartners->save();
                \Yii::$app->getSession()->setFlash('success', 'Data added successfully.');
                return $this->redirect('index');
            } else {
                print_r($ourpartners->errors);
                die();
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
        $imagepath = Yii::getAlias('@webroot') .'/uploads/ourpartners/' .$ourpartners->file;
        unlink($imagepath);

        if (!\Yii::$app->request->isAjax || \Yii::$app->request->isGet) {
            return $this->redirect(['/ourpartners']);
        }
        $ourpartners->delete();
        return $this->redirect(['index']);
    }
}
