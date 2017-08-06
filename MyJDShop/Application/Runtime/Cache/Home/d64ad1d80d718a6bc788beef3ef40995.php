<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert title here</title>
<link rel="stylesheet" href="/MyJDShop/Public/Home/style/base.css" type="text/css">
<link rel="stylesheet" href="/MyJDShop/Public/Home/style/global.css" type="text/css">
<link rel="stylesheet" href="/MyJDShop/Public/Home/style/header.css" type="text/css">
<link rel="stylesheet" href="/MyJDShop/Public/Home/style/list.css" type="text/css">
<link rel="stylesheet" href="/MyJDShop/Public/Home/style/common.css" type="text/css">
<link rel="stylesheet" href="/MyJDShop/Public/Home/style/bottomnav.css" type="text/css">
<link rel="stylesheet" href="/MyJDShop/Public/Home/style/footer.css" type="text/css">
<script type="text/javascript" src="/MyJDShop/Public/Home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/MyJDShop/Public/Home/js/header.js"></script>
<script type="text/javascript" src="/MyJDShop/Public/Home/js/list.js"></script>
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

	<!-- 列表主体 start -->
	<div class="list w1210 bc mt10">
		<!-- 面包屑导航 start -->
		<div class="breadcrumb">
			<h2>全部结果 > "<?php echo ($_GET['search']); ?>"</h2>
		</div>
		<!-- 面包屑导航 end -->

		<!-- 左侧内容 start -->
		<div class="list_left fl mt10">
	<!-- 分类列表 start -->
	<?php echo ($catList); ?>
	<!-- 分类列表 end -->
		
	<div style="clear:both;"></div>	

	<!-- 新品推荐 start -->
	<div class="newgoods leftbar mt10">
		<h2><strong>新品推荐</strong></h2>
		<div class="leftbar_wrap">
			<ul>
				<li>
				<?php if(is_array($newProduct)): foreach($newProduct as $key=>$v): ?><dl>
						<dt><a href=""><img src="/MyJDShop/Public/Upload/Product/<?php echo ($v["imagename"]); ?>" alt="" /></a></dt>
						<dd><a href=""><?php echo ($v["productname"]); ?></a></dd>
						<dd><strong>￥<?php echo ($v["vipprice"]); ?></strong></dd>
					</dl><?php endforeach; endif; ?>
				</li>
			</ul>
		</div>
	</div>
	<!-- 新品推荐 end -->

	<!-- 最近浏览 start -->
	<div class="viewd leftbar mt10">
		<h2><a href="/MyJDShop/index.php/User/History/deleteHistory/clear/0">清空</a><strong>最近浏览过的商品</strong></h2>
		<div class="leftbar_wrap">
		<?php if(is_array($clickArr)): foreach($clickArr as $key=>$v): ?><dl>
				<dt><a href=""><img src="/MyJDShop/Public/Upload/Product/<?php echo ($v["imagename"]); ?>" alt="" /></a></dt>
				<dd><a href=""><?php echo ($v["productname"]); ?></a></dd>
			</dl><?php endforeach; endif; ?>	
		</div>
	</div>
	<!-- 最近浏览 end -->
