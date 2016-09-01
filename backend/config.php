<?php
//Параметры подключения к Стильной
if($_SERVER['HTTP_HOST'] == 'fashion.my'){
	$__server_host = 'stilnaya.com.ua';
	$__db_server_host = 'localhost';
	$__db_user = 'root';
	$__db_pass = 'sturm2015';
	$__db_name = 'loderi_stua';
}else{
	$__server_host = 'stilnaya.com.ua';
	$__db_server_host = 'localhost';
	$__db_user = 'loderi_stua';
	$__db_pass = 'Fzy3NpHW';
	$__db_name = 'loderi_stua';
}
define("ST__SERVER_NAME", $__server_host);
define("ST__DB_SERVER_NAME", $__db_server_host);
define("ST__DB_USER", $__db_user);
define("ST__DB_PASS", $__db_pass);
define("ST__DB_NAME", $__db_name);

$mysqli = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($mysqli)); 
mysqli_set_charset($mysqli,"utf8");
?>