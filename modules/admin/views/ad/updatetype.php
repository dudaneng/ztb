<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<strong>类型编辑</strong>
        </div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<?php foreach($list as $v):?>
				<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/ad/updatetype">
					<div class="form-group">
						<div class="label"><label>广告类型名称</label></div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<input type="text" class="input" id="siteurl" name="position_name" size="50" value="<?=$v['position_name']?>" placeholder="请填写广告类型" data-validate="required:请填写广告类型" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">排列位置</label></div>
						<div class="button-group button-group-small radio">
							<input type="number" min="0" class="input" id="sitename" name="sort" size="50" value="<?=$v['sort']?>" placeholder="排列位置,越大越排前" />
						</div>
					</div>
					<div class="form-button"><input class="button bg-main ajax-post" type="submit" value="提交"/>
					<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/></div>
					<input type="hidden" class="input" name="id" value="<?=$v['id']?>" size="50" />
				</form>
				<?php endforeach;?>
			</div>
		</div>
    </div>
    <p class="text-right text-gray"></p>
</div>


<script>
	//UE.getEditor('editor');
	//UE.getEditor('images');
	
</script>

