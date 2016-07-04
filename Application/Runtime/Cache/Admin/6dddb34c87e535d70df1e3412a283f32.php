<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title></title>
   
   

    <style>
      .addImg{
        padding-left: 30px;
        padding-right: 30px;
        z-index: 1111;
        position: fixed;
        background-color: #fff;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        box-shadow: 0 1px 15px rgba(0,0,0,.5);
        -webkit-box-shadow: 0 1px 15px rgba(0,0,0,.5);
        width:550px;
        height: 430px;
        left: 37%;
        top: 30%;
        /*border: 1px solid red;*/
        overflow: hidden;
      }
      .addImg .yd{
        margin-right: 30px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        width: 150px;
        height: 80px;
      }
      div.addImg hr{
        clear: both;
      }
      div.addImg>button{
        /*border: 1px solid orange;*/
        float: right;
        margin-right: 20px;
        margin-top: 20px;
      }
      div.addImg div:nth-child(5),div.addImg div.yd{
        float: left;
        margin-top: 5px;
        /*border: 1px solid yellow;*/
      }
      div.addImg div:nth-child(5) input{
        width: 70px;
        /*border: 1px solid green;*/
        position:absolute;
        /*margin-left: 100px;*/
      }
      div.addImg div:nth-child(5) button{
        position: absolute;
        margin-top: 40px;
      }
      div.addImg p:nth-child(3){
        color: red;
      }
      div.addImg input[type='text']{
        width: 240px;
        /*height: 30px;*/
      }
    </style>
</head>
<body>
<div class="addImg">
  <h3>图片文件</h3>
  <p>文件大小不超过 1MB；格式为: gif, jpg, png；设计师建议的大小为：宽 500 像素，高 200 像素。</p>
  <p>注意：各图片间的宽高应保持一致，如不一致则部分轮播图片底部会出现空白。</p>
  <div id="thisImg" class="yd" >
  
  		<?php if(($src) != "new"): ?><img src="/Project001/TP/Application/admin/userfile/<?php echo ($uid); ?>/<?php echo ($head); ?>upload_file/F<?php echo ($src); ?>.jpg?rank=<?php echo ($rank); ?>" width="150" height="80" ><?php endif; ?>
  		 
  </div>
  <div><input id="imgChoose" type="file" size="1" name="img"></div>
  <hr/>
  <h3>图片链接 URL</h3>
  <p>用户点击图片时，打开的页面 URL。</p>
  <div><input type="text" name="imgURL" id="imgURL" width="300" value="<?php echo ($url); ?>"/><span>（可不填）</span></div>
  <button type="button" class="btn" id="cancelAddImg">取消</button>
  <button type="button" class="btn btn-primary" id="imgUpload" data-dismiss="modal" onclick="return ajaxFileUpload('F');">确定</button>
	<div id="mesforupload"></div>
</div>

<script>

	
	var url_upload = "http://<?php echo ($hosts); ?>/tp/application/admin/userfile/<?php echo ($uid); ?>/<?php echo ($head); ?>do_file_upload.php";
  	
//  flat是上传的前缀
  function ajaxFileUpload(flat)
  {
   
    var ret;//上传的结果
    var rank; //图片后的随机数
    var filename; //图片的名字
    var add; //是否新上传图片
    var dbret; //是否记载URL成功
    
    var url=jq("#imgURL").val();
    jq.post(url_upload, {dir:"<?php echo ($uid); ?>/<?php echo ($head); ?>upload_file", uid:"<?php echo ($uid); ?>", theme:"<?php echo ($head); ?>", src:"<?php echo ($src); ?>", flat:flat, imgURL:url}, 
    		
    function(msg){   //回调函数
      console.log(msg);
      jq.ajaxFileUpload
      (
        {
          url:url_upload,//"do_file_upload.php", //你处理上传文件的服务端
          secureuri:false,
          fileElementId:'imgChoose',
          dataType: 'json',
          success: function (data)
          {
        	  ret = data.ret;
        	 
        if(ret == 0)
        	{
            rank = data.rank;
          	filename = data.filename;
          	add = data.add;
          	dbret = data.dbret;
          
         
           
            if(add == 0)
            	{
	            	jq('#'+filename).empty();
	               	jq('#'+filename).html('<img src="/Project001/TP/Application/admin/userfile/<?php echo ($uid); ?>/<?php echo ($head); ?>upload_file/'+filename+'.jpg?rank='+rank+'" width="150" height="80" />');
  			   	}else{
  			   		
  			   		var src = '/Project001/TP/Application/admin/userfile/<?php echo ($uid); ?>/<?php echo ($head); ?>upload_file/'+filename+'.jpg?rank='+rank;
  			   	
  			   		var new_content = '<div class="panel"><div class="panel-heading">'+
  			   						  '<div class="panel-actions ba1" style="display:none"><span class="openImg">编 辑</span>'+
  			   						  '<button class="btn btn-mini btn-danger remove-panel"><i class="icon-remove"></i></button>'+
  			   						  '</div><div id="'+filename+'"><img src="'+src+'" width="150" height="80"/></div></div></div>';
  			   		
  			   		var new_div=jq('<div class="col-md-4 col-sm-6" data-id="1"></div>').html(new_content);				  
  			   		jq('#Fpic').append(new_div);
  			   		
  			   		
  			   	}
            
            if(dbret)
            	{
             		jq(".blackBg1").hide();	
            	}else{
            		jq('#mesforupload').html('<p>URL设置失败</p>');
            	}
          
           	
        	}else if(ret == 2)
        		{
        			jq('#mesforupload').html('<p>最多只能上传五张图片</p>');
        		}else if(ret == 3)
        			{
        				dbret = data.dbret;
        			
        				if(dbret)
        					{
        						jq('#mesforupload').html('<p>图片上传失败或没上传图片，URL设置成功</p>');
        					}
        				else{
        					jq('#mesforupload').html('<p>图片上传失败或没上传图片，URL设置失败</p>');
        				}
        				
        			}
            

          }
        }
      );

    })

    return false;
  }
    //图片显示插件
    jq.imageFileVisible({wrapSelector: "#thisImg",
      fileSelector: "#imgChoose",
      width: 150,
      height: 80
    });

  //点“取消”按钮取消显示“图片编辑”
  jq("#cancelAddImg").on("click",function(){
    jq(".blackBg1").hide();
  })

</script>
</body>
</html>