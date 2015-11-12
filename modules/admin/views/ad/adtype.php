<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<form method="post">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>列表</strong></div>
        <div class="padding border-bottom">
            <input type="checkbox" class="button button-small checkbox check-all" name="checkall" checkfor="id" value="全选" />
            <?=Html::a('添加类型', ['addtype'], ['class' => 'button button-small border-green']) ?>
		</div>
        <table class="table table-hover">
        	<tr>
				<th width="100">ID</th>
				<th width="120">广告类名</th>
				<th width="100">排列位置</th>
				<th width="100">状态</th>
				<th width="200">操作</th>
			</tr>
            <?php foreach($row as $v):?>
			<tr>
				<td><input type="checkbox" class="ids checkbox" name="id[]" value="<?=$v['id'];?>" />&nbsp;&nbsp;<?=$v['id'];?></td>
				<td><?=$v['position_name']?></td>
				<td>
				<input type="text" class="input" id="sort<?=$v['id']?>" name="read_count" onblur="sortEdit(<?=$v['id']?>, 'typesortedit')" value="<?=$v['sort']?>" />
				<input type="hidden" class="input" id="hidsort<?=$v['id']?>" value="<?=$v['sort']?>" />
				</td>
				<td>
					<?php if($v['status'] == 0){?><span style="color:red;">禁用</span>
					<?php }else if($v['status'] == 1){?>启用
					<?php };?>
				</td>
				<td>
					<?php if($v['status'] == 0){?>
					<?=Html::a('启用', ['resumetype', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get ']) ?>
					<?php }else if($v['status'] == 1){?>
					<?=Html::a('禁用', ['forbidtype', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get ']) ?>
					<?php };?>
					
					<?=Html::a('修改', ['updatetype', 'id' => $v['id']], ['class' => 'button border-blue button-little']) ?>
					<?=Html::a('删除', ['deletetype', 'id' => $v['id']], ['class' => 'button border-yellow button-little ajax-post confirm']) ?>
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
