<?PHP
//Load our database
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
//Database connect
$connect = mysqli_connect($host,$user,$pass,$dbname);

if ($_SESSION['resetallow'] = false){
header('Location:' . $home . '/error.php');
}

if (isset($_POST['p'])){
$pass = $_POST['p'];
$pass_conf = $_POST['p_c'];

if($pass != $pass_conf){
//redirect back to index with error
$_SESSION['mismatch'] = true;
header('Location:' . $home . '/login/reset.php');
}
$email = $_SESSION['emailtoreset'];
$pass = mysqli_real_escape_string($connect, $pass);
$saltgrab = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' LIMIT 0, 1");	
$saltgrab_array = mysqli_fetch_array($saltgrab);
$salt = $saltgrab_array['salt'];
$pass = crypt($pass, $salt);
$hash = md5( rand(0,1000) );
$check = mysqli_query($connect, "UPDATE `users` SET `password` = '$pass', `verify` = '$hash' WHERE `email` = '$email'");
setcookie("passchanged", "true", time()+60, '/');
header('Location: ' . $home . '/login/');
}
?>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Password reset // abercog.co.uk</title>

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

      <form class="form-signin" role="form" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <h2 class="form-signin-heading">Reset password</h2>
        <input name="p" id="p" type="password" class="form-control" placeholder="Password" required autofocus>
        <input name="p_c" id="p_c" type="password" class="form-control" placeholder="Confirm password" style="margin-bottom: 10px;" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset password</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
