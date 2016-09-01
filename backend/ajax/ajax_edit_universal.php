<?php

include('../../config.php');
include('../config.php');
	
	$key = 'exit';
    $table = '';
    $id = '';
	$mainkey = 'id';
    $data = array();
	$find = array('*1*', '@*@');
	$replace = array('=', '&');
    
foreach($_POST as $index => $value){
    
    //echo '++++    '.$index.'='.$value;
 
	
    if($index == 'key'){
        $key = $value;
    }elseif($index == 'table'){
        $table = $value;
    }elseif($index == 'id'){
        $id = str_replace($find,$replace,$value);
    }elseif($index == 'mainkey'){
        $mainkey = $value;
    }else{
        $data[$index] = str_replace($find,$replace,$value);
    }
}

if($key == 'add'){
    
	$sql = "INSERT INTO " . DB_PREFIX . $table . " SET ";
			foreach($data as $index => $value){
				 $sql .= " `$index` = '$value',";		
			}
			$sql = trim($sql, ',');
	echo $sql;
	$mysqli->query($sql) or die('sad54yfljsad bf;j '.$sql);
	
}

if($key == 'edit'){
    
	$sql = "UPDATE " . DB_PREFIX . $table . " SET ";
	foreach($data as $index => $value){
		 $sql .= " `$index` = '$value',";		
	}
	$sql = trim($sql, ',');
	$sql .=	" WHERE `$mainkey` = '" . $id . "'";
echo $sql;
	$mysqli->query($sql) or die('sadlkjgfljsad bf;j '.$sql);
		
}

if($key == 'dell'){
	
	$sql = "DELETE FROM " . DB_PREFIX . $table ." WHERE `$mainkey` = '" . $id . "'";
	echo $sql;
	$mysqli->query($sql) or die('sadlkjgfljsad bf;j '.$sql);
	
}

?>