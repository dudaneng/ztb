<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />

<!--content start-->
<?php foreach($row as $k => $v):?>
<div class="orderTitle">
	我的订单：<?=$v['order_sn']?>
</div>
<div class="detailTitle">订单详情</div>
<div class="detailBox">
	<p>订单号：<?=$v['order_sn']?></p>
	<p>订单日期：<?=date('Y-m-d', $v['create_time'])?></p>
	<p>付款方式：微信支付</p>
</div>
<div class="btnBox">
	<?php if($v['status'] < 4):?>
	<a href="<?php echo dy::getWebUrl();?>/myweb/goods/paysub?order_sn=<?=$v['order_sn']?>">去支付</a>
	<?php endif;?>
</div>
<p class="time">取菜时间：<?=date('Y-m-d', $v['put_time'])?></span>&nbsp;<?=$time_set?></p>
<div class="orderInfo">
	<ul class="bg">
		<li>商品名称</li>
		<li>单价</li>
		<li>数量</li>
	<div class="clear"></div>
	</ul>
	<?php foreach($goods as $ke => $vo):?>
	<?php foreach($vo as $key => $vol):?>
	<ul>
		<li><a href="<?php echo dy::getWebUrl();?>.myweb/goods/detail?id=<?=$vol['id']?>"><?=$vol['goods_name']?></a></li>
		<li>￥<?=$vol['price_vip']?></li>
		<li><?=$vol['goods_num']?></li>
	<div class="clear"></div>
	</ul>
	<?php endforeach;?>
	<?php endforeach;?>
</div>
<div class="plusPrice">
	订单总额：<?=$v['price_all']?>
	<br/>
	应付总额：<?=$v['price_discount']?>
	<p>
	<?php if($v['status'] < 4){?>
	<a href="<?php echo dy::getWebUrl();?>/myweb/person/forbid?id=<?=$v['id']?>&type=1">取消</a>
	<?php }else if($v['status'] >= 4 && $v['status'] < 9){?>
	<a href="<?php echo dy::getWebUrl();?>/myweb/person/forbid?id=<?=$v['id']?>&type=2">确认收货</a>
	<?php }?>
	</p>
	<div class="clear"></div>
</div>
<?php endforeach;?>
<!--content end-->