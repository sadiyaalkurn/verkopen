<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\UserWorkoutCategory */

$this->title = 'Create User Workout Category';
$this->params['breadcrumbs'][] = ['label' => 'User Workout Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-workout-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
