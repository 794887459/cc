<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>修改商品</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link href="/MyJDShop/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
<script src="/MyJDShop/Public/Admin/kindeditor/kindeditor.js"></script>
<script src="/MyJDShop/Public/Admin/js/jquery.js"></script>
<script>
//加载编辑器
KindEditor.ready(function(e){
	//创建编辑器
	e.create('[name="content"]',{width:'100%',height:'200px'});
	e.create('[name="style"]',{width:'100%',height:'100px'});
})
$(function(){
	$('[name="typestr"]').change(function(){  //当商品分类发生改变
		var typeid = $('[name="typestr"]').val();
		$.ajax({
			url:"/MyJDShop/index.php/Admin/Product/ajax",
			type:"get",
			data:{'typeid':typeid},
			success:function(re){
				//alert(re);
				$("[name=brandid]").empty();
				$("[name=brandid]").append(re);
			}
		})
	})
})
</script>
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
	<span style="float:left">当前位置是：商品管理-》修改商品信息</span>
    <span style="float:right;margin-right: 8px;font-weight: bold">
        <a style="text-decoration: none" href="/MyJDShop/index.php/Admin/Product/listProduct">【返回列表】</a>
        <a style="text-decoration: none" href="/MyJDShop/index.php/Admin/Index/index">【返回首页】</a>
        <a style="text-decoration: none" href="/MyJDShop/index.php/Admin/Brand/addBrand">【添加品牌】</a>
        <a style="text-decoration: none" href="/MyJDShop/index.php/Admin/GoodsTypes/addTypes">【添加分类】</a>
    </span>
</span>
</div>

<div style="font-size: 13px;margin: 10px 5px">
    <form action="" method="post">
       	<table border="1" width="100%" class="table_a">
           <tr>
               <td>商品名称</td>
               <td><input type="text" name="productname" value="<?php echo ($post["productname"]); echo ($productArr["productname"]); ?>" autofocus='true' required/>&nbsp;&nbsp;<span><?php echo ($info["productname"]); ?></span></td>
           </tr>
           <tr>
               <td>商品分类</td>
               <td>
                   <select name="typestr">
                     	<?php echo ($optionStr); ?>
                   </select>
               </td>
           </tr>
           <tr>
               <td>商品品牌</td>
               <td>
                   <select name="brandid">
	                   <?php if(is_array($brandArr)): foreach($brandArr as $key=>$v): if($v['brandid'] == $productArr['brandid']): ?><option value="<?php echo ($v["brandid"]); ?>" selected><?php echo ($v["brandname"]); ?></option>
	                       		<?php else: ?><option value="<?php echo ($v["brandid"]); ?>"><?php echo ($v["brandname"]); ?></option><?php endif; endforeach; endif; ?>   
                   </select>                   
               </td>
           </tr>
           <tr>
           		<td>商品类型</td>
          	 	<td>
        			<select name="state">
        				<option value="0">普通商品</option>
        				<option value="1">热卖商品</option>
        				<option value="2">新品商品</option>
        				<option value="3">促销商品</option>
        			</select>
           		</td>
           </tr>
           <tr>
               <td>商品价格</td>
               <td><input type="text" name="price" value="<?php echo ($post["price"]); echo ($productArr["price"]); ?>" required/>&nbsp;&nbsp;<span><?php echo ($info["price"]); ?></span></td>
           </tr>
           <tr>
               <td>会员价格</td>
               <td><input type="text" name="vipprice" value="<?php echo ($post["vipprice"]); echo ($productArr["vipprice"]); ?>" required/>&nbsp;&nbsp;<span><?php echo ($info["vipprice"]); ?></span></td>
           </tr>
           <tr>
               <td>优惠价格</td>
               <td><input type="text" name="yhprice" value="<?php echo ($post["yhprice"]); echo ($productArr["yhprice"]); ?>" required/>&nbsp;&nbsp;<span><?php echo ($info["yhprice"]); ?></span></td>
           </tr>
           <tr>
               <td>优惠数量</td>
               <td><input type="text" name="yhnum" value="<?php echo ($post["yhnum"]); echo ($productArr["yhnum"]); ?>" required/>&nbsp;&nbsp;<span><?php echo ($info["yhnum"]); ?></span></td>
           </tr>
           <tr>
               <td>商品库存</td>
               <td><input type="text" name="libnum" value="<?php echo ($post["libnum"]); echo ($productArr["libnum"]); ?>" required/>&nbsp;&nbsp;<span><?php echo ($info["libnum"]); ?></span></td>
           </tr>
           <tr>             
               <td colspan=2>
                   <textarea  name="content"><?php echo ($info["content"]); echo ($productArr["content"]); ?></textarea>
                   <!-- &nbsp;&nbsp;<span><?php echo ($info["content"]); ?></span> -->
               </td>
           </tr>
           <tr>
               <td colspan=2>
                   <textarea placeholder='ddf' name="style"><?php echo ($info["style"]); echo ($productArr["style"]); ?></textarea>
                  <!--  &nbsp;&nbsp;<span><?php echo ($info["style"]); ?></span> -->
               </td>
           </tr>
           <tr>
               <td colspan="2" align="center">
                   <input type="submit" value="确认修改" id="button">
                   <input type="reset" value="重置" id="button">
               </td>
           </tr>  
       </table>
	</form>
</div>
</body>
</html>