<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<strong>分类添加</strong>
        </div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<form method="post" class="form-x" id="test" action="<?php echo dy::getWebUrl();?>/admin/newstype/add" >
					<div class="form-group">
						<div class="label"><label>类名</label></div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<input type="text" class="input" id="siteurl" name="type_name" size="50" placeholder="请填写类名" data-validate="required:请填写类名" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">排列位置</label></div>
						<div class="button-group button-group-small radio">
							<input type="number" min="0" class="input" id="sitename" name="sort" size="50" placeholder="排列位置,越大越排前" />
						</div>
					</div>
					<div class="form-button"><input class="button bg-main ajax-post" type="submit" value="提交"/>
					<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/></div>
				</form>
			</div>
		</div>
    </div>
    <p class="text-right text-gray"></p>
</div>
