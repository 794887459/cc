<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>填写核对订单信息</title>
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/fillin.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/footer.css" type="text/css">
	<script type="text/javascript" src="/MyJDShop/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/MyJDShop/Public/Home/js/cart2.js"></script>
	<script>
		$(function(){
			$('[name="city"]').change(function(){
				var cid = $(this).val();
				$.ajax({
					url:'/MyJDShop/index.php/User/User/ajax',
					type:'get',
					data:{'cid':cid},
					success:function(re){
						$('[name="region"] option:gt(0)').remove();//除了第一个
						//$("div span:gt(0)").remove();
						$('[name="region"]').append(re);
						//alert(re);
					}
				}) 
			})
			$('[name="region"]').change(function(){
				var cid = $(this).val();
				$.ajax({
					url:'/MyJDShop/index.php/User/User/ajax',
					type:'get',
					data:{'cid':cid},
					success:function(re){
						$('[name="county"] option:gt(0)').remove();//除了第一个
						//$("div span:gt(0)").remove();
						$('[name="county"]').append(re);
						//alert(re);
					}
				}) 
			})
		})
	</script>
	<style>
	#savesub{
		height:30px;background:#E43E41;color:#FFFFFF;border:0px;width:150px;font-size:14px;cursor: pointer;
	}
	#sub{
		background:red;
		border:none;
		color:#fff;
		height: 30px;
		margin-top: 10px;
		width:144px;
		cursor: pointer;
		font-size: 14px;
		font-weight: bolder;
	}
	#sub:hover{
		background-position: 0 -60px;
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
			<div class="flow fr flow2">
				<ul>
					<li>1.我的购物车</li>
					<li class="cur">2.填写核对订单信息</li>
					<li>3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<div class="fillin w990 bc mt15">
		<div class="fillin_hd">
			<h2>填写并核对订单信息</h2>
		</div>

		<div class="fillin_bd">
			<!-- 收货人信息  start-->
			<div class="address">
				<h3>收货人信息 <a href="javascript:;" id="address_modify">[修改]</a></h3>
				
				<div class="address_info">
					<p><?php echo ($defArr["name"]); ?>  <?php echo ($defArr["phone"]); ?> </p>
					<p><?php echo ($defArr["addr"]); ?> </p>
				</div>

				<div class="address_select none">
					<ul>
					<?php if(is_array($infoArr)): foreach($infoArr as $key=>$v): ?><li class="cur">
							<input type="radio" name="address" <?php if($v['state'] == 1): ?>checked="checked"<?php endif; ?> /><?php echo ($v["name"]); ?>&nbsp;&nbsp;<?php echo ($v["addr"]); ?> <?php echo ($v["phone"]); ?> 
							<a href="/MyJDShop/index.php/User/User/setDefaddr/id/<?php echo ($v["id"]); ?>">设为默认地址</a>
							<a href="/MyJDShop/index.php/User/User/addAddr/id/<?php echo ($v["id"]); ?>/s/2">编辑</a>
							<a href="/MyJDShop/index.php/User/User/deleteAddr/id/<?php echo ($v["id"]); ?>/s/2">删除</a>
						</li><?php endforeach; endif; ?>
						<li><input type="radio" name="address" class="new_address"  />使用新地址</li>
					</ul>	
					<form action="/MyJDShop/index.php/User/User/addAddr/s/2" class="none" name="address_form" method="post">
						<ul>
							<li>
								<label for=""><span>*</span>收 货 人：</label>
								<input type="text" name="name" class="txt" />
							</li>
							<li>
								<label for=""><span></span>所在地区：</label>
								<select name="city" id="">
									<option value="">请选择</option>
									<?php echo ($cityStr); ?>
								</select>

								<select name="region" id="">
									<option value="">请选择</option>
								</select>

								<select name="county" id="">
									<option value="">请选择</option>
								</select>
							</li>
							<li>
								<label for=""><span>*</span>详细地址：</label>
								<input type="text" name="addr" class="txt address"  />
							</li>
							<li>
								<label for=""><span>*</span>手机号码：</label>
								<input type="text" name="phone" class="txt" />
							</li>
						</ul>
						<input type="submit" value="保存收货人信息" id="savesub"/>
					</form>
				</div>
			</div>
			<!-- 收货人信息  end-->
					
			<!-- 配送方式 start -->
			<div class="delivery">
				<h3>送货方式 <a href="javascript:;" id="delivery_modify">[修改]</a></h3>
				<div class="delivery_info">
					<p><?php if(!$defArr['smode']): ?>普通快递<?php endif; echo ($defArr["smode"]); ?></p>
					<p><?php if(!$defArr['stime']): ?>时间不限<?php endif; echo ($defArr["stime"]); ?></p>
				</div>

				<div class="delivery_select none">
					<form  action="/MyJDShop/index.php/User/User/updateAddr/s/2" method="post" id="s_from">
						<table>
							<thead>
								<tr>
									<th class="col1">送货方式</th>
									<th class="col2">运费</th>
									<th class="col3">运费标准</th>
								</tr>
							</thead>
							<tbody>
								<tr class="cur">	
									<td>
										<input type="radio" name="smode" value="普通快递送货上门" checked="checked"/>普通快递送货上门
										<select name="stime" id="">
											<option value="时间不限">时间不限</option>
											<option value="工作日，周一到周五">工作日，周一到周五</option>
											<option value="周六日及公众假期">周六日及公众假期</option>
										</select>
									</td>
									<td>0</td>
									<td>包邮</td>
								</tr>
								<tr>
									<td><input type="radio" name="smode" value="顺丰专递" />顺丰专递</td>
									<td>￥25.00</td>
									<td>顺丰快递需补运费差价</td>
								</tr>
							</tbody>
						</table>
						<input type="submit" id="sub" value="确认送货方式" />
					</form>
				</div>
			</div> 
			
			<!-- 配送方式 end --> 

			<!-- 支付方式  start-->
			<div class="pay">
				<h3>支付方式 <a href="javascript:;" id="pay_modify">[修改]</a></h3>
				<div class="pay_info">
					<p><?php echo ($defArr["pay"]); ?></p>
				</div>

				<div class="pay_select none">
					<form  action="/MyJDShop/index.php/User/User/updateAddr/s/2" method="post">
						<table> 
							<tr>
								<td class="col1"><input type="radio" name="pay" value="在线支付" checked="checked"/>在线支付</td>
								<td class="col2">即时到帐，支持绝大数银行借记卡及部分银行信用卡</td>
							</tr>
							<tr class="cur">
								<td class="col1"><input type="radio" name="pay" value="货到付款"/>货到付款</td>
								<td class="col2">送货上门后再收款，支持现金、POS机刷卡、支票支付</td>
							</tr>
						</table>
						<input type="submit" id="sub" value="确认支付方式" />
					</form>
				</div>
			</div>
			<!-- 支付方式  end-->

			<!-- 发票信息 start-->
			<div class="receipt">
				<h3>发票信息 <a href="javascript:;" id="receipt_modify">[修改]</a></h3>
				<div class="receipt_info">
					<p><?php echo ($defArr["fhead"]); ?></p>
					<p>内容：<?php echo ($defArr["fcontent"]); ?></p>
				</div>

				<div class="receipt_select none">
					<form  action="/MyJDShop/index.php/User/User/updateAddr/s/2" method="post">
						<ul>
							<li>
								<label for="">发票抬头：</label>
								<input type="radio" name="fhead" checked="checked" class="personal" value="个人"/>个人
								<input type="radio" name="fhead" class="company" value="单位"/>单位
								<input type="text"  name="fhead" class="txt company_input" disabled="disabled" value="<?php echo ($defArr["fhead"]); ?>"/>
							</li>
							<li>
								<label for="">发票内容：</label>
								<input type="radio" name="fcontent" checked="checked" value="明细"/>明细
								<input type="radio" name="fcontent" value="办公用品"/>办公用品
								<input type="radio" name="fcontent" value="体育休闲"/>体育休闲
								<input type="radio" name="fcontent" value="耗材"/>耗材
							</li>
						</ul>
						<input type="submit" id="sub" value="确认支付方式" />						
					</form>
				</div>
			</div>
			<!-- 发票信息 end-->

			<!-- 商品清单 start -->
			<div class="goods">
				<h3>商品清单</h3>
				<table>
					<thead>
						<tr>
							<th class="col1">商品</th>
							<th class="col2">规格</th>
							<th class="col3">价格</th>
							<th class="col4">数量</th>
							<th class="col5">小计</th>
						</tr>	
					</thead>
					<tbody>
					<?php if(is_array($cartArr)): foreach($cartArr as $key=>$v): ?><tr>
							<td class="col1"><a href=""><img src="/MyJDShop/Public/Upload/Product/<?php echo ($v["imagename"]); ?>" alt="" /></a>  <strong><a href=""><?php echo ($v["productname"]); ?></a></strong></td>
							<td class="col2"> <p><?php echo ($v["style"]); ?></p> <p></p> </td>
							<td class="col3">￥<?php echo ($v["vipprice"]); ?></td>
							<td class="col4"> <?php echo ($v["num"]); ?></td>
							<td class="col5"><span id="xiaoji">￥<?php echo ($v["xiaoji"]); ?>.00</span></td>
						</tr><?php endforeach; endif; ?>	
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5">
								<ul>
									<li><!-- $被调节变量|函数名=参数1,参数2,###..... -->
										<span><?php echo (count($cartArr)); ?> 件商品，总商品金额：￥<?php echo ($cartArr[0]['sum']); ?>.00</span>
										<em></em>
									</li>
									
									<li>
										<span>应付总额：￥<?php echo ($cartArr[0]['sum']); ?>.00</span>
										<em></em>
									</li>
								</ul>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<!-- 商品清单 end -->
		
		</div>

		<div class="fillin_ft">
			<a href="/MyJDShop/index.php/User/Order/order"><span>提交订单</span></a>
			<p>应付总额：<strong>￥<?php echo ($cartArr[0]['sum']); ?>.00元</strong></p>
		</div>
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