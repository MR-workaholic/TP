<?php

namespace Admin\Model;

use Think\Model;

class TelsigninModel extends Model {
	
	
	// 定义自动验证
	protected $_validate = array (
			
			array (
					'mobilephone',
					'require',
					'手机号码必须' 
			),
			
			array(
            'mobilephone',
            '/^1(3|4|5|8){1}[0-9]{9}$/i',
            '手机号码不正确'
       		 ) ,
			
			array (
					'mobilephone',
					'',
					'该号码已经注册了' ,
					self::EXISTS_VALIDATE,
            		'unique',
            		self::MODEL_INSERT
			),
			
			
			
			array (
					'name',
					'require',
					'名称必须' 
			),
			
			array (
					'name',
					'',
					'该用户名已被注册了' ,
					self::EXISTS_VALIDATE,
					'unique',
					self::MODEL_INSERT
			),
			
			array (
					'password',
					'require',
					'密码必须' 
			),
			
			array (
					'password',
					 '6,20',
					'密码长度不对,必须是6~20长度的字符' ,
					 self::MUST_VALIDATE,
           			 'length'
			),
			
			array (
					'pwconfirm',
					'require',
					'请再次输入密码' 
			),
			
			array(
					'pwconfirm',
					'password',
					'确认密码不一致',
					self::MUST_VALIDATE,
					'confirm',
					self::MODEL_INSERT
			) ,
			
			array (
					'telverify',
					'require',
					'请输入验证码' 
			) ,
			
			array (
					'telverify',
					 4,
					'验证码长度不对',
					self::MUST_VALIDATE,
           			'length' 
			) ,
			array (
					'telverify',
					'checkTelverify',
					'验证码不对',
					self::MUST_VALIDATE,
           			'callback',
            		self::MODEL_BOTH 
			) 
			
	);
	
	function checkTelverify($value){
		
		$mobilephone = I('post.mobilephone');
		$check = $_SESSION[$mobilephone];
		
		return $value == $check;
		
	}
	
	// 定义自动完成
	protected $_auto = array (
			array (
					 'password',
					 'sha1',
            		 self::MODEL_BOTH,
            		 'function'
			) 
	);
}