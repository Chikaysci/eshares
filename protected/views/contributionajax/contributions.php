  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/dataTables.bootstrap.css" rel="stylesheet">
  
<div class="row">
	  <div class="col-lg-12">
			  <div class="panel panel-default">
	              <div class="panel-heading">
	                            Contributions
	              </div>
	             <div class="panel-body">
							<div id="notification"></div>
									
								<button type="button" id="deleteselected" class="btn btn-primary btn-xs"><i class="fa fa-trash"></i> Delete Selected</button>
								
							<br><br>		
				           <div class="table-responsive">
				                <table class="table table-striped table-bordered table-hover" id="ctable">
				                      <thead>
				                           <tr>
				                             <th><input type="checkbox" id="checkall" class="checkall"></th>
				                             <th>Member</th>
				                             <th>Contribution</th>
				                             <th>Value</th>
				                             <th>Date</th>
				                             <th>Description</th>
				                           </tr>
				                      </thead>
				                        <tbody>
				                           <?php if (count($contributions)> 0):?>
				                            	<?php foreach ($contributions as $key=>$row):?>
				                            		<tr>
				                            		    <td><input type="checkbox" id="cbox" name="cbox" value="<?php echo $row['c_id']?>"></td>
				                            			<td><?php echo $row['firstname'].' '.$row['lastname']?></td>
				                            			<td><?php echo $row['c_type']?></td>
				                            			<td><?php echo $row['amount']?></td>
				                            			<td><?php echo  date( 'Y-m-d',strtotime( $row['date_added'] ));?></td>
				                            			<td><?php echo $row['description']?></td>
				                            		</tr>
				                            	<?php endforeach;?>
				                           <?php endif?>        
				                                   
				                       </tbody>
				                  </table>
				        </div>
				</div>
			</div>	
	</div>
</div>



<script>

var oTable =   $('#ctable').dataTable( {
	  "aoColumns": [
          { "bSearchable": false ,"bSortable": false},
          { "bSearchable": true , "bSortable": true},
          { "bSearchable": true , "bSortable": true},
          { "bSearchable": true , "bSortable": true},
          { "bSearchable": true , "bSortable": true},
          { "bSearchable": true , "bSortable": true},
          
      ],
  } );

    



$('.checkall').bind("click", function(){
	$('table#ctable input[type=checkbox]').attr('checked',true);
	$(this).removeClass("checkall");
	$(this).addClass("uncheckall");
});

$('.uncheckall').bind("click", function(){
	$('table#ctable input[type=checkbox]').attr('checked',false);
	$(this).removeClass("uncheckall");
	$(this).addClass("checkall");
});
</script>

	