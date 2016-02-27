<?php
return array(
	//'配置项'=>'配置值'
		'DB_TYPE'=>'mysql',// 数据库类型
		'DB_HOST'=>'127.0.0.1',// 服务器地址
		'DB_NAME'=>'thinkphp',// 数据库名
		'DB_USER'=>'root',// 用户名
		'DB_PWD'=>'',// 密码
		'DB_PORT'=>3306,// 端口
		'DB_PREFIX'=>'think_',// 数据库表前缀
		'DB_CHARSET'=>'utf8',// 数据库字符集
		
		//路由定义
		'URL_ROUTER_ON' => true,  // 开启路由
		
		'URL_ROUTE_RULES' => array(	
		//静态地址和动态地址结合
		'test/:name' => 'test/test1',  //输入：http://project001.com/TP/index.php/home/test/bbc		
		'look/:name/:behavior' => 'test/test2', //输入http://project001.com/TP/index.php/home/look/tom/run
		
		//静态地址路由
		'hello' => 'test/test',  //输入：http://project001.com/TP/index.php/home/hello		
		
				
		'num/:num' => '/TP/index.php/home/test/test3/:1', //输入http://project001.com/TP/index.php/home/num/3
		),  // 配置路由规则
		
);