<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    
    
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
      div.index div.indexmyLine1,div.index div.indexmyLine2{
        margin-top: 20px;
      }
    </style>
    
    <script type="text/javascript">
    
    function updateTodaysta()
    {
    	ThinkAjax.send("<?php echo U('Statistics/handlepro');?>","ajax=1&date=0&dev=0",completeupdatesta,'');
    }
    
    function updateYesterdaysta()
    {
    	ThinkAjax.send("<?php echo U('Statistics/handlepro');?>","ajax=1&date=1&dev=0",completeupdatesta,'');
    }
    
    function updateWeeksta()
    {
    	ThinkAjax.send("<?php echo U('Statistics/handlepro');?>","ajax=1&date=2&dev=0",completeupdatesta,'');
    }
    
    function updateMonthsta()
    {
    	ThinkAjax.send("<?php echo U('Statistics/handlepro');?>","ajax=1&date=3&dev=0",completeupdatesta,'');
    }
    
    function completeupdatesta(data, status){
    	
    	var datasetsFlow = new Array();
		var datasetsUser = new Array();
    	
    	for (var i=0; i<status; i++)
		{
		
		var color1 = "rgb("+GetRandomNum(0,255)+","+GetRandomNum(0,255)+","+GetRandomNum(0,255)+")";
		var color2 = "rgb("+GetRandomNum(0,255)+","+GetRandomNum(0,255)+","+GetRandomNum(0,255)+")";
						
		 datasetsFlow[i] = {
			        // 数据集名称，会在图例中显示
			        label: data['data'][i]['dname'],
			        // 颜色主题，可以是'#fff'、'rgb(255,0,0)'、'rgba(255,0,0,0.85)'、'red' 或 ZUI配色表中的颜色名称
			        // 或者指定为 'random' 来使用一个随机的颜色主题
			        color: "red",
			        //也可以不指定颜色主题，使用下面的值来分别应用颜色设置，这些值会覆盖color生成的主题颜色设置
			        fillColor: color1,
			        strokeColor: color1,
			        pointColor: color1,
			        pointStrokeColor: "white",
			        pointHighlightFill: "black",
			        pointHighlightStroke: "black",
			        // 数据集
			        data: data['bigdataflow'][i]
			      };
		 
		 datasetsUser[i] = {
			        // 数据集名称，会在图例中显示
			        label: data['data'][i]['dname'],
			        // 颜色主题，可以是'#fff'、'rgb(255,0,0)'、'rgba(255,0,0,0.85)'、'red' 或 ZUI配色表中的颜色名称
			        // 或者指定为 'random' 来使用一个随机的颜色主题
			        color: "red",
			        //也可以不指定颜色主题，使用下面的值来分别应用颜色设置，这些值会覆盖color生成的主题颜色设置
			        fillColor: color2,
			        strokeColor: color2,
			        pointColor: color2,
			        pointStrokeColor: "white",
			        pointHighlightFill: "black",
			        pointHighlightStroke: "black",
			        // 数据集
			        data: data['bigdatauser'][i]
			      };
		 
		}
    	
    	 //设备流量时间拆线图（今天）
		  var APflow = {
		    // labels 数据包含依次在X轴上显示的文本标签
		    labels: labels,
		    datasets: datasetsFlow,
		  };
		 
		 //用户数时间拆线图（今天）
		  var APuser = {
		    // labels 数据包含依次在X轴上显示的文本标签
		    labels: labels,
		    datasets: datasetsUser,
		  };
		 
		  //创建拆线图
		  
		 
		  var myLinechart1 = jq("#indexmyLine1").lineChart(APflow, options2);
		  
		  var myLinechart2 = jq("#indexmyLine2").lineChart(APuser, options2);
		
    	
    	
    }
    
    
    </script>
