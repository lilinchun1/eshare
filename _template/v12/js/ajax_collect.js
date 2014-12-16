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
                        $(".logo-star-on").hide();
                        $(".logo-star-off").show();
                    }else if(status==1){
                        $(".logo-star-on").show();
                        $(".logo-star-off").hied();
                        floatNotify.simple("取消收藏成功");
                    }
                }else if(fdata==1){
                    if(status==0) {
                        floatNotify.simple("收藏失败");
                    }else if(status==1){
                        floatNotify.simple("取消收藏失败");
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
