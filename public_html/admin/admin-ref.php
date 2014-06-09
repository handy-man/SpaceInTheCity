<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
require('../core/functions.php');
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
require('../dbconfig.php');
$connect = mysqli_connect($host,$user,$pass,$dbname);
$admin_email = $_POST['admin_email'];
$admin_email = mysqli_real_escape_string($connect, $admin_email); //Shouldn't really have to do this, our admins can be trusted right?
$check = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$admin_email' AND `admin` = '0' LIMIT 0, 30 ");	
$result = mysqli_num_rows($check);

$anyadmins = mysqli_query($connect, "SELECT * FROM `users` WHERE `admin` = '2' LIMIT 0, 30 ");	
$anyadmin_result = mysqli_num_rows($anyadmins);
//We're checking if we have website admins still, only because we might want to clean the list of refs.
$web_admin = mysqli_query($connect, "SELECT `admin` FROM `users` WHERE `admin` = '2' AND `email` = '$admin_email' LIMIT 0, 30 ");	
$web_admin_result = mysqli_num_rows($web_admin);
if ($result == 1 && $web_admin_result != 1){
$update = mysqli_query($connect, "UPDATE `users` SET `admin` = '1' WHERE `email` = '$admin_email'");
$_SESSION['editpushed'] = true;
$user_id=$_SESSION['uid'];
$event = "The following user was given ref! " . $admin_email . ".";
log_admin($connect, $user_id, $event);
}
else if($_SESSION['email'] == $admin_email){
$_SESSION['editpushed'] = false;
}
else if ($web_admin_result == 1){
$_SESSION['webadmintrue'] = true;
}
else if ($anyadmin_result > 1 && $web_admin_result != 1){
$update = mysqli_query($connect, "UPDATE `users` SET `admin` = '0' WHERE `email` = '$admin_email'"); //not sure if should give to most people.
$_SESSION['editpushed'] = true;
$user_id=$_SESSION['uid'];
$event = "The following user had ref taken away! " . $admin_email . ".";
log_admin($connect, $user_id, $event);
}
else{
$noadmins = true;
}
mysqli_close($connect);
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
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! Ref has been made or taken away.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
			unset($_SESSION['editpushed']);
		}
		else{
			echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Don't try and edit yourself.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
			unset($_SESSION['editpushed']);
		}
	}
	
	if (isset($_SESSION['webadmintrue'])){
				echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>This user is a website admin, they're already considered a ref.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
			unset($_SESSION['webadmintrue']);
	}
	
	if ($noadmins == true){
	echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>No more admins left, you can't kill the last admin.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
	unset($noadmins);
	}
	
	?>
	<img class="img-responsive img-center" src="../images/acog-logo.png" />
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
	<p style="text-align: center;">Make and break referees.</p>
	<P>Enter the Email of the person you want to make an Ref, if they are already an Ref it will take it away.</p>
    <input name="admin_email" type="text" class="form-control" placeholder="Email address" required>
    <input class="form-control btn btn-success" type="submit" value="Save"> 

</form>
<p>Current list of Refs:</p>

<?PHP
require_once('../dbconfig.php');
$connect_1 = mysqli_connect($host,$user,$pass,$dbname);
$adminlist = mysqli_query($connect_1, "SELECT * FROM `users` WHERE `admin` = '1' LIMIT 0, 30 ");	
while($adminlistprint = mysqli_fetch_array($adminlist, MYSQLI_ASSOC)) {
echo "<div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>" . $adminlistprint['displayname'] . " - " . $adminlistprint['email'] . "</h3></div></div>";
}
?>
<!--
<p>Current list of non-admins:</p>
<?PHP
/**
$nonadminlist = mysqli_query($connect_1, "SELECT * FROM `users` WHERE `admin` = '0' LIMIT 0, 30 ");	
while($nonadminlistprint = mysqli_fetch_array($nonadminlist, MYSQLI_ASSOC)) {
echo "<div class='panel panel-warning'><div class='panel-heading'><h3 class='panel-title'>" . $nonadminlistprint['displayname'] . " - " . $nonadminlistprint['email'] . "</h3></div></div>";
}

*/
?>

-->

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
