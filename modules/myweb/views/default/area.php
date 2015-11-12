<?php
use yii\helpers\Html;
use components\dy;
?>
<link rel="stylesheet" type="text/css" href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css">
<!--content start-->
<div class="pickContent">
	<div class="pickTitle">
		选择自提点
	</div>
	<div class="pickInfo">
		<ul>
			<?php if(count($area) > 0){?>
				<?php foreach($area as $v):?>
				<li><a href="<?php echo dy::getWebUrl();?>/myweb/default/area?id=<?=$v['id']?>&type=<?=$type?>"><?=$v['area_name']?><span>&gt;</span></a></li>
				<?php endforeach;?>
			<?php }else{?>
				<li><a>暂无此自提点相关信息</a></li>
			<?php }?>
		</ul>
	</div>
</div>