<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>我的收入</title>
<link href="css/style.css<?php echo STATIC_VER;?>" rel="stylesheet" type="text/css">
</head>
<body>
<div class="min">
	<div class="sub_top border_w">
		<div class="border_g">
			<a href="index.php?act=agent">返回</a>
			<div class="gy_top">我的收入</div>
		</div>
	</div>
	<!--提现现金-->
	<div class="S006_tx border_w">
		<div class="border_g">
			<div class="withdrawal">
				可提现金额(
				<samp>&nbsp;<?php echo $agent_info['total_income']?>&nbsp;</samp>
				)
				<a href="?act=document&op=setting&doc_code=money">
					<img src="images/wh.png" />
				</a>
			</div>
			<div class="balace_l">
				<P>账户余额</P>
				<p>
					<samp><?php echo $agent_info['total_income']?></samp>
				</p>
			</div>
			<div class="income_r">
				<P>累计收入</P>
				<p>
					<samp><?php echo $agent_info['total_income']?></samp>
				</p>
			</div>
		</div>
	</div>
	<!--绑定银行-->
<?php if($agent_info['bankcard_number']=='' || $agent_info['bankcard_name']==''  || $agent_info['bankcard_status']==0){?>
<div class="S006_but">
		<input type="button" value="绑定银行卡" onclick="checkCard();"/>
	</div>
<?php }else{ ?>
	<div class="S006_binding border_w <?php if($agent_info['bankcard_status']==2){ echo 'red';} ?>">
		<div class="border_g">
			<h4>
				银行卡绑定信息
				<?php if($agent_info['bankcard_status']==2){ ?><input type="button" class="apply" value="重新绑定" onclick="checkCard();"/><?php } ?>
			</h4>
			<!--按钮-->
			<ul>
				<li>持卡人姓名：&nbsp;<?php echo $agent_info['bankcard_name'];?></li>
				<li style="border: 0;">
					银行卡账号：
					<samp>
					<?php
						$card_number=$agent_info['bankcard_number'];
					    echo substr($card_number,0,4).' ******** '.substr($card_number,15,4);
					?></samp>
				</li>
			</ul>
		</div>
	</div>
 <?php }?>
<!--收入明细-->
	<div class="S006_detail_box border_w">
		<div class="border_g" id="moreload">
			<h4>收入明细</h4>
 <?php if(!empty($bill_list) && is_array($bill_list)){?>
 <?php foreach ($bill_list as $key=>$value){?>
 <?php if($value['bill_type']=='WITHDRAW'){?>
     <ul>
				<li class="li_border">

					<samp class=" orange">提现:￥-<?php echo $value['bill_amount']?></samp>
					<span class=" orange"><?php echo date('Y-m-d H:i:s',$value['bill_time']);?></span>
				</li>
			</ul>
 <?php }else{?>
 <a href="index.php?act=agent_detail&order_id=<?php echo $value['order_id']?>">
 <ul>
				<li class="li_border_1 her">
					<div class="li_border_1_1 her">订单总额：￥<?php echo $value['order_amount']?> </div>
					<span><?php echo date('Y-m-d H:i:s',$value['bill_time']);?></span>
				</li>
				<li class="li_border_2 her">
					<div class="li_border_1_1 her">佣金收入：￥<?php echo $value['bill_amount']?></div>					
				</li>
			</ul>
			</a>
 <?php }?>
 <?php }?>
        </div>
  </div>
	<div class="more border_w">
		<div class="border_g">
			<a href="javascript:;" id="loadMore">查看更多</a>
		</div>
	</div>
<?php }else{?>
      <ul >
		<li>暂无信息</li>
	  </ul>
<?php }?>
</div>
</body>
<script type="text/javascript" src="js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangyating 2014-9-22 修改 通用的分享功能-->
<script type="text/javascript" src="js/tmpl/shareWx.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<!-- zhangyating 2014-9-22 修改 end -->
<script type="text/javascript">
     function checkCard(){
           window.location.href="index.php?act=agent_income&op=checkCard";
         }
$(function(){
	  var page='<?php echo $nowpage?>';
	  var pagecounts='<?php echo $totalPages?>';
	  var pagecount='<?php echo $totalPage?>';

	  if(pagecounts<10){
	     	 $("#loadMore").hide();
	      }
  $("#loadMore").on(touchMethod,function() {

	  var url='index.php?act=agent_income&op=more';
		$.getJSON(url, {'p':++page}, function (data) {

			$.each(data,function(key,val){
				//console.log(val);
				var iteHtml="";
				var type=val['bill_type'];
				var date=val['bill_time'];
				if(type=='WITHDRAW'){
					 itemHtml='<ul><li class="li_border"><samp class=" orange">提现:￥- '+val['bill_amount']+'</samp><span class=" orange">'+date+'</span></li></ul>';
				}else{
                     itemHtml='<a href="index.php?act=agent_detail&order_id='+val['order_id']+'"><ul><li class="li_border_1 her"><div class="li_border_1_1 her">订单总额：￥'+val['order_amount']+'</div><span>'+date+'</span></li><li class="li_border_2 her"><div class="li_border_1_1 her">佣金收入：￥'+ val['bill_amount']+'</div></li></ul></a>';
				}
 				$('#moreload').append(itemHtml);
                 if(page>=pagecount){
                	 $("#loadMore").hide();
                   }
 				});
      });

   });
});
</script>
<!-- zhangxuanliang 2014-9-24 修改 站长统计功能-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- zhangxuanliang 2014-9-24 修改 end -->
</html>
