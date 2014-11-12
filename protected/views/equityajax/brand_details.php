   <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Brand Details
                        </div>
                        <div class="panel-body">
                            <div class="row">
                               <div class="col-lg-8">
								<div id="save_pie_result"></div>
								<form role="form" id="pie_settings_form">
                                        <div class="form-group">
                                            <label>Team Name</label>
                                            <input class="form-control" value="<?echo $domain_name?> Team" disabled />
                                        </div>
										
										<div class="form-group">
                                            <label>Currency</label>
                                            <select class="form-control" id="currency">
												<?foreach($currencies AS $currency):?>
													<option value="<?echo $currency?>"><?echo $currency?></option>
                                                <?endforeach;?>
                                            </select>
                                        </div>
										
                                        <div class="form-group">
                                            <label>Non-Cash Multiplier</label>
                                            <input class="form-control" id="non_cash_multiplier" value="<?echo $non_cash_multiplier?>" />
                                        </div>
										
										<div class="form-group">
                                            <label>Cash Multiplier</label>
                                            <input class="form-control" id="cash_multiplier" value="<?echo $cash_multiplier?>" />
                                        </div>

										<div class="form-group">
                                            <label>Commission Rate</label>
                                            <input class="form-control" id="commission_rate" value="<?echo $commission_rate?>" />
                                        </div>
										
										<div class="form-group">
                                            <label>Royalty Rate</label>
                                            <input class="form-control" id="royalty_rate" value="<?echo $royalty_rate?>" />
                                        </div>
										
                                        <input type="hidden" value="<?echo $s_id?>" id="s_id" />
                                        <button type="button" id="submit_pie_settings_form" class="btn btn-default">Save Changes</button>
                                        
                                    </form>
								</div> <!-- col-lg-8 -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->