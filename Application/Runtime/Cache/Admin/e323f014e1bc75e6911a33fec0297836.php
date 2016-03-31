<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>统计数据列表</title>

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
</head>
<body>
<div class="example">
  <div class="container">
    <div class="row">
      <div class="col-sm-2 col-md-2 col-lg-2">
        <label class="control-label">搜索：</label>
      </div>
      <div class="col-sm-4 col-md-4 col-lg-4">
        <input  id="agnetKeyword" class="form-control" type="text"  placeholder="搜索商家ID或者商家名称"/>
      </div>
      <div class="col-sm-2 col-md-2 col-lg-2">
        <input type="button" class="btn btn-toolbar else" value="搜索" onclick="searchAgent()"/>
      </div>
    </div>
  </div>
  <br />
  <p>选择代理商：</p>
  <table id="agentsList" class="table table-bordered basic">
    <thead>
    <tr>
      <th>代理商ID</th>
      <th>代理商名称</th>
      <th>选择</th>

    </tr>
    </thead>
    <tbody>
    <tr>
      <td></td>
      <td></td>
      <td> <input type="checkbox"></td>

    </tr>
    <tr>
      <td></td>
      <td></td>
      <td> <input type="checkbox"></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td> <input type="checkbox"></td>
    </tr>
    </tbody>
  </table>
  <div>
<ul  id='AgentsPaginator' class="pagination-sm"></ul>
</div>   

  <div class="container">
    <div class="row">
      <div class="col-sm-8 col-md-8 col-lg-8"></div>
      <div class="col-sm-2 col-md-2 col-lg-2">

          <button type="button" class="btn btn-default">统计(导出数据)</button>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
          <button type="button" class="btn btn-default">数据图形化</button>
        </div>
    </div>
  </div>
  

</div>
<!--<script src="../../dist/js/jquery-1.11.0.min.js"></script>-->
<script>
ThinkAjax.send("<?php echo U('Admin/getAgentList4Static');?>",'ajax=1&PageSize=3&PageNum=1', genPaginator,'');

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

            	ThinkAjax.send("<?php echo U('Admin/getAgentList4Static');?>",'ajax=1&PageSize=3&PageNum='+page,completeAgentsList4Statistic,'');
            },
	    };

		var element =  jq('#AgentsPaginator');
		element.bootstrapPaginator(options);
		completeAgentsList4Statistic(data,status);	
}

function completeAgentsList4Statistic(data,status){
	 var table = document.getElementById("agentsList");
	 var newtbodies="";
	var tbodies= table.getElementsByTagName("tbody");
	var tbodyCotent = data['AgentList'];
	for(var i=0;i<tbodyCotent.length;i++){
		newtbodies += "<tr><td>"+tbodyCotent[i]['agentId']+"</td><td>"+tbodyCotent[i]['agentName']+"</td>";
		newtbodies +="<td><input type=\"checkbox\" value=\""+tbodyCotent[i]['agentId']+"\"></td>";
		newtbodies += "</tr>";
	}
	tbodies[0].innerHTML=newtbodies;
}

function searchAgent(){
	var agentKeyword = jq('#agnetKeyword').val();
	ThinkAjax.send("<?php echo U('Admin/searchAgent4Statistic');?>",'ajax=1&agentKeyword='+agentKeyword,completeAgentsList4Statistic,'');
}

</script>
</body>
</html>