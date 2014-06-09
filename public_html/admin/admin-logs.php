<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
require('../core/functions.php');
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Aberystwyth Community of Gamers</title>
	
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
	Navigation_admin();
	?>
    <div class="container">
	<img class="img-responsive img-center" src="../images/acog-logo.png" />
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">

<p>Logs of who did what: Userid -> event -> Time</p>

<?PHP
require_once('../dbconfig.php');
$connect_1 = mysqli_connect($host,$user,$pass,$dbname);
$logslist = mysqli_query($connect_1, "SELECT * FROM `logs` order by `LOGID` DESC");	
while($logslistprint = mysqli_fetch_array($logslist, MYSQLI_ASSOC)) {
echo "<div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'> user: " . $logslistprint['user_id'] . " - " . $logslistprint['event'] . " @ " . $logslistprint['time'] . "</h3></div></div>";
}
?>
      </div>

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
