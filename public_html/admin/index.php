<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
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
		<p>Welcome committee, this administrator back end features a few tools that will aid in the running of this website, this allows you to edit the current committee, the page contents as well as some admin management of the user section of the website.</p>
		<p>If you want to request a feature/ report a problem for any part of the website it is best to contact Nathan Hand (nathan454@hotmail.co.uk) he originally wrote the entire website from scratch and should be happy to help.</p>
		<p>Please visit the navigation at the top of the admin backend to get started, please be careful as anything entered here will go onto the live website straight away no questions asked.</p>
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
