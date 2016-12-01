<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ad Form Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-form-type-index">

    <!--<p>
        <?php //echo Html::a('Create Ad Form Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'type_id',
            'type_name',

            ['class' => 'yii\grid\ActionColumn', 'visible'=>false],
        ],
    ]); ?>
</div>
