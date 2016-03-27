<?php
namespace Admin\Controller;
use Think\Controller;
class SigninController extends Controller {
	
// 	public function index(){
// 		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
// 	}

	
// 	public function showsignupview()
// 	{
// 		$this->display('./GLLogin/Signin/myproject_lai/html/signin.html');
// 	}

	
	
	public function showsignupview($mobilephone=0)
	{
		$hosts = C('Hosts');
		
		$this->assign('mobilephone',$mobilephone);  //绑定到html的$mobilephone中
		$this->assign('hosts', $hosts);
		$this->display('./GLLogin/Signin/myproject_lai/html/signin.html');
	}
	
	public function showloginview()
	{
		$hosts = C('Hosts');
		$this->assign('hosts', $hosts);
		$this->display('./GLLogin/Signin/myproject_lai/html/login.html');
	}
	
	/*
	 *  检测注册的手机的准确性与是否已经注册，返回验证码到网页上
	 */
	public  function telverify()
	{
		$mobilephone = I('post.mobilephone');
		$call = A('Publiccode');
		$hosts = C('Hosts');
		
		if(!($call->check_mobilephone($mobilephone)))
		{
			$this->error('请输入正确的十一位手机号码');
		}
		else {
			/*
		$Telverify = M('telsignin');
		$condition['mobilephone']=$mobilephone;
		$result = $Telverify->where($condition)->select();*/
		
		$result = $call->check_user_exist('telsignin', 'mobilephone', $mobilephone);
// 		dump($result) ;
		
		if($result=='N')
		{
		
		$rands = $call->getrandstr();
		
		session_start();
// 		$str =   getrandstr();
		$_SESSION[$mobilephone] = $rands;
		
		$this->success('请输入验证码：'.$rands,'http://'.$hosts.'/TP/index.php/admin/signin/showsignupview/mobilephone/'.$mobilephone);
	   }
	   elseif($result) {
	   	$this->error('该用户已经注册');
	   }
	}
	}
	
	/*
	 * 利用框架的自动检测与自动完成检测验证码与填写的数据，全部通过则注册成功
	 */
	
	public function telsignin()
	{
		$Telsignin = D('telsignin');
// 		$password = I('post.password');
// 		$pwconfirm = I('post.pwconfirm');
// 		$telverify = I('post.telverify');
		$mobilephone = I('post.mobilephone');
		$call = A('Publiccode');
		$hosts = C('Hosts');
		
			
			

			if ($Telsignin->create())  //利用模型的自动检测功能
			{
				
				$uid = $Telsignin->add();
				
				unset($_SESSION[$mobilephone]);//不绑定验证码，验证已经通过
				
				//以电话名创建文件夹并放在session中，然后登陆进去主页面中
				
					$_SESSION['uid'] = $uid;
					
					if (mkdir('./Application/Admin/UserFile/'.$_SESSION['uid']))  //创建用户的文件夹
					{
						
	   	
	   					$updata_information = array(   //仅仅需要填写需要修改的字段
	   						'uid' => $uid,
	   					);
	   	
	   				$call->saveshop($updata_information,0);
	   					
						
					$this->success('注册成功！请记住密码 '.$mobilephone.'网络接口账号号是'.$websresult, 'http://'.$hosts.'/TP/index.php/admin/Merchant/show');//之后改为跳转到主页
					}else{
						
						$this->error('请联系代理商后，重新注册！ ', 'http://'.$hosts.'/TP/index.php/admin/signin/showsignupview');
						
					}
					
					
			}else{
				
				$this->error($Telsignin->getError());
				}

		
	}
	
	/*
	 * 邮件注册，利用框架的自动检测与自动完成来记录注册者的信息，发送激活邮件到用户的邮箱中
	 */
	
	public function emailsignin()
	{
		$Emailsignin = D('emailsignin');
		$hosts = C('Hosts');
		
		if ($Emailsignin->create() && $result = $Emailsignin->add())
		{
			$condition['euid'] = $result;
			$data = $Emailsignin->where($condition)->find();
			
			
			$call = A('Publiccode');
			
			$to = $data['email'];
			$name = '尊敬的'.$data['username'];
			$subject = '用户帐号激活';
			$body = "亲爱的".$data['username']."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/> 
    				<a href='http://".$hosts."/TP/index.php/Admin/Signin/emailsignin_check?verify=".$data['token']."' target= 
					'_blank'>http://".$hosts."/TP/index.php/Admin/Signin/emailsignin_check?verify=".$data['token']."</a><br/> 
    				如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。";
			
			$email_result = $call->think_send_mail($to, $name, $subject, $body);
			
			if ($email_result === true)
			{
				$this->success('恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号!') ;
			}else {
				$this->error($email_result);
			}
			
			
			
		}else {
			$this->error($Emailsignin->getError());
		}
		
	}
	
	/*
	 *   点击激活邮件后跳转到这里进行邮箱的检测与激活
	 */
	
	public function emailsignin_check()
	{
		header("Content-Type:text/html;charset=UTF-8");
		$verify = I('get.verify');
		$now_time = time();
		
		$Telsignin = M('telsignin');
		$hosts = C('Hosts');
		$Emailsignin = M('emailsignin');
		$condition['status'] = 0;
		$condition['token'] = $verify;
		
		$result = $Emailsignin->where($condition)->find();
		
		if ($result)
		{
			if ($now_time > $result['token_exptime'])
			{
				$Emailsignin->delete($result['euid']);//由于过期，删除记录
				echo '您的激活有效期已过，请重新注册.';
			}else{
				
				$check_unique_a['name'] = $result['username'];
				$check_unique_b['email'] = $result['email'];
				$check_result_a = $Telsignin->where($check_unique_a)->find();
				$check_result_b = $Telsignin->where($check_unique_b)->find();
				
				if ($check_result_b)
				{
					$Emailsignin->delete($result['euid']);//由于被注册，删除记录
					echo '激活失败！您的邮箱已被注册。';
				}elseif ($check_result_a)
				{
					$Emailsignin->delete($result['euid']);//由于被注册，删除记录
					echo '激活失败！您的用户名已被注册。';
				}else {
				
				
				//其实成功注册后可以删除该记录
// 				$save['status'] = 1;
// 				$save['euid'] = $result['euid'];
// 				$Emailsignin->save($save);

				$Emailsignin->delete($result['euid']);//成功注册，删除记录
				
				$data['mobilephone'] = 13000000000;
				$data['email'] = $result['email'];
				$data['name'] = $result['username'];
				$data['password'] = $result['password'];
				
				$uid = $Telsignin->add($data);
				
				
				$_SESSION['uid'] = $uid;
					
				if (mkdir('./Application/Admin/UserFile/'.$_SESSION['uid']))
				{
					
					$call = A('Publiccode'); 
					
					$updata_information = array(   //仅仅需要填写需要修改的字段
							'uid' => $uid,
					);
					 
					$call->saveshop($updata_information,0);
				
					$this->success('注册成功！请记住密码 ', 'http://'.$hosts.'/TP/index.php/admin/Merchant/show');//之后改为跳转到主页
				}else{
				
					$this->error('请联系代理商后，重新注册！ ', 'http://'.$hosts.'/TP/index.php/admin/signin/showsignupview');
				
				}
					
				
			}
				
			}
			
		}else {
			echo '注册失败';
		}
		
		
	}
	
	
	
	
}