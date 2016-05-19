<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="/Project001/TP/Public/dist/css/zui.min.css">
    <script src="/Project001/TP/Public/dist/js/jquery-1.11.0.min.js"></script>
    
    	<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/Base.js"></script>
		<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/prototype.js"></script>
		<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/mootools.js"></script>
		<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/Ajax/ThinkAjax.js"></script>
		<script type="text/javascript" src="/Project001/TP/Public/AjaxJs/Form/CheckForm.js"></script>
    
    <style>
		
 div.mobile-my-authen i{
        font-size: 25px;
      }

      /*------------------------移动端（2016/1/14）适用于手机---------------------------------------------*/
      @media(max-width:767px){
        .mobile-my-authen{
          width: 320px;
          /*border: 1px solid red;*/
          margin: 10px auto;
        }
        div.mobile-my-authen>p{
          text-align: center;
          margin-top: 70px;
        }
        .tabb{
          height: 35px;
          font-size: 16px;
          line-height: 35px;
          text-align: center;
          /*color: #666;*/
          color: #008800;
          cursor: pointer;
          border-bottom: 1px solid white;
          display: none;
        }
        .tabbSelected {
          background-color:rgba(255,255,100,.2);
        }
        .logoStyle{
          height: 40px;
          /*border: 1px solid yellow;*/
          position: relative;
        }
        .mybar{
          width: 40px;
          height: 40px;
          /*border: 1px solid green;*/
          text-align: center;
          line-height: 45px;
          margin-right: 10px;
          -webkit-border-radius: 4px;
          -moz-border-radius: 4px;
          border-radius: 4px;
          cursor: pointer;
          position: relative;
          top: -50px;
          left: 270px;
          background-color:rgba(0,0,13,.1);
        }
        .logoStyle,.mybar{
          margin-top: 10px;
          margin-bottom: 1px;
        }

        .mobile-login{
          /*border: 1px solid rosybrown;*/
          /*margin-top: 50px;*/
          padding-top: 50px;
          /*display: none;*/
        }

        .mobile-btn {
          width: 90px;
          height: 38px;
          border-radius: 4px;
          -webkit-border-radius: 4px;
          -moz-border-radius: 4px;
          /*border: 1px solid rgba(15,90,229,1);*/
          color: white;
          font-size: 17px;
         
        }

        div.mobile-login>div{
          width: 280px;
          height: 45px;
          /*border: 1px solid orange;*/
          font-size: 20px;
          line-height: 45px;
          margin: 20px auto;
          position: relative;
        }
        div.mobile-login>p{
          width: 280px;
          font-size: 15px;
          color: #666;
          margin: 0 auto;
        }
        div.mobile-login>div:nth-child(2)>input{
          width: 155px;
        }
        div.mobile-login>button{
          width: 200px;
          height: 44px;
          margin: 40px auto;
          /*border: 1px solid cyan;*/
          display: block;
        }

        div.mobile-login>div button{
          position: absolute;
          right: 0;
          top: 3px;
          /*border: 1px solid darkblue;*/
          display: block;
          line-height: 38px;
        }
        div.mobile-login>div input{
          position: absolute;
          left: 20px;
          height: 43px;
          width: 260px;
        }
        .wechat-login{
          font-size: 15px;
          /*border: 1px solid green;*/
          text-align: center;
          padding-top: 20px;
          display: none;
        }
        div.wechat-login>div{
          width: 280px;
          height: 300px;
          margin: 10px auto;
          background:url("/Project001/TP/Public/images/tieshi2.png") no-repeat;
          border-radius: 4px;
          padding-top: 40px;
          padding-left: 30px;
          padding-right: 30px;
          color: rgba(93,46,3,.7);
          box-shadow: 0 0 5px #888888;
        }
        div.wechat-login>div span{
          font-size: 20px;
          display: block;
        }
        div.wechat-login>button{
          width: 200px;
          margin-top: 20px;
        }
        .mobile-oneclick{
          display: none;
          padding-top: 70px;
          text-align: center;
          /*border: 1px solid yellow;*/
        }
        div.mobile-oneclick>button{
          width: 200px;
        }
      }

      /*------------------------移动端（2016/1/14）适用于PC、平板电脑---------------------------------------------*/
      @media(min-width: 768px){
        body{
          margin: 0;
          padding: 0;
          /*color:#996337;*/
        }
        .mobile-my-authen{
          width: 768px;
          /*border: 1px solid red;*/
          margin: 10px auto;
        }
        div.mobile-my-authen>p{
          text-align: center;
          margin-top: 100px;
        }
        .tabb{
          /*border: 1px solid orange;*/
          height: 60px;
          width: 200px;
          float: left;
          margin-bottom: 30px;
          font-size: 17px;
          text-align: center;
          line-height: 60px;
          color: #008800;
          cursor: pointer;
        }
        .tabbSelected {
          background-color:rgba(255,255,100,.2);
        }
        .logoStyle{
          /*border: 1px solid blue;*/
          width: 150px;
          height: 40px;
          float: right;
        }
        .mobile-login,.wechat-login,.mobile-oneclick{
          clear: both;
        }
        .mobile-btn {
          width: 200px;
          height: 50px;
          line-height: 50px;
          border-radius: 6px;
          color: white;
          font-size: 26px;
          
        }

        .mobile-login{
          margin-top: 150px;
          /*border: 1px solid yellow;*/
        }
        div.mobile-login>p{
          width:550px;
          margin: 0 auto;
          font-size: 16px;
          color: #666;
        }
        div.mobile-login>div{
          width: 550px;
          height: 50px;
          /*border: 1px solid orange;*/
          font-size: 28px;
          margin: 30px auto;
          position: relative;
        }

        div.mobile-login>button{
          width: 410px;
          margin: 20px auto;
          /*border: 1px solid cyan;*/
          display: block;
        }
        div.mobile-login>div>button{
          position: absolute;
          right: 5px;
          top: 0;
          display: block;
        }
        div.mobile-login>div input{
          width: 510px;
          position: absolute;
          left: 30px;
        }
        div.mobile-login>div:nth-child(3) input{
          width: 270px;
        }
        div.wechat-login{
          font-size: 17px;
          /*border: 1px solid green;*/
          text-align: center;
          display: none;
        }
        div.wechat-login>div{
          width: 500px;
          height: 400px;
          margin: 20px auto;
          background:url("/Project001/TP/Public/images/tieshi.png");
          border-radius: 4px;
          padding-top: 120px;
          padding-left: 40px;
          padding-right: 40px;
          color: rgba(93,46,3,.7);
          box-shadow: 0 0 5px #888888;
        }
        div.wechat-login>div span{
          font-size: 25px;
          display: block;
        }
        div.wechat-login>button{
          width: 400px;
          margin-top: 20px;
        }
        .mobile-oneclick{
          display: none;
          padding-top: 100px;
          text-align: center;
          /*border: 1px solid yellow;*/
        }
        div.mobile-oneclick>button{
          width: 400px;
        }
      }
    </style>
