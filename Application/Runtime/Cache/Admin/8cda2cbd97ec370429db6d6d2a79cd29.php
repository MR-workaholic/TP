<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>

<h1><?php echo ($src); ?></h1>

<?php if(is_array($Fpicarr)): foreach($Fpicarr as $key=>$vo): ?><img  src="<?php echo ($vo); ?>">
   <br><?php endforeach; endif; ?>

</body>
</html>