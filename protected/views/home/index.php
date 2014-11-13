<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css">
<div class="wrap-eshares-login-container">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-heading-bg text-center">
						<h1>
							Check your <span class="highlight">equity</span> today!
						</h1>
						
						<form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/home" id="login-form" class="form-inline form-padd form-s1"> 
						
							<div class="form-group">
								<label class="sr-only" for="exampleInputEmail2">Email address</label>
								<input type="email" class="form-control input-lg"  id="LoginForm_email" name="LoginForm[email]" placeholder="Enter email">
								<?php if($error_message !=""):?>
								<span class="text-block text-danger text-left errorMessage" id="LoginForm_email_em_"><?php echo $error_message?></span>
								<?php endif?>
							</div>
							<div class="form-group">
								<label class="sr-only" for="exampleInputPassword2">Password</label>
								<input type="password" class="form-control input-lg"  id="LoginForm_password" name="LoginForm[password]" placeholder="Password">
								<span class="text-block text-danger text-left errorMessage" id="LoginForm_password_em_" style="display:none"></span>
							</div>
							<button type="submit" class="btn btn-info btn-lg" name="yt0">Sign in</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	