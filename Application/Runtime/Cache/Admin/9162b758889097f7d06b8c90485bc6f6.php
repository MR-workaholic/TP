<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
   
    <style>
      *{
        margin: 0;
      }
      .theme-basic{
        width: 800px;
        /*border: 1px solid red;*/
        padding-left: 20px;
        padding-right: 20px;
        margin: 0 auto;
        position: relative;
      }
      div.theme-basic ul{
        list-style-type: none;
        /*border: 1px solid orange;*/
      }
      div.theme-basic ul li{
        padding-top: 10px;
        padding-bottom: 10px;
        /*border: 1px solid yellow;*/
      }
      div.theme-basic ul li span{
        display: inline-block;
        /*border: 1px solid green;*/
        font-size: 15px;
        font-weight: bold;
        margin-right: 15px;
      }
      div.theme-basic ul li label{
        margin-left: 3px;
        margin-right: 10px;
      }
      div.theme-basic ul select{
        width: 80px;
      }
      label{
        font-weight: normal;
      }
      div.theme-basic>div{
        /*border: 1px solid cyan;*/
        overflow: hidden;
      }
      div.theme-basic>div input{
        margin-left: 20px;
        float: right;
      }
      .tip{
        background-color: #ddf3f5;
        padding: 7px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        box-shadow: 0 1px 6px;
        filter:alpha(opacity=50);
        opacity: 0.5;
        display: none;
      }
      div.theme-basic div+p{
        position: absolute;
        width: 305px;
        /*border: 1px solid purple;*/
        margin-top: -175px;
        margin-left: 160px;
      }
      div.theme-basic p+p{
        position: absolute;
        width: 500px;
        /*border: 1px solid purple;*/
        margin-top: -115px;
        margin-left: 160px;
      }
      .mytip{
        background-color: #e3e3e3;
        border: none;
        padding: 2px 5px 2px 5px;
        border-radius: 4px;
        -webkit-border-radius:4px;
      }
    </style>
    <script language="JavaScript">
    
    function updatathemebasic()
    {
    	var adname = jq('#adname').val();
    	var adremark = jq('#adremark').val();
    	var adstatus = jq("input[name='adstatus']:checked").val();
    	ThinkAjax.send("<?php echo U('Adset/updatathemebasic');?>",'ajax=1&aid=<?php echo ($aid); ?>&adname='+adname+'&adstatus='+adstatus+'&adremark='+adremark, completeupdatathemebasic,'');
    }
    
    function completeupdatathemebasic(data, status)
    {
    	if(status == 1)
    		{
    			alert('设置成功');
    		}else if(status == 2)
    			{
    				alert('您已开启改主题为您的路由器广告');
    			} if(status == 3)
    				{
    					alert('您没有开启任何主题为您的路由器广告');
    				}
    			
    			var adname = jq('#adname').val();
    			jq('#adnameshow').empty();
    			jq('#adnameshow').html(adname);
    }
    
    </script>
</head>
<body>
<div class="theme-basic">
  <ul>
    <li>
	    <span>广告主题的名称：</span><input type="text" name="adname" id="adname" value="<?php echo ($adname); ?>"/>
	    
    </li>
    <li><span>编号：</span><label><?php echo ($order); ?></label></li>
    
    <li>
    	<form name='adstatus'>
    		<span>开启状态：</span>
    		<input type="radio" name="adstatus" value='Y'/><label>开</label>
    		<input type="radio" name="adstatus" value='N'/><label>关</label>
    	</form>
    </li>
    
    <li><span>应用的模板：</span><span><?php echo ($admodel); ?></span></li>
    
    <li>
    	<span>备注信息：</span>
    	<span><textarea  rows="3" name="adremark" id="adremark" style="resize: none;"><?php echo ($adremark); ?></textarea></span>
    </li>
    
    
    
    <li><span>应用设备：</span><select name="appEquipment">
        <option value="设备1" selected="selected">设备1</option>
        <option value="设备2">设备2</option>
        <option value="设备3">设备3</option>
      </select>
    </li>
    
    <li><span>默认主题：</span><input id="tip1" type="button" class="mytip" value="提示"/><br/>
      <input type="checkbox" name="defaultTheme"/><label>设为默认主题</label>
    </li>
    <li><span>二次访问：</span><input type="button" id="tip2" class="mytip" value="提示"/><br/>
      <select name="themeName">
        <option value="主题1" selected="selected">主题1</option>
        <option value="主题2">主题2</option>
        <option value="主题3">主题3</option>
      </select>
    </li>
  </ul>
  <div>
  	<input type="button" class="btn" name="cancelTheme-basic" onclick="updatathemebasic()" value="保存">
  </div>
  <p class="tip" id="1">当新设备接入时，使用该主题作为新设备的主题。</p>
  <p class="tip" id="2">若指定，则用户第一次认证时使用当前主题，后续的访问都将使用指定的二次主题。
    此功能可实现新老用户区别对待，二次主题的认证方式与当前主题一致。</p>
</div>
<script>

	var adstatus = "<?php echo ($adstatus); ?>";

	function radioSelectforad(aValue,radio_oj)
	{
		   for(var i=0;i<radio_oj.length;i++) 
		   {
		        if(radio_oj[i].value==aValue)
		        {  
		            radio_oj[i].checked=true; 
		            break; 
		        }
		   }
		}
	
	radioSelectforad(adstatus,document.adstatus.adstatus);
	
	
	
  //提示的显示与隐藏
//  tip(jq("input[name='tips2']"),jq("#2"));
  var btnTip1=jq("#tip1");
  var btnTip2=jq("#tip2");

  btnTip2.on("mouseover",function (){
    jq("#2").show();
    jq("#1").hide();
  });
  btnTip2.on("mouseout",function (){
    jq("#2").hide();
  });
  btnTip1.on("mouseover",function (){
    jq("#1").show();
    jq("#2").hide();
  });
  btnTip1.on("mouseout",function (){
    jq("#1").hide();
  });
</script>
</body>
</html>