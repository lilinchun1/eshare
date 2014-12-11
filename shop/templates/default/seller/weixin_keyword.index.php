<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="tabmenu">
  <?php include template('layout/submenu');?>
  <a href="javascript:void(0)" class="ncsc-btn ncsc-btn-green" onclick="go('index.php?act=weixin_keyword&op=keyword_add1');" title="添加回复">添加回复</a> 
  </div>
<table class="ncsc-table-style">
  <thead>
    <tr>
      <th>事件类型</th>
      <th>关键字</th>
      <th class="tl">回复的内容</th>
      <th class="w100"><?php echo $lang['nc_handle'];?></th>
    </tr>
  </thead>
  <tbody>
    <?php if(!empty($output['keyword_list']) && is_array($output['keyword_list'])){?>
    <?php foreach($output['keyword_list'] as $key => $value){?>
    <tr class="bd-line">
      <td><?php echo $value['event_type'];?></td>
      <td><?php echo $value['keyword'];?></td>
      <td class="tl"><?php echo $value['content'];?></td>
     <?php if($value['event_type']=='many'){?>
      <td class="nscs-table-handle"><span><a href="<?php echo urlShop('weixin_keyword', 'keyword_edit',array('keyword_id'=>$value['keyword_id'],'event_type'=>$value['event_type']));?>" class="btn-blue"><i class="icon-edit"></i>
        <p>详细</p>
        </a></span>
        </span><span><a nctype="btn_del_group" data-group-id="<?php echo $value['keyword_id'];?>" href="javascript:;" class="btn-red"><i class="icon-trash"></i>
        <p><?php echo $lang['nc_del'];?></p>
        </a>
        </a></span>
       </td>
      <?php }else{?>
      <td class="nscs-table-handle"><span><a href="<?php echo urlShop('weixin_keyword', 'keyword_edit',array('keyword_id'=>$value['keyword_id'],'event_type'=>$value['event_type']));?>" class="btn-blue"><i class="icon-edit"></i>
        <p><?php echo $lang['nc_edit'];?></p>
        </a></span><span><a nctype="btn_del_group" data-group-id="<?php echo $value['keyword_id'];?>" href="javascript:;" class="btn-red"><i class="icon-trash"></i>
        <p><?php echo $lang['nc_del'];?></p>
        </a>
        </a></span></td>
       <?php }?> 
    </tr>
    <?php }?>
    <?php }else{?>
    <tr>
      <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
    </tr>
    <?php }?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
    </tr>
  </tfoot>
</table>
<form id="del_form" method="post" action="<?php echo urlShop('weixin_keyword', 'keyword_del');?>">
  <input id="del_group_id" name="keyword_id" type="hidden" />
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('[nctype="btn_del_group"]').on('click', function() {
            var keyword_id = $(this).attr('data-group-id');
            if(confirm('确认删除？')) {
                $('#del_group_id').val(keyword_id);
                ajaxpost('del_form', '', '', 'onerror');
            }
        });
    });
</script> 
