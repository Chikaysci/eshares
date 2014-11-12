<div class="btn-group pull-right">
                  <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" type="button" aria-expanded="false">
                        Add contribution<span class="caret"></span>
                  </button>
                  <ul role="menu" class="dropdown-menu">
                    <?php if (count($contributions)>0):?>
                    	<?php foreach ($contributions as $k=>$v):?>
                    	   <li><a href="javascript:void(0)" onclick="showaddcontribution('<?php echo $v->c_id ?>','<?php echo $member_id?>')"><?php echo $v->name?></a></li>    
                    	<?php endforeach;?>
                    <?php endif?>
                  </ul>
</div>