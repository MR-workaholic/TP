<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    
    
    <style>
      *{
        margin: 0;
        padding: 0;
      }
      h3.choose{
        width: 800px;
        margin: 20px auto;
        /*border: 1px solid red;*/
      }
      div.routeSet input,div.routeSet select option,h3.choose select option{
        padding: 3px 10px 3px 10px;
      }
      .routeSet{
      width: 800px;
      margin: 0 auto;
      /*border: 1px solid red;*/
      }
      div.routeSet p{
      margin: 20px auto;
      /*border: 1px solid orange;*/
      }

      div.SSIDlist table{
      width: 500px;
      text-align: center;
      }
      div.SSIDlist table th{
      text-align: center;
      }
      div.SSIDlist table tr td{
        vertical-align: middle;
      }
      div.wirelessParameter table{
      width: 400px;
      }
      div.wirelessParameter table tr{
      padding: 10px;
      height: 30px;
      /*border: 1px solid yellow;*/
      }
      .routeSet .wirelessParameter{
      margin-top: 50px;
      /*border: 1px solid green;*/
      }
      div.MACadress table{
      width: 500px;
      text-align: center;
      }
      .MACadress{
      margin-top: 30px;
      }
      .submit{
      text-align: right;
      }
      div.submit input{
      margin-right: 20px;
      }
      div.upgrade span{
      margin-left: 20px;
      }

  </style>
  
  <script language="JavaScript">

	function updateRouteset()
	{
		
		ThinkAjax.sendForm('formRouteset',"<?php echo U('Routeset/Routesetmeschange');?>",Routesetinfoshow,'');
	}
	
	function Routesetinfoshow(data,status)
	{
		if(status==1)
		{
		 // 提示信息
		 //$('txtHint').innerHTML = data['a']+'hello '+data['c'];
			$('dssid').innerHTML = data['dssid'];
			$('power').value = data['power'];
			$('dsid').value = data['dsid'];
			$('did').value = data['did'];
			displaySelect(data['channel'], 'channel');
			displaySelect(data['wlmodel'], 'pattern');
			//displaySelect(data['bandwidth'], 'bandwidth');
	
		}
		
	
	}
	
	function setRouternamefun()
	{
		ThinkAjax.sendForm('routerBasicMes',"<?php echo U('Routeset/routerBasicMesChange');?>",completeRouterBasicMesChange,'');
	}
	
	function completeRouterBasicMesChange(data, status)
	{
		$('Routername').value = data['routerName'];
		$('rMac').value = data['dsid'];
		
	}
	
