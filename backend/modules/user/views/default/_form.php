<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\users\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	<?php
	if($role_details=='admin'){
	?>

    <?= $form->field($model, 'status')->dropDownList([5 => 'Inactive', 10 => 'Active'], ['prompt' => 'Select Status']) ?>

    <?php
        //print_r($model);//$model->user_role = 'manager';
        //$list = ['manager' => 'manager', 'designer' => 'designer'];
        //echo $form->field($model, 'user_role')->radioList($list); 
	}
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
