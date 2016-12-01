<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\adformattribute\models\AdFormAttribute */

$this->title = 'Create Ad Form Attribute';
$this->params['breadcrumbs'][] = ['label' => 'Ad Form Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-form-attribute-create">

    <!--<h1><?php //echo Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items
    ]) ?>

</div>
