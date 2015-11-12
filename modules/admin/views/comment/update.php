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
				<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/news/update">
					<div class="form-group">
						<div class="label"><label>文章标题</label></div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<input type="text" class="input" id="siteurl" name="news_title" size="50" value="<?=$v['news_title']?>" placeholder="请填写文章标题" data-validate="required:请填写文章标题" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">文章类别</label></div>
						<div class="field">
							<select name="news_type_id">
								<option value="<?=$v['news_type_id']?>"><?=$v['type_name']?></option>
								<?php foreach($type as $vo):?>
								<option value="<?=$vo['id']?>"><?=$vo['type_name']?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>文章作者</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" class="input" id="sitename" name="news_author" size="50" value="<?=$v['news_author']?>" placeholder="请填写文章作者" data-validate="required:请填写文章作者" />
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>阅读次数</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="read_count" value="<?=$v['read_count']?>" size="50" placeholder="请填写阅读次数" />
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="readme">文章摘要</label></div>
						<div class="field">
							<textarea class="input" name="news_summary" rows="5" cols="50" placeholder="请填写文章摘要" data-validate="required:请填写文章摘要"><?=$v['news_summary']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="readme">文章内容</label></div>
						<div class="field">
							<script id="editor" type="text/plain" name="news_content" style="width:1024px;height:500px;"><?=$v['news_content']?></script>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">排列类别</label></div>
						<div class="field">
							<select name="is_top">
								<?php if($v['is_top'] == 0){?>
								<option value="0">普通</option>
								<option value="1">置顶</option>
								<?php }else if($v['is_top'] == 1){?>
								<option value="1">置顶</option>
								<option value="0">普通</option>
								<?php }?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">排列位置</label></div>
						<div class="button-group button-group-small radio">
							<input type="number" min="0" class="input" id="sitename" name="sort" value="<?=$v['sort']?>" size="50" placeholder="请填写排列位置,越大越排前" />
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
	UE.getEditor('editor');
	
</script>

