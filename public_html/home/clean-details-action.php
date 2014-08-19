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
//What clean are we actioning
$clean_id = $_POST['CID'];
//What are we doing
$action = $_POST['action'];
//If delete, delete the report. (Likely due to duplication)
if ($action == "delete"){

$delete = mysqli_query($connect, "DELETE FROM `clean` WHERE `ID` = '$clean_id'");
setcookie("reportdeleted", "true", time()+60, '/');
header('Location: ./status.php');
exit();
}
else{
echo $action;
echo $clean_id;
}
//Add other actions here.
 ?>