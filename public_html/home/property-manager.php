<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
require('../core/functions.php');
require('../dbconfig.php');
$connect = mysqli_connect($host,$user,$pass,$dbname);


if (isset($_POST['dev_id'])){
$dev_id = $_POST['dev_id'];
$building_name = $_POST['building_name'];
$apt_number = $_POST['apt_number'];
$dev_id = mysqli_real_escape_string($connect, $dev_id); //Shouldn't really have to do this, our admins can be trusted right?
$building_name = mysqli_real_escape_string($connect, $building_name); //Shouldn't really have to do this, our admins can be trusted right?
$apt_number = mysqli_real_escape_string($connect, $apt_number); //Shouldn't really have to do this, our admins can be trusted right?
$check = mysqli_query($connect, "SELECT * FROM `properties` WHERE `development` = '$dev_id' AND `building` = '$building_name' AND `apt_number` = '$apt_number'");	
$result = mysqli_num_rows($check);

if ($result == 1){	
$alreadyexist = true;
}
else{
$new_building = mysqli_query($connect, "INSERT into properties (`development`, `building`, `apt_number`) VALUES ('$dev_id', '$building_name', '$apt_number')");
$newbuilding = true;
}

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Add a new property</title>
	
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
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success new property added<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
		
				if($alreadyexist == true){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>That property already exists!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
	
	?>
	<div class="page-header">
		<h1>Property manager  <small>Register a new property</small></h1>
	</div>
      <!-- Main component for a primary marketing message or call to action -->

	  
		<form class="form-signin" name="form1" role="form" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

		<div style="margin-bottom: 10px;" class="input-group input-group-sm">
		<span class="input-group-addon">Development</span>
		<select name="dev_id" class="form-control">
		<?PHP
		$developmentlist = mysqli_query($connect, "SELECT * FROM `developments`");
		while($developmentlistprint = mysqli_fetch_array($developmentlist, MYSQLI_ASSOC)) {
		echo "<option value='" . $developmentlistprint['dev_id'] . "'>" . $developmentlistprint['dev_name'] . "</option>";
		}
		
		?>
		</select>
		</div>
		
		<div style="margin-bottom: 10px;" class="input-group input-group-sm">
		<span class="input-group-addon">Building</span>
		<select name="building_name" class="form-control">
		<?PHP
		$developmentlist = mysqli_query($connect, "SELECT * FROM `buildings` ORDER BY `buildings`.`building_name` ASC");
		while($developmentlistprint = mysqli_fetch_array($developmentlist, MYSQLI_ASSOC)) {
		echo "<option value='" . $developmentlistprint['building_name'] . "'>" . $developmentlistprint['building_name'] . "</option>";
		}
		
		?>
		</select>
		</div>
		
		<div class="input-group input-group-sm">
		<span class="input-group-addon"><span>Development</span></span>
        <input name="apt_number" id="apt_number" data-toggle="tooltip" data-placement="right" title="" data-original-title="Apartment number" type="text" class="form-control" placeholder="Apartment number" required>
		</div>
		
		
		<div  style="margin-bottom: 10px;"></div>
		
		<button class='btn btn-lg btn-success btn-block' type='submit'>Add a new property</button>
		<div  style="margin-bottom: 15px;"></div>
		
      </form>
	  
	<?PHP
		$proplist = mysqli_query($connect, "SELECT * FROM `properties`");	
		$row_cnt = $proplist->num_rows;
		echo "<div class='panel panel-primary'><div style='text-align: center;' class='panel-heading'><h3 class='panel-title'>Number of properties: " . $row_cnt . "</h3></div></div>";
		while($proplistprint = mysqli_fetch_array($proplist, MYSQLI_ASSOC)) {
		if($proplistprint['enabled'] == 1){
		$panel_type = "panel-primary";
		}
		else{
		$panel_type = "panel-warning";
		}
		echo "<div class='panel " .  $panel_type . "'><div class='panel-heading'><h3 class='panel-title'><a href='property-editor.php?PID=" . $proplistprint['ID'] . "'>" . $proplistprint['apt_number'] . " - " . $proplistprint['building'] . " - " . $proplistprint['development'] . "</a>
		</h3></div></div>";
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
	$('#apt_number').tooltip({'trigger':'focus', 'title': 'tooptip'});
	});
	</script>
  </body>
</html>
