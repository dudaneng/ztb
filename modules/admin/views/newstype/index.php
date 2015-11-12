<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<form method="post">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>分类列表</strong></div>
        <div class="padding border-bottom">
            <input type="checkbox" class="button button-small checkbox check-all" name="checkall" checkfor="id" value="全选" />
            <?=Html::a('添加分类', ['add'], ['class' => 'button button-small border-green']) ?>
		</div>
        <table class="table table-hover">
        	<tr>
				<th width="45">ID</th>
				<th width="100">分类名</th>
				<th width="50">排列位置</th>
				<th width="50">状态</th>
				<th width="50">操作</th>
			</tr>
            <?php foreach($row as $v):?>
			<tr>
				<td><input type="checkbox" class="ids checkbox" name="id[]"/>&nbsp;&nbsp;<?=$v['id'];?></td>
				<td>
					<input type="text" class="input" id="Title<?=$v['id']?>" onblur="NameEdit(this.value, <?=$v['id']?>, 'titleedit')" value="<?=$v['type_name']?>" />
					<input type="hidden" class="input" id="hidTitle<?=$v['id']?>" value="<?=$v['type_name']?>" />
				</td>
				<td>
				<input type="text" class="input" id="sort<?=$v['id']?>" name="read_count" onblur="sortEdit(<?=$v['id']?>, 'sortedit')" value="<?=$v['sort']?>" />
				<input type="hidden" class="input" id="hidsort<?=$v['id']?>" value="<?=$v['sort']?>" />
				</td>
				<td>
					<?php if($v['status'] == 0){?><span style="color:red;">禁用</span>
					<?php }else if($v['status'] == 1){?>启用
					<?php };?>
				</td>
				<td>
					<?=Html::a('修改', ['update', 'id' => $v['id']], ['class' => 'button border-blue button-little']) ?>
					
					<?php if($v['id'] > 21){?>
						<?php if($v['status'] == 0){?>
						<?=Html::a('启用', ['resume', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get ']) ?>
						<?php }else if($v['status'] == 1){?>
						<?=Html::a('禁用', ['forbid', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get ']) ?>
						<?php };?>
						<?=Html::a('删除', ['delete', 'id' => $v['id']], ['class' => 'button border-yellow button-little ajax-post confirm']) ?>
					<?php }?>
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
