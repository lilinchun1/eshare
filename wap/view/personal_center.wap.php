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
    <title>个人资料</title>
    <link rel="stylesheet" href="<?php echo IMG_CDN_URL;?>/v12/css/index.css<?php echo STATIC_VER;?>"/>
</head>
<body>
    <div class="box-wrap" >
        <div class="box_wrap_box" style="">
        <h2 class="schedule-item-tt">
            <em>当前等级：</em><span class="logo-v"><img src="<?php echo IMG_CDN_URL;?>/v12/img/icon/dp_vip<?php echo $agent_info['level_id']?>.png<?php echo STATIC_VER;?>" alt=""/></span><a href="index.php?act=personal_center&op=upgrade">如何升级？</a>
        </h2>
        <div class="leve-box" >
        <div class="leve-l"><img src="<?php echo IMG_CDN_URL;?>/v12/img/icon/dp_vip<?php echo $agent_info['level_id']?>.png<?php echo STATIC_VER;?>" alt=""/></div>

        <ul class="leve-bar" style="">
            <li class="progress-bar" style="width: <?php echo $say['scale'];?>%"></li>

        </ul>

        <div class="leve-r"><img src="<?php echo IMG_CDN_URL;?>/v12/img/icon/dp_vip<?php echo $agent_info['level_id']+1;?>.png<?php echo STATIC_VER;?>" alt=""/></div>
        </div>
        <div>

            <div class="alert-con8 pz6">
                <?php echo $say['say'];?>
            </div>
        </div>

    </div>

    </div>
        <section class="my-income-wrap">
            <div class="my-icome-item">
                <div class="div-p-1">
                <?php 
                   $state=$check_data['check_state'];
                  if($state==0||$state==""||$state==null){
                  	$url="index.php?act=personal_center&op=check_name";
                  	$date="<b>修改</b>";
                  }else if($state==10){
                   	  $url="#";
                   	  $date="<em>审核中</em>";
                   }else if($state==30){
                   	  $url="index.php?act=personal_center&op=check_names";
                      $date="<b>未通过审核</b>";
                   }else if($state==20){
                   	  $url="#";
                   	  $date="<em></em>";
                   }
                
                
                ?>
                    <a href="<?php echo $url;?>">
                        <p class="icome1-p">
                            <span></span>
                             <?php echo $person['agent_name'];?>
                            <?php echo $date;?>
                        </p>
                    </a>
                </div>
                <div class="div-p-2">
                    <a href="index.php?act=personal_center&op=check_phone">
                        <p class="icome1-p">
                            <span></span>
                          已绑定手机<?php echo substr($person['member_mobile'],0,3);?>****<?php echo substr($person['member_mobile'],7);?>
                            <b>修改</b>
                        </p>
                    </a>
                </div>
                <div class="div-p-3">
                    <a href="index.php?act=personal_center&op=check_pwd">
                        <p class="icome1-p">
                            <span></span>
                            修改密码
                            <em></em>
                        </p>
                    </a>
                </div>
            </div>
        </section>
    <footer class="foot">
        易享科技出品
    </footer>
</body>
</html>
