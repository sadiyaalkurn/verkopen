<?php
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
?>
<h2>Select Category</h2>
<?php
// Parent 
echo $form->field($model, 'category_id')->dropDownList($catList, ['id'=>'cat-id']);
 
// Child # 1
echo $form->field($model, 'subcat_id')->widget(DepDrop::classname(), [
    'options'=>['id'=>'subcat-id'],
    'pluginOptions'=>[
        'depends'=>['cat-id'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/subcategories'])
    ]
]);
 
// Child # 2
echo $form->field($model, 'subsubcat_id')->widget(DepDrop::classname(), [
    'pluginOptions'=>[
        'depends'=>['cat-id', 'subcat-id'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/subsubcategories'])
    ]
]);
?>