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
<title>管理中心 </title>
<link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
<!-- 双12 zyt -->
<style type="text/css">
.pop1{width:100%;height:100%;position:fixed;top:0px;left:0px;z-index:999999999;background:url('http://<?php echo $_SERVER['SERVER_NAME']?>/weka/double_twelve/img/gl.png?1416552228') no-repeat rgba(0,0,0,0.7);background-size:100%}
</style>
<!-- 双12 zyt -->
</head>
<body>
<div class="box-wrap">
    <div class="my-bank-alert my-bank-alert2" id="J-my-bank-alert" style="display:none;">
        <p>关注提醒：</p>
        <p>请点此关注新玉麟海参微信公众号</p>
        <div class="close">×</div>
    </div>
    <header class="head">
        <div class="head-left">
            <div class="pic-wrap">
                <a class="pic-wrap-a" href="?act=personal_center&op=index">
                    <img src="<?php echo getWxImg($agent_info['member_avatar'],"132");?>" alt=""/>
                </a>
				<div class="head_vip"> <img src="<?php echo IMG_CDN_URL;?>/v12/img/icon/dp_vip<?php echo $lv['level_id']; ?>.png<?php echo STATIC_VER;?>"> </div>
            </div>
        </div>
        <div class="head-right">
            <div class="head-right-set">
                <a href="?act=document" title="设置"></a>
            </div>

            <h1 class="head-shop-tt_xyl">
                 <?php echo $agent_info['agent_name'];?>
            </h1>
            <!--
            <div class="shop-level">
                <a href="">
                    <span class="wz">级别:</span>

                    <span class="shop-level-l"><img src="v12/img/level_2x/l-level1.png" alt=""/></span>

                    <span class="wz2"></span>
                </a>
            </div>-->
            <div class="message">
                <a href="?act=document&op=article&ac_code=message" title="消息"></a>
            </div>
            <div class="number" id="J_noticeMsg" style="display:none"></div>
        </div>
    </header>
    <section class="income">
        <ul class="income-list">
            <li>
               <em><?php echo $agent_info['total_sales'];?></em>
                <i>我的业绩</i>
            </li>
            <li class="income-list-mid">
                <em><?php echo number_format($totalNum,2);?></em>
                <i>团队业绩</i>
            </li>
            <li>
                <em><?php echo $agent_info['total_income'];?></em>
                <i>我的收入</i>
            </li>
        </ul>
    </section>
    <section class="function-wrap">
        <ul class="function-item">
            <li>
                <a href="?act=agent_index" style="color:#999;">
                    <div class="function-item-logo">

                    </div>
                    <h3>我的店铺</h3>
                </a>
            </li>
            <li>
                <a href="?act=agent_order" id="J_order" style="color:#999;">
                    <div class="function-item-logo">
                        <span class="number" id="J_noticeOrder" style="display:none">0</span>
                    </div>
                    <h3>订单管理</h3>
                </a>
            </li>
            <li>
                <a href="?act=agent_income&op=income" id="J_income" style="color:#999;">
                    <div class="function-item-logo">
                         <span class="number" id="J_noticeIncome" style="display:none">0</span>
                    </div>
                    <h3>我的收入</h3>
                </a>
            </li>
            <li>
                <a href="?act=agent&op=team_index" id="J_team" style="color:#999;">
                    <div class="function-item-logo">
                        <span class="number" id="J_noticeTeam" style="display:none">0</span>
                    </div>
                    <h3>我的团队</h3>
                </a>
            </li>
            <li>
                <a href="?act=document&op=article&ac_code=strategy"style="color:#999;">
                    <div class="function-item-logo">

                    </div>
                    <h3>新手宝典</h3>
                </a>
            </li>
            <li>
                <a href="http://<?php echo $_SERVER['SERVER_NAME']?>/weka/double_twelve/index.php?act=ranking_list&op=index" style="color:#999;">
                    <div class="function-item-logo">

                    </div>
                    <h3>双12</h3>
                </a>
            </li>
        </ul>
    </section>
    <footer class="foot">
        易享科技出品
    </footer>
    <!--双12浮层 -->
    <div id="pop-up" onclick="document.getElementById('pop-up').style.display='none';">
        <div class="pop1"></div>
    </div>
    <!--双12浮层 -->
