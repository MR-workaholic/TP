<?php
namespace Admin\Controller;
use Think\Controller;
class PubliccodeController extends Controller {
	
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
    
    /*
     * 检测用户是否登陆
     */
    public function check_valid_user() {
    	
    	$hosts = C('Hosts');
    	
	// see if somebody is logged in and notify them if not
	// isset()作用是确定一个变量是否是注册的会话变量，只要登录了就会登记在session中
 	 if (isset($_SESSION['uid']))  {
 	 	
      	return $_SESSION['uid'];
      	
  	} else {

  		$this->error('您还未登陆，请重新登陆。 ', 'http://'.$hosts.'/TP/index.php/admin/login/showloginview');
  	}
}

	/*
	 * 检测用户是否已经注册
	 */

	public function check_user_exist($table='', $field='', $target=''){
	
	if($table)
	{
		$handle = M($table);
		$condition[$field]=$target;
		$result = $handle->where($condition)->find();
		if ($result)
		{
			return $result;
		}else {
			return 'N';
		}
	}
	else {
		return false;
	}
	
}
	
	/*
	 * 检测手机号码格式
	 */
	public function check_mobilephone($mobilephone=0)
	{
		if(preg_match('/^1(3|4|5|8){1}[0-9]{9}$/i', $mobilephone))
		{
			return true;
		}
		else{
			return false;
		}
	}
	
	/*
	 * 检测邮箱格式
	 */
	public function check_email($email='')
	{
		if(preg_match('/^[\w.]+@\w+\.\w+$/i', $email))
		{
			return true;
		}
		else{
			return false;
		}
	}
	
	
	/*
	 * 返回用户名
	 */
	public  function get_name()
	{
	 	
		
		$handle = M('telsignin');
		$condition['uid'] = $this->check_valid_user();
		$result = $handle->where($condition)->getField('name');
		return $result;
		
	}
	
	
	/*
	 * 返回随机数字
	 */
	public function getrandstr(){
		$str = '1234567890';
		$randstr = str_shuffle($str);  //打乱字符串 
		$rands = substr($randstr, 0, 4);
		return $rands;
	}
	
	/*
	 * 保存商家信息
	 */
	public function  saveshop($updata_information, $mode=0){
		
		$database = C('Database');
		$webservice = C('Webservice');
		$msgsource = C('MsgSource');
		
		if ($msgsource == $database)
		{
			$Form = M('shop');
			$shop = array(
					'uid' => 0,
					'shopname' => "例如：山泉公馆",
					'shopphone' => "例如：020-38216208;020-38216468",
					'shopstyle' => "例如：餐饮中餐",
					'shopwebsite' => "例如：guanlian.com/shop/47rs",
					'shopremark' => " ",
					'shopman' => "例如：李小明",
					'shopsite' => "例如：林乐路25号中怡城市花园A栋2楼（近中信广场）",
					'shoplongitude' => 113.336899,
					'shoplatitude' => 23.14892,
			
			);
			
			foreach ($updata_information as $k => $v)
			{
				$shop[$k] = $v;
			}
			
			if(!$mode)
			{
				$Form->add($shop);
			}else {
				$result=$Form->save($shop);
				echo $result;
			}
			
		}else {
			
			$Form1 = M('telsignin');
			
			$resultForForm1 = $Form1->where($updata_information)->find();
			
			$newRole['BId'] = 0;
			$newRole['LoginName'] = $resultForForm1['name'];
			$newRole['Password'] = 'test11';//$resultForForm1['password'];
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
			//var_dump($json1);
			
			$jsonResult1 = $this->AccountHandle($json1);
			
			
		}
		
	}
	
	/*
	 * 返回店铺的资料
	 */
	
