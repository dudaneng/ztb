<?php 
use yii\helpers\Html;
use components\dy;
?>
<title>快递管理-<?php echo $session = Yii::$app->session->get('setting');?></title>
<link rel="stylesheet"  type="text/css" href="<?php echo dy::getWebUrl();?>/modules/express/public/css/area.css">

<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/modules/express/public/css/pintuer.css">
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/modules/express/public/css/admin.css">
<script src="<?php echo dy::getWebUrl();?>/modules/express/public/js/jquery.js"></script>
<script src="<?php echo dy::getWebUrl();?>/modules/express/public/js/pintuer.js"></script>
<script src="<?php echo dy::getWebUrl();?>/modules/express/public/js/respond.js"></script>
<script src="<?php echo dy::getWebUrl();?>/modules/express/public/js/admin.js"></script>

<link rel="shortcut icon" href="<?php echo dy::getWebUrl();?>/themes/default/public/favicon.ico" />
<link rel="bookmark" href="<?php echo dy::getWebUrl();?>/themes/default/public/favicon.ico" type="image/x-icon"　/>
<!--
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog.css">
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/default.css">
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-min.js"></script>
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/artDialog.min.js"></script>
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-plus-min.js"></script>
-->
<div  class="admin">
<div class="Goodslist">
	<ul>
		<?php foreach ($goods_info as $v){?>
		<li><img src="<?=$v['goods_show']?>"><span><?=$v['goods_name']?></span></li>
		<?php }?>
	</ul>
</div>

<table>
	<?php foreach($row as $k => $vo):?>
	<tr>
    	<td width="80%">
        	<div class="areaInfo">
           <form>
            	<ul>
                	<li>
                    	<div class="areaNext">
                            <input type="text" class="areaName" value="<?=$vo['code'];?>" disabled />
							<p>
								<span>	
								<?php if($vo['status'] == 1){?>
									<a href="javascript:">启用中</a>
								<?php }else{?>
									<a style="color:red; font-size:1.5em; font-weight:700;" href="javascript:">停用中</a>
								<?php }?>
								</span>
							</p>
						</div>
                        
                        <ul>
                        	<?php if(isset($vo['box'])){?>
							<?php foreach($vo['box'] as $vol){?>
							<li>
                                <input type="text" class="areaName" value="<?=$vol['number'];?>" disabled>
								<p>
									<span>
										<?php if($vo['status'] == 1){?>
											<?php if($vol['status'] == 1){?>
											<?php }else{?>
											<a href="javascript:" style="color:red; font-size:1.5em; font-weight:700;">停用中</a>
											<?php }?>
										<?php }else{?>
											<a style="color:red; font-size:1.5em; font-weight:700;" href="javascript:">停用中</a>
										<?php }?>
									</span>
								</p>
								<p>
									<span>
										<?php if($vo['status'] == 1 && $vol['status'] == 1){?>
											<?php if($vol['contact'] == 1){?>
											<a href="javascript:">空闲</a>
											<?php }else if ($vol['contact'] == 2){?>
											<a href="javascript:">占用</a>
											<?php }else if ($vol['contact'] == 3){?>
											<a href="javascript:">已用</a>
											<?php }?>
										<?php }?>
									</span>
								</p>
								<b>
									<?php if($vo['status'] == 1 && $vol['status'] == 1 && $vol['contact'] != 3){?>
									<!--
									<a href="<?php echo dy::getWebUrl();?>/box/index?code=<?=$vo['code']?>&number=<?=$vol['number']?>">打开</a>
									-->
									<a href="javascript:" onclick="return OpenBox('<?=$vo['code']?>','<?=$vol['number']?>', '<?=$user_code?>')">打开</a>
									
									<a href="javascript:" onclick="return OkBox(<?=$vol['id']?>, <?=$order_id?>)">发货</a>
									<?php }?>
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
 * 2015-07-03 add by dudanfeng 1 ajax get请求		
 **/
/******************** 1 ********************/ 
function OkBox(id, order_id){
	if(!confirm('确认要执行该操作吗?')){
		return false;
	}
	
	$.ajax({
		"type" : "post" ,
		"url"  : "<?php echo dy::getWebUrl();?>/box/closebox",
		"data" : {
			id  : id,
			order_id : order_id,
		},
		
		"success" : function ( data ){
			if(data == 1){
				window.location.href="<?php echo dy::getWebUrl();?>/express/default/index";
			}else if(data == 2){
				alert("请先关闭柜门！");
			}else{
				alert("操作有误！");
				location.reload();
			}
		} 
	});
	return false;
}
/******************** 1 ********************/ 


/**							
 * 2015-07-03 add by dudanfeng 1 打开箱子
 **/
/******************** 1 ********************/ 
function OpenBox(code, number, user_code){
	$.ajax({
		"type" : "post" ,
		"url"  : "<?php echo dy::getWebUrl();?>/box/index",
		"data" : {
			code  : code,
			number : number,
			user_code : user_code,
		},
		
		"success" : function ( data ) {
			
		} 
	});
	return false;
}

</script>
