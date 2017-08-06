<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>商品列表</title>
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
function getbrand(){
	//分类联动	
	//$('[name="search_typestr"]').change(function(){    //$("p").on("mouseover mouseout",function(){
		var typeid=$('[name="search_typestr"]').val();
		var brandid = $('[name="search_brandid"]').val();
		$.ajax({
			url:'/MyJDShop/index.php/Admin/Product/ajax',
			type:'get',
			data:{'typeid':typeid,'brandid':brandid},
			success:function(re){
				$('[name="search_brandid"] option:gt(0)').remove();
				//$("div span:gt(0)").remove();
				$('[name="search_brandid"]').append(re);
			}
		})
	//})
}
$(function(){	
	getbrand();
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
		$('#form2').attr('action','huishouProduct').submit();
	})
	$("[type='button']:eq(2)").click(function(){
		$('#form2').attr('action','deleteProduct').submit();	
	})
	$("[type='button']:eq(1)").click(function(){
		$('#form2').attr('action','showProduct').submit();	
	})
})
</script>
</head>
<body">
<div class="div_head">
    <span>
        <span style="float: left;">当前位置是：商品管理-》商品列表</span>
      	<span style="float: right; margin-right: 8px; font-weight: bold;">
         	 <a style="text-decoration: none;" href="/MyJDShop/index.php/Admin/Product/addProduct">【添加商品】</a>
         	 <a style="text-decoration: none;" href="/MyJDShop/index.php/Admin/Index/index">【返回首页】</a>
         	 <a style="text-decoration: none;" href="/MyJDShop/index.php/Admin/GoodsTypes/addTypes">【添加分类】</a>
        </span>
    </span>
</div>
<div class="div_search">
    <span>
        <form action="" method="get">
            <select onchange="getbrand()"  name="search_typestr" style="width: 100px;">
            	<option value='' selected>请选择分类</option>
               	<?php echo ($typeOption); ?>
            </select>
            <span>&gt;</span>
            <select name="search_brandid" style="width: 100px;">
            	<option value=''>请选择品牌</option>
            	<?php if(is_array($brandArr)): foreach($brandArr as $key=>$v): if($v['brandid'] == $brandid): ?><option value="<?php echo ($v["brandid"]); ?>" selected="selected"><?php echo ($v["brandname"]); ?></option>
                		<?php else: ?><option value="<?php echo ($v["brandid"]); ?>"><?php echo ($v["brandname"]); ?></option><?php endif; endforeach; endif; ?>
            </select>
            <span>&gt;</span>
            <input type="text" name="search_name" placeholder="商品名" value="<?php echo ($searchname); ?>" style="width: 100px;"></input>
            <input value="查询" type="submit" />
        </form>
    </span>
</div>
<div style="font-size: 13px; margin: 10px 5px;">
<form action="" method="post" id="form2">
    <table class="table_a" border="1" width="100%">
        <tbody><tr style="font-weight: bold;">
                <td><input type="checkbox" id="control"/></td>
                <td>商品名称</td> 
                <td>商品图片</td>
                <td>商品分类</td>
                <td>商品品牌</td>
                <td>商品价格</td> 
                <td>VIP价格</td> 
                <td>商品库存</td> 
                <td>状态</td> 
                <td style="text-align:center">回收状态</td>  
                <td>操作</td>                     
            </tr>
            <?php if(is_array($productArr)): foreach($productArr as $key=>$v): ?><tr id="product1">
                <td><input type="checkbox" name="id[]" value="<?php echo ($v["productid"]); ?>"/></td>
                <td><?php echo ($v["productname"]); ?></td>
                <td><a href="/MyJDShop/index.php/Admin/Product/updateImage/productid/<?php echo ($v["productid"]); ?>"><img src="/MyJDShop/Public/upload/product/<?php echo ($v["imagename"]); ?>" width="100">修改</a></td>
                <td><?php echo ($v["typestr"]); ?></td>
                <td><?php echo ($v["brandname"]); ?></td>
                <td><?php echo ($v["price"]); ?></td>
                <td><?php echo ($v["vipprice"]); ?></td>
                <td><?php echo ($v["libnum"]); ?></td>
                <?php if($v[state] == 1): ?><td style="color:red">热卖商品</td> 
                	<?php else: if($v['state'] == 2): ?><td style="color:red">新品推荐</td>
                	<?php else: ?><td>普通商品</td><?php endif; endif; ?>
                <?php if($v[isdel]): ?><td style="color:red;text-align:center"><img src="/MyJDShop/Public/Admin/images/show.png"></td> 
                	<?php else: ?><td style="text-align:center"><img src="/MyJDShop/Public/Admin/images/hidden.png"></td><?php endif; ?> 
                <td align="center"><a href="/MyJDShop/index.php/Admin/Product/updateProduct/productid/<?php echo ($v["productid"]); ?>">修改</a></td>                     
            </tr><?php endforeach; endif; ?>
            <tr>
                <td colspan="11" style="text-align: left;">
                	<input type="button" value="回收" class="button">&nbsp;
					<input type="button" value="显示" class="button">&nbsp;
					<input type="button" value="彻底删除！" class="button" style="color: #f00">
					<?php echo ($pagestr); ?>					
	            </td>
            </tr>
        </tbody>
    </table>
</form>
</div>
</body>
</html>