<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use backend\assets\BootstrapDialogAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\helpers\Url;
BootstrapPluginAsset::register($this);
BootstrapDialogAsset::register($this);

$this->title = "Our Partners";
?>
<div class="content-type-index">
	<p>
		<?php echo HTML::a('Add New', ['create'], ['class' => 'btn btn-success create_data', 'id' => '']) ?>
	</p>

	<?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            array(
                    'label' => 'Logo',
                    'format' => 'html',
                    'value'=>function($model) {
                $path = Yii::$app->urlManagerFrontEnd->createUrl('/backend/web/uploads/ourpartners', true);
                        return Html::img($path.'/'.$model->file);
                    },
                       ),
            'title',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="fa fa-trash"></span>', $url, [
                            'title' => Yii::t('app', 'Delete'),
                            'class' => 'btn delete btn-xs',
                            'id' => $model->id
                        ]);
                    },
                    'update' => function( $url, $model ) {
                        return Html::a('<span class="fa fa-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'Update'),
                            'class' => 'btn create_data btn-xs'
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ( $action === "update" ) {
                        $url = Yii::$app->urlManager->createUrl(['/ourpartners/default/update','id'=>$model->id]);
                        return $url;
                    } elseif($action === 'delete'){
                        $url = Yii::$app->urlManager->createUrl(['/ourpartners/default/delete','id'=>$model->id]);
                        return $url;
                    }  
                }
            ],
        ],
    ]); ?>

</div>
<?php
$script = <<< JS
$('.create_data').on('click', function(event){
    event.preventDefault();
    var create_data_url = $(this).attr('href');
    BootstrapDialog.show({
        closable: false,
        title: 'Add / Edit',
        message: function(dialog) {
            var message = $('<div><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>');
            var pageToLoad = dialog.getData('pageToLoad');
            message.load(pageToLoad, function(response, status, xhr){
                if(xhr.status == 403) {
                    message.html("<p class='bg-info'>You're not authorise to change the newsletter settings. The default settings of main site will apply.</p>");
                }
            });
            return message;
        },
        data: {
            'pageToLoad': create_data_url
        },
        buttons: [{
            label: 'Close',
            action: function(dialog) {
                dialog.close()
            }
        }]
    });
    return false;
});
$('.delete').on('click', function(event){
    event.preventDefault();
    var deleteUrl = $(this).attr('href');
    BootstrapDialog.confirm({
       title: 'Delete Slider',
       message: $('<div><p>Are you sure want to delete this content? </p></div>'),
       type: BootstrapDialog.TYPE_DANGER, 
       closable: true, 
       draggable: true,
       btnCancelLabel: 'Cancel', 
       btnOKLabel: 'Delete', 
       btnOKClass: 'btn-danger',
        callback: function(result) {
            if(result) {

                $.post(deleteUrl, {data: 'Yes'}, function(data){
                    if(data.flag) {

                    } else {
                        
                    }
                }, 'json');
            }
        }
       });
});
JS;
$this->registerJs($script);
?>