<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	
	public function index(){
		$this->display('./GLLogin/Signin/myproject_lai/html/login.html');
	}
	
	public function showloginview()
	{
		
		$hosts = C('Hosts');
		
		$this->assign('hosts', $hosts);
		
		$this->display('./GLLogin/Signin/myproject_lai/html/login.html');
	}
	
	public function firstlogin()
	{
		$way = I('post.way');
		$call = A('Publiccode');
		$hosts = C('Hosts');
// 		echo $loginway.'  '.$password;
		session_start();
		
		if ($way == 0){
			

			$loginway = I('post.loginway1');
			$password = I('post.password1');
			
		if ($call->check_email($loginway))  //邮箱登陆
		{
// 			$this->success('邮箱登陆');
			$result = $call->check_user_exist('telsignin', 'email', $loginway);
			
			if($result=='N')
			{
				$this->error('没有该用户');
			
			}else{
			
				if ($result['password']==sha1($password))
				{
					
					$_SESSION['uid'] = $result['uid'];
					//$this->success('登陆成功','http://'.$hosts.'/TP/index.php/admin/Merchant/show');//跳转到主页
					switch ($result['type'])
					{
						case '商家':
							$this->success('登陆成功', 'http://'.$hosts.'/TP/index.php/admin/Merchant/show');//之后改为跳转到主页
							break;
						case '代理商':
							$this->success('登陆成功 ', 'http://'.$hosts.'/TP/index.php/admin/Merchant/show');//之后改为跳转到主页
							break;
						case '管理员':
							$this->success('登陆成功', 'http://'.$hosts.'/TP/index.php/admin/Merchant/show');//之后改为跳转到主页
							break;
						default:
							$this->error('账号类型错误', 'http://'.$hosts.'/TP/index.php/admin/signin/showloginview');
					}
					
				}
				else {
					$this->error('密码错误');
				}
			}
			
			
		}
		elseif ($call->check_mobilephone($loginway))      //手机登陆
		{	
// 			$firstlogin = M("telsignin");
// 			$where['mobilephone'] = $loginway;
// 			$result = $firstlogin->where($where)->select();//返回的是二维数组
			
			$result = $call->check_user_exist('telsignin', 'mobilephone', $loginway);
// 			dump($result);
			
			if($result=='N')
			{
				$this->error('没有该用户');
				
			}else{
				
				if ($result['password']==sha1($password))  
				{
					
					$_SESSION['uid'] = $result['uid'];
					//$this->success('登陆成功','http://'.$hosts.'/TP/index.php/admin/Merchant/show');//跳转到主页
					switch ($result['type'])
					{
						case '商家':
							$this->success('登陆成功', 'http://'.$hosts.'/TP/index.php/admin/Merchant/show');//之后改为跳转到主页
							break;
						case '代理商':
							$this->success('登陆成功 ', 'http://'.$hosts.'/TP/index.php/admin/Merchant/show');//之后改为跳转到主页
							break;
						case '管理员':
							$this->success('登陆成功', 'http://'.$hosts.'/TP/index.php/admin/Merchant/show');//之后改为跳转到主页
							break;
						default:
							$this->error('账号类型错误', 'http://'.$hosts.'/TP/index.php/admin/signin/showloginview');
					}

						
				}
				else {
					$this->error('密码错误');
				}
			}
		}else 
		{
			$this->error("请输入正确的登陆账号");
		}
	}else 
	{
		

		$loginway = I('post.loginway2');
		$password = I('post.password2');

		// 			$this->success('邮箱登陆');
		$result = $call->check_user_exist('telsignin', 'name', $loginway);
			
		if($result=='N')
		{
			$this->error('没有该用户');
				
		}else{
				
			if ($result['password']==sha1($password))
			{
					
				$_SESSION['uid'] = $result['uid'];
				//$this->success('登陆成功','http://'.$hosts.'/TP/index.php/admin/Merchant/show');//跳转到主页
				switch ($result['type'])
				{
					case '商家':
						$this->success('登陆成功', 'http://'.$hosts.'/TP/index.php/admin/Merchant/show');//之后改为跳转到主页
						break;
					case '代理商':
						$this->success('登陆成功 ', 'http://'.$hosts.'/TP/index.php/admin/Merchant/show');//之后改为跳转到主页
						break;
					case '管理员':
						$this->success('登陆成功', 'http://'.$hosts.'/TP/index.php/admin/Merchant/show');//之后改为跳转到主页
						break;
					default:
						$this->error('账号类型错误', 'http://'.$hosts.'/TP/index.php/admin/signin/showloginview');
				}
					
			}
			else {
				$this->error('密码错误');
			}
		}
		
	}
		
		
			}
		
		
	}
