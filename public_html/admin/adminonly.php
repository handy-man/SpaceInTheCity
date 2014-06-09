<?php 
require("../includes/session.php");
require("../config.php");
if (isset($_SESSION['admin'])){
$adminLevel = $_SESSION['admin'];
	if($adminLevel == 2){
	//do nothing, we're an admin :D
	}
	else{
	setcookie("directattempt", "true", time()+60);
	header('Location: ' . $home . '/admin/login.php');
	}
}
else{
setcookie("directattempt", "true", time()+60);
header('Location: ' . $home . '/admin/login.php');
}
?>
