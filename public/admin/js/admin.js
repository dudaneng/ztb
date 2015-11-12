//admin.js
var code ; // 全局变量 登录模块 定义验证码    
var url = document.location.host+'/shiping';

window.onload =function() {

/**							
 * 20150626 add by dudanfeng 1 全选的实现
 **/
/******************** 1 ********************/ 
$(".check-all").click(function(){
	$(".ids").prop("checked", this.checked);
});
$(".ids").click(function(){
	var option = $(".ids");
	option.each(function(i){
		if(!this.checked){
			$(".check-all").prop("checked", false);
			return false;
		}else{
			$(".check-all").prop("checked", true);
		}
	});
});
/******************** 1 ********************/ 


/**							
 * 2015-04-28 add by dudanfeng 1 ajax get请求		
 **/
/******************** 1 ********************/ 
$('.ajax-get').click(function(){
	var target;
	var that = this;
	if ( $(this).hasClass('confirm') ) {
		if(!confirm('确认要执行该操作吗?')){
			return false;
		}
	}
	if ( (target = $(this).attr('href')) || (target = $(this).attr('url')) ) {
		$.get(target).success(function(data){
			if(data == 1){
				location.reload();
			}else if(data == 2){
				dialogCue('操作成功');
				location.reload();
			}else if(data == 3){
				dialogCue('类型未启用！');
				location.reload();
			}else{
				dialogCue('操作错误');
			}
		});
		 return false;
	}
});
/******************** 1 ********************/ 


/**							
 * 2015-06-20 add by dudanfeng 1 ajax get请求 区域状态改变
 **/
/******************** 1 ********************/ 
$('.ajax-get-status').click(function(){
	var target;
	var that = this;
	if ( $(this).hasClass('confirm') ) {
		if(!confirm('确认要执行该操作吗?')){
			return false;
		}
	}
	if ( (target = $(this).attr('href')) || (target = $(this).attr('url')) ) {
		$.get(target).success(function(data){
			var arr = eval(data);
			
			var type = arr[0].type;
			var id = arr[0].id;
			var status = arr[0].status;
			
			var str = target.indexOf('?')//路径截取
			var url_1 = target.substring(0, str);//路径获取
			
			if(type == 1){
				if(status == 1){
					document.getElementById("StatusUpOne"+id).href = url_1+"?id="+id+"&type=1&status=0";
					document.getElementById("StatusUpOne"+id).innerHTML = "隐藏中";
				}else if(status == 0){
					document.getElementById("StatusUpOne"+id).href = url_1+"?id="+id+"&type=1&status=1";
					document.getElementById("StatusUpOne"+id).innerHTML = "显示中";
				}
			}else if(type == 2){
				if(status == 1){
					document.getElementById("StatusUpTwo"+id).href = url_1+"?id="+id+"&type=2&status=0";
					document.getElementById("StatusUpTwo"+id).innerHTML = "隐藏中";
				}else if(status == 0){
					document.getElementById("StatusUpTwo"+id).href = url_1+"?id="+id+"&type=2&status=1";
					document.getElementById("StatusUpTwo"+id).innerHTML = "显示中";
				}
			}else if(type == 3){
				if(status == 1){
					document.getElementById("StatusUpTh"+id).href = url_1+"?id="+id+"&type=3&status=0";
					document.getElementById("StatusUpTh"+id).innerHTML = "隐藏中";
				}else if(status == 0){
					document.getElementById("StatusUpTh"+id).href = url_1+"?id="+id+"&type=3&status=1";
					document.getElementById("StatusUpTh"+id).innerHTML = "显示中";
				}
			}else{
				dialogCue('操作错误');
			}
			return false;
		});
		return false;
	}
});
/******************** 1 ********************/ 

/**							
 * 2015-06-03 add by dudanfeng 1 ajax get请求		
 **/
/******************** 1 ********************/ 
$('.ajax-form').click(function(){
	
	if ( $(this).hasClass('confirm') ) {
		if(!confirm('确认要执行该操作吗?')){
			return false;
		}
	}
	
	var self = $(this);
	$.get(self.attr("href"), self.serialize(), success, "json");
	return false;
	
	function success(data) {
		var arr = eval(data);
		
		var type = arr.type;
		var big = arr.big;
		var middle = arr.middle;
		
		dialogForm(big,middle,type);
	}
	
});
/******************** 1 ********************/ 


/**							
 * 2015-04-28 add by dudanfeng 1 ajax post请求	
 **/
/******************** 1 ********************/ 
$('.ajax-post').click(function(){
	var target;
	var that = this;
	if ( $(this).hasClass('confirm') ) {
		if(!confirm('确认要执行该操作吗?')){
			return false;
			location.reload();
		}
	}
	
	if ( (target = $(this).attr('href')) || (target = $(this).attr('url')) ) {
		$.post(target).success(function(data){
			if(data == 1){
				location.reload();
			}else if(data == 2){
				alert('操作成功');
				location.reload();
			}else{
				dialogCue('操作错误');
			}
		});
		 return false;
	}
});
/******************** 1 ********************/ 


/**							
 * 2015-04-28 add by dudanfeng 1 表单提交
 **/
/******************** 1 ********************/ 
$("form").submit(function() {
	
	var self = $(this);
	$.post(self.attr("action"), self.serialize(), success, "json");
	return false;
	
	function success(data) {
		var arr = eval(data);
		var a = arr.msg;
		var time = arr.time;
		var b = arr.action;
		var type = arr.type;
		
		if(arr.data == 1){
			if(arr.cue == 1){
				dialogShow(a, b);
			}else if(arr.cue == 0){
				dialogCue(a);
				location.reload();
			}else if(arr.cue == 3){
				dialogCue(a);
				
				if(type == 1){
					document.getElementById('Old_User_Pass').value = '';
					document.getElementById('News_User_Pass1').value = '';
					document.getElementById('News_User_Pass2').value = '';
				}
			}
		}else if(arr.data == -1){
			dialogCue(a);
		}else if(arr.date == -2){
			document.getElementById('select').submit();
		}
	}
});
/******************** 1 ********************/ 
}	


