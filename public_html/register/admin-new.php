<?PHP
require('../includes/session.php');
require("../config.php");
require("../includes/settings.php");

if (isset($_COOKIE['mismatch'])){
$mismatch = true;
setcookie("mismatch", "true", time()-3600, '/');
}

if (isset($_COOKIE['exist'])){
$exist = true;
setcookie("exist", "true", time()-3600, '/');
}

if (isset($_COOKIE['notfound'])){
$notfound = true;
setcookie("notfound", "true", time()-3600, '/');
}

if (isset($_COOKIE['reallybaduser'])){
$reallybaduser = true;
setcookie("reallybaduser", "true", time()-3600, '/');
}

if (isset($_COOKIE['nodisplay'])){
$nodisplay = true;
setcookie("nodisplay", "true", time()-3600, '/');
}

if (isset($_COOKIE['baddomain'])){
$baddomain = true;
setcookie("baddomain", "true", time()-3600, '/');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Register // abercog.co.uk</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
	
	<style>
	.tooltip.right {
	width: 300px;
	}
	</style>

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
				if (isset($mismatch)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-warning fade in hints'>Your email address or passwords didn't match, please try again.</div>";
	}
	
				if (isset($exist)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-warning fade in hints'>That email address is already in use! Please try to <a href='../login/'>login</a></div>";
	}
	
					if (isset($notfound)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-warning fade in hints'>That email address is already in use! Please try to <a href='../login/'>login</a></div>";
	}
	
			if ($register_enabled == false){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Registration is currently disabled!</div>";
		}
		
						if (isset($reallybaduser)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>I said it was disabled!</div>";
	}
	
							if (isset($nodisplay)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>ERROR, You're missing data.</div>";
	}
	
							if (isset($baddomain)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>That email provider is not allowed.</div>";
	}
	?>
	
	
      <form class="form-signin" name="form1" role="form" method="post" action="./register.php">
        <h2 class="form-signin-heading">ASITC - Registration</h2>
		<div class="input-group input-group-sm">
		<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input name="displayname" id="displayname" data-toggle="tooltip" data-placement="right" title="" data-original-title="Displayname" type="text" class="form-control" placeholder="Display Name" required>
		</div>
		<div class="input-group input-group-sm">
		<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <input name="password" id="password" data-toggle="tooltip" data-placement="right" title="" data-original-title="Password" type="password" class="form-control" placeholder="Password" required>
		</div>
		<div class="input-group input-group-sm">
		<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
		<input name="conf_password" id="conf_password" type="password" class="form-control" placeholder="Confirm Password" required>
		</div>
		<div  style="margin-bottom: 10px;"></div>
		<?PHP
		if ($register_enabled == true){
		echo "<button class='btn btn-lg btn-primary btn-block' type='submit'>Register</button>";
		}
		else{
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Registration is currently disabled!</div>";
		
		}
		?>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	    <script>
	$(document).ready(function() {
	$('#displayname').tooltip({'trigger':'focus', 'title': 'tooptip'});
	$('#email').tooltip({'trigger':'focus', 'title': 'tooptip'});
	$('#password').tooltip({'trigger':'focus', 'title': 'tooptip'});
	});
	</script>
  </body>
</html>
