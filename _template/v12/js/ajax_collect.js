/**
 * Created by 闫继鹏 on 2014/12/15.
 */
//收藏
function collect(fav_type,fav_id,status){
    var key = getcookie('key');//登录标记
    if(status==0){
        var url=WapApiUrl + "/index.php?act=member_favorites&op=favorites_add";
    }else if(status==1){
        var url=WapApiUrl + "/index.php?act=member_favorites&op=favorites_del";
    }
    //alert(url);
    if(key==''){
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
    }else {
        $.ajax({
            url: url,
            dataType: "json",
            type: 'get',
            data: {'fav_type': fav_type, 'fav_id': fav_id, 'key': key},
            success: function (fdata) {   //成功后回调
                if(fdata==0) {
                    if(status==0) {
                        floatNotify.simple("收藏成功");
                        $(".logo-star-on").show();
                        $(".logo-star-off").hide();
                    }else if(status==1){
                        $(".logo-star-on").hide();
                        $(".logo-star-off").show();
                        floatNotify.simple("取消收藏成功");
                    }
                }else{
                    floatNotify.simple(fdata);
                }
            },
            error: function (e) {    //失败后回调
                floatNotify.simple("请求有误，请稍后重试");
            },
            beforeSend: function () {

            }
        })
    }
}

//我的收藏
function my_fav(fav_type,fav_id,list){
    var key = getcookie('key');//登录标记
    var url=WapApiUrl + "/index.php?act=member_favorites&op=favorites_del";
    if(key==''){
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
    }else {
        $.ajax({
            url: url,
            dataType: "json",
            type: 'get',
            data: {'fav_type': fav_type, 'fav_id': fav_id, 'key': key},
            success: function (fdata) {   //成功后回调
                if(fdata==0) {
                    floatNotify.simple("取消收藏成功");
                    $(list).parent("li").remove();
                    if(fav_type=="agent") {
                        $(".favorites_agent_num").text(parseInt($(".favorites_agent_num").text()) - 1);
                    }else{
                        $(".favorites_goods_num").text(parseInt($(".favorites_goods_num").text()) - 1);
                    }
                    if($(".collection-box-dp").length==0){
                        document.URL=location.href;
                    }
                }else{
                    floatNotify.simple(fdata);
                }
            },
            error: function (e) {    //失败后回调
                floatNotify.simple("请求有误，请稍后重试");
            },
            beforeSend: function () {

            }
        })
    }
}
