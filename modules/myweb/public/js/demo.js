$(function(){
	//底部导航点击tab
	$('.imte').on('click',function(){
		$(this).siblings().children('ul').removeClass('active');
		$(this).children('ul').toggleClass('active')
	})
})