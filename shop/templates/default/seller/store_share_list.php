<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
    <a href="<?php echo urlShop('store_share', 'share_add');?>" class="ncsc-btn ncsc-btn-green" title="添加信息">添加信息</a> </div>
  <table class="ncsc-table-style">
    <thead>
      <tr>
        <th class="w60">分享ID</th>
        <th class="tl">分享图片</th>
        <th class="tl">分享内容</th>
        <th class="w110"><?php echo $lang['nc_handle'];?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($output['share_list'])){?>
      
      <?php foreach($output['share_list'] as $key=> $value){?>
      
      <tr class="w60">
      
        <td><?php echo $value['wxs_id'];?></td>
        
        <td class="tl"><img  src="<?php echo wxShareImage($value['wxs_picture'],$_SESSION['store_id']);?>" width="300" height="300" onload="javascript:DrawImage(this,300,200);" align="left" /></td>
        
        <?php $art_href = empty($value['wxs_title'])?urlShop('show_store', 'show_share', array('store_id' => $_SESSION['store_id'], 'wxs_id' => $value['wxs_id'])):$value['wxs_title'];?>
        
       <td class="tl">
       <dl class="goods-name">
       <dt><font size="2"><a href=""><?php echo $value['wxs_title'];?></a></font></dt>
        
    	<dd><?php echo $value['wxs_content'];?></dd></dl></td>
    	
    	
        <td class="nscs-table-handle"><span><a href="<?php echo urlShop('store_share', 'share_edit', array('wxs_id' => $value['wxs_id']));?>" class="btn-blue"><i class="icon-edit"></i>
        
        <p> <?php echo $lang['nc_edit'];?></p>
        
        </a></span><span> <a href="javascript:;" nctype="btn_del" data-sn-id="<?php echo $value['wxs_id'];?>"class="btn-red"><i class="icon-trash"></i>
        
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
<form id="del_form" method="post" action="<?php echo urlShop('store_share', 'share_del');?>">
  <input id="del_wxs_id" name="wxs_id" type="hidden" />
</form>
<!-- 分页 -->
<tfoot>
    <?php if (!empty($output['share_list'])) { ?>
    <tr>
      <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
    </tr>
    <?php } ?>
  </tfoot>
<!-- 分页 --> 
   
<script type="text/javascript">
    $(document).ready(function(){
        $('[nctype="btn_del"]').on('click', function() {
            var wxs_id = $(this).attr('data-sn-id');
            if(confirm('确认删除？')) {
                $('#del_wxs_id').val(wxs_id);
                ajaxpost('del_form', '', '', 'onerror')
            }
        });
    });
</script> 

