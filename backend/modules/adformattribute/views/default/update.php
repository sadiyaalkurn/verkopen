<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\adformattribute\models\AdFormAttribute */

$this->title = 'Update Ad Form Attribute: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ad Form Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ad-form-attribute-update">

    <!--<h1><?php //echo Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items
    ]) ?>

</div>
