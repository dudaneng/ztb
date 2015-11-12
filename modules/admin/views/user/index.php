<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="panel admin-panel">
    	<div class="panel-head"><strong>用户列表</strong></div>
        <div class="padding border-bottom" style="height:60px;">
			<form style="float:left; margin-left:10px;">
				<input type="checkbox" class="button checkbox button-small check-all" name="checkall" checkfor="id" value="全选" />
			</form>
			
			<form style="float:left; margin-left:10px;">
				<?=Html::a('刷新', ['index'], ['class' => 'button button-small border-green']) ?>
			</form>
			
			<form style="float:right;" action="<?php echo dy::getWebUrl();?>/admin/user/index" id="select" method="get">
				<input style="float:left; width:200px;" type="text" class="input" name="keyword" placeholder="请填写用户姓名或手机号" />
				<input style="float:left;" type="submit" onclick="selectclick()" class="button  bg-main" value="搜索">
			</form>
			
		</div>
        <table class="table table-hover">
        	<tr>
				<th width="45">ID</th>
				<th width="120">用户姓名</th>
				<th width="100">用户手机</th>
				<th width="100">创建时间</th>
				<th width="100">上一次登录时间</th>
				<th width="100">状态</th>
				<th width="200">操作</th>
			</tr>
            <?php foreach($row as $v):?>
			<tr>
				<td><input type="checkbox" class="ids checkbox" name="id[]" value="<?=$v['id'];?>" />&nbsp;<?=$v['id']?></td>
				<td><?=$v['user_name']?></td>
				<td><?=$v['user_phone']?></td>
				<td><?=date('Y-m-d H:i:s',$v['create_time'])?></td>
				<td><?=date('Y-m-d H:i:s',$v['last_time'])?></td>
				<td>
					<?php if($v['status'] == 0){?><span style="color:red;">禁用</span>
					<?php }else if($v['status'] == 1){?>启用
					<?php };?>
				</td>
				<td>
					<?php if($v['status'] == 0){?>
					<?=Html::a('启用', ['resume', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get ']) ?>
					<?php }else if($v['status'] == 1){?>
					<?=Html::a('禁用', ['forbid', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get ']) ?>
					<?php };?>
					
					<?=Html::a('查看', ['detail', 'id' => $v['id']], ['class' => 'button border-blue button-little']) ?>
					<!--
					<?=Html::a('删除', ['delete', 'id' => $v['id']], ['class' => 'button border-yellow button-little ajax-post confirm']) ?>
					-->
					<?php if($type == 1){?>
					<?=Html::a('快递授权', ['group', 'id' => $v['id']], ['class' => 'button border-yellow button-little ajax-get confirm']) ?>
					<?php }else if($type == 2){?>
					<?=Html::a('授权取消', ['setgroup', 'id' => $v['id']], ['class' => 'button border-yellow button-little ajax-get confirm']) ?>
					<?php }?>
					
				</td>
			</tr>
			<?php endforeach;?>
        </table>
        <div class="panel-foot text-center">
            <?=$page;?>
		</div>
    </div>
    <br />
    <p class="text-right text-gray"></p>
</div>
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/baguettebox/baguettebox.min.css">
<script type='text/javascript' src="<?php echo dy::getWebUrl();?>/plug/baguettebox/baguettebox.min.js"></script>
<script type='text/javascript'>
	function selectclick(){
		document.getElementById('select').submit();
	}
	// 点击浏览大图
    baguetteBox.run('.baguetteBox', {
		animation: 'fadeIn',
	});
</script>