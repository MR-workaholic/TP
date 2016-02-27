<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/Project001/TP/Public/dist/js/jquery-1.11.0.min.js"></script>
    <title></title>
    <style>
      /*------------------------移动端（2016/1/12）适用于手机---------------------------------------------*/
      @media(max-width:767px){
        div.mobile-my-welcome{
          width: 320px;
          height: 460px;
          margin: 0 auto;
          /*border: 1px solid red;*/
        }
        div.mobile-my-welcome div:nth-child(1)>img{
          width: 300px;
          height: 300px;
          /*border: 1px solid orange;*/
        }
        .welButton{
          display: block;
          width: 256px;
          height: 40px;
          margin: 10px auto 9px auto;
          border-radius: 6px;
          -webkit-border-radius: 6px;
          background-color: #19B0CA;
          color: #FFFFFF;
          font-size: 18px;
        }
        .welcomeDiv{
          text-align: center;
          /*border: 1px solid yellow;*/
        }
        div.mobile-my-welcome div:nth-child(2){
          font-size: 15px;
          margin-top: 5px;
        }
        div.mobile-my-welcome{
          color:#666666;
          font-size: 13px;
        }
        div.mobile-my-welcome div:nth-child(5){
          margin-top: 8px;
        }
      }

      /*------------------------（2016/1/12）适用于平板电脑或笔记本---------------------------------------------*/
      @media(min-width: 768px){
        div.mobile-my-welcome{
          margin: 0 auto;
          width: 768px;
          height: 850px;
          /*border: 1px solid red;*/
        }
		div.mobile-my-welcome div:nth-child(1)>img{
          width: 400px;
          height: 400px;
          /*border: 1px solid orange;*/
        }
        .welcomeDiv{
          text-align: center;
          /*border: 1px solid orange;*/
        }
        .welButton{
           display: block;
           width: 350px;
           height: 50px;
           /*border: 1px solid yellow;*/
           margin: 20px auto;
           border-radius: 6px;
           -webkit-border-radius: 6px;
           background-color: #19B0CA;
           color: #FFFFFF;
           font-size: 18px;
        }
        div.mobile-my-welcome div:nth-child(2){
          font-size: 16px;
          margin-top: 15px;
        }
        div.mobile-my-welcome{
          color:#666666;
          font-size: 16px;
        }
        div.mobile-my-welcome div:nth-child(5){
          margin-top: 30px;
        }
      }

    </style>
</head>
<body>
<div class="mobile-my-welcome">
  <div class="welcomeDiv">
  
  	<?php if(is_array($Spicarr)): foreach($Spicarr as $key=>$vo): ?><img  src="<?php echo ($vo); ?>"></br><?php endforeach; endif; ?>
  	
  </div>
  <div class="welcomeDiv"><?php echo ($welcomeword); ?></div>
  <div>
  
  <form action="../../../../showad2/aid/<?php echo ($aid); ?>" method="post">
  	<input type='submit' id="welButton" class="welButton" value="<?php echo ($fbtntext); ?>"/>
  </form>
  	
  </div>
  <div class="welcomeDiv">&copy;<?php echo ($vermes); ?></div>
  
 
</div>
<script type="text/javascript">

	var fbtnbgcol = "<?php echo ($fbtnbgcol); ?>";
	var fbtntxtcol = "<?php echo ($fbtntxtcol); ?>";
  	$("#welButton").css({ "background-color":fbtnbgcol, "color":fbtntxtcol});
  	
  	

</script>
</body>
</html>