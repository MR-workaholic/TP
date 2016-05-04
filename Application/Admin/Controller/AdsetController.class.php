<?php
namespace Admin\Controller;
use Think\Controller;
class AdsetController extends Controller {
	
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	
	/*
	 * 广告列表的视图
	 */
	public function showadlist(){
		
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/adList.html');
		
	}
	
	/*
	 * 添加广告的视图
	 */
	public function themeAddshow(){

		$call = A('Publiccode');
		$call->check_valid_user();
		$imgPath = C('IMG_PATH');
		$this->assign('imgPath', $imgPath);
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/themeAdd.html');
		
	}
	
	/*
	 * 广告列表数据的返回
	 */
	public function admescalling()
	{
		$call = A('Publiccode');
		$host = C('Hosts');
		
		$uid = $call->check_valid_user();
		
		$handle = M('adlist');
		$condition['uid'] = $uid;
		$result = $handle->where($condition)->select();
		
		if(!$result)
		{
			$response['status'] = 0;
		}else {
			$num = count($result,0);
			$response['status'] = $num;
			
			$handle1 = M('adstatus');
			$aid = $handle1->where($condition)->getField('aid');
			
			for($i=0; $i<$num; $i++)
			{
				if ($result[$i]['aid'] == $aid)
				{
					$result[$i]['adstatus'] = 'Y';
				}else {
					$result[$i]['adstatus'] = 'N';
				}
			}
			
			$response['data'] = $result;
			$response['data']['host'] = $host;
		}
			
	

		$response['info'] = '';
		$response['type'] = 'JSON';
		$this->ajaxReturn($response,'JSON');
	
	
	}
	
	/*
	 * 广告添加action
	 */
	
	public  function themeadd(){
		
		$call = A('Publiccode');
		$hosts = C('Hosts');
		$uid = $call->check_valid_user();
		
		$adname = I('post.themeName');
		$admodel = $_POST['themeTemplate'];
		$adremark = I('post.adremark');
		
		$handle = M('adlist');
		$condition['uid'] = $uid;
		$result = $handle->where($condition)->select();
		
		if ($result)
		{
			$arr = array(0,0,0,0,0,0,0,0,0,0);
			
			foreach ($result as $k=>$v)
			{
				$arr[$v['order']] = 1;
			}
			
			for($j=0; $j<10; $j++)
			{
				if ($arr[$j] == 1)
				{
					continue;
				}else {
					$num = $j;
					break;
				}
			}
			
			$new = 0;
		}else{
			
		
			$new = 1;
			$num = 0;
		}
		
		
		//上面添加广告完成，下面将是根据广告模板选择复制文件到相应文件夹上
		
 		
		$call->cp_files('./Public/GLProject/load/'.$admodel.'/', './Application/Admin/UserFile/'.$uid.'/', $num);
		$call->cp_files('./Public/GLProject/load/'.$admodel.'/upload_file/', './Application/Admin/UserFile/'.$uid."/{$num}upload_file/", '');
		
		

 		$data = array(
 				'uid' => $uid,
 				'order' => $num,
 				'adname' => $adname,
 				'admodel' => $admodel,
 				'adremark' => $adremark,
 				'url' => '/TP/index.php/Admin/Adset/showad/shop/'.$uid,
 				'uploadfile' => $num.'themeSet',
 		);
 			
 		$handle = M('adlist');
 		$aid = $handle->add($data);
 		
 		if ($new == 1)   //增添默认广告
 		{
 			$handle2 = M('addefault');
 			$condition2['uid'] = $uid;
 			$condition['aid'] = $aid;
 			$handle2->add($condition2);
 		}
 		
 		$save['aid'] = $aid;
 		$save['url'] = '/TP/index.php/Admin/Adset/showad/shop/'.$uid.'/aid/'.$aid;
 		$handle->save($save);
 		
 		$data1 = array(
 			'aid' => $aid,	
 			'vermes' => '广东广联科技有限公司 &lt;br/&gt; 智能WIFI  智能家居 ',	
 			'welcomeword' => '欢迎光临，免费WIFI使用&lt;br/&gt;请放心进行验证吧     ',	
 			'fbtntext' => '马上体验免费WIFI',	
 			'fbtntxtcol' => '#f2f4f5',	
 			'fbtnbgcol' => '#16bdf5',	
 			'sbtntext' => '打开微信',	
 			'guidecontent' => '欢迎使用免费 Wi-Fi！&lt;br /&gt;用微信扫一扫我们的二维码即可上网！',	
 			'phoneguide' => '输入手机号码，然后点击【获取密码】按钮，系统将把验证码发送到您输入的手机。然后返回当前页面进行验证。',	
 			'wechatguide' => '      1. 先关注本店微信公众号，并回复 wifi；系统将回复登录用户名和密码。&lt;br /&gt;2. 输入以上用户名和密码，然后点击登录，即可上网',	
 			'tbtntxtcol' => '#f7f4f5',	
 			'tbtnbgcol' => '#0facfa',	
 					
 		);
 		
 		$handle1 = M('adbtn');
 		$handle1->add($data1);
 			
 		
 		
 		$data['aid'] = $aid;

 		$response['data'] = $data;
 		$response['status'] = 1;
 		$response['info'] = '';
 		$response['type'] = 'JSON';
 		
 		$this->ajaxReturn($response, 'JSON');
 		

	}
	
	
	/*
	 * 广告删除
	 */
	
