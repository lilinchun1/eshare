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

		
<div class="box-wrap wrap-bg">
    <section class="my-income-wrap">
        <div class="my-icome-item icome1">
            <div class="div-p1">
                <a href="index.php?act=agent_balance">
                    <p class="icome1-p">
                        <span></span>
                         账户余额(￥)
<?php
//显示账户余额的信息 
$status=$apply_money['apply_status'];
$balance=$agent_info['total_balance'];
$apply_money=$apply_money['apply_money'];
if($apply_money!=null){
	if($status==-1||$status==0){
		$balance=($balance*100-$apply_money*100)/100;
?>

   <em>(提现中：<i><?php echo $apply_money?></i>)</em>
<?php		
	}
}?>                         
                        <em><?php echo $balance;?></em>
                    </p>
                </a>
            </div>
            <div class="div-p2">
                <a href="index.php?act=agent_income&op=withdraw_list">
                    <p class="icome1-p2">
                        <span></span>
                        累计提现(￥)
                        <!-- <em><?php echo $income['sum(apply_money)']==null? 0.00 : $income['sum(apply_money)'];?></em> -->
                        <em><?php echo $agent_info['total_withdraw']==null? 0.00 : $agent_info['total_withdraw'];?></em>
                    </p>
                </a>
            </div>
        </div>
        <div class="my-icome-item icome2">
<?php $bankcard_status=$agent_info['bankcard_status'];
        if($bankcard_status==0){
        	$card_status='未绑定';
        	$check='checkCard';
        }else if($bankcard_status==1){
        	$card_status='已绑定';
        	$check='noticeCard';
        }else if($bankcard_status==2){
        	$card_status='已绑定(<i>账户异常</i>)';
        	$check='noticeCard';
        }
   
   ?>      
            <a href="index.php?act=agent_income&op=<?php echo $check;?>"  >
                <p>
                    <span></span>
                    我的银行卡
                    <em><?php echo $card_status;?></em>
                </p>
            </a>
        </div>
        <div class="my-icome-item icome3">
 <?php
  $count=2-$count['count(agent_id)'];
  if($apply_money!=null){
  	if($status==0||$status==-1){
      	$text='正在结算中';
 ?>
 <a href="index.php?act=agent_income&op=apply" >
 <?php      	
      }else{
      	$text='本月可申请'.$count.'次';
 ?>
 <a href="index.php?act=agent_income&op=apply" > 
 <?php      	
      	if($count==0){
      		$text='申请次数已用完';
 ?>
 <a href="#" > 
 <?php      		
      	}
      }
  }else{
 	
  	$text='本月可提现2次';
 ?>
 <a href="index.php?act=agent_income&op=apply" > 
 <?php  	
  }   
  ?>        
             
                <p>
                    <span></span>
                    申请提现
                    <em><?php echo $text;?></em>
                </p>
            </a>
        </div>
        <div class="my-icome-item icome4">
            <a href="index.php?act=agent_income&op=apply_info">
                <p>
                    <span></span>
                    提现说明
                </p>
            </a>
        </div>
    </section>
     <footer class="foot">
        易享科技出品
    </footer>
</div>
</body>
</html>
