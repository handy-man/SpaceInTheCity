<?PHP
//Load our database
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
//Database connect
$connect = mysqli_connect($host,$user,$pass,$dbname);
//Username & password grab
$myusername=$_POST['u'];
$mypassword=$_POST['p'];
//Username and password mysqli check
$myusername = mysqli_real_escape_string($connect, $myusername);
$mypassword = mysqli_real_escape_string($connect, $mypassword);

$saltgrab = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$myusername' LIMIT 0, 1");	
$saltgrab_array = mysqli_fetch_array($saltgrab);
$salt = $saltgrab_array['salt'];
$mypassword = crypt($mypassword, $salt);

//Mysql stuff
$check = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$myusername' and password = '$mypassword' LIMIT 0, 1");	
$playerarray = mysqli_fetch_array( $check);
$user_displayname = $playerarray['displayname'];
$user_email = $playerarray['email'];
$user_admin_status = $playerarray['admin'];
$user_id = $playerarray['ID'];
$user_mod_status = $playerarray['port_mod'];
if ($user_admin_status == 2){
//redirect user to admin backend with the correct session data.
$_SESSION['admin'] = $user_admin_status; // should always be 2 in this instance.
$_SESSION['mod'] = $user_mod_status;
$_SESSION['email'] = $user_email;
$_SESSION['displayname'] = $user_displayname;
$_SESSION['uid'] = $user_id;
setcookie("uid", $user_id, time()+3600, '/');
header('Location: ' . $home . '/admin/');
}
else{
//redirect user to admin backend login page with alert about how bad they are.
setcookie("failedlogin", "true", time()+60);
header('Location: ' . $home . '/admin/login.php');
}






 ?>
