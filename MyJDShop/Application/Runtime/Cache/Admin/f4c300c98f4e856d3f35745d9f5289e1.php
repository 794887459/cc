<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>添加分类</title>
<meta charset=utf-8">
<link href="/MyJDShop/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
<style>
td{
	width:30px;
}
</style>
</head>
<body>
<div class="div_head">
	<span>
		<span style="float:left">当前位置是：分类管理-》修改分类信息</span>
		<span style="float:right;margin-right: 8px;font-weight: bold">
			<a style="text-decoration: none" href="/MyJDShop/index.php/Admin/GoodsTypes/listType">【返回列表】</a>
		</span>
	</span>
</div>
<div style="font-size: 13px;margin: 10px 5px">
	<form action="/MyJDShop/index.php/Admin/GoodsTypes/updateType/typeid/<?php echo ($typeValue["typeid"]); ?>" method="post">
	    <table border="1" width="100%" class="table_a">
	        <tr>
	            <td>分类名称</td>
	            <td><input type="text" name="typename" value="<?php echo ($typeValue["typename"]); ?>"/>&nbsp;<span><?php echo ($info["typename"]); ?></span></td>
	           
	        </tr>
	        <tr>
	            <td>父分类</td>
	            <td>
	            	<input type="hidden" name="url" value="<?php echo ($_SERVER['HTTP_REFERER']); ?>"/>
	                <select name="fid">
	                    <option value="0">顶级</option>
	                    <?php echo ($optionStr); ?>
	                </select>
	            </td>	             
	        </tr> 	        	        
	        <tr>
	            <td colspan="2" align="center">
	                <input type="submit" value="确认修改">
	            </td>
	        </tr>  
	    </table>
	</form>
</div>
</body>
</html>