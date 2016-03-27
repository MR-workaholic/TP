<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
   <title></title>

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
        padding-left:4%;
        padding-top: 3%;
       /* border: 1px solid cyan;*/
      }
      div.myp1s1left>div{
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
    
    <!--  -->
    <script language="JavaScript">

	function updateshopinfo()
	{
		
		ThinkAjax.sendForm('form1',"<?php echo U('Merchant/shopmeschange');?>",shopinfoshow,'');
	}
	
	function shopinfoshow(data,status)
	{
		if(status==1)
		{
		 // 提示信息
		 //$('txtHint').innerHTML = data['a']+'hello '+data['c']; 
		 $('shopname').value = data['shopname'];
		 $('shopphone').value = data['shopphone'];
		 $('shopwebsite').value = data['shopwebsite'];
		 $('shopremark').value = data['shopremark'];
		 $('shopman').value = data['shopman'];
		 $('shopsite').value = data['shopsite'];
		 $('shoplongitude').value = data['shoplongitude'];
		 $('shoplatitude').value = data['shoplatitude'];
		 $('sid').value = data['sid'];
		 $('shopsite2').innerHTML = data['shopsite'];
		 displaySelect(data['shopstyle'],"shopstyle");
		 
		 shopname = data['shopname'];
		 shopsite = data['shopsite'];
		 x = data['shoplongitude'];
		 y = data['shoplatitude'];
		 
		 baiduMap();
		 
		 
		 
		 
		}
	}
	
</script>
    
    
</head>
<body>
<form name="form1" method="post" id="form1" action="<?php echo U('Merchant/shopmeschange');?>" >
<div class="myp1s1left">

     
	
  		<div>

    <table class="table-fixed" style=" width:90%;margin-top: 0;">
    
      <tr >
        <td style="width: 20%; "><h4>商 家 名 称： </h4></td>
        <td style="width: 65%; ">
        	<input type="text" class="form-control" name="shopname" id="shopname" value=<?php echo ($shop["shopname"]); ?>>
        </td>
      </tr>
      <tr>
        <td ><h4>联 系 方 式： </h4></td>
        <td><input type="text" class="form-control" name="shopphone" id="shopphone" value=<?php echo ($shop["shopphone"]); ?>></td>
      </tr>
      <tr>
        <td ><h4>商 家 类 型： </h4></td>
        <td>
        <!-- 
          <input type="text" class="form-control" name="shopstyle" value=<?php echo ($shop["shopstyle"]); ?>>
         -->
         
         <select class="form-control" name="shopstyle" id="shopstyle">
            <option value='餐饮业'>餐饮业</option>
            <option value='零售业'>零售业</option>
            <option value='酒店'>酒店</option>
            <option value='公司企业'>公司企业</option>
            
         </select>
         
         
         
        </td>
      </tr>
      <tr>
        <td ><h4>商 家 主 页： </h4></td>
        <td><input type="text" class="form-control" name="shopwebsite" id="shopwebsite" value=<?php echo ($shop["shopwebsite"]); ?>></td>
      </tr>
      <tr>
        <td ><h4>备 注 信 息： </h4></td>
        <td><textarea rows="3" class="form-control" name="shopremark" id="shopremark" style="resize: none;"><?php echo ($shop["shopremark"]); ?></textarea></td>
      </tr>
      <tr>
        <td ><h4>负 责 人： </h4></td>
        <td><input type="text" class="form-control" name="shopman" id="shopman" value=<?php echo ($shop["shopman"]); ?>></td>
      </tr>
      <tr>
        <td ><h4>商 铺 地 址： </h4></td>
        <td ><input type="text" class="form-control" name="shopsite"  id="shopsite" value=<?php echo ($shop["shopsite"]); ?>></td>
      </tr>
      <!-- 
      <tr>
        <td ><h4>商 家 图 标： </h4></td>
        <td style="text-align:left">
        <img src="/TP/Application/Admin/UserFile/<?php echo ($valid_user); ?>/sqbrand.png" >
        
       
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input  name="userfile" type="file" id="userfile">
        <input type="submit" value="Send File">
        
        
        </td>
	  </tr>
	   -->
     
    </table>

  	</div>

  	

</div>
<div class="myp1s1right">

    <div id="map" style="border:1px blue solid"></div>

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
  	<input type="hidden" name="sid"  id="sid" value=<?php echo ($shop["sid"]); ?>>
  	<input type="hidden" name="ajax" value="1">
    <input class="btn btn-lg " type="button" onClick="updateshopinfo()" style="border-radius: 10px; margin-right: 60px; margin-top:50px; float:right" value="确定修改">
</div>
<div style="clear: both"></div>  	


 </form>
 <!--   -->
 <script language="JavaScript">

 
    var x = 113.414091;
    var y = 23.065068;
    var shopname = '';
    var shopsite = '';
 
	ThinkAjax.send("<?php echo U('Merchant/shopmescalling');?>",'ajax=1&calling='+'y',complete2,'');
	
	function complete2(data,status)
	{
		if(status==1)
		{
		 // 提示信息
		 //$('txtHint').innerHTML = data['a']+'hello '+data['c'];
		 $('shopname').value = data['shopname'];
		 $('shopphone').value = data['shopphone'];
		 $('shopwebsite').value = data['shopwebsite'];
		 $('shopremark').value = data['shopremark'];
		 $('shopman').value = data['shopman'];
		 $('shopsite').value = data['shopsite'];
		 $('shoplongitude').value = data['shoplongitude'];
		 $('shoplatitude').value = data['shoplatitude'];
		 $('sid').value = data['sid'];
		 $('shopsite2').innerHTML = data['shopsite'];
		 displaySelect(data['shopstyle'],"shopstyle");
		 shopname = data['shopname'];
		 shopsite = data['shopsite'];
		 x = data['shoplongitude'];
		 y = data['shoplatitude'];
		 
		
		 
		}
	}
	
	
	
	function displaySelect(optionValue,id){
		
			var all_options = document.getElementById(id).options;
			
			for (i=0; i<all_options.length; i++){
				
				if (all_options[i].value == optionValue) // 根据option标签的ID来进行判断 测试的代码这里是两个等号
					{
						all_options[i].selected = true;
					}
				}
		};
	
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