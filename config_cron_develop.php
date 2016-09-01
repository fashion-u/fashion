<?php
    define('TMP_DIR', '');
    // HTTP
    define('HTTP_SERVER', 'http://fashion.my/');
    
    // HTTPS
    define('HTTPS_SERVER', 'http://fashion.my/');
    
    // DIR
    define('DIR_APPLICATION', '/var/www/fashion/catalog/');
    define('DIR_SYSTEM', '/var/www/fashion/system/');
    define('DIR_LANGUAGE', '/var/www/fashion/catalog/language/');
    define('DIR_TEMPLATE', '/var/www/fashion/catalog/view/theme/');
    define('DIR_CONFIG', '/var/www/fashion/system/config/');
    define('DIR_IMAGE', '/var/www/fashion/image/');
    define('DIR_CACHE', '/var/www/fashion/system/storage/cache/');
    define('DIR_DOWNLOAD', '/var/www/fashion/system/storage/download/');
    define('DIR_LOGS', '/var/www/fashion/system/storage/logs/');
    define('DIR_MODIFICATION', '/var/www/fashion/system/storage/modification/');
    define('DIR_UPLOAD', '/var/www/fashion/system/storage/upload/');
    
    // DB
    define('DB_DRIVER', 'mysqli');
    define('DB_HOSTNAME', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'sturm2015');
    define('DB_DATABASE', 'loderi_fashion_new');
    define('DB_PORT', '3306');
    define('DB_PREFIX', 'fash_');
    
    $mysqli = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($mysqli)); 
    mysqli_set_charset($mysqli,"utf8");
?>