<?PHP
function show_twitch($home){
	$cache_file = "./cache/twitch.cache";
	$data = unserialize(file_get_contents($cache_file));
		$twitch = $data['object'];
		if ($twitch == 1){
		echo "<div style='text-align: center; margin: auto;' class='alert alert-danger fade in hints'>ACOG is streaming live, checkout the livestream <a href='" . $home . "/twitch.php'>here</a> <a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></div>";
		}
}

function cache_news_create($time){
					file_put_contents("../cache/news.cache", serialize( array("timestamp" => $time)));
}

function news_timeleft(){
		$cache_file = "../cache/news.cache";
	$data = unserialize(file_get_contents($cache_file));
		$date = $data['timestamp'];
		$time = gmdate("d-m-y H:i", $date);
		echo $time;
}

function check_port($connect, $user_id){
$activecheck = mysqli_query($connect, "SELECT * FROM `users` WHERE `ID` = '$user_id' AND `port_mod` = '1' LIMIT 0, 1");	
$activecheck_result = mysqli_num_rows($activecheck);
if ($activecheck_result == 1){
$allowed = "true";
}
else{
$allowed = "false";
}
return $allowed;
}

function log_admin($connect, $user_id, $event){
$logs = mysqli_query($connect, "INSERT INTO `logs` (`user_id`, `event`) VALUES ('$user_id', '$event');");	
}

function admin_only($home){
	if ($_SESSION['admin'] != 2){
	header('Location: ' . $home . '/home/no-auth.php');
	}
}

function ref_only($home){
	if ($_SESSION['admin'] >= 1){
	header('Location: ' . $home . '/home/no-auth.php');
	}
}


function user_only($home){
	if (!isset($_SESSION['uid'])){
	header('Location: ' . $home . '/home/no-auth.php');
	}
}

function log_reg($displayname, $email, $email_conf, $ipaddress){
	//We are worried about our website being seen from the world, getting spambots trying to register wanna store more info.	
	$file = '../admin/logs.txt';
	$curtime = time();
	$log_string = "" . $displayname . " registered with " . $email . " and " . $email_conf . " from the IP address , " . $ipaddress . " @ " . $curtime . "\n";
	$fh = fopen($file, 'a') or die("can't open file");
	fwrite($fh, $log_string);
	fclose($fh);
}

?>
