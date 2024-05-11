<?php
header("Content-type: text/html; charset=utf-8");
include("../includes/vars.php");
include("../includes/db.php");
include("../includes/langs/".$cur_apl_lang.".php");
include("../includes/functions.php");

mysql_select_db($_POST["base_name"], $db);
gen_html_table($_POST["table_name"]);
?>