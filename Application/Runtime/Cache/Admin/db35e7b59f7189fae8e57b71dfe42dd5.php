<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>路由列表</title>
  <!-- zui -->
  <link href="../dist/css/zui.min.css" rel="stylesheet">
  <link href="../dist/css/zui-theme.css" rel="stylesheet">
  <!--<link href="../../frame/framestyle.css" rel="stylesheet" type="text/css">-->
  <!--<link href="../../Merchant/css/listGlobal.css" rel="stylesheet" type="text/css">-->

  <link rel="shortcut icon" href="../docs/favicon.ico" type="image/x-icon">
  <link rel="icon" href="../docs/favicon.ico" type="image/x-icon">

  <!--[if lt IE 9]>
  <script src="../dist/lib/ieonly/html5shiv.js"></script>
  <script src="../dist/lib/ieonly/respond.js"></script>
  <script src="../dist/lib/ieonly/excanvas.js"></script>
  <![endif]-->

  <!-- jQuery (ZUI中的Javascript组件依赖于jQuery) -->

  <!-- ZUI  Javascript组件 -->
  <!--<script src="../../dist/js/zui.min.js"></script>-->
  <style>
    div.example{
      width:800px;
      margin: 0 auto;
      /*border: 1px solid blue;*/
    }
    div.example h3{
      margin: 30px auto;
      /*border: 1px solid red;*/
    }
    div.example h3 span{
      margin-left:30px;
      /*border: 1px solid blueviolet;*/
    }
    div.example h3 span input{
      margin: 0 10px 0 10px;
    }
    div.example thead tr th{
      text-align: center;
    }
    div.example table.table.table-bordered{
      max-width: 900px;
      min-width: 800px;
      margin: 0 auto;
      text-align: center;
    }

  </style>
</head>
<body>
<div class="example">
    <h3>你所设置的广告主题如下:<span><input type="button" class="btn btn-toolbar basic" value="添加广告主题"/><input type="button" class="btn btn-toolbar else" value="统一发布公共广告"/></span></h3>
    <table class="table table-bordered basic">
      <thead>
      <tr>
        <th>编号</th>
        <th>名称</th>
        <th>使用商户</th>
        <th>应用模板</th>
        <th>预览</th>
        <th>设置</th>
        <th>备注</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td></td>
        <td></td>
        <td><a href="javascript:">增加(查看)</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="javascript:">设置</a></td>
      </tr>
      <tr>
      <tr>
        <td></td>
        <td></td>
        <td><a href="javascript:">增加(查看)</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="javascript:">设置</a></td>
      </tr>
      <tr>
      <tr>
        <td></td>
        <td></td>
        <td><a href="javascript:">增加(查看)</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="javascript:">设置</a></td>
      </tr>
      </tbody>
    </table>


</div>
<!--<script src="../../dist/js/jquery-1.11.0.min.js"></script>-->
<script>
  var jq=jQuery.noConflict();
  var tableBasic=jq("table.basic");        //基本信息的表格
  var tableElse=jq("table.else");
  tableBasic.show();                        //基本信息的表格的显示
  tableElse.hide();
  jq("input.basic").on("click",function(){tableElse.hide();tableBasic.show();});   //绑定点击事件，当点击“基本信息”的按钮时，显示“基本信息的表格”，隐藏“其它信息的表格”
  jq("input.else").on("click",function(){tableBasic.hide();tableElse.show();});
</script>
</body>
</html>