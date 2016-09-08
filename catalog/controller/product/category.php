<?php
class ControllerProductCategory extends Controller {
	
	public function setHideMenuHelp(){
		
		setcookie('hide_menu_help', '1', time()+3600);
		
	}
	
	public function index() {
		$this->load->language('product/category');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');
	
		$this->load->model('catalog/attribute');

		$this->load->model('tool/image');

		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}
		
		$price = array('price_from'=>0, 'price_to'=>1000000);
		if (isset($this->request->get['price_from']) AND (int)$this->request->get['price_from'] > 0) {
			$price['price_from'] = (int)$this->request->get['price_from'];
		}
		if (isset($this->request->get['price_to']) AND (int)$this->request->get['price_to'] > 0) {
			$price['price_to'] = (int)$this->request->get['price_to'];
		}
		
//setcookie('hide_menu_help', '0', time()+3600);
		$data['selected_attributes'] = array();
		$attributes = array();
		if (isset($this->request->get['attributes'])) {
			
			$tmps = explode(',',$this->request->get['attributes']);
			
			if(count($tmps) > 0){	
				foreach($tmps as $tmp){
					$tmp = explode('*', $tmp);
					
					if(isset($tmp[1])){
						//Сортировки не участвуют в фильтре
						if((int)$tmp[1] != 169 AND (int)$tmp[1] != 168){
							$attributes[(int)$tmp[0]][(int)$tmp[1]] = (int)$tmp[1];
						}
						$data['selected_attributes'][(int)$tmp[1]] = (int)$tmp[1];
					}
				}
			}
			
		}
		
		if(isset($this->request->get['helikopter'])){
			$data['helikopter'] = (int)$this->request->get['helikopter'];
		}else{
			$data['helikopter'] = 0;
		}
		
		if(isset($this->request->get['_route_'])){
			$data['_route_'] = $this->request->get['_route_'];
		}else{
			$data['_route_'] = '';
		}
		
		$data['selected_sizes'] = array();
		if (isset($this->request->get['sizes'])) {
			$sizes = $this->request->get['sizes'];
			
			$tmps = explode(',',$sizes);
			foreach($tmps as $tmp){
				$data['selected_sizes'][$tmp] = $tmp;
			}
			
		} else {
			$sizes = '';
		}

		if (isset($this->request->get['sort']) AND $this->request->get['sort'] != '') {
			if($this->request->get['sort'] == 'viewed'){
				$sort = 'p.viewed';
			}elseif($this->request->get['sort'] == 'cheap'){
				$sort = 'p.price';
			}elseif($this->request->get['sort'] == 'expensive'){
				$sort = 'p.price_Z';
			}elseif($this->request->get['sort'] == 'a-z'){
				$sort = 'pd.name';
			}elseif($this->request->get['sort'] == 'z-a'){
				$sort = 'pd.name_Z';
			}else{
				$sort = 'pd.name';
			}
		} else {
			$sort = 'pd.name';
		}

