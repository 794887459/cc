<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>购物车页面</title>
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/cart.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/footer.css" type="text/css">

	<script type="text/javascript" src="/MyJDShop/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/MyJDShop/Public/Home/js/cart1.js"></script>
	<script>
		$(function(){
			$("[type='button']:eq(0)").click(function(){
				$('#form').attr('action','/MyJDShop/index.php/Home/CartCookie/updateCart').submit();
			})
			$("[type='button']:eq(1)").click(function(){
				$('#form').attr('action','/MyJDShop/index.php/Home/CartCookie/checkoutCart').submit();
			})
		})
	</script>
	<style>
		.l-tip, .nologin-tip {
		    border: 1px solid #edd28b;
		    background: #fffdee;
		    padding: 10px 20px;
		    line-height: 25px;
		    margin-bottom: 20px;
		    color: #f70;
			width:950;
			margin-left:150px;
		}
		
	</style>
</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<?php if(!isset($_COOKIE['userid'])): ?><li>您好，欢迎来到京东！[<a href="/MyJDShop/index.php/Home/User/login">登录</a>] [<a href="/MyJDShop/index.php/Home/User/register">免费注册</a>] </li>
						<?php else: ?><li>您好，欢迎来到京东！  <a href=""><?php echo ($_COOKIE['nickname']); ?></a></li>
						<li class="line">|</li>
						<li><a onclick="if (confirm('确定要退出吗？')) return true; else return false;" href="/MyJDShop/index.php/Home/User/logout">退出</a></li>
						<li class="line">|</li>
						<li><a href="/MyJDShop/index.php/User/Order/index">我的订单</a></li>
						<li class="line">|</li>
						<li>客户服务</li><?php endif; ?>
				</ul>
			</div>
		</div>
</div>
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>
	
	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="/MyJDShop/index.php/Home/Index/index"><img src="/MyJDShop/Public/Home/images/logo.png" alt="京西商城"></a></h2>
			<div class="flow fr">
				<ul>
					<li class="cur">1.我的购物车</li>
					<li>2.填写核对订单信息</li>
					<li>3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<?php if(!isset($_COOKIE['userid'])): ?><!-- 如果未登录 -->
	<div class="nologin-tip">
		<span class="wicon"></span>
		您还没有登录！登录后购物车的商品将保存到您账号中
		<a class="btn-1 ml10" href="/MyJDShop/index.php/Home/User/login/s/1">立即登录</a>
	</div><?php endif; ?>
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<div class="mycart w990 mt10 bc">
		<h2><span>我的购物车</span></h2>
		<form action="/MyJDShop/index.php/Home/CartCookie/updateCart" method="post" id="form">
			<table>
				<thead>
					<tr>
						<th class="col1">商品名称</th>
						<th class="col3">单价</th>
						<th class="col4">数量</th>	
						<th class="col5">小计</th>
						<th class="col6">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php if(is_array($cartArr)): foreach($cartArr as $key=>$v): ?><tr>
						<td class="col1"><a href="">
							<img src="/MyJDShop/Public/Upload/Product/<?php echo ($v["imagename"]); ?>" alt="" width="82px" height="82px"/><input type="hidden" name="imagename[]" value="<?php echo ($v["imagename"]); ?>"></a>  
							<strong><a href=""><?php echo ($v["productname"]); ?><input type="hidden" name="productname[]" value="<?php echo ($v["productname"]); ?>"></a></strong>
						</td>
						
						<td class="col3">￥<span><?php echo ($v["vipprice"]); ?><input type="hidden" name="vipprice[]" value="<?php echo ($v["vipprice"]); ?>"></span></td>
						<td class="col4"> 
							<a href="javascript:;" class="reduce_num"></a>
							<input type="text" name="amount[]" value="<?php echo ($v["num"]); ?>" class="amount"/>
							<input type="hidden" name="productid[]" value="<?php echo ($v["productid"]); ?>"/>
							<a href="javascript:;" class="add_num"></a>
						</td>
						<td class="col5">￥<span><?php echo ($v["xiaoji"]); ?>.00<input type="hidden" name="xiaoji[]" value="<?php echo ($v["xiaoji"]); ?>"></span></td>
						<td class="col6"><a href="/MyJDShop/index.php/Home/CartCookie/deleteCart/productid/<?php echo ($v["productid"]); ?>">删除</a></td>
					</tr><?php endforeach; endif; ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">购物金额总计： <strong>￥ <span id="total"><?php echo ($sum); ?>.00<input type="hidden" name="sum" value="<?php echo ($sum); ?>"></span></strong></td>
					</tr>
				</tfoot>
			</table>
			<div class="cart_btn w990 bc mt10">
				<a href="/MyJDShop/index.php/Home/Product/productList/typeid/1" class="continue">继续购物</a>
				<input type="button" value="更新购物" class="continue" style="margin-left:20px;border:0px #ccc solid;font-size:12px;cursor:pointer;color:#333">&nbsp;
				<input type="button" value="结算" class="checkout" style='border:0px #ccc solid'/>&nbsp;
			</div>
		</form>
	</div>
	<!-- 主体部分 end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt15">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="/MyJDShop/Public/Home/images/xin.png" alt="" /></a>
			<a href=""><img src="/MyJDShop/Public/Home/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="/MyJDShop/Public/Home/images/police.jpg" alt="" /></a>
			<a href=""><img src="/MyJDShop/Public/Home/images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->
</body>
</html>