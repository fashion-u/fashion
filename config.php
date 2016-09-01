<?php
/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/
if($_SERVER['HTTP_HOST'] == 'fashion.my'){
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
}else{
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
}

    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $mobile = strpos($_SERVER['HTTP_USER_AGENT'],"Mobile");
    $symb = strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
    $operam = strpos($_SERVER['HTTP_USER_AGENT'],"Opera M");
    $htc = strpos($_SERVER['HTTP_USER_AGENT'],"HTC_");
    $fennec = strpos($_SERVER['HTTP_USER_AGENT'],"Fennec/");
    $winphone = strpos($_SERVER['HTTP_USER_AGENT'],"WindowsPhone");
    $wp7 = strpos($_SERVER['HTTP_USER_AGENT'],"WP7");
    $wp8 = strpos($_SERVER['HTTP_USER_AGENT'],"WP8");
    if ($ipad ||$ipod || $iphone || $android || $palmpre || $berry || $mobile || $symb || $operam || $htc || $fennec || $winphone || $wp7 || $wp8 === true) {
        define('IS_MOBILE', true);
    }else{
        define('IS_MOBILE', false);
    }
    
    

    //Настройки из сетапа
    /*
    $setup = array(
                'email' => 'fashionforemail@gmail.com',
                'email name' => 'Fashion',
                'email login' => 'fashionforemail@gmail.com',
                'email pass' => 'ckjyjgjafglsafgnfv2015',
                'email port' => '465',
                'email smtp' => 'ssl://smtp.gmail.com',
                );  //Настройки из сетапа
    */
    $setup = array(
                'email' => 'info.fashon@yandex.ru',
                'email name' => 'Fashion-admin',
                'email login' => 'info.fashon@yandex.ru',
                'email pass' => 'ckjyjgjafglsafgnfv2015',
                'email port' => '25',
                'email smtp' => 'smtp.yandex.ru',
                );
      
    $adapterConfigs = array(
        'vk' => array(
            'client_id'     => '3774741',
            'client_secret' => '3nLWEs45iWeKypmVR2CU',
            'redirect_uri'  => HTTP_SERVER.'login/?provider=vk'
        ),
        /*
        'odnoklassniki' => array(
            'client_id'     => '168635560',
            'client_secret' => 'C342554C028C0A76605C7C0F',
            'redirect_uri'  => HTTP_SERVER.'auth?provider=odnoklassniki',
            'public_key'    => 'CBADCBMKABABABABA'
        ),
        'mailru' => array(
            'client_id'     => '770076',
            'client_secret' => '5b8f8906167229feccd2a7320dd6e140',
            'redirect_uri'  => HTTP_SERVER.'auth/?provider=mailru'
        ),
        'yandex' => array(
            'client_id'     => 'bfbff04a6cb60395ca05ef38be0a86cf',
            'client_secret' => '219ba8388d6e6af7abe4b4b119cbee48',
            'redirect_uri'  => HTTP_SERVER.'auth/?provider=yandex'
        ),*/
        'google' => array(
            'client_id'     => '45586715019-1806lg8ehp68ddvpvq3m71ofsu6i79rm.apps.googleusercontent.com',
            'client_secret' => '-D7NGaNchDuodyZE5kgKDF3-',
            'redirect_uri'  => HTTP_SERVER.'login_google'
        ),
        'facebook' => array(
            'client_id'     => '1804192209864141',
            'client_secret' => '6bbd137dac4040fe80b3784e2104ff28',
            'redirect_uri'  => HTTP_SERVER.'login?provider=facebook'
        )
    );
    require_once DIR_SYSTEM.'addons/SocialAuther/autoload.php';
    require_once DIR_SYSTEM.'addons/SocialAuther/Adapter/AdapterInterface.php';
    require_once DIR_SYSTEM.'addons/SocialAuther/Adapter/AbstractAdapter.php';
    require_once DIR_SYSTEM.'addons/SocialAuther/SocialAuther.php';
    require_once DIR_SYSTEM.'addons/SocialAuther/Adapter/Vk.php';
    require_once DIR_SYSTEM.'addons/SocialAuther/Adapter/Google.php';
    require_once DIR_SYSTEM.'addons/SocialAuther/Adapter/Facebook.php';
    
    $adapters = array();
    foreach ($adapterConfigs as $adapter => $settings) {
            $class = 'SocialAuther\Adapter\\' . ucfirst($adapter);
            $adapters[$adapter] = new $class($settings);
    }
    
    //Social images
    $social_images = array(
						 'facebook'=>'<img src="/catalog/view/theme/FA/image/icon/login_facebook.png" alt="facebook login">',
						 'vk'=>'<img src="/catalog/view/theme/FA/image/icon/login_vk.png" alt="vk login">',
						 'google'=>'<img src="/catalog/view/theme/FA/image/icon/login_google.png" alt="google+ login">',
						 );
    
    //В самом начале - не прилетел ли нам логин из социалки!!! ===========================================
    if(isset($_GET['_route_']) AND $_GET['_route_'] == 'login_google'){
        $_GET['provider'] = 'google';
    }
       
    if (isset($_GET['provider']) && array_key_exists($_GET['provider'], $adapters)) {
        $auther = new SocialAuther\SocialAuther($adapters[$_GET['provider']]);
        if($auther->authenticate()) {
          
            $user = array(
              'provider' 	=> $auther->getProvider(),
              'id' 			=> $auther->getSocialId(),
              'name' 		=> $auther->getName(),
              'email' 		=> $auther->getEmail(),
              'page' 		=> $auther->getSocialPage(),
              'sex' 		=> $auther->getSex(),
              'birthday' 	=> $auther->getBirthday(),
              'avatar' 		=> $auther->getAvatar()
            );
          
        }
    }
