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
$check = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$admin_email' AND `port_mod` = '0' LIMIT 0, 30 ");	
$result = mysqli_num_rows($check);

$anyadmins = mysqli_query($connect, "SELECT * FROM `users` WHERE `port_mod` = '1' LIMIT 0, 30 ");	
$anyadmin_result = mysqli_num_rows($anyadmins);
if ($result == 1){
$update = mysqli_query($connect, "UPDATE `users` SET `port_mod` = '1' WHERE `email` = '$admin_email'");
$_SESSION['editpushed'] = true;
$user_id=$_SESSION['uid'];
$event = "The following user was given port mod privileges! " . $admin_email . ".";
log_admin($connect, $user_id, $event);
}
else if($_SESSION['email'] == $admin_email){
$_SESSION['editpushed'] = false;
}
else if ($anyadmin_result > 1){
$update = mysqli_query($connect, "UPDATE `users` SET `port_mod` = '0' WHERE `email` = '$admin_email'"); //not sure if should give to most people.
$_SESSION['editpushed'] = true;
$user_id=$_SESSION['uid'];
$event = "The following user had port mod taken away! " . $admin_email . ".";
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
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! Port moderation has been given or taken away.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
			unset($_SESSION['editpushed']);
		}
		else{
			echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Don't try and edit yourself.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
			unset($_SESSION['editpushed']);
		}
	}
	
	if ($noadmins == true){
	echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>We have no port mods... so no.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
	unset($noadmins);
	}
	
	?>
	<img class="img-responsive img-center" src="../images/acog-logo.png" />
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
	<p style="text-align: center;">Make and break port moderators.</p>
	<P>Enter the Email of the person you want to make a port mod, if they are already a port mod it will take it away.</p>
    <input name="admin_email" type="text" class="form-control" placeholder="Email address" required>
    <input class="form-control btn btn-success" type="submit" value="Save"> 

</form>
<p>Current list of port mods:</p>

<?PHP
require_once('../dbconfig.php');
$connect_1 = mysqli_connect($host,$user,$pass,$dbname);
$adminlist = mysqli_query($connect_1, "SELECT * FROM `users` WHERE `port_mod` = '1' LIMIT 0, 30 ");	
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
