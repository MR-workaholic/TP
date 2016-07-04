<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>为设备应用此营销广告</title>

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
	
	<style type="text/css">

		*{ 
			scrollbar-3dlight-color:#D4D0C8; /*- 最外左 -*/ 
			scrollbar-highlight-color:#fff; /*- 左二 -*/ 
			scrollbar-face-color:#E4E4E4; /*- 面子 -*/ 
			scrollbar-arrow-color:#666; /*- 箭头 -*/ 
			scrollbar-shadow-color:#808080; /*- 右二 -*/ 
			scrollbar-darkshadow-color:#D7DCE0; /*- 右一 -*/ 
			scrollbar-base-color:#D7DCE0; /*- 基色 -*/ 
			scrollbar-track-color:#;/*- 滑道 -*/ 
			} 
	</style>
	
</head>
<body style="overflow-x:hidden;overflow-y:scroll">

<h3>正使用主题<strong>【<?php echo ($adname); ?>】</strong>的路由器</h3>
  <form id = "deleteADMac">
	<table id="routeListforRouteHave" class="table table-bordered basic">
	      <thead>
	      <tr>
	        <th>路由器名称</th>
	        <th>路由器型号</th>
	        <th>路由器MAC地址</th>
	        <th>删除路由应用该主题</th>
	      </tr>
	      </thead>
	      <tbody>
	      
	      </tbody>
	</table>
	<input type="hidden" name="ajax" value="1">
  </form>
	
	<div class="container" style="float:right">
	  <div class="input-group">
	   
	      <button class="btn" type="button" onClick="doJob2()">确定删除</button>

	  </div>
	</div>
	
	<br/>
	<br/>
	
<h3>正使用其他主题的路由器</h3>

  <form id = "handleADMac">
	<table id="routeListforRouteNotHave" class="table table-bordered basic">
	      <thead>
	      <tr>
	        <th>路由器名称</th>
	        <th>路由器MAC地址</th>
	        <th>正在使用的主题</th>
	        <th>选择路由应用该主题</th>
	      </tr>
	      </thead>
	      <tbody>
	      
	      </tbody>
	</table>
	<input type="hidden" name="ajax" value="1">
	<input type="hidden" name="aid"  value='<?php echo ($aid); ?>'>
  </form>
  
	<div class="container" style="float:right">
	  <div class="input-group">
	   
	      <button class="btn" type="button" onClick="doJob()">确定使用</button>

	  </div>
	</div>
	
	
	
	<script>
		var jq = jQuery.noConflict();
		var aid = <?php echo ($aid); ?>;
		
		ThinkAjax.send("<?php echo U('Adset/showHandleADMac');?>",　"ajax=1&aid="+aid, completeShowHandleADMac, '');
		
		
		
		function completeShowHandleADMac(data, status)
		{
			var table = document.getElementById("routeListforRouteHave");
			var newtbodies = "";
			var tbodies = table.getElementsByTagName("tbody");
			
			if(data['haveflag'] == 1)
				{
					
					for(var i = 0; i < data['have'].length; i++)
					{
						newtbodies += "<tr><td>"+data['have'][i]['RouterName']+"</td><td>"+data['have'][i]['RouterModel']+"</td><td>"+data['have'][i]['mac']+"</td>";	
						newtbodies += "<td><input type=\"checkbox\" name=\"deleteMac[]\" value='"+data['have'][i]['mac']+"'></td></tr>"
					}
					
					
					tbodies[0].innerHTML = newtbodies;
					
				}
			
			table = document.getElementById("routeListforRouteNotHave");
			newtbodies = "";
			tbodies = table.getElementsByTagName("tbody");
			
			if(data['nothaveflag'] == 1)
				{
					for(var i = 0; i < data['nothave'].length; i++)
					{
						newtbodies += "<tr><td>"+data['nothave'][i]['RouterName']+"</td><td>"+data['nothave'][i]['Mac']+"</td><td>"+data['nothave'][i]['adname']+"</td>";
						newtbodies += "<td><input type=\"checkbox\" name=\"chooseMac[]\" value='"+data['nothave'][i]['Mac']+"'></td></tr>"
					}
					
					
					tbodies[0].innerHTML = newtbodies;
					
				}
			
		}
		
		function doJob()
		{
			/*
			var chk_value =[]; 
			
			jq('input[name="chooseMac"]:checked').each(function(){ 
				chk_value.push(jq(this).val()); 
			});
			
			if(chk_value.length==0)
				{
					alert('你还没有选择任何路由器！');
				}
			*/
			
			ThinkAjax.sendForm("handleADMac", "<?php echo U('Adset/handleADandMac');?>", completehandleADandMac, '');
			
			
		}
		
		function completehandleADandMac(data, status){
			
			if(status == 1){
				
				window.opener = null; 
				window.open('', '_self'); 
				window.close() 
				
			}else{
				alert("请选择路由器");
			}
			
		}
		
		function doJob2()
		{
			ThinkAjax.sendForm("deleteADMac", "<?php echo U('Adset/deleteADandMac');?>", completehandleADandMac, '');
		}
	
	</script>



</body>
</html>