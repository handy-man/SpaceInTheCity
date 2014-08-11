<?PHP

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

function curdate() {
    return date('Y-m-d');
}

?>
