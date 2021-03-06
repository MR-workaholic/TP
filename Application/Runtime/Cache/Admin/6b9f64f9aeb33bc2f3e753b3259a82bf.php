<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <title></title>
   
    <style>
.theme-after{
        width: 800px;
        margin: 0 auto;
        /*border: 1px solid red;*/
        overflow: hidden;
        padding-left: 20px;
        padding-right: 20px;
      }
      div.theme-after ul li:nth-child(3)>div{
        width: 310px;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        /*border: 1px solid red;*/
        border-radius: 4px;
        -webkit-border-radius: 4px;
      }
      div.theme-after ul+div{
        /*border: 1px solid yellow;*/
        float: right;
      }
      div.theme-after ul+div input{
        /*border: 1px solid cyan;*/
        margin-left: 20px;
      }
      .ba1{
        width: 150px;
        height: 80px;
      }
      .ba2{
        width: 80px;
        height: 80px;
      }
      div.ba1 span,div.ba2 span{
        color: white;
        /*z-index: 5;*/
        position: absolute;
        cursor: pointer;
        /*border: 1px solid beige;*/
      }
      div.ba1 span{
        margin-top: 20%;
        margin-left: 44%;
      }
      div.ba2 span{
        margin-top: 34%;
        margin-left: 32%;
      }
      /*---------------------------------图片编辑框（2015、12、24 by 赖晓青）----------------------------------------------------------*/
      .blackBg1,.blackBg2,.blackBg3{
        background-color: rgba(0,0,0,.5);
        width: 100%;
        height: 100%;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1105;
        padding: 0;
        display: none;
      }
        .addMagnet{
        padding-left: 30px;
        padding-right: 30px;
        z-index: 1111;
        position: fixed;
        background-color: #fff;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        box-shadow: 0 1px 15px rgba(0,0,0,.5);
        -webkit-box-shadow: 0 1px 15px rgba(0,0,0,.5);
      }

      .addMagnet{
        width:650px;
        height: 510px;
        left: 35%;
        top: 20%;
      }

      div.addMagnet button{
        /*border: 1px solid orange;*/
        float: right;
        margin-right: 20px;
        margin-top: 20px;
      }

      .magnetList{
        width: 400px;
        height: 170px;
        overflow-y: scroll;
        border: 1px solid #ccc;
      }
      div.magnetList img{
        /*border: 1px solid yellow;*/

        margin: 5px;
      }
      .magnetBg{
        background-color: white;
        filter: alpha(opacity=20);
        opacity: 0.2;
      }
    </style>

</head>
<body>
<div class="theme-after">
  <ul>
    <li><h3>
      关于商家主页
    </h3><p>
      商家主页用于展示商家的品牌形象以及为站内商讯作导航。</p>
    </li>
    <li><h3>
      海报图片轮播
    </h3><p>
      以轮播图片的形式展现商家的品牌形象。您可以设置图片及其轮播次序（可拖动排序），图片数量限制在 2~5 张。
    </p>
        <div id="dashboard1" class="dashboard dashboard-draggable" >
          <section class='row' id='Fpic'>
          
          	<?php if(is_array($Fpicarr)): foreach($Fpicarr as $key=>$vo): ?><div class="col-md-4 col-sm-6" data-id='1'>
              <div class="panel">
                <div class="panel-heading">
	                <div class="panel-actions ba1" style="display:none">
	                <span class="openImg">编 辑</span>
	                <button class="btn btn-mini btn-danger remove-panel">
	                <i class="icon-remove"></i></button>
	                </div>
	                
	                <div id = <?php echo ($vo["id"]); ?>> 
	                	<img src="<?php echo ($vo["src"]); ?>" width="150" height="80"/>
	                </div>
	               
                </div>
               
              </div>
            </div><?php endforeach; endif; ?>
        
          </section>
        </div><input type="button" name="openImage" class="btn " id="add1" value="添加图片..."/>
    </li>
    <li>
    
    <h3>磁贴导航</h3>
    <p>磁贴即带图标的色块，用户点击磁贴后，将打开该磁贴的链接。点击磁贴以编辑磁贴属性，拖动可排列磁贴的次序。</p>
      <div id="dashboard2" class="dashboard dashboard-draggable">
        <section class='row'>
        
        <?php if(is_array($Ipicarr)): foreach($Ipicarr as $key=>$vo): ?><div class="col-md-4 col-sm-6" data-id='1'>
            	<div class="panel">
              		<div class="panel-heading">
              		<div class="panel-actions ba2" style="display:none">
              		<span class="openMagnet">编 辑</span>
              		<button class="btn btn-mini btn-danger remove-panel">
              		<i class="icon-remove"></i></button>
              		</div>
              		
              		 	<div id = <?php echo ($vo["id"]); ?>> 
              				<img src="<?php echo ($vo["src"]); ?>" width="80" height="80"/>
              			</div>
              			
              		</div>
            	</div>
          	</div><?php endforeach; endif; ?>
         
        </section>
        
      </div><input type="button" name="openMagnet" class="btn" id="add2" value="添加磁贴..."/>
    </li>
    
  </ul>
 
