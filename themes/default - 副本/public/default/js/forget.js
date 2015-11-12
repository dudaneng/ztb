//找回密码  forget.js

/**							
 * 20150610 add by dudanfeng 1  密码重置 手机验证	
 **/
/******************** 1 ********************/ 
function ForgetPhoneO(){
	document.getElementById('ForgetPhoneText').style.display = 'none';
}
/******************** 1 ********************/ 


/**							
 * 20150610 add by dudanfeng 1  密码重置 手机验证	
 **/
/******************** 1 ********************/ 
function FBCodeOn(){
	document.getElementById('ForgetCodeText').style.display = 'none';
}
/******************** 1 ********************/ 


/**							
 * 20150610 add by dudanfeng 1  密码重置 发送手机验证码
 **/
/******************** 1 ********************/ 
function ForgetPhCode(val,url_1){
	var phone = document.getElementById('ForgetPhone').value;
	var aa = isPhone(phone);
	var cookie_phone = getCookie('phone');
	
	if(aa == false){
		document.getElementById('ForgetPhoneText').style.display = 'block';
		return false;
	}else if(cookie_phone != null){
		SetTime(val,30);//倒计时
		return false;
	}else{
		SetTime(val,60);//倒计时
		
		$.ajax( {
			"type" : "post" ,  
			"url"  : url_1+"/login/sendcodere",
			"dataType" : "json",
			"data" : {
				phone : phone,
			},
			"success" : function ( data ){
				if(data == 1){
					setCookie('phone', phone, 60);//设置cookie
				}else if(data == 0){
					document.getElementById('ForGetPhCo').value = "验证码发送失败";
				}else if(data == 2){
					document.getElementById('ForgetPhoneText').innerHTML = '此手机未注册';
					document.getElementById('ForgetPhoneText').style.display = 'block';
				}
			}
		});
	}
}
/******************** 1 ********************/ 


/**							
 * 20150610 add by dudanfeng 1  手机验证码验证 新手机验证			
 **/
/******************** 1 ********************/ 
function ForGetPCO(code, url_1){
	
	$.ajax( {
		"type" : "post" ,
		"url"  : url_1+"/login/sendcodenaber",
		"dataType" : "json",
		"data" : {
			code : code,
		},
		"success" : function ( data ){
			if(data == 0){
				document.getElementById('ForgetCodeText').style.display = "block";
			}else{
				document.getElementById('ForgetCodeText').style.display = "none";
			}
		}
	});
}
/******************** 1 ********************/ 


/**							
 * 20150610 add by dudanfeng 1  手机验证码验证 新手机验证			
 **/
/******************** 1 ********************/ 
function forgetPhoneBtn(url_1){
	var phone = document.getElementById('ForgetPhone').value;
	var code = document.getElementById('FBCode').value;
	
	if(phone == ''){
		document.getElementById('ForgetPhoneText').style.display = 'block';
		return false;
	}else if(code == ''){
		document.getElementById('ForgetCodeText').style.display = 'block';
		return false;
	}
	$.ajax( {
		"type" : "post" ,  
		"url"  : url_1+"/login/forgetcodebtn",
		"dataType" : "json",
		"data" : {
			phone : phone,
			code : code,
		},
		"success" : function ( data ){
			if(data == 1){
				window.location.href=url_1+"/login/forgetpassword"
			}else if(data == 2){
				document.getElementById('ForgetPhoneText').style.display = "block";
			}else if(data == 0){
				document.getElementById('ForgetCodeText').style.display = "block";
			}
		}
	});
}
/******************** 1 ********************/ 