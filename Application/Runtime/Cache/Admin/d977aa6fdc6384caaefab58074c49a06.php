<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	

	<title></title>


	<style>
		*{
			margin: 0;
      padding: 0;
		}
    .mymiddletitle0{
      /*border: 1px solid greenyellow;*/
      overflow: hidden;
      height:60px;
      /*background-color: #F5F5F5;*/
    }
		.mymiddletitle1{
			float: left;
			width: 40%;
			margin-left: 6%;
      /*border:1px solid red;*/
      margin-top: 15px;
		}
		.mymiddletitle2{
			text-align: right;
			width: 40%;
			margin-right: 20px;
      margin-top: 15px;
			float: right;
      /*border:1px solid blue;*/
		}
    div.mymiddletitle2 a:link,div.mymiddletitle2 a:active, div.mymiddletitle2 a{
      text-decoration: none;
      font-size: 15px;
      color: #666;
    }
    
	</style>

</head>

<body>
<div class="mymiddletitle0" >

	<div id='usernamediv'>
		<h1 class="mymiddletitle1" id ='username'><?php echo ($username); ?></h1>
	</div>
	
	<div class="mymiddletitle2">
		<p>
			<a href="#" title="<?php echo ($username); ?>">账户名</a>
			<a href="#" title="查看以及设置账号信息">账户信息</a>
		</p>
	</div>
</div>

</body>
</html>