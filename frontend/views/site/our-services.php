<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\modules\testimonials\widgets\Testimonial;

$this->title = 'Our Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-area">
  <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <!--  -->
            <div class="loginregistration" style="color: #000">
              <h3><?= Html::encode($this->title) ?></h3>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ornare purus. Cras consequat sem velit, a facilisis massa condimentum a. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla ex leo, euismod ac semper ut, elementum sollicitudin sem. Phasellus dictum felis ut nunc porttitor viverra. Proin placerat lectus quam, sit amet molestie augue pulvinar ac. Mauris ultricies massa mi, in auctor ligula lacinia eget. Donec a mollis nisl. Sed porta at magna eu finibus. Sed et cursus ipsum. Morbi condimentum congue imperdiet. Ut tincidunt suscipit ipsum, in fermentum mi iaculis in. Pellentesque hendrerit facilisis ligula ut lobortis. Nunc ultricies tincidunt bibendum.
                <br /><br />
        Vivamus ornare purus quis hendrerit consequat. Aliquam sit amet ante eget urna imperdiet ullamcorper vel quis magna. Proin sit amet interdum diam. Fusce non sem sit amet mi elementum cursus. Mauris efficitur purus quis dolor facilisis venenatis. Nunc eget tellus vitae diam pulvinar lobortis et nec justo. In libero urna, hendrerit quis ultricies eu, imperdiet quis nibh.
            </div>
            <!--  -->
          </div>
        </div>
      </div>
</section>
<?php echo Testimonial::widget(); ?>