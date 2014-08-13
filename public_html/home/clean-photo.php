<?PHP
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
require("../core/navigation.php");
require("../core/functions.php");
$user_id = $_SESSION['uid'];
user_only($home);
$connect = mysqli_connect($host,$user,$pass,$dbname);

$clean_id = $_GET['cid'];

if(isset($_FILES['files'])){
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }		
        $query="INSERT into clean_photos (`CID`,`FILE_NAME`,`FILE_SIZE`,`FILE_TYPE`) VALUES('$clean_id','$file_name','$file_size','$file_type'); ";
        $desired_dir="./photos";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0744);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
            }else{									// rename the file if another one exist
                $new_dir="$desired_dir/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
		$query = mysqli_query($connect, $query);
		 
        }else{
				$error_print = true;
        }
    }
	if(empty($errors)){
		$success = true;
	}
}

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?PHP include($home . "/includes/meta.html");  ?> 

    <title>Cleaning in progress...</title>
	
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
			if (isset($success)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-success fade in hints'>Success! Select another photo or finish.</div>";
	}
	
				if (isset($error_print)){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>";  print_r($errors); echo "</div>";
	}
	
	?>
      <!-- Main component for a primary marketing message or call to action -->
		<div class="page-header">
		<h1>Submit photo's for any damages </h1>
		<h5>Photo's being completed by: <?PHP echo $_SESSION['displayname']; ?></h5>
		</div>
		<form action="<?PHP $_SERVER['PHP_SELF']  . "?cid=" . $_GET['cid']; ?>" method="post" enctype="multipart/form-data">
		<input type="file" name="files[]" multiple/>
		<button class='btn btn-lg btn-primary btn-block' type='submit'>Submit photo</button>
		</form>
	<div style="margin-top: 30px;"></div>
	<a href="./index.php"><button class='btn btn-lg btn-danger btn-block'>Finished</button></a>
      </div> <!--/Jumbotron -- >

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
