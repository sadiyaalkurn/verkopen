<h2>Choose ad Sites</h2>
<div class="row field-row">
<div class="col-sm-3">
  <label>Choose classified ads website:</label>
</div>
<div class="col-sm-5">
  <?php
    echo $form->field($model, 'platforms')->checkboxList($platforms)->label(false);
  ?>
</div>
</div>