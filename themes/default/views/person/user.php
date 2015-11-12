<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/user.js"></script>

<!--content start-->
<!--2015-6-3 add 唐小莉 编辑账户-->
<dd class="editAccount">
	<p><a href="<?php echo dy::getWebUrl();?>/default/index">首页</a>&gt;&gt;<a href="javascript:;">个人中心</a>&gt;&gt;<span>编辑账户</span></p>
	<h4>编辑账户</h4>
	<form action="<?php echo dy::getWebUrl();?>/person/useredit" method="post">
	<ul>
		<li>
			<p><b>*</b>用户名：</p>
			<input type="text" id="UseName" onfocus="UseNameC()" name="user_name" value="<?=$row['user_name']?>"/>
			<span style="display:none;" id="UseName1">用户名不能为空</span>
		</li>
		<li>
			<p><b>*</b>手机号码：</p>
			<input type="tel" value="<?=$row['user_phone']?>" disabled />
		</li>
		<li>
			<p><b></b>电子邮箱：</p>
			<input type="email" id="Emial" onblur="ChangEmail(this.value)" name="user_email" value="<?=$row['user_email']?>" />
			<span style="display:none;" id="Emial1">邮箱格式不正确！</span>
		</li>
		<li>
			<input type="button" onclick="UserSubmit('<?php echo dy::getWebUrl();?>')" value="保存" />
		</li>
	</ul>
	</form>
</dd>
<!--2015-6-3 add 唐小莉 编辑账户-->

