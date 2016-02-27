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
	<FORM method="post" action="/TP/index.php/Home/Form/insert">
	标题： <INPUT type="text" name="title" class="style"><br/>
	内容： <TEXTAREA name="content" rows="5" cols="45" class="style"></TEXTAREA><br/>
	<INPUT type="submit" value="提交" class="style">
	</FORM>

</body>
</html>