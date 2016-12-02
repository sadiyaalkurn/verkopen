<h2>Choose ad Sites</h2>
<div class="row field-row">
<div class="col-sm-9">
  <?php
  foreach ($platforms as $value) {
  ?>
  <div style="width: 100%; border:1px solid #ccc; line-height: 40px; height: 45px; margin: 10px 0; padding: 0 10px;">
  	<div style="width: 5%; float: left;"><i class="fa fa-share-square-o"></i></div>
  	<div style="width: 20%; float: left;"><?php echo $value->name;?></div>
  	<div style="width: 20%; float: left;">Directe Plaasting</div>
  	<div style="width: 35%; float: left;">Plaastingkosten Speurders &euro; <?php echo $value->basic_price;?></div>
  	<div style="width: 15%; float: left;"><a href="#" class="btn btn-warning radius-0"><b>Connect</b></a></div>
  	<div style="width: 5%; float: left;">
  	<?php
  	if($value->name=="Aanbodpagina.nl") {
  	?>
  	<?= $form->field($model, 'platforms')->checkbox(['label'=>false, 'value'=>$value->name, 'checked'=>'checked']); ?>
	<?php } else { ?>
	<?= $form->field($model, 'platforms')->checkbox(['label'=>false, 'value'=>$value->name, 'disabled'=>'disabled']); ?>
	<?php } ?>
	</div>
  </div>
  <div style="clear: both;"></div>
  <?php } ?>
  <?php
    // /echo $form->field($model, 'platforms')->checkboxList($platforms)->label(false);
  ?>
</div>
<!--<div class="col-sm-3">
PRICE
</div>-->
</div>