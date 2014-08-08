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
		<h1>Development selection <small>Select a development</small></h1>
	</div>
	
		<?PHP
		$connect_1 = mysqli_connect($host,$user,$pass,$dbname);
		$devlist = mysqli_query($connect_1, "SELECT * FROM `developments` WHERE `enabled` = '1'");	
		while($devlistprint = mysqli_fetch_array($devlist, MYSQLI_ASSOC)) {
		echo "<a href='building.php?d=" . $devlistprint['dev_id'] . "'>
		<span class='label center-block label-primary large-button'>" . $devlistprint['dev_name'] . "</span>
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