	public  function get_shop(){
		
			$database = C('Database');
			$webservice = C('Webservice');
			$msgsource = C('MsgSource');
			
			$uid = $this->check_valid_user();
			
			if ($msgsource == $database)
			{
				
				$handle = M('shop');
				$condition['uid']=$uid;
				$result = $handle->where($condition)->find();
				
			}else{
				
				$json = array(
						"op" => "query",
						"where" => "where Num = {$uid}",
				);
					
				//构造查询json
				$json = json_encode($json);
					
					
				$jsonResult = $this->AccountHandle($json);
				
					
				$result['shopname']      = $jsonResult['rows'][0]['Name'];
				$result['shopphone']     = '例如：020-38216208;020-38216468';//$jsonResult['rows'][0][''];
				$result['shopwebsite']   = '例如：guanlian.com/shop/47rs';//$jsonResult['rows'][0][''];
				$result['shopremark']    = '暂时没有备注';//$jsonResult['rows'][0][''];
				$result['shopman']       = $jsonResult['rows'][0]['Contact'];
				$result['shopsite']      = $jsonResult['rows'][0]['Address'];
				$result['shoplongitude'] = 113.33395;//$jsonResult['rows'][0][''];
				$result['shoplatitude']  = 23.149136;//$jsonResult['rows'][0][''];
				$result['sid']           = $jsonResult['rows'][0]['BId'];
				$result['shopstyle']     = '餐饮业';//$jsonResult['rows'][0][''];
				
			}
		
			
			
			return $result;
		
		
	}
	
	/*
	 * 返回店铺的ID
	 */
	
	public  function get_sid(){
		
			
			$uid = $this->check_valid_user();
			$handle = M('shop');
			$condition['uid']=$uid;
			$result = $handle->where($condition)->getField('sid');
			
			return $result;
		
		
	}
	
	/*
	 * 返回店铺的设备数量
	 */
	
	public function get_devnum(){
		
		
		$uid = $this->check_valid_user();
		$handle = M('devicelist');
		$condition['uid'] = $uid;
		$result = $handle->where($condition)->select();
		
		if (!$result)
		{
			return 0;
		}else{
			return count($result,0);
		}
		
		
		
	}
	/*
	 * 返回网络接口服务器
	 */
	public function return_client()
	{
		return $client = new \SoapClient("http://www.wiidev.com/router/service.asmx?wsdl", array('encoding'=>'UTF-8'));
	}
	
	/*
	 * 返回appkey
	 */
	
	public function return_appkey()
	{
		return '2EFEC84BCB03F473';
	}
	
	/*
	 * 将返回值std_class转换成array
	 */
	
	public function object_array($array) {
	
		if(is_object($array)) {
			$array = (array)$array;
		} if(is_array($array)) {
			foreach($array as $key=>$value) {
				$array[$key] = $this->object_array($value);
			}
		}
		return $array;
	}
	
	/*
	 * 账号操作
	 */
	
	public function AccountHandle($json)
	{
		//获取服务接口与key
		$client = $this->return_client();
		$appkey = $this->return_appkey();
		//传递参数，返回结果
		$param = array('appkey' => $appkey, 'json' => $json,);
		$result = $client->Account($param);
		$jsonResult = json_decode($result->AccountResult);  //注意是$result->AccountResult
		$jsonResult = $this->object_array($jsonResult);
		return $jsonResult;
	}
	
	/*
	 * 设备操作
	 */
	
	public function RouterHandle($json)
	{
		//获取服务接口与key
		$client = $this->return_client();
		$appkey = $this->return_appkey();
		//传递参数，返回结果
		$param = array('appkey' => $appkey, 'json' => $json,);
		$result = $client->Router($param);
		var_dump($result);
		$jsonResult = json_decode($result->RouterResult);  //注意是$result->RouterResult
		
		$jsonResult = $this->object_array($jsonResult);
		return $jsonResult;
	}
	/*
	 * 	上网用户终端操作
	 */
	
	public function ClientHandle($json)
	{
		//获取服务接口与key
		$client = $this->return_client();
		$appkey = $this->return_appkey();
		//传递参数，返回结果
		$param = array('appkey' => $appkey, 'json' => $json,);
		$result = $client->Client($param);
		$jsonResult = json_decode($result->ClientResult);  //注意是ClientResult
		$jsonResult = $this->object_array($jsonResult);
		return $jsonResult;
	}
	
	/*
	 *	上网用户信息记录
	 */
	public function ClientRecordHandle($json)
	{
		//获取服务接口与key
		$client = $this->return_client();
		$appkey = $this->return_appkey();
		//传递参数，返回结果
		$param = array('appkey' => $appkey, 'json' => $json,);
		$result = $client->ClientRecord($param);
		$jsonResult = json_decode($result->ClientRecordResult);
		$jsonResult = $this->object_array($jsonResult);
		return  $jsonResult;
	}
	
	
	
