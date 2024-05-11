<?php
header("Content-type: text/plain; charset=utf-8");
include("../includes/vars.php");
include("../includes/db.php");

mysql_select_db($_POST["base_name"], $db);
$query = mysql_query("DELETE FROM `$_POST[table_name]` WHERE `$_POST[field_name]`='$_POST[field_value]'");
if($query) echo "1"; else echo "0";
?>