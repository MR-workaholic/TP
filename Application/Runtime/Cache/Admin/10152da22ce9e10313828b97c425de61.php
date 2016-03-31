<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>代理商基本信息</title>

    <style>
      .myp1s1left{
        width: 55%;
        height: 100%;
        /*border: 1px solid black;*/
        float: left;
        /*border-right: 1px solid #ECEBEB;*/
      }
      .myp1s1right{
        width: 45%;
        height: 100%;
        /*border: 1px solid red;*/
        float: right;
        /*background-color: #000088;*/
        /*border-left: 1px solid #ECEBEB;*/
      }
      div.myp1s1left div:first-child{
        /*max-width: 540px;*/
        height: 60%;
        padding-left:6%;
        padding-top: 3%;
        /*border: 1px solid cyan;*/
      }
      div.myp1s1left div:last-child{
        padding-top: 4%;
        padding-right: 6%;
        text-align: right;
        /*border: 1px solid blueviolet;*/
      }

      #map{
        max-width: 400px;
        max-height: 300px;
        min-height: 250px;
        min-width: 300px;
        margin: 5% 7% 0 7%;
        /*border: 1px solid orange;*/
      }
      div.myp1s1right div:nth-child(2){
        margin-left: 5%;
        margin-top: 8%;
        /*border: 1px solid greenyellow;*/
      }
    </style>
 <script type="text/javascript">
	function updateAgentInfo()
	{
		
		ThinkAjax.sendForm('basicMsg',"<?php echo U('AgentMessage/updateAgentInfo');?>",agentinfoshow,'');
	}
	
	function agentinfoshow(data,status)
	{
		if(status==1){
			
			 $('agentname').value = data['agentname'];
			 $('agent').value = data['agent'];
			 $('agentContact').value = data['agentContact'];
			 $('agentAddress').value = data['agentAddress'];
			 $('agentNote').value = data['agentNote'];
			 $('shoplongitude').value = data['shoplongitude'];
			 $('shoplatitude').value = data['shoplatitude'];
	/* 		 $('sid').value = data['sid'];
			 $('shopsite2').innerHTML = data['shopsite']; */
			 $('agentId').value = data['agentId'];
			 
			 shopname = data['shopname'];
			 shopsite = data['shopsite'];
			 x = data['shoplongitude'];
			 y = data['shoplatitude'];
			 
			 baiduMap();
			 
			
			
			alert('更新成功！');
		 }else{
			 alert('更新失败！');
		 }
	}
 </script>
</head>
<body>
<form id="basicMsg" method="post" name="basicMsg" action="<?php echo U('AgentMessage/updateAgentInfo');?>" >
<div class="myp1s1left">
  <div>

    <table class="table-fixed" style=" width:90%;margin-top: 0;">
      <tr>
        <td style="width: 20%;"><h4>代理商名称： </h4></td>
        <td style="width: 65%"><input name="agentname" id="agentname" type="text" class="form-control"></td>
      </tr>
      <tr>
        <td ><h4>负责人： </h4></td>
        <td><input type="text"  name="agent" id="agent" class="form-control"></td>
      </tr>
      <tr>
        <td ><h4>联系方式： </h4></td>
        <td><input type="text" name="agentContact" id="agentContact" class="form-control"></td>
      </tr>
      <tr>
        <td ><h4>代理商地址： </h4></td>
        <td><input type="text" name="agentAddress" id="agentAddress" class="form-control"></td>
      </tr>
      <tr>
        <td ><h4>备注信息： </h4></td>
        <td><textarea rows="3" name="agentNote" id="agentNote" class="form-control" style="resize: none;"></textarea></td>
      </tr>
      <!--<tr>-->
        <!--<td ><h4>商 家 图 标： </h4></td>-->
        <!--<td ><img src="../content/img/sqbrand.png"><input type="file" value=""></td>-->

      <!--</tr>-->
    </table>

  </div>



</div>
<div class="myp1s1right">

    <div id="map"></div>

    <div>

      <table class="table" style="width: 95% ">
        <tr>
          <td width="10%" style="border-style: none"><h4>地理位置：</h4></td>
          <td width="30%" style="border-style: none"><span  id="shopsite2" ></span></td>
        </tr>
        <tr>
          <td style="border-style: none"><h4>经度：</h4></td>
          <td style="border-style: none"><input type="text" class="form-control" name="shoplongitude" id="shoplongitude" value=<?php echo ($shop["shoplongitude"]); ?>></td>
        </tr>
        <tr>
          <td style="border-style: none"><h4>纬度：</h4></td>
          <td style="border-style: none"><input type="text" class="form-control" name="shoplatitude" id="shoplatitude" value=<?php echo ($shop["shoplatitude"]); ?>></td>
        </tr>
      </table>

    </div>
  </div>
