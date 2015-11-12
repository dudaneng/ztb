<?php
use yii\helpers\Url;
use components\dy;
?>
<div class="admin">

<div class="tab">
	<div class="tab-head">
		<strong>系统设置</strong>
		<ul class="tab-nav">
			<li class="active"><a href="#tab-set">系统设置</a></li>
			<li><a href="#tab-pass">管理员设置</a></li>
			<li><a href="#tab-seo">SEO设置</a></li>
			<li><a href="#tab-email">邮箱设置</a></li>
			<li><a href="#tab-message">短信设置</a></li>
			<li><a href="#tab-company">公司设置</a></li>
			<li><a href="#tab-weixin">微信设置</a></li>
		</ul>
	</div>
	<div class="tab-body">
		<br />
		<!-- start system -->
		<div class="tab-panel active" id="tab-set">
			<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/setting/webup">
				<div class="form-group">
					<div class="label">
						<label>网站维护状态</label>
					</div>
					<div class="field">
						<div class="button-group button-group-small radio">
								<?php if($l['web_status'] == 1){ ?>
									<label class="button active"><input name="web_status" value="1" checked="checked" type="radio"><span class="icon icon-check"></span> 开启</label> 
									<label class="button"><input name="web_status" value="0" type="radio"><span class="icon icon-times"></span> 关闭</label>
								<?php }else{ ?>
									<label class="button"><input name="web_status" value="1" type="radio"><span class="icon icon-check"></span> 开启</label> 
									<label class="button active"><input name="web_status" value="0" checked="checked" type="radio"><span class="icon icon-times"></span> 关闭</label>
								<?php } ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="readme">维护说明</label>
					</div>
					<div class="field">
						<textarea class="input" id="web_close_say" name="web_close_say" rows="5" cols="50" placeholder="请填写维护说明" data-validate="required:请填写维护说明"><?php echo $l['web_close_say']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="sitename">网站备案号</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="web_icp" name="web_icp" size="50" placeholder="网站名称" data-validate="required:请填写网站备案号" value="<?php echo $l['web_icp']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="siteurl">版权信息</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="web_copyright" name="web_copyright" size="50" placeholder="请填写版权信息" data-validate="required:请填写版权信息" value="<?php echo $l['web_copyright']; ?>" />
					</div>
				</div>
				<div class="form-button">
					<button class="button bg-main" type="submit">提交</button>
				</div>
			</form>
		</div>
		<!-- end system -->
		
		<!-- start seo -->
		<div class="tab-panel" id="tab-pass">
			<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/setting/setuser">
				<div class="form-group">
					<div class="label">
						<label for="title">旧密码：</label>
					</div>
					<div class="field">
						<input type="password" class="input" id="Old_User_Pass" name="user_password" size="50" placeholder="请输入旧密码" data-validate="required:请输入旧密码" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="title">新密码：</label>
					</div>
					<div class="field">
						<input type="password" class="input" id="News_User_Pass1" name="password" size="50" placeholder="请输入新密码" data-validate="required:请输入新密码" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="keywords">确认密码：</label>
					</div>
					<div class="field">
						<input type="password" class="input" id="News_User_Pass2" name="r_password" size="50" placeholder="请再次输入新密码" data-validate="required:请再次输入新密码"/>
					</div>
				</div>
				<div class="form-button">
					<input type="hidden" name="formtype" value="1"/>
					<button class="button bg-main" type="submit">提交</button>
				</div>
			</form>
		</div>
		<!-- end seo -->
		
		<!-- start seo -->
		<div class="tab-panel" id="tab-seo">
			<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/setting/seoup">
				<div class="form-group">
					<div class="label">
						<label for="title">网站标题</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="seo_title" name="seo_title" size="50" placeholder="请填写网站标题" data-validate="required:请填写网站标题" value="<?php echo $l['seo_title']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="keywords">网站关键词</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="seo_keywords" name="seo_keywords" size="50" placeholder="请填写网站关键词" data-validate="required:请填写网站关键词" value="<?php echo $l['seo_keywords']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="desc">网站描述</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="seo_describe" name="seo_describe" size="50" placeholder="请填写网站描述" data-validate="required:请填写网站描述" value="<?php echo $l['seo_describe']; ?>" />
					</div>
				</div>
				<div class="form-button">
					<button class="button bg-main" type="submit">提交</button>
				</div>
			</form>
		</div>
		<!-- end seo -->

		<!-- start email -->
		<div class="tab-panel" id="tab-email">
			<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/setting/emailup">
				<div class="form-group">
					<div class="label">
						<label for="test_email">测试人邮箱</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="test_email" name="test_email" size="50" placeholder="请填写测试人邮箱" data-validate="required:请填写测试人邮箱,email:测试人邮箱格式错误" />
					</div>
				</div>
				<div class="form-button">
					<input type="hidden" id="email_test_url" value="<?php echo dy::getWebUrl();?>/admin/setting/sendemail" />
					<button class="button bg-main" type="button" id="email_test">测试</button>&nbsp;&nbsp
				</div>
			</form>
		</div>
		<!-- end email -->

		<!-- start message -->
		<div class="tab-panel" id="tab-message">
			<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/setting/messageup">
				<div class="form-group">
					<div class="label">
						<label>短信状态</label>
					</div>
					<div class="field">
						<div class="button-group button-group-small radio">
							<?php if($l['web_status'] == 1){ ?>
									<label class="button active"><input name="sms_set" value="1" checked="checked" type="radio"><span class="icon icon-check"></span> 开启</label> <label class="button"><input name="sms_set" value="no" type="radio"><span class="icon icon-times"></span> 关闭</label>
							<?php }else{ ?>
									<label class="button"><input name="sms_set" value="0" type="radio"><span class="icon icon-check"></span> 开启</label> <label class="button active"><input name="sms_set" value="no" checked="checked" type="radio"><span class="icon icon-times"></span> 关闭</label>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="sms_account">接口账号</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="sms_account" name="sms_account" size="50" placeholder="请填写接口账号" data-validate="required:请填写接口账号" value="<?php echo $l['sms_account']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="sms_password">接口密码</label>
					</div>
					<div class="field">
						<input type="password" class="input" id="sms_password" name="sms_password" size="50" placeholder="请填写接口密码" data-validate="required:请填写接口密码" value="<?php echo $l['sms_password']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="sms_test">测试手机号</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="sms_test" name="sms_test" size="50" placeholder="请填写测试手机号" data-validate="required:请填写测试手机号,mobile:测试手机号格式错误" />
					</div>
				</div>
				<div class="form-button">
					<input type="hidden" id="mobile_test_url" value="<?php echo dy::getWebUrl();?>/admin/setting/sendcode" />
					<button class="button bg-main" type="button" id="mobile_test">测试</button>&nbsp;&nbsp
					<button class="button bg-main" type="submit">保存</button>
				</div>
			</form>
		</div>
		<!-- end message -->

		<!-- start company -->
		<div class="tab-panel" id="tab-company">
			<form method="post" id="form-n" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/setting/companyup">
				<div class="form-group">
					<div class="label">
						<label for="company_name">公司名称</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="company_name" name="company_name" size="50" placeholder="请填写网站名称" value="<?php echo $l['company_name']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="company_address">公司地址</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="company_address" name="company_address" size="50" placeholder="请填写公司地址" value="<?php echo $l['company_address']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="company_phone">公司手机</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="company_phone" name="company_phone" size="50" placeholder="请填写公司手机"  value="<?php echo $l['company_phone']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="company_tel">公司座机</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="company_tel" name="company_tel" size="50" placeholder="请填写公司座机" value="<?php echo $l['company_tel']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="logo">公司qq</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="company_qq" name="company_qq" size="50" placeholder="请填写公司qq" value="<?php echo $l['company_qq']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="title">公司Email</label>
					</div>
					<div class="field">
						<input type="email" class="input" id="company_email" name="company_email" size="50" placeholder="请填写公司Email" value="<?php echo $l['company_email']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="title">提示说明1</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="company_time" name="company_notice1" size="50" placeholder="请填写提示说明1" value="<?php echo $l['company_notice1']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="title">提示说明2</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="company_time" name="company_notice2" size="50" placeholder="请填写提示说明2" value="<?php echo $l['company_notice2']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="title">自提时间点</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="company_time" name="company_time" size="50" placeholder="请填写自提时间点" value="<?php echo $l['company_time']; ?>" />
					</div>
				</div>
				<div class="form-button">
					<button class="button bg-main" type="submit">提交</button>
				</div>
			</form>
		</div>
		<!-- end company -->
		
		
		<!-- start weixin -->
		<div class="tab-panel" id="tab-weixin">
			<form method="post" id="form-n" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/setting/weixinup">
				<div class="form-group">
					<div class="label">
						<label>高级接口</label>
					</div>
					<div class="field">
						<div class="button-group button-group-small radio">
							<?php if($weixin['api_type'] == 1){ ?>
								<label class="button active"><input name="api_type" value="1" checked="checked" type="radio"><span class="icon icon-check"></span> 是</label> 
								<label class="button"><input name="api_type" value="0" type="radio"><span class="icon icon-times"></span> 否</label>
							<?php }else{ ?>
								<label class="button"><input name="api_type" value="1" type="radio"><span class="icon icon-check"></span> 是</label> 
								<label class="button active"><input name="api_type" value="0" checked="checked" type="radio"><span class="icon icon-times"></span> 否</label>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="company_name">微信Appid</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="appid" name="appid" size="50" placeholder="微信Appid" value="<?=$weixin['appid']?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="label">
						<label for="company_address">Appsecret</label>
					</div>
					<div class="field">
						<input type="text" class="input" id="appsecret" name="appsecret" size="50" placeholder="Appsecret" value="<?=$weixin['appsecret']?>" />
					</div>
				</div>
				<div class="form-button">
					<input type="hidden" name="id" value="<?=$weixin['id']?>" />
					<button class="button bg-main" type="submit">提交</button>
				</div>
			</form>
		</div>
		<!-- end weixin -->
    </div>
</div>
<p class="text-right text-gray"></p>
</div>
	
<script type="text/javascript">
$(function(){
	
	// 发送短信
	$("#mobile_test").click(function(){
		$.post(
			$("#mobile_test_url").val(), 
			{ 
				sms_account: $("#sms_account").val(), 
				sms_password: $("#sms_password").val(), 
				sms_test: $("#sms_test").val(), 
			}, 
			function (data, textStatus){         
				alert(data.result);        
			}, 
			"json" 
		);
	});
	
	// 发送邮箱
	$("#email_test").click(function(){
		$.post(
			$("#email_test_url").val(), 
			{ 				
				test_email: $("#test_email").val(),
			}, 
			function (data, textStatus){
				alert(data);        
			}, 
			"json" 
		);
	});
});
</script>