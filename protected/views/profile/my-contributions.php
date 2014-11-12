 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">My Contributions</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
        
			 <div class="panel panel-default">
                        <div class="panel-heading">
                            &nbsp;
                        </div>
			 <!-- /.panel-heading -->
                <div class="panel-body">
						<button type="button" id="deleteselected" class="btn btn-primary btn-xs"><i class="fa fa-trash"></i> Delete Selected</button>
						<br><br>
							<div id="notification"></div>
						
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				                      <thead>
				                           <tr>
				                             <th><input type="checkbox" name="checkall" id="checkall" class="checkall"></th>
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
				                            		<tr id="row_<?php echo $row['c_id']?>">
				                            		    <td><input type="checkbox" id="cbox" name="cbox" value="<?php echo $row['c_id']?>"></td>
				                            			<td><?php echo $row['firstname'].' '.$row['lastname']?></td>
				                            			<td><?php echo $row['name']?></td>
				                            			<td><?php echo $row['amount']?></td>
				                            			<td><?php echo  date( 'Y-m-d',strtotime( $row['date_added'] ));?></td>
				                            			<td><?php echo $row['description']?></td>
				                            		</tr>
				                            	<?php endforeach;?>
				                           <?php endif?>        
				                                   
				                       </tbody>
				                  </table>

				</div>
                <!-- /.panel-body -->
        </div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script>
$(document).ready(function() {
	$('a').removeClass("active");
	$('a#li_mycontributions').addClass("active");
    
	$('#dataTables-example').dataTable();	
	
	
		$('#deleteselected').live('click',function(){
	    var selectedArr = new Array();
		
		$("input:checkbox[name=cbox]:checked").each(function(){	
			var temp = $(this).val();
			selectedArr.push(temp);
		});
		
		if(selectedArr.length < 1){
			$('#notification').html('<div class="alert alert-danger"><i class="fa-warning"></i> Please select at least one.</div>');
		}else{
			var base_url = $('#base_url').val();
			console.log("Array contents: "+selectedArr);
			$('#notification').html('<div class="alert alert-danger"><i class="fa-warning"></i> <img src="http://manage.vnoc.com/images/loaders/loader1.gif" alt=""/>Please wait. </div></br>');
			$.post(base_url+'/equityajax',{t:'deletecontribution',selectedarray:selectedArr},function(data){
				if(data.status){
					$('#notification').html('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Delete successful.</div></br>');
					cleardeleted(selectedArr);
					
				}else{
					$('#notification').html('<div class="alert alert-danger">Failed. There was an error while deleting.</div></br>');
				}
			});
		}
	});
	

	$('input[type="checkbox"][name="checkall"]').live('change',function() {
		 if(this.checked) {
			$('input:checkbox').prop('checked',true);
			console.log("check check");
		 }else{
			 $('input:checkbox').prop('checked',false);
		 }
    });
	
	
});

function cleardeleted(selectedArr){
	var size = selectedArr.length + 1;
	for(var i = 0; i<size ; i++){
		var fadethis = selectedArr.pop();
		$('#row_'+fadethis).hide();
		console.log("hide "+fadethis);
	}
}

</script>