<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="panel admin-panel">
    	<div class="panel-head"><strong>自提点列表</strong></div>
        <div class="padding border-bottom"  style="height:60px;">
            <form style="float:left;">
				<input type="checkbox" class="button button-small checkbox check-all" name="checkall" checkfor="id" value="全选" />
				<?=Html::a('添加自提点', ['addrest'], ['class' => 'button button-small border-green']) ?>
			</form>
			<form style="float:left;">
				<?=Html::a('刷新', ['restaurant'], ['class' => 'button button-small border-green']) ?>
			</form>
			<form style="float:right;" action="<?php echo dy::getWebUrl();?>/admin/area/restaurant" id="select" method="get">
				<input style="float:left; width:200px;" type="text" class="input" name="keyword" placeholder="填写所在商圈" />
				<input style="float:left;" type="submit" onclick="selectclick()" class="button  bg-main" value="搜索">
			</form>
		</div>
        <table class="table table-hover">
        	<tr>
				<th width="70">ID</th>
				<th width="150">所在商圈</th>
				<th width="*">自提地址</th>
				<th width="*">快递员配置</th>
				<th width="*"></th>
				<th width="*">营业时间</th>
				<th width="100">联系电话</th>
				<th width="100">创建时间</th>
				<th width="50">状态</th>
				<th width="200">操作</th>
			</tr>
            <?php foreach($row as $v):?>
			<tr>
				<td><input type="checkbox" name="id[]" class="ids checkbox" value="<?=$v['id'];?>" />&nbsp;&nbsp;<?=$v['id'];?></td>
				<td><?=$v['area_name']?></td>
				<td><?=$v['address']?></td>
				<td>
					<input type="text" class="input" id="ExpressId<?=$v['id']?>" onblur="ExpressIdEdit(this.value, <?=$v['id']?>)" value="<?=$v['express']?>" />
					<input type="hidden" class="input" id="hidExpressId<?=$v['id']?>" value="<?=$v['express']?>" />
				</td>
				<td><?=Html::a('查看', ['resdetail', 'id' => $v['id']], ['class' => 'button border-yellow button-little']) ?></td>
				<td><?=$v['shop_time']?></td>
				<td><?=$v['contact']?></td>
				<td><?=date('Y-m-d',$v['update_time'])?></td>
				<td>
					<?php if($v['status'] == 0){?>禁用
					<?php }else if($v['status'] == 1){?>启用
					<?php };?>
				</td>
				<td>
					<?php if($v['status'] == 0){?>
					<?=Html::a('启用', ['resumerest', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get']) ?>
					<?php }else if($v['status'] == 1){?>
					<?=Html::a('禁用', ['forbidrest', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get']) ?>
					<?php };?>
					
					<?=Html::a('修改', ['updaterest', 'id' => $v['id']], ['class' => 'button border-blue button-little']) ?>
					<?=Html::a('删除', ['deleterest', 'id' => $v['id']], ['class' => 'button border-yellow button-little ajax-post confirm']) ?>
					<?=Html::a('柜子管理', ['cabinet/index', 'id' => $v['id']], ['class' => 'button border-yellow button-little']) ?>
				</td>
			</tr>
			<?php endforeach;?>
        </table>
        <div class="panel-foot text-center">
            <?=$page?>
		</div>
    </div>

    <br/>
	<p class="text-right text-gray"></p>
</div>
<script type='text/javascript'>
	/**							
	 * 2015-06-25 add by dudanfeng 1 搜索事件
	 **/
	/******************** 1 ********************/
	function selectclick(){
		document.getElementById('select').submit();
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 2015-06-25 add by dudanfeng 1 修改快递员配置
	 **/
	/******************** 1 ********************/
	function ExpressIdEdit(express, id){
		var y = document.getElementById('hidExpressId'+id).value;
	
		if(express != '' && express != y){
			$.ajax( {
				"type" : "post" ,
				"url"  : 'expressedit',	  	
				"data" : {
					id  : id,
					express: express,
				},
				"success" : function ( data ){
					
					if(data == 1){
						document.getElementById('hidExpressId'+id).value=express;
					}else if(data == 2){
						alert("存在用户不为快递员");
						location.reload();
					}else{
						alert("用户ID不能重复或不存在");
						location.reload();
					}
				} 
			});
		}else{
		}
	}
	/******************** 1 ********************/
</script>