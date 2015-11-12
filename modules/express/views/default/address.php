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
			<strong>自提点</strong>
        </div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/news/update">
					<div class="form-group">
						<div class="label"><label>用户名</label></div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<input type="text" class="input" id="siteurl" name="news_title" size="50" value="<?=$user['user_name']?>" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>用户手机号</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" class="input" id="sitename" name="news_author" size="50" value="<?=$user['user_phone']?>" placeholder="请填写文章作者" data-validate="required:请填写文章作者" />
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">商圈</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="sort" value="<?=$area['area_name']?>" size="50" placeholder="请填写排列位置,越大越排前" />
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">自提点</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="sort" value="<?=$rest['address']?>" size="50" placeholder="请填写排列位置,越大越排前" />
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
    <p class="text-right text-gray"></p>
</div>

