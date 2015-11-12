<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />

<!--content start-->
<!--2015-6-3 add 唐小莉 我的优惠券-->
<dd class="coupon">
	<p><a href="<?php echo dy::getWebUrl();?>/default/index">首页</a>&gt;&gt;<a href="javascript:;">个人中心</a>&gt;&gt;<span>我的优惠券</span></p>
	<h4>我的优惠券</h4>
	<div class="couponCon">
		<form>
			<b>我的推荐码：<?=$act['activity']?></b>
			<p>
				<input  placeholder="请输入推荐人的推荐码" type="text" id="RecAct" placeholder="" />
				<input type="button" onclick="Recact('<?php echo dy::getWebUrl();?>')" value="添加到我的优惠券" />
			</p>
			<span style="color:red;">Tips:将我的推荐码推荐给新用户即可获得推荐奖励金额【<?=$money['value2'];?>】元。在被推荐用户首次在美食帮消费后即可到账！
</span>
		</form>
	</div>
	<b style="margin-left:20px; color:#0aa39a;">优惠金额：<?=$act['money']?> 元</b>
	<span style="display:none;">您还没有优惠券哦</span>
	<ul class="couponList">
		<li><h5>优惠券名称</h5></li>
		<li><h5>使用次数</h5></li>
		<li><h5>使用说明</h5></li>
		<li><h5>截止日期</h5></li>
	</ul>
	<?php foreach($row as $v):?>
	<ul class="couponInfo">
		<?php if($v['type'] == 1 || $v['type'] == 3){?>
		<li><span><?=$v['value2']?>元券</span></li>
		<?php }else{?>
		<li><span><?=$v['ac_name']?></span></li>
		<?php }?>
		<li><span><?=$v['numbers']?></span></li>
		<li><span class="<?php if(strlen($v['ac_content']) > 60){echo 'couponInfo-child';}else{echo '';}?>"><?=$v['ac_content']?></span></li>
		<li><span><?=date('Y-m-d', $v['end_time'])?></span></li>
	</ul>
	<?php endforeach;?>
</dd>
<!--2015-6-3 add 唐小莉 我的优惠券-->

<!--content end-->
<script>
	function Recact(url_1){
		var reccode = document.getElementById('RecAct').value;
		
			$.ajax({
				"type" : "post",
				"url"  : url_1+"/person/activitysub",
				"dataType" : "json",
				"data" : {
					reccode  : reccode,
				},
				"success" : function ( data ){
					if(data == 1){
						dialogCue('领取成功');
						location.reload();
					}else{
						dialogCue('已领取或已过期');
					}
				}
			});	
	}
</script>
