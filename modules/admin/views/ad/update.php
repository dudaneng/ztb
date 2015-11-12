<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<strong>文章编辑</strong>
        </div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<?php foreach($list as $v):?>
				<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/ad/update">
					<div class="form-group">
						<div class="label"><label>广告标题</label></div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<input type="text" class="input" id="siteurl" name="ad_name" size="50" value="<?=$v['ad_name']?>" placeholder="请填写广告标题" data-validate="required:请填写广告标题" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">广告类别</label></div>
						<div class="field">
							<select name="position_id">
								<option value="<?=$v['position_id']?>"><?=$v['position_name']?></option>
								<?php foreach($type as $vo):?>
								<option value="<?=$vo['id']?>"><?=$vo['position_name']?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>广告链接</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" class="input" id="sitename" name="ad_url" size="50" value="<?=$v['ad_url']?>"  placeholder="请填写广告链接" data-validate="required:请填写广告链接" />
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">排列位置</label></div>
						<div class="button-group button-group-small radio">
							<input type="number" min="0" class="input" id="sitename" name="sort" size="50" value="<?=$v['sort']?>" placeholder="排列位置,越大越排前" />
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="readme">广告LOGO</label></div>
						<div class="field">
							<script id="images" type="text/plain" name="ad_image" style="width:1024px;height:500px;"><?=$v['ad_image']?></script>
						</div>
					</div>
					<div class="form-button"><input class="button bg-main" type="submit" value="提交"/>
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
	UE.getEditor('images');
	
</script>

