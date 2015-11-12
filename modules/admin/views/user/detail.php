<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<strong>用户查看</strong>
        </div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<?php foreach($list as $v):?>
				<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/news/update">
					<div class="form-group">
						<div class="label"><label for="siteurl">真实姓名</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['user_name']?>
							</div>
						</div>
					</div>
					<?php if($v['group_id'] == 2){?>
					<div class="form-group">
						<div class="label"><label>快递数量</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$numbers?>
							</div>
						</div>
					</div>
					<?php }?>
					<?php if($v['group_id'] == 2){?>
					<div class="form-group">
						<div class="label"><label>进行中快递数量</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$numbers1?>
							</div>
						</div>
					</div>
					<?php }?>
					<div class="form-group">
						<div class="label"><label>权限分组</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?php if($v['group_id'] == 1){echo "普通会员";}else if($v['group_id'] == 2){echo ("快递员");}?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="readme">用户昵称</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['user_nickname']?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">用户手机</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['user_phone']?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">用户手机是否已验证</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?php if($v['check_phone'] == 1){ echo '已验证'; }else{ echo '<font color="red">未验证</font>'; } ?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">用户邮箱</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['user_email']?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">用户邮箱是否已验证</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?php if($v['check_email'] == 1){ echo '已验证'; }else{ echo '<font color="red">未验证</font>'; } ?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">用户性别</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?php if($v['user_sex'] == 1){ echo '男'; }else{ echo '女'; } ?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">用户生日</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['user_birthday']?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">用户QQ</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['user_qq']?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">用户状态</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?php if($v['status'] == 1){ echo '正常'; }else{ echo '禁用'; } ?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">用户国籍</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['user_country']?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">用户省份</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['user_province']?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">用户城市</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['user_city']?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">用户地址</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['user_address']?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">余额</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['money']?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">积分</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['points']?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">用户头像</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<div class="baguetteBox">
									<a>
										<img src="<?=dy::getImgOne($v['user_logo'])?>" width="30" height="30">
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">注册时间</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=date('Y-m-d H:i:s', $v['create_time'])?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">注册IP</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['create_ip']?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">上一次登录时间</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=date('Y-m-d H:i:s', $v['last_time'])?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">上一次登录Ip</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['last_ip']?>
							</div>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label for="siteurl">登录次数</label></div>
						<div class="field">
							<div class="button-group button-group-small user-detail">
								<?=$v['login_num']?>
							</div>
						</div>
					</div>
					<div class="form-button"><input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/></div>
				</form>
				<?php endforeach;?>
			</div>
		</div>
    </div>
    <p class="text-right text-gray"></p>
</div>

<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/baguettebox/baguettebox.min.css">
<script type='text/javascript' src="<?php echo dy::getWebUrl();?>/plug/baguettebox/baguettebox.min.js"></script>
<script type='text/javascript'>
	// 点击浏览大图
    baguetteBox.run('.baguetteBox', {
		animation: 'fadeIn',
	});
</script>