/**							
 * 2015-04-28 add by dudanfeng 1 改变排列顺序
 **/
/******************** 1 ********************/ 
function sortEdit(id, url){
	var x = document.getElementById('sort'+id).value;
	var y = document.getElementById('hidsort'+id).value;
	
	if(x != null && x != y){
		$.ajax( {
		"type" : "get" ,  
		"url"  : url,	  	
		"data" : {
			id  : id,
			sort: x,
		},
		"success" : function ( data ) {	
			if(data == 1){
				document.getElementById('hidsort'+id).value=x;
			}else{
				alert("操作有误！");
				location.reload();
			}
		} 
		});
	}else{
	}
}
/******************** 1 ********************/ 


/**							
 * 2015-06-18 add by dudanfeng 1 快速修改标题
 **/
/******************** 1 ********************/ 
function NameEdit(name, id, url){
	var y = document.getElementById('hidTitle'+id).value;
	
	if(name != '' && name != y){
		$.ajax( {
		"type" : "post" ,
		"url"  : url,	  	
		"data" : {
			id  : id,
			name: name,
		},
		"success" : function ( data ) {	
			if(data == 1){
				document.getElementById('hidTitle'+id).value=name;
			}else{
				alert("操作有误！");
				location.reload();
			}
		} 
		});
	}else{
		document.getElementById('Title'+id).value=y;
	}
}
/******************** 1 ********************/ 


/**							
 * 2015-04-13 add by xiaozhu 1 产生验证码								 
 **/							
/****************************** 1 ******************************/
function createCode(){
     code = "";   
     var codeLength = 4;//验证码的长度  
     var checkCode = document.getElementById("code");
     var random = new Array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R',  
     'S','T','U','V','W','X','Y','Z');//随机数  
     for(var i = 0; i < codeLength; i++) {//循环操作  
        var index = Math.floor(Math.random()*36);//取得随机数的索引（0~35）  
        code += random[index];//根据索引取得随机数加到code上  
    }  
    checkCode.value = code;//把code值赋给验证码  
}
/******************** 1 ********************/


