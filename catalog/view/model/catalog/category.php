<?php
class ModelCatalogCategory extends Model {
	public function getCategory($category_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row;
	}

	public function getCategoryDomain($category_id) {
		
		$sql = "SELECT DISTINCT * FROM " . DB_PREFIX . "category_description_domain WHERE category_id = '" . (int)$category_id . "' LIMIT 0, 1";
	
		$query = $this->db->query($sql);

		return $query->row;
		
	}

	public function getCategories($parent_id = 0) {
		$sql = "SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)";
	
		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getCategoryFilters($category_id) {
		$implode = array();

		$query = $this->db->query("SELECT filter_id FROM " . DB_PREFIX . "category_filter WHERE category_id = '" . (int)$category_id . "'");

		foreach ($query->rows as $result) {
			$implode[] = (int)$result['filter_id'];
		}

		$filter_group_data = array();

		if ($implode) {
			$filter_group_query = $this->db->query("SELECT DISTINCT f.filter_group_id, fgd.name, fg.sort_order FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_group fg ON (f.filter_group_id = fg.filter_group_id) LEFT JOIN " . DB_PREFIX . "filter_group_description fgd ON (fg.filter_group_id = fgd.filter_group_id) WHERE f.filter_id IN (" . implode(',', $implode) . ") AND fgd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY f.filter_group_id ORDER BY fg.sort_order, LCASE(fgd.name)");

			foreach ($filter_group_query->rows as $filter_group) {
				$filter_data = array();

				$filter_query = $this->db->query("SELECT DISTINCT f.filter_id, fd.name FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_description fd ON (f.filter_id = fd.filter_id) WHERE f.filter_id IN (" . implode(',', $implode) . ") AND f.filter_group_id = '" . (int)$filter_group['filter_group_id'] . "' AND fd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY f.sort_order, LCASE(fd.name)");

				foreach ($filter_query->rows as $filter) {
					$filter_data[] = array(
						'filter_id' => $filter['filter_id'],
						'name'      => $filter['name']
					);
				}

				if ($filter_data) {
					$filter_group_data[] = array(
						'filter_group_id' => $filter_group['filter_group_id'],
						'name'            => $filter_group['name'],
						'filter'          => $filter_data
					);
				}
			}
		}

		return $filter_group_data;
	}

	public function getCategoryLayoutId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int)$category_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}

	public function getTotalCategoriesByCategoryId($parent_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row['total'];
	}
	
	public function getCategoryAlias($category_id = 0) {
			
		$sql = 'SELECT keyword FROM '. DB_PREFIX .'url_alias WHERE `query` = "category_id='.$category_id.'" LIMIT 0,1;';
		$r1 = $this->db->query($sql);
		
		if($r1->num_rows){
			return $r1->row['keyword'];
		}
		return '';
		
	}

	public function getCategorize($alias) {
			
		$sql = 'SELECT * FROM '. DB_PREFIX .'alias_description WHERE `url` = "'.$alias.'" LIMIT 0,1;';
		$r1 = $this->db->query($sql);
		return $r1->row;
		
	}
	public function getCategorizeName($alias) {
			
		$sql = 'SELECT name FROM '. DB_PREFIX .'alias_description WHERE `url` = "'.$alias.'" LIMIT 0,1;';
		
		$r1 = $this->db->query($sql);
		if($r1->num_rows){
			return $r1->row['name'];
		}
		return '';
		
	}

	public function getCategorizeDomain($id) {
			
		$sql = 'SELECT * FROM '. DB_PREFIX .'alias_description_domain 
						WHERE `id` = "'.$id.'" LIMIT 0,1;';
		
		$r1 = $this->db->query($sql);
		
		return $r1->row;
		
	}

	public function getCategoryPath($category_id = 0) {
		$sql = 'SELECT path_id FROM '. DB_PREFIX .'category_path WHERE category_id = "'.$category_id.'" ORDER BY level;';
		$r = $this->db->query($sql);
		
		$return = array();
		foreach($r->rows as $row){
			
			$return[] = $row['path_id'];

		}
		
		return $return;
		
	}

	public function getCategoryAliasPath($category_id = 0) {
		$sql = 'SELECT path_id FROM '. DB_PREFIX .'category_path WHERE category_id = "'.$category_id.'" ORDER BY level;';
		$r = $this->db->query($sql);
		
		$return = '';
		foreach($r->rows as $row){
			
			$sql = 'SELECT keyword FROM '. DB_PREFIX .'url_alias WHERE `query` = "category_id='.$row['path_id'].'" LIMIT 0,1;';
			$r1 = $this->db->query($sql);
			$return .= $r1->row['keyword'] . '/';

		}
		
		$return = trim($return, '/');
		return $return;
		
		
	}
	public function getCategoryAttribute($category_id = 0) {
		$sql = 'SELECT attribute_id FROM '. DB_PREFIX .'category_to_attribute WHERE category_id = "'.$category_id.'";';
	
		$r = $this->db->query($sql);
		
		$return = array();
		foreach($r->rows as $row){
			
			$return[$row['attribute_id']] = $row['attribute_id'];

		}
		
		return $return;
		
	}
	public function getCategoryTree() {
		
		$body = '<link rel="stylesheet" type="text/css" href="/'.TMP_DIR.'backend/libs/category_tree/type-for-get-admin.css">
					<script type="text/javascript" src="/'.TMP_DIR.'backend/libs/category_tree/script-for-get.js"></script>
					<script type="text/javascript" src="/'.TMP_DIR.'backend/category/category_tree.js"></script>
					<input type="hidden" id="select_cetegory_target" value="">		
					<script>
						$(document).ready(function(){
							$("#0").parent("span").parent("li").children("span").first().toggleClass("closed opened").nextAll("ul").toggle();;
						});
						$(document).on("click", ".select_category", function(){
							$("#select_cetegory_target").val($(this).data("target"));
							var id = $(this).data("id");
							$("#target_categ_id").val(id);
							$("#target_categ_name").val($("#categ_name"+id).html());
							$("#container_tree").show();
							$("#container_back").show();
						});
						$(document).on("click", ".close_tree", function(){
							$("#container_tree").hide();
							$("#container_back").hide();
						});
						$(document).on("click", "#container_back", function(){
							$("#container_tree").hide();
							$("#container_back").hide();
						});
					</script>
						<input type="hidden" value="" id="category" class="selected_category">
						<div id="container_back"></div>
						<style>
							#container_back{width: 100%;height: 100%;z-index:11001;opacity: 0.7;display: none;position: fixed;background-color: gray;top:0;left:0;}
							#container_tree{    z-index: 11001;}
						</style>
					';				
		
        $Types = array();
        $Types[0] = array("id"=>0,"name"=>"Главная");
        //=======================================================================
            $sql = 'SELECT C.category_id AS id, C.parent_id, CD.name, A.keyword
                            FROM `'.DB_PREFIX.'category` C
                            LEFT JOIN `'.DB_PREFIX.'category_description` CD ON C.category_id = CD.category_id
                            LEFT JOIN `'.DB_PREFIX.'url_alias` A ON A.query = CONCAT("category_id=",CD.category_id)
                            WHERE parent_id = "0" ORDER BY name ASC;';
            //echo '<br>'.$sql;
            $rs = $this->db->query($sql);
            
            $body .= "
                    <input type='hidden' id=\"target_categ_id\" value='0'>
                    <input type='hidden' id=\"target_categ_name\" value=''>
                    <div id=\"container_tree\" class = \"product-type-tree\">
                        <h4>Выбрать категорию <span class='close_tree'>[закрыть]</span></h4><ul  id=\"celebTree\">
                ";
            foreach ($rs->rows as $Type) {
        
            if($Type['parent_id'] == 0){
                
                $body .=  "<li><span id=\"span_".$Type['id']."\"> <a class = \"tree category_id_".$Type['id']."\" href=\"javascript:;\" id=\"".$Type['id']."\">".$Type['name']."</a>";
                $body .= "</span>".$this->readTree($Type['id']);
                $body .= "</li>";
            }
            $Types[$Type['id']]['id'] = $Type['id'];
            $Types[$Type['id']]['name'] = $Type['name'];
            }
            $body .= "</ul>
                </li></ul></div>";
        
            return $body;
	}                
    //Рекурсия=================================================================
    protected function readTree($parent){
            $sql = 'SELECT C.category_id AS id, C.parent_id, CD.name, A.keyword
                        FROM `'.DB_PREFIX.'category` C
                        LEFT JOIN `'.DB_PREFIX.'category_description` CD ON C.category_id = CD.category_id
                        LEFT JOIN `'.DB_PREFIX.'url_alias` A ON A.query = CONCAT("category_id=",CD.category_id)
                        WHERE parent_id = "'.$parent.'" ORDER BY name ASC;';
                
            $rs = $this->db->query($sql);
        
            $body = "";
        
           foreach ($rs->rows as $Type) {
        
                //Посчитаем сколько есть описаний
                $sql = 'SELECT count(id) AS total FROM `'.DB_PREFIX.'alias_description` WHERE url LIKE "%'.$Type['keyword'].'";';
                
             
                $body .=  "<li><span id=\"span_".$Type['id']."\"><a class = \"tree category_id_".$Type['id']."\" href=\"javascript:;\" id=\"".$Type['id']."\">".$Type['name']."</a>";
                $body .= "</span>".$this->readTree($Type['id']);
                $body .= "</li>";
            }
            if($body != "") $body = "<ul>$body</ul>";
            return $body;
        
    }
        

}