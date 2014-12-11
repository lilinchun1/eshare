<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="ncsc-form-default">
  <form method="post" action="index.php?act=store_article&op=article_save" target="_parent" name="store_article_form" id="store_article_form" enctype="multipart/form-data">
    <input type="hidden" name="art_id" value="<?php echo $output['art_info']['art_id'];?>"/>
   
    <input type="hidden" name="old_art_picture" value="<?php echo $output['art_info']['art_picture'];?>"/>
    
    <dl>
      <dt><i class="required">*</i>添加标题</dt>
      <dd>
        <input type="text" class="w150 text" name="art_title" value="<?php echo $output['art_info']['art_title'];?>" /><span></span>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>选择分类</dt>
      <dd id="gcategory">     
        <select name="art_catid" id="art_catid" >
            <option value="">请选择</option>
            <?php foreach ($output['art_catid'] as $key=> $value){
            	?>
           
           <option <?php if($output['art_info']['art_catid'] == $key){ ?>selected="selected"<?php } ?> value="<?php echo $key?>"><?php echo $value?></option>
           <?php  	
            }
            ?>
            
        </select>
         <span></span>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>排序</dt>
      <dd>
        <input type="text" class="w50 text" name="art_sort" value="<?php echo $output['art_info']['art_sort']?>"/><span></span>
      </dd>
    </dl>
     <dl>
      <dt><i class="required">*</i>上传缩略图</dt>
      <dd>
      <span></span>
        <div class="">
           <span class="sign"><img src="<?php echo brandImage($output['art_info']['art_picture']);?>" onload="javascript:DrawImage(this,200,200)" nc_type="logo1"/></span>
        </div>
        <div class="ncsc-upload-btn"> 
        <a href="javascript:void(0);">
        <span>
          <input type="file" hidefocus="true" size="1" class="input-file" name="art_picture" id="art_picture" nc_type="logo"/>
         </span>
         <p><i class="icon-upload-alt"></i>图片上传</p>
         </a> </div>
         
        <p class="hint"><?php echo $lang['store_goods_brand_upload_tip'];?></p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>简介</dt>
      <dd>
        <textarea name="art_info" cols="50" rows="5"><?php echo $output['art_info']['art_info']?></textarea><span></span>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>正文</dt>
      <dd>
        <?php showEditor('art_content',$output['art_info']['art_content'],'600px','300px','','false',$output['editor_multimedia']); ?><span></span>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i>链接</dt>
      <dd>
        
          <input type="text" class="w300 text" name="art_url" value="<?php echo $output['art_info']['art_url'];?>" /><span></span>
       
        <p class="hint"> 请填写包含http://的完整URL地址,如果填写此项则点击该导航会跳转到外链</p> 
        </dd>
    </dl>
    <div class="bottom">
      <label class="submit-border"><input type="submit" class="submit" value="提交内容" /></label>
    </div>
  </form>
</div>
<script type="text/javascript">
$(document).ready(function(){   	    	
     
	//页面输入内容验证
	$('#store_article_form').validate({
			
            
	        errorPlacement: function(error, element){
	            var error_td = element.parent('dd').children('span');
	            error.appendTo(error_td);
	        },
	     	submitHandler:function(form){
	    		ajaxpost('add_form', '', '', 'onerror')
	    	},
        rules: {
            art_title: {
                required: true,//required:true 必输字段 
                maxlength: 10//maxlength:10 输入长度最多是10的字符串(汉字算一个字符)                 
            },
            art_info: {
                required: true,//required:true 必输字段 
                maxlength: 100//maxlength:10 输入长度最多是10的字符串(汉字算一个字符)                 
            },
            art_sort: {
                required: true,//required:true 必输字段 
                maxlength: 3,//maxlength:10 输入长度最多是10的字符串(汉字算一个字符)
                number:"请输入合法的数字"                 
            },
            art_content: {
                required: true,//required:true 必输字段 
                                
            },
            art_url: {
                required: true,//required:true 必输字段 
                              
            },
             art_catid: {
                  required: true,//required:true 必输字段 
                              
              }
             
            
           
        },
        
        messages: {//提示
            art_title: {
                required: '<i class="icon-exclamation-sign"></i>标题不能为空',
                maxlength: '<i class="icon-exclamation-sign"></i>标题不能超过10个字'
            },
            art_info: {
                required: '<i class="icon-exclamation-sign"></i>简介不能为空',
                maxlength: '<i class="icon-exclamation-sign"></i>简介不能超过100个字'
            },
            art_sort: {
                required: '<i class="icon-exclamation-sign"></i>不能为空值',
                maxlength: '<i class="icon-exclamation-sign"></i>不能超过3位数',
                mumber: '<i class="icon-exclamation-sign"></i>必须为数字'
                   
            },
            art_content: {
                required: '<i class="icon-exclamation-sign"></i>内容不能为空',
                
            },
            art_url: {
                required: '<i class="icon-exclamation-sign"></i>链接不能为空',
               
            },
            art_catid: {
                  required: '<i class="icon-exclamation-sign"></i>选择不能为空',
               
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
