<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>路由列表</title>
  
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
<body >


<div class="example">
    <h3>您的路由器列表<span><input type="button" class="btn btn-toolbar basic" value="基本信息"/><input type="button" class="btn btn-toolbar else" value="其它信息"/></span></h3>
    
    <div id="routelisttable">
    
   </div>
</div>

<script language="JavaScript">

    var whichbutton = 0;

    //循环请求页面，以更新在线人数
   	devicelistRefresh(); // routelistStatus = setInterval('devicelistRefresh()', 2000);
    
   
    
	function devicelistRefresh()
	{
      ThinkAjax.send("<?php echo U('Devicelist/devmescalling');?>",'ajax=1&whichbutton='+whichbutton, completedevmescalling,'');
	}
	
	function completedevmescalling(data,status,info)
	{
		if(status!=0)
		{
			var devlistcon =
			 "<table class=\"table table-bordered basic\"><thead><tr><th>设备名称</th>"+
				 "<th>设备型号</th><th>SSID</th><th>是否在线</th><th>在线人数</th><th>运行统计</th>"+
				 "<th>预览页面</th></tr></thead>";
				 
				 devlistcon += "<tbody>";
	               for(var i=0; i<status; i++)
	            	   {
	            	   devlistcon += "<tr><td>"+data[i]['dname']+"</td><td>"+data[i]['dtype']+"</td><td>"+data[i]['dssid']+"</td>";
	            	   devlistcon += "<td>"+data[i]['dstate']+"</td><td>"+data[i]['donlinenum']+"</td><td><a href=\"javascript:\">查看</a></td>";
	            	   devlistcon += "<td><a href=\""+data[i]['url']+"\" target=\"_Blank\">预览</a></td></tr>";
	            	   }
	               
	               devlistcon += "</tbody></table>" ; 
				 
				 devlistcon += 
				 "<table class=\"table table-bordered else\"><thead><tr><th>设备名称</th>"+
				 "<th>SSID</th><th>是否在线</th><th>在线人数</th><th>MAC地址</th><th>PLC MAC地址</th><th>PLC带宽</th>"+
				 "<th>PLC网络名称</th></tr></thead>";
				 
				 devlistcon += "<tbody>";
	               for(var i=0; i<status; i++)
	            	   {
	            	   devlistcon += "<tr><td>"+data[i]['dname']+"</td><td>"+data[i]['dssid']+"</td><td>"+data[i]['dstate']+"</td>";
	            	   devlistcon += "<td>"+data[i]['donlinenum']+"</td><td>"+data[i]['dmac']+"</td><td>"+data[i]['dplmac']+"</td>";
	            	   devlistcon += "<td>"+data[i]['dplcbandwidth']+"</td><td>"+data[i]['dplcnetworkname']+"</td></tr>";
	            	  
	            	   }
	               
	               devlistcon += "</tbody></table>" ; 
				 
				 
			 $('routelisttable').innerHTML = devlistcon;
		}
		else
			{
			 $('routelisttable').innerHTML = "<table class=\"table table-bordered basic\"><thead><tr><th>设备名称</th>"+
			 								 "<th>设备型号</th><th>SSID</th><th>是否在线</th><th>在线人数</th><th>运行统计</th>"+
			 								 "<th>使用广告主题</th><th>预览页面</th></tr></thead></table>"+
			 								 "<table class=\"table table-bordered else\"><thead><tr><th>设备名称</th>"+
			 								 "<th>SSID</th><th>是否在线</th><th>在线人数</th><th>MAC地址</th><th>PLC MAC地址</th><th>PLC带宽</th>"+
			 								 "<th>PLC网络名称</th></tr></thead></table>"+
			 								 "<h4>还未有广告营销路由，赶紧购买体验吧吧</h4>";
			}
		
		  var tableBasic=jq("table.basic");        //基本信息的表格
		  var tableElse=jq("table.else");
		  if(info == 0)
			  {
			 	 tableBasic.show();                        //基本信息的表格的显示
			 	 tableElse.hide();
			  }
		  else
			  {
			     tableBasic.hide();                        //基本信息的表格的显示
			 	 tableElse.show();
			  }
		  
		  jq("input.basic").on("click",function(){whichbutton=0;tableElse.hide();tableBasic.show();});   //绑定点击事件，当点击“基本信息”的按钮时，显示“基本信息的表格”，隐藏“其它信息的表格”
		  jq("input.else").on("click",function(){whichbutton=1;tableBasic.hide();tableElse.show();});
	}
	
	
	
	
</script>



</body>
</html>