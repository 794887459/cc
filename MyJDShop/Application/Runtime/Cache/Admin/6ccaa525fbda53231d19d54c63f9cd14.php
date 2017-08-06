<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>添加商品</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link href="/MyJDShop/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">

<style type="text/css">
td{
	width:40px;
}
#button{
	width:49.7%;
	background:#E8F2FC;
	color:#0000EE;
	font:14px/20px 微软雅黑;
}
</style>
</head>
<body>
<div class="div_head">
<span>
	<span style="float:left">当前位置是：商品管理-》添加商品信息</span>
    <span style="float:right;margin-right: 8px;font-weight: bold">
        <a style="text-decoration: none" href="/MyJDShop/index.php/Admin/Product/listProduct">【返回列表】</a>
        <a style="text-decoration: none" href="/MyJDShop/index.php/Admin/Index/index">【返回首页】</a>
        <a style="text-decoration: none" href="/MyJDShop/index.php/Admin/Brand/addBrand">【添加品牌】</a>
        <a style="text-decoration: none" href="/MyJDShop/index.php/Admin/GoodsTypes/addTypes">【添加分类】</a>
    </span>
</span>
</div>

<div style="font-size: 13px;margin: 10px 5px">
    <form action="" method="post" enctype="multipart/form-data">
       	<table border="1" width="100%" class="table_a">
           <tr>
               <td>商品名称</td>
               <td><input type="text" value="<?php echo ($arr["productname"]); ?>" disabled/></td>
           </tr>
           
           
           <?php if(is_array($imageArr)): foreach($imageArr as $key=>$v): ?><tr>
               <td>商品图片</td>
               <td>
               		<input type="file" name="imagename[]" multiple="multiple"/>
               		<img src="/MyJDShop/Public/upload/product/<?php echo ($v["imagename"]); ?>" alt="" width="100"/>
               </td>
           </tr><?php endforeach; endif; ?>
           <tr>
               <td colspan="2" align="center">
                   <input type="submit" value="修改" id="button">
                   <input type="reset" value="重置" id="button">
               </td>
           </tr>  
       </table>
	</form>
</div>
</body>
</html>