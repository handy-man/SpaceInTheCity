<?PHP
//Load our database
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
require("../includes/settings.php");

//Database connect
$connect = mysqli_connect($host,$user,$pass,$dbname);
//Who is submitting the report?
$author_name=$_SESSION['uid'];
//Property ID grab
$property_id=$_POST['properties'];
$property_id = mysqli_real_escape_string($connect, $property_id);
//Type of clean (Service, exit or other)
$clean_type=$_POST['clean_type'];
$clean_type = mysqli_real_escape_string($connect, $clean_type);
//The second house keeper (first being the author)
$housekeeper_2=$_POST['hk_2'];
$housekeeper_2 = mysqli_real_escape_string($connect, $housekeeper_2);
//The third house keeper
$housekeeper_3=$_POST['hk_3'];
$housekeeper_3 = mysqli_real_escape_string($connect, $housekeeper_3);
//The forth house keeper
$housekeeper_4=$_POST['hk_4'];
$housekeeper_4 = mysqli_real_escape_string($connect, $housekeeper_4);
//Hour of start for the clean
$start_hour=$_POST['start_hh'];
$start_hour = mysqli_real_escape_string($connect, $start_hour);
//Minute of start for the clean
$start_minute=$_POST['start_mm'];
$start_minute = mysqli_real_escape_string($connect, $start_minute);
//Hour of end for the clean
$end_hour=$_POST['end_hh'];
$end_hour = mysqli_real_escape_string($connect, $end_hour);
//Minute of end of the clean
$end_minute=$_POST['end_mm'];
$end_minute = mysqli_real_escape_string($connect, $end_minute);
//Is the property ready? (if no notes are important!)
$property_ready=$_POST['prop_ready'];
$property_ready = mysqli_real_escape_string($connect, $property_ready);
//Extra notes! (Important if the property isn't ready)
$extra_notes=$_POST['extra_notes'];
$extra_notes = mysqli_real_escape_string($connect, $extra_notes);
//Cleaned to best of ability declaration
$cleaned_to_best=$_POST['bestofability'];
$cleaned_to_best = mysqli_real_escape_string($connect, $cleaned_to_best);

//Insert all our data!
$clean_insert = mysqli_query($connect, "INSERT into clean (`apt_id`, `HK1`, `HK2`, `HK3`, `HK4`, `typeofclean`, `start_hh`, `start_mm`, `end_hh`, `end_mm`, `clean`, `notes`, `declaration`, `photo`, `dateofclean`) VALUES ('$property_id', '$author_name', '$housekeeper_2', '$housekeeper_3', '$housekeeper_4', '$clean_type', '$start_hour', '$start_minute', '$end_hour', '$end_minute', '$property_ready', '$extra_notes', '1', 'PHOTO', 'CURDATE()')");


//header('Location: ' . $home . '/home/index.php');

 ?>