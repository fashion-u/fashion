<?php
class ModelCatalogManufacturer extends Model {
	public function getManufacturer($manufacturer_id) {
		$sql = "SELECT m.*,
											ua.keyword,
											md.description,
											md.meta_title,
											md.meta_description,
											md.meta_keyword
											FROM " . DB_PREFIX . "manufacturer m
									LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id)
									LEFT JOIN " . DB_PREFIX . "url_alias ua ON ua.query = CONCAT('manufacturer_id=',m.manufacturer_id)
									LEFT JOIN " . DB_PREFIX . "manufacturer_description md ON (m.manufacturer_id = md.manufacturer_id) 
									WHERE m.manufacturer_id = '" . (int)$manufacturer_id . "'
									/*AND m2s.store_id = '" . (int)$this->config->get('config_store_id') . "'*/
									";
		$query = $this->db->query($sql);

		return $query->row;
	}

	
	public function getManufacturerBanner() {
		$items = 7;
		
		$sql = "SELECT manufacturer_id FROM " . DB_PREFIX . "manufacturer  WHERE enable='1';";
		$query = $this->db->query($sql);
		$rows = array();
		
		if($query->num_rows < 7){
			return false;	
		}
		
		foreach($query->rows as $row){
			$rows[$row['manufacturer_id']] = $row['manufacturer_id'];
		}
		
		$ids = array();
		while($items > 0){
			$id = array_rand($rows);
			unset($rows[$id]);
			$ids[] = $id;
			$items--;
		}
		
		$sql = "SELECT * FROM " . DB_PREFIX . "manufacturer  WHERE manufacturer_id IN (".implode(',',$ids).");";
	
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	public function getManufacturers($data = array()) {
		if ($data) {
			$sql = "SELECT m.*,
							ua.keyword,
							md.description,
							md.meta_title,
							md.meta_description,
							md.meta_keyword
						FROM " . DB_PREFIX . "manufacturer m
						LEFT JOIN " . DB_PREFIX . "manufacturer_description md ON (m.manufacturer_id = md.manufacturer_id)
						LEFT JOIN " . DB_PREFIX . "url_alias ua ON ua.query = CONCAT('manufacturer_id=',m.manufacturer_id)
									
						WHERE enable='1' ";

			$sort_data = array(
				'name',
				'sort_order'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY name";
			}

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
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

			$query = $this->db->query($sql);

			return $query->rows;
		} else {
		
			$manufacturer_data = $this->cache->get('manufacturer.' . (int)$this->config->get('config_store_id'));

			if (!$manufacturer_data) {
				$sql = "SELECT m.*, ua.keyword FROM " . DB_PREFIX . "manufacturer m
									LEFT JOIN " . DB_PREFIX . "url_alias ua ON ua.query = CONCAT('manufacturer_id=',m.manufacturer_id)
									 ORDER BY name";
				$query = $this->db->query($sql);

				$manufacturer_data = $query->rows;

				$this->cache->set('manufacturer.' . (int)$this->config->get('config_store_id'), $manufacturer_data);
			}

			return $manufacturer_data;
		}
	}
}