  	public 	function addel()
  	{
  		$aid = I('post.aid');
  		$call = A('Publiccode');
  		
  		$condition['aid'] = $aid;
  		
  		$handle = M('adlist');
  		$condition1['uid'] = $handle->where($condition)->getField('uid');
  		$condition1['theme'] = $handle->where($condition)->getField('order');
  		
  		//数据库清空操作
  		$result = $handle->where($condition)->delete();
  		
  		$handle1 = M('adbtn');
  		$result1 = $handle1->where($condition)->delete();
  		
  		$handle2 = M('adpicurl');
  		$result2 = $handle2->where($condition1)->delete();
  		
  		$handle3 = M('adstatus');
  		$result3 = $handle3->where($condition)->find();
  		
  		if ($result3)
  		{
  			$result3 = $handle3->where($condition)->delete();
  		}
  		 
  		//文件删除操作

  		$call->del_files('./Application/Admin/UserFile/'.$condition1['uid'].'/'.$condition1['theme'].'upload_file/', '');
  		$call->del_files('./Application/Admin/UserFile/'.$condition1['uid'].'/', $condition1['theme']);
  		
  		
  		
  		//其他删除操作，略，包括删除相应的数据库信息与文件
  	
  		if ($result)
  		{
  			$response['status'] = 1;
  			$response['info'] = '';
  			$response['type'] = 'JSON';
  			$this->ajaxReturn($response, 'JSON');
  		}else {
  			$response['status'] = 0;
  			$response['info'] = '';
  			$response['type'] = 'JSON';
  			$this->ajaxReturn($response, 'JSON');
  			
  		}
  
  		
  	} 
  	 
	
  	/*
  	 * 广告展示action--根据路由器MAC选择路由
  	 * 
  	 * $shop: 用户的id（$uid）
  	 */
  	
  	public function showADbyMac($shop, $mac=0)
  	{
  		$c = I('get.c'); // 终端MAC
  		$c = '1232243543546';
  		$r = I('get.r'); // 路由MAC
  		$r = '14324343213';
  		$a = I('get.a'); // 是否认证
  	
  		
  		if (!$mac)
  		{
  			$mac = $r;
  		}
  		
  		$handle = M('admac');
  		$condition['mac'] = $mac;
  		$result = $handle->where($condition)->getField('aid');
  		
  		if($result)
  		{
  			if($a==1)
  			{
  				$this->showad3($result);
  			}else{
  				$this->showad($shop, $result, $c, $r);
  			}
  			
  		}else {
  			
  			$handle1 = M('addefault');
  			$condition1['uid'] = $shop;
  			$result1 = $handle1->where($condition1)->getField('aid');
  			
  			if ($result1)
  			{
  				if ($a == 1)
  				{
  					$this->showad3($result1);
  				}else{
  					$this->showad($shop, $result1, $c, $r);
  				}
  				
  			}else {
  				$this->error('商家没有设置任何的广告');
  			}
  			
  		}
  		
  		
  		
  		
  		
  	}
  	
  	/*
  	 * 处理路由与广告
  	 */
  	
  	public function handleADMac($aid)
  	{
  		$handle = M('adlist');
  		$condition['aid'] = $aid;
  		$adname = $handle->where($condition)->getField('adname');

  		$this->assign('aid', $aid);
  		$this->assign('adname', $adname);
  		$this->display('./GLLogin/Signin/zui-master-me/Merchant/handleADMac.html');
  	}
	
  	public function showHandleADMac()
  	{
  		$aid = I('post.aid');
  		$call = A('Publiccode');
  		$uid = $call->check_valid_user();
  		
  		$handle = M('admac');
  		$condition['aid'] = $aid;
  		$result = $handle->where($condition)->select();
  		
  		$string4NotIn = "(";
  		
  		if($result)
  		{
  			$response['data']['haveflag'] = 1;
	  		foreach ($result as $key=>$value)
	  		{
	  			$response['data']['have'][$key]['mac'] = $value['mac'];
	  			
	  			$json = array(
	  					"op" => "query",
	  					"where" => "where Mac = '{$value['mac']}'",
	  			);
	  			
	  			$string4NotIn = $string4NotIn."'{$value['mac']}',";
	  			
	  			$json = json_encode($json);
	  			
	  			$result_json = $call->RouterHandle($json);
	  			
	  			$response['data']['have'][$key]['RouterName'] = $result_json['rows'][0]['RouterName'];
	  			$response['data']['have'][$key]['RouterModel'] = $result_json['rows'][0]['RouterModel'];	
	  		}
	  		
	  		$string4NotIn = substr_replace($string4NotIn, ")", -1);
	  		
  		}else{
  			
  			$string4NotIn = $string4NotIn.")";
  			$response['data']['haveflag'] = 0;
  		}
  		
  		$response['data']['string'] = $string4NotIn;
  		
  		
  		//需要添加的设备
  		
  		if ($string4NotIn == "()")
  		{
  			
  			$json = array(
  					"op" => "query",
  					"where" => "where BusinessNum = '{$uid}'",
  			);
  			
  		}else {
  			
  			$json = array(
  					"op" => "query",
  					"where" => "where BusinessNum = '{$uid}' and Mac NOT IN {$string4NotIn}",
  			);
  			
  		}
  		

  		
  		$json = json_encode($json);
  		
  		$result_json = $call->RouterHandle($json);
  		
  		if (!$result_json && $result_json['total'] == 0)
  		{
  			$response['data']['nothaveflag'] = 0;
  			
  		}else 
  		{
  			$response['data']['nothaveflag'] = 1;
  			
  			foreach($result_json['rows'] as $key=>$value)
  			{
  					
  				$response['data']['nothave'][$key]['RouterName'] = $value['RouterName'];
  				$response['data']['nothave'][$key]['Mac'] = $value['Mac'];
  					
  				$condition1['mac'] = $value['Mac'];
  				$result1 = $handle->where($condition1)->find();
  					
  				if ($result1)
  				{
  					$handle1 = M('adlist');
  					$condition2['aid'] = $result1['aid'];
  					$response['data']['nothave'][$key]['adname'] = $handle1->where($condition2)->getField('adname');
  			
  				}else{
  					
  					$handle2 = M('addefault');
  					$condition3['uid'] = $uid;
  					$result2 = $handle2->where($condition3)->getField('aid');
  					
  					if ($result2)
  					{
  						$handle1 = M('adlist');
  						$condition2['aid'] = $result2;
  						$response['data']['nothave'][$key]['adname'] = '使用默认广告主题【'.$handle1->where($condition2)->getField('adname').'】';
  						
  					}else{
  						$response['data']['nothave'][$key]['adname'] = '没有任何广告主题';
  					}
  					
  					
  					
  					
  				}
  							
  			}
  			
  		}
  		
  	
  			
  		
  		
  		$response['status'] = 1;
  		$response['info'] = '';
  		$response['type'] = 'JSON';
  		$this->ajaxReturn($response, 'JSON');
  		
  		
  		
  	}
	
