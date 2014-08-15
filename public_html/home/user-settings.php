<?PHP
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
require("../core/navigation.php");
require("../core/functions.php");
user_only($home);
$user_id = $_SESSION['uid'];
//Database connect
$connect = mysqli_connect($host,$user,$pass,$dbname);

if (isset($_POST['editpushed'])){
$mypassword=$_POST['user_pass_current'];
$newpassword=$_POST['user_pass_new'];
$newpassword_repeat=$_POST['user_pass_new_repeat'];
$mypassword = mysqli_real_escape_string($connect, $mypassword);
$newpassword = mysqli_real_escape_string($connect, $newpassword);
$newpassword_repeat = mysqli_real_escape_string($connect, $newpassword_repeat);

if ($newpassword != $newpassword_repeat){
$error = true;
}
else{
$saltgrab = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$user_id' LIMIT 0, 1");	
$saltgrab_array = mysqli_fetch_array($saltgrab);
$salt = $saltgrab_array['salt'];
$mypass = crypt($mypassword, $salt);
//More mysql stuff
$check = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$user_id' AND `password` = '$mypass' LIMIT 0, 1");	
$result = mysqli_num_rows($check);
if ($result == 1) {
#current password = password, change the password.

$salt_part1 = md5( rand(0,1000) );
$salt_part2 = md5( rand(0,1000) );
$salt = crypt($salt_part1, $salt_part2);
$newpassword = crypt($newpassword, $salt);
$update = mysqli_query($connect, "UPDATE `users` SET `password` = '$newpassword', `salt` = '$salt' WHERE `id` = '$user_id'");
$pass_changed = true;
}
else{
$error = true;
}
}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Settings</title>

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
	
    <!-- Fixed navbar repeated code because we need to change active page. -->
	<div id="wrap">
        <?PHP
		Navigation_home($home);
	?>
	<!--Copy all above this line into new pages, changing relevant details. (active page, title maybe? etc) -->
    <div class="container">
		<?PHP
	if (isset($error)){
	echo "<div style='text-align: center; margin: auto;' class='alert alert-warning fade in hints'>Something went wrong!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
	}
	if (isset($pass_changed)){
	echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! password changed, please logout and login again.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
	}

	?>
	
		<div class="page-header">
		<h1>User settings  <small>Change your personal settings</small></h1>
	</div>
      <!-- Main component for a primary marketing message or call to action -->
	    <div class="jumbotron-user-edit">
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
			<P>Password change:</p>
			<div class="input-group input-group-sm">
			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
			<input name="user_pass_current" type="password" class="form-control" placeholder="Current password">
			</div>
					<div class="input-group input-group-sm">
			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
			<input name="user_pass_new" type="password" class="form-control" placeholder="New password">
			</div>
					<div class="input-group input-group-sm">
			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
			<input name="user_pass_new_repeat" type="password" class="form-control" placeholder="Password repeat">
			</div>
			<div style="margin-bottom: 10px;"></div>
			<input type="hidden" name="editpushed" value="true">
			<input class="form-control btn btn-success" type="submit" value="Change password"> 
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