</div>

<div class="blackBg1">
  <div id="addImg">

  </div>
</div>

<div class="blackBg2">
  <div class="addMagnet">
    <h3>磁贴链接</h3>
    <p>链接至指定URL</p>
    <div>
      <p>请输入URL：</p><input type="text"  id="magnetURL1" name="magnetURL" value=''/>
    </div>
    <div>
      <p>请输入磁贴文字：</p><input type="text" id="magnetWord1" name="magnetWord" value=''/>
    </div>
    <h3>磁贴图标</h3>
    <p>为磁贴选择一个图标，点击以下图标进行选择：</p>
    <div class="magnetList">
  
      	
    	<img src="/Project001/TP/Public/images/I01.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I02.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I03.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I04.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I05.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I06.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I07.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I08.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I09.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I10.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I11.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I12.png" width="60" height="60">
      	
 
    </div>
    <button type="button" class="btn" id="cancelAddMagnet" data-dismiss="modal">取消</button>
    <button type="button" class="btn btn-primary" id="confirmAddMagnet" data-dismiss="modal">确定</button>
    <div id="mesforupload1"></div>
  </div>
</div>

<!--------------------------点击磁贴“添加”框后弹出的模态框------------------------------------------------------------>
<div class="blackBg3">
  <div class="addMagnet">
    <h3>磁贴链接</h3>
    <p>链接至指定URL</p>
    <div>
      <p>请输入URL：</p><input type="text" id="magnetURL2" name="magnetURL" value=''/>
    </div>
    <div>
      <p>请输入磁贴文字：</p><input type="text" id="magnetWord2" name="magnetWord" value=''/>
    </div>
    <h3>磁贴图标</h3>
    <p>为磁贴选择一个图标，点击以下图标进行选择：</p>
    <div class="magnetList">
    	
    	<img src="/Project001/TP/Public/images/I01.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I02.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I03.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I04.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I05.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I06.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I07.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I08.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I09.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I10.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I11.png" width="60" height="60">
      	<img src="/Project001/TP/Public/images/I12.png" width="60" height="60">
      
      
      </div>
    <button type="button" class="btn" id="cancelAddMagnet2" data-dismiss="modal">取消</button>
    <button type="button" class="btn btn-primary" id="confirmAddMagnet2">确定</button>
    <div id="mesforupload2"></div>
  </div>
</div>

<script>

	var head = "<?php echo ($a); ?>";
	
	
	
	
	/*------------------urlbefore为点击磁贴“编辑”时，该磁贴图片的路径，urlAfter为弹出磁贴的编辑框后，选择了哪张磁贴的路径-----------------------*/
	/*------------------urlAfter2为点击磁贴“添加”时，弹出磁贴的编辑框后，选择了哪张磁贴的路径-----------------------*/
	  var urlBefore;
	  var urlAfter,urlAfter2;
	  
	 

