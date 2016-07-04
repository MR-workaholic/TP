<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
   
    <style>
      .themeAdd{
        width: 800px;
        margin: 0 auto;
        padding-left: 30px;
      }
      div.themeAdd ul div{
        display: inline-block;
        /*border: 1px solid orange;*/
        margin-right: 30px;
        margin-top: 20px;
        text-align: center;
      }
      div.themeAdd ul input{
        margin-right: 10px;
      }
      div.themeAdd ul li:nth-child(11) select{
        margin-top: 10px;
        margin-bottom: 10px;
        width: 160px;
        padding-left: 10px;
        /*border: 1px solid  yellow;*/
      }
      div.themeAdd ul li:nth-child(11) select option{
        padding-left: 10px;
      }
      div.themeAdd ul li:nth-child(12){
        /*border: 1px solid green;*/
        width: 180px;
        float: right;
      }
      div.themeAdd ul li:nth-child(12) input{
        margin-right: 20px;
      }
      .mymymy{
        background-color: rgba(0,0,0,.5);
        width: 100%;
        height: 100%;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1105;
        padding: 0;
        display: none;
        overflow: hidden;
      }
      div.modal-body{
        padding-left: 20px;
        z-index: 1111;
        width:300px;
        height: 150px;
        position: fixed;
        background-color: #fff;
        left: 45%;
        top: 40%;
        border-radius: 6px;
        box-shadow: 0 1px 15px rgba(0,0,0,.5);
        -webkit-box-shadow: 0 1px 15px rgba(0,0,0,.5);
      }
      div.modal-body button{
        float: right;
        margin-right: 20px;
        margin-top: 20px;
      }
    </style>
    
    <script type="text/javascript">
  
    
    function themeAdd(){
    	
    	ThinkAjax.sendForm('themeadd', "<?php echo U('Adset/themeadd');?>", completethemeAdd, '' );
    	
    }
    
    function completethemeAdd(data, status){
    	if(status == 1)
    		{
    			$('themeName').innerHTML = data['adname'];
    			
    			aid = data['aid'];
    			
    			 jq(".mymymy").show();
    			    //      阻止方向键、F5键默认行为
    			      jq(".virtual_body").keydown(function(event){
    			        if ((event.keyCode==37)||(event.keyCode==38)||(event.keyCode==39)||(event.keyCode==40)|| (event.keyCode==116)){
    			          event.keyCode=0;
    			          return false;
    			        }
    			      })
    		}
    	
    }
    
    </script>
    
