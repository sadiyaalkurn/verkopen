<?php 
use frontend\modules\postad\controllers\DefaultController;
use yii\helpers\Html;
$info->name_at_ad = $uerprofile[0]['fname'].' '.$uerprofile[0]['lname'];
$info->email_address = $uerprofile[0]['email'];
$info->phone = $uerprofile[0]['phone'];
$info->location = $uerprofile[0]['street'];
$info->zip_code = $uerprofile[0]['zipcode'];
use kartik\file\FileInput;
?>

<h2>Ad Description</h2>
<div class="row field-row">
<div class="col-sm-3">
  <label>Selected Category</label>
</div>
<div class="col-sm-9">
  <span style="font-weight: normal;"><?php echo ucwords($cname);?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php if(empty($sname)) { } else { ?><?php echo ucwords($sname);?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php } ?><?php echo ucwords($ssname);?></span>
  <?php
  echo Html::hiddenInput('PostAd[main_category]',$cname);
  if(empty($sname)) { } else {
  echo Html::hiddenInput('PostAd[sub_category]',$sname);
  }
  echo Html::hiddenInput('PostAd[sub_sub_category]',$ssname);
  ?>
</div>
</div>
<div class="row field-row" style="background: #eee; padding:20px">
<?php
  if(!empty($attributes)){
  foreach ($attributes as $key => $property) {
?>
  <div class="row field-row">
    <div class="col-sm-3">
      <label><?php echo $property->name;?>:</label>
    </div>
  <?php
  $Attvalue = DefaultController::getSubAttributes($property->uid);
  ?>
    <div class="col-sm-9">
    <?php
    if(!empty($Attvalue)) {
      if (strpos($property->name,"Type") !== false) {
    ?>
      <select name="PostAd[<?php echo $property->name;?>]" class="form-control required">
        <option value=""> - Select - </option>
        <?php
          foreach ($Attvalue as $key => $value) {
        ?>
        <option value="<?php echo $value->name;?>"><?php echo $value->name;?></option>
        <?php } ?>
      </select>
    <?php } else { ?>
      <div class="row">
      <?php foreach ($Attvalue as $key => $value) { ?>
        <div class="col-sm-4">
        <input type="checkbox" name="PostAd[<?php echo $property->name;?>][]" value="<?php echo $value->name;?>"> <?php echo $value->name;?>
        </div>
      <?php } ?>
      </div>
    <?php } } else { ?>
    <input type="text" id="<?php echo $property->name;?>" class="form-control required" name="PostAd[<?php echo $property->name;?>]" placeholder="Enter <?php echo $property->name;?>">
    <?php } ?>
    </div>
  </div>
<?php } } ?>
<?php
  if(!empty($attributes_sub)){
  foreach ($attributes_sub as $key_sub => $property_sub) {
?>
  <div class="row field-row">
    <div class="col-sm-3">
      <label><?php echo $property_sub->name;?>:</label>
    </div>
  <?php
  $Attvalue_sub = DefaultController::getSubAttributes($property_sub->uid);
  ?>
    <div class="col-sm-9">
    <?php
    if(!empty($Attvalue_sub)) {
      if (strpos($property_sub->name,"Type") !== false) {
    ?>
      <select name="PostAd[<?php echo $property_sub->name;?>]" class="form-control required">
        <option value=""> - Select - </option>
        <?php
          foreach ($Attvalue_sub as $key_sub => $value) {
        ?>
        <option value="<?php echo $value->name;?>"><?php echo $value->name;?></option>
        <?php } ?>
      </select>
    <?php } else { ?>
      <div class="row">
      <?php foreach ($Attvalue_sub as $key_sub => $value) { ?>
        <div class="col-sm-4">
        <input type="checkbox" name="PostAd[<?php echo $property_sub->name;?>][]" value="<?php echo $value->name;?>"> <?php echo $value->name;?>
        </div>
      <?php } ?>
      </div>
    <?php } } else { ?>
    <input type="text" id="<?php echo $property_sub->name;?>" class="form-control required" name="PostAd[<?php echo $property_sub->name;?>]" placeholder="Enter <?php echo $property_sub->name;?>">
    <?php } ?>
    </div>
  </div>
<?php } } ?>
<?php
  if(!empty($attributes_sub_sub)){
  foreach ($attributes_sub_sub as $key_sub_sub => $property_sub_sub) {
?>
  <div class="row field-row">
    <div class="col-sm-3">
      <label><?php echo $property_sub_sub->name;?>:</label>
    </div>
  <?php
  $Attvalue_sub_sub = DefaultController::getSubAttributes($property_sub_sub->uid);
  ?>
    <div class="col-sm-9">
    <?php
    if(!empty($Attvalue_sub_sub)) {
      if (strpos($property_sub_sub->name,"Type") !== false) {
    ?>
      <select name="PostAd[<?php echo $property_sub_sub->name;?>]" class="form-control required">
        <option value=""> - Select - </option>
        <?php
          foreach ($Attvalue_sub_sub as $key_sub_sub => $value) {
        ?>
        <option value="<?php echo $value->name;?>"><?php echo $value->name;?></option>
        <?php } ?>
      </select>
    <?php } else { ?>
      <div class="row">
      <?php foreach ($Attvalue_sub_sub as $key_sub_sub => $value) { ?>
        <div class="col-sm-4">
        <input type="checkbox" name="PostAd[<?php echo $property_sub_sub->name;?>][]" value="<?php echo $value->name;?>"> <?php echo $value->name;?>
        </div>
      <?php } ?>
      </div>
    <?php } } else { ?>
    <input type="text" id="<?php echo $property_sub_sub->name;?>" class="form-control required" name="PostAd[<?php echo $property_sub_sub->name;?>]" placeholder="Enter <?php echo $property_sub_sub->name;?>">
    <?php } ?>
    </div>
  </div>
<?php } } ?>
</div>
<?php
  foreach ($formfeilds as $feild) {
    $valuefeild = explode(',', $feild->value);
?>
<div class="row field-row">
<div class="col-sm-3">
  <label><?php echo ucwords($feild->name);?></label>
</div>
<div class="col-sm-5">
  <div class="form-group">
    <?php
        if($feild->type==1):
          echo Html::textInput($feild->name,'',['class'=>'form-control required', 'placeholder'=>ucwords($feild->name)]);
        endif;
        if($feild->type==2):
          echo Html::radioList($feild->name, null, $valuefeild, ['class' => 'form required']);
        endif;
        if($feild->type==3):
          echo Html::checkboxList($feild->name, null, $valuefeild, ['class' => 'form required']);
        endif;
        if($feild->type==4):
          echo Html::textArea($feild->name,null,['class'=>'form-control required', 'style'=>'height:100px', 'placeholder'=>ucwords($feild->name)]);
        endif;
        if($feild->type==5):
          echo Html::dropDownList($feild->name, null, $valuefeild, ['class' => 'form-control required']);
        endif;
        if($feild->type==6):
          echo Html::textInput($feild->name,'',['class'=>'form-control required number', 'placeholder'=>ucwords($feild->name)]);
        endif;
        if($feild->type==7):
          echo Html::textInput($feild->name,'',['class'=>'form-control required email', 'placeholder'=>ucwords($feild->name)]);
        endif;
        if($feild->type==8):
          echo Html::textInput($feild->name,'',['class'=>'form-control required url', 'pattern'=>'https?://.+', 'placeholder'=>ucwords($feild->name)]);
        endif;
    ?>
  </div>
</div>
</div>
<?php } ?>

<div class="row field-row">
<div class="col-sm-3">
  <label>Upload Up To 24 Photos</label>
</div>
<div class="col-sm-5">
  <div class="form-group">
  <?php
    echo FileInput::widget([
        'model' => $model,
        'attribute' => 'files[]',
        'class'=>'form-control',
        'options' => ['multiple' => true],
        'pluginOptions' => ['overwriteInitial'=>false],
    ]);
  ?>
  </div>
</div>
</div>
<?php
  $info->contact_preference='Email';
  echo $form->field($info, 'name_at_ad')->hiddenInput()->label(false);
  echo $form->field($info, 'email_address')->hiddenInput()->label(false);
  echo $form->field($info, 'phone')->hiddenInput()->label(false);
  echo $form->field($info, 'location')->hiddenInput()->label(false);
  echo $form->field($info, 'zip_code')->hiddenInput()->label(false);
  echo $form->field($info, 'contact_preference')->hiddenInput()->label(false);
?>