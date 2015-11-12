<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<strong>商品添加</strong>
			<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/>
		</div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<form method="post" class="form-x" id="test" action="<?php echo dy::getWebUrl();?>/admin/goods/add" >
					<div class="form-group">
						<div class="label"><label>商品名称</label></div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<input type="text" class="input" id="siteurl" name="goods_name" size="50" placeholder="请填写商品名称" data-validate="required:请填写商品名称" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>商品编号</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="hs_code" size="50" placeholder="请填写商品编号" data-validate="required:请填写商品编号"/>
						</div>
					</div>
					<!--<div class="form-group">
						<div class="label"><label>所属商店</label></div>
						<div class="button-group button-group-small radio">
							<select name="shop_id">
								<?php foreach($shop as $v):?>
								<option value="<?=$v['id']?>"><?=$v['shop_name']?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>-->
					<div class="form-group">
						<div class="label"><label for="siteurl">商品分类</label></div>
						<div class="field">
							<select name="type_big">
								<option value="0">请选择</option>
								<?php foreach($type_big as $vo):?>
								<option value="<?=$vo['id']?>"><?=$vo['type_name']?></option>
								<?php endforeach;?>
							</select> 
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>市场价</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="price_market" size="50" placeholder="请填写市场价"/>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>会员价</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="price_vip" size="50" placeholder="请填写会员价"/>
						</div>
					</div>
					<div style="display:none;" class="form-group">
						<div class="label"><label>库存</label></div>
						<div class="button-group button-group-small radio">
							<input type="number" min="0" class="input" id="sitename" name="goods_num" value="1000000" size="50" placeholder="请填写商品数量"/>
						</div>
					</div>
					<div class="form-group"  style="display:none;">
						<div class="label"><label>销售数量</label></div>
						<div class="button-group button-group-small radio">
							<input type="number" min="0" class="input" id="sitename" name="sold" value="" size="50" placeholder="请填写销售数量"/>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>规格</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="spec" size="50" placeholder="请填写商品规格"/>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>产地</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="origin" size="50" placeholder="请填写商品产地"/>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>储存方式</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="storage" size="50" placeholder="请填写储存方式"/>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>配送方式</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="carry" size="50" placeholder="请填写配送方式"/>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="readme">商品简介</label></div>
						<div class="field">
							<textarea id="sitename" name="goods_info" style="width:500px;"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="readme">食材选择</label></div>
						<div class="field">
							<script id="food" type="text/plain" name="sel_food" style="width:1024px;height:250px;"></script>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="readme">商品图片</label></div>
						<div class="field">
							<script id="image" type="text/plain" name="goods_show" style="width:1024px;height:500px;"></script>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="readme">商品描述</label></div>
						<div class="field">
							<script id="editor" type="text/plain" name="goods_content" style="width:1024px;height:500px;"></script>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">排列位置</label></div>
						<div class="button-group button-group-small radio">
							<input type="number" min="0" class="input" id="sitename" name="sort" size="50" placeholder="排列位置,越大越排前" />
						</div>
					</div>
					
					<div class="form-button">
						<input class="button bg-main" type="submit" value="提交"/>
						<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/>
					</div>
				</form>
			</div>
		</div>
    </div>
    <p class="text-right text-gray"></p>
</div>


<script>
UE.getEditor('editor');
UE.getEditor('image');
UE.getEditor('food');
//二级分类
function set_location(id){
	var url = "<?php echo dy::getWebUrl();?>/admin/goods/setselect";
	
	$.ajax({
		type : "post",
		url : url,
		async : false,
		data : {
			id : id
		},
		beforeSend : function(){
		},
		success : function(data){
			var arr = eval(data);
			
			if(arr != 0)
			{
				var obj = document.getElementById('set_type');
				obj.options.length=0;
				//obj.options.add(new Option("--请选择--","0"));
				
				if(arr != 1){
					for(var i=0;i<arr.length;i++){
						obj.options.add(new Option(arr[i]['type_name'],arr[i]['id']));
					}
				}else{
					location.reload();
				}
			}
			else
			{
				alert("操作有误!");
			}
		}
	});
}

</script>