</head>
<body>
  <div class="mymymy" >
    <div class="modal-body">
      <h4>您已成功添加广告主题【<span id="themeName">广告主题1</span>】</h4>
      <h4>是否开始设置主题详细信息？</h4>
      <button type="button" class="btn" data-dismiss="modal">取消</button>
      <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='adset(aid)'>确定</button>
    </div>
  </div>

  <div class="themeAdd">
  
  <form method="post" id='themeadd' action="<?php echo U('Adset/themeadd');?>">
    <h2>增加广告主题</h2>
    <p><span>广告主题 </span>指为用户提供 WiFi 上网认证功能的微型门户网站。一般是由欢迎页、认证页、认证后页等页面构成。
      <br/>当您为 WiFi 网络设置了<span>广告主题</span>之后，用户在访问您的 WiFi 时，将被强制浏览这些页面，才能上网。<br/>
      因此，您可以利用这些页面实现广告宣传和品牌营销。</p>
    <ul class="nav">
      <li><h3>主题名称</h3></li>
      <li><input type="text" name="themeName"/></li>
      <li><h3>选择模板</h3></li>
      <li>模板决定各页面的排版布局风格(暂时只有<strong>模板2(mo2)</strong>可用)</li>
      <li>
        <div>
          <?php if(($imgPath) == "0"): ?><img src="/tp/public/merchant/img/mo1.png" />
		  <?php else: ?>
		    <img src="/<?php echo ($host); ?>/tp/public/merchant/img/mo1.png" /><?php endif; ?>	
          <p><input type="radio" name="themeTemplate" value='mo1'/><label> mo1</label></p>
        </div>
        <div>
        	 <?php if(($imgPath) == "0"): ?><img src="/tp/public/merchant/img/mo2.png" />
		  	 <?php else: ?>
		    	<img src="/<?php echo ($host); ?>/tp/public/merchant/img/mo2.png" /><?php endif; ?>	
        	<p><input type="radio" name="themeTemplate" value='mo2'/><label> mo2</label></p></div>
        <div>
         <?php if(($imgPath) == "0"): ?><img src="/tp/public/merchant/img/mo3.png" />
		  <?php else: ?>
		    <img src="/<?php echo ($host); ?>/tp/public/merchant/img/mo3.png" /><?php endif; ?>	
        	<p><input type="radio" name="themeTemplate" value='mo3'/><label> mo3</label></p>
        </div>
        <div>
         <?php if(($imgPath) == "0"): ?><img src="/tp/public/merchant/img/mo4.png" />
		  <?php else: ?>
		    <img src="/<?php echo ($host); ?>/tp/public/merchant/img/mo4.png" /><?php endif; ?>	
        	<p><input type="radio" name="themeTemplate" value='mo4'/><label> mo4</label></p>
        </div>
        <div>
         <?php if(($imgPath) == "0"): ?><img src="/tp/public/merchant/img/mo5.png" />
		  <?php else: ?>
		    <img src="/<?php echo ($host); ?>/tp/public/merchant/img/mo5.png" /><?php endif; ?>	
        	<p><input type="radio" name="themeTemplate" value='mo5'/><label> mo5</label></p>
        </div>
        <div>
          <?php if(($imgPath) == "0"): ?><img src="/tp/public/merchant/img/mo6.png" />
		  <?php else: ?>
		    <img src="/<?php echo ($host); ?>/tp/public/merchant/img/mo6.png" /><?php endif; ?>	
        	<p><input type="radio" name="themeTemplate" value='mo6'/><label> mo6</label></p>
        </div>
        <div>
           <?php if(($imgPath) == "0"): ?><img src="/tp/public/merchant/img/mo7.png" />
		  <?php else: ?>
		    <img src="/<?php echo ($host); ?>/tp/public/merchant/img/mo7.png" /><?php endif; ?>	
        	<p><input type="radio" name="themeTemplate" value='mo7'/><label> mo7</label></p>
        </div>
        <div>
         <?php if(($imgPath) == "0"): ?><img src="/tp/public/merchant/img/mo8.png" />
		  <?php else: ?>
		    <img src="/<?php echo ($host); ?>/tp/public/merchant/img/mo8.png" /><?php endif; ?>	
        	<p><input type="radio" name="themeTemplate" value='mo8'/><label> mo8</label></p>
        </div>
      </li>
      <li><h3>备注</h3></li>
      <li></li>
      <li><input type="text" name="adremark"/></li>
      <li><h3>二次访问</h3></li>
      <li>若指定，则用户第一次认证时使用当前主题，后续的访问都将使用指定的二次主题。此功能可实现新老用户区别对待，<br/>
        二次主题的认证方式与当前主题一致。</li>
      <li>
        <select name="secondaryTheme">
          <option name="theme1">主题1</option>
          <option name="theme2">主题2</option>
          <option name="theme3">主题3</option>
        </select>
      </li>
      <li><input type="button" name="confirmAddTheme" class="btn" onclick='themeAdd()' data-backdrop="static" data-toggle="modal" data-target="#addSure" data-moveable="true" value="确定"/>
      	  <input type="button" name="cancelAddTheme" class="btn" value="取消"/></li>
    </ul>
    
    </form>
  </div>


<script>
/*
  jq("input[name='confirmAddTheme']").on("click",function(){
      jq(".mymymy").show();
    //      阻止方向键、F5键默认行为
      jq(".virtual_body").keydown(function(event){
        if ((event.keyCode==37)||(event.keyCode==38)||(event.keyCode==39)||(event.keyCode==40)|| (event.keyCode==116)){
          event.keyCode=0;
          return false;
        }
      })
  });
  */
  jq(".modal-body button").on("click",function(){
    jq(".mymymy").hide();
    jq(".virtual_body").keydown(function(event){
      if ((event.keyCode==37)||(event.keyCode==38)||(event.keyCode==39)||(event.keyCode==40)|| (event.keyCode==116)){
        return;
      }
    })
  })
</script>
</body>
</html>