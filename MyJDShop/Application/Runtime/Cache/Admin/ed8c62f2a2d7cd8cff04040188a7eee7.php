<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>添加广告</title>
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
	cursor:pointer;
}
</style>
</head>
<body>
<div class="div_head">
    <span>
        <span style="float:left">当前位置是：品牌中心-》添加广告信息</span>
        <span style="float:right;margin-right: 8px;font-weight: bold">
            <a style="text-decoration: none" href="/MyJDShop/index.php/Admin/Adv/listAdv">【返回列表】</a>
        </span>
    </span>
</div>

<div style="font-size: 13px;margin: 10px 5px">
	<form action="" method="post" enctype="multipart/form-data">
		<table border="1" width="1000px" class="table_a">
		    <tr>
		        <td width="5%">广告标题</td>
		        <td width="5%"><input type="text" name="title" />&nbsp;<span><?php echo ($info); ?></span></td>
		    </tr>
		    <tr>
		        <td>图片</td>
		        <td><input type="file" name="upload""/></td>
		    </tr>
		    <tr>
		        <td>广告分类</td>
		        <td>
		            <select name="typeid">
		               <option value="0">轮播广告</option>
		               <option value="1" selected>普通广告</option>
		            </select>
		        </td>
		    </tr>
		    <tr>
		        <td>广告链接</td>
		        <td><input type="text" name="link" />&nbsp;<span><?php echo ($info); ?></span></td>
		    </tr>		    
		    <tr>
		        <td colspan="2">
		            <input type="submit" value="添加广告" id="button">
		        </td>
		    </tr>  
		</table>
	</form>
</div>
</body>
</html>