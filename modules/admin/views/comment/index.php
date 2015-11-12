<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="panel admin-panel">
    	<div class="panel-head"><strong>文章列表</strong></div>
        <div class="padding border-bottom" style="height:60px;">
				<form style="float:left;">
					<input type="button" class="button checkbox button-small checkall" name="checkall" checkfor="id" value="全选" />
					<?=Html::a('添加文章', ['add'], ['class' => 'button button-small border-green']) ?>
				</form>
				
				<form style="float:left;">
					<?=Html::a('刷新', ['index'], ['class' => 'button button-small border-green']) ?>
				</form>
				
				<form style="float:left;" action="<?php echo dy::getWebUrl();?>/admin/news/index" id="type" method="get">
					<select style="margin-left:10px;" class="input" name="type" >
						<?php foreach($news_type as $vo):?>
							<option onclick=typeclick() value="<?=$vo['id']?>"><?=$vo['type_name']?></option>
						<?php endforeach;?>
					</select>
				</form>
				<form style="float:right;" action="<?php echo dy::getWebUrl();?>/admin/news/index" id="select" method="get">
					<input style="float:left; width:200px;" type="text" class="input" name="keyword" placeholder="请填写文章标题" />
					<input style="float:left;" type="submit" onclick=selectclick() class="button  bg-main" value="搜索">
				</form>
			
		</div>
		
        <table class="table table-hover">
        	<tr>
				<th width="100">ID</th>
				<th width="120">分类</th>
				<th width="*">标题</th>
				<th width="100">阅读次数</th>
				<th width="100">排列位置</th>
				<th width="100">创建时间</th>
				<th width="100">修改时间</th>
				<th width="100">状态</th>
				<th width="200">操作</th>
			</tr>
            <?php foreach($row as $v):?>
			<tr>
				<td><input type="checkbox" name="id[]" />&nbsp;&nbsp;<?=$v['id'];?></td>
				<td><?=$v['type_name']?></td>
				<td><?=$v['news_title']?></td>
				<td><?=$v['read_count']?></td>
				<td>
				<input type="text" class="input" id="sort<?=$v['id']?>" name="read_count" onblur="sortEdit(<?=$v['id']?>, 'sortedit')" value="<?=$v['sort']?>" />
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
            <?=$page?>
		</div>
    </div>
    <br />
    <p class="text-right text-gray"></p>
</div>
<script>
function selectclick(){
	document.getElementById('select').submit();
}

function typeclick(){
	document.getElementById('type').submit();
}

</script>
