<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
   
    <style>
      *{margin: 0;
        padding: 0;
      }
      .authenticationSet{
        width: 800px;
        margin: 0 auto;
      }
      div.authenticationSet div:first-child span{
        margin-right: 30px;
      }
      /*---------一键登录和账号登录-----------*/
      .oneclickLogin,.signin1{
        width: 800px;
        margin-top: 20px;
      }

    </style>
    
    <script type="text/javascript">
    
       function updataauthen(authen)
       {
    		ThinkAjax.send("<?php echo U('Authentication/updataauthentication');?>",'ajax=1&authen='+authen,completeupdataauthen,'');	
       }
       
       function completeupdataauthen(data, status)
       {
    	   
       }
    
    </script>
</head>
<body>
<!--认证设置-->
<div class="authenticationSet">

<div>
  <form name="authentication">
  <span> <input type="radio" id="freeAuthen" name="authentication" value="nosignin"/>免认证</span>
  <span> <input type="radio" id="oneclickLogin" name="authentication" value="onclickLogin"/>一键登录</span>
  <span> <input type="radio" id="signin" name="authentication" value="signin"/>账户登录</span>
  </form>
</div>
  <!-- 账户登录-->
  <div class="signin1" style="display: none"></div>

  <!-- 一键登录-->
  <div class="oneclickLogin" style="display: none"></div>

</div>

 <script language="JavaScript">
 
 
 
 
 function radioSelect(aValue,radio_oj)
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

	ThinkAjax.send("<?php echo U('Authentication/authenticationmescalling');?>",'ajax=1&calling='+'y',completeauthenticationmescalling,'');
	
	function completeauthenticationmescalling(data,status)
	{
		if(status==1)
			{
			
			   var radio_value;
			
			   switch(data['authentication'])
			   {
			     case "1":  radio_value='onclickLogin'; jq(".oneclickLogin").show();jq(".signin1").hide();break;
			     case "2":  radio_value='signin';jq(".signin1,.oneclickLogin").show();break;
			     default: radio_value='nosignin'; jq(".oneclickLogin,.signin1").hide();
			   }
			   //console.log(radio_value);
			   
			   radioSelect(radio_value,document.authentication.authentication);
			   
			}
	}
	
	
		
	
	
	
	
</script>

<script>
  var jq=jQuery.noConflict();
//authen1,authen2,authen3分别代表选择的是“免认证”，“一键登录”和“账户登录”
var authen1,authen2,authen3;
//  点击“免认证”
  jq("#freeAuthen").on("click",function(){
//    authen1为所选的框的状态
    authen1=jq(this)[0].checked;
    if(authen1){
      updataauthen(0);
      jq(".oneclickLogin,.signin1").hide();
    }
   
  });

//加载“一键登录”和帐户登录,objdiv就指待加载内容的div，url是指所加载的页面url
function login(objdiv,url){
  objdiv.load(url,function(a,status,c){
    console.log(status);
    if(status=="error"){
      objdiv.text("加载失败");
    }
  })
}

login(jq(".oneclickLogin"),"../Authentication/oneClickLoginshow");
login(jq(".signin1"),"../Authentication/signinshow");

//  点击“一键登录”
  jq("#oneclickLogin").on("click",function(){
    authen2=jq(this)[0].checked;
    if(authen2){
//      加载“一键登录”
      updataauthen(1);
      jq(".oneclickLogin").show();
      jq(".signin1").hide();
    }
  });

//  点击“账户登录”
jq("#signin").on("click",function(){
  authen3=jq(this)[0].checked;
  if(authen3){
	updataauthen(2);
    jq(".signin1,.oneclickLogin").show();
  }
})


</script>
</body>
</html>