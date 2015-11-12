<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="panel admin-panel">
    	<div class="panel-head"><strong>快递员列表</strong></div>
        <div class="padding border-bottom" style="height:60px;">
			<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/>
		</div>
		<table class="table table-hover">
        	<tr>
				<th width="100">ID</th>
				<th width="100">姓名</th>
				<th width="100">手机号</th>
				<th width="100">状态</th>
			</tr>
            <?php foreach($row as $k => $v):?>
			<tr>
				<td><?=$v['id']?></td>
				<td><?=$v['user_name']?></td>
				<td><?=$v['user_phone']?></td>
				<td>
					<?php if($v['user_phone'] == 0){?>禁用
					<?php }else{?>启用
					<?php }?>
				</td>
			</tr>
			<?php endforeach;?>
        </table>
    </div>
    <br />
    <p class="text-right text-gray"></p>
</div>

<script>

</script>
