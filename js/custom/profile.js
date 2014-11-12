$(document).ready(function(){
	$('#submit_personal_settings').click(function(){
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			var password1 = $("#password1").val();
			var password2 = $("#password2").val();
				console.log("verifying..");
				
				
				if(firstname == ""){
					$('#result').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>First Name can not be empty.</div>');
					$("#firstname").focus();
				}else if(lastname == ""){
					$('#result').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Last Name can not be empty.</div>');
					$("#lastname").focus();
				}else if(password1 == ""){
					$('#result').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Please enter password</div>');
					$("#password1").focus();
				}else if(password2 == ""){
					$('#result').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Please confirm password</div>');
					$("#password2").focus();
				}else if(password1 != password2){
					$('#result').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Passwords did not match.</div>');
					$("#password2").focus();
				}else{
					$('#result').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><img src="http://manage.vnoc.com/images/loaders/loader4.gif" alt="" /> Saving in production.. Please wait.</div>');
					$.post('/profileajax/updatepersonalprofile',{firstname:firstname,lastname:lastname,password:password1},function(data){
						if(data.success){
							$('#result').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Changes saved.</div>');
						}else{
							$('#result').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Unable to save.</div>');
						}
					});
				}
				
				
			
		
	});
});