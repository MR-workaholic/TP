<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
  <title>Administration - upload new files</title>
  <style type="text/css">
    
    input{
	   margin:5px;
    }

  </style>
</head>

<body>
<h1>Upload new news files</h1>
         <!-- multipart/form-data֪ͨ�������Ǵ��б�����ʽ��   1000000��1MB -->
	<form enctype="multipart/form-data" action="upload.php" method=post>
  		<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
  		<label for="userfile">Upload a txt or jpeg file:</label>
  		<br/>
 		<input type="file" name="userfile0" id="userfile">
 		<br/>
 		<input type="file" name="userfile1" id="userfile">
 		<br/>
 		<input type="file" name="userfile2" id="userfile">
 		<br/>
 		<input type="submit" value="Send File">
	</form>
</body>

</html>