<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
   
    <style>
      .theme-whole{
        width: 800px;
        padding-left: 20px;
        padding-right: 20px;
        /*border: 1px solid red;*/
        overflow: hidden;
        margin: 0 auto;
      }
      div.theme-whole ul li:nth-child(3){
        clear: both;
        padding-top: 10px;
      }
      div.theme-whole ul textarea{
        resize: none;
      }
      div.theme-whole ul img{
        border: 1px solid #c0c0c0;
      }
      div.theme-whole >div{
        float: right;
        /*border: 1px solid yellow;*/
      }
      div.theme-whole >div input{
        margin-left: 20px;
      }

      div.theme-whole input[type='file']{
        /*border: 1px solid red;*/
        width: 70px;
        /*float: left;*/
      }
      .logoContent {
        width: 150px;
        height: 40px;
        /*border: 1px solid orange;*/
        border: 1px solid #ccc;
        float: left;
        margin-right: 30px;
      }
    </style>
</head>
<body>
<div class="theme-whole">
  <ul>
    <li><h3>关于广告主题</h3><span>广告主题 指为用户提供 WiFi 上网认证功能的微型门户网站。一般是由欢迎页、认证页、认证后页等页面构成。您可以在各页面设置广告或商讯等内容。</span></li>
    <li><h3>网站标题</h3><p>选择网站的 logo 图片，格式为 png、jpg、gif；设计师建议的大小为：宽 150 像素，高 40 像素。</p>
      	<div id="logoDiv" class="logoContent">
      		<img src="<?php echo ($imgsrc); ?>" width="150" height="40"/>
     	</div>
      <input type="file" id="themeWholeImg" name="img"/>
    </li>
    <li>
	    <h3>版权信息</h3>
	    <span>显示在页脚的版权信息。文字将自动居中，请用"&lt;br /&gt;"换行。</span>
	    <br/>
	    <textarea rows="3" cols="50" id='vermes'><?php echo ($vermes); ?></textarea>
    </li>
    <li> <div id='mesforupload2'></div> </li>
  </ul>
 
  <div>
  <input  type="button" id="confirmTheme-whole" name="confirmTheme-whole" class="btn" onclick="return ajaxFileUpload('L');" value="保存"/>
  </div>
</div>
<script>


	var ret;//上传的结果
	var rank; //图片后的随机数
	var dbret; //是否记载URL成功 
	
  //  flat是上传的前缀
  function ajaxFileUpload(flat) {
	  
	var vermes = jq('#vermes').val();
	  
    jq.post('<?php echo ($url_upload); ?>',{dir:"<?php echo ($uid); ?>/<?php echo ($order); ?>upload_file", uid:"<?php echo ($uid); ?>", theme:"<?php echo ($order); ?>",flat:flat}, 
    function (msg) {
      console.log(msg);
      jq.ajaxFileUpload
      ({
        url: '<?php echo ($url_upload); ?>', //你处理上传文件的服务端
        secureuri: false,
        fileElementId: 'themeWholeImg',
        dataType: 'json',
        success: function (data) {
        	
          ret = data.ret;
          
          if(ret == 0)
        	  {
        	  	rank = data.rank;
        	  	jq('#logoDiv').empty();
               	jq('#logoDiv').html('<img src="/tp/application/admin/userfile/<?php echo ($uid); ?>/<?php echo ($order); ?>upload_file/L0.jpg?rank='+rank+'" width="150" height="40" />');
			   
        	  	
        	  }else if(ret == 3)
        		  {
	        	
	  				jq('#mesforupload2').html('<p>图片上传失败或没重新上传图片</p>');
	  				  
        		  }
          
          ThinkAjax.send("<?php echo U('Adset/updatavermes');?>", "ajax=1&adbid=<?php echo ($adbid); ?>&vermes="+vermes, '', '');
   		

         
        }
      },"#logoDiv","#themeWholeImg",150,40);

      return false;
    });
  }
  //图片显示插件
  jq.imageFileVisible({wrapSelector: "#logoDiv",
    fileSelector: "#themeWholeImg",
    width: 150,
    height: 40
  });

</script>
</body>
</html>