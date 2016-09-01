<?php

class Designer
{
	private $db;
	private $pp;
	
    function __construct ($conn, $pp){
		$this->db = $conn;
		$this->pp = $pp;
	}
	
	public function getDesignerIdOnName($name, $shop_id){
		
		$name = str_replace("'",'&#39;', $name);
		$name = str_replace("\\",'', $name);
		
		$pp = $this->pp;
		
		$sql = 'SELECT manufacturer_id FROM `'.$pp.'manufacturer` WHERE
				upper(`name`) = "'.mb_strtoupper(addslashes($name),'UTF-8').'";';
		//echo $sql;
		$r = $this->db->query($sql);
		
		if($r->num_rows > 0){
			$tmp = $r->fetch_assoc();
			return $tmp['manufacturer_id'];
		}else{
			$sql = 'SELECT id FROM `'.$pp.'manufacturer_alternative` WHERE
				(upper(`name`) = "'.mb_strtoupper(addslashes($name),'UTF-8').'" AND shop_id="'.$shop_id.'") OR
				(upper(`name`) = "'.mb_strtoupper(addslashes($name),'UTF-8').'" AND shop_id="0") ;';
			//echo $sql;
			$r = $this->db->query($sql);
			
			if($r->num_rows > 0){
				$tmp = $r->fetch_assoc();
				return $tmp['id'];
			}
		}
		
		return 0;

		
		/*
		$pp = $this->pp;
		
		$sql = 'SELECT id FROM `'.$pp.'guidedesigner` WHERE
				upper(`name`) = "'.mb_strtoupper(addslashes($name),'UTF-8').'" OR
				upper(`alternative_name`) LIKE "%'.mb_strtoupper(addslashes($name),'UTF-8').'%";';
		//echo $sql;
		$r = $this->db->query($sql);
		
		if($r->num_rows > 0){
			$tmp = $r->fetch_assoc();
			return $tmp['id'];
		}
		
		return 0;
		*/
		
	}

	public function getDesigner($id){
		$pp = $this->pp;
		
		$sql = 'SELECT * FROM `'.$pp.'manufacturer` WHERE
						manufacturer_id = "'.$id.'";';
		//echo $sql;
		$r = $this->db->query($sql);
		
		if($r->num_rows > 0){
			$tmp = $r->fetch_assoc();
			return $tmp;
		}
		
		return false;
		
	}
	
	public function getManufacturers(){
		return $this->getDesigners();
	}
	
	public function getDesigners(){
		$pp = $this->pp;
		
		$sql = 'SELECT * FROM `'.$pp.'manufacturer` ORDER BY name;';
		//echo $sql;
		$r = $this->db->query($sql);
		
		$return = array();
		if($r->num_rows > 0){
			while($tmp = $r->fetch_assoc()){
				$return[$tmp['manufacturer_id']] = $tmp;
			}
		}
		
		return $return;
		
	}

}

?>
