<?php
namespace Admin\Controller;
use Think\Controller;
use common\widgets\Alert;
class TestController extends Controller {
	
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	
	public  function ws(){
		header("Content-Type:text/html;charset=UTF-8");
		
		try {
			
			$client = new \SoapClient("http://www.wiidev.com/router/service.asmx?wsdl", array('encoding'=>'UTF-8'));
// 			$client = new \SoapClient(
// 					null,
// 					array('location' =>'http://www.wiidev.com/router/service.asmx?wsdl','uri' =>'http://www.wiidev.com/router/router/')
// 			);

			
// 			$client = new \SoapClient("http://webservice.webxml.com.cn/webservices/ChinaTVprogramWebService.asmx?wsdl", array('encoding'=>'UTF-8'));
			
			var_dump($client->__getFunctions());
			print ("<br/>");
			var_dump($client->__getTypes());
			print ("<br/>");
// 			$string = $client->getAreaString();
// 			echo ' '.$string;
			
			/*
 			$result = $client->getAreaDataSet();
 			var_dump($result);

 			$res = $result->getAreaDataSetResult->any; //xml格式的结果，需要进行解析
 			*/
 			
 			/**
			 *	 XML Expat Parser处理
 			 */
 			/*
 			$p = xml_parser_create();
 			xml_parse_into_struct($p, $res, $vals, $index);
 			xml_parser_free($p);
 			echo "Index array\n";
 			print_r($index);
 			echo "\nVals array\n";
 			print_r($vals);
			print ("<br/>");
			*/
 			/**
 			 *  SimpleXML处理
 			*/
 			/*
 			
 			$xml = simplexml_load_string($res);
 			print_r($xml);
 			print ("<br/>");
 			$login = $xml->AREA;//这里返回的依然是个SimpleXMLElement对象
 			print_r($login);
 			print ("<br/>");
 			$login = (string) $xml->AREA;//在做数据比较时，注意要先强制转换
 			print_r($login);
 			print ("<br/>");
 			 */
 			
 			
 			
			/**
			 * 连接qqOnlineWebService 
			 */
 			
			/*
			$client = new \SoapClient("http://webservice.webxml.com.cn/webservices/qqOnlineWebService.asmx?wsdl", array('encoding'=>'UTF-8'));
			var_dump($client->__getFunctions());
			print ("<br/>");
			var_dump($client->__getTypes());
			print ("<br/>");
			
			$param1 = '675520216';
			//serviceParam1,serviceParam2,serviceParam3为发送参数值所对应的参数名（或service端提供的字段名）
// 			$param = array('serviceParam1' => $param1,'serviceParam2' =>$param2,'serviceParam3' => $param3);
			$param = array('qqCode' => $param1);
			
			//默认以parameters字段标示传递的参数数组(这里的web services是.net提供的，所以和php提供的Web service不同)
// 			$arr = $client->__soapCall('ServiceMethod',array('parameters' => $param));     //ServiceMethod是那个函数的名字
			//这里淡水推荐直接使用web services提供的方法，如
			$arr = $client->qqCheckOnline($param);
			
			print_r($arr);*/
			
			
		} catch (\SoapFault $e) {
			print ($e);
		}
	}
	
	/*
	 * 账号查询测试 pass
	 */
	public function xqtest_query()
	{
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
		//获取服务接口与key
// 		$client = $call->return_client();
// 		$appkey = $call->return_appkey();
		
		$phone = 12345678912;
		$role = 'hello';
		
		/*
		 * 可以使用json校验工具来检测
		 */
		$json = array(
				"op" => "query",
				"where" => "where Role = '{$role}' and Phone = {$phone}",
		);
		
		$json = json_encode($json);
		
// 		$json = '{"op": "query", "where":"where Role<>\'管理员\'", "order":"order by BId desc"}';
// 		$param = array('appkey' => $appkey, 'json' => $json,);
// 		$result = $client->Account($param);
// 		$jsonResult = json_decode($result->AccountResult);
// 		var_dump($jsonResult);
		
// 		$jsonResult = $call->object_array($jsonResult);

		$jsonResult = $call->AccountHandle($json);
		var_dump($jsonResult);
		

		echo $jsonResult['rows'][0]['LoginName'];
		echo $jsonResult['rows'][0]['Num'];
		
		
	}
	
