<?php
class ModelCatalogShops extends Model {
	public function getShop($shop_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "shops WHERE id = '$shop_id' LIMIT 0,1");

		return $query->row;
	}

	public function getShops() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "shops WHERE enable='1' AND id > 0 ORDER BY name");

		return $query->rows;
	}
	public function getIgnoreClickIpList($shop_id) {
			$query = $this->db->query("SELECT ip FROM " . DB_PREFIX . "shops_ignore_click_ip WHERE shop_id = '" . (int)$shop_id . "'") or die('11');
			
			$return = array();
			foreach($query->rows as $row){
				$return[$row['ip']] = $row['ip'];
			}
		return $return;
	}

	public function getShopMoneySumm($shop_id) {
		$query = $this->db->query("SELECT SUM(`money_summ`) as summ FROM " . DB_PREFIX . "shops_money WHERE shop_id = '".$shop_id."'");
		
		$return = 0;
		if($query->num_rows){
			$return = $query->row['summ'];
		}
		return $return;
	}


}