<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
frontend\assets\UserAsset::register($this);
frontend\assets\AnimateAsset::register($this);
frontend\assets\FontAwesomeAsset::register($this);
frontend\assets\OwlCarouselAsset::register($this);

AppAsset::register($this);
use yii\helpers\Url;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Start Navigation -->
    <nav class="navbar navbar-default navbar-mobile navbar-sticky navbar-scrollspy bootsnav">

      <div class="container">            
        <!-- Start Atribute Navigation -->
        <div class="attr-nav">
            <ul>
              <li class="wishlist"><a href="<?= Url::to(['/user/post-ad'])?>" class="btn btn-warning radius-0"><img src="<?php echo \yii\helpers\Url::to('images/icon-post.png', true);?>" alt=""> Post Your Ad</a></li>
              <?php if (Yii::$app->user->isGuest) { ?>
              <li><a href="<?= Url::to(['/user/security/login'])?>">Login</a></li>
              <li><a href="<?= Url::to(['/user/registration/register'])?>">Register</a></li>
              <?php } else { ?>
              <li><a href="<?= Url::to(['/user/settings/profile'])?>">Profile</a></li>
              <li><?= Html::a('Logout', ['/site/logout'], ['data' => ['method' => 'post']]) ?></li>
              <?php } ?>
            </ul>
        </div>
        <!-- End Atribute Navigation -->

        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="<?php echo Yii::$app->homeUrl; ?>"><img src="<?php echo \yii\helpers\Url::to('images/logo.png', true);?>" class="logo wow bounceInDown" alt=""></a>
        </div>
        <!-- End Header Navigation -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                <li><a href="<?php echo Yii::$app->homeUrl; ?>">Home</a></li>
                <li><a href="<?= Url::to(['/site/about'])?>">About Us</a></li>
                <li><a href="<?= Url::to(['/site/our-services'])?>">Our Services</a></li>
                <li><a href="<?= Url::to(['/site/our-partners'])?>">Our Partners</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>
    <!-- End Navigation -->
    <?php //Breadcrumbs::widget([ 'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>

    <!-- Footer Start  -->
    <footer id="footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-4 f-contact">
            <h3>Contact us</h3>
            <p><span>+</span>90 555 999 77 44 , <span>+</span>90 505 959 75 24 </p>
          </div>
          <div class="col-sm-4 f-contact">
            <h3>Address</h3>
            <p>1 Infinite Loop Cupertino , CA 95014 United States </p>
          </div>
          <div class="col-sm-4 f-contact">
            <h3>Keep In Touch</h3>
            <p><a href="mailto:info@vekropen.nl" target="_top">info@vekropen.nl</a></p>
          </div>
        </div>
        <div class="row">
          <div class="newsletter">
            <div class="col-sm-8">
              <div class="row">
                <div class="col-sm-2">
                  <label>Newsletter</label>
                </div>
                <div class="col-sm-7">
                  <div class="input-group">
                     <input type="text" class="form-control" placeholder="Enter Your Email Addres">
                     <span class="input-group-btn">
                          <button class="btn btn-default" type="button">Submit</button>
                     </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-sm-4">
              <div class="f-social">
                <a href="#" target="_blank" class="wow bounceIn"><img src="<?php echo \yii\helpers\Url::to('images/icon-fb.png', true);?>" alt="Facebook"></a>
                <a href="#" target="_blank" class="wow bounceIn"><img src="<?php echo \yii\helpers\Url::to('images/icon-twitter.png', true);?>" alt="Twitter"></a>
                <a href="#" target="_blank" class="wow bounceIn"><img src="<?php echo \yii\helpers\Url::to('images/icon-insta.png', true);?>" alt="Instagram"></a>
                <a href="#" target="_blank" class="wow bounceIn"><img src="<?php echo \yii\helpers\Url::to('images/icon-youtube.png', true);?>" alt="Youtube"></a>
                <a href="#" target="_blank" class="wow bounceIn"><img src="<?php echo \yii\helpers\Url::to('images/icon-linked.png', true);?>" alt="LinkedIn"></a>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="copyright">
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <p>© 2016, By Vekropen.nl. All rights reserved. Designed by <a href="#">Alkurn Technologies</a>.</p>
            </div>
            <div class="col-sm-6">
              <div class="f-link">
                <a href="<?php echo Yii::$app->homeUrl; ?>">Home</a> |
                <a href="<?= Url::to(['/site/about'])?>">About Us</a> |
                <a href="<?= Url::to(['/site/our-services'])?>">Our Services</a> |
                <a href="<?= Url::to(['/site/our-partners'])?>">Our Partners</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- Footer End  -->
<?php $this->endBody() ?>
<script type="text/javascript">
  new WOW().init();
  $(document).ready(function() {
    $("#banner-carousel").owlCarousel({
      loop: true,
      dots: true,
      items: 1,
      autoplay:true,
      autoplayTimeout:10000,
      autoplayHoverPause:true,
    });
    $("#testimonial-carousel").owlCarousel({
      lazyLoad: true,
      nav: true,
      loop: true,
      dots: false,
      items: 1,
      autoplay:true,
      autoplayTimeout:5000,
      autoplayHoverPause:true,
      navText: ['<img src="images/arrow-left.png">','<img src="images/arrow-right.png">'],
    });
  })  
</script>
</body>
</html>
<?php $this->endPage(); ?>