<?php
header("content-type:text/html;charset=utf-8");
require_once '../../../../Public/db/connect.php';

if(isset($_POST["dir"])){

	$flat = $_POST["flat"];
	
	if ($flat == 'L' || $flat == 'S')
	{
		$dir = $_POST["dir"];
		$uid=$_POST['uid'];
		$theme=$_POST['theme'];
		
		
		session_start();
		$_SESSION['dir'] = $dir;
		$_SESSION['flat'] = $flat;
		$_SESSION['puid'] = $uid;
		$_SESSION['theme'] = $theme;
		
		
		echo $dir.$flat.$uid.$theme;
		
	}else{
		
		$dir = $_POST["dir"]; 
		$url=$_POST['imgURL'];
		$src=$_POST['src'];
		$uid=$_POST['uid'];
		$theme=$_POST['theme'];
		
		session_start();
		$_SESSION['dir'] = $dir;
		$_SESSION['flat'] = $flat;
		$_SESSION['url'] = $url;
		$_SESSION['src'] = $src;
		$_SESSION['puid'] = $uid;
		$_SESSION['theme'] = $theme;
		
		
		
		echo $_SESSION['dir'].$_SESSION['flat'].$_SESSION['url'].$_SESSION['src'].'url:'.$_SESSION['url'];
		
		
	}
	
}
else{
	
		session_start();       
        $flat =$_SESSION['flat'];
        
        if ($flat == 'L' || $flat == 'S')
        {
        	$dir =$_SESSION['dir'];
        	$uid=$_SESSION['puid'];
        	$theme=$_SESSION['theme'];
        	
        	
        	unset($_SESSION['dir']);
        	unset($_SESSION['flat']);
        	unset($_SESSION['puid']);
        	unset($_SESSION['theme']);
        	
        	
        	$upFilePath = "../{$dir}/{$flat}0.jpg";
        	
        	/*
        	 * 图片上传
        	*/
        	$ok=@move_uploaded_file($_FILES['img']['tmp_name'], $upFilePath);
        	
        	if ($ok === false)
        	{
        	 
        			$success = array(
        					'ret' => 3,
        		
        			);
        			echo json_encode($success);
        			exit();
        	
        	}else {
        		
        	
        		$success = array(
        				'ret' => 0,
        				'rank' =>time(),
        				 
        		);
        		echo json_encode($success);
        		
        	}
        	
        	
        	
        	
        }else {
        	
   			$dir =$_SESSION['dir'];
        	$url=$_SESSION['url'];
        	$src=$_SESSION['src'];
        	$uid=$_SESSION['puid'];
        	$theme=$_SESSION['theme'];
        	$add = 0;
        	
        	unset($_SESSION['dir']);
        	unset($_SESSION['flat']);
        	unset($_SESSION['url']);
        	unset($_SESSION['src']);
        	unset($_SESSION['puid']);
        	unset($_SESSION['theme']);
        	
        	
        	/*
        	 * 判断是添加还是编辑，根据此判断出图片的上传名称
        	*/
        	if ($src == 'new')
        	{
        		$add = 1;
        		// 	        $src = file_count($dir,$flat);
        		$src = file_num($dir, $flat);
        			
        		if ($src ===  false)
        		{
        			$fail = array(
        					'ret' => 2,
        			);
        			echo json_encode($fail);
        			exit();
        	
        		}else {
        			$upFilePath = "../{$dir}/{$flat}{$src}.jpg";
        		}
        	
        	}else{
        		$add = 0;
        		$upFilePath = "../{$dir}/{$flat}{$src}.jpg";
        	}
        	
        	
        	/*
        	 * 图片上传
        	*/
        	$ok=@move_uploaded_file($_FILES['img']['tmp_name'], $upFilePath);
        	
        	if($ok === FALSE){  
        		 
        		//上传失败，可能是真的失败，或者仅仅是修改url信息而已
        		if($url && $add==0)
        		{
        			//修改URL信息
        	
        			//URL非空，需要判断是否已经存在该图片的URL信息而进行更新还是插入操作
        			$selectsql = "select * from glproject_adpicurl where uid={$uid} and theme={$theme} and picname='{$flat}{$src}.jpg'";
        			$query = mysqli_query($con,$selectsql);
        			 
        			 
        			if($query&&mysqli_num_rows($query)){
        				//存在
        				$updatesql = "update glproject_adpicurl set url='{$url}' where uid={$uid} and theme={$theme} and picname='{$flat}{$src}.jpg'";
        				$result = mysqli_query($con, $updatesql);
        			}else{
        				//不存在
        				$insertsql = "insert into glproject_adpicurl(uid, theme, picname, url) values('{$uid}', '{$theme}', '{$flat}{$src}.jpg','{$url}')";
        				$result = mysqli_query($con,$insertsql);
        			}
        	
        			$success = array(
        					'ret' => 3,
        					'dbret' => $query,
        					 
        			);
        			echo json_encode($success);
        			exit();
        	
        		}else
        		{
        			//真的上传失败
        			$fail = array(
        					'ret' => 1,
        			);
        			echo json_encode($fail);
        			exit();
        		}
        		 
        		 
        	
        	}else{
        		 
        		if ($add)
        		{
        			//添加图片,URL入库
        				$insertsql = "insert into glproject_adpicurl(uid, theme, picname, url) values('{$uid}', '{$theme}', '{$flat}{$src}.jpg','{$url}')";
        				$result = mysqli_query($con,$insertsql);
        			
        			 
        		}else{
        			//编辑图片
        			//URL需要判断是否已经存在该图片的URL信息而进行更新还是插入操作
        				$selectsql = "select * from glproject_adpicurl where uid={$uid} and theme={$theme} and picname='{$flat}{$src}.jpg'";
        				$query = mysqli_query($con,$selectsql);
        				 
        				if($query&&mysqli_num_rows($query)){
        					//存在
        					$updatesql = "update glproject_adpicurl set url='{$url}' where uid={$uid} and theme={$theme} and picname='{$flat}{$src}.jpg'";
        					$result = mysqli_query($con, $updatesql);
        				}else{
        					//不存在
        					$insertsql = "insert into glproject_adpicurl(uid, theme, picname, url) values('{$uid}', '{$theme}', '{$flat}{$src}.jpg','{$url}')";
        					$result = mysqli_query($con,$insertsql);
        				}
        	
        			 
        		}
        		 
        		$success = array(
        				'ret' => 0,
        				'rank' =>time(),
        				'filename' => "{$flat}{$src}",
        				'add' => $add,
        				'dbret' => $result,
        				 
        		);
        		echo json_encode($success);
        	}
        	
        	
        	 
        	
        }
      
    

}

/**/
 function file_count($dir,$flat)
{

    $current_dir = "../{$dir}/";

    $dir = opendir($current_dir);
    $countF = 0;

    while (false !== ($file = readdir($dir)))
    {
        if ($file != '.' && $file != '..' && $file[0] == $flat)
        {
            $countF++;
           
        }
    }

    closedir($dir);
    return $countF;

}

function file_num($dir,$flat)
{
	$current_dir = "../{$dir}/{$flat}";
	for($i=0; $i<5; $i++)
	{
		if (!file_exists($current_dir.$i.'.jpg'))
		{
			return $i;
		}
	}
	return false;

}



