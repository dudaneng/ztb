<?php 
use yii\helpers\Url;
use components\dy;
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title><?php echo $session = Yii::$app->session->get('setting');?>-快递-订单管理系统</title>
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/public/admin/css/pintuer.css">
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/public/admin/css/admin.css">
<script src="<?php echo dy::getWebUrl();?>/public/admin/js/jquery.js"></script>
<script src="<?php echo dy::getWebUrl();?>/public/admin/js/pintuer.js"></script>
<script src="<?php echo dy::getWebUrl();?>/public/admin/js/respond.js"></script>
<script src="<?php echo dy::getWebUrl();?>/public/admin/js/admin.js"></script>
<link type="image/x-icon" href="<?php echo dy::getWebUrl();?>/public/admin/favicon.ico" rel="shortcut icon" />
<link href="<?php echo dy::getWebUrl();?>/public/admin/favicon.ico" rel="bookmark icon" />

<script type="text/javascript" charset="utf-8" src="<?php echo dy::getWebUrl();?>/plug/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo dy::getWebUrl();?>/plug/ueditor/ueditor.all.min.js"></script>

<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog.css">
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/default.css">
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-min.js"></script>
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/artDialog.min.js"></script>
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-plus-min.js"></script>
</head>

<body>
	<div class="lefter">
		<div class="logo">
			<a href="http://www.028daye.com" target="_blank"><img src="<?php echo dy::getWebUrl();?>/public/admin/images/logo.png" alt="后台管理系统" /></a>
		</div>
	</div>
	<div class="righter nav-navicon" id="admin-nav">
		<div class="mainer">
			<div class="admin-navbar">
				<span class="float-right"> 
					<a class="button button-little bg-yellow" href="<?php echo Url::to(['/site/logoutuser']); ?>">注销登录</a>
				</span>
				<?php
				/**
				 * 20050410 add by ygd 导航样式处理 可根据需求更改样式
				**/
				$controller = Yii::$app->controller->id;	//获取当前controller名称
				$cls1 = '';
				$cls2 = '';
				$cls3 = '';
				$cls4 = '';
				$cls5 = '';
				$cls6 = '';
				$cls7 = '';
				$cls8 = '';
				switch($controller){
					case "default": 
						$cls1 = "active"; $cls2 = ""; $cls3 = ""; $cls4 = ""; $cls5 = "";break;
					case "setting": 
						$cls1 = ""; $cls2 = "active"; $cls3 = ""; $cls4 = ""; $cls5 = "";break;
					case "news": 
					case "goods":
					case "goodstype":
					case "newstype":
					case "ad":
						$cls1 = ""; $cls2 = ""; $cls3 = "active"; $cls4 = ""; $cls5 = "";break;
					case "user": 
						$cls1 = ""; $cls2 = ""; $cls3 = ""; $cls4 = "active"; $cls5 = "";break;
					case "link": 
						$cls1 = ""; $cls2 = ""; $cls3 = ""; $cls4 = ""; $cls5 = "active";break;
					case "area": 
						$cls1 = ""; $cls2 = ""; $cls3 = ""; $cls4 = ""; $cls5 = "";$cls6="active";break;
					case "order": 
						$cls7="active";break;
					case "activity": 
						$cls8="active";break;
				}
				?>
				<ul class="nav nav-inline admin-nav">
					<li class="<?=$cls1?>"><a href="javascript:" class="icon-home"> 快递-订单</a>
						<ul>
							<li><a href="javascript:">快递-订单</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="admin-bread">
				<span></span>
				<ul class="bread">
					<li><a href="javascript:" class="icon-home"> 开始</a></li>
					<li>后台首页</li>
				</ul>
			</div>
		</div>
	</div>

	<?= $content?>

	<div class="hidden">
		<script src="123" language="JavaScript"></script>
	</div>
</body>
</html>