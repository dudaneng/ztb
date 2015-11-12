<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<form method="post">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>内容列表</strong></div>
        <div class="padding border-bottom">
            <input type="checkbox" class="button checkbox button-small check-all" name="checkall" checkfor="id" value="全选" />
            <?=Html::a('添加友情链接', ['add'], ['class' => 'button button-small border-green']) ?>
		</div>
        <table class="table table-hover">
        	<tr>
				<th width="45">ID</th>
				<th width="120">名称</th>
				<th width="*">URL</th>
				<th width="200">LOGO</th>
				<th width="100">排列位置</th>
				<th width="100">创建时间</th>
				<th width="100">修改时间</th>
				<th width="100">状态</th>
				<th width="200">操作</th>
			</tr>
            <?php foreach($row as $v):?>
			<tr>
				<td><input type="checkbox" class="ids checkbox" name="id[]" value="<?=$v['id'];?>" />&nbsp;<?=$v['id']?></td>
				<td><?=$v['link_name']?></td>
				<td><?=$v['link_url']?></td>
				<td>
					<div class="baguetteBox">
						<a href="<?=dy::getImgOne($v['link_logo'])?>">
							<img src="<?=dy::getImgOne($v['link_logo'])?>" width="60" height="60">
						</a>
					</div>
				</td>
				<td>
				<input type="text" class="input" id="sort<?=$v['id']?>" name="read_count" onblur="sortEdit(<?=$v['id']?>)" value="<?=$v['sort']?>" />
				<input type="hidden" class="input" id="hidsort<?=$v['id']?>" value="<?=$v['sort']?>" />
				</td>
				<td><?=date('Y-m-d',$v['create_time'])?></td>
				<td><?=date('Y-m-d',$v['update_time'])?></td>
				<td>
					<?php if($v['status'] == 0){?>禁用
					<?php }else if($v['status'] == 1){?>启用
					<?php };?>
				</td>
				<td>
					<?php if($v['status'] == 0){?>
					<?=Html::a('启用', ['resume', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get ']) ?>
					<?php }else if($v['status'] == 1){?>
					<?=Html::a('禁用', ['forbid', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get ']) ?>
					<?php };?>
					
					<?=Html::a('修改', ['update', 'id' => $v['id']], ['class' => 'button border-blue button-little']) ?>
					<?=Html::a('删除', ['delete', 'id' => $v['id']], ['class' => 'button border-yellow button-little ajax-post confirm']) ?>
				</td>
			</tr>
			<?php endforeach;?>
        </table>
        <div class="panel-foot text-center">
            <?=$page;?>
		</div>
    </div>
    </form>
    <br />
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