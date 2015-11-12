<?php 
use yii\helpers\Html;
use components\dy;
?>
<link rel="stylesheet"  type="text/css" href="<?php echo dy::getWebUrl();?>/public/admin/css/area.css">
<div  class="admin">
<form method="post" id="AddAreaBig1" action="<?php echo dy::getWebUrl();?>/admin/area/add?type=1">
	<input style="float:left; width:200px;" type="text" class="input" name="area_name" placeholder="添加大区域" />
	<input style="float:left;" type="button" class="button  bg-main" onclick="AddAreaBig()" value="添加">
</form>
<table>
	<?php foreach($row as $k => $v):?>
	<tr>
    	<td width="20%">
        	<div class="area">
            <form>
            	<ul>
                    <li>
						<input class="areaName" id="area_big<?=$v['id']?>" onblur="areaBig(<?=$v['id']?>, 'bigedit', 1)" type="text" value="<?=$v['area_name']?>"/>
						<input type="hidden" id="big_hid<?=$v['id']?>" value="<?=$v['area_name'];?>">
					</li>
                    <li>
						<input type="text" class="input" id="sort_big<?=$v['id']?>" onblur="sortBig(<?=$v['id']?>, 'sortedit', 1)" value="<?=$v['sort'];?>">
						<input type="hidden" id="big_sort_hid<?=$v['id']?>" value="<?=$v['sort'];?>">
						
						<?php if($v['status'] == 1){?>
						<a id="StatusUpOne<?=$v['id']?>" href="<?php echo dy::getWebUrl();?>/admin/area/statusup?id=<?=$v['id']?>&type=1&status=1" class="ajax-get-status">显示中</a>
						<?php }else{?>
						<a id="StatusUpOne<?=$v['id']?>" href="<?php echo dy::getWebUrl();?>/admin/area/statusup?id=<?=$v['id']?>&type=1&status=0" class="ajax-get-status">隐藏中</a>
						<?php }?>
					</li>
                    <li>
						<a href="javascript:" onclick="return AddArea(<?=$v['id']?>, '', 2)">添加</a>
						<a href="<?php echo dy::getWebUrl();?>/admin/area/deleteup?id=<?=$v['id']?>&type=1" class="ajax-get confirm">删除</a>
					</li>
                </ul>
            </form>
            </div>
        </td>
    	<td width="80%">
        	<div class="areaInfo">
            <form>
            	<ul>
                	<?php if(isset($v['middle'])){?>
					<?php foreach($v['middle'] as $ke => $vo){?>
					<li>
                    	<div class="areaNext">
                            <input type="text" class="areaName" id="area_middle<?=$vo['id']?>" onblur="areaBig(<?=$vo['id']?>, 'bigedit', 2)" value="<?=$vo['area_name'];?>">
							<input type="hidden" id="mid_hid<?=$vo['id']?>" value="<?=$vo['area_name'];?>">
							<p>
							<input type="text" class="input" id="sort_mid<?=$vo['id']?>" onblur="sortBig(<?=$vo['id']?>, 'sortedit', 2)" value="<?=$vo['sort'];?>">
							<input type="hidden" id="mid_sort_hid<?=$vo['id']?>" value="<?=$vo['sort'];?>">
							<span>	
							<?php if($vo['status'] == 1){?>
								<a id="StatusUpTwo<?=$vo['id']?>" href="<?php echo dy::getWebUrl();?>/admin/area/statusup?id=<?=$vo['id']?>&type=2&status=1" class="ajax-get-status">显示中</a>
							<?php }else{?>
								<a id="StatusUpTwo<?=$vo['id']?>" href="<?php echo dy::getWebUrl();?>/admin/area/statusup?id=<?=$vo['id']?>&type=2&status=0" class="ajax-get-status">隐藏中</a>
							<?php }?>
							</span>
							</p>
							<b>
								<a href="javascript:" onclick="return AddArea(<?=$v['id']?>, <?=$vo['id']?>, 3)">添加</a>
								<a href="<?php echo dy::getWebUrl();?>/admin/area/deleteup?id=<?=$vo['id']?>&type=2" class="ajax-get confirm">删除</a>
							</b>	
						</div>
                        
                        <ul>
                        	<?php if(isset($vo['small'])){?>
							<?php foreach($vo['small'] as $vol){?>
							<li>
                                <input type="text" class="areaName" id="area_small<?=$vol['id']?>" onblur="areaBig(<?=$vol['id']?>, 'bigedit', 3)" value="<?=$vol['area_name'];?>">
								<input type="hidden" id="smal_hid<?=$vol['id']?>" value="<?=$vol['area_name'];?>">
								<p>
								<input type="text" class="input" id="sort_smal<?=$vol['id']?>" onblur="sortBig(<?=$vol['id']?>, 'sortedit', 3)" value="<?=$vol['sort'];?>">
								<input type="hidden" id="saml_sort_hid<?=$vol['id']?>" value="<?=$vol['sort'];?>">
								<span>
								<?php if($vol['status'] == 1){?>
								<a id="StatusUpTh<?=$vol['id']?>" href="<?php echo dy::getWebUrl();?>/admin/area/statusup?id=<?=$vol['id']?>&type=3&status=1" class="ajax-get-status">显示中</a>
								<?php }else{?>
								<a id="StatusUpTh<?=$vol['id']?>" href="<?php echo dy::getWebUrl();?>/admin/area/statusup?id=<?=$vol['id']?>&type=3&status=0" class="ajax-get-status">隐藏中</a>
								<?php }?>
								</span>
								</p>
								<b>
									<a href="<?php echo dy::getWebUrl();?>/admin/area/deleteup?id=<?=$vol['id']?>&type=3" class="ajax-get confirm">删除</a>
									<a href="javascript:" onclick="return Restaurant(<?=$vol['id']?>)">查看</a>
								</b>
                            </li>
							<?php }?>
							<?php }?>	
						</ul>
                    </li>
					<?php }?>
					<?php }?>
				</ul>
            </form>
            </div>
        </td>
    </tr>
	<?php endforeach;?>
</table>
</div>
<script>
function Restaurant(id){
	
	$.ajax( {
		"type" : "post" ,  
		"url"  : "quickrestaurant",	  
		"dataType" : "json",		
		"data" : {
			id  : id,
		},
		"success" : function ( data ) {	
			if(data != 0){
				dialogValidateShow1($("#area_small"+id),data[0]);
			}else{
				dialogValidateShow2($("#area_small"+id));
			}
		} 
	});
}

function AddAreaBig(){
	document.getElementById('AddAreaBig1').submit();
}
</script>