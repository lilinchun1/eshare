/**
 * Created by 闫继鹏 on 2014/12/15.
 */
var pageNum=2;
var pageCount=2;
$(window).scroll(function () {
    var scrollTop = $(this).scrollTop();
    var scrollHeight = $(document).height();
    var windowHeight = $(this).height();
    var ajax_url=$(".ajax_url").val();
    if (scrollTop + windowHeight >= scrollHeight&&pageNum<=pageCount) {
      $.ajax({
            url: ajax_url,
            dataType: "json",
            type: 'get',
            async:false,
            data:{'pageNum':pageNum},
            success: function (data) {   //成功后回调
                var goods_list=data['goods_list'];
                var agent_id=data['agent_id'];
                if(goods_list==null){
                    $(".add-more").html("全部加载完毕");
                    return false;
                }
                $.each(goods_list, function (key, val) {
                    pageCount =val['pageCount'];//总页数
                    var image_url=val['goods_image_url'];//图片地址
                    var goods_commend=val['goods_commend'];//是否特价,有值为特价;
                    var goods_name=val['goods_name'];//标题
                    var goods_price=val['goods_price'];//价格.
                    var goods_marketprice=val['goods_marketprice'];//原价
                    var goods_id=val['goods_id'];//商品ID
                    $(".shop-item-wrap").append(
                            "<div class='shop-item'>" +
                            "<div class='shop-item-pic'>" +
                            "<a  href='"+WapSiteUrl+"/index.php?act=product&goods_id="+goods_id+"&agent_id="+agent_id+"'>"+
                            "<img src='"+image_url+"'/>" +
                            "</a>"+
                            "<span class='tj-logo'>特价</span>" +
                            "</div>" +
                            "<h2 class='shop-item-tt'><span></span>"+goods_name+"</h2>" +
                            "<div class='shop-item-buy'>" +
                            "<em><span>￥</span>"+goods_price+"</em>" +
                            "<i>原价：￥"+goods_marketprice+"</i>" +
                            "<a href='"+WapSiteUrl+"/index.php?act=product&goods_id="+goods_id+"&agent_id="+agent_id+"'>"+
                            "<button class='shop-item-btn'>立即购买</button>" +
                            "</a>"+
                            "</div>" +
                            "</div>");
                });
                if(pageNum==pageCount){
                    $(".add-more").html("全部加载完毕");
                }
                pageNum++;
            },
            error: function(e){    //失败后回调
                floatNotify.simple("请求有误，请稍后重试");
            },
            beforeSend: function(){
                $(".add-more").html('<img src="'+htmlUrl+'/v12/img/load.gif" alt="" class="add-gif"/>正在加载...');
            }
        })
    }

});