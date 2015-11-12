<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="panel admin-panel">
    	<div class="panel-head"><strong>订单详情</strong></div>
        <div class="padding border-bottom" style="height:60px;">
			<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/>
		</div>
		<table class="table table-hover">
        	<tr>
				<th width="100">商品图片</th>
				<th width="100">商品名称</th>
				<th width="100">商品编号</th>
				<th width="100">商品数量</th>
				<th width="100">单价</th>
				<th width="100">总价</th>
			</tr>
            <?php foreach($goods as $ke => $vo):?>
			<?php foreach($vo as $key => $vol):?>
			<tr>
				<td><img src="<?=dy::getImgOne($vol['goods_show'])?>" width="53" height="53" /></td>
				<td><?=$vol['goods_name']?></td>
				<td><?=$vol['hs_code']?></td>
				<td><?=$vol['goods_num']?></td>
				<td><?=$vol['price_vip']?> 元</td>
				<td><?=$vol['price_vip']*$vol['goods_num']?> 元</td>
			</tr>
			<?php endforeach;?>
			<?php endforeach;?>
        </table>
		<br/>
		<table class="table  border-top">
        	<tr>
				<th width="*">订单备注</th>
			</tr>
            <tr>
				<?php foreach($row as $v):?>
				<td><?=$v['remark']?></td>
				<?php endforeach;?>
			</tr>
		</table>
	</div>
    <br />
	<p class="text-right text-gray"></p>
</div>

<script>

</script>
