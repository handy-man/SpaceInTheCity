<?PHP
//Load our database
require("../dbconfig.php");
require("../config.php");
require("../includes/session.php");
require("../includes/settings.php");
require("../core/functions.php");

//Database connect
$connect = mysqli_connect($host,$user,$pass,$dbname);
//Username & password grab
$displayname = $_POST['displayname'];
$password = $_POST['password'];
$password_conf = $_POST['conf_password'];
$hash = md5( rand(0,1000) );

$displayname = mysqli_real_escape_string($connect, $displayname);
$password = mysqli_real_escape_string($connect, $password);
$password_conf = mysqli_real_escape_string($connect, $password_conf);

$check = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '$displayname' LIMIT 0, 30 ");	
$result = mysqli_num_rows($check);


if($password != $password_conf){
//redirect back to index with error
setcookie("mismatch", "true", time()+60, '/');
header('Location: ./admin-pass.php');
exit();
}
else if($result == 1){
//carry on
$displayname = mysqli_real_escape_string($connect, $displayname);
$password = mysqli_real_escape_string($connect, $password);
$salt_part1 = md5( rand(0,1000) );
$salt_part2 = md5( rand(0,1000) );
$salt = crypt($salt_part1, $salt_part2);
$password = crypt($password, $salt);
setcookie("passwordchanged", "true", time()+60, '/');
$new_user = mysqli_query($connect, "UPDATE `users` SET `password` = '$password', `salt` = '$salt' WHERE `username` = '$displayname'");
header('Location: ./admin-pass.php');
}
else{
setcookie("noexist", "true", time()+60, '/');
header('Location: ./admin-pass.php');

}
?>

