<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    
    <script src="/TP/Public/js/jquery-1.11.0.min.js"></script>
    <script src="/TP/Public/js/jquery.webcam.min.js"></script>
    
    <script type="text/javascript" src="/TP/Public/AjaxJs/Base.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/prototype.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/mootools.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/Ajax/ThinkAjax.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/Form/CheckForm.js"></script>
    
    
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        a{
            font-size: 15px;
            text-decoration: none;
            color: #777;
            font-weight: bold;
        }
        .font_15{
            color: #90C74B;
        }
        /*--------------------------------------------top--------------------------------------------------------------*/
        .my_top {
            max-width:98%;
            min-width: 1000px;
            height:6px;
            margin: 0 auto;
            background-color:#1AB7D8;
        }
        /*--------------------------------------------header--------------------------------------------------------------*/
        .my_header {
            width: 980px;
            height: 100px;
            margin: 0 auto;
        }
        .my_header img{
            float: left;
            margin-top: 10px;
        }
        .my_header .header_menu{
            float: right;
            margin-top:36px ;
        }
        .my_header .header_menu span{
            margin-left: 20px;
            margin-right: 20px;
            color: #aaaaaa;
            font-size: 21px;
        }

        /*--------------------------------------------container--------------------------------------------------------------*/
        .my_container {
            max-width: 98%;
            min-width:1000px;
            height: 720px;
            background-color: #F9F7F8;
            margin: 0 auto;
            padding-top: 90px;
            /*border: 1px solid red;*/
        }

        /*--------------------------------------------container main--------------------------------------------------------------*/
        div.my_container div.main {
            max-width: 1000px;
            min-width: 800px;
            /*margin-top: 90px;*/
            margin: 0 auto;
            overflow: hidden;
            /*border: 1px solid orange;*/
        }
        div.main>img{
            float: left;
            margin-right: 20px;
        }
        .my_login{
            float: right;
            /*border: 1px solid yellow;*/
            background-color: white;
            padding: 20px;
            overflow: hidden;
        }
        div.my_login>p{
            /*border: 1px solid cyan;*/
            height: 43px;
            line-height: 43px;
        }
        div.my_login>p input{
            float: right;
            width: 200px;
            height: 30px;
            margin-right: 72px;
            padding-left: 10px;
            margin-left: 0;
        }
        div.my_login>a{
            border: 1px solid palegreen;
            float: left;
            margin-left: 70px;
            margin-right: 70px;
            background-color: #8EC448;
            color: white;
            width: 40px;
            height: 27px;
            padding: 5px;
            border-radius: 6px;
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
        }
       div.my_login>input{
            border: 1px solid palegreen;
            float: left;
            margin-left: 70px;
            margin-right: 70px;
            background-color: #8EC448;
            color: white;
            width: 50px;
            height: 36px;
            padding: 5px;
            border-radius: 6px;
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
        }
        #webcam{
            width: 320px;
            border:20px solid #333;
            background:#eee;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
        }

        #webcam {
            position:relative;
            margin-top:30px;
            margin-left:15px;
            margin-bottom:30px;
        }

        #webcam > span {
            z-index:2;
            position:absolute;
            color:#eee;
            font-size:10px;
            bottom: -16px;
            left:152px;
        }

        #webcam > div {
            border:5px solid #333;
            position:absolute;
            right:-90px;
            padding:5px;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            cursor:pointer;
        }

        #webcam a {
            background:#fff;
            font-weight:bold;
        }

        /*#canvas {*/
            /*border:20px solid #ccc;*/
            /*background:#eee;*/
        /*}*/

        #flash {
            position:absolute;
            top:0;
            left:0;
            z-index:5000;
            width:100%;
            height:500px;
            background-color:#c00;
            display:none;
        }

        object {
            display:block; /* HTML5 fix */
            position:relative;
            z-index:1000;
        }


    </style>
</head>
<body>
    <div class="my_top"></div>
    <div class="my_header">
        <img src="/TP/Public/images/login-logo.png">
        <div class="header_menu">
            <a href="#">关于我们</a><span>|</span>
            <a href="http://project001.com/TP/index.php/admin/signin/showsignupview" class="font_15" >免费注册</a>
        </div>
    </div>
    <div class="my_container">
        <div class="main">
            <img src="/TP/Public/images/login-mid.png">
             <form action="<?php echo U('Webcam/loginhandle');?>" method="post" >
            <div class="my_login">
                <p>
                	<span>手机号：</span><img src="/TP/Public/images/icon_user.png"/>
                	<input id="webcamloginphone" type="tel" value="手机号"  name="tel"/>
                </p>
                <div id="webcam">
                    <span>智能登陆</span>
                </div>
                <a href="javascript:check_webcamphone();void(0);">拍 照</a>
               
                
                 <input  type="submit" value ="登&nbsp;&nbsp;录" >
                
            </div>
            </form>
        </div>

    </div>
    
