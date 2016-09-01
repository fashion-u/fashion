<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if($_SERVER['HTTP_HOST'] == 'fashion.my'){
    // HTTP
    define('TMP_DIR', '');
    
    define('HTTP_SERVER', 'http://fashion.my/admin/');
    define('HTTP_CATALOG', 'http://fashion.my/');
    
    // HTTPS
    define('HTTPS_SERVER', 'http://fashion.my/admin/');
    define('HTTPS_CATALOG', 'http://fashion.my/');
    
    // DIR
    define('DIR_APPLICATION', '/var/www/fashion/admin/');
    define('DIR_SYSTEM', '/var/www/fashion/system/');
    define('DIR_LANGUAGE', '/var/www/fashion/admin/language/');
    define('DIR_TEMPLATE', '/var/www/fashion/admin/view/template/');
    define('DIR_CONFIG', '/var/www/fashion/system/config/');
    define('DIR_IMAGE', '/var/www/fashion/image/');
    define('DIR_CACHE', '/var/www/fashion/system/storage/cache/');
    define('DIR_DOWNLOAD', '/var/www/fashion/system/storage/download/');
    define('DIR_LOGS', '/var/www/fashion/system/storage/logs/');
    define('DIR_MODIFICATION', '/var/www/fashion/system/storage/modification/');
    define('DIR_UPLOAD', '/var/www/fashion/system/storage/upload/');
    define('DIR_CATALOG', '/var/www/fashion/catalog/');
    
    // DB
    define('DB_DRIVER', 'mysqli');
    define('DB_HOSTNAME', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'sturm2015');
    define('DB_DATABASE', 'loderi_fashion_new');
    define('DB_PORT', '3306');
    define('DB_PREFIX', 'fash_');
}else{
    define('TMP_DIR', '');
    // HTTP
    define('HTTP_SERVER', 'http://fashion-u.com.ua/'.TMP_DIR.'admin/');
    define('HTTP_CATALOG', 'http://fashion-u.com.ua/'.TMP_DIR);
    
    // HTTPS
    define('HTTPS_SERVER', 'http://fashion-u.com.ua/'.TMP_DIR.'admin/');
    define('HTTPS_CATALOG', 'http://fashion-u.com.ua/'.TMP_DIR);
    
    // DIR
    define('DIR_APPLICATION', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'/admin/');
    define('DIR_SYSTEM', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'/system/');
    define('DIR_LANGUAGE', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'/admin/language/');
    define('DIR_TEMPLATE', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'/admin/view/template/');
    define('DIR_CONFIG', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'/system/config/');
    define('DIR_IMAGE', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'/image/');
    define('DIR_CACHE', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'/system/storage/cache/');
    define('DIR_DOWNLOAD', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'/system/storage/download/');
    define('DIR_LOGS', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'/system/storage/logs/');
    define('DIR_MODIFICATION', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'/system/storage/modification/');
    define('DIR_UPLOAD', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'/system/storage/upload/');
    define('DIR_CATALOG', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'/catalog/');
    
    // DB
    define('DB_DRIVER', 'mysqli');
    define('DB_HOSTNAME', 'localhost');
    define('DB_USERNAME', 'loderi_fashion');
    define('DB_PASSWORD', 'Rc5xycNN');
    define('DB_DATABASE', 'loderi_fashion_new');
    define('DB_PORT', '3306');
    define('DB_PREFIX', 'fash_');
}