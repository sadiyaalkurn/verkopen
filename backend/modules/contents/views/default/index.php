<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ad Form Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-form-type-index">

    <p>
        <?php echo Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'position',

            [
                'attribute'=>'menu',
                'header'=>'Menu Type',
                'filter' => ['0'=>'Header', '1'=>'Footer'],
                'format'=>'raw',    
                'value' => function($model, $key, $index)
                {   
                    if($model->menu == '0')
                    {
                        return 'Header Menu';
                    }
                    else
                    {   
                        return 'Footer Menu';
                    }
                },
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}','visible'=>true],
        ],
    ]); ?>
</div>
