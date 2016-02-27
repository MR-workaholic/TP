<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <title></title>

    <style>
      .oneclickLogin1 {
        width: 800px;
        padding-left : 20px;
        margin-top: 30px;

        border: 1px solid #ddd;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05)

      }

      div.oneclickLogin1 ul{
        /*border: 1px solid orange;*/
        margin-right: 20px;

      }
      div.oneclickLogin1 ul span{
        /*border: 1px solid orange;*/
        display: inline-block;
        width:110px;
      }
      div.oneclickLogin1 ul li{
        /*border: 1px solid greenyellow;*/
        height: 40px;
        line-height: 26px;

      }
      div.oneclickLogin1 ul input{
        width: 60px;
        text-align: left;
      }
      div.oneclickLogin1 ul label{
        margin-left: 10px;
        margin-right: 10px;
      }
      #adSeconds{
        margin-left: 30px;
      }
      div.oneclickLogin1 ul p{
        background-color: #DDDDDD;
        width: 300px;
        float: right;
        border-radius: 3px;
        padding: 10px;
      }
      div.oneclickLogin1 div{
        text-align: right;
        padding: 20px;
        /*border: 1px solid red;*/
      }
    </style>
    
    <script language="JavaScript">
    
    function updataoneClickLogin()
    {
    	ThinkAjax.sendForm('idoneclickLogin',"<?php echo U('Authentication/updataoneClickLogin');?>",completeupdataoneClickLogin,'');
    }
    
    function completeupdataoneClickLogin()
    {
    	
    }
    
    </script>
    
</head>
<body>

 <form name="oneclickLogin" method="post" id="idoneclickLogin">
    <div class="oneclickLogin1">
   
    
      <h3>认证基本设置</h3>
      <ul class="nav">
      
        <li><span>WIFI认证有效期：</span>
        
<!--  -->  <input type="radio" id="wifiTime1"  name="wifiTime" value="0" > 
          <input type="text" id="wifiEffectiveHour" name="wifiEffectiveHour" >
          <label for="wifiEffectiveHour">小时(0~23的整数)</label>
          <input type="text" id="wifiEffectiveMinute" name="wifiEffectiveMinute" >
          <label for="wifiEffectiveMinute">分钟(0~59的整数)</label>
          <p>注：连网时间超出认证有效期后需再次认证才能上网。已通过认证的顾客想要重新设置WIFI认证有效期，需在前一次认证有限期结束后才有效。</p>
        </li>
        
      <!-- -->    <li><span></span><input type="radio" id="wifiTime2" name="wifiTime" value="86400" ><label>时长不限</label></li>  
        
        <li>
            <span>广告显示时长：</span>
            <input type="text" id="adSeconds" name="adseconds" >
            <label for="adSeconds">秒(0~59的整数)</label>
        </li>
        
         
        <li><span>老用户免认证：</span>
        <input type="checkbox" id="oldCustomeFreeA" onclick="javascript:document.getElementById('oldCustomeFreeA_value').value=this.checked?1:0;" >
        <input type="hidden" id="oldCustomeFreeA_value" name="freeAuthentication" value=''>
          <label for="oldCustomeFreeA">启用</label>
          <p>注：首次完成认证的用户，再次连网无需认证，仅展示登录完成页和商家主页</p>
        </li>
         
     
        <li>
            <span>认证次数限制：</span>
          <!-- -->    <input type="radio"  id="NumberofTime1" name="wifiNumber" value="0" >    
            <input type="text" id="authenticationNumber" name='authenticationNumber' />
            <label for="authenticationNumber">次数（仅支持1－5次）</label>
        </li>
        <!--  -->
        <li>
            <span></span>
            <input type="radio" name="wifiNumber" id="NumberofTime2" value="10" >
            <label for="NumberofTime2">次数不限</label>
        </li>
        
      </ul>
      
      <div>
      	<input type="hidden"  name="auid" id='auid' value=''>
      	<input type="hidden"  name="uid" id='uid' value=''>
        <input type="button" class="btn" name="confirmOneclick" onClick="updataoneClickLogin()" value="确定" >
      </div>
      
 
    </div>
   </form>
    <script type="text/javascript">
    
    var oldCustomeFreeA = document.getElementById('oldCustomeFreeA');
    
	ThinkAjax.send("<?php echo U('Authentication/oneclickloginmescalling');?>",'ajax=1&calling='+'y',completeoneclickloginmescalling,'');
	
	function completeoneclickloginmescalling(data,status)
	{
		if(status==1)
			{
			 
			$('adSeconds').value = data['adseconds'];
			$('auid').value = data['auid'];
			$('uid').value = data['uid'];
			   
			   if(data['freeauthentication']==1)
				   {
				    
				    oldCustomeFreeA.checked = true;
				    $('oldCustomeFreeA_value').value = 1;
				   }else
					   {
					   $('oldCustomeFreeA_value').value = 0;
					   }
			   
			   if(data['wifitime'] == 86400)
			   {
			   document.oneclickLogin.wifiTime[1].checked=true;
		
			   }else
				   {
				   console.log('happy');
				   document.oneclickLogin.wifiTime[0].checked=true;
				   jq("#wifiEffectiveHour,#wifiEffectiveMinute").removeAttr("disabled");
				   $('wifiEffectiveHour').value = data['wifitime'] / 3600;
				   $('wifiEffectiveMinute').value = data['wifitime'] % 3600 / 60;
				   
				   }
			   
			   
			  
			   
			   if(data['wifinumber'] == 10)
				   {
				   document.oneclickLogin.wifiNumber[1].checked=true;
				   
				   }else
					   {
					   document.oneclickLogin.wifiNumber[0].checked=true;
					   jq("#authenticationNumber").removeAttr("disabled");
					   $('authenticationNumber').value = data['wifinumber'];
					   }
			   
			 
			   
			  
			   
			   
			 
			}
	}
    
    
    </script>
    
    <script>
//    var jq=jQuery.noConflict();
//  初始化
    jq("#wifiEffectiveHour,#wifiEffectiveMinute").attr("disabled","isDisabled");
    jq("#authenticationNumber").attr("disabled","isDisabled");
    //点击“WIFI认证有效期”选择时长不限时，另一项禁用小时和分钟
    jq("#wifiTime1").on("click",function(){
        jq("#wifiEffectiveHour,#wifiEffectiveMinute").removeAttr("disabled");
    });
    jq("#wifiTime2").on("click",function(){
        jq("#wifiEffectiveHour,#wifiEffectiveMinute").attr("disabled","isDisabled");
      });
    //点击“认证次数限制”选择时长不限时，另一项禁用次数
    jq("#NumberofTime1").on("click",function(){
      jq("#authenticationNumber").removeAttr("disabled");
    });
    jq("#NumberofTime2").on("click",function(){
      jq("#authenticationNumber").attr("disabled","isDisabled");
    });

    //  验证“WIFI认证有效期”的小时和分钟,objinput为待验证的表单，re为匹配的正则表达式，str为弹出的提示语句
    function validate(objinput,re,str){
      objinput.blur(function(){
        var obj=jq(this).val();
        if(!(re.test(obj))){
          alert(str);
        }
      });
    }
    validate(jq("#wifiEffectiveHour"),/^([01]?\d|2[0-3])$/,"小时数为0~23的整数");
    validate(jq("#wifiEffectiveMinute"),/^[0-5]?\d$/,"分钟数为0~59的整数");
    validate(jq("#authenticationNumber"),/^[1-6]{1}$/,"仅支持1－6次");
    validate(jq("#adSeconds"),/^[0-5]?\d$/,"秒数为0~59的整数");


</script>

</body>
</html>