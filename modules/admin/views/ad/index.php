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
            <?=Html::a('添加广告', ['add'], ['class' => 'button button-small border-green']) ?>
		</div>
        <table class="table table-hover">
        	<tr>
				<th width="70">ID</th>
				<th width="120">广告位</th>
				<th width="*">广告名称</th>
				<th width="200">广告链接</th>
				<th width="200">广告图片</th>
				<th width="100">排列位置</th>
				<th width="100">创建时间</th>
				<th width="100">修改时间</th>
				<th width="100">状态</th>
				<th width="200">操作</th>
			</tr>
            <?php foreach($row as $v):?>
			<tr>
				<td><input type="checkbox" class="ids checkbox" name="id[]" value="<?=$v['id'];?>" />&nbsp;&nbsp;<?=$v['id'];?></td>
				<td><?=$v['position_name']?></td>
				<td><?=$v['ad_name']?></td>
				<td><?=$v['ad_url']?></td>
				<td><img src="<?=$v['index_pic']?>" style="width:100px; hieght:100px;"></td>
				<td>
				<input type="text" class="input" id="sort<?=$v['id']?>" name="read_count" onblur="sortEdit(<?=$v['id']?>, 'sortedit')" value="<?=$v['sort']?>" />
				<input type="hidden" class="input" id="hidsort<?=$v['id']?>" value="<?=$v['sort']?>" />
				</td>
				<td><?=date('Y-m-d',$v['create_time'])?></td>
				<td><?=date('Y-m-d',$v['update_time'])?></td>
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
					
					<?=Html::a('修改', ['update', 'id' => $v['id']], ['class' => 'button border-blue button-little']) ?>
					<?=Html::a('删除', ['delete', 'id' => $v['id']], ['class' => 'button border-yellow button-little ajax-post confirm']) ?>
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
