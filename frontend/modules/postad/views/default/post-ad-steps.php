<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
frontend\assets\StepsAsset::register($this);
$this->title = "Post Your Ad";
$backurl = "/postad/?cname=".$cname."&sname=".$sname."&ssname=".$ssname;
?>
    <div class="add-desc-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 wow fadeIn">
            <?php $form = ActiveForm::begin([
                    'id' => 'post-ad',
                    'action' => Url::to(['/postad/default/adpost']),
                    'options' => [
                        'enctype' => 'multipart/form-data',
                    ]
                ]); ?>
    <h3>Add Description</h3>
    <p><a href="<?php echo Url::to([$backurl]);?>" class="btn btn-success" style="font-weight: bold;">Back</a></p>
    <fieldset>
        <?php
        echo $this->render('steps/_description', ['model' => $model, 'form' => $form, 'info'=>$info, 'cname'=>$cname, 'sname'=>$sname, 'ssname'=>$ssname,'attributes'=>$attributes,'uerprofile'=>$uerprofile, 'formfeilds'=>$formfeilds, 'attributes_sub'=>$attributes_sub, 'attributes_sub_sub'=>$attributes_sub_sub,])
        ?>
    </fieldset>
 
    <h3>Choose ad Sites</h3>
    <fieldset>
        <?php echo $this->render('steps/_platforms', ['model' => $model, 'form' => $form, 'platforms'=>$platforms]); ?>
    </fieldset>

    <h3>Payment</h3>
    <fieldset>
        <?php echo $this->render('steps/_payment', ['model' => $model, 'form' => $form, 'platforms'=>$platforms, 'finalPrice'=>$finalPrice]); ?>
    </fieldset>
    <?php ActiveForm::end(); ?>
          </div>
        </div>
      </div>
    </div>