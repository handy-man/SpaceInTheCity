<?PHP
//admin-login-exec.php
//Load our database
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
require("../includes/settings.php");

//Database connect
$connect = mysqli_connect($host,$user,$pass,$dbname);

$userid = $_POST['userid'];

$check = mysqli_query($connect, "SELECT * FROM `users` WHERE `ID` = '$userid'LIMIT 0, 1");	
$result = mysqli_num_rows($check);
if ($result == 1) {
//Grab variables from our databse check and redirect them to their profile.
$playerarray = mysqli_fetch_array( $check);
$user_displayname = $playerarray['displayname'];
$user_email = $playerarray['email'];
$user_id = $playerarray['ID'];
$user_admin_status = $playerarray['admin'];
$user_mod_status = $playerarray['port_mod'];

$_SESSION['admin'] = $user_admin_status;
$_SESSION['mod'] = $user_mod_status;
$_SESSION['email'] = $user_email;
$_SESSION['displayname'] = $user_displayname;
$_SESSION['uid'] = $user_id;
setcookie("uid", $user_id, time()+3600, '/');
header('Location: ' . $home . '/login/login-success.php');
}
?>