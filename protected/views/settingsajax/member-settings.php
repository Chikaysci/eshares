<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/member-settings.js"></script>

<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

<div class="col-lg-6">
		  <div class="panel panel-default">
              <div class="panel-heading">
                            <?php echo ucfirst($domain) .' Member Settings'?>
              </div>
             <div class="panel-body">
			           <div class="table-responsive">
			                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			                                    <thead>
			                                        <tr>
			                                            <th>Member</th>
			                                            <th>Equity Type</th>
			                                        </tr>
			                                    </thead>
			                                    <tbody>
			                                    <?php if (count($members)>0):?>
			                                    <?php for ($i=0;$i<count($members);$i++):?>
			                                        <tr class="odd gradeX">
			                                            <td><?php echo $members[$i]['name']?></td>
			                                            <td> <?php $this->renderPartial('_equity-role-form',array('types'=>$types,'member_id'=>$members[$i]['member_id'],'type_id'=>$members[$i]['type_id'],'domain_id'=>$domain_id)); ?></td>
			                                        </tr>
			                                       <?php endfor;?> 
			                                      <?php endif?>  
			                                    </tbody>
			                                </table>
			                            </div>
			</div>
		</div>	
</div>
	