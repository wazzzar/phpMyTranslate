<?php
function get_translate($s){
	if("en" == $GLOBALS["lang_to"]) return $s;
	$t = json_decode(
		file_get_contents(
			$GLOBALS["translater_url"].
			"?key=".$GLOBALS["api_key"].
			"&text=".str_replace("_", " ", $s).
			"&lang=en-".$GLOBALS["lang_to"].
			"&format=".$GLOBALS["format"]
		), true
	);
	if($t) return str_replace(" ", "&nbsp;", $t["text"][0]);
	  else return $s;
}

function show_databases(){
	$query = mysql_query("SHOW DATABASES");
	global $bases;
	while($bases[] = mysql_fetch_assoc($query)){
		$t = $bases[count($bases) - 1]["Database"];
		echo "<li class=\"$t\">".get_translate($t)."</li>";
	}
}

function show_tables($base){
	$query = mysql_query("SHOW TABLES");
	global $tables;
	while($tables[] = mysql_fetch_assoc($query)){
		$t = $tables[count($tables) - 1]["Tables_in_".$base];
		echo "<li class=\"$t\">".get_translate($t)."</li>";
	}
}

function type_2_type($t){
	$t = explode("(", $t);
	if(!empty($t[1])) $l = explode(")", $t[1]);
	if(!empty($l[1])){ $a = $GLOBALS["TYPES"][trim($l[1])]; }
	switch($t[0]){
		// int
		case "tinyint" : case "smallint" : case "mediumint" : case "int" : case "bigint" :
		// real
		case "float" : case "double" : case "real" :
		// char
		case "char" : case "varchar" :
			return $GLOBALS["TYPES"][$t[0]].$a.$GLOBALS["TYPES"]["len"].$l[0].")";
		case "text" : return $GLOBALS["TYPES"]["text"];
	}
}

function gen_form_for($table){
	$query = mysql_query("DESCRIBE `$table`");
	echo "<tr class='form_to_add'>";
	while($field = mysql_fetch_assoc($query)){
		echo "<td class='input_text'>";
		$t = explode("(", $field["Type"]);
		if(!empty($t[1])) $l = explode(")", $t[1]);
		if(!empty($l[1])) $a = trim($l[1]);
		$size = $l[0] > 32 ? 32 : $l[0];
		switch(trim($t[0])){
			case "text" : echo "<textarea rows='1'></textarea>"; break;
			default : echo "<input type='text' size='$size' maxlength='$l[0]' />";
		}
		echo "</td>";
	}
	echo "<td class='data save_row'><img src='img/save.png' alt='".$GLOBALS["LANG"]["save_row"]."' /><span class='field_type'>".$GLOBALS["LANG"]["save_row"]."</span></td>
		</tr>";
}

function gen_html_table($table){
	echo "<table class='table_data'><tbody><tr>";
	$query = mysql_query("DESCRIBE `$table`");
	$c = 0;
	while($field = mysql_fetch_assoc($query)){
		$c++;
		$f = $field["Field"];
		if("auto_increment" == $field["Extra"]){ $e = "&nbsp;".$GLOBALS["TYPES"]["auto_increment"]; }else{ $e = ""; }
		echo "<td class='field_name' id='$f'>".get_translate($f)."<span class='field_type'>".type_2_type($field["Type"]).$e."</span></td>";
	}
	echo "<td class='data add_row'><img src='img/add.png' alt='".$GLOBALS["LANG"]["add_row"]."' /><span class='field_type'>".$GLOBALS["LANG"]["add_row"]."</span></td></tr>";
	gen_form_for($table);
	$query = mysql_query("SELECT * FROM `$table`");
	$i = 0;
	while($data = mysql_fetch_assoc($query)){
		$i++;
		echo "<tr>";
		foreach($data as $d){	
			echo "<td class='data to_get'>$d</td>";
		}
		echo "<td class='data edit_row'><img src='img/edit.png' alt='".$GLOBALS["LANG"]["edit_row"]."' /><span class='field_type'>".$GLOBALS["LANG"]["edit_row"]."</span></td>
			  <td class='data del_row'><img src='img/delete.png' alt='".$GLOBALS["LANG"]["del_row"]."' /><span class='field_type'>".$GLOBALS["LANG"]["del_row"]."</span></td>
			</tr>";
	}
	if(!$i){
		while($c){
			$empty_row .= "<td class='data'>".$GLOBALS["LANG"]["no_data"]."</td>";
			$c--;
		}
		echo "<tr>
				$empty_row
				<td class='data edit_row empty'><img src='img/edit.png' alt='".$GLOBALS["LANG"]["edit_row"]."' /><span class='field_type'>".$GLOBALS["LANG"]["edit_row"]."</span></td>
				<td class='data del_row empty'><img src='img/delete.png' alt='".$GLOBALS["LANG"]["del_row"]."' /><span class='field_type'>".$GLOBALS["LANG"]["del_row"]."</span></td>
			</tr>";
	}
	echo "</tbody></table><br />";
}

function get_settings(){
	include("../includes/settings_form.html");
}
?>










