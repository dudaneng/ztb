<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="editTitle">
	我的优惠券
</div>
<div class="coupons">
	<div class="getCoupons">
		<input type="text" id="RecAct" placeholder="" />
		<input type="button" onclick="Recact('<?php echo dy::getWebUrl();?>')" value="添加到我的优惠券" />
		<p style="color:red;">Tips:将我的推荐码推荐给新用户即可获得推荐奖励金额【<?=$money['value2'];?>】元。在被推荐用户首次在美食帮消费后即可到账！</p>
	</div>
	<div class="couInfo">
		<ul  class="coutitle">
			<li>优惠券名称</li>
			<li>使用说明</li>
			<li>使用次数</li>
			<li>截止日期</li>
		</ul>
		<?php foreach($row as $v):?>
		<ul>
			<?php if($v['type'] == 1 || $v['type'] == 3){?>
			<li><?=$v['value2']?>元券</li>
			<?php }else{?>
			<li><?=$v['ac_name']?></li>
			<?php }?>
			<?php if(strlen($v['ac_content']) > 36){?>
			<li><?php if(strlen($v['ac_content']) > 36){echo dy::msubstr($v['ac_content'], 0, 9);}else{echo $v['ac_content'];} ?><span onclick="LookContent('<?=$v['ac_content']?>')"><img src="<?php echo dy::getWebUrl();?>/modules/myweb/public/images/123321.png"></span></li>
			<?php }else{?>
			<li><?=$v['ac_content']?></li>
			<?php }?>
			<li><?=$v['numbers']?></li>
			<li><?=date('Y-m-d', $v['end_time'])?></li>
		</ul>
		<?php endforeach;?>
		
	</div>
</div>
<!--content end-->

<script>
	function Recact(url_1){
		var reccode = document.getElementById('RecAct').value;
		
			$.ajax({
				"type" : "post",
				"url"  : url_1+"/myweb/person/activitysub",
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
	
	function LookContent(con){
		alert(con);
	}
</script>
