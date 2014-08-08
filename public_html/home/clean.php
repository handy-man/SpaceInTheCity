<?PHP
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
require("../core/navigation.php");
require("../core/functions.php");
$user_id = $_SESSION['uid'];
user_only($home);
$connect = mysqli_connect($host,$user,$pass,$dbname);

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
	?>
      <!-- Main component for a primary marketing message or call to action -->
		<div class="page-header">
  <h1>Cleaning <small><?PHP echo $_GET['b']; ?></small></h1>
		</div>
		
		<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
		
		<div style="margin-bottom: 10px;" class="input-group input-group-sm">
		<span class="input-group-addon">Where are you?</span>
		<select name="properties" class="form-control">
		<?PHP
		$dev = $_GET['d'];
		$dev = mysqli_real_escape_string($connect, $dev);
		
		$building = $_GET['b'];
		$building = mysqli_real_escape_string($connect, $building);
		$propertylist = mysqli_query($connect, "SELECT `ID`, `apt_number`, `building` FROM `properties` WHERE `building` = '$building'");
		
		while($propertylistprint = mysqli_fetch_array($propertylist, MYSQLI_ASSOC)) {
		echo "<option value='" . $propertylistprint['ID'] . "'>" . $propertylistprint['building'] . " " . $propertylistprint['apt_number'] . "</option>";
		}
		
		?>
		</select>
		</div>
		
		<div style="margin-bottom: 10px;" class="input-group input-group-sm">
		<span class="input-group-addon">What type of clean is it?</span>
		<select name="clean_type" class="form-control">
			<option value='service'>service</option>
			<option value='exit'>exit</option>
			<option value='other'>other</option>
		</select>
		</div>
		
		<div style="margin-bottom: 10px;" class="input-group input-group-sm">
		<span class="input-group-addon">Who is with you?</span>
		<select name="hk_2" class="form-control">
		<?PHP
		$userlist = mysqli_query($connect, "SELECT `ID`, `username` FROM `users` WHERE `level` != '2'  AND `ID` != '$user_id'");
		echo "<option value=''></option>";
		while($userlistprint = mysqli_fetch_array($userlist, MYSQLI_ASSOC)) {
		echo "<option value='" . $userlistprint['ID'] . "'>" . $userlistprint['username'] . "</option>";
		}
		
		?>
		</select>
		</div>
		
		<div style="margin-bottom: 10px;" class="input-group input-group-sm">
		<span class="input-group-addon">Who is with you?</span>
		<select name="hk_3" class="form-control">
		<?PHP
		$userlist = mysqli_query($connect, "SELECT `ID`, `username` FROM `users` WHERE `level` != '2' AND `ID` != '$user_id'");
		echo "<option value=''></option>";
		while($userlistprint = mysqli_fetch_array($userlist, MYSQLI_ASSOC)) {
		echo "<option value='" . $userlistprint['ID'] . "'>" . $userlistprint['username'] . "</option>";
		}
		
		?>
		</select>
		</div>
		
		<div style="margin-bottom: 10px;" class="input-group input-group-sm">
		<span class="input-group-addon">Who is with you?</span>
		<select name="hk_4" class="form-control">
		<?PHP
		$userlist = mysqli_query($connect, "SELECT `ID`, `username` FROM `users` WHERE `level` != '2'  AND `ID` != '$user_id'");
		echo "<option value=''></option>";
		while($userlistprint = mysqli_fetch_array($userlist, MYSQLI_ASSOC)) {
		echo "<option value='" . $userlistprint['ID'] . "'>" . $userlistprint['username'] . "</option>";
		}
		
		?>
		</select>
		</div>
		<span class="help-block">Clean started: <script type="text/javascript">
<!--
	var currentTime = new Date()
	var hours = currentTime.getHours()
	var minutes = currentTime.getMinutes()
	var cur_hh = document.getElementById("cur_hh");
	var cur_mm = document.getElementById("cur_mm");
	if (minutes < 10)
	minutes = "0" + minutes 
	document.write("<b>" + hours + ":" + minutes + " " + "</b>")
	document.getElementById("cur_hh").setAttribute("value", hours);
	//-->
</script>
</span>
		<div style="width: 25%; margin-bottom: 5px;" class="input-group input-group-sm">
		<span class="input-group-addon">HH</span>
		<input id="cur_hh" type="number" class="form-control" min="0" max="24" required>
		</div>
		<div style="width: 25%; margin-bottom: 5px;" class="input-group input-group-sm">
		<span class="input-group-addon">MM</span>
		<input id="cur_mm" type="number" class="form-control"  min="0" max="59" required>
		</div>
		
				<span class="help-block">Clean Ended:</span>
		<div style="width: 25%; margin-bottom: 5px;" class="input-group input-group-sm">
		<span class="input-group-addon">HH</span>
		<input type="number" class="form-control"  min="0" max="24" required>
		</div>
		<div style="width: 25%; margin-bottom: 5px;" class="input-group input-group-sm">
		<span class="input-group-addon">MM</span>
		<input type="number" class="form-control"  min="0" max="59" required>
		</div>
		
				<div style="margin-bottom: 10px;" class="input-group input-group-sm">
		<span class="input-group-addon">Property ready for guests?</span>
		<select name="clean_type" class="form-control">
			<option value='yes'>Yes</option>
			<option value='no'>No</option>
		</select>
		</div>
		
		<span class="help-block">Extra information:</span>
		<textarea style="margin-bottom: 10px;" name="user_bio" class="form-control" rows="5" cols="400" name="content"><?php echo $user_bio ?></textarea>
		
	<div class="checkbox">
    <label>
      <input type="checkbox" required> I confirm that we have cleaned this apartment to the best of our ability and to company standards.
    </label>
  </div>
	
<button class='btn btn-lg btn-primary btn-block' type='submit'>Submit cleaning report</button>
</form>


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
