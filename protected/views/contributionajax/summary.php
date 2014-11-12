  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/dataTables.bootstrap.css" rel="stylesheet">
  
<script>
$(document).ready(function() {
    $('#dataTables-example').dataTable();
});
</script>
  
  
<div class="row">
	  <div class="col-lg-12">
			  <div class="panel panel-default">
	              <div class="panel-heading">
	                            Summary
	              </div>
	             <div class="panel-body">
				           <div class="table-responsive">
				                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
				                      <thead>
				                           <tr>
				                              <th>Member</th>
				                             <?php if (count($contributions)>0):?>
				                             <?php foreach ($contributions as $key=>$v):?>
				                             	<th><?php echo $v->name?></th>
				                             <?php endforeach;?>	
				                             <?php endif?>
				                             <th>Total</th>
				                             <th>Slice of Pie</th>
				                           </tr>
				                      </thead>
				                                    <tbody>
				                                    <?php if (count($members)>0):?>
				                                    <?php for ($i=0;$i<count($members);$i++):?>
				                                        <tr class="odd gradeX">
				                                            <td><?php echo $members[$i]['name']?></td>
				                                             <?php foreach ($contributions as $key=>$v):?>
								                                <td><?php echo $members[$i]['type_'.$v->c_id]?></td>
								                             <?php endforeach;?>	
								                             <td><?php echo $members[$i]['total'] ?></td> 
								                             <td><?php echo $members[$i]['percent'] ?>%</td>               
								                         </tr>
				                                       <?php endfor;?> 
				                                      <?php endif?>  
				                                    </tbody>
				                  </table>
				        </div>
				</div>
			</div>	
	</div>
</div>

<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Equity Summary
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Member</th>
                                            <th>Type</th>
                                            <th>Percent</th>
                                            <th>Theoretical Value</th>
                                            <th>Equity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($p)>0):?>
                                          <?php foreach ($p as $kar=>$var):?>
	                                        <tr>
	                                            <td><?php echo $var['name']?></td>
	                                            <td><?php echo $var['type']?></td>
	                                            <td><?php echo $var['data']?>%</td>
	                                            <td><?php echo number_format($theo_value)?></td>
	                                            <td><?php echo (number_format($theo_value * ($var['data']/100)))?></td>
	                                        </tr>
	                                      <?php endforeach;?>  
                                      <?php endif?>  
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
        </div>
              
</div>

	