<div style="clear: both"></div>
<div>
  <!-- 	<input type="hidden" name="sid"  id="sid" value=<?php echo ($shop["sid"]); ?>> -->
  	<input type="hidden" name="ajax" value="1">
  	<input type="hidden" name="agentId" id="agentId" value="">
    <input class="btn btn-lg " type="button" onClick="updateAgentInfo()" style="border-radius: 10px; margin-right: 60px; margin-top:50px; float:right" value="确定修改">
</div>
<div style="clear: both"></div>
</form>

   <script language="JavaScript">

   var x = 113.414091;
   var y = 23.065068;
   var shopname = '';
   var shopsite = '';
   
	ThinkAjax.send("<?php echo U('AgentMessage/showBasicMessage');?>",'ajax=1',completeBasicMsg,'');
	  
 function completeBasicMsg(data,status){

	 if(status==1){
		 $('agentname').value = data['agentname'];
		 $('agent').value = data['agent'];
		 $('agentContact').value = data['agentContact'];
		 $('agentAddress').value = data['agentAddress'];
		 $('agentNote').value = data['agentNote'];
		 $('shoplongitude').value = data['shoplongitude'];
		 $('shoplatitude').value = data['shoplatitude'];
/* 		 $('sid').value = data['sid'];*/
		 $('shopsite2').innerHTML = data['agentAddress']; 
		 $('agentId').value = data['agentId'];
		 
		 shopname = data['shopname'];
		 shopsite = data['shopsite'];
		 x = data['shoplongitude'];
		 y = data['shoplatitude'];
		 
		 
	 }

 }

    </script>

</body>

<script type="text/javascript">

 

  function baiduMap(){
    var mp = new BMap.Map('map',{minZoom:10,maxZoom:25});
    //创建map实例，传入标签id
    var a = x;
    var b = y;
    var point = new BMap.Point(a, b);
    mp.centerAndZoom(point, 15);
    // 初始化地图,设置中心点坐标和地图级别
    //			mp.addControl(new BMap.MapTypeControl());   //添加地图类型控件（显示地图/卫星/三维）
    mp.setCurrentCity("广州");          // 设置地图显示的城市 此项是必须设置的
    mp.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放

    var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺，每厘米实际多长的比例尺
    var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
    var top_right_navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}); //右上角，仅包含平移和缩放按钮

    /*缩放控件type有四种类型:
     BMAP_NAVIGATION_CONTROL_SMALL：仅包含平移和缩放按钮；
     BMAP_NAVIGATION_CONTROL_PAN:仅包含平移按钮；
     BMAP_NAVIGATION_CONTROL_ZOOM：仅包含缩放按钮*/

    mp.addControl(top_left_control);
    mp.addControl(top_left_navigation);
    //			mp.addControl(top_right_navigation);

    var marker = new BMap.Marker(point); // 创建点
    mp.addOverlay(marker);            //增加点
    marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画

    var opts = {
      width : 130,     // 信息窗口宽度
      height: 50,     // 信息窗口高度
      title : shopname  // 信息窗口标题


    };
    var infoWindow = new BMap.InfoWindow("地址： "+shopsite, opts);  // 创建信息窗口对象

    //	mp.openInfoWindow(infoWindow,point); //开启信息窗口
    marker.addEventListener("click", function(){
      mp.openInfoWindow(infoWindow,point); //开启信息窗口
  });
  }

  var url = "http://api.map.baidu.com/getscript?v=2.0&ak=8PvM7DYxxWm25zHO8v0mE3IZ&services=&t=20151020152414";
 // var url = "http://api.map.baidu.com/getscript?v=2.0&ak=密钥&services=&t=20151020152414";
  jq.getScript(url,function(response,status){
    console.log(status);
    if(status=="success"){
    	
    	 setTimeout(baiduMap, 1000);
    }
    if(status=="error"){
      jq("#map").text("百度地图加载失败");
    }
  });



</script>
</html>