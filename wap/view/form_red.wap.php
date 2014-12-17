<!doctype html>
<html>
<head>

<meta http-equiv="refresh" content="60*10">
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>新玉麟电商平台</title>

<link href="css/style02.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="Box">
<h2><?php echo date("Y-m-d H:i:s",time())?> 星期<?php 

    switch (date("N")){
    	case '1': echo '一';
    	break;
    	case '2': echo '二';
    	break;
    	case '3': echo '三';
    	break;
    	case '4': echo '四';
    	break;
    	case '5': echo '五';
    	break;
    	case '6': echo '六';
    	break;
    	case '7': echo '日';
    	break;
    }


?></h2><!--时间是更新-->
<div class="one">V1.0</div>
	<table width="100%">
    	<tr class="top">
        	<th class="yellow" width="14%">销售金额</th>
            <th class="yellow" width="15%">消费者数</th>
            <th class="yellow" width="15%">商品访问数</th>
            <th class="yellow" width="14%">成交笔数</th>
            <th width="14%">微代注册数</th>
            <th width="14%">微代登录数</th>
            <th width="14%">分享数</th>
        </tr>
        <tr class="wierd">
            <!-- 销售金额 -->
        	<th class="today"><div class="tod">今日<?php echo $biao['sell_today']?>
        	<?php if($biao['sell_today'] > $biao['sell_yesterday']){ ?>
        	 <img src="images/top.png"></div>
        	<?php }else{?>
        	 <img src="images/bottom.png"></div>
        	<?php }?>        	
        	<div class="yesterday"> 昨日 <?php echo $biao['sell_yesterday']?></div>
        	<div class="daily">日均  <?php echo ceil($biao['sell_avg'])?></div>
        	<div class="sun">总额 <?php echo ceil($biao['sell_sum'])?></div> </th>
            <!-- 消费者数 -->
            <th class="today"><div class="tod">今日 <?php echo $biao['salses_today']?>
             <?php if($biao['salses_today'] > $biao['salses_yesterday']){ ?>
        	 <img src="images/top.png"></div>
        	<?php }else{?>
        	 <img src="images/bottom.png"></div>
        	<?php }?>
            <div class="yesterday"> 昨日 <?php echo $biao['salses_yesterday']?></div>
            <div class="daily">日均 <?php echo ceil($biao['salses_avg'])?></div>
            <div class="sun">总数 <?php echo $biao['salses_sum']?></div> </th>
            <!-- 商品访问数 -->
            <th class="today">
            <div class="sun_1">总数  <?php echo $biao['goods_login_sum']?></div>
            <div class="daily_1">日均 <?php echo ceil($biao['goods_login_avg'])?></div>
            <br><br>
             </th>
            <!-- 成交笔数 --> 
             <th class="today"><div class="tod">今日<?php echo $biao['deal_today']?>
            <?php if($biao['deal_today'] > $biao['deal_yesterday']){ ?>
        	 <img src="images/top.png"></div>
        	<?php }else{?>
        	 <img src="images/bottom.png"></div>
        	<?php }?>
            <div class="yesterday"> 昨日 <?php echo $biao['deal_yesterday']?></div>
            <div class="daily">日均 <?php echo ceil($biao['deal_avg'])?></div>
            <div class="sun">总数 <?php echo $biao['deal_sum']?></div> </th>
            <!-- 微代注册数 -->
            <th class="today"><div class="tod">今日 <?php echo $biao['agent_today']?>
            <?php if($biao['agent_today'] > $biao['agent_yesterday']){ ?>
        	 <img src="images/top.png"></div>
        	<?php }else{?>
        	 <img src="images/bottom.png"></div>
        	<?php }?>
            <div class="yesterday"> 昨日 <?php echo $biao['agent_yesterday']?></div>
            <div class="daily">日均<?php echo ceil($biao['agent_avg'])?></div>
            <div class="sun">总数<?php echo $biao['agent_sum']?></div> </th>
           <!-- 微代登录数 -->
             <th class="today"><div class="tod">今日 <?php echo $biao['agent_login_today']?>
            <?php if($biao['agent_login_today'] > $biao['agent_login_yesterday']){ ?>
        	 <img src="images/top.png"></div>
        	<?php }else{?>
        	 <img src="images/bottom.png"></div>
        	<?php }?>
            <div class="yesterday"> 昨日 <?php echo $biao['agent_login_yesterday']?></div>
            <div class="daily">日均 <?php echo ceil($biao['agent_login_avg'])?></div>
            <div class="sun"><br></div> </th>
            <!-- 分享数 -->
            <th class="today"><div class="tod">今日 <?php echo $biao['share_todays']?>
             <?php if($biao['share_todays'] > $biao['share_yesterdays']){ ?>
        	 <img src="images/top.png"></div>
        	<?php }else{?>
        	 <img src="images/bottom.png"></div>
        	<?php }?>
            <div class="yesterday"> 昨日 <?php echo $biao['share_yesterdays']?></div>
            <div class="daily">日均 <?php echo ceil($biao['share_avg'])?></div>
            <div class="sun">总数 <?php echo $biao['share_sum']?></div> </th>       
        </tr>   
    </table>
    <div class="imgBox">
    	<div class="left">
        	<div id="container" style="width:90%"></div>           
        </div>
        <div class="right">       	
        	<div id="containers" style="width:90%"></div>          
        </div>
    </div>
    <div class="cenyer">
        <h3>热销商品 TOP 5</h3>
        	<table width="100%">
            	<tr class="show">
                	<th >商品名称</th>
                    <th width="10%">商品单价</th>
                    <th width="10%">今日销量</th>
                    <th width="10%">总销量</th>
                    <th width="10%">总访问量</th>
                    <th width="12%">转化率</th>                    
                </tr>
               <?php foreach($biao1 as $key=>$value ){?>
            	<tr class="bottom">
                	<th class="th"> <?php echo $value['goods_name']?></th>
                    <th class="res"><?php echo $value['goods_price']?></th>
                    
                    <th class="res"><?php echo $value['extend_goods']['sum(t1.goods_num)']==null?0:$value['extend_goods']['sum(t1.goods_num)']?></th>
                    <th class="ser"><?php echo $value['sum(t1.goods_num)']?></th>
                    <th class="ser"><?php echo $value['goods_click']?></th> 
                    <?php $change=$value['sum(t1.goods_num)'] / $value['goods_click'] ?>
                    <th class="ser"><?php echo substr($change,0,5)*100 ?>%</th>                  
                </tr>
               <?php }?>                                
            </table>
        </div>

    </div>
