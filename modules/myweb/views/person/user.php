<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />
<script src="<?php echo dy::getWebUrl();?>/modules/myweb/public/js/user.js" type="text/javascript" charset="utf-8"></script>

<!--content start-->
<div class="editTitle">
	编辑账户
</div>
<div class="editBox">
	<form>
		<div class="item"><span>*</span>用户名：</div>
		<input type="text" id="UseName" onfocus="UseNameC()" name="user_name" value="<?=$row['user_name']?>"/>
		<span style="display:none;" id="UseName1">用户名不能为空</span>
		
		<div class="item"><span>*</span>手机号码：</div>
		<input value="<?=$row['user_phone']?>" disabled />
		
		<div class="item"><span>*</span>电子邮箱：</div>
		<input type="email" id="Emial" onblur="ChangEmail(this.value)" name="user_email" value="<?=$row['user_email']?>" />
        <span style="display:none;" id="Emial1">邮箱格式不正确！</span>
		
		<input type="button" class="color1" onclick="UserSubmit('<?php echo dy::getWebUrl();?>')" value="保存修改"/>
	</form>
</div>
<!--content end-->
<script>
	
</script>