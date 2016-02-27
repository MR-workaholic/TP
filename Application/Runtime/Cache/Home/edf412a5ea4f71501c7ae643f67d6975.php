<?php if (!defined('THINK_PATH')) exit();?> <!--http://www.xarg.org/project/jquery-webcam-plugin/-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>thinkPHP下测试webcam</title>

</head>
<body>

<script src="/TP/Public/jQuery-webcam-master/jquery-1.11.0.min.js"></script>
<style type="text/css">
    #webcam, #canvas {
        width: 320px;
        border:20px solid #333;
        background:#eee;
        -webkit-border-radius: 20px;
        -moz-border-radius: 20px;
        border-radius: 20px;
    }

    #webcam {
        position:relative;
        margin-top:50px;
        margin-bottom:50px;
    }

    #webcam > span {
        z-index:2;
        position:absolute;
        color:#eee;
        font-size:10px;
        bottom: -16px;
        left:152px;
    }

    /*#webcam > img {*/
        /*z-index:1;*/
        /*position:absolute;*/
        /*border:0px none;*/
        /*padding:0px;*/
        /*bottom:-40px;*/
        /*left:89px;*/
    /*}*/

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

    /*#webcam a > img {*/
        /*border:0px none;*/
    /*}*/

    #canvas {
        border:20px solid #ccc;
        background:#eee;
    }

    #flash {
        position:absolute;
        top:0px;
        left:0px;
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

<script src="/TP/Public/jQuery-webcam-master/jquery.webcam.min.js"></script>

<h2>jQuery webcam example</h2>

<form method="post" action="<?php echo U('Webcam/makedir');?>">
	<input type="text" name="dirname" value=<?php echo ($dirname); ?>/>
	<input type="submit" value="send" />
</form>

<p id="status" style="height:22px; color:#c00;font-weight:bold;"></p>

<div id="webcam">

    <span>jQuery</span>

    <div>
        <a onClick="toggleFilter(this);">点击</a>
    </div>
</div>

<p style="width:360px;text-align:center;font-size:12px">
    <a  href="javascript:webcam.capture(3);changeFilter();void(0);">Take
    a picture after 3 seconds</a> | <a id="clicka" href="javascript:webcam.capture();changeFilter();void(0);">Take a picture
    instantly</a></p>
<!-- 
<p>
    <canvas id="canvas" height="240" width="320"></canvas>
</p>
 -->
<h3>Available Cameras</h3>
<ul id="cams"></ul>

<?php if(($dirname) == " "): ?><img src="/TP/Public/jQuery-webcam-master/load/0.jpg" alt="请拍照" style="width:320px; height:240px"/>
<?php else: ?>
	<img src="/TP/Application/Home/UserFile/<?php echo ($dirname); ?>/1.jpg" alt="请拍照" style="width:320px; height:240px"/><?php endif; ?>

<form method="post" action="<?php echo U('Webcam/handle');?>" >
	<input type="hidden" name="dirname" value=<?php echo ($dirname); ?>/>
	<input type="submit" value="查看信息"/>
</form>

<form method="post" action="<?php echo U('Webcam/FaceRegister');?>" >
	<input type="hidden" name="dirname" value=<?php echo ($dirname); ?>/>
	<input type="submit" value="人脸注册"/>
</form>

<form method="post" action="<?php echo U('Webcam/FaceVerifyDelete');?>" >
	<input type="hidden" name="dirname" value=<?php echo ($dirname); ?>/>
	<input type="submit" value="用户删除"/>
</form>

<form method="post" action="<?php echo U('Webcam/FaceVerify');?>" >
	<input type="hidden" name="dirname" value=<?php echo ($dirname); ?>/>
	<input type="submit" value="用户验证"/>
</form>

<form method="post" action="<?php echo U('Webcam/face_query');?>" >
	<input type="hidden" name="dirname" value=<?php echo ($dirname); ?>/>
	<input type="submit" value="注册查询"/>
</form>



  
<script type="text/javascript">
	var i=1;
	var str="/TP/Application/Home/UserFile/<?php echo ($dirname); ?>/"+i+".jpg";
	$(document).ready(function(){
		
		$("#clicka").click(function(){
			i++;
			var str="/TP/Application/Home/UserFile/<?php echo ($dirname); ?>/"+i+".jpg";
            setTimeout(function (){
                $("#cams").next().attr("src",str);
            }, 7000);
		});

	});

 