</div>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/highcharts.js"></script>
<script type="text/javascript" >
$(function () {
    $('#container').highcharts({
    	 
         
    	chart:{
            type: 'spline',
            height:'190',
           
            },
         colors:['#fd9530'],

            
        title: {
            text: '最近十天销量金额',
            
        },
        
        xAxis: {
            categories: [<?php echo $dws;?>],
            tickmarkPlacement:10,
             lables:{
             	zIndex:10,
             	x:100
              },
             tickPixelInterval:100
        },
        yAxis: {
            title: {
                text: '销量金额 (元)'
            },
            min: 0,
            maxPadding:0.01,
            tickPixelInterval:100
        },
        tooltip: {
            valueSuffix: '元'                
        },
        credits:{
        	enabled:false,
        	position:{
        		align:'left',
        		x:50
        	},
        	style:{
        		color:'red',
        		fontWeight:'bold'
        	}
        },
        plotOptions: {
        	spline: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        }, 
        legend:{
        	enabled:false
        },     
        series: [{
            
            data: [<?php echo $result_clicknum_str?>]
        }]
    });
   //微代图表
    $('#containers').highcharts({
        chart:{
            height:'190',
            type: 'spline',
            },
        title: {
            text: '最近十五天微代数'
            
        },
     
        xAxis: {
            categories: [<?php echo $dwv;?>],
            tickmarkPlacement:10,
            lables:{
            	zIndex:10
             },
            minPadding:0.5
        },
        yAxis: {
            title: {
                text: '微代人数 (个)'
            },
            min: 0,
            maxPadding:0.1,
        },
        tooltip: {
            valueSuffix: '个'
        },
        credits:{
        	enabled:false,
        	position:{
        		align:'left',
        		x:40
        	},
        	style:{
        		color:'red',
        		fontWeight:'bold'
        	}
        },
        plotOptions: {
            spline: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        legend:{
        	enabled:false,
        	
        },        
        series: [{
           
            data: [<?php echo $result_clicknum_str1?>]
        }]
    });
});
</script>
</body>
</html>
