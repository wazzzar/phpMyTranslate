<?php
	if(!$_POST["user_login"])	 $_POST["user_login"] = "admin";
	if(!$_POST["user_password"]) $_POST["user_password"] = "admin";
	$md5_login = md5($_POST["user_login"]);
	$md5_pass = md5($_POST["user_password"]);
	if($_POST["bind_langs"]) $_POST["lang_to"] = $_POST["application_lang"];
	$f =
"<?php
	// for base connect
	\$host = '$_POST[db_host]';
	\$user = '$_POST[db_user]';
	\$pass = '$_POST[db_pass]';

	// translate API settings
	\$translater_url = '$_POST[translater_url]';
	\$api_key = '$_POST[api_key]';
	\$lang_to = '$_POST[lang_to]';
	\$format = '$_POST[format]';
	
	// user login, password
	\$user_login = '$_POST[user_login]';
	\$md5_login = '$md5_login';
	\$user_password = '$_POST[user_password]';
	\$md5_pass = '$md5_pass';
	
	// application settings
	\$cur_apl_lang = '$_POST[application_lang]';
?>";
	if(file_put_contents("../includes/vars.php", $f)) echo "1"; else echo "0";
?>