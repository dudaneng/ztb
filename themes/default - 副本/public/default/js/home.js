//home.js
var code ; // 全局变量 登录模块 定义验证码
var url = document.location.host+'/shiping';

window.onload =function() {
	
/**							
 * 20150610 add by ddf 1 地区初始化								 
 **/
var a = document.getElementById('areaButtonHd').value;
if(a== ''){
	document.getElementById('areaButton').onclick();
}
/******************** 1 ********************/


/**							
 * 20150608 add by dudanfeng 1 全选的实现	
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
				alert('操作错误');
			}
		});
		return false;
	}
	return false;
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
	var target,query,form;
	var target_form = $(this).attr('target-form');
	var that = this;
	var nead_confirm=false;
	if( ($(this).attr('type')=='submit') || (target = $(this).attr('href')) || (target = $(this).attr('url')) ){
		form = $('.'+target_form);

		if ($(this).attr('hide-data') === 'true'){//无数据时也可以使用的功能
			form = $('.hide-data');
			query = form.serialize();
		}else if (form.get(0)==undefined){
			return false;
		}else if ( form.get(0).nodeName=='FORM' ){
			if ( $(this).hasClass('confirm') ) {
				if(!confirm('确认要执行该操作吗?')){
					return false;
				}
			}
			if($(this).attr('url') !== undefined){
				target = $(this).attr('url');
			}else{
				target = form.get(0).action;
			}
			query = form.serialize();
		}else if( form.get(0).nodeName=='INPUT' || form.get(0).nodeName=='SELECT' || form.get(0).nodeName=='TEXTAREA') {
			form.each(function(k,v){
				if(v.type=='checkbox' && v.checked==true){
					nead_confirm = true;
				}
			})
			if ( nead_confirm && $(this).hasClass('confirm') ) {
				if(!confirm('确认要执行该操作吗?')){
					return false;
				}
			}
			query = form.serialize();
		}else{
			if ( $(this).hasClass('confirm') ) {
				if(!confirm('确认要执行该操作吗?')){
					return false;
				}
			}
			query = form.find('input,select,textarea').serialize();
		}
		$(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
		
		$.post(target,query).success(function(data){
			if(data == 1){
				dialogCue("删除成功");
				location.reload();
			}else if(data == 2){
				dialogCue("请选择数据！");
			}else{
				dialogCue("删除失败");
				location.reload();
			}
		});
	}
	return false;
});
/******************** 1 ********************/ 
}	


/**							
 * 20150623 add by dudanfeng 1 按钮 时间倒计时
 **/
/******************** 1 ********************/
function SetTime(val, countdown) {
	if (countdown == -1){
		val.removeAttribute("disabled");    
		val.value="免费获取验证码"; 
	}else{
		val.setAttribute("disabled", true); 
		val.value="重新发送(" + countdown + ")"; 
		countdown--;
	} 
	
	if(countdown != -1){
		setTimeout(function() {
			if(countdown == 0){
				SetTime(val, -1);
			}else{
				SetTime(val, countdown);
			}
		},1000) 
	}
} 
/******************** 1 ********************/


/**							
 * 20150623 add by dudanfeng 1  设置cookie
 **/
/******************** 1 ********************/
function setCookie(name,value,time){ 
    var exp = new Date(); 
    exp.setTime(exp.getTime() + time*1000); 
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString(); 
}
/******************** 1 ********************/


/**							
 * 20150623 add by dudanfeng 1  读取cookie
 **/
/******************** 1 ********************/
function getCookie(name){
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
 
    if(arr=document.cookie.match(reg))
 
        return unescape(arr[2]); 
    else 
        return null; 
} 
/******************** 1 ********************/


/**							
 * 20150610 add by dudanfeng 1  手机号码正则验证
 **/
/******************** 1 ********************/
function isPhone(rst){
	var reg = /^((\(\d{3}\))|(\d{3}\-))?13[0-9]\d{8}?$|15[89]\d{8}?$|170\d{8}?$|147\d{8}?$/; 
	return reg.test(rst);
}
/******************** 1 ********************/


/**							
 * 20150611 add by dudanfeng 1  邮箱正则验证
 **/
/******************** 1 ********************/
function isEmail(str){ 
	var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/; 
	return reg.test(str); 
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
			width: 200,
			zIndex:999,
			height:100,
			time:1000,
	});
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
 * 20150604 add by dudanfeng 1 登陆验证								 
 **/							