	/**
	 * 系统邮件发送函数
	 * @param string $to    接收邮件者邮箱
	 * @param string $name  接收邮件者名称
	 * @param string $subject 邮件主题
	 * @param string $body    邮件内容
	 * @param string $attachment 附件列表
	 * @return boolean
	 */
	
	public function think_send_mail($to, $name, $subject = '', $body = '', $attachment = null){
		
		$config = C('THINK_EMAIL');
		
		vendor('PHPMailer.class#phpmailer'); //从PHPMailer目录导class.phpmailer.php类文件
		vendor('PHPMailer.class#smtp');  //从PHPMailer目录导class.smtp.php类文件
		
		$mail             = new \PHPMailer(); //PHPMailer对象
		$mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
		$mail->IsSMTP();  // 设定使用SMTP服务
		$mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
		// 1 = errors and messages
		// 2 = messages only
		$mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
		$mail->SMTPSecure = 'ssl';                 // 使用安全协议
		$mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
		$mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
		$mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
		$mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
		
		$mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
		$replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
		$replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
		$mail->AddReplyTo($replyEmail, $replyName);
		$mail->Subject    = $subject;
		$mail->MsgHTML($body);
		$mail->AddAddress($to, $name);
		if(is_array($attachment)){ // 添加附件
			foreach ($attachment as $file){
				is_file($file) && $mail->AddAttachment($file);
			}
		}
		return $mail->Send() ? true : $mail->ErrorInfo;
	}
	
	
/** 
 * 将一个文件夹下的所有文件及文件夹 
 * 复制到另一个文件夹里（保持原有结构） 
 * 
 * @param <string> $rootFrom 需要复制的文件夹路径（最好为绝对路径） 
 * @param <string> $rootTo 需要复制的文件夹路径（最好为绝对路径） 
 */  
	public function cp_files($rootFrom, $rootTo, $pre)
	{
		  
	    $handle = opendir($rootFrom); 
	     
	    while(false  !== ($file = readdir($handle)))
	    {  
	    	
	        //DIRECTORY_SEPARATOR 为系统的文件夹名称的分隔符 例如：windos为'/'; linux为'/'  
	        $fileFrom = $rootFrom.$file;  
	        $fileTo   = $rootTo.$pre.$file;  
	        if($file=='.' || $file=='..')
	        {       
	        	continue;
	        }  
	        if(is_dir($fileFrom))
	        {  
	            mkdir($fileTo, 0777);  
	           
	        }else{  
	            @copy($fileFrom, $fileTo);  
	        }  
	    } 

	    closedir($handle);
	}  
		
/** 
 * 将一个文件夹下的所有文件删除 
 * 
 * @param <string> $root 需要删除的文件夹路径（最好为绝对路径）  
 */  
	public function del_files($root, $pre)
	{
		  
	    $handle = opendir($root); 
	     
	    if ($pre === '')
	    {
	    	while(false  !== ($file = readdir($handle)))
	    	{
	    	
	    		//DIRECTORY_SEPARATOR 为系统的文件夹名称的分隔符 例如：windos为'/'; linux为'/'
	    		$fileDel = $root.$file;
	    		 
	    		if($file=='.' || $file=='..')
	    		{
	    			continue;
	    		}
	    	
	    		 
	    		if(is_dir($fileDel))
	    		{
	    			rmdir($fileDel);
	    	
	    		}else{
	    			unlink($fileDel);
	    		}
	    		 
	    	}
	    	
	    }else {
	    	
	    	while(false  !== ($file = readdir($handle)))
	    	{
	    	
	    		//DIRECTORY_SEPARATOR 为系统的文件夹名称的分隔符 例如：windos为'/'; linux为'/'
	    		$fileDel = $root.$file;
	    		 
	    		if($file=='.' || $file=='..' || $file[0] != $pre)
	    		{
	    			continue;
	    		}
	    	
	    		 
	    		if(is_dir($fileDel))
	    		{
	    			rmdir($fileDel);
	    	
	    		}else{
	    			unlink($fileDel);
	    		}
	    	
	    		 
	    	}
	    	
	    }
	   
	   

	    closedir($handle);
	}  
		
	

}
