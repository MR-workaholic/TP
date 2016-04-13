<?php
namespace Admin\Controller;
use Think\Controller;

class MerchantController extends Controller {
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	
	/*
	 * 展示商家的页面
	 */
	public function show()
	{
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/merchantIndex.html');
	}
	
	/*
	 * 展示代理商的页面
	 */
	public function showAgent()
	{
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Agent/agentIndex.html');
	}
	
	/*
	 * 展示管理员的页面
	 */
	public function showAdmin()
	{
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Admin/adminIndex.html');
	}
	
	
	
	public function showIndex()
	{
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/index.html');
	}
	
	public function showview()
	{
		$call = A('Publiccode');
		$call->check_valid_user();
		
		$username = $call->get_name();
		//$shop = $call->get_shop();
		
		$this->assign('valid_user', $username);
		$this->display('./GLLogin/Signin/zui-master-me/frame/basicMessage.html');	
	}
	
	/*
	 * 首页信息的AJAX返回
	 */
	
	public function indexmescalling(){
		
		$call = A('Publiccode');
		$hosts = C('Hosts');
		$uid = $call->check_valid_user();
		
		$database = C('Database');
		$webservice = C('Webservice');
		$msgsource = C('MsgSource');
		
		
		if ($msgsource == $database)
		{
			
			$handle = M('devicelist');
			$condition['uid'] = $uid;
			$result = $handle->where($condition)->select();
			
			$count_sum = count($result, 0);
			$count_online = 0;
			
			for($i=0; $i<$count_sum; $i++)
			{
				$data['data'][$i]['dname'] = $result[$i]['dname'];
				$data['data'][$i]['dssid'] = $result[$i]['dssid'];
				$data['data'][$i]['donlinenum'] = $result[$i]['donlinenum'];
				if($result[$i]['dstate'] == '是')
				{
					$count_online++;
				}
			}
			
			// 		$handle1 = M('adlist');
			// 		$condition['adstatus'] = 'Y';
			// 		$url = $handle1->where($condition)->getField('url');
			
			
			$data['count_sum'] = $count_sum;
			$data['count_online'] = $count_online;
			$data['url'] = 'http://'.$hosts.'/TP/index.php/Admin/Adset/showad/shop/'.$uid.'/aid/0';
			
		}else{

			/*
				$json = array(
					"op" => "count",
					"where" => "where BusinessNum = {$uid}  and State <> '停用'"	
				);
				$json = json_encode($json);
				$data['count_sum'] = $call->RouterHandle($json);
				
				$json = array(
					"op" => "count",
					"where" => "where BusinessNum = {$uid}  and State = '在线'"	
				);
				$json = json_encode($json);
				$data['count_online'] = $call->RouterHandle($json);
				*/
			$data['count_online'] = 0;
			$data['url'] = 'http://'.$hosts.'/TP/index.php/Admin/Adset/showad/shop/'.$uid.'/aid/0';
			
			$json = array(
					"op" => "query",
					"where" => "where BusinessNum = {$uid}  and State <> '停用'"
			);
			$json = json_encode($json);
			$result = $call->RouterHandle($json);
			
			$data['count_sum'] = $result['total'];
			
			foreach ($result['rows'] as $key => $item)
			{
				
				$data['data'][$key]['dname'] = $item['RouterName'];
				$data['data'][$key]['donlinenum'] = $item['OnlineCount'];
				if($result[$key]['State'] == '在线')
				{
					$data['count_online']++;
				}
				
				/*  由于路由器的MAC地址问题，暂时能查阅的路由只有一个
				$json1 = array(
					"op" => "getSetting",
					"RouterMac" => $item['Mac']
				);*/
				
				$json1 = array(
						"op" => "getSetting",
						"RouterMac" => '00:03:7F:11:20:B0',
				);
				
				
				
				$json1 = json_encode($json1);
				$result1 = $call->RouterHandle($json1);
				$data['data'][$key]['dssid'] = $result1['Wlan']['ssid'];	
			}
			
			
		}
		
		$response['data'] = $data;
		$response['status'] = $data['count_sum'];
		$response['type'] = 'JSON';
		$response['info'] = '';
			
		$this->ajaxReturn($response, 'JSON');
		
		
		
	}
	
	
	/*
	 * 处理ajax请求，返回店铺信息的后台函数
	 */
	
	
	public function shopmescalling()
	{
		
		$call = A('Publiccode');
		$call->check_valid_user();
		
	
		$shop = $call->get_shop();
				
		$response['data'] = $shop;
		$response['info'] = '';
		$response['status'] = 1;
		$response['type'] = 'JSON';
		$this->ajaxReturn($response,'JSON');
	
	}
	
	/*
	 * 修改店铺信息的后台处理函数
	 */
	
