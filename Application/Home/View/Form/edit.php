<!DOCTYPE html>
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

<present name="vo">
<FORM method="post" action="__URL__/update">
标题： <INPUT class="style" type="text" name="title" value="{$vo.title}"><br/>
内容： <TEXTAREA class="style" name="content" rows="5" cols="45">{$vo.content}</TEXTAREA><br/>
<INPUT class="style" type="hidden" name="id" value="{$vo.id}">
<INPUT class="style" type="submit" value="提交">
</FORM>
</present>

<present name="list">
<volist  name='list' id='data' offset='0' length='2' empty='暂时没有数据'>
	标题： <INPUT class="style" type="text" name="title" value="{$data.title}"><br/>
	内容： <TEXTAREA class="style" name="content" rows="5" cols="45">{$data.content}</TEXTAREA><br/>
</volist>
</present>

<present name="vo">
<switch name="vo.title" >
	<case value="test1.3">发现test1.3</case>
	<case value="test1.2">发现test1.2</case>
	<case value="test1.1">发现test1.1</case>
	<default/>不发现他们
</switch>
</present>

<?php 
  echo 'keke hello';
?>


</body>
</html>