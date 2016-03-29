<?php
namespace Admin\Controller;
use Think\Controller;
class RoutesetController extends Controller {
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	
	public function showview(){
		
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/routeSet.html');
	}
	
	/*
	 * 设备设置的数据的AJAX返回
	 */
	public function routesetmescalling(){
		
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$database = C('Database');
		$webservice = C('Webservice');
		$msgsource = C('MsgSource');
		
		if ($msgsource == $database)
		{
			$handle = M('devicelist');
			$condition['uid'] = $uid;
			$result = $handle->where($condition)->select();
			$num = count($result,0);
			
			if(!$result)
			{
				$response['status'] = 0;
			}else {
				$response['status'] = $num;
					
				for ($i=0; $i < $num; $i++)
				{
				$data[$i]['dname'] = $result[$i]['dname'];
				}
					
				$response['data'] = $data;
			}
			
			
				$response['info'] = '';
				$response['type'] = 'JSON';
				$this->ajaxReturn($response,'JSON');
			
		}else {
			
			//为了返回BID
			
			//构造用户查询json参数
			$json = array(
					"op" => "query",
					"where" => "where Num = {$uid}",
			);
			$json = json_encode($json);
			
			//执行账户查询,返回数组
			$jsonResult = $call->AccountHandle($json);
				
				
			//构造设备查询语句
			$json1 = array(
					"op" => "query",
					"where" => "where BusinessId = {$jsonResult['rows'][0]['BId']} and State <> '停用'",
			);
				
			$json1 = json_encode($json1);
				
			$result = $call->RouterHandle($json1);
			
			if (!$result || $result['total'] == 0)
			{
				$response['status'] = 0;
			}else {
				
				$response['status'] = $result['total'];
				foreach ($result['rows'] as $k=>$v)
				{
					$data[$k]['dname'] = $v['Mac'];
				}
				$response['data'] = $data;
				
			}
			
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response,'JSON');
			
		}
		
		
		
		
		
	}
	
	/*
	 * 点击修改SSID的弹出框
	 */
	public function SSIDset($did)
	{
		$this->assign('did',$did);
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/SSIDset.html');
	}
	
	/*
	 * SSID相关数据的AJAX返回
	 */
	public function SSIDmescalling()
	{
		$did = $_POST['calling'];
		$handle = M('devicelist');
		$condition['did'] = $did;
		$dssid = $handle->where($condition)->getField('dssid');
		
		$handle1 = M('devset');
		$smodel = $handle1->where($condition)->getField('smodel');
		$devpassword = $handle1->where($condition)->getField('devpassword');
	
		$data['dssid'] = $dssid;
		$data['smodel'] = $smodel;
		$data['devpassword'] = $devpassword;
		
		$response['data'] = $data;
		$response['status'] = 1;
		$response['info'] = '';
		$response['type'] = 'JSON';
		$this->ajaxReturn($response,'JSON');
		
	}
	/*
	 * 设备设置的数据的AJAX返回
	 */
	public function showrousetmescalling(){
		
		$whichrou = $_POST['whichrou'];
		
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$database = C('Database');
		$webservice = C('Webservice');
		$msgsource = C('MsgSource');
		
		if ($msgsource == $database)
		{
			$handle = M('devicelist');
			$condition['uid'] = $uid;
			$condition['dname'] = $whichrou;
			
			$did = $handle->where($condition)->getField('did');
			$dssid = $handle->where($condition)->getField('dssid');
			$version = $handle->where($condition)->getField('version');
			
			$handle1 = M('devset');
			$condition1['did'] = $did;
			$result = $handle1->where($condition1)->find();
			$result['dssid'] = $dssid;
			$result['version'] = $version;
			
			
			$response['status'] = 1;
			$response['data'] = $result;
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response,'JSON');
			
		}else{
			
			//构造用户查询json参数
			$json = array(
					"op" => "getSetting",
					"RouterMac" => $whichrou,
			);
			$json = json_encode($json);
				
			//执行账户查询,返回数组
			$jsonResult = $call->RouterHandle($json);
			
			
			
		}
		
		
		
	}
	/*
	 * ssid信息的修改
	 */
	public function SSIDmeschange(){
		
		$dssid = $_POST['dssid'];
		$smodel = $_POST['smodel'];
		$devpassword = $_POST['devpassword'];
		$did = $_POST['did'];
		$len = strlen($did);
		$did = substr($did, 0, $len-1);  //去除后面的‘/’
		
		$handle = M('devicelist');
		$data['did'] = $did;
		$data['dssid'] = $dssid;
		$handle->save($data);
		
		$handle1 = M('devset');
		$condition['did'] = $did;
		$data['smodel'] = $smodel;
		$data['devpassword'] = $devpassword;
		$handle1->where($condition)->save($data);

		$response['data'] = $data;
		$response['info'] = '更新成功';
		$response['status'] = 1;
		$response['type'] = 'JSON';
		$this->ajaxReturn($response,'JSON');
	}
	
	/*
	 * 修改前端提交的设备设置
	 */
	
	public function Routesetmeschange(){
		
		$wlmodel = $_POST['pattern'];
		$channel = $_POST['channel'];
		$bandwidth = $_POST['bandwidth'];
		$power = $_POST['power'];
		$dsid = $_POST['dsid'];
		$did = $_POST['did'];
		
		$data['wlmodel'] = $wlmodel;
		$data['channel'] = $channel;
		$data['bandwidth'] = $bandwidth;
		$data['power'] = $power;
		$data['dsid'] = $dsid;
		$data['did'] = $did;
		
		$handle = M('devset');
		$handle->save($data);  //数据库的更新
		
		$handle1 = M('devicelist');
		$condition['did'] = $did;
		$data['dssid'] = $handle1->where($condition)->getField('dssid');
		
		
		$response['data'] = $data;
		$response['info'] = '更新成功';
		$response['status'] = 1;
		$response['type'] = 'JSON';
		$this->ajaxReturn($response,'JSON');
		
		
		
	}
	
	
}

