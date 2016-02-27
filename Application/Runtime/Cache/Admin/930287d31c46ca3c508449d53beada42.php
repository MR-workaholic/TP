<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title></title>

	

	<style>
		.myhat0{

			height: 35px;
			margin-right: 20px;
      padding-top: 5px;
      /*border: 1px solid red;*/
      overflow: hidden;
		}

		.myhat1{
			/*margin-top: 20%;*/
			float: left;
			/*border: 1px solid bisque;*/
		}

		.myhat2{
			/*margin-top: 20%;*/
			float: right;
			/*border: 1px solid black;*/
		}

		*{
			margin: 0;
      padding: 0;
		}

	</style>
</head>
<body>
	<div class="myhat0" >
		<div class="myhat1" >
			<p>您好！广东广联科技有限公司（gdgl）</p>
		</div>
		<div class="myhat2">
			<a id='changePassword' href="javascript:;">修改密码</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://<?php echo ($hosts); ?>/TP/index.php/admin/Merchant/quituser">退出</a>
		</div>
	</div>
	
	<script type="text/javascript">
	
	 //点击“修改按钮”
    jq("#changePassword").click(function(){
//      alert(jq(this).attr("id"));
      window.open("passwordsetshow","","width=350,height=350,top=350,left=700,resizable=no");
    });
	
	</script>
	
	

</body>
</html>