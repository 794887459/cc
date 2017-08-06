<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>添加品牌</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link href="/MyJDShop/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
<style>
td{
	width:40px;
}
#button{
	width:100%;
	background:#E8F2FC;
	color:#0000EE;
}
</style>
</head>
<body>
<div class="div_head">
    <span>
        <span style="float:left">当前位置是：品牌中心-》添加品牌信息</span>
        <span style="float:right;margin-right: 8px;font-weight: bold">
            <a style="text-decoration: none" href="/MyJDShop/index.php/Admin/Brand/listBrand">【返回列表】</a>
        </span>
    </span>
</div>

<div style="font-size: 13px;margin: 10px 5px">
	<form action="" method="post" enctype="multipart/form-data">
		<table border="1" width="100%" class="table_a">
		    <tr>
		        <td>品牌名称</td>
		        <td><input type="text" name="brandname" />&nbsp;<span><?php echo ($info); ?></span></td>
		    </tr>
		    <tr>
		        <td>品牌图片</td>
		        <td><input type="file" name="upload" multiple="multiple"/></td>
		    </tr>
		    <tr>
		        <td>品牌分类</td>
		        <td>
		            <select name="typeid">
		               <?php echo ($optionStr); ?>
		            </select>
		        </td>
		    </tr>		    
		    <tr>
		        <td colspan="2">
		            <input type="submit" value="添加品牌" id="button">
		        </td>
		    </tr>  
		</table>
	</form>
</div>
</body>
</html>