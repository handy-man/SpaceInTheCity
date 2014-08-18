<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
require('../core/functions.php');
require('../dbconfig.php');
$connect = mysqli_connect($host,$user,$pass,$dbname);


if (isset($_GET['PID'])){
$PID = $_GET['PID'];
$PID = mysqli_real_escape_string($connect, $PID);

$grabdetails = mysqli_query($connect, "SELECT * FROM `properties` WHERE `ID` = '$PID'");

$row = $grabdetails->fetch_array(MYSQLI_ASSOC);
$apt_number = $row['apt_number'];
$building = $row['building'];
$development_id = $row['development'];
$status = $row['enabled'];

}

if (isset($_POST['delete']) && isset($_POST['PID'])){
$PID = $_POST['PID'];
$delete = $_POST['delete'];
//Delete is actually disable.
if ($delete == "true"){
$update = mysqli_query($connect, "UPDATE `properties` SET `enabled` = '0' WHERE `ID` = '$PID'");
$status = 0;
}
elseif($delete == "false"){
$update = mysqli_query($connect, "UPDATE `properties` SET `enabled` = '1' WHERE `ID` = '$PID'");
$status = 1;
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
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success details updated.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
		
		if($delete == "true"){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success property disabled.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
		elseif($delete == "false"){
						echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success property enabled.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
	?>
	<div class="page-header">
		<h1>Property editor <small>Edit property details</small></h1>
		<h5>You are editing the property: <?PHP echo $apt_number . " - " . $building; ?></h5>
	</div>
      <!-- Main component for a primary marketing message or call to action -->

	  
		<form class="form-signin" name="form1" role="form" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

		<div style="margin-bottom: 10px;" class="input-group input-group-sm">
		<span class="input-group-addon">Development</span>
		<select name="dev_id" class="form-control">
		<?PHP
		$developmentlist = mysqli_query($connect, "SELECT * FROM `developments`");
		while($developmentlistprint = mysqli_fetch_array($developmentlist, MYSQLI_ASSOC)) {
		if ($developmentlistprint['dev_id'] != $development_id){
		echo "<option value='" . $developmentlistprint['dev_id'] . "'>" . $developmentlistprint['dev_name'] . "</option>";
		}
		else{
		echo "<option value='" . $developmentlistprint['dev_id'] . "' selected>" . $developmentlistprint['dev_name'] . "</option>";
		}
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
		if ($developmentlistprint['building_name'] != $building){
		echo "<option value='" . $developmentlistprint['building_name'] . "'>" . $developmentlistprint['building_name'] . "</option>";
		}
		else{
		echo "<option value='" . $developmentlistprint['building_name'] . "' selected>" . $developmentlistprint['building_name'] . "</option>";
		}
		}
		
		?>
		</select>
		</div>
		
		<div class="input-group input-group-sm">
		<span class="input-group-addon"><span>Development</span></span>
        <input name="apt_number" id="apt_number" data-toggle="tooltip" data-placement="right" title="" data-original-title="Apartment number" type="text" class="form-control" placeholder="Apartment number" required value="<?PHP echo $apt_number; ?>">
		</div>
		
		
		<div  style="margin-bottom: 10px;"></div>
		
		<button class='btn btn-lg btn-success btn-block' type='submit'>Save property details</button>
		<div  style="margin-bottom: 15px;"></div>
		
      </form>
	  
	  <form class="form-signin" name="form2" role="form" method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?PID=" . $_GET['PID']; ?>">
	  
	  <input type="hidden" name="delete" value="<?PHP if($status == 1){echo "true";}else{echo "false";} ?>">
	  <input type="hidden" name="PID" value="<?PHP echo $_GET['PID']; ?>">
	  		<button class='btn btn-lg btn-danger btn-block' type='submit'><?PHP if($status == 1){echo "Disable";}else{echo "Enable";} ?> this property</button>
	  </form>

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