<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
 
	public function test(){
		echo 'this is a test too';
	}
	
	public function test1($name = 'hello')
	{
		
		echo "this is ".$name;
	}
	
	public function test2($name = 'mary', $behavior = 'eat')
	{
		
		echo $name." is do ".$behavior;
	}
	public function test3($num = 1)
	{
		
		echo "tom's num is ".$num;
	}

}