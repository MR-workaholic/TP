<?php

    $dir=opendir('./');
    $count = 0;
    while (false !== ($file = readdir($dir)))
    {
    	if ($file != "." && $file != "..")
    	{
    		$count++;
    	}
    }
    
    
    
// 	$filename = date('YmdHis') . '.jpg';
	$filename = $count.'.jpg';
	$str = file_get_contents("php://input");
	$result = file_put_contents( './' . $filename, pack("H*", $str) );  // 参看http://www.kuitao8.com/20140727/2867.shtml

	
// 	$test = $_GET['dirname'];
// 	file_put_contents('test1/look.txt', $test);
	//mkdir(date('Ymd'));
// 	$result = file_put_contents( date('Ymd').'/' . $filename, pack("H*", $str) );  // 参看http://www.kuitao8.com/20140727/2867.shtml
	
?>