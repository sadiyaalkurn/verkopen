<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $model['title'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="banner-inner"></div>
<section class="content-area">
  <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <!--  -->
            <div class="loginregistration" style="color: #000;margin-top: 60px;">
              <h3><?= Html::encode($model['title']) ?></h3>
                <?= $model['content']; ?>
            </div>
            <!--  -->
          </div>
        </div>
      </div>
</section>