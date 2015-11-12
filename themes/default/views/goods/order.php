<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="con">
	<div class="checkOrder">
    	<ul class="ShoppingProcess">
        	<li class="cartSlected">我的购物车</li>
        	<li><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/shoppingCart1.png" width="284" height="40" /></li>
        	<li class="cartSlected">核对订单信息</li>
        	<li><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/shoppingCart1.png" width="284" height="40" /></li>
        	<li>成功提交订单</li>
        </ul>
        <div class="checkOrderInfo">
        	<h3>核对订单信息：</h3>
            <p><span>选择自提点</span><a style="cursor:pointer;" onclick="ShowDiv('MyDiv','fade')">切换自提点</a></p>
        	<ul class="checkArea" id="CheckArea">
            	<?php foreach($area as $v):?>
				<li class="checkAreaSlected"><b><?=$v['area_name']?></b><span><?=$v['address']?></span></li>
				<?php endforeach;?>
			</ul>
			<input type="hidden" id="OrderCheckArea" onclick="OrderCheckArea1('<?php echo dy::getWebUrl();?>')"/>
            <p>支付方式</p>
        	<ul class="selectPay">
            	<li class="paySelected"><a href="javascript:;"><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/pay.png" width="110" height="40" /></a></li>
            </ul>
			
            <p><span>商品清单</span><a href="<?php echo dy::getWebUrl();?>/goods/cart">去购物车修改</a></p>
            
        	<ul class="checkOrderList">
            	<li>商品名称</li>
            	<li>商品编号</li>
            	<li>单价</li>
            	<li>数量</li>
            	<li>总计（元）</li>
            </ul>
        	<?php foreach($goodslist as $v):?>
			<ul class="checkOrderListInfo">
            	<li><a href="<?php echo dy::getWebUrl();?>/goods/detail?id=<?=$v['goods_id']?>"><?=$v['goods_name']?></a></li>
            	<li><?=$v['hs_code']?></li>
            	<li>¥<?=$v['price_vip']?></li>
            	<li><?=$v['goods_number']?></li>
            	<li>¥<?=$v['price_vip']*$v['goods_number']?></li>
            </ul>
			<?php endforeach;?>
        	<i>
            	<span>支付方式：支付宝</span>
            	<span>取商品点：<?=$area_name?></span>
            </i>
            <div class="orderRemarks" style="display:none;">
            	<b>备注：</b>
                <textarea id="OrderText" placeholder="请输入备注信息"></textarea>
            </div>
			<p>温馨提示</p>
        	<ul class="selectPay">
            	<h4 style="color:red;font-weight:bold;margin-bottom:50px;margin-top:10px;font-size:16px;">取菜时间：<?=date('Y-m-d', $time)?>&nbsp; <?=$set_time?><br><?=$company_notice1?></h4>
            </ul>
			<div class="submitOrder">
            	<p>
                    <select class="selectCoupon" onchange="ActivitySelect(this.value, '<?php echo dy::getWebUrl();?>')">
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
                </p>
				<p><span>应付总额：</span><b id="OrderPrice">¥<?=$price?></b></p>
                <p><a href="javascript:" onclick="return OrderPay()">提交订单</a></p>
            </div>
			<form style="display:none" id="ordersubmit" action="<?php echo dy::getWebUrl();?>/goods/pay" method="post">
				<input type="text" name="time" value="<?=$time?>">
				<input type="text" id="AllPrice" name="allprice" value="<?=$price?>" >
				<input type="text" id="OldAllPrice" name="oldallprice" value="<?=$price?>" readonly >
				<input type="text" name="text" value="" id="Text">
			</form>
        </div>
    </div>
</div>

<!--content end-->
<script>
	 
</script>