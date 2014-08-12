<?PHP
require("./dbconfig.php");
require("./config.php");
require("./includes/session.php");
require("./core/navigation.php");
require("./core/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Welcome // aspaceinthecity.co.uk</title>

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
        <?PHP Navigation_basic($home); ?>
		
		
    <div class="container">
	
	<div class="page-header">
		<h1>Welcome, <small>a space in the city cleaning reporter.</small></h1>
	</div>
	

		<a href="./login.php"><span class='label center-block label-primary large-button'>Please login</span></a>
	
	
    </div> <!-- /container -->
	
	</div><!-- /wrap -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>