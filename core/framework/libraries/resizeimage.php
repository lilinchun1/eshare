<?php
/**
 * 图片缩略
 * 
 *
 * @package    library
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @author	   ShopNC Team
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class ResizeImage{
	private $config;
	/**
	 * 图片类型
	 */
	private $type;
	/**
	 * 实际图片宽度
	 */
	private $width;
	/**
	 * 实际图片高度
	 */
	private $height;
	/**
	 * 改变后的图片宽度
	 */
	private $resize_width;
	/**
	 * 改变后的图片高度
	 */
	private $resize_height;
	/**
	 * 是否截图
	 */
	private $cut=0;
	/**
	 * 来源图片地址
	 */
	private $srcimg;
	/**
	 * 目标图片地址
	 */
	private $dstimg;
	/**
	 * 目标图片相对地址
	 */
	public $relative_dstimg;
	/**
	 * 临时图片
	 */
	private $im;
	/**
	 * 缩略图文件名扩展
	 */
	private $small_ext="_small.";
	/**
	 * 缩略图宽高比例
	 *
	 * @var unknown_type
	 */
	private $scale = 0;
	/**
	 * 是否允许填充空白
	 *
	 * @var unknown_type
	 */
	private $filling = true;
	/**
	 * 构造函数
	 *
	 * 使用示例
	 * newImg('图片', '宽度', '高度','缩略图宽高比','缩略图后缀名')
	 * $resizeImage	= new ResizeImage();
	 * $resizeImage->newImg($save_path.DS.$this->file_name,$thumb_width,$thumb_height,$scale,$thumb_ext[$i].'.',$save_path);
	 * 
	 * @param string $img 原图路径
	 * @param int $wid 缩略图宽度
	 * @param int $hei 缩略图高度
	 * @param $scale 缩略图宽高比 >0说明宽高相等，值为宽的值，=0为宽高不等
	 * @param string $small_ext 缩略图文件名后缀
	 * @param string $dst_img 生成图片地址
	 * @param $filling 是否允许填充空白，默认允许
	 * @return array $rs_row 返回数组形式的查询结果
	 */
	public function newImg($img, $wid, $hei,$small_ext="_small.",$dst_img='',$filling = true){
		$this->config['impath'] = C('thumb.impath');
		$this->config['thumb_type'] = C('thumb.cut_type');
		$this->config['thumb_quality'] = 100;
// 		$this->config['thumb_quality'] = (C('thumb_quality') ? C('thumb_quality') : 100);
		$this->srcimg = $img;
		$this->resize_width = round($wid);
		$this->resize_height = round($hei);
		$this->small_ext = $small_ext;
		$this->dstimg = $dst_img;
		$this->type = substr(strrchr($this->srcimg,"."),1);
// 		if ($this->config['thumb_type']=='im'){
// 			$this->thumb_im();
// 		}else{
			$this->thumb_gd();
// 		}
	}

	private function thumb_gd(){
		$this->initi_img();
		if (!is_resource($this->im)) return false;
		$this->dst_img();
		$this->width = imagesx($this->im);
		$this->height = imagesy($this->im);
		
		$differ=($this->resize_height/$this->resize_width)-($this->height/$this->width);
		if($differ<0){
			$dstW = $this->resize_width;        //设定缩略图的宽度
			$dstH=$dstW*($this->height/$this->width);//计算缩略图的高度
		}else{
			$dstH = $this->resize_height;        //设定缩略图的高度
			$dstW=$dstH*($this->width/$this->height);//计算缩略图的宽度
		}
			
		$dst_image = ImageCreateTrueColor($dstW,$dstH);      //创建新的图像对象
		ImageCopyResized($dst_image,$this->im,0,0,0,0,$dstW,$dstH,$this->width,$this->height);//将图像重定义大小后写入新的图像对象
		//剪裁图片
		$x=0;$y=0;
		if($differ<0){
			$y = ($dstH-$this->resize_height)/2;
		}else{
			$x = ($dstW-$this->resize_width)/2;
		}
		$newimg = ImageCreateTrueColor($this->resize_width,$this->resize_height);
			
		imagecopy($newimg, $dst_image, 0, 0, $x, $y, $this->resize_width, $this->resize_height);
		ImageJpeg($newimg,$this->dstimg);
		/**
		 * 销毁临时图
		 */
		ImageDestroy($dst_image);
		ImageDestroy($this->im);
		ImageDestroy($newimg);
	}

	/**
	 * 初始化图象
	 *
	 * @param 
	 * @return 
	 */
	private function initi_img()
	{
		if($this->type=="jpg"){
			$this->im = @imagecreatefromjpeg($this->srcimg);
		}
		if($this->type=="gif"){
			$this->im = @imagecreatefromgif($this->srcimg);
		}
		if($this->type=="png"){
			$this->im = imagecreatefrompng($this->srcimg);
		}
		if($this->type=='jpeg'){
			$this->im = imagecreatefromjpeg($this->srcimg);
		}
	}

	/**
	 * 图象目标地址
	 *
	 * @param 
	 * @return 
	 */
	private function dst_img()
	{
		if($this->dstimg == ''){
			$full_length = strlen($this->srcimg);
			$type_length = strlen($this->type);
			$name_length = $full_length-$type_length;
			$name = substr($this->srcimg,0,$name_length-1);
			$this->dstimg = $name.$this->small_ext.$this->type;
		}else{
			$line = str_replace('\\','/',$this->srcimg);
			$img = explode('/',$line);
			$file = explode('.',$img[count($img)-1]);
			$this->dstimg = $this->dstimg.'/'.$file[0].$this->small_ext.$file[1];
		}
		$this->relative_dstimg = str_replace(BASE_PATH,'',$this->dstimg);
	}
}