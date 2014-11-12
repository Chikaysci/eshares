 <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Update Contribution Type</h4>
</div>

    <div class="modal-body">
         <form role="form">
                        <div class="alert alert-danger" id="contrib-error" style="display:none">
                                
                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input id="ctype_name" name="ctype_name"  class="form-control" value="<?php echo $type->name?>">
                                        </div>
                                        <input type="hidden" name="ctype_id" id="ctype_id" value="<?php echo $type->c_id?>">
                                        
                                    </form>
    </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="savetype()">Save</button>
</div>