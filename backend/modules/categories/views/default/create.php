<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	$form = ActiveForm::begin(['id' => 'create-data-form', 'action' => '']);
?>
	
	<div class="fomr-group">
		<?php echo $form->field($categories, 'CategoryID')->dropDownList($Category,
         ['prompt'=>'-Choose a Category-']) ?>
	</div>
	<div class="fomr-group">
		<label for="url">Name</label>
		<?php echo $form->field($categories, 'Name')->textInput(['class' => 'form-control', 'id' => '', 'placeholder' => 'Enter Name'])->label(false); ?>
	</div>
	<div class="fomr-group">
		<label for="url">SubCategoryID</label>
		<?php echo $form->field($categories, 'SubCategoryID')->textInput(['class' => 'form-control', 'id' => '', 'placeholder' => 'Enter SubCategoryID'])->label(false); ?>
	</div>
<?php
	ActiveForm::end();
?>