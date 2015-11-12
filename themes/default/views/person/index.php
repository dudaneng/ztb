<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use components\dy;
?>
	<!--2015-6-3 add 唐小莉 我的订单-->
	<dd class="userOrder">
		<p><a href="<?php echo dy::getWebUrl();?>/default/index">首页</a>&gt;&gt;<a href="javascript:;">个人中心</a>&gt;&gt;<span>订单管理</span></p>
		<h4><?php if($type == 1){echo "所有的订单";}else if($type == 2){echo "未付款订单";}else if($type == 3){echo "进行中的订单";}else if($type == 4){echo "已完成订单";}?></h4>
		<div style="display:none;">您暂时还没有订单哦，马上去<a href="javascript:;">下单</a>吧！</div>
		
		<ul class="userOrderList">
			<li><h5>订单号</h5></li>
			<li><h5>订单商品</h5></li>
			<li><h5>提取码</h5></li>
			<li><h5>收货人</h5></li>
			<li><h5>合计</h5></li>
			<li><h5>状态</h5></li>
			<li><h5>取菜时间</h5></li>
			<li><h5>操作</h5></li>
		</ul>
		<?php if($page != ''){?>
		<?php foreach($row as $k => $v):?>
		<ul class="userOrderInfo">
			<li><span><?=$v['order_sn']?></span></li>
			<li>
				<?php foreach($v['goods_id'] as $key => $vol):?>
				<?php if($key<3):?>
				<a href="<?php echo dy::getWebUrl();?>/goods/detail?id=<?=$vol['id']?>"><img src="<?=dy::getImgOne($vol['goods_show'])?>" width="53" height="53" title="<?=$vol['goods_name']?>" /></a>
				<?php endif;?>
				<?php endforeach;?>
			</li>
			<li><b><?=$v['user_code']?></b></li>
			<li><span><?=$v['user_id']?></span></li>
			<li><span>¥<?=$v['price_all']?></span></li>
			<li><span>
			<?php if($v['status'] == 1){
				echo ('待付款');
			}else if($v['status'] == 2){
				echo ('已取消');
			}else if($v['status'] == 3){
				echo ('已取消');
			}else if($v['status'] == 4){
				echo ('已付款');
			}else if($v['status'] == 7){
				echo ('货已到');
			}else if($v['status'] == 9){
				echo ('已完成');
			}
			?>
			</span></li>
			<li><p style="line-height:40px;"><?=date('Y-m-d', $v['put_time'])?></p></li>
			<li>
				<?php if($v['status'] == 1){?>
				<a class="ajax-get confirm" href="<?php echo dy::getWebUrl();?>/person/forbid?id=<?=$v['id']?>&type=1">取消</a>
				<a href="<?php echo dy::getWebUrl();?>/goods/paysub?id=<?=$v['id']?>">付款</a>
				<?php }else if($v['status'] == 2 || $v['status'] == 3){?>
				<a class="ajax-get confirm" href="<?php echo dy::getWebUrl();?>/person/forbid?id=<?=$v['id']?>&type=3">删除</a>
				<?php }else if($v['status'] >= 4 && $v['status'] < 9){?>
				<a class="ajax-get confirm" href="<?php echo dy::getWebUrl();?>/person/forbid?id=<?=$v['id']?>&type=2">确认收货</a>
				<?php }?>
				<a href="<?php echo dy::getWebUrl();?>/person/orderinfo?id=<?=$v['id']?>">详情</a>
			</li>
		</ul>
		<?php endforeach;?>
		<?php }else{?>
		 <ul style="height:50px;" class="userOrderInfo">
			<br/>
			<span style="padding:10px 10px; color:#333; font-size:14px;">你还没有购买过本店商品</span>
		</ul>
		<?php }?>
		<?=$page?>
		
	 </dd>
	 <div style="margin-left:280px;">
	 <b style="color:red;margin-top:-20px;">温馨提示：<?=$time_set?></b>
	 </div>
	<!--2015-6-3 add 唐小莉 我的订单-->

