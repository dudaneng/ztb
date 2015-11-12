<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="userTitle">
	个人中心
</div>
<div class="userbox">
	<b><?=$row['user_name']?></b>，美食帮欢迎您！
	<p>您的推荐码：<?=$row['activity']?></p>
</div>
<div class="commonBox">
	<div class="commonTitle">交易管理</div>
	<div class="commoninfo">
		<ul>
			<li onclick="OrderHref('order?type=2')"><a  href="javascript:">未付款订单<b>（<?php if($num1){echo $num1;}else{ echo 0;}?>）</b><span>></span></a></li>
			<li onclick="OrderHref('order?type=3')"><a href="javascript:">进行中订单<b>（<?php if($num2){echo $num2;}else{ echo 0;}?>）</b></a><span>></span></li>
			<li onclick="OrderHref('order?type=4')"><a href="javascript:">已完成订单<b>（<?php if($num3){echo $num3;}else{ echo 0;}?>）</b></a><span>></span></li>
			<li onclick="OrderHref('activity')"><a href="javascript:">我的优惠券<b>（<?php if($num4){echo $num4;}else{ echo 0;}?>）</b></a><span>></span></li>
		</ul>
	</div>
</div>
<div class="commonBox">
	<div class="commonTitle">账户管理</div>
	<div class="commoninfo">
		<ul>
			<li onclick="OrderHref('user')"><a href="javascript:">编辑账户<span>></span></a></li>
			<li onclick="OrderHref('password')"><a href="javascript:">修改密码<span>></span></a></li>
			<li onclick="OrderHref('phone')"><a href="javascript:">修改手机号<span>></span></a></li>
			<li><a href="<?php echo dy::getWebUrl();?>/myweb/login/logout">退出系统<span>></span></a></li>
		</ul>
	</div>
</div>
<div class="bottom"></div>
<!--content end-->

<script>
	function OrderHref(str){
		window.location.href="<?php echo dy::getWebUrl();?>/myweb/person/"+str;
	}
</script>