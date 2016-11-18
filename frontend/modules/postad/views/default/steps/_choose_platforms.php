<h2>Choose ad Sites</h2>
<div class="row field-row">
<div class="col-sm-3">
  <label>Choose classified ads website:</label>
</div>
<div class="col-sm-5">
  <?php
    $platforms_list = [0 => 'Marktplaats.nl', 1 => 'Marktplaza.nl', 2 => 'Speurders.nl', 3 => 'Marktnet.nl', 4 => 'Tweedehands.nl', 5 => 'Tweedehands.net', 6 => 'Aanbodpagina.nl', 7 => 'Koopplein.nl', 8 => 'Marktgigant.nl', 9 => 'Aanbodnet.nl', 10 => 'Ebay.nl', 11 => 'Spotlaats.nl'];
    echo $form->field($model, 'platforms')->radioList($platforms_list)->label(false); 
    ?>
</div>
</div>