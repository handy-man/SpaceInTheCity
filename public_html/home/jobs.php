<?PHP
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
require("../core/navigation.php");
require("../core/functions.php");
$user_id = $_SESSION['uid'];
user_only($home);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Index</title>

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
	<div id="wrap">
        <?PHP
		Navigation_home($home);
	?>
    <div class="container" style="width: 400px;">
	
	<?PHP
	$connect = mysqli_connect($host,$user,$pass,$dbname);
	//Loop through our jobs that are assigned to us and add them to an array.
	$jobs_assigned = mysqli_query($connect, "SELECT * FROM `jobs_ass` WHERE `UID` = $user_id");
	$jobs = array();
	$properties = array();
	$result = mysqli_num_rows($jobs_assigned);
	if ($result > 0) {
	while($joblist = mysqli_fetch_array($jobs_assigned, MYSQLI_ASSOC)) {	
	$jobid = $joblist['JOBID'];
	array_push($jobs, $jobid);
	}
	//For every job, grab details of the job
	foreach ($jobs as $x){
		$jobs_details = mysqli_query($connect, "SELECT * FROM `jobs` WHERE `ID` = '$x' AND status = '0'");
		$job_details_print = mysqli_fetch_array($jobs_details, MYSQLI_ASSOC);
		$properyid = $job_details_print['ID'];
		array_push($properties, $properyid);
	}
	//for every property id for the jobs we get echo a link & job number.
	foreach ($properties as $y){
	
	echo "<a href='job-start.php?ID=" . $y . "'>";
	echo "<span class='label center-block label-primary' style='font-size: 35px; margin-bottom: 10px;'>Job number:" . $y . "</span>";
	echo "</a>";
	}
	
	
	}//end result if statement
	else{
	echo "No jobs found";
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
  </body>
</html>