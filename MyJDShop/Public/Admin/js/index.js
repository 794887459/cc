$(function(){
	//点击评论排行特效
	$('#reviewContent').hide();
	$('#clickTop').addClass('title-name-hover');
	$('#clickTop').mouseover(function(){
		$('#clickContent').show();
		$('#reviewContent').hide();
		$(this).addClass('title-name-hover');
		$('#reviewTop').removeClass('title-name-hover')
	})
	$('#reviewTop').mouseover(function(){
		$('#clickContent').hide();
		$('#reviewContent').show();
		$(this).addClass('title-name-hover');
		$('#clickTop').removeClass('title-name-hover')
	})
	//点击量排行特效
	$('.top-num:eq(0)').addClass('num1');
	$('.top-num:eq(1)').addClass('num2');
	$('.top-num:eq(2)').addClass('num3');
	$('.top-num:eq(10)').addClass('num1');
	$('.top-num:eq(11)').addClass('num2');
	$('.top-num:eq(12)').addClass('num3');
	//24小时排行榜特效
	$('.list-hot>li:eq(0)').addClass('hot');
	$('.list-hot>li:eq(1)').addClass('hot');
	$('.list-hot>li:eq(2)').addClass('hot');
	
	//图片的手动轮播
	$('#focus-num>li').mouseover(function(){  
		var index = $(this).index();
		showPics(index);
	});
	$("#focus-num>li").eq(0).addClass('current');
	//普通切换
	function showPics(index) {				
		$("#focus-image>li").eq(index).fadeIn(400).siblings().fadeOut(200);
		$("#focus-text>li").eq(index).fadeIn(400).siblings().fadeOut(200);
		$("#focus-num>li").eq(index).addClass('current').siblings().removeClass('current');
	}	
	//图片的自动轮播
	var len = $('#focus-image>li').size();
	var index = 0;
	$('#focus-image').hover(
			function(){
				window.clearInterval(picTimer);
			},
			function(){
				picTimer = window.setInterval(function(){
					showPics(index);
					index++;
					if(index==len){
						index = 0;
					}
				},2000);
			}
		).trigger('mouseout');
})
