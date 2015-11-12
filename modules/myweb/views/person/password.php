<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />
<script src="<?php echo dy::getWebUrl();?>/modules/myweb/public/js/getpassword.js" type="text/javascript" charset="utf-8"></script>

<!--content start-->
<div class="editTitle">
	修改密码
</div>
<div class="editBox">
	<form>
		<div class="item"><span>*</span>原始密码：</div>
		<input type="password" id="UnsetPassword" onfocus="UnsetPasswordO()" value="" placeholder="" />
        <span class="color" id="UnsetPasswordText" style="display:none;">密码输入不正确！</span>
		
		<div class="item"><span>*</span>新密码：</div>
		<input type="password" id="UnsetPassword1" onfocus="UnsetPassword1O()" value="" placeholder="" />
		
		<div class="item"><span>*</span>确认密码：</div>
	    <input type="password" id="UnsetPassword2" onfocus="UnsetPassword1O()" value="" placeholder="" />
        <span  class="color" id="PasswordText" style="display:none;">两次密码为空或者输入不一致！</span>
		
		<input type="button" onclick="UnPasswordSub('<?php echo dy::getWebUrl();?>')" class="color1"  value="保存修改"/>
	</form>
</div>
<!--content end-->

<script>
	
</script>