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
  
  var checkboxList = new Array();
  
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
	            			ThinkAjax.send("<?php echo U('AgentMessage/getMerchantList');?>",'ajax=1&PageSize='+mPageSize+'&PageNum='+page, completeMerchantList, '');
	            		}else{
	            			$('PageNum').value = page;
	            			ThinkAjax.sendForm("searchMerchant4Statistics", "<?php echo U('AgentMessage/searchMerchantList');?>", completeMerchantList, '');
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
					
						
						var table = document.getElementById("merchantStatistics");
						var newtbodies = "";
						var tbodies = table.getElementsByTagName("tbody");
						
						newtbodies = "<h4>没有任何商家</h4>";
						
						tbodies[0].innerHTML = newtbodies;
					
					}else{
						
						merchantList = data['merchantList'];
						var table = document.getElementById("merchantStatistics");
						var newtbodies = "";
						var tbodies = table.getElementsByTagName("tbody");
						
						
						
						for(var i = 0; i < merchantList.length; i++)
						{
							newtbodies += "<tr><td>"+merchantList[i]['Name']+"</td><td>"+merchantList[i]['Contact']+"</td><td>"+merchantList[i]['Address']+"</td><td>"+merchantList[i]['Role']+"</td>";
							newtbodies += "<td><input type=\"checkbox\" id='cb_"+merchantList[i]['BId']+"'  onclick=\"checkboxChanged('"+merchantList[i]['BId']+"')\" name='"+merchantList[i]['BId']+"'></td>";
							newtbodies += "</tr>";
							
						}
						
						tbodies[0].innerHTML = newtbodies;
						
					}
				
				
				
				
			}
			
			function checkboxChanged(BId){
				 
				if(document.getElementById('cb_'+BId).checked == true){
					
					checkboxList.push(BId);

				}else{
					
				 	for(var i=0;i<checkboxList.length;i++){
				 		
						if(checkboxList[i] == BId){
							checkboxList.splice(i,1);

						}
					} 
				}
				alert(checkboxList); 
			 }
		
 
  
  </script>
  
  
</head>
<body>
<div class="example">
 <form id='searchMerchant4Statistics'> 
       <div class="input-group">
       	
            <span class="input-group-addon">查询内容：</span>
            <select class="form-control" name="key">
              <option value="Contact">联系人</option>
              <option value="Name">商家名称</option>
            </select>
            <span class="input-group-addon fix-border fix-padding"></span>
            
            <span class="input-group-addon">查询关键字：</span>
            <span class="input-group-addon fix-border fix-padding"></span>
            
            <input type="text" class="form-control" placeholder="填写完整的关键字" name="merchantKeyword">
            <input type="hidden" class="form-control" name="ajax" value="1">
            <input type="hidden" class="form-control" name="PageSize" value="" id="PageSize">
            <input type="hidden" class="form-control" name="PageNum" value="1" id="PageNum">
            <span class="input-group-btn">
              <button type="button" class="btn btn-default" onclick="searchMerchant4Statistics()" >搜索</button>
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
		
		var mPageSize = parseInt(document.body.clientHeight / 100);
		$('PageSize').value = mPageSize;
		
		
		//开始构造分页插件
		ThinkAjax.send("<?php echo U('AgentMessage/getMerchantList');?>",'ajax=1&PageNum=1&PageSize='+mPageSize, genPaginator,'');
		
		function searchMerchant4Statistics(){
			ThinkAjax.sendForm("searchMerchant4Statistics", "<?php echo U('AgentMessage/searchMerchantList');?>", genPaginator, '');
		}
		
		
</script>

</body>
</html>