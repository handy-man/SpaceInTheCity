<?PHP

function admin_only($home){
	if ($_SESSION['admin'] != 2){
	header('Location: ' . $home . '/home/no-auth.php');
	}
}

function reports_only($home){
	if ($_SESSION['admin'] < 1){
	header('Location: ' . $home . '/home/no-auth.php');
	}
}


function user_only($home){
	if (!isset($_SESSION['uid'])){
	header('Location: ' . $home . '/home/no-auth.php');
	}
}

function curdate() {
    return date('Y-m-d');
}


function getaptdetails($connect, $propertyid) {
$property = mysqli_query($connect, "SELECT * FROM `properties` WHERE `ID` = '$propertyid' ");
$row = $property->fetch_array(MYSQLI_ASSOC);
$details = $row['apt_number'] . " - " . $row['building'];
    return $details;
}

function gethousekeepername($connect, $hkid) {
$user = mysqli_query($connect, "SELECT `username` FROM `users` WHERE `ID` = '$hkid' ");
$row = $user->fetch_array(MYSQLI_ASSOC);
$name = $row['username'];
    return $name;
}

?>
