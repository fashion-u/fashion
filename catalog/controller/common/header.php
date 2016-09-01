<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		
		// Analytics
		$this->load->model('extension/extension');

		$data['analytics'] = array();

		$analytics = $this->model_extension_extension->getExtensions('analytics');

		
		
		//Социальные сети
		global $adapters;
		$data['adapters'] = $adapters;
		global $social_images;
		$data['social_images'] = $social_images;
		//==========================================	
		
		
		foreach ($analytics as $analytic) {
			if ($this->config->get($analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('analytics/' . $analytic['code']);
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();
		//$data['shop'] = $this->document->getShop();

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['money'] = $this->document->getMoney();
		$data['param'] = $this->document->getParam();
		$data['ip_list'] = $this->document->getIpList();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

		$data['text_home'] = $this->language->get('text_home');

		// Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');
			$this->load->model('account/customer');
			$this->load->model('catalog/shops');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
			
			$data['customer_info'] = $customer_info = $this->model_account_customer->getCustomer($this->customer->isLogged());
		
			if(isset($customer_info['customer_shop_id'])){
				//основные данные по магазину и деньгам
				$data['shop'] = $this->model_catalog_shops->getShop($customer_info['customer_shop_id']);
				$this->document->setShop($data['shop']);
			}
			
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}

		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['logged'] = $this->customer->isLogged();
	
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['register'] = $this->url->link('account/register', '', 'SSL');
		$data['login'] = $this->url->link('account/login', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$data['download'] = $this->url->link('account/download', '', 'SSL');
		$data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');

		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			//if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);
				foreach ($children as $child) {
					if($child['is_menu'] == 1){
						
						$children2 = $this->model_catalog_category->getCategories($child['category_id']);
						$children_data2 = array();
						foreach ($children2 as $child2) {
							if($child2['is_menu'] == 1){
								$filter_data2 = array(
									'filter_category_id'  => $child2['category_id'],
									'filter_sub_category' => true
								);
								
								$children_data2[] = array(
									'category_id'	=> $child2['category_id'],
									'name'  => $child2['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data2) . ')' : ''),
									'href'  => $this->model_catalog_category->getCategoryAlias($child2['category_id'])
								);
							}
						}
						
						$filter_data = array(
							'filter_category_id'  => $child['category_id'],
							'filter_sub_category' => true
						);
	
						$children_data[] = array(
							'category_id'	=> $child['category_id'],
							'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
							'href'  => $this->model_catalog_category->getCategoryAlias($child['category_id']),
							'children' => $children_data2,
						);
					
					}
				}

				// Level 1
				if($category['is_menu'] == 1){
					$data['categories'][] = array(
						'category_id'	=> $category['category_id'],
						'name'     => $category['name'],
						'column'   => $category['column'] ? $category['column'] : 1,
						'href'     => $this->model_catalog_category->getCategoryAlias($category['category_id']),
						'children' => $children_data
					);
				}
			//}
		}

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

		$data['total_viewed_products'] = (int)$this->model_catalog_product->getTotalViewedProducts();
		if($data['total_viewed_products'] > 99){
			$data['total_viewed_products'] = '99';
		}if($data['total_viewed_products'] < 0){
			$data['total_viewed_products'] = '';
		}
		
		$data['total_loved_products'] = (int)$this->model_catalog_product->getTotalLovedProducts();
		if($data['total_loved_products'] > 99){
			$data['total_loved_products'] = '99';
		}elseif($data['total_loved_products'] < 1){
			$data['total_loved_products'] = '';
		}
		
		
		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
		} else {
			return $this->load->view('default/template/common/header.tpl', $data);
		}
	}
}
