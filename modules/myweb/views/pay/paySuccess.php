<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />
<div class="submitTitle">
	订单已经提交成功，请您尽快付款！
</div>
<div class="submitInfo">
	<p>订单号：<b><?=$row['order_sn']?></b></p>
	<p>验证码：<b><?=$row['user_code']?></b></p>
	<p>应付金额：<b><?=$row['price_discount']?>元</b></p>
	<p>您可以在<a href="<?php echo dy::getWebUrl();?>/myweb/person/index">【我的账户】</a>中查看订单记录</p>
	<p>请您在提交订单<span>30分钟</span>内完成支付，否则订单会自动取消。</p>
</div>

<script src="http://localhost:8080/socket.io/socket.io.js"></script>

<script>
	var iosocket = io.connect("http://localhost:8080");

	function PaySubmit(){
		
		var wx_token = '<?=$row['order_sn']?>';
		var user_wx = '<?=$row['price_discount']?>';
		var msg = wx_token+','+user_wx;
		
		iosocket.send(msg);
	}
</script>