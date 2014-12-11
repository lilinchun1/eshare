<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="ncsc-form-default">
  <form id="add_form" action="<?php echo urlShop('access_token', 'token_save');?>" method="post">
    <dl>
      <dt><i class="required">*</i>APPID<?php echo $lang['nc_colon'];?></dt>
      <dd><input class="w300 text" name="appid" type="text" id="appid" value="" />
          <span></span>
        <p class="hint"></p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>APPSECRET<?php echo $lang['nc_colon'];?></dt>
      <dd><input class="w300 text" name="appsecret" type="text" id="appsecret" value="" />
          <span></span>
        <p class="hint"></p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>EncodingAESKey<?php echo $lang['nc_colon'];?></dt>
      <dd><input class="w300 text" name="EncodingAESKey" type="text" id="EncodingAESKey" value="" />
          <span></span>
        <p class="hint"></p>
      </dd>
    </dl>
    <div class="bottom">
      <label class="submit-border">
        <input type="submit" class="submit" value="<?php echo $lang['nc_submit'];?>">
      </label>
    </div>
  </form>
</div>
<script> 
 $(document).ready(function(){
     $('#add_form').validate({
         onkeyup: false,
         errorPlacement: function(error, element){
             element.nextAll('span').first().after(error);
         },
     	submitHandler:function(form){
     		ajaxpost('add_form', '', '', 'onerror');
     	},
         rules: {
        	 appid: {
                 required: true
             },
             appsecret: {
                 required: true
             },
             EncodingAESKey: {
                 required: true
             }
         },
         messages: {
        	 appid: {
                required: '<i class="icon-exclamation-sign"></i>APPID不能为空'
             },
             appsecret: {
                 required: '<i class="icon-exclamation-sign"></i>APPSECRET不能为空'
             },
             EncodingAESKey: {
                 required: '<i class="icon-exclamation-sign"></i>EncodingAESKey不能为空'
             }
         }
     });
 });
 </script>
