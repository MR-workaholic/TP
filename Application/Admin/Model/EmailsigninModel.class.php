<?php

namespace Admin\Model;

use Think\Model;

class EmailsigninModel extends Model {

	protected $_validate = array(
		
			array (
					'email',
					'require',
					'邮箱地址必须填写' 
			),
			
			array (
					'email',
					'email',
					'邮箱地址格式不正确' 
			),
			
		
			
			array (
					'username',
					'require',
					'用户名必须填写' 
			),
			
			array (
					'username',
					'check_name_unique',
					'该用户名已被注册',
					self::MUST_VALIDATE,
           			'callback',
            		self::MODEL_BOTH 
			),
			
			array (
					'password',
					'require',
					'登陆密码必须填写' 
			),
			
			array (
					'password',
					'6,20',
					'密码长度不对,必须是6~20长度的字符',
					self::MUST_VALIDATE,
					'length' 
			),
			
			array (
					'pwconfirm',
					'require',
					'请再次填写登陆密码' 
			),
			
			array (
					'pwconfirm',
					'password',
					'两次输入的密码不一致',
					self::MUST_VALIDATE,
					'confirm',
					self::MODEL_INSERT 
			),
			
			
	);
	
	function check_name_unique($value)
	{
		$handle = M('telsignin');
		$condition['name'] = $value;
		$result = $handle->where($condition)->find();
		
		if ($result)
		{
			return false;
		}else {
			return true;
		}
	}
	
	protected $_auto = array(
			
		array (
					'regtime',
					'time',
					self::MODEL_INSERT,
					'function' 
			),
			
			array (
					'token',
					'create_email_token',
					self::MODEL_INSERT,
					'function'
			),
			
			array (
					'password',
					'sha1',
					self::MODEL_BOTH,
					'function' 
			),
			
			array (
					'token_exptime',
					'create_email_token_exptime',
					self::MODEL_INSERT,
					'function' 
			),
			
	);


}