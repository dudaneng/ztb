<?php
use yii\helpers\Html;
use yii\helpers\Url;
use components\dy;

?>
<?php $counts = $this->context->counts;?>

<?php $this->beginContent('@app/views/layouts/main.php');?>
<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />
<!--content start-->
<div class="con">
	<div class="userCon">
    	<div class="userNavList" id="userNavList">
        	<dl>
            	<dt>交易管理</dt>
            	<dd><a href="<?php echo dy::getWebUrl();?>/person/index?type=2">未付款订单<i>(<?php echo !empty($counts[0]) ? $counts[0] : 0;?>)</i></a></dd>
				<dd><a href="<?php echo dy::getWebUrl();?>/person/index?type=3">进行中订单<i>(<?php echo !empty($counts[1]) ? $counts[1] : 0;?>)</i></a></dd>
				<dd><a class="navSelected" href="<?php echo dy::getWebUrl();?>/person/index?type=1">所有的订单<i>(<?php echo !empty($counts[3]) ? $counts[3] : 0;?>)</i></a></dd>
            	<dd><a href="<?php echo dy::getWebUrl();?>/person/index?type=4">已完成订单<i>(<?php echo !empty($counts[2]) ? $counts[2] : 0;?>)</i></a></dd>
				<dd><a href="<?php echo dy::getWebUrl();?>/person/activity">我的优惠券</a></dd>
            	<dt>个人信息管理</dt>
            	<dd><a href="<?php echo dy::getWebUrl();?>/person/user">编辑账户</a></dd>
            	<dd><a href="<?php echo dy::getWebUrl();?>/person/password">修改密码</a></dd>
            	<dd><a href="<?php echo dy::getWebUrl();?>/person/phone">修改手机号</a></dd>
            	<dd><a href="<?php echo dy::getWebUrl();?>/login/logout">退出系统</a></dd>
            </dl>
        </div>
		<dl id="userInfo">
			<?= $content ?>
        </dl>
    </div>
</div>
<!--content end-->
<?php $this->endContent();?>