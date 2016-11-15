<?php

namespace backend\modules\testimonials\controllers;

use yii\web\Controller;
use backend\modules\testimonials\models\Testimonials;
use yii\data\ActiveDataProvider;
use yii;
/**
 * Default controller for the `testimonials` module
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
        $dataProvider = new ActiveDataProvider(['query' => Testimonials::find()]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }


    public function actionCreate()
    {
        $testimonials = new Testimonials();
        $flag = true;
        $messages = [];
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['/testimonials']);
        }

        if (Yii::$app->request->isPost) {
            $testimonials->load(Yii::$app->request->post());
            if ($testimonials->validate()) {
                $testimonials->save();
                \Yii::$app->getSession()->setFlash('success', 'Data added successfully.');
                $messages['message'] = 'Data added successfully';
                $messages['redirect_url'] = \Yii::$app->urlManager->createUrl(['/testimonials/index']);
                $messages['flag'] = $flag;
                echo json_encode($messages);
                exit;
            } else {
                $flag = false;
                $messages['message'] = $testimonials->errors;
                $messages['flag'] = $flag;
                echo json_encode($messages);
                exit;
            }
        }

        return $this->renderAjax('create', ['testimonials' => $testimonials]);
    }

    public function actionUpdate($id)
    {
        $testimonials = Testimonials::find()->where(['id' => $id])->one();
        $flag = true;
        $messages = [];

        if (!Yii::$app->request->isAjax) {
            return $this->redirect([
                '/testimonials',
            ]);
        }
        if (Yii::$app->request->isPost) {
            $testimonials->load(Yii::$app->request->post());
            if ($testimonials->validate()) {
                $testimonials->save();
                \Yii::$app->getSession()->setFlash('success', 'testimonials updated successfully.');
                $messages['message'] = 'Data updated successfully';
                $messages['redirect_url'] = \Yii::$app->urlManager->createUrl(['/testimonials/index']);
                $messages['flag'] = $flag;
                echo json_encode($messages);
                exit;
            } else {
                $flag = false;
                $messages['message'] = $testimonials->errors;
                $messages['flag'] = $flag;
                echo json_encode($messages);
                exit;
            }
        } else {
            return $this->renderAjax('update', ['testimonials' => $testimonials]);
        }
    }

    public function actionDelete($id)
    {
        $testimonials = Testimonials::find()->where(['id' => $id])->one();
        $flag = true;
        $messages = [];

        if (!\Yii::$app->request->isAjax || \Yii::$app->request->isGet) {
            return $this->redirect(['/testimonials']);
        }

        $testimonials->delete();

        return $this->redirect(['index']);
    }


}