	/*
	 * 账号更新测试，不通过
	 */
	
	public function xqtest_updata()
	{
		
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
		//获取服务接口与key
		$client = $call->return_client();
		$appkey = $call->return_appkey();
		
		//构造json参数
		$phone = 12345678912;
		$role = 'hello';
		$json = array(
				"op" => "query",
				"where" => "where Role = '{$role}' and Phone = '{$phone}'",
		);
		$json = json_encode($json);
		var_dump($json);
		
		
		//执行账户查询,返回数组
		$jsonResult = $call->AccountHandle($json);
		var_dump($jsonResult);
		
		
		
		//构造新的json参数
// 		$jsonResult['rows'][0]['BId'] = 0;
// 		$jsonResult['rows'][0]['Name'] = '商家AA';
// 		$jsonResult['rows'][0]['LoginName'] = 'sjaa';
// 		$jsonResult['rows'][0]['Phone'] = 13265478956;
// 		$jsonResult['rows'][0]['Num'] = 'SJ003';
		$jsonResult['rows'][0]['Address'] = '广州市天河区某大厦';
		$jsonResult['rows'][0]['Role'] = '普通商家';
// 		$jsonResult['rows'][0]['Weixin'] = 'sj001';
// 		$jsonResult['rows'][0]['IndexPage'] = 'www.baidu.com\mon\widgets\Alert';
		unset($jsonResult['rows'][0]['AgentName']);
		unset($jsonResult['rows'][0]['CreateTime']);
		unset($jsonResult['rows'][0]['Auth']);
		unset($jsonResult['rows'][0]['Weixin']);
		unset($jsonResult['rows'][0]['IsHidePhone']);
		unset($jsonResult['rows'][0]['AdminModify']);
		unset($jsonResult['rows'][0]['IndexPage']);
		unset($jsonResult['rows'][0]['MsgCount']);
		unset($jsonResult['rows'][0]['AgentId']);
		
		$json1 = array(
				'op' => 'save',
				'obj' => $jsonResult['rows'][0]
			
		);
		$json1 = json_encode($json1);	
		var_dump($json1);
		
// 		$jsonResult1 = $call->AccountHandle($json1);
		$param1 = array('appkey' => $appkey, 'json' => $json1,);
		$result1 = $client->Account($param1);
 		$jsonResult1 = json_decode($result1->AccountResult);
		var_dump($result1);
		
	}
	
	
	
	/*
	 * 账号删除测试 pass
	 */
	
	public function xqtest_del(){
		
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
		//获取服务接口与key
		$client = $call->return_client();
		$appkey = $call->return_appkey();
		
		//构造json参数
		$phone = 10254698745;
		$role = '普通商家 ';
		$json = array(
				"op" => "del",
				"where" => "where Role = '{$role}' and Phone = {$phone}",
		);
		$json = json_encode($json);
		var_dump($json);
		
		
		//执行账户查询,返回数组
		$jsonResult = $call->AccountHandle($json);
		var_dump($jsonResult);
		
	}
	
	/*
	 * 设备查询测试(pass)
	 */
	
	public function dev_query()
	{
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
		$BusinessId = 3;
		$json = array(
				"op" => "query",
				"where" => "where BusinessId = {$BusinessId}",
		);
		
		$json = json_encode($json);
		
		$result = $call->RouterHandle($json);
		
		var_dump($result);
		
		echo $result['rows'][0]['Mac'];
	}
	
	/*
	 * 设备添加测试
	 */
	
