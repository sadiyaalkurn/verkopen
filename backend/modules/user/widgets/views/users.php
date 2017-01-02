<?php
use yii\grid\GridView;

use yii\widgets\DetailView;
?>

<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Recent Users</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <?= GridView::widget([
	    'dataProvider' => $dataProvider,
	    'summary' => false,
	    'columns' => [
	        'id',
	        'username',
	        'email',
	    ],
	]) ?>
    </div>
</div>