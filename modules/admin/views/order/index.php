<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="panel admin-panel">
    	<div class="panel-head"><strong>订单列表</strong></div>
        <div class="padding border-bottom" style="height:60px;">
			<form style="float:left;">
				<?=Html::a('打印便签', ['printgoods'], ['class' => 'button button-small border-green _blank']) ?>
			</form>
			<form style="display:none; float:left; margin-left:10px;">
				<?=Html::a('刷新', ['index'], ['class' => 'button button-small border-green']) ?>
			</form>
			<form style="float:right;" action="<?php echo dy::getWebUrl();?>/admin/order/index" id="select" method="get">
				<input style="float:left; width:200px;" type="text" class="input" name="keyword" placeholder="请填写订单号" />
				<input style="float:left;" type="submit" onclick="selectclick()" class="button  bg-main" value="搜索">
			</form>
		</div>
		
        <table class="table table-hover">
        	<tr>
				<th width="100">ID</th>
				<th width="100">订单号</th>
				<th width="100">提取码</th>
				<th width="100">订单总价</th>
				<th width="200">下单时间</th>
				<th width="200">自提时间</th>
				<th width="200">修改时间</th>
				<th width="100">订单状态</th>
				<th width="*">操作</th>
			</tr>
            <?php foreach($row as $v):?>
			<tr>
				<td><input type="checkbox" class="ids checkbox" name="id[]" />&nbsp;&nbsp;<?=$v['id'];?></td>
				<td><?=$v['order_sn']?></td>
				<td><?=$v['user_code']?></td>
				<td><?=$v['price_all']?> 元</td>
				<td><?=date('Y-m-d H:s:i',$v['create_time'])?></td>
				<td title="<?=date('Y-m-d',$v['put_time'])?>&nbsp;<?=$set_time?>"><?=date('Y-m-d',$v['put_time'])?></td>
				<td><?=date('Y-m-d H:s:i',$v['update_time'])?></td>
				<td>
					<?php if($v['status'] == 1){
						echo ("已下单");
					}else if($v['status'] == 2){
						echo ("用户取消");
					}else if($v['status'] == 3){
						echo ("商家取消");
					}else if($v['status'] == 4){
						echo ("已付款");
					}else if($v['status'] == 5){
						echo ("申请退款");
					}else if($v['status'] == 6){
						echo ("已发货");
					}else if($v['status'] == 7){
						echo ("到自提点");
					}else if($v['status'] == 8){
						echo ("取货");
					}else if($v['status'] == 9){
						echo ("已完成");
					}else{
						echo ("异常");
					}
					?>
				</td>
				<td>
					<?php if($v['status'] == 4){?>
					<?=Html::a('发货', ['resume', 'id' => $v['id'], 'page'=>$pages], ['class' => 'button border-blue button-little']) ?>
					<?php };?>
					<?=Html::a('用户地址', ['address', 'id' => $v['id']], ['class' => 'button border-yellow button-little'])?>
					<?=Html::a('订单详情', ['detail', 'id' => $v['id']], ['class' => 'button border-yellow button-little']) ?>
					<?=Html::a('快递查看', ['express', 'id' => $v['id']], ['class' => 'button border-yellow button-little']) ?>
				</td>
			</tr>
			<?php endforeach;?>
        </table>
        <div class="panel-foot text-center">
            <?=$page?>
		</div>
    </div>
    <br />
    <p class="text-right text-gray" id="notice_box">
	</p>
</div>


<script src="<?php echo dy::getWebUrl();?>/public/admin/js/jquery-1.8.3.min.js"></script>
<script src="http://localhost:8080/socket.io/socket.io.js"></script>
<script>
function selectclick(){
	document.getElementById('select').submit();
}

</script>
<script>
var iosocket = io.connect("http://localhost:8080");

window.onload=function()
{
	socket_connect();
}

function socket_connect()
{
	iosocket.on('connect', function () {
		iosocket.on('message', function(message) {
			if(message != ''){
				alert("有人下单，请及时处理");
				//dialogCue("有人下单，请及时处理");
			}
			location.reload();
		});
		iosocket.on('disconnect', function() {
			
		});
	});
}
</script>
