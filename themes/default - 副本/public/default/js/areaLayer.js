/**							
 * 20150604 add by txl 1  弹出隐藏层	
 **/
/******************** 1 ********************/
function ShowDiv(show_div,bg_div){
	document.getElementById(show_div).style.display='block';
	document.getElementById(bg_div).style.display='block' ;
	var bgdiv = document.getElementById(bg_div);
	bgdiv.style.width = document.body.scrollWidth;
	$("#"+bg_div).height($(document).height());
};
/******************** 1 ********************/


/**							
 * 20150604 add by txl 1  关闭弹出层	
 **/
/******************** 1 ********************/
function CloseDiv(show_div,bg_div)
{
	document.getElementById(show_div).style.display='none';
	document.getElementById(bg_div).style.display='none';
	document.getElementById('area1').style.display='none';//隐藏自提点
	document.getElementById('area3').style.display='none';//隐藏自提点
	document.getElementById('area5').style.display='none';//隐藏自提点
};
/******************** 1 ********************/


/**							
 * 20150604 add by dudanfeng 1  中区域选择		
 **/
/******************** 1 ********************/ 
function areabig(id, url, type){
	
	document.getElementById('area3').style.display='none';//隐藏取菜点
	document.getElementById('area5').style.display='none';//隐藏自提点
	
	$.ajax( {
		"type" : "post" ,  
		"url"  : url,
		"dataType" : "json",
		"data" : {
			id  : id,
			type: type,
		},
		"success" : function ( data ){	
			if(data != ''){
				var str = '';
				str += '<h4>所在商圈：</h4>';
				str += '<ul>';
				for(var i=0; i<data.length; i++){
					str += '<li><a onclick="areamiddle('+data[i].id+','+2+')" id="middle'+data[i].id+'" href="javascript:;">'+data[i].area_name+'</a></li>';
				}
				str += '</ul>';
				
				var divBox = document.getElementById("area1"); 
				divBox.innerHTML = str;
				document.getElementById('area1').style.display='block';
				
				var tags = $('#areaWuhou ul li a');
				for (var i = 0; i < tags.length; i++) {
					tags[i].removeAttribute('style');
				}//清除行间样式
				document.getElementById('big'+id).style.color='#0aa39a';//添加行间样式
			}else{
				var str = '';
				str += '<h4>所在商圈：</h4>';
				str += '<ul>';
				str += '<li><a href="javascript:">无</a></li>';
				str += '</ul>';
				var divBox = document.getElementById("area1"); 
				divBox.innerHTML = str;
				document.getElementById('area1').style.display='block';
				
				var tags = $('#areaWuhou ul li a');
				for (var i = 0; i < tags.length; i++) {
					tags[i].removeAttribute('style');
				}//清除行间样式
				document.getElementById('big'+id).style.color='#0aa39a';//添加行间样式			
			}
		}
	});
	
}
/******************** 1 ********************/ 


/**							
 * 20150604 add by dudanfeng 1  小区域选择		
 **/
/******************** 1 ********************/ 
function areamiddle(id,type){
	var url = document.getElementById('TypeUrl').value;
	
	document.getElementById('area5').style.display='none';//隐藏自提点
	
	$.ajax( {
		"type" : "post" ,  
		"url"  : url,
		"dataType" : "json",
		"data" : {
			id  : id,
			type: type,
		},
		"success" : function ( data ){	
			if(data != ''){
				var str = '';
				str += '<h4>取菜点：</h4>';
				str += '<ul>';
				for(var i=0; i<data.length; i++){
					str += '<li><a onmouseover="areasmall('+data[i].id+','+3+')" onclick="areacheck('+data[i].id+','+4+')" id="small'+data[i].id+'" href="javascript:;">'+data[i].area_name+'</a></li>';
				}
				str += '</ul>';
				
				var divBox = document.getElementById("area3"); 
				divBox.innerHTML = str;
				document.getElementById('area3').style.display='block';
				
				var tags = $('#area1 ul li a');
				for (var i = 0; i < tags.length; i++) {
					tags[i].removeAttribute('style');
				}//清除行间样式
				document.getElementById('middle'+id).style.color='#0aa39a';//添加行间样式
			}else{
				var str = '';
				str += '<h4>取菜点：</h4>';
				str += '<ul>';
				str += '</li><a href="javascript:">无</a></li>';
				str += '</ul>';
				var divBox = document.getElementById("area3"); 
				divBox.innerHTML = str;
				document.getElementById('area3').style.display='block';
				
				var tags = $('#area1 ul li a');
				for (var i = 0; i < tags.length; i++) {
					tags[i].removeAttribute('style');
				}//清除行间样式
				document.getElementById('middle'+id).style.color='#0aa39a';//添加行间样式
			}
		}
	});
}
/******************** 1 ********************/ 


/**							
 * 20150604 add by dudanfeng 1  商店数据		
 **/
/******************** 1 ********************/ 
function areasmall(id,type){
	var url = document.getElementById('TypeUrl').value;
	
	$.ajax( {
		"type" : "post" ,  
		"url"  : url,
		"dataType" : "json",
		"data" : {
			id  : id,
			type: type,
		},
		"success" : function ( data ){	
			if(data != ''){
				var str = '';
				str += '<ul>';
				for(var i=0; i<data.length; i++){
					str += '<li>地址：'+data[i].address+'</li>'
					str += '<li>营业时间：'+data[i].shop_time+'</li>'
					str += '<li>联系电话：'+data[i].contact+'</li>'
				}
				str += '</ul>';
				
				var divBox = document.getElementById("area5"); 
				divBox.innerHTML = str;
				document.getElementById('area5').style.display='block';
				
				var tags = $('#area3 ul li a');
				for (var i = 0; i < tags.length; i++) {
					tags[i].removeAttribute('style');
				}//清除行间样式
				document.getElementById('small'+id).style.color='#0aa39a';//添加行间样式
			}else{
				var str = '';
				for(var i=0; i<data.length; i++){
					str += '<ul>';
					str += '</li><a href="javascript:">无</a></li>';
				}
				str += '</ul>';
				
				var divBox = document.getElementById("area5"); 
				divBox.innerHTML = str;
				document.getElementById('area5').style.display='block';
				
				var tags = $('#area3 ul li a');
				for (var i = 0; i < tags.length; i++) {
					tags[i].removeAttribute('style');
				}//清除行间样式
				document.getElementById('small'+id).style.color='#0aa39a';//添加行间样式
			}
		}
	});
}
/******************** 1 ********************/


/**							
 * 20150605 add by dudanfeng 1  地点确认		
 **/
/******************** 1 ********************/ 
function areacheck(id, type){
	var url = document.getElementById('TypeUrl').value;
	var name = document.getElementById('small'+id).innerHTML;
	
	$.ajax( {
		"type" : "post" ,  
		"url"  : url,
		"dataType" : "json",
		"data" : {
			id  : id,
			name : name,
			type: type,
		},
		"success" : function ( data ){
			var divBox = document.getElementById("areaButton"); 
				divBox.value = data[0].area_name;
			
			document.getElementById('area1').style.display='none';//隐藏自提点
			document.getElementById('area3').style.display='none';//隐藏自提点
			document.getElementById('area5').style.display='none';//隐藏自提点
			
			document.getElementById("Close").onclick();
			
			document.getElementById("OrderCheckArea").onclick();
		}
	});
}