<script language="JavaScript">

    var str = 0;
    
    function check_webcamphone(){
    	
    str = document.getElementById('webcamloginphone').value;
	console.log(str);

	ThinkAjax.send("<?php echo U('Webcam/login');?>",'ajax=1&webcamphone='+str,completewebcamphone,'');
	
    }
	
	function completewebcamphone(data,status)
	{
		 
		 $('webcamloginphone').value = data;
		 if(status==1)
			 {
			    console.log('enter');
			 	webcam.capture();
			 	changeFilter();
			 }
	}
	
</script>

<script>


    var pos = 0;
    var ctx = null;
    var cam = null;
    var image = null;

    var filter_on = false;
    var filter_id = 0;

    function changeFilter() {
    	
    	console.log('filter');
    	
        if (filter_on) {
            filter_id = (filter_id + 1) & 7;
        }
    }

    function toggleFilter(obj) {
        if (filter_on =!filter_on) {   //滤波器状态取反，取反后判断其是否true or false
            obj.parentNode.style.borderColor = "#0c0";
        } else {
            obj.parentNode.style.borderColor = "#333";
        }
    }

    jQuery("#webcam").webcam({

        width: 320,
        height: 240,
        mode: "save",  //callback
        swffile: "/TP/Public/jQuery-webcam-master/jscam.swf",  //jscam_canvas_only.swf

        onTick: function(remain) {

            if (0 == remain) {
                jQuery("#status").text("Cheese!");
            } else {
                jQuery("#status").text(remain + " seconds remaining...");
            }
        },

        //功能：开启滤波器后，每拍一次照，效果是不同的，有8种效果；不开启的话是没有任何特殊效果的
        onSave: function(data) {

            var col = data.split(";");
            var img = image;

            if (false == filter_on) {

                for(var i = 0; i < 320; i++) {

                    var tmp = parseInt(col[i]);
                    img.data[pos + 0] = (tmp >> 16) & 0xff;
                    img.data[pos + 1] = (tmp >> 8) & 0xff;
                    img.data[pos + 2] = tmp & 0xff;
                    img.data[pos + 3] = 0xff;
                    pos+= 4;
                }

            } else {

                var id = filter_id;
                var r,g,b;
                var r1 = Math.floor(Math.random() * 255);
                var r2 = Math.floor(Math.random() * 255);
                var r3 = Math.floor(Math.random() * 255);

                for(var i = 0; i < 320; i++) {

                    var tmp = parseInt(col[i]);

                    /* Copied some xcolor methods here to be faster
                     than calling all methods inside of xcolor and to not
                     serve complete library with every req */

                    if (id == 0) {  //红色滤镜
                        r = (tmp >> 16) & 0xff;
                        g = 0xff;
                        b = 0xff;
                    } else if (id == 1) {  //绿色滤镜
                        r = 0xff;
                        g = (tmp >> 8) & 0xff;
                        b = 0xff;
                    } else if (id == 2) {  //蓝色滤镜
                        r = 0xff;
                        g = 0xff;
                        b = tmp & 0xff;
                    } else if (id == 3) {  //三色 取反
                        r = 0xff ^ ((tmp >> 16) & 0xff);  //异或取反
                        g = 0xff ^ ((tmp >> 8) & 0xff);
                        b = 0xff ^ (tmp & 0xff);
                    } else if (id == 4) {  //灰度图像

                        r = (tmp >> 16) & 0xff;
                        g = (tmp >> 8) & 0xff;
                        b = tmp & 0xff;
                        var v = Math.min(Math.floor(.35 + 13 * (r + g + b) / 60), 255);
                        r = v;
                        g = v;
                        b = v;
                    } else if (id == 5) {  // 彩色  32是？
                        r = (tmp >> 16) & 0xff;
                        g = (tmp >> 8) & 0xff;
                        b = tmp & 0xff;
                        if ((r+= 32) < 0) r = 0;
                        if ((g+= 32) < 0) g = 0;
                        if ((b+= 32) < 0) b = 0;
                    } else if (id == 6) {  //彩色 32是？
                        r = (tmp >> 16) & 0xff;
                        g = (tmp >> 8) & 0xff;
                        b = tmp & 0xff;
                        if ((r-= 32) < 0) r = 0;
                        if ((g-= 32) < 0) g = 0;
                        if ((b-= 32) < 0) b = 0;
                    } else if (id == 7) {  //彩色 乘以随机数
                        r = (tmp >> 16) & 0xff;
                        g = (tmp >> 8) & 0xff;
                        b = tmp & 0xff;
                        r = Math.floor(r / 255 * r1);
                        g = Math.floor(g / 255 * r2);
                        b = Math.floor(b / 255 * r3);
                    }

                    img.data[pos + 0] = r;
                    img.data[pos + 1] = g;
                    img.data[pos + 2] = b;
                    img.data[pos + 3] = 0xff;
                    pos+= 4;
                }
            }

            if (pos >= 0x4B000) {  //4B000 = 307200 = 76800*4 = 320*240*4
                ctx.putImageData(img, 0, 0);  //上传图像信息到ctx，ctx就是画布canvas
                pos = 0;
            }
        },
        onCapture: function () {
        	
        	str = document.getElementById('webcamloginphone').value;
            webcam.save('/TP/Application/Admin/WebcamUserFile/'+str+'/upload.php');  //js中是用+好连接字符串的

            jQuery("#flash").css("display", "block");
            jQuery("#flash").fadeOut(100, function () {
                jQuery("#flash").css("opacity", 1);
            });
        },

        debug: function (type, string) {
            jQuery("#status").html(type + ": " + string);
        },

        onLoad: function () {

            var cams = webcam.getCameraList();
            for(var i in cams) {
                jQuery("#cams").append("<li>" + cams[i] + "</li>");
            }
        }
    });

    function getPageSize() {

        var xScroll, yScroll;

        if (window.innerHeight && window.scrollMaxY) {
            xScroll = window.innerWidth + window.scrollMaxX;
            yScroll = window.innerHeight + window.scrollMaxY;
        } else if (document.body.scrollHeight > document.body.offsetHeight){
            // all but Explorer Mac
            xScroll = document.body.scrollWidth;
            yScroll = document.body.scrollHeight;
        } else {
            // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
            xScroll = document.body.offsetWidth;
            yScroll = document.body.offsetHeight;
        }

        var windowWidth, windowHeight;

        if (self.innerHeight) { // all except Explorer
            if(document.documentElement.clientWidth){
                windowWidth = document.documentElement.clientWidth;
            } else {
                windowWidth = self.innerWidth;
            }
            windowHeight = self.innerHeight;
        } else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
            windowWidth = document.documentElement.clientWidth;
            windowHeight = document.documentElement.clientHeight;
        } else if (document.body) { // other Explorers
            windowWidth = document.body.clientWidth;
            windowHeight = document.body.clientHeight;
        }

