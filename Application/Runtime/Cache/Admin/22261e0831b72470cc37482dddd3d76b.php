<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
   
    <style>
      .mobileLogin{
        width: 800px;
        /*border: 1px solid red;*/
      }
      div.mobileLogin div.my-arrow+div span{
        margin-top: 20px;
        margin-right: 10px;
        /*border: 1px solid yellow;*/
      }
      div.mobileLogin div.my-arrow+div{
        margin: 20px auto;
      }
      /*-----手机开启-----*/
      div.mobileOpen,div.mobileLogin>div:nth-child(2),div.mobileLogin>div:last-child{
        width: 760px;
        margin: 20px;
        /*border: 1px solid green;*/
      }
      div.mobileOpen ul li{
        /*border: 1px solid blue;*/
        width: 500px;
        margin-left: 60px;
        margin-bottom: 5px;
      }
      div.mobileOpen li:nth-child(2){
        color: red;
      }
      div.mobileOpen li:nth-child(3) textarea{
        resize: none;
      }
      div.mobileOpen li:last-child{
        text-align: right;
      }
      div.mobileOpen+div{
        text-align: right;
        margin:10px;
      }
      div.mobileOpen+div input{
        margin-right: 30px;
      }

      /*------------带向上箭头框的样式---------------------*/
      .my-popover {
        display: block;
        margin: 12px auto 0 auto;
        /*border: 1px solid deeppink;*/

        position: relative;
        top: -64px;
        left: 0;
        z-index: 1010;
        /*display: none;*/
        width: 800px;
        /*padding: 20px;*/
        text-align: left;
        white-space: normal;
        background-color: #fff;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        border: 1px solid #ccc;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 4px;
        -webkit-box-shadow: 0 2px 25px rgba(0, 0, 0, .2);
        box-shadow: 0 2px 25px rgba(0, 0, 0, .2);
      }
      .my-popover .my-arrow, .my-popover .my-arrow:after {
        position: absolute;
        display: block;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
      }

      .my-popover .my-arrow {
        border-width: 11px;
      }

      .my-popover .my-arrow:after {
        content: "";
        border-width: 10px;
      }
      .my-popover.my-bottom .my-arrow {
        top: -11px;
        border-top-width: 0;
        border-bottom-color: #999;
        border-bottom-color: rgba(0, 0, 0, .25);
      }
      .my-arrow-left{
        left: 18%;
        margin-left: -10px;
      }
      .my-popover.my-bottom .my-arrow:after {
        top: 2px;
        margin-left: -9px;
        content: " ";
        border-top-width: 0;
        border-bottom-color: #fff;
      }
    </style>
    <script type="text/javascript">
    
     function updatamobileopen(){
    	 
    	 ThinkAjax.sendForm('idmobileopen',"<?php echo U('Authentication/updatamobileopen');?>",completeupdatamobileopen,'');
    	 
     }
     
     function completeupdatamobileopen(data, status)
     {
    	 if(status==1)
		  {
		     $('paid').value = data['paid'];
		     $('uid').value = data['uid'];
		     if(data['status']==0)
		    	 {
		    	 	document.mobileopen.mobileLogin[1].checked=true;
		    	 	 jq(".mobileOpen").hide();
		    	 	$('mobileMessage').value = data['content'];
		    	 }else
		    		 {
		    		 	document.mobileopen.mobileLogin[0].checked=true;
		    		 	 jq(".mobileOpen").show();
		    		 	$('mobileMessage').value = data['content'];
		    		 }
		  } 
     }
    
    
    </script>
</head>
<body>
<form name='mobileopen' id='idmobileopen'>
<div class="mobileLogin my-popover my-bottom" >
  <div class="my-arrow my-arrow-left"></div>
  <div>
    <span>状态：</span>
    <span><input type="radio" id="mobileOpen" name="mobileLogin" value='1' checked="checked"/><label> 开启</label></span>
    <span><input type="radio" id="mobileOff" name="mobileLogin" value='0' /><label> 关闭</label></span>
  </div>
  <div class="mobileOpen">
      <p>短信审核状态：正常</p>
      <ul class="nav">短信文案：
        <li>（红色字为固定文案。请不要添加带有营销性质的文案，如：本店优惠大酬宾，满600减100，可能会导致短信发送失败。）</li>
        <li>验证码：XXX</li>
        <li><textarea cols="65" rows="2" placeholder="凭本手机号和验证码可登录此处免费Wi-Fi！" name="mobileMessage" id="mobileMessage"></textarea></li>
        <li><span>还可以输入23个字</span></li>
      </ul>
  </div>
  <div>
    <input type="hidden" id='paid' name='paid' value='' >
    <input type="hidden" id='uid' name='uid' value='' >
    <input type="button" class="btn" id="mobile-confirm"  onClick='updatamobileopen()' value="确定"/>
    <input type="button" class="btn" id="mobile-cancel" value="取消"/>
  </div>

</div>
</form>

<script type="text/javascript">


  ThinkAjax.send("<?php echo U('Authentication/phonesigninmescalling');?>",'ajax=1&uid='+'<?php echo ($uid); ?>',completephonesigninmescalling,'')

  function completephonesigninmescalling(data, status)
  {
	  if(status==1)
		  {
		     $('paid').value = data['paid'];
		     $('uid').value = data['uid'];
		     if(data['status']==0)
		    	 {
		    	 	document.mobileopen.mobileLogin[1].checked=true;
		    	 	 jq(".mobileOpen").hide();
		    	 	$('mobileMessage').value = data['content'];
		    	 }else
		    		 {
		    		 	document.mobileopen.mobileLogin[0].checked=true;
		    		 	 jq(".mobileOpen").show();
		    		 	 $('mobileMessage').value = data['content'];
		    		 }
		  }
  }

</script>

<script>
  var jq=jQuery.noConflict();
  //点击“开启手机”
  jq("#mobileOpen").click(function(){
    jq(".mobileOpen").show();
  });

  //点击“关闭手机”
  jq("#mobileOff").click(function(){
    jq(".mobileOpen").hide();
  });

  //点击“取消”
  jq("#mobile-cancel").click(function(){
    jq(".mobileLogin").hide();
  })
</script>
</body>
</html>