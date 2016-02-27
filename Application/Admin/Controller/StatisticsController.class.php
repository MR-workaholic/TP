<?php
namespace Admin\Controller;
use Think\Controller;
class StatisticsController extends Controller {
	
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	
	/*
	 * 设备统计的视图
	 */
	public function APstatistics(){
		
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/APstatistics.html');
		
	}
	
	/*
	 * 用户统计的视图
	 */	
	public function userStatistics(){
		
		$call = A('Publiccode');
		$call->check_valid_user();
		$this->display('./GLLogin/Signin/zui-master-me/Merchant/userStatistics.html');
		
	}
	
	public function APStatisticsmescalling(){
		
		$call = A('Publiccode');
		$uid = $call->check_valid_user();
		
		$handle = M('devicelist');
		$condition['uid'] = $uid;
		$result = $handle->where($condition)->select();
		$num = count($result,0);
		
		if(!$result)
		{
			$response['status'] = 0;
		}else {
			$response['status'] = $num;
		}
		
		
	if($num != 0)
	{
		
	$a = 100/$num;	
		
	for ($i=0; $i < $num; $i++)
	{
		$data['data'][$i]['dname'] = $result[$i]['dname'];
		$data['data'][$i]['did'] = $result[$i]['did'];
		
		if (!$type[$result[$i]['dtype']])
		{
			$type[$result[$i]['dtype']] = $a;
		}else {
			$type[$result[$i]['dtype']] += $a;
		}
		
		if (!$version[$result[$i]['dtype'].$result[$i]['version']])
		{
			$version[$result[$i]['dtype'].$result[$i]['version']] = $a;
		}else {
			$version[$result[$i]['dtype'].$result[$i]['version']] += $a;
		}
		
	}
	$data['type'] = $type;
	$data['version'] = $version;
	
	
	
	$response['data'] = $data;
	}

		
		$response['info'] = '';
		$response['type'] = 'JSON';
		$this->ajaxReturn($response,'JSON');
		
		
	}
	
	/*
	 * POST获取的信息有：
	 * date：日期
	 * 其中0表示今天，1表示昨天，2表示近一周，3表示近一个月
     * dev：需要统计的设备
	 * 其中dev为0的时候返回各设备的数据以及数据总和。当dev为非0时，返回相应设备的统计数据
	 * 
	 * 函数返回相应的统计信息，现所有返回的统计数据均是随机数
	 * */
	
