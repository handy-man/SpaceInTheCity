<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
require('../core/functions.php');
require('../dbconfig.php');

if (isset($_POST['buildingname'])){
$connect = mysqli_connect($host,$user,$pass,$dbname);
$building_name = $_POST['buildingname'];
$building_name = mysqli_real_escape_string($connect, $building_name); //Shouldn't really have to do this, our admins can be trusted right?
$check = mysqli_query($connect, "SELECT * FROM `buildings` WHERE `building_name` = '$building_name'");	
$result = mysqli_num_rows($check);

if ($result == 1){
$alreadyexist = true;
}
else{
$new_building = mysqli_query($connect, "INSERT into buildings (`building_name`) VALUES ('$building_name')");
$newbuilding = true;
}


}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Add a new building</title>
	
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
		if($newbuilding == true){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success new building created!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
		
				if($alreadyexist == true){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>That building already exists!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
	
	?>
	<div class="page-header">
		<h1>Building manager  <small>Register a new building</small></h1>
	</div>
      <!-- Main component for a primary marketing message or call to action -->

	  
		<form class="form-signin" name="form1" role="form" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		<div class="input-group input-group-sm">
		<span class="input-group-addon"><span>Building name</span></span>
        <input name="buildingname" id="buildingname" data-toggle="tooltip" data-placement="right" title="" data-original-title="Building name" type="text" class="form-control" placeholder="Building name" required>
		</div>
		<div  style="margin-bottom: 10px;"></div>
		
		<button class='btn btn-lg btn-primary btn-block' type='submit'>Add a new building</button>
		<div  style="margin-bottom: 15px;"></div>
		
      </form>
	  
	<?PHP
		require_once('../dbconfig.php');
		$connect_1 = mysqli_connect($host,$user,$pass,$dbname);
		$adminlist = mysqli_query($connect_1, "SELECT * FROM `buildings` ORDER BY `buildings`.`building_name` ASC");	
		while($adminlistprint = mysqli_fetch_array($adminlist, MYSQLI_ASSOC)) {
		echo "<div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>" . $adminlistprint['building_name'] . "</h3></div></div>";
		}
	?>

    </div> <!-- /container -->
	
	</div><!-- /wrap -->
	<?PHP include("../includes/footer.php");?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	
		    <script>
	$(document).ready(function() {
	$('#buildingname').tooltip({'trigger':'focus', 'title': 'tooptip'});
	});
	</script>
  </body>
</html>
