<?php
// 引用class文件夹对应的类
require_once('class/BCGFontFile.php');
require_once('class/BCGColor.php');
require_once('class/BCGDrawing.php');

// 条形码的编码格式
require_once('class/BCGcode39.barcode.php');

// 加载字体大小
$font = new BCGFontFile('./font/Arial.ttf', 18);

// 条形码需要的数据内容
$text = isset($_GET['text']) ? $_GET['text'] : 'HELLO';

//颜色条形码
$color_black = new BCGColor(0, 0, 0);
// 空白间隙颜色
$color_white = new BCGColor(255, 255, 255);

$drawException = null;
try {
    $code = new BCGcode39();
    $code->setScale(2); //条形码整体大小
    $code->setThickness(30); // 条形码的厚度
    $code->setForegroundColor($color_black); // 条形码颜色
    $code->setBackgroundColor($color_white); // 空白间隙颜色
    $code->setFont(0); // Font ($font or 0) 0则条形码下面无字体
    $code->parse($text); // 条形码需要的数据内容
} catch(Exception $exception) {
    $drawException = $exception;
}

//根据以上条件绘制条形码
$drawing = new BCGDrawing('', $color_white);
if($drawException) {
    $drawing->drawException($drawException);
} else {
    $drawing->setBarcode($code);
    $drawing->draw();
}

// 生成PNG格式的图片
header('Content-Type: image/png');
header('Content-Disposition: inline; filename="barcode.png"');

// Draw (or save) the image into PNG format.
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
?>