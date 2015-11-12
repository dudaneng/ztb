<?php 
use yii\helpers\Html;
use components\dy;
?>
<script src="<?php echo dy::getWebUrl();?>/plug/wdatepicker/wdatepicker.js"></script>

<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<strong>活动编辑</strong>
			<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/>
        </div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<?php foreach($list as $v):?>
				<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/activity/update">
					<div class="form-group">
						<div class="label"><label>优惠券名称</label></div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<input type="text" class="input" id="siteurl" name="ac_name" value="<?=$v['ac_name']?>" size="50" placeholder="请填写优惠券名称" data-validate="required:请填写商品名称" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">活动类型</label></div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<?php if($v['type'] == 1){?>
								<input type="text" class="input" value="优惠券" id="siteurl" name="" size="50" readonly="readonly"/>
								<input type="hidden" class="input" value="1" id="sitename" name="type" size="50"/>
								<?php }else if($v['type'] == 2){?>
								<input type="text" class="input" value="现金券" id="siteurl" size="50" readonly="readonly"/>
								<input type="hidden" class="input" value="2" id="sitename" name="type" size="50"/>
								<?php }else if($v['type'] == 3){?>
								<input type="text" class="input" value="推荐送金" id="siteurl" size="50" readonly="readonly"/>
								<input type="hidden" class="input" value="3" id="sitename" name="type" size="50"/>
								<?php }?>
							</div>
						</div>
					</div>
					<?php if($v['type'] != 3){?>
					<div class="form-group">
						<div class="label"><label>购物满值</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="value1" value="<?=$v['value1']?>" size="50" placeholder="请填写购物满值" data-validate="required:请填写购物满值"/>
						</div>
					</div>
					<?php }?>
					<div class="form-group">
						<div class="label"><label>赠送金额</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="value2" value="<?=$v['value2']?>" size="50" placeholder="请填写赠送金额"/>
						</div>
					</div>
					<?php if($v['type'] != 3){?>
					<div class="form-group">
						<div class="label"><label>用户参与次数</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="ac_numbers" value="<?=$v['ac_numbers']?>" size="50" placeholder="请填写用户使用次数"/>
						</div>
					</div>
					<?php }?>
					<div class="form-group">
						<div class="label"><label>活动开始时间</label></div>
						<div class="button-group button-group-small radio">
							<input onFocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" type="text" style="width:133px;" placeholder="开始时间" value="<?=date('Y-m-d', $v['start_time'])?>" name="start_time" id="start_time" /> 
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>活动结束时间</label></div>
						<div class="button-group button-group-small radio">
							<input onFocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" type="text" style="width:133px;" placeholder="结束时间" value="<?=date('Y-m-d', $v['end_time'])?>" name="end_time" id="end_time" /> 
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="readme">使用说明</label></div>
						<div class="field">
							<textarea id="sitename" name="ac_content" style="width:500px;"><?=$v['ac_content']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="readme">活动展示</label></div>
						<div class="field">
							<script id="editor" type="text/plain" name="ac_images" style="width:1024px;height:500px;"><?=$v['ac_images']?></script>
						</div>
					</div>
					<div class="form-button">
						<input class="button bg-main" type="submit" value="提交"/>
						<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/>
					</div>
					<input type="hidden" name="id" value="<?=$v['id']?>">
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

