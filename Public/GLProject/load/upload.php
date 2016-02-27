<html>
<head>
  <title>Uploading...</title>
</head>
<body>
<h1>Uploading file...</h1>
<?php

//Check to see if an error code was generated on the upload attempt

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
	  case 6:   echo 'Cannot upload file: No temp directory specified.';
	  			break;
	  case 7:   echo 'Upload failed: Cannot write to disk.';
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
  		$upfile = './upload_files/'.'F'.$j.'.jpg';
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
  	
  	echo 'File uploaded successfully<br><br>';

	}
	}
	
	/*
	echo  '--'.$j.'<br>';
	
	$current_dir = './upload_files/';
	$dir = opendir($current_dir);
	
	while (false !== ($file = readdir($dir)))
	{
		if ($file != '.' && $file != '..')
		{
			echo '<br> '.$file[1];
			
			if ($file[0] == 'F' && $file[1] >= $j)
			{
				echo '<br>del';
				//while (!unlink($current_dir.$file));  //删除F开头的非新上传的旧文件
				
			}else {
				echo '<br>'.$file;
			}
		}
	}
	
	closedir($dir);
	echo  '<br>';
  
    */

//   // reformat the file contents
//   $fp = fopen($upfile, 'r');
//   $contents = fread ($fp, filesize ($upfile));
//   fclose ($fp);
 
//   $contents = strip_tags($contents);
//   $fp = fopen($upfile, 'w');
//   fwrite($fp, $contents);
//   fclose($fp);

//   // show what was uploaded
//   echo 'Preview of uploaded file contents:<br><hr>';
//   echo $contents;
//   echo '<br><hr>';

?>
</body>
</html>
