<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>订单页面</title>
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/home.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/order.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/bottomnav.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/footer.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/orderDetail.css" type="text/css">

	<script type="text/javascript" src="/MyJDShop/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/MyJDShop/Public/Home/js/header.js"></script>
	<script type="text/javascript" src="/MyJDShop/Public/Home/js/home.js"></script>
</head>
<body>
	<!-- 顶部导航 start -->
	
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w1210 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<?php if(!isset($_COOKIE['userid'])): ?><li>您好，欢迎来到京东！[<a href="/MyJDShop/index.php/Home/User/login">登录</a>] [<a href="/MyJDShop/index.php/Home/User/regist">免费注册</a>] </li>
						<?php else: ?><li>您好，欢迎来到京东！  <a href="/MyJDShop/index.php/User/User/userinfo"><?php echo ($_COOKIE['nickname']); ?></a></li>
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

	<!-- 头部 start -->
	<div class="header w1210 bc mt15">
		<!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
		<div class="logo w1210">
			<h1 class="fl"><a href="/MyJDShop/index.php/Home/Index/index"><img src="/MyJDShop/Public/Home/images/logo.png" alt="京西商城"></a></h1>
			<!-- 头部搜索 start -->
			<div class="search fl">
				<div class="search_form">
					<div class="form_left fl"></div>
					<form action="/MyJDShop/index.php/Home/Product/productSearch" name="search" method="get" class="fl">
						<input type="text" class="txt" placeholde="请输入商品关键字" value="<?php echo ($_GET['search']); ?>" name="search"/>
						<input type="submit" class="btn" value="搜索" />
					</form>
					<div class="form_right fl"></div>
				</div>
				
				<div style="clear:both;"></div>

				<div class="hot_search">
					<strong>热门搜索:</strong>   <!-- 怎么记录热门搜索  根据这个商品的点击数抽取四个商品名称 -->
					<?php if(is_array($clickTop)): foreach($clickTop as $key=>$v): ?><a href="/MyJDShop/index.php/Home/Product/productDetail/productid/<?php echo ($v["productid"]); ?>"><?php echo ($v["productname"]); ?></a>&nbsp;&nbsp;<?php endforeach; endif; ?>
				</div>
			</div>
			<!-- 头部搜索 end -->

			<!-- 用户中心 start-->
			<div class="user fl">
				<dl>
					<dt>
						<em></em>
						<a href="/MyJDShop/index.php/User/User/index">用户中心</a>
						<b></b>
					</dt>
					<dd>
					<?php if(!isset($_COOKIE['userid'])): ?><div class="prompt">
							您好，请<a href="/MyJDShop/index.php/Home/User/login">登录</a>
						</div><?php endif; ?>
						<div class="uclist mt10">
							<ul class="list1 fl">
								<li><a href="/MyJDShop/index.php/User/User/userinfo">用户信息></a></li>
								<li><a href="">我的订单></a></li>
								<li><a href="">收货地址></a></li>
								<li><a href="">我的收藏></a></li>
							</ul>

							<ul class="fl">
								<li><a href="">我的留言></a></li>
								<li><a href="">我的红包></a></li>
								<li><a href="">我的评论></a></li>
								<li><a href="">资金管理></a></li>
							</ul>

						</div>
						<div style="clear:both;"></div>
						<div class="viewlist mt10">
							<h3>最近浏览的商品：</h3>		<!-- 根据用户的点击时间抽取三张图片 -->
							<ul>
								<?php if(is_array($clickArr)): foreach($clickArr as $key=>$v): ?><li><a href="/MyJDShop/index.php/Home/Product/productDetail/productid/<?php echo ($v["productid"]); ?>"><img src="/MyJDShop/Public/Upload/Product/<?php echo ($v["imagename"]); ?>" alt="<?php echo ($v["procutname"]); ?>" /></a></li><?php endforeach; endif; ?>
							</ul>
						</div>
					</dd>
				</dl>
			</div>
			<!-- 用户中心 end-->

			<!-- 购物车 start -->
			<div class="cart fl">
				<dl>
					<dt>
						<a href="/MyJDShop/index.php/Home/CartCookie/index">去购物车结算</a>
						<b></b>
					</dt>
					<dd>
						<div class="prompt">
							<?php if($cartNum): ?>您购物车中共有<?php echo ($cartNum); ?>件商品<?php else: ?>
							购物车中还没有商品，赶紧选购吧！<?php endif; ?>
						</div>
					</dd>
				</dl>
			</div>
			<!-- 购物车 end -->
		</div>
		<!-- 头部上半部分 end -->
		
		<div style="clear:both;"></div>

		<!-- 导航条部分 start -->
		<div class="nav w1210 bc mt10">
			<!--  商品分类部分 start-->
				<div class="category fl cat1">  
				<div class="cat_hd off">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
				
					<h2>全部商品分类</h2>
					<em></em>
				</div>
				
				
					
					<div class="cat_bd none">
					<!-- 分类开始 -->
					<?php echo ($allTypeStr); ?>
					<!-- 分类结束 -->
					
				</div>
			</div>
			<!--  商品分类部分 end--> 

			<div class="navitems fl">
				<ul class="fl">
					<?php if($headerControllerName == 'Index'): ?><li class="current"><a href="/MyJDShop/index.php/Home/Index/index">首页</a></li>
						<?php else: ?><li><a href="/MyJDShop/index.php/Home/Index/index">首页</a></li><?php endif; ?>
					<?php if(is_array($headerFatherTypeArr)): foreach($headerFatherTypeArr as $key=>$v): if($headerTypeId == $v['typeid']): ?><li class="current"><a  href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($v["typeid"]); ?>"><?php echo ($v["typename"]); ?></a></li>
						<?php else: ?><li><a  href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($v["typeid"]); ?>"><?php echo ($v["typename"]); ?></a></li><?php endif; endforeach; endif; ?>
				</ul>
				<div class="right_corner fl"></div>
			</div>
		</div>
		<!-- 导航条部分 end -->
	</div>
	<!-- 头部 end-->
	
	<div style="clear:both;"></div>
	<!-- 头部 end-->
	
	<div style="clear:both;"></div>

	<!-- 页面主体 start -->
	<div class="main w1210 bc mt10">
		<div class="crumb w1210">
			<h2><strong>我的XX </strong><span>> 我的订单</span></h2>
		</div>
		
		<!-- 左侧导航菜单 start -->
		<div class="menu fl">
			<div class="menu_wrap">
				<dl>
					<dt>订单中心 <b></b></dt>
					<dd <?php if($controller.'/'.$method == 'Order/index'): ?>class="cur"<?php endif; ?>><b>.</b><a href="/MyJDShop/index.php/User/Order/index">我的订单</a></dd>
					<dd <?php if($method == mygz): ?>class="cur"<?php endif; ?>><b>.</b><a href="">我的关注</a></dd>
					<dd <?php if($method == history): ?>class="cur"<?php endif; ?>><b>.</b><a href="/MyJDShop/index.php/User/History/historyList">浏览历史</a></dd>
				</dl>

				<dl>
					<dt>账户中心 <b></b></dt>
					<dd <?php if($method == userinfo): ?>class="cur"<?php endif; ?>><b>.</b><a href="/MyJDShop/index.php/User/User/userinfo">账户信息</a></dd>
					<dd <?php if($method == balance): ?>class="cur"<?php endif; ?>><b>.</b><a href="">账户余额</a></dd>
					<dd <?php if($method == record): ?>class="cur"<?php endif; ?>><b>.</b><a href="">消费记录</a></dd>
					<dd <?php if($method == integral): ?>class="cur"<?php endif; ?>><b>.</b><a href="">我的积分</a></dd>
					<dd <?php if($method == addAddr): ?>class="cur"<?php endif; ?>><b>.</b><a href="/MyJDShop/index.php/User/User/addAddr">收货地址</a></dd>
				</dl>

				<dl>
					<dt>订单中心 <b></b></dt>
					<dd <?php if($method == repair): ?>class="cur"<?php endif; ?>><b>.</b><a href="">返修/退换货</a></dd>
					<dd <?php if($method == complain): ?>class="cur"<?php endif; ?>><b>.</b><a href="">我的投诉</a></dd>
				</dl>
			</div>
		</div>
		<!-- 左侧导航菜单 end -->

		<!-- 右侧内容区域 start -->
		<div class="content fl ml10">
			<div class="order_hd">
				<h3>我的订单</h3>
				<dl>
					<dt>订单号：</dt>
					<dd><?php echo ($orderArr["ordernum"]); ?></dd>
					
					<dd style="margin-left:150px;">未付款订单会为您保留24.0小时（从下单之日算起），24.0小时之后如果还未付款，系统将自动取消该订单。</dd>
				</dl>
			</div>

			<!-- 进度条state -->
			<h3 class="state-txt ftx-01"><b>等待付款</b></h3>
			<ul class='ul1'>
				<li class="txt1">&nbsp;</li>
				<li class="txt2">提交订单</li>
				<li id="track_time_0" class="txt3"><?php echo ($orderArr["date"]); ?><br> <?php echo ($orderArr["time"]); ?> </li>
			</ul>
			<ul class='ul2'>
				<li class="txt1">&nbsp;</li>
				<li class="txt2">付款成功</li>
				<li id="track_time_0" class="txt3">0000-00-00 <br> 00:00:00 </li>
			</ul>
			<ul class='ul3'>
				<li class="txt1">&nbsp;</li>
				<li class="txt2">商品出库</li>
				<li id="track_time_0" class="txt3">0000-00-00 <br> 00:00:00 </li>
			</ul>
			<ul class='ul4'>
				<li class="txt1">&nbsp;</li>
				<li class="txt2">等待收货</li>
				<li id="track_time_0" class="txt3">0000-00-00 <br> 00:00:00 </li>
			</ul>
			<ul class='ul5'>
				<li class="txt1">&nbsp;</li>
				<li class="txt2">完成</li>
				<li id="track_time_0" class="txt3">0000-00-00 <br> 00:00:00 </li>
			</ul>
			<!-- 进度条end -->
			
			<!-- 收货信息state -->
			<div class="dl">
				<div class="dt">
					<h4>收货人信息 </h4>   
				</div>
				<div class="dd">
					<div class="item">
						<span class="label">收货人：</span>
						<div class="info-rcol"><?php echo ($addrArr["name"]); ?></div>
					</div>
					<div class="item">
						<span class="label">地址：</span>
						<div class="info-rcol"><?php echo ($addrArr["addr"]); ?></div>
					</div>
					<div class="item">
						<span class="label">手机号码：</span>
						<div class="info-rcol"><?php echo ($addrArr["phone"]); ?></div>
					</div>           
				</div>
			</div>
			<!-- 收货信息end -->
			
			<!-- 配送信息state -->
			<div class="dl">
				<div class="dt">
					<h4>配送信息 </h4>   
				</div>
				<div class="dd">
					<div class="item">
						<span class="label">配送方式：</span>
						<div class="info-rcol"><?php echo ($addrArr["smode"]); ?></div>
					</div>
					<div class="item">
						<span class="label">运费：</span>
						<div class="info-rcol">0.00</div>
					</div>
					<div class="item">
						<span class="label">送货日期：</span>
						<div class="info-rcol"><?php echo ($tomorrow); ?></div>
					</div>  
					<div class="item">
						<span class="label">配送时间：</span>
						<div class="info-rcol">9:00-15:00</div>
					</div>   
					<div class="item">
						<span class="label">发票类型：</span>
						<div class="info-rcol">电子发票</div>
					</div>
					<div class="item">
						<span class="label">发票抬头：</span>
						<div class="info-rcol"><?php echo ($addrArr["fhead"]); ?></div>
					</div> 
					<div class="item">
						<span class="label">发票内容：</span>
						<div class="info-rcol"><?php echo ($addrArr["fcontent"]); ?></div>
					</div>        
				</div>
			</div>
			<!-- 配送信息end -->
			
			<!-- 付款信息state -->
			<div class="dl">
				<div class="dt">
					<h4>付款信息 </h4>   
				</div>
				<div class="dd">
					<div class="item">
						<span class="label">付款方式：</span>
						<div class="info-rcol"><?php echo ($addrArr["pay"]); ?></div>
					</div>
					<div class="item">
						<span class="label">商品总额：</span>
						<div class="info-rcol">￥<?php echo ($orderArr["totalprice"]); ?></div>
					</div>
					<div class="item">
						<span class="label">运费金额：</span>
						<div class="info-rcol">￥0.00</div>
					</div> 
					<div class="item">
						<span class="label">订单优惠：</span>
						<div class="info-rcol">￥0.00</div>
					</div>           
				</div>
			</div>
			<!-- 付款信息end -->
			
			
			<div class="order_bd mt10">
				<table class="orders">
					<thead>
						<tr>
							<th width="10%"></th>
							<th width="15%" style="text-align:left;">商品</th>
							<th width="10%">商品编号</th>
							<th width="10%">价格</th>
							<th width="20%">数量</th>
						</tr>
					</thead>
					<tbody>
					<?php if(is_array($detailArr)): foreach($detailArr as $key=>$v): ?><tr>
							<td style="text-align:right;"><a href="/MyJDShop/index.php/Home/Product/productDetail/productid/<?php echo ($v["productid"]); ?>"><img src="/MyJDShop/Public/Upload/Product/<?php echo ($v["imagename"]); ?>"></a></td>
							<td style="border-left:0px solid #ccc;text-align:left;"><a href="/MyJDShop/index.php/Home/Product/productDetail/productid/<?php echo ($v["productid"]); ?>"><?php echo ($v["productname"]); ?></a></td>
							<td><?php echo ($v["productid"]); ?></td>
							<td><?php echo ($v["vipprice"]); ?></td>
							<td><?php echo ($v["num"]); ?></td>
						</tr><?php endforeach; endif; ?>
					</tbody> 
				</table>
			</div>
		</div>
		<!-- 右侧内容区域 end -->
	</div>
	<!-- 页面主体 end-->

	<div style="clear:both;"></div>

	<!-- 底部导航 start -->
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>底部导航</title>
	<link rel="stylesheet" href="style/base.css" type="text/css"/>
	<link rel="stylesheet" href="style/global.css" type="text/css"/>
	<link rel="stylesheet" href="style/bottomnav.css" type="text/css" />
