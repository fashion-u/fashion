<?php
class ModelCatalogProduct extends Model {
	public function updateViewed($product_id, $source = 0) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET viewed = (viewed + 1) WHERE product_id = '" . (int)$product_id . "'");
	}
	public function getProductCategories($product_id) {
			
			$category_ids = array();
			
			$sql = 'SELECT category_id FROM ' . DB_PREFIX . 'product_to_category WHERE product_id = "'.$product_id.'";';
			$query = $this->db->query($sql);
			
			if($query->num_rows){
				
				foreach($query->rows as $row){
					$category_id = $row['category_id'];
				
					$sql = "SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id ) WHERE cp.category_id = c.category_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.category_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int)$category_id . "') AS keyword FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (c.category_id = cd2.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";
					$query1 = $this->db->query($sql);
					
					if($query1->num_rows){
						$category_ids[$row['category_id']] = $query1->row['path'];
					}
					
				}
			}

		return $category_ids;
	}

	public function uppProduct($product_id, $source = 0) {
		
		$user_key = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
		
		$sql = 'UPDATE ' . DB_PREFIX . 'product SET count_view = count_view + 1 WHERE product_id = "'.(int)$product_id.'";';
		$this->db->query($sql);
		
		$sql = 'INSERT INTO ' . DB_PREFIX . 'product_views_users SET
						hasp = "'.$user_key.'",
						customer_id = "'.$this->customer->isLogged().'",
						ip = "'.$_SERVER['REMOTE_ADDR'].'",
						agent = "'.$_SERVER['HTTP_USER_AGENT'].'"
					ON DUPLICATE KEY UPDATE ip = "'.$_SERVER['REMOTE_ADDR'].'";';
		$this->db->query($sql);
		
		$date = date('Y-m-d H:i:s');
		$sql = 'INSERT INTO ' . DB_PREFIX . 'product_views SET
						user = "'.$user_key.'",
						customer_id = "'.$this->customer->isLogged().'",
						product_id = "'.$product_id.'",
						source="'.$source.'",
						date = "'.$date.'";';
		$this->db->query($sql) or die($sql);
		
	}
	
	public function getProductUniqueClicks($product_id){
		
		$sql = 'SELECT COUNT(id) FROM ' . DB_PREFIX . 'product_views WHERE
						product_id = "'.$product_id.'"
						GROUP BY user;';
		$r = $this->db->query($sql) or die(' product.php');
		
		if($r->num_rows){
			return $r->num_rows;
		}
		
		return 0;
	}
	
	public function getProductClicksList($product_id, $key = 'not_unique'){
		
		$sql = 'SELECT PV.date, PVU.ip
					FROM ' . DB_PREFIX . 'product_views PV 
					LEFT JOIN ' . DB_PREFIX . 'product_views_users PVU ON PVU.hasp = PV.user
					WHERE product_id = "'.$product_id.'"
					';
		
		if($key == 'unique'){
			$sql .= ' GROUP BY PV.user';	
		}
		
		$sql .= ' ORDER BY PVU.ip DESC';
		
		
		$r = $this->db->query($sql) or die(' product.php');
		
		if($r->num_rows){
			return $r->rows;
		}
		
		return array();
	}
	
	public function getViewedProducts() {
		
		if(!$this->customer->isLogged()) return array('-1'=>'-1');
		
		$user_key = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
		
		$sql = 'SELECT product_id FROM ' . DB_PREFIX . 'product_views WHERE
						customer_id = "'.$this->customer->isLogged().'"
						ORDER BY date DESC;';
		$r = $this->db->query($sql) or die(' product.php');
		
		if($r->num_rows){
			$return = array();
			$count = 0;
			foreach($r->rows as $row){
				$return[$count++] = $row['product_id'];
			}
			return $return;
		}
		
		return array('-1'=>'-1');
		
	}

	public function getViewedIds() {
		
		if(!$this->customer->isLogged()) return array('-1'=>'-1');
		
		$user_key = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
		
		$sql = 'SELECT id FROM ' . DB_PREFIX . 'product_views WHERE
						customer_id = "'.$this->customer->isLogged().'"
						ORDER BY date DESC;';
		//echo $sql;				
		$r = $this->db->query($sql) or die(' product.php');
		
		if($r->num_rows){
			$return = array();
			$count = 0;
			foreach($r->rows as $row){
				$return[$count++] = $row['id'];
			}
			return $return;
		}
		
		return array('-1'=>'-1');
		
	}

	public function getTotalViewedProducts() {
		
		if(!$this->customer->isLogged()) return 0;
		
		$user_key = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
		
		$sql = 'SELECT COUNT(product_id) AS total FROM ' . DB_PREFIX . 'product_views WHERE
						customer_id = "'.$this->customer->isLogged().'"
						;';
		$r = $this->db->query($sql) or die(' product.php');
		
		if($r->num_rows){
			return $r->row['total'];
		}
		
		return 0;
		
	}
	public function addLovedProduct($product_id) {
		
		if(!$this->customer->isLogged()) return 0;
		
		$user_key = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
		
		$sql = 'INSERT INTO ' . DB_PREFIX . 'product_views_users SET
						hasp = "'.$user_key.'",
						customer_id = "'.$this->customer->isLogged().'",
						ip = "'.$_SERVER['REMOTE_ADDR'].'",
						agent = "'.$_SERVER['HTTP_USER_AGENT'].'"
					ON DUPLICATE KEY UPDATE ip = "'.$_SERVER['REMOTE_ADDR'].'";';
		$this->db->query($sql);
		
		$sql = 'INSERT INTO ' . DB_PREFIX . 'product_loved SET
						user = "'.$user_key.'",
						customer_id = "'.$this->customer->isLogged().'",
						product_id = "'.$product_id.'"
						ON DUPLICATE KEY UPDATE product_id = "'.$product_id.'";';
		$this->db->query($sql) or die($sql);
		
		return $this->getTotalLovedProducts();
		
	}

	public function dellLovedProduct($product_id) {
		
		if(!$this->customer->isLogged()) return 0;
		
		$user_key = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
		
		$sql = 'DELETE FROM ' . DB_PREFIX . 'product_loved WHERE
						customer_id = "'.$this->customer->isLogged().'"
						AND
						product_id = "'.$product_id.'";';
		$this->db->query($sql) or die($sql);
		
		return $this->getTotalLovedProducts();
		
	}

	public function getLovedProducts() {
		
		if(!$this->customer->isLogged()) return array('-1'=>'-1');
		
		$user_key = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
		
		$sql = 'SELECT DISTINCT product_id FROM ' . DB_PREFIX . 'product_loved WHERE
						customer_id = "'.$this->customer->isLogged().'"
						ORDER BY id DESC;';
		$r = $this->db->query($sql) or die(' product.php');
		
		if($r->num_rows){
			$return = array();
			foreach($r->rows as $row){
				$return[$row['product_id']] = $row['product_id'];
			}
			return $return;
		}
	
		return array('-1'=>'-1');
		
	}

	public function getTotalLovedProducts() {
		
		if(!$this->customer->isLogged()) return 0;
		
		$user_key = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
		
		$sql = 'SELECT COUNT(DISTINCT product_id) AS total FROM ' . DB_PREFIX . 'product_loved WHERE
						customer_id = "'.$this->customer->isLogged().'"
						;';
		$r = $this->db->query($sql) or die(' product.php');
		
		if($r->num_rows){
			return $r->row['total'];
		}
		
		return 0;
		
	}
	public function getProductAlias($product_id = 0) {
			
		$sql = 'SELECT keyword FROM '. DB_PREFIX .'url_alias WHERE `query` = "product_id='.$product_id.'" LIMIT 0,1;';
		$r1 = $this->db->query($sql);
		if($r1->num_rows){
			return 'product/view/'.$r1->row['keyword'];
		}
		return '';
		
	}	
	public function getProduct($product_id, $data = array()) {
		/*
		$sql = "SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.#status GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.#status GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.#status AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		*/
		$status = "status='1'";
		if(isset($data['status'])){
			if(is_numeric($data['status'])){
				$status = "status='".(int)$data['status']."'";
			}else{
				$status = "status >= '0'";
			}
		}
		
		$sql = "SELECT DISTINCT *, p.old_price, p2c.category_id, pl.id AS loved, pd.name AS name, p.image, m.name AS manufacturer, ua.keyword AS manufacturer_href,
							(SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount,
							(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special,
							(SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.$status GROUP BY r1.product_id) AS rating,
							(SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status,
							p.sort_order,
							s.id AS shop_id,
							s.name AS shop_name,
							s.href AS shop_href,
							pml.money_limit,
							pclik.money_click
						FROM " . DB_PREFIX . "product p
						LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
						LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)
						LEFT JOIN " . DB_PREFIX . "product_loved pl ON (p.product_id = pl.product_id AND customer_id > 0 AND customer_id = '".$this->customer->isLogged()."')
						LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id)
						LEFT JOIN " . DB_PREFIX . "url_alias ua ON ua.query = CONCAT('manufacturer_id=',m.manufacturer_id)
						LEFT JOIN " . DB_PREFIX . "product_to_shop p2sh ON (p.product_id = p2sh.product_id)
						LEFT JOIN " . DB_PREFIX . "shops s ON (s.id = p2sh.shop_id)
						LEFT JOIN " . DB_PREFIX . "product_money_limit pml ON (p.product_id = pml.money_product_id)
						LEFT JOIN " . DB_PREFIX . "product_money_click pclik ON (p.product_id = pclik.click_product_id)
						
						WHERE p.product_id = '" . (int)$product_id . "' AND p.$status AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
	
		$query = $this->db->query($sql);

		//Получим размеры
		$sql = "SELECT	S.size_id,
						S.name AS size_name,
						SG.name AS group_name,
						SG.filter_name AS filter_group_name,
						SG.id AS group_id
					FROM " . DB_PREFIX . "product_to_size P2S
					LEFT JOIN " . DB_PREFIX . "size S ON P2S.size_id = S.size_id
					LEFT JOIN " . DB_PREFIX . "size_group SG ON SG.id = S.group_id
						
					WHERE P2S.product_id='".(int)$product_id."'
					ORDER BY S.sort ASC
						;";
		//echo '<br>'.$sql;
		$r_s = $this->db->query($sql);
		$size = array();
		if($r_s->num_rows > 0){
			foreach($r_s->rows as $row){
				$size[$row['size_id']] = $row;
			}
		}
	
		if ($query->num_rows) {
			return array(
				'product_id'       => $query->row['product_id'],
				'category_id'       => $query->row['category_id'],
				'loved'       		=> $query->row['loved'],
				'name'             => $query->row['name'],
				'count_view'             => $query->row['count_view'],
				'description'      => $query->row['description'],
				'moderation_id'      => $query->row['moderation_id'],
				'original_url'      => $query->row['original_url'],
				'original_code'      => $query->row['original_code'],
				'meta_title'       => $query->row['meta_title'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],
				'shop_id'     => $query->row['shop_id'],
				'shop_name'     => $query->row['shop_name'],
				'shop_href'     => $query->row['shop_href'],
				'money_limit'     => ($query->row['money_limit'] > 0) ? $query->row['money_limit'] : 0,
				'money_click'     => ($query->row['money_click'] > 0) ? $query->row['money_click'] : 0,
				'tag'              => $query->row['tag'],
				'size'              => $size,
				'model'            => $query->row['model'],
				'sku'              => $query->row['sku'],
				'upc'              => $query->row['upc'],
				'ean'              => $query->row['ean'],
				'jan'              => $query->row['jan'],
				'isbn'             => $query->row['isbn'],
				'mpn'              => $query->row['mpn'],
				'location'         => $query->row['location'],
				'quantity'         => $query->row['quantity'],
				'stock_status'     => $query->row['stock_status'],
				'image'            => $query->row['image'],
				'manufacturer_id'  => $query->row['manufacturer_id'],
				'manufacturer'     => $query->row['manufacturer'],
				'manufacturer_href'     => $query->row['manufacturer_href'],
				'price'            => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
				'old_price'          => $query->row['old_price'],
				'sale'          => $query->row['sale'],
				'click_price'          => $query->row['click_price'],
				'special'          => $query->row['special'],
				'reward'           => 0 /*$query->row['reward']*/,
				'points'           => $query->row['points'],
				'tax_class_id'     => $query->row['tax_class_id'],
				'date_available'   => $query->row['date_available'],
				'weight'           => $query->row['weight'],
				'weight_class_id'  => $query->row['weight_class_id'],
				'length'           => $query->row['length'],
				'width'            => $query->row['width'],
				'height'           => $query->row['height'],
				'length_class_id'  => $query->row['length_class_id'],
				'subtract'         => $query->row['subtract'],
				'rating'           => round($query->row['rating']),
				'reviews'          => 0 /*$query->row['reviews'] ? $query->row['reviews'] : 0*/,
				'minimum'          => $query->row['minimum'],
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'date_modified'    => $query->row['date_modified'],
				'viewed'           => $query->row['viewed']
			);
		} else {
			return false;
		}
	}

	public function getProducts($data = array()) {
		/*
		$sql = "SELECT p.product_id, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.#status GROUP BY r1.product_id) AS rating, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special";
*/
		
		
		$status = "status='1'";
		if(isset($data['status'])){
			if(is_numeric($data['status'])){
				$status = "status='".(int)$data['status']."'";
			}else{
				$status = "status >= '0'";
			}
		}
		
		$filds = '';
		if (isset($data['lovedproducts'])) {
			$product_ids = $this->getLovedProducts();
		}elseif (isset($data['lastviewed'])) {
			$product_ids = $viewed = $this->getViewedIds();
			$filds = 'pv.date,';
		}
		
	
		$sql = "SELECT p.product_id, $filds p2c.category_id, MIN(p.price) AS min_price, 
				(SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.$status GROUP BY r1.product_id) AS rating,
				(SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id  AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount,
				(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special";

		//Если это последние просмотренные
		if (isset($data['lastviewed'])){
		
			$sql .= " FROM " . DB_PREFIX . "product_views pv ";
			$sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (pv.product_id = p.product_id)";
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (pv.product_id = p2c.product_id)";
		
		}elseif (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "category_path cp
						LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id)
						LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
			}
		} else {
			$sql .= " FROM " . DB_PREFIX . "product p
					LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";
		}
	
	
		if(isset($data['my_accont'])){
			
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_money_limit pml ON (p.product_id = pml.money_product_id)";
			//$sql .= " LEFT JOIN " . DB_PREFIX . "product_money_click pclik ON (p.product_id = pclik.click_product_id)";
				
		}
		
	
		//Фильтр по размерам
		if (!empty($data['filter_sizes']) AND count($data['filter_sizes']) > 0) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_size p2size ON (p.product_id = p2size.product_id)";
		}
		
		//Фильтр по атрибутам
		if (!empty($data['filter_attributes']) AND count($data['filter_attributes']) > 0) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_attribute p2a ON (p.product_id = p2a.product_id)";
		}
		
		//Фильтр по магазину
		if (isset($data['filter_shop_id']) AND (int)($data['filter_shop_id']) > 0) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_shop p2sh ON (p.product_id = p2sh.product_id)";
		}
		
		
		
		$sql .= "
					LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
					LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
					WHERE p.moderation_id = 0
						AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
						AND p.$status
						AND p.date_available <= NOW()
						AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ";
						
		if(isset($data['filter_price'])	AND is_array($data['filter_price'])){
			$sql .= "AND p.price >= '".$data['filter_price']['price_from']."'
					AND p.price <= '".$data['filter_price']['price_to']."' ";
		}
		
		//Фильтр по размерам
		if (!empty($data['filter_sizes']) AND count($data['filter_sizes']) > 0) {
			$sql .= " AND p2size.size_id IN (" . $this->db->escape($data['filter_sizes']) . ")";
		}
		//end Фильтр по размерам

		//Фильтр по магазину
		if (isset($data['filter_shop_id']) AND (int)($data['filter_shop_id']) > 0) {
			$sql .= ' AND p2sh.shop_id = '.(int)($data['filter_shop_id']).'';
		}
		
		//Фильтр по атрибутам
		$products = array();
		$filter_sort = false;
		if (!empty($data['filter_attributes']) AND count($data['filter_attributes']) > 0) {
			if(is_array($data['filter_attributes'])){
				
				foreach($data['filter_attributes'] as $index => $group_items){
					
					//Есть фильтр по скидке
					if(in_array(580, $group_items)){
						$filter_sort = true;
					}
	
					
					$sql1 = "SELECT DISTINCT product_id FROM " . DB_PREFIX . "product_attribute WHERE attribute_id IN (" . implode(',', $group_items) . ") ";
					if(count($products) > 0) $sql1 .= " AND product_id IN (" . implode(',', $products) . ") ";
					$sql1 .= ' GROUP BY product_id';
					
					$query = $this->db->query($sql1);
	
					if($query->num_rows){
						$products = array();
						foreach($query->rows as $row){
							$products[$row['product_id']] = $row['product_id'];
						}
					}
				
				}
				
			}

	
			if(count($products) > 0){
				$sql .= ' AND p.product_id IN ('.implode(',', $products).')';
			}
		}
		//end Фильтр по атрибутам

		if(isset($product_ids) AND count($product_ids) > 0){
			if (isset($data['lastviewed'])){
				$sql .= ' AND pv.id IN ('.implode(',', $product_ids).')';
			}else{
				$sql .= ' AND p.product_id IN ('.implode(',', $product_ids).')';
			}
		}
		
		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				$implode = array();

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
			}
		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "pd.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$sql .= " GROUP BY p.product_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'p.quantity',
			'p.price',
			'rating',
			'p.sort_order',
			'p.date_added'
		);

		if (isset($data['lastviewed'])) {
		
			$sql .= " ORDER BY pv.date DESC";
		
		}elseif ($filter_sort){ 
			$sql .= " ORDER BY p.sale DESC, pd.name";
		}elseif (isset($data['sort'])){ // && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model' || $data['sort'] == 'p.viewed') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'pd.name_Z') {
				$sql .= " ORDER BY pd.name DESC";
			
			} elseif ($data['sort'] == 'sort_limit_asc') {
				$sql .= " ORDER BY pml.money_limit ASC";
			} elseif ($data['sort'] == 'sort_limit_desc') {
				$sql .= " ORDER BY pml.money_limit DESC";
			
			/*
			} elseif ($data['sort'] == 'sort_clicks_asc') {
				$sql .= " ORDER BY pclik.money_click ASC";
			} elseif ($data['sort'] == 'sort_clicks_desc') {
				$sql .= " ORDER BY pclik.money_click DESC";
			*/
			} elseif ($data['sort'] == 'sort_clicks_asc') {
				$sql .= " ORDER BY p.click_price ASC";
			} elseif ($data['sort'] == 'sort_clicks_desc') {
				$sql .= " ORDER BY p.click_price DESC";
			
			} elseif ($data['sort'] == 'p.price_Z') {
				$sql .= " ORDER BY (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END) DESC";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END)";
			} else {
				
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.click_price DESC, p.price ASC, pd.name ASC";
		}
		

		/*
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
		}
		*/

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$product_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$product_data[$result['product_id']] = $this->getProduct($result['product_id'], $data);
			
			if (isset($data['lastviewed'])) {
				$product_data[$result['product_id']]['viewed'] = date('Y-m-d', strtotime($result['date']));
			}
		}
