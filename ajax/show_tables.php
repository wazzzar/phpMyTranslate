<?php
header("Content-type: text/html; charset=utf-8");
include("../includes/vars.php");
include("../includes/db.php");
include("../includes/functions.php");

mysql_select_db($_POST["base_name"], $db);
show_tables($_POST["base_name"]);
?>