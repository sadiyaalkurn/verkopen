<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use kartik\file\FileInput;
	use yii\helpers\Url;
	$path = Yii::$app->urlManagerFrontEnd->createUrl('/backend/web/uploads/ourpartners', true);
?>
<?php
$form = ActiveForm::begin(['action' => '', 'id' => 'create-data-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
	
	<div class="form-group">
		<label for="url">Partner Title</label>
		<?php echo $form->field($ourpartners, 'title')->textInput(['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter Partner Title'])->label(false); ?>
	</div>
	<div class="form-group">
		<?php
		echo $form->field($ourpartners, 'file')->widget(FileInput::classname(), [ 'options' => ['accept' => 'image/*'],]);
		?>
		<br />
		<img src="<?php echo $path.'/'.$ourpartners->file;?>">
	</div>

	<div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>