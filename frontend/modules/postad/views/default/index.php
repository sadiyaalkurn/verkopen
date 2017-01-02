<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
frontend\assets\DropifyAsset::register($this);
use kartik\depdrop\DepDrop;
$this->title = "Post Your Ad";
?>
<style type="text/css">
    ul#result{ margin-left:-20px; } ul#result li{ list-style-type: disc; padding: 5px 0; } ul#result li:hover{ color: #EE1C25; } ul#result a{ text-decoration: none; font-size: 15px;}
    select#cat-id,select#subcat-id,select#subsubcat-id { width: 320px; }
</style>

<div class="add-desc-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 wow fadeIn">
        <h2>Choose Your Category</h2>
        <div id="container">
             <input type="text" style="width: 80%; float: left; height: 50px;" class="form-control" id="search" placeholder="Search your category"/>
             <input type="button" style="margin: 0 0 0 10px;" id="button" class="btn-lg btn-warning" value="Find Result" />
             <div style="clear: both;"></div>
             <div id="pageloaddiv" style="display: none;"></div>
             <br />
             <ul id="result"></ul>
        </div>
        <!-- Form start -->
        <?php $form = ActiveForm::begin([
                'id' => 'post-ad',
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
            ]); ?>
        <h2>Specify Ad</h2>
        <div>
            <div style="float: left; width: 33%; padding: 10px 0">
                <label>Choose Category<span class="red_text"> (*)</span></label>
                <?php
                echo $form->field($model, 'category_id')->dropDownList($catList, ['id'=>'cat-id', 'size'=>'12', 'class'=>'category_select'])->label(false);
                ?>
            </div>
            <div style="float: left; width: 33%; padding: 10px 0 0 10px">
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
            <div style="float: left; width: 34%; padding: 10px 0 0 10px">
                <label>Choose Sub Category<span class="red_text"> (*)</span></label>
                <?php                 
                echo $form->field($model, 'subsubcat_id')->widget(DepDrop::classname(), [
                    'options'=>['id'=>'subsubcat-id', 'size'=>'12', 'class'=>'category_select'],
                    'pluginOptions'=>[
                        'depends'=>['subcat-id'],
                        'placeholder'=>'Select...',
                        'url'=>Url::to(['/postad/default/subsubcategories'])
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
$url = Url::to(['/postad/default/search']);
$loader = \yii\helpers\Url::to('images/spin.gif', true);
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
$(document).ready(function(){
    function search(){
          var title=$("#search").val();
          if(title!=""){
            $('#pageloaddiv').show();
             $.ajax({
                type:"post",
                url:"$url",
                data:"title="+title,
                success:function(data){
                    $('#pageloaddiv').hide();
                    var posts = JSON.parse(data);
                    console.log(data);
                    $.each(posts, function() {
                        var cname = this.cname;
                        var sname = this.sname;
                        var cid = this.cid;
                        var sid = this.sid;
                        var val = this.value;
                    if(sname==''){
                        var html_li = '<li><a href="/postad" data-method="post" data-params="{&quot;category_id&quot;:&quot;'+cid+'&quot;,&quot;subcat_id&quot;:&quot;'+sid+'&quot;,&quot;subsubcat_id&quot;:&quot;'+this.id+' &quot;}"><b>'+cname+'</b> -> '+val+'</a></li>';
                    } else {
                        var html_li = '<li><a href="/postad" data-method="post" data-params="{&quot;category_id&quot;:&quot;'+cid+'&quot;,&quot;subcat_id&quot;:&quot;'+sid+'&quot;,&quot;subsubcat_id&quot;:&quot;'+this.id+' &quot;}"><b>'+cname+'</b> -> <b>'+sname+'</b> -> '+val+'</a></li>';
                    }
                    $('#result').append( $(html_li));
                    });
                    $("#search").val("");
                 }
              });
          }
     }
      $("#button").click(function(){
         search();
      });
      $('#search').keyup(function(e) {
         if(e.keyCode == 13) {
            search();
          }
      });
});
EOT_JS_CODE
);
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>