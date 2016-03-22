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
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/themeAdd.html');
		
	}
	
	/*
	 * 广告列表数据的返回
	 */
	public function admescalling()
	{
		$call = A('Publiccode');
		
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
		}
			
	
		//$num = count($result,0);
	
		
		//$response['adnum'] = $num;
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
		}else{
			$num = 0;
		}
		
		
		//上面添加广告完成，下面将是根据广告模板选择复制文件到相应文件夹上
		
// 		copy('./Public/GLProject/load/'.$admodel.'/upload.html', './Application/Admin/UserFile/'.$uid.'/'.$num.'upload.html');
//  	copy('./Public/GLProject/load/'.$admodel.'/showpic.html', './Application/Admin/UserFile/'.$uid.'/'.$num.'showpic.html');
 		
		$call->cp_files('./Public/GLProject/load/'.$admodel.'/', './Application/Admin/UserFile/'.$uid.'/', $num);
		$call->cp_files('./Public/GLProject/load/'.$admodel.'/upload_file/', './Application/Admin/UserFile/'.$uid."/{$num}upload_file/", '');
		
		
//  		if (mkdir('./Application/Admin/UserFile/'.$uid.'/'.$num.'upload_file'))
//  		{
//  			copy('./Public/GLProject/load/'.$admodel.'/upload_files/F0.jpg', './Application/Admin/UserFile/'.$uid.'/'.$num.'upload_file/F0.jpg');
//  			copy('./Public/GLProject/load/'.$admodel.'/upload_files/F1.jpg', './Application/Admin/UserFile/'.$uid.'/'.$num.'upload_file/F1.jpg');
//  			copy('./Public/GLProject/load/'.$admodel.'/upload_files/F2.jpg', './Application/Admin/UserFile/'.$uid.'/'.$num.'upload_file/F2.jpg');
//  		}
 		
 		$data = array(
 				'uid' => $uid,
 				'order' => $num,
 				'adname' => $adname,
 				'admodel' => $admodel,
 				'adremark' => $adremark,
 				'url' => 'http://'.$hosts.'/TP/index.php/Admin/Adset/showad/shop/'.$uid,
 				'uploadfile' => $num.'themeSet',
 		);
 			
 		$handle = M('adlist');
 		$aid = $handle->add($data);
 		
 		$save['aid'] = $aid;
 		$save['url'] = 'http://'.$hosts.'/TP/index.php/Admin/Adset/showad/shop/'.$uid.'/aid/'.$aid;
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
	 * 广告上传图片action
	 */
  	/*
	public  function upload_model1(){
		
	
// 		$validname = $_SESSION['valid_user'];
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$a = $_POST['num'];
		
		$count = count($_FILES,0);
		
		//检测上传了多少张图片的检测数组$count_arr定义
		for($i = 0; $i<$count; $i++)
		{
			$str = 'userfile'.$i;
			if ($_FILES[$str]['name'] == '')
			{
				$count_arr[$i] = 0;
			}
			else {
				$count_arr[$i] = 1;
			}
		
		}
		
		for ($i = 0; $i<$count; $i++)
		{
			$str = 'userfile'.$i;
		
			if ($count_arr[$i] == 1 && $_FILES[$str]['error'] > 0 )
			{
			echo 'Problem: ';
			switch ($_FILES[$str]['error'])
			{
				case 1:	echo 'File exceeded upload_max_filesize';
	  			break;
      			case 2:	echo 'File exceeded max_file_size';
		      	break;
      			case 3:	echo 'File only partially uploaded';
		      	break;
      			case 4:	echo 'No file uploaded';
		     	 break;
		     	case 6: echo 'Cannot upload file: No temp directory specified.';
	  			break;
	  			case 7: echo 'Upload failed: Cannot write to disk.';
	  			break;
    		}
    		exit;
		}
		
		}
		
		$j =0 ;
		for ($i = 0; $i<$count; $i++)
		{
		
		  $str = 'userfile'.$i;
		
		  if($count_arr[$i] == 1)
		 {
		
		// Does the file have the right MIME type?
			if ($_FILES[$str]['type'] != 'text/plain' && $_FILES[$str]['type'] != 'image/jpeg')
  	         {
					echo 'Problem: file is not plain text or JPEG file';
    	            exit;
			 }
		
					// put the file where we'd like it
			//$upfile = './upload_files/'.'F'.$j.'.jpg';
			$upfile = './Application/Admin/UserFile/'.$uid.'/'.$a.'upload_file/F'.$j.'.jpg';
			$j++;
		
			if (is_uploaded_file($_FILES[$str]['tmp_name']))
  		       {
				 if (!move_uploaded_file($_FILES[$str]['tmp_name'], $upfile))
				 {
					echo 'Problem: Could not move file to destination directory';
       		        exit;
				 }
				}
				else
				{
				 echo 'Problem: Possible file upload attack. Filename: ';
    	         echo $_FILES[$str]['name'];
		    	 exit;
				}
							 
				// echo 'File uploaded successfully<br><br>';
		
	      }
		 }
		 
// 		 $response['data'] = 'success '.$count;
// 		 $response['status'] = 1;
// 		 $response['info'] = '';
// 		 $response['type'] = 'JSON';
		 
// 		 $this->ajaxReturn($response, 'JSON');

		 $this->success('success');
		
		
	}
	*/
	
	
	/*
	 * 广告展示action--欢迎页
	 * 
	 * $aid为0的时候是展现当前设置的默认广告，否则是展现相应的广告
	 * $shop:用户的id（uid）
	 * $aid: 广告的id
	 */
	public function showad($shop, $aid)
	{
		
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
				$Spicarr[$countS] = '/tp/application/admin/userfile/'.$shop.'/'.$order.'upload_file/'.$file.'?rank='.time();
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
		
		$this->display($str);
	}
	

	/*
	 * 广告展示action-认证页
	*
	* $aid:为要展现的广告ID
	*/
	
	public function showad2($aid)
	{
	
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
				$Lpicarr[$countL] = '/tp/application/admin/userfile/'.$result['uid'].'/'.$result['order'].'upload_file/'.$file.'?rank='.time();
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
		
		
		
		$this->assign('vermes', $vermes);
		$this->assign('wechatguide', $wechatguide);
		$this->assign('phoneguide', $phoneguide);
		$this->assign('tbtnbgcol', $result1['tbtnbgcol']);
		$this->assign('tbtntxtcol', $result1['tbtntxtcol']);
		$this->assign('aid', $aid);
		
		
		$str = './Application/Admin/UserFile/'.$result['uid'].'/'.$result['order'].'mymobile-theme-authentication.html';
		$this->display($str);
		

	}
	
	/*
	 * 广告展示action-广告页
	*
	* $aid:为要展现的广告ID
	*/
	
	public function showad3($aid)
	{
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
					
					
					
					$Ipicarr[$countI] = array(
							
							'src' => '/tp/application/admin/userfile/'.$result['uid'].'/'.$result['order'].'upload_file/'.$file.'?rank='.time(),
							'name' => $Ipicnamearr,
							'url' => $Ipicurlarr,
						
					);
					
					$countI++;
				}else{
					
					$Lpicarr[$countL] = '/tp/application/admin/userfile/'.$result['uid'].'/'.$result['order'].'upload_file/'.$file.'?rank='.time();
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
				
					$Fpicarr[$countF] = '/tp/application/admin/userfile/'.$result['uid'].'/'.$result['order'].'upload_file/'.$file.'?rank='.time();
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
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$handle = M('adlist');
		$condition['aid'] = $aid;
		$handle->where($condition)->setField('adname', $adname);
		$handle->where($condition)->setField('adremark', $adremark);
		
		
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
	
		$handle = M('adlist');
		$hosts = C('Hosts');
		
		$condition['aid'] = $aid;
		$result = $handle->where($condition)->find();
		$call = A('Publiccode');
		
		$imgsrc = "/tp/application/admin/userfile/{$result['uid']}/{$result['order']}upload_file/L0.jpg?rank=".$call->getrandstr();
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
		
		$Simgsrc = "/tp/application/admin/userfile/{$result['uid']}/{$result['order']}upload_file/S0.jpg?rank=".$call->getrandstr();
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
						$Fpicarr[$countF] = array(
							src => "/tp/application/admin/userfile/{$result['uid']}/{$result['order']}upload_file/{$file}?rank=".$call->getrandstr(),
							id => substr($file, 0, 2),
						);
						
						$countF++;
						break;
					case 'I':
						$Ipicarr[$counti] = array(
						 src => "/tp/application/admin/userfile/{$result['uid']}/{$result['order']}upload_file/{$file}?rank=".$call->getrandstr(),
						 id => substr($file, 0, 3),
						
						);
						
						$counti++;
						break;
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
		
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		
		if ($before == 567)  //before赋值为0是有问题的，赋值为字符串也是判断失败的
		{
			if (file_exists("./Application/Admin/UserFile/{$uid}/{$head}upload_file/{$after}"))
			{
// 				$response['data'] = '您已经拥有该磁贴（增加）';
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
				
				
					$response['data'] = array(
							'src' => "/tp/application/admin/userfile/{$uid}/{$head}upload_file/{$after}?rank=".$call->getrandstr(),
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
				
				
				$response['data'] = array(
					'oldfilename' => substr($before, 0, 3),
					'src' => "/tp/application/admin/userfile/{$uid}/{$head}upload_file/{$after}?rank=".$call->getrandstr(),
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