</head>
<body>
  <div class="mobile-my-authen">
    <div class="logoStyle">
    	
     <?php if(is_array($Lpicarr)): foreach($Lpicarr as $key=>$vo): ?><img  src="<?php echo ($vo); ?>" width="150" height="40"></br><?php endforeach; endif; ?>
		 
      <div class="mybar visible-xs"><i class="icon icon-bars"></i></div>
    </div>
    
    
    
    
    <?php if(($authentication) == "1"): ?><div id="onclick-login-my" class="tabb">一键登录</div>
	
    	<?php else: ?>
    		<?php if(($phone) == "1"): ?><div id="mobile-login-my" class="tabb">手机登录</div><?php endif; ?>
    		
    		<?php if(($wechat) == "1"): ?><div id="wechat-login-my" class="tabb">微信登录</div><?php endif; endif; ?>
    

    <div class="mobile-login">
      <p>请按照以下步骤登录：</p>
      <p><?php echo ($phoneguide); ?></p>
      
     
      <div>
      		<i class="icon icon-mobile"></i>
      		<input type="text" id="cellphoneNumber" name="cellphoneNumber"/>
      		
      		<button class="mobile-btn" onclick="sendMsg()">获取密码</button>	
      </div>
     
     
      <div><i class="icon icon-lock"></i><input type="text" id="cellPasword" name="cellPasword"/></div>
      <button class="mobile-btn"  onclick="regMsg()">登&nbsp;&nbsp;录</button>
    </div>

    <div class="wechat-login">
      <div><p>本店微信公众号为： <span><b>广联科技</b></span></p>
        <p>请按照以下步骤登录：</p>
        <div><?php echo ($wechatguide); ?></div>
        </div>
      <button class="mobile-btn ">登&nbsp;&nbsp;录</button>
    </div>

    <div class="mobile-oneclick">
      <form action="../../showad3/aid/<?php echo ($aid); ?>" method="post">
      	<input class="mobile-btn " type="submit" value="登&nbsp;&nbsp;录"/>
      </form>
    </div>
    
    
    <p>&copy;<?php echo ($vermes); ?></p>
  </div>
