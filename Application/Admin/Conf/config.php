<?php
return array(
	//'配置项'=>'配置值'
	'VIEW_PATH'=>'./GLLogin/',
		
		// 添加数据库配置信息
		'DB_TYPE'=>'mysql',// 数据库类型
		'DB_HOST'=>'127.0.0.1',// 服务器地址
		'DB_NAME'=>'glproject',// 数据库名
		'DB_USER'=>'root',// 用户名
		'DB_PWD'=>'',// 密码
		'DB_PORT'=>3306,// 端口
		'DB_PREFIX'=>'glproject_',// 数据库表前缀
		'DB_CHARSET'=>'utf8',// 数据库字符集
		
		//邮件配置
		'THINK_EMAIL' => array(
				'SMTP_HOST'   => '', //SMTP服务器
				'SMTP_PORT'   => '', //SMTP服务器端口
				'SMTP_USER'   => '', //SMTP服务器用户名
				'SMTP_PASS'   => '', //SMTP服务器密码
				'FROM_EMAIL'  => '', //发件人EMAIL
				'FROM_NAME'   => '', //发件人名称
				'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）
				'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）
		),
		
// 		'Hosts' => '192.168.1.92/Project001',    //局域网内wamp上线测试使用
		'Hosts' => 'Project001.com',	//虚拟主机wamp离线测试使用
		
);