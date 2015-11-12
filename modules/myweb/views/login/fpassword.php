<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/modules/myweb/public/js/fpassword.js"></script>

<!--content start-->
<div class="editTitle">
	重置密码
</div>
<div class="editBox">
	<form>
		<div class="item">
			<span>*</span>新密码：
		</div>
		<input type="password" id="FgPasswordNew" placeholder="" />
		<div class="item">
			<span>*</span>确认密码：
		</div>
		<input type="password" id="FgPasswordNew1" placeholder="" />
		
		<p class="color" id="FgPasswordNewText" style="display:none;">两次密码不一致！</p>
		
		<input type="button" class="color1" onclick="FgPasswordBtn('<?php echo dy::getWebUrl();?>')" value="找回密码"/>				
	</form>
</div>
<!--content end-->

<script>
	
</script>