// for small pages with total height less then height of the viewport
        if(yScroll < windowHeight){
            pageHeight = windowHeight;
        } else {
            pageHeight = yScroll;
        }

// for small pages with total width less then width of the viewport
        if(xScroll < windowWidth){
            pageWidth = xScroll;
        } else {
            pageWidth = windowWidth;
        }

        return [pageWidth, pageHeight];
    }

//    window.addEventListener("load", function() {
//
//        jQuery("body").append("<div id=\"flash\"></div>");   //增加id是flash的div
//
//        var canvas = document.getElementById("canvas");
//
//        if (canvas.getContext) {
//
////        Canvas 对象表示一个 HTML 画布元素 - <canvas>。它没有自己的行为，
//// 但是定义了一个 API 支持脚本化客户端绘图操作。
////你可以直接在该对象上指定宽度和高度，但是，其大多数功能都可以
//// 通过 CanvasRenderingContext2D 对象获得。 这是通过 Canvas 对
//// 象的 getContext() 方法并且把直接量字符串 "2d" 作为唯一的参数
//// 传递给它而获得的。
//
//            ctx = document.getElementById("canvas").getContext("2d");  //ctx就是画布了
//            ctx.clearRect(0, 0, 320, 240); //矩形清除函数 可参看 http://www.w3school.com.cn/tags/canvas_clearrect.asp
//
//            var img = new Image();
//            img.src = "jQuery-webcam-master/beizi.jpg";  //src 设置或返回图像的 URL。
//            img.onload = function() {                     //onload  当图像装载完毕时调用的事件句柄。
//                ctx.drawImage(img, 0, 0, 320, 240);                //在画布上画画 可参看http://www.w3school.com.cn/tags/canvas_drawimage.asp
//            };
//
//            image = ctx.getImageData(0, 0, 320, 240);    //image获取数据吧
//        }
//
//        var pageSize = getPageSize();
//        jQuery("#flash").css({ height: pageSize[1] + "px" });
//
//    }, false);

    window.addEventListener("resize", function() {  //resize调整大小

        var pageSize = getPageSize();
        jQuery("#flash").css({ height: pageSize[1] + "px" });

    }, false);

</script>
</body>
</html>