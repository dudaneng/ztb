<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="editTitle">
	注册
</div>
<div class="editBox">
	<form  method="post" action="<?php echo dy::getWebUrl();?>/login/registersubmit">
		<div class="item">
			<span>*</span>真实姓名：
		</div>
		<input type="text" onfocus="UserAccount()" id="user_account" name="user_account" placeholder="请输入真实姓名！" />
        <span id="user_account1" class="color" style="display:none;">请输入真实姓名！</span>
		
		
		<div class="item">
			<span>*</span>手机号码：
		</div>
		<input type="text" onfocus="UserPhone()" id="user_phone" name="user_phone" placeholder="" />
        <span id="user_phone1" class="color" style="display:none;">请输入正确的手机号！</span>
		
		<div class="item" style="display:<?php if($sms_set == 1){echo "block";}else{echo "none";}?>">
			<span>*</span>注册验证码：
		</div>
		<div class="item" style="display:<?php if($sms_set == 1){echo "block";}else{echo "none";}?>">
			<input style="width:50%;" type="text" onblur="return CodePhoneNamber(this.value)" value="<?php if($sms_set == 1){echo "";}else{echo "1234";}?>" id="CodePhone4" placeholder="" />
			<input type="button" onclick="return CodePhone(this)" id="CodePhone1" style="width:42%;height:32px; margin-left: 3%;" value="免费获取验证码" />
			<span id="CodePhone3" style="display:none;">验证码有误！</span>
		</div>
		
		<div class="item">
			<span>*</span>密码：
		</div>
		<input type="password" name="user_password" id="user_password" placeholder="" />
		
		<div class="item">
			<span>*</span>确认密码：
		</div>
		<input type="password" onfocus="Password()" name="password1" id="password" placeholder="" />
        <span id="password1" class="color" style="display:none;">两次输入的密码不一致！</span>
		
		<p><input type="checkbox" style="width:20px;" id="Checked" class="fl" checked="checked" />我已经阅读并同意美食帮相关服务条款</p>
		<input type="submit" class="color1" onclick="return registerBtn()" value="注册"/>
		
		<input type="button" class="color2" onclick="LoginBtn()" value="已有账号登录"/>
	</form>
</div>
		
<!--content end-->

<script>
	function LoginBtn(){
		location.href = '<?php echo dy::getWebUrl();?>'+'/myweb/login/index';
	}
</script>