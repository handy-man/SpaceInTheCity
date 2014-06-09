<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
require('../core/functions.php');
require('../dbconfig.php');
$connect = mysqli_connect($host,$user,$pass,$dbname);
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
	<?PHP
	if (isset($_SESSION['editpushed'])){
	
		if($_SESSION['editpushed'] == true){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! password changed!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
			unset($_SESSION['editpushed']);
		}
		else{
			echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Don't try and edit yourself.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
			unset($_SESSION['editpushed']);
		}
	}
	
	?>
	<img class="img-responsive img-center" src="../images/acog-logo.png" />
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron-user-edit">

<form action="admin-login-exec.php" method="post">
	<p style="text-align: center;">Login as a different user!</p>
	<P>Login as any regular user! select them from below.</p>
	<div class="input-group input-group-sm">
		<span class="input-group-addon">Users</span>
		<select name="userid" class="form-control">
    <?PHP
	$userlist = mysqli_query($connect, "SELECT `ID`, `displayname`, `email` FROM `users` WHERE `admin` != '2'");
		
	while($userlistprint = mysqli_fetch_array($userlist, MYSQLI_ASSOC)) {
	echo "<option value='" . $userlistprint['ID'] . "'>" . $userlistprint['displayname'] . " - " . $userlistprint['email'] . "</option>";
	}
	
	?>
	</select>
	</div>
    <input style="margin-top: 10px;" class="form-control btn btn-danger" type="submit" value="Login as the above user!"> 

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