</div>
		<!-- 左侧内容 end -->
	
		<!-- 列表内容 start -->
		<div class="list_bd fl ml10 mt10">
			<!-- 热卖、促销 start -->
			<div class="list_top">
				<!-- 热卖推荐 start -->
				<div class="hotsale fl">
					<h2><strong><span class="none">热卖推荐</span></strong></h2>
					<ul>
					<?php if(is_array($hotProduct)): foreach($hotProduct as $key=>$v): ?><li>
							<dl>
								<dt><a href="/MyJDShop/index.php/Home/Product/productDetail/productid/<?php echo ($v["productid"]); ?>"><img src="/MyJDShop/Public/Upload/Product/<?php echo ($v["imagename"]); ?>" alt="<?php echo ($v["productname"]); ?>" /></a></dt>
								<dd class="name"><a href="/MyJDShop/index.php/Home/Product/productDetail/productid/<?php echo ($v["productid"]); ?>"><?php echo ($v["productname"]); ?></a></dd>
								<dd class="price">特价：<strong><?php echo ($v["yhprice"]); ?></strong></dd>
								<dd class="buy"><span>立即抢购</span></dd>
							</dl>
						</li><?php endforeach; endif; ?>
					</ul>
				</div>
				<!-- 热卖推荐 end -->

				<!-- 促销活动 start -->
				<div class="promote fl">
					<h2><strong><span class="none">促销活动</span></strong></h2>
					<ul>
						<li><b>.</b><a href="">DIY装机之向雷锋同志学习！</a></li>
						<li><b>.</b><a href="">京东宏碁联合促销送好礼！</a></li>
						<li><b>.</b><a href="">台式机笔记本三月巨惠！</a></li>
						<li><b>.</b><a href="">富勒A53g智能人手识别鼠标</a></li>
						<li><b>.</b><a href="">希捷硬盘白色情人节专场</a></li>
					</ul>

				</div>
				<!-- 促销活动 end -->
			</div>
			<!-- 热卖、促销 end -->
			
			<div style="clear:both;"></div>
			
			<!-- 商品筛选 start -->
			<div class="filter mt10">
				<h2><a href="">重置筛选条件</a> <strong>商品筛选</strong></h2>
				<div class="filter_wrap">
					<dl>
						<dt>品牌：</dt>						
						<dd class="cur"><a href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($typeid); ?>">不限</a></dd>
						<?php if(is_array($brandArr)): foreach($brandArr as $key=>$v): if($_GET['brandid']== $v[brandid]): ?><dd class="cur"><a href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($typeid); ?>/brandid/<?php echo ($v["brandid"]); ?>"><?php echo ($v["brandname"]); ?></a></dd>
								<?php else: ?><dd><a href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($typeid); ?>/brandid/<?php echo ($v["brandid"]); ?>"><?php echo ($v["brandname"]); ?></a></dd><?php endif; endforeach; endif; ?>
					</dl>
				</div>
			</div>
			<!-- 商品筛选 end -->
			
			<div style="clear:both;"></div>

			<!-- 排序 start -->
			<div class="sort mt10">
				<dl>
					<dt>排序：</dt>
					<!-- 根据销量排序 -->
					<?php if($_GET['order']== asc): ?><!-- 如果get下的是asc那么点击后变desc -->
						<dd <?php if($_GET['field']== salesnum): ?>class="cur"<?php endif; ?>><a href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($typeid); ?>/field/salesnum/order/desc">销量</a></dd>	<!-- 传typeid 销量字段 -->
						<?php else: ?><dd <?php if($_GET['field']== salesnum): ?>class="cur"<?php endif; ?>><a href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($typeid); ?>/field/salesnum/order/asc">销量</a></dd><?php endif; ?>
					<!-- 根据价格排序 -->
					<?php if($_GET['order']== asc): ?><dd <?php if($_GET['field']== price): ?>class="cur"<?php endif; ?>><a href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($typeid); ?>/field/price/order/desc">价格</a></dd> <!-- 传typeid 价格字段 -->
						<?php else: ?><dd <?php if($_GET['field']== price): ?>class="cur"<?php endif; ?>><a href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($typeid); ?>/field/price/order/asc">价格</a></dd><?php endif; ?>
					<!-- 根据评论数排序 -->
					<?php if($_GET['order']== asc): ?><dd <?php if($_GET['field']== reviewnum): ?>class="cur"<?php endif; ?>><a href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($typeid); ?>/field/reviewnum/order/desc">评论数</a></dd>
						<?php else: ?><dd <?php if($_GET['field']== reviewnum): ?>class="cur"<?php endif; ?>><a href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($typeid); ?>/field/reviewnum/order/asc">评论数</a></dd><?php endif; ?>
					<!-- 根据上架时间排序 -->
					<?php if($_GET['order']== asc): ?><dd <?php if($_GET['field']== productid): ?>class="cur"<?php endif; ?>><a href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($typeid); ?>/field/productid/order/desc">上架时间</a></dd>
						<?php else: ?><dd <?php if($_GET['field']== productid): ?>class="cur"<?php endif; ?>><a href="/MyJDShop/index.php/Home/Product/productList/typeid/<?php echo ($typeid); ?>/field/productid/order/asc">上架时间</a></dd><?php endif; ?>
				</dl>
			</div>
			
			<!-- 排序 end -->
			
			<div style="clear:both;"></div>

			<!-- 商品列表 start-->
			<div class="goodslist mt10">
				<ul>
				<?php if(is_array($productArr)): foreach($productArr as $key=>$v): ?><li>
						<dl>
							<dt><a href="/MyJDShop/index.php/Home/Product/productDetail/productid/<?php echo ($v["productid"]); ?>"><img src="/MyJDShop/Public/Upload/Product/<?php echo ($v["imagename"]); ?>" alt="<?php echo ($v["productname"]); ?>" /></a></dt>
							<dd><a href="/MyJDShop/index.php/Home/Product/productDetail/productid/<?php echo ($v["productid"]); ?>"><?php echo ($v["productname"]); ?></a></dt>
							<dd><strong>￥<?php echo ($v["price"]); ?></strong></dt>
							<dd><a href="/MyJDShop/index.php/Home/Product/productDetail/productid/<?php echo ($v["productid"]); ?>"><em>已有<?php echo ($v["reviewnum"]); ?>条评价&nbsp;销量<?php echo ($v["salesnum"]); ?></em></a></dt>
						</dl>
					</li><?php endforeach; endif; ?>	
				</ul>
			</div>
			<!-- 商品列表 end-->

			<!-- 分页信息 start -->
			<div class="page mt20">
				<?php echo ($pagestr); ?>&nbsp;&nbsp;	
				<span>
					<em>共<?php echo ($countpage); ?>页&nbsp;&nbsp;到第 <input type="text" class="page_num" value="1"/> 页</em>
					<a href="" class="skipsearch" href="javascript:;">确定</a>
				</span>			
			</div>
			<!-- 分页信息 end -->

		</div>
		<!-- 列表内容 end -->
	</div>
	<!-- 列表主体 end-->

	<div style="clear:both;"></div>
	<!-- 底部导航 start -->
	<div class="bottomnav w1210 bc mt20">
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

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt10">
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