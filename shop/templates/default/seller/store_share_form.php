<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="ncsc-form-default">
  <form method="post" action="index.php?act=store_share&op=share_save" target="_parent" name="store_share_form" id="store_share_form" enctype="multipart/form-data">
    <input type="hidden" name="wxs_id" value="<?php echo $output['share_info']['wxs_id'];?>"/>
   
    <input type="hidden" name="old_wxs_picture" value="<?php echo $output['share_info']['wxs_picture'];?>"/>
    
    <dl>
      <dt><i class="required">*</i>标题</dt>
      <dd>
        <input type="text" class="text w400" name="wxs_title" value="<?php echo $output['share_info']['wxs_title'];?>" /><span></span>
      	<p class="hint"><?php echo "可以使用 {%NAME%} 代替经销商用户名，{%AGENT%} 代替经销商店铺名称";?></p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>上传缩略图</dt>
      <dd>
      <span></span>
        <div class="">
           <span class="sign"><img src="<?php echo wxShareImage($output['share_info']['wxs_picture'],$_SESSION['store_id']);?>" onload="javascript:DrawImage(this,300,200)" nc_type="logo1"/></span>
        </div>
        <div class="ncsc-upload-btn"> 
        <a href="javascript:void(0);">
        <span>
          <input type="file" hidefocus="true" size="1" class="input-file" name="wxs_picture" id="wxs_picture" nc_type="logo"/>
         </span>
         <p><i class="icon-upload-alt"></i>图片上传</p>
         </a> </div>
        <p class="hint"><?php echo "此处为您上传的缩略图";?></p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>正文</dt>
      <dd>
      <p>
         <textarea name="wxs_content" class="textarea w400"><?php echo $output['share_info']['wxs_content']?></textarea><span></span>
      </p>
		  <p class="hint"><?php echo "可以使用 {%NAME%} 代替经销商用户名，{%AGENT%} 代替经销商店铺名称"; ?></p>
      </dd>
    </dl>
    <div class="bottom" >
      <label class="submit-border"><input type="submit" class="submit" value="提交内容" /></label>
    </div>
  </form>
</div>
<script type="text/javascript">
$(document).ready(function(){   	    	
     
	//页面输入内容验证
	$('#store_share_form').validate({
			
            
	        errorPlacement: function(error, element){
	            var error_td = element.parent('dd').children('span');
	            error.appendTo(error_td);
		         
	        },
	     	submitHandler:function(form){
	    		ajaxpost('add_form', '', '', 'onerror')
	    	},
        	rules: {
	    	wxs_title: {
                required: true,//required:true 必输字段 
                maxlength: 30//maxlength:10 输入长度最多是30的字符串(汉字算一个字符)                 
            },

            wxs_content: {
                required: true,//required:true 必输字段 
                                
            },
        },
        
        messages: {//提示
        	wxs_title: {
                required: '<i class="icon-exclamation-sign"></i>标题不能为空',
                maxlength: '<i class="icon-exclamation-sign"></i>标题不能超过30个字'
            },
      
            wxs_content: {
                required: '<i class="icon-exclamation-sign"></i>内容不能为空',
                
            },
        }
    });
    //图片显示
	$('input[nc_type="logo"]').change(function(){
		var src = getFullPath($(this)[0]);
		$('img[nc_type="logo1"]').attr('src', src);
	});

	
    
});
    
</script> 
