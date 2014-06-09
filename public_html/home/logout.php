<?PHP
require("../includes/session.php");
require("../config.php");
session_destroy(); 
header('Location: ' . $home . '');
?>