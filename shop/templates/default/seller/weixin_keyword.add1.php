<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="alert alert-block alert-info"> <strong>回复类型：</strong>
  <label class="mr20">
    <input type="radio" name="sns_type" value="normal" id="sns_normal" checked="checked" class="vm mr5" />
    单图文回复</label>
  <label class="mr20">
    <input type="radio" name="sns_type" value="recommend" id="sns_recommend" class="vm mr5" />
    多图文回复</label>
  <label class="mr20">
    <input type="radio" name="sns_type" value="hotsell" id="sns_hotsell" class="vm mr5" />
    文本回复</label>
  <label class="mr20">
    <input type="radio" name="sns_type" value="new" id="sns_new" class="vm mr5" />
    音乐回复</label>
</div>
<div class="ncsc-form-default" nctype="normal" >
  <form method="post" action="index.php?act=weixin_keyword&op=keyword_save" id="normal_form" enctype="multipart/form-data">
    <input type="hidden" name="type" value="single" />
    <input type="hidden" name="keyword_id" value="<?php echo $_GET['keyword_id'];?>"/>
    <input type="hidden" name="old_pic_url" value="<?php echo $output['keyword_info']['pic_url'];?>"/>
     <dl>
      <dt><i class="required">*</i>关键字：</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="keyword" value="<?php echo empty($output['keyword_infos']['keyword'])?'':$output['keyword_infos']['keyword']?>" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt>标题：</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="title" value="<?php echo empty($output['keyword_info']['title'])?'':$output['keyword_info']['title']?>" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt>图片：</dt>
      <dd>
        <div class="ncsc-upload-thumb store-sns-pic">
          <p><img nc_type="logo1" src="<?php echo wxShareImage($output['keyword_info']['pic_url'],$_SESSION['store_id']);?>"/></p>
        </div>
        <div class="handle">
          <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
            <input type="file" hidefocus="true" size="1" class="input-file" name="pic_url" id="normal_file" nc_type="logo">
            </span>
            <p><i class="icon-upload-alt"></i>图片上传</p>
            </a> </div>
        </div>
      </dd>
    </dl>
     <dl>
      <dt><i class="required">*</i>图片链接:</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="page_url" value="<?php echo empty($output['keyword_info']['page_url'])?'':$output['keyword_info']['page_url']?>" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>内容:</dt>
      <dd>
      <?php showEditor('content',$output['keyword_info']['content'],'600px','300px','','false',$output['editor_multimedia']); ?>
        <!-- <textarea name="content" class="textarea w450 h100" id="content_normal" nctype="normal"><?php echo empty($output['keyword_info']['content'])?'':$output['keyword_info']['content']?></textarea> -->
        <p class="w450"><span class="smile"><a href="javascript:void(0)" nc_type="smiliesbtn" data-param='{"txtid":"normal"}'><?php echo $lang['store_sns_face'];?></a></span> <span id="weibocharcount_normal" class="weibocharcount"></span></p>
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
		window.location.href="index.php?act=weixin_keyword&op=keyword_add1&keyword_id=<?php echo $output['keyword_id'];?>";
	});
	$('#sns_recommend').click(function(){
		window.location.href="index.php?act=weixin_keyword&op=keyword_add2&keyword_id=<?php echo $output['keyword_id'];?>";
	});
	$('#sns_hotsell').click(function(){
		window.location.href="index.php?act=weixin_keyword&op=keyword_add3&keyword_id=<?php echo $output['keyword_id'];?>";
	});
	$('#sns_new').click(function(){
		window.location.href="index.php?act=weixin_keyword&op=keyword_add4&keyword_id=<?php echo $output['keyword_id'];?>";
	});

	$('#normal_form').validate({
		errorLabelContainer: $('#warning'),
		invalidHandler: function(form, validator) {
			$('#warning').show();
		},
		submitHandler:function(form){
			ajaxpost('normal_form', '', '', 'onerror') 
		},
		rules : {
			content : {
				required : true
			},
			keyword : {
				required : true
			},
			normal_file : {
				required : true
			},
			page_url : {
				required : true,
				url : true
			}
		},
		messages : {
			content : {
				required : '不能为空'
			},
			keyword : {
				required : '不能为空'
			},
			normal_file : {
				required : '不能为空'
			},
			page_url : {
				required : '不能为空',
				url : '请输入正确的url'
				
			}
		}
	});
    
	//图片显示
	$('input[nc_type="logo"]').change(function(){
		var src = getFullPath($(this)[0]);
		$('img[nc_type="logo1"]').attr('src', src);
	});
	
});
</script>