//	        点击“磁贴编辑框中的“确定””
	jq("#confirmAddMagnet").on("click",function(a){

	
	  	var index = urlBefore.indexOf(".");
  		var num1 = urlBefore.substring(index-3,index+4);
  		
  		index = urlAfter.indexOf(".");
  		var num2 = urlAfter.substring(index-3,index+4);
  		
  		var magnetURL = jq("#magnetURL1").val();
  		var magnetWord = jq("#magnetWord1").val();
  		
  	
  		ThinkAjax.send("<?php echo U('Adset/changeMagnet');?>", 'ajax=1&before='+num1+'&after='+num2+"&head="+head+"&magnetURL="+magnetURL+"&magnetWord="+magnetWord, completechangeMagnet, 'mesforupload1');
	  
	  
	});
	
	
	/*
	*  编辑磁贴回调函数
	*/
	function completechangeMagnet(data, status)
	{
		
		if(status == 0)
			{
				jq('#'+data['oldfilename']).empty();
           		jq('#'+data['oldfilename']).html("<img src='"+data['src']+"' width=\"80\" height=\"80\" />");
           		jq(".blackBg2").hide();
           		
			}else{
				//jq('#mesforupload1').html('<p>'+data+'</p>');
			}
	}
	
	/*
	*  选中磁贴回调函数
	*/
	 function completecallMagnetmes(data, status)
     {
   	  if(status == 1)
   		  {
   		  
   		  $('magnetURL1').value = data['url'];
   		  $('magnetWord1').value = data['name'];
   		  	
   		
   		  }
   	  
      jq(".blackBg2").show();
   	 
     }
	
	/*
	*确认增加磁贴的回调函数
	*/
	
	function completeaddMagnet(data, status)
	{
		if(status == 0)
			{
			  var newMagnet=jq('<div class="col-md-4 col-sm-6"></div>').html(
					    '<div class="panel">'+
					    '<div class="panel-heading">'+
					    '<div class="panel-actions ba2" style="display:none">'+
					    '<span class="openMagnet">编 辑</span><button class="btn btn-mini btn-danger remove-panel">'+
					    '<i class="icon-remove"></i></button></div><img src="'+data['src']+'" width="80" height="80"/></div>'+
					    '</div>'
					  )
				jq("div#dashboard2 section.row").append(newMagnet);
			  
			  //清空标签
			  	
			  	jq(".blackBg3").hide();
			
			}else{
				//jq('#mesforupload2').html('<p>'+data+'</p>');
			}
	}
	
	
	//  点击磁贴编辑框中的“取消”
	jq("#cancelAddMagnet").on("click",function(){
	  jq(".blackBg2").hide();
	})

	//  磁贴中的“添加”框中的“确定”按钮
	jq("#confirmAddMagnet2").on("click",function(){
	
	  
	  if(urlAfter2)
		  {
		  	var index = urlAfter2.indexOf(".");
			var num = urlAfter2.substring(index-3,index+4);
			
			var magnetURL = jq("#magnetURL2").val();
			var magnetWord = jq("#magnetWord2").val();
			
			ThinkAjax.send("<?php echo U('Adset/changeMagnet');?>", 'ajax=1&before=567&after='+num+'&head='+head+'&magnetURL='+magnetURL+'&magnetWord='+magnetWord, completeaddMagnet, 'mesforupload2');
		 
		  }else
			  {
			  	jq('#mesforupload2').html('<p>请选择磁贴</p>');
			  }
	  	

	})
	
	

  //照片移动部分的代码
  !function (a, b) {
    "use strict";
    function c(b) {
      var c = b.data("url");
      c && (b.addClass("panel-loading").find(".panel-heading .icon-refresh,.panel-heading .icon-repeat").addClass("icon-spin"), a.ajax({
        url: c,
        dataType: "html"
      }).done(function (a) {
        b.find(".panel-body").html(a)
      }).fail(function () {
        b.addClass("panel-error")
      }).always(function () {
        b.removeClass("panel-loading"), b.find(".panel-heading .icon-refresh,.panel-heading .icon-repeat").removeClass("icon-spin")
      }))
    }

    var g = function (b, c) {
      this.jq = a(b), this.options = this.getOptions(c), this.draggable = this.jq.hasClass("dashboard-draggable") || this.options.draggable, this.init()
    };
    g.DEFAULTS = {
      height: 360,
      shadowType: "normal",
      sensitive: !1,
      circleShadowSize: 100
    }, g.prototype.getOptions = function (b) {
      return b = a.extend({}, g.DEFAULTS, this.jq.data(), b)
    },
    
//      图片和磁贴中的删除代码
      g.prototype.handleRemoveEvent = function () {
      var b = this.options.afterPanelRemoved, c = this.options.panelRemovingTip;
      this.jq.on("click", ".remove-panel", function () {
    	  
        var d = a(this).closest(".panel"), e = d.data("name") || d.find(".panel-heading").text().replace("\n", "").replace(/(^\s*)|(\s*jq)/g, ""), f = d.attr("data-id");
      
        //获取需要删除的图片的路径
        var imgSrc=jq(this).closest(".panel-actions").next("div").find('img').attr("src");
        var index=imgSrc.indexOf(".");
    	var num = imgSrc.substring(index+1,index+4);
    	
        if(num == 'jpg')
		{
        	var imgNumber=jq("#dashboard1").find(".panel").length;
            
        	if(imgNumber>=3&&imgNumber<=5){
             	
        	 num = imgSrc.substring(index-2,index+4);
        	
        	
        		  
        	ThinkAjax.send("<?php echo U('Adset/remove_pic');?>", "ajax=1&src="+num+"&head="+head, '', '');
        	
        	(void 0 === c || confirm(c.format(e))) && (d.parent().remove(), b && a.isFunction(b) && b(f));
			
    			
            }
            if(imgNumber<3){
              alert("轮播图片要求是2~5张，请添加图片后删除");
            }
		
		}else(num == 'png')
			{
			 	var magnetNumber=jq("#dashboard2").find(".panel").length;
		        
			 	num = imgSrc.substring(index-3,index+4);
	        
	        		  
	        	ThinkAjax.send("<?php echo U('Adset/remove_magnet');?>", "ajax=1&src="+num+"&head="+head, '', '');
	        	
		        
		        if(magnetNumber==1){
		          jq("#dashboard2").remove();
		        }
		    	(void 0 === c || confirm(c.format(e))) && (d.parent().remove(), b && a.isFunction(b) && b(f));
			
			}
       
      })
    },
    
//      2015/12/24 改by赖晓青 点击图片中的“编辑”，编辑相应图片的链接等属性
      g.prototype.handleEditImgEvent=function(){
      this.jq.on("click",".openImg",function(){
        var imgSrc=jq(this).closest(".panel-actions").next("div").find('img').attr("src");


		 var index=imgSrc.indexOf(".");
		 var num = imgSrc.substring(index-1,index);
	
		
        

        //加载图片编辑部分
        jq("#addImg").load("../Adset/addImg/head/"+head+"/src/"+num,function(a,status,c){
          console.log(status);
          if(status=="error"){
            jq("#addImg").text("判断加载失败");
          }
        })

    
        jq(".blackBg1").show();
      })

    },
//  点击图片中的“添加”部分
      g.prototype.handAddImgEvent=function(){
        jq("#add1").on("click",function(){

          //加载图片编辑部分
          jq("#addImg").load("../Adset/addImg/head/"+head+"/src/new",function(a,status,c){
            console.log(status);
            if(status=="error"){
              jq("#addImg").text("判断加载失败");
            }
          })

        
//          jq("#thisImg").attr("src",imgSrc);
          jq(".blackBg1").show();
        })

      },
      
   

//    点击磁贴中的“编辑”部分
      g.prototype.handleMagnetEvent=function(){
        this.jq.on("click",".openMagnet",function(){
        	
        urlBefore=jq(this).closest(".panel-actions").next("div").find("img").attr("src");
       	
          var magnetSrc=jq(this).closest(".panel-actions").next("div").find("img").attr("src");
          var index=magnetSrc.indexOf(".");
      	  var num = magnetSrc.substring(index-3,index+4);
      	
      	
      	  ThinkAjax.send("<?php echo U('Adset/callMagnetmes');?>", 'ajax=1&filename='+num+"&head="+head, completecallMagnetmes, '');
  
	  
          
          jq(".magnetList").find("img").each(function(){

            if(jq(this).attr("src")==="/Project001/TP/Public/images/"+num){
              jq(this).siblings().addClass("magnetBg");
              jq(this).removeClass("magnetBg");
              urlAfter=jq(this).attr("src");
            }
          });
          
          //  磁贴选中效果
          jq(".magnetList").children("img").on("click",function(){
            jq(this).siblings("img").addClass("magnetBg");
            jq(this).removeClass("magnetBg");
            urlAfter= jq(this).attr("src");
          })
          
          
       
          
         
        });
          
       
 
      },
      
     
      
     

      //      点击磁贴中的“添加”部分
      g.prototype.handleADDMagnetEvent=function(){
    	  
        jq("#add2").on("click",function(){
          jq(".magnetList").find("img").addClass("magnetBg");
          
          //  磁贴选中效果
          jq(".magnetList").children("img").on("click",function(){
            jq(this).siblings("img").addClass("magnetBg");
            jq(this).removeClass("magnetBg");
            urlAfter2= jq(this).attr("src");
          })
          
          //don't work
          urlAfter2 = 0;
          
          jq('#mesforupload2').empty();
          jq("#magnetURL2").val("");
          jq("#magnetWord2").val("");
          
          

          jq(".blackBg3").show();
        });
        
        jq("#cancelAddMagnet2").on("click",function(){
        
        
       
        	
          jq(".blackBg3").hide();
        })

      },

      g.prototype.handleRefreshEvent = function () {
      this.jq.on("click", ".refresh-panel", function () {
        var b = a(this).closest(".panel");
        c(b)
      })
    },
//      拖拉事件处理函数
      g.prototype.handleDraggable = function () {
      var c = this.jq, e = this.options, g = "circle" === e.shadowType, h = e.circleShadowSize, i = h / 2, j = e.afterOrdered;


      this.jq.addClass("dashboard-draggable"), this.jq.find(".remove-panel").mousedown(function (a) {
        a.preventDefault(), a.stopPropagation()
      }),this.jq.find(".openImg").mousedown(function(a){

        a.stopPropagation()
      }),this.jq.find(".openMagnet").mousedown(function(a){
        a.stopPropagation()
      });
      var k;

      /*----------------------------赖晓青改（2015、12、17）-----------------------------------------------------------------------------------*/
      this.jq.find(".panel-heading").mouseenter(function(){
        a(this).find(".panel-actions").show();
      })
      this.jq.find(".panel-heading").mouseleave(function(){
        a(this).find(".panel-actions").hide();
      })


      /*----------------------------赖晓青改（2015、12、24）-----------------------------------------------------*/
      this.jq.find(".panel-actions").mousedown(function (l){
//        a(this).find(".panel-actions").show();
        function m(c) {
          var g = A.data("mouseOffset");
          p = c.pageX - g.x, q = c.pageY - g.y, r = p + E, s = q + F, A.css({
            left: p,
            top: q
          }), z.find(".dragging-in").removeClass("dragging-in"), v = !1, u = null;
          var h, i = 0;
          z.children(":not(.dragging-col)").each(function () {
            var g = a(this);
            if (g.hasClass("dragging-col-holder"))return v = !e.sensitive || 100 > i, !0;
            var j = g.children(".panel"), k = j.offset(), l = j.width(), m = j.height(), n = k.left, o = k.top;
            if (e.sensitive)n -= C.left, o -= C.top, h = f(p, q, r, s, n, o, n + l, o + m), h > 100 && h > i && h > b.min(d(p, q, r, s), d(n, o, n + l, o + m)) / 3 && (i = h, u = g); else {
              var t = c.pageX, w = c.pageY;
              if (t > n && w > o && n + l > t && o + m > w)return u = g, !1
            }
          }), u && (t && clearTimeout(t), w = u, t = setTimeout(n, 50)), c.preventDefault()
        }


        function n() {
          w && (w.addClass("dragging-in"), v ? D.insertAfter(w) : D.insertBefore(w), c.addClass("dashboard-holding"), t = null, w = null)
        }

//        mouseup
        function o(b) {
          t && clearTimeout(t);
          var d = x.data("order");
          x.parent().insertAfter(D);
          var e = 0, f = {};
          z.children(":not(.dragging-col-holder)").each(function () {
            var b = a(this).children(".panel");
            b.data("order", ++e), f[b.attr("id")] = e, b.parent().attr("data-order", e)
          }), d != f[x.attr("id")] && (z.data("orders", f), j && a.isFunction(j) && j(f)), A.remove(), c.removeClass("dashboard-holding"), c.find(".dragging-col").removeClass("dragging-col"), c.find(".panel-dragging").removeClass("panel-dragging"), z.find(".dragging-in").removeClass("dragging-in"), c.removeClass("dashboard-dragging"), a(document).unbind("mousemove", m).unbind("mouseup", o), b.preventDefault()
        }
        /*---------------赖晓青改（2015/12/21）---------------------*/

        var p, q, r, s, t, u, v, w, x = a(this).closest(".panel"), y = x.parent(), z = x.closest(".row"), A = x.clone().addClass("panel-dragging-shadow"), B = x.offset(), C = c.offset(), D = z.find(".dragging-col-holder"), E = x.width(), F = x.height();
        D.length || (D = a('<div class="dragging-col-holder"><div class="panel"></div></div>').removeClass("dragging-col").appendTo(z)), k && D.removeClass(k), D.addClass(k = y.attr("class")), D.insertBefore(y).find(".panel").replaceWith(x.clone().addClass("panel-dragging panel-dragging-holder")), c.addClass("dashboard-dragging"), x.addClass("panel-dragging").parent().addClass("dragging-col"), A.css({
          left: B.left - C.left,
          top: B.top - C.top,
          width: E,
          height: F
        }).appendTo(c).data("mouseOffset", {
          x: l.pageX - B.left + C.left,
          y: l.pageY - B.top + C.top
        }), g && (A.addClass("circle"), setTimeout(function () {
          A.css({
            left: l.pageX - C.left - i,
            top: l.pageY - C.top - i,
            width: h,
            height: h
          }).data("mouseOffset", {x: C.left + i, y: C.top + i})
        }, 100)), a(document).bind("mousemove", m).bind("mouseup", o), l.preventDefault()
      })
    }, g.prototype.handlePanelPadding = function () {
      this.jq.find(".panel-body > table, .panel-body > .list-group").closest(".panel-body").addClass("no-padding")
    }, g.prototype.handlePanelHeight = function () {
      var c = this.options.height;
      this.jq.find(".row").each(function () {
        var d = a(this), e = d.find(".panel"), f = d.data("height") || c;
        "number" != typeof f && (f = 0, e.each(function () {
          f = b.max(f, a(this).innerHeight())
        })), e.each(function () {
          var b = a(this);
          b.find(".panel-body").css("height", f - b.find(".panel-heading").outerHeight() - 2)
        })
      })
    }, g.prototype.init = function () {
      this.handlePanelHeight(), this.handlePanelPadding(), this.handleRemoveEvent(),this.handAddImgEvent(),this.handleEditImgEvent(),this.handleMagnetEvent(),this.handleADDMagnetEvent(), this.handleRefreshEvent(), this.draggable && this.handleDraggable();
      var b = 0;
      this.jq.find(".panel").each(function () {
        var d = a(this);
        d.data("order", ++b), d.attr("id") || d.attr("id", "panel" + b), d.attr("data-id") || d.attr("data-id", b), c(d)
      })
    }, a.fn.dashboard = function (b) {
      return this.each(function () {
        var c = a(this), d = c.data("zui.dashboard"), e = "object" == typeof b && b;
        d || c.data("zui.dashboard", d = new g(this, e)), "string" == typeof b && d[b]()
      })
    }
  }(jQuery, Math)

  if(jq.fn.dashboard) jq('#dashboard1').dashboard({shadowType: 'normal'});
  if(jq.fn.dashboard) jq('#dashboard2').dashboard({shadowType: 'normal'});




</script>
</body>
</html>