<?php 
use yii\helpers\Html;
use components\dy;
?>

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
						<div class="label"><label>大区域</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" class="input" id="sitename" name="news_author" size="50" value="<?=$area_big['area_name']?>" placeholder="请填写文章作者" data-validate="required:请填写文章作者" />
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>中区域</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="read_count" value="<?=$area_middle['area_name']?>" size="50" placeholder="请填写阅读次数" />
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">商圈</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="sort" value="<?=$area_small['area_name']?>" size="50" placeholder="请填写排列位置,越大越排前" />
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">自提点</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="sort" value="<?=$rest['address']?>" size="50" placeholder="请填写排列位置,越大越排前" />
						</div>
					</div>
					<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/></div>
				</form>
			</div>
		</div>
    </div>
    <p class="text-right text-gray"></p>
</div>

