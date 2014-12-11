<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
  <?php if(empty($output['token_list'])){?>
  <a href="javascript:void(0)" class="ncsc-btn ncsc-btn-green" onclick="go('index.php?act=access_token&op=token_add');" title="添加配置">添加配置</a> 
  <?php }?>
  </div>
<table class="ncsc-table-style">
  <thead>
    <tr>
      <th>APPID</th>
      <th class="tl">APPSERECT</th>
      <th class="tl">EncodingAESKey</th>
      <th class="w100"><?php echo $lang['nc_handle'];?></th>
    </tr>
  </thead>
  <tbody>
    <?php if(!empty($output['token_list']) && is_array($output['token_list'])){?>
    <?php foreach($output['token_list'] as $key => $value){?>
    <tr class="bd-line">
      <td><?php echo $value['appid'];?></td>
      <td class="tl"><?php echo $value['appsecret'];?></td>
      <td class="tl"><?php echo $value['EncodingAESKey'];?></td>
      <td class="nscs-table-handle"><span><a href="<?php echo urlShop('access_token', 'token_edit');?>" class="btn-blue"><i class="icon-edit"></i>
        <p><?php echo $lang['nc_edit'];?></p>
        </a></span></td>
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
<form id="del_form" method="post" action="<?php echo urlShop('store_account_group', 'group_del');?>">
  <input id="del_group_id" name="group_id" type="hidden" />
</form>