<?php
use yii\helpers\Html;
use components\dy;
?>
<link rel="stylesheet" type="text/css" href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css">
<!--content start-->
<div class="pickconfirm">
	<?php if(count($area) > 0){?>
		<?php foreach($area as $v):?>
		<div class="confirmTitle">
			<?=$v['area_name']?>
		</div>
		<div class="confirmInfo">
			<p>详细地址：<?=$v['address']?></p>
			<p>电话：<?=$v['contact']?></p>
			<a href="javascript:void(0);" onclick="SelectArea(<?=$v['id']?>, '<?=$v['area_name']?>')">确认选择</a>
		</div>
		<?php endforeach;?>
	<?php }else{?>
		<div class="confirmInfo">
			<a href="javascript:void(0);">暂无此相关信息！</a>
		</div>
	<?php }?>
</div>

