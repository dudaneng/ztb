<?php 
use yii\helpers\Html;
use components\dy;
?>
<link rel="stylesheet"  type="text/css" href="<?php echo dy::getWebUrl();?>/public/admin/css/area.css">
<div  class="admin">
<form method="post" action="<?php echo dy::getWebUrl();?>/admin/cabinet/add">
	<input style="float:left; width:200px;" type="text" class="input" name="code" placeholder="添加柜子" />
	<input style="float:left; margin-left:10px;" type="button" class="button   button-small border-green" value="盒子:">
	<input style="float:left;  margin-left:10px; width:50px;" type="text" class="input" name="code1" placeholder="首号" />
	<input style="float:left; margin-left:10px;" type="button" class="button   button-small border-green" value="-->">
	<input style="float:left; margin-left:10px; width:50px;" type="text" class="input" name="code2" placeholder="尾号" />
	<input type="hidden" name="res_id" value="<?=$id?>"/>
	<input style="float:left; margin-left:10px;" type="submit" class="button  bg-main" value="添加">
</form>
<span style="float:left; color:green; margin-left:250px; font-size:20px;" ><?=$res['address']?></span>
<table>
	<?php foreach($row as $k => $vo):?>
	<tr>
    	<td width="80%">
        	<div class="areaInfo">
            <form>
            	<ul>
                	<li>
                    	<div class="areaNext">
                            <input type="text" class="areaName" id="Cabinet<?=$vo['id']?>" onblur="CabinetEdit(<?=$vo['id']?>)" value="<?=$vo['code'];?>">
							<input type="hidden" id="Cabinet_hid<?=$vo['id']?>" value="<?=$vo['code'];?>">
							<p>
								<span>	
								<?php if($vo['status'] == 1){?>
									<a id="StatusUpTwo<?=$vo['id']?>" href="<?php echo dy::getWebUrl();?>/admin/cabinet/statusup?id=<?=$vo['id']?>&type=2&status=1" class="ajax-get-status">显示中</a>
								<?php }else{?>
									<a id="StatusUpTwo<?=$vo['id']?>" href="<?php echo dy::getWebUrl();?>/admin/cabinet/statusup?id=<?=$vo['id']?>&type=2&status=0" class="ajax-get-status">隐藏中</a>
								<?php }?>
								</span>
							</p>
							<b>
								<a href="javascript:" onclick="return AddBox(<?=$vo['id']?>, <?=$id?>)">添加</a>
								<a href="<?php echo dy::getWebUrl();?>/admin/cabinet/deleteup?id=<?=$vo['id']?>&type=2" class="ajax-get confirm">删除</a>
							</b>	
						</div>
                        
                        <ul>
                        	<?php if(isset($vo['box'])){?>
							<?php foreach($vo['box'] as $vol){?>
							<li>
                                <input type="text" class="areaName" id="Box<?=$vol['id']?>" onblur="BoxEdit(<?=$vol['id']?>)" value="<?=$vol['number'];?>">
								<input type="hidden" id="Box_hid<?=$vol['id']?>" value="<?=$vol['number'];?>">
								<p>
									<span>
									<?php if($vol['status'] == 1){?>
									<a id="StatusUpTh<?=$vol['id']?>" href="<?php echo dy::getWebUrl();?>/admin/cabinet/statusup?id=<?=$vol['id']?>&type=3&status=1" class="ajax-get-status">显示中</a>
									<?php }else{?>
									<a id="StatusUpTh<?=$vol['id']?>" href="<?php echo dy::getWebUrl();?>/admin/cabinet/statusup?id=<?=$vol['id']?>&type=3&status=0" class="ajax-get-status">隐藏中</a>
									<?php }?>
									</span>
								</p>
								<b>
									<a href="<?php echo dy::getWebUrl();?>/admin/cabinet/deleteup?id=<?=$vol['id']?>&type=3" class="ajax-get confirm">删除</a>
									<a href="javascript:" style="display:block;" onclick="return CabinetBox(<?=$vol['id']?>)">查看</a>
								</b>
                            </li>
							<?php }?>
							<?php }?>	
						</ul>
                    </li>
				</ul>
            </form>
            </div>
        </td>
    </tr>
	<?php endforeach;?>
</table>
</div>
<script>
/**							
 * 2015-05-28 add by dudanfeng 1 改变
 **/
/******************** 1 ********************/ 
function CabinetBox(id){
	/**
	$.ajax( {
		"type" : "post" ,  
		"url"  : "quickbox",	  
		"dataType" : "json",		
		"data" : {
			id  : id,
		},
		"success" : function ( data ) {	
			if(data != 0){
				dialogValidateShow1($("#Box"+id),data[0]);
			}else{
				dialogValidateShow2($("#Box"+id));
			}
		} 
	});
	**/
	return false;
}
/******************** 1 ********************/ 


/**							
 * 2015-07-02 add by dudanfeng 1 改变柜子名称
 **/
/******************** 1 ********************/ 
function CabinetEdit(id){
	
	var x = document.getElementById('Cabinet'+id).value;
	var y = document.getElementById('Cabinet_hid'+id).value;
	
	
	if(x != y && x != ''){
		
		$.ajax( {
		"type" : "get" ,  
		"url"  : "cedit",	  	
		"data" : {
			id  : id,
			code : x,
		},
		
		"success" : function ( data ) {	
			if(data == 1){
				document.getElementById('Cabinet_hid'+id).value=x;
			}else if(data == 2){
				alert("柜子名已存在！");
				location.reload();
			} else{
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
 * 20150603 add by dudanfeng 1  表单弹窗		
 **/
/******************** 1 ********************/ 
function dialogFormBox(id, res_id){
	art.dialog({
			title: '区域添加',
			content: '<form action="addbox" method="post"><input type="text" name="number"><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="res_id" value="'+res_id+'"><input type="submit" value="提交"></form>',
	});
}
/******************** 1 ********************/


/**							
 * 20150603 add by dudanfeng 1  表单弹窗		
 **/
/******************** 1 ********************/ 
function AddBox(id, res_id){
	
	dialogFormBox(id, res_id);
	
}
/******************** 1 ********************/


/**							
 * 2015-07-03 add by dudanfeng 1 改变箱子名称
 **/
/******************** 1 ********************/ 
function BoxEdit(id){
	
	var x = document.getElementById('Box'+id).value;
	var y = document.getElementById('Box_hid'+id).value;
	
	
	if(x != y && x != ''){
		
		$.ajax( {
		"type" : "get" ,  
		"url"  : "boxedit",	  	
		"data" : {
			id  : id,
			code : x,
		},
		
		"success" : function ( data ) {	
			if(data == 1){
				document.getElementById('Box_hid'+id).value=x;
			}else{
				alert("操作有误！");
				location.reload();
			}
		} 
		});
		
	}else if(x == ''){
		alert('箱子名不能为空！');
	}else{
		
	}	
}
/******************** 1 ********************/ 
 

</script>