//echo '<hr>'.$sql;
		return $product_data;
	}

	public function getProductSpecials($data = array()) {
		
		$status = "status='1'";
		if(isset($data['status'])){
			if(is_numeric($data['status'])){
				$status = "status='".(int)$data['status']."'";
			}else{
				$status = "status >= '0'";
			}
		}
		
		$sql = "SELECT DISTINCT ps.product_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.$status GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id)
		LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.$status AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND  p.moderation_id = 0 AND  (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) GROUP BY ps.product_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'ps.price',
			'rating',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$product_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
		}

		return $product_data;
	}

	public function getLatestProducts($limit) {
		$product_data = $this->cache->get('product.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);

		if (!$product_data) {
			$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p
									  LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.#status AND p.date_available <= NOW() AND  p.moderation_id = 0 AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
									  ORDER BY p.date_added DESC LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
			}

			$this->cache->set('product.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data);
		}

		return $product_data;
	}

	public function getPopularProducts($limit) {
		$product_data = array();

		$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE  p.moderation_id = 0 AND p.#status AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.viewed DESC, p.date_added DESC LIMIT " . (int)$limit);

		foreach ($query->rows as $result) {
			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
		}

		return $product_data;
	}

	public function getBestSellerProducts($limit) {
		$product_data = $this->cache->get('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);

		if (!$product_data) {
			$product_data = array();

			$query = $this->db->query("SELECT op.product_id, SUM(op.quantity) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE  p.moderation_id = 0 AND o.order_status_id > '0' AND p.#status AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
			}

			$this->cache->set('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data);
		}

		return $product_data;
	}

	public function getProductAttributes($product_id) {
		$product_attribute_group_data = array();

		$product_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, agd.name FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) WHERE pa.product_id = '" . (int)$product_id . "' AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, agd.name");

		foreach ($product_attribute_group_query->rows as $product_attribute_group) {
			$product_attribute_data = array();

			$product_attribute_query = $this->db->query("SELECT a.attribute_id, ad.name, pa.text FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.product_id = '" . (int)$product_id . "' AND a.attribute_group_id = '" . (int)$product_attribute_group['attribute_group_id'] . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name");

			foreach ($product_attribute_query->rows as $product_attribute) {
				$product_attribute_data[] = array(
					'attribute_id' => $product_attribute['attribute_id'],
					'name'         => $product_attribute['name'],
					'text'         => $product_attribute['text']
				);
			}

			$product_attribute_group_data[] = array(
				'attribute_group_id' => $product_attribute_group['attribute_group_id'],
				'name'               => $product_attribute_group['name'],
				'attribute'          => $product_attribute_data
			);
		}

		return $product_attribute_group_data;
	}

	public function getProductOptions($product_id) {
		$product_option_data = array();

		$product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

		foreach ($product_option_query->rows as $product_option) {
			$product_option_value_data = array();

			$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order");

			foreach ($product_option_value_query->rows as $product_option_value) {
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'name'                    => $product_option_value['name'],
					'image'                   => $product_option_value['image'],
					'quantity'                => $product_option_value['quantity'],
					'subtract'                => $product_option_value['subtract'],
					'price'                   => $product_option_value['price'],
					'price_prefix'            => $product_option_value['price_prefix'],
					'weight'                  => $product_option_value['weight'],
					'weight_prefix'           => $product_option_value['weight_prefix']
				);
			}

			$product_option_data[] = array(
				'product_option_id'    => $product_option['product_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],
				'value'                => $product_option['value'],
				'required'             => $product_option['required']
			);
		}

		return $product_option_data;
	}

	public function getProductDiscounts($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity ASC, priority ASC, price ASC");

		return $query->rows;
	}

	public function getProductImages($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getProductRelated($product_id) {
		$product_data = array();

		$sql = "SELECT * FROM " . DB_PREFIX . "product_related pr LEFT JOIN " . DB_PREFIX . "product p ON (pr.related_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pr.product_id = '" . (int)$product_id . "' AND p.#status AND p.moderation_id = 0 AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		$query = $this->db->query($sql);
echo $sql;
		foreach ($query->rows as $result) {
			$product_data[$result['related_id']] = $this->getProduct($result['related_id']);
		}

		return $product_data;
	}

	public function getProductLayoutId($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}

	public function getCategories($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

		return $query->rows;
	}

	public function getSuperViewProduct($limit, $shop_id = 0) {
		
		if($shop_id == 0){
			$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product ORDER BY viewed DESC LIMIT 0, $limit");
		}else{
			$query = $this->db->query("SELECT P.product_id FROM " . DB_PREFIX . "product P
											LEFT JOIN " . DB_PREFIX . "product_to_shop P2S ON P2S.product_id = P.product_id
											WHERE P2S.shop_id = '$shop_id' ORDER BY P.viewed DESC LIMIT 0, $limit");
		}

		return $query->rows;
	}
	
	public function getProductsTags($product_ids) {
		
		$data = array(
					'@min_price@' => '0.00',
					'@shops_count@' => '0',
					'@products_count@' => count($product_ids),
					'@design_count@' => '0',
					'@prev_year@' => date('Y', strtotime('-1 year')),
					'@now_year@' => date('Y'),
					'@next_year@' => date('Y', strtotime('+1 year')), 
					'@dinamic_year@' => '',
					'@city@' => '',
					'@sity_to@' => '',
					'@city_on@' => '',
					'@city_rod@' => ''
					  );
		
		if(date('Y-m-d') < date('Y-m-d', strtotime(date('Y').'-07-01'))){
			$data['@dinamic_year@'] = $data['@prev_year@'].' - '.$data['@now_year@'];
		}else{
			$data['@dinamic_year@'] = $data['@now_year@'].' - '.$data['@next_year@'];
		}
		
		$domain = explode('.', $_SERVER['HTTP_HOST']);
		
		//moscow
		if($domain[0] == 'shopsplum' OR $domain[0] == '') $domain[0] = 'moscow';
		$sql = 'SELECT * FROM ' . DB_PREFIX . 'citys WHERE Domain LIKE "'.$domain[0].'" LIMIT 0, 1;';
		
		$r = $this->db->query($sql);
		
		if($r->num_rows > 0){
			$row = $r->row;
			
			$data['@city@'] = $row['CityLable'];
			$data['@sity_to@'] = $row['CityLableKuda'];
			$data['@city_on@'] = $row['CityLablePoChemu'];
			$data['@city_rod@'] = $row['CityLableChego'];
	
			$data['@Region@'] = $row['Region'];
			$data['@poRegionu@'] = $row['poRegionu'];
			$data['@ChegoRegiona@'] = $row['ChegoRegiona'];
			$data['@People@'] = $row['People'];
			$data['@LitlleCity@'] = $row['LitlleCity'];
			$data['@KodGoroda@'] = $row['KodGoroda'];
			$data['@Population@'] = $row['Population'];
	
		}
		
		$data['@DateandTime@'] = date('Y-m-d H:i:s');
		   
		
		if(count($product_ids) > 0){
		
			//Price
			$sql = 'SELECT min(price) as min_price FROM ' . DB_PREFIX . 'product WHERE product_id IN ('.implode(',', $product_ids).')';
			$r = $this->db->query($sql);
			if($r->num_rows){
				$data['@min_price@'] = number_format($r->row['min_price'], 0, '.','');
			}
			
			//Дизайнеры
			$sql = 'SELECT COUNT(DISTINCT manufacturer_id) as manufacturer FROM ' . DB_PREFIX . 'product WHERE product_id IN ('.implode(',', $product_ids).')';
			$r = $this->db->query($sql);
			if($r->num_rows){
				$data['@design_count@'] = $r->row['manufacturer'];
			}
			
			//Магазины
			$sql = 'SELECT COUNT(DISTINCT shop_id) as shops FROM ' . DB_PREFIX . 'product_to_shop WHERE product_id IN ('.implode(',', $product_ids).')';
			$r = $this->db->query($sql);
			if($r->num_rows){
				$data['@shops_count@'] = $r->row['shops'];
			}
		}
		
		return $data;
		
	}
	
	public function getTotalProducts($data = array()) {
		$status = "status='1'";
		if(isset($data['status'])){
			if(is_numeric($data['status'])){
				$status = "status='".(int)$data['status']."'";
			}else{
				$status = "status >= '0'";
			}
		}
		
		$sql = "SELECT COUNT(DISTINCT p.product_id) AS total ";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
			}
		} else {
			$sql .= " FROM " . DB_PREFIX . "product p";
		}
		
		//Фильтр по размерам
		if (!empty($data['filter_sizes']) AND count($data['filter_sizes']) > 0) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_size p2size ON (p.product_id = p2size.product_id)";
		}
	
		//Фильтр по атрибутам
		if (!empty($data['filter_attributes']) AND count($data['filter_attributes']) > 0) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_attribute p2a ON (p.product_id = p2a.product_id)";
		}
		
		//Фильтр по магазину
		if (isset($data['filter_shop_id']) AND (int)($data['filter_shop_id']) > 0) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_shop p2sh ON (p.product_id = p2sh.product_id)";
		}
		
			
		$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND  p.moderation_id = 0 AND p.$status AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		
		//Цена
		if(isset($data['filter_price'])	AND is_array($data['filter_price'])){
			$sql .= "AND p.price >= '".$data['filter_price']['price_from']."'
					AND p.price <= '".$data['filter_price']['price_to']."' ";
		}
		

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				$implode = array();

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
			}
		}

		//Фильтр по размерам
		if (!empty($data['filter_sizes']) AND count($data['filter_sizes']) > 0) {
			$sql .= " AND p2size.size_id IN (" . $this->db->escape($data['filter_sizes']) . ")";
		}
	
		//Фильтр по магазину
		if (isset($data['filter_shop_id']) AND (int)($data['filter_shop_id']) > 0) {
			$sql .= ' AND p2sh.shop_id = '.(int)($data['filter_shop_id']).'';
		}
	
		//Фильтр по атрибутам
		$products = array();
		if (!empty($data['filter_attributes']) AND count($data['filter_attributes']) > 0) {
			if(is_array($data['filter_attributes'])){
				
				foreach($data['filter_attributes'] as $group_items){
					
					$sql1 = "SELECT DISTINCT product_id FROM " . DB_PREFIX . "product_attribute WHERE attribute_id IN (" . implode(',', $group_items) . ") ";
					if(count($products) > 0) $sql1 .= " AND product_id IN (" . implode(',', $products) . ") ";
					$sql1 .= ' GROUP BY product_id';
					
					$query = $this->db->query($sql1);
					
					if($query->num_rows){
						$products = array();
						foreach($query->rows as $row){
							$products[] = $row['product_id'];
						}
					}
				
				}
				
			}
			
			if(count($products) > 0){
				$sql .= ' AND p.product_id IN ('.implode(',', $products).')';
			}
		}
		//end Фильтр по атрибутам



		
		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "pd.tag LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "%'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}

	public function getTotalProductIds($data = array()) {
		$status = "status='1'";
		if(isset($data['status'])){
			if(is_numeric($data['status'])){
				$status = "status='".(int)$data['status']."'";
			}else{
				$status = "status >= '0'";
			}
		}
		
		$sql = "SELECT DISTINCT p.product_id";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
			}
		} else {
			$sql .= " FROM " . DB_PREFIX . "product p";
		}

		//Фильтр по размерам
		if (!empty($data['filter_sizes']) AND count($data['filter_sizes']) > 0) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_size p2size ON (p.product_id = p2size.product_id)";
		}
			
		//Фильтр по атрибутам
		if (!empty($data['filter_attributes']) AND count($data['filter_attributes']) > 0) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_attribute p2a ON (p.product_id = p2a.product_id)";
		}
			
		$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND  p.moderation_id = 0 AND p.$status AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				$implode = array();

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
			}
		}

		//Цена
		if(isset($data['filter_price'])	AND is_array($data['filter_price'])){
			$sql .= "AND p.price >= '".$data['filter_price']['price_from']."'
					AND p.price <= '".$data['filter_price']['price_to']."' ";
		}
		
		//Фильтр по размерам
		if (!empty($data['filter_sizes']) AND count($data['filter_sizes']) > 0) {
			$sql .= " AND p2size.size_id IN (" . $this->db->escape($data['filter_sizes']) . ")";
		}

		//Фильтр по атрибутам
		$products = array();
		if (!empty($data['filter_attributes']) AND count($data['filter_attributes']) > 0) {
			if(is_array($data['filter_attributes'])){
				
				foreach($data['filter_attributes'] as $group_items){
					
					$sql1 = "SELECT DISTINCT product_id FROM " . DB_PREFIX . "product_attribute WHERE attribute_id IN (" . implode(',', $group_items) . ") ";
					if(count($products) > 0) $sql1 .= " AND product_id IN (" . implode(',', $products) . ") ";
					$sql1 .= ' GROUP BY product_id';
					
					$query = $this->db->query($sql1);
					
					if($query->num_rows){
						$products = array();
						foreach($query->rows as $row){
							$products[] = $row['product_id'];
						}
					}
				
				}
				
			}
			
			if(count($products) > 0){
				$sql .= ' AND p.product_id IN ('.implode(',', $products).')';
			}
		}
		//end Фильтр по атрибутам

		
		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "pd.tag LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "%'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$query = $this->db->query($sql);
