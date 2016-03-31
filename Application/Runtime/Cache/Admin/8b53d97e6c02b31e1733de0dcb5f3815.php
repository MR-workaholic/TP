<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="../dist/js/jquery-1.11.0.min.js"></script>

  <title>添加商家</title>

  <style>
      .myp1s1left{
        width: 55%;
        height: 100%;
        /*border: 1px solid black;*/
        float: left;
        /*border-right: 1px solid #ECEBEB;*/
      }
      .myp1s1right{
        width: 45%;
        height: 100%;
        /*border: 1px solid red;*/
        float: right;
        /*background-color: #000088;*/
        /*border-left: 1px solid #ECEBEB;*/
      }
      div.myp1s1left div:first-child{
        /*max-width: 540px;*/
        height: 60%;
        padding-left:6%;
        padding-top: 3%;
        /*border: 1px solid cyan;*/
      }
      div.myp1s1left div:last-child{
        padding-top: 4%;
        padding-right: 6%;
        text-align: right;
        /*border: 1px solid blueviolet;*/
      }

      #map{
        max-width: 400px;
        max-height: 300px;
        min-height: 250px;
        min-width: 300px;
        margin: 5% 7% 0 7%;
        /*border: 1px solid orange;*/
      }
      div.myp1s1right div:nth-child(2){
        margin-left: 5%;
        margin-top: 8%;
        /*border: 1px solid greenyellow;*/
      }
    </style>
</head>
<body>

    <form class="form-horizontal" role="form">
      <div class="form-group">
        <label for="responsor" class="col-sm-2 control-label">商家名称：</label>
        <div class="col-sm-4">
          <input id="merchantName" type="text" class="form-control" placeholder="">
        </div>
      </div>

      <div class="form-group">
        <label for="responsor" class="col-sm-2 control-label">负责人：</label>
        <div class="col-sm-4">
          <input id="responsor" type="text" class="form-control" placeholder="">
        </div>
      </div>

      <div class="form-group">
        <label for="contactWay" class="col-sm-2 control-label">联系方式：</label>
        <div class="col-sm-4">
          <input id="contactWay" type="text" class="form-control" placeholder="">
        </div>
      </div>

      <div class="form-group">
        <label for="address" class="col-sm-2 control-label">地址：</label>
        <div class="col-sm-4">
          <input id="address" type="text" class="form-control" placeholder="">
        </div>
      </div>

      <div class="form-group">
        <label for="merchantType" class="col-sm-2 control-label">商家类型： </label>
        <div class="col-sm-4">
          <input id="merchantType" type="text" class="form-control" placeholder="">
        </div>
      </div>

      <div class="form-group">
        <label for="businessRange" class="col-sm-2 control-label">商圈：</label>
        <div class="col-sm-4">
          <input id="businessRange" type="text" class="form-control" placeholder="">
        </div>
      </div>

      <div class="form-group">
            <label class="col-sm-offset-2 control-label">
              添加路由（请用分号分开不同的路由器MAC地址）
            </label>
        </div>

      <div class="form-group">
        <div class="col-sm-4">
          <textarea class="col-sm-offset-5 form-control" rows="3"></textarea>
        </div>
      </div>
      <button type="submit" class="col-sm-offset-5 btn btn-default">提交</button>
    </form>



<script>

  $("input[name='confirmAddTheme']").on("click",function(){
      $(".mymymy").show();
    //      阻止方向键、F5键默认行为
      $(".virtual_body").keydown(function(event){
        if ((event.keyCode==37)||(event.keyCode==38)||(event.keyCode==39)||(event.keyCode==40)|| (event.keyCode==116)){
          event.keyCode=0;
          return false;
        }
      })
  });
  $(".modal-body button").on("click",function(){
    $(".mymymy").hide();
    $(".virtual_body").keydown(function(event){
      if ((event.keyCode==37)||(event.keyCode==38)||(event.keyCode==39)||(event.keyCode==40)|| (event.keyCode==116)){
        return;
      }
    })
  })
//点击“是否开始设置主题详细信息”中的“确定”
  $("#themeAdd-confirmAdSet").on("click",function(){
    mycontent="themeSet.html";
    contentLoad();
  })

</script>
</body>
</html>