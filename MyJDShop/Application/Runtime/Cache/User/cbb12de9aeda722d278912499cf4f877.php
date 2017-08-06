<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>我的足迹-京东网上商城</title>
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/home.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/user.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/bottomnav.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/footer.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/userinfo.css" type="text/css">
	
	<script type="text/javascript" src="/MyJDShop/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/MyJDShop/Public/Home/js/header.js"></script>
	<script type="text/javascript" src="/MyJDShop/Public/Home/js/home.js"></script>
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/history.css" type="text/css">
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
								<li><a href=""><img src="/MyJDShop/Public/Home/images/view_list1.jpg" alt="" /></a></li>
								<li><a href=""><img src="/MyJDShop/Public/Home/images/view_list2.jpg" alt="" /></a></li>
								<li><a href=""><img src="/MyJDShop/Public/Home/images/view_list3.jpg" alt="" /></a></li>
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
							购物车中还没有商品，赶紧选购吧！
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
<div class="w">
	<div class="breadcrumb">
        <a href=""><strong>我的足迹</strong></a>&nbsp;>&nbsp;
    </div>
</div><!--breadcrumb-->
<div class="w" id="content-history">
    <div class="goods">
        <div class="m">
            <div class="nav-history">
                <div class="nh-left " ><a href="/MyJDShop/index.php/User/History/historyList">全部分类</a></div>
                <div class="nh-center" clstag = "personal|keycount|myhistory|2014class">
                    <ul>
	                    <?php if(is_array($headerFatherTypeArr)): foreach($headerFatherTypeArr as $key=>$v): ?><li <?php if($_GET['typeid'] == $v['typeid']): ?>class="nh-cur"<?php endif; ?>><a href="/MyJDShop/index.php/User/History/historyList/typeid/<?php echo ($v["typeid"]); ?>"><?php echo ($v["typename"]); ?></a></li><?php endforeach; endif; ?>
                   </ul>
                </div>
        	</div>
        </div>
        <!-- 分类end -->
             
        <!-- 历史商品start -->
        <!-- <div class='goods-content'>
            <div class='mt'>
            	<strong>2017-7-11</strong>                    
            	<span class='del-all'>删除</span> 
            </div>
           	<div id='p-list'>
           	
           		<div class='img_p'>
           			<img src='/MyJDShop/Public/Upload/Product/594bb60dae8f8.jpg' width='220px'/>
           			<div class='p-price'><i class="J-p-1057210">￥849.00</i><span class="p-del"><a href="" title="删除">×</a></span></div>
           		</div>  
           		  
           	</div>
        </div> -->
        <?php echo ($historyStr); ?>
        <!-- 历史商品end -->
    </div>
</div>
</body>
</html>