//echo $sql;
	
		return $query->rows;
	}

	public function getTotalProductsInfo($data = array()) {
		
		$status = "status='1'";
		if(isset($data['status'])){
			if(is_numeric($data['status'])){
				$status = "status='".(int)$data['status']."'";
			}else{
				$status = "status >= '0'";
			}
		}
		$sql = "SELECT DISTINCT MAX(p.price) AS max_price , MIN(p.price) AS min_price ";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
			}
		} else {
			$sql .= " FROM " . DB_PREFIX . "product p";
		}

		//Фильтр по размерам
		if (!empty($data['filter_sizes']) AND count($data['filter_sizes']) > 0) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_size p2size ON (p.product_id = p2size.product_id)";
		}
			
		//Фильтр по атрибутам
		if (!empty($data['filter_attributes']) AND count($data['filter_attributes']) > 0) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_attribute p2a ON (p.product_id = p2a.product_id)";
		}
			
		$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND  p.moderation_id = 0 AND p.$status AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				$implode = array();

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
			}
		}

		//Фильтр по размерам
		if (!empty($data['filter_sizes']) AND count($data['filter_sizes']) > 0) {
			$sql .= " AND p2size.size_id IN (" . $this->db->escape($data['filter_sizes']) . ")";
		}

		//Фильтр по атрибутам
		$products = array();
		if (!empty($data['filter_attributes']) AND count($data['filter_attributes']) > 0) {
			if(is_array($data['filter_attributes'])){
				
				foreach($data['filter_attributes'] as $group_items){
					
					$sql1 = "SELECT DISTINCT product_id FROM " . DB_PREFIX . "product_attribute WHERE attribute_id IN (" . implode(',', $group_items) . ") ";
					if(count($products) > 0) $sql1 .= " AND product_id IN (" . implode(',', $products) . ") ";
					$sql1 .= ' GROUP BY product_id';
					
					$query = $this->db->query($sql1);
					
					if($query->num_rows){
						$products = array();
						foreach($query->rows as $row){
							$products[] = $row['product_id'];
						}
					}
				
				}
				
			}
			
			if(count($products) > 0){
				$sql .= ' AND p.product_id IN ('.implode(',', $products).')';
			}
		}
		//end Фильтр по атрибутам

		
		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "pd.tag LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "%'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$query = $this->db->query($sql);
