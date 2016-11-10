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
use yii\helpers\Url;
?>
<section class="login-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <!--  -->
            <div class="loginregistration">
              <div class="formicon">
                <img src="<?php echo \yii\helpers\Url::to('images/register-icon.jpg', true);?>" alt="">
              </div>
              <h3>Register</h3>
              <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                ]); ?>
                <div class="form-group">
                  <?= $form->field($model, 'fname', ['inputOptions' => ['class' => 'form-control user', 'placeholder'=>'First Name']])->label(false); ?>
                </div>
                <div class="form-group">
                <?= $form->field($model, 'lname', ['inputOptions' => ['class' => 'form-control user', 'placeholder'=>'Last Name']])->label(false); ?>
                </div>
                <div class="form-group">
                  <?= $form->field($model, 'email', ['inputOptions' => ['class' => 'form-control email', 'placeholder'=>'Email Address']])->label(false); ?>
                </div>
                <div class="form-group">
                <?= $form->field($model, 'username', ['inputOptions' => ['class' => 'form-control user', 'placeholder'=>'Username']])->label(false); ?>
                </div>
                <div class="form-group">
                  <?= $form->field($model, 'password', ['inputOptions' => ['class' => 'form-control password', 'placeholder'=>'Password']])->passwordInput()->label(false); ?>
                </div>
                <div class="form-group">
                  <?= $form->field($model, 'zipcode', ['inputOptions' => ['class' => 'form-control zcode', 'placeholder'=>'Zip Code']])->label(false)->textInput(['id'=>'zip']); ?>
                </div>
                <div class="form-group">
                  <?= $form->field($model, 'street', ['inputOptions' => ['class' => 'form-control street', 'placeholder'=>'Street']])->label(false); ?>
                </div>
                <div class="form-group">
                  <div id="city_wrap">
                  <?= $form->field($model, 'city', ['inputOptions' => ['class' => 'form-control city', 'placeholder'=>'City']])->textInput(['id'=>'city'])->label(false); ?>
                  </div>
                </div>
                <div class="form-group">
                  <?= $form->field($model, 'state', ['inputOptions' => ['class' => 'form-control state', 'placeholder'=>'State']])->textInput(['id'=>'state'])->label(false); ?>
                </div>
                
                <div>
                  <?= $form->field($model, 'phone', ['inputOptions' => ['class' => 'form-control phone', 'placeholder'=>'Phone Number']])->label(false); ?>
                </div>

                <div class="form-group ch-box">
                    <div id="myModal" class="modal">

                      <!-- Modal content -->
                      <div class="modal-content">
                        <div class="modal-header">
                          <span class="close">×</span>
                          <h2 style="padding-top:0 !important; font-size:25px">Terms and Conditions</h2>
                        </div>
                        <div class="modal-body">
                          <p style="line-height: 30px; color: #000; font-size: 15px; text-align: left;">Nullam ut lacus mauris. Maecenas nec dignissim urna. Vestibulum sit amet nulla sed diam venenatis vehicula. Sed mattis, lacus a porttitor pellentesque, nisi lorem lobortis nisi, eget pretium nisl ante a purus. Nullam eu eros egestas neque pulvinar lobortis at eget metus. Cras pretium mauris at velit condimentum, elementum laoreet ligula mollis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin sit amet volutpat mi. Sed eu suscipit ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam pretium tincidunt nulla, eget malesuada velit iaculis eget. Cras sed dolor ligula. Cras a finibus tellus. Duis pellentesque iaculis faucibus.
<br /><br />
Sed et ultrices felis. Nam eget consequat metus, nec elementum diam. Curabitur mollis nec lacus id placerat. Duis non quam commodo, ullamcorper dui sit amet, vulputate lectus. Vivamus efficitur convallis posuere. Sed rutrum accumsan eros id porttitor. Nam dictum ut orci a ultricies. Vestibulum libero augue, vestibulum facilisis nulla ut, vestibulum molestie felis. Nam lacinia pulvinar ex ac auctor. Proin feugiat lectus sed turpis fermentum, ac elementum arcu porta. Duis scelerisque justo eu massa tempor, nec tincidunt orci venenatis. Nam feugiat vulputate ullamcorper.</p>
                        </div>
                      </div>

                    </div>
                    I Agree to the <a id="myBtn" style="cursor: pointer;">Terms and Conditions</a> of the Website.
                   <?= $form->field($model, 'accept')->checkbox(['label'=>false]); ?>
                </div>
                
                <div class="submit">
                  <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-warning btn-block']) ?>
                  <p>Already have an account? <a href="<?= Url::to(['/user/security/login'])?>">Login</a></p>
                </div>
              <?php ActiveForm::end(); ?>
            </div>
            <!--  -->
          </div>
        </div>
      </div>
    </section>
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

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>