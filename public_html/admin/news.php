<?PHP require('adminonly.php');
require('../config.php');
require('../core/navigation.php');
include('../core/functions.php');
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
		<?php
		//Basically gets the text file via a _GET statement and then loads it into the text area, then overwrites the textfile with data from text area. (potential for abuse for any text file in this directory)
			$text = $_GET['file'];
			$fn = "../includes/" . $text . ".txt";
			if (!isset($_GET['file'])){

			}
			if (isset($_POST['content']))

			{
			$fn = "../includes/" . $_POST['filesave'] . ".txt";
				$content = $_POST['content'];
				$time = 86400 * $_POST['days'] + time();
				cache_news_create($time);
				$fp = fopen($fn,"w") or die ("Error opening file in write mode!");

				fputs($fp,$content);

				fclose($fp) or die ("Error closing file!");

			}
		?>



<form action="<?php echo $_SERVER["PHP_SELF"] . "?file=" . $text .  ""; ?>" method="post">

    <textarea class="form-control" rows="10" cols="400" name="content"><?php readfile($fn); ?></textarea>
	<input type="hidden" name="filesave" value="<?PHP echo $text; ?>">
	<input type="hidden" name="editpushed" value="true">
	<span>Number of days before we automatically remove news:</span><select name="days" >
	<?PHP while($i <=30){$i++; echo "<option value='$i'>$i</option>";}  ?>
	</select>
	<p>Current date for when we self destruct: <?PHP news_timeleft(); ?> </p>
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
