<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="contetBox">
	<?php foreach($row as $v):?>
	<div class="contentTitle">
		<?=$v['goods_name']?>
	</div>
	<div class="contentImg">
		<img src="<?=dy::getImgOne($v['goods_show'])?>">
	</div>
	<div class="contentInfo">
		<h3><?=$v['goods_name']?></h3>
		<p><?=$v['goods_info']?></p>
		<p>编号：<?=$v['hs_code']?></p>
		<p>产地：<?=$v['origin']?></p>
		<p>配送说明：<?=$v['carry']?></p>
		<p>
			<span class="price" >￥<?=$v['price_vip']?></span>
			<div class="clear"></div>
		</p>
		<input type="hidden" id="BuyAllNumber" value="<?=$v['goods_num']?>">
		<p ><span class="number" ><div class="spinner">
			数量：
				<a class="Decrease" href="javascript:" onclick="return ChangeNumberDetail(1)"><i>-</i></a>
				<input onblur="ChangeNumberDetail(3)" id="DetailGoods" class="Amount" value="1">
				<a onclick="return ChangeNumberDetail(2)" href="javascrip:" class="DisIn"><i>+</i></a>
		</div></span></p>
		<p class="plus"><a href="javascript:void(0);" onclick="addToCartDetail('<?php echo dy::getWebUrl();?>', <?=$v['id']?>)">加入购物车</a></p>
		<p class="plus" style="display:none;"><a href="<?php echo dy::getWebUrl();?>/myweb/goods/cart">查看购物车</a></p>
	</div>
	<?php endforeach;?>
	<div class="clear"></div>
	<div class="goodsIntro">
		<h3>商品介绍</h3>
		<div class="introInfo">
			<?=$v['goods_content']?>
		</div>
	</div>
	<div class="foodGuarantee">
		<h3>食材保证</h3>
		<div class="guaranteeInfo">
			<img src="<?=dy::getImgOne($v['sel_food'])?>">
		<div class="clear"></div>
	</div>
	</div>
	
	<div class="clear"></div>
</div>

<!--content end-->
<script>
/**							
 * 20150608 add by dudanfeng 1  购物车添加	
 **/
/******************** 1 ********************/
function addToCart1(id, url_1){
	var number = document.getElementById('CartNumbers').innerHTML;
	var aa = parseFloat(number)+1;
	
	$.ajax( {
		"type" : "post",
		"url"  : url_1+"/goods/cartadd",
		"dataType" : "json",
		"data" : {
			id  : id,
		},
		"success" : function ( data ){
			if(data > 0){
				dialogCue("加入成功!");
				
				document.getElementById('CartNumbers').innerHTML = aa;
			}else if(data == 0){
				window.location.href=url_1+"/login/index";
			}else if(data == -1){
				dialogCue("已加入!");
			}
		}
	});	
}
/******************** 1 ********************/

</script>