/****************************** 1 ******************************/
function userId(data){
	if(data.length != 11){
		document.getElementById('user').innerHTML='手机号格式错误';
		document.getElementById('user').style.display='block';
	}else{
		document.getElementById('user').style.display='none';
	}
}
/****************************** 1 ******************************/


/**							
 * 20150604 add by dudanfeng 1 登陆验证								 
 **/							
/****************************** 1 ******************************/	
function userPassword(data){
	if(data == ''){
		document.getElementById('password').innerHTML='密码不能为空';
		document.getElementById('password').style.display='block';
	}else{
		document.getElementById('password').style.display='none';
	}
}
/****************************** 1 ******************************/


/**							
 * 20150604 add by dudanfeng 1 登陆验证								 
 **/							
/****************************** 1 ******************************/	
function userPasswordF(){
	document.getElementById('password').style.display='none';
}
/****************************** 1 ******************************/


/**							
 * 20150604 add by dudanfeng 1 登陆验证								 
 **/							
/****************************** 1 ******************************/
function userCode(){
	document.getElementById('code1').style.display='none';
}
/****************************** 1 ******************************/


/**							
 * 20150604 add by dudanfeng 1 登陆验证								 
 **/							
/****************************** 1 ******************************/
function userIdFocus(){
	document.getElementById('user').style.display='none';
}
/****************************** 1 ******************************/


/**							
 * 20150604 add by dudanfeng 1 用户登陆
 **/							
/****************************** 1 ******************************/
function loginBtn(url_1){
	var user = document.getElementById('user1').value;
	var password = document.getElementById('password1').value;
	var inputCode = $("#passcode").val().toUpperCase(); //取得输入的验证码并转化为大写  	
	
	if(!$("#checked").attr('checked')){    
		var chec = 0;
	}else{
		var chec = 1;
	}
	document.getElementById('Hchecked').value = chec;
	
	if(inputCode != code || inputCode == '' ){//若输入的验证码与产生的验证码不一致时  
		document.getElementById('code1').style.display = 'block';		
		createCode(); //刷新验证码  
		$("#passcode").val("");
		return false;
	}else if(user == ''){
		document.getElementById('user').innerHTML='手机号不能为空';
		document.getElementById('user').style.display='block';
		return false;
	}else if(password == ''){
		document.getElementById('password').innerHTML='密码不能为空';
		document.getElementById('password').style.display='block';
		return false;
	}else{
		$("form").submit(function() {
			var self = $(this);
			$.post(self.attr("action"), self.serialize(), success, "json");
			return false;
			
			function success(data) {
				if(data == 1){
					location.href = url_1+'/person/index?type=3';
				}else if(data == 0){
					document.getElementById('LoginSub').innerHTML='此账号已被禁用';
					document.getElementById('LoginSub').style.display='block';
					createCode(); //刷新验证码  
				}else{
					document.getElementById('LoginSub').innerHTML='手机号或者密码错误';
					document.getElementById('LoginSub').style.display='block';
					createCode(); //刷新验证码  
				}
			}
		});
	}
}
/****************************** 1 ******************************/

/**							
 * 20150605 add by dudanfeng 1 注册验证	用户名							 
 **/							
/****************************** 1 ******************************/
function UserAccount(){
	document.getElementById('user_account1').style.display='none';
}
/****************************** 1 ******************************/

/**							
 * 20150605 add by dudanfeng 1 注册验证 手机								 
 **/							
/****************************** 1 ******************************/
function UserPhone(){
	document.getElementById('user_phone1').style.display='none';
}
/****************************** 1 ******************************/

/**							
 * 20150605 add by dudanfeng 1 注册验证	密码							 
 **/							
/****************************** 1 ******************************/
function Password(){
	document.getElementById('password1').style.display='none';
}
/****************************** 1 ******************************/

/**							
 * 20150605 add by dudanfeng 1 注册验证	手机短信							 
 **/							
