<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>云管理平台－商家</title>

  <script src="/Project001/TP/Public/dist/js/jquery-1.11.0.min.js"></script>
  <script src="/Project001/TP/Public/dist/js/chart.min.js"></script>
  <script src="/Project001/TP/Public/dist/js/image-file-visible.js"></script>
  <script src="/Project001/TP/Public/dist/js/ajaxfileupload.js"></script>
  <script src="/Project001/TP/Public/dist/js/jquery.minicolors.js"></script>

  <link href="/Project001/TP/Public/dist/css/zui.min.css" rel="stylesheet">
  <link href="/Project001/TP/Public/dist/css/zui-theme.css" rel="stylesheet">
  <link href="/Project001/TP/Public/merchant/css/merchantIndex.css" rel="stylesheet" type="text/css">
  <link href="/Project001/TP/Public/dist/css/jquery.minicolors.css" rel="stylesheet" type="text/css">
  
   


    <!-- --> 
	<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/Base.js"></script>
	<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/prototype.js"></script>
	<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/mootools.js"></script>
	<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/Ajax/ThinkAjax.js"></script>
	<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/Form/CheckForm.js"></script>
	
   
</head>
<body >

<div class="virtual_body">
<div id="mywhole">

  <div id="myhat" >

  </div>

  <div id="myhead">

  </div>

  <div id="mymiddle">

    <div id="mymiddletitle">
    </div>

    <div id="mymiddlecontent">

      <div id="mytitle">
        <div class="example" contenteditable="false" style="max-width: 217px;min-width: 169px;width: 100%;">
          <nav class="menu" data-toggle="menu" style="width: 100%;border-right-color: white;">

            <ul class="nav nav-primary" >
              <li class="active"><a href="javascript:;" onclick="clickIndex()" ><i class="icon-home"></i> 首页</a></li>

              <li class="nav-parent show">
                <a href="javascript:;" ><i class="icon-user"></i> 商户信息 <i class="icon-chevron-right nav-parent-fold-icon"></i></a>
                <ul class="nav">
                  <li ><a href="javascript:void (0);" onclick="clickBasic()">基本信息</a></li>
                  <li><a href="javascript:void(0);" onclick="clickRouteList()">路由列表</a></li>
                </ul>
              </li>

              <li><a href="javascript:void(0);" onclick="clickRouteSet()"><i class="icon-cogs"></i> 设备设置 </a></li>

              <li class="nav-parent">
                <a href="javascript:;"><i class="icon-share-alt"></i> 广告设置 <i class="icon-chevron-right nav-parent-fold-icon"></i></a>
                <ul class="nav">
                  <li><a href="javascript:void (0);" onclick="clickADList()">广告列表</a></li>
                  <li><a href="javascript:;" onclick="clickADthemeAdd()" >添加</a></li>
                </ul>
              </li>

              <li><a href="javascript:void(0);" onclick="clickAuthenSet()"><i class="icon-eye-open"></i> 认证设置 </a></li>

              <li class="nav-parent">
                <a href="javascript:;"><i class="icon-tasks"></i> 运行统计 <i class="icon-chevron-right nav-parent-fold-icon"></i></a>
                <ul class="nav">
                  <li><a href="javascript:;" onclick="clickAuthstatic()"> 设备统计</a></li>
                  <li><a href="javascript:;" onclick="clickUserStatic()"> 客户统计</a></li>
                </ul>
              </li>

              <li><a href="javascript:;" onclick="clickAccountSet()"><i class="icon-list-ul"></i> 账号设置 </a></li>

            </ul>

          </nav>

        </div>
      </div>

      <div id="mycontent"></div>
    </div>
  </div>

  <div id="mytail">
    <p style="margin-top:12px;text-align:center;font-size: 13px;color: #aaa;">
      ©2015 nuomi.com 京公网安备11010802014106号  互联网药品信息服务资格证编号（京-经营性-2011-0009） 营业执照信息
    </p>
  </div>