</body>
<script>
	
	var jq = jQuery.noConflict();
	var tbtnbgcol = "<?php echo ($tbtnbgcol); ?>";
	var tbtntxtcol = "<?php echo ($tbtntxtcol); ?>";
	var cc = '<?php echo ($cc); ?>';
	var rr = '<?php echo ($rr); ?>'; 
	var phoneNumber;
	var auth = '<?php echo ($authentication); ?>';
	
	if(auth == 1)
		{
			oneclickLogin();
		}else if(auth == 2)
			{
				var phone = '<?php echo ($phone); ?>';
				var wechat = '<?php echo ($wechat); ?>';
				
				if(phone == 1)
					{
						mobileLogin();
					}else if(wechat == 1)
						{
							wechatLogin();
						}else{
							oneclickLogin();
						}
				
			}
	
	
	
	
	function getOs()  
	{  
	    var OsObject = "";  
	   if(navigator.userAgent.indexOf("MSIE")>0) {  
	        return "MSIE";  
	   }  
	   if(isFirefox=navigator.userAgent.indexOf("Firefox")>0){  
	        return "Firefox";  
	   }  
	   if(isSafari=navigator.userAgent.indexOf("Safari")>0) {  
	        return "Safari";  
	   }   
	   if(isCamino=navigator.userAgent.indexOf("Camino")>0){  
	        return "Camino";  
	   }  
	   if(isMozilla=navigator.userAgent.indexOf("Gecko/")>0){  
	        return "Gecko";  
	   }  
	    
	}  
	var Os = getOs();  


	
	function RGB2RGBA(rgb_color,alp){
		//注：rgb_color的格式为#FFFFFF
		var r = parseInt("0x" + rgb_color.substr(1,2));
		var g = parseInt("0x" + rgb_color.substr(3,2));
		var b = parseInt("0x" + rgb_color.substr(5,2));
		var a = alp;//为透明度
		return "rgba(" + r + "," + g + "," + b + "," + a + ")";
		}
	
	
	
	
	jq(".mobile-btn").css({"color":tbtntxtcol});
	
	if(Os == 'MSIE') {
		jq(".mobile-btn").css({"background":"-ms-linear-gradient(top,"+RGB2RGBA(tbtnbgcol,0.6)+","+RGB2RGBA(tbtnbgcol,0.8)+","+RGB2RGBA(tbtnbgcol,1)+","+RGB2RGBA(tbtnbgcol,0.8)+","+RGB2RGBA(tbtnbgcol,0.6)+")"});
	}else if(Os == 'Firefox') {
		  jq(".mobile-btn").css({"background":"-moz-linear-gradient(top,"+RGB2RGBA(tbtnbgcol,0.6)+","+RGB2RGBA(tbtnbgcol,0.8)+","+RGB2RGBA(tbtnbgcol,1)+","+RGB2RGBA(tbtnbgcol,0.8)+","+RGB2RGBA(tbtnbgcol,0.6)+")"});
	   }else if(Os == 'Safari') {
		   jq(".mobile-btn").css({"background":"-webkit-linear-gradient(top,"+RGB2RGBA(tbtnbgcol,0.6)+","+RGB2RGBA(tbtnbgcol,0.8)+","+RGB2RGBA(tbtnbgcol,1)+","+RGB2RGBA(tbtnbgcol,0.8)+","+RGB2RGBA(tbtnbgcol,0.6)+")"});
	   }
	     

	
		function sendMsg(){
			
			 	phoneNumber = jq("#cellphoneNumber").val(); 
				ThinkAjax.send("<?php echo U('Adset/showad2_sendmsg');?>", "ajax=1&cc="+cc+"&rr="+rr+"&pn="+phoneNumber, completesendMsg, '');
			
			}
		
		function completesendMsg(data, status){
					
					if(status == 1)
					{
							cc = data['cc'];
							rr = data['rr'];
							phoneNumber = data['phoneNumber'];
				
							
						}
			
			}
			
		function regMsg(){
			
				var reg = jq("#cellPasword").val(); 
				 
				  ThinkAjax.send("<?php echo U('Adset/showad2_regmsg');?>", "ajax=1&cc="+cc+"&rr="+rr+"&pn="+phoneNumber+"&reg="+reg, completeregMsg, '');
			}
			
		function completeregMsg(data, status)
		{
			if(status==1)
				{
					window.location.href = "../../showad3/aid/<?php echo ($aid); ?>";
				}
			}
	
	
	
	
	
	//background: -moz-linear-gradient(top,rgba(15,90,229,0.6),rgba(15,90,229,.8),rgba(15,90,229,1),rgba(15,90,229,.8),rgba(15,90,229,0.6));
   // background: -webkit-linear-gradient(top,rgba(15,90,229,0.6),rgba(15,90,229,.8),rgba(15,90,229,1),rgba(15,90,229,.8),rgba(15,90,229,0.6));
   // background: -o-linear-gradient(top,rgba(15,90,229,0.6),rgba(15,90,229,.8),rgba(15,90,229,1),rgba(15,90,229,.8),rgba(15,90,229,0.6));
   // background: -ms-linear-gradient(top,rgba(15,90,229,0.6),rgba(15,90,229,.8),rgba(15,90,229,1),rgba(15,90,229,.8),rgba(15,90,229,0.6));
  

	function mobileLogin(){
		
			    jq('#mobile-login-my').addClass("tabbSelected");
			    jq("#wechat-login-my").removeClass("tabbSelected");
			    jq("#onclick-login-my").removeClass("tabbSelected");
			    jq(".mobile-login").show();
			    jq(".wechat-login").hide();
			    jq(".mobile-oneclick").hide();
			  }
	
	function wechatLogin(){
		
		jq("#wechat-login-my").addClass("tabbSelected");
	    jq("#mobile-login-my").removeClass("tabbSelected");
	    jq("#onclick-login-my").removeClass("tabbSelected")
	    jq(".mobile-login").hide();
	    jq(".wechat-login").show();
	    jq(".mobile-oneclick").hide();
		
	}
	
	function oneclickLogin(){
		
		 	jq("#onclick-login-my").addClass("tabbSelected");
		    jq("#wechat-login-my").removeClass("tabbSelected");
		    jq("#mobile-login-my").removeClass("tabbSelected")
		    jq(".mobile-login").hide();
		    jq(".wechat-login").hide();
		    jq(".mobile-oneclick").show();
		
	}

  //手机页面效果（2016、1、14）
  jq(".mybar").on("click",function(){
    jq(".tabb").slideToggle(500);
      //alert("hello")
  });
  
  jq("#mobile-login-my").on("click", mobileLogin);
  
  jq("#wechat-login-my").on("click", wechatLogin);
  
  jq("#onclick-login-my").on("click", oneclickLogin);
//  当窗口改变时，判断文档的宽度，如果大于768px，让导航条显示
  window.onresize=function(){
    if(document.body.clientWidth>=768){
      jq(".tabb").show();
//      alert(document.body.clientWidth);
    }
  }

</script>
</html>