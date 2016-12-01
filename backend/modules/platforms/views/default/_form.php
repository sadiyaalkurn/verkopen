<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\platforms\models\Platforms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="platforms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['0' => 'Enable', '1' => 'Disable']); ?>

    <?= $form->field($model, 'basic_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'api_price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
