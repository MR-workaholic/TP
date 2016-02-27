<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<style type="text/css">

.style{
	margin:10px;
}

</style>
</head>
<body>

<?php if(isset($vo)): ?><FORM method="post" action="/TP/index.php/Home/Form/update">
标题： <INPUT class="style" type="text" name="title" value="<?php echo ($vo["title"]); ?>"><br/>
内容： <TEXTAREA class="style" name="content" rows="5" cols="45"><?php echo ($vo["content"]); ?></TEXTAREA><br/>
<INPUT class="style" type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">
<INPUT class="style" type="submit" value="提交">
</FORM><?php endif; ?>

<?php if(isset($list)): if(is_array($list)): $i = 0; $__LIST__ = array_slice($list,0,2,true);if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>标题： <INPUT class="style" type="text" name="title" value="<?php echo ($data["title"]); ?>"><br/>
	内容： <TEXTAREA class="style" name="content" rows="5" cols="45"><?php echo ($data["content"]); ?></TEXTAREA><br/><?php endforeach; endif; else: echo "暂时没有数据" ;endif; endif; ?>

<?php if(isset($vo)): switch($vo["title"]): case "test1.3": ?>发现test1.3<?php break;?>
	<?php case "test1.2": ?>发现test1.2<?php break;?>
	<?php case "test1.1": ?>发现test1.1<?php break;?>
	<?php default: ?>不发现他们<?php endswitch; endif; ?>

<?php  echo 'keke hello'; ?>


</body>
</html>