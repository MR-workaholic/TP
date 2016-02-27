<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    
    <style>
      .theme-welcome{
        width: 800px;
        /*border: 1px solid red;*/
        padding-left: 20px;
        padding-right: 20px;
        margin: 0 auto;
        overflow: hidden;
      }
      div.theme-welcome ul li{
        /*border: 1px solid green;*/
        margin-bottom: 40px;
        padding-right: 20px;
      }
      div.theme-welcome ul li:nth-child(2){
        overflow: hidden;
      }
      div.theme-welcome ul li:nth-child(2)>div{
        width: 200px;
        height: 200px;
        border: 1px solid #CCCCCC;
        float: left;
        margin-right: 40px;
      }
      div.theme-welcome ul li:nth-child(2) input{
        /*border: 1px solid red;*/
        width: 70px;
        float: left;
      }
      div.theme-welcome ul+div{
        /*border: 1px solid yellow;*/
        float: right;
      }
      div.theme-welcome label{
        font-weight: normal;
      }
      div.theme-welcome  img+input,div.theme-welcome ul+div input{
        /*border: 1px solid cyan;*/
        margin-left: 20px;
      }
      div.theme-welcome ul h4{
        padding-top: 10px;
        border-top: 1px solid #CCCCCC;
      }
      div.theme-welcome textarea{
        resize: none;
      }
    </style>
   
   
</head>
<body>
<div class="theme-welcome">
  <ul>
    <li><h3>关于欢迎页</h3><span>
      未通过认证的用户连接 WiFi 后，打开浏览器访问任意网页都会被强制跳转至该页面，
      用户只有点击页面上的跳转按钮才能继续。
    </span></li>
    <li><h3>欢迎页图片</h3><p>
      以大图的形式向用户展示商家的品牌形象。文件大小不超过 1MB；格式为 png、jpg、gif；设计师建议的大小为：宽 400 像素，高 400 像素。
    </p>
      <div id="themeWelDiv">
      	<img src="<?php echo ($Simgsrc); ?>" width="200" height="200">
      </div>
      <input type="file" id="themeWelChooseImg" name="img"/>
    </li>
    <li><h3>欢迎文字</h3><span>
      文字将自动居中，请用"&lt;br /&gt;"换行。
    </span><br/>
    <textarea name="welcomeword" id='welcomeword' rows="3" cols="80">
     <?php echo ($welcomeword); ?>
    </textarea></li>
    <li><h3>跳转按钮</h3><span>
      设置跳转按钮的样式。
    </span>
      <h4>按钮文字</h4>
      <input type="text" name="fbtntext" id='fbtntext' value="<?php echo ($fbtntext); ?>"/>
      <h4>按钮背景颜色</h4>
      <label>请选择颜色值：</label>
      	<input type="hidden" id="hidden-input1" class="demo"  value="<?php echo ($fbtnbgcol); ?>">
      <h4>按钮字体颜色</h4>
      <label>请选择颜色值：</label>
      	<input type="hidden" id="hidden-input2" class="demo"  value="<?php echo ($fbtntxtcol); ?>">
    </li>
    <li><h3>
      微信关注指引</h3><span>
        用户进行认证时，如未关注公众则欢迎页显示微信关注指引，引导用户扫码关注。</span><h4>
      指引内容</h4><span>
      文字将自动居中，请用"&lt;br /&gt;"换行。</span><br/><textarea  name="guidecontent" id='guidecontent' rows="3" cols="80"><?php echo ($guidecontent); ?></textarea>
    <h4>
      打开按钮文字
    </h4><input type="text" name="sbtntext" id='sbtntext' value="<?php echo ($sbtntext); ?>"/>
    </li>
    
    <li><div id='mesforupload3'></div></li>
    
  </ul>
  <div>
  <input type="button" class="btn" name="confirmTheme-welcome" id="confirmTheme-welcome" onclick="return ajaxFileUpload('S');" value="保存"/>
 
  </div>
</div>
<script>
  //这是颜色选择器的代码
  jq('.demo').each( function() {
    
    jq(this).minicolors({
      control: jq(this).attr('data-control') || 'hue',
      defaultValue: jq(this).attr('data-defaultValue') || '',
      inline: jq(this).attr('data-inline') === 'true',
      letterCase: jq(this).attr('data-letterCase') || 'lowercase',
      opacity: jq(this).attr('data-opacity'),
      position: jq(this).attr('data-position') || 'bottom left',
      change: function(hex, opacity) {
//        log是获取的颜色值
        var log;
        try {
          log = hex ? hex : 'transparent';
          if( opacity ) log += ', ' + opacity;
          console.log(log);
          jq(this).val(log);
        } catch(e) {}
      },
      theme: 'default'
    });
  });

  //这是图片上传及选择图片时显示在div中的代码
  //  flat是上传的前缀
  function ajaxFileUpload(flat) {
    jq.post('<?php echo ($url_upload); ?>',{dir:"<?php echo ($uid); ?>/<?php echo ($order); ?>upload_file", uid:"<?php echo ($uid); ?>", theme:"<?php echo ($order); ?>",flat:flat}, 
    function (msg) {
      console.log(msg);
      jq.ajaxFileUpload
      ({
        url: "<?php echo ($url_upload); ?>", //你处理上传文件的服务端
        secureuri: false,
        fileElementId: 'themeWelChooseImg',
        dataType: 'json',
        success: function (data) {
         
        	 ret = data.ret;
             
             if(ret == 0)
           	  {
           	  	rank = data.rank;
           	  	jq('#themeWelDiv').empty();
                jq('#themeWelDiv').html('<img src="/tp/application/admin/userfile/<?php echo ($uid); ?>/<?php echo ($order); ?>upload_file/S0.jpg?rank='+rank+'" width="200" height="200" />');
   			   
           	  	
           	  }else if(ret == 3)
           		  {
   	        	
   	  				jq('#mesforupload3').html('<p>图片上传失败或没重新上传图片</p>');
   	  				  
           		  }
             
            var welcomeword  = jq('#welcomeword').val();
     		var fbtntext     = jq('#fbtntext').val();
     		var guidecontent = jq('#guidecontent').val();
     		var sbtntext     = jq('#sbtntext').val();
     		var fbtntxtcol   = jq('#hidden-input2').val();
     		var fbtnbgcol    = jq('#hidden-input1').val();
     		
     		ThinkAjax.send("<?php echo U('Adset/updataadwelmes');?>", "ajax=1&adbid=<?php echo ($adbid); ?>&welcomeword="+welcomeword+"&fbtntext="+fbtntext+"&guidecontent="+guidecontent+"&sbtntext="+sbtntext+"&fbtnbgcol="+fbtnbgcol+"&fbtntxtcol="+fbtntxtcol, '', '');
     		
        	
        }
      },"#themeWelDiv","#themeWelChooseImg",200,200);

      return false;
    });
  }
  //图片显示插件
  jq.imageFileVisible({wrapSelector: "#themeWelDiv",
    fileSelector: "#themeWelChooseImg",
    width: 200,
    height: 200
  });
</script>
</body>
</html>