  	/*
  	 * 将AD与路由器绑定一起
  	 */
  	public function handleADandMac()
  	{
  		$aid = I('post.aid');
  		$chooseMac = I('post.chooseMac');
  		
  		if (empty($chooseMac))
  		{
  			$response['status'] = 0;
  		}else{
  			
  			$handle = M('admac');
  			
  			foreach ($chooseMac as $v)
  			{
  				$condition['mac'] = $v;
  				$result = $handle->where($condition)->find();
  				
  				if($result)
  				{
  					$handle->where($condition)->setField('aid', $aid);
  				}else {
  					$condition['aid'] = $aid;
  					$handle->add($condition);
  				}
  				
  			}
  			
  			$response['status'] = 1;
  		}
  		
  		$response['info'] = '';
  		$response['type'] = 'JSON';
  		$this->ajaxReturn($response, 'JSON');
  		

  		
  		
  		
  	}
  	
  	
  	/*
  	 * 将路由与AD解除绑定
  	 */
  	
  	public function deleteADandMac()
  	{
  		
  		$deleteMac = I('post.deleteMac');
  		
  		if (empty($deleteMac))
  		{
  			$response['status'] = 0;
  		}else{
  			$response['status'] = 1;
  			
  			$handle = M('admac');
  			
  			foreach ($deleteMac as $v)
  			{
  				$condition['mac'] = $v;
  				$handle->where($condition)->delete();
  			}
  			
  		}
  		
  		$response['info'] = '';
  		$response['type'] = 'JSON';
  		$this->ajaxReturn($response, 'JSON');
  		
  		
  	}
  	
  	
	/*
	 * 广告展示action--欢迎页
	 * 
	 * $shop:用户的id（uid）
	 * $aid: 广告的id,为0的时候是展现当前设置的默认广告，否则是展现相应的广告
	 */
	public function showad($shop, $aid, $c=0, $r=0)
	{
		
		$imgPath = C('IMG_PATH');
		
		if ($aid == 0)
		{
		
			$handle0 = M('adstatus');
			$conditon0['uid'] = $shop;
			$aid = $handle0->where($conditon0)->getField('aid');
		}
		
		$handle = M('adlist');
		$conditon['aid'] = $aid;
		$order =  $handle->where($conditon)->getField('order');

		$handle1 = M('adbtn');
		$result = $handle1->where($conditon)->find();
		
// 		$srcdir = $handle->where($conditon)->getField('srcdir');
// 		$adfile = $handle->where($conditon)->getField('adfile');
		 
		
		
		$current_dir = './Application/Admin/UserFile/'.$shop.'/'.$order.'upload_file/';
		$dir = opendir($current_dir);
		$countS = 0;
		
		while (false !== ($file = readdir($dir)))
		{
			if ($file != '.' && $file != '..' && $file[0] == 'S')
			{
				if ($imgPath == 0)
				{
					$Spicarr[$countS] = '/tp/application/admin/userfile/'.$shop.'/'.$order.'upload_file/'.$file.'?rank='.time();
				}else {
					$Spicarr[$countS] = '/project001/tp/application/admin/userfile/'.$shop.'/'.$order.'upload_file/'.$file.'?rank='.time();
				}
				
				$countS++;	
			}
		}
		
		closedir($dir);
		
		$str = './Application/Admin/UserFile/'.$shop.'/'.$order.'mymobile-theme-welcome.html';
		
		$vermes = str_replace('&lt;', '<', $result['vermes']);
		$vermes = str_replace('&gt;', '>', $vermes);
		
		$welcomeword = str_replace('&lt;', '<', $result['welcomeword']);
		$welcomeword = str_replace('&gt;', '>', $welcomeword);
		
		
		
		
		$this->assign('Spicarr', $Spicarr);
		$this->assign('welcomeword', $welcomeword);
		$this->assign('fbtntxtcol', $result['fbtntxtcol']);
		$this->assign('fbtnbgcol', $result['fbtnbgcol']);
		$this->assign('fbtntext', $result['fbtntext']);
		$this->assign('vermes', $vermes);
		$this->assign('aid', $aid);
		$this->assign('cc', $c);
		$this->assign('rr', $r);
		
		$this->display($str);
	}
	

	/*
	 * 广告展示action-认证页
	*
	* $aid:为要展现的广告ID
	*/
	
