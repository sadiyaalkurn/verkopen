<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	$form = ActiveForm::begin(['id' => 'create-data-form', 'action' => '']);
?>
	<?php
	if($is_main==0) {
		$categories->uid = 0;
	?>
	<?php echo $form->field($categories, 'uid')->hiddenInput(['value'=> 0])->label(false);
	?>
	<?php
	} elseif ($child!='' && $is_main!='') {
		$categories->uid = $child;
	?>
	<div class="fomr-group">
		<?php echo $form->field($categories, 'uid')->dropDownList($Category,
         ['prompt'=>'-Choose a Category-']) ?>
	</div>
	<?php
	} else {
		$categories->uid = $is_main;
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