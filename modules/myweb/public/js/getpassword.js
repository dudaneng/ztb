
/**							
 * 20150610 add by dudanfeng 1 用户中心 修改密码 密码验证		
 **/
/******************** 1 ********************/
function UnsetPasswordO(){
	document.getElementById('UnsetPasswordText').style.display = 'none';
}
/******************** 1 ********************/


/**							
 * 20150610 add by dudanfeng 1 用户中心 修改密码 密码验证		
 **/
/******************** 1 ********************/
function UnsetPassword1O(){
	document.getElementById('PasswordText').style.display = 'none';
}
/******************** 1 ********************/


/**							
 * 20150610 add by dudanfeng 1 用户中心 修改密码 密码验证		
 **/
/******************** 1 ********************/	
function UnPasswordSub(url_1){
	var re_password = document.getElementById('UnsetPassword').value; //原密码
	var password1 = document.getElementById('UnsetPassword1').value;//新密码
	var password2 = document.getElementById('UnsetPassword2').value;//新密码
	
	if(re_password == ''){
		document.getElementById('UnsetPasswordText').style.display = 'block';
		return false;
	}else if(password1 != password2 || password1 == ''){
		document.getElementById('PasswordText').style.display = 'block';
		return false;
	}else{
		$.ajax( {
			"type" : "post" ,  
			"url"  : url_1+"/myweb/person/passwordsub",
			"data" : {
				re_password : re_password,
				ne_password : password1,
			},
			"success" : function ( data ){
				if(data == 1){
					dialogCue('修改成功');
					
					document.getElementById('PasswordText').style.display = 'none';
					document.getElementById('UnsetPasswordText').style.display = 'none';
					
					document.getElementById('UnsetPassword').value = '';
					document.getElementById('UnsetPassword1').value = '';
					document.getElementById('UnsetPassword2').value = '';
				}else{
					document.getElementById('UnsetPasswordText').style.display = 'block';
				}
			}
		});
	}	
}
/******************** 1 ********************/