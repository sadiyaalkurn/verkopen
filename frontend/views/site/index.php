<?php

/* @var $this yii\web\View */
use yii\base\Widget;
use backend\modules\testimonials\widgets\Testimonial;
use backend\modules\ourpartners\widgets\Ourpartner;
$this->title = 'Verkopen.nl';
?>

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
            <h2>Welcome to Verkopen.nl</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,</p>
          </div>
        </div>
      </div>
    </div>
    <!-- End Welcome text  -->

    <!-- Start our partner  -->
    <?php echo Ourpartner::widget(); ?>
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
    <?php echo Testimonial::widget(); ?>
    <!-- End testimonial  -->
    