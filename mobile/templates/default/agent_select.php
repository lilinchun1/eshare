<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<script src="<?php echo MOBILE_SITE_URL;?>/templates/default/js/jquery-1.8.0.min.js"></script>
<title>WEKA</title>
<link href="<?php echo MOBILE_SITE_URL;?>/templates/default/css/style.css" rel="stylesheet" type="text/css">

</head>
<script>
$('document').ready(function(){
	var windowHeight = $(window).height();
	$(".shuoming").attr('style','height:'+windowHeight*0.5+'px;overflow-x:hidden;overflow-y:auto;');
});
</script>
<body>
<div class="process shuoming">
	<h4>申请流程</h4>
    <div class="process_text">
    1.开账户：请携带企业的“营业执照”和“机构代码证”正本以及复印件（加盖公章），并带齐企业公章、银行预留印鉴章（财务章、私章），到就近的光大银行网点办理开户手续（如已是光大银行对公客户可免此步骤）。<br />

2.申请网上银行：向光大银行索取相关文件，包括申请书、协议书、授权书及代办协议等，填妥后交给开户行的柜台人员；（申请时客户要根据自身的特点和需求选择适用的网上银行版本） 。<br />

1.开账户：请携带企业的“营业执照”和“机构代码证”正本以及复印件（加盖公章），并带齐企业公章、银行预留印鉴章（财务章、私章），到就近的光大银行网点办理开户手续（如已是光大银行对公客户可免此步骤）。<br />

2.申请网上银行：向光大银行索取相关文件，包括申请书、协议书、授权书及代办协议等，填妥后交给开户行的柜台人员；（申请时客户要根据自身的特点和需求选择适用的网上银行版本） 。<br />


    </div>
    
</div>
 <input type="button" class="S006_but4" onclick="location.href='<?php echo MOBILE_SITE_URL;?>/index.php?act=agent&op=agent_phonecheck&channel_qrcode=<?php echo $output['channel_qrcode']?>&store_id=<?php echo $output['store_id'];?>&is_agent=<?php echo $output['is_agent'];?>'" value="申请开店" />
 <input type="button" class="S006_but3" onclick="location.href='<?php echo MOBILE_SITE_URL;?>/index.php?act=agent&op=agent_login&channel_qrcode=<?php echo $output['channel_qrcode']?>&store_id=<?php echo $output['store_id'];?>&is_agent=<?php echo $output['is_agent'];?>'" value="登 录" />
</body>
</html>