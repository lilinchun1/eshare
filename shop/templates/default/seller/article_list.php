<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
    <a href="<?php echo urlShop('store_article', 'article_add');?>" class="ncsc-btn ncsc-btn-green" title="添加信息">添加信息</a> </div>
  <table class="ncsc-table-style">
    <thead>
      <tr>
        <th class="w60">排序</th>
        <th class="tl">标题</th>
        <th class="tl">图片</th>
        <th class="w120">商品分类</th>
        <th class="w110"><?php echo $lang['nc_handle'];?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($output['article_list'])){?>
      <?php foreach($output['article_list'] as $key=> $value){?>
      <tr class="bd-line">
        <td><?php echo $value['art_sort'];?></td>
        <?php $art_href = empty($value['art_url'])?urlShop('show_store', 'show_article', array('store_id' => $_SESSION['store_id'], 'art_id' => $value['art_id'])):$value['art_url'];?>
        <td class="tl"><dl class="goods-name"><dt><a href="<?php echo $art_href;?>" target="_blank"><?php echo $value['art_title'];?></a></dt></dl></td>
    <td ><img src="<?php echo brandImage($value['art_picture']);?>" onload="javascript:DrawImage(this,88,44);" align="left" /></td>
     <td> <?php  echo $output['art_catid'][$value['art_catid']]?></td>
       
       
        <td class="nscs-table-handle"><span><a href="<?php echo urlShop('store_article', 'article_edit', array('art_id' => $value['art_id']));?>" class="btn-blue"><i class="icon-edit"></i>
          <p> <?php echo $lang['nc_edit'];?></p>
          </a></span><span> <a href="javascript:;" nctype="btn_del" data-sn-id="<?php echo $value['art_id'];?>"class="btn-red"><i class="icon-trash"></i>
          <p><?php echo $lang['nc_del'];?></p>
          </a></span></td>
      </tr>
      <?php }?>
      <?php } else { ?>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
</div>
<form id="del_form" method="post" action="<?php echo urlShop('store_article', 'article_del');?>">
  <input id="del_art_id" name="art_id" type="hidden" />
</form>
<!-- 分页 -->
<tfoot>
    <?php if (!empty($output['article_list'])) { ?>
    <tr>
      <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
    </tr>
    <?php } ?>
  </tfoot>
<!-- 分页 --> 
   
<script type="text/javascript">
    $(document).ready(function(){
        $('[nctype="btn_del"]').on('click', function() {
            var art_id = $(this).attr('data-sn-id');
            if(confirm('确认删除？')) {
                $('#del_art_id').val(art_id);
                ajaxpost('del_form', '', '', 'onerror')
            }
        });
    });
</script> 
