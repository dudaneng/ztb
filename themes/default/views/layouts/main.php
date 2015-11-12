<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use components\dy;
use yii\web\Session;
use yii\web\Cookie;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $setting = $this->context->setting;?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?=$setting['seo_title']?></title>
    <meta name="keywords" content="<?=$setting['seo_keywords']?>">
    <meta name="description" content="<?=$setting['seo_describe']?>">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge"><!--强制ie最新渲染-->
    <meta name="renderer" content="webkit"><!--针对国内双核浏览器 强制使用webkit-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    
	<script type="text/javascript" src="/themes/default/public/default/js/a.js"></script>
	<script type="text/javascript" src="/themes/default/public/default/js/artDialog.js"></script>
	<script type="text/javascript" src="/themes/default/public/default/js/jquery.js"></script>
    <link href="/themes/default/public/default/css/a.css" rel="stylesheet" media="all">
    <link href="/themes/default/public/default/css/blue.css" rel="stylesheet">
	
	<link href="/plug/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="/plug/bootstrap/js/bootstrap.min.js"></script>
</head>
<body class="szt_front_body">
	<div class="" style="display: none; position: absolute;">
		<div class="aui_outer">
			<table class="aui_border">
				<tbody><tr>
					<td class="aui_nw"></td>
					<td class="aui_n"></td>
					<td class="aui_ne"></td>
				</tr>
				<tr>
					<td class="aui_w"></td>
					<td class="aui_c">
						<div class="aui_inner">
							<table class="aui_dialog">
								<tbody><tr>
									<td colspan="2" class="aui_header">
										<div class="aui_titleBar">
											<div style="cursor: move;" class="aui_title"></div>
											<a class="aui_close" href="javascript:/*artDialog*/;">×</a>
										</div>
									</td>
								</tr>
								<tr>
									<td style="display: none;" class="aui_icon">
										<div style="background: transparent none repeat scroll 0% 0%;" class="aui_iconBg"></div>
									</td>
									<td style="width: auto; height: auto;" class="aui_main">
										<div style="padding: 20px 25px;" class="aui_content"></div>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="aui_footer">
										<div style="display: none;" class="aui_buttons"></div>
									</td>
								</tr></tbody>
							</table>
						</div>
					</td>
					<td class="aui_e"></td>
				</tr>
				<tr>
					<td class="aui_sw"></td>
					<td class="aui_s"></td>
					<td style="cursor: se-resize;" class="aui_se"></td>
				</tr></tbody>
			</table>
		</div>
	</div>
	<!--顶部信息-->
	<div class="navbar-ezhew-set">
		<div class="container  ">
			<div class="row">
				<div class="col-md-12">
					<span class="front_top_a"><a href="javascript:">登录</a></span>
					<span class="front_top_a"><a href="javascript:">免费注册</a></span>
					<span class="pull-right text-right">
					<span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
					020-123456
					</span>
				</div>
			</div>
		</div>
	</div>
	
	<!--导航信息-->
	<div class="container navbar-nav-pr">
		<nav class="navbar navbar-default navbar-static-top navbar-nav-set">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand navbar-logo active_banner" href="http://ezhew.com/" title="试折淘"><img src="/themes/default/public/default/images/logo_w.png"></a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class=" "><a href="/goods">免费试用</a></li>
						<li class=" "><a href="javascript:">淘足迹</a></li>
						<li class=" "><a href="javascript:">试用排行</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">产品分类 <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="javascript:">实货</a></li>
								<li><a href="javascript:">礼物</a></li>
								<li><a href="javascript:">红包</a></li>
							</ul>
						</li>
						<li class=" "><a href="/helper">帮助中心</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right hidden-sm">
						<li class=" "><a href="javascript:">推荐有奖</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>

	<?= $content ?>
	
	<div class="szt_front_footer" xmlns="http://www.w3.org/1999/html">
		<div class="container " id="footer">
			<div class="row">
				<div class="col-md-8  marginTop10">
					<div class="col-md-4 g_foot-nav">
						<p class="mini_logo">
							<a href="javascript:" title="试折淘">
								<img src="/themes/default/public/default/images/logo_mini.png">
								<strong>xxxxx网络</strong>
							</a>
						</p>
						<p><a rel="nofollow" target="_blank" href="javascript:"><?=$setting['web_copyright']?></a></p>
						<p>? <?=$setting['web_icp']?> </p>
					</div>
					<div class="col-md-2 g_foot-nav marginTop10">
						<p><a href="http://ezhew.com/help/detail/12.html" target="_blank">关于我们</a></p>
						<p><a href="http://ezhew.com/help/detail/13.html" target="_blank">联系我们</a></p>
						<p><a href="http://ezhew.com/help/detail/14.html" target="_blank">人才招聘</a></p>
						<p><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=2850512762&amp;site=qq&amp;menu=yes" target="_blank">在线客服</a></p>
					</div>
					<div class="col-md-2 g_foot-nav marginTop10">
						<p><a href="http://ezhew.com/help/category/4/1" target="_blank">商家帮助</a></p>
						<p><a href="http://ezhew.com/help/category/5/1" target="_blank">试客帮助</a></p>
						<p><a href="http://ezhew.com/help/category/14/1" target="_blank">站内公告</a></p>
					</div>
					<div class="col-md-2 g_foot-nav marginTop10">
						<p><a href="http://ezhew.com/system/goto_user_center" target="_blank">用户中心</a></p>
						<p><a href="http://ezhew.com/system/reg_2/2.html" target="_blank">商家入驻</a></p>
						<p><a href="http://ezhew.com/system/reg_2/1.html" target="_blank">试客注册</a></p>
					</div>
				</div>

				<div class="col-md-4 g_foot-nav_logo  marginTop10">
					<h5 class="friend_title">合作伙伴/权威认证</h5>
					<p>
						<a href="http://www.pingan.com/" class="szt_front_pingan">平安银行</a>
					</p>
					<p style="overflow: hidden">
						<a href="http://webscan.360.cn/index/checkwebsite/url/ezhew.com" class="szt_front_360">360web检测</a>

						<a href="http://www.anquan.org/authenticate/cert/?site=ezhew.com&amp;at=business" class="szt_front_anquan marginLeft10">安全联盟</a>
					</p>
				</div>
			</div>
		</div>

		<div style="display: block; bottom: 50px;" class="right_control none" onclick="backTop();">
			<div class="right_control_warp">
				<div class="to_user_center" onclick="goto_user_center()">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<div class="to_top"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></div>
			</div>

		</div>
	</div>
</body>
</html>