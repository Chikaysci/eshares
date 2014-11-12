 
  <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Personal Info</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
        
			 <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit
                        </div>
			 <!-- /.panel-heading -->
                <div class="panel-body">
 
								 <div id="result"></div>
								 <form role="form" id="personal_settings">
									<p class="help-block">Changes will reflect to your VNOC Account.</p>
									
									<div class="form-group">
									   <label>First Name</label>
									   <input class="form-control" id="firstname" value="<?echo $firstname?>">
									</div>
									<div class="form-group">
									   <label>Last Name</label>
									   <input class="form-control" id="lastname" value="<?echo $lastname?>">
									   
									</div>
									<div class="form-group">
									   <label>Email</label>
									   <input class="form-control" value="<?echo $email?>" disabled>
									   <p class="help-block">You can not change your email.</p>
									</div>
									<div class="form-group">
									   <label>Password</label>
									   <input class="form-control" id="password1" type="password" value="<?echo $password?>">
									   
									</div>
									
									<div class="form-group">
									   <label>Confirm Password</label>
									   <input class="form-control" id="password2" type="password" value="<?echo $password?>">
									  
									</div>
									
									<button type="button" id="submit_personal_settings" class="btn btn-default">Save Changes</button>
								 </form>

						</div>
                        <!-- /.panel-body -->
        </div>
<script type="text/javascript" src="/js/custom/profile.js"></script>
<script>
$(document).ready(function() {
	$('a').removeClass("active");
	$('a#li_mycontributions').addClass("active"); 
});