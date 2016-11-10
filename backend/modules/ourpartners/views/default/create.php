<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use kartik\file\FileInput;

	$form = ActiveForm::begin(['id' => 'create-data-form', 'action' => '']);
?>
	<div class="fomr-group">
		<label for="url">Partner Title</label>
		<?php echo $form->field($ourpartners, 'title')->textInput(['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter Partner Title'])->label(false); ?>
	</div>
	<div class="fomr-group">
		<?php
		echo $form->field($ourpartners, 'file')->widget(FileInput::classname(), [
		    'options' => ['accept' => 'image/*'],
		]);
		?>
	</div>
<?php
	ActiveForm::end();
?>