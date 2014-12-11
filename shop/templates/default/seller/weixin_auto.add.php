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
<div class="ncsc-form-default" nctype="normal" style=" display: none;">
  <form method="post" action="index.php?act=weixin_auto&op=auto_save" id="normal_form" enctype="multipart/form-data">
    <input type="hidden" name="type" value="single" />
    <dl>
      <dt>标题：</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="title" value="" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt>图片：</dt>
      <dd>
        <div class="ncsc-upload-thumb store-sns-pic">
          <p><img nc_type="logo1" src="<?php echo SHOP_TEMPLATES_URL?>/images/member/default_image.png"/></p>
          <input type="hidden" name="old_pic_url" id="" value="" />
        </div>
        <div class="handle">
          <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
            <input type="file" hidefocus="true" size="1" class="input-file" name="normal_file" id="normal_file" nc_type="logo">
            </span>
            <p><i class="icon-upload-alt"></i>图片上传</p>
            </a> </div>
        </div>
        <div id="get_img_ajaxContent" class="ajax-albume"></div>
      </dd>
    </dl>
     <dl>
      <dt><i class="required">*</i>图片链接:</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="page_url" value="" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>内容:</dt>
      <dd>
        <textarea name="content" class="textarea w450 h100" id="content_normal" nctype="normal"></textarea>
        <p class="w450"><span class="smile"><a href="javascript:void(0)" nc_type="smiliesbtn" data-param='{"txtid":"normal"}'><?php echo $lang['store_sns_face'];?></a></span> <span id="weibocharcount_normal" class="weibocharcount"></span></p>
      </dd>
    </dl>
    <div class="bottom">
      <label class="submit-border"><input type="submit" class="submit" value="提交" /></label>
    </div>
  </form>
</div>
<div class="ncsc-form-default" nctype="recommend" style=" display: none;">
   <form method="post" action="index.php?act=weixin_auto&op=auto_save" id="recommend_form" enctype="multipart/form-data">
    <input type="hidden" name="type" value="many" />
    <dl>
      <dt>标题：</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="title" value="" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt>图片：</dt>
      <dd>
        <div class="ncsc-upload-thumb store-sns-pic">
          <p><img nc_type="logo1" src="<?php echo SHOP_TEMPLATES_URL?>/images/member/default_image.png"/></p>
          <input type="hidden" name="old_pic_url" id="" value="" />
        </div>
        <div class="handle">
          <div class="ncsc-upload-btn"> <a href="javascript:void(0);"><span>
            <input type="file" hidefocus="true" size="1" class="input-file" name="normal_file" id="normal_file" nc_type="logo">
            </span>
            <p><i class="icon-upload-alt"></i>图片上传</p>
            </a> </div>
        </div>
        <div id="get_img_ajaxContent" class="ajax-albume"></div>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>图片链接:</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="page_url" value="" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>内容:</dt>
      <dd>
        <textarea name="content" class="textarea w450 h100" id="content_normal" nctype="normal"></textarea>
      </dd>
    </dl>
    <div class="bottom">
      <label class="submit-border"><input type="submit" class="submit" value="提交" /></label>
    </div>
  </form>
</div>
<div class="ncsc-form-default" nctype="hotsell" style="display: none;" >
  <form method="post" action="index.php?act=weixin_auto&op=auto_save" id="hotsell_form">
    <input type="hidden" name="type" value="text" />
    <dl>
      <dt><i class="required">*</i>内容:</dt>
      <dd>
        <textarea name="content" class="textarea w450" nctype="hotsell" id="content_hotsell"></textarea>
      </dd>
    </dl>
    <div class="bottom">
      <label class="submit-border"><input type="submit" class="submit" value="提交" /></label>
    </div> 
  </form>
</div>
<div class="ncsc-form-default" nctype="new" style="display: none;">
  <form method="post" action="index.php?act=weixin_auto&op=auto_save" id="new_form">
    <input type="hidden" name="type" value="music" />
    <dl>
      <dt>标题：</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="title" value="" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>内容:</dt>
      <dd>
        <textarea name="content" class="textarea w450" nctype="" id="content_hotsell"></textarea>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>音乐链接:</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="music_url" value="" placeholder="" />
        </p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>高品质音乐链接:</dt>
      <dd>
        <p>
          <input type="text" class="text w400" name="hqmusic_url" value="" placeholder="" />
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
	//点击不同选项出现不同样式
	$('input[name="sns_type"]').change(function(){
		$('.ncsc-form-default').hide();
		$('.ncsc-form-default[nctype="'+$(this).val()+'"]').show();
	});
	$('input[name="sns_type"]').each(function(){
		if($(this).attr('checked')){
			$('.ncsc-form-default').hide();
			$('.ncsc-form-default[nctype="'+$(this).val()+'"]').show();
		}
	});

	
// 	/* ajax添加商品  */
// 	$('a[nctype="get_img"]').ajaxContent({
// 		event:'click', //mouseover
// 		loaderType:"img",
// 		loadingMsg:SHOP_TEMPLATES_URL+"/images/transparent.gif",
// 		target:'#get_img_ajaxContent'
// 	}).click(function(){
// 	    $(this).hide();
// 	    $('a[nctype="del_img"]').show();
//     });
//     $('a[nctype="del_img"]').click(function(){
//         $(this).hide();
//         $('a[nctype="get_img"]').show();
//         $('#get_img_ajaxContent').html('');
//     });

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
			normal_file : {
				required : '不能为空'
			},
			page_url : {
				required : '不能为空',
				url : '请输入正确的url'
				
			}
		}
	});
    
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
				
			}
		}
	});
    
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
	//图片显示
	$('input[nc_type="logo"]').change(function(){
		var src = getFullPath($(this)[0]);
		$('img[nc_type="logo1"]').attr('src', src);
	});
	
});
</script>