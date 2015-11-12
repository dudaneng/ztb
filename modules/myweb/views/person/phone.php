<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/modules/myweb/public/js/getphone.js"></script>

<!--content start-->
<div class="editTitle">
	修改手机号
</div>
<div class="editBox">
	<form id="PhoneForm" style="display:block;">
		<div class="item">
			<span>*</span>原始手机号：
		</div>
		<input type="text" id="RePhone" value="<?=$row['user_phone']?>" placeholder="" disabled />
		
		<div class="item">
			<span>*</span>验证码：
		</div>
		<input type="text" style="width:50%;" id="CodeOne" onclick="SetPhoF()" onblur="SetPhoC(this.value, '<?php echo dy::getWebUrl();?>')" placeholder="" />
		<input type="button"  style="width:42%;height:32px; margin-left: 3%;" id="SetPhoneCode" onclick="SetPhoneCodeF(this,'<?php echo dy::getWebUrl();?>')" value="免费获取验证码" />
		<span class="color" id="SetPhoneCodeText" style="display:none;">验证码错误或失效！</span>
		<input class="color1" type="button" onclick="CheckSetPhoneBtnOne('<?php echo dy::getWebUrl();?>')" value="下一步" />
	</form>
	
	<form  id="PhoneForm1" style="display:none;">
		<div class="item">
			<span>*</span>新手机号：
		</div>
		<input type="text" id="NePhone" onclick="NePhoneC()" placeholder="" />
        <span  class="color" id="RePhoneText" style="display:none;">该手机号不存在！</span>
		
		<div class="item">
			<span>*</span>验证码：
		</div>
		<input style="width:50%;" type="text" id="CodeTwo" onclick="SetPhoCNewC()" onblur="SetPhoCNew(this.value, '<?php echo dy::getWebUrl();?>')"  placeholder="" />
        <input style="width:42%;height:32px; margin-left: 3%;" type="button" id="SetPhoneCode1" onclick="SetPhoneCodeR(this, '<?php echo dy::getWebUrl();?>')" value="免费获取验证码" />
        <span class="color" id="SetPhoneCode1Text" style="display:none;">验证码错误或失效！</span>
		
		<input type="button" value="保存修改" onclick="CheckSetPhoneBtn('<?php echo dy::getWebUrl();?>')" class="color1"/>
	</form>
</div>
<!--content end-->

<script>
	
</script>