<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	
	<title></title>

	<style>
		.myhead0{

			width: 100%;
			height: 100%;

      background-color: #00BDD5;
      /*border: 1px solid yellow;*/
      overflow: hidden;
		}

		.myhead1{
			/*margin-top: 20%;*/
			float: left;
      /*border: 1px solid darkgoldenrod;*/

			/*border: 1px solid bisque;*/
		}

		.myhead2{
			/*margin-top: 20%;*/
			float: right;
      margin-right: 20px;
			margin-top: 1%;
			color: #FFFFFF;
			/*border: 1px solid black;*/
		}

		*{
			margin: 0;
      padding: 0;
		}

	</style>
</head>
<body>
	<div class="myhead0">
		<div class="myhead1">
		  <?php if(($imgPath) == "0"): ?><img src="/tp/public/merchant/img/brand.png" alt="商标" title="连WIFI">
		  <?php else: ?>
		    <img src="/<?php echo ($host); ?>/tp/public/merchant/img/brand.png" alt="商标" title="连WIFI"><?php endif; ?>	
		</div>
		<div class="myhead2">
			<p >帮助中心</p>
		</div>
	</div>

	

</body>
</html>