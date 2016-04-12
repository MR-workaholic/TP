<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册页面</title>
   
    <link  rel="stylesheet" type="text/css" href="/TP/Public/dist/css/signin.css">
    <link  rel="stylesheet" type="text/css" href="/TP/Public/dist/css/global.css">
    <link  rel="stylesheet" type="text/css" href="/TP/Public/dist/css/login.css">
    
    <script src="/TP/Public/dist/js/jquery-1.11.0.min.js"></script>
    <script src="/TP/Public/dist/js/signin.js"></script>
    <script src="/TP/Public/dist/js/jquery.webcam.min.js"></script>
   
    
    
        
       
 
  
</head>
<body>
    <div class="my_top"></div>
    <div class="my_header">
        <img src="/TP/Public/images/login-logo.png">
        <div class="header_menu">
            <a href="#">关于我们</a><span>|</span>
           
            <a href="http://<?php echo ($hosts); ?>/TP/index.php/admin/signin/showloginview" class="font_15">登陆</a> 
        </div>
    </div>
    <div class="my_contain">
        
            <ul class="my_signin_tab" id="my_signin_tab">
            	<li>通过手机注册</li>
            	<li>通过邮箱注册</li>         	
            	<li class="li_null"></li>
            </ul>
            
          <div class="my_signin"> 
            <ul class="my_signin_form" id="my_signin_tel">
             
             
               <?php if(($mobilephone) == "0"): ?><li>
            	  <FORM method="post" action="<?php echo U('Signin/telverify');?>">
                	<span>手机号码：</span>
                	<input type="tel" name="mobilephone"  placeholder="手机号为普通登录方式的账号">
                	<input  class="sentVerify" type="submit" value="发送验证码">
                	<input class="style" type="hidden" name="type" value="<?php echo ($type); ?>">
                	<input class="style" type="hidden" name="agent" value="<?php echo ($agent); ?>">             	
                  </FORM>
              	</li>
                 <?php else: ?>
                  <li>
                  <FORM method="post" action="<?php echo U('Signin/telverify');?>">
                	<span>手机号码：</span>
                	<input type="tel"  name="mobilephone"  value="<?php echo ($mobilephone); ?>">
                	<input  class="sentVerify" type="submit" value="发送验证码">
                	<input class="style" type="hidden" name="type" value="<?php echo ($type); ?>">
                	<input class="style" type="hidden" name="agent" value="<?php echo ($agent); ?>">
                  </FORM>
                  </li><?php endif; ?>
              
              <FORM method="post" action="<?php echo U('Signin/telsignin');?>">
                	<li><span>验证码：</span><input type="text" name="telverify"  maxlength="20" value="0"></li>
                	<li><span>昵称：</span><input type="text" name="name"  maxlength="20" placeholder="昵称可作为论坛登录方式的账号"></li>
                	<li><span>登录密码：</span><input type="password" name="password"  maxlength="20" placeholder="请输入6－20位的字符"></li>
                	<li><span>确认密码：</span><input type="password" name="pwconfirm"  maxlength="20" placeholder="请输入确认密码"></li>
                	<li><input class="register" type="submit" value="注册"></li>
                	<li><input class="style" type="hidden" name="mobilephone" value="<?php echo ($mobilephone); ?>"></li>
                	<li><input class="style" type="hidden" name="agent" value="<?php echo ($agent); ?>"></li>
                	<li><input class="style" type="hidden" name="type" value="<?php echo ($type); ?>"></li>
              </FORM>
              
            </ul>
           
            <ul class="my_signin_form" id="my_signin_mail">
            
            	<form method="post" action="<?php echo U('Signin/emailsignin');?>">
                	<li><span>邮箱地址：</span><input type="email" name="email"  placeholder="邮箱为普通登录方式的账号"></li>
                	<li><span>昵称：</span><input type="text" name="username"  maxlength="20" placeholder="昵称可作为论坛登录方式的账号"></li>
                	<li><span>登录密码：</span><input type="password" name="password"  maxlength="20" placeholder="请输入6－20位的字符"></li>
                	<li><span>确认密码：</span><input type="password" name="pwconfirm"  maxlength="20" placeholder="请输入确认密码"></li> 
                	<li><input class="register" type="submit" value="注册"></li>
                	<li><input class="style" type="hidden" name="type" value="<?php echo ($type); ?>"></li>
                </form>
            </ul>
          
        </div>
    </div>
    
  
    
</body>


</html>