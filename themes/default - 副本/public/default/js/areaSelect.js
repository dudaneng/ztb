$(document).ready(function(){
	$("#areaWuhou").click(function(){
		$("#area1 ul li").show(300);
		$(this).removeClass("on");
		$(this).siblings("li")..addClass("on");
	})
	
	$("#area2").click(function(){
		$("#area3").show(300);
		$(this).css("color","#0aa39a");
	})

	$("#area4").hover(function(){
		$("#area5").show(300);
		$(this).css("color","#0aa39a");
	})

	$("#area4").click(function(){
		$("#areaButton").val("祥和苑"); 
	})

});
