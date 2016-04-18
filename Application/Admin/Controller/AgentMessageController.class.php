<?php
namespace Admin\Controller;
use Think\Controller;

class AgentMessageController extends Controller {
    public function showBasicMsg(){
        $call = A('Publiccode');
        $call->check_valid_user();
        $this->display('./GLLogin/Signin/zui-master-me/Agent/AgentBasicMessage.html');
    }
    
    public function showDeviceList(){
        $call = A('Publiccode');
        $call->check_valid_user();
        $this->display('./GLLogin/Signin/zui-master-me/Agent/DeviceList.html');
    }
    
    public function showMerchantsList(){
        $call = A('Publiccode');
        $call->check_valid_user();
        $this->display('./GLLogin/Signin/zui-master-me/Agent/MerchantList.html');
    }
    
    public function AddMerchant(){
        $call = A('Publiccode');
        $call->check_valid_user();
        $this->display('./GLLogin/Signin/zui-master-me/Agent/addMerchant.html');
    }
    
    public function AgentAccountSetting(){
        $call = A('Publiccode');
        $call->check_valid_user();
        $this->display('./GLLogin/Signin/zui-master-me/Agent/accountSettings.html');
    }
    
    //显示某个路由的基本信息
    public function showDeviceDetail($routerId){
        //$routerId = I('get.routerId');
        $routerMsg = $this->devmescalling($routerId);
        $call = A('Publiccode');
        $call->check_valid_user();
        $this->assign('RouterMsg', $routerMsg);
   //    var_dump($routerMsg);
        $this->display('./GLLogin/Signin/zui-master-me/Agent/deviceDetail.html');
     // $this->display('./GLLogin/Signin/zui-master-me/Agent/addRoute.html');
    }
    
    public function showBasicMessage(){
    	
        $call = A('Publiccode');
       // $agentId = I('session.BId');
       // $agentId = 2;
        $agentId = $call->getAgentBid();
        
        
        $json = array(
            "op" => "query",
            "where" => "where BId = '{$agentId}'",
        );
        
        $json = json_encode($json);
        
        
        $jsonResult = $call->AccountHandle($json);

        $agentMsg['agentname']     = $jsonResult['rows'][0]['Name'];
        $agentMsg['agent']         = $jsonResult['rows'][0]['Contact'];
        $agentMsg['agentContact']  = $jsonResult['rows'][0]['ContactInfo'];
        $agentMsg['agentAddress']  = $jsonResult['rows'][0]['Address'];
        $agentMsg['shoplongitude'] = $jsonResult['rows'][0]['Longitude'];
        $agentMsg['shoplatitude']  = $jsonResult['rows'][0]['Latitude'];
        $agentMsg['agentId']       = $jsonResult['rows'][0]['Num'];
        $agentMsg['agentNote']     = $jsonResult['rows'][0]['Remark'];
            
        $response['data'] = $agentMsg;
        $response['status'] = 1;
        $response['info'] = '';
        $response['type'] = 'JSON';
        $this->ajaxReturn($response,'JSON');
        
    }
    
