<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
require('../core/functions.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_GET['upload'])){
$image = $_POST['image'];
$temp = explode(".", $_FILES["file"]["name"]);
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
	include('../dbconfig.php');
	$connect = mysqli_connect($host,$user,$pass,$dbname);
	$user_id=$_SESSION['uid'];
	$event = "Uploaded a photo replacing " . $image . ".";
	log_admin($connect, $user_id, $event);
	move_uploaded_file($_FILES["file"]["tmp_name"],"../images/" . $image . ".png");
	  $fileuploaded = true;
    }
  }
else
  {
  $invalidfile = true;
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
	
    <!-- Fixed navbar repeated code because we need to change active page. -->
	<div id="wrap">
        <?PHP
	Navigation_admin();
	?>
    <div class="container">
	<?PHP
	if (isset($_POST['editpushed'])){
	echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! edits saved. <a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
	}

		if (isset($fileuploaded)){
	echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Photo uploaded! <a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
	}
	?>
	<img class="img-responsive img-center" src="../images/acog-logo.png" />
      <!-- Main component for a primary marketing message or call to action -->
	  
	  	  <div class="jumbotron">
	  <P>Photo uploader for banner <span id="info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Images will be displayed at 1920x500 pixels, please make sure that they are appropriate for the front page." class="glyphicon glyphicon-info-sign"></span> </p>
	  		<form action="?upload" method="post"
			enctype="multipart/form-data">
			<select class="form-control" name="image">
			<option value="top">1st banner - Top</option>
			<option value="middle">2nd banner - Middle</option>
			<option value="bottom">3rd banner - Bottom</option>
			</select>
			<input style="margin: auto;" type="file" name="file" id="file">
			<input class="form-control btn btn-primary" type="submit" name="submit" value="Upload picture">
			</form>
	  
	  </div>
	  
	  	  	  <div class="jumbotron">
	  <P>Photo uploader for other <span id="info-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Use common sense for uploading these images, get like for like sizes etc." class="glyphicon glyphicon-info-sign"></span> <span id="info-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Committee images can be uploaded from the committee edit page." class="glyphicon glyphicon-info-sign"></span> </p>
	  		<form action="?upload" method="post"
			enctype="multipart/form-data">
			<select class="form-control" name="image">
			<option value="acog-logo">ACOG logo (the logo found on most pages of the website)</option>
			<option value="default">Default user image (in the /user/ profile)</option>
			<option value="splash">splash behind committee (on committee page, currently the green edges(at time of initial website creation))</option>
			</select>
			<input style="margin: auto;" type="file" name="file" id="file">
			<input class="form-control btn btn-primary" type="submit" name="submit" value="Upload picture">
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
		    <script>
	$(document).ready(function() {
	$('#info').tooltip();
	$('#info-1').tooltip();
	$('#info-2').tooltip();
	});
	</script>
  </body>
</html>

