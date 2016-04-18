<?php
namespace Admin\Controller;
use Think\Controller;

class AgentController extends Controller {
	
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	
	public function show()
	{
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Agent/agentIndex.html');

		
	}
	
	public function showIndex()
	{
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Agent/HomePage.html');
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
	
	public function indexInfo(){
		
		$call = A('Publiccode');
	    $agentid = $call->getAgentBid();
// 		$agentid = session('proxyBId');
	    //$agentid = 12;
	   
	     //  在线设备总数
	    $onlineRouterjson = array(
	        "op" => "count",
	        "where" => "where AgentId = '{$agentid}' and State='在线'",
	    );    
	    $onlineRouterjson = json_encode($onlineRouterjson);   
	    $onlineRouterCount = $call->RouterHandle($onlineRouterjson);
	    
        //离线设备总数
	    $offlineRouterjson = array(
	        "op" => "count",
	        "where" => "where AgentId = '{$agentid}' and State='离线'",
	    );
	    $offlineRouterjson = json_encode($offlineRouterjson);
	    $offlineRouterCount = $call->RouterHandle($offlineRouterjson);
	    
		//设备总数
	    $totalRouterjson = array(
	        "op" => "count",
	        "where" => "where AgentId = '{$agentid}'",
	    );
	    $totalRouterjson = json_encode($totalRouterjson);
	    $totalRouterCount = $call->RouterHandle($totalRouterjson);
	    
	
	    //--------在线客流量------------
	    //获取代理商下的商家Num列表
	    $MerchantNumjson = array(
	        "op" => "query",
	        "where" => "where Role = '普通商家' and AgentId='{$agentid}'",
	    );
	    $MerchantNumjson = json_encode($MerchantNumjson);
	    $merchantResult = $call->AccountHandle($MerchantNumjson);
	    
	    //拥有商家总数
	    $merchantCount = $merchantResult['total'];
	    
	    if($merchantCount != 0)
	    {
	    	$mercharsList="(";
	    	for($i = 0; $i < $merchantCount - 1; $i++){
	    		$mercharsList=$mercharsList.$merchantResult['rows'][$i]['BId'].",";
	    	}
	    	$mercharsList=$mercharsList.$merchantResult['rows'][$merchantCount-1]['BId'].")";
	    	//在线客流量
	    	$onlientClientNumjson = array(
	    			"op" => "count",
	    			"where" => "where BId IN {$mercharsList} and State = '在线'",
	    	);
	    	$onlientClientNumjson = json_encode($onlientClientNumjson);
	    	$onlientClientNumResult = $call->ClientRecordHandle($onlientClientNumjson);
	    	
	    }else{
	    	$onlientClientNumResult = 0;
	    }
	    
        
	    
	    $data['onlineDevices'] = $onlineRouterCount.'/'.$totalRouterCount;
	    $data['merchantTotal'] = $merchantCount;
	    $data['onlineClients'] = $onlientClientNumResult;
	    $data['offlineDevices'] = $offlineRouterCount.'/'.$totalRouterCount;
		$response['data'] = $data;
		$response['status'] = 1;
		$response['type'] = 'JSON';
		$response['info'] = ''.json_encode($_SESSION);
		
		$this->ajaxReturn($response, 'JSON');
		
	}
	

	
}