</head>
<body>
	
	<div style="clear:both;"></div>
	<!-- 底部导航 start -->
	<div class="bottomnav w1210 bc mt10">
		<div class="bnav1">
			<h3><b></b> <em>购物指南</em></h3>
			<ul>
				<li><a href="">购物流程</a></li>
				<li><a href="">会员介绍</a></li>
				<li><a href="">团购/机票/充值/点卡</a></li>
				<li><a href="">常见问题</a></li>
				<li><a href="">大家电</a></li>
				<li><a href="">联系客服</a></li>
			</ul>
		</div>
		
		<div class="bnav2">
			<h3><b></b> <em>配送方式</em></h3>
			<ul>
				<li><a href="">上门自提</a></li>
				<li><a href="">快速运输</a></li>
				<li><a href="">特快专递（EMS）</a></li>
				<li><a href="">如何送礼</a></li>
				<li><a href="">海外购物</a></li>
			</ul>
		</div>

		
		<div class="bnav3">
			<h3><b></b> <em>支付方式</em></h3>
			<ul>
				<li><a href="">货到付款</a></li>
				<li><a href="">在线支付</a></li>
				<li><a href="">分期付款</a></li>
				<li><a href="">邮局汇款</a></li>
				<li><a href="">公司转账</a></li>
			</ul>
		</div>

		<div class="bnav4">
			<h3><b></b> <em>售后服务</em></h3>
			<ul>
				<li><a href="">退换货政策</a></li>
				<li><a href="">退换货流程</a></li>
				<li><a href="">价格保护</a></li>
				<li><a href="">退款说明</a></li>
				<li><a href="">返修/退换货</a></li>
				<li><a href="">退款申请</a></li>
			</ul>
		</div>

		<div class="bnav5">
			<h3><b></b> <em>特色服务</em></h3>
			<ul>
				<li><a href="">夺宝岛</a></li>
				<li><a href="">DIY装机</a></li>
				<li><a href="">延保服务</a></li>
				<li><a href="">家电下乡</a></li>
				<li><a href="">京东礼品卡</a></li>
				<li><a href="">能效补贴</a></li>
			</ul>
		</div>
	</div>
	<!-- 底部导航 end -->
</body>
</html>
	<!-- 底部导航 end -->

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