	public function showad2($aid)
	{
		
		$imgPath = C('IMG_PATH');
		$cc = I('post.cc');
		$rr = I('post.rr');
		
		
		$handle = M('adlist');
		$condition['aid'] = $aid;
		$result = $handle->where($condition)->find();
		
		$current_dir = './Application/Admin/UserFile/'.$result['uid'].'/'.$result['order'].'upload_file/';
		$dir = opendir($current_dir);
		$countL = 0;
		
		while (false !== ($file = readdir($dir)))
		{
			if ($file != '.' && $file != '..' && $file[0] == 'L')
			{
				if ($imgPath == 0)
				{
					$Lpicarr[$countL] = '/tp/application/admin/userfile/'.$result['uid'].'/'.$result['order'].'upload_file/'.$file.'?rank='.time();
				}else{
					$Lpicarr[$countL] = '/project001/tp/application/admin/userfile/'.$result['uid'].'/'.$result['order'].'upload_file/'.$file.'?rank='.time();
				}
				
				$countL++;
			}
		}
		
		closedir($dir);
		
		
		$this->assign('Lpicarr', $Lpicarr);
		
		$handle1 = M('adbtn');
		$result1 = $handle1->where($condition)->find();
		
		$vermes = str_replace('&lt;', '<', $result1['vermes']);
		$vermes = str_replace('&gt;', '>', $vermes);
		
		$phoneguide = str_replace('&lt;', '<', $result1['phoneguide']);
		$phoneguide = str_replace('&gt;', '>', $phoneguide);
		
		$wechatguide = str_replace('&lt;', '<', $result1['wechatguide']);
		$wechatguide = str_replace('&gt;', '>', $wechatguide);
		
		$handle2 = M('authentication');
		$condition2['uid'] = $result['uid'];
		$authentication = $handle2->where($condition2)->getField('authentication');
		if ($authentication == 2)
		{
			$signinstyle = $handle2->where($condition2)->getField('signinstyle');
			$a = 1 << 0;
			$b = 1 << 1;
			$c = 1 << 2;
			
			if (($signinstyle | $a) == $signinstyle)
			{
				$this->assign('phone', 1);
			}
			
			if (($signinstyle | $b) == $signinstyle)
			{
				$this->assign('wechat', 1);
			}
			
			if (($signinstyle | $c) == $signinstyle)
			{
				$this->assign('wechat', 1);
			}
			
		}
		
		
		
		
		$this->assign('vermes', $vermes);
		$this->assign('wechatguide', $wechatguide);
		$this->assign('phoneguide', $phoneguide);
		$this->assign('tbtnbgcol', $result1['tbtnbgcol']);
		$this->assign('tbtntxtcol', $result1['tbtntxtcol']);
		$this->assign('aid', $aid);
		$this->assign('cc', $cc);
		$this->assign('rr', $rr);
		$this->assign('authentication', $authentication);
		
		
		$str = './Application/Admin/UserFile/'.$result['uid'].'/'.$result['order'].'mymobile-theme-authentication.html';
		$this->display($str);
		

	}
	
	public function showad2_sendmsg()
	{
		
		$phoneNumber = I('post.pn');
		$cc = I('post.cc');
		$rr = I('post.rr');
// 		$call = A('Publiccode');

// 		$json = array(
// 			"op" => "sendSms",
// 			"obj" => array(
// 					"ClientName" => $phoneNumber,
// 					"ClientMac"  => $cc,
// 					"RouterMac"  => $rr
// 					)	
			
// 		);
		
// 		$json = json_encode($json);
// 		$call->ClientHandle($json);

		$response['data']['cc'] = $cc;
		$response['data']['rr'] = $rr;
		$response['data']['phoneNumber'] = $phoneNumber;
	
		$response['status'] = 1;
		$response['info'] = '';
		$response['type'] = 'JSON';
		$this->ajaxReturn($response,'JSON');
		 
		
		
	}
	
	public function showad2_regmsg()
	{
		
		$phoneNumber = I('post.pn');
		$cc = I('post.cc');
		$rr = I('post.rr');
		$reg = I('post.reg');
		$hosts = C('Hosts');
		
// 	    $call = A('Publiccode');
		
// 		$json = array(
// 			"op" => "reg",
// 			"obj" => array(
// 					"ClientName" => $phoneNumber,
// 					"ClientMac"  => $cc,
// 					"RouterMac"  => $rr,
// 					"SmsVerify"  => $reg
// 					)
			
// 		);
		
// 		$json = json_encode($json);
// 		$call->ClientHandle($json);

		$response['data']['cc'] = $cc;
		$response['data']['rr'] = $rr;
		$response['data']['phoneNumber'] = $phoneNumber;
		$response['data']['reg'] = $reg;

		
		$response['status'] = 1;
		$response['info'] = '';
		$response['type'] = 'JSON';
		$this->ajaxReturn($response,'JSON');
		
		
		
	}
	
	/*
	 * 广告展示action-广告页
	*
	* $aid:为要展现的广告ID
	*/
	
	public function showad3($aid)
	{
		$imgPath = C('IMG_PATH');
		$handle = M('adlist');
		$condition['aid'] = $aid;
		$result = $handle->where($condition)->find();
		
		$current_dir = './Application/Admin/UserFile/'.$result['uid'].'/'.$result['order'].'upload_file/';
		$dir = opendir($current_dir);
		$countF = 0;
		$countI = 0;
		$countL = 0;
		
		$handle1 = M('adpicurl');
		$condition1['uid'] = $result['uid'];
		$condition1['theme'] = $result['order'];
		
		while (false !== ($file = readdir($dir)))
		{
			if ($file != '.' && $file != '..' && ( $file[0] == 'I'|| $file[0] == 'L' ) )
			{
				if($file[0] == 'I') {
					
					$condition1['picname'] = $file;
					$Ipicnamearr = $handle1->where($condition1)->getField('magnetname');
					$Ipicurlarr  = trim($handle1->where($condition1)->getField('url'));
					
					if ($imgPath == 0)
					{
						$src = '/tp/application/admin/userfile/'.$result['uid'].'/'.$result['order'].'upload_file/'.$file.'?rank='.time();
					}else {
						$src = '/project001/tp/application/admin/userfile/'.$result['uid'].'/'.$result['order'].'upload_file/'.$file.'?rank='.time();
					}
					
					$Ipicarr[$countI] = array(
							
							'src' => $src,
							'name' => $Ipicnamearr,
							'url' => $Ipicurlarr,
						
					);
					
					$countI++;
				}else{
					if ($imgPath == 0)
					{
						$Lpicarr[$countL] = '/tp/application/admin/userfile/'.$result['uid'].'/'.$result['order'].'upload_file/'.$file.'?rank='.time();			
					}else{
						$Lpicarr[$countL] = '/project001/tp/application/admin/userfile/'.$result['uid'].'/'.$result['order'].'upload_file/'.$file.'?rank='.time();		
					}
					$countL++;
					
				}
				
			}
		}
		
		closedir($dir);
		
		
		
		$handle2 = M('adbtn');
		$vermes = $handle2->where($condition)->getField('vermes');
		
		$vermes = str_replace('&lt;', '<', $vermes);
		$vermes = str_replace('&gt;', '>', $vermes);
		
		
		$this->assign('Ipicarr', $Ipicarr);
		$this->assign('Lpicarr', $Lpicarr);
		
		$this->assign('aid', $aid);
		$this->assign('vermes', $vermes);
		
		$str = './Application/Admin/UserFile/'.$result['uid'].'/'.$result['order'].'mymobile-theme-after.html';
		$this->display($str);
		
		
	}
	
