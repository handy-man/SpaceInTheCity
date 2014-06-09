<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');

if(isset($_GET['upload'])){
$person = $_POST['person'];
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
	move_uploaded_file($_FILES["file"]["tmp_name"],"../images/" . $person . ".png");
	  $fileuploaded = true;
      }
  }
else
  {
  $invalidfile = true;
  }
}






 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 
    <title>Aberystwyth Community of Gamers</title>
	
	<?PHP include('../includes/committee-names.php'); ?>
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
	echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! edits saved. Refresh to see the changes.  <a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
	include_once("../includes/committee-names.php");
	}
	
		if (isset($fileuploaded)){
	echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Photo uploaded! <a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a> </div>";
	}
	?>
	<img class="img-responsive img-center" src="../images/acog-logo.png" />
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron-user-edit">

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

	<P> President </p>
	<div class="input-group input-group-sm">
	<span class="input-group-addon">Name</span>
    <input name="president_name" type="text" class="form-control" value="<?PHP echo $president_name; ?>" required>
	</div>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Bio</span>
	<input name="president_bio" type="text" class="form-control" value="<?PHP echo $president_bio; ?>" required>
	</div>

	<P>Vice-President </p>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Name</span>
    <input name="vice_president_name" type="text" class="form-control" value="<?PHP echo $vice_president_name; ?>" required>
	</div>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Bio</span>
	<input name="vice_president_bio" type="text" class="form-control" value="<?PHP echo $vice_president_bio; ?>" required>
	</div>
	
	<P>Treasurer </p>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Name</span>
    <input name="treasurer_name" type="text" class="form-control" value="<?PHP echo $treasurer_name; ?>" required>
	</div>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Bio</span>
	<input name="treasurer_bio" type="text" class="form-control" value="<?PHP echo $treasurer_bio; ?>" required>
	</div>

	<P>secretary </p>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Name</span>
    <input name="secretary_name" type="text" class="form-control" value="<?PHP echo $secretary_name; ?>" required>
	</div>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Bio</span>
	<input name="secretary_bio" type="text" class="form-control" value="<?PHP echo $secretary_bio; ?>" required>
	</div>

	<P>Social secretary </p>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Name</span>
    <input name="social_secretary_name" type="text" class="form-control" value="<?PHP echo $social_secretary_name; ?>" required>
	</div>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Bio</span>
	<input name="social_secretary_bio" type="text" class="form-control" value="<?PHP echo $social_secretary_bio; ?>" required>
	</div>

	<P>Events manager </p>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Name</span>
    <input name="tournament_name" type="text" class="form-control" value="<?PHP echo $tournament_name; ?>" required>
	</div>
		<div class="input-group input-group-sm">
	<span class="input-group-addon">Bio</span>
	<input name="tournament_bio" type="text" class="form-control" value="<?PHP echo $tournament_bio; ?>" required>
	</div>

	<input type="hidden" name="editpushed" value="true">
    <input class="form-control btn btn-success" type="submit" value="Save"> 

</form>
      </div>
	  
	  <div class="jumbotron">
	  <P>Photo uploader! <span id="info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Images will be displayed in the resolution 256x236 in pixels, please resize your image as near as this as you can so not to create a squashed image for your picture." class="glyphicon glyphicon-info-sign"></span></p>
	  		<form action="?upload" method="post"
			enctype="multipart/form-data">
			<select class="form-control" name="person">
			<option value="president"><?PHP echo $president_name; ?> - President</option>
			<option value="vice-president"><?PHP echo $vice_president_name; ?> - Vice-president</option>
			<option value="treasurer"><?PHP echo $treasurer_name; ?> - Treasurer</option>
			<option value="secretary"><?PHP echo $secretary_name; ?> - Secretary</option>
			<option value="social-sec"><?PHP echo $social_secretary_name; ?> - Social secretary</option>
			<option value="events-manager"><?PHP echo $tournament_name; ?> - Events manager</option>
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
	});
	</script>
  </body>
</html>


<?php

if (isset($_POST['tournament_bio']))
{

$president_name = str_replace('"', "'",$_POST['president_name']);
$president_bio = str_replace('"', "'",$_POST['president_bio']);

$vice_president_name = str_replace('"', "'",$_POST['vice_president_name']);
$vice_president_bio = str_replace('"', "'",$_POST['vice_president_bio']);

$treasurer_name = str_replace('"', "'",$_POST['treasurer_name']);
$treasurer_bio = str_replace('"', "'",$_POST['treasurer_bio']);

$secretary_name = str_replace('"', "'",$_POST['secretary_name']);
$secretary_bio = str_replace('"', "'",$_POST['secretary_bio']);

$social_secretary_name = str_replace('"', "'",$_POST['social_secretary_name']);
$social_secretary_bio = str_replace('"', "'",$_POST['social_secretary_bio']);

$tournament_name = str_replace('"', "'",$_POST['tournament_name']);
$tournament_bio = str_replace('"', "'",$_POST['tournament_bio']);


$string = '<?php 

$president_name = "'. $president_name. '";
$president_bio = "'. $president_bio . '";

$vice_president_name = "'. $vice_president_name. '";
$vice_president_bio = "'. $vice_president_bio. '";

$treasurer_name = "'. $treasurer_name. '";
$treasurer_bio = "'. $treasurer_bio. '";

$secretary_name = "'. $secretary_name. '";
$secretary_bio = "'. $secretary_bio. '";

$social_secretary_name = "'. $social_secretary_name. '";
$social_secretary_bio = "'. $social_secretary_bio. '";

$tournament_name = "'. $tournament_name. '";
$tournament_bio = "'. $tournament_bio. '";

?>';



$fp = fopen("../includes/committee-names.php", "w");

fwrite($fp, $string);

fclose($fp);

}

?>
