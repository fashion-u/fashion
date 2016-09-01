<?php

    define("FV_ROOT", realpath(dirname(__FILE__) . "/../"));
    define("CURRENT_LANGUAGE", "ru");
    $srv = $_SERVER['SERVER_NAME'];

    //if( preg_match('/fashion-u.com.ru/',$srv)  )  //local version
    //{
        $__server_host = 'flocalhost/fashion/';
        $__db_server_host = 'localhost';
        $__db_user = 'root';
        $__db_pass = 'sturm2015';
        $__db_name = 'loderi_fashion';

    /*} else {
        $__server_host = 'fashion-u.com.ua';
        $__db_server_host = 'localhost';
        $__db_user = 'loderi_fashion';
        $__db_pass = 'Rc5xycNN';
        $__db_name = 'loderi_fashion'; 
    }*/

    define("__SERVER_NAME", $__server_host);
    define("__DB_SERVER_NAME", $__db_server_host);
    define("__DB_USER", $__db_user);
    define("__DB_PASS", $__db_pass);
    define("__DB_NAME", $__db_name);


?>