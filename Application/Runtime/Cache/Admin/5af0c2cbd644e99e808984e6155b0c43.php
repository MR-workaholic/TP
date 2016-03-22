<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<title>修改密码</title>
	<style type="text/css">

	.passwordTitle,.passwordSet{
        width: 300px;
        margin: 30px auto;
      }
      
	.passwordSet{
        list-style-type: none;
      }
    ul.passwordSet li{
        margin: 10px auto;
      }
      
 	  div.subbtn{
        text-align: right;
      }
      div.subbtn input{
        margin-left: 10px;
        margin-right: 10px;
      }

	</style>

</head>
<body>

	<p class="passwordTitle">密码设置</p>
	
	<form method="post" action="<?php echo U('Merchant/passwordset');?>">

	<ul class="passwordSet">
  		<li>原密码：
  			<input type="password" name="oldPassword" placeholder="请输入原密码" />
  		</li>
  
  		<li>新密码：
			<input type="password" name="newPassword" placeholder="请输入6到20位新密码" />  	
  		</li>
  		
  		<li>重复输入：
			<input type="password" name="newPasswordcomfirm" placeholder="请再次输入新密码" />  	
  		</li>
  	</ul>
  	
  	<div class="subbtn">

  		<input type="submit"  value="确 定"/>
  		
	</div>
  	
  	
</form>

</body>
</html>