<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>代理商首页</title>


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
    </style>
</head>
<body>
<div class="index">
  <div  class="container">
    <div class="row">
      <div class="col-sm-4 col-md-4 col-lg-4"><span class="h3">在线设备总数: </span><span id="onlineDevices" class="h3"></span></div>
      <div class="col-sm-4 col-md-4 col-lg-4"><span class="h3">商户总数: </span><span id="merchantTotal" class="h3"></span></div>
      <div class="col-sm-4 col-md-4 col-lg-4"><span class="h3">在线客流: </span><span id="onlineClients" class="h3"></span></div>
      <div class="col-sm-4 col-md-4 col-lg-4"><span class="h3">离线设备总数: </span><span id="offlineDevices" class="h3"></span></div>
    </div>
    <hr/>
    <!-- <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-6">十大客流量最大商家</div>
      <div class="col-sm-6 col-md-6 col-lg-6">十大客流量最大商圈</div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-6">
      <canvas id = "merchantPieChart" width="200" height="200"></canvas>
        </div>
     <div class="col-sm-1 col-md-1 col-lg-1">
        <div id="legend0"></div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-6">
        <canvas id = "buziRangePieChart" width="200" height="200"></canvas>
      </div>
    </div>
    <br /><br /><br />
    <div>在线设备客流实时统计：</div>
    <br />
    <div>
      <canvas id = "trafficBarChart" width="400" height="200"></canvas>
    </div>
  </div> -->
</div>



<script>
ThinkAjax.send("<?php echo U('Agent/indexInfo');?>",'ajax=1',completeIndexInfo,'');

function completeIndexInfo(data,status){
	$('onlineDevices').innerHTML=data['onlineDevices'];
	$('merchantTotal').innerHTML=data['merchantTotal'];
	$('onlineClients').innerHTML=data['onlineClients'];
	$('offlineDevices').innerHTML=data['offlineDevices'];
}




/*   var merchantData = [
	{value: 30,color:"#FFF68F",label:"商家一"},
	{value: 12,color:"#FFEFD5",label:"商家二"},
	{value: 20,color:"#FFC1C1",label:"商家三"},
	{value: 35,color:"#FF6EB4",label:"商家四"},
	{value: 60,color:"#FF3030",label:"商家五"},
	{value: 60,color:"#B4EEB4",label:"商家六"},
	{value: 10,color:"#B23AEE",label:"商家七"},
	{value: 5,color:"#F7464A",label:"商家八"},
	{value: 55,color:"#8DEEEE",label:"商家九"},
	{value: 40,color:"#607B8B",label:"商家十"},
];
// 图表配置项，可以留空来使用默认的配置
var options = {
    scaleShowLabels: true, //展示标签
    scaleLabel: "<%=value%>",
     scaleLabelPlacement: "auto",
     //String - 图例模板
    legendTemplate : "<ul class='<%=name.toLowerCase()%>-legend'><% for (var i=0; i<segments.length; i++){%><li><span style='background-color:<%=segments[i].fillColor%>'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
};
// 创建饼图
var merPieChart = jq("#merchantPieChart").pieChart(merchantData, options);
var legend = merPieChart.generateLegend();
//document.getElementById("legend0").innerHTML=legend;
var buziRangeData=[
	{value: 30,color:"#FFF68F",label:"商圈一"},
	{value: 12,color:"#FFEFD5",label:"商圈二"},
	{value: 20,color:"#FFC1C1",label:"商圈三"},
	{value: 35,color:"#FF6EB4",label:"商圈四"},
	{value: 60,color:"#FF3030",label:"商圈五"},
	{value: 60,color:"#B4EEB4",label:"商圈六"},
	{value: 10,color:"#B23AEE",label:"商圈七"},
	{value: 5,color:"#F7464A",label:"商圈八"},
	{value: 55,color:"#8DEEEE",label:"商圈九"},
	{value: 40,color:"#607B8B",label:"商圈十"},
];
// 图表配置项，可以留空来使用默认的配置
var buziOptions = {
    scaleShowLabels: true, //展示标签
    scaleLabel: "<%=value%>",
     scaleLabelPlacement: "auto",
     //String - 图例模板
    legendTemplate : "<ul class='<%=name.toLowerCase()%>-legend'><% for (var i=0; i<segments.length; i++){%><li><span style='background-color:<%=segments[i].fillColor%>'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
};
// 创建饼图
var buziPieChart = jq("#buziRangePieChart").pieChart(merchantData, buziOptions);

var trafficData={
    labels:["78:D3:C8:C5:D0","78:D3:C8:C5:D1","78:D3:C8:C5:D2","78:D3:C8:C5:D3","78:D3:C8:C5:D4","78:D3:C8:C5:D5","78:D3:C8:C5:D6","78:D3:C8:C5:D7","78:D3:C8:C5:D8","78:D3:C8:C5:D9",],
    datasets:[{label:"客流量",color: 'primary',data: [65, 59, 80, 81, 56, 55, 40,99,45,66]}]
};
var trafficOptions = {responsive: true};
var trafficChart = jq('#trafficBarChart').barChart(trafficData, trafficOptions); */
</script>
</body>
</html>