</div>
</div>
<!-- ZUI  Javascript组件 -->
<!--<script src="../dist/js/zui.min.js"></script>-->
<script>
  /**
   * Created by Administrator on 2015/10/27.
   */
   
  var jq = jQuery.noConflict();
  var routelistStatus = 0;
   
  var hat="hatshow";
  var head="headshow";
  var middletitle="middletitleshow";
 // var middletitle="/Project001/TP/Public/frame/middletitle.html";
  var mycontent="showIndex";
  
  function GetRandomNum(Min,Max)
  {   
  	var Range = Max - Min;   
  	var Rand = Math.random();  //产生0到1之间的随机数 
  	return(Min + Math.round(Rand * Range));  //round函数：四舍五入  
  }   

  //加载
    function hatLoad(){
      jq("#myhat").load(hat,function(a,status,c){
        console.log(status);
        if(status=="error"){
          jq("#myhat").text("判断加载失败");
        }
      });
    }
    function headLoad(){
      jq("#myhead").load(head,function(a,status,c){
        console.log(status);
        if(status=="error"){
          jq("#myhead").text("判断加载失败");
        }
      });
    }
    function middletitleLoad(){
      jq("#mymiddletitle").load(middletitle,function(a,status,c){
        console.log(status);
        if(status=="error"){
          jq("#mymiddletitle").text("判断加载失败");
        }
      });
    }
    
    function contentLoad(){
      jq("#mycontent").load(mycontent,function(a,status,c){
    	jq(".virtual_body").scrollTop(0);
        console.log(status);
        if(status=="error"){
          jq("#mycontent").text("判断加载失败");
        }
      });
    }

    hatLoad();
    headLoad();
    middletitleLoad();
    contentLoad();
    menuStyle();

  //menu菜单样式
    function menuStyle(){
      jq("ul.nav.nav-primary a").attr("draggable","false");
      var parentLi=jq("li.nav-parent.show");
      function down(objLi){objLi.find("a i.icon-chevron-right.nav-parent-fold-icon").removeClass("icon-chevron-right,nav-parent-fold-icon").addClass("icon-rotate-90");}  //icon的图标变为向下
      down(parentLi);       //初始化：商户信息的icon

      //点击a
      jq("a").on("click",function(){
        var objli=jq(this).closest("li");

        //如果有子列表
        if(objli.hasClass("nav-parent")){
          //如果子列表已显示
          if(objli.hasClass("show")){
            jq(this).find("i.icon-rotate-90").addClass("icon-chevron-right,nav-parent-fold-icon").removeClass("icon-rotate-90");//icon的图标为向右
            objli.removeClass("show");
            jq("li.active").removeClass("active");
          }
          //子列表未显示
          else{
            down(objli);
            objli.addClass("show");
          }
        }
        //点击的是没有子列表的li
        else{
          jq("li.active").removeClass("active");
          objli.addClass("active");
        }
      })
    }

  //菜单监听事件
      //点击了基本信息
      function clickBasic(){
        mycontent="/Project001/TP/Public/content/P1S1.html";
        contentLoad();
      }
      //点击了路由列表
      function clickRouteList() {
        mycontent = "/Project001/TP/Public/content/P1S1-2.html";
        jq("#mycontent").load(mycontent, function (a, status, c) {
          console.log(status);
          if (status == "error") {
            jq("#mycontent").text("判断加载失败");
          }
        });
      }
    //

      //点击了设备设置
      function  clickRouteSet(){
    	
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		routelistStatus = 0;
    	  	  
    	  	  }
    	
        mycontent = "../Routeset/showview";
        contentLoad();
      }

      //点击了广告列表
      function  clickADList(){
    	  
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		
    	  		routelistStatus = 0;
    	  	  
    	  	  }
    	  
        mycontent = "../Adset/showadlist";
        contentLoad();
      }
      
      //点击了“认证设置”
      function clickAuthenSet(){
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		
    	  		routelistStatus = 0;
    	  	  
    	  	  }
    	  
        mycontent="../Authentication/showview";
        contentLoad();
      }
      
      //      点击了“添加”
      function clickADthemeAdd(){
    	  
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		
    	  		routelistStatus = 0;
    	  	  
    	  	  }
    	  
        mycontent="../Adset/themeAddshow";
        contentLoad();

      }
      
//    点击了“首页”
      function clickIndex(){
	
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		
    	  		routelistStatus = 0;
    	  	  
    	  	  }
    	  
        mycontent="showIndex";
        contentLoad();

      }
      
      //点击了“设备统计”
      function clickAuthstatic(){
    	  
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		
    	  		routelistStatus = 0;
    	  	  
    	  	  }
    	  
        mycontent="../Statistics/APstatistics";
        contentLoad();

      }

      //点击了“客户统计”
      function clickUserStatic(){
    	  
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  	
    	  		routelistStatus = 0;
    	  	  
    	  	  }
    	  
        mycontent="../Statistics/userStatistics";
        contentLoad();

      }
      
      //点击了“账号设置”
      function clickAccountSet(){
    	  
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		
    	  		routelistStatus = 0;
    	  	  
    	  	  }
    	  
        mycontent="../Account/accountSettings";
        contentLoad();

      }
      
    //menu菜单样式
      function menuStyle(){
        jq("ul.nav.nav-primary a").attr("draggable","false");
        var parentLi=jq("li.nav-parent.show");
        function down(objLi){objLi.find("a i.icon-chevron-right.nav-parent-fold-icon").removeClass("icon-chevron-right,nav-parent-fold-icon").addClass("icon-rotate-90");}  //icon的图标变为向下
        down(parentLi);       //初始化：商户信息的icon

        //点击a
        jq("a").on("click",function(){
          var objli=jq(this).closest("li");

          //如果点击的有子列表的"li"
          if(objli.hasClass("nav-parent")){
            //如果子列表已显示，点击是想要关闭子列表
            if(objli.hasClass("show")){
              jq(this).find("i.icon-rotate-90").addClass("icon-chevron-right,nav-parent-fold-icon").removeClass("icon-rotate-90");//icon的图标为向右
              objli.removeClass("show");
              jq("li.active").removeClass("active");
            }
            //子列表未显示,点击是想要开启子列表
            else{
//              关闭其它已经展开的子列表
              jq("li.show").find("i.icon-rotate-90").addClass("icon-chevron-right,nav-parent-fold-icon").removeClass("icon-rotate-90");//icon的图标为向右
              jq("li.show").removeClass("show");
              jq("li.active").removeClass("active");
              down(objli);
              objli.addClass("show");
            }
          }
          //点击的是没有子列表的li
          else{
            if(objli.parents("li").hasClass("show")){
              jq("li.active").removeClass("active");
              objli.addClass("active");
            }
            else{
              jq("li.show").find("i.icon-rotate-90").addClass("icon-chevron-right,nav-parent-fold-icon").removeClass("icon-rotate-90");//icon的图标为向右
              jq("li.show").removeClass("show");
              jq("li.active").removeClass("active");
              objli.addClass("active");
            }
          }
        })
      }

    
      function displaySelect(optionValue,id){
  		
			var all_options = document.getElementById(id).options;
			
			for (i=0; i<all_options.length; i++){
				
				if (all_options[i].value == optionValue) // 根据option标签的ID来进行判断 测试的代码这里是两个等号
					{
						all_options[i].selected = true;
					}
				}
		};



</script>

</body>
</html>