</div>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/common.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/zepto.min.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo IMG_CDN_URL;?>/v12/js/share/agent.js<?php echo STATIC_VER;?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo WAP_SITE_URL;?>/index.php?act=state&op=addState&agent_id=<?php echo $agent_id;?>&page=agent_admin&page_id=1&event=agent_admin"></script>
<script>
var Notice = {
	defaultNotice : {
		view_msgid  : "",
		time_team   : "0",
		time_order  : "0",
		time_income : "0"
	},
	init: function(){
		var _this = this;
		_this.getData(_this.update);

		//红点
		$("#J_order,#J_team,#J_income").click(function(e){
			e.preventDefault();
			var type = this.id.replace("J_", "time_");
			_this.setPoint(type, this.href);
		});
	},
	merge: function(notice){
		var result = this.defaultNotice;
		for(var key in result){
			if(notice[key])
				result[key] = notice[key];
		}
		return result;
	},
 	getData: function(cb){
		var notice = getstorage("notice"), _this = this;
		if(notice == undefined){
			$.get("?act=statist&op=getNotice&uid=<?php echo $agent_id;?>&keys=view_msgid,time_team,time_order,time_income", function(result){
				var json = result.datas;
				if(json.status){
					notice = _this.merge(json.data);
				}else{
					notice = _this.defaultNotice;
				}
				setstorage("notice", JSON.stringify(notice));

				cb.call(_this, notice);
			}, 'json');
		}else{
			try{
				notice = JSON.parse(notice);
				notice = this.merge(notice);
			}catch(e){
				notice = this.defaultNotice;
			}
			setstorage("notice", JSON.stringify(notice));
			cb.call(this, notice);
		}
	},
	update : function(notice){
		//获取消息阅读量
		$.get("?act=document&op=artlist&ac_code=message", function(result){
			var data = result.datas, unread = [];
			if(data.status){
				artids = data.idlist.split(","), reads = notice.view_msgid ? notice.view_msgid.split(",") : [];
				for(i=0;i<artids.length;i++){
					if(!contains(reads, artids[i])){
						unread.push(artids[i]);
					}
				}
				if(unread.length){
					var num = unread.length > 99 ? '99' : unread.length;
					$("#J_noticeMsg").html(num).show();
				}
			}
		}, 'json');

		//获取订单、收入、团队
		var group = ['Order','Income','Team'], _this = this, _cur = 0;
		var timer = setInterval(function(){
			if(_cur >= group.length) {
				clearInterval(timer);
				return;
			}

			var idx = group[_cur], timestamp = parseInt(notice["time_" + idx.toLowerCase()]);
			if(isNaN(timestamp))
				timestamp = 0;

			_this.showRed(idx, timestamp);
			_cur ++ ;
		}, 30);
	},
	showRed : function(idx, timestamp){
		$.get("?act=statist&op=" +idx.toLowerCase()+ "Red&uid=<?php echo $agent_id;?>&timestamp=" + timestamp, function(result){
			var json = result.datas;
			if(json.status && parseInt(json.data)){
				$("#J_notice"+idx).html(json.data).show();
			}
		}, 'json');
	},
	setPoint: function(type, href){
		var notice = JSON.parse(getstorage("notice")), data = {}, timestamp = (new Date().getTime())/1000;
		if(type == "time_team" || type == "time_order" || type == "time_income"){
			data[type] = 1;
			$.post("?act=statist&op=setNotice&uid=<?php echo $agent_id;?>", data, function(result){
				var json = result.datas;
				if(json.status){
					notice[type] = parseInt(timestamp);
					setstorage("notice", JSON.stringify(notice));
				}
				location.href = href;
			}, 'json');
		}
	}
}

Notice.init();
</script>
<script>
var agent_id = "<?php echo $agent_info['agent_id'];?>";
$.post("?act=wxCap&op=isSubscribe",{'agent_id':agent_id}, function(result){
	var json = result.datas;
	if(json.status){
		$("#J-my-bank-alert").hide();
	}else{
		$("#J-my-bank-alert").show();
		 var obox = document.getElementById("J-my-bank-alert");
         obox.onclick = function () {
           window.location.href="http://mp.weixin.qq.com/s?__biz=MzA5Mzg3MTYzNw==&mid=200945736&idx=1&sn=cc010f559941cda1724b9818008a799e#rd";
         }
	}
}, 'json');

</script>
<!-- 站长统计功能 -->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F921b4696aec0527b77e8a3edc6d65da1' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</body>
</html>