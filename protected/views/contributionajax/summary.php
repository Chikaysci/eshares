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
				                                        <tr class="odd gradeX <?php if (Yii::app()->user->getId()==$members[$i]['member_id']) echo 'text-primary'?>">
				                                            <td ><?php echo $members[$i]['name']?></td>
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
				        <br>
				        <div class="alert alert-info">
				         <b>Summary Computations</b><br>
				         <?php $i=0;?>
                          user1_total_contributions =  
                          <?php if (count($contributions)>0):?>
                             <?php foreach ($contributions as $ckey=>$cvalue):?>
                                <?php echo $cvalue->name?> <?php if ($i < count($contributions)-1) echo '+'?> 
                                <?php $i++;?>
                             <?php endforeach;?>
                             
                          <?php endif?>   <br>
                          <?php $i=0;?>
                           user2_total_contributions =  
                          <?php if (count($contributions)>0):?>
                             <?php foreach ($contributions as $ckey=>$cvalue):?>
                                <?php echo $cvalue->name?> <?php if ($i < count($contributions)-1) echo '+'?>
                                <?php $i++;?>
                             <?php endforeach;?>
                             
                          <?php endif?>   <br><br>
                          
                          Slice of pie = (user1_total_contributions/( user1_total_contributions + user2_total_contributions  )) X 100
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
	                                        <tr class="<?php if (Yii::app()->user->getId()==$var['member_id']) echo 'text-primary'?>">
	                                            <td ><?php echo $var['name']?></td>
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
        
        
        <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Revenue Shares
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
                                            <th>Monetization</th>
                                            <th>Expenses</th>
                                            <th>Share</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($p)>0):?>
                                          <?php foreach ($p as $kar=>$var):?>
	                                        <tr  class="<?php if (Yii::app()->user->getId()==$var['member_id']) echo 'text-primary'?>">
	                                            <td><?php echo $var['name']?></td>
	                                            <td><?php echo $var['type']?></td>
	                                            <td><?php echo $var['data']?>%</td>
	                                            <td><?php echo number_format($monetization)?></td>
	                                            <td><?php echo $expenses?></td>
	                                            <td><?php echo (number_format(($monetization-$expenses) * ($var['data']/100)))?></td>
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

	