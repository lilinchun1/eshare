<?php defined('InShopNC') or exit('Access Invalid!');?>
<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>我的收入</title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
<?php if($agent_info['bankcard_status']==2){?>
<div class="my-bank-alert" id="J-my-bank-alert">
        <p>账户异常</p>
        <p>原因可能是开户人姓名与实际不符，请修改银行卡绑定！</p>
        <div class="close">x</div>
</div>
<?php }?>
<div class="box-wrap wrap-bg h100p">
    <section class="my-bank-wrap">
        <div class="bank-logo"><img src="<?php echo IMG_CDN_URL;?>/v12/img/<?php echo $bank_info['logo']?>" alt=""/></div>
        <p>
            <em><?php echo $agent_info['bankcard_name'];?></em>
        </p>

        <p>
            <em><?php echo $bank_info['bank_name']?></em>  储蓄卡
        </p>
        <?php if(empty($agent_info['bankcard_number'])){?>
        <p></p>
        <?php }else{?> 
        <p>
           <?php 
              $str="";
              for($i=0;$i<strlen($agent_info['bankcard_number'])-4;$i++){
              	  $str.="*";
              }
           ?> 
           <?php echo substr_replace($agent_info['bankcard_number'],$str,0,strlen($agent_info['bankcard_number'])-4)?>
        </p>
        <?php }?>
    </section>
    <div class="bank-item-btn">
       <?php if(($apply_status['apply_status']!=0 && $apply_status['apply_status']!=-1) || $apply_status['apply_status']==null){?>
       
        <button type="button" class="draw-money-btn" onclick="modify();">修改银行卡</button>
        <?php }else{?>
        <button type="button" class="draw-money-btn disabled" disabled="disabled">修改银行卡</button>
        <?php }?>
    </div>
    
</div>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/notification.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script>
    window.onload = function () {
        var obox = document.getElementById("J-my-bank-alert");
        obox.onclick = function () {
            obox.style.display = "none";
        }
    }
    function modify(){
    	$.post("index.php?act=agent_income&op=modifyCard", function(result){
			var data = result.datas;
			if(data.error){
				floatNotify.simple(data.error);
			}else{
		     	setTimeout('window.location.href="index.php?act=agent_income&op=checkCard";', 1000)
			}
		}, 'json');   
           
	   }
</script>
</body>
</html>