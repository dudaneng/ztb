<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/fpassword.js"></script>

<!--content start-->
<div class="con">
	<div class="loginCon">
    	<div class="loginConLeft">
        	<p><a href="javascript:;">首页</a>&gt;&gt;<a href="javascript:;">个人中心</a>&gt;&gt;<span>密码重置</span></p>
            <a href="javascript:;"><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/login.png" width="563" /></a>
        </div>
        
        <div class="retrievePassword">
        	<h3>密码重置</h3>
            <form>
            <ul class="step2">
                <li><i><b>*</b>新密码：</i><input type="password" id="FgPasswordNew" placeholder="" /></li>
                <li><i><b>*</b>确认密码：</i><input type="password" id="FgPasswordNew1" placeholder="" />
					<u id="FgPasswordNewText" style="display:none;">两次密码输入不一致！</u>
				</li>
                <li><input type="button" onclick="FgPasswordBtn('<?php echo dy::getWebUrl();?>')" value="找回密码" /></li>
            </ul>
            </form>
        </div>
    </div>
</div>
<!--content end-->

<script>
	
</script>