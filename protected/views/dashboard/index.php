  <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>
    
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <div class="row">
               
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">$<?php echo number_format($total_equity)?></div>
                                    <div>Total Equity!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
               
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $eshares?></div>
                                    <div>Eshares</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default">
                        <div class="panel-heading">
                            Summary
                        </div>
                        
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li  class="active"><a data-toggle="tab" href="#highest_equity" aria-expanded="false">Highest Equity</a>
                                </li>
                                <li><a data-toggle="tab" href="#latest_teams" aria-expanded="true">Latest Teams</a>
                                </li>
                               
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="highest_equity" class="tab-pane fade active in">
                                    <div class="col-lg-6">
	                                    <div class="panel-body">
			                                <div class="table-responsive">
			                                <table class="table table-striped">
			                                    <thead>
			                                        <tr>
			                                            <th>Team</th>
			                                            <th>Equity Points</th>
			                                        </tr>
			                                    </thead>
			                                    <tbody>
			                                       <?php if (count($points)>0):?>
			                                       <?php foreach($points as $k=>$v):?>
				                                        <tr>
				                                            <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/equity/details/t/<?php echo $v->domain->domain_name?>"><?php echo $v->domain->domain_name?></a></td>
				                                            <td><img src="http://d2qcctj8epnr7y.cloudfront.net/images/2013/coin-equity-points-50x50.png" style="height:30px;">&nbsp; <?php echo number_format($v->equity_points)?></td>
				                                        </tr>
			                                        <?php endforeach;?>
			                                       <?php endif?> 
			                                        
			                                    </tbody>
			                                </table>
			                            </div>
	                                </div>
                                </div>
                                </div>
                                <div id="latest_teams" class="tab-pane fade">
                                 <div class="col-lg-12">
                                    <div class="panel-body">
			                            <div class="table-responsive">
			                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			                                    <thead>
			                                        <tr>
			                                            <th>Domain</th>
			                                        </tr>
			                                    </thead>
			                                    <tbody>
			                                    <?php if (count($teams)>0):?>
			                                    <?php foreach ($teams as $v=>$k):?>
			                                        <tr class="odd gradeX">
			                                            <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/equity/details/t/<?php echo $k->team->domain?>"><?php echo $k->team->domain?></a></td>
			                                        </tr>
			                                       <?php endforeach;?> 
			                                      <?php endif?>  
			                                    </tbody>
			                                </table>
			                            </div>
			                            <!-- /.table-responsive -->
			                            
			                        </div>
                                </div>
                                </div>
                               
                            </div>
                            

                        </div>
                        <!-- /.panel-body -->
                    </div>
 