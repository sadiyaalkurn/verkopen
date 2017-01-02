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
        $dataProvider = new ActiveDataProvider(['query' => Categories::find()->where(['parent'=>0])]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        if (\Yii::$app->user->getIsGuest()) {
            return $this->redirect(['/site/login']);
        };
        $cname = Categories::find()->where(['uid' => $id])->one();
        $dataProvider = new ActiveDataProvider(['query' => Categories::find()->where(['parent'=>$id])]);
        return $this->render('view', ['dataProvider' => $dataProvider, 'cname'=>$cname]);
    }


    public function actionViewchild($id)
    {
        if (\Yii::$app->user->getIsGuest()) {
            return $this->redirect(['/site/login']);
        };
        $cname = Categories::find()->where(['uid' => $id])->one();
        $dataProvider = new ActiveDataProvider(['query' => Categories::find()->where(['parent'=>$id])]);
        return $this->render('viewchild', ['dataProvider' => $dataProvider, 'cname'=>$cname]);
    }


    public function actionCreate($is_main,$child=0)
    {
        $categories = new Categories();
        $flag = true;
        $messages = [];
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['/categories']);
        }
        if($child!=0) {
            $Category=ArrayHelper::map(Categories::find()->where(['parent'=>$is_main])->asArray()->all(), 'uid', 'name');
        } else {
            $Category=ArrayHelper::map(Categories::find()->where(['parent'=>0])->asArray()->all(), 'uid', 'name');
        }
        
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($post['Categories']['uid']!='') {
                $categories->parent = $post['Categories']['uid'];
            }
            $categories->load(Yii::$app->request->post());
            if ($categories->validate()) {
                //print_r($categories);
                //die();
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

        return $this->renderAjax('create', ['categories' => $categories, 'Category'=>$Category, 'is_main'=>$is_main, 'child'=>$child]);
    }

    public function actionUpdate($id,$parent=0,$child=0)
    {
        $categories = Categories::find()->where(['uid' => $id])->one();
        $flag = true;
        $messages = [];
        if($parent!=0) {
            $Category=ArrayHelper::map(Categories::find()->where(['parent'=>$parent])->asArray()->all(), 'uid', 'name');
        } else {
            $Category=ArrayHelper::map(Categories::find()->where(['parent'=>0])->asArray()->all(), 'uid', 'name');
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
            } else {
                $flag = false;
                $messages['message'] = $categories->errors;
                $messages['flag'] = $flag;
                echo json_encode($messages);
            }
        } else {
            return $this->renderAjax('update', ['categories' => $categories, 'Category'=>$Category, 'parent'=>$parent, 'child'=>$child]);
        }
    }

    public function actionDelete($id)
    {
        $categories = Categories::find()->where(['uid' => $id])->one();
        $flag = true;
        $messages = [];

        if (!\Yii::$app->request->isAjax || \Yii::$app->request->isGet) {
            return $this->redirect(['/categories']);
        }

        $categories->delete();

        return $this->redirect(['index']);
    }


}
