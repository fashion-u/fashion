<?php

class Alias
{
	private $db;
	private $pp;
	
    function __construct ($conn, $pp){
		$this->db = $conn;
		$this->pp = $pp;
	}
		
    public function getProductAlias($product_id){
		$pp = $this->pp;
		$alias = '';
		
		$sql = 'SELECT path_id FROM `'.$pp.'category_path` WHERE
					`category_id` = (SELECT category_id FROM `'.$pp.'product_to_category` where `product_id` = "'.$product_id.'" LIMIT 0,1)
					ORDER BY level;';
		$r = $this->db->query($sql) or die($sql);
		
		if($r->num_rows > 0){
			while($row = $r->fetch_assoc()){
				$category_id = $row['path_id'];
				
				$sql = 'SELECT keyword FROM `'.$pp.'url_alias` where `query` = "category_id='.$category_id.'" LIMIT 0,1;';
				$r_a = $this->db->query($sql) or die($sql);
			
				if($r->num_rows > 0){
					$row_a = $r_a->fetch_assoc();
					$alias .= $row_a['keyword'] . '/';
				}
			}
		}
		
		$sql = 'SELECT keyword FROM `'.$pp.'url_alias` where `query` = "product_id='.$product_id.'" LIMIT 0,1;';
		$r = $this->db->query($sql) or die($sql);
		if($r->num_rows > 0){
			$row = $r->fetch_assoc();
			$alias .= $row['keyword'];
		}
		
		return $alias;
		
	}

	public function getArrayFromAlias($alias){
	
		$aliases = explode('-', $alias);
		
		$categ = $alias;
		$data = array();
		$attributes = array();
		$sizes = array();
		$attributes_name = array();
		
		$attr_array = array();
		if(count($aliases) > 0){
				
			$attr_array['group_id'] = 0;
			$attr_array['attribute_name'] = 'none';
			$attr_array['group_name'] = 'none';			
			
			foreach($aliases as $alias){
				
				//Если есть подчеркивание - Это размер
				if(strpos($alias,'_') !== false){
					$size = explode('_',$alias);
					
					$sql = "SELECT size_id FROM " . $this->pp . "size
									WHERE name LIKE '" . $size[1] . "' AND
										group_id = (SELECT id FROM " . $this->pp . "size_group WHERE filter_name LIKE '" . $size[0] . "')
									LIMIT 0,1;";
					$query = $this->db->query($sql);
					if($query->num_rows){
						$row = $query->fetch_assoc();
						$sizes[] = $row['size_id'];
					}
					//echo '<br>'.$sql;
					
					$sql = "SELECT query FROM " . $this->pp . "url_alias WHERE keyword LIKE '" . $categ . "' AND `query` LIKE 'category_id=%' LIMIT 0,1;";
					$query = $this->db->query($sql);
					//echo '<br>'.$sql;
				
					if($query->num_rows){
						
						$row = $query->fetch_assoc();
						
						$url = explode('=', $row['query']);
						$data['sizes'] = implode(',',$sizes);
						$data['attributes'] = implode(',',$attributes);
						if((int)$attr_array['group_id'] > 0){
							$data['attributes_array'] = $attr_array;
						}
						$data['attributes_name'] = implode(',',$attributes_name);
						$data['category_id'] = $url[1];
						$data['path'] = true;
						break;
					
					}elseif($categ == 'lovedproducts'  OR
						
						$categ == 'lastviewed'){

						$data['sizes'] = implode(',',$sizes);
						$data['attributes'] = implode(',',$attributes);
						$data['attributes_name'] = implode(',',$attributes_name);
						$data['category_id'] = 0;
						break;

					}
			
				}else{
				
					$sql = "SELECT A.attribute_id, A.attribute_group_id, AD.name AS attribute_name, AGD.name AS group_name
							FROM " . $this->pp . "attribute A
							LEFT JOIN " . $this->pp . "attribute_description AD ON AD.attribute_id = A.attribute_id
							LEFT JOIN " . $this->pp . "attribute_group_description AGD ON AGD.attribute_group_id = A.attribute_group_id
							WHERE filter_name LIKE '" . $alias . "' LIMIT 0,1;";
					//echo '<br><br>'.$sql;
					$query = $this->db->query($sql);
					
					if($query->num_rows){
						$row = $query->fetch_assoc();
						
						$attributes[] = $row['attribute_group_id'].'*'.$row['attribute_id'];
						$attributes_name[] = $alias;
						
						$attr_array['group_id'] = $row['attribute_group_id'];
						$attr_array['attribute_name'] = $row['attribute_name'];
						$attr_array['group_name'] = $row['group_name'];
					}
					$attr_array['sql'] = $sql;
					//echo '<br>'.$sql;
					
					$sql = "SELECT query FROM " . $this->pp . "url_alias WHERE keyword LIKE '" . $categ . "' AND `query` LIKE 'category_id=%' LIMIT 0,1;";
					$query = $this->db->query($sql);
					//echo '<br>'.$sql;
					
					if($query->num_rows){
						
						$row = $query->fetch_assoc();
						
						$url = explode('=', $row['query']);
						$data['sizes'] = implode(',',$sizes);
						$data['attributes'] = implode(',',$attributes);
						$data['attributes_array'] = $attr_array;
						$data['attributes_name'] = implode(',',$attributes_name);
						$data['category_id'] = $url[1];
						$data['path'] = true;
						break;
							  
					}elseif($categ == 'lovedproducts'  OR
						
						$categ == 'lastviewed'){

						$data['_route_'] = $categ;
						$data['route'] = 'product/category';
						$data['sizes'] = implode(',',$sizes);
						$data['attributes'] = implode(',',$attributes);
						if((int)$attr_array['group_id'] > 0){
							$data['attributes_array'] = $attr_array;
						}
						$data['attributes_name'] = implode(',',$attributes_name);
						$data['category_id'] = 0;
						break;

					}
				}
				$categ = str_replace($alias.'-', '', $categ);
			}
			
			return $data;
		
		}else{

			return false;
		}
		
	
	}
	
	
}

?>
