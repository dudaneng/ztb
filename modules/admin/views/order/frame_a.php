<?php 
use yii\helpers\Html;
use components\dy;
?>

<div class="printerTicket" style="display:block;">
	<?php foreach($ordergoods as $k => $v):?>
	<br/>
	<div class="content">
		<ul>
			<li><p><b><?=$v['goods_name']?></b><span>&nbsp;&nbsp;¥<?=$v['goods_price']?></span></p><img src="<?php echo dy::getWebUrl();?>/public/admin/images/msb.jpg"/></li>
			<li><span>微信扫码关注美食帮</span><span>更多精彩等着您</span><i>（低温保鲜冷藏，建议当天食用）</i></li>
		</ul>
	</div>
	<br/>
	<?php endforeach;?>
</div>
	
