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

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Verkopen.nl',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];

    

    if (Yii::$app->user->isGuest) {
        /*$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];*/
        $menuItems[] = ['label' => 'Sign in', 'url' => ['/user/security/login']];
        $menuItems[] = ['label' => 'Register', 'url' => ['/user/registration/register']];
    } else {
        /*$menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';*/
        $menuItems[] = ['label' => 'Profile', 'url' => ['/user/settings/profile']];
        if(Yii::$app->user->identity->username=='admin'):
        $menuItems[] = ['label' => 'Users', 'url' => ['/user/admin/index']];
        endif;
        $menuItems[] = ['label' => 'Sign out (' . Yii::$app->user->identity->username . ')',
        'url' => ['/user/security/logout'],
        'linkOptions' => ['data-method' => 'post']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<body>
    <!-- Start Navigation -->
    <nav class="navbar navbar-default navbar-mobile navbar-sticky navbar-scrollspy bootsnav">

      <div class="container">            
        <!-- Start Atribute Navigation -->
        <div class="attr-nav">
            <ul>
              <li class="wishlist"><a href="#" class="btn btn-warning radius-0"><img src="images/icon-post.png" alt=""> Post Your Ad</a></li>
              <li><a href="#">Login</a></li>
              <li><a href="#">Register</a></li>
            </ul>
        </div>
        <!-- End Atribute Navigation -->

        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#brand"><img src="images/logo.png" class="logo wow bounceInDown" alt=""></a>
        </div>
        <!-- End Header Navigation -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Our Services</a></li>
                <li><a href="#">Our Partners</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
      </div>   
    </nav>
    <!-- End Navigation -->

    <!-- Start Banner  -->
    <div class="home-banner">
      <!-- <img src="images/banner-01.jpg" alt=""> -->
      <div class="owl-carousel owl-theme" id="banner-carousel">
        <div class="items">
          <figure>
            <figcaption>
              <div class="banner-img">
                 <img src="images/banner-01.jpg" alt="" class="">
              </div>
              <div class="container">
                <div class="fixed-box">
                  <h2>Your digital future starts here</h2>
                  <p><a href="" class="btn btn-warning radius-large btn-lg">Get Started</a></p>
                </div>
              </div>
            </figcaption>
          </figure>
        </div>

        <div class="items">
          <figure>
            <figcaption>
              <div class="banner-img">
                 <img src="images/banner-01.jpg" alt="" class="">
              </div>
              <div class="container">
                <div class="fixed-box">
                  <h2>Your digital future starts here</h2>
                  <p><a href="" class="btn btn-warning radius-large btn-lg">Get Started</a></p>
                </div>
              </div>
            </figcaption>
          </figure>
        </div>

        <div class="items">
          <figure>
            <figcaption>
              <div class="banner-img">
                 <img src="images/banner-01.jpg" alt="" class="">
              </div>
              <div class="container">
                <div class="fixed-box">
                  <h2>Your digital future starts here</h2>
                  <p><a href="" class="btn btn-warning radius-large btn-lg">Get Started</a></p>
                </div>
              </div>
            </figcaption>
          </figure>
        </div>
      </div>
    </div>
    <!-- End Banner  -->
    
    <!-- Start Welcome text  -->
    <div class="welcome-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 wow fadeIn">
            <h2>Welcome to Vekropen.nl</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,</p>
          </div>
        </div>
      </div>
    </div>
    <!-- End Welcome text  -->

    <!-- Start our partner  -->
    <div class="our-partners">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2>Our Partners</h2>
            <div class="row">
              <div class="col-sm-20 wow bounceIn">
                <a href="#"><img src="images/partner-logo-01.jpg" class="partner-logo" alt=""></a>
              </div>
              <div class="col-sm-20 wow bounceIn">
                <a href="#"><img src="images/partner-logo-02.jpg" class="partner-logo" alt=""></a>
              </div>
              <div class="col-sm-20 wow bounceIn">
                <a href="#"><img src="images/partner-logo-03.jpg" class="partner-logo" alt=""></a>
              </div>
              <div class="col-sm-20 wow bounceIn">
                <a href="#"><img src="images/partner-logo-04.jpg" class="partner-logo" alt=""></a>
              </div>
              <div class="col-sm-20 wow bounceIn">
                <a href="#"><img src="images/partner-logo-05.jpg" class="partner-logo" alt=""></a>
              </div>
              <div class="col-sm-20 wow bounceIn">
                <a href="#"><img src="images/partner-logo-06.jpg" class="partner-logo" alt=""></a>
              </div>
              <div class="col-sm-20 wow bounceIn">
                <a href="#"><img src="images/partner-logo-07.jpg" class="partner-logo" alt=""></a>
              </div>
              <div class="col-sm-20 wow bounceIn">
                <a href="#"><img src="images/partner-logo-08.jpg" class="partner-logo" alt=""></a>
              </div>
              <div class="col-sm-20 wow bounceIn">
                <a href="#"><img src="images/partner-logo-09.jpg" class="partner-logo" alt=""></a>
              </div>
              <div class="col-sm-20 wow bounceIn">
                <a href="#"><img src="images/partner-logo-10.jpg" class="partner-logo" alt=""></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End our-partner  -->

    <!-- Start How it work  -->
    <div class="how-it-work">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 wow fadeIn">
            <h2>How it Work?</h2>
            <div class="row">
              <div class="dash-line">
                <div class="col-sm-4">
                  <img src="images/step-01.png" alt="">
                  <p>Place an Ad Over Multiple <br> Marketplaces</p>
                </div>
                <div class="col-sm-4">
                  <img src="images/step-02.png" alt="">
                  <p>Review ads stats on each <br> Marketplace</p>
                </div>
                <div class="col-sm-4">
                  <img src="images/step-03.png" alt="">
                  <p>Monitor the Most Profitable Platform <br> for your Advertisement</p>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End How it work  -->

    <!-- Start testimonial  -->
    <div class="home-testimonial">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <img src="images/quote.png" alt="" class="quote ">
            <div class="owl-carousel owl-theme wow fadeIn" id="testimonial-carousel">

              <div class="items">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <h4>-JOHN ALEXIS</h4>
              </div>
              <div class="items">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <h4>-JOHN ALEXIS</h4>
              </div>
              <div class="items">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <h4>-JOHN ALEXIS</h4>
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>
    <!-- End testimonial  -->

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
                <a href="#" target="_blank" class="wow bounceIn"><img src="images/icon-fb.png" alt="Facebook"></a>
                <a href="#" target="_blank" class="wow bounceIn"><img src="images/icon-twitter.png" alt="Twitter"></a>
                <a href="#" target="_blank" class="wow bounceIn"><img src="images/icon-insta.png" alt="Instagram"></a>
                <a href="#" target="_blank" class="wow bounceIn"><img src="images/icon-youtube.png" alt="Youtube"></a>
                <a href="#" target="_blank" class="wow bounceIn"><img src="images/icon-linked.png" alt="LinkedIn"></a>
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
                <a href="#">Home</a> |
                <a href="#">About Us</a> |
                <a href="#">Our Services</a> |
                <a href="#">Our Partners</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- Footer End  -->




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="vendor/jquery/dist/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendor/OwlCarousel2/dist/owl.carousel.js"></script>

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
          //navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        });

        // var owl = $('#banner-carousel');
        //   owl.owlCarousel({
        //     margin: 10,
        //     loop: true,
        //     dots: true,
        //     responsive: {
        //       0: {
        //         items: 1
        //       },
        //       600: {
        //         items: 1
        //       },
        //       1000: {
        //         items: 1
        //       }
        //     }
        //   })

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
</body>
</html>
<?php $this->endPage() ?>