//echo $sql;
		$return = array();
		$return['max_price'] = '';
		$return['min_price'] = '';
		
		foreach($query->rows as $row){

			$return['max_price'] = $row['max_price'];
			$return['min_price'] = $row['min_price'];
		
		}
		return $return;
	}

	
	public function getProfile($product_id, $recurring_id) {
		return $this->db->query("SELECT * FROM `" . DB_PREFIX . "recurring` `p` JOIN `" . DB_PREFIX . "product_recurring` `pp` ON `pp`.`recurring_id` = `p`.`recurring_id` AND `pp`.`product_id` = " . (int)$product_id . " WHERE `pp`.`recurring_id` = " . (int)$recurring_id . " AND `status` = 1 AND `pp`.`customer_group_id` = " . (int)$this->config->get('config_customer_group_id'))->row;
	}

	public function getProfiles($product_id) {
		return $this->db->query("SELECT `pd`.* FROM `" . DB_PREFIX . "product_recurring` `pp` JOIN `" . DB_PREFIX . "recurring_description` `pd` ON `pd`.`language_id` = " . (int)$this->config->get('config_language_id') . " AND `pd`.`recurring_id` = `pp`.`recurring_id` JOIN `" . DB_PREFIX . "recurring` `p` ON `p`.`recurring_id` = `pd`.`recurring_id` WHERE `product_id` = " . (int)$product_id . " AND  `status` = 1 AND `customer_group_id` = " . (int)$this->config->get('config_customer_group_id') . " ORDER BY `sort_order` ASC")->rows;
	}

	public function getTotalProductSpecials() {
		$status = "status='1'";
		if(isset($data['status'])){
			if(is_numeric($data['status'])){
				$status = "status='".(int)$data['status']."'";
			}else{
				$status = "status >= '0'";
			}
		}
		$query = $this->db->query("SELECT COUNT(DISTINCT ps.product_id) AS total FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE  p.moderation_id = 0 AND p.$status AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))");

		if (isset($query->row['total'])) {
			return $query->row['total'];
		} else {
			return 0;
		}
	}
	
	public function setProductStatus($product_id, $status_id) {
		
		$sql = 'SELECT status FROM ' . DB_PREFIX . 'product WHERE product_id = "'.(int)$product_id.'" LIMIT 0, 1;';
		$query = $this->db->query($sql);
		
		if($query->num_rows AND $query->row['status'] != '2'){
			$sql = 'UPDATE ' . DB_PREFIX . 'product SET status="'.(int)$status_id.'" WHERE product_id = "'.(int)$product_id.'" ';
			$this->db->query($sql);
		}
	}
	public function setProductMoneyLimit($product_id, $money_limit) {
		
		$sql = 'INSERT INTO ' . DB_PREFIX . 'product_money_limit SET
						money_product_id="'.(int)$product_id.'",
						money_limit = "'.(float)$money_limit.'",
						edit_date = "'.date('Y-m-d H:i:s').'",
						customer_id = "'.$this->customer->isLogged().'"
					ON DUPLICATE KEY UPDATE
						money_limit = "'.(float)$money_limit.'",
						edit_date = "'.date('Y-m-d H:i:s').'",
						customer_id = "'.$this->customer->isLogged().'";
						';
		$this->db->query($sql);
	
	}
	public function setProductMoneyClick($product_id, $money_click) {
		
		$sql = 'INSERT INTO ' . DB_PREFIX . 'product_money_click SET
						click_product_id="'.(int)$product_id.'",
						money_click = "'.(float)$money_click.'",
						edit_date = "'.date('Y-m-d H:i:s').'",
						customer_id = "'.$this->customer->isLogged().'"
					ON DUPLICATE KEY UPDATE
						money_click = "'.(float)$money_click.'",
						edit_date = "'.date('Y-m-d H:i:s').'",
						customer_id = "'.$this->customer->isLogged().'";
						';
		$this->db->query($sql);
		
		$sql = 'UPDATE ' . DB_PREFIX . 'product SET click_price = "'.(float)$money_click.'" WHERE product_id="'.(int)$product_id.'";';
		$this->db->query($sql);
	
	}
}
