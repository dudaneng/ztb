<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="con">
	<div class="loginCon">
    	<div class="loginConLeft">
        	<p><a href="<?php echo dy::getWebUrl();?>/default/index">首页</a>&gt;&gt;<a href="<?php echo dy::getWebUrl();?>/person/index">个人中心</a>&gt;&gt;<span>用户登陆</span></p>
            <a href="javascript:;"><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/login.png" width="563" /></a>
        </div>
        
        <div class="loginConRight">
        	<h3>用户登陆<span>没有账号？<a href="<?php echo dy::getWebUrl();?>/login/register">【马上注册】</a></span></h3>
            <form method="post" id="userLogin" action="<?php echo dy::getWebUrl();?>/login/login">
            <ul>
            	<li>
                	<p><b>*</b>手机号：</p>
                    <input type="text" onblur="userId(this.value)" onfocus="userIdFocus()" id="user1" name="user" value="<?=$user?>" placeholder="请输入手机号" />
                    <span id="user" style="text-align: left; margin-top: 10px;display:none;">该用户名不存在！</span>
                </li>
            	<li>
                	<p><b>*</b>密码：</p>
                    <input type="password" id="password1" name="user_password" onfocus="userPasswordF()" onblur="userPassword(this.value)" placeholder="请输入密码" />
                    <span id="password" style="text-align: left; margin-top: 10px;display:none;">密码错误，请重新输入</span>
                </li>
            	<li class="identifyingCode">
                    <input class="test" type="text" name="passcode" onblur="userCode()"  id="passcode" placeholder="填写验证码" />
					
                    <input class="test" style="height:31px;" type = "button" id="code" onclick="createCode()" value="点击获取验证码"/> 
					<span id="code1" style="text-align:left; margin-top:10px; display:none;">验证有误！</span>
				</li>
            	<li>
                    <input class="selected" id="checked" type="checkbox" placeholder="" checked />
					<input type="hidden" name="checked" value="" id="Hchecked">
                    <i>记住账号</i>
                    <a href="<?php echo dy::getWebUrl();?>/login/forget">忘记密码？</a>
                </li>
                <li>
                	<input class="loginBtn" type="submit" onclick="return loginBtn('<?php echo dy::getWebUrl();?>')" value="登陆" />
					<span id="LoginSub" style="text-align:left; margin-top:10px; display:none;">验证有误！</span>
                </li>
            </ul>
            </form>
        </div>
	</div>
</div>
<!--content end-->
<script>
	createCode();
</script>