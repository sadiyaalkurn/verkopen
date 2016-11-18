<?php
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
?>
<h2>Select Category</h2>
<?php
echo $form->field($model, 'category_id')->dropDownList($catList, ['id'=>'cat-id', 'prompt'=>'Select...']);
 
echo $form->field($model, 'subcat_id')->widget(DepDrop::classname(), [
    'options'=>['id'=>'subcat-id'],
    'pluginOptions'=>[
        'depends'=>['cat-id'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/postad/default/subcategories'])
    ]
]);

?>