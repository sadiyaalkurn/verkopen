<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\contents\models\AdFormType */

$this->title = 'Page';
$this->params['breadcrumbs'][] = ['label' => 'Ad Form Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-form-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'type_id',
            'type_name',
        ],
    ]) ?>

</div>
