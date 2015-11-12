<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />
<!--content start-->
<div class="check">
	<div class="checkTitle">
		核对订单信息
	</div>
	<div class="checkBox">
		请选择取菜点<a href="<?php echo dy::getWebUrl();?>/myweb/default/area">切换自提点</a>
	</div>
	<div class="select">
		<select>
			<?php foreach($area as $v):?>
				<option><b><?=$v['area_name']?></b>&nbsp;&nbsp;&nbsp;<span><?=$v['address']?></span></option>
			<?php endforeach;?>
			
		</select>
	</div>
	<div class="PaymentMethod">
		支付方式<p><img src="<?php echo dy::getWebUrl();?>/modules/myweb/public/images/wx.png"></p>
	</div>
	<div class="goodsList">
		商品清单 <a href="<?php echo dy::getWebUrl();?>/myweb/goods/cart">修改购物车</a>
	</div>
	<div class="getTime" style="display:none">
		取菜时间：<?=date('Y-m-d', $time)?>&nbsp; <?=$set_time?>
	</div>
	<div class="getBox">
			<ul class="getboxTitle">
				<li>商品图片</li>
				<li>商品名称</li>
				<li>单价</li>
				<li>数量</li>
				<div class="clear"></div>
			</ul>
			
			<?php foreach($goodslist as $v):?>
			<ul class="getboxInfo">
				<li><img src="<?=dy::getImgOne($v['goods_show'])?>"></li>
				<li><a href="<?php echo dy::getWebUrl();?>/goods/detail?id=<?=$v['goods_id']?>"><?=$v['goods_name']?></a></li>
				<li><?=$v['price_vip']?></li>
				<li><?=$v['goods_number']?></li>
				<div class="clear"></div>
			</ul>
			<?php endforeach;?>
	</div>
	<div class="useCou">
		<p>请选择您的优惠券</p>
		<select onchange="ActivitySelect(this.value, '<?php echo dy::getWebUrl();?>')">
			<option value="-2">不使用优惠券</option>
			<?php if($user['money'] > 0){?>
			<option value="-1">账户余额<?=$user['money']?>元</option>
			<?php }?>
			<?php foreach($activity as $v):?>
			<?php if($v['type'] == 1){?>
			<option value="<?=$v['id']?>"><?=$v['value2']?>元券</option>
			<?php }else{?>
			<option value="<?=$v['id']?>"><?=$v['ac_name']?></option>
			<?php }?>
			<?php endforeach;?>
		</select>
	</div>
	<div class="remark">
		<div class="remarkBox">
			<p>温馨提示</p>
			<span style="color:red;">取菜时间：<?=date('Y-m-d', $time)?>&nbsp; <?=$set_time?><br><?=$company_notice1?></span>
		</div>
	</div>
	<div class="reconfirm">
		<p>支付方式：微信支付</p>
		<p>取菜点：<?=$area_name?></p>
	</div>
	<div class="reconfirmResult">
		<p style="font-weight:bold;">应付总额：<b id="OrderPrice" style="font-size:1.5em;color:red;"><?=$price?></b></p>
		<a style="width:97%;height:40px;line-height:40px;font-size:2em;margin-bottom:40px;" href="javascript:void(0);" onclick="return OrderPay()">立即结算</a>
	</div>
	<form style="display:none" id="ordersubmit" action="<?php echo dy::getWebUrl();?>/myweb/goods/pay" method="post">
		<input type="text" name="time" value="<?=$time?>">
		<input type="text" id="AllPrice" name="allprice" value="<?=$price?>" >
		<input type="text" name="oldallprice" value="<?=$price?>" >
		<input type="text" name="text" value="" id="Text">
	</form>
	<div class="clear"></div>
</div>

<!--content end-->
<script>
	 
</script>