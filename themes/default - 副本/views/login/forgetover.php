<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />


<div class="con">
	<div class="loginCon">
    	<div class="loginConLeft">
        	<p><a href="javascript:;">首页</a>&gt;&gt;<a href="javascript:;">个人中心</a>&gt;&gt;<span>密码重置</span></p>
            <a href="javascript:;"><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/login.png" width="563" /></a>
        </div>
        
        <div class="step3"><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/bingo.png" />恭喜您，密码重置成功。马上去<a href="<?php echo dy::getWebUrl();?>/login/index">登录</a>吧！</div>
    </div>
</div>
