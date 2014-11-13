<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/dataTables.bootstrap.css" rel="stylesheet">
  <div class="col-lg-6">
  <div class="panel panel-default">
                        <div class="panel-heading">
                            Venture Settings
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills">
                                <li class="active"><a data-toggle="tab" href="#content-percentage" aria-expanded="true">Equity Percentage</a>
                                </li>
                                <li class=""><a data-toggle="tab" href="#content-expenses" aria-expanded="false">Expenses</a>
                                </li>
                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="content-percentage" class="tab-pane fade active in">
                                <br>
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
                                <div id="content-expenses" class="tab-pane fade">
                                <br>
                                 <p align="right"><button class="btn btn-primary" type="button" onclick="addexpenses();">Add</button></p>
	             
				          			 <div class="table-responsive">
				                                <table class="table table-striped table-bordered table-hover" id="t-expenses">
				                                    <thead>
				                                        <tr>
				                                            <th>Id</th>
				                                            <th>Description</th>
				                                            <th>Amount</th>
				                                            <th>Date</th>
				                                            <th>Action</th>
				                                        </tr>
				                                    </thead>
				                                </table>
				                            </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
  
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                       
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/brand-settings.js"></script>

	