<?php 
use yii\helpers\Url;
use components\dy;

/**微信分享**/
header("Content-type: text/html; charset=utf-8");

/* require_once(dy::getWebUrl().'/components/weixin.class.php');
$weixin = new class_weixin();
$signPackage = $weixin->GetSignPackage();

$news_info = dy::getWeixinSign();
$news = array("Title" =>"$news_info[title]", "Description"=>"成都美食帮", "PicUrl" =>"$news_info[pic]", "Url" =>"$news_info[url]");    
/**微信分享**/
?>

<?php $data = $this->context->menu;?>
<?php $numbers = $this->context->numbers;?>
<?php $setting = $this->context->setting;?>
<?php $this->beginPage();?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title><?=$setting['seo_title']?></title>
<meta name="Keywords" content="<?=$setting['seo_keywords']?>">
<meta name="Description" content="<?=$setting['seo_describe']?>">

<link rel="stylesheet" type="text/css" href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/swiper3.07.min.css">
<script src="<?php echo dy::getWebUrl();?>/modules/myweb/public/js/jquery-2.1.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo dy::getWebUrl();?>/modules/myweb/public/js/demo.js" type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog.css">
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/default.css">
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-min.js"></script>
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/artDialog.min.js"></script>
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-plus-min.js"></script>

<script src="<?php echo dy::getWebUrl();?>/modules/myweb/public/js/home.js" type="text/javascript" charset="utf-8"></script>
<!--Swiper3.0.4-->
</head>
<body>

<!--content start-->
<?= $content ?>
<!--content end-->

<!--footer start-->
<div class="footer">
	<div class="nav">
		<ul class="nav-main">
			<li class="imte">
				<a href="<?php echo dy::getWebUrl();?>/myweb/default/index" class="home">
					<p>首页</p>
				</a>
			</li>
			<li class="imte">
				<a href="javascript:;" class="list">
					<p>分类</p>
				</a>
					<ul class="nav-bar1">
						<li><a href="<?php echo dy::getWebUrl();?>/myweb/default/index?id=-1">推荐产品</a></li>
						<?php foreach($data as $v):?>
						<li><a href="<?php echo dy::getWebUrl();?>/myweb/default/index?id=<?=$v['id']?>"><?=$v['type_name']?></a></li>
						<?php endforeach;?>
					</ul>
			</li>
			<li class="imte">
				<a href="<?php echo dy::getWebUrl();?>/myweb/goods/cart" class="carticon">
					<p>购物车</p>
					<div id="CartNumbers" class="cartNumber"><?php if($numbers){echo $numbers;}else{echo 0;}?></div>
				</a>
			</li>
			<li class="imte">
				<a href="<?php echo dy::getWebUrl();?>/myweb/person/index" class="user">
					<p>个人中心</p>
				</a>
			</li>
			<div class="clear"></div>
		</ul>
	</div>
</div>
<!--footer start-->

<?php $this->endBody() ?>

</body>
</html>

