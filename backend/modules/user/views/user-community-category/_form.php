<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use himiklab\thumbnail\EasyThumbnailImage;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\UserCommunityCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-community-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'avatar')->fileInput() ?>
												 
	<?php 
	 	echo EasyThumbnailImage::thumbnailImg(
	 	@$model->icon->pathinfo(path),
	 	120,
	 	120,
	 	EasyThumbnailImage::THUMBNAIL_OUTBOUND,
	 	['alt' => @$model->icon->file_name, 'class' => 'my-profile-img']
	 	);
	?>  

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
