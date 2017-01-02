<?php

namespace backend\modules\user\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\user\models\User;
use yii\helpers\Url;
//use backend\modules\users\models\UserBillingShipping;
//use backend\modules\users\models\UserContactDetails;

/**
 * DefaultController implements the CRUD actions for User model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
		
		$curr_user_id=Yii::$app->user->identity->id;
		$role_details=key(\Yii::$app->authManager->getRolesByUser($curr_user_id));//exit;

        if ($model->load(Yii::$app->request->post())) {

            $model->setPassword($model->password_hash);
			$model->confirmed_at=time();
			$model->status='10';
            $model->generateAuthKey();
            //$model->user_verification_token = \Yii::$app->security->generateRandomString();
            if($model->save(false))
            {
                $manager = Yii::$app->authManager;
                //$role = $manager->getRole($_POST['User']['user_role']);
                //$role = $role ?: $manager->getPermission($_POST['User']['user_role']);
                //$manager->assign($role, $model->id);

                /*$user_bill_ship = new UserBillingShipping();
                $user_bill_ship->contractee_id = $model->id;

                $user_bill_ship->billing_company = '';
                $user_bill_ship->billing_address = '';
                $user_bill_ship->billing_apt = '';
                $user_bill_ship->billing_city = '';
                $user_bill_ship->billing_province = '';
                $user_bill_ship->billing_postalcode = '';

                $user_bill_ship->shipping_company = '';
                $user_bill_ship->shipping_address = '';
                $user_bill_ship->shipping_apt = '';
                $user_bill_ship->shipping_city = '';
                $user_bill_ship->shipping_province = '';
                $user_bill_ship->shipping_postalcode = '';
                
                if($user_bill_ship->save(false))
                {
                    $userContactDetails = new UserContactDetails();
                    $userContactDetails->user_id = $model->id;
                    $userContactDetails->mobile = '';                
                    $userContactDetails->phone = '';                
                    $userContactDetails->note = '';                
                    $userContactDetails->manager_fname = '';                
                    $userContactDetails->manager_lname = '';                
                    $userContactDetails->manager_email = '';                
                    $userContactDetails->manager_note = '';                
                    $userContactDetails->save(false);
                }*/
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,'role_details' => $role_details
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		/*****************************/
		$curr_user_id=Yii::$app->user->identity->id;
		$role_details=key(\Yii::$app->authManager->getRolesByUser($curr_user_id));//print_r($role_details);exit;
		//if($role_details!='admin' && $curr_user_id!=$model->id)
		//return Yii::$app->response->redirect(Url::to(['site/index'],true));

        if ($model->load(Yii::$app->request->post())) {

			if(strlen($model->password_hash)<=50)
			$model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($model->password_hash);
			
			$model->save();
            
			if($role_details!='admin')
			return $this->render('update', ['model' => $model,'role_details' => $role_details]);
			else
			return $this->redirect(['view', 'id' => $model->id]);
        } else {//print_r($model);exit;
            return $this->render('update', [
                'model' => $model,'role_details' => $role_details
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
