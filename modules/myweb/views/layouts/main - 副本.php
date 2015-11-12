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
					<div id="CartNumbers" class="cartNumber"><?=$numbers?></div>
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

<!--微信分享-->
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
	wx.config({
		debug: false,
		appId: '<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		jsApiList: [
			// 所有要调用的 API 都要加到这个列表中
			'checkJsApi',
			'openLocation',
			'getLocation',
			'onMenuShareTimeline',
			'onMenuShareAppMessage'
		  ]
	});
</script>
<script>
	wx.ready(function () {
		//自动执行的
		wx.checkJsApi({
			jsApiList: [
				'getLocation',
				'onMenuShareTimeline',
				'onMenuShareAppMessage'
			],
			success: function (res) {
				//alert(JSON.stringify(res));
				// alert(JSON.stringify(res.checkResult.getLocation));
				// if (res.checkResult.getLocation == false) {
					// alert('你的微信版本太低，不支持微信JS接口，请升级到最新的微信版本！');
					// return;
				// }
			}
		});
		
		
		wx.onMenuShareAppMessage({
		  title: '<?php echo $news['Title'];?>',
		  desc: '<?php echo $news['Description'];?>',
		  link: '<?php echo $news['Url'];?>',
		  imgUrl: '<?php echo $news['PicUrl'];?>',
		  trigger: function (res) {
			// 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
			// alert('用户点击发送给朋友');
		  },
		  success: function (res) {
			 alert('已分享1');
		  },
		  cancel: function (res) {
			// alert('已取消');
		  },
		  fail: function (res) {
			// alert(JSON.stringify(res));
		  }
		});

		wx.onMenuShareTimeline({
		  title: '<?php echo $news['Title'];?>',
		  link: '<?php echo $news['Url'];?>',
		  imgUrl: '<?php echo $news['PicUrl'];?>',
		  trigger: function (res) {
			// 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
			// alert('用户点击分享到朋友圈');
		  },
		  success: function (res) {
			 alert('已分享');
		  },
		  cancel: function (res) {
			// alert('已取消');
		  },
		  fail: function (res) {
			// alert(JSON.stringify(res));
		  }
		});
	});

	wx.error(function (res) {
		alert(res.errMsg);
	});
 </script>
<!--微信分享-->