	public function handlepro()
	{
		$call = A('Publiccode');
		
		$date = $_POST['date'];
		$dev = $_POST['dev'];
		//$num = $call->get_devnum();
		
		$handle = M('devicelist');
		
		$uid = $call->check_valid_user();
		$condition['uid'] = $uid;
		
		$result = $handle->where($condition)->select();
		
		$num = count($result, 0);
		
		if ($num)
		{
		
		switch ($date)
		{
			case 0:
				if ($dev)
				{
					$num = 1;
					$data['data'][0]['dname'] = $result[0]['dname'];
					$data['bigdataflow'][0] = $this->returndata(12);
					$data['bigdatauser'][0] = $this->returndata(12);
					
				}
				else {
					$data['data'][$num]['dname'] = 'all dev';
					$data['bigdataflow'][$num] = [0,0,0,0,0,0,0,0,0,0,0,0];
					$data['bigdatauser'][$num] = [0,0,0,0,0,0,0,0,0,0,0,0];
					for($i=0; $i<$num; $i++)
					{
						$data['data'][$i]['dname'] = $result[$i]['dname'];
						$data['bigdataflow'][$i] = $this->returndata(12);
						$data['bigdatauser'][$i] = $this->returndata(12);
 						$data['bigdataflow'][$num] = $this->arr_add($data['bigdataflow'][$num], $data['bigdataflow'][$i]);
 						$data['bigdatauser'][$num] = $this->arr_add($data['bigdatauser'][$num], $data['bigdatauser'][$i]);
					}
					
					$num++;
				}
				break;
			case 1:
				
			if ($dev)
				{
					$num = 1;
					$data['data'][0]['dname'] = $result[0]['dname'];
					$data['bigdataflow'][0] = $this->returndata(12);
					$data['bigdatauser'][0] = $this->returndata(12);
					
				}
				else {
					$data['data'][$num]['dname'] = 'all dev';
					$data['bigdataflow'][$num] = [0,0,0,0,0,0,0,0,0,0,0,0];
					$data['bigdatauser'][$num] = [0,0,0,0,0,0,0,0,0,0,0,0];
					for($i=0; $i<$num; $i++)
					{
						$data['data'][$i]['dname'] = $result[$i]['dname'];
						$data['bigdataflow'][$i] = $this->returndata(12);
						$data['bigdatauser'][$i] = $this->returndata(12);
 						$data['bigdataflow'][$num] = $this->arr_add($data['bigdataflow'][$num], $data['bigdataflow'][$i]);
 						$data['bigdatauser'][$num] = $this->arr_add($data['bigdatauser'][$num], $data['bigdatauser'][$i]);
					}
					
					$num++;
				}
				break;
				
			case 2:
			if ($dev)
				{
					$num = 1;
					$data['data'][0]['dname'] = $result[0]['dname'];
					$data['bigdataflow'][0] = $this->returndata(12);
					$data['bigdatauser'][0] = $this->returndata(12);
					
				}
				else {
					$data['data'][$num]['dname'] = 'all dev';
					$data['bigdataflow'][$num] = [0,0,0,0,0,0,0,0,0,0,0,0];
					$data['bigdatauser'][$num] = [0,0,0,0,0,0,0,0,0,0,0,0];
					for($i=0; $i<$num; $i++)
					{
						$data['data'][$i]['dname'] = $result[$i]['dname'];
						$data['bigdataflow'][$i] = $this->returndata(12);
						$data['bigdatauser'][$i] = $this->returndata(12);
 						$data['bigdataflow'][$num] = $this->arr_add($data['bigdataflow'][$num], $data['bigdataflow'][$i]);
 						$data['bigdatauser'][$num] = $this->arr_add($data['bigdatauser'][$num], $data['bigdatauser'][$i]);
					}
					
					$num++;
				}
				break;
				
			case 3:
			if ($dev)
				{
					$num = 1;
					$data['data'][0]['dname'] = $result[0]['dname'];
					$data['bigdataflow'][0] = $this->returndata(12);
					$data['bigdatauser'][0] = $this->returndata(12);
					
				}
				else {
					$data['data'][$num]['dname'] = 'all dev';
					$data['bigdataflow'][$num] = [0,0,0,0,0,0,0,0,0,0,0,0];
					$data['bigdatauser'][$num] = [0,0,0,0,0,0,0,0,0,0,0,0];
					for($i=0; $i<$num; $i++)
					{
						$data['data'][$i]['dname'] = $result[$i]['dname'];
						$data['bigdataflow'][$i] = $this->returndata(12);
						$data['bigdatauser'][$i] = $this->returndata(12);
 						$data['bigdataflow'][$num] = $this->arr_add($data['bigdataflow'][$num], $data['bigdataflow'][$i]);
 						$data['bigdatauser'][$num] = $this->arr_add($data['bigdatauser'][$num], $data['bigdatauser'][$i]);
					}
					
					$num++;
				}
				break;
		}
		
		$data['dev'] = $dev;
		$data['curlver'] = curl_version();
		
		$response['data'] = $data;
		}
		
		
		$response['status'] = $num;
		$response['info'] = '';
		$response['type'] = 'JSON';
		
		$this->ajaxReturn($response, 'JSON');
	}
	
	//返回实验随机数
	public function returndata($number){
		
		
		for($i=0; $i<$number; $i++)
		{
			$arr[$i] = rand(10, 100);
		}
		
		return $arr;
		
	}
	
	//数组相加
	public function arr_add($a, $b)
	{
		$num = count($a);
		for($i=0; $i<$num; $i++)
		{
			$a[$i] += $b[$i];
		}
		return $a;
	}
	
	/*
	 * 根据post得到的date：日期，该函数返回用户统计数据
	 * 其中0表示今天，1表示昨天，2表示近一周，3表示近一个月，但这里没有利用该数据，返回的数据均是随机数
	 * 在线用户为在线的总人数，只返回一组数据
	 * */
	
