<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/getphone.js"></script>

<!--content start-->
<!--2015-6-3 add 唐小莉 修改手机号码-->
<dd class="amendedPhone">
	<p><a href="<?php echo dy::getWebUrl();?>/default/index">首页</a>&gt;&gt;<a href="javascript:;">个人中心</a>&gt;&gt;<span>修改手机号码</span></p>
	<h4>修改手机号码</h4>
	<form id="PhoneForm">
	<ul>
		<li>
			<p><b>*</b>原始手机号：</p>
			<input type="text" id="RePhone" value="<?=$row['user_phone']?>" placeholder="" disabled />
		</li>
		<li>
			<p><b>*</b>验证码：</p>
			<input type="text" id="CodeOne" onclick="SetPhoF()" onblur="SetPhoC(this.value, '<?php echo dy::getWebUrl();?>')" placeholder="" />
			<input type="button" id="SetPhoneCode" onclick="SetPhoneCodeF(this,'<?php echo dy::getWebUrl();?>')" value="免费获取验证码" />
			<span id="SetPhoneCodeText" style="display:none;">验证码错误或失效！</span>
		</li>
		<li><input class="amendedBtn" type="button" onclick="CheckSetPhoneBtnOne('<?php echo dy::getWebUrl();?>')" value="下一步" /></li>
	</ul>
	</form>
	<form  id="PhoneForm1" style="display:none;">
	<ul>
		<li>
			<p><b>*</b>新手机号：</p>
			<input type="text" id="NePhone" onclick="NePhoneC()" placeholder="" />
			<span  id="RePhoneText" style="display:none;">该手机号不存在！</span>
		</li>
		<li>
			<p><b>*</b>验证码：</p>
			<input type="text" id="CodeTwo" onclick="SetPhoCNewC()" onblur="SetPhoCNew(this.value, '<?php echo dy::getWebUrl();?>')"  placeholder="" />
			<input type="button" id="SetPhoneCode1" onclick="SetPhoneCodeR(this, '<?php echo dy::getWebUrl();?>')" value="免费获取验证码" />
			<span id="SetPhoneCode1Text" style="display:none;">验证码错误或失效！</span>
		</li>
		<li><input class="amendedBtn" type="button" onclick="CheckSetPhoneBtn('<?php echo dy::getWebUrl();?>')" value="保存" /></li>
	</ul>
	</form>
	
</dd>
<!--2015-6-3 add 唐小莉 修改手机号码-->
