<?php

namespace Admin\Controller;
use Think\Controller;
class AccountController extends Controller {
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	
	
	public function accountSettings()
	{
		
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/accountSettings.html');
		
	}
	
	/*
	 * 账户设置页面，数据的AJAX返回
	 */
	public function accountmescalling()
	{
		$call = A('Publiccode');
		$handle = M('telsignin');
		
		$condition['uid'] = $call->check_valid_user() ;
		
		$result = $handle->where($condition)->find();
		
		if ($result['mobilephone'] == 13000000000)
		{
			$result['mobilephone'] = '';
		}
		
		$response['data'] = array(
			'mobilephone' => $result['mobilephone'],
			'email' => $result['email'],
			'name' => $result['name'],
			'password' => $call->getrandstr().'ok',
			'name1' => $call->getrandstr().'anyname',
		);
		
		

		
		
		$response['status'] = 1;
		$response['info'] = '';
		$response['type'] = 'JSON';
		
		$this->ajaxReturn($response, 'JSON');
		
	}
	
	/*
	 * 修改用户名的操作
	 */
	public function changeName()
	{
		$name = I('post.name');
		$call = A('Publiccode');
		$handle = M('telsignin');
		
		$condition['name'] = $name;
		$result = $handle->where($condition)->find();
		
		if ($result)
		{
			$response['status'] = 0;
			$response['info'] = '';
			$response['tyep'] = 'JSON';	
			$this->ajaxReturn($response, 'JSON');
			
		}else {
			$uid = $call->check_valid_user();
			$data['uid'] = $uid;
			$data['name'] = $name;
			
			$handle->save($data);
			
			$response['data'] = $data;
			$response['status'] = 1;
			$response['info'] = '';
			$response['tyep'] = 'JSON';
			
			$this->ajaxReturn($response, 'JSON');
		}
		
		
		
		
	}
	
	
	/*
	 * 修改绑定电话的操作，同时发生验证码（在前端页面显示）
	 */
	public function changeTel()
	{
		$mobilephone = I('post.mobilephone');
		$call = A('Publiccode');
		
		$result = $call->check_mobilephone($mobilephone);
		
		if ($result == false)
		{
			$response['status'] = 0;
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response, 'JSON');
		}else {
			session_start();
			$rands = $call->getrandstr();
			$_SESSION[$mobilephone] = $rands;
			
			$response['data'] = $rands;
			$response['status'] = 1;
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response, 'JSON');
			
		}
		
		
	}
	
	/*
	 *  验证码的检测
	 */
	public function telver()
	{
		$mobilephone = I('post.mobilephone');
		$telver = I('post.telver');
		$call = A('Publiccode');
		
		if ($telver == $_SESSION[$mobilephone])
		{
			unset($_SESSION[$mobilephone]);//不绑定验证码，验证已经通过
			
			$handle = M('telsignin');
			$data['uid'] = $call->check_valid_user();
			$data['mobilephone'] = $mobilephone;
			$handle->save($data);
			
			$response['data'] = $data;
			$response['status'] = 1;
			$response['info'] = '成功修改';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response, 'JSON');
		}else {
			
			unset($_SESSION[$mobilephone]);//不绑定验证码，验证不通过
			
			$response['status'] = 0;
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response, 'JSON');
			
		}
	}
	
	/*
	 * 修改绑定的邮箱，发送绑定邮件
	 */
	public function changeemail(){
		
		
		$password = I('post.password');
		$username = I('post.username');
		$handle = D('emailsignin');
		
		if ($handle->create() && $result = $handle->add())
		{
			$condition['euid'] = $result;
			
			$data = $handle->where($condition)->find();
			
			$call = A('Publiccode');
			$hosts = C('Hosts');
			
			$uid = $call->check_valid_user();	
			$to = $data['email'];
			$name = '尊敬的用户';
			$subject = '用户邮箱绑定';
			$body = "亲爱的用户：<br/>感谢您使用我们的产品。<br/>请点击链接绑定你的邮箱。<br/>
    				<a href='http://".$hosts."/TP/index.php/Admin/Account/email_check?verify=".$data['token']."&this=".$uid."' target=
					'_blank'>http://".$hosts."/TP/index.php/Admin/Account/email_check?verify=".$data['token']."&this=".$uid."</a><br/>
    				如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。";
				
			$email_result = $call->think_send_mail($to, $name, $subject, $body);
				
			if ($email_result === true)
			{
				$response['status'] = 1;
				$response['info'] = '请在24小时内打开邮箱进行邮箱绑定';
				$response['type'] = 'JSON';
				$this->ajaxReturn($response, 'JSON');
			
			}else {
				$response['status'] = 1;
				$response['info'] = $email_result;
				$response['type'] = 'JSON';
				$this->ajaxReturn($response, 'JSON');
			}
			
			
			
		}else {
			
			$response['data'] = $password.'  '.$username;
			$response['status'] = 0;
			$response['info'] = $handle->getError();
			$response['type'] = 'JSON';
			$this->ajaxReturn($response, 'JSON');
			
		}
		
		
	}
	
	
	/*
	 *点击绑定邮件的链接操作
	 */
	public function email_check()
	{
		header("Content-Type:text/html;charset=UTF-8");
		$verify = I('get.verify');
		$uid = I('get.this');
		$now_time = time();
		
		$handle = M('telsignin');
		$Emailsignin = M('emailsignin');
		$condition['status'] = 0;
		$condition['token'] = $verify;
		
		$result = $Emailsignin->where($condition)->find();
		
		if ($result){
			
			if ($now_time > $result['token_exptime'])
			{
				echo '您的激活有效期已过，请联系管理员.';
			}else{
				
				$check_unique_b['email'] = $result['email'];
				$check_result_b = $handle->where($check_unique_b)->find();
				
				if($check_result_b)
				{
					$Emailsignin->delete($result['euid']);//由于被注册，删除记录
					echo '绑定失败！您的邮箱已被注册。';
					
				}else {
					
					//其实成功绑定后可以删除该记录
// 					$save['status'] = 1;
// 					$save['euid'] = $result['euid'];
// 					$Emailsignin->save($save);
// 					$email = $Emailsignin->where($save)->getField('email');
					
					$Emailsignin->delete($result['euid']);//成功绑定，删除记录
					
					
					$condition['uid'] = $uid;
					$condition['email'] = $result['email'];
					$handle->save($condition);
					
					echo '绑定邮箱成功';
					
					
				}
				
				
				
			}
			
		}else{
			echo '绑定邮箱失败';
		}
		
	}
	
	
}