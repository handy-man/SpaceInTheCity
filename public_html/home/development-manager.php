<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
require('../core/functions.php');
require('../dbconfig.php');

if (isset($_POST['developmentname'])){
$connect = mysqli_connect($host,$user,$pass,$dbname);
$dev_name = $_POST['developmentname'];
$dev_id = $_POST['developmentid'];
$dev_name = mysqli_real_escape_string($connect, $dev_name); //Shouldn't really have to do this, our admins can be trusted right?
$dev_id = mysqli_real_escape_string($connect, $dev_id); //Shouldn't really have to do this, our admins can be trusted right?
$check = mysqli_query($connect, "SELECT * FROM `developments` WHERE `dev_name` = '$dev_name'");	
$result = mysqli_num_rows($check);

if ($result == 1){
$alreadyexist = true;
}
else{
$new_building = mysqli_query($connect, "INSERT into developments (`dev_name`, `dev_id`) VALUES ('$dev_name', '$dev_id')");
$newbuilding = true;
}


}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Add a new Development</title>
	
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
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success new development added<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
		
				if($alreadyexist == true){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>That development already exists!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
	
	?>
	<div class="page-header">
		<h1>Development manager  <small>Register a new development</small></h1>
	</div>
      <!-- Main component for a primary marketing message or call to action -->

	  
		<form class="form-signin" name="form1" role="form" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		<div class="input-group input-group-sm">
		<span class="input-group-addon"><span>Development</span></span>
        <input name="developmentname" id="developmentname" data-toggle="tooltip" data-placement="right" title="" data-original-title="Development name" type="text" class="form-control" placeholder="Development name" required>
        <input name="developmentid" id="developmentid" data-toggle="tooltip" data-placement="right" title="" data-original-title="Development ID" type="text" class="form-control" placeholder="Development ID (5 chars max!)" required>
		</div>
		<div  style="margin-bottom: 10px;"></div>
		
		<button class='btn btn-lg btn-primary btn-block' type='submit'>Add a new development</button>
		<div  style="margin-bottom: 15px;"></div>
		
      </form>
	  
	<?PHP
		require_once('../dbconfig.php');
		$connect_1 = mysqli_connect($host,$user,$pass,$dbname);
		$adminlist = mysqli_query($connect_1, "SELECT * FROM `developments`");	
		while($adminlistprint = mysqli_fetch_array($adminlist, MYSQLI_ASSOC)) {
		echo "<div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>" . $adminlistprint['dev_name'] . " - " . $adminlistprint['dev_id'] . "</h3></div></div>";
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
