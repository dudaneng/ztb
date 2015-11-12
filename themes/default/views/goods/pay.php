<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/goodsBanner.js"></script>
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/jquery-1.8.3.min.js"></script>
<!--content start-->

<div class="con">
	<div class="submitSuccess">
    	<h3><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/bingo.png" /><span>订单已经提交成功，请您尽快付款！</span></h3>
        <p>订单号：<b><?=$order_sn?></b></p>
        <p>提取码：<b><?=$user_code?>（在我的订单内亦可查看）</b></p>
        <p>应付金额：<b><?=$price?>元</b></p>
        <span>请您在提交订单<b>30分钟</b>内完成支付，否则订单会自动取消。</span>
        <i><a href="javascript:" onclick="PaySubmit()">立即付款</a><a><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/pay.png" /></a></i>
		
		<form style="display:none;" id="PayOrder" action="<?php echo dy::getWebUrl();?>/components/alipay/alipayapi.php" target="_blank" method="post">
			<input type="hidden" value="<?=$order_sn?>" name="order_sn">
			<input type="hidden" value="美食帮订单号：<?=$order_sn?>" name="subject">
			<input type="hidden" value="<?=$price?>" name="total_fee">
			<input type="hidden" value="美食帮" name="body">
			<input type="hidden" value="" name="show_url">
		</form>
	</div>
</div>

<!--content end-->
<script src="http://localhost:8080/socket.io/socket.io.js"></script>
<script>
	var iosocket = io.connect("http://localhost:8080");

	function PaySubmit(){
		document.getElementById('PayOrder').submit();
		
		var wx_token = '<?=$order_sn?>';
		var user_wx = '<?=$price?>';
		var msg = wx_token+','+user_wx;
		
		iosocket.send(msg);
	}
</script>