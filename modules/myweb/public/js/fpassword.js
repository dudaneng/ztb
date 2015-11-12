
/**							
 * 20150611 add by dudanfeng 1  密码重置 密码重设	
 **/
/******************** 1 ********************/ 
function FgPasswordBtn(url_1){
	var password = document.getElementById('FgPasswordNew').value;
	var password1 = document.getElementById('FgPasswordNew1').value;
	
	if(password != password1){
		document.getElementById('FgPasswordNewText').style.display='block';
	}else if(password == ''){
		document.getElementById('FgPasswordNewText').innerHTML="密码不能为空！";
		document.getElementById('FgPasswordNewText').style.display='block';
	}else{
		$.ajax( {
			"type" : "post" ,  
			"url"  : url_1+"/myweb/login/forgetpasswordbtn",
			"data" : {
				password : password,
			},
			"success" : function ( data ){
				if(data == 1){
					window.location.href=url_1+"/myweb/login/forgetover"
				}else {
					document.getElementById('FgPasswordNewText').innerHTML="操作有误";
					document.getElementById('FgPasswordNewText').style.display='block';
				}
			}
		});
	}
}