	/*
	 * 广告展示action-认证页的部分信息的ajax请求
	 *
	 */
	
	public function Fpicmescall()
	{
		$aid = I('post.aid');
		$imgPath = C('IMG_PATH');
		$handle = M('adlist');
		$condition['aid'] = $aid;
		$result = $handle->where($condition)->find();
		
		$current_dir = './Application/Admin/UserFile/'.$result['uid'].'/'.$result['order'].'upload_file/';
		$dir = opendir($current_dir);
		$countF = 0;
		
		$handle1 = M('adpicurl');
		$condition1['uid'] = $result['uid'];
		$condition1['theme'] = $result['order'];
		
		while (false !== ($file = readdir($dir)))
		{
			if ($file != '.' && $file != '..' && $file[0] == 'F')
			{
				
				if ($imgPath == 0)
				{
					$Fpicarr[$countF] = '/tp/application/admin/userfile/'.$result['uid'].'/'.$result['order'].'upload_file/'.$file.'?rank='.time();
				}else{
					$Fpicarr[$countF] = '/project001/tp/application/admin/userfile/'.$result['uid'].'/'.$result['order'].'upload_file/'.$file.'?rank='.time();
				}
					
					$condition1['picname'] = $file;
					$Fpicurlarr[$countF] = trim($handle1->where($condition1)->getField('url'));
					$countF++;
			
			}
		}
		
		closedir($dir);
		
		$Fpicarrlength = count($Fpicarr);
		
		$response['data'] = array(
			'src' => $Fpicarr,
			'url' => $Fpicurlarr,
		);
		
		$response['status'] = $Fpicarrlength;
		$response['info'] = '';
		$response['type'] = 'JSON';
		
		$this->ajaxReturn($response, 'JSON');
		
		
		
		
		
	}
	
	/*
	 * 广告设置action--设置导航
	 */
	
	public  function adsetnav($aid)
	{
		
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$handle = M('adlist');
		$condition['aid'] = $aid;
		
		$filename = $handle->where($condition)->getField('uploadfile');
		$adname = $handle->where($condition)->getField('adname');
		$order = $handle->where($condition)->getField('order');
		
		$this->assign('adname', $adname);
		$this->assign('aid', $aid);
		
		
		$this->display("./Application/Admin/UserFile/{$uid}/{$filename}.html");
	}
	
	/*
	 * 广告设置action--基本信息--展示
	 */

	public function adset_basic($aid)
	{
		
		$handle = M('adlist');
		$condition['aid'] = $aid;
		$result = $handle->where($condition)->find();
		
		
		$this->assign('adname', $result['adname']);
		$this->assign('order', $result['order']);
		$this->assign('admodel', $result['admodel']);
		$this->assign('adremark', $result['adremark']);
		$this->assign('aid', $result['aid']);
		
		$handle1 = M('adstatus');
		$condition1['uid'] = $result['uid'];
		$result1 = $handle1->where($condition1)->getField('aid');
		
		if ($result1 && $result1 == $aid)
		{
			$this->assign('adstatus', 'Y');
		}else {
			$this->assign('adstatus', 'N');
		}
		
		$handle2 = M('addefault');
		$result2 = $handle2->where($condition1)->getField('aid');
		if ($result2 && $result2==$aid)
		{
			$this->assign('addefault', 'Y');
		}else{
			$this->assign('addefault', 'N');
		}
		
		
		
		
		$this->display("./Application/Admin/UserFile/{$result['uid']}/{$result['order']}theme-basic.html");
		
		
	}
	
	/*
	 * 广告设置action--基本信息--设置
	 */
	public  function  updatathemebasic()
	{
		$aid = I('post.aid');
		$adname = I('post.adname');
		$adremark = I('post.adremark');
		$adstatus = I('post.adstatus');
		$addefault = I('post.addefault');
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$handle = M('adlist');
		$condition['aid'] = $aid;
		$handle->where($condition)->setField('adname', $adname);
		$handle->where($condition)->setField('adremark', $adremark);
		
		$handle2 = M('addefault');
		$condition2['uid'] = $uid;
		$result2 = $handle2->where($condition2)->find();
		
		if ($addefault == 'on')
		{
			if (!$result2)
			{
				$condition2['aid'] = $aid;
				$handle2->add($condition2);
			}else {
				$handle2->where($condition2)->setField('aid', $aid);
			}
			
		}else {
			
// 			if ($result2)
// 			{
// 				$response['data']['addefault'] = 0;
// 				//$handle2->where($condition2)->delete();
// 			}
		}
		
		
		$handle1 = M('adstatus');
		$condition1['uid'] = $uid;
		$result1 = $handle1->where($condition1)->getField('aid');
		
		
		
		
		if (!$result1)
		{
			if ($adstatus=='N')
			{
				$response['status'] = 1;
				$response['info'] = '';
				$response['type'] = 'JSON';
				$this->ajaxReturn($response, 'JSON');
					
			}elseif ($adstatus == 'Y') 
			{
				$condition1['aid'] = $aid;
				$handle1->add($condition1);
				
				$response['status'] = 2;
				$response['info'] = '';
				$response['type'] = 'JSON';
				$this->ajaxReturn($response, 'JSON');	
			}
				
		}else 
		{
			if ($result1 == $aid )
			{
				if ($adstatus == 'Y')
				{
					$response['status'] = 1;
					$response['info'] = '';
					$response['type'] = 'JSON';
					$this->ajaxReturn($response, 'JSON');
					
				}elseif ($adstatus == 'N')
				{
					$handle1->where($condition1)->delete();
					$response['status'] = 3;
					$response['info'] = '';
					$response['type'] = 'JSON';
					$this->ajaxReturn($response, 'JSON');
				}
				
			}else {
				
			if ($adstatus == 'Y')
				{
					$handle1->where($condition1)->setField('aid', $aid);
					$response['status'] = 2;
					$response['info'] = '';
					$response['type'] = 'JSON';
					$this->ajaxReturn($response, 'JSON');
					
				}elseif ($adstatus == 'N')
				{
					
					$response['status'] = 1;
					$response['info'] = '';
					$response['type'] = 'JSON';
					$this->ajaxReturn($response, 'JSON');
				}
				
			}
		}
		
		
		
		
	}
	
