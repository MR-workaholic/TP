<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商户运行统计</title>
    <style>
 .userStatic{
        width: 800px;
        /*border: 1px solid red;*/
        padding-left: 30px;
        padding-top: 30px;
        /*box-shadow: 0 1px 5px rgba(0,0,0,0.1);*/
        /*-webkit-box-shadow:0 1px 5px rgba(0,0,0,0.1) ;*/
        overflow: hidden;
        margin: 0 auto;
      }
      div.userStatic ul a{
        margin-right: 20px;
        /*border: 1px solid red;*/
      }
      div.userStatic ul li:nth-child(5) span{
        margin-left: 50px;
        line-height: 35px;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 5px;
      }
      div.userStatic div,div.userStatic ul{
        /*border: 1px solid yellow;*/
        margin-bottom: 50px;
      }
      div.userStatic div:nth-child(5),div.userStatic div:nth-child(6){
        /*border: 1px solid green;*/
        width: 330px;
        float: left;
        text-align: center;
      }
    </style>
</head>
<body>
  <div class="userStatic">
    <ul class="nav nav-pills">
      <li><a href="">今天</a></li>
      <li><a href="">昨天</a></li>
      <li><a href="">近一周</a></li>
      <li><a href="">近一个月</a></li>
      <li><span>今天是以小时为单位，从0点开始算起的小时数</span></li>
    </ul>

      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p>十大客流量最大商家</p>
            <canvas id="merchantPieChart" width="200" height="200"></canvas>
          </div>
            <div class="col-md-6">
              <p>十大客流量最大商圈</p>
                <canvas id="buziRangePieChart" width="200" height="200"></canvas>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <p>认证方式统计</p>
                <canvas id="authWayPieChart" width="200" height="200"></canvas>
            </div>
            <div class="col-md-6">
              <p>十大高点击率广告</p>
                <canvas id="popularADPieChart" width="200" height="200"></canvas>
            </div>
          </div>
        </div>

</div>

<script>
  var merchantData = [
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


//  新老客户占比
  var newUser=[
    {
      value: 80,
      color:"#FFC1C1", // 自定义颜色
      // highlight: "#FF5A5E", // 自定义高亮颜色
      label: "新客户"
    },
    {
      value: 20,
      color: '#FF6EB4',
      label: "老客户"
    }
  ];

//  登录方式饼图
  var loginWay=[
    {
      value: 35,
      color:"#EBF2F9", // 自定义颜色
      // highlight: "#FF5A5E", // 自定义高亮颜色
      label: "一键登录"
    },
    {
      value: 25,
      color: '#9BD79F',
      label: "手机登录"
    },
    {
      value: 40,
      color: '#F4B2A5',
      label: "微信登录"
    }
  ];

  var myPiechart1=jq("#authWayPieChart").pieChart(newUser,options);
  var myPiechart2=jq("#popularADPieChart").pieChart(loginWay,options);
</script>
</body>
</html>