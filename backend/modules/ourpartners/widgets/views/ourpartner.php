<?php 
use yii\helpers\Url;
if($data) { 
$path = Url::home(true)."/backend/web/uploads/ourpartners/";
?>
  <div class="our-partners">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2>Our Partners</h2>
            <div class="row">
              <?php foreach ($data as $key => $value)  { ?>
              <div class="col-sm-20 wow bounceIn">
                <img src="<?php echo $path.$value['file'];?>" class="partner-logo" alt="<?php echo $value['title'];?>" title="<?php echo $value['title'];?>">
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
  </div>
<?php } ?>