	/*
	 * 广告设置action--整站设置--展示
	*/
	
	public function adset_whole($aid)
	{
	
		$imgPath = C('IMG_PATH');
		$handle = M('adlist');
		$hosts = C('Hosts');
		
		$condition['aid'] = $aid;
		$result = $handle->where($condition)->find();
		$call = A('Publiccode');
		
		if ($imgPath == 0)
		{
			$imgsrc = "/tp/application/admin/userfile/{$result['uid']}/{$result['order']}upload_file/L0.jpg?rank=".$call->getrandstr();
		}else{
			$imgsrc = "/project001/tp/application/admin/userfile/{$result['uid']}/{$result['order']}upload_file/L0.jpg?rank=".$call->getrandstr();
		}
		
		$url_upload = "http://{$hosts}/tp/application/admin/userfile/{$result['uid']}/{$result['order']}do_file_upload.php";
		
		$handle1 = M('adbtn');
		$condition1['aid'] = $aid;
		$vermes = $handle1->where($condition1)->getField('vermes');
		$adbid = $handle1->where($condition1)->getField('adbid');
		
		$this->assign('imgsrc', $imgsrc);
		$this->assign('url_upload', $url_upload);
		$this->assign('order', $result['order']);
		$this->assign('uid', $result['uid']);
		$this->assign('vermes', $vermes);
		$this->assign('adbid', $adbid);
	
		$this->display("./Application/Admin/UserFile/{$result['uid']}/{$result['order']}theme-whole.html");
	
	
	}
	
	/*
	 * 广告设置action--整站设置--设置
	*/
	public function updatavermes(){
		
		$adbid  = I('post.adbid');
		$vermes = I('post.vermes');
		
		$handle = M('adbtn');
		
		$condition['adbid'] = $adbid;
		$condition['vermes'] = $vermes;
		
		$result = $handle->save($condition);
		
		$response['status'] = $result;
		$response['info'] = '';
		$response['type'] = 'JSON';
		$this->ajaxReturn($response, 'JSON');
		
	}
	
	/*
	 * 广告设置action--欢迎页设置--展示
	*/
	
	public function adset_welcome($aid)
	{
	
		$handle = M('adlist');
		$hosts = C('Hosts');
		$condition['aid'] = $aid;
		$result = $handle->where($condition)->find();
		$call = A('Publiccode');
		$imgPath = C('IMG_PATH');
		
		if ($imgPath == 0)
		{
			$Simgsrc = "/tp/application/admin/userfile/{$result['uid']}/{$result['order']}upload_file/S0.jpg?rank=".$call->getrandstr();
		}else{
			$Simgsrc = "/project001/tp/application/admin/userfile/{$result['uid']}/{$result['order']}upload_file/S0.jpg?rank=".$call->getrandstr();
		}
		
		$url_upload = "http://{$hosts}/tp/application/admin/userfile/{$result['uid']}/{$result['order']}do_file_upload.php";
		
		
		$handle1 = M('adbtn');
		$condition1['aid'] = $aid;
		$result1 = $handle1->where($condition1)->find();
		
		$this->assign('Simgsrc', $Simgsrc);
		$this->assign('url_upload', $url_upload);
		$this->assign('order', $result['order']);
		$this->assign('uid', $result['uid']);
		$this->assign('welcomeword', $result1['welcomeword']);
		$this->assign('fbtntext', $result1['fbtntext']);
		$this->assign('fbtntxtcol', $result1['fbtntxtcol']);
		$this->assign('fbtnbgcol', $result1['fbtnbgcol']);
		$this->assign('sbtntext', $result1['sbtntext']);
		$this->assign('guidecontent', $result1['guidecontent']);
		$this->assign('adbid', $result1['adbid']);
	
		
		
		$this->display("./Application/Admin/UserFile/{$result['uid']}/{$result['order']}theme-welcome.html");
	
	
	}
	
	/*
	 * 广告设置action--欢迎页设置--设置
	 */
	public function  updataadwelmes()
	{
		$adbid        = I('post.adbid');
		$welcomeword  = I('post.welcomeword');
		$fbtntext     = I('post.fbtntext');
		$guidecontent = I('post.guidecontent');
		$sbtntext     = I('post.sbtntext');
		$fbtnbgcol   = I('post.fbtnbgcol');
		$fbtntxtcol  = I('post.fbtntxtcol');
		
		$handle = M('adbtn');
		
		$condition['adbid'] = $adbid;
		$condition['welcomeword'] = $welcomeword;
		$condition['fbtntext'] = $fbtntext;
		$condition['guidecontent'] = $guidecontent;
		$condition['sbtntext'] = $sbtntext;
		$condition['fbtnbgcol']   = $fbtnbgcol;
		$condition['fbtntxtcol']  = $fbtntxtcol;
		
		$result = $handle->save($condition);
		
		$response['status'] = $result;
		$response['info'] = '';
		$response['type'] = 'JSON';
		$this->ajaxReturn($response, 'JSON');
			
	}
	
