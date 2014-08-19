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
		<h1>Cleaning reports by apartment. <small>Click the title for detailed information</small></h1>
		<?PHP
		$proplist = mysqli_query($connect, "SELECT * FROM `properties` WHERE `enabled` = '1'");	
		$row_cnt = $proplist->num_rows;
		echo "<div class='panel panel-primary'><div style='text-align: center;' class='panel-heading'><h3 class='panel-title'>Number of properties: " . $row_cnt . "</h3></div></div>";
		while($proplistprint = mysqli_fetch_array($proplist, MYSQLI_ASSOC)) {
		$panel_type = "panel-primary";
		echo "<div class='panel " .  $panel_type . "'><div class='panel-heading'><h3 class='panel-title'><a href='reports-cleaning.php?PID=" . $proplistprint['ID'] . "'>" . $proplistprint['apt_number'] . " - " . $proplistprint['building'] . " - " . $proplistprint['development'] . "</a>
		</h3></div></div>";
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