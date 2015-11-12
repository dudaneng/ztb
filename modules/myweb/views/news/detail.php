<?php
use yii\helpers\Html;
use components\dy;

?>

<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="detailsBox">
	<?php foreach($news as $v):?>
	<div class="detailsInfo">
		<h4><?=$v['news_title']?></h4>
		<?=$v['news_content']?>
	</div>
	<?php endforeach;?>
</div>