	/*
	 * 广告设置action--认证页设置--展示
	*/
	
	public function adset_authentication($aid){
		
		$handle = M('adlist');
		$condition['aid'] = $aid;
		$result = $handle->where($condition)->find();
		
		$handle1 = M('adbtn');
		$condition1['aid'] = $aid;
		$result1 = $handle1->where($condition1)->find();
		
		$this->assign('phoneguide', $result1['phoneguide']);
		$this->assign('wechatguide', $result1['wechatguide']);
		$this->assign('tbtntxtcol', $result1['tbtntxtcol']);
		$this->assign('tbtnbgcol', $result1['tbtnbgcol']);
		$this->assign('adbid', $result1['adbid']);
		
		
		

		$this->display("./Application/Admin/UserFile/{$result['uid']}/{$result['order']}theme-authentication.html");
		
		
	}
	
	/*
	 * 广告设置action--认证页设置--设置
	*/
	
	public  function updataauthmes()
	{
		$adbid       = I('post.adbid');
		$phoneguide  = I('post.phoneguide');
		$wechatguide = I('post.wechatguide');
		$tbtnbgcol   = I('post.tbtnbgcol');
		$tbtntxtcol  = I('post.tbtntxtcol');
		
		
		$handle = M('adbtn');
		
		$condition['adbid']       = $adbid;
		$condition['phoneguide']  = $phoneguide;
		$condition['wechatguide'] = $wechatguide;
		$condition['tbtnbgcol']   = $tbtnbgcol;
		$condition['tbtntxtcol']  = $tbtntxtcol;
	
		
		$result = $handle->save($condition);
		
		$response['status'] = $result;
		$response['info'] = '';
		$response['type'] = 'JSON';
		$this->ajaxReturn($response, 'JSON');
	}
	
	
	/*
	 * 广告设置action--广告后页--展示
	 */
	public function adset_after($aid)
	{
		$imgPath = C('IMG_PATH');
		$handle = M('adlist');
		$condition['aid'] = $aid;
		$result = $handle->where($condition)->find();
		
		
		$call = A('Publiccode');
		
		
		$current_dir = "./Application/Admin/UserFile/{$result['uid']}/{$result['order']}upload_file/";
		$dir = opendir($current_dir);
		$countF = 0;
		$counti = 1;
		
		while (false !== ($file = readdir($dir)))
		{
			if ($file != '.' && $file != '..')
			{
				switch ($file[0])
				{
					case 'F': 
						
						if ($imgPath == 0)
						{
							$src = "/tp/application/admin/userfile/{$result['uid']}/{$result['order']}upload_file/{$file}?rank=".$call->getrandstr();
						}else{
							$src = "/project001/tp/application/admin/userfile/{$result['uid']}/{$result['order']}upload_file/{$file}?rank=".$call->getrandstr();
						}
						$Fpicarr[$countF] = array(
							src => $src,
							id => substr($file, 0, 2),
						);
						
						$countF++;
						break;
						
					case 'I':
						
						if ($imgPath == 0)
						{
							$src = "/tp/application/admin/userfile/{$result['uid']}/{$result['order']}upload_file/{$file}?rank=".$call->getrandstr();
						}else{
							$src = "/project001/tp/application/admin/userfile/{$result['uid']}/{$result['order']}upload_file/{$file}?rank=".$call->getrandstr();
						}
						
						$Ipicarr[$counti] = array(
						 src => $src,
						 id => substr($file, 0, 3),
						
						);
						
						$counti++;
						break;
						
					default:break;
				}
				
			}
		}
		
		
		closedir($dir);
		
		
// 		var_dump($Ipicmes);
		
		$this->assign('Fpicarr', $Fpicarr);
		$this->assign('Ipicarr', $Ipicarr);
		$this->assign('a', $result['order']);
		
		

		$this->display("./Application/Admin/UserFile/{$result['uid']}/{$result['order']}theme-after.html"); 
		
	}
	
	/*
	 * 广告设置action--广告后页--添加照片
	*/
	
	public function addImg($head, $src)
	{
		$call = A('Publiccode');
		$hosts = C('Hosts');
		$uid = $call->check_valid_user();
		
		
		if ($src != 'new')
		{
			$handle = M('adpicurl');
			$condition['uid'] = $uid;
			$condition['theme'] = $head;
			$condition['picname'] = "F{$src}.jpg";
			
			$url = $handle->where($condition)->getField('url');
		}else {
			$url = '';
		}
		
		
		
		$this->assign('src', $src);
		$this->assign('uid', $uid);
		$this->assign('head', $head);
		$this->assign('url', $url);
		$this->assign('rank', time());
		$this->assign('hosts', $hosts);
	

		$this->display("./Application/Admin/UserFile/{$uid}/{$head}addImg.html");
	}
	
	/*
	 * 广告设置action--广告后页--去除照片
	*/
	
