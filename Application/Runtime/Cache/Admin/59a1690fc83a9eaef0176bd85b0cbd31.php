<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>广告列表</title>
    
    <style>
      *{
        margin: 0;
        padding: 0;
      }
      ul.adlist{
        width: 800px;
        margin: 0 auto;
        overflow: hidden;
        list-style-type: none;
        border: 1px solid yellow;
        font-size: 16px;
        padding-left: 0;
      }
     .listStyle{
        float: left;
        height: 40px;
        line-height: 40px;
        width: 100px;
        /*border: 1px solid red;*/
      }
      div.example{
        width:800px;
        margin: 0 auto;
        /*border: 1px solid blue;*/
      }
      div.example h3{
        width: 800px;
        margin: 30px auto;
        text-align: left;
        /*border: 1px solid red;*/
      }
      div.example h3 b{
        margin-right: 30px;
      }
      div.example thead tr th{
        text-align: center;
      }
      div.example table.table.table-bordered{
        max-width:900px;
        min-width: 800px;
        margin: 0 auto;
        text-align: center;
      }


    </style>
   
</head>
<body>
  <div class="example" >
   
   
    <h3>
    <b>您所设置的广告主题如下：</b>
     <a  class="btn btn-toolbar" href="javascript:;" onclick="clickADthemeAdd()">添加广告主题</a>
     
     </h3>
     
 
   
   
   <div id="adlisttable">
   
    </div>
  </div>
  
   <script language="JavaScript">

	ThinkAjax.send("<?php echo U('Adset/admescalling');?>",'ajax=1&calling='+'y',completeadmescalling,'');
	
	function completeadmescalling(data,status)
	{
		if(status!=0)
		{
		var adlistcon = "<table class=\"table table-bordered\"><thead><tr>"+
                        "<th>名称</th><th>启用状态</th><th>应用模板</th><th>预览</th><th>设置</th>";
                        
            if(data['type'] == 0)
                 {
                       adlistcon += "<th>应用路由</th>";
                   }
                        
            adlistcon += "<th>备注</th><th>删除</th></tr></thead>";
                        	
                        
  
              adlistcon += "<tbody>";
               for(var i=0; i<status; i++)
            	   {
	            	   adlistcon += "<tr><td>"+data[i]['adname']+"</td><td>"+data[i]['adstatus']+"</td><td>"+data[i]['admodel']+"</td>";
	            	   adlistcon += "<td><a href=\"http://"+data['host']+data[i]['url']+"\" target=\"_Blank\">预览</a></td><td><a href=\"javascript:void(0)\" onclick=\"adset('"+data[i]['aid']+"')\">设置</a></td>";
	            	   if(data['type'] == 0)
	            		   {
	            		   		adlistcon += "<td><a href=\"javascript:\" onclick=\"handleADMac('"+data[i]['aid']+"')\">查看</a></td>";
	            		   }
	            	   adlistcon += "<td>"+data[i]['adremark']+"</td><td><a href=\"javascript:\" onclick=\"addel('"+data[i]['aid']+"')\">删除</a></td></tr>";
            	   }
               
              adlistcon += "</tbody></table>" ; 
              
			  $('adlisttable').innerHTML = adlistcon;
		}
		else
			{
			 $('adlisttable').innerHTML = "<table class=\"table table-bordered\"><thead><tr>"+
			                              "<th>名称</th><th>启用状态</th><th>应用模板</th><th>预览</th><th>设置</th>"+
			                              "<th>应用路由</th><th>备注</th><th>删除</th></tr></thead></table>"+
			                              "<h4>还未有广告主题，点击添加广告主题，创造属于自己的路由器营销广告</h4>" ;
			}
	}
	
	/*
	* 编辑广告导航页加载
	*/
	function adset(aid)
	{
		
		mycontent = "../Adset/adsetnav/aid/"+aid;
        contentLoad();
//		 var adset = "../Adset/adset/filename/"+filename;
//		window.open(adset,"","width=800,height=600,top=150,left=700,resizable=no");
	}
	
	/*
	*  删除广告
	*/
	function addel(aid)
	{
		ThinkAjax.send("<?php echo U('Adset/addel');?>", "ajax=1&aid="+aid, completeaddel, '');
	}
	
	function completeaddel(data, status)
	{
		if(status==1)
			{
				alert('删除成功');
				ThinkAjax.send("<?php echo U('Adset/admescalling');?>",'ajax=1&calling='+'y',completeadmescalling,'');
				
			}else
				{
				alert('删除失败');
				}
	}
	
	function handleADMac(aid)
	{
		var top = document.body.clientHeight / 4;
		var left = document.body.clientWidth / 4; 
		window.open("../Adset/handleADMac/aid/"+aid, "", "width=800,height=400,top="+top+",left="+left+",scrollbars=yes,resizable=no");
		
	}
	
</script>


</body>
</html>