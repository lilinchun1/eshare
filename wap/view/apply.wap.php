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
<div class="box-wrap wrap-bg h100p">
    <section class="apply-cash-wrap">
        <p>
            <?php if($apply_status['apply_status']==0||$apply_status['apply_status']==-1){
            	$money=($agent_info['total_balance']*100-$apply_status['apply_money']*100)/100;
            }else{
            	$money=$agent_info['total_balance'];
            }
            ?>
            <em>账户余额(￥)</em> <i><?php echo $money;?></i>
        </p>

        <p>
            <input class="apply-cash-input" type="tel" name="apply_money" id="apply_money" placeholder="请填写申请金额"/>
        </p>

        <p>
            <span>每月10日，25日为结算日，结算后1-2天可到账，请注意查收。</span>
        </p>

        <p> <?php if($apply_status['apply_status']==1 || $apply_status['apply_status']==null||$apply_status['apply_status']==2){?>
            <button type="button" class="draw-money-btn" id="J_code" >确定</button>
           <?php }else{?>
           <button type="button" class="draw-money-btn disabled" disabled="disabled" id="J_code" >确定</button>
           <?php }?>
        </p>
    </section>
    <div class="overlay" id="J_overlay"></div>
    <div class="modal" id="con1">
        <p>
            <span class="alert-logo" id="J-alt-pic"></span>
        </p>
        <p id="J-alt-con">
            
        </p>
        <p>
            <button type="button" class="mode-btn" id="J_btn">确定</button>
        </p>
    </div>
</div>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script>
$(function(){
	var bankcard_status='<?php echo $bankcard_status;?>';
		if(bankcard_status==0){
		    altBox("未绑定银行卡",1,"index.php?act=agent_income&op=checkCard");
		 }else if(bankcard_status==2){
	        altBox("银行卡状态异常",1,"index.php?act=agent_income&op=checkCard");
		 }   

	});            
		$("#J_code").on(touchMethod, function(e){
			//有disabled直接返回不验证
			if($(this).hasClass("disabled")){
				return;
			}
			check();
		});	 
 
function altBox(txt, logo,Ourl) {
    var overlay = document.getElementById("J_overlay");
    var con1 = document.getElementById("con1");
    var btn = document.getElementById("J_btn");
    var altCon = document.getElementById("J-alt-con");
    var altPic = document.getElementById("J-alt-pic");
    var scrolltop = document.body.clientHeight;
    //var scrolltop = document.documentElement.scrollTop || document.body.scrollTop;
    altCon.textContent=altCon.innerText = txt;
    switch (logo) {
        case 1:
            altPic.className = "alert-logo";
            break;
        case 2:
            altPic.className = "alert-logo yes-logo";
            break;
    }
    
    overlay.style.display = "block";
    con1.style.display = "block";
    overlay.style.height = document.body.clientHeight + scrolltop + 'px';
    btn.onclick = function () {
        //alert("22222222");
        overlay.style.display = "none";
        con1.style.display = "none";
        if(Ourl){
            window.location.href = Ourl;
        }
    };
}
	function check(){
	  	var balance='<?php echo intval($agent_info['total_balance'])?>';
 	  	var apply_money = $('#apply_money').val();
 	  	var apply_name='<?php echo $agent_info['bankcard_name'];?>';
 	  	var apply_bank='<?php echo $agent_info['bankcard_type'];?>';
 	  	var apply_bankcard='<?php echo $agent_info['bankcard_number'];?>';
 	  	var agent_id='<?php echo $agent_info['agent_id'];?>';
 	  	var reg=/^[0-9]*$/; 
  	  	 if(apply_money==''){
  	 		altBox("不能为空",1);
  	  	 }else if(!reg.test(apply_money)){
  	  		altBox("格式不正确",1);
  	  	 }else if(balance<100){
  	  		altBox("余额小于100",1);
  	  	 }else if(Number(apply_money)<100){
  	  		altBox("申请金额不能小于100",1);
  	  	 }else if(Number(apply_money) > Number(balance)){
  	  		altBox("输入金额不得大于余额",1);
  	  	 }else{
   	  		$.post("index.php?act=agent_income&op=checkApply", {'apply_money':apply_money,'apply_name':apply_name,'apply_bank':apply_bank,'apply_bankcard':apply_bankcard,'agent_id':agent_id}, function(result){
    				var data = result.datas;
    				if(data.error){
    					altBox(data.error,1);
    				}else{               
    				altBox("申请已提交，请等待结算... ",2,"index.php?act=agent_income&op=income"	);
    			   		
  				    
    				}
  			 
   			}, 'json');

  	  	 }

 	   }	

</script>
</body>
</html>