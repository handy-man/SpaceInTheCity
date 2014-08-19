<?PHP
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
require("../core/navigation.php");
require("../core/functions.php");

reports_only($home);

if (isset($_COOKIE['reportdeleted'])){
$reportdeleted = true;
setcookie("reportdeleted", "true", time()-3600, '/');
}
$connect = mysqli_connect($host,$user,$pass,$dbname);

		$prop_clean_id = $_GET['PID'];
		$prop_clean_id = mysqli_real_escape_string($connect, $prop_clean_id);
		$property_details = getaptdetails($connect, $prop_clean_id);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 
<title>Detailed reports</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
	<style>
	.large-button{
	margin-bottom: 20px;
	font-size: 35px;
	}
	
	.report-display{
	width: 40%; 
	margin: auto; 
	margin-bottom: 10px;
	}
	
	.datepicker-input{
	width: 20%;
	}
	
	a {
	color: white;
	}
	
	@media (max-width: 768px) {

  	.report-display{
	width: 100%; 
	margin: auto; 
	margin-bottom: 10px;
	}

	.datepicker-input{
	width: 100%;
	}
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
	
		<?PHP
		if($reportdeleted == true){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success report deleted.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
	
	?>
	
	<div class="page-header">
		<h1>Cleaning report for <small><?PHP echo $property_details; ?></small></h1>
		<?PHP		
		
	$cleans = mysqli_query($connect, "SELECT `ID`, `apt_id`, `HK1`, `HK2`, `HK3`, `HK4`, `typeofclean`, `notes`, `start_hh`, `start_mm`, `end_hh`, `end_mm`, `photo` FROM `clean` WHERE `apt_id` = '$prop_clean_id'");	
	while($cleansprint = mysqli_fetch_array($cleans, MYSQLI_ASSOC)) {
	$clean_id = $cleansprint['ID'];
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
	$typeofclean = $cleansprint['typeofclean'];
	if ($cleansprint['notes'] == ""){
	$extranotesbool = "None";
	}
	else{
	$extranotesbool = "Yes";
	}
	
	if ($cleansprint['photo'] == ""){
	$photobool = "None";
	}
	else{
	$photobool = "Yes";
	}
	echo "<div class='panel panel-primary report-display'>
  <div class='panel-heading panel-primary' style='text-align: center; text-transform: uppercase;'><a href='./clean-details.php?cid=" . $clean_id . "'>" . $property_details ."</a></div>
  <ul class='list-group'>
    <li class='list-group-item'>" . $housekeeper1name . " " . $housekeeper2name . " " . $housekeeper3name . " " . $housekeeper4name . "</li>
    <li class='list-group-item list-title'>Clean: " . $typeofclean . " Extra notes: " . $extranotesbool . " photos: " . $photobool . "</li>
    <li class='list-group-item'>Start: " . $cleansprint['start_hh'] . ":" . $cleansprint['start_mm'] . " End: " . $cleansprint['end_hh'] . ":" . $cleansprint['end_mm'] . "</li>
  </ul>
	</div>";
	}
		?>
	
    </div> <!-- /container -->
	
	</div><!-- /wrap -->
	<?PHP include("../includes/footer.php");?>
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>