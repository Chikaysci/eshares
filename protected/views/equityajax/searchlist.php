<?php if (count($list) > 0):?>
   <?php foreach ($list as $key=>$row):?>
        <?php  $domain_name = str_replace($keyword, '<b>'.$keyword.'</b>', $row['domain_name']);?>
	     <li onclick="set_item('<?php echo $row['domain_name']?>')"><?php echo $domain_name?></li>
   <?php endforeach;?>
<?php endif?>