	public function handleuserpro(){
		
		$call = A('Publiccode');
		$call->check_valid_user();
		$date = $_POST['date'];
		
		$num = $call->get_devnum();
		$uid = $call->check_valid_user();
		
		if($num)
		{
		
		//返回总线总人数数据
		$data['bigdatauser'] = $this->returndata(12);
		
		//返回在线时长数据
		$handle = M('authentication');
		$condition['uid'] = $uid;
		$wifitime = $handle->where($condition)->getField('wifitime');
		$data['wifitime'] = $wifitime;
		$data['onlinetime'] = $this->returndata(4);
		
		//返回流量使用最多的前10个用户
		$data['userflow'] = $this->returndata(10);
	    $data['userflow'] = $this->quick_sort_sec($data['userflow']);
	    $data['userflow'] = $this->tran_arr($data['userflow']);
// 	    $data['findpos'] = $this->findpos($data['userflow'],1,10);//测试findpos没有错误

	    //返回新老客户
		$data['newuser'] = $this->returndata(2);
		
		//返回认证比例
		$data['loginay'] = $this->returndata(3);
		
		
		
		$response['data'] = $data;
		}
		
		
		$response['status'] = $num;
		$response['info'] = '';
		$response['type'] = 'JSON';
		
		$this->ajaxReturn($response, 'JSON');

		
	}
	
	public function test($value)
	{
		$value[0] = 1;
		$value[1] = 2;
		
		return $value;
	}
	
	public function tran_arr($arr){
		
		$length = count($arr);
		if($length <= 1) {
			return $arr;
		}
		
		for ($i=0; $i<$length/2; $i++)
		{
			$arr = $this->swap($arr, $i, $length-$i-1);
		}
		
		return $arr;
		
		
	}
	/*
	 * 快速排序
	 */
	public function quick_sort_sec($arr) {
		//先判断是否需要继续进行
		$length = count($arr);
		if($length <= 1) {
			return $arr;
		}
		//如果没有返回，说明数组内的元素个数 多余1个，需要排序
		//选择一个标尺
		//选择第一个元素
		$base_num = $arr[0];
		//遍历 除了标尺外的所有元素，按照大小关系放入两个数组内
		//初始化两个数组
		$left_array = array();//小于标尺的
		$right_array = array();//大于标尺的
		for($i=1; $i<$length; $i++) {
			if($base_num > $arr[$i]) {
				//放入左边数组
				$left_array[] = $arr[$i];
			} else {
				//放入右边
				$right_array[] = $arr[$i];
			}
		}
		//再分别对 左边 和 右边的数组进行相同的排序处理方式
		//递归调用这个函数,并记录结果
		$left_array = $this->quick_sort_sec($left_array);
		$right_array = $this->quick_sort_sec($right_array);
		//合并左边 标尺 右边
		return array_merge($left_array, array($base_num), $right_array);
	}
	
	
	public function quick_sort($arr, $min, $max)
	{
		if ($min >= $max)
		{
			
		}else {
			$arr = $this->findpos($arr, $min, $max);
// 			$arr = $this->quick_sort($arr, $min, $arr[0]);
// 			$arr = $this->quick_sort($arr, $arr[0], $max);
			
		}
		return $arr;
		
	}
	
	public function findpos($arr, $min, $max)
	{
		$mid = ($min+$max);
		$a = $arr[$min] < $arr[$mid] ? $arr[$min] : $arr[$mid];
		$b = $arr[$min] < $arr[$max] ? $arr[$min] : $arr[$max];
		
		if(($a == $arr[$min] && $b != $arr[$min]) || ($b == $arr[$min] && $a != $arr[$min]))
		{
			
		}else
		{
		if ($a == $b)
		{
			
			if ($arr[mid] < $arr[max])
			{
				$arr = $this->swap($arr, $min, $mid);
			}else {
				$arr = $this->swap($arr, $min, $max);
			}
				
		}else {
			
			if ($arr[mid] > $arr[max])
			{
				$arr = $this->swap($arr, $min, $mid);
			}else {
				$arr = $this->swap($arr, $min, $max);
			}
			
		}
		
		}
		
		$temp = $arr[$min];
		
		while($min < $max)
		{
			
			
			while ($min<$max && $arr[$max]>$temp)
			{
				$max--;
			}
			
			$arr = $this->swap($arr, $min, $max);
			
			while ($min<$max && $arr[$min]<$temp)
			{
				$min++;
			}
			
			$arr = $this->swap($arr, $min, $max);
			
		}
		
		$arr[0] = $min;
		
		return $arr;
		
	}
	
	public function swap($arr, $a, $b)
	{
		$temp = $arr[$a];
		$arr[$a] = $arr[$b];
		$arr[$b] = $temp;
		
		return $arr;
	}
	
	
	
	
	
}