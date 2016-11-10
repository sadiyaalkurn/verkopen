<?php if($data) { ?>
    <div class="home-testimonial">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <img src="images/quote.png" alt="" class="quote ">
            <div class="owl-carousel owl-theme wow fadeIn" id="testimonial-carousel">
            <?php foreach ($data as $key => $value)  { ?>
            <div class="items">
                <p><?php echo $value['text'];?></p>
                <h4>-<?php echo $value['by'];?></h4>
            </div>
            <?php } ?>
            </div>            
          </div>
        </div>
      </div>
    </div>
<?php } ?>
