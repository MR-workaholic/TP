<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>为用户添加路由</title>
    
    
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
    
  <script language="JavaScript">   
  
//构造分页器
	function genPaginator(data,status){
	
		var options = {
		        size:"small",
		        bootstrapMajorVersion:3,
		        currentPage: 1,
		        numberOfPages: 10,
		        totalPages:data['totalPage'],
		        itemTexts: function(type, page, current) { //修改显示文字
	                switch (type) {
	                case "first":
	                    return "第一页";
	                case "prev":
	                    return "上一页";
	                case "next":
	                    return "下一页";
	                case "last":
	                    return "最后一页";
	                case "page":
	                    return page;
	                }
	            },
	            onPageClicked: function (event, originalEvent, type, page) { //异步换页
	           // ThinkAjax.send("<?php echo U('AgentMessage/showRouteListforAddRoute');?>",'ajax=1&PageSize=6&PageNum='+page, completeRouteListforAdd, '');
	            	if(action == 'ADD')
	        		{
	        			ThinkAjax.send("<?php echo U('AgentMessage/showRouteListforAddRoute');?>",　'ajax=1&PageSize=6&PageNum='+page, genPaginator, '');
	        		}else
	        			{
	        				ThinkAjax.send("<?php echo U('AgentMessage/showRouteListforDelRoute');?>",　"ajax=1&PageNum="+page+"&PageSize=6&businessId="+'<?php echo ($businessId); ?>', genPaginator, '');
	        			}
	            	
	            },
		    };
		
			var element =  jq('#paginator-test');
			element.bootstrapPaginator(options);
			
			//ThinkAjax.send("<?php echo U('AgentMessage/getrMerchantList');?>",'ajax=1&PageNum=0&PageSize=3',completeMerchantList,'');
		
			completeRouteListforAdd(data, status);
		}
		
		function completeRouteListforAdd(data, status)
		{
			
			routerList = data['routerList'];
			var table = document.getElementById("routeListforAdd");
			var newtbodies = "";
			var tbodies = table.getElementsByTagName("tbody");
			
			
			
			for(var i = 0; i < routerList.length; i++)
			{
				newtbodies += "<tr><td>"+routerList[i]['Mac']+"</td>";
				newtbodies += "<td><input type=\"checkbox\"  id='cb_"+routerList[i]['RouterId']+"'  onclick=\"checkboxChanged('"+routerList[i]['RouterId']+"')\"   value='"+routerList[i]['RouterId']+"'></td>";
				newtbodies += "</tr>";
				
			}
			
			
			tbodies[0].innerHTML = newtbodies;
			
			
		}
		
		function checkboxChanged(routerId){
			 
			if(document.getElementById('cb_'+routerId).checked == true){
				checkboxList.push(routerId);

			}else{
			 	for(var i=0;i<checkboxList.length;i++){
					if(checkboxList[i] == routerId){
						checkboxList.splice(i,1);

					}
				} 
			}
			alert(checkboxList); 
		 }

  		
	
	
  </script>

</head>
<body>
<div class="main">
	<h3>为商家选择路由</h3>
	<div>
	<form id = "addRoute">
		<table id="routeListforAdd" class="table table-bordered basic">
	      <thead>
	      <tr>
	        <th>路由器MAC地址</th>
	        <th>选择</th>
	      </tr>
	      </thead>
	      <tbody>
	      
	      </tbody>
	    </table>
	    <input type="hidden" name="ajax" value="1">
	    <input type="hidden" name="businessId" value='<?php echo ($businessId); ?>'>
    </form>
    
    <div style="float:left">
  		<ul  id='paginator-test' class="pagination-sm"></ul>
   	</div> 
   	
   	<div class="container" style="float:right">
	  <div class="input-group">
	   
	      <button class="btn" type="button" onClick="doJob()"><?php echo ($action); ?></button>

	  </div>
	</div>
	
	<div style="clear: both"></div>

</div>

</div>

<script type="text/javascript">

	var jq = jQuery.noConflict();
	
	var checkboxList = new Array();
	
	var action = '<?php echo ($action); ?>';
	
	if(action == 'ADD')
		{
			ThinkAjax.send("<?php echo U('AgentMessage/showRouteListforAddRoute');?>",　"ajax=1&PageNum=1&PageSize=6", genPaginator, '');
		}else
			{
				ThinkAjax.send("<?php echo U('AgentMessage/showRouteListforDelRoute');?>",　"ajax=1&PageNum=1&PageSize=6&businessId="+'<?php echo ($businessId); ?>', genPaginator, '');
			}
	
	function doJob()
	{
		if(action == 'ADD')
			{
				addRoute();
			}else{
				deleteRoute();
			}
	}
	

	
	function addRoute()
	{
		//ThinkAjax.sendForm("addRoute", "<?php echo U('AgentMessage/addRouteforMerchant');?>", completeRouteAction, '');
		ThinkAjax.send("<?php echo U('AgentMessage/addRouteforMerchant');?>", "ajax=1&checkboxList="+checkboxList+"&businessId=<?php echo ($businessId); ?>", completeRouteAction, '');
	}
	
	function deleteRoute()
	{
		//ThinkAjax.sendForm("addRoute", "<?php echo U('AgentMessage/deleteRouteforMerchant');?>", completeRouteAction, '');
		ThinkAjax.send("<?php echo U('AgentMessage/deleteRouteforMerchant');?>", "ajax=1&checkboxList="+checkboxList+"&businessId=<?php echo ($businessId); ?>", completeRouteAction, '');
	}
	
	function completeRouteAction(data, status)
	{
		if(status == 0)
			{
				alert("请选择路由");
			}else{
				window.opener = null; 
				window.open('', '_self'); 
				window.close() 
			}
		
	}
</script>


</body>
</html>