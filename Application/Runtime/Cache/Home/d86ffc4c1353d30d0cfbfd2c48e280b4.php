<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>我们的标题是<?php echo ($title); ?></title>
</head>
<body>
	<table>
		<tr>
			<td>id:</td>
			<td><?php echo ($data["id"]); ?></td>
		</tr>
		<tr>
			<td>标题： </td>
			<td><?php echo ($data["title"]); ?></td>
		</tr>
		<tr>
			<td>内容： </td>
			<td><?php echo ($data["content"]); ?></td>
		</tr>
	</table>

</body>
</html>