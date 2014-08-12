<?PHP
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
require("../core/navigation.php");
require("../core/functions.php");

user_only($home);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 
<title>Daily reports on cleaning</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
	<style>
	.large-button{
	margin-bottom: 20px;
	font-size: 35px;
	}
	</style>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
    <!-- Custom styles for this template -->
    <link href="../css/navbar-fixed-top.css" rel="stylesheet">
    <link href="../css/port.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div id="wrap">
        <?PHP Navigation_home($home); ?>
		
		
    <div class="container">
	
	<div class="page-header">
		<h1>Cleaning reports <small>Click the title for detailed information</small></h1><form action="<?PHP $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="input-group">
			<span class="input-group-btn">
			<button class="btn btn-default" type="submit">Filter</button>
			</span>
		<input type="text" style="width: 20%;" class="form-control" name="datepicker" id="datepicker" size="30" value="<?PHP if (!isset($_POST['datepicker'])){$curdate = curdate(); echo $curdate; } else { echo $_POST['datepicker']; }  ?>">
	</div>
	</form>
	</div>
	
	<?PHP
	$connect = mysqli_connect($host,$user,$pass,$dbname);
	if (!isset($_POST['datepicker'])){
	$curdate = curdate();
	$cleans = mysqli_query($connect, "SELECT * FROM `clean` WHERE `dateofclean` = '$curdate' ");	
	while($cleansprint = mysqli_fetch_array($cleans, MYSQLI_ASSOC)) {
	$propertyid = $cleansprint['apt_id'];
	$property_details = getaptdetails($connect, $propertyid);
	$housekeeper1 = $cleansprint['HK1'];
	$housekeeper1name = gethousekeepername($connect, $housekeeper1);
	$housekeeper2 = $cleansprint['HK2'];
	$housekeeper2name = gethousekeepername($connect, $housekeeper2);
	$housekeeper3 = $cleansprint['HK3'];
	$housekeeper3name = gethousekeepername($connect, $housekeeper3);
	$housekeeper4 = $cleansprint['HK4'];
	$housekeeper4name = gethousekeepername($connect, $housekeeper4);
	echo "<div class='panel panel-primary' style='width: 40%; margin: auto; margin-bottom: 10px;'>
  <div class='panel-heading panel-primary' style='text-align: center; text-transform: uppercase;'>" . $property_details ."</div>
  <ul class='list-group'>
    <li class='list-group-item'>" . $housekeeper1name . " " . $housekeeper2name . " " . $housekeeper3name . " " . $housekeeper4name . "</li>
    <li class='list-group-item list-title'>Time:</li>
    <li class='list-group-item'>Start: " . $cleansprint['start_hh'] . ":" . $cleansprint['start_mm'] . " End: " . $cleansprint['end_hh'] . ":" . $cleansprint['end_mm'] . "</li>
  </ul>
	</div>";
	}//End of while
	}
	else{
	$curdate = $_POST['datepicker'];
	$cleans = mysqli_query($connect, "SELECT * FROM `clean` WHERE `dateofclean` = '$curdate' ");	
	while($cleansprint = mysqli_fetch_array($cleans, MYSQLI_ASSOC)) {
	$propertyid = $cleansprint['apt_id'];
	$property_details = getaptdetails($connect, $propertyid);
	$housekeeper1 = $cleansprint['HK1'];
	$housekeeper1name = gethousekeepername($connect, $housekeeper1);
	$housekeeper2 = $cleansprint['HK2'];
	$housekeeper2name = gethousekeepername($connect, $housekeeper2);
	$housekeeper3 = $cleansprint['HK3'];
	$housekeeper3name = gethousekeepername($connect, $housekeeper3);
	$housekeeper4 = $cleansprint['HK4'];
	$housekeeper4name = gethousekeepername($connect, $housekeeper4);
	echo "<div class='panel panel-primary' style='width: 40%; margin: auto; margin-bottom: 10px;'>
  <div class='panel-heading panel-primary' style='text-align: center; text-transform: uppercase;'>" . $property_details ."</div>
  <ul class='list-group'>
    <li class='list-group-item'>" . $housekeeper1name . " " . $housekeeper2name . " " . $housekeeper3name . " " . $housekeeper4name . "</li>
    <li class='list-group-item list-title'>Time:</li>
    <li class='list-group-item'>Start: " . $cleansprint['start_hh'] . ":" . $cleansprint['start_mm'] . " End: " . $cleansprint['end_hh'] . ":" . $cleansprint['end_mm'] . "</li>
  </ul>
	</div>";
	}
	}
	?>
	
    </div> <!-- /container -->
	
	</div><!-- /wrap -->
	<?PHP include("../includes/footer.php");?>
  </body>
</html>