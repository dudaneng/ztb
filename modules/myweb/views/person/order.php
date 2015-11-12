<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="unpaidTitle">
	<?php if($type == 1){echo "我的订单";}else if($type == 2){echo "未付款订单";}else if($type == 3){echo "进行中的订单";}else if($type == 4){echo "已完成订单";}?>
</div>
<div class="unpaidInfo">
	<?php foreach($row as $v):?>
	<a href="<?php echo dy::getWebUrl();?>/myweb/person/orderinfo?id=<?=$v['id']?>">
	<div class="unpaidbox">
		<p>订单号：<b><?=$v['order_sn']?></b>
			<span>状态：<b>
				<?php if($v['status'] == 1){
					echo ('待付款');
				}else if($v['status'] == 2){
					echo ('已取消');
				}else if($v['status'] == 3){
					echo ('商家取消');
				}else if($v['status'] == 4){
					echo ('已付款');
				}else if($v['status'] == 5){
					echo ('已申请退款');
				}else if($v['status'] == 7){
					echo ('已到自提点');
				}else if($v['status'] == 9){
					echo ('已完成');
				}
				?>
			</b></span>
		</p>
		<p class="mark">></p>
		<p>取菜时间：<?=date('Y-m-d', $v['put_time'])?> <?=$time_set?><span>合计：￥<?=$v['price_all']?></span></p>
	</div>
	</a>
	<?php endforeach;?>
</div>

<div class="unpaidInfo">
	<?=$page?>
</div>
<!--content end-->
