<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\adformtype\models\AdFormType */

$this->title = 'Create Ad Form Type';
$this->params['breadcrumbs'][] = ['label' => 'Ad Form Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-form-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
