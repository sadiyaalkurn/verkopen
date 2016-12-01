<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use drsdre\wizardwidget\WizardWidget;

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
                        'enctype' => 'multipart/form-data'
                    ]
                ]); ?>
                <?php
                $wizard_config = [
    'steps' => [
        '1' => [
            'title' => 'Step 1',
            'icon' => 'glyphicon glyphicon-cloud-download',
            'content' => $this->render('_step1', ['form' => $form, 'Model' => $Model]),
            'buttons' => [
                'next' => [
                    'title' => 'Next: Step 2',
                    'options' => ['class'=> 'btn btn-success']
                ]
            ],
        ],
        '2' => [
            'title' => 'Step 2',
            'icon' => 'glyphicon glyphicon-cloud-upload',
            'content' => $this->render('_step2', ['form' => $form, 'Model' => $Model]),
            'buttons' => [
            'buttons' => [
                'next' => [
                    'title' => 'Next: Final Step 3',
                    'options' => ['class'=> 'btn btn-success']
                ]
            ],
        ],
        '3' => [
            'title' => 'Step 3 - Final',
            'icon' => 'glyphicon glyphicon-ok',
            'content' => $this->render('_step3', ['form' => $form, 'Dataset' => $Dataset]),
            'buttons' => [
                'save' => [
                    'html' => Html::submitButton(
                        Yii::t('app', 'Load data'),
                        [
                            'class' => 'btn btn-success',
                            'id' => 'wizard_step3_final',
                            'name' => 'step',
                            'value' => 'save-final'
                        ]
                    ),
                ],
            ],
        ],
    ],
    'start_step' => $step,
];

echo WizardWidget::widget($wizard_config);
                ?>
                <div class="row field-row">
                    <div class="col-sm-12">
                        <!--<div class="center-icon-image">
                            <p class="re-text">Please fill the following fields to Post Ad:</p>
                        </div>-->
                        <?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
          </div>
        </div>
      </div>
    </div>
<?php
$this->registerJsFile('@web/js/step.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$js = <<<JS
$('input.some-blue').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%',
    labelHover: true,
    cursor: true
});
$(".chosen-select").select2();
JS;

$this->registerJs($js);

$this->registerJs( <<< EOT_JS_CODE
$('.dropify').dropify();
EOT_JS_CODE
);