/**							
 * 2015-04-13 add by xiaozhu 1  普通弹窗		
 **/
/******************** 1 ********************/ 
function dialogShow(con, a){
	var d = dialog({
			title: '提示信息：',
			content: con,
			okValue: '继续操作',
			ok: function () {
				location.reload();
			},
			cancelValue: '回列表页',
			cancel: function () {
				window.location.href = a; 
			},
			zIndex:999,
			left:80,
			top:10,
			   
	});
	d.show(this);	
}
/******************** 1 ********************/


/**							
 * 2015-04-28 add by dudanfeng 1  提示窗口		
 **/
/******************** 1 ********************/ 
function dialogCue(con){
	art.dialog({
			title: '温馨提示：',
			content: con,
			zIndex:999,
			height:100,
			time:1000,
	});
}
/******************** 1 ********************/


/**							
 * 2015-06-26 add by dudanfeng 1  提示窗口1		
 **/
/******************** 1 ********************/ 
function dialogCue1(con){
	var d = dialog({
			title: '温馨提示：',
			content: con,
			time:1000,
	});
	d.show(this);	
}
/******************** 1 ********************/



/**
 * 2015-04-13 add by xiaozhu 1 验证弹窗
 * @param String element 控件
 * @param String con 消息内容
 **/
/******************** 1 ********************/ 
function dialogValidateShow(element,con){
	var d = dialog({
			quickClose: true,
			content: con,
			follow: element[0],
			onclose: function () {
				element[0].onblur();
			},
		});
	d.show();
}
/******************** 1 ********************/


/**
 * 20150618 add by ddf 1 自由弹窗 1
 * @param String element 控件
 * @param String con 消息内容
 **/
/******************** 1 ********************/ 
function dialogValidateShow1(element,con){
	var d = dialog({
			quickClose: true,
			content: "<ul><li>地址："+con.address+"</li><li>营业时间："+con.shop_time+"</li><li>联系方式:"+con.contact+"</li></ul>",
			follow: element[0],
			okValue: '修改',
			ok: function () {
				window.location.href = "updaterest?id="+con.id; 
			},
			cancelValue: '关闭',
			cancel: function () {
			},
		});
	d.show();
}
/******************** 1 ********************/


/**
 * 20150618 add by ddf 1 自由弹窗 2
 * @param String element 控件
 * @param String con 消息内容
 **/
/******************** 1 ********************/ 
function dialogValidateShow2(element){
	var d = dialog({
			quickClose: true,
			content:'无',
			follow: element[0],
			okValue: '添加',
			ok: function () {
				window.location.href = "addrest"; 
			},
			cancelValue: '关闭',
			cancel: function () {
			},
		});
	d.show();
}
/******************** 1 ********************/


/**							
 * 20150603 add by dudanfeng 1  表单弹窗		
 **/
/******************** 1 ********************/ 
function dialogForm(big,middle,type){
	art.dialog({
			title: '区域添加',
			content: '<form action="add?type='+type+'" method="post"><input type="text" name="area_name"><input type="hidden" name="area_big" value="'+big+'"><input type="hidden" name="area_middle" value="'+middle+'"><input type="submit" value="提交"></form>',
	});
}
/******************** 1 ********************/


/**							
 * 20150603 add by dudanfeng 1  表单弹窗		
 **/
/******************** 1 ********************/ 
function AddArea(big,middle,type){
	
	dialogForm(big,middle,type);
	
}
/******************** 1 ********************/
  

/**							
 * 2015-04-13 add by xiaozhu 1 校验验证码
 * 2015-04-24 add by dudanfeng 2 弹窗效果						 
 **/	
