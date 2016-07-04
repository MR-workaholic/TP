<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    
    <style>
      .signin{
        width: 800px;
        /*border: 1px solid cyan;*/
        margin-top: 20px;
        height: 300px;
      }
      /*---------一键登录和账号登录的面板样式-----------*/
      section{
        position: relative;
        padding: 20px;
        border: 1px solid #ddd;
        overflow: hidden;
        -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .5);
        box-shadow: 0 1px 3px rgba(0, 0, 0, .5);
      }
      .panel{
        padding-top: 20px;
        float: left;
        margin-right:41px;
        margin-left:41px;
        width: 170px;
        height: 230px;
        text-align: center;
      }
      div.panel p{
        margin: 10px;
      }

      /*------------手机登录-----------------*/
      .login {
        /*width: 800px;*/
        /*margin: 0 auto;*/
      }

    </style>
</head>
<body>
<div class="signin" style="">
  <!-- 账户登录的三种方式-->
  <section>
    <div class="panel">
    <?php if(($imgPath) == "0"): ?><img src="/tp/public/merchant/img/phone.png"/>
      <?php else: ?>
      	<img src="/<?php echo ($host); ?>/tp/public/merchant/img/phone.png"/><?php endif; ?>
      <p>手机登录</p>
      <p>已开启</p>
      <button id="mobileSet" class="btn" href="javascript:">设置</button>
    </div>
    <div class="panel">
      <?php if(($imgPath) == "0"): ?><img src="/tp/public/merchant/img/weixin.png"/>
      <?php else: ?>
      	<img src="/<?php echo ($host); ?>/tp/public/merchant/img/weixin.png"/><?php endif; ?>
      
      <p>微信登录</p>
      <p>已开启</p>
      <button id="wechatSet" class="btn" href="javascript:">设置</button>
    </div>
    <div class="panel">
       <?php if(($imgPath) == "0"): ?><img src="/tp/public/merchant/img/qq.png"/>
      <?php else: ?>
      	<img src="/<?php echo ($host); ?>/tp/public/merchant/img/qq.png"/><?php endif; ?>
      <p>QQ登录</p>
      <p>已开启</p>
      <button id="qqSet" class="btn" href="javascript:">设置</button>
    </div>
  </section>

  <!--<div class="mobileLogin" style="display: none"></div>-->
  <!--<div class="wechatLogin" style="display: none"></div>-->

</div>

<script>
  var jq=jQuery.noConflict();
  //加载“手机登录”和"微信登录",objdiv就指待加载内容的div，url是指所加载的页面url
  function way(objdiv,url){
    objdiv.load(url,function(a,status,c){
      console.log(status);
      if(status=="error"){
        objdiv.text("加载失败");
      }
    })
  }

//  变量是为了如重复点击“手机设置”时能移除之前加载的手机设置div
  var flag1= 0,flag2=0;

  //点击“手机设置”
  jq("#mobileSet").click(function(){

    if(flag1==1){
      jq(".mobileLogin1").remove();
      flag1=0;
    }
//    alert(jq(".signin").children("div").length);
    var obj1='<div class="mobileLogin1"></div>';
    jq(".signin").append(obj1);
//    alert(jq(".signin").children("div").length);
    way(jq(".mobileLogin1"),"../Authentication/mobileOpen");
    jq(".wechatLogin1").remove();
    flag1=1;
    flag2=0;
//    alert(jq(".signin").children("div").length);
  });
//  点击“微信设置”
  jq("#wechatSet").click(function(){
    if(flag2==1){
      jq(".wechatLogin1").remove();
      flag2=0;
    }
//    alert(jq(".signin").children("div").length);
    var obj2='<div class="wechatLogin1"></div>';
    jq(".signin").append(obj2);
    flag2=1;
    flag1=0;
//    alert(jq(".signin").children("div").length);
    way(jq(".wechatLogin1"),"../Authentication/wechatLogin");
    jq(".mobileLogin1").remove();
//    alert(jq(".signin").children("div").length);
  });


</script>
</body>
</html>