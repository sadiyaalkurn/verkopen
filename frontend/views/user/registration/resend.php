<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/*
 * @var yii\web\View                    $this
 * @var dektrium\user\models\ResendForm $model
 */

$this->title = Yii::t('user', 'Request new confirmation message');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="login-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <!--  -->
            <div class="loginregistration">
              <div class="formicon">
                <img src="<?php echo \yii\helpers\Url::to('images/forgot-icon.jpg', true);?>" alt="">
              </div>
              <h3><?= Html::encode($this->title) ?></h3>
              <?php $form = ActiveForm::begin([
                    'id'                     => 'resend-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]); ?>
                <input name="_frontendCSRF" value="" type="hidden">
                <div class="form-group">
                  <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'class'=>'form-control email', 'placeholder'=>'Email Address'])->label(false); ?>
                </div>
                
                <div class="submit">
                  <?= Html::submitButton(Yii::t('user', 'Continue'), ['class' => 'btn btn-warning btn-block']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <!--  -->
          </div>
        </div>
      </div>
    </section>