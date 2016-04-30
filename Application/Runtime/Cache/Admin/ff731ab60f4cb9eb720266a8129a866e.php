<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>云管理平台－代理商家</title>

  <script src="/Project001/TP/Public/dist/js/jquery-1.11.0.min.js"></script>
  <script src="/Project001/TP/Public/dist/js/chart.min.js"></script>
  <script src="/Project001/TP/Public/dist/js/image-file-visible.js"></script>
  <script src="/Project001/TP/Public/dist/js/ajaxfileupload.js"></script>
  <script src="/Project001/TP/Public/dist/js/jquery.minicolors.js"></script>



  <link href="/Project001/TP/Public/dist/css/zui.min.css" rel="stylesheet">
  <link href="/Project001/TP/Public/dist/css/zui-theme.css" rel="stylesheet">
  <link href="/Project001/TP/Public/merchant/css/merchantIndex.css" rel="stylesheet" type="text/css">
  <link href="/Project001/TP/Public/dist/css/jquery.minicolors.css" rel="stylesheet" type="text/css">
  
<script src="/Project001/TP/Public/dist/js/bootstrap-paginator.js" type="text/javascript"></script>
     <link rel="stylesheet" href="/Project001/TP/Public/dist/css/qunit-1.11.0.css">
    <link rel="stylesheet" href="/Project001/TP/Public/dist/css/bootstrapv3.css">




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

 
    <div id="myhat" ></div>

    <div id="myhead"></div>

    <div id="mymiddle">

      <div id="mymiddletitle">
      </div>
      
     

      <div id="mymiddlecontent">

        <div id="mytitle">
          <div class="example" contenteditable="false" style="max-width: 217px;min-width: 169px;width: 100%;">
            <nav class="menu" data-toggle="menu" style="width: 100%;border-right-color: white;">

              <ul class="nav nav-primary" >
              
                <li class="active"><a href="javascript:void(0);" onclick="clickIndex()" style="font-size:13px"><i class="icon-home"></i> 首页</a></li>

                <li class="nav-parent">
                  <a href="javascript:;" style="font-size:13px"><i class="icon-user"></i> 代理商信息 <i class="icon-chevron-right nav-parent-fold-icon"></i></a>
                  <ul class="nav">
                    <li><a href="javascript:void (0);" onclick="clickAgentBasic()" style="font-size:13px">基本信息</a></li>
                    <li><a href="javascript:void(0);" onclick="clickMerchaList()" style="font-size:13px">设备列表</a></li>
                  </ul>
                </li>


               <li><a href="javascript:void (0);" onclick="clickUserList()" style="font-size:13px"><i class="icon-share-alt"></i> 商家列表</a></li>
                 
               

                <li class="nav-parent">
                  <a href="javascript:;" style="font-size:13px"><i class="icon-newspaper-o"></i> 广告设置 <i class="icon-chevron-right nav-parent-fold-icon"></i></a>
                  <ul class="nav">
                    <li><a href="javascript:void (0);" onclick="clickADList()" style="font-size:13px">广告列表</a></li>
                  	<li><a href="javascript:;" onclick="clickADthemeAdd()" style="font-size:13px">添加</a></li>
                  </ul>
                </li>

                <li class="nav-parent">
                  <a href="javascript:;" style="font-size:13px"><i class="icon-bar-chart-alt"></i> 运行统计 <i class="icon-chevron-right nav-parent-fold-icon"></i></a>
                  <ul class="nav">
                    <li><a href="javascript:void(0);" onclick="clickStaticSummary()" style="font-size:13px"> 统计概况</a></li>
                    <li><a href="javascript:void (0);" onclick="clickMerchantStatic()" style="font-size:13px"> 商户统计情况</a></li>
                  </ul>
                </li>

				<?php if(($type) == "代理商"): ?><li><a href="javascript:void(0);" onclick="clickAccountSet()" style="font-size:13px"><i class="icon-list-ul"></i> 账号设置 </a></li><?php endif; ?>
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
   
   var type = '<?php echo ($type); ?>';
    
   if(type == '管理员')
	   {
		   var hat="blank";
		   var head="blank";
		   var middletitle="blank";
	   }else{
		   var hat="hatshow";
		   var head="headshow";
		   var middletitle="middletitleshow";
	   }
   
  
  // var middletitle="/Project001/TP/Public/frame/middletitle.html";
   var mycontent="../Agent/showIndex";
   
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
//            关闭其它已经展开的子列表
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

  //菜单监听事件
      //点击了代理商信息
      function clickAgentBasic(){
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		routelistStatus = 0;
    	  	  
    	  	  }
        mycontent="../AgentMessage/showBasicMsg";
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


       //点击了设备列表
      function clickMerchaList(){
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		routelistStatus = 0;
    	  	  
    	  	  }
        mycontent = "../AgentMessage/showDeviceList";
        contentLoad();
      }
      //点击了商家列表
      function clickUserList(){
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		routelistStatus = 0;
    	  	  
    	  	  }
       mycontent = "../AgentMessage/showMerchantsList";
        contentLoad();
      }
       //点击添加商家
      function clickUserAdd(){
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		routelistStatus = 0;
    	  	  
    	  	  }
        mycontent = "../AgentMessage/AddMerchant";
        contentLoad();
      }

      //点击了广告主题
      function  clickADthemeSet(){
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		routelistStatus = 0;
    	  	  
    	  	  }
        mycontent = "../AgentAd/showAdThemeSet";
        contentLoad();
      }

    

      //      点击了"广告添加”
      function clickADthemeAdd(){
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		routelistStatus = 0;
    	  	  
    	  	  }
    	  mycontent="../Adset/themeAddshow";
        contentLoad();
      }

      //点击了“统计概况”
      function clickStaticSummary(){
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		routelistStatus = 0;
    	  	  
    	  	  }
        mycontent="../AgentStatistic/showStatisticSummary";
        contentLoad();

      }

      //点击了“客户统计”
      function clickMerchantStatic(){
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		routelistStatus = 0;
    	  	  
    	  	  }
        mycontent="../AgentStatistic/showMerchantStatistic";
        contentLoad();

      }
      //点击了“账号设置”
      function clickAccountSet(){
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		routelistStatus = 0;
    	  	  
    	  	  }
        mycontent="../AgentMessage/AgentAccountSetting";
        contentLoad();

      }
//      点击了“首页”
      function clickIndex(){
    	  if(  routelistStatus != 0)
    	  {
    	  	 	clearInterval(routelistStatus);
    	  		routelistStatus = 0;
    	  	  
    	  	  }
        mycontent="../Agent/showIndex";
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
</script>

</body>
</html>