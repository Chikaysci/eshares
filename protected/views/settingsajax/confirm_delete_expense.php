 <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
</div>

    <div class="modal-body">
        
          <div class="alert alert-danger">
             Are you sure you want to delete record: <?php echo $model->description.' with the amount of '.$model->amount?>?
         </div>
    </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-primary" onclick="deleteexpense('<?php echo $model->ex_id?>')">Delete</button>
</div>