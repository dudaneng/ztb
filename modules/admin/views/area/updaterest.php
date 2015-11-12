<?php 
use yii\helpers\Html;
use components\dy;
?>
<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<strong>商品编辑</strong>
			<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/>
        </div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<?php foreach($list as $v):?>
				<form method="post" class="form-x" action="<?php echo dy::getWebUrl();?>/admin/area/updaterest">
					<div class="form-group">
						<div class="label"><label>自提地址</label></div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<input type="text" class="input" id="siteurl" name="address" value="<?=$v['address']?>" size="50" placeholder="请填写自提地址" data-validate="required:请填写自提地址" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">区域选择</label></div>
						<div class="field">
							<select onchange="return set_location(this.value, 1);">
								<option value="0">--请选择--</option>
								<?php foreach($type as $vo):?>
								<option value="<?=$vo['id']?>"><?=$vo['area_name']?></option>
								<?php endforeach;?>
							</select> 
							<select id="set_type" onchange="return set_location(this.value, 2);">
								<option value="0">--请选择--</option>
							</select>
							<select name="area_small" id="set_areamid" onchange="return AreaTypeText(this.value);">
								<option value="0">--请选择--</option>
							</select>
							
							<span id="AreaType" style="margin-left:30px;"><?=$v['area_name']?></span>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>营业时间</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="shop_time" value="<?=$v['shop_time']?>" size="50" placeholder="请填写营业时间"/>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>联系电话</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="contact" value="<?=$v['contact']?>" size="50" placeholder="请填写联系电话"/>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">排列位置</label></div>
						<div class="button-group button-group-small radio">
							<input type="number" min="0" class="input" id="sitename" name="sort" value="<?=$v['sort']?>" size="50" placeholder="排列位置,越大越排前" />
						</div>
					</div>
					<div class="form-button">
						<input class="button bg-main" type="submit" value="提交"/>
						<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/>
					</div>
					<input type="hidden" name="id" value="<?=$v['id']?>">
				</form>
				<?php endforeach;?>
			</div>
		</div>
    </div>
    <p class="text-right text-gray"></p>
</div>


<script>

//二级分类
function set_location(id, type){
	var url = "<?php echo dy::getWebUrl();?>/admin/area/setselect";
	
	if(type == 1){
		var obj1 = document.getElementById('set_type');
		obj1.options.length=0;
		obj1.options.add(new Option("--请选择--","0"));
		
		var obj2 = document.getElementById('set_areamid');
		obj2.options.length=0;
		obj2.options.add(new Option("--请选择--","0"));
	}else if(type == 2){
		var obj3 = document.getElementById('set_areamid');
		obj3.options.length=0;
		obj3.options.add(new Option("--请选择--","0"));
	}
	
	$.ajax({
		type : "post",
		url : url,
		async : false,
		data : {
			id : id,
			type : type, 
		},
		beforeSend : function(){
		},
		success : function(data){
			var arr = eval(data);
			
			if(arr != 0)
			{
				if(type == 1){
					var obj = document.getElementById('set_type');
				}else if(type == 2){
					var obj = document.getElementById('set_areamid');
				}
				
				obj.options.length=0;
				obj.options.add(new Option("--请选择--","0"));
				
				if(arr != 1){
					for(var i=0;i<arr.length;i++){
						obj.options.add(new Option(arr[i]['area_name'],arr[i]['id']));
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

function AreaTypeText(id){
	var obj=document.getElementById('set_areamid'); 
	var text=obj.options[obj.selectedIndex].text;//获取文本
	
	document.getElementById('AreaType').innerHTML = text;
}
</script>

