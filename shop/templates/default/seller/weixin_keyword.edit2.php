<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="alert alert-block alert-info"> <strong>回复类型：</strong>
  <label class="mr20">
    <input type="radio" name="sns_type" value="recommend" id="sns_recommend" checked="checked" class="vm mr5" />
    多图文回复</label>
</div>
<div><a href="javascript:void(0)" class="ncsc-btn ncsc-btn-green" nc_type="dialog" dialog_title="增加图文" dialog_id="my_goods" dialog_width="720" uri="index.php?act=weixin_keyword&op=keyword_adds&keyword_id=<?php echo $output['keyword_list'][0]['keyword_id']?>">增加图文</a></div>
<table class="ncsc-table-style">
<input type="hidden" name="type" value="many" />
  <thead>
    <tr>
      <th>关键字</th>
      <th>事件类型</th>
      <th>图片</th>
      <th>内容</th>
      <th class="w100"><?php echo $lang['nc_handle'];?></th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($output['keyword_list']) && is_array($output['keyword_list'])) { ?>
    <?php foreach($output['keyword_list'] as $val) { ?>
    <tr class="bd-line">
      <td><?php echo $val['keyword']; ?></td>
      <td>多图文</td>
      <td><img src="<?php echo wxShareImage($val['pic_url'],$_SESSION['store_id']);?>" onload="javascript:DrawImage(this,40,40);" /></td>
      <td><?php echo $val['content']; ?></td>
      <td class="nscs-table-handle">
       <span><a href="javascript:void(0)" class="btn-blue" nc_type="dialog" dialog_title="编辑回复" dialog_id="my_goods_brand_edit" dialog_width="720" uri="index.php?act=weixin_keyword&op=keyword_edits&reply_id=<?php echo $val['reply_id']; ?>&keyword_id=<?php echo $val['keyword_id'];?>"><i class="icon-edit"></i><p><?php echo $lang['nc_edit'];?></p></a></span>
       <span><a href="javascript:void(0)" class="btn-red" onclick="ajax_get_confirm('<?php echo $lang['nc_ensure_del'];?>', 'index.php?act=weixin_keyword&op=keyword_dels&reply_id=<?php echo $val['reply_id']; ?>&keyword_id=<?php echo $val['keyword_id'];?>');"><i class="icon-trash"></i><p><?php echo $lang['nc_del'];?></p></a></span></td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
    </tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <?php if (!empty($output['keyword_list'])) { ?>
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
		window.location.href="index.php?act=weixin_keyword&op=index";
	});
	
	
});
</script>