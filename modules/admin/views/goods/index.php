<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="panel admin-panel">
    	<div class="panel-head"><strong>商品列表</strong></div>
        <div class="padding border-bottom"  style="height:60px;">
            <form style="float:left;">
				<input type="checkbox" class="button button-small checkbox check-all" name="checkall" checkfor="id" value="全选" />
				<?=Html::a('添加商品', ['add'], ['class' => 'button button-small border-green']) ?>
			</form>
			<form style="float:left;">
				<?=Html::a('查看全部', ['index'], ['class' => 'button button-small border-green']) ?>
			</form>
			
			<form style="float:left;" action="<?php echo dy::getWebUrl();?>/admin/goods/index" id="type" method="get">
				<select style="margin-left:10px;" class="input" id="type" name="type" onchange="typeclick()">
					<?php if($select_type){?>
					<option value="<?=$select_type['id']?>"><?=$select_type['type_name']?></option>
					<?php }else{?>
					<option value="0">无</option>
					<?php }?>
					
					<?php foreach($goods_type as $vo):?>
						<?php if($vo['type_name'] != $select_type['type_name']){?>
							<option value="<?=$vo['id']?>"><?=$vo['type_name']?></option>
						<?php }?>
					<?php endforeach;?>
				</select>
				
			</form>
			<form style="float:right;" action="<?php echo dy::getWebUrl();?>/admin/goods/index" id="select" method="get">
				<input style="float:left; width:200px;" type="text" class="input" name="keyword" placeholder="请填写商品名" />
				<input style="float:left;" type="submit" onclick="selectclick()" class="button  bg-main" value="搜索">
			</form>
		</div>
        <table class="table table-hover">
        	<tr>
				<th width="70">ID</th>
				<th width="100">商品分类</th>
				<th width="100">商品名称</th>
				<th width="100">商品编号</th>
				<!--<th width="100">所属商店</th>-->
				<th width="100">商品图片</th>
				<th width="70">市场价</th>
				<th width="70">会员价</th>
				<th width="70">规格</th>
				<th width="70">库存</th>
				<th style="display:none;" width="70">产地</th>
				<th style="display:none;" width="70">存储方式</th>
				<th style="display:none;" width="70">配送方式</th>
				<th width="70">排列顺序</th>
				<th width="100">修改时间</th>
				<th width="50">推荐</th>
				<th width="50">状态</th>
				<th width="150">操作</th>
			</tr>
            <?php foreach($row as $v):?>
			<tr>
				<td><input type="checkbox" name="id[]" class="ids checkbox" value="<?=$v['id'];?>" />&nbsp;&nbsp;<?=$v['id'];?></td>
				<td><?=$v['type_big_name']?></td>
				<td><a href="<?php echo dy::getWebUrl();?>/admin/goods/update?id=<?=$v['id']?>"><?=$v['goods_name']?></a></td>
				<td><?=$v['hs_code']?></td>
				<!--<td><?=$v['shop_name']?></td>-->
				<td><img src="<?=dy::getImgOne($v['goods_show'])?>" style="width:100px; height:100px;"></td>
				<td>
					<input type="text" class="input" id="Market<?=$v['id']?>" onblur="MarketEdit(this.value, <?=$v['id']?>, 1)" value="<?=$v['price_market']?>" />
					<input type="hidden" class="input" id="hidMarket<?=$v['id']?>" value="<?=$v['price_market']?>" />
				</td>
				<td>
					<input type="text" class="input" id="Vip<?=$v['id']?>" name="read_count" onblur="MarketEdit(this.value, <?=$v['id']?>, 2)" value="<?=$v['price_vip']?>" />
					<input type="hidden" class="input" id="hidVip<?=$v['id']?>" value="<?=$v['price_vip']?>" />
				</td>
				<td><?=$v['spec']?></td>
				<td><?=$v['goods_num']?></td>
				<td style="display:none;"><?=$v['origin']?></td>
				<td style="display:none;"><?=$v['storage']?></td>
				<td style="display:none;"><?=$v['carry']?></td>
				<td>
				<input type="text" class="input" id="sort<?=$v['id']?>" name="read_count" onblur="sortEdit(<?=$v['id']?>, 'sortedit')" value="<?=$v['sort']?>" />
				<input type="hidden" class="input" id="hidsort<?=$v['id']?>" value="<?=$v['sort']?>" />
				</td>
				<td><?=date('Y-m-d',$v['update_time'])?></td>
				<!--
				<td>
					<?php if($v['is_hot'] == 1){?>
					<a href="javascript:" onclick="hotEdit(<?=$v['is_hot']?>,<?=$v['id']?>)" class="icon icon-check"></a>
					<?php }else if($v['is_hot'] == 0){?>
					<a href="javascript:" onclick="hotEdit(<?=$v['is_hot']?>,<?=$v['id']?>)" class="icon icon-times"></a>
					<?php };?>
				</td>
				-->
				<td>				
					<?php if($v['is_recommend'] == 1){?>
					<a href="javascript:" onclick="recommendEdit(<?=$v['is_recommend']?>,<?=$v['id']?>)" class="icon icon-check"></a>
					<?php }else if($v['is_recommend'] == 0){?>
					<a href="javascript:" onclick="recommendEdit(<?=$v['is_recommend']?>,<?=$v['id']?>)" class="icon icon-times"></a>
					<?php };?>
				</td>
				<td>
					<?php if($v['status'] == 0){?><span style="color:red;">下架</span>
					<?php }else if($v['status'] == 1){?>上架
					<?php };?>
				</td>
				<td>
					<?php if($v['status'] == 0){?>
					<?=Html::a('上架', ['resume', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get']) ?>
					<?php }else if($v['status'] == 1){?>
					<?=Html::a('下架', ['forbid', 'id' => $v['id']], ['class' => 'button border-blue button-little ajax-get']) ?>
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

    <br/>
	<p class="text-right text-gray"></p>
</div>
<script type='text/javascript'>
/**							
 * 2015-06-18 add by dudanfeng 1 修改热门状态	
 **/
/******************** 1 ********************/	
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
/******************** 1 ********************/


/**							
 * 2015-06-18 add by dudanfeng 1 修改推荐状态	
 **/
/******************** 1 ********************/		
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
/******************** 1 ********************/


/**							
 * 2015-06-18 add by dudanfeng 1 筛选名称	
 **/
/******************** 1 ********************/	
function selectclick(){
	document.getElementById('select').submit();
}
/******************** 1 ********************/


/**							
 * 2015-06-18 add by dudanfeng 1 筛选类型	
 **/
/******************** 1 ********************/
function typeclick(){
	document.getElementById('type').submit();
}
/******************** 1 ********************/


/**							
 * 2015-06-18 add by dudanfeng 1 修改价格
 **/
/******************** 1 ********************/
function MarketEdit(price, id, type){
	
	
	if(type == 1){
		var y = document.getElementById('hidMarket'+id).value;
	}else if(type == 2){
		var y = document.getElementById('hidVip'+id).value;
	}
	
	if(price != '' && price != y){
		$.ajax( {
			"type" : "post" ,
			"url"  : 'priceedit',	  	
			"data" : {
				id  : id,
				price: price,
				type : type,
			},
			"success" : function ( data ){
				if(data == 1){
					document.getElementById('hidMarket'+id).value=price;
				}else if(data == 2){
					document.getElementById('hidVip'+id).value=price;
				}else{
					alert("操作有误！");
					location.reload();
				}
			} 
		});
	}else{
	}
}
/******************** 1 ********************/

</script>