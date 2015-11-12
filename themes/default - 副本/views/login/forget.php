<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/forget.js"></script>

<!--content start-->
<div class="con">
	<div class="loginCon">
    	<div class="loginConLeft">
        	<p><a href="<?php echo dy::getWebUrl();?>/default/index">首页</a>&gt;&gt;<a href="javascript:;">个人中心</a>&gt;&gt;<span>密码重置</span></p>
            <a href="javascript:;"><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/login.png" width="563" /></a>
        </div>
        
        <div class="retrievePassword">
        	<h3>密码重置</h3>
            <form>
            <ul>
            	<li><span>请输入您注册时使用的手机号，系统将发送一个验证码到该手机，请注意查收。</span></li>
                <li><i><b>*</b>注册手机号：</i>
					<input type="tel" id="ForgetPhone" onclick="ForgetPhoneO()" placeholder="" />
					<u id="ForgetPhoneText" style="display:none;">该手机号不存在！</u>
				</li>
                <li><p>
					<input type="text" id="FBCode" onclick="FBCodeOn()" onblur="ForGetPCO(this.value, '<?php echo dy::getWebUrl();?>')" placeholder="" />
					<input type="button" id="ForGetPhCo" onclick="ForgetPhCode(this,'<?php echo dy::getWebUrl();?>')" value="获取验证码" />
					<span id="ForgetCodeText" style="display:none; font-size:13px; color:#f27510;">验证码错误或已失效</span>
				</p></li>
                <li><input type="button" onclick="forgetPhoneBtn('<?php echo dy::getWebUrl();?>')" value="找回密码" /></li>
            </ul>
            </form>
        </div>
    </div>
</div>
<!--content end-->

<script>

</script>