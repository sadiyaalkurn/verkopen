<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Post Your Ad";
?>
    <div class="add-desc-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 wow fadeIn">
            <!-- Form start -->
            <?php $form = ActiveForm::begin([
                    'id' => 'post-ad',
                    'options' => [
                        'enctype' => 'multipart/form-data',
                    ]
                ]); ?>
                <?php
                $wizard_config = [
                    'id' => 'stepwizard',
                    'steps' => [
                        1 => [
                            'title' => 'Add Description',
                            'icon' => 'glyphicon glyphicon-list-alt',
                            'content' => $this->render('steps/_add_description', ['model' => $model, 'form' => $form, 'info'=>$info, 'cname'=>$cname, 'sname'=>$sname, 'ssname'=>$ssname,'attributes'=>$attributes,'uerprofile'=>$uerprofile, 'formfeilds'=>$formfeilds]),
                                'next' => [
                                        'title' => 'Next',
                                        'options' => [
                                            'class' => 'btn btn-warning btn-block',
                                        ],
                                    ],
                        ],
                        2 => [
                            'title' => 'Connect Platforms',
                            'icon' => 'glyphicon glyphicon-th-list',
                            'content' => $this->render('steps/_choose_platforms', ['model' => $model, 'form' => $form, 'platforms'=>$platforms]),
                            'buttons' => [
                                'save' => [
                                    'title' => 'Complete',
                                    'options' => [
                                        'class' => 'btn btn-warning btn-block',
                                        'type' => 'submit'
                                    ],
                                ],
                            ],
                        ],
                        3 => [
                            'title' => 'Step 3',
                            'icon' => 'glyphicon glyphicon-transfer',
                            'content' => $this->render('steps/_progress'),
                        ],
                    ],
                ];
                ?>
                <div class="row field-row">
                    <div class="col-sm-12">
                    <?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>
                    <button type="button" id="NextValidate" class="btn btn-default">Next</button>
                    <input type="submit" />
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
          </div>
        </div>
      </div>
    </div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
  $.validate({
    lang: 'es'
  });
</script>
<?php
$js = <<<JS
$(document).ready(function () {

    $('#post-ad').validate({
        rules: {
            Price: {
                required: true,
                minlength: 5
            }
        },
        submitHandler: function (form) {
            alert('valid form submitted');
            return false;
        }
    });

});
JS;
/*$this->registerJs($js);
$(document).ready(function(){
$('#NextValidate').click(function() {
    var YoutubeLink = $('#YoutubeLink').val();
    var Price = $('#Price').val();
    if(YoutubeLink.length == 0){
        alert('required');
        $('#YoutubeLink').focus();
        return false;
    } 
    if(Price.length == 0){
        alert('required');
        $('#Price').focus();
        return false;
    } 
});
});*/