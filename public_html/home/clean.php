<?PHP
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
require("../core/navigation.php");
require("../core/functions.php");
$user_id = $_SESSION['uid'];
user_only($home);
$connect = mysqli_connect($host,$user,$pass,$dbname);
if (isset($_POST['d'])){
$_SESSION['development'] = $_POST['d'];
echo $_SESSION['development'];
}
if (isset($_POST['b'])){
$_SESSION['building'] = $_POST['b'];
echo "building set";
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Cleaning in progress...</title>
	
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
    <div class="container">
	<?PHP
	
		if($Success == true){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! New committee role set.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}

        if($Success_refresh == true){
      echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! Image data refreshed.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
    }

	?>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron-user-edit">
<?PHP
if (!isset($_SESSION['development']) && !isset($_SESSION['building'])){
?>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
	<p style="text-align: center;">Select which development you are in</p>
<div style="margin-bottom: 10px;" class="input-group input-group-sm">
    <span class="input-group-addon">Development</span>
    <select name="d" class="form-control">
		<option value='CW'>Century Wharf</option>
		<option value='QS'>Quayside / Ocean Buildings</option>
		<option value='CIW'>City Wharf / Ocean Reach</option>
		<option value='RG'>Richards House</option>
	</select>
</div>
<button class='btn btn-lg btn-primary btn-block' type='submit'>Next</button>
</form>
<?PHP 
}
elseif (isset($_SESSION['development']) && !isset($_SESSION['building'])){
$development = $_SESSION['development'];
?>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
	<p style="text-align: center;">Select which building you are in</p>
<div style="margin-bottom: 10px;" class="input-group input-group-sm">
    <span class="input-group-addon">Building</span>
    <select name="b" class="form-control">
	<?PHP 
		$buildings_indev = mysqli_query($connect, "SELECT * FROM `properties` WHERE `development` = $development");
		while ($row = mysqli_fetch_array( $buildings_indev)){
		$building = $row['building'];
		$apt_number = $row['apt_number'];
		echo "test";
		echo "<option value='" . $building . "'>" . $building . "</option>";
		}
	?>
	</select>
</div>
<button class='btn btn-lg btn-primary btn-block' type='submit'>Next</button>
</form>
<?PHP 
echo $development;
}
else{
?>
<p>Test</p>
<?PHP
}
?>

      </div> <!--/Jumbotron -- >

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
