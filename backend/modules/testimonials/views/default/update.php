<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use dosamigos\ckeditor\CKEditor;

	$form = ActiveForm::begin(['id' => 'create-data-form', 'action' => '']);
?>
	<div class="fomr-group">
		<?php echo $form->field($testimonials, 'text')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic',
    ])->label('Description'); ?>
	</div>
	<div class="fomr-group">
		<label for="url">By</label>
		<?php echo $form->field($testimonials, 'by')->textInput(['class' => 'form-control', 'id' => 'by', 'placeholder' => 'Enter Testimonial By'])->label(false); ?>
	</div>
<?php
	ActiveForm::end();
?>