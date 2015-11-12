
/**							
 * 20150610 add by dudanfeng 1  手机验证码验证 旧手机号码	
 **/
/******************** 1 ********************/ 
function SetPhoneCodeF(val, url_1){
	var phone = document.getElementById('RePhone').value;
	var cookie_phone = getCookie('old_code_phone');//获取cookie
	
	if(cookie_phone == phone){
		SetTime(val,10);
		return false;
	}else{
		SetTime(val,60);
		
		$.ajax( {
			"type" : "post" ,  
			"url"  : url_1+"/myweb/person/phonerecode",
			"dataType" : "json",
			"data" : {
				phone : phone,
			},
			"success" : function ( data ){
				if(data == 1){
					setCookie('old_code_phone', phone, 60);//设置cookie
				}else if(data == 0){
					document.getElementById('SetPhoneCode').value = "验证码发送失败";
				}
			}
		});
	}
}
/******************** 1 ********************/ 


/**							
 * 20150626 add by dudanfeng 1  手机验证码验证
 **/
/******************** 1 ********************/ 
function SetPhoF(){
	document.getElementById('SetPhoneCodeText').style.display = "none";
}
/******************** 1 ********************/ 


/**							
 * 20150610 add by dudanfeng 1  手机验证码验证		
 **/
/******************** 1 ********************/ 
function SetPhoC(code, url_1){
	
	$.ajax( {
		"type" : "post" ,  
		"url"  : url_1+"/myweb/person/verecode",
		"dataType" : "json",
		"data" : {
			code : code,
		},
		"success" : function ( data ){
			if(data == 0){
				document.getElementById('SetPhoneCodeText').style.display = "block";
			}else{
				document.getElementById('SetPhoneCodeText').style.display = "none";
			}
		}
	});
}
/******************** 1 ********************/ 


/**							
 * 20150610 add by dudanfeng 1  手机修改提交 新手机验证			
 **/
/******************** 1 ********************/ 
function CheckSetPhoneBtnOne(url_1){
	var code = document.getElementById('CodeOne').value;
	
	$.ajax( {
		"type" : "post" ,  
		"url"  : url_1+"/myweb/person/verecode",
		"dataType" : "json",
		"data" : {
			code : code,
		},
		"success" : function ( data ){
			if(data == 0){
				document.getElementById('SetPhoneCodeText').style.display = "block";
			}else{
				document.getElementById('PhoneForm').style.display = 'none';
				document.getElementById('PhoneForm1').style.display = 'block';
			}
		}
	});
}
/******************** 1 ********************/


/**							
 * 20150610 add by dudanfeng 1  手机修改 新手机验证	
 **/
/******************** 1 ********************/ 
function NePhoneC(){
	document.getElementById('RePhoneText').style.display = 'none';
}
/******************** 1 ********************/ 


/**							
 * 20150626 add by dudanfeng 1  手机验证码验证		
 **/
/******************** 1 ********************/ 
function SetPhoCNewC(){
	document.getElementById('SetPhoneCode1Text').style.display = "none";
}
/******************** 1 ********************/ 


/**							
 * 20150610 add by dudanfeng 1  手机验证码验证 新手机验证	
 **/
/******************** 1 ********************/ 
function SetPhoneCodeR(val, url_1){
	var phone = document.getElementById('NePhone').value;
	
	var aa = isPhone(phone);
	var cookie_phone = getCookie('news_code_phone');//获取cookie
	
	if(aa == false){
		document.getElementById('RePhoneText').style.display = 'block';
	}else if(cookie_phone == phone){
		SetTime(val,10);
		return false;
	}else{
		SetTime(val,60);
		
		$.ajax( {
			"type" : "post" ,  
			"url"  : url_1+"/myweb/person/phonecodenew",
			"dataType" : "json",
			"data" : {
				phone : phone,
			},
			"success" : function ( data ){
				if(data == 1){
					setCookie('news_code_phone', phone, 60);//设置cookie
				}else if(data == 0){
					document.getElementById('SetPhoneCode1').value = "验证码发送失败";
				}else if(data == 2){
					dialogCue("此手机号已被注册");
				}
			}
		});
	}
};
/******************** 1 ********************/ 



/**							
 * 20150610 add by dudanfeng 1  手机验证码验证 新手机验证			
 **/
/******************** 1 ********************/ 
function SetPhoCNew(code, url_1){
	
	$.ajax( {
		"type" : "post" ,  
		"url"  : url_1+"/myweb/person/verecodenew",
		"dataType" : "json",
		"data" : {
			code : code,
		},
		"success" : function ( data ){
			if(data == 0){
				document.getElementById('SetPhoneCode1Text').style.display = "block";
			}else{
				document.getElementById('SetPhoneCode1Text').style.display = "none";
			}
		}
	});
}
/******************** 1 ********************/ 


/**							
 * 20150610 add by dudanfeng 1  手机修改提交 新手机验证			
 **/
/******************** 1 ********************/ 
function CheckSetPhoneBtn(url_1){
	var code2 = document.getElementById('CodeTwo').value;
	var phone = document.getElementById('NePhone').value;
	
	if(code2 == ''){
		document.getElementById('SetPhoneCode1Text').style.display = 'block';
		return false;
	}else{
		$.ajax( {
			"type" : "post" ,  
			"url"  : url_1+"/myweb/person/phonesubmit",
			"data" : {
				phone : phone,
				code : code2,
			},
			"success" : function ( data ){
				if(data == 1){
					dialogCue('修改成功');
					location.reload();
				}else if(data == 2){
					dialogCue('此手机号已被注册');
				}else{
					dialogCue('操作有误');
				}
			}
		});
	}	
}
/******************** 1 ********************/ 