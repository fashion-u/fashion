<?php
    define('TMP_DIR', '');
    // HTTP
    define('HTTP_SERVER', 'http://fashion-u.com.ua/'.TMP_DIR);
    
    // HTTPS
    define('HTTPS_SERVER', 'http://fashion-u.com.ua/'.TMP_DIR);
    
    // DIR
    define('DIR_APPLICATION', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'catalog/');
    define('DIR_SYSTEM', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'system/');
    define('DIR_LANGUAGE', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'catalog/language/');
    define('DIR_TEMPLATE', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'catalog/view/theme/');
    define('DIR_CONFIG', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'system/config/');
    define('DIR_IMAGE', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'image/');
    define('DIR_CACHE', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'system/storage/cache/');
    define('DIR_DOWNLOAD', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'system/storage/download/');
    define('DIR_LOGS', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'system/storage/logs/');
    define('DIR_MODIFICATION', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'system/storage/modification/');
    define('DIR_UPLOAD', '/var/www/loderi/data/www/fashion-u.com.ua/www/'.TMP_DIR.'system/storage/upload/');
    
    // DB
    define('DB_DRIVER', 'mysqli');
    define('DB_HOSTNAME', 'localhost');
    define('DB_USERNAME', 'loderi_fashion');
    define('DB_PASSWORD', 'Rc5xycNN');
    define('DB_DATABASE', 'loderi_fashion_new');
    define('DB_PORT', '3306');
    define('DB_PREFIX', 'fash_');

    $mysqli = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($mysqli)); 
    mysqli_set_charset($mysqli,"utf8");
?>