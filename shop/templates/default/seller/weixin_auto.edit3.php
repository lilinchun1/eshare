<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="alert alert-block alert-info"> <strong>回复类型：</strong>
  <label class="mr20">
    <input type="radio" name="sns_type" value="hotsell" id="sns_hotsell"  checked="checked" class="vm mr5" />
    文本回复</label> 
</div>
<div class="ncsc-form-default" nctype="hotsell"  >
  <form method="post" action="index.php?act=weixin_auto&op=auto_save" id="hotsell_form">
    <input type="hidden" name="type" value="text" />
    <input type="hidden" name="keyword_id" value="<?php echo $_GET['keyword_id'];?>"/>
    <dl>
      <dt><i class="required">*</i>内容:</dt>
      <dd>
      <?php showEditor('content',$output['auto_info']['content'],'600px','300px','','false',$output['editor_multimedia']); ?>
       <!--  <textarea name="content" class="textarea w450" nctype="hotsell" id="content_hotsell"><?php echo empty($output['auto_info']['content'])?'':$output['auto_info']['content']?></textarea>-->
      </dd>
    </dl>
    <div class="bottom">
      <label class="submit-border"><input type="submit" class="submit" value="提交" /></label>
    </div> 
  </form>
</div>
<script>
$(function(){
	
	$('#hotsell_form').validate({
		errorLabelContainer: $('#warning'),
		invalidHandler: function(form, validator) {
			$('#warning').show();
		},
		submitHandler:function(form){
			ajaxpost('hotsell_form', '', '', 'onerror')
		},
		rules : {
			content : {
				required : true
			}
		},
		messages : {
			content : {
				required : '不能为空'
			}
		}
	});
	
});
</script>