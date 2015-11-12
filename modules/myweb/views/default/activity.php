<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>
<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="con">
	<div class="main">
    	<?php foreach($row as $v):?>
		<img src="<?php echo dy::getImgOne($v['ac_images']);?>">
		<?php endforeach;?>
    </div>
</div>
<!--content end-->