//
//    $("#camera").webcam({
//        width: 320,
//        height: 240,
//        mode: "callback",
//        swffile: "jQuery-webcam-master/jscam_canvas_only.swf",
//        onTick: function (remain) {
//
//            if (0 == remain) {
//                jQuery("#status").text("Cheese!");
//            } else {
//                jQuery("#status").text(remain + " seconds remaining...");
//            }
//        },
//        onSave: function (data) {
//
//            var col = data.split(";");
//            var img = image;
//
//            for (var i = 0; i < 320; i++) {
//                var tmp = parseInt(col[i]);
//                img.data[pos + 0] = (tmp >> 16) & 0xff;
//                img.data[pos + 1] = (tmp >> 8) & 0xff;
//                img.data[pos + 2] = tmp & 0xff;
//                img.data[pos + 3] = 0xff;
//                pos += 4;
//            }
//
//            if (pos >= 4 * 320 * 240) {
//                ctx.putImageData(img, 0, 0);
//                pos = 0;
//            }
//        },
//        onCapture: function () {
//
//            jQuery("#flash").css("display", "block");
//            jQuery("#flash").fadeOut("fast", function () {
//                jQuery("#flash").css("opacity", 1);
//            });
//
//            webcam.save();
//        },
//        debug: function (type, string) {
//            $("#status").html(type + ": " + string);
//        },
//        onLoad: function () {
//
//            var cams = webcam.getCameraList();
//            for (var i in cams) {
//                jQuery("#cams").append("<li>" + cams[i] + "</li>");
//            }
//        }
//    });

var pos = 0;
var ctx = null;
var cam = null;
var image = null;

var filter_on = false;
var filter_id = 0;

function changeFilter() {
	<?php echo ($num++); ?>;
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

//    onSave: function (data) {
//
//        var col = data.split(";");
//        var img = image;
//
//        for (var i = 0; i < 320; i++) {
//            var tmp = parseInt(col[i]);
//            img.data[pos + 0] = (tmp >> 16) & 0xff;
//            img.data[pos + 1] = (tmp >> 8) & 0xff;
//            img.data[pos + 2] = tmp & 0xff;
//            img.data[pos + 3] = 0xff;
//            pos += 4;
//        }
//
//        if (pos >= 4 * 320 * 240) {
//            ctx.putImageData(img, 0, 0);
//            pos = 0;
//        }
//    },

    onCapture: function () {
    	
    	var str = '<?php echo ($dirname); ?>';
        webcam.save('/TP/Application/Home/UserFile/'+str+'/upload.php');  //js中是用+好连接字符串的
        
       
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

window.addEventListener("load", function() {

    jQuery("body").append("<div id=\"flash\"></div>");   //增加id是flash的div

    var canvas = document.getElementById("canvas");

    if (canvas.getContext) {

//        Canvas 对象表示一个 HTML 画布元素 - <canvas>。它没有自己的行为，
// 但是定义了一个 API 支持脚本化客户端绘图操作。
//你可以直接在该对象上指定宽度和高度，但是，其大多数功能都可以
// 通过 CanvasRenderingContext2D 对象获得。 这是通过 Canvas 对
// 象的 getContext() 方法并且把直接量字符串 "2d" 作为唯一的参数
// 传递给它而获得的。

        ctx = document.getElementById("canvas").getContext("2d");  //ctx就是画布了
        ctx.clearRect(0, 0, 320, 240); //矩形清除函数 可参看 http://www.w3school.com.cn/tags/canvas_clearrect.asp

        var img = new Image();
        img.src = "/TP/Public/jQuery-webcam-master/beizi.jpg";  //src 设置或返回图像的 URL。
        img.onload = function() {                     //onload  当图像装载完毕时调用的事件句柄。
            ctx.drawImage(img, 0, 0, 320, 240);                //在画布上画画 可参看http://www.w3school.com.cn/tags/canvas_drawimage.asp
        }

        image = ctx.getImageData(0, 0, 320, 240);    //image获取数据吧
    }

    var pageSize = getPageSize();
    jQuery("#flash").css({ height: pageSize[1] + "px" });

}, false);

window.addEventListener("resize", function() {  //resize调整大小

    var pageSize = getPageSize();
    jQuery("#flash").css({ height: pageSize[1] + "px" });

}, false);


</script>

</body>
</html>