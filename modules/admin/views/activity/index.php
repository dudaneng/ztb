<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="panel admin-panel">
    	<div class="panel-head"><strong>活动列表</strong>
		<?php if(isset($_GET['type']) && $_GET['type'] == 1){
			echo "【满多少送多少，送的优惠在下一次使用！】";
			}else if(isset($_GET['type']) && $_GET['type'] == 2){
			echo "【满多少减多少，减的优惠在本次订单中使用！】";
			}else if(isset($_GET['type']) && $_GET['type'] == 3){
			echo "【推荐注册后赠送优惠金额，相当于现金！】";
			}
		
		?>
		</div>
        <div class="padding border-bottom"  style="height:60px;">
            <form style="float:left;">
				<input type="checkbox" class="button checkbox button-small check-all" name="checkall" checkfor="id" value="全选" />
				<?php if($type != 3){?>
				<?=Html::a('添加活动', ['add', 'type'=>$type], ['class' => 'button button-small border-green']) ?>
				<?php }?>
			</form>
		</div>
        <table class="table table-hover">
        	<tr>
				<th width="70">ID</th>
				<th width="150">活动名称</th>
				<th width="150">活动类型</th>
				<?php if($type != 3){?>
				<th width="100">消费金额</th>
				<?php }?>
				<th width="100">优惠金额</th>
				<?php if($type != 3){?>
				<th width="100">参与次数</th>
				<?php }?>
				<th width="100">使用说明</th>
				<th width="200">活动链接</th>
				<th width="100">起始时间</th>
				<th width="100">结束时间</th>
				<th width="100">修改时间</th>
				<th width="50">状态</th>
				<th width="150">操作</th>
			</tr>
            <?php foreach($row as $v):?>
			<tr>
				<td><input type="checkbox" name="id[]" class="ids checkbox" value="<?=$v['id'];?>" />&nbsp;&nbsp;<?=$v['id'];?></td>
				<td><?=$v['ac_name']?></td>
				<td>
					<?php if($v['type'] == 1){echo ('优惠券');}else if($v['type'] == 2){echo ('现金券');}else if($v['type'] == 3){echo ('注册特送');}?>
				</td>
				<?php if($type != 3){?>
				<?php if($v['value1'] != 0){?>
					<td><?=$v['value1']?>元</td>
				<?php }else{?>
					<td>无</td>
				<?php }?>
				<?php }?>
				<td><?=$v['value2']?>元</td>
				<?php if($type != 3){?>
				<td><?=$v['ac_numbers']?></td>
				<?php }?>
				<td><?=$v['ac_content']?></td>
				<td>http://<?php echo $_SERVER['HTTP_HOST']?><?php echo dy::getWebUrl();?>/default/activity?id=<?=$v['id']?></td>
				<td><?=date('Y-m-d',$v['start_time'])?></td>
				<td><?=date('Y-m-d',$v['end_time'])?></td>
				<td><?=date('Y-m-d H:i:s',$v['update_time'])?></td>
				<td>
					<?php if($v['status'] == 0){?><span style='color:red;'>禁用</span>
					<?php }else if($v['status'] == 1){?>启用
					<?php };?>
				</td>
				<td>
					<?php if($v['status'] == 0){?>
					<?=Html::a('启用', ['resume', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get']) ?>
					<?php }else if($v['status'] == 1){?>
					<?=Html::a('禁用', ['forbid', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get']) ?>
					<?php };?>
					
					<?=Html::a('修改', ['update', 'id' => $v['id']], ['class' => 'button border-blue button-little']) ?>
					<?php if(isset($_GET['type']) && $_GET['type'] != 3){?>
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

    <br/>
	<p class="text-right text-gray"></p>
</div>
<script type='text/javascript'>
	function hotEdit($hot,$id){
		var url = "<?php echo dy::getWebUrl();?>/admin/goods/hotedit"
		
		if($id != null){
			$.ajax( {
			"type" : "get" ,  
			"url"  : url,	  	
			"data" : {
				id  : $id,
				is_hot: $hot,
			},
			"success" : function ( data ) {	
				if(data == 1){
					location.reload();
				}else{
					alert("操作有误！");
					location.reload();
				}
			} 
			});
		}else{
			
		}
	}
	
	function recommendEdit($recommend,$id){
		var url = "<?php echo dy::getWebUrl();?>/admin/goods/recommendedit"
		
		if($id != null){
			$.ajax( {
			"type" : "get" ,  
			"url"  : url,	  	
			"data" : {
				id  : $id,
				is_recommend: $recommend,
			},
			"success" : function ( data ) {	
				if(data == 1){
					location.reload();
				}else{
					alert("操作有误！");
					location.reload();
				}
			} 
			});
		}else{
			
		}
	}
	
	function selectclick(){
		document.getElementById('select').submit();
	}

	function typeclick(){
		document.getElementById('type').submit();
	}
</script>