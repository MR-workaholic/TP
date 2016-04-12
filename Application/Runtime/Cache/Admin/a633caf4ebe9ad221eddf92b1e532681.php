<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>商户统计情况</title>


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
	            ThinkAjax.send("<?php echo U('AgentMessage/getrMerchantList');?>",'ajax=1&PageSize=6&PageNum='+page, completeMerchantList, '');
	            },
		    };
		
			var element =  jq('#paginator-test');
			element.bootstrapPaginator(options);
			
			//ThinkAjax.send("<?php echo U('AgentMessage/getrMerchantList');?>",'ajax=1&PageNum=0&PageSize=3',completeMerchantList,'');
		
			completeMerchantList(data, status);
		}
		
		
		
			//把列表信息填充到table中
			function completeMerchantList(data,status){
				
				
				merchantList = data['merchantList'];
				var table = document.getElementById("merchantStatistics");
				var newtbodies = "";
				var tbodies = table.getElementsByTagName("tbody");
				
				
				
				for(var i = 0; i < merchantList.length; i++)
				{
					newtbodies += "<tr><td>"+merchantList[i]['Name']+"</td><td>"+merchantList[i]['Contact']+"</td><td>"+merchantList[i]['Address']+"</td><td>"+merchantList[i]['Role']+"</td>";
					newtbodies += "<td><input type=\"checkbox\" name='"+merchantList[i]['BId']+"'></td>";
					newtbodies += "</tr>";
					
				}
				
				tbodies[0].innerHTML = newtbodies;
				
				
			}
		
 
  
  </script>
  
  
</head>
<body>
<div class="example">
 <form id='searchMerchant4Statistics'> 
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
  
  <br />
  
  <table id="merchantStatistics" class="table table-bordered basic">
      <thead>
      <tr>
        <th>商家名称</th>
        <th>联系人</th>
        <th>地址</th>
        <th>商家类型</th>
        <th>选择</th>
      </tr>
      </thead>
      <tbody>
      
      </tbody>
    </table>
    
    <div>
  		<ul  id='paginator-test' class="pagination-sm"></ul>
   	</div> 
    
    
  <br />
<div class="container">
  <div class="row">
    <div class="col-lg-offset-10 col-sm-2">
      <button class="btn" type="button">统计</button>
    </div>
  </div>
</div>
</div>

<script>
		//开始构造分页插件
		ThinkAjax.send("<?php echo U('AgentMessage/getrMerchantList');?>",'ajax=1&PageNum=1&PageSize=6', genPaginator,'');
</script>

</body>
</html>