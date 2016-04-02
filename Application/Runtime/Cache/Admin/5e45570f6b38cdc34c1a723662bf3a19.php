<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="UTF-8">
  <title>代理商列表</title>


  <style>
      .index{
        width: 800px;
        margin:0 auto;
        /*border: 1px solid red;*/
        padding-left: 30px;
      }
      .onlineEquipment{
        width: 500px;
        border: 1px solid #DDDDDD;
      }
      table.onlineEquipment td,table.onlineEquipment th{
        border: 1px solid #DDDDDD;
        height: 30px;
        text-align: center;
      }
      div.index>div{
        margin-top: 50px;
        /*border: 1px solid orange;*/
      }
      div.index ul li a{
        margin-right: 20px;
      }
      div.index ul li:nth-child(5) span{
        margin-left: 50px;
        line-height: 35px;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 5px;
      }
      div.index div.myLine1,div.index div.myLine2{
        margin-top: 20px;
      }
      .conter  {
          height:80px;
          border:1px solid #000;
          background:#E8E8E8;
          margin:0px auto;
          padding:0px;
          }
    </style>
    
</head>
<body>

<div class="example">
    <div class="container">
    <!-- 
    <div class="row" style="float:left; border:1px solid red">
    
    	<div class="col-sm-3 col-md-3 col-lg-3">
    	 <label style="width:80px">查询内容： </label>
    	</div>
    	
    	<div class="col-sm-8 col-md-8 col-lg-8">
	    	 <select class="form-control" name="key" >
	  			    	<option value="Num">代理商ID</option>
	  			    	<option value="Name">代理商名称</option>
	  		 </select>
  		 </div>
    
    </div>
    
    
      <div class="row" style="float:left; border:1px solid blue; margin:10px">
        <div class="col-sm-2 col-md-2 col-lg-2">
          <label style="width:80px" >关键字： </label>
        </div>
        <div class="col-sm-5 col-md-5 col-lg-5">
          <input id="agentKeyword" class="form-control" type="text"  placeholder="搜索代理商ID或者名称"/>
        </div>
        <div class="col-sm-1 col-md-1 col-lg-1">
          <input type="button" class="btn btn-toolbar else" value="搜索" onclick="searchAgent()"/>
        </div>
       
      </div>
      
     <div style="clear: both"></div>
       -->
         <form id='searchAgent'> 
       <div class="input-group">
       	
            <span class="input-group-addon">查询内容：</span>
            <select class="form-control" name="key">
              <option value="Num">代理商ID</option>
              <option value="Name">代理商名称</option>
            </select>
            <span class="input-group-addon fix-border fix-padding"></span>
            
            <span class="input-group-addon">查询关键字：</span>
            <span class="input-group-addon fix-border fix-padding"></span>
            
            <input type="text" class="form-control" placeholder="填写关键字" name="agentKeyword">
            <input type="hidden" class="form-control" name="ajax" value="1">
            <span class="input-group-btn">
              <button type="button" class="btn btn-default" onclick="searchAgent()" >搜索</button>
            </span>
     
        </div>
       </form>
    </div>
<br/>
    <table id="agents" class="table table-bordered basic">
      <thead>
      <tr>
        <th>代理商ID</th>
        <th>代理商名称</th>
        <th>商户拥有数</th>
        <th>设备拥有数</th>
        <th>设备在线数</th>
        <th>设备操作</th>
        <th>进入代理商账户</th>
        <th>备注</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="javascript:">进入</a></td>
        <td></td>
      </tr>
     
      </tbody>
    </table>
    
   <div>
	<ul  id='AgentsPaginator' class="pagination-sm"></ul>
</div> 
  </div>




<script>
	function enterAgentAccount(agentId){
		var url="../Admin/showAgentIndex?proxyId="+agentId
		window.open(url);
	}

	ThinkAjax.send("<?php echo U('Admin/getAgentsInfo');?>",'ajax=1&PageSize=10&PageNum=1',genPaginator,'');
	
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
	            },onPageClicked: function (event, originalEvent, type, page) { //异步换页

	            	ThinkAjax.send("<?php echo U('Admin/getAgentsInfo');?>",'ajax=1&PageSize=10&PageNum='+page,completeAgentInfo,'');
	            },
		    };

			var element =  jq('#AgentsPaginator');
			element.bootstrapPaginator(options);
			completeAgentInfo(data,status);	
	}
	
	function completeAgentInfo(data,status){
		
	     var bodyContent = data['agentsList'];
		 var table = document.getElementById("agents");
		 var newtbodies="";
		var tbodies= table.getElementsByTagName("tbody");
		for(var i=0;i<bodyContent.length;i++){
			newtbodies += "<tr><td>"+bodyContent[i]['agentId']+"</td><td>"+bodyContent[i]['agentName']+"</td><td>"+bodyContent[i]['MerchantNum']+"</td><td>"+bodyContent[i]['routerNum']+"</td><td>"+bodyContent[i]['onlineRouterNum']+"</td>";
			newtbodies += "<td><a href=\"javascript:\" onclick=\"addRoute('"+bodyContent[i]['BId']+"')\">添加</a>&nbsp;&nbsp;<a href=\"javascript:\" onclick=\"deleteRoute('"+bodyContent[i]['BId']+"')\">删除</a></td>";
			newtbodies +="<td><a href=\"javascript:\" onclick=\"enterAgentAccount('"+bodyContent[i]['BId']+"')\">进入</a></td>";
			newtbodies +="<td>"+bodyContent[i]['note']+"</td>";
			newtbodies += "</tr>";
		}
		tbodies[0].innerHTML=newtbodies;
	}
	
	function addRoute(uid){
		
		var top = document.body.clientHeight / 4;
		var left = document.body.clientWidth / 4; 
		
		window.open("../AgentMessage/addRoute/uid/"+uid, "", "width=700,height=400,top="+top+",left="+left+",resizable=no");
		
	}
	
	function deleteRoute(uid){
		
		var top = document.body.clientHeight / 4;
		var left = document.body.clientWidth / 4; 
		
		window.open("../AgentMessage/deleteRoute/uid/"+uid, "", "width=700,height=400,top="+top+",left="+left+",resizable=no");
		
		
	}
	
	
	function searchAgent(){
		//var agentKeyword = jq('#agentKeyword').val();
		ThinkAjax.sendForm("searchAgent", "<?php echo U('Admin/searchAgentList');?>",genPaginator,'');
	}
</script>
</body>
</html>