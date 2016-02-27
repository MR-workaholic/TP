<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
  
    <style>
      .userStatic{
        width: 800px;
        /*border: 1px solid red;*/
        padding-left: 30px;
        padding-top: 30px;
        box-shadow: 0 1px 5px rgba(0,0,0,0.1);
        -webkit-box-shadow:0 1px 5px rgba(0,0,0,0.1) ;
        overflow: hidden;
        margin: 0 auto;
      }
      div.userStatic ul a{
        margin-right: 20px;
        /*border: 1px solid red;*/
      }
      div.userStatic ul li:nth-child(5){
        /*border: 1px solid orange;*/
        height: 40px;
        line-height: 35px;
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
    
    <script type="text/javascript">
    
    function updateTodayUserstat()
    {
    	ThinkAjax.send("<?php echo U('Statistics/handleuserpro');?>", "ajax=1&date=0", completehandleuserpro, "");
    }
    
    function updateYesterdayUserstat()
    {
    	ThinkAjax.send("<?php echo U('Statistics/handleuserpro');?>", "ajax=1&date=1", completehandleuserpro, "");
    }
    
    function updateWeekUserstat()
    {
    	ThinkAjax.send("<?php echo U('Statistics/handleuserpro');?>", "ajax=1&date=2", completehandleuserpro, "");
    }
    
    function updateMonthUserstat()
    {
    	ThinkAjax.send("<?php echo U('Statistics/handleuserpro');?>", "ajax=1&date=3", completehandleuserpro, "");
    }
   
    </script>
    
</head>
<body>
 <div class="equipment" id="equipment"></div>  <div class="userStatic" id="userStatic">
  
 
  
    <ul class="nav nav-pills">
      <li><a href="javascript:void(0);" onClick="updateTodayUserstat()">今天</a></li>
      <li><a href="javascript:void(0);" onClick="updateYesterdayUserstat()">昨天</a></li>
      <li><a href="javascript:void(0);" onClick="updateWeekUserstat()">近一周</a></li>
      <li><a href="javascript:void(0);" onClick="updateMonthUserstat()">近一个月</a></li>
      <li><span>今天是以小时为单位，从0点开始算起的小时数</span></li>
    </ul>
    <div>
      <h3>在线用户数统计</h3>
      <span>今天是以小时为单位，从0点开始算起的小时数</span>
      <div class="user">
        <canvas id="user" width="700" height="300"></canvas>
      </div>
    </div>
    <div>
      <h3>接入时长比例</h3>
      <span>不同颜色表示的是用户接入的时间段，比例为该段时间内人数占总人数的百分比</span>
      <div class="onlineTime">
        <canvas id="onlineTime" width="700" height="300"></canvas>
      </div>
    </div>
    <div>
      <h3>用户流量使用Top10</h3>
      <span>用户流量情况统计的是一段时间内的使用流量排名前十的用户数目。x轴表示用户MAC地址，y轴表示流量</span>
      <div class="userflow">
        <canvas id="userflow" width="700" height="300"></canvas>
      </div>
    </div>
    <div>
      <h3>新老客户占比</h3>
      <div class="newUser">
        <canvas id="newUser" width="180" height="180"></canvas>
      </div>
    </div>
    <div>
      <h3>登录方式饼图</h3>
      <div class="loginWay">
        <canvas id="loginWay" width="180" height="180"></canvas>
      </div>
    </div>
  </div>
  
  <script type="text/javascript">
  
  	ThinkAjax.send("<?php echo U('Statistics/handleuserpro');?>", "ajax=1&date=0", completehandleuserpro, "");
  	
  	function completehandleuserpro(data, status){
  		
  		 if(status == 0)
		  {
		    $('equipment').innerHTML = " <h4>您还未购置属于您自己的广告路由设备</h4>";
		    
		  	jq('.userStatic').hide();
		  }else{
			  
			  //绘制在线总人数
			 var userSumdataset = new Array(); 
			 
			 
			 userSumdataset[0] = {
					 // 数据集名称，会在图例中显示
				        label: "所有设备在线用户数",
				        // 颜色主题，可以是'#fff'、'rgb(255,0,0)'、'rgba(255,0,0,0.85)'、'red' 或 ZUI配色表中的颜色名称
				        // 或者指定为 'random' 来使用一个随机的颜色主题
				        color: "red",
				        //也可以不指定颜色主题，使用下面的值来分别应用颜色设置，这些值会覆盖color生成的主题颜色设置
				        fillColor: "blue",
				        strokeColor: "blue",
				        pointColor: "blue",
				        pointStrokeColor: "white",
				        pointHighlightFill: "white",
				        pointHighlightStroke: "white",

				        // 数据集
				        data: data['bigdatauser'],
					 
			 };
			 
			 var userSum = {
					 labels: labels,
					 datasets: userSumdataset,
					 };
			 
			 
			 
			 var myLinechart1 = jq("#user").lineChart(userSum, options2);
			 
			 //绘制在线时间
			 var onlinetimeLabel = ['today'];
			 var onlinetimeDataset = new Array();
			 var time = data['wifitime'] / 240;
			 for(var i=0; i<4; i++)
				 {
				 var color = "rgb("+GetRandomNum(0,255)+","+GetRandomNum(0,255)+","+GetRandomNum(0,255)+")";
				// onlinetimeLabel[i] = time*(i)+'分钟~'+time*(i+1)+'分钟';
				 onlinetimeDataset[i] = {
					          label: time*(i)+'分钟~'+time*(i+1)+'分钟',
					          color: 'primary',
					          fillColor: color,
					          strokeColor: color,
					          data: [data['onlinetime'][i]],
				 };
				 
				 }
			 
			 var onlineTime = {
					
					 labels:onlinetimeLabel,
					 datasets: onlinetimeDataset,
					 
			 };
			 
			 var myBarChart1 = jq("#onlineTime").barChart(onlineTime,options3);
			 
			 //绘制流量
			 var userflow={
					    // labels 数据包含依次在X轴上显示的文本标签
					    labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
					    datasets: [
					      {
					        // 数据集名称，会在图例中显示
					        label: "在线用户数",

					        // 颜色主题，可以是'#fff'、'rgb(255,0,0)'、'rgba(255,0,0,0.85)'、'red' 或 ZUI配色表中的颜色名称
					        // 或者指定为 'random' 来使用一个随机的颜色主题
					        color: 'primary',
					        fillColor: "#9BD79F",
					        strokeColor: "#82CD87",

					        // 数据集
					        data: data['userflow'],
					      }
					      ]
					  };
			 
			 var myBarChart2 = jq("#userflow").barChart(userflow, options3);
			 
			 //绘制饼状图
			 
			 var sum1 = data['newuser'][0] + data['newuser'][1];
			 var sum2 = data['loginay'][0] + data['loginay'][1] + data['loginay'][2];
			 
			 var newUser=[
			              {
			                value: Math.round(100*data['newuser'][0]/sum1),
			                color:"#FBE0DB", // 自定义颜色
			                // highlight: "#FF5A5E", // 自定义高亮颜色
			                label: "新客户"
			              },
			              {
			                value: Math.round(100*data['newuser'][1]/sum1),
			                color: '#9BD79F',
			                label: "老客户"
			              }
			            ];

			          //  登录方式饼图
			            var loginWay=[
			              {
			                value: Math.round(100*data['loginay'][0]/sum2),
			                color:"#EBF2F9", // 自定义颜色
			                // highlight: "#FF5A5E", // 自定义高亮颜色
			                label: "一键登录"
			              },
			              {
			                value: Math.round(100*data['loginay'][1]/sum2),
			                color: '#9BD79F',
			                label: "手机登录"
			              },
			              {
			                value: Math.round(100*data['loginay'][2]/sum2),
			                color: '#F4B2A5',
			                label: "微信登录"
			              }
			            ];

			            var myPiechart1=jq("#newUser").pieChart(newUser, options1);
			            var myPiechart2=jq("#loginWay").pieChart(loginWay, options1);
			 
			 
			 
			 
	  
		  }
		  }
  		
  		
  		
  	
  
  </script>


</body>
</html>