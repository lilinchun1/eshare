<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="refresh" content="60">
<title>无标题文档</title>


<link href="css/ins.css" rel="stylesheet" type="text/css">
</head>

<body>
        <div class="ins">
        <h3>机构</h3>
        	<table width="1321" class="show">
            	<tr>
            	<th width="336">机构名称</th>
                <th width="350">
                	<div>机构人数</div>
                    <div class="blue">
                        <span>总数</span>
                        <span class="border">今日</span>
                        <span>昨日</span>
                    </div>
                </th>
                <th width="343">
                	<div>成交笔数</div>
                    <div class="blue">
                    	<span>总数</span>
                        <span class="border">今日</span>
                        <span>昨日</span>
                    </div>
                </th>
                <th width="272">
                	<div>成交金额</div>
                    <div class="blue">
                    	<span>总数</span>
                        <span class="border">今日</span>
                        <span>昨日</span>
                    </div>
                </th>
                </tr>
                <?php foreach ($biao1 as $key=>$value){?>
                 <tr class="wer">
            	<th><?php echo $key?></th>
                <th>
                    <div class="wierd">
                        <span class="wer"><?php echo $value['0']?></span>
                        <span class="wer"><?php echo $value['1']?></span>
                        <span class="wer"><?php echo $value['2']?></span>
                   </div>
                </th>
                <th>
                    <div class="wierd">
                        <span class="wer"><?php echo $value['3']?></span>
                        <span class="wer"><?php echo $value['4']['count(order_id)']==null?0:$value['4']['count(order_id)']?></span>
                        <span><?php echo $value['5']==null?0:$value['5']?></span>
                    </div>
                </th>
                <th>
                   <div class="wierd">
                        <span class="wer"><?php echo $value['6']['sum(total_sales)']?></span>
                        <span class="wer"><?php echo $value['7']['sum(order_amount)']==null?0:$value['7']['sum(order_amount)']?></span>
                        <span class="wer"><?php echo $value['8']['sum(order_amount)']==null?0:$value['8']['sum(order_amount)']?></span>
                    </div>
                </th>
                </tr>
                <?php }?> 
            </table>
            </div>
</body>
</html>
