<?php
header("Content-type: text/plain; charset=utf-8");
include("../includes/vars.php");
include("../includes/db.php");

if( $_POST["that"] == "table" ){
	$filename = "./".$_POST["base"]."_".$_POST["table"].".sql";
	$query = "mysqldump -uroot -p $_POST[base] $_POST[table] > $filename \n\n";
}else{
	$filename = "./".$_POST["base"].".sql";
	$query = "mysqldump -uroot -p $_POST[base] > $filename \n\n";
}

echo ( mysql_query($query) ? $filename : "err");
?>