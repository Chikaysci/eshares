<!DOCTYPE html>
<html>
<head>
	<title>eshares.com</title>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
	
	
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.3/jquery.backstretch.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$.backstretch("<?php echo Yii::app()->request->baseUrl; ?>/images/smb_owner.jpg");
		});
	</script>
</head>
<body>
	<header class="hide">
		<nav class="navigation navigation-header">
			<div class="container">
				<div class="navigation-brand">
					<div class="brand-logo">
						<a href="" class="logo">
							<img src="http://d2qcctj8epnr7y.cloudfront.net/images/2013/logo-eshares1.png">
						</a>
					</div>
					<button data-target=".navigation-navbar" data-toggle="dropdown" type="button" class="navigation-toggle visible-xs">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
				</div>
				<div class="navigation-navbar">
					<ul class="navigation-bar navigation-bar-left">
                        <li class=""><a href="/appcom/web/">Home</a></li>
                        <li class="active"><a href="#about">About</a></li>
                        <li class=""><a href="#features">Features</a></li>
			        </ul>
                    <ul class="navigation-bar navigation-bar-right">
                        <li><a href="/appcom/web/login">Login</a></li>
                        <li class="featured active"><a href="/appcom/web/">Sign up</a></li>
                    </ul>
				</div>
			</div>
		</nav>
	</header>

	<nav class="navbar navbar-default navbar-s1-wrap" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand logo" href="#">
					<img src="http://d2qcctj8epnr7y.cloudfront.net/images/2013/logo-eshares1.png">
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-s1">
					<li  class="active"><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Features</a></li>
					
				</ul>
				
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<?php echo $content?>
</body>
</html>