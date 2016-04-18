<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title></title>
  <script src="/TP/Public/dist/js/jquery-1.11.0.min.js"></script>
  <script src="/TP/Public/dist/js/chart.min.js"></script>
  <script src="/TP/Public/dist/js/image-file-visible.js"></script>
  <script src="/TP/Public/dist/js/ajaxfileupload.js"></script>
  <script src="/TP/Public/dist/js/jquery.minicolors.js"></script>



  <link href="/TP/Public/dist/css/zui.min.css" rel="stylesheet">
  <link href="/TP/Public/dist/css/zui-theme.css" rel="stylesheet">
  <link href="/TP/Public/merchant/css/merchantIndex.css" rel="stylesheet" type="text/css">
  <link href="/TP/Public/dist/css/jquery.minicolors.css" rel="stylesheet" type="text/css">
  



    <!-- --> 
	<script type="text/javascript" src="/TP/Public/AjaxJs/Base.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/prototype.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/mootools.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/Ajax/ThinkAjax.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/Form/CheckForm.js"></script>	
	
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


<div class="example">
    <h3>您的路由器列表<span><input type="button" class="btn btn-toolbar basic" value="基本信息"/><input type="button" class="btn btn-toolbar else" value="其它信息"/></span></h3>
    
    <div id="routelisttable">
    
   </div>
</div>

<script language="JavaScript">
var jq = jQuery.noConflict();
    var whichbutton = 0;
  
  //    ThinkAjax.send("<?php echo U('AgentMessage/devmescalling');?>",'ajax=1&whichbutton='+whichbutton, completedevmescalling,'');

	
	//function completedevmescalling(data,status,info)
	//{
	//	if(status!=0)
	//	{
			var devlistcon =
			 "<table class=\"table table-bordered basic\"><thead><tr><th>设备名称</th>"+
				 "<th>设备型号</th><th>SSID</th><th>是否在线</th><th>在线人数</th><th>运行统计</th>"+
				 "<th>使用广告主题</th><th>预览页面</th></tr></thead>";
				 
				 devlistcon += "<tbody>";
	               
	            	   devlistcon += "<tr><td><?php echo ($RouterMsg['RouterName']); ?></td><td><?php echo ($RouterMsg['FirmwareVer']); ?></td><td><?php echo ($RouterMsg['SSID']); ?></td>";
	            	   devlistcon += "<td><?php echo ($RouterMsg['State']); ?></td><td><?php echo ($RouterMsg['onlineUserNum']); ?></td><td><a href=\"javascript:\">查看</a></td>";
	            	   devlistcon += "<td><a href=\"javascript:\">查看</a></td><td><a href=\"javascript:\">预览</a></td></tr>";
              
	               devlistcon += "</tbody></table>" ; 
				 
				 devlistcon += 
				 "<table class=\"table table-bordered else\"><thead><tr><th>设备名称</th>"+
				 "<th>SSID</th><th>是否在线</th><th>在线人数</th><th>MAC地址</th><th>PLC MAC地址</th><th>PLC带宽</th>"+
				 "<th>PLC网络名称</th></tr></thead>";
				 
				 devlistcon += "<tbody>";
	            	   devlistcon += "<tr><td><?php echo ($RouterMsg['RouterName']); ?></td><td><?php echo ($RouterMsg['SSID']); ?></td><td><?php echo ($RouterMsg['State']); ?></td>";
	            	   devlistcon += "<td><?php echo ($RouterMsg['onlineUserNum']); ?></td><td><?php echo ($RouterMsg['MAC']); ?></td><td><?php echo ($RouterMsg['PLCmac']); ?></td>";
	            	   devlistcon += "<td><?php echo ($RouterMsg['PLCwidth']); ?></td><td><?php echo ($RouterMsg['PLCName']); ?></td></tr>";
	               
	               devlistcon += "</tbody></table>";
				 
				 
			 $('routelisttable').innerHTML = devlistcon;
		//}
		/* else
			{
			 $('routelisttable').innerHTML = "<table class=\"table table-bordered basic\"><thead><tr><th>设备名称</th>"+
			 								 "<th>设备型号</th><th>SSID</th><th>是否在线</th><th>在线人数</th><th>运行统计</th>"+
			 								 "<th>使用广告主题</th><th>预览页面</th></tr></thead></table>"+
			 								 "<table class=\"table table-bordered else\"><thead><tr><th>设备名称</th>"+
			 								 "<th>SSID</th><th>是否在线</th><th>在线人数</th><th>MAC地址</th><th>PLC MAC地址</th><th>PLC带宽</th>"+
			 								 "<th>PLC网络名称</th></tr></thead></table>"+
			 								 "<h4>还未有广告营销路由，赶紧购买体验吧吧</h4>";
			} */
		
			  var tableBasic=jq("table.basic");        //基本信息的表格
			  var tableElse=jq("table.else");
		/*   if(info == 0)
			  { */
			 	 tableBasic.show();                        //基本信息的表格的显示
			 	 tableElse.hide();
			 /*  } */
		/*   else
			  {
			     tableBasic.hide();                        //基本信息的表格的显示
			 	 tableElse.show();
			  } */
		  
		  jq("input.basic").on("click",function(){whichbutton=0;tableElse.hide();tableBasic.show();});   //绑定点击事件，当点击“基本信息”的按钮时，显示“基本信息的表格”，隐藏“其它信息的表格”
		  jq("input.else").on("click",function(){whichbutton=1;tableBasic.hide();tableElse.show();});
//	}
	
	
	
	
</script>

</body>
</html>