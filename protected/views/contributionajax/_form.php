 <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Add <?php echo $type->name?></h4>
</div>

    <div class="modal-body">
         <form role="form">
                        <div class="alert alert-danger" id="contrib-error" style="display:none">
                                
                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea rows="3" id="c_description" name="c_description" class="form-control"></textarea>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input placeholder="0" id="c_amount" name="c_amount"  class="form-control">
                                        </div>
                                        
                                        <input type="hidden" name="member_id" id="member_id" value="<?php echo $member_id?>">
                                        <input type="hidden" name="contrib" id="contrib" value="<?php echo $type->c_id?>">
                                    </form>
    </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="savecontribution()">Save changes</button>
</div>