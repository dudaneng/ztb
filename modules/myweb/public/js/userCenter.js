$(document).ready(function() {
	jQuery.jqtab = function(userNavList,userInfo,shijian) {
		$("#userInfo").find("dd").hide();
		$("#userNavList").find("dd:first").addClass("on").show(); 
		$("#userInfo").find("dd:first").show();
	
		$("#userNavList").find("dd").bind(shijian,function(){
		  $(this).addClass("on").siblings("dd").removeClass("on"); 
			var activeindex = $("#userNavList").find("dd").index(this);
			$("#userInfo").children().eq(activeindex).show().siblings().hide();
			return false;
		});
	
	};
	/*调用方法如下：*/
	$.jqtab("#userNavList","#userInfo","click");
});
