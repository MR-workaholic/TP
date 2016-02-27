<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    
    <style>
      .wireSecurity,.wireSecuritySet{
        width: 300px;
        margin: 30px auto;
        /*border: 1px solid red;*/
      }
      .wireSecuritySet{
        list-style-type: none;
      }
      ul.wireSecuritySet li{
        margin: 10px auto;
      }
      div.wireSecurity{
        text-align: right;
      }
      div.wireSecurity input{
        margin-left: 10px;
        margin-right: 10px;
      }
    </style>
    
    <script type="text/javascript" src="/TP/Public/AjaxJs/Base.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/prototype.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/mootools.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/Ajax/ThinkAjax.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/Form/CheckForm.js"></script>
    
  <script language="JavaScript">

	function updateSSIDset()
	{
		
		ThinkAjax.sendForm('formSSIDset',"<?php echo U('Routeset/SSIDmeschange');?>",ssidinfoshow,'');
	}
	
	function ssidinfoshow(data,status)
	{
		if(status==1)
		{
		 // 提示信息
		 //$('txtHint').innerHTML = data['a']+'hello '+data['c'];
		 $('dssid').value = data['dssid'];
		 $('devpassword').value = data['devpassword'];
		 displaySelect(data['smodel'],'smodel');
	
		}
		
	
	}
	
</script>

</head>
<body>
<p class="wireSecurity">无线安全设置</p>

<form method="post" id="formSSIDset">

<ul class="wireSecuritySet">
  <li>名称：
  	<input type="text" name="dssid" id='dssid' value=''/>
  	<input type="hidden" name='did' value=<?php echo ($did); ?>/>
  </li>
  
  <li>加密：
  <select name="smodel" id="smodel">
    <option value="0">不加密</option>
    <option value="1">弱加密</option>
    <option value="2">强加密</option>
    
   </select>
  </li>
  
  <li>密码：<input type="password" name="devpassword" id='devpassword' value=''/></li>
</ul>
</form>

<div class="wireSecurity">

  <input type="button" onClick="updateSSIDset()" value="确 定"/>
  <input type="button" value="取 消"/>

</div>

<script type="text/javascript">

 // console.log('<?php echo ($smodel); ?>');
  //displaySelect('<?php echo ($smodel); ?>','smodel');
  
  ThinkAjax.send("<?php echo U('Routeset/SSIDmescalling');?>",'ajax=1&calling='+'<?php echo ($did); ?>',completeSSIDmescalling,'');
	
	function completeSSIDmescalling(data,status)
	{
		if(status==1)
		{
		 // 提示信息
		 //$('txtHint').innerHTML = data['a']+'hello '+data['c'];
			 $('dssid').value = data['dssid'];
			 $('devpassword').value = data['devpassword'];
			 displaySelect(data['smodel'],'smodel');
		 
		}
	}
  
  function displaySelect(optionValue,id){
		
		var all_options = document.getElementById(id).options;
		
		for (i=0; i<all_options.length; i++){
			
			if (all_options[i].value == optionValue) // 根据option标签的ID来进行判断 测试的代码这里是两个等号
				{
					all_options[i].selected = true;
				}
			}
	};

</script>


</body>
</html>