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
		
		
// 		$phone = 13265478956;
// 		$role = '普通商家';
		$Num = 'test0003';
		
		/*
		 * 可以使用json校验工具来检测
		 */
		$json = array(
				"op" => "query",
				"where" => "where Num = '{$Num}'",
		);
		
		$json = json_encode($json);
		

		$jsonResult = $call->AccountHandle($json);
		var_dump($jsonResult);
		

		echo $jsonResult['rows'][0]['LoginName'];
		echo $jsonResult['rows'][0]['Num'];
		
		
	}
	
	/*
	 * 账号更新测试 pass
	 */
	
	public function xqtest_updata()
	{
		
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
		
		//构造json参数
		$phone = 12345678901;
		$role = '普通商家';
		$name = '商家1';
		$json = array(
				"op" => "query",
				"where" => "where Role = '{$role}' and Phone = '{$phone}' and Name = '{$name}'",
		);
		$json = json_encode($json);
		var_dump($json);
		
		
		//执行账户查询,返回数组
		$jsonResult = $call->AccountHandle($json);
		var_dump($jsonResult);
		
		
		
		//构造新的json参数

		$jsonResult['rows'][0]['Address'] = '广州市天河区哈哈大厦';
		$jsonResult['rows'][0]['Role'] = '普通商家';

		
		$json1 = array(
				'op' => 'save',
				'obj' => $jsonResult['rows'][0]
			
		);
		$json1 = json_encode($json1);	
		var_dump($json1);
		
		$jsonResult1 = $call->AccountHandle($json1);
		var_dump($jsonResult1);
		
	}
	
	
	
	/*
	 * 账号删除测试 pass
	 */
	
	public function xqtest_del(){
		
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
		
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
	 * 账户添加测试 pass
	 */
	
	public function xqtest_add()
	{
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
// 		$newRole['BId'] = 0;
// 		$newRole['Name'] = '商家AA';
// 		$newRole['LoginName'] = 'sjaa';
// 		$newRole['Phone'] = 13265478956;
// 		$newRole['Num'] = 'SJ003';
		
// 		$json1 = array(
// 				'op' => 'save',
// 				'obj' => $newRole
					
// 		);

		$updata_information = array(   //仅仅需要填写需要修改的字段
				'uid' => 26,
		);

		$Form1 = M('telsignin');
		
		$resultForForm1 = $Form1->where($updata_information)->find();
		
		$newRole['BId'] = 0;
		$newRole['LoginName'] = $resultForForm1['name'];
		$newRole['Password'] = '123456';
		$newRole['State'] = '正常';
		$newRole['Name'] = '例如：山泉公馆';
		$newRole['Phone'] = $resultForForm1['mobilephone'];
		$newRole['Role'] = '普通商家';
		$newRole['Num'] = $resultForForm1['uid'];
		$newRole['Contact'] = "例如：李小明";
		$newRole['Address'] = "例如：林乐路25号中怡城市花园A栋2楼（近中信广场）";
		$newRole['AdminModify'] = "是";
		
		
		$json1 = array(
				'op' => 'save',
				'obj' => $newRole
					
		);
		
		$json1 = json_encode($json1);
		var_dump($json1);
		
		$jsonResult1 = $call->AccountHandle($json1);
		var_dump($jsonResult1);
		
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
				"where" => "where AgentId = 12",
		);
		
		$json = json_encode($json);
		
		$result = $call->RouterHandle($json);
		
		var_dump($result);
		
		echo $result['rows'][0]['Mac'];

// 		//构造用户查询json参数
// 		$json = array(
// 				"op" => "query",
// 				"where" => "where Num = 37",
// 		);
// 		$json = json_encode($json);
		
// 		//执行账户查询,返回数组
// 		$jsonResult = $call->AccountHandle($json);
			
			
// 		//构造设备查询语句
// 		$json1 = array(
// 				"op" => "query",
// 				"where" => "where BusinessId = {$jsonResult['rows'][0]['BId']} and State <> '停用'",
// 		);
			
// 		$json1 = json_encode($json1);
			
// 		$result = $call->RouterHandle($json1);
		
// 		var_dump($result);
		
// 		foreach ($result['rows'] as $k=>$v)
// 		{
// 			$devmes[$k]['dname'] = 'dname'.$k;//$v[''];
// 			$devmes[$k]['dtype'] = $v['FirmwareVer'];
// 			$devmes[$k]['dssid'] = 'dssid'.$k;//$v[''];
// 			$devmes[$k]['dstate'] = $v['State'];
// 			$devmes[$k]['donlinenum'] = $v['OnlineCount'];
// 			$devmes[$k]['dmac'] = $v['Mac'];
// 			$devmes[$k]['dplmac'] = 'dplmac'.$k;//$v[''];
// 			$devmes[$k]['dplcbandwidth'] = 'dplcbandwidth'.$k;//$v[''];
// 			$devmes[$k]['dplcnetworkname'] = 'dplcnetworkname'.$k;//$v[''];
		
// 		}
			
// 		var_dump($devmes);	
			
	//	echo $result['rows'][0]['Mac'];
	}
	
	/*
	 * 设备添加更新测试pass
	 */
	
	public function dev_update(){
		
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
		$BusinessId = 3;
		$json = array(
				"op" => "query",
				"where" => "where AgentId = 12",
		);
		
		$json = json_encode($json);
		
		$result = $call->RouterHandle($json);
		
	//	$result['rows'][0]['Mac'] = '00:03:7F:11:20:B0';
		
		//下面的元素不用删除也可以更新成功
	//	unset($result['rows'][0]['AgentName']);
// 		unset($result['rows'][0]['BusinessName']);
// 		unset($result['rows'][0]['BusinessId']);
// 		unset($result['rows'][0]['FirmwareVer']);
// 		unset($result['rows'][0]['State']);
// 		unset($result['rows'][0]['OnlineCount']);
// 		unset($result['rows'][0]['ReceiveData']);
// 		unset($result['rows'][0]['SendData']);
// 		unset($result['rows'][0]['AgentId']);   删除AgentId可以更新成功
// 		unset($result['rows'][0]['SN']);   删除SN不可以更新成功
		
		
		for($i=1; $i<5; $i++)
		{
			unset($result['rows'][$i]['BusinessName']);
			unset($result['rows'][$i]['BusinessId']);
			$json1 = array(
					"op" => "save",
					"obj" => $result['rows'][$i]
			);
			
			$json1 = json_encode($json1);
			
			var_dump($json1);
			
			$result1 = $call->RouterHandle($json1);
			
		}
		
		var_dump($result1);
		
	}
	
	/*
	 * 获取路由器配置
	 */
	
	public function dev_getsetting()
	{
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
		$RouterMac = '00:03:7F:11:28:B0';
		$json = array(
				"op" => "getSetting",
				"RouterMac" => $RouterMac
		);
		
		$json = json_encode($json);
		
		var_dump($json);
		
		$result = $call->RouterHandle($json); //打印RouterHandle函数里面的$result值，结果如下
											  //object(stdClass)[8]  public 'RouterResult' => string 'wrsdb.Model.RouterSetting' (length=25)
		
		var_dump($result);
	}
	
	/*
	 * 上网用户查询测试pass
	 */
	
	public function client_query()
	{
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
		$BusinessName = '商家1';
		$json = array(
				"op" => "query",
				"where" => "where BusinessName = '{$BusinessName}'",
		);
		
		$json = json_encode($json);
		var_dump($json);
		
		$result = $call->ClientHandle($json);
		
		var_dump($result);
		
	}
	
	/*
	 * 上网用户信息查询测试pass
	 */
	public function client_record_query()
	{
		header("Content-Type:text/html;charset=UTF-8");
		$call = A('Publiccode');
		
		$ClientName = 13580518842;
		$json = array(
				"op" => "query",
				"where" => "where ClientName = {$ClientName}",
		);
		
		$json = json_encode($json);
		
		$result = $call->ClientRecordHandle($json);
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
