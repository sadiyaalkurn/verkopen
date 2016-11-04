<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/**
 * @var yii\web\View                   $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module           $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Login Section  -->
    <section class="login-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
          <?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
            <!--  -->
            <div class="loginregistration">
              <div class="formicon">
                <img src="<?php echo \yii\helpers\Url::to('images/login-icon.jpg', true);?>" alt="">
              </div>
              <h3>Login</h3>
              <?php $form = ActiveForm::begin([
                    'id'                     => 'login-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validateOnBlur'         => false,
                    'validateOnType'         => false,
                    'validateOnChange'       => false,
                ]) ?>
                <input name="_frontendCSRF" value="" type="hidden">
                <div class="form-group">
                  <?= $form->field(
                    $model,
                    'login',
                    ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control user', 'tabindex' => '1', 'placeholder'=>'Username']]
                )->label(false); ?>
                </div>
                <div class="form-group">
                  <?= $form
                    ->field(
                        $model,
                        'password',
                        ['inputOptions' => ['class' => 'form-control password', 'tabindex' => '2', 'placeholder'=>'Password']]
                    )
                    ->passwordInput()
                    ->label(false);
                    ?>
                </div>
                <div class="form-group" style="color:#ccc">
                <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']); ?>
                </div>
                <div class="submit">
                  <?= Html::submitButton(
                    Yii::t('user', 'Login'),
                    ['class' => 'btn btn-warning btn-block', 'tabindex' => '3']
                    ); ?>
                  <p><a href="<?= Url::to(['/user/recovery/request'])?>" class="forgot">Forgot Password?</a></p>

                  <hr>
                  <div class="or">OR</div>
                  <?= Connect::widget([
                        'baseAuthUrl' => ['/user/security/auth'],
                    ]) ?>
                  <!--<p><a href=""><img src="<?php //echo \yii\helpers\Url::to('images/fb-icon-01.png', true);?>" alt=""> Log in with Facebook &nbsp;&nbsp;&nbsp;</a></p>
                  <p><a href=""><img src="<?php //echo \yii\helpers\Url::to('images/gp-icon-01.png', true);?>" alt=""> Log in with Google Plus</a></p>-->
                  <?php if ($module->enableRegistration): ?>
                  <br>
                  <p><a href="<?= Url::to(['/user/registration/resend'])?>">Didn't receive confirmation message?</a></p>
                  <?php endif ?>
                  <?php if ($module->enableRegistration): ?>
                  <p>Don't have an account? <a href="<?= Url::to(['/user/registration/register'])?>">Sign up</a></p>
                  <?php endif ?>
                </div>
              <?php ActiveForm::end(); ?>
            </div>
            <!--  -->
          </div>
        </div>
      </div>
    </section>
    <!-- End Login  -->