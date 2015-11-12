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
<?php $data = $this->context->menu;?>
<?php $numbers = $this->context->numbers;?>
<?php $setting = $this->context->setting;?>
<?php $this->beginPage() ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>">
<title><?=$setting['seo_title']?></title>
<meta name="Keywords" content="<?=$setting['seo_keywords']?>">
<meta name="Description" content="<?=$setting['seo_describe']?>">
<link rel="shortcut icon" href="<?php echo dy::getWebUrl();?>/themes/default/public/favicon.ico" />
<link rel="bookmark" href="<?php echo dy::getWebUrl();?>/themes/default/public/favicon.ico" type="image/x-icon"　/>

<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/areaLayer.js"></script>
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/areaSelect.js"></script>
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/banner.js"></script>
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/jquery.flexslider-min.js"></script>

<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/home.js"></script>

<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog.css">
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/default.css">
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-min.js"></script>
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/artDialog.min.js"></script>
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-plus-min.js"></script>

<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/index.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!--背景遮罩层-->
<div id="fade" class="black_overlay"></div>
<!--背景遮罩层-->
<!--弹出层内容-->
<div id="MyDiv" class="white_content">
	<span class="close" id="Close" onclick="CloseDiv('MyDiv','fade')"><img style="cursor:pointer;" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/close.png" /></span>
    <div class="conList">
    	<h3>请选择您附近的自提点区域</h3>
    	<div class="areaList" id="areaWuhou">
        	<h4>所在区域：</h4>
            <ul>
                <?php foreach($data as $v):?>
				<li><a id="big<?=$v['id']?>" onclick="areabig(<?=$v['id']?>, '<?php echo dy::getWebUrl();?>/site/areaselect', 1)" href="javascript:;"><?=$v['area_name']?></a></li>
                <?php endforeach;?>
				<input type="hidden" id="TypeUrl" value="<?php echo dy::getWebUrl();?>/site/areaselect" />
			</ul>
        </div>
		<div id="area1" class="areaList" style="display:none;">
			<h4>所在商圈：</h4>
            <ul>
                <li></li>
                
        	</ul>
		</div>
    	<div id="area3" class="areaList" style="display:none;">
        	<h4>取菜点：</h4>
            <ul>
                <li></li>
            </ul>
        </div>
        <div id="area5" class="areaInfo" style="display:none;">
        	<ul>
            	<li></li>
            </ul>
        </div>
    </div>
</div>
<!--弹出层内容-->
<div class="header">
	<div class="headInfo">
        <a class="logo" href="<?php echo dy::getWebUrl();?>/default/index"><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/logo.png" width="232" height="85" /></a>
        <div class="nav">
            <ul>
                <li><a href="<?php echo dy::getWebUrl();?>/default/index">首页</a></li>
                <li><a href="<?php echo dy::getWebUrl();?>/person/index?type=3">我的订单</a></li>
                <li><a href="<?php echo dy::getWebUrl();?>/helper/index">帮助中心&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <?php if(dy::getLoginOn()){?>
				<li><a href="<?php echo dy::getWebUrl();?>/person/index?type=3">您好，<?php echo ($session = Yii::$app->session->get('user_name'));?>&nbsp;&nbsp;&nbsp;&nbsp;</a>&nbsp;<a href="<?php echo dy::getWebUrl();?>/login/logout">[退出]</a></li>
				<?php }else{?> 
				<li><a href="<?php echo dy::getWebUrl();?>/login/index">登陆&nbsp;</a><a>/</a>&nbsp;<a href="<?php echo dy::getWebUrl();?>/login/register">注册</a></li>
                <?php }?>
				<li><a href="<?php echo dy::getWebUrl();?>/goods/cart"><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/shoppingCart.png" /><span id="CartNumbers"><?php if($numbers){echo $numbers;}else{echo 0;}?></span></a></li>
                <div style="clear:both;"></div>
            </ul>
            <!--2015-5-27  add  唐小莉  自提点选择-->
            <div class="area">
                <img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/landMark.png" />
                <span></span>
                <input class="select" id="areaButton" type="button" value="<?php if(Yii::$app->request->cookies->get('area') != ''){echo Yii::$app->request->cookies->get('area')->value;}else{ echo "选取自提点";} ?>" onclick="ShowDiv('MyDiv','fade')" />
				<input type="hidden" id="areaButtonHd" value="<?php if(Yii::$app->request->cookies->get('area_id') != ''){echo Yii::$app->request->cookies->get('area_id')->value;}else{ echo "";} ?>" >
			</div>
            <!--2015-5-27  add  唐小莉  自提点选择-->
        </div>
    </div>
</div>

<!--content start-->
<?= $content ?>
<!--content end-->

<!--footer start-->
<div class="service">
	<img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/footerService.jpg">
</div>

<div class="footer">
	<p><?=$setting['web_copyright']?> <?=$setting['web_icp']?></p>
    <p>技术支持：<a href="http://028daye.com/" target="_blank" style="color:white;">大业互动网络</a>
	<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1255812359'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/stat.php%3Fid%3D1255812359%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
	</p>
</div>
<!--footer start-->
<?php $this->endBody() ?>

</body>
</html>
