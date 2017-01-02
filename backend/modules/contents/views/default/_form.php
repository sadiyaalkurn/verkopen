<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\modules\contents\models\AdFormType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-form-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="fomr-group">
		<?php echo $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic',
    ])->label('Description'); ?>
	</div>
    
    <?= $form->field($model, 'position')->textInput(['maxlength' => true,'type' => 'number']) ?>
    <?= $form->field($model, 'menu')->dropDownList(['0' => 'Header', '1' => 'Footer']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>