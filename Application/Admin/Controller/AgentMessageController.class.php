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
        $agentId = 2;
        if(I('session.proxyId',0) != 0){
            $agentId=I('session.proxyId');
        }
        $json = array(
            "op" => "query",
            "where" => "where BId = '{$agentId}'",
        );
        
        $json = json_encode($json);
        
        
        $jsonResult = $call->AccountHandle($json);

            $agentMsg['agentname']= $jsonResult['rows'][0]['Name'];
            $agentMsg['agent']= $jsonResult['rows'][0]['Contact'];
            $agentMsg['agentContact']= "020-12345678";//$jsonResult['rows'][0]['Phone'];
            $agentMsg['agentAddress']= $jsonResult['rows'][0]['Address'];
            $agentMsg['shoplongitude']= 113.33395;
            $agentMsg['shoplatitude']= 23.149136;
            $agentMsg['agentId']=$jsonResult['rows'][0]['Num'];
            $agentMsg['agentNote']= "test";
            
        $response['data'] = $agentMsg;
        $response['status'] = 1;
        $response['info'] = '';
        $response['type'] = 'JSON';
        $this->ajaxReturn($response,'JSON');
        
    }
    
    public function updateAgentInfo(){
    	
        $call = A('Publiccode');
        $agentId = $_POST['agentId'];
        
        $json = array(
            "op" => "query",
            "where" => "where Num = '{$agentId}'",
        );
        
        $json = json_encode($json);
        $jsonResult = $call->AccountHandle($json);

        $jsonResult['rows'][0]['Name'] = $_POST['agentname'];
        $jsonResult['rows'][0]['Contact'] = $_POST['agent'];
        //$jsonResult['rows'][0]['Phone'] = $_POST['agentContact'];
        $jsonResult['rows'][0]['Address'] = $_POST['agentAddress'];


        $json1 = array(
           'op' => 'save',
		   'obj' => $jsonResult['rows'][0]
        );
        
        $json1 = json_encode($json1);
        $jsonResult1 = $call->AccountHandle($json1);
        
        //更新完毕
        
        //重新获取数据
        
    
        $jsonResult = $call->AccountHandle($json);
        
        $agentMsg['agentname']= $jsonResult['rows'][0]['Name'];
        $agentMsg['agent']= $jsonResult['rows'][0]['Contact'];
        $agentMsg['agentContact']= "020-12345678";//$jsonResult['rows'][0]['Phone'];
        $agentMsg['agentAddress']= $jsonResult['rows'][0]['Address'];
        $agentMsg['shoplongitude']= 113.33395;
        $agentMsg['shoplatitude']= 23.149136;
        $agentMsg['agentId']=$jsonResult['rows'][0]['Num'];
        $agentMsg['agentNote']= "test";
        
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
    	
     	$agentid = 12;
        $pageSize=I('post.PageSize');
        $pageNum=I('post.PageNum');
        $call = A('Publiccode');
        $json = array(
            "op" => "query",
            "where" => "where AgentId = {$agentid}",
            "rows" =>$pageSize,
            "page"=> $pageNum,
        );
        
        $json = json_encode($json);
        
        $result = $call->RouterHandle($json);
        
        $response['data']['routerList'] = $result['rows'];
        $response['data']['totalPage'] = ceil($result['total']/$pageSize);
        $response['data']['isSearch'] = 0;
        $response['status'] = 1;
        $response['info'] = '';
 
        $response['type'] = 'JSON';
        $this->ajaxReturn($response,'JSON');


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
    	
    	$response['data']['routerList'] = $result['rows'];
    	$response['data']['totalPage'] = ceil($result['total']/$pageSize);
    	$response['data']['isSearch'] = 1;
    	$response['status'] = 1;
    	$response['info'] = '';
    	$response['type'] = 'JSON';
    	$this->ajaxReturn($response,'JSON');
    	
    	
    	
    	
    }
    
    //获取商家列表
    public function getrMerchantList(){
    	
    	$agentid  = 12;
    	$call     = A('Publiccode');
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
    	$response['data']['merchantList'] = $result['rows'];
    	$response['data']['totalPage'] = ceil($result['total']/$PageSize);
    	$response['data']['isSearch'] = 0;
    	$response['status'] = 1;
    	$response['info'] = '';
    	
    	$response['type'] = 'JSON';
    	$this->ajaxReturn($response,'JSON');
    	
    	
    	
    	
    }
    
    //搜索商家列表结果
    public function searchMerchantList()
    {
    	$call = A('Publiccode');
    	$key = I('post.key');
    	$merchantKeyword = I('post.merchantKeyword');
    	$PageSize = I('post.PageSize');
    	$pageNum  = I('post.PageNum');
    	$agentid  = 12;
    	
    	$json = array(
    			"op" => "query",
    			"where" => "where {$key} = '{$merchantKeyword}' and AgentId = {$agentid}",
    			"rows"  => $PageSize,
    			"page"  => $pageNum,
    	);
    	 
    	$json = json_encode($json);
    	 
    	$result = $call->AccountHandle($json);
    	$response['data']['merchantList'] = $result['rows'];
    	$response['data']['totalPage'] = ceil($result['total']/$PageSize);
    	$response['data']['isSearch'] = 1;
    	$response['status'] = 1;
    	$response['info'] = '';
    	 
    	$response['type'] = 'JSON';
    	$this->ajaxReturn($response,'JSON');
    	
    	
    	
    	
    	
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
        
		$data['RouterId']=$routerInfoResult['rows'][0]['RouterId'];
		$data['SN']=$routerInfoResult['rows'][0]['SN'];
		$data['FirmwareVer']=$routerInfoResult['rows'][0]['FirmwareVer'];
		$data['State']=$routerInfoResult['rows'][0]['State'];
		$data['MAC']=$routerInfoResult['rows'][0]['Mac'];
		$data['PLCmac']='PLC名字';
		$data['PLCwidth']='测试PLC带宽';	
		$data['PLCName']='测试PLC网络名称';
		$data['SSID']='测试SSID';
		$data['onlineUserNum']=$onlineUserCount;
		
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
    	
    	if ($type == '代理商')
    	{
    		$json = array(
    				'op' => 'query',
    				'where' => "where AgentId = 12 and BusinessId = 0",
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
    	
    	if ($type == '代理商')
    	{
    		
    		$json = array(
    			'op' => 'query',
    			'where' => "where AgentId = 12 and BusinessId = ".$businessId,
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