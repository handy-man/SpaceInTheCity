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
	
	<?PHP require('../includes/settings.php'); ?>
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
	Navigation_admin();
	?>
    <div class="container">
	<?PHP
	if (isset($_POST['editpushed'])){
	echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! settings changed.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
	}
	?>
	<img class="img-responsive img-center" src="../images/acog-logo.png" />
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron-user-edit">

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

	<div class="input-group input-group-sm">
	<span class="input-group-addon">Login</span>
    <select class="form-control" name="login">
			<option value="true">Enabled</option>
			<option value="false" <?PHP if ($login_enabled == false){echo "selected='selected'";}?>>Disabled</option>
			</select>
	</div>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Registration</span>
	<select class="form-control" name="register">
			<option value="true">Enabled</option>
			<option value="false" <?PHP if ($register_enabled == false){echo "selected='selected'";}?>>Disabled</option>
			</select>
	</div>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Aberystwyth email force</span>
    <select class="form-control" name="aberonly">
			<option value="true">Enabled</option>
			<option value="false" <?PHP if ($aberonly == false){echo "selected='selected'";}?>>Disabled</option>
			</select>
	</div>
	<div style="margin-bottom: 10px;" ></div>
	<input type="hidden" name="editpushed" value="true">
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


<?php

if (isset($_POST['editpushed']))

{
$string = '<?php 

$login_enabled = '. $_POST["login"]. ';
$register_enabled = '. $_POST["register"]. ';
$aberonly = '. $_POST["aberonly"]. ';


?>';



$fp = fopen("../includes/settings.php", "w");

fwrite($fp, $string);

fclose($fp);

include('../dbconfig.php');
$connect = mysqli_connect($host,$user,$pass,$dbname);
$user_id=$_SESSION['uid'];
$event = "Settings change login: " . $_POST['login'] . " register: " . $_POST['register'] . " aberonly: " . $_POST['aberonly'] . ".";
log_admin($connect, $user_id, $event);

}

?>
