<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>分类列表</title>
<link href="/MyJDShop/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
<script src="/MyJDShop/Public/Admin/js/jquery.js"></script>
<style>
.tr_color{
	background-color: #9F88FF
}
.button{
	width:100px;
	height:20px;
	background:#E8F2FC;
	font-size:10px;
}
.bg{
	background:#EAF1D7;
}
</style>
<script>
$(function(){
	$(':button').prop('disabled',$("[name='id[]']:checked").size()==0);//按钮初始化为不可用
	//控制全选和取消全选
	$('#control').click(function(){
		//先获取control的checkbox的属性true / false,让checked[]的属性和control相同
		$("[name='id[]']").prop('checked',$(this).prop('checked'));
		$(':button').prop('disabled',$("[name='id[]']:checked").size()==0);
	})
	//单击列表的复选框
	$("[name='id[]']").click(function(){
		var chenkedNUm = $("[name='id[]']:checked").size();//获取被选中的数量
		var b = $("[name='id[]']").size();
		$('#control').prop("checked",chenkedNUm==b);
		$(':button').prop('disabled',$("[name='id[]']:checked").size()==0);
	})
	//控制背景颜色
	$("tr:not(:first):not(:last)").hover(function(){
		$(this).addClass("bg");
	},function(){
		$(this).removeClass('bg');
	});
	//提交事件
	$("[type='button']:eq(0)").click(function(){
		$('form').attr('action','huishouType').submit();
	})
	$("[type='button']:eq(2)").click(function(){
		$('form').attr('action','deleteType').submit();	
	})
	$("[type='button']:eq(1)").click(function(){
		$('form').attr('action','showType').submit();	
	})
})
</script>
</head>
<body>
<div class="div_head">
    <span>
        <span style="float: left;">当前位置是：分类管理-》分类列表</span>
        <span style="float: right; margin-right: 8px; font-weight: bold;">
            <a style="text-decoration: none;" href="/MyJDShop/index.php/Admin/GoodsTypes/addTypes">【添加分类】</a>
        </span>
    </span>
</div>
	<div class="div_search">
	    <span>
	        <form action="/MyJDShop/index.php/Admin/GoodsTypes/searchType" method="get">
	                 分类<select name="search_name" style="width: 100px;">
	                <?php echo ($option); ?>
	            </select>
	            <input value="查询" type="submit" />
	        </form>
	    </span>
	</div>
<form method="post">
	<div style="font-size: 13px; margin: 10px 5px;">
	    <table class="table_a" border="1" width="100%">
	        <tbody><tr style="font-weight: bold;">
	                <td><input type="checkbox" id="control"/></td>
	                <td>分类名称</td>  
	                <td>状态</td>          
	                <td align="center">操作</td>
	            </tr>
	            <?php echo ($tr_str); ?>
	            <tr>
	                <td colspan="4" style="text-align: left;">
	                	<input type="button" value="回收" class="button">&nbsp;
						<input type="button" value="显示" class="button">&nbsp;
						<input type="button" value="彻底删除！" class="button" style="color: #f00">
	                </td>
	            </tr>
	        </tbody>
	    </table>
	</div>
</form>
</body>
</html>