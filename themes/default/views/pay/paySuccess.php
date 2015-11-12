<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />

<div class="con">
	<div class="paySuccess">
    	<h3><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/bingo.png" /><span>订单已支付成功，请及时取回您的菜品！</span></h3>
        <p>支付金额：<b><?=$row['price_discount']?>元</b></p>
        <p>支付方式：<b><?php if($row['price_discount'] != 0){?>支付宝<?php }else{?>余额付款<?php }?></b></p>
        <p>订单号：<b><?=$row['order_sn']?></b></p>
        <p>验证码：<b><?=$row['user_code']?>（在我的订单内亦可查看）</b></p>
        <i><a href="<?php echo dy::getWebUrl();?>/person/orderinfo?id=<?=$row['id']?>">查看订单详情</a><a href="<?php echo dy::getWebUrl();?>/person/index">返回个人中心</a></i>
    </div>
</div>

<script src="http://localhost:8080/socket.io/socket.io.js"></script>

<script>
window.onload =function() {
	var iosocket = io.connect("http://localhost:8080");
	
	var wx_token = '<?=$row['order_sn']?>';
	var user_wx = '<?=$row['price_discount']?>';
	var msg = wx_token+','+user_wx;
	iosocket.send(msg);
}
</script>