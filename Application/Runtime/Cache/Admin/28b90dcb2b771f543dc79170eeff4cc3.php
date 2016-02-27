<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
  <title>Administration - upload new files</title>
  
  <style type="text/css">
    
    input{
	   margin:5px;
    }

  </style>
  
  	<script type="text/javascript" src="/TP/Public/AjaxJs/Base.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/prototype.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/mootools.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/Ajax/ThinkAjax.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/Form/CheckForm.js"></script>
  
  <script type="text/javascript">
  
    function test()
    {
    	ThinkAjax.sendForm('testid',"<?php echo U('Adset/upload_model1');?>", completetest, '');
    	
    }
    
    function test2()
    {
    	ThinkAjax.send("<?php echo U('Adset/upload_model');?>", 'ajax=1',completetest, '');
    }
    
    function completetest(data, status)
    {
    	
    }
  
  </script>
  
</head>

<body>
<h1>Upload new news files</h1>
         <!-- multipart/form-data通知服务器是带有表单格式的   1000000是1MB -->
         <!-- 
	<form enctype="multipart/form-data" action="<?php echo U('Adset/upload_model1');?>" method=post>
	
  		<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
  		<label for="userfile">Upload a txt or jpeg file:</label>
  		<br/>
 		<input type="file" name="userfile0" id="userfile">
 		<br/>
 		<input type="file" name="userfile1" id="userfile">
 		<br/>
 		<input type="file" name="userfile2" id="userfile">
 		<br/>
 		 
 		<input type="hidden" name='a' value=<?php echo ($a); ?> >
 		<input type="submit" value="Send File">
	</form>
	-->
	<form  id='testid' method="post" action="<?php echo U('Adset/upload_model2');?>">
	
		<input type="hidden" name='s' value="upload_model2" id="s">
		<input type="text" name='o' value="hello" id="o">
		<input type="text" name='b' value="hello1" id="b">
		<input type="text" name='c' value="hello2" id="c">
		<input type="hidden" name="ajax" value="1">
 		
	
	
	
	<input type="button" value="Send File" onClick="test()">
	<input type="button" value="test" onClick="test2()">
	<input type="submit" value="test1" >
	
	</form>
	
	<h1><?php echo ($a); ?></h1>
	<h1>hello man</h1>
	
	
	
</body>

</html>