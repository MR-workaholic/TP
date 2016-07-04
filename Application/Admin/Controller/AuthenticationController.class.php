<?php
namespace Admin\Controller;
use Think\Controller;
class AuthenticationController extends Controller {
	
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	
	public function showview()
	{
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/AuthenticationSet.html');
	}
	
	/*
	 * 显示一键认证内容
	 */
	
	public function oneClickLoginshow()
	{
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/oneClickLogin.html');
		
	}
	
	/*
	 * 显示注册内容
	 */
	
	public function signinshow()
	{
		$imgPath = C('IMG_PATH');
		$host = C('Hosts');
		$var = explode("/", $host);
		$this->assign('imgPath', $imgPath);
		$this->assign('host', $var[1]);
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/signin.html');
	}
	
	/*
	 * 显示手机登陆设置框
	 */
	
	public function mobileOpen()
	{
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		$this->assign('uid',$uid);
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/mobileOpen.html');
		
	}
	
	/*
	 * 显示微信登陆设置框
	 */
	
	public function wechatLogin()
	{

		$this->display('./GLLogin/Signin/zui-master-me/Merchant/wechatLogin.html');
		
	}
	
	/*
	 * 认证信息的AJAX返回
	 */
	public function authenticationmescalling(){
		
	
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$handel = M('authentication');
		$condition['uid'] = $uid;
		$result = $handel->where($condition)->find();
		
		if(!$result)
		{
			$data = array(
				'uid' => $uid,
				'authentication' => 0,
				'wifitime' => 86400,
				'wifinumber' => 10,
				'adseconds' => 15,
				'freeauthentication' => 0,	
				'signinstyle' => 0,	
			);
			$handel->add($data);
			$result = $data;
		}
		
		$response['status'] = 1;
		$response['data'] = $result;
		$response['info'] = '';
		$response['type'] = 'JSON';
		$this->ajaxReturn($response,'JSON');
		
		
	}
	
	/*
	 * 点击选择认证方式时的处理函数——马上登记进数据库中，修改glproject_authentication数据表的authentication字段
	 */
	public function updataauthentication(){
		
		$authentication = I('post.authen');
		
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$handle = M('authentication');
		$condition['uid'] = $uid;
		
		$oldAuthentication = $handle->where($condition)->getField('authentication');
		
		$data['authentication'] = $authentication;
		$handle->where($condition)->save($data);
		
		if(!($oldAuthentication*$authentication))
		{
			
			$json = array(
					"op" => "query",
					"where" => "where BusinessNum = '{$uid}'",
			);
			
			$json = json_encode($json);
			
			$result = $call->RouterHandle($json);
			
			if($result && $result['total'] != 0)   //寻找有没有路由器，没有即可退出
			{
				foreach ($result['rows'] as $k=>$v)
				{
					$response['data']['mac'][$k] = $v['Mac'];
					
					$json1 = array(
							"op" => "getSetting",
							"RouterMac" => "{$v['Mac']}"
					);
					$json1 = json_encode($json1);
					$result1 = $call->RouterHandle($json1);
					
					if ($authentication == 0)
					{
						$result1['Portal']['enable'] = 0;
					}else{
						$result1['Portal']['enable'] = 1;
					}
					
					$json2 = array(
						"op" => "setSetting",
						"obj" => $result1
					);
					
					$json2 = json_encode($json2);
					$call->RouterHandle($json2);
					
				}
			}
			
			
// 			$response['data']['mes'] = "gai";
		}
		
		
		$response['data']['new'] = $authentication;
		$response['data']['old'] = $oldAuthentication;
		$response['status'] = 1;
		$response['info'] = '';
		$response['type'] = 'JSON';
		
		$this->ajaxReturn($response,'JSON');
	}
	
	/*
	 * 一键登陆的认证信息的AJAX返回
	 */
	public function oneclickloginmescalling()
	{
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$handle = M('authentication');
		$condition['uid'] = $uid;
		$result = $handle->where($condition)->find();
		
		$response['data'] = $result;
		$response['status'] = 1;
		$response['info'] = '';
		$response['type'] = 'JSON';
		
		$this->ajaxReturn($response, 'JSON');
		
	}
	
	/*
	 * 更新一键登陆的信息
	 */
	public function updataoneClickLogin()
	{
		$data['freeauthentication'] = $_POST['freeAuthentication'];
		
		$wifitime = $_POST['wifiTime'];
		$wifiEffectiveHour = $_POST['wifiEffectiveHour'];
		$wifiEffectiveMinute = $_POST['wifiEffectiveMinute'];
		$wifinumber = $_POST['wifiNumber'];
		
		
		$data['adseconds'] = $_POST['adseconds'];
		$data['auid'] = $_POST['auid'];
		$data['uid'] = $_POST['uid'];
		
		if($wifitime == 0)
		{
			$data['wifitime'] = ($wifiEffectiveHour*60 + $wifiEffectiveMinute) * 60;
		}else{
			$data['wifitime'] = $wifitime;
		}
		
		if($wifinumber == 0)
		{
			$data['wifinumber'] = $_POST['authenticationNumber'];
		}else {
			$data['wifinumber'] = $wifinumber;
		}
		
		$handle = M('authentication');
		$handle->save($data);
		
		
		$response['data'] = $data;
		$response['status'] = 1;
		$response['info'] = '';
		$response['type'] = 'JSON';
		$this->ajaxReturn($response, 'JSON');
	}
	
