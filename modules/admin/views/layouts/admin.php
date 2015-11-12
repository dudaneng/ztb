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
<title>后台管理-<?php echo $session = Yii::$app->session->get('setting');?></title>
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/public/admin/css/pintuer.css">
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/public/admin/css/admin.css">
<script src="<?php echo dy::getWebUrl();?>/public/admin/js/jquery.js"></script>
<script src="<?php echo dy::getWebUrl();?>/public/admin/js/pintuer.js"></script>
<script src="<?php echo dy::getWebUrl();?>/public/admin/js/respond.js"></script>
<script src="<?php echo dy::getWebUrl();?>/public/admin/js/admin.js"></script>
<link rel="shortcut icon" href="<?php echo dy::getWebUrl();?>/themes/default/public/favicon.ico" />
<link rel="bookmark" href="<?php echo dy::getWebUrl();?>/themes/default/public/favicon.ico" type="image/x-icon"　/>

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
			<a href="javascript:" target="_blank"><img src="<?php echo dy::getWebUrl();?>/public/admin/images/logo.png" width='90' height='40' alt="后台管理系统" /></a>
		</div>
	</div>
	<div class="righter nav-navicon" id="admin-nav">
		<div class="mainer">
			<div class="admin-navbar">
				<span class="float-right"> <a class="button button-little bg-main" href="<?php echo Url::to(['/default/index']); ?>" target="_blank">前台首页</a> 
				<a class="button button-little bg-yellow" href="<?php echo Url::to(['/site/logoutadmin']); ?>">注销登录</a>
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
				$cls9 = '';
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
					case "cabinet":
					case "area": 
						$cls1 = ""; $cls2 = ""; $cls3 = ""; $cls4 = ""; $cls5 = "";$cls6="active";break;
					case "order": 
						$cls7="active";break;
					case "activity": 
						$cls8="active";break;
					case "cabinet": 
						$cls9="active";break;
				}
				?>
				<ul class="nav nav-inline admin-nav">
					<li class="<?=$cls1?>"><a href="<?php echo Url::to(['default/index']); ?>" class="icon-home"> 开始</a>
						
					</li>
					<li class="<?=$cls2?>"><a href="<?php echo Url::to(['setting/index']); ?>" class="icon-cog"> 系统设置</a>
						<ul>
							<li class="active"><a href="javascript:">系统设置</a></li>
						</ul>
					</li>
					<li class="<?=$cls3?>"><a href="<?php echo Url::to(['goods/index']); ?>" class="icon-file-text"> 业务管理</a>
					<?php
					/**
					 * 20050410 add by ygd 导航样式处理 可根据需求更改样式
					**/
					//$action = Yii::$app->controller->action->id;	//获取当前action名称
					$ctrl_son = Yii::$app->controller->id;	//获取当前controller名称
					$cls_son1 = '';
					$cls_son2 = '';
					$cls_son3 = '';
					$cls_son4 = '';
					$cls_son5 = '';
					$cls_son6 = '';
					switch($ctrl_son){
						case "newstype": 
							$cls_son1 = "active"; $cls_son2 = ""; $cls_son3 = ""; $cls_son4 = "";$cls_son5 = "";$cls_son6 = "";break;
						case "news": 
							$cls_son1 = ""; $cls_son2 = "active"; $cls_son3 = ""; $cls_son4 = "";$cls_son5 = "";$cls_son6 = "";break;
						case "goodstype":
							$cls_son1 = ""; $cls_son2 = ""; $cls_son3 = "active"; $cls_son4 = "";$cls_son5 = "";$cls_son6 = "";break;
						case "goods": 
							$cls_son1 = ""; $cls_son2 = ""; $cls_son3 = ""; $cls_son4 = "active";$cls_son5 = "";$cls_son6 = "";break;
						case "adtype":
							$cls_son1 = ""; $cls_son2 = ""; $cls_son3 = ""; $cls_son4 = "";$cls_son5 = "active";$cls_son6 = "";break;
						case "ad":
							$cls_son1 = ""; $cls_son2 = ""; $cls_son3 = ""; $cls_son4 = "";$cls_son5 = "";$cls_son6 = "active";break;
					}
					$action = Yii::$app->controller->action->id;	//获取当前action名称
					if($ctrl_son == 'ad'){
						switch($action){
							case "updatetype":
							case "addtype":
							case "adtype":
								$cls_son1 = ""; $cls_son2 = ""; $cls_son3 = ""; $cls_son4 = "";$cls_son5 = "active";$cls_son6 = "";break;
							case "update":
							case "add":
							case "index":
								$cls_son1 = ""; $cls_son2 = ""; $cls_son3 = ""; $cls_son4 = "";$cls_son5 = "";$cls_son6 = "active";break;
						}
					}
					?>
						<ul>
							<li class="<?php echo $cls_son1?>"><a href="<?php echo Url::to(['newstype/index']); ?>">文章类型</a></li>
							<li class="<?php echo $cls_son2?>"><a href="<?php echo Url::to(['news/index']); ?>">文章管理</a></li>
							<li class="<?php echo $cls_son3?>"><a href="<?php echo Url::to(['goodstype/index']); ?>">商品类型</a></li>
							<li class="<?php echo $cls_son4?>"><a href="<?php echo Url::to(['goods/index']); ?>">商品管理</a></li>
							<li class="<?php echo $cls_son5?>"><a href="<?php echo Url::to(['ad/adtype']); ?>">广告类型</a></li>
							<li class="<?php echo $cls_son6?>"><a href="<?php echo Url::to(['ad/index']); ?>">广告管理</a></li>
						</ul>
					</li>
					<li class="<?=$cls6?>"><a href="<?php echo Url::to(['area/index']); ?>" class="icon-shopping-cart"> 区域管理</a>
						<?php
						/**
						 * 20050410 add by xiaozhu 导航样式处理 可根据需求更改样式
						**/
						$action = Yii::$app->controller->action->id;	//获取当前action名称
						$ctrl_son = Yii::$app->controller->id;	//获取当前controller名称
						//$action = '';
						switch($action){
							case "index": 
								$cls_son1 = "active"; $cls_son2 = "";break;
							case "restaurant": 
								$cls_son2 = "active"; $cls_son1 = "";break;	
						}
						?>
						<ul>
							<li class="<?php echo $cls_son1?>"><a href="<?php echo Url::to(['area/index']); ?>">区域管理</a></li>
							<li class="<?php echo $cls_son2?>"><a href="<?php echo Url::to(['area/restaurant']); ?>">自提点管理</a></li>
						</ul>
					</li>
					<li class="<?=$cls7?>"><a href="<?php echo Url::to(['order/index?type=2']); ?>" class="icon-shopping-cart"> 订单管理</a>
						<?php
						/**
						 * 20050410 add by xiaozhu 导航样式处理 可根据需求更改样式
						**/
						$action = Yii::$app->controller->action->id;	//获取当前action名称
						//$ctrl_son = Yii::$app->controller->id;	//获取当前controller名称
						$type = Yii::$app->request->get('type'); //获取type的值
						
						$cls_son1 = '';
						$cls_son2 = '';
						$cls_son3 = '';
						$cls_son4 = '';
						switch($type){
							case "1": 
								$cls_son1 = "active";break;
							case "2": 
								$cls_son2 = "active";break;
							case "3": 
								$cls_son3 = "active";break;
							case "4": 
								$cls_son4 = "active";break;	
						}
						?>
						<ul>
							<li class="<?php echo $cls_son2?>"><a href="<?php echo Url::to(['order/index?type=2']); ?>">进行中订单</a></li>
							<li class="<?php echo $cls_son1?>"><a href="<?php echo Url::to(['order/index?type=1']); ?>">未付款订单</a></li>
							<li class="<?php echo $cls_son3?>"><a href="<?php echo Url::to(['order/index?type=3']); ?>">已完成订单</a></li>
							<li class="<?php echo $cls_son4?>"><a href="<?php echo Url::to(['order/index?type=4']); ?>">已取消订单</a></li>
						</ul>
					</li>
					<li class="<?=$cls8?>"><a href="<?php echo Url::to(['activity/index?type=1']); ?>" class="icon-shopping-cart"> 活动管理</a>
						<?php
						/**
						 * 20050410 add by xiaozhu 导航样式处理 可根据需求更改样式
						**/
						//$action = Yii::$app->controller->action->id;	//获取当前action名称
						$ctrl_son = Yii::$app->controller->id;	//获取当前controller名称
						$type = Yii::$app->request->get('type'); //获取type的值
						
						$cls_son1 = '';
						switch($type){
							case "1": 
								$cls_son1 = "active";break;
							case "2": 
								$cls_son2 = "active";break;
							case "3": 
								$cls_son3 = "active";break;
						}
						?>
						<ul>
							<li class="<?php echo $cls_son1?>"><a href="<?php echo Url::to(['activity/index?type=1']); ?>">优惠券</a></li>
							<li class="<?php echo $cls_son2?>"><a href="<?php echo Url::to(['activity/index?type=2']); ?>">现金券</a></li>
							<li class="<?php echo $cls_son3?>"><a href="<?php echo Url::to(['activity/index?type=3']); ?>">推荐注册</a></li>
						</ul>
					</li>
					
					<li class="<?=$cls9?>" style="display:none;"><a href="<?php echo Url::to(['cabinet/index']); ?>" class="icon-user"> 储物柜管理</a>
						<?php
						/**
						 * 20050410 add by xiaozhu 导航样式处理 可根据需求更改样式
						**/
						$action = Yii::$app->controller->action->id;	//获取当前action名称
						$ctrl_son = Yii::$app->controller->id;	//获取当前controller名称
						$type = Yii::$app->request->get('type'); //获取type的值
						$cls_son1 = '';
						
						switch($action){
							case "index": 
								$cls_son1 = "active";break;
						}
						?>
						<ul>
							<li class="<?php echo $cls_son1?>"><a href="<?php echo Url::to(['cabinet/index']); ?>">储物柜管理</a></li>
						</ul>
					</li>
					
					<li class="<?=$cls4?>"><a href="<?php echo Url::to(['user/index?type=1']); ?>" class="icon-user"> 用户管理</a>
						<?php
						/**
						 * 20050410 add by xiaozhu 导航样式处理 可根据需求更改样式
						**/
						//$action = Yii::$app->controller->action->id;	//获取当前action名称
						$ctrl_son = Yii::$app->controller->id;	//获取当前controller名称
						$type = Yii::$app->request->get('type'); //获取type的值
						$cls_son1 = '';
						
						switch($type){
							case "1": 
								$cls_son1 = "active";break;
							case "2": 
								$cls_son2 = "active";break;
						}
						?>
						<ul>
							<li class="<?php echo $cls_son1?>"><a href="<?php echo Url::to(['user/index?type=1']); ?>">普通会员</a></li>
							<li class="<?php echo $cls_son2?>"><a href="<?php echo Url::to(['user/index?type=2']); ?>">快递员</a></li>
						</ul>
					</li>
					
					<li style="display:none;"><a href="#" class="icon-user"> 会员</a></li>
					<li style="display:none;"><a href="#" class="icon-file"> 文件</a></li>
					<li style="display:none;" class="<?=$cls5?>"><a href="<?php echo Url::to(['link/index']); ?>" class="icon-th-list"> 友情链接</a>
						<?php
						/**
						 * 20050410 add by xiaozhu 导航样式处理 可根据需求更改样式
						**/
						//$action = Yii::$app->controller->action->id;	//获取当前action名称
						$ctrl_son = Yii::$app->controller->id;	//获取当前controller名称
						$cls_son1 = '';
						switch($ctrl_son){
							case "link": 
								$cls_son1 = "active";break;
						}
						?>
						<ul>
							<li class="<?php echo $cls_son1?>"><a href="#">友情链接</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="admin-bread">
				<span></span>
				<ul class="bread">
					<li><a href="<?php echo Url::to(['default/index']); ?>" class="icon-home"> 开始</a></li>
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