/****************************** 1 ******************************/
function CodePhone(val){
	var phone = document.getElementById('user_phone').value;
	var user_phone = document.getElementById('user_phone').value;
	var cookie_phone = getCookie('code_phone');//获取cookie
	
	if(user_phone.length != 11){
		document.getElementById('user_phone1').innerHTML='手机号格式错误';
		document.getElementById('user_phone1').style.display='block';
		return false;
	}else if(cookie_phone == phone){
		SetTime(val,10);
		return false;
	}else{
		SetTime(val,60); //时间倒计时
		
		$.ajax( {
			"type" : "post" ,
			"url"  : "sendcode",
			"dataType" : "json",
			"data" : {
				phone : phone,
			},
			"success" : function ( data ){
				if(data == 1){
					setCookie('code_phone', phone, 60);//设置cookie
				}else if(data == 0){
					document.getElementById('CodePhone1').value = "验证码发送失败";
				}else if(data == 2){
					document.getElementById('user_phone1').innerHTML='此手机号已被注册';
					document.getElementById('user_phone1').style.display='block';
				}
			}
		});
	}
}
/****************************** 1 ******************************/


/**							
 * 20150605 add by dudanfeng 1 注册验证	手机短信
 **/							
/****************************** 1 ******************************/
function CodePhoneNamber(codephone){
	
	$.ajax( {
		"type" : "post" ,  
		"url"  : "sendcodenaber",
		"data" : {
			code : codephone,
		},
		"success" : function ( data ){
			if(data == 0){
				document.getElementById('CodePhone3').innerHTML = "验证码错误";
				document.getElementById('CodePhone3').style.display = 'block';
			}else if(data == 1) {
				document.getElementById('CodePhone3').style.display = 'none';
			}
		}
	});
}
/****************************** 1 ******************************/


/**							
 * 20150604 add by dudanfeng 1 用户注册
 **/							
/****************************** 1 ******************************/
function registerBtn(){
	var user = document.getElementById('user_account').value;
	var password = document.getElementById('password').value;
	var password1 = document.getElementById('user_password').value;
	var user_phone = document.getElementById('user_phone').value;
	var CodePhone4 = document.getElementById('CodePhone4').value;
	
	var inputCode = $("#passcode").val().toUpperCase(); //取得输入的验证码并转化为大写
	
	if(!$("#checked").attr('checked')){    
		alert('请阅读并同意相关服务条款');
		return false; 	
	}
	if(inputCode != code || inputCode == '' ){ 
		document.getElementById('code1').style.display = 'block';		
		createCode(); //刷新验证码  
		$("#passcode").val("");
		return false;
	}else if(user == ''){
		document.getElementById('user_account1').innerHTML='用户名不能为空';
		document.getElementById('user_account1').style.display='block';
		return false;
	}else if(user_phone.length != 11){
		document.getElementById('user_phone1').innerHTML='手机号格式错误';
		document.getElementById('user_phone1').style.display='block';
		return false;
	}else if(password == ''){
		document.getElementById('password1').innerHTML='密码不能为空';
		document.getElementById('password1').style.display='block';
		return false;
	}else if(password != password1){
		document.getElementById('password1').innerHTML='两次密码不一致';
		document.getElementById('password1').style.display='block';
		return false;
	}else if(CodePhone4 == ''){
		document.getElementById('CodePhone3').innerHTML='手机验证错误';
		document.getElementById('CodePhone3').style.display='block';
		return false;
	}else{
		$("form").submit(function() {
			var self = $(this);
			$.post(self.attr("action"), self.serialize(), success, "json");
			return false;
			
			function success(data) {
				if(data == 1){
					alert('注册成功！');
					document.location.href = 'index';
				}else if(data == 0){
					alert('该手机已被注册');
				}else if(data == 3){
					alert('手机错误');
				}
			}
		});
	}
}
/****************************** 1 ******************************/


/**							
 * 20150605 add by dudanfeng 1  首页  菜单		
 **/
