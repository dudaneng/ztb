<?php
use yii\helpers\Html;
use components\dy;
use components\js;

header("Content-type: text/html; charset=utf-8");
//echo Yii::$app->params['adminEmail'];
 
require_once(dy::getWebUrl().'/components/weixin.class.php');
$weixin = new class_weixin();
$signPackage = $weixin->GetSignPackage();

$news = array("Title" =>"222", "Description"=>"333", "PicUrl" =>'http://case2.dayehd.com/Upload/1435887465.png', "Url" =>'http://case2.dayehd.com/');    

?>

<!--content start-->
<div class="header">
	<div class="logo">
    	<img src="<?php echo dy::getWebUrl();?>/modules/myweb/public/images/logo.png">
    </div>
    <div class="search">
    	<a class="inner" id="Area1" href="<?php echo dy::getWebUrl();?>/myweb/default/area"><?php if(Yii::$app->request->cookies->get('area') != ''){echo Yii::$app->request->cookies->get('area')->value;}else{ echo "请选择自提点";} ?></a>
		<input type="hidden" id="areaButtonHd" value="<?php if(Yii::$app->request->cookies->get('area') != ''){echo Yii::$app->request->cookies->get('area')->value;}else{ echo "";} ?>" >
    </div>
</div>
<div class="banner">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <?php foreach($banner as $v):?>
		<div class="swiper-slide"><a href="<?php if($v['ad_url']){echo ($v['ad_url']);}else{echo ('javascript:');}?>"><img src="<?=$v['index_pic']?>"></a></div>
        <?php endforeach;?>
	  </div>
      <div class="swiper-pagination"></div>
    </div>
</div>
<div class="main">
	<div class="title">
        本周菜品&nbsp;<i><?=date('m-d', $week[0]).' 至 '.date('m-d', $week[1])?></i>
		<i style="float:right; margin-right:10px;">
		<?php if($goods_type_name){?>
		<?=$goods_type_name?>
		<?php }?>
		</i>
    </div>
	<?php foreach($goods as $v):?>
	<div class="infoBox">
        <a href="<?php echo dy::getWebUrl();?>/myweb/goods/detail?id=<?=$v['id']?>">
        	<img src="<?=dy::getImgOne($v['goods_show'])?>">
        </a>
        <h2><a href="<?php echo dy::getWebUrl();?>/myweb/goods/detail?id=<?=$v['id']?>"><?=$v['goods_name']?></a></h2>
        <p>￥<?=$v['price_vip']?></p>
        <div class="btn"><a href="javascript:void(0)" onclick="addToCart(<?=$v['id']?>, '<?php echo dy::getWebUrl();?>')">加入购物车</a></div>
	</div>
	<?php endforeach;?>
	<div class="clear"></div>
</div>
<div class="clear"></div>

<script src="<?php echo dy::getWebUrl();?>/modules/myweb/public/js/swiper3.07.min.js"></script>
<script type="text/javascript">
  var mySwiper = new Swiper('.swiper-container',{
    loop: true,
	autoplay: 3000,
	  pagination: '.swiper-pagination',
  });
</script>

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
			 alert('已分享2');
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
