<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/getpassword.js"></script>

<!--content start-->
<!--2015-6-3 add 唐小莉 修改密码-->
<dd class="amendedPassword">
	<p><a href="<?php echo dy::getWebUrl();?>/default/index">首页</a>&gt;&gt;<a href="javascript:;">个人中心</a>&gt;&gt;<span>修改密码</span></p>
	<h4>修改密码</h4>
	<form>
	<ul>
		<li>
			<p><b>*</b>原始密码：</p>
			<input type="password" id="UnsetPassword" onfocus="UnsetPasswordO()" value="" placeholder="" />
			<span id="UnsetPasswordText" style="display:none;">密码输入不正确！</span>
		</li>
		<li>
			<p><b>*</b>新密码：</p>
			<input type="password" id="UnsetPassword1" onfocus="UnsetPassword1O()" value="" placeholder="" />
		</li>
		<li>
			<p><b>*</b>确认新密码：</p>
			<input type="password" id="UnsetPassword2" onfocus="UnsetPassword1O()" value="" placeholder="" />
			<span id="PasswordText" style="display:none;">两次密码为空或者输入不一致！</span>
		</li>
		<li><input type="button" onclick="UnPasswordSub('<?php echo dy::getWebUrl();?>')" value="保存" /></li>
	</ul>
	</form>
</dd>
<!--2015-6-3 add 唐小莉 修改密码-->
