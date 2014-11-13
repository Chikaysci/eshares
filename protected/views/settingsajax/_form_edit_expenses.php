 <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Update Expenses</h4>
</div>

    <div class="modal-body">
         <form role="form">
                        <div class="alert alert-danger" id="expense-error" style="display:none">
                                
                        </div>
                                        
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input  id="ex_date" name="ex_date"  class="form-control" value="<?php echo $model->date_spent?>">
                                        </div>
                                     
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea rows="3" id="ex_description" name="ex_description" class="form-control"><?php echo $model->description?></textarea>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input placeholder="0" id="ex_amount" name="ex_amount"  class="form-control" value="<?php echo $model->amount?>">
                                        </div>
                  
                  <input type="hidden" name="ex_id" id="ex_id" value="<?php echo $model->ex_id?>">                   
           </form>
    </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="updateexpenses()">Save changes</button>
</div>

<script>
$(document).ready(function(){
	$( "#ex_date" ).datepicker();
});
</script>