<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<!--content start-->
<!--2015-6-3 add 唐小莉 订单详情-->
<div class="userOrder">
	<p><a href="<?php echo dy::getWebUrl();?>/default/index">首页</a>&gt;&gt;<a href="javascript:;">个人中心</a>&gt;&gt;<span>我的订单</span></p>
	<?php foreach($row as $k => $v):?>
	<h4>我的订单</h4>
	<div class="orderState">
		<p>订单状态</p>
		<ul>
			<?php if($v['status'] >= 4){?>
			<li><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/state01.png" width="184" height="25" /><span>付款成功</span></li>
			<?php }else{?>
			<li><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/state02.png" width="184" height="25" /><span>付款成功</span></li>
			<?php }?>
			<?php if($v['status'] >= 6){?>
			<li><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/state01.png" width="184" height="25" /><span>等待收货</span></li>
			<?php }else{?>
			<li><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/state02.png" width="184" height="25" /><span>等待收货</span></li>
			<?php }?>
			<?php if($v['status'] >= 9){?>
			<li><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/state01.png" width="184" height="25" /><span>订单完成</span></li>
			<?php }else{?>
			<li><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/state02.png" width="184" height="25" /><span>订单完成</span></li>
			<?php }?>
		</ul>
	</div>
	
	<div class="orderInfo">
		<p>订单详情</p>
		<ul>
			<li><span style="padding-top:12px;">订单号：<?=$v['order_sn']?></span><span>订单日期：<?=date('Y-m-d', $v['create_time'])?></span></li>
			<li><span>付款方式：<?php if($v['price_discount'] != 0){?>支付宝<?php }else{?>余额支付<?php }?></span></li>
		</ul>
	</div>
	
	<!--2015-6-3 add 唐小莉 订单列表-->
	<div class="usergoodsInfo">
		<p>取菜时间：<span><?=date('Y-m-d', $v['put_time'])?></span>&nbsp;<?=$time_set?>&nbsp;&nbsp;&nbsp;&nbsp;取菜验证码：<span><?=$v['user_code']?></span></p>
		<p>自提地点: <span style="color:#0aa39a;"><?=$area['area_name']?></span>&nbsp;&nbsp;&nbsp;&nbsp; <span style="color:#0aa39a;"><?=$res['address']?></span>
		<ul class="userGoodsName">
			<li><h5>商品图片</h5></li>
			<li><h5>商品名称</h5></li>
			<li><h5>商品编号</h5></li>
			<li><h5>单价</h5></li>
			<li><h5>数量</h5></li>
			<li><h5>总计</h5></li>
		</ul>
		<?php foreach($goods as $ke => $vo):?>
		<?php foreach($vo as $key => $vol):?>
		<ul class="userGoodsList">
			<li><a href="<?php echo dy::getWebUrl();?>/goods/detail?id=<?=$vol['id']?>"><img src="<?=dy::getImgOne($vol['goods_show'])?>" width="53" height="53" /></a></li>
			<li><a href="<?php echo dy::getWebUrl();?>/goods/detail?id=<?=$vol['id']?>"><?=$vol['goods_name']?></a></li>
			<li><span><?=$vol['hs_code']?></span></li>
			<li><span>¥<?=$vol['price_vip']?></span></li>
			<li><span><?=$vol['goods_num']?></span></li>
			<li><span>¥<?=$vol['price_vip']*$vol['goods_num']?></span></li>
		</ul>
		<?php endforeach;?>
		<?php endforeach;?>
	</div>
	<!--2015-6-3 add 唐小莉 订单列表-->
	
	<div class="orderTotal">
		<p><span>总订单</span><span>金额</span></p>
		<ul>
			<li><span>订单总金额：</span></li>
			<li><span>¥<?=$v['price_all']?></span></li>
		</ul>
		<ul>
			<li><span>付款总金额：</span></li>
			<li><span>¥<?=$v['price_discount']?></span></li>
		</ul>
	</div>
	<?php endforeach;?>
	<?php if($v['status'] == 1):?>
	<a class="orderPayGet" href="<?php echo dy::getWebUrl();?>/goods/paysub?id=<?=$v['id']?>">去付款</a>
	<?php endif;?>
</div>
<!--2015-6-3 add 唐小莉 订单详情-->
