<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="/TP/Public/dist/css/zui.min.css">
    <script src="/TP/Public/dist/js/jquery-1.11.0.min.js"></script>
    
    <script type="text/javascript" src="/TP/Public/AjaxJs/Base.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/prototype.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/mootools.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/Ajax/ThinkAjax.js"></script>
	<script type="text/javascript" src="/TP/Public/AjaxJs/Form/CheckForm.js"></script>
	
    <style>
      body{
        margin: 0;
        padding: 0;
      }
      div.mobile-my-after>p{
        text-align: center;
        margin-top: 20px;
      }
/*---------------------------2016/1/15手机端(⊙o⊙)哦---------------------------------------------------*/
      @media (max-width: 767px){
        .mobile-my-after{
          width: 320px;
          /*border: 1px solid red;*/
          margin: 10px auto;
        }
        .logoStyle{
          height: 42px;
          /*border: 1px solid yellow;*/
          margin-top: 10px;
          margin-bottom: 10px;
          /*border: 1px solid orange;*/
          text-align: center;
        }
        .mobile-my-imgauto{
          text-align: center;
        }
        div.mobile-my-imgauto>img{
          width: 320px;
          height: 200px;
          /*border: 1px solid orange;*/
          cursor: pointer;
          margin-bottom: 10px;
          -webkit-border-radius: 2px;
          -moz-border-radius: 2px;
          border-radius: 2px;
        }
        div.mobile-my-magnet{
          text-align: center;
          color: #666;
          /*border: 1px solid darkblue;*/
          overflow: hidden;
        }
        div.mobile-my-magnet>div{
          /*border: 1px solid orange;*/
          width: 158px;
          height: 160px;
          margin: 5px auto;
          float: left;
        }
        div.mobile-my-magnet img{
          width: 90px;
          height: 90px;
          /*border: 1px solid yellow;*/
          cursor: pointer;
        }
      }

      /*---------------------------2016/1/15 PC、平板、电脑 (⊙o⊙)哦---------------------------------------------------*/
      @media (min-width: 768px){
        .mobile-my-after{
          width: 768px;
          /*border: 1px solid red;*/
          margin: 10px auto;
        }
        .mobile-my-imgauto{
          text-align: center;
        }
        .mobile-my-imgauto>img{
          width: 768px;
          height: 400px;
          cursor: pointer;
          margin-bottom: 10px;
          -webkit-border-radius: 4px;
          -moz-border-radius: 4px;
          border-radius: 4px;
        }
        .logoStyle{
          height: 40px;
          /*border: 1px solid yellow;*/
          text-align: center;
        }

        .logoStyle{
          margin-top: 10px;
          margin-bottom: 10px;
        }
        div.mobile-my-magnet{
          text-align: center;
          color: #666;
          /*border: 1px solid orange;*/
          overflow: hidden;
        }
        div.mobile-my-magnet>div{
          float: left;
          /*border: 1px solid yellow;*/
          width: 220px;
          height: 200px;
          margin-left: 15px;
          margin-right: 15px;
          margin-top: 30px;
        }
        div.mobile-my-magnet img{
          width: 130px;
          height: 130px;
          cursor: pointer;
        }
      }

    </style>
</head>
<body>
<div class="mobile-my-after">

  <div class="mobile-my-imgauto" id="mobile-my-imgauto">
   
  </div>
  
  <div class="mobile-my-magnet">
  
  <?php if(is_array($Ipicarr)): foreach($Ipicarr as $key=>$vo): ?><div><a href="http://<?php echo ($vo["url"]); ?>" target="_blank"><img  src="<?php echo ($vo["src"]); ?>" /></a><h4><?php echo ($vo["name"]); ?></h4></div><?php endforeach; endif; ?>
	
 
  </div>
  <div class="logoStyle">
  	 <?php if(is_array($Lpicarr)): foreach($Lpicarr as $key=>$vo): ?><img  src="<?php echo ($vo); ?>" width="150" height="40"></br><?php endforeach; endif; ?>
  </div>
  <p>&copy;<?php echo ($vermes); ?></p>
</div>
<script>

	var picArray = new Array();
	var picHref = new Array();
	var jq = jQuery.noConflict();

	ThinkAjax.send("<?php echo U('Adset/Fpicmescall');?>", 'ajax=1&aid=<?php echo ($aid); ?>', completeFpicmescall, '');
	
	function completeFpicmescall(data, status)
	{
		if(status != 0)
			{
			
			jq('#mobile-my-imgauto').html("<img src=\""+data['src'][0]+"\" alt=\"轮播图片\" title=\"轮播图片\"/>");
			   
				var j = 0;
				for(j=0; j<status; j++)
					{
						picArray[j] = data['src'][j];
						picHref[j] = "http://"+data['url'][j];
					}
				 function slideImg(){
				      jq("div.mobile-my-imgauto>img").attr("src",picArray[i]);
				      i++;
				      if(i==picArray.length) {i=0};
				  }
				//图片轮播
				  var  timer=window.setInterval(slideImg,2000);
				  var i=0;
				  fpicClickLink();
				  
				  
			
			}
		
	}
  
  
 
  
  function fpicClickLink(){
	  
	    jq("img").on("click",function(){
	    	var j=0;
	    	for(j=0; j<picArray.length; j++)
	    		{
	    			if(jq(this).attr("src") == picArray[j])
	    				{
	    				 	window.open(picHref[j]);
	    		          	break;
	    				}
	    		}
	    })
	    }


</script>
</body>
</html>