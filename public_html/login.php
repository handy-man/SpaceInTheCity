<?PHP require('./includes/session.php');
require("./config.php");
require("./includes/settings.php");

if (isset($_COOKIE['pleaseverify'])){
$verify = true;
setcookie("pleaseverify", "true", time()-3600, '/');
}

if (isset($_COOKIE['verifyfirst'])){
$verifyfirst = true;
setcookie("verifyfirst", "true", time()-3600, '/');
}

if (isset($_COOKIE['nope'])){
$nope = true;
setcookie("nope", "true", time()-3600, '/');
}

if (isset($_COOKIE['passreset'])){
$passreset = true;
setcookie("passreset", "true", time()-3600, '/');
}

if (isset($_COOKIE['verified'])){
$verified = true;
setcookie("verified", "", time()-3600, '/');
}

if (isset($_COOKIE['baduser'])){
$baduser = true;
setcookie("baduser", "true", time()-3600, '/');
}

if (isset($_COOKIE['noexist'])){
$noexist = true;
setcookie("noexist", "true", time()-3600, '/');
}

if (isset($_COOKIE['passchanged'])){
$passchanged = true;
setcookie("passchanged", "true", time()-3600, '/');
}

if (isset($_COOKIE['reallybaduser'])){
$reallybaduser = true;
setcookie("reallybaduser", "true", time()-3600, '/');
}

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Login // aspaceinthecity.co.uk</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">	
	<?PHP
	if (isset($verify)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Please login.</div>";
	}
	
			if (isset($baduser)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Username or password incorrect, talk to manager.</div>";
	}
	
				if (isset($nope)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Please login to access that function.</a></div>";
	}
	
				if (isset($noexist)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>404 user not found, please <a href='../register/'>register</a> first.</div>";
	}
	
				if ($login_enabled == false){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Login is currently disabled!</div>";
		}
		
				if (isset($reallybaduser)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>I said it was disabled! go back to computer science class.</div>";
	}
	?>

      <form class="form-signin" role="form" method="post" action="verify.php">
        <h2 class="form-signin-heading">Please sign in</h2>
		<div class="input-group input-group-sm">
		<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input name="u" id="u" type="text" class="form-control" placeholder="Username" required autofocus>
		</div>
		<div class="input-group input-group-sm">
		<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <input name="p" id="p" type="password" class="form-control" placeholder="Password" required>
		</div>
		<div style="margin-bottom: 10px;"></div>
		<?PHP
		if ($login_enabled == true){
		echo "<button class='btn btn-lg btn-primary btn-block' type='submit'>Sign in</button>";
		}
		else{
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Login is currently disabled!</div>";
		}
		?>
        
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
