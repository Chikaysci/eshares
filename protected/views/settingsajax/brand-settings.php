  <div class="col-lg-6">
		  <div class="panel panel-default">
              <div class="panel-heading">
                            <?php echo ucfirst($domain) .' Percentage Settings'?>
              </div>
             <div class="panel-body">
			           <form role="form" class="brand-form">
				           <div class="alert alert-danger" id="contrib-error" style="display:none">
				           </div>
				           <div class="alert alert-success alert-dismissable" id="contrib-success" style="display:none">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Equity percentage saved.
                            </div>
                            
				            <?php foreach ($types as $k=>$v):?>                            
					            <div class="form-group">
					                   <label><?php echo $v->equity_name?></label>
					                   <input id="p_<?php echo $v->type_id?>" name="p_<?php echo $v->type_id?>" value="<?php echo $ep[$v->type_id]?>" class="form-control input_percent">
					             </div>
				           <?php endforeach;?>  
				             <input type="hidden" name="domain_id" id="domain_id" value="<?php echo $domain_id?>">
				             <button class="btn btn-default" type="button" onclick="savebrandsettings()">Save</button>
			            </form>
			</div>
		</div>	
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/brand-settings.js"></script>
	