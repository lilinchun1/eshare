/**
 * Created by 闫继鹏 on 2014/12/16.
 */
$(function(){
    $(".order-l-b .shopping-listing").hide();
    $(".order-l-b .shopping-listing").first().show();
});
function drop_down(list) {
    var classes = $(list).parent().attr('class');
    if (classes == "order-dd-button1") {
        $(list).parent().parent().find(".shopping-listing").show();
        $(list).parent().removeClass();
        $(list).parent().addClass("order-dd-button2");
    }else if(classes == "order-dd-button2"){
        $(list).parent().parent().find(".shopping-listing").hide();
        $(list).parent().parent().find(".shopping-listing").first().show();
        $(list).parent().removeClass();
        $(list).parent().addClass("order-dd-button1");
    }
}