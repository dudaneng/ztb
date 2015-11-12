<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<form method="post">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>回收站</strong></div>
        <div class="padding border-bottom">
            <input type="button" class="button checkbox button-small checkall" name="checkall" checkfor="id" value="全选" />
        </div>
        <table class="table table-hover">
        	<tr>
				<th width="100">ID</th>
				<th width="120">分类</th>
				<th width="*">标题</th>
				<th width="200">操作</th>
			</tr>
            <?php foreach($row as $v):?>
			<tr>
				<td><input type="checkbox" class="ids checkbox" name="id[]" value="<?=$v['id'];?>" />&nbsp;<?=$v['id'];?></td>
				<td><?=$v['type_name']?></td>
				<td><?=$v['news_title']?></td>
				<td>
					<?=Html::a('恢复', ['reduction', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get']) ?>
					<?=Html::a('清除', ['delete', 'id' => $v['id']], ['class' => 'button border-yellow button-little ajax-post confirm']) ?>
				</td>
			</tr>
			<?php endforeach;?>
        </table>
        <div class="panel-foot text-center">
            <?=$page?>
		</div>
    </div>
    </form>
    <br />
    <p class="text-right text-gray"></p>
</div>
