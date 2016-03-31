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



    <!--<div class="panel conter">
      <div class="panel-body">
      <div  class="container">
        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4">
              <button class="btn btn-lg" type="button">代理商列表</button>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
              <button class="btn btn-lg" type="button">设备列表</button>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
              <button class="btn btn-lg" type="button">统计数据</button>
            </div>
        </div>
        </div>
      </div>
    </div>-->
<div class="example">
    <div class="container">
      <div class="row">
        <div class="col-sm-1 col-md-1 col-lg-1">
          <label class="control-label">关键字： </label>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3">
          <input id="agentKeyword" class="form-control" type="text"  placeholder="搜索代理商ID或者名称"/>
        </div>
        <div class="col-sm-1 col-md-1 col-lg-1">
          <input type="button" class="btn btn-toolbar else" value="搜索" onclick="searchAgent()"/>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6"></div>
      </div>
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
        <th>进入代理商账户</th>
        <th>备注</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>001</td>
        <td>有缘代理</td>
        <td>30</td>
        <td></td>
        <td></td>
        <td><a href="javascript:">进入</a></td>
        <td></td>
      </tr>
      <tr>
      <tr>
        <td>001</td>
        <td>有缘代理</td>
        <td>30</td>
        <td></td>
        <td></td>
        <td><a href="javascript:">进入</a></td>
        <td></td>
      </tr>
      <tr>
      <tr>
        <td>001</td>
        <td>有缘代理</td>
        <td>30</td>
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
			newtbodies +="<td><a href=\"javascript:\" onclick=\"enterAgentAccount('"+bodyContent[i]['BId']+"')\">进入</a></td>";
			newtbodies +="<td>"+bodyContent[i]['note']+"</td>";
			newtbodies += "</tr>";
		}
		tbodies[0].innerHTML=newtbodies;
	}
	
	
	function searchAgent(){
		var agentKeyword = jq('#agentKeyword').val();
		ThinkAjax.send("<?php echo U('Admin/searchAgentList');?>",'ajax=1&agentKeyword='+agentKeyword,completeAgentInfo,'');
	}
</script>
</body>
</html>