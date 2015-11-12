<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />
<script src="<?php echo dy::getWebUrl();?>/modules/myweb/public/js/jquery-1.8.3.min.js"></script>
<!--content start-->
<div class="cart">
	<div class="cartTitle">
		<ul>
			<li>菜品图片</li>
			<li>菜品名称</li>
			<li>数量</li>
			<li>价格</li>
			<li>删除</li>
			<div class="clear"></div>
		</ul>
	</div>
	<?php if($row){?>
	<div class="cartInfo">
		<?php foreach($row as $v):?>	
		<ul>
			<li><a href="<?php echo dy::getWebUrl();?>/myweb/goods/detail?id=<?=$v['goods_id']?>"><img src="<?=dy::getImgOne($v['goods_show'])?>" style="width:50px; height:50px;"/></a></li>
			<li>
				<ul><li><a href="<?php echo dy::getWebUrl();?>/myweb/goods/detail?id=<?=$v['goods_id']?>"><?=$v['goods_name']?></a></li></ul>
				<ul><li>￥<?=$v['price_vip']?></li></ul>
			</li>
			<li>
				<a class="aclolor" href="javascript:" onclick="return ChangeNumber(<?=$v['id']?>, 1)">-</a>
				<input style="margin-bottom:6px;" onblur="ChangeNumber(<?=$v['id']?>, 3)" id="CatrGoodsNum<?=$v['id']?>" value="<?=$v['goods_number']?>">
				<a onclick="return ChangeNumber(<?=$v['id']?>, 2)" href="javascrip:" class="aclolor">+</a>
			</li>
			<li><span id="GoodsPrice<?=$v['id']?>"><?=$v['price_vip']*$v['goods_number']?></span>元</li>
			<li><a class="ajax-get confirm" href="<?php echo dy::getWebUrl();?>/myweb/goods/cartdelete?id=<?=$v['id']?>"><img src="<?php echo dy::getWebUrl();?>/modules/myweb/public/images/remove.png"></a></li>
			
			<input type="hidden" id="GoodsNUM<?=$v['id']?>" value="<?=$v['goods_num']?>">
			<input type="hidden" id="AreaId" value="<?php if(Yii::$app->request->cookies->get('res_id') != ''){echo Yii::$app->request->cookies->get('res_id')->value;}else{ echo "";} ?>">
			
			<div class="clear"></div>
		</ul>
		<?php endforeach;?>
	</div>
	<div class="choseTime">
		<span style="color:red;font-weight:bold;font-size:1.3em;margin-left:12px;">请选择取菜日期:</span>
		<select id="SelectTime" >
			<?php foreach($time as $v):?>
			<option value="<?=$v?>"><?=date('Y-m-d',$v)?></option>
			<?php endforeach;?>
		</select>
		<p style="float:right;margin-right:14px;">应付总金额：￥<b id="AllPrice" style="font-size:1.5em;"><?=$price;?></b></p>
	</div>
	<div class="clear"></div>
	<div class="cartBottom">
		
		<a style="width:94%;height:40px;line-height:40px;font-size:2em;" href="javascript:" onclick="return CheckButton('<?php echo dy::getWebUrl();?>')">去结算</a>
	</div>
	<?php }else{?>
	<div>
		<span class="cart03"><img src="<?php echo dy::getWebUrl();?>/modules/myweb/public/images/shoppingcart2.png">您的购物车内没有添加任何商品！</span>
		<a class="cartbtn" class="orderPayGet1" href="<?php echo dy::getWebUrl();?>/myweb/default/index">选择商品</a>
	</ul>
	<?php };?>
	<div class="clear"></div>
</div>
<!--content end-->
<script>
	/**
 * 2015-04-28 add by dudanfeng 1 ajax get请求		
 **/
/******************** 1 ********************/
$('.ajax-get').click(function(){
	var target;
	var that = this;
	if ( $(this).hasClass('confirm') ) {
		if(!confirm('确认要执行该操作吗?')){
			return false;
		}
	}
	
	if ( (target = $(this).attr('href')) || (target = $(this).attr('url')) ) {
		$.get(target).success(function(data){
			if(data == 1){
				location.reload();
			}else if(data == 2){
				dialogCue('操作成功');
				location.reload();
			}else if(data == 3){
				dialogCue('类型未启用！');
				location.reload();
			}else{
				alert('操作错误');
			}
		});
		return false;
	}
	return false;
});
/******************** 1 ********************/

</script>