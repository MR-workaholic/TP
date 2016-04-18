<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>商家列表</title>
 
 
  <style>
    div.example{
      width:800px;
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
      max-width: 900px;
      min-width: 800px;
      margin: 0 auto;
      text-align: center;
    }

  </style>
  
  <script>
  
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
	            	
	            	if(data['isSearch'] == 0)
	            		{
	            			ThinkAjax.send("<?php echo U('AgentMessage/getMerchantList');?>",'ajax=1&PageSize=2&PageNum='+page, completeMerchantList, '');
	            		}else{
	            			$('PageNum').value = page;
	            			ThinkAjax.sendForm("searchMerchant", "<?php echo U('AgentMessage/searchMerchantList');?>", completeMerchantList, '');
	            		}
	             },
		    };
		
			var element =  jq('#paginator-test');
			element.bootstrapPaginator(options);
			
			
			completeMerchantList(data, status);
}


	//把列表信息填充到table中
	function completeMerchantList(data,status){
		
		if(status == 0)
			{
				var table = document.getElementById("merchants");
				var newtbodies = "";
				var tbodies= table.getElementsByTagName("tbody");
				
				newtbodies += "<h4>没有任何商家</h4>";
				tbodies[0].innerHTML=newtbodies;
				
			
			}else{
				
				merchantList = data['merchantList'];
				var table = document.getElementById("merchants");
				var newtbodies = "";
				var tbodies= table.getElementsByTagName("tbody");
				
				for(var i = 0; i < merchantList.length; i++){
					newtbodies += "<tr><td>"+merchantList[i]['Name']+"</td><td>"+merchantList[i]['ContactInfo']+"</td><td>"+merchantList[i]['Contact']+"</td><td>"+merchantList[i]['Address']+"</td>";
					
					newtbodies += "<td><a href=\"javascript:\" onclick=\"getMerchantStatistics('"+merchantList[i]['Num']+"')\">查看</a></td>";
					newtbodies += "<td><a href=\"javascript:\" onclick=\"addRoute('"+merchantList[i]['BId']+"')\">添加</a>&nbsp;&nbsp;<a href=\"javascript:\" onclick=\"deleteRoute('"+merchantList[i]['BId']+"')\">删除</a></td>";
					newtbodies += "<td><a href=\"javascript:\" onclick=\"deleteMerchant('"+merchantList[i]['BId']+"','"+i+"')\">删除</a></td>";
					newtbodies += "</tr>";
				}
				tbodies[0].innerHTML=newtbodies;
				
			}
		
		
	}
	
	
	function getMerchantStatistics(uid){
		
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
	
	//删除用户
	function deleteMerchant(Bid, Row){
		
		if(confirm("你确定删除该用户吗？")){
			ThinkAjax.send("<?php echo U('AgentMessage/deleteMerchant');?>",'ajax=1&BId='+Bid+'&rowId='+Row,completeDelMerchant,'');
		}
		
	}
	
	function completeDelMerchant(data, status)
	{
		if(status ==1){
			jq('#merchants tbody tr:eq('+data['rowId']+')').remove();
		}else if(status ==0){
			alert("删除商家操作失败！");
		}
		
	}
  
  </script>
</head>
<body>
<div class="example">
  <div class="container">
    <h3>商家列表</h3>
      <form id='searchMerchant'> 
       <div class="input-group">
       	
            <span class="input-group-addon">查询内容：</span>
            <select class="form-control" name="key">
              <option value="Contact">负责人</option>
              <option value="Name">商家名称</option>
            </select>
            <span class="input-group-addon fix-border fix-padding"></span>
            
            <span class="input-group-addon">查询关键字：</span>
            <span class="input-group-addon fix-border fix-padding"></span>
            
            <input type="text" class="form-control" placeholder="填写完整的关键字" name="merchantKeyword">
            <input type="hidden" class="form-control" name="ajax" value="1">
            <input type="hidden" class="form-control" name="PageSize" value="2">
            <input type="hidden" class="form-control" name="PageNum" value="1" id="PageNum">
            <span class="input-group-btn">
              <button type="button" class="btn btn-default" onclick="searchMerchant()" >搜索</button>
            </span>
     
        </div>
       </form>
  </div>
  <br />
    <table id="merchants" class="table table-bordered basic">
      <thead>
      <tr>
        <th>商家名称</th>
        <th>联系方式</th>
        <th>负责人</th>
        <th>商铺地址</th>
        <th>商户运行统计</th>
        <th>设备操作</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody>
      
      </tbody>
    </table>
    
    <div>
  		<ul  id='paginator-test' class="pagination-sm"></ul>
   	</div> 

  

</div>

<script>


	//开始构造分页插件
	ThinkAjax.send("<?php echo U('AgentMessage/getMerchantList');?>",'ajax=1&PageNum=1&PageSize=2', genPaginator,'');
	
	function searchMerchant(){
		ThinkAjax.sendForm("searchMerchant", "<?php echo U('AgentMessage/searchMerchantList');?>", genPaginator, '');
	}

</script>
</body>
</html>