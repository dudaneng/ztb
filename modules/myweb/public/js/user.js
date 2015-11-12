//找回密码  user.js

/**							
 * 20150611 add by dudanfeng 1  个人中心 修改邮箱
 **/
/******************** 1 ********************/ 
function ChangEmail(email){
	if(email != ''){
		var aa = isEmail(email);
		if(aa == false){
			document.getElementById('Emial1').style.display = 'block';
		}else{
			document.getElementById('Emial1').style.display = 'none';
		}
	}else{
		document.getElementById('Emial1').style.display = 'none';
	}
}
/******************** 1 ********************/ 


/**							
 * 20150611 add by dudanfeng 1  个人中心 修改用户名
 **/
/******************** 1 ********************/ 
function UseNameC(){
	document.getElementById('UseName1').style.display = 'none';
}
/******************** 1 ********************/ 


/**							
 * 20150611 add by dudanfeng 1  个人中心 提交修改信息
 **/
/******************** 1 ********************/ 
function UserSubmit(url_1){
	var user_name = document.getElementById('UseName').value;
	var email = document.getElementById('Emial').value;
	
	if(user_name == ''){
		document.getElementById('UseName1').style.display = 'block';
		return false;
	}else if(email != '' && isEmail(email) == false){
		document.getElementById('Emial1').style.display = 'block';
		return false;
	}else{
		$.ajax( {
			"type" : "post" ,  
			"url"  : url_1+"/myweb/person/usersubmit",
			"data" : {
				user_name : user_name,
				email : email,
			},
			"success" : function ( data ){
				if(data == 1){
					dialogCue('修改成功');
					location.reload();
				}
			}
		});
	}	
}
/******************** 1 ********************/ 