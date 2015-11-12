<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use components\dy;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>大业网-管理员登录</title>
    <link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/public/admin/css/pintuer.css">
    <link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/public/admin/css/admin.css">
    <script src="<?php echo dy::getWebUrl();?>/public/admin/js/jquery.js"></script>
    <script src="<?php echo dy::getWebUrl();?>/public/admin/js/pintuer.js"></script>
    <script src="<?php echo dy::getWebUrl();?>/public/admin/js/respond.js"></script>
    <script src="<?php echo dy::getWebUrl();?>/public/admin/js/admin.js"></script>
	<!--弹窗插件-->
	<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog.css">
	<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-min.js"></script>
	<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-plus-min.js"></script>
	<!--弹窗插件END-->
    <link type="image/x-icon" href="<?php echo dy::getWebUrl();?>/public/admin/favicon.ico" rel="shortcut icon" />
    <link href="<?php echo dy::getWebUrl();?>/public/admin/favicon.ico" rel="bookmark icon" />
</head>

<body onload="createCode();">
<div class="container">
    <div class="line">
        <div class="xs6 xm4 xs3-move xm4-move">
            <br /><br />
            <div class="media media-y">
                <a href="http://www.028daye.com" target="_blank"><img src="<?php echo dy::getWebUrl();?>/public/admin/images/logo.png" class="radius" alt="后台管理系统" /></a>
            </div>
            <br /><br />
            <form action="<?php echo dy::getWebUrl();?>/site/admin" id="test" action1="<?php echo dy::getWebUrl();?>/site/adminsubmit" method="post">
            <div class="panel">
                <div class="panel-head"><strong>大业网-管理员登录</strong></div>
                <div class="panel-body" style="padding:30px;">
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="text" class="input" name="admin" id="AdminUserId" placeholder="登录账号" data-validate="required:请填写账号,length#>=5:账号长度不符合要求" />
                            <span class="icon icon-user"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="password" class="input" name="password" placeholder="登录密码" data-validate="required:请填写密码,length#>=1:密码长度不符合要求" />
                            <span class="icon icon-key"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field">
                            <input type="text" class="input" name="passcode" id="passcode" placeholder="填写右侧的验证码" data-validate="required:请填写右侧的验证码" />
							<input type = "button" id="code" onclick="createCode()" class="passcode"/> 	
                        </div>
                    </div>
                </div>
                <div class="panel-foot text-center"><button  class="button button-block bg-main text-big" onclick = "return validate();">立即登录后台</button></div>
            </div>
            </form>
            <div class="text-right text-small text-gray padding-top">大业网，您值得信赖。</div>
        </div>
    </div>
</div>
</body>
</html>