    public function updateAgentInfo(){
    	
        $call = A('Publiccode');
        $agentId = I('post.agentId');
        
        $json = array(
            "op" => "query",
            "where" => "where Num = '{$agentId}'",
        );
        
        $json = json_encode($json);
        $jsonResult = $call->AccountHandle($json);

        $jsonResult['rows'][0]['Name'] = I('post.agentname');
        $jsonResult['rows'][0]['Contact'] = I('post.agent');
        $jsonResult['rows'][0]['Address'] = I('post.agentAddress');
        $jsonResult['rows'][0]['Longitude'] = I('post.shoplongitude');
        $jsonResult['rows'][0]['Latitude'] = I('post.shoplatitude');
        $jsonResult['rows'][0]['Remark'] = I('post.agentNote');
        $jsonResult['rows'][0]['ContactInfo'] = I('post.agentContact');
        


        $json1 = array(
           'op' => 'save',
		   'obj' => $jsonResult['rows'][0]
        );
        
        $json1 = json_encode($json1);
        $jsonResult1 = $call->AccountHandle($json1);
        
        //更新完毕
        
        //重新获取数据
        
    
        $jsonResult = $call->AccountHandle($json);
        

        $agentMsg['agentname']     = $jsonResult['rows'][0]['Name'];
        $agentMsg['agent']         = $jsonResult['rows'][0]['Contact'];
        $agentMsg['agentContact']  = $jsonResult['rows'][0]['ContactInfo'];
        $agentMsg['agentAddress']  = $jsonResult['rows'][0]['Address'];
        $agentMsg['shoplongitude'] = $jsonResult['rows'][0]['Longitude'];
        $agentMsg['shoplatitude']  = $jsonResult['rows'][0]['Latitude'];
        $agentMsg['agentId']       = $jsonResult['rows'][0]['Num'];
        $agentMsg['agentNote']     = $jsonResult['rows'][0]['Remark'];
        
        $response['data'] = $agentMsg;
        
        
        if($jsonResult1 == $jsonResult['rows'][0]['BId']){
            $response['status'] = 1;
        }else{
            $response['status'] = 0;
        }
        $response['info'] = '';
        $response['type'] = 'JSON';
        $this->ajaxReturn($response,'JSON');
    }
    
  
    
 
    
//获取路由列表
    public function getRouterList(){
    	
//     	$agentid = I('session.BId');
     	//$agentid = 12;
    	$call = A('Publiccode');
    	$agentid = $call->getAgentBid();
        $pageSize=I('post.PageSize');
        $pageNum=I('post.PageNum');
       
        $json = array(
            "op" => "query",
            "where" => "where AgentId = {$agentid}",
            "rows" =>$pageSize,
            "page"=> $pageNum,
        );
        
        $json = json_encode($json);
        
        $result = $call->RouterHandle($json);

        
        if($result['total'] == 0 || !$result)
        {
        	$response['data']['totalPage'] = 1;
        	$response['data']['isSearch'] = 0;
        	$response['status'] = 0;
        	$response['info'] = '';
        	$response['type'] = 'JSON';
        	$this->ajaxReturn($response,'JSON');
        	
        }else{
        	
        	$response['data']['routerList'] = $result['rows'];
        	$response['data']['totalPage'] = ceil($result['total']/$pageSize);
        	$response['data']['isSearch'] = 0;
        	$response['status'] = 1;
        	$response['info'] = '';
        	
        	$response['type'] = 'JSON';
        	$this->ajaxReturn($response,'JSON');
        	
        }
        
       


    }
    
    //获取搜索结果的路由列表
    
    public function searchRouterList(){
    	
    	$call = A('Publiccode');
    	$key = I('post.key');
    	$routerKeyword = I('post.routerKeyword');
    	$pageSize = I('post.PageSize');
    	$pageNum = I('post.PageNum');
    
    	$json = array(
    			'op' => 'query',
    			'where' => "where {$key} = '{$routerKeyword}'",
    			'rows' => $pageSize,
    			'page' => $pageNum
    	);
    	
    	$json = json_encode($json);
    	
    	$result = $call->RouterHandle($json);
 
    	
    	if($result['total'] == 0 || !$result)
    	{
    		
    		$response['data']['totalPage'] = 1;
    		$response['data']['isSearch'] = 1;
    		$response['status'] = 0;
    		$response['info'] = '';
    		$response['type'] = 'JSON';
    		$this->ajaxReturn($response,'JSON');
    		
    		
    	}else{
    		
    	
    	
    	$response['data']['routerList'] = $result['rows'];
    	$response['data']['totalPage'] = ceil($result['total']/$pageSize);
    	$response['data']['isSearch'] = 1;
    	$response['status'] = 1;
    	$response['info'] = '';
    	$response['type'] = 'JSON';
    	$this->ajaxReturn($response,'JSON');
    	
    	}
    	
    	
    }
    
