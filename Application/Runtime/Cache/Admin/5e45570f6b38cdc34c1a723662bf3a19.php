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
            
            <input type="text" class="form-control" placeholder="填写查询字段" name="agentKeyword">
            <input type="hidden" class="form-control" name="ajax" value="1">
            <input type="hidden" class="form-control" name="PageSize" id="PageSize" value="">
            <input type="hidden" class="form-control" name="PageNum" value="1" id="PageNum">
            
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
     
     
      </tbody>
    </table>
    
   <div>
	<ul  id='AgentsPaginator' class="pagination-sm"></ul>
</div> 
  </div>
  





<script>

	var mPageSize = parseInt(document.body.clientHeight / 100);
	alert(mPageSize);
	$('PageSize').value = mPageSize;
	
	

	

	function enterAgentAccount(agentId){
		var url="../Admin/showAgentIndex?proxyId="+agentId
		window.open(url);
	}

	ThinkAjax.send("<?php echo U('Admin/getAgentsInfo');?>",'ajax=1&PageSize='+mPageSize+'&PageNum=1',genPaginator,'');
	
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
	            		ThinkAjax.send("<?php echo U('Admin/getAgentsInfo');?>",'ajax=1&PageSize='+mPageSize+'&PageNum='+page,completeAgentInfo,'');
            		}else
            			{
            				$('PageNum').value = page;
            				ThinkAjax.sendForm("searchAgent", "<?php echo U('Admin/searchAgentList');?>",completeAgentInfo,'');
            				
            			}
	            	
	            	

	            	
	            },
		    };

			var element =  jq('#AgentsPaginator');
			element.bootstrapPaginator(options);
			completeAgentInfo(data,status);	
	}
	
	function completeAgentInfo(data,status){
		
		if(status == 0)
			{
				 
				 var table = document.getElementById("agents");
				 var newtbodies = "";
				 var tbodies = table.getElementsByTagName("tbody");
				 newtbodies += "<h4>没有任何代理商</h4>";
				 tbodies[0].innerHTML=newtbodies;
			
			}else{
				
				 var bodyContent = data['agentsList'];
				 var table = document.getElementById("agents");
				 var newtbodies="";
				 var tbodies= table.getElementsByTagName("tbody");
				 for(var i=0;i<bodyContent.length;i++){
					newtbodies += "<tr><td>"+bodyContent[i]['agentId']+"</td><td>"+bodyContent[i]['agentName']+"</td><td>"+bodyContent[i]['MerchantNum']+"</td><td>"+bodyContent[i]['routerNum']+"</td><td>"+bodyContent[i]['onlineRouterNum']+"</td>";
					newtbodies += "<td><a href=\"javascript:\" onclick=\"addRoute('"+bodyContent[i]['BId']+"')\">添加</a>&nbsp;&nbsp;<a href=\"javascript:\" onclick=\"deleteRoute('"+bodyContent[i]['BId']+"')\">删除</a></td>";
					newtbodies += "<td><a href=\"javascript:\" onclick=\"enterAgentAccount('"+bodyContent[i]['Num']+"')\">进入</a></td>";
					newtbodies += "<td>"+bodyContent[i]['note']+"</td>";
					newtbodies += "</tr>";
				 }
				 tbodies[0].innerHTML=newtbodies;
				
			}
		
	     
	}
	
	var open_q=false, win_q, t_q;
	
	function addRoute(uid){
		
		var top = document.body.clientHeight / 4;
		var left = document.body.clientWidth / 4; 
		
		win_q = window.open("../AgentMessage/addRoute/uid/"+uid, "", "width=700,height=400,top="+top+",left="+left+",resizable=no");
		
		//关闭窗口后更新页面
		open_q = true;
		
		 t_q = setInterval(function()
			        //单击之后就开始计时
			        {
			            if(open_q)
			            // 如果新窗口打开为真
			            {
			                if(win_q && win_q.closed)
			                // 如果这个新窗口存在并且已经被关闭
			                {
			                    open_q=false;
			                    t_q=null;
			                    clearInterval(t_q);
			                    ThinkAjax.send("<?php echo U('Admin/getAgentsInfo');?>",'ajax=1&PageSize=10&PageNum=1',genPaginator,'');
			                }
			            }
			        },200);
		
		
		/*
		jq("#handlerouter").load("../AgentMessage/addRoute/uid/"+uid,function(a,status,c){
	        console.log(status);
	        if(status=="error"){
	          jq("#handlerouter").text("判断加载失败");
	        }
	      });
		
		jq(".newview").show();*/
		
	}
	
	function deleteRoute(uid){
		
		var top = document.body.clientHeight / 4;
		var left = document.body.clientWidth / 4; 
		
		win_q = window.open("../AgentMessage/deleteRoute/uid/"+uid, "", "width=700,height=400,top="+top+",left="+left+",resizable=no");
		
		//关闭窗口后更新页面
		open_q = true;
		
		 t_q = setInterval(function()
			        //单击之后就开始计时
			        {
			            if(open_q)
			            // 如果新窗口打开为真
			            {
			                if(win_q && win_q.closed)
			                // 如果这个新窗口存在并且已经被关闭
			                {
			                    open_q=false;
			                    t_q=null;
			                    clearInterval(t_q);
			                    ThinkAjax.send("<?php echo U('Admin/getAgentsInfo');?>",'ajax=1&PageSize=10&PageNum=1',genPaginator,'');
			                }
			            }
			        },200);
		 
		/*
		jq("#handlerouter").load("../AgentMessage/deleteRoute/uid/"+uid,function(a,status,c){
	        console.log(status);
	        if(status=="error"){
	          jq("#handlerouter").text("判断加载失败");
	        }
	      });
		
		jq(".newview").show();*/
		
	}
	
	
	function searchAgent(){
		//var agentKeyword = jq('#agentKeyword').val();
		ThinkAjax.sendForm("searchAgent", "<?php echo U('Admin/searchAgentList');?>",genPaginator,'');
	}
</script>
</body>
</html>