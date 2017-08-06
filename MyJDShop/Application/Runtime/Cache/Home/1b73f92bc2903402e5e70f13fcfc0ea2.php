<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>用户注册</title>
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/login.css" type="text/css">
	<link rel="stylesheet" href="/MyJDShop/Public/Home/style/footer.css" type="text/css">
	<script src="/MyJDShop/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script>
		$(function(){
			var u     = false;
			var p     = false;
			var r     = false;
			
			//用户名验证
			$('[name="username"]').blur(function(){
				var uvalue = $(this).val();
				var ureg  = /[\u4e00-\u9fa5a-zA-Z0-9\-]{4,20}/;
				if(uvalue==''){
					$(this).next('span').html('*必填');
				}else if(!ureg.test(uvalue)){
					$(this).next('span').html('*格式不正确');
				}else{
					$(this).next('span').html('');
					u     = true;
				}
			})
			//密码验证
			$('[name="password"]').blur(function(){
				var pvalue = $(this).val();
				var preg  = /^(?![\d]+$)(?![a-zA-Z]+$)(?![^\da-zA-Z]+$).{6,20}$/;
				if(pvalue==''){
					$(this).next('span').html('*必填');
				}else if(!preg.test(pvalue)){
					$(this).next('span').html('*格式不正确');
				}else{
					$(this).next('span').html('');
					p     = true;
				}
			})
			$('[name="repassword"]').blur(function(){
				var pvalue = $(this).val();
				var rvalue = $('[name="password"]').val();
				if(pvalue==''){
					$(this).next('span').html('*必填');
				}else if(pvalue!=rvalue){
					$(this).next('span').html('*两次密码必须一致');
				}else{
					$(this).next('span').html('^-^ OK');
					r     = true;
				}
			})
			//验证码局部刷新
			$('#f5').click(function(){
				//alert('fdf');
				$('#img').attr('src',"/MyJDShop/index.php/Home/User/showCode/id/"+Math.random());
			})
			//提交表单
			$(':button').click(function(){
				var agree = $('.chb').prop('checked');//注册协议
				if(!agree){
					$("#a").html('&nbsp;&nbsp;<span style="color:#f00">*</span>必选');
				}else{$("#a").html('<span style="color:#f00"></span>');}
				if( u && p && r){
					$('form').submit();
				}
			})	
		})
	</script>
</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<li>您好，欢迎来到京西！[<a href="/MyJDShop/index.php/Home/User/login">登录</a>] [<a href="/MyJDShop/index.php/Home/User/regist">免费注册</a>] </li>
					<li class="line">|</li>
					<li>我的订单</li>
					<li class="line">|</li>
					<li>客户服务</li>

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
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<!-- 登录主体部分start -->
	<div class="login w990 bc mt10 regist">
		<div class="login_hd">
			<h2>用户注册</h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="/MyJDShop/index.php/Home/User/regist" method="post">
					<ul>
						<li>
							<label for="">用户名：</label>
							<input type="text" class="txt" name="username" value="<?php echo ($post["username"]); ?>"/>&nbsp;&nbsp;<span><?php echo ($errinfo["username"]); ?></span>
							<p>3-20位字符，可由中文、字母、数字和下划线组成</p>
						</li>
						<li>
							<label for="">密码：</label>
							<input type="password" class="txt" name="password" value="<?php echo ($post["password"]); ?>"/>&nbsp;&nbsp;<span><?php echo ($errinfo["password"]); ?></span>
							<p>6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号</p>
						</li>
						<li>
							<label for="">确认密码：</label>
							<input type="password" class="txt" name="repassword" value="<?php echo ($post["repassword"]); ?>"/>&nbsp;&nbsp;<span><?php echo ($errinfo["repassword"]); ?></span>
							<p> <span>请再次输入密码</p>
						</li>
						<li class="checkcode">
							<label for="">验证码：</label>
							<input type="text"  name="checkcode" />
							<img src="/MyJDShop/index.php/Home/User/showCode" alt="" id="img"/>
							<span id="f5" style="margin-left:20px;cursor:pointer;color:#00f">看不清？ 换一张</span>&nbsp;&nbsp;<?php echo ($errinfo["checkcode"]); ?>
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="checkbox" class="chb" checked/> 我已阅读并同意《用户注册协议》&nbsp;&nbsp;<span id="a"></span>
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="button" value="" class="login_btn" />
						</li>
					</ul>
				</form>

			</div>
			
			<div class="mobile fl">
				<h3>手机快速注册</h3>			
				<p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
				<p><strong>1069099988</strong></p>
			</div>

		</div>
	</div>
	<!-- 登录主体部分end -->

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