/******************** 1 ********************/						
function validate(){  
    var inputCode = $("#passcode").val().toUpperCase(); //取得输入的验证码并转化为大写  	
    if(inputCode != code || inputCode == '' ) { //若输入的验证码与产生的验证码不一致时  
		dialogValidateShow($("#passcode"),'验证码错误');		
        createCode(); //刷新验证码  
		$("#passcode").val("");
		return false; 
    }         
    else { //验证码输入正确时  
        /******************** 2 ********************/
		$("form").submit(function(){
			var self = $(this);
			$.post(self.attr("action1"), self.serialize(), success, "json");
			return false;
			
			function success(data) {
				if(data == 1){
					document.getElementById('test').submit();
				}else{
					dialogValidateShow($("#AdminUserId"),'用户名或密码错误！');		
					createCode(); //刷新验证码  
				}
			}
		});
		/******************** 2 ********************/
	}
}
/******************** 1 ********************/


/**							
 * 2015-05-28 add by dudanfeng 1 改变区域名称
 **/
/******************** 1 ********************/ 
function areaBig(id, url, a){
	if(a == 1){
		var x = document.getElementById('area_big'+id).value;
		var y = document.getElementById('big_hid'+id).value;
	}else if(a == 2){
		var x = document.getElementById('area_middle'+id).value;
		var y = document.getElementById('mid_hid'+id).value;
	}else if(a == 3){
		var x = document.getElementById('area_small'+id).value;
		var y = document.getElementById('smal_hid'+id).value;
	}
	
	if(x != y && x != ''){
		
		$.ajax( {
		"type" : "get" ,  
		"url"  : url,	  	
		"data" : {
			id  : id,
			name: x,
			type: a,
		},
		"success" : function ( data ) {	
			if(data == 1){
				if(a == 1){
					document.getElementById('big_hid'+id).value=x;
				}else if(a == 2){
					document.getElementById('mid_hid'+id).value=x;
				}else if(a == 3){
					document.getElementById('smal_hid'+id).value=x;
				}
			}else{
				alert("操作有误！");
				location.reload();
			}
		} 
		});
		
	}else if(x == ''){
		alert('区域名不能为空！');
	}else{
	}	
}
/******************** 1 ********************/ 


/**							
 * 2015-05-28 add by dudanfeng 1 改变区域排名
 **/
/******************** 1 ********************/ 
function sortBig(id, url, a){
	if(a == 1){
		var x = document.getElementById('sort_big'+id).value;
		var y = document.getElementById('big_sort_hid'+id).value;
	}else if(a == 2){
		var x = document.getElementById('sort_mid'+id).value;
		var y = document.getElementById('mid_sort_hid'+id).value;
	}else if(a == 3){
		var x = document.getElementById('sort_smal'+id).value;
		var y = document.getElementById('saml_sort_hid'+id).value;
	}
	
	if(x != y && x != ''){
		
		$.ajax( {
		"type" : "get" ,  
		"url"  : url,	  	
		"data" : {
			id  : id,
			sort: x,
			type: a,
		},
		"success" : function ( data ) {	
			if(data == 1){
				if(a == 1){
					document.getElementById('big_sort_hid'+id).value=x;
					location.reload();
				}else if(a == 2){
					document.getElementById('mid_sort_hid'+id).value=x;
					location.reload();
				}else if(a == 3){
					document.getElementById('saml_sort_hid'+id).value=x;
					location.reload();
				}
			}else{
				alert("操作有误！");
				location.reload();
			}
		} 
		});
		
	}else{
	}	
}
/******************** 1 ********************/ 


/**							
 * 2015-05-28 add by dudanfeng 1  区域选择		
 **/
/******************** 1 ********************/ 
function set_location(id,url){
	
	$.ajax({
		type : "post",
		url : url,
		async : false,
		data : {
			id : id
		},
		
		success : function(data){
			var arr = eval(data);
			var obj = document.getElementById('set_city');
			obj.options.length=0;
			obj.options.add(new Option("请选择","0"));
			for(var i=0;i<arr.length;i++){
				obj.options.add(new Option(arr[i]['area_name'],arr[i]['id']));
			}
		}
	});
}
/******************** 1 ********************/