	public function dev_update(){
		
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
		$BusinessId = 3;
		$json = array(
				"op" => "query",
				"where" => "where BusinessId = {$BusinessId}",
		);
		
		$json = json_encode($json);
		
		$result = $call->RouterHandle($json);
		
		$result['rows'][0]['Mac'] = '10236548796520120';
		
		//下面的元素不用删除也可以更新成功
		unset($result['rows'][0]['AgentName']);
		unset($result['rows'][0]['BusinessName']);
		unset($result['rows'][0]['FirmwareVer']);
		unset($result['rows'][0]['State']);
		unset($result['rows'][0]['OnlineCount']);
		unset($result['rows'][0]['ReceiveData']);
		unset($result['rows'][0]['SendData']);
// 		unset($result['rows'][0]['AgentId']);   删除AgentId可以更新成功
// 		unset($result['rows'][0]['SN']);   删除SN不可以更新成功
		
		$json1 = array(
				"op" => "save",
				"obj" => $result['rows'][0]
		);
		
		$json1 = json_encode($json1);
		
		var_dump($json1);
		
		$result1 = $call->RouterHandle($json1);
		var_dump($result1);
		
	}
	
	/*
	 * 获取路由器配置
	 */
	
	public function dev_getsetting()
	{
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
		$RouterMac = '12345678901234567';
		$json = array(
				"op" => "getSetting",
				"RouterMac" => $RouterMac
		);
		
		$json = json_encode($json);
		
		var_dump($json);
		
		$result = $call->RouterHandle($json);
		
		var_dump($result);
		
	}
	
	
	
	
	public  function ajaxcalling(){
		$q=$_POST["calling"];
		
		$data['dinfo'] = 'hello boy';
		$data['ddata'] = 'input a letter';
		
		if($q == 'y')
		{
			$response['data'] = $data;
			
			$response['info'] = 'DONE';
			$response['status'] = 1;
			$response['type'] = 'JSON';
			$this->ajaxReturn($response,'JSON');
			
		}
		else {
			$response['status'] = 1;
			$response['type'] = 'JSON';
			$this->ajaxReturn($response,'JSON');
		}
	}
	
	public function ajaxtest(){
		$this->display();
		
	}
	
	public function ajaxhandle(){
		
		$a[]="Anna";
		$a[]="Brittany";
		$a[]="Cinderella";
		$a[]="Diana";
		$a[]="Eva";
		$a[]="Fiona";
		$a[]="Gunda";
		$a[]="Hege";
		$a[]="Inga";
		$a[]="Johanna";
		$a[]="Kitty";
		$a[]="Linda";
		$a[]="Nina";
		$a[]="Ophelia";
		$a[]="Petunia";
		$a[]="Amanda";
		$a[]="Raquel";
		$a[]="Cindy";
		$a[]="Doris";
		$a[]="Eve";
		$a[]="Evita";
		$a[]="Sunniva";
		$a[]="Tove";
		$a[]="Unni";
		$a[]="Violet";
		$a[]="Liza";
		$a[]="Elizabeth";
		$a[]="Ellen";
		$a[]="Wenche";
		$a[]="Vicky";
		//获得来自 URL 的 q 参数
		$q=$_POST["latter"];
		
		
		//如果 q 大于 0，则查找数组中的所有提示
		if (strlen($q) > 0)
		{
			$hint="";
			
			for($i=0; $i<count($a); $i++)
			{
			if (strtolower($q)==strtolower(substr($a[$i],0,strlen($q))))
			{
			if ($hint=="")
				{
				$hint=$a[$i];
				}
				else
				{
				$hint=$hint." , ".$a[$i];
				}
				}
				}
				}
				// 如果未找到提示，则把输出设置为 "no suggestion"
				// 否则设置为正确的值
				if ($hint == "")
				{
					$response['data']="no suggestion";
				}
				else
				{
					$response['data']=$hint;
				}
				
				$data['a'] = "a";
				$data['b'] = "b";
				$data['c'] = "c";
				$response['data'] = $data;
				
				$response['info'] = 'DONE';
				$response['status'] = 1;
				$response['type'] = 'JSON';
					//输出响应
// 					echo $response;
// 				$this->success('result is '.$response);
// 				$this->ajaxReturn($response,'DONE',1,'XML');
				
				$this->ajaxReturn($response,'JSON');
		
	}
	
	
	
	
	
	
	
}