<?php
header("Content-type: text/plain; charset=utf-8");
include("../includes/vars.php");
include("../includes/db.php");

mysql_select_db($_POST["base_name"], $db);
$query = mysql_query("INSERT INTO `$_POST[table_name]` VALUES($_POST[values])");
if($query) echo "1"; else echo "0";
?>