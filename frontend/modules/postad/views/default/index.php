<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
frontend\assets\DropifyAsset::register($this);
use kartik\depdrop\DepDrop;
use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;

$this->title = "Post Your Ad";
?>
<div class="add-desc-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 wow fadeIn">
        <!-- Form start -->
        <?php $form = ActiveForm::begin([
                'id' => 'post-ad',
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
            ]); ?>
        <h2>Choose Your Category</h2>
        <?php
            echo Typeahead::widget([
            'name' => 'search_subcat_id',
            'options' => ['placeholder' => 'Filter as you type ...', 'id'=>'subcat_id'],
            'pluginOptions' => ['highlight'=>true],
            'dataset' => [
                [
                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                    'display' => 'value',
                    //'prefetch' => '/samples/countries.json',
                    'remote' => [
                        'url' => Url::to(['default/category-list']) . '?q=%QUERY',
                        'wildcard' => '%QUERY'
                    ]
                ]
            ]
        ]);
        ?>
        <h2>Specify Ad</h2>
        <div>
            <div style="float: left; width: 50%; padding: 10px 0">
                <label>Choose Category<span class="red_text"> (*)</span></label>
                <?php
                echo $form->field($model, 'category_id')->dropDownList($catList, ['id'=>'cat-id', 'size'=>'12', 'class'=>'category_select'])->label(false);
                ?>
            </div>
            <div style="float: left; width: 50%; padding: 10px 0 0 10px">
                <label>Choose Sub Category<span class="red_text"> (*)</span></label>
                <?php                 
                echo $form->field($model, 'subcat_id')->widget(DepDrop::classname(), [
                    'options'=>['id'=>'subcat-id', 'size'=>'12', 'class'=>'category_select'],
                    'pluginOptions'=>[
                        'depends'=>['cat-id'],
                        'placeholder'=>'Select...',
                        'url'=>Url::to(['/postad/default/subcategories'])
                    ]
                ])->label(false);
                ?>
            </div>
        </div>
        <div style="clear: both;"></div>
        <?= Html::submitButton('Next', ['class' => 'btn btn-warning', 'id'=>'next_step']) ?>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
<?php
$this->registerJs( <<< EOT_JS_CODE
$(function() {
    $('#next_step').hide();
    $('#subcat_id').blur(function(){
        $('#next_step').show(); 
    });
    $('#subcat-id').blur(function(){
        $('#subcat_id').val('');
        $('#next_step').show();
    });
});
EOT_JS_CODE
);