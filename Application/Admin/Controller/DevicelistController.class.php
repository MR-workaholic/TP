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
		
	}
	
}