</script>
  
  
</head>
<body>

  <div id="equipmentlist"></div>
  
  
  <!-------路由器设置--------->
  <div class="routeSet">
  
  
  	  <!-- 基本信息设置 -->
  	  
  	  <p class="basicRouterSet">
  	    <form id="routerBasicMes">
  	  		设备名称:<input type="text" id="Routername" name="Routername"/>
  	  		<input type="hidden"  name="rMac" id='rMac' value=''>
  	  		<input type="hidden"  name="ajax" id='ajax' value=1>
            <input type="button" id="setRoutername" onclick="setRouternamefun()" value="修改[这里以及以下的信息都是20b0这台路由的]">
  	    </form>
  	  </p>
      <!-------无线网络使能--------->
      <p class="wifiEnable">
      	
       	   	 无线网络使能：<input id="wifiEnable" type="checkbox" name="wifiEnable"/>
       	
      </p>

      <!-------增加SSID--------->
      <p class="SSIDadd">
        SSID:<input type="text" id="SSIDname" name="SSIDname"/>
        <input type="button" id="addSSIDname" value="增加">
      </p>

      <!-------SSID列表--------->
      <div class="SSIDlist">
        <table class="table table-bordered">
          <tr><th>SSID名称</th><th>禁用</th><th>无线安全设置</th><th>隐藏</th><th>移除</th></tr>
          <tr><td id='dssid'></td>
            <td><input type="checkbox" id="forbidden" name="forbidden"/></td>
            <td><input type="button" id="modifyWsafe1" value="修改"/></td>
            <td><input type="checkbox" id="hidden" name="hidden"/></td>
            <td><input type="button" id="SSIDdelete1" name="SSIDdelete" value="移除"/></td></tr>
        </table>
      </div>

      <!-------无线参数--------->
    <form method="post" id="formRouteset" >
    
      <div class="wirelessParameter">
      
        <p>无线参数：</p>
        
      
        <table>
          <tr><td>信道：</td>
            <td>
              <select name="channel" id="channel">
                <option value="0">自动</option>
                <option value="1">信道l</option>
                <option value="2">信道2</option>
                <option value="3">信道3</option>
                <option value="4">信道4</option>
                <option value="5">信道5</option>
                <option value="6">信道6</option>
                <option value="7">信道7</option>
                <option value="8">信道8</option>
                <option value="9">信道9</option>
                <option value="10">信道l0</option>
                <option value="11">信道l1</option>
                <option value="12">信道l2</option></select>
            </td>
          </tr>
          <tr><td>模式：</td>
            <td>
              <select name="pattern" id="pattern">
                <option value="11b">11b</option>
                <option value="11g">11g</option>
                <option value="11n">11n</option>
                <option value="11ng">11ng</option>
               </select>
            </td>
          </tr>
          <!--
          <tr><td>频宽：</td>
            <td>
              <select name="bandwidth" id="bandwidth">
                <option value="1">20/40MHz</option>
                <option value="2">20MHz</option>
                <option value="3">40MHz</option>
              </select>
            </td>
          </tr>
            -->
          <tr>
              <td>无线功率：</td>
              <td><input type="text" id="power" name="power" >  dBm</td>
          </tr>
          
          <tr>
          	<td><input type="hidden"  name="dsid" id='dsid' value=''></td>
          	<td><input type="hidden"  name="did" id='did' value=''></td>
          	<td><input type="hidden"  name="ajax" id='ajax' value=1></td>
          </tr>
          
          <tr><td>WAN参数：</td></tr>
          
          <tr><td>上网模式：</td><td><strong id="mode"></strong></td></tr>
          
         
          <tr id="usr"></tr>
          <tr id="pwd"></tr>
          <tr id="ip"></tr>
          <tr id="nm"></tr>
          <tr id="gw"></tr>
          <tr id="dns1"></tr>
          <tr id="dns2"></tr>
          		
          
         
       
        </table>
      
      </div>
     </form>
      <!-------MAC地址过滤--------->
      <div class="MACadress">
        <p>MAC地址过滤：<input type="button" id="addMACadress" value="增加MAC地址"/></p>
        <table class="table table-bordered">
          <tr><td>MAC地址</td><td>规则</td></tr>
          <tr><td></td><td>
            <input id="MACforbidden" type="radio" name="MACrule" value="disable"/>禁用&nbsp;&nbsp;
            <input id="MACwhite" type="radio" name="MACrule" value="whiteList"/>白名单&nbsp;&nbsp;
            <input id="blackList" type="radio" name="MACrule" value="blackList"/>黑名单&nbsp;&nbsp;
          </td></tr>
        </table>
      </div>

      <!-------提交信息按钮--------->
      <div class="submit">
        <input id="submit" type="button" onClick="updateRouteset()" value="修改信息"/>
        <input id="applicationAll" type="button" value="应用到所有设备"/>
        <input id="cancel" type="button" value="取消"/>
      </div>

      <!-------升级--------->
      <div class="upgrade">
        <p>现版本号：<strong id="version"></strong> <span>最新版本：<strong id="newVersion"></strong></span></p>
        <input id="upgrade" type="button" value=" 升 级 "/>
      </div>
  </div>



<!--JS代码-->
<script>
//  var jq=jQuery.noConflict();
var i=2;
var security_mod;

//点击增加MAC地址
var objTable=jq("div.MACadress table");
  jq("#addMACadress").on("click",function(){
    var addTr='<tr><td></td><td> <input type="radio" name="MACrule" value="disable"/>禁用&nbsp;&nbsp; <input type="radio" name="MACrule" value="whiteList"/>白名单&nbsp;&nbsp; <input type="radio" name="MACrule" value="blackList"/>黑名单&nbsp;&nbsp; </td></tr>';
    objTable.append(addTr);
  });


//  点击SSID列表“增加”及“修改”响应
    function SSIDlistClick(){

        //点击“增加SSID名称按钮”
        jq("#addSSIDname").on("click",function(){
        var str=jq("#SSIDname").val();
        var addTr='<tr><td>'+str+'</td><td><input type="checkbox" id="forbidden" name="forbidden"/></td><td><input type="button" id="modifyWsafe'+i+'" name="forbidden" value="修改"/></td><td><input type="checkbox" id="hidden" name="hidden"/></td> <td><input type="button" id="SSIDdelete'+i+'" name="SSIDdelete" value="移除"/></td></tr>';
        jq("div.SSIDlist>table ").append(addTr);

          //点击“修改按钮”
            jq("#"+"modifyWsafe"+i).click(function(){
//              alert(jq(this).attr("id"));
              window.open("SSIDset","","width=350,height=350,top=350,left=700,resizable=no");
            });
            //点击“移除”
            jq("#"+"SSIDdelete"+i).click(function(){
//              alert(jq(this).attr("id"));
              jq(this).parents("tr").remove();
              if(jq(this).parents("table").children("tr").length==0){
//                alert("oh no");
                i=1;
              }
            });
            i++;
      });

        //第一次点击“修改"（未点击“添加”）
        jq("#modifyWsafe1").click(function(){
          window.open(security_mod,"","width=350,height=350,top=350,left=700,resizable=no");
        });
        
         //第一次点击“SSID”移除按钮（未点击“添加”）
        jq("#SSIDdelete1").click(function(){
//          alert("he");
          jq(this).closest("tr").remove();
          if(jq(this).parents("table").children("tr").length==0){
            i=1;
          }
        });
    }

    SSIDlistClick();






  //点击“禁用”按钮
    jq("p.wifiEnable input").on("click",function(){
      //获取“无线网络使能复选框”的值~~true or false.
      var flag=jq(this)[0].checked;
//      alert(flag);
      if(!flag){
        jq("p.SSIDadd>input,table input[id],div.MACadress p>input,div.wirelessParameter select").attr("disabled","isDisabled");
      }
      if(flag){
      	jq("p.SSIDadd>input,table input[id],div.MACadress p>input,div.wirelessParameter select").removeAttr("disabled");
      }
    })
