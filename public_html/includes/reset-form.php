<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aberystwyth Community of Gamers">
    <meta name="author" content="Nathan Hand, www.thehiddennation.com">
    <link rel="shortcut icon" href="">

    <title>Aberystwyth Community of Gamers</title>

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
	if (isset($_SESSION['verifynow'])){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Registration complete, please check your email inbox for the verification email.</div>";
	session_destroy();
	}
	
		if (isset($_SESSION['verifyfirst'])){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Your account has not been verified, please check your email inbox.</div>";
	session_destroy();
	}
	
		if (isset($_SESSION['verified'])){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Verification complete, please login.</div>";
	session_destroy();
	}
	
			if (isset($_SESSION['baduser'])){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Username or password incorrect. <a href='reset.php'>reset password?</a></div>";
	session_destroy();
	}
	?>

      <form class="form-signin" role="form" method="post" action="../reset.php">
        <h2 class="form-signin-heading">Reset password</h2>
        <input name="p" id="p" type="password" class="form-control" placeholder="Password" required autofocus>
        <input name="p_c" id="p_c" type="passowrd" class="form-control" placeholder="Confirm password" style="margin-bottom: 10px;" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset password</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>