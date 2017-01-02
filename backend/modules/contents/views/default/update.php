<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\contents\models\AdFormType */

$this->title = 'Update Page: ';
$this->params['breadcrumbs'][] = ['label' => 'Page', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['view']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ad-form-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
