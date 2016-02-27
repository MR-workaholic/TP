<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ThinkPHP Ajax 实现示例</title>
<!--  
<script type="text/javascript" src="/TP/Public/AjaxJs/Base.js"></script>
<script type="text/javascript" src="/TP/Public/AjaxJs/prototype.js"></script>
<script type="text/javascript" src="/TP/Public/AjaxJs/mootools.js"></script>
<script type="text/javascript" src="/TP/Public/AjaxJs/Ajax/ThinkAjax.js"></script>
<script type="text/javascript" src="/TP/Public/AjaxJs/Form/CheckForm.js"></script>
-->

<script src="/TP/Public/AjaxJs/Base.js"></script>
<script src="/TP/Public/AjaxJs/prototype.js"></script>
<script src="/TP/Public/AjaxJs/mootools.js"></script>
<script src="/TP/Public/AjaxJs/Ajax/ThinkAjax.js"></script>
<script src="/TP/Public/AjaxJs/Form/CheckForm.js"></script>


<script language="JavaScript">

	function check()
	{
		
		ThinkAjax.sendForm('form1',"<?php echo U('Test/ajaxhandle');?>",complete,'txt');
	}
	
	function complete(data,status)
	{
		if(status==1)
			{
			// 提示信息
			$('txtHint').innerHTML = data['a']+'hello '+data['c'];
			}
		else
			{
			$('txtHint').innerHTML = 'wrong';
			}
			
	}
	
</script>

</head>
<body>

   <h3>请在下面的输入框中键入字母（A - Z）：</h3>
   
	<form  id="form1" method="post"> 
	姓氏：
	<input type="text" id="txt1" name="latter"/>
	<input type="hidden" name="ajax" value="1">
	<input type="button" onClick="check()" value="提 交" />
	</form>
	
	<p>建议：<span id="txtHint"></span></p> 
	<p>提示：<span id="txt"></span></p> 
	
	<script language="JavaScript">

	
	ThinkAjax.send("<?php echo U('Test/ajaxcalling');?>",'ajax=1&calling='+'y',complete2,'txt');
	
	
	
	function complete2(data,status)
	{
		if(status==1)
			{
			// 提示信息
			$('txtHint').innerHTML = data['dinfo'];
			$('txt1').value = data['ddata'];
			}
		else
			{
			$('txtHint').innerHTML = 'wrong';
			}
			
	}
	
	function complete3()
	{
		
			$('txtHint').innerHTML = 'hello girl';  //不执行
		
	}
	
</script>


</body>
</html>