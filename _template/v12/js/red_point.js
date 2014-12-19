var cart_url = WapSiteUrl+"/index.php?act=statist&op=cartRed";
var center_url = WapSiteUrl+"/index.php?act=statist&op=centerRed";
var param_key = getcookie('key');//登录标记
if(param_key==''){
	  window.location.href = WapSiteUrl+'/tmpl/member/login.html';
 }else{
	$.post(cart_url,{key:param_key},function(result){
				var json = result.datas;
					if(json.status && parseInt(json.data)){
					$(".pro_car").html(json.data).show();
					}
			}, 'json');
 }//购物车红点结束

var Notice = {
		defaultNotice : {time_center : "0"},//初始化notice
		init: function(){
			var _this = this;
			
			_this.getData(_this.update);
			
			//红点
			$("#J_center").click(function(e){
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
			var notice = getstorage("notice_other"), _this = this;
			console.log(notice);
			if(notice == undefined){
				$.get(WapSiteUrl+"/index.php?act=statist&op=getNotice&key="+param_key+"&keys=time_center", function(result){
					var json = result.datas;
					if(json.status){
						notice = _this.merge(json.data);
					}else{
						notice = _this.defaultNotice;
					}
					setstorage("notice_other", JSON.stringify(notice));
					console.log(JSON.stringify(notice));

					cb.call(_this, notice);
				}, 'json');
			}else{
				try{
					notice = JSON.parse(notice);
					notice = this.merge(notice);
				}catch(e){
					notice = this.defaultNotice;
				}
				setstorage("notice_other", JSON.stringify(notice));
				cb.call(this, notice);
			}
		},
		update : function(notice){
			//获取订单、收入、团队
			var group = ['Center'], _this = this, _cur = 0;
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
			$.get(WapSiteUrl+"/index.php?act=statist&op=" +idx.toLowerCase()+ "Red&key="+param_key+"&timestamp=" + timestamp, function(result){
				var json = result.datas;
				if(json.status && parseInt(json.data)){
					//$("#J_notice"+idx).html(json.data).show();
					
					$(".pro_pen").html(json.data).show();
				}
			}, 'json');
		},
		setPoint: function(type, href){
			var notice = JSON.parse(getstorage("notice_other")), data = {}, timestamp = (new Date().getTime())/1000;
			if(type == "time_center"){
				data[type] = 1;
				$.post(WapSiteUrl+"/index.php?act=statist&op=setNotice&key="+param_key, data, function(result){
					var json = result.datas;
					if(json.status){
						notice[type] = parseInt(timestamp);
						setstorage("notice_other", JSON.stringify(notice));
					}
					location.href = href;
				}, 'json');
			}
		}
	}

Notice.init();