    //获取商家列表
    public function getMerchantList(){
    	
//     	$agentid = I('session.BId');
    	//$agentid  = 12;
    	$call     = A('Publiccode');
    	
    	$agentid = $call->getAgentBid();
    	
    	$PageSize = I('post.PageSize');
    	$pageNum  = I('post.PageNum');
    
    	$json = array(
    			"op" => "query",
    			"where" => "where Role = '普通商家' and AgentId = {$agentid}",
    			"rows"  => $PageSize,
    			"page"  => $pageNum,
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
    		
    		
    	}else{
    		
    		$response['data']['merchantList'] = $result['rows'];
    		$response['data']['totalPage'] = ceil($result['total']/$PageSize);
    		$response['data']['isSearch'] = 0;
    		$response['status'] = 1;
    		$response['info'] = '';
    		 
    		$response['type'] = 'JSON';
    		$this->ajaxReturn($response,'JSON');
    		
    	}
    	
    	
    	
    	
    	
    }
    
    //搜索商家列表结果
    public function searchMerchantList()
    {
    	$call = A('Publiccode');
    	$key = I('post.key');
    	$merchantKeyword = I('post.merchantKeyword');
    	$PageSize = I('post.PageSize');
    	$pageNum  = I('post.PageNum');
    	//$agentid  = 12;
//     	$agentid = I('session.BId');
    	$agentid = $call->getAgentBid();
		
    	
    	$json = array(
    			"op" => "query",
    			"where" => "where {$key} = '{$merchantKeyword}' and AgentId = {$agentid}",
    			"rows"  => $PageSize,
    			"page"  => $pageNum,
    	);
    	 
    	$json = json_encode($json);
    	 
    	$result = $call->AccountHandle($json);
    	
    	if ($result['total'] == 0 || !$result )
    	{
    		
    		$response['data']['totalPage'] = 1;
    		$response['data']['isSearch'] = 1;
    		$response['status'] = 0;
    		$response['info'] = '';
    		
    		$response['type'] = 'JSON';
    		$this->ajaxReturn($response,'JSON');
    		
    	}else{
    		
    		$response['data']['merchantList'] = $result['rows'];
    		$response['data']['totalPage'] = ceil($result['total']/$PageSize);
    		$response['data']['isSearch'] = 1;
    		$response['status'] = 1;
    		$response['info'] = '';
    		
    		$response['type'] = 'JSON';
    		$this->ajaxReturn($response,'JSON');
    		
    	}
    	
	
    }
    
    
  //删除路由
    public function deleteRouter(){
        $call = A('Publiccode');
        $routerId = I('post.routerId');
        $rowId =  I('post.rowId');
        //通过先勤接口删除路由
        $json = array(
            "op" => "del",
            "where" => "where RouterId = {$routerId}",
        );      
        $json = json_encode($json);       
        $result = $call->RouterHandle($json);
        
        $response['data']['rowId'] = $rowId;
        $response['data']['routerId'] = $routerId;
        if(result == ''){
            $response['status'] = 0;
            $response['info'] = '';
        }else {
            $response['status'] = 1;
            $response['info'] = '';
        }
        $response['type'] = 'JSON';
        $this->ajaxReturn($response,'JSON');
    } 
    
