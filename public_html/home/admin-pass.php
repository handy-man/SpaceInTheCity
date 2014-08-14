<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
require('../core/functions.php');
require('../dbconfig.php');

if (isset($_COOKIE['passwordchanged'])){
$newuserset = true;
setcookie("passwordchanged", "true", time()-3600, '/');
}

if (isset($_COOKIE['mismatch'])){
$mismatch = true;
setcookie("mismatch", "true", time()-3600, '/');
}

if (isset($_COOKIE['noexist'])){
$noexist = true;
setcookie("noexist", "true", time()-3600, '/');
}

$connect = mysqli_connect($host,$user,$pass,$dbname);


?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Create a new user</title>
	
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
	Navigation_home($home);
	?>
    <div class="container">
	<?PHP
		if($newuserset == true){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success new password set!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
		
		if($mismatch == true){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>Passwords didn't match!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
		
				if($noexist == true){
			echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>User doesn't exist!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
		}
	
	?>
	<div class="page-header">
		<h1>Password manager  <small>Set a user password</small></h1>
	</div>
      <!-- Main component for a primary marketing message or call to action -->

	  
		<form class="form-signin" name="form1" role="form" method="post" action="./changepassword.php">
		
		<div style="margin-bottom: 10px;" class="input-group input-group-sm">
		<span class="input-group-addon">User</span>
		<select name="displayname" class="form-control">
		<?PHP
	
		$userlist = mysqli_query($connect, "SELECT `ID`, `username` FROM `users` ORDER BY `username` ASC");
		while($userlistprint = mysqli_fetch_array($userlist, MYSQLI_ASSOC)) {
		echo "<option value='" . $userlistprint['username'] . "'>" . $userlistprint['username'] . "</option>";
		}
		
	
		
		?>
		</select>
		</div>
		
		
		<div class="input-group input-group-sm">
		<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <input name="password" id="password" data-toggle="tooltip" data-placement="right" title="" data-original-title="Password" type="password" class="form-control" placeholder="Password" required>
		</div>
		<div class="input-group input-group-sm">
		<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
		<input name="conf_password" id="conf_password" type="password" class="form-control" placeholder="Confirm Password" required>
		</div>
		<div  style="margin-bottom: 10px;"></div>
		
		<button class='btn btn-lg btn-primary btn-block' type='submit'>Change password for the user</button>
		
      </form>

    </div> <!-- /container -->
	
	</div><!-- /wrap -->
	<?PHP include("../includes/footer.php");?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	
		    <script>
	$(document).ready(function() {
	$('#displayname').tooltip({'trigger':'focus', 'title': 'tooptip'});
	$('#email').tooltip({'trigger':'focus', 'title': 'tooptip'});
	$('#password').tooltip({'trigger':'focus', 'title': 'tooptip'});
	});
	</script>
  </body>
</html>
