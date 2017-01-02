<?php if($data) { ?>
    <?php foreach ($data as $key => $value)  { 
    	if($value['menu']==0) {
    ?>
    <li><a href="/page/?id=<?php echo $value['id'];?>"><?php echo $value['title'];?></a></li>
    <?php } else { ?>
    <a href="/page/?id=<?php echo $value['id'];?>"><?php echo $value['title'];?></a> |
    <?php } } ?>
<?php } ?>