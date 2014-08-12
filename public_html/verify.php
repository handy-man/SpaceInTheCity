<?PHP
//Load our database
require("./dbconfig.php");
require("./config.php");
require("./includes/session.php");
require("./includes/settings.php");
$_SESSION['uid'] = 0;
//Database connect
$connect = mysqli_connect($host,$user,$pass,$dbname);
//Username & password grab
$myusername=$_POST['u'];
$mypassword=$_POST['p'];
//Username and password mysqli check
$myusername = mysqli_real_escape_string($connect, $myusername);
$mypassword = mysqli_real_escape_string($connect, $mypassword);


$saltgrab = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '$myusername' LIMIT 0, 1");	
$saltgrab_array = mysqli_fetch_array($saltgrab);
$salt = $saltgrab_array['salt'];
$mypass = crypt($mypassword, $salt);
//More mysql stuff
$check = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '$myusername' AND `password` = '$mypass' LIMIT 0, 1");	
$result = mysqli_num_rows($check);
if ($result == 1) {
//Grab variables from our databse check and redirect them to their profile.
$playerarray = mysqli_fetch_array( $check);
$user_displayname = $playerarray['username'];
$user_id = $playerarray['ID'];
$user_admin_status = $playerarray['level'];
//redirect user to our profiles etc
$_SESSION['admin'] = $user_admin_status;
$_SESSION['displayname'] = $user_displayname;
$_SESSION['uid'] = $user_id;
setcookie("uid", $user_id, time()+3600, '/');
header('Location: ' . $home . '/login-success.php');
}
else{
setcookie("baduser", "true", time()+60, '/');
header('Location: ' . $home . '/');
}

 ?>