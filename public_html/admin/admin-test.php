<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
require('../core/functions.php');
if (!isset($_SESSION['timetrialarray'])){
$_SESSION['timetrialarray'] = array();
echo "i created teh array again!";
}
else{
#echo "poop";
}
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
  <?php

if (isset($_POST['username']) && isset($_SESSION['timetrialarray'])){
$user = $_POST['username'];
$time = $_POST['time'];
$input = array($user=>$time);
$array_current = $_SESSION['timetrialarray'];
$array = array_merge($array_current, $input);
print_r($array);
$_SESSION['timetrialarray'] = $array;
}
?>
	
    <!-- Fixed navbar repeated code because we need to change active page. -->
	<div id="wrap">
        <?PHP
	Navigation_admin();
	?>
    <div class="container">
	<?PHP
	if (isset($_SESSION['editpushed'])){
	
		if($_SESSION['editpushed'] == true){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! details added<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
			unset($_SESSION['editpushed']);
		}
	}
	
	?>
	<img class="img-responsive img-center" src="../images/acog-logo.png" />
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
	<p style="text-align: center;">Writing a super simple write to an array form:</p>
    <input name="username" type="text" class="form-control" placeholder="username" required autofocus>
    <input name="time" type="text" class="form-control" placeholder="Time" required autofocus>
    <input class="form-control btn btn-success" type="submit" value="Save"> 

</form>

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
