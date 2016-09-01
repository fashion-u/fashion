<!-- Sergey Kotlyarov 2016 folder.list@gmail.com -->
<?php
$file = explode('/', __FILE__);
if(strpos($_SERVER['PHP_SELF'], $file[count($file)-1]) !== false){
	header("Content-Type: text/html; charset=UTF-8");
	die('Прямой запуск запрещен!');
}


	include_once('class/product.class.php');
	$Product = new Product($mysqli, DB_PREFIX);
	
	$x = $Product->dellImages();	

?>
