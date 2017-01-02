<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	$form = ActiveForm::begin(['id' => 'create-data-form', 'action' => '']);
?>
	<?php
	if($categories->parent==0) {
	?>
	<?php echo $form->field($categories, 'parent')->hiddenInput(['value'=> 0])->label(false);
	?>
	<?php
	} elseif ($child!='') {
		$categories->uid = $child;
	?>
	<div class="fomr-group">
		<?php echo $form->field($categories, 'uid')->dropDownList($Category,
         ['prompt'=>'-Choose a Category-']) ?>
	</div>
	<?php
	} else {
	?>
	<div class="fomr-group">
		<?php echo $form->field($categories, 'uid')->dropDownList($Category,
         ['prompt'=>'-Choose a Category-']) ?>
	</div>
	<?php }?>
	<div class="fomr-group">
		<label for="url">Name</label>
		<?php echo $form->field($categories, 'name')->textInput(['class' => 'form-control', 'id' => '', 'placeholder' => 'Enter Name'])->label(false); ?>
	</div>
	<div class="fomr-group">
		<label for="url">Price</label>
		<?php echo $form->field($categories, 'price')->textInput(['class' => 'form-control', 'id' => '', 'placeholder' => 'Enter Price'])->label(false); ?>
	</div>
<?php
	ActiveForm::end();
?>