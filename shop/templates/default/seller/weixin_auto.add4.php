<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="alert alert-block alert-info"> <strong>回复类型：</strong>
  <label class="mr20">
    <input type="radio" name="sns_type" value="normal" id="sns_normal"  class="vm mr5" />
    单图文回复</label>
  <label class="mr20">
    <input type="radio" name="sns_type" value="recommend" id="sns_recommend" class="vm mr5" />
    多图文回复</label>
  <label class="mr20">
    <input type="radio" name="sns_type" value="hotsell" id="sns_hotsell" class="vm mr5" />
    文本回复</label>
  <label class="mr20">
    <input type="radio" name="sns_type" value="new" id="sns_new" checked="checked" class="vm mr5" />
    音乐回复</label>
</div>
<div class="ncsc-form-default" nctype="new" >
  <form method="post" action="index.php?act=weixin_auto&op=auto_save" id="new_form">
    <input type="hidden" name="type" value="music" />
   <input type="hidden" name="keyword_id" value="<?php echo $_GET['keyword_id'];?>"/>
    <dl>
      <dt>标题：</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="title" value="<?php echo empty($output['auto_info']['title'])?'':$output['auto_info']['title']?>" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>内容:</dt>
      <dd>
      <?php showEditor('content',$output['auto_info']['content'],'600px','300px','','false',$output['editor_multimedia']); ?>
       <!--   <textarea name="content" class="textarea w450" nctype="" id="content_hotsell"><?php echo empty($output['auto_info']['content'])?'':$output['auto_info']['content']?></textarea>-->
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>音乐链接:</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="music_url" value="<?php echo empty($output['auto_info']['music_url'])?'':$output['auto_info']['music_url']?>" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>高品质音乐链接:</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="hqmusic_url" value="<?php echo empty($output['auto_info']['hqmusic_url'])?'':$output['auto_info']['hqmusic_url']?>" placeholder="" />
        </p>
      </dd>
    </dl>
    <div class="bottom">
      <label class="submit-border"><input type="submit" class="submit" value="提交" /></label>
    </div>
  </form>
</div>
<script>
$(function(){
	$('#sns_normal').click(function(){
		window.location.href="index.php?act=weixin_auto&op=auto_add1&keyword_id=<?php echo $output['keyword_id'];?>";
	});
	$('#sns_recommend').click(function(){
		window.location.href="index.php?act=weixin_auto&op=auto_add2&keyword_id=<?php echo $output['keyword_id'];?>";
	});
	$('#sns_hotsell').click(function(){
		window.location.href="index.php?act=weixin_auto&op=auto_add3&keyword_id=<?php echo $output['keyword_id'];?>";
	});
	$('#sns_new').click(function(){
		window.location.href="index.php?act=weixin_auto&op=auto_add4&keyword_id=<?php echo $output['keyword_id'];?>";
	});
    
	$('#new_form').validate({
		errorLabelContainer: $('#warning'),
		invalidHandler: function(form, validator) {
			$('#warning').show();
		},
    	submitHandler:function(form){
    		ajaxpost('new_form', '', '', 'onerror')
    	},
		rules : {
			content : {
				required : true
			},
			music_url : {
				required : true,
				url : true
			},
			hqmusic_url : {
				required : true,
				url : true
			}
		},
		messages : {
			content : {
				required : '不能为空'
			},
			music_url : {
				required : '不能为空',
				url : '请输入正确的url'
			},
			hqmusic_url : {
				required : '不能为空',
				url : '请输入正确的url'
			}
		}
	});
	
	
});
</script>