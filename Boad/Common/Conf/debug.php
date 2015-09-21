<?php
return array(
	//mysql
	'DB_TYPE'               =>  'mysql',     // 数据库类型
	'DB_HOST'               =>  '127.0.0.1', // 服务器地址
	'DB_NAME'               =>  'think',          // 数据库名
	'DB_USER'               =>  'root',      // 用户名
	'DB_PWD'                =>  '654321',          // 密码
	'DB_PORT'               =>  '3306',        // 端口
	'DB_PREFIX'             =>  'wp_aite_',    // 数据库表前缀
	'DB_CHARSET'            =>  'utf8',      // 数据库编码
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志

	'SHOW_PAGE_TRACE'		=>	true,
    
    //'TAGLIB_BUILD_IN'     =>  'cx,html',
    //'TAGLIB_PRE_LOAD'     =>  'html',
    
    'MODULE_ALLOW_LIST'     =>  array('Home','Admin'),
    'DEFAULT_MODULE'        =>  'Home',
    
    'URL_ROUTER_ON'         =>  true,
    'URL_ROUTE_RULES'       =>  array(
        //'u'         =>  'User/index',
        //'u/:id'     =>  'User/index',
        //'/^u\/([0-9]+)$/'   =>  'User/index?id=:1',
        /* '/^u\/([0-9]+)$/'   =>  function ($idc){
            echo $idc;
        }, */
        '/^([0-9]+)$/'   =>  'Index/index?id=:1',
    ),
    
    'URL_MODEL'     => 2,

);