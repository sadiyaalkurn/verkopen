<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var yii\widgets\ActiveForm    $form
 * @var dektrium\user\models\User $user
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                ]); ?>

                <?= $form->field($model, 'fname')->label('First Name'); ?>

                <?= $form->field($model, 'lname')->label('Last Name'); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'zipcode')->label('Zip Code')->textInput(['id'=>'zip']); ?>
                <div id="city_wrap">
                <?= $form->field($model, 'city')->textInput(['id'=>'city']); ?>
                </div>

                <?= $form->field($model, 'state')->textInput(['id'=>'state']); ?>

                <?= $form->field($model, 'street'); ?>

                <?= $form->field($model, 'phone')->label('Phone Number'); ?>
                
                <?= $form->field($model, 'accept')->checkbox(['label'=>'I agree to the Terms and Conditions of the Website.']); ?>

                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.js"></script>
<script>
$(document).ready(function(){

//when the user clicks off of the zip field:
$('#zip').keyup(function(){
  //if($(this).val().length == 5){
  var zip = $(this).val();
  var city = '';
  var state = '';
  //make a request to the google geocode api
  $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+zip+'&components=country:NL&sensor=false')
  .success(function(response){
    //find the city and state
    var address_components = response.results[0].address_components;

    $.each(address_components, function(index, component){
      var types = component.types;
      $.each(types, function(index, type){
        if(type == 'locality') {
          city = component.long_name;
        }
        if(type == 'administrative_area_level_1') {
          state = component.short_name;
        }
      });
    });
    //pre-fill the city and state
    var cities = response.results[0].postcode_localities;
    if(cities) {
      //turn city into a dropdown if necessary
      var $select = $(document.createElement('select'));
      console.log(cities);
      $.each(cities, function(index, locality){
        var $option = $(document.createElement('option'));
        $option.html(locality);
        $option.attr('value',locality);
        if(city == locality) {
          $option.attr('selected','selected');
        }
        $select.append($option);
      });
      $select.attr('id','city');
      $('#city_wrap').html($select);
    } else {
      $('#city').val(city);
    }
    $('#state').val(state);
  });
  //}
});
});
</script>