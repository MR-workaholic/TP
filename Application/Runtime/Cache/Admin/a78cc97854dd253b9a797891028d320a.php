<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>路由设备变更广告</title>
    
    
  <script src="/Project001/TP/Public/dist/js/jquery-1.11.0.min.js"></script>
  <script src="/Project001/TP/Public/dist/js/chart.min.js"></script>
  <script src="/Project001/TP/Public/dist/js/image-file-visible.js"></script>
  <script src="/Project001/TP/Public/dist/js/ajaxfileupload.js"></script>
  <script src="/Project001/TP/Public/dist/js/jquery.minicolors.js"></script>
  <script src="/Project001/TP/Public/dist/js/bootstrap-paginator.js" type="text/javascript"></script>



  <link href="/Project001/TP/Public/dist/css/zui.min.css" rel="stylesheet">
  <link href="/Project001/TP/Public/dist/css/zui-theme.css" rel="stylesheet">
  <link href="/Project001/TP/Public/merchant/css/merchantIndex.css" rel="stylesheet" type="text/css">
  <link href="/Project001/TP/Public/dist/css/jquery.minicolors.css" rel="stylesheet" type="text/css">
  

    <link rel="stylesheet" href="/Project001/TP/Public/dist/css/qunit-1.11.0.css">
    <link rel="stylesheet" href="/Project001/TP/Public/dist/css/bootstrapv3.css">




  
	<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/Base.js"></script>
	<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/prototype.js"></script>
	<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/mootools.js"></script>
	<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/Ajax/ThinkAjax.js"></script>
	<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/Form/CheckForm.js"></script>
    

</head>
<body>
<div class="main">
	<h3>为设备选择广告</h3>
	<div>
	<form id = "addRoute">
		<table id="routeListforAdd" class="table table-bordered basic">
	      <thead>
	      <tr>
	        <th>广告名称</th>
	        <th>广告模板</th>
	        <th>预览</th>
	        <th>选择</th>
	      </tr>
	      </thead>
	      <tbody>
	      
	      </tbody>
	    </table>
	    <input type="hidden" name="ajax" value="1">
	    <input type="hidden" name="mac" value='<?php echo ($mac); ?>'>
    </form>
    
    <div style="float:left">
  		<ul  id='paginator-test' class="pagination-sm"></ul>
   	</div> 
   	
   	<div class="container" style="float:right">
	  <div class="input-group">
	   
	      <button class="btn" type="button" onClick="doJob()">确定</button>

	  </div>
	</div>
	
	<div style="clear: both"></div>

</div>

</div>

<script type="text/javascript">

	var jq = jQuery.noConflict();
	

	
	ThinkAjax.send("<?php echo U('AgentMessage/showMyAD');?>",　"ajax=1", completeshowMyAD, '');
	
	function completeshowMyAD(data, status)
	{
		
		var ADList = data;
		var table = document.getElementById("routeListforAdd");
		var newtbodies = "";
		var tbodies = table.getElementsByTagName("tbody");
		
		
		
		for(var i = 0; i < ADList.length; i++)
		{
			newtbodies += "<tr><td>"+ADList[i]['adname']+"</td><td>"+ADList[i]['admodel']+"</td>";
			newtbodies += "<td><a href=\""+ADList[i]['adurl']+"\" target=\"_Blank\">预览</a></td>";
			newtbodies += "<td><input type=\"radio\"  name=\"ADradio\"  value='"+ADList[i]['aid']+"'></td>";
			newtbodies += "</tr>";
			
		}
		
		
		tbodies[0].innerHTML = newtbodies;
		
		
	}

		
	
	
	

	
	function doJob()
	{
		var aid = jq('input[name=ADradio]:checked').val();
		ThinkAjax.send("<?php echo U('AgentMessage/changeAD4dev');?>", "ajax=1&aid="+aid+"&mac=<?php echo ($mac); ?>", completeChangeAD4dev, '');
	}

	
	function completeChangeAD4dev(data, status)
	{
		if(status == 0)
			{
				alert("请选择广告");
			}else{
				window.opener = null; 
				window.open('', '_self'); 
				window.close() 
			}
		
	}
</script>


</body>
</html>