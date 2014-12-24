/**
 * Created by 闫继鹏 on 2014/12/17.
 */
// 检查库存方法
function check_stock(teambuy_num) {
    var stock_num = parseInt($(".stock_num").text());// 获取静态库存数量
    if (teambuy_num > stock_num) {
        floatNotify.simple("超过最大库存");
        $("#teambuy_num_input").val(stock_num);
        return false;
    }else{
        return true;
    }
}
$(function() {
    var mouse_event = 'click';// 事件变量：测试PC环境改为click MOBILE 环境:touchstart
    $('#teambuy_num_left').on(mouse_event, function() {
        var teambuy_num = $("#teambuy_num_input").val();// 获取团购数量
        teambuy_num--;
        check_stock(teambuy_num);// 检查库存方法
        if (teambuy_num == 0) {
            teambuy_num++;
        } else {
            $("#teambuy_num_input").val(teambuy_num);
        }
    });
    $('#teambuy_num_right').on(mouse_event, function() {
        var teambuy_num = $("#teambuy_num_input").val();// 获取团购数量
        teambuy_num++;
        var check = check_stock(teambuy_num);// 检查库存方法
        if (check == true) {
            $("#teambuy_num_input").val(teambuy_num);
        }
    });
    $("#J_openterm").on(mouse_event, function(e) {
        $("#D_mobile").hide();
        $("#D_term").show();
    });
    $("#J_closeterm").on(mouse_event, function(e) {
        $("#D_mobile").show();
        history.go(0);
    });
    // 立即购买
    $('.pay-btn').on(mouse_event,function() {
        var key = getcookie('key');// 登录标记
        if (key == '') {
            window.location.href = WapSiteUrl + '/tmpl/member/login.html';
        } else {
            var json = {};
            var buynum = $('#teambuy_num_input').val();
            json.key = key;
            json.cart_id = goods_id + '|' + buynum + ',';
            $.ajax({
                type : 'post',
                url : ApiUrl + '/index.php?act=member_buy&op=buy_step1',
                data : json,
                dataType : 'json',
                success : function(result) {
                    if (typeof (result.datas.error) == 'undefined') {
                        location.href = WapSiteUrl
                            + '/index.php?act=member_buy&goods_id='
                            + goods_id
                            + '&buynum='
                            + buynum;
                    } else {
                        $("#J-my-bank-alert").show(500);
                        $("#J-my-bank-alert p").html(result.datas.error);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){    //(默认: 自动判断 (xml 或 html)) 请求失败时将调用此方法。这个方法有三个参数：XMLHttpRequest 对象，错误信息，（可能）捕获的错误对象。
                    alert(errorThrown);return;
                }
            });
        }
    });

    //加入购物车
    $('.add_cart').on(mouse_event,function() {
        var key = getcookie('key');//登录标记
        if(key==''){
            window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        }else{
            var quantity = parseInt($('#teambuy_num_input').val());
            $.ajax({
                url:"index.php?act=member_cart&op=cart_add",
                data:{key:key,goods_id:goods_id,quantity:quantity},
                type:"post",
                success:function (result){
                    var rData = $.parseJSON(result);
                    if(checklogin(rData.login)){
                        if(!rData.datas.error){
                        	/*
                            $.sDialog({
                                skin:"block",
                                content:"添加购物车成功！",
                                "okBtnText": "&nbsp;&nbsp;再逛逛&nbsp;&nbsp;",
                                "cancelBtnText": "去购物车",
                                okFn:function (){},
                                cancelFn:function (){
                                    window.location.href = WapSiteUrl+'/index.php?act=member_cart&op=cart_list';
                                }
                            });
                            */
                            tipsBox($.extend({
                                str: "+"+quantity
                            }));
                            $(".shoppingNum").html(parseInt($(".shoppingNum").html())+quantity);
                        }else{
                            $.sDialog({
                                skin:"red",
                                content:rData.datas.error,
                                okBtn:false,
                                cancelBtn:false
                            });
                        }
                    }
                }
            });

        }
    })

//进入购物车
    $(".foot-nav-car").on(mouse_event,function() {
        window.location.href = WapSiteUrl+'/index.php?act=member_cart&op=cart_list';
    })
})



//加入购物车效果
function tipsBox(options) {
    options = $.extend({
        obj: $('.foot-nav-icon').last(),  //jq对象，要在那个html标签上显示
        str: "+1",  //字符串，要显示的内容;也可以传一段html，如: "<b style='font-family:Microsoft YaHei;'>+1</b>"
        startSize: "12px",  //动画开始的文字大小
        endSize: "30px",    //动画结束的文字大小
        interval: 800,  //动画时间间隔
        color: "red",    //文字颜色
        callback: function() {}    //回调函数
    }, options);
    $("body").append("<span class='num'>"+ options.str +"</span>");
    var box = $(".num");
    var left = options.obj.offset().left + options.obj.width() / 2;
    var top = options.obj.offset().top - options.obj.height();
    box.css({
        "position": "absolute",
        "left": left + "px",
        "top": top + "px",
        "z-index": 9999,
        "font-size": options.startSize,
        "line-height": options.endSize,
        "color": options.color
    });
    box.animate({
        "font-size": options.endSize,
        "opacity": "0",
        "top": top - parseInt(options.endSize) + "px"
    }, options.interval , function() {
        box.remove();
        options.callback();
    });
}