		if(isset($this->request->get['_route_'])){
			$data['nosort_alias'] = str_replace(array('viewed-','cheap-','expensive-'),'', $this->request->get['_route_']);
		}                     
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => HTTP_SERVER /*$this->url->link('common/home')*/
		);

		if (isset($this->request->get['path'])) {
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}


			$path = '';

			//Если это страница списков товаров (Поиск, вы смотрели и тд - без определенной категории)			
			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
				$this->request->get['category_id'] = 0;
				$parts = array();
			}elseif (isset($this->request->get['_route_']) AND $this->request->get['_route_']== 'lovedproducts') {
				$this->request->get['category_id'] = 0;
				$parts = array();
			}elseif (isset($this->request->get['_route_']) AND $this->request->get['_route_'] == 'lastviewed'){
				$this->request->get['category_id'] = 0;
				$parts = array();
			}else{
				$parts = $this->model_catalog_category->getCategoryPath((int)$this->request->get['category_id']);
				$parent_id = 0;
				$category_id = (int)array_pop($parts);
			}
			

			$count = 0;
			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$category_info = $this->model_catalog_category->getCategory((int)$path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->model_catalog_category->getCategoryAlias((int)$path_id)//.$url
					);
				}
				
				if($count == 1){
					$parent_id = (int)$path_id;
					$parent_name = $category_info['name'];
				}
				$count++;

				
			}
		} else {
			$category_id = 0;
		}

		$search = '';
		if (isset($this->request->get['search'])) {
			
			$this->load->model('catalog/information'); 
			$category_info = $this->model_catalog_information->getInformation(7); // id 7 = search
			$like_info = 'search';
			$search = $this->request->get['search'];
			
			foreach($category_info as $index => $name){
				$category_info[$index] = str_replace('@search@', $this->request->get['search'], $name);
			}
		
		}elseif (isset($this->request->get['_route_']) AND $this->request->get['_route_']== 'lovedproducts') {
			
			$this->load->model('catalog/information'); 
			$category_info = $this->model_catalog_information->getInformation(8); // id 7 = search
			$like_info = true;
			
		}elseif (isset($this->request->get['_route_']) AND $this->request->get['_route_'] == 'lastviewed'){
			
			$this->load->model('catalog/information'); 
			$category_info = $this->model_catalog_information->getInformation(9); // id 7 = search
			$like_info = true;
		}else{
		
			$category_info = $this->model_catalog_category->getCategory($category_id);
		
		}
			
		if ($category_info) {
			
			//Если есть назначенные данные для категории
			if(isset($this->request->get['_route_'])){
				$categorize = $this->model_catalog_category->getCategorize($this->request->get['_route_']);
			}


			if(isset($categorize) AND $categorize){
				$this->document->setTitle($categorize['title']);
				$this->document->setDescription(strip_tags(htmlspecialchars_decode($categorize['text1'], ENT_QUOTES)));
				$this->document->setKeywords($categorize['title']);
				$data['heading_title'] = $categorize['title_h1'];
				$data['description'] = html_entity_decode($categorize['text2'], ENT_QUOTES, 'UTF-8');
				
			}elseif(isset($like_info) AND $like_info){
				
				$this->document->setTitle($category_info['meta_title']);
				$this->document->setDescription(strip_tags(htmlspecialchars_decode($category_info['meta_description'], ENT_QUOTES)));
				$this->document->setKeywords($category_info['meta_keyword']);
				$data['heading_title'] = $category_info['title'];
				$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
				$category_info['name'] = $category_info['title'];
			
			}else{
				
				
				$data['heading_title'] = ($category_info['title_h1'] == '') ? $category_info['name'] : $category_info['title_h1'];
				$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
				
				
				//Если есть фильтры но они не подпадают по назначенные алиасы
				if(isset($attributes) AND count($attributes) > 0){
					$attributes_as_string = $this->model_catalog_attribute->getStringFromAttributes($attributes);
					
					$tmp = explode(':', $data['heading_title']);
					$data['heading_title'] = $tmp[0] . ': ' . $attributes_as_string;
					
					$data['description'] = '';
					$this->document->setTitle($data['heading_title']);
					$this->document->setDescription($data['heading_title']);
					$this->document->setKeywords($data['heading_title']);
					
					$data['heading_title'] = '';
					
				}else{
					
					//Описания по умолчанию
					$this->document->setTitle($category_info['meta_title']);
					$this->document->setDescription($category_info['meta_description']);
					$this->document->setKeywords($category_info['meta_keyword']);
				}
				
			}

			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_quantity'] = $this->language->get('text_quantity');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_price'] = $this->language->get('text_price');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_list'] = $this->language->get('button_list');
			$data['button_grid'] = $this->language->get('button_grid');

			// Set the last category breadcrumb
			if(isset($like_info) AND $like_info){
				//Для информационной страницы
				$data['breadcrumbs'][] = array(
					'text' => $category_info['title'],
					'href' => ''
				);
	
				$data['thumb'] = '';

			}else{
				//Для конечно категории
				$data['breadcrumbs'][] = array(
					'text' => $category_info['name'],
					'href' => $this->model_catalog_category->getCategoryAlias((int)$category_info['category_id'])
				);
	
				if ($category_info['image']) {
					$data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
				} else {
					$data['thumb'] = '';
				}
			}
				
			$data['compare'] = $this->url->link('product/compare');

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			
			$data['categories'] = array();
			
			if(isset($parent_id) AND $parent_id > 0){
				$results = $this->model_catalog_category->getCategories($parent_id);
				$data['categories']['header'] = $parent_name;
			}else{
				$results = $this->model_catalog_category->getCategories($category_id);
				$data['categories']['header'] = $category_info['name'] ;
			}

			foreach ($results as $result) {
				$filter_data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true
				);

				$data['categories']['categories'][] = array(
					'category_id' => $result['category_id'],
					'name' => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
					'href' => $this->model_catalog_category->getCategoryAlias($result['category_id']) //. $url
				);
			}

			$data['products'] = array();
			
			$filter_data = array(
				'filter_category_id' 	=> $category_id,
				'filter_sub_category' 	=> true,
				'filter_sizes'      	=> $sizes,
				'filter_name'      		=> $search,
				'filter_price'      	=> $price,
				'filter_filter'      	=> $filter,
				'filter_attributes' 	=> $attributes,
				'sort'               	=> $sort,
				'order'              	=> $order,
				'start'              	=> ($page - 1) * $limit,
				'limit'              	=> $limit
			);
			
			

			//Фиксированные ЧПУ
			if (isset($this->request->get['_route_']) AND $this->request->get['_route_']== 'lovedproducts') {
			
				$data['lovedproducts'] = true;
				$filter_data['lovedproducts'] = true;
				//$filter_data['start'] = 0;
				//$filter_data['limit'] = 100000;
				
			}elseif (isset($this->request->get['_route_']) AND $this->request->get['_route_'] == 'lastviewed'){
				
				$filter_data['lastviewed'] = true;
			
			}
			
			$data['category_alias'] = $this->model_catalog_category->getCategoryAlias($category_id);

			$product_ids = $this->model_catalog_product->getTotalProductIds($filter_data);
			$data['total_product_info'] = $total_product_info = $this->model_catalog_product->getTotalProductsInfo($filter_data);
	
			$product_total = count($product_ids);

			$results = $this->model_catalog_product->getProducts($filter_data);
		
			//Соберем все атрибуты
			$attr_ids = array();
			if(count($attributes) > 0){
				$filter_data_tmp = $filter_data;
				unset($filter_data_tmp['filter_attributes']);
				$tmp = $this->model_catalog_product->getTotalProductIds($filter_data_tmp);
			}else{
				$tmp = $product_ids;
			}
	
			//Догружаем фильтрованные товары
			//$product_addons_line = array();
			if(count($attributes) > 0 AND $product_total < (($page - 1) * $limit + $limit)){
				
				foreach($attributes as $grp_id  => $attr_grp){
					
					//Если фильтр один
					if(count($attributes) < 2 AND count($attr_grp) < 2){
						continue;
					}
					
					foreach($attr_grp as $attr_id){
						
						$filter_data_tmp = $filter_data;
						
						$filter_data_tmp['filter_attributes'] = array($grp_id => array($attr_id=>$attr_id));
						$filter_data_tmp['limit'] 	= 4;
						$filter_data_tmp['sort'] 	= 'p.viewed';
					
						$tmp_array = $this->model_catalog_product->getProducts($filter_data_tmp);
					
						if(count($tmp_array) > 0){
							
							$filter_alias = $this->model_catalog_attribute->getAttributeAlias($attr_id);
							
							$name = $this->model_catalog_category->getCategorizeName($filter_alias.'-'.$data['category_alias']);
							
							if($name == ''){
								$name = $this->model_catalog_attribute->getAttributeName($attr_id).' '.$data['heading_title'] ;
							}
							
							$results[] = array(
											   'product_id'	=> 'system',
											   'name'		=> 'break_stop_line',
											   'href'		=> '/'.$filter_alias,
											   'header_name'=> $name
											   );
							foreach($tmp_array as $product){
								$results[] = $product;
							}
						}
					}
				}
			}elseif($product_total < (($page - 1) * $limit + $limit)){
				//Если нет фильтров - возьмем немного товаров с соседних категорий
				if(isset($data['categories']) AND isset($data['categories']['categories'])){
					foreach($data['categories']['categories'] as $brother_category){
						
						if($category_id != $brother_category['category_id']){
							$filter_data_tmp = $filter_data;
							
							$filter_data_tmp['filter_category_id'] = $brother_category['category_id'];
							$filter_data_tmp['limit'] 	= 4;
							$filter_data_tmp['sort'] 	= 'p.viewed';
						
							$tmp_array = $this->model_catalog_product->getProducts($filter_data_tmp);
						
							if(count($tmp_array) > 0){
								
								$filter_alias = $brother_category['href'];
								$name = $brother_category['name'];
								
								$results[] = array(
												   'product_id'	=> 'system',
												   'name'		=> 'break_stop_line',
												   'href'		=> '/'.$filter_alias,
												   'header_name'=> $name
												   );
								foreach($tmp_array as $product){
									$results[] = $product;
								}
							}
						}
					}
				}
			}
			
			//Если это конец списка
			$data['last_page'] = 0;
			if($product_total < (($page - 1) * $limit + $limit)){
				$data['last_page'] = 1;	
			}
			
			if(is_array($tmp)){
				foreach ($tmp as $result) {
			
					$tmp1 = $this->model_catalog_attribute->getAttributesIdOnProduct($result['product_id']);
						if($tmp1){
						foreach($tmp1 as $value){
							$attr_ids[$value['attribute_id']] = $value['attribute_id'];
						}
					}
				}
			}
			//end Соберем все атрибуты
			
			//Если есть выбранные размеры - нам нужно получить ИД продуктов без фильтрации по размерам
			if(count($sizes) > 0){
				$filter_data_tmp = $filter_data;
				unset($filter_data_tmp['filter_sizes']);
				$tmp = $this->model_catalog_product->getTotalProductIds($filter_data_tmp);
			}else{
				$tmp = $product_total;
			}
			
			$product_ids_no_size_filter = array();
			foreach($tmp as $value){
				$product_ids_no_size_filter[] = $value['product_id'];
			}
			//end Если есть выбранные размеры - нам нужно получить ИД продуктов без фильтрации по размерам
			
			//Соберем размеры
			$data['size'] = $this->model_catalog_attribute->getSisezOnProduct($product_ids_no_size_filter);
			unset($tmp);
			unset($product_ids_no_size_filter);
			//end Соберем размеры
		
			//Тут будут ИД всех категорий продуктов которые мы выводим
			$product_attributes = array();
		
			//Прилепим рекламные продукты если есть
			
		
			foreach ($results as $result) {
				
				if($result['product_id'] == 'system'){
					$data['products'][] = array(
										'product_id'	=> 'system',
										'name'       	=> $result['name'],
										'href'			=> $result['href'] . '-' . $data['category_alias'],
										'header_name'	=> $result['header_name'],
										);
					continue;
				}
				
				$product_attributes[$result['category_id']] = $result['category_id'];
				
				$tmp = $this->model_catalog_attribute->getAttributesIdOnProduct($result['product_id']);
				if($tmp){
					foreach($tmp as $value){
						$attr_ids[$value['attribute_id']] = $value['attribute_id'];
					}
				}
			
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}
				
	
	//echo "<pre>";  print_r(var_dump( $result )); echo "</pre>";
				$date_v = date('Y-m-d');
				if(isset($result['viewed']) AND $result['viewed']) $date_v = $result['viewed'];
	
				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'viewed'	=> $date_v,
					'original_url'      => $result['original_url'],
					'name'        		=> $result['name'],
					'loved'        		=> $result['loved'],
					'size'        		=> $result['size'],
					'shop_id'        	=> $result['shop_id'],
					'shop_name'        	=> $result['shop_name'],
					'shop_href'        	=> $result['shop_href'],
					'manufacturer_id'   => $result['manufacturer_id'],
					'manufacturer'      => $result['manufacturer'],
					'manufacturer_href'      => $result['manufacturer_href'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'old_price'   => $result['old_price'],
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $result['rating'],
					'href'        => $this->model_catalog_product->getProductAlias($result['product_id'])
				);
			}

			//Если это аякс запрос следующей страницы - можем уже тут и закончить
			if(isset($this->request->post['autoload']) AND $this->request->post['autoload'] == true){
				echo  json_encode($data['products']);
				return true;
			}
			
			//Если нужно вывести категории только тех товаров что выбраны (поиск или просмотренные)
			if(isset($like_info) AND $like_info){
				unset($data['categories']);
				$data['categories'] = array();
			
				foreach ($product_attributes as $category_id) {
					
					$result = $this->model_catalog_category->getCategory($category_id);
					
					if(isset($filter_data['lastviewed']) OR isset($filter_data['lovedproducts'])){
						$data['categories']['categories'][] = array(
							'category_id' => (int)$category_id,
							'name' => $result['name'],
							'href' => $this->model_catalog_category->getCategoryAlias($category_id) //. $url
						);
					}else{
						$data['categories']['categories'][] = array(
							'category_id' => (int)$category_id,
							'name' => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
							'href' => $this->model_catalog_category->getCategoryAlias($category_id) //. $url
						);
					}
				}
			}		
			
			//Массив атрибутов для фильтров
			$product_attributes = array();
			/*	
			$add_filters = array();
			$add_filters[] = array('name'=>'Цена','attribute_id'=>169,'filter_name'=>'Недорогие','filter_alias'=>'cheap');
			$add_filters[] = array('name'=>'Цена','attribute_id'=>168,'filter_name'=>'Дорогие','filter_alias'=>'expensive');
			
			foreach($add_filters as $filter){
				$product_attributes[22]['attribute_group_id'] = 22;
				$product_attributes[22]['attribute_group_name'] = $filter['name'];
				$product_attributes[22]['description'] = $filter['name'];
				$product_attributes[22]['attributes'][$filter['attribute_id']]['attribute_id'] = $filter['attribute_id'];
				$product_attributes[22]['attributes'][$filter['attribute_id']]['name'] = $filter['filter_name'];
				$product_attributes[22]['attributes'][$filter['attribute_id']]['filter_name'] = $filter['filter_alias'];
			}
			*/
			$product_attributes[22]['attribute_group_id'] = 22;
			$product_attributes[22]['attributes'][0]['attribute_id'] = -1;
			$product_attributes[22]['attribute_group_name'] = 'Цена';
			$product_attributes[22]['description'] = 'Цена';
			
			//Подчистим атрибуты по тем что назначены
			if($attr_ids AND count($attr_ids)){
				
				$category_attr = $this->model_catalog_category->getCategoryAttribute($category_id);
				
				foreach($attr_ids as $attr_id => $tmp){
					if(!isset($category_attr[$attr_id])) unset($attr_ids[$attr_id]);
				}
	
			}
			
			if($attr_ids AND count($attr_ids)){
	
				$results = $this->model_catalog_attribute->getAttributesOnIds($attr_ids);
				
				if($results){
					
					foreach($results as $result){
						
						$product_attributes[$result['attribute_group_id']]['attribute_group_id'] = $result['attribute_group_id'];
						$product_attributes[$result['attribute_group_id']]['attribute_group_name'] = $result['group_name'];
						$product_attributes[$result['attribute_group_id']]['description'] = $result['description'];
						$product_attributes[$result['attribute_group_id']]['attributes'][$result['attribute_id']]['attribute_id'] = $result['attribute_id'];
						$product_attributes[$result['attribute_group_id']]['attributes'][$result['attribute_id']]['name'] = $result['name'];
						$product_attributes[$result['attribute_group_id']]['attributes'][$result['attribute_id']]['filter_name'] = $result['filter_name'];
						
					}
					
				}
			}
			$data['product_attributes'] = $product_attributes;

			//Выбранные фильтры
			if(isset($product_attributes) AND is_array($product_attributes) AND count($product_attributes) > 0){
				
				$selected_attributes = $data['selected_attributes'];
				//создаем доп строку с фильтрами
				$selected_attributes_alias = '';
				foreach($product_attributes as $product_attribute){
					foreach($product_attribute['attributes'] as $attributes){
						if(isset($selected_attributes[$attributes['attribute_id']])){
							$selected_attributes_alias .= $attributes['filter_name'].'-';
						}
					}
				}
			}
			
			//Возможно залетел системный фильтр
			$results = $this->model_catalog_attribute->getAttributesOnGroupId(0);
			
			foreach($results as $attributes){
				if(isset($selected_attributes[$attributes['attribute_id']])){
					$selected_attributes_alias .= $attributes['filter_name'].'-';
				}
			}
	
			
			$data['selected_attributes_alias'] = $selected_attributes_alias;
			
			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			if(isset($like_info) AND $like_info){
				$this->request->get['path'] = '';
			}
			
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=DESC' . $url)
			);

			if ($this->config->get('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=ASC' . $url)
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=DESC' . $url)
			);

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get('config_product_limit'), 20, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			
			
			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			//$pagination->url = $data['category_alias'] . $url;
			if(isset($this->request->get['_route_'] )){
				$pagination->url = $this->request->get['_route_'] . $url;
			}elseif(isset($this->request->get['search'] )){
				$pagination->url = '?search='.$this->request->get['search'];
			}else{
				$pagination->url = '';
			}
			
			
			if(strpos($pagination->url, '?') === false){
				$pagination->url .= '?page={page}';
			}else{
				$pagination->url .= '&page={page}';
			}
			
			
			$data['pagination'] = $pagination->render();
			$data['pagination_array']['total'] = $product_total;
			$data['pagination_array']['page'] = $page;
			$data['pagination_array']['limit'] = $limit;
			$data['pagination_array']['url'] = $pagination->url;
			
			if($product_total <= $limit OR ceil($product_total/$limit) == $page){
				$data['is_last_page'] = true;
			}
			
			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if (isset($this->request->get['_route_']) AND $this->request->get['_route_']== 'lovedproducts') {

				$this->document->addLink('http://'.$_SERVER['SERVER_NAME'].'/'.$this->request->get['_route_'], 'canonical');

			}elseif(isset($like_info) AND $like_info AND is_string($like_info)){
				
				$this->document->addLink('http://'.$_SERVER['SERVER_NAME'].'/?'.$like_info . '=' . $this->request->get[$like_info], 'canonical');

			}else{

				$this->document->addLink('http://'.$_SERVER['SERVER_NAME'].'/'.$this->request->get['_route_'], 'canonical');

			}
			
			
			//Делаем прогонку на короткие теги автозамены
			/*
			 * Памятка по кодам
			 * @min_price@ - Минимальная цена
			 * @products_count@ - Количество продуктов
			 * @shops_count@ - Количество магазинов
			 * @design_count@ - Количество дизайнеров
			 * @prev_year@ - Предыдущий год
			 * @now_year@ - Текущий год
			 * @next_year@ - Следующий год
			 * @dinamic_year@ - Динамический диапазон 2016-2016
			 *
			 * @city@ - Город [именительный] (Москва)
			 * @sity_to@ - Кород [дательный] (В Москву)
			 * @city_on@ - Город [предложный](По Москве)
			 */
		
			$ids = array();
			foreach($product_ids as $row){
				$ids[] = $row['product_id'];
			}
			
			$product_tags = $this->model_catalog_product->getProductsTags($ids);
			
			foreach($product_tags as $find => $replace){

				$data['heading_title'] = str_replace($find, $replace, $data['heading_title']);
				$data['description'] = str_replace($find, $replace, $data['description']);
				$this->document->setTitle(str_replace($find, $replace, $this->document->getTitle()));
				$this->document->setDescription(str_replace($find, $replace, $this->document->getDescription()));
				$this->document->setKeywords(str_replace($find, $replace, $this->document->getKeywords()));
	
			}
			
			//Вертолет
			if($data['helikopter'] > 0){
				//$data['heading_title'] = не меняем
				$data['description'] = '';
				$this->document->setTitle($this->document->getTitle().' '.$data['helikopter']);
				$this->document->setDescription($data['helikopter'] . ' ' . $this->document->getDescription());
				//$this->document->setKeywords(str_replace($find, $replace, $this->document->getKeywords()));
			}
			
			//Сгенерим линк на следующий клик вертолета
			if(isset($this->request->get['_route_'])){
				$data['helikopter_next_href'] = 'http://'.$_SERVER['SERVER_NAME'].'/'.$this->request->get['_route_'].'-'.($data['helikopter']+1).'click';
				if(strpos($_SERVER['REQUEST_URI'],'?') !== false){
					$tmp = explode('?', $_SERVER['REQUEST_URI']);
					if(isset($tmp[1]) AND $tmp[1] !== ''){
						$data['helikopter_next_href'] .= '?'.$tmp[1];
					}
				}
			}
			
			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;
			$data['category_id'] = $category_id;

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
	
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/category.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/category.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/product/category.tpl', $data));
			}
		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/category', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}
	
	
	
}
