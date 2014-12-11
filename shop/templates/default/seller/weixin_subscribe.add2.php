<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="alert alert-block alert-info"> <strong>回复类型：</strong>
  <label class="mr20">
    <input type="radio" name="sns_type" value="normal" id="sns_normal"  class="vm mr5" />
    单图文回复</label>
  <label class="mr20">
    <input type="radio" name="sns_type" value="recommend" id="sns_recommend" checked="checked" class="vm mr5" />
    多图文回复</label>
  <label class="mr20">
    <input type="radio" name="sns_type" value="hotsell" id="sns_hotsell" class="vm mr5" />
    文本回复</label>
  <label class="mr20">
    <input type="radio" name="sns_type" value="new" id="sns_new" class="vm mr5" />
    音乐回复</label>
</div>
<div><a href="javascript:void(0)" class="ncsc-btn ncsc-btn-green" nc_type="dialog" dialog_title="增加图文" dialog_id="my_goods" dialog_width="720" uri="index.php?act=weixin_subscribe&op=subscribe_adds">增加图文</a></div>
<table class="ncsc-table-style">
<input type="hidden" name="type" value="many" />
  <thead>
    <tr>
      <th>事件类型</th>
      <th>图片</th>
      <th>内容</th>
      <th class="w100"><?php echo $lang['nc_handle'];?></th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($output['subscribe_list']) && is_array($output['subscribe_list'])) { ?>
    <?php foreach($output['subscribe_list'] as $val) { ?>
    <tr class="bd-line">
      <td>多图文</td>
      <td><img src="<?php echo wxShareImage($val['pic_url'],$_SESSION['store_id']);?>" onload="javascript:DrawImage(this,40,40);" /></td>
      <td><?php echo $val['content']; ?></td>
      <td class="nscs-table-handle">
       <span><a href="javascript:void(0)" class="btn-blue" nc_type="dialog" dialog_title="编辑回复" dialog_id="my_goods_brand_edit" dialog_width="720" uri="index.php?act=weixin_subscribe&op=subscribe_edits&reply_id=<?php echo $val['reply_id']; ?>"><i class="icon-edit"></i><p><?php echo $lang['nc_edit'];?></p></a></span>
       <span><a href="javascript:void(0)" class="btn-red" onclick="ajax_get_confirm('<?php echo $lang['nc_ensure_del'];?>', 'index.php?act=weixin_subscribe&op=subscribe_dels&reply_id=<?php echo $val['reply_id']; ?>&keyword_id=<?php echo $val['keyword_id'];?>');"><i class="icon-trash"></i><p><?php echo $lang['nc_del'];?></p></a></span></td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
    </tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <?php if (!empty($output['subscribe_list'])) { ?>
    <tr>
      <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
    </tr>
    <?php } ?>
   <div class="bottom">
      <label class="submit-border"><input type="button" class="submit" value="保存" id="sub"/></label>
   </div>
  </tfoot>
</table>
<script>
$(function(){
	$('#sub').click(function(){
		window.location.href="index.php?act=weixin_subscribe&op=index";
	});
	$('#sns_normal').click(function(){
		window.location.href="index.php?act=weixin_subscribe&op=subscribe_add1&keyword_id=<?php echo $output['keyword_id'];?>";
	});
	$('#sns_recommend').click(function(){
		window.location.href="index.php?act=weixin_subscribe&op=subscribe_add2&keyword_id=<?php echo $output['keyword_id'];?>";
	});
	$('#sns_hotsell').click(function(){
		window.location.href="index.php?act=weixin_subscribe&op=subscribe_add3&keyword_id=<?php echo $output['keyword_id'];?>";
	});
	$('#sns_new').click(function(){
		window.location.href="index.php?act=weixin_subscribe&op=subscribe_add4&keyword_id=<?php echo $output['keyword_id'];?>";
	});
	
});
</script>