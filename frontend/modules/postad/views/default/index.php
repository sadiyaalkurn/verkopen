<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
frontend\assets\DropifyAsset::register($this);

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
                    'id' => 'stepwizard',
                    'steps' => [
                        1 => [
                            'title' => 'Select Category',
                            'icon' => 'glyphicon glyphicon-tags',
                            'content' => $this->render('steps/_select_category', ['model' => $model, 'form' => $form, 'catList'=>$catList]),
                            'buttons' => [
                                'next' => [
                                    'title' => 'Next',
                                    'options' => [
                                        'class' => 'btn btn-warning btn-block'
                                    ],
                                ],
                            ],
                        ],
                        2 => [
                            'title' => 'Add Description',
                            'icon' => 'glyphicon glyphicon-list-alt',
                            'content' => $this->render('steps/_add_description', ['model' => $model, 'form' => $form, 'info'=>$info]),
                                'next' => [
                                        'title' => 'Next',
                                        'options' => [
                                            'class' => 'btn btn-warning btn-block'
                                        ],
                                    ],
                        ],
                        3 => [
                            'title' => 'Choose ad Sites',
                            'icon' => 'glyphicon glyphicon-th-list',
                            'content' => $this->render('steps/_choose_platforms', ['model' => $model, 'form' => $form]),
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
                    ],
                //'complete_content' => "You are done!", // Optional final screen
                ];
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
$this->registerJs( <<< EOT_JS_CODE
$('.dropify').dropify();
EOT_JS_CODE
);
?>