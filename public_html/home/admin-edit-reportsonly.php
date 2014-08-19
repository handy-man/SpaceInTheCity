<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
require('../core/functions.php');

require('../dbconfig.php');
$connect = mysqli_connect($host,$user,$pass,$dbname);
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Reports manager - Create or remove report status</title>
	
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
$admin_email = $_POST['admin_email'];
$admin_email = mysqli_real_escape_string($connect, $admin_email); //Shouldn't really have to do this, our admins can be trusted right?
$check = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '$admin_email' AND `level` != '1'");	
$result = mysqli_num_rows($check);

$anyadmins = mysqli_query($connect, "SELECT * FROM `users` WHERE `level` = '1' LIMIT 0, 30 ");	
$anyadmin_result = mysqli_num_rows($anyadmins);
//Anyadmin is used to check if we still have an admin, if we don't DO NOT ALLOW REMOVAL! (no admins is bad)
if ($result == 1){
$update = mysqli_query($connect, "UPDATE `users` SET `level` = '1' WHERE `username` = '$admin_email'");
$adminchange = 1;
}
else if ($anyadmin_result >= 1){
$update = mysqli_query($connect, "UPDATE `users` SET `level` = '0' WHERE `username` = '$admin_email'"); //not sure if should give to most people.
$adminchange = 2;
}
else{
$noadmins = true;
}
}
?>
	
    <!-- Fixed navbar repeated code because we need to change active page. -->
	<div id="wrap">
    <?PHP
	Navigation_home($home);
	?>
    <div class="container">
	<?PHP
	
		if($adminchange == 1){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! Admin has been given.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
			unset($adminchange);
		}
		
		if($adminchange == 2){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! Admin has been taken away.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
			unset($adminchange);
		}
	if ($noadmins == true){
	echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>No more admins left, you can't kill the last admin.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
	unset($noadmins);
	}
	?>
	<div class="page-header">
		<h1>Report access manager <small>Create/ Remove reports access</small></h1>
	</div>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

			<div style="margin-bottom: 10px;" class="input-group input-group-sm">
		<span class="input-group-addon">User</span>
		<select name="admin_email" class="form-control">
		<?PHP
	
		$userlist = mysqli_query($connect, "SELECT `ID`, `username`, `enabled` FROM `users` WHERE `enabled` = '1' AND `level` != '2' ORDER BY `username` ASC");
		while($userlistprint = mysqli_fetch_array($userlist, MYSQLI_ASSOC)) {
		echo "<option value='" . $userlistprint['username'] . "'>" . $userlistprint['username'] . "</option>";
		}
		
	
		
		?>
		</select>
		</div>

    <input class="form-control btn btn-success" type="submit" value="Give the above user access to daily reports."> 
</form>
<p>Current list of HK report access:</p>

<?PHP
$adminlist = mysqli_query($connect, "SELECT `ID`, `username` FROM `users` WHERE `level` = '1'");	
while($adminlistprint = mysqli_fetch_array($adminlist, MYSQLI_ASSOC)) {
echo "<div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>" . $adminlistprint['username'] . "</h3></div></div>";
}
?>
    </div> <!-- /container -->
	
	</div><!-- /wrap -->
	<?PHP include("../includes/footer.php"); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>