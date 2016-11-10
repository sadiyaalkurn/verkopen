<?php

namespace backend\modules\user\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;

use backend\modules\user\models\UserCommunityCategory;
use backend\modules\user\models\Files;
/**
 * UserCommunityCategoryController implements the CRUD actions for UserCommunityCategory model.
 */
class UserCommunityCategoryController extends Controller
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
     * Lists all UserCommunityCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => UserCommunityCategory::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserCommunityCategory model.
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
     * Creates a new UserCommunityCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserCommunityCategory();

        $model->avatar = UploadedFile::getInstance($model, 'avatar');

        if ($model->load(Yii::$app->request->post())) {

            if($file = $this->upload($model->avatar)) {
                $model->icon_id = $file->id;
            }

            $model->save(false);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function upload($avatar)
    {
        if(!empty($avatar)) {
            $time = time();
            $file_name = $avatar->baseName . "-" . $time . '.' . $avatar->extension;
            $avatar->saveAs(Yii::getAlias('@uploads/') . 'category-icon/' . $file_name);
            $path = realpath(Yii::getAlias('@uploads/') . 'category-icon/' . $file_name);
            $url = Url::to(Yii::getAlias('uploads/category-icon/' . $file_name), true);
            $file = $this->saveFile($avatar, $path, $url);
            return $file;
        } else {
            return false;
        }
    }

    protected function saveFile(UploadedFile $uploadedFile, $path, $url)
    {
        $file = new Files();
        $file->file_name  = basename($path);
        $file->file_size  = $uploadedFile->size;
        $file->mime_type  = $uploadedFile->type;
        $file->extension = $uploadedFile->extension;
        $file->path      = $path;
        $file->url       = $url;
        $file->save(false);
        return $file;
    }

    /**
     * Updates an existing UserCommunityCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->avatar = UploadedFile::getInstance($model, 'avatar');
        if ($model->load(Yii::$app->request->post())) {

            if($file = $this->upload($model->avatar)) {
                $model->icon_id = $file->id;
            }

            $model->save(false);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserCommunityCategory model.
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
     * Finds the UserCommunityCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserCommunityCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserCommunityCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