    //查看某一个路由器的详细信息
    public function devmescalling($routerId){
        $call = A('Publiccode');
        //获取路由信息
        $routerjson = array(
            "op" => "query",
            "where" => "where RouterId = {$routerId}",
        );
        $routerjson = json_encode($routerjson);
        $routerInfoResult = $call->RouterHandle($routerjson);
        
        //获取在线用户人数
        $onlineUserjson = array(
            "op" => "count",
            "where" => "where RouterMac = '{$routerInfoResult['rows'][0]['MAC']}' AND State='在线'",
        );
		$onlineUserjson = json_encode($onlineUserjson);		
		$onlineUserCount = $call->ClientRecordHandle($onlineUserjson);
        
		$data['RouterId']      = $routerInfoResult['rows'][0]['RouterId'];
		$data['SN']            = $routerInfoResult['rows'][0]['SN'];
		$data['RouterName']    = $routerInfoResult['rows'][0]['RouterName'];
		$data['FirmwareVer']   = $routerInfoResult['rows'][0]['FirmwareVer'];
		$data['State']         = $routerInfoResult['rows'][0]['State'];
		$data['MAC']           = $routerInfoResult['rows'][0]['Mac'];
		$data['PLCmac']        = $routerInfoResult['rows'][0]['PLCMac'];
		$data['PLCwidth']      = $routerInfoResult['rows'][0]['PLCBandwidth'];	
		$data['PLCName']       = $routerInfoResult['rows'][0]['PLCName'];
		$data['onlineUserNum'] = $onlineUserCount;
		
		//获取SSID
// 		$ssidJson = array(
// 			'op' => 'getSetting',
// 			'RouterMac' => "{$routerInfoResult['rows'][0]['MAC']}",	
// 		);

				$ssidJson = array(
					'op' => 'getSetting',
					'RouterMac' => "00:03:7F:11:20:B0",
				);
				
				$ssidJson = json_encode($ssidJson);
				
				$result = $call->RouterHandle($ssidJson);
		
		$data['SSID'] = $result['Wlan']['ssid'];
		
		
		return $data;
    }
    
    //删除商家
    public function deleteMerchant(){
    	
    	$call = A('Publiccode');
    	$BId = I('post.BId');
    	$rowId =  I('post.rowId');
    	
    	//通过先勤接口删除用户
    	$json = array(
    			"op" => "del",
    			"where" => "where BId = {$BId}",
    	);
    	$json = json_encode($json);
    	$result = $call->AccountHandle($json);
    
    	$response['data']['rowId'] = $rowId;
    	$response['data']['BId'] = $BId;
    	if(result == ''){
    		$response['status'] = 0;
    		$response['info'] = '';
    	}else {
    		$response['status'] = 1;
    		$response['info'] = '';
    	}
    	$response['type'] = 'JSON';
    	$this->ajaxReturn($response,'JSON');
    }
    
    public function addRoute($uid)
    {
    	$this->assign('businessId',$uid);
    	$this->assign('action', 'ADD');
    	//$this->assign('type', I('session.type'));
    	$this->display('./GLLogin/Signin/zui-master-me/Agent/addRoute.html');
    }
    
    public function deleteRoute($uid)
    {
    	$this->assign('businessId',$uid);
    	$this->assign('action', 'DELETE');
    	//$this->assign('type', I('session.type'));
    	$this->display('./GLLogin/Signin/zui-master-me/Agent/addRoute.html');
    }
    
    public function showRouteListforAddRoute()
    {
    	$call = A('Publiccode');
    	$pageNum = I('post.PageNum');
    	$pageSize = I('post.PageSize');
    	$type = I('session.type');
//     	$agentid = I('session.BId');
    	$agentid = $call->getAgentBid();
    	
    	if ($type == '代理商')
    	{
    		$json = array(
    				'op' => 'query',
    				'where' => "where AgentId = {$agentid} and BusinessId = 0",
    				"rows"  => $pageSize,
    				"page"  => $pageNum,
    		);
    		
    	}else {
    		
    		$json = array(
    				'op' => 'query',
    				'where' => 'where AgentId = 0',
    				"rows"  => $pageSize,
    				"page"  => $pageNum,
    		);
    		
    	}
    	
    	
    	
    	
    	$json = json_encode($json);
    	
    	$result = $call->RouterHandle($json);
    	
    	$response['data']['routerList'] = $result['rows'];
    	$response['data']['totalPage'] = ceil($result['total']/$pageSize);
    	$response['status'] = 1;
    	$response['info'] = '';
    	$response['type'] = 'JSON';
    	$this->ajaxReturn($response,'JSON');
    	
    	
    }
    
