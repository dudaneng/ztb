<?php 
use yii\helpers\Html;
use components\dy;
?>

<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<strong>快递员信息</strong>
        </div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/news/update">
					<div class="form-group">
						<div class="label"><label>快递员性名</label></div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<input type="text" class="input" id="siteurl" name="news_title" size="50" value="<?=$express['user_name']?>"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>快递员手机号</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" class="input" id="sitename" name="news_author" size="50" value="<?=$express['user_phone']?>"/>
						</div>
					</div>
					<hr/>
					<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/>
				</form>
			</div>	
		</div>
	</div>
</div>
    <p class="text-right text-gray"></p>
</div>

