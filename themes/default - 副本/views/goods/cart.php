<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="con">
	<div class="cartCon">
    	<ul class="ShoppingProcess">
        	<li class="cartSlected">我的购物车</li>
        	<li><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/shoppingCart1.png" width="284" height="40" /></li>
        	<li>核对订单信息</li>
        	<li><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/shoppingCart4.png" width="284" height="40" /></li>
        	<li>成功提交订单</li>
        </ul>
        <div class="cartConTitle">
        	<h2><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/shoppingcart2.png" />购物车</h2>
            <span>请选择取菜日期：</span>
			<select id="SelectTime">
            	<?php foreach($time as $v):?>
				<option value="<?=$v?>"><?=date('Y-m-d',$v)?></option>
				<?php endforeach;?>
            </select>
        </div>
        <div>
            <ul class="cartListName">
                <li><label><input class="check-all" type="checkbox" name="checkall"/></label></li>
                <li>商品图片</li>
                <li>商品名称</li>
                <li>商品编号</li>
                <li>单价</li>
                <li>数量</li>
                <li>总计</li>
                <li>删除</li>
            </ul>
            <?php if($row){?>
			<?php foreach($row as $v):?>
			<ul class="cartListInfo">
                <li><label><input class="ids" name="id[]"  type="checkbox" value="<?=$v['id']?>"/></label></li>
                <li><a href="<?php echo dy::getWebUrl();?>/goods/detail?id=<?=$v['goods_id']?>"><img src="<?=dy::getImgOne($v['goods_show'])?>"/></a></li>
                <li><a href="<?php echo dy::getWebUrl();?>/goods/detail?id=<?=$v['goods_id']?>"><?=$v['goods_name']?></a></li>
                <li><span><?=$v['hs_code']?></span></li>
                <li><span><?=$v['price_vip']?></span></li>
                <li>
					<a style="padding:3px 9px; position:relative; left:5px; border:1px solid #ccc; border-right:0;" href="javascript:" onclick="return ChangeNumber(<?=$v['id']?>, 1)">-</a>
					<input onblur="ChangeNumber(<?=$v['id']?>, 3)" id="CatrGoodsNum<?=$v['id']?>" style="border:1px solid #ccc; width:45px; text-align:center; height:25px;" value="<?=$v['goods_number']?>">
				    <a onclick="return ChangeNumber(<?=$v['id']?>, 2)" href="javascrip:" style="padding:3px 7px;  position:relative; right:5px;  border:1px solid #ccc; border-left:0;">+</a>
				</li>
 			    <!--
				<li><u id="d" class="Spinner"></u></li>
                -->
				<li><span id="GoodsPrice<?=$v['id']?>"><?=$v['price_vip']*$v['goods_number']?></span></li>
                <li><a class="ajax-get confirm" href="<?php echo dy::getWebUrl();?>/goods/cartdelete?id=<?=$v['id']?>"><b><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/shoppingcart3.png" /></b></a></li>
			</ul>
			<input type="hidden" id="GoodsNUM<?=$v['id']?>" value="<?=$v['goods_num']?>">
			<input type="hidden" id="AreaId" value="<?php if(Yii::$app->request->cookies->get('res_id') != ''){echo Yii::$app->request->cookies->get('res_id')->value;}else{ echo "";} ?>">
			<?php endforeach;?>
			<p>
            	<a href="<?php echo dy::getWebUrl();?>/goods/cartdelete" target-form="ids" class="ajax-post confirm"><img src="<?php echo dy::getWebUrl();?>/themes/default/public/default/images/shoppingcart3.png" /><span>删除选中的商品</span></a>
            </p>
			
            <div class="cartSubmit">
            	<span>应付总额：<b>¥</b><b id="AllPrice"><?=$price;?></b></span>
                <i><a href="<?php echo dy::getWebUrl();?>/default/index">返回继续订餐</a><a href="javascript:" onclick="return CheckButton('<?php echo dy::getWebUrl();?>')">去结账</a></i>
            </div>
			<?php }else{?>
				<div class="cartListInfoNot">
					<span>您的购物车内没有添加任何商品！</span>
					<br>
					<a class="orderPayGet1" href="<?php echo dy::getWebUrl();?>/default/index">开始订餐</a>
				</div>
			<?php };?>
        </div>
    </div>
</div>

<!--content end-->