	public function shopmeschange()
	{
		$call = A('Publiccode');
		
		$database = C('Database');
		$webservice = C('Webservice');
		$msgsource = C('MsgSource');
		
		if ($msgsource == $database)
		{
			$Form = D('shop');
			
			if ($Form->create())
			{
				$result = $Form->save();
					
				if ($result)
				{
					$shop = $call->get_shop();
					$response['data'] = $shop;
					$response['info'] = '更新成功';
					$response['status'] = 1;
					$response['type'] = 'JSON';
					$this->ajaxReturn($response,'JSON');
					// 				echo "success";
				}else {
					$response['info'] = " 更新失败  ".$Form->getError();
					$response['status'] = 0;
					$response['type'] = 'JSON';
					$this->ajaxReturn($response,'JSON');
				}
			}
			
		}else {
			
			$uid = $call->check_valid_user();
			
			
			//构造用户查询json参数
			$json = array(
					"op" => "query",
					"where" => "where Num = {$uid}",
			);
			$json = json_encode($json);
			
			//执行账户查询,返回数组
			$jsonResult = $call->AccountHandle($json);

			//构造用户更新json参数
			
			$jsonResult['rows'][0]['Name'] = I('post.shopname');
			$jsonResult['rows'][0]['ContactInfo'] = I('post.shopphone');
			$jsonResult['rows'][0]['Type'] = I('post.shopstyle');
// 			$jsonResult['rows'][0][''] = I('post.shopwebsite');
			$jsonResult['rows'][0]['Remark'] = I('post.shopremark');
			$jsonResult['rows'][0]['Contact'] = I('post.shopman');
			$jsonResult['rows'][0]['Address'] = I('post.shopsite');
			$jsonResult['rows'][0]['Longitude'] = I('post.shoplongitude');
			$jsonResult['rows'][0]['Latitude'] = I('post.shoplatitude');
			
			
			$json1 = array(
					'op' => 'save',
					'obj' => $jsonResult['rows'][0]
						
			);
			$json1 = json_encode($json1);
			
			
			$jsonResult1 = $call->AccountHandle($json1);
			
			if ($jsonResult1)
			{
				$shop = $call->get_shop();
				$response['data'] = $shop;
				$response['info'] = '更新成功';
				$response['status'] = 1;
				$response['type'] = 'JSON';
				$this->ajaxReturn($response,'JSON');
				// 				echo "success";
			}else {
				$response['info'] = " 更新失败  ";
				$response['status'] = 0;
				$response['type'] = 'JSON';
				$this->ajaxReturn($response,'JSON');
			}
	
		}
		
		
	}
	
	
	
	public function middletitleshow(){
		
		$call = A('Publiccode');
		$call->check_valid_user();
		
		$username = $call->get_name();
		
		$this->assign('username', $username);
		$this->display('./Public/frame/middletitle.html');
		
	}
	
	/*
	 * 展示网页帽子
	 */
	public function hatshow(){
		
		$hosts = C('Hosts');
		$this->assign('hosts', $hosts);
		$this->display('./Public/frame/hat.html');
		
	}
	
	/*
	 * 展示网页的头部
	 */
	public function  headshow(){
		$imgPath = C('IMG_PATH');
		$this->assign('imgPath', $imgPath);
		$this->display('./Public/frame/head.html');
		
	}
	
	/*
	 * 退出账户
	 */
	public function quituser(){
		
		$call = A('Publiccode');
		$call->check_valid_user();
		
		
		
		session_start();
		
		unset($_SESSION['uid']);
		unset($_SESSION['type']);
		unset($_SESSION['BId']);
		
		
		$result_dest = session_destroy();
		
		if ($result_dest)
		{
			$hosts = C('Hosts');
			$this->assign('hosts', $hosts);
			
			$this->display('./GLLogin/Signin/myproject_lai/html/login.html');
		}
		else {
			$this->error("can not log you out");
		}
		
	}
	
	/*
	 * 修改密码弹出框
	 */
	
	public function passwordsetshow()
	{
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/passwordSet.html');
	}
	
	/*
	 * 修改密码后台操作
	 */
	public function passwordset()
	{
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		$oldPassword = I('post.oldPassword');
		$newPassword = I('post.newPassword');
		$newPasswordcomfirm = I('post.newPasswordcomfirm');
		$handle = M('telsignin');
		$condition['uid'] = $uid;
		
		$password = $handle->where($condition)->getField('password');
		
		if ($password == sha1($oldPassword))
		{
			if (strlen($newPassword)>5 && strlen($newPassword)<21)
			{
			
				if ($newPassword == $newPasswordcomfirm)
				{
					$condition['password'] = sha1($newPassword);
					$handle->save($condition);
					$this->success('修改密码成功','',3);
				
				}else{
					$this->error('两次输入的新密码不一致');
				}
			
			}else {
					$this->error('输入的新密码长度不对');
			}
				
			
		}else {
			$this->error('原密码不准确');
		}
	
	}
	
}