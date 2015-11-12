<?php
use yii\helpers\Html;
use components\dy;
use components\js;

header("Content-type: text/html; charset=utf-8");

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
