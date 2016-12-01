<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ad Form Attributes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-form-attribute-index">

    <!--<h1><?php //echo Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Create Ad Form Attribute', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'type',
            'status',
            'value:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
