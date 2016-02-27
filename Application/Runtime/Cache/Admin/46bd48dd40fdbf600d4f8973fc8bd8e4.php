<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    
    <style>
      .wechatLogin{
        width: 800px;
      }
      div.wechatLogin div:last-child{
        text-align: right;
        margin: 20px auto;
      }
      div.wechatLogin div.my-arrow+div{
        margin: 20px;
        /*border: 1px solid red;*/
      }
      div.wechatLogin div.my-arrow+div span{
        margin-right: 10px;
      }
      div.wechatLogin div:last-child input{
        margin-right: 30px;
      }
      /*------------微信认证---------------------*/
      .weChatAuthen,.wechatLianWifi{
        width: 760px;
        margin:20px;
      }
      div.weChatAuthen ul{
        margin-top: 20px;
      }
      div.weChatAuthen ul li,div.wechatLianWifi ul li{
        height:43px;
        line-height: 26px;
      }
      div.weChatAuthen ul:first-child span{
        display: inline-block;
        width: 120px;
      }
      div.weChatAuthen ul:first-child p{
        float: right;
        margin-right: 150px;
      }
      div.weChatAuthen ul li input{
        margin-left: 20px;
      }
      div.weChatAuthen ul:nth-child(2)>li+li span{
        display: inline-block;
        width: 120px;
        text-align: right;
      }

      /*------------微信连wifi---------------------*/

      div.wechatLianWifi ul{
        margin-top: 20px;
      }

      div.wechatLianWifi ul li span{
        display: inline-block;
        /*border: 1px solid yellow;*/
        width: 100px;
        text-align: right;
      }
      div.wechatLianWifi ul li a{
        width: 90px;
        float: right;
        margin-right: 100px;
        text-align: center;
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
      .my-arrow-center{
        left: 50%;
        margin-left: -12px;
      }
      .my-popover.my-bottom .my-arrow:after {
        top: 2px;
        margin-left: -9px;
        content: " ";
        border-top-width: 0;
        border-bottom-color: #fff;
      }
    </style>
</head>
<body>
<div class="wechatLogin my-popover my-bottom">
  <div class="my-arrow my-arrow-center"></div>
  <div>
    <span>状态：</span>
    <span><input type="radio" checked="checked" id="weChatAuthen" name="wechatLogin"/><label> 微信认证</label></span>
    <span><input type="radio" id="wechatLianWifi" name="wechatLogin"/><label> 微信连Wi-Fi</label></span>
    <span><input type="radio" id="wechatOff" name="wechatLogin"/><label> 关闭</label></span>
  </div>

  <!--微信认证 -->
  <div class="weChatAuthen">
    <ul class="nav">
      <li><span>公众号的微信号：</span><input type="text" name="wechatNumber"/></li>
      <li><span>微信粉丝放行：</span><input type="radio" name="funsRelease" value="no"/><label>否</label>
        <input type="radio" name="funsRelease" value="yes"/><label>是</label>
        <p>已经关注您微信公众号的用户可以连接网络直接上网</p></li>
      <li><span>是否弹认证页：</span><input type="radio" name="playAuthenPage" value="no"/><label>否</label>
        <input type="radio" name="playAuthenPage" value="yes"/><label>是</label>
        <p>如果您还设置了除微信以外其他认证方式，请选择“是”</p></li>
      <li><span>微信内链接登录：</span><input type="checkbox" name="innerLinkLogin"/><label>用于公众号点击上网</label></li>
      <li><span>启用关注即上网：</span><input type="checkbox" name="twoDimensional"/><label>建议线下准备公众号二维码供用户扫一扫</label></li>
      <li><span>已有微网站：</span><input type="radio" name="microSet" value="no"/><label>否</label>
        <input type="radio" name="microSet" value="yes"/><label>是</label><input type="button" name="testURL/Token" class="btn" value="测试URL/Token"/></li>
    </ul>
    <ul class="nav">
      <li><span>请将以下参数填到微信公众账号后台 填入“开发者中心 ——>服务器配置</span><input type="button" class="btn" value="打开公众号后台"/></li>
      <li><span>URL：</span><input type="text" name="URL"/><input type="button" class="btn" value="复制"/></li>
      <li><span>Token：</span><input type="text" name="Token"/><input type="button" class="btn" value="复制"/></li>
    </ul>
  </div>

  <!-- 微信连wifi-->
  <div class="wechatLianWifi" style="display: none">
    <ul class="nav">
      <li>请先按照“微信Wi-Fi设置教程”步骤，进入 打开公众号后台 完成微信设置<a href="javascript:">设置教程</a></li>
      <li><span>SSID：</span><input type="text" name="SSID"/></li>
      <li><span>shopId：</span><input type="text" name="shopId"/></li>
      <li><span>appId：</span><input type="text" name="appId"/></li>
      <li><span>secretKey：</span><input type="text" name="secretKey"/></li>
      <li>提示：appID、shopID、secretkey均来源于“微信公众平台--微信连Wi-Fi--设备管理--查看开发者凭证”。</li>
    </ul>
  </div>

  <div><input type="button" class="btn" id="wechat-confirm" value="确定"/><input type="button" class="btn" id="wechat-cancel" value="取消"/></div>
</div>
<script>

  var jq=jQuery.noConflict();
  //点击“微信认证”
  jq("#weChatAuthen").click(function(){
    jq(".weChatAuthen").show();
    jq(".wechatLianWifi").hide();
  });

  //点击“微信连Wi-Fi”
  jq("#wechatLianWifi").click(function(){
    jq(".wechatLianWifi").show();
    jq(".weChatAuthen").hide();
  });

  //点击“关闭”
  jq("#wechatOff").click(function(){
    jq(".wechatLianWifi").hide();
    jq(".weChatAuthen").hide();
  });

  //点击“取消”
  jq("#wechat-cancel").click(function(){
    jq(".wechatLogin").hide();
  })
</script>
</body>
</html>