</script>


   <script language="JavaScript">

	ThinkAjax.send("<?php echo U('Routeset/routesetmescalling');?>",'ajax=1&calling='+'y',completeroutesetmescalling,'');
	
	function completeroutesetmescalling(data,status)
	{
		if(status!=0)
		{
		 var routesetlist = "<h3 class=\"choose\">请选择您的路由器设备：<select name=\"equipment\" onchange=\"showrousetmes(this.value);\" >";
			                               
			 for(var i=0; i<status; i++)
      	   {
				 routesetlist += "<option value="+data[i]['dname']+">"+data[i]['dname']+"</option>";
      	   }
			 
			 routesetlist += "</select></h3>";   
			
			  $('equipmentlist').innerHTML = routesetlist;
			  showrousetmes(data[0]['dname']);
		}
		else
			{
			  $('equipmentlist').innerHTML = "<h3 class=\"choose\">请购买属于您的路由器设备</h3>";
			  jq('.routeSet').hide();
			}
	}
	
	function showrousetmes(value){
		ThinkAjax.send("<?php echo U('Routeset/showrousetmescalling');?>",'ajax=1&whichrou='+value,showrousetmescalling,'');
	}
	
	function showrousetmescalling(data, status){
		
		if(status == 1)
			{
			  security_mod = "../Routeset/SSIDset/mac/"+data['mac']; 
			  $('dssid').innerHTML = data['dssid'];
			  $('power').value = data['power'];
			  $('Routername').value = data['routerName'];
			  $('dsid').value = data['dsid'];
			  $('rMac').value = data['dsid'];
			  $('did').value = data['did'];
			  $('version').innerHTML = data['version'];
			  $('newVersion').innerHTML = data['newVersion'];
			  displaySelect(data['channel'], 'channel');
			  displaySelect(data['wlmodel'], 'pattern');
			 // displaySelect(data['bandwidth'], 'bandwidth');
			 
			  $('mode').innerHTML = data['mode'];

			  if(data['mode'] == 'pppoe')
				  {
				  	$('usr').innerHTML = "<td>拨号用户名：</td><td><strong>"+data['ppoe_usr']+"</strong></td>";
				  	$('pwd').innerHTML = "<td>拨号密码：   </td><td><strong>"+data['ppoe_pwd']+"</strong></td>";	
				  	jq("#ip").hide();
				  	jq("#nm").hide();
				  	jq("#gw").hide();
				  	jq("#dns1").hide();
				  	jq("#dns2").hide();
				  }else if(data['mode'] == 'static')
					  {
					  	jq("#usr").hide();
					  	jq("#pwd").hide();
					  	$('ip').innerHTML = "<td>静态IP地址：</td><td><strong>"+data['static_ip']+"</strong></td>";
					  	$('nm').innerHTML = "<td>子网掩码：</td><td><strong>"+data['static_nm']+"</strong></td>";
					  	$('gw').innerHTML = "<td>默认网关：</td><td><strong>"+data['static_gw']+"</strong></td>";
					  	$('dns1').innerHTML = "<td>首选DNS：</td><td><strong>"+data['static_dns1']+"</strong></td>";
					  	$('dhs2').innerHTML = "<td>备用DNS：</td><td><strong>"+data['static_dns2']+"</strong></td>";
					  
					  }
			  
			  
			  
			  
			  
			  var boxes = document.getElementsByName('wifiEnable');
			 
			  if(data['enable'] == 1)
				  {
				  	boxes[0].checked = true;
				  }else{
					boxes[0].checked = false; 
				  }
			  
			}
		
	}
	
	
	
</script>

</body>
</html>