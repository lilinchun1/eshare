<div class="eject_con">
   <form method="post" action="index.php?act=weixin_auto&op=auto_saveas&keyword_id=<?php echo $_GET['keyword_id']?>" id="recommend_form" enctype="multipart/form-data">
    <input type="hidden" name="type" value="many" />
    <input type="hidden" name="keyword_id" value="<?php echo $_GET['keyword_id'];?>"/>
    <input type="hidden" name="reply_id" value="<?php echo $_GET['reply_id'];?>"/>
    <input type="hidden" name="old_pic_url" value="<?php echo $output['auto_info']['pic_url'];?>"/>
    <dl>
      <dt>标题：</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="title" value="<?php echo empty($output['auto_info']['title'])?'':$output['auto_info']['title']?>" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt>排序：</dt>
      <dd>
        <p>
          <input type="text" class="text w100" name="order_num" value="<?php echo empty($output['auto_info']['order_num'])?'':$output['auto_info']['order_num']?>" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt>图片：</dt>
      <dd>
        <div class="ncsc-upload-thumb store-sns-pic">
          <p><img nc_type="logo1" width="100" height="100" src="<?php echo wxShareImage($output['auto_info']['pic_url'],$_SESSION['store_id']);?>"/></p>
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
          <input type="text" class="text w400" name="page_url" value="<?php echo empty($output['auto_info']['page_url'])?'':$output['auto_info']['page_url']?>" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>内容:</dt>
      <dd>
        <textarea name="content" class="textarea w450 h100" id="content_normal" nctype="normal"><?php echo empty($output['auto_info']['content'])?'':$output['auto_info']['content']?></textarea>
      </dd>
    </dl>
    <div class="bottom">
      <label class="submit-border"><input type="submit" class="submit" value="提交" /></label>
    </div>
  </form>
</div>
<script>
$('#recommend_form').validate({
	errorLabelContainer: $('#warning'),
	invalidHandler: function(form, validator) {
		$('#warning').show();
	},
	submitHandler:function(form){
		ajaxpost('recommend_form', '', '', 'onerror')
	},
	rules : {
		content : {
			required : true
		},
		normal_file : {
			required : true
		},
		page_url : {
			required : true,
			url : true
		},
		order_num : {
			required : true,
			digits:true
		}
	},
	messages : {
		content : {
			required : '不能为空'
		},
		normal_file : {
			required : '不能为空'
		},
		page_url : {
			required : '不能为空',
			url : '请输入正确的url'
			
		},
		order_num : {
			required : '不能为空',
			digits:'请输入正确的数字'
		}
	}
});

//图片显示
$('input[nc_type="logo"]').change(function(){
	var src = getFullPath($(this)[0]);
	$('img[nc_type="logo1"]').attr('src', src);
});
</script>