/******************** 1 ********************/ 
function GoodsType(id, url_1, type){
	
	$.ajax( {
		"type" : "post" ,  
		"url"  : url_1+"/default/selectgoods",
		"dataType" : "json",
		"data" : {
			id  : id,
			type : type,
		},
		"success" : function ( data ){	
			if(data != ''){
				var str = '';
				str += '<ul>';
				for(var i=0; i<data.length; i++){
					str += '<li>';
					str += '<a href="'+url_1+'/goods/detail?id='+data[i].id+'"><img src="'+data[i].index_pic+'" width="260" height="284" /></a>';
					str += '<div class="goodsListInfo">';
					str += '<h5><a style="color:#333;" href="'+url_1+'/goods/detail?id='+data[i].id+'">'+data[i].goods_name+'</a></h5>';
					str += '<span>'+data[i].goods_info+'</span>';
					str += '<p>¥'+data[i].price_vip+'</p>';
					str += '<b><a href="javascript:" onclick=\'addToCart('+data[i].id+', "'+url_1+'")\'>加入购物车</a></b>';
					str += '</div>';
					str += '</li>';
				}
				str += '</ul>';
				
				var divBox = document.getElementById("goodsList"); 
				divBox.innerHTML = str;
				
				$("#GoodsTypeList a").removeClass("active"); //清除原始的Class
				if(type == 1){
					document.getElementById("TypeColorRecom").className = "active"; //重新赋值class
				}else{
					document.getElementById("TypeColor"+id).className = "active"; //重新赋值class
				}
			}else{
				var str = '';
				str += '<ul>';
				str += '</ul>';
				var divBox = document.getElementById("goodsList"); 
				divBox.innerHTML = str;
				
				$("#GoodsTypeList a").removeClass("active");//清除原始的Class
				if(type == 1){
					document.getElementById("TypeColorRecom").className = "active"; 
				}else{
					document.getElementById("TypeColor"+id).className = "active"; 
				}
			}
		}
	});	

}
/******************** 1 ********************/ 


/**							
 * 20150605 add by dudanfeng 1  首页 菜品种类搜索	
 **/
/******************** 1 ********************/
function select(url_1){
	var goods_name = document.getElementById('select_name').value;
	
	$.ajax( {
		"type" : "post" ,  
		"url"  : url_1+"/default/select",
		"dataType" : "json",
		"data" : {
			goods_name  : goods_name,
		},
		"success" : function ( data ){
			if(data != ''){
				var str = '';
				str += '<ul>';
				for(var i=0; i<data.length; i++){
					str += '<li>';
					str += '<a href="'+url_1+'/goods/detail?id='+data[i].id+'"><img src="'+data[i].index_pic+'" width="260" height="284" /></a>';
					str += '<div class="goodsListInfo">';
					str += '<h5><a style="color:#333;" href="'+url_1+'/goods/detail?id='+data[i].id+'">'+data[i].goods_name+'</a></h5>';
					str += '<span>'+data[i].goods_info+'</span>';
					str += '<p>¥'+data[i].price_vip+'</p>';
					str += '<b><a href="javascript:" onclick=\'addToCart('+data[i].id+', "'+url_1+'")\'>加入购物车</a></b>';
					str += '</div>';
					str += '</li>';
				}
				str += '</ul>';
				
				var divBox = document.getElementById("goodsList"); 
				divBox.innerHTML = str;
			}else{
				var str = '';
				str += '<ul>';
				str += '</ul>';
				var divBox = document.getElementById("goodsList"); 
				divBox.innerHTML = str;
			}
		}
	});	
}
/******************** 1 ********************/



/**							
 * 20150608 add by dudanfeng 1  购物车添加	
 **/
/******************** 1 ********************/
function addToCart(id, url_1){
	var number = document.getElementById('CartNumbers').innerHTML;
	var aa = parseFloat(number)+1;
	
	$.ajax( {
		"type" : "post",
		"url"  : url_1+"/goods/cartadd",
		"dataType" : "json",
		"data" : {
			id  : id,
		},
		"success" : function ( data ){
			if(data > 0){
				dialogCue("<span style='color:red;'>加入成功!</span>");
				
				document.getElementById('InCatrNumbers').innerHTML = aa;
				document.getElementById('CartNumbers').innerHTML = aa;
			}else if(data == 0){
				window.location.href=url_1+"/login/index";
			}else if(data == -1){
				dialogCue("<span style='color:red;'>已加入!</span>");
			}
		}
	});	
}
/******************** 1 ********************/


/**							
 * 20150608 add by dudanfeng 1  购物车数据提交
 **/
/******************** 1 ********************/
function CheckButton(url_1){
	var time = document.getElementById('SelectTime').value;
	var area = document.getElementById('AreaId').value;
	
	if(area != ''){
		window.location.href=url_1+'/goods/order?time='+time;
	}else{
		alert('该自提点还未启用,切换后请刷新页面！');
		//dialogCue('该自提点还未启用,切换后请刷新页面！');
	}
	
	return false;
}
/******************** 1 ********************/


/**							
 * 20150608 add by dudanfeng 1  购物车商品数量改变	
 **/
