<?php 
use yii\helpers\Html;
use components\dy;
?>
<script src="<?php echo dy::getWebUrl();?>/plug/wdatepicker/wdatepicker.js"></script>

<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<strong>活动添加</strong>
			<input class="button bg-main" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/>
			<?php if(isset($_GET['type']) && $_GET['type'] == 1){
			echo "【满多少送多少，送的优惠在下一次使用！】";
			}else if(isset($_GET['type']) && $_GET['type'] == 2){
			echo "【满多少减多少，减的优惠在本次订单中使用！】";
			}else if(isset($_GET['type']) && $_GET['type'] == 3){
			echo "【推荐注册后赠送优惠金额，相当于现金！】";
			}
		
		?>
		</div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<form method="post" class="form-x" id="test" action="<?php echo dy::getWebUrl();?>/admin/activity/add" >
					<div class="form-group">
						<div class="label"><label>优惠券名称</label></div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<input type="text" class="input" id="siteurl" name="ac_name" size="50" placeholder="请填写优惠券名称" data-validate="required:请填写商品名称" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="siteurl">活动类型</label></div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<?php if($type == 1){?>
								<input type="text" class="input" value="优惠券" id="siteurl" name="" size="50" readonly="readonly"/>
								<input type="hidden" class="input" value="1" id="sitename" name="type" size="50"/>
								<?php }else if($type == 2){?>
								<input type="text" class="input" value="现金券" id="siteurl" size="50" readonly="readonly"/>
								<input type="hidden" class="input" value="2" id="sitename" name="type" size="50"/>
								<?php }?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>购物满值</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="value1" size="50" placeholder="请填写购物满值" data-validate="required:请填写购物满值"/>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>赠送金额</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="value2" size="50" placeholder="请填写赠送金额"/>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>用户参与次数</label></div>
						<div class="button-group button-group-small radio">
							<input type="text" min="0" class="input" id="sitename" name="ac_numbers" value="1" size="50" placeholder="请填写用户参与次数"/>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>活动开始时间</label></div>
						<div class="button-group button-group-small radio">
							<input onFocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" type="text" style="width:133px;" placeholder="开始时间" name="start_time" id="start_time" /> 
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label>活动结束时间</label></div>
						<div class="button-group button-group-small radio">
							<input onFocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" type="text" style="width:133px;" placeholder="结束时间" name="end_time" id="end_time" /> 
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="readme">使用说明</label></div>
						<div class="field">
							<textarea id="sitename" name="ac_content" style="width:500px;"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="readme">活动展示</label></div>
						<div class="field">
							<script id="editor" type="text/plain" name="ac_images" style="width:1024px;height:500px;"></script>
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

