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
		<h1>Building selection <small>Select a building</small></h1>
	</div>
	
		<?PHP
		$connect_1 = mysqli_connect($host,$user,$pass,$dbname);
		$dev = $_GET['d'];
		$dev = mysqli_real_escape_string($connect_1, $dev); //Shouldn't really have to do this, our admins can be trusted right?
		$buildinglist = mysqli_query($connect_1, "SELECT * FROM `buildings` WHERE `dev_id` = '$dev' AND `enabled` = '1' ORDER BY `building_name` ASC");	
		while($buildinglistprint = mysqli_fetch_array($buildinglist, MYSQLI_ASSOC)) {
		echo "<a href='clean.php?d=" . $buildinglistprint['dev_id'] . "&b=" . $buildinglistprint['building_name'] . "'>
		<span class='label center-block label-primary large-button'>" . $buildinglistprint['building_name'] . "</span>
		</a>";
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