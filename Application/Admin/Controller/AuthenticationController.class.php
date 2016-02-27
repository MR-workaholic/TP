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
		
		$authentication = $_POST['authen'];
		
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$handle = M('authentication');
		$condition['uid'] = $uid;
		$data['authentication'] = $authentication;
		
		$handle->where($condition)->save($data);
		
		$response['data'] = $authentication;
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
		
		$uid = $_POST['uid'];
		
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
	
	/*
	 * 更新手机登陆所设置的信息
	 */
	public function updatamobileopen(){
		
		$data['paid'] = $_POST['paid'];
		$data['status'] = $_POST['mobileLogin'];
		$data['content'] = $_POST['mobileMessage'];
		$data['uid'] = $_POST['uid'];
		
		$handle = M('phoneauth');
		$condition['paid'] = $data['paid'];
		$status = $handle->where($condition)->getField('status');
		$handle->save($data);
		
		if($status != $data['status'])  //手机验证状态发送改变
		{
			$handle1 = M('authentication');
			$condition1['uid'] = $data['uid'];
			if ($data['status'] == 1)
			{
				$handle1->where($condition)->setInc('signinstyle');
			}else{
				$handle1->where($condition)->setDec('signinstyle');
			}
		}
		
		$response['data'] = $data;
		$response['status'] = 1;
		$response['info'] = '';
		$response['type'] = 'JSON';
		
		$this->ajaxReturn($response, 'JSON');
		
		
		
	}
	
	
}