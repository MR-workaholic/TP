<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录界面</title>
    <link  rel="stylesheet" type="text/css" href="/Project001/TP/Public/dist/css/login.css">
    <link  rel="stylesheet" type="text/css" href="/Project001/TP/Public/dist/css/global.css">
    <script src="/Project001/TP/Public/dist/js/jquery-1.11.0.min.js"></script>
    <script src="/Project001/TP/Public/dist/js/my_login.js"></script>
    
    <script language="JavaScript">
    	function setway(way)
    	{
    		$('#way').val(way);
    	}
    </script>
</head>
<body>
    <div class="my_top"></div>
    <div class="my_header">
        <img src="/Project001/TP/Public/images/login-logo.png">
        <div class="header_menu">
            <a href="#">关于我们</a><span>|</span>
            <a href="http://<?php echo ($hosts); ?>/TP/index.php/admin/signin/showsignupview" class="font_15">免费注册</a>
        </div>
    </div>
    <div class="my_container">
        <div class="my_main">
            <img src="/Project001/TP/Public/images/login-mid.png">
            <div class="my_login">
                <ul id="my_logintab">
                    <li id="commonLogin" onclick='setway(0)'>普通方式登录</li>
                    <li id="otherLogin" onclick='setway(1)'>其它方式登录</li>
                </ul>
                
                <form  method="post" action="<?php echo U('Login/firstlogin');?>">
                
                <div class="my_form_div" id="form_name">
                    <p class="my_from_p">用户名：</p>
                    <img src="/Project001/TP/Public/images/icon_user.png">
                    	<input type="text" name="loginway1" placeholder="手机号/邮箱"/>
                    <div class="div_null"></div>
                    
                    <p class="my_from_p">密码：</p>
                    <img src="/Project001/TP/Public/images/icon_password.png">
                    	<input type="password"  name="password1" placeholder="请输入您的账户密码"/>
                    <div class="div_null"></div>
                </div>
                
                <div class="my_form_div" id="form_forum" style="">
                    <p class="my_from_p">论坛账号:</p>
                    <img src="/Project001/TP/Public/images/icon_user.png">
                    <input type="text" name="loginway2" placeholder="论坛账号"/>
                    <div class="div_null"></div>
                    
                    <p class="my_from_p">密码：</p>
                    <img src="/Project001/TP/Public/images/icon_password.png">
                    <input type="password" name="password2"  placeholder="请输入您的账户密码"/>
                    <div class="div_null"></div>
                </div>
                
               
                <div class="form_tip">
	                <span><a href="#" class="font_13">忘记密码?</a></span>
	                <label>
	                	<a href="http://<?php echo ($hosts); ?>/TP/index.php/admin/signin/showsignupview" class="font_13">免费注册</a>
	                </label>
	                <div class="div_null"></div>
                </div>
                
                <input type="hidden" name="way" id="way" value='0'/>
                <input class="form_login"  type="submit" value ="登&nbsp;&nbsp;录" />
                
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>