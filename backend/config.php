<?php
//Параметры подключения к Стильной


include ".assets/".$_SERVER['HTTP_HOST']."/config.php";

$mysqli = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($mysqli)); 
mysqli_set_charset($mysqli,"utf8");

?>