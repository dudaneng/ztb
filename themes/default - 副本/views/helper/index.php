<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="con">
	<div class="helpCenter">
    	<div class="helpCenterNav">
        	<dl>
            	<dt>操作指南</dt>
                <dd><a href="<?php echo dy::getWebUrl();?>/helper/index?id=24">网站订购流程</a></dd>
            	<dt>支付说明</dt>
                <dd><a href="<?php echo dy::getWebUrl();?>/helper/index?id=25">支付方式</a></dd>
                <dd><a href="<?php echo dy::getWebUrl();?>/helper/index?id=26">退订退款</a></dd>
            	<dt>配送取货</dt>
                <dd><a href="<?php echo dy::getWebUrl();?>/helper/index?id=27">配送时间 / 取货方式</a></dd>
                <dd><a href="<?php echo dy::getWebUrl();?>/helper/index?id=28">取货自提地址</a></dd>
            	<dt>关于我们</dt>
                <dd><a href="<?php echo dy::getWebUrl();?>/helper/index?id=29">关于美食帮</a></dd>
            	<dt>联系我们</dt>
                <dd><a href="<?php echo dy::getWebUrl();?>/helper/index?id=30">联系我们</a></dd>
            </dl>
        </div>
        
        <div class="helpCenterInfo">
        	<?php if($row){?>
			<h4><?=$row['news_title']?></h4>
            <div>
				<?=$row['news_content']?>
			</div>
			<?php }else{?>
				<div>暂无信息</div>
			<?php }?>
        </div>
    </div>
</div>

<!--content end-->
<script>
	
</script>