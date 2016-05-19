<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>路由列表</title>

  <!-- jQuery (ZUI中的Javascript组件依赖于jQuery) -->

  <!-- ZUI  Javascript组件 -->
  <!--<script src="../../dist/js/zui.min.js"></script>-->
  <style>
 div.example{
      width:1000px;
      margin: 0 auto;
      /*border: 1px solid blue;*/
    }
    div.example h3{
      margin: 30px auto;
      /*border: 1px solid red;*/
    }
    div.example h3 span{
      margin-left:30px;
      /*border: 1px solid blueviolet;*/
    }
    div.example h3 span input{
      margin: 0 10px 0 10px;
    }
    div.example thead tr th{
      text-align: center;
    }
    div.example table.table.table-bordered{
      max-width: 1200px;
      min-width: 800px;
      margin: 0px auto;
      text-align: center;
    }

  </style>
  <script>
//构造分页器


	var isSearch = 0;
		
	function genPaginator(data,status){
		
		isSearch = data['isSearch'];
		
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
	            },onPageClicked: function (event, originalEvent, type, page) { //异步换页
	            	
	            	if(isSearch == 0)
	            		{
	            			ThinkAjax.send("<?php echo U('Admin/getRouterList');?>",'ajax=1&PageSize='+mPageSize+'&PageNum='+page,completeRouterList,'');
	            		}else
	            			{
	            				$('PageNum').value = page;
	            				ThinkAjax.sendForm('searchRouter', "<?php echo U('Admin/searchRouterList');?>", completeRouterList, '');
	            			}
	            	
	            },
		    };
			var element =  jq('#paginator-test');
			element.bootstrapPaginator(options);
			
			completeRouterList(data,status);
}
	//把列表信息填充到table中
	function completeRouterList(data, status){
		
		if(status == 0){
			
			var table = document.getElementById("routers");
			var newtbodies = "";
			var tbodies = table.getElementsByTagName("tbody");
			newtbodies += "<h4>没有任何路由设备</h4>";
			tbodies[0].innerHTML = newtbodies;
			
		}else{
			
			routerList = data['routerMsg'];
			var table = document.getElementById("routers");
			var newtbodies = "";
			var tbodies = table.getElementsByTagName("tbody");
			for(var i=0;i<routerList.length;i++){
				newtbodies += "<tr><td>"+routerList[i]['SN']+"</td><td>"+routerList[i]['RouterModel']+"</td><td>"+routerList[i]['State']+"</td><td>"+routerList[i]['Mac']+"</td><td>"+routerList[i]['BusinessName']+"</td>";
				newtbodies += "<td>"+routerList[i]['AgentName']+"</td><td>"+routerList[i]['FirmwareVer']+"</td><td>"+""+"</td>";
				newtbodies += "<td><a href=\"javascript:\" onclick=\"getRouterDetail('"+routerList[i]['RouterId']+"')\">查看</a></td>";
				newtbodies += "<td><a href=\"javascript:\" onclick=\"upgradeConfirm()\">升级</a>&nbsp;&nbsp;<a href=\"javascript:\" onclick=\"deleteConfirm('"+routerList[i]['RouterId']+"','"+i+"')\">删除</a></td>";
				newtbodies += "</tr>";
			}
			tbodies[0].innerHTML=newtbodies;
			
		}
		
		
	}
	
	
	//路由升级确认
 	function upgradeConfirm(){
		//jq('#upgrateConfirm').modal('show');
		if(confirm("你确定把路由器升级到最新版本吗？")){
			
		}
	} 
 	//路由删除确认
	function deleteConfirm(routerId,rowId){
		if(confirm("你确定删除该路由器吗？")){
			ThinkAjax.send("<?php echo U('AgentMessage/deleteRouter');?>",'ajax=1&routerId='+routerId+'&rowId='+rowId,completeDelRouter,'');
		}
	}
	//查看路由的详细信息
	function getRouterDetail(routerId)
	{
		 var top = document.body.clientHeight / 4;
		 var left = document.body.clientWidth / 8; 
		 window.open("../AgentMessage/showDeviceDetail/routerId/"+routerId, "", "width=1000,height=200,top="+top+",left="+left+",resizable=no");
	} 
	
	function completeDelRouter(data,status){
		if(status ==1){
			jq('#routers tbody tr:eq('+data['rowId']+')').remove();
		}else if(status ==0){
			alert("删除设备操作失败！");
		}
	}
  </script>
</head>
<body>

<div class="example">
    <h3>您的设备列表</h3>
    
      <form id='searchRouter'> 
       <div class="input-group">
       	
            <span class="input-group-addon">查询内容：</span>
            <select class="form-control" name="key">
              <option value="SN">SN号</option>
              <option value="RouterModel">设备型号</option>
              <option value="State">在线状态</option>
              <option value="Mac">路由MAC</option>
              <option value="BusinessName">商家名</option>
              <option value="AgentName">代理商名</option>
            </select>
            <span class="input-group-addon fix-border fix-padding"></span>
            
            <span class="input-group-addon">查询关键字：</span>
            <span class="input-group-addon fix-border fix-padding"></span>
            
            <input type="text" class="form-control" placeholder="填写查询字段" name="routerKeyword">
            <input type="hidden" class="form-control" name="ajax" value="1">
            <input type="hidden" class="form-control" name="PageSize" value="" id="PageSize">
            <input type="hidden" class="form-control" name="PageNum" value="1" id="PageNum">
            <span class="input-group-btn">
              <button type="button" class="btn btn-default" onclick="searchRouter()" >搜索</button>
            </span>
     
        </div>
       </form>
       
        <br/>
       
    <table id="routers" class="table table-bordered">
      <thead>
      <tr>
        <th>SN号</th>
        <th>设备型号</th>
        <th>在线状态</th>
        <th>路由MAC</th>
        <th>所属商家</th>
        <th>所属代理商</th>
        <th>当前版本</th>
        <th>最新版本</th>
        <th>详细信息</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody>
     
      
      </tbody>
    </table>
  <div>
  <ul  id='paginator-test' class="pagination-sm"></ul>
  </div>   

<div>
  	  	<input type="hidden" name="agentId" value="">
</div>
</div>
<!--<script src="../../dist/js/jquery-1.11.0.min.js"></script>-->


<script  language="JavaScript">

	var mPageSize = parseInt(document.body.clientHeight / 100);
	alert(mPageSize);
	$('PageSize').value = mPageSize;
      
	//开始构造分页插件
	ThinkAjax.send("<?php echo U('Admin/getRouterList');?>",'ajax=1&PageSize='+mPageSize+'&PageNum=1',genPaginator,'');
	
	
	function searchRouter()
	{
		ThinkAjax.sendForm('searchRouter', "<?php echo U('Admin/searchRouterList');?>", genPaginator, '');
	}


</script>
</body>
</html>