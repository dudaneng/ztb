<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="con">
	<div class="registerCon">
    	<div class="registerConLeft">
        	<p><a href="<?php echo dy::getWebUrl();?>/default/index">首页</a>&gt;&gt;<a href="<?php echo dy::getWebUrl();?>/person/index">个人中心</a>&gt;&gt;<span>用户注册</span></p>
            <a href="javascript:;"><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/login.png" width="563" height="365" /></a>
        </div>
        
        <div class="registerConRight">
        	<h3>用户注册<span>我已有账号，立即<a href="<?php echo dy::getWebUrl();?>/login/index">【登陆】</a></span></h3>
            <form method="post" action="<?php echo dy::getWebUrl();?>/login/registersubmit">
            <ul>
            	<li>
                	<p><b>*</b>真实姓名：</p>
                    <input type="text" onfocus="UserAccount()" id="user_account" name="user_account" placeholder="请输入真实姓名！" />
                    <span id="user_account1" style="display:none;">请输入真实姓名！</span>
                </li>
            	<li>
                	<p><b>*</b>手机号码：</p>
                    <input type="text" onfocus="UserPhone()" id="user_phone" name="user_phone" placeholder="" />
                    <span id="user_phone1" style="display:none;">请输入正确的手机号！</span>
                </li>
            	
				<li style="display:<?php if($sms_set == 1){echo "block";}else{echo "none";}?>" class="identifyingCode">
                	<p><b>*</b>注册码验证：</p>
                    <input type="text" onblur="return CodePhoneNamber(this.value)" value="<?php if($sms_set == 1){echo "";}else{echo "1234";}?>" id="CodePhone4" placeholder="" />
                    <input type="button" onclick="return CodePhone(this)" id="CodePhone1" value="免费获取验证码" />
					<span id="CodePhone3" style="display:none;">验证码有误！</span>
                </li>
				<li>
                	<p><b>*</b>密码：</p>
                    <input type="password" name="user_password" id="user_password" placeholder="" />
                </li>
            	<li>
                	<p><b>*</b>确认密码：</p>
                    <input type="password" onfocus="Password()" name="password1" id="password" placeholder="" />
                    <span id="password1" style="display:none;">两次输入的密码不一致！</span>
                </li>
            	<li>
                    <input class="test" type="text" name="passcode" onblur="userCode()"  id="passcode" placeholder="填写验证码" />
					<input class="test" style="cursor:pointer; margin-top:2px;height:33px;" type = "button" id="code" onclick="createCode(this)" value="点击获取验证码"/> 
					<span id="code1" style="text-align:left; margin-top:10px; display:none;">验证有误！</span>
				</li>
            	<li>
                    <input class="selected" id="checked" type="checkbox" placeholder="" checked="checked" />
                    <a href="javascript:;">我已阅读并同意美食帮相关服务条款</a>
                </li>
                <li>
                    <input class="registerBtn" type="submit" onclick="return registerBtn()" value="注册" />
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