<?php
namespace Admin\Controller;
use Think\Controller;
class DevicelistController extends Controller {
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	
	public function showview(){
		$call = A('Publiccode');
		$call->check_valid_user();
		
		$this->display('./GLLogin/Signin/zui-master-me/frame/ggly/routeList.html');
	}
	
	/*
	 * 设备信息的AJAX返回
	 */
	public function devmescalling(){
		
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		$hosts = C('Hosts');
		
		$database = C('Database');
		$webservice = C('Webservice');
		$msgsource = C('MsgSource');
		
		if ($msgsource == $database)
		{
			$handle = M('devicelist');
			$condition['uid'] = $uid;
			$result = $handle->where($condition)->select();	
			
			if(!$result)
			{
				$response['status'] = 0;
			}else {
				$response['status'] = count($result,0);
			}
			
			$response['data'] = $result;
			$response['info'] = $_POST['whichbutton'];
			$response['type'] = 'JSON';
			$this->ajaxReturn($response,'JSON');
			
		}else 
		{
			/*
			//为了返回BID
	
			//构造用户查询json参数
			$json = array(
					"op" => "query",
					"where" => "where Num = {$uid}",
			);
			$json = json_encode($json);
				
			//执行账户查询,返回数组
			$jsonResult = $call->AccountHandle($json);
			*/
			
			//构造设备查询语句
			$json1 = array(
					"op" => "query",
					"where" => "where BusinessNum = {$uid} and State <> '停用'",
			);
			
			$json1 = json_encode($json1);
			
			$result = $call->RouterHandle($json1);
			
			if (!$result || $result['total'] == 0)
			{
				$response['status'] = 0;
				//$response['data'] = $result;
				$response['info'] = $_POST['whichbutton'];
				$response['type'] = 'JSON';
				$this->ajaxReturn($response,'JSON');
				
			}else {
				
				foreach ($result['rows'] as $k=>$v)
				{
					 $devmes[$k]['dname'] = $v['RouterName'];
					 $devmes[$k]['dtype'] = $v['RouterModel'];
					 //$devmes[$k]['dssid'] = 'dssid'.$k;//$v[''];
					 $devmes[$k]['dstate'] = $v['State'];
					 $devmes[$k]['donlinenum'] = $v['OnlineCount'];
					 $devmes[$k]['dmac'] = $v['Mac'];
					 $devmes[$k]['dplmac'] = $v['PLCMac'];
					 $devmes[$k]['dplcbandwidth'] = $v['PLCBandwidth'];
					 $devmes[$k]['dplcnetworkname'] = $v['PLCName'];
					 $devmes[$k]['url'] = 'http://'.$hosts.'/TP/index.php/Admin/Adset/showADbyMac/shop/'.$uid.'/mac/'.$v['Mac'];
					 
					 /*  由于路由器的MAC地址问题，暂时能查阅的路由只有一个
					  $json1 = array(
					  		"op" => "getSetting",
					  		"RouterMac" => $item['Mac']
					  );*/
					 
					 $json2 = array(
					 		"op" => "getSetting",
					 		"RouterMac" => '00:03:7F:11:20:B0',
					 );
					 
					 $json2 = json_encode($json2);
					 $result2 = $call->RouterHandle($json2);
					 $devmes[$k]['dssid'] = $result2['Wlan']['ssid'];

				}
				
				$response['status'] = $result['total'];
				$response['data'] = $devmes;
				$response['info'] = $_POST['whichbutton'];
				$response['type'] = 'JSON';
				$this->ajaxReturn($response,'JSON');
				
			}
			
			
			
			
			
			
		}
		
		
		
		
		
	}
	
}