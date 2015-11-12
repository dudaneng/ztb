<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<strong>友情链接添加</strong>
        </div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<form method="post" class="form-x" id="test" action="<?php echo dy::getWebUrl();?>/admin/link/add">
					<div class="form-group">
						<div class="label"><label for="link_name">名称</label></div>
						<div class="field">
							<div class="button-group button-group-small">
								<input type="text" class="input" id="link_name" name="link_name" size="50" placeholder="请填写友情链接名称" data-validate="required:请填写友情链接名称" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="link_url">URL</label></div>
						<div class="field">
							<div class="button-group button-group-small">
								<input type="text" class="input" id="link_url" name="link_url" size="50" placeholder="请填写友情链接URL" data-validate="required:请填写友情链接URL,url:请填写正确的友情链接URL" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="link_logo">LOGO</label></div>
						<div class="field">
							<script id="editor" type="text/plain" name="link_logo" style="width:1024px;height:500px;"></script>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="sort">排列位置</label></div>
						<div class="field">
							<div class="button-group button-group-small">
								<input type="text" class="input" id="sort" name="sort" size="50" placeholder="排列位置,越大越排前" data-validate="required:请填写友情链接排序,number:请填写正确的友情链接排序" />
							</div>
						</div>
					</div>
					
					<div class="form-button">
						<input class="button bg-main" type="submit" value="提交"/>
						<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/>
					</div>
				</form>
			</div>
		</div>
    </div>
    <p class="text-right text-gray"></p>
</div>


<script>
	UE.getEditor('editor');
</script>

