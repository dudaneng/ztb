<?php 
use yii\helpers\Html;
use components\dy;
?>
<title>快递管理-<?php echo $session = Yii::$app->session->get('setting');?></title>
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/modules/express/public/css/pintuer.css">
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/modules/express/public/css/admin.css">
<script src="<?php echo dy::getWebUrl();?>/modules/express/public/js/jquery.js"></script>
<script src="<?php echo dy::getWebUrl();?>/modules/express/public/js/pintuer.js"></script>
<script src="<?php echo dy::getWebUrl();?>/modules/express/public/js/respond.js"></script>
<script src="<?php echo dy::getWebUrl();?>/modules/express/public/js/admin.js"></script>

<link rel="shortcut icon" href="<?php echo dy::getWebUrl();?>/themes/default/public/favicon.ico" />
<link rel="bookmark" href="<?php echo dy::getWebUrl();?>/themes/default/public/favicon.ico" type="image/x-icon"　/>

<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog.css">
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/default.css">
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-min.js"></script>
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/artDialog.min.js"></script>
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-plus-min.js"></script>

<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<strong>箱子</strong>
        </div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<form class="form-x" >
					<div class="form-group">
						<div class="label"><label for="siteurl">商圈</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="sort" value="<?=$area['area_name']?>" size="50" disabled placeholder="请填写排列位置,越大越排前" />
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">自提点</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="sort" value="<?=$rest['address']?>" size="50" disabled placeholder="请填写排列位置,越大越排前" />
						</div>
					</div>
					<?php foreach($row as $v):?>
					<div class="form-group">
						<div class="label"><label for="siteurl">柜子编号</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="sort" value="<?=$v['code']?>" size="50" disabled placeholder="请填写排列位置,越大越排前" />
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">箱子编号</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="sort" value="<?=$v['number']?>" size="50" disabled placeholder="请填写排列位置,越大越排前" />
						</div>
					</div>
					<?php endforeach;?>
				</form>
			</div>
		</div>
    </div>
    <p class="text-right text-gray"></p>
</div>

