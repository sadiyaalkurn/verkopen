<?php
namespace backend\modules\categories\controllers;

use yii\web\Controller;
use backend\modules\categories\models\Categories;
use yii\data\ActiveDataProvider;
use yii;
use yii\helpers\ArrayHelper;
/**
 * Default controller for the `categories` module
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
        $dataProvider = new ActiveDataProvider(['query' => Categories::find()->where(['SubCategoryID'=>0])]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        if (\Yii::$app->user->getIsGuest()) {
            return $this->redirect(['/site/login']);
        };
        $cname = Categories::find()->where(['CategoryID' => $id])->one();
        $dataProvider = new ActiveDataProvider(['query' => Categories::find()->where(['CategoryID'=>$id])]);
        return $this->render('view', ['dataProvider' => $dataProvider, 'cname'=>$cname]);
    }


    public function actionCreate()
    {
        $categories = new Categories();
        $flag = true;
        $messages = [];
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['/categories']);
        }
        $Category=ArrayHelper::map(Categories::find()->where(['SubCategoryID'=>0])->asArray()->all(), 'CategoryID', 'Name');
        if (Yii::$app->request->isPost) {
            $categories->load(Yii::$app->request->post());
            if ($categories->validate()) {
                $categories->save();
                \Yii::$app->getSession()->setFlash('success', 'Data added successfully.');
                $messages['message'] = 'Data added successfully';
                $messages['redirect_url'] = \Yii::$app->urlManager->createUrl(['/categories/index']);
                $messages['flag'] = $flag;
                echo json_encode($messages);
                exit;
            } else {
                $flag = false;
                $messages['message'] = $categories->errors;
                $messages['flag'] = $flag;
                echo json_encode($messages);
                exit;
            }
        }

        return $this->renderAjax('create', ['categories' => $categories, 'Category'=>$Category]);
    }

    public function actionUpdate($id)
    {
        $categories = Categories::find()->where(['id' => $id])->one();
        $flag = true;
        $messages = [];
        $Category=ArrayHelper::map(Categories::find()->where(['SubCategoryID'=>0])->asArray()->all(), 'CategoryID', 'Name');
        if (!Yii::$app->request->isAjax) {
            return $this->redirect([
                '/categories',
            ]);
        }
        if (Yii::$app->request->isPost) {
            $categories->load(Yii::$app->request->post());
            if ($categories->validate()) {
                $categories->save();
                \Yii::$app->getSession()->setFlash('success', 'categories updated successfully.');
                $messages['message'] = 'Data updated successfully';
                $messages['redirect_url'] = \Yii::$app->urlManager->createUrl(['/categories/index']);
                $messages['flag'] = $flag;
                echo json_encode($messages);
                exit;
            } else {
                $flag = false;
                $messages['message'] = $categories->errors;
                $messages['flag'] = $flag;
                echo json_encode($messages);
                exit;
            }
        } else {
            return $this->renderAjax('update', ['categories' => $categories, 'Category'=>$Category]);
        }
    }

    public function actionDelete($id)
    {
        $categories = Categories::find()->where(['id' => $id])->one();
        $flag = true;
        $messages = [];

        if (!\Yii::$app->request->isAjax || \Yii::$app->request->isGet) {
            return $this->redirect(['/categories']);
        }

        $categories->delete();

        return $this->redirect(['index']);
    }


}
