<?PHP require("../includes/session.php");
require("../config.php");

if (isset($_COOKIE['failedlogin'])){
$failedlogin = true;
setcookie("failedlogin", "true", time()-3600);
}

if (isset($_COOKIE['directattempt'])){
$directattempt = true;
setcookie("directattempt", "true", time()-3600);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Aberystwyth Community of Gamers</title>
	<?PHP 
	require("../config.php");
	?>
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
if (isset($failedlogin)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Username or password incorrect, alternatively you are not an admin.</div>";
}

if (isset($directattempt)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-warning fade in hints'>You attempted to access the admin backend directly, please login first.</div>";
}


?>
  
      <form class="form-signin" role="form" method="post" action="verify.php">
        <h2 class="form-signin-heading">Admin backend - login</h2>
        <input name="u" id="u" type="text" class="form-control" placeholder="Email address" required autofocus>
        <input name="p" id="p" type="password" class="form-control" placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