	public function remove_pic()
	{
		$src = I('post.src');
		$head = I('post.head');
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		if (unlink("./Application/Admin/UserFile/{$uid}/{$head}upload_file/{$src}"))
		{
			//删除该图片的URL记录
			
			$handle = M('adpicurl');
			$condition['uid'] = $uid;
			$condition['theme'] = $head;
			$condition['picname'] = $src;
			$handle->where($condition)->delete();
			
			$response['status'] = 1;
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response, 'JSON');
		}else {
			$response['status'] = 0;
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response, 'JSON');
			
		}
		
		
		
	}
	
	/*
	 * 广告设置action--广告后页--修改磁贴
	*/
	
	public function changeMagnet()
	{
		$before = I('post.before');
		$after  = I('post.after');
		$head = I('post.head');
		$magnetWord = I('post.magnetWord');
		$magnetURL = I('post.magnetURL');
		$imgPath = C('IMG_PATH');
		
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		
		if ($before == 567)  //before赋值为0是有问题的，赋值为字符串也是判断失败的
		{
			if (file_exists("./Application/Admin/UserFile/{$uid}/{$head}upload_file/{$after}"))
			{

				$response['status'] = 1;
				$response['info'] = '您已经拥有该磁贴（增加）';
				$response['type'] = 'JSON';
				$this->ajaxReturn($response, 'JSON');
				
			}else {
				
				if (copy("./Public/images/{$after}", "./Application/Admin/UserFile/{$uid}/{$head}upload_file/{$after}"))
				{
				
					$handle = M('adpicurl');
					$condition['uid'] = $uid;
					$condition['theme'] = $head;
					$condition['picname'] = $after;
					$condition['magnetname'] = $magnetWord;
					$condition['url'] = $magnetURL;
					$handle->add($condition);
				
					if ($imgPath == 0)
					{
						$src = "/tp/application/admin/userfile/{$uid}/{$head}upload_file/{$after}?rank=".$call->getrandstr();
					}else{
						$src = "/Project001/tp/application/admin/userfile/{$uid}/{$head}upload_file/{$after}?rank=".$call->getrandstr();
					}
				
					$response['data'] = array(
							'src' => $src,
					);
				
					$response['status'] = 0;
					$response['info'] = '';
					$response['type'] = 'JSON';
					$this->ajaxReturn($response, 'JSON');
				
			}else{
// 				$response['data'] = '设置失败';
				$response['status'] = 1;
				$response['info'] = '设置失败';
				$response['type'] = 'JSON';
				$this->ajaxReturn($response, 'JSON');
				
			}
			
			
			}
			
		}elseif ($before == $after)
		{
			$handle = M('adpicurl');
			$condition['uid'] = $uid;
			$condition['theme'] = $head;
			$condition['picname'] = $after;
			
			$result = $handle->where($condition)->find();
			
			if ($result)
			{
				$save['magnetname'] = $magnetWord;
				$save['url'] = $magnetURL;
					
				$handle->where($condition)->save($save);
					
			}else {
				$condition['magnetname'] = $magnetWord;
				$condition['url'] = $magnetURL;
				$handle->add($condition);
			}
			
		
			
// 			$response['data'] = '磁贴信息修改成功';
			$response['status'] = 1;
			$response['info'] = '磁贴信息修改成功';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response, 'JSON');
			
			
		}elseif (!file_exists("./Application/Admin/UserFile/{$uid}/{$head}upload_file/{$after}"))
		{
			
			
			if (
					unlink("./Application/Admin/UserFile/{$uid}/{$head}upload_file/{$before}") &&
					copy("./Public/images/{$after}", "./Application/Admin/UserFile/{$uid}/{$head}upload_file/{$after}")
						)
			{
				
				//删除该图片的URL记录
				
				$handle = M('adpicurl');
				$condition['uid'] = $uid;
				$condition['theme'] = $head;
				$condition['picname'] = $before;
				$handle->where($condition)->delete();
				
				$condition['picname'] = $after;
				$condition['magnetname'] = $magnetWord;
				$condition['url'] = $magnetURL;
				$handle->add($condition);
				
				if ($imgPath == 0)
				{
					$src = "/tp/application/admin/userfile/{$uid}/{$head}upload_file/{$after}?rank=".$call->getrandstr();
				}else{
					$src = "/project001/tp/application/admin/userfile/{$uid}/{$head}upload_file/{$after}?rank=".$call->getrandstr();
				}
				
				$response['data'] = array(
					'oldfilename' => substr($before, 0, 3),
					'src' => $src,
				);
				
				$response['status'] = 0;
				$response['info'] = '';
				$response['type'] = 'JSON';
				$this->ajaxReturn($response, 'JSON');
				
			}else {
				
// 				$response['data'] = '设置失败';
				$response['status'] = 1;
				$response['info'] = '设置失败';
				$response['type'] = 'JSON';
				$this->ajaxReturn($response, 'JSON');
				
			} 
			
			
			
		}else {
// 			$response['data'] = '您已经拥有该磁贴';
			$response['status'] = 1;
			$response['info'] = '您已经拥有该磁贴';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response, 'JSON');
				
		}
		
		
		
		
	}
	
	/*
	 * 广告设置action--广告后页--返回磁贴信息
	*/
	
	public function callMagnetmes()
	{
		$filename = I('post.filename');
		$head = I('post.head');
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$handle = M('adpicurl');
		$condition['uid'] = $uid;
		$condition['theme'] = $head;
		$condition['picname'] = $filename;
		
		$result = $handle->where($condition)->find();
		
		if ($result)
		{
			$response['data'] = array(
					'name' => $result['magnetname'],
					'url' => $result['url'],
			);
		}else {
			$response['data'] = array(
					'name' => ' ',
					'url' => ' ',
			);
		}
			
			$response['status'] = 1;
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response, 'JSON');
		
		
		
		
		
	}
	
	/*
	 * 广告设置action--广告后页--删除磁贴
	*/
	public function  remove_magnet()
	{
		$src = I('post.src');
		$head = I('post.head');
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		if (unlink("./Application/Admin/UserFile/{$uid}/{$head}upload_file/{$src}"))
		{
			//删除该图片的URL记录
				
			$handle = M('adpicurl');
			$condition['uid'] = $uid;
			$condition['theme'] = $head;
			$condition['picname'] = $src;
			$handle->where($condition)->delete();
				
			$response['status'] = 1;
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response, 'JSON');
		}else {
			$response['status'] = 0;
			$response['info'] = '';
			$response['type'] = 'JSON';
			$this->ajaxReturn($response, 'JSON');
				
		}
		
	}
	
	
}