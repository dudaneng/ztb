<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="editTitle">
	登录
</div>
<div class="editBox">
	<form  method="post" id="userLogin" action="<?php echo dy::getWebUrl();?>/myweb/login/login">
		<div class="item">
			<span>*</span>手机号：
		</div>
		<input type="text" onfocus="userIdFocus()" id="user1" name="user" value="<?=$user?>" placeholder="请输入手机号" />
        <p id="user" class="color" style="text-align: left; margin-top: 10px;display:none;">该用户名不存在！</p>
		
		<div class="item">
			<span>*</span>密码：
		</div>
		<input type="password" id="password1" name="user_password" onfocus="userPasswordF()" placeholder="请输入密码" />
        <span id="password" class="color" style="text-align: left; margin-top: 10px;display:none;">密码错误，请重新输入</span>
		
		<p>
			<input type="checkbox" id="Checked" style="width:20px;" class="fl" checked />记住账号
			<input type="hidden" name="checked" value="" id="Hchecked">
			
			<a href="<?php echo dy::getWebUrl();?>/myweb/login/forget">忘记密码</a>
		
		</p>
		<input type="submit" class="color1" onclick="return loginBtn('<?php echo dy::getWebUrl();?>')" value="登录"/>
		<span id="LoginSub" class="color" style="text-align:left; margin-top:10px; display:none;">验证有误！</span>
		
		<input type="button" class="color2" onclick="Register()" value="注册"/>
		
	</form>
</div>
<!--content end-->
<script>
	function Register(){
		location.href = '<?php echo dy::getWebUrl();?>'+'/myweb/login/register';
	}
</script>