</head>
<body>
<div class="index">

 <div id="devtable"></div>
    
  <div class="devmsg">
    <ul class="nav nav-pills">
      <li><a href="javascript:void(0);" onClick="updateTodaysta()">今天</a></li>
      <li><a href="javascript:void(0);" onClick="updateYesterdaysta()">昨天</a></li>
      <li><a href="javascript:void(0);" onClick="updateWeeksta()">近一周</a></li>
      <li><a href="javascript:void(0);" onClick="updateMonthsta()">近一个月</a></li>
      <li><span>今天是以小时为单位，从0点开始算起的小时数</span></li>
    </ul>
    <div>
      <h3>设备流量统计 </h3>
      <p>对设备流量进行统计。（X轴为时间，Y轴为流量，不同折线表示不同设备型号）</p>
      <div class="indexmyLine1">
        <canvas id="indexmyLine1" width="700" height="300"></canvas>
      </div>
      <h3>设备接入用户数统计</h3>
      <p>对设备接入用户（MAC地址）数进行统计。（X轴为时间，Y轴为用户人数，折线表示不同设备型号）</p>
      <div class="indexmyLine2">
        <canvas id="indexmyLine2" width="700" height="300"></canvas>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

// 图表配置项，可以留空来使用默认的配置
var options1 = {
  scaleShowLabels: true  // 展示标签
};


var options2 = {
	    scaleShowLabels: true,
	    //Boolean - 是否在图表上显示网格
	    scaleShowGridLines : true,
	    //String - 网格线条颜色
	    scaleGridLineColor : "rgba(0,0,0,.05)",
	    //Number - 网格宽度
	    scaleGridLineWidth : 1,
	    //Boolean - 是否显示水平坐标，即X轴
	    scaleShowHorizontalLines: true,
	    //Boolean - 是否显示垂直坐标，即Y轴
	    scaleShowVerticalLines: true,
	    //Boolean - 是否显示为平滑曲线
	    bezierCurve : true,
	    //Number - 平滑曲线时所使用的贝塞尔曲线参数
	    bezierCurveTension : 0.4,
	    //Boolean - 是否显示顶点
	    pointDot : true,
	    //Number - 顶点半径，单位像素
	    pointDotRadius : 4,
	    //Number - 顶点描边线条宽度，单位像素
	    pointDotStrokeWidth : 1,
	    //Number - 检测鼠标点击所使用依据的半径大小，单位像素
	    pointHitDetectionRadius : 20,
	    //Boolean - 是否
	    datasetStroke : true,
	    //Number - 数据集线条宽度，单位为像素
	    datasetStrokeWidth : 2,
	    //Boolean - 是否用颜色来填充数据集
	    datasetFill : false
	 };
	 
	var options3 = {
	    scaleShowLabels: true,
	    bezierCurve: true,
	    barValueSpacing:15,
	    barDatasetSpacing: 20,
	    datasetFill : true
	  };
	 

	var labels = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11"];
	
	 
	 
	
	ThinkAjax.send("<?php echo U('Merchant/indexmescalling');?>", "ajax=1", completeindexmescalling, '');
	
	function completeindexmescalling(data, status)
	{
		
		 var datasetsFlow = new Array();
		 var datasetsUser = new Array();
		
		if(status == 0){
			$('devtable').innerHTML = "<h3>您还未购置广告路由，快购买体验一下吧！</h3>"	
			jq('.devmsg').hide();
		}
		else{
			
			var devtablecon = " <h3>当前在线设备提示：（在线设备数:"+data['count_online']+"/总设备数:"+data['count_sum']+"）</h3>"+
							  "<table class=\"onlineEquipment\" rules=\"all\"><tr><th>设备名称</th><th>接入用户人数</th><th>SSID</th><th>预览广告</th></tr>";
							  
			for (var i=0; i<status; i++)
				{
				devtablecon += "<tr><td>"+data['data'][i]['dname']+"</td><td>"+data['data'][i]['donlinenum']+"</td>"+
								"<td>"+data['data'][i]['dssid']+"</td><td><a href=\""+data['data'][i]['url']+"\" target=\"_Blank\">预览</a></td></tr>";
				
								
				 
				}
			
			devtablecon += "</table>"; 
			
			$('devtable').innerHTML = devtablecon;
		
			  
			ThinkAjax.send("<?php echo U('Statistics/handlepro');?>","ajax=1&date=0&dev=0",completeupdatesta,'');
			
		}
		
	}
	
	

</script>



</body>
</html>