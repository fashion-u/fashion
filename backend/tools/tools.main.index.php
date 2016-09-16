<!-- Sergey Kotlyarov 2016 folder.list@gmail.com -->
<?php
$file = explode('/', __FILE__);
if(strpos($_SERVER['PHP_SELF'], $file[count($file)-1]) !== false){
	header("Content-Type: text/html; charset=UTF-8");
	die('Прямой запуск запрещен!');
}

//Востановление описания из резерва
	$sql = 'SELECT id, text2 FROM fash_alias_description_2016_09_14';
	$r = $mysqli->query($sql) or die($sql);

	while($row = $r->fetch_assoc()){

		$sql = 'UPDATE fash_alias_description SET text2 = "'.$row['text2'].'" WHERE id="'.(int)$row['id'].'"';
		$mysqli->query($sql) or die($sql);

		$sql = 'UPDATE fash_alias_description_domain SET text2 = "'.$row['text2'].'" WHERE id="'.(int)$row['id'].'"';
		$mysqli->query($sql) or die($sql);

	}	

	die('1111');

/*
	$sql = 'SELECT product_id FROM fash_product WHERE manufacturer_id IN (184, 166, 178)';
	$r = $mysqli->query($sql) or die($sql);
	
	$product_ids = array();
	while($row = $r->fetch_assoc()){
		
		$product_ids[] = $row['product_id'];
	}	
	
	$sql = 'UPDATE fash_product_to_size SET size_id = 2 WHERE size_id=35 AND product_id IN ('.implode(',', $product_ids).')';
	$mysqli->query($sql) or die($sql);
	
	$sql = 'UPDATE fash_product_to_size SET size_id = 3 WHERE size_id=32 AND product_id IN ('.implode(',', $product_ids).')';
	$mysqli->query($sql) or die($sql);
	
	$sql = 'UPDATE fash_product_to_size SET size_id = 4 WHERE size_id=33 AND product_id IN ('.implode(',', $product_ids).')';
	$mysqli->query($sql) or die($sql);
	
	$sql = 'UPDATE fash_product_to_size SET size_id = 5 WHERE size_id=34 AND product_id IN ('.implode(',', $product_ids).')';
	$mysqli->query($sql) or die($sql);
	
	$sql = 'UPDATE fash_product_to_size SET size_id = 6 WHERE size_id=17 AND product_id IN ('.implode(',', $product_ids).')';
	$mysqli->query($sql) or die($sql);
	
	$sql = 'UPDATE fash_product_to_size SET size_id = 7 WHERE size_id=18 AND product_id IN ('.implode(',', $product_ids).')';
	$mysqli->query($sql) or die($sql);
	
	$sql = 'UPDATE fash_product_to_size SET size_id = 28 WHERE size_id=19 AND product_id IN ('.implode(',', $product_ids).')';
	$mysqli->query($sql) or die($sql);
		
	echo 'OK';
*/

$c = 28;
	
	$sql = 'SELECT P.category_id, PD.name FROM fash_product_to_category P LEFT JOIN fash_category_description PD ON PD.category_id = P.category_id';
	$r = $mysqli->query($sql) or die($sql);

	$categs = array();
	while($row = $r->fetch_assoc()){
		$categs[$row['category_id']] = $row['name'];
	}
	
	
	$sql = 'SELECT P.product_id, P.category_id, PD.name FROM fash_product_to_category P LEFT JOIN fash_product_description PD ON PD.product_id = P.product_id WHERE category_id IN ('.$c.')';
	$r = $mysqli->query($sql) or die($sql);

	$product_ids = array();
	while($row = $r->fetch_assoc()){
		
		$sql = 'SELECT category_id FROM fash_product_to_category_tmp WHERE product_id = "'.$row['product_id'].'"';
		
		$r1 = $mysqli->query($sql) or die($sql);
		$row1 = $r1->fetch_assoc();
		$categ_id = $row1['category_id'];
		
		if($row1['category_id'] != $row['category_id'] AND isset($categs[$categ_id])){
			echo '<br>'.$row['name'].'->'.$categs[$categ_id];
			
			if(isset($categs[$categ_id])){
				$sql = 'UPDATE fash_product_to_category SET category_id="'.$categ_id.'" WHERE product_id="'.$row['product_id'].'" AND category_id="'.$c.'";';
				//echo '<br>'.$sql;
				//$mysqli->query($sql) or die($sql);
			}
			
		}
		
	}
	
	
?>