    public function showRouteListforDelRoute(){
    	
    	$call = A('Publiccode');
    	$pageNum = I('post.PageNum');
    	$pageSize = I('post.PageSize');
    	$businessId = I('post.businessId');
    	$type = I('session.type');
//     	$agentid = I('session.BId');
    	$agentid = $call->getAgentBid();
    	
    	if ($type == '代理商')
    	{
    		
    		$json = array(
    			'op' => 'query',
    			'where' => "where AgentId = {$agentid} and BusinessId = {$businessId}",
    			"rows"  => $pageSize,
    			"page"  => $pageNum,
    	);
    	
    	}else {
    	
    		$json = array(
    				'op' => 'query',
    				'where' => "where AgentId = ".$businessId,
    				"rows"  => $pageSize,
    				"page"  => $pageNum,
    		);
    	
    	}
    	 
    	 
    
    	 
    	$json = json_encode($json);
    	 
    	$result = $call->RouterHandle($json);
    	 
    	$response['data']['routerList'] = $result['rows'];
    	$response['data']['totalPage'] = ceil($result['total']/$pageSize);
    	$response['status'] = 1;
    	$response['info'] = '';
    	$response['type'] = 'JSON';
    	$this->ajaxReturn($response,'JSON');
    	
    }
    
    public  function addRouteforMerchant(){
    	
    	$businessId = I('post.businessId');
    	$route = I('post.route');
    	$call = A('Publiccode');
    	$type = I('session.type');
    	
    	if (!empty($route))
    	{
    		
    		for ($i=0; $i<count($route); $i++)
    		{
    			$json = array(
    					"op" => "query",
    					"where" => "where RouterId = {$route[$i]}",
    			);
    			
    			$json = json_encode($json);
    			
    			$result = $call->RouterHandle($json);
    			
    			if ($type == '代理商')
    			{
    				$result['rows'][0]['BusinessId'] = $businessId;
    			}else{
    				$result['rows'][0]['AgentId'] = $businessId;
    			}
    			

    			$json1 = array(
    					"op" => "save",
    					"obj" => $result['rows'][0]
    			);
    				
    			$json1 = json_encode($json1);
    				
    			$call->RouterHandle($json1);
    			
    			
    			
    		}
    		
    		
    		
    		$response['status'] = 1;
    		$response['info'] = '';
    		$response['type'] = 'JSON';
    		$this->ajaxReturn($response,'JSON');
    		
    	}else{
    		$response['status'] = 0;
    		$response['info'] = '';
    		$response['type'] = 'JSON';
    		$this->ajaxReturn($response,'JSON');
    	}
    	
    	
    	
    	
    	
    }
    
    public function deleteRouteforMerchant()
    {
    	
    	$businessId = I('post.businessId');
    	$route = I('post.route');
    	$call = A('Publiccode');
    	$type = I('session.type');
    	 
    	if (!empty($route))
    	{
    	
    		for ($i=0; $i<count($route); $i++)
    		{
    		$json = array(
    				"op" => "query",
    				"where" => "where RouterId = {$route[$i]}",
    		);
    				 
    		$json = json_encode($json);
    		 
    		$result = $call->RouterHandle($json);
    		 
    		if ($type == '代理商')
    		{
    			unset($result['rows'][0]['BusinessName']);
    			unset($result['rows'][0]['BusinessId']);
    			
    		}else{
    			unset($result['rows'][0]['AgentName']);
    			unset($result['rows'][0]['AgentId']);
    		}
    		
    	
    		$json1 = array(
    		"op" => "save",
    		"obj" => $result['rows'][0]
    		);
    	
    		$json1 = json_encode($json1);
    	
    		$call->RouterHandle($json1);
    		 
    		 
    		 
    		}
    	
    	
    	
    		$response['status'] = 1;
    		$response['info'] = '';
    		$response['type'] = 'JSON';
    		$this->ajaxReturn($response,'JSON');
    	
    	}else{
    	$response['status'] = 0;
    	$response['info'] = '';
    	$response['type'] = 'JSON';
    	$this->ajaxReturn($response,'JSON');
    	}
    	
    } 
    
    
}