	/*
	 * 点击手机登陆的设置 通过AJAX向前端返回信息
	 */
	public function phonesigninmescalling(){
		
		$uid = I('post.uid');
		
		$handle = M('phoneauth');
		$condition['uid'] = $uid;
		$result = $handle->where($condition)->find();
		
		if(!$result)
		{
			//$data['test'] = 'happy';
			$handle1 = M('authentication');
			$auid = $handle1->where($condition)->getField('auid');
			$data['auid'] = $auid;
			$data['uid'] = $uid;
			$data['status'] = 0;
			$data['content'] = "凭本手机号和验证码可登录此处免费Wi-Fi！";
			
			$handle->add($data);
			
			
			
		}else 
		{
			$data = $result;
		}
		
	
		$response['data'] = $data;
		$response['status'] = 1;
		$response['info'] = '';
		$response['type'] = 'JSON';
		
	 	$this->ajaxReturn($response,'JSON');
		
	}
	
	public function wechatsigninmescalling(){
		
		$call = A('Publiccode');
		$uid = $call->check_valid_user();

		$handle = M('authentication');
		$condition['uid'] = $uid;
		$signinstyle = $handle->where($condition)->getField('signinstyle');
		
		$a = 1 << 1;
		$b = 1 << 2;
		
		if (($signinstyle | $a) == $signinstyle)
		{
			$signinstyle = 1;
		}elseif (($signinstyle | $b) == $signinstyle)
		{
			$signinstyle = 2;
		}else {
			$signinstyle = 0;
		}
		
		$response['data']['signinstyle'] = $signinstyle;
		$response['status'] = 1;
		$response['info'] = '';
		$response['type'] = 'JSON';
		
		$this->ajaxReturn($response,'JSON');
		
	}
	
	/*
	 * 更新手机登陆所设置的信息
	 */
	public function updatamobileopen(){
		
		$data['paid'] = I('post.paid');
		$data['status'] = I('post.mobileLogin');
		$data['content'] = I('post.mobileMessage');
		$data['uid'] = I('post.uid');
		
		$handle = M('phoneauth');
		$condition['paid'] = $data['paid'];
		$status = $handle->where($condition)->getField('status');
		$handle->save($data);
		
		if($status != $data['status'])  //手机验证状态发送改变
		{
			$handle1 = M('authentication');
			$condition1['uid'] = $data['uid'];
			$signinsnstyle = $handle1->where($condition1)->getField('signinstyle');
			$a = 1 << 0;
			if ($data['status'] == 1)
			{
				$signinsnstyle =  $signinsnstyle | $a;  //加上2的0次方
				//$handle1->where($condition1)->setInc('signinstyle');
			}else{
				$signinsnstyle = $signinsnstyle ^ $a;   //减去2的0次方
				//$handle1->where($condition1)->setDec('signinstyle');
			}
			$handle1->where($condition1)->setField('signinstyle', $signinsnstyle);
		}
		
		$response['data'] = $data;
		$response['status'] = 1;
		$response['info'] = '';
		$response['type'] = 'JSON';
		
		$this->ajaxReturn($response, 'JSON');
		
		
		
	}
	
	public function updatawechatLogin(){
		
		$wechatLogin = I('post.wechatLogin');
		
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$handle = M('authentication');
		$condition['uid'] = $uid;
		$signinsnstyle = $handle->where($condition)->getField('signinstyle');
		$a = 1<<1;
		$b = 1<<2;
		
		if (($signinsnstyle | $a) == $signinsnstyle)  //原本第二位为1
		{
			if ($wechatLogin != 1)
			{
				$signinsnstyle = $signinsnstyle ^ $a;
			}
			
			if ($wechatLogin == 2)
			{
				$signinsnstyle = $signinsnstyle | $b;
			}
			
		} elseif(($signinsnstyle | $b) == $signinsnstyle){		//原本第三位为1
			
			if($wechatLogin != 2)
			{
				$signinsnstyle = $signinsnstyle ^ $b;
			}
			if ($wechatLogin == 1)
			{
				$signinsnstyle = $signinsnstyle | $a;
			}
			
		}else{     //第二第三位为0
			
			if($wechatLogin == 1)
			{
				$signinsnstyle = $signinsnstyle | $a;
			}elseif($wechatLogin == 2)
			{
				$signinsnstyle = $signinsnstyle | $b;
			}
			
		}
		
		$handle->where($condition)->setField('signinstyle', $signinsnstyle);
		
		
		
		
		
		$response['data'] = $wechatLogin;
		$response['status'] = 1;
		$response['info'] = '';
		$response['type'] = 'JSON';
		$this->ajaxReturn($response, 'JSON');
		
		
	}
	
	
}