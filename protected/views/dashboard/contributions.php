<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/contribution_types.js"></script>




             <div class="row">
                <div class="col-lg-6">
                  <h1 class="page-header">Manage Contribution Types</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
	<div class="row">
	<div class="col-lg-6">
			  <div class="panel panel-default">
	              <div class="panel-heading">
	                            Contribution Types
	              </div>
	             <div class="panel-body">
	             
	             <p align="right"><button class="btn btn-primary" type="button" onclick="addctype();">Add</button></p>
	             
				           <div class="table-responsive">
				                                <table class="table table-striped table-bordered table-hover" id="contribution-types">
				                                    <thead>
				                                        <tr>
				                                            <th>Id</th>
				                                            <th>Name</th>
				                                            <th>&nbsp;</th>
				                                        </tr>
				                                    </thead>
				                                    
				                                </table>
				                            </div>
				</div>
			</div>	
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

	