<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/modules/myweb/public/js/forget.js"></script>

<!--content start-->
<div class="editTitle">
	重置密码
</div>
<div class="editBox">
	<form>
		<div class="item">
			<span>*</span>注册手机号：
		</div>
		<input type="tel" id="ForgetPhone" onclick="ForgetPhoneO()" placeholder="" />
		<p class="color" id="ForgetPhoneText" style="display:none;">该手机号不存在！</p>
		
		<div class="item">
			<span>*</span>验证码：
		</div>
		<input style="width:50%;" type="text" id="FBCode" onclick="FBCodeOn()" onblur="ForGetPCO(this.value, '<?php echo dy::getWebUrl();?>')" placeholder="" />
		<input style="width:42%;height:32px; margin-left: 3%;" type="button" id="ForGetPhCo" onclick="ForgetPhCode(this,'<?php echo dy::getWebUrl();?>')" value="获取验证码" />
		<span class="color" id="ForgetCodeText" style="display:none; font-size:13px; color:#f27510;">验证码错误或已失效</span>
		
		<input type="button" class="color1" onclick="forgetPhoneBtn('<?php echo dy::getWebUrl();?>')" value="找回密码"/>
	</form>
</div>
<!--content end-->

<script>

</script>