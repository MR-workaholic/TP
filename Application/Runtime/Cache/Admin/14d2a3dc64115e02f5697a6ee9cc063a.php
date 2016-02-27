<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
	<form method="post" action="<?php echo U('Merchant/shopmeschange');?>">
  		<h4>商 家 名 称： </h4>
        <input type="text"  name="shopname"  value=<?php echo ($shop["shopname"]); ?>>
        <input type="hidden" name="sid"  value=3>
    	<input type="submit" style="border-radius: 10px; margin-right: 10px;margin-top:50px" value="确定修改">
	</form>
</body>
</html>