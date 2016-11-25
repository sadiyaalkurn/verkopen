<h2>Add Description</h2>
<div class="row field-row">
<div class="col-sm-3">
  <label>Selected Category</label>
</div>
<div class="col-sm-5">
  <span><?php echo ucwords($cname);?>-><?php echo ucwords($sname);?>-><?php echo ucwords($ssname);?></span>
</div>
</div>
<?php
  //foreach ($variable as $key => $value) {
?>
<div class="row field-row">
<div class="col-sm-3">
  <label>Type of Add:</label>
</div>
<div class="col-sm-5">
    <?php
    $list = [0 => 'Offered', 1 => 'Wanted'];
    echo $form->field($model, 'type_of_ad')->radioList($list)->label(false); 
    ?>
</div>
</div>
<?php //} ?>
<div class="row field-row">
<div class="col-sm-3">
  <label>Add Title</label>
</div>
<div class="col-sm-5">
  <div class="form-group">
    <?php
        echo $form->field($model, 'title')->textInput(['class'=>'form-control', 'placeholder'=>'Enter Ad Title'])->label(false);
    ?>
  </div>
</div>
</div>

<div class="row field-row">
<div class="col-sm-3">
  <label>Type</label>
</div>
<div class="col-sm-5">
  <div class="form-group">
    <?php
        echo $form->field($model, 'type')->textInput(['class'=>'form-control', 'placeholder'=>'Enter Type'])->label(false);
    ?>
  </div>
</div>
</div>

<div class="row field-row">
<div class="col-sm-3">
  <label>Delivery</label>
</div>
<div class="col-sm-5">
  <div class="form-group">
    <?php
        echo $form->field($model, 'delivery')->textInput(['class'=>'form-control', 'placeholder'=>'Enter Delivery'])->label(false);
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
    $characterstics_list = [0 => 'With', 1 => 'No'];
    echo $form->field($model, 'characterstics')->radioList($characterstics_list)->label(false); 
    ?>
</div>
</div>

<div class="row field-row">
<div class="col-sm-3">
  <label>Show Location Map:</label>
</div>
<div class="col-sm-5">
  <?php
    $location_list = [0 => 'Yes', 1 => 'No'];
    echo $form->field($model, 'show_location_map')->radioList($location_list)->label(false); 
    ?>
</div>
</div>

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

<div class="row field-row">
<div class="col-sm-3">
  <label>Ad Text</label>
</div>
<div class="col-sm-5">
  <div class="form-group">
    <?php
        echo $form->field($model, 'text')->textArea(['class'=>'form-control', 'placeholder'=>'Enter Text'])->label(false);
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
        echo $form->field($model, 'website')->textInput(['class'=>'form-control', 'placeholder'=>'Enter Website'])->label(false);
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
        echo $form->field($model, 'youtube')->textInput(['class'=>'form-control', 'placeholder'=>'Enter Youtube Link'])->label(false);
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
    $price_list = [0 => 'Asking Price', 1 => 'Choose another type of price'];
    echo $form->field($model, 'price')->radioList($price_list)->label(false); 
    ?>
</div>
</div>

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