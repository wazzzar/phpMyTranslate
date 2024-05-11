<?php
ob_start();
header("Content-type: text/html; charset=utf-8");
// usefull things
include("includes/vars.php");
include("includes/langs/".$cur_apl_lang.".php");

$base_dir = $_SERVER["REQUEST_URI"];
$page = "lock";

// is authorization
if( isset($_POST["login"]) && isset($_POST["pass"]) ){
	$t = time()+600;
	setcookie("login", $_POST["login"], $t, $base_dir);
	setcookie("pass", $_POST["pass"], $t, $base_dir);
	header("Location: $base_dir");
}else{
	// if logged
	if( md5($_COOKIE["login"]) == $md5_login && md5($_COOKIE["pass"]) == $md5_pass ){
		include("includes/db.php");
		include("includes/functions.php");
		$page = "main";
	}
}

// $page = "main";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">

		<!-- jquery +UI -->
		<link type='text/css' href='script/jquery-ui-1.10.3/themes/ui-lightness/jquery-ui.min.css' rel='stylesheet'>
		<script type='text/javascript' src="script/jquery-1.11.1.min.js"></script>
		<script type='text/javascript' src='script/jquery-ui-1.10.3/ui/jquery-ui.min.js'></script>
		<!-- /jquery +UI -->

		<script type='text/javascript' src="includes/langs/<?php echo $cur_apl_lang; ?>.js"></script>
		<script type='text/javascript' src="script/main.js"></script>
		
		<link type="text/css" href="css/style.css" rel="stylesheet">
		<link type='image/x-icon' href='img/favicon.ico' rel='icon'>
		<title><?php echo $LANG["title"]; ?></title>
	</head>
	
	<body>
		<?php include("$page.php"); ?>
	</body>
</html>