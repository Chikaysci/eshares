 <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Fund
                        </div>
                        <div class="panel-body">
							<div id="addfund_result"></div>
							<div class="form-group">
                                            <label>Amount Invested</label>
                                            <input class="form-control" id="add_fund_amount" >
                                            <p class="help-block">Pleas enter numbers only, in USD.</p>
                                        </div>
                                       
							<div class="form-group">
                                            <label>Investor</label>
                                            <select class="form-control" id="add_fund_investor">
                                                <?php if (count($team_members)>0):?>
												<?php foreach($team_members as $m=>$member):?>
													<option value="<?php echo $member['member_id']?>"><?php echo $member['firstname'].' '.$member['lastname']?></option>
												<?php endforeach;?>
												<?php endif;?>
                                                
                                            </select>
                                        </div>
										
							<button type="button" onclick="saveaddfund()" class="btn btn-default">Add Funds</button>
						
						</div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
 </div>
<!-- /.col-lg-12 -->