   <form role="form" class="equity-role-form">
   <div class="form-group" id=>
     <select class="form-control selectetype" id="equity_type_<?php echo $member_id ?>" name="equity_type_<?php echo $member_id ?>" onchange="saveerole('<?php echo $member_id ?>','<?php echo $domain_id?>')">
             <option value="">Select type</>
             <?php if (count($types)>0):?>
               <?php foreach ($types as $k=>$v):?>
                   <option value="<?php echo $v->type_id?>" <?php if ($type_id == $v->type_id) echo 'selected'?>><?php echo $v->equity_name?></option>
               <?php endforeach;?>
             <?php endif?>     
      </select>
      <span class="text-success"  id="loader_<?php echo $member_id ?>" style="display:none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loaders/loader2.gif"></span>
    </div>
   </form>