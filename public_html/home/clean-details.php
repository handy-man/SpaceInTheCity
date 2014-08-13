<?PHP
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
require("../core/navigation.php");
require("../core/functions.php");

user_only($home);
$connect = mysqli_connect($host,$user,$pass,$dbname);
$cleanid = $_GET['cid'];
$cleanid = mysqli_real_escape_string($connect, $cleanid);

$cleandetails = mysqli_query($connect, "SELECT * FROM `clean` WHERE `ID` = '$cleanid'");
$row = $cleandetails->fetch_array(MYSQLI_ASSOC);

$propertyid = $row['apt_id'];
$property_details = getaptdetails($connect, $propertyid); //apartmnet name & number

$housekeeper1 = $row['HK1'];
$housekeeper1name = gethousekeepername($connect, $housekeeper1);
$housekeeper2 = $row['HK2'];
$housekeeper2name = gethousekeepername($connect, $housekeeper2);
$housekeeper3 = $row['HK3'];
$housekeeper3name = gethousekeepername($connect, $housekeeper3);
$housekeeper4 = $row['HK4'];
$housekeeper4name = gethousekeepername($connect, $housekeeper4);

$typeofclean = $row['typeofclean'];

$start_hh = $row['start_hh'];

$start_mm = $row['start_mm'];

$end_hh = $row['end_hh'];

$end_mm = $row['end_mm'];

$clean = $row['clean'];

$notes = $row['notes'];

$dateofclean = $row['dateofclean'];

$photosexist = $row['photo'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Select a development</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
	<style>
	.large-button{
	margin-bottom: 20px;
	font-size: 35px;
	}
	</style>

    <!-- Custom styles for this template -->
    <link href="../css/navbar-fixed-top.css" rel="stylesheet">
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
		<h1>Clean id: <?PHP echo $_GET['cid']; ?> <small><?PHP echo $property_details;  ?></small></h1>
	</div>
	
	<p>
	<ul class="list-group">
		<li style="background-color: #428bca; color: white;" class="list-group-item">Cleaners:</li>

	<?PHP
	if ($housekeeper1name != ""){
	echo "<li class='list-group-item'>" . $housekeeper1name . "</li>";
	}
	
		if ($housekeeper2name != ""){
	echo "<li class='list-group-item'>" . $housekeeper2name . "</li>";
	}
	
			if ($housekeeper3name != ""){
	echo "<li class='list-group-item'>" . $housekeeper3name . "</li>";
	}
	
				if ($housekeeper4name != ""){
	echo "<li class='list-group-item'>" . $housekeeper4name . "</li>";
	}
	?>
	<li style="background-color: #428bca; color: white;" class="list-group-item">Type of clean:</li>
	<?PHP
					if ($typeofclean != ""){
	echo "<li class='list-group-item'>" . $typeofclean . "</li>";
	}
	?>
		<li style="background-color: #428bca; color: white;" class="list-group-item">Start of clean:</li>
		<?PHP
					if ($start_hh != "" AND $start_mm != ""){
	echo "<li class='list-group-item'>" . $start_hh . ":" . $start_mm . "</li>";
	}
	?>
			<li style="background-color: #428bca; color: white;" class="list-group-item">End of clean:</li>
		<?PHP
					if ($end_hh != "" AND $end_mm != ""){
	echo "<li class='list-group-item'>" . $end_hh . ":" . $end_mm . "</li>";
	}
	?>
				<li style="background-color: #428bca; color: white;" class="list-group-item">Cleaner notes:</li>
		<?PHP
					if ($notes != ""){
	echo "<li class='list-group-item'>" . $notes . "</li>";
	}
	?>
					<li style="background-color: #428bca; color: white;" class="list-group-item">Photos:</li>
		<?PHP
					if ($photosexist != ""){
		
		$photodetails = mysqli_query($connect, "SELECT * FROM `clean_photos` WHERE `CID` = '$cleanid'");
			while($photodetailsprint = mysqli_fetch_array($photodetails, MYSQLI_ASSOC)) {
		echo "<li class='list-group-item'><a href='./photos/" . $photodetailsprint['FILE_NAME'] . "'>Evidence photo #" . $photodetailsprint['ID'] . "</a></li>";
		}
		
	}
	
	else{
		echo "<li class='list-group-item'>None</li>";
	}
	?>
	
	
	
	</ul>
	</P>
	
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