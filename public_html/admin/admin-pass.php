<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
require('../core/functions.php');
require('../dbconfig.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Aberystwyth Community of Gamers</title>
	
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/navbar-fixed-top.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <?php

if (isset($_POST['admin_email'])){
$connect = mysqli_connect($host,$user,$pass,$dbname);
$admin_email = $_POST['admin_email'];
$admin_password = $_POST['admin_password'];
$admin_email = mysqli_real_escape_string($connect, $admin_email); //Shouldn't really have to do this, our admins can be trusted right?
$admin_password = mysqli_real_escape_string($connect, $admin_password); //Shouldn't really have to do this, our admins can be trusted right?
$salt_part1 = md5( rand(0,1000) );
$salt_part2 = md5( rand(0,1000) );
$salt = crypt($salt_part1, $salt_part2);
$admin_password = crypt($admin_password, $salt); //Shouldn't really have to do this, our admins can be trusted right?
$check = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$admin_email' LIMIT 0, 30 ");	
$result = mysqli_num_rows($check);
if ($result == 1){
$update = mysqli_query($connect, "UPDATE `users` SET `password` = '$admin_password', `salt` = '$salt' WHERE `email` = '$admin_email'");
$user_id=$_SESSION['uid'];
$event = "Changed the password of " . $admin_email . " ";
log_admin($connect, $user_id, $event);
$_SESSION['editpushed'] = true;
}
}
?>
	
    <!-- Fixed navbar repeated code because we need to change active page. -->
	<div id="wrap">
    <?PHP
	Navigation_admin();
	?>
    <div class="container">
	<?PHP
	if (isset($_SESSION['editpushed'])){
	
		if($_SESSION['editpushed'] == true){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! password changed!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
			unset($_SESSION['editpushed']);
		}
		else{
			echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Don't try and edit yourself.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
			unset($_SESSION['editpushed']);
		}
	}
	
	?>
	<img class="img-responsive img-center" src="../images/acog-logo.png" />
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
	<p style="text-align: center;">Password changer!</p>
	<P>Enter the Email of the person you want to change a password for.</p>
    <input name="admin_email" type="text" class="form-control" placeholder="Email address" required autofocus>
    <input name="admin_password" type="password" class="form-control" placeholder="password" required>
    <input class="form-control btn btn-success" type="submit" value="Save"> 

</form>
      </div>

    </div> <!-- /container -->
	
	</div><!-- /wrap -->
	<?PHP include("../includes/footer.php");?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
