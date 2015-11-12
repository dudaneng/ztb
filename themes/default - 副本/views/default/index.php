<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<?php $numbers = $this->context->numbers;?>
<!--content start-->
<!--banner start-->
<div class="flexslider">
	<ul class="slides">
		<?php foreach($banner as $k => $v):?>
		<li><a href="<?php if($v['ad_url']){echo ($v['ad_url']);}else{echo ('javascript:');}?>"><img src="<?=$v['index_pic']?>" width="100%" height="460" /></a></li>
		<?php endforeach;?>
	</ul>
</div>
<!--banner end-->
<div class="content">
	<h3>本周菜品<i>[<?=date('m-d', $week[0]).' 至 '.date('m-d', $week[1])?>]</i></h3>
    <div class="sortList" id="GoodsTypeList">
    	<h4>口味</h4>
        <ul>
			<li><a href="javascript:" id="TypeColor" onclick="GoodsType('', '<?php echo dy::getWebUrl();?>', 2)" class="active">全部种类</a></li>
			<li><a href="javascript:" id="TypeColorRecom" onclick="GoodsType('', '<?php echo dy::getWebUrl();?>', 1)">推荐产品</a></li>
			<?php foreach($goods_type as $v):?>
			<li><a href="javascript:" id="TypeColor<?=$v['id']?>" onclick="GoodsType(<?=$v['id']?>, '<?php echo dy::getWebUrl();?>', 2)"><?=$v['type_name']?></a></li>
			<?php endforeach;?>
		</ul>
	</div>
	
    <div class="search">
    	<form>
        	<input type="text" id="select_name" name="goods_name" placeholder="请在此处输入您心仪的商品" />
            <span></span>
            <a href="javascript:;" onclick="select('<?php echo dy::getWebUrl();?>')"><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/seachIcon.png" /></a>
        </form>
    </div>
	
    <div style="clear:both;"></div>
    <div class="goodsList" id="goodsList">
    	<ul>
        	<?php foreach($goods as $v):?>
			<li>
            	<a href="<?php echo dy::getWebUrl();?>/goods/detail?id=<?=$v['id']?>"><img src="<?=dy::getImgOne($v['goods_show'])?>"/></a>
                <div class="goodsListInfo">
                	<h5><a style="color:#333;" href="<?php echo dy::getWebUrl();?>/goods/detail?id=<?=$v['id']?>"><?=$v['goods_name']?></a></h5>
                    <span><?=$v['goods_info']?></span>
                    <p>¥<?=$v['price_vip']?><i>¥<?=$v['price_market']?></i></p>
                    <b><a href="javascript:" onclick="addToCart(<?=$v['id']?>, '<?php echo dy::getWebUrl();?>')">加入购物车</a></b>
                </div>
            </li>
			<?php endforeach;?>
		</ul>
    </div>
</div>
<!--content end-->
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/goTop.js"></script>
<div id="back-to-top">
	<a href="#top"></a>
    <a href="<?php echo dy::getWebUrl();?>/goods/cart"><span id="InCatrNumbers"><?php if($numbers){echo $numbers;}else{echo 0;}?></span></a>
</div>