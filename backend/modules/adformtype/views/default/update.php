<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\adformtype\models\AdFormType */

$this->title = 'Update Ad Form Type: ' . $model->type_id;
$this->params['breadcrumbs'][] = ['label' => 'Ad Form Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type_id, 'url' => ['view', 'id' => $model->type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ad-form-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
