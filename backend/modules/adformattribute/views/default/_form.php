<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\adformattribute\models\AdFormAttribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-form-attribute-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList($items) ?>

    <?php //$form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(['0' => 'Enable', '1' => 'Disable']); ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>
    <small>Input comma seperated values (Example: a,b,c,d)</small>
    <br /><br />
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>