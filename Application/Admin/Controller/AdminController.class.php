<?php

namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	
	
	public function show()
	{
		
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/accountSettings.html');
		
	}
	
	public function showAgentList()
	{
	
	    $call = A('Publiccode');
	    $call->check_valid_user();
	    $this->display('./GLLogin/Signin/zui-master-me/Admin/AgentsMessage.html');
	
	}

	public function showDeviceList(){
	    $call = A('Publiccode');
	    $call->check_valid_user();
	    $this->display('./GLLogin/Signin/zui-master-me/Admin/DeviceList.html');
	}
	
	public function showStatisticInfo(){
	    $call = A('Publiccode');
	    $call->check_valid_user();
	    $this->display('./GLLogin/Signin/zui-master-me/Admin/Statistics.html');
	}
	
	//进入代理商账户
	public function showAgentIndex(){
		
		$call = A('Publiccode');
		$call->check_valid_user();
		$hosts = C('Hosts');
		
	    //以哪一个代理商进入
	    $proxyAgentNum = I('get.proxyId');  //代理商的num

	    session('proxyNum', $proxyAgentNum);

	    
	    $this->success('跳转中…… ', 'http://'.$hosts.'/TP/index.php/admin/Merchant/showAgent');

	}
	
	//从先勤接口中获取代理商列表
	public function getAgentsInfo(){
	   
	    $pageSize = I('post.PageSize');
	    $pageNum  = I('post.PageNum');
	    $call = A('Publiccode');
		
		$json = array(
				"op" => "query",
				"where" => "where Role = '代理商'",
		        "rows" =>$pageSize,
		        "page" => $pageNum
		);
		$json = json_encode($json);
		$result = $call->AccountHandle($json);
		
		if ($result['total'] == 0 || !$result)
		{
			
			$response['data']['totalPage'] = 1;
			$response['data']['isSearch'] = 0;
			$response['status'] = 0;
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response,'JSON');
			
		}else {
	
		
		foreach ($result['rows'] as $key=>$value){
			
		    $data[$key]['agentId'] = $value['Num'];
		    $data[$key]['agentName'] = $value['Name'];
		    $data[$key]['BId'] = $value['BId'];
		    $data[$key]['Num'] = $value['Num'];
		    //商户拥有数的条件语句
		    $MerchantNumjson = array(
		        "op" => "count",
		        "where" => "where Role = '普通商家' and AgentId='{$value['BId']}'",
		    );
		    $MerchantNumjson = json_encode($MerchantNumjson);
		    $data[$key]['MerchantNum'] = $call->AccountHandle($MerchantNumjson);
		    
		    //设备拥有数的条件语句
		    $RouterNumjson = array(
		        "op" => "count",
		        "where" => "where AgentId='{$value['BId']}'",
		    );
		    $RouterNumjson = json_encode($RouterNumjson);
		    $data[$key]['routerNum'] = $call->RouterHandle($RouterNumjson);
		    
		    //在线设备拥有数
		    $onlineRouterNumjson = array(
		        "op" => "count",
		        "where" => "where State='在线' and AgentId='{$value['BId']}'",
		    );
		    
		    $onlineRouterNumjson = json_encode($onlineRouterNumjson);
		    $data[$key]['onlineRouterNum'] = $call->RouterHandle($onlineRouterNumjson);

		    $data[$key]['note']='test';

		}
	    
	    $response['data']['agentsList'] = $data;
	    $response['data']['totalPage'] = ceil($result['total']/$pageSize);
	    $response['data']['isSearch'] = 0;
	    $response['status'] = 1;
	    $response['info'] = '';
	    $response['type'] = 'JSON';
	    $this->ajaxReturn($response,'JSON');
		}
	}
	
	//搜索一个商家的信息
	public function searchAgentList(){
		
	    $call = A('Publiccode');
	    $agentKeyword = I('post.agentKeyword');
	    $key = I('post.key');
	    $pageSize = I('post.PageSize');
		$pageNum = I('post.PageNum');
	    
	    $json = array(
	        "op" => "query",
	        "where" => "where Role = '代理商' and {$key} like '%{$agentKeyword}%'",
	        'rows' => $pageSize,
	        'page' => $pageNum
	        
	    );
	    $json = json_encode($json);
	    $result = $call->AccountHandle($json);
	     
	  
	    if($result['total'] == 0 || !$result)
	    {
	    	
	    	$response['data']['totalPage'] = 1;
	    	$response['data']['isSearch'] = 1;
	    	$response['status'] = 0;
	    	$response['info'] = '';
	    	$response['type'] = 'JSON';
	    	$this->ajaxReturn($response,'JSON');
	    	
	    }else {
	    	


	    foreach ($result['rows'] as $key=>$value)
	    	{
			
		    $data[$key]['agentId'] = $value['Num'];
		    $data[$key]['agentName'] = $value['Name'];
		    $data[$key]['BId'] = $value['BId'];
		    $data[$key]['Num'] = $value['Num'];
		    //商户拥有数的条件语句
		    $MerchantNumjson = array(
		        "op" => "count",
		        "where" => "where Role = '普通商家' and AgentId='{$value['BId']}'",
		    );
		    $MerchantNumjson = json_encode($MerchantNumjson);
		    $data[$key]['MerchantNum'] = $call->AccountHandle($MerchantNumjson);
		    
		    //设备拥有数的条件语句
		    $RouterNumjson = array(
		        "op" => "count",
		        "where" => "where AgentId='{$value['BId']}'",
		    );
		    $RouterNumjson = json_encode($RouterNumjson);
		    $data[$key]['routerNum'] = $call->RouterHandle($RouterNumjson);
		    
		    //在线设备拥有数
		    $onlineRouterNumjson = array(
		        "op" => "count",
		        "where" => "where State='在线' and AgentId='{$value['BId']}'",
		    );
		    
		    $onlineRouterNumjson = json_encode($onlineRouterNumjson);
		    $data[$key]['onlineRouterNum'] = $call->RouterHandle($onlineRouterNumjson);

		    $data[$key]['note']='test';

		}


	    
	    $response['data']['agentsList'] = $data;
	    $response['data']['totalPage'] = ceil($result['total']/$pageSize);
	    $response['data']['isSearch'] = 1;
	    $response['status'] = 1;
	    $response['info'] = '';
	    $response['type'] = 'JSON';
	    $this->ajaxReturn($response,'JSON');
	    
	    }
	}
	
	
	//获取搜索的路由列表
	public function searchRouterList(){
		
		$key = I('post.key');
		$routerKeyword = I('post.routerKeyword');
		$pageSize = I('post.PageSize');
		$pageNum = I('post.PageNum');
		$call = A('Publiccode');
		
		$json = array(
			'op' => 'query',
			'where' => "where {$key} like '%{$routerKeyword}%'",
			'rows' => $pageSize,
			'page' => $pageNum
		);
		
		$json = json_encode($json);
		
		$result = $call->RouterHandle($json);
// 		$result['total'] = 0;
		
		if($result['total'] == 0 || !$result)
		{

			
			$response['data']['totalPage'] = 1;
			$response['data']['isSearch'] = 1;
			$response['status'] = 0;
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response,'JSON');
			
		}else{
			
			$response['data']['routerMsg'] = $result['rows'];
			$response['data']['totalPage'] = ceil($result['total']/$pageSize);
			$response['data']['isSearch'] = 1;
			$response['status'] = 1;
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response,'JSON');
			
		}
		
		
		
		
	}
	
	
	
	//获取路由器的总数
	public function getToatalRoutersNum(){
	    $call = A('Publiccode');
	
	    $json = array(
	        "op" => "count",
	    );
	
	    $json = json_encode($json);
	
	    $count = $call->RouterHandle($json);
	
	
	    $response['data']['totalPage'] = ceil($count/10);
	    if($count == ""){
	        $response['status'] = 0;
	        $response['info'] = '查询总数失败';
	    }else{
	        $response['status'] = 1;
	        $response['info'] = '';
	    }
	    $response['type'] = 'JSON';
	    $this->ajaxReturn($response,'JSON');
	}
	
	//获取路由列表
	public function getRouterList(){
	    $pageSize=I('post.PageSize');
	    $pageNum=I('post.PageNum');
	    
	    $call = A('Publiccode');
	    $json = array(
	        "op" => "query",
	        "rows" =>$pageSize,
	        "page" => $pageNum
	    );
	
	    $json = json_encode($json);
	
	    $result = $call->RouterHandle($json);
	    
	    if ($result['total'] == 0 || !$result)
	    {
	    	
	    	$response['data']['totalPage'] = 1;
	    	$response['data']['isSearch'] = 0;
	    	$response['status'] = 0;
	    	$response['info'] = '';
	    	// $response['totoalRow'] = $result['total'];
	    	$response['type'] = 'JSON';
	    	$this->ajaxReturn($response,'JSON');
	    	
	    }else {
	    
		    $response['data']['routerMsg'] = $result['rows'];
		    $response['data']['totalPage'] = ceil($result['total']/$pageSize);
		    $response['data']['isSearch'] = 0;
		    $response['status'] = 1;
		    $response['info'] = '';
		   // $response['totoalRow'] = $result['total'];
		    $response['type'] = 'JSON';
		    $this->ajaxReturn($response,'JSON');
	    
	    }
	
	
	}
	
	//获取统计页面的代理商列表
	public function getAgentList4Static(){
		
	    $pageSize = I('post.PageSize');
	    $pageNum  = I('post.PageNum');
	    $call = A('Publiccode');
	    
	    $json = array(
	        "op" => "query",
	        "where" => "where Role = '代理商'",
	        "rows" =>$pageSize,
	        "page" => $pageNum
	    );
	    $json = json_encode($json);
	    $result = $call->AccountHandle($json);
	    
	    if ($result['total'] == 0 || !$result)
	    {
	    	
	    	$response['data']['totalPage'] = 1;
	    	$response['data']['isSearch'] = 0;
	    	$response['status'] = 0;
	    	$response['info'] = '';
	    	$response['type'] = 'JSON';
	    	
	    }else {
	    	

	    	foreach ($result['rows'] as $k=>$v)
	    	{
	    		$data[$k]['agentId'] = $v['BId'];
	    		$data[$k]['agentNum'] = $v['Num'];
	    	    $data[$k]['agentName'] = $v['Name'];
	    	}
	    	 
	    	$response['data']['AgentList'] = $data;
	    	$response['data']['totalPage'] = ceil($result['total']/$pageSize);
	    	$response['data']['isSearch'] = 0;
	    	$response['status'] = 1;
	    	$response['info'] = '';
	    	$response['type'] = 'JSON';
	    	$this->ajaxReturn($response,'JSON');
	    	
	    }

	    
	}
	
	//在统计页面上搜索代理商
	public function searchAgent4Statistic(){
	    
	    $call = A('Publiccode');
	    $agentKeyword = I('post.agentKeyword');
	    $pageSize = I('post.PageSize');
	    $pageNum = I('post.PageNum');
	    $key = I('post.key');
	    
	    $json = array(
	        "op" => "query",
	        "where" => "where Role = '代理商' and {$key} like '%{$agentKeyword}%'",
	        "rows" => $pageSize,
	        "page" => $pageNum
	    );
	    $json = json_encode($json);
	    $result = $call->AccountHandle($json);

	    
	    if($result['total'] == 0 || !$result)
	    {
	    	
	    	$response['data']['totalPage'] = 1;
	    	$response['data']['isSearch'] = 1;
	    	$response['status'] = 0;
	    	$response['info'] = '';
	    	$response['type'] = 'JSON';
	    	$this->ajaxReturn($response,'JSON');
	    	
	    }else{
	    	
	    	foreach ($result['rows'] as $key=>$value)
	    	{
	    		$data[$key]['agentId'] = $value['BId'];
	    		$data[$key]['agentNum'] = $value['Num'];
	    		$data[$key]['agentName'] = $value['Name'];
	    		
	    	}
	    	
	    	
	    	$response['data']['AgentList'] = $data;
	    	$response['data']['totalPage'] = ceil($result['total']/$pageSize);
	    	$response['data']['isSearch'] = 1;
	    	$response['status'] = 1;
	    	$response['info'] = '';
	    	$response['type'] = 'JSON';
	    	$this->ajaxReturn($response,'JSON');
	    	
	    }
	    
	   
	}
	
	
	
	
	
	
	
}