/******************** 1 ********************/
function ChangeNumber(id, type){
	var number = document.getElementById('CatrGoodsNum'+id).value;
	var max = document.getElementById('GoodsNUM'+id).value;
	var price1 = document.getElementById('GoodsPrice'+id).innerHTML;
	var allprice = document.getElementById('AllPrice').innerHTML;
	
	if(parseFloat(number) < 2 && type == 1){
		return false;
	}else if(parseFloat(number) >= parseFloat(max) && type == 2){
		dialogCue('超过最大限购数量!');
		location.reload();
		return false;
	}else if(type == 3 && parseFloat(number) < 1 || parseFloat(number) > parseFloat(max) || number == ''){
		dialogCue('数量有误!');
		location.reload();
		return false;
	}else{
		$.ajax( {
			"type" : "post",
			"url"  : "changenumbers",
			"dataType" : "json",
			"data" : {
				id  : id,
				type : type,
				number : number,
				max : max,
				allprice : allprice,
				price1 : price1,
			},
			"success" : function ( data ){
				document.getElementById('CatrGoodsNum'+id).value = data.number;
				document.getElementById('GoodsPrice'+id).innerHTML = data.price;
				document.getElementById('AllPrice').innerHTML = data.all;
			}
		});	
	}
	
	return false;
}
/******************** 1 ********************/


/**							
 * 20150608 add by dudanfeng 1  简介 商品数量改变	
 **/
/******************** 1 ********************/
function ChangeNumberDetail(type){
	var number = document.getElementById('DetailGoods').value;
	var max = document.getElementById('BuyAllNumber').value;
	var numbers = '';
	
	if(parseInt(number) >= 1 && parseInt(number) < parseInt(max)){
		if(type == 1){
			numbers = parseInt(number) - 1;
		}else if(type == 2){
			numbers = parseInt(number) + 1;
		}else if(type == 3){
			numbers = parseInt(number);
		}
	}
	
	if(numbers != ''){
		document.getElementById('DetailGoods').value = parseInt(numbers);
	}else if(numbers >= max){
		document.getElementById('DetailGoods').value = parseInt(max);
	}else{
		document.getElementById('DetailGoods').value = 1;
		dialogCue('超过库存量');
	}
	
	return false;
}
/******************** 1 ********************/


/**							
 * 20150608 add by dudanfeng 1  简介 购物车添加商品	
 **/
/******************** 1 ********************/
function addToCartDetail(url_1, id){
	var number = document.getElementById('DetailGoods').value;
	
	var number1 = document.getElementById('CartNumbers').innerHTML;
	var aa = parseFloat(number1)+1;
	
	
	$.ajax( {
		"type" : "post",
		"url"  : url_1+"/goods/changedetail",
		"dataType" : "json",
		"data" : {
			id  : id,
			number : number,
		},
		"success" : function ( data ){
			if(data == 1){
				dialogCue("加入成功!");
			}else if(data ==2){
				document.getElementById('CartNumbers').innerHTML = aa;
				
				dialogCue("加入成功!");
			}else if(data ==0){
				window.location.href=url_1+"/login/index";
			}
		}
	});	

	return false;
}
/******************** 1 ********************/



/**							
 * 20150609 add by dudanfeng 1  订单 选择地区
 **/
/******************** 1 ********************/
function OrderCheckArea1(url_1){
	window.location.href = url_1+'/goods/order?type=1';
}
/******************** 1 ********************/


/**							
 * 20150609 add by dudanfeng 1  订单 支付
 **/
/******************** 1 ********************/
function OrderPay(){
	var tx = document.getElementById('OrderText').value;
	document.getElementById('Text').value = tx;
	
	document.getElementById('ordersubmit').submit();
	
	return false;
}
/******************** 1 ********************/


/**							
 * 20150613 add by dudanfeng 1  订单 优惠券选择
 **/
/******************** 1 ********************/
function ActivitySelect(id, url_1){
	var price = document.getElementById('OldAllPrice').value;
	
	if(id == -2){
		location.reload();
	}else{
		$.ajax( {
			"type" : "post",
			"url"  : url_1+"/goods/allprice",
			"dataType" : "json",
			"data" : {
				id  : id,
				price : price,
			},
			"success" : function ( data ){
				if(data != price){
					document.getElementById('AllPrice').value = data;
					document.getElementById('OrderPrice').innerHTML = '¥'+data;
				}else{
					alert('金额不足\n或者超过参与次数\n或者请重新登录');
					//dialogCue('超过次数限制');
					location.reload();
				}
			}
		});	
	}
	return false;
}
/******************** 1 ********************/




