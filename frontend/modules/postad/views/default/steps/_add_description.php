<?php 
use frontend\modules\postad\controllers\DefaultController;
frontend\assets\DropifyAsset::register($this);
use yii\helpers\Html;
$info->name_at_ad = $uerprofile[0]['fname'].' '.$uerprofile[0]['lname'];
$info->email_address = $uerprofile[0]['email'];
$info->phone = $uerprofile[0]['phone'];
$info->location = $uerprofile[0]['street'];
$info->zip_code = $uerprofile[0]['zipcode'];

?>
<h2>Add Description</h2>
<div class="row field-row">
<div class="col-sm-3">
  <label>Selected Category</label>
</div>
<div class="col-sm-5">
  <span style="font-weight: normal;"><?php echo ucwords($cname);?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php if(empty($sname)) { } else { ?><?php echo ucwords($sname);?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php } ?><?php echo ucwords($ssname);?></span>
</div>
</div>
<?php
  foreach ($attributes as $key => $property) {
?>
<div class="row field-row">
<div class="col-sm-3">
  <label><?php echo $property->name;?>:</label>
</div>
<?php
$Attvalue = DefaultController::getSubAttributes($property->uid);
?>
<div class="col-sm-5">
<?php
if(!empty($Attvalue)) {
?>
<select name="PostAd[<?php echo $property->name;?>]" class="form-control">
<option value=""> - Select - </option>
<?php
  foreach ($Attvalue as $key => $value) {
?>
<option value="<?php echo $value->name;?>"><?php echo $value->name;?></option>
<?php } ?>
</select>
<?php
} else {
?>
<input type="text" id="<?php echo $property->name;?>" class="form-control" name="PostAd[<?php echo $property->name;?>]" placeholder="Enter <?php echo $property->name;?>">
<?php
}
?>
</div>
</div>
<?php } ?>
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
          echo Html::textInput($feild->name,'',['class'=>'form-control', 'placeholder'=>ucwords($feild->name)]);
        endif;
        if($feild->type==2):
          echo Html::radioList($feild->name, null, $valuefeild, ['class' => 'form-group']);
        endif;
        if($feild->type==3):
          echo Html::checkboxList($feild->name, null, $valuefeild, ['class' => 'form-group']);
        endif;
        if($feild->type==4):
          echo Html::textArea($feild->name,null,['class'=>'form-control', 'style'=>'height:100px', 'placeholder'=>ucwords($feild->name)]);
        endif;
    ?>
  </div>
</div>
</div>
<?php } ?>
<!--<div class="row field-row">
<div class="col-sm-3">
  <label>Type</label>
</div>
<div class="col-sm-5">
  <div class="form-group">
    <?php
        //echo $form->field($model, 'type')->textInput(['class'=>'form-control', 'placeholder'=>'Enter Type'])->label(false);
    ?>
  </div>
</div>
</div>-->

<!--<div class="row field-row">
<div class="col-sm-3">
  <label>Delivery</label>
</div>
<div class="col-sm-5">
  <div class="form-group">
    <?php
        //echo $form->field($model, 'delivery')->textInput(['class'=>'form-control', 'placeholder'=>'Enter Delivery'])->label(false);
    ?>
  </div>
</div>
</div>

<div class="row field-row">
<div class="col-sm-3">
  <label>Characteristics</label>
</div>
<div class="col-sm-5">
  <?php
    //$characterstics_list = [0 => 'With', 1 => 'No'];
    //echo $form->field($model, 'characterstics')->radioList($characterstics_list)->label(false); 
    ?>
</div>
</div>

<div class="row field-row">
<div class="col-sm-3">
  <label>Show Location Map:</label>
</div>
<div class="col-sm-5">
  <?php
    //$location_list = [0 => 'Yes', 1 => 'No'];
    //echo $form->field($model, 'show_location_map')->radioList($location_list)->label(false); 
    ?>
</div>
</div>-->

<div class="row field-row">
<div class="col-sm-3">
  <label>Upload Up To 24 Photos</label>
</div>
<div class="col-sm-5">
  <div class="form-group">
  <?php echo $form->field($model, 'files')->fileInput(['class'=>'dropify'])->label(false); ?>
  </div>
</div>
</div>

<!--<div class="row field-row">
<div class="col-sm-3">
  <label>Ad Text</label>
</div>
<div class="col-sm-5">
  <div class="form-group">
    <?php
        //echo $form->field($model, 'text')->textArea(['class'=>'form-control', 'placeholder'=>'Enter Text'])->label(false);
    ?>
  </div>
</div>
</div>

<div class="row field-row">
<div class="col-sm-3">
  <label>Website</label>
</div>
<div class="col-sm-5">
  <div class="form-group">
    <?php
        //echo $form->field($model, 'website')->textInput(['class'=>'form-control', 'placeholder'=>'Enter Website'])->label(false);
    ?>
  </div>
</div>
</div>

<div class="row field-row">
<div class="col-sm-3">
  <label>Youtube Link</label>
</div>
<div class="col-sm-5">
  <div class="form-group">
    <?php
        //echo $form->field($model, 'youtube')->textInput(['class'=>'form-control', 'placeholder'=>'Enter Youtube Link'])->label(false);
    ?>
  </div>
</div>
</div>

<div class="row field-row">
<div class="col-sm-3">
  <label>Price:</label>
</div>
<div class="col-sm-5">
  <?php
    //$price_list = [0 => 'Asking Price', 1 => 'Choose another type of price'];
    //echo $form->field($model, 'price')->radioList($price_list)->label(false); 
    ?>
</div>
</div>-->

<div class="row field-row">
<div class="col-sm-3">
  <label>Contact Information and preference:</label>
</div>
<div class="col-sm-5">
  <label>Name at Ad:</label>
  <?php
        echo $form->field($info, 'name_at_ad')->textInput(['class'=>'form-control', 'placeholder'=>''])->label(false);
    ?>
  <label>Contact Preference:</label>
  <?php
    $c_list = [0 => 'Email', 1 => 'Dial', 2 => 'SMS'];
    echo $form->field($info, 'contact_preference')->radioList($c_list)->label(false); 
  ?>
  <?php
        echo $form->field($info, 'email_address')->textInput(['class'=>'form-control', 'placeholder'=>''])->label(false);
    ?>
    <label>Phone:</label>
  <?php
        echo $form->field($info, 'phone')->textInput(['class'=>'form-control', 'placeholder'=>''])->label(false);
    ?>
    <label>Location:</label>
  <?php
        echo $form->field($info, 'location')->textInput(['class'=>'form-control', 'placeholder'=>''])->label(false);
    ?>
    <label>Zip Code:</label>
  <?php
        echo $form->field($info, 'zip_code')->textInput(['class'=>'form-control', 'placeholder'=>''])->label(false);
    ?>
</div>
</div>
<?php
$this->registerJsFile('@web/js/step.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJs( <<< EOT_JS_CODE
$('.dropify').dropify();
EOT_JS_CODE
);