<?php 
use yii\helpers\Html;
use components\dy;
?>
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/public/admin/css/print.css">

<div class="admin" style="width:60%; margin:0 auto; height:30%">
	<div class="panel" style="margin:0 auto; text-align:center; margin-top:100px;">
    	<div class="panel-head">
			<input class="button bg-main border-red" style="width:20%; font-size:18px;" onclick="javascript:history.back(-1);return false;" type="button" value="返回"/>
		</div>
		<br/>
		<div class="padding border-bottom" style="height:60px;">
			<input type="button" style="width:20%; font-size:18px;" class="button button-small border-green" id="print" value="点击打印" />
		</div>
	</div>
	<br />
    <p class="text-right text-gray" id="notice_box"></p>
</div>

<div class="print_div">
<?php foreach($ordergoods as $k => $v):?>
<div class="printerTicket">
	<div class="content">
    	<ul>
        	<li><p><b><?=$v['goods_name']?></b><span>&nbsp;&nbsp;¥<?=$v['goods_price']?></span></p><img src="<?php echo dy::getWebUrl();?>/public/admin/images/msb.jpg" /></li>
            <li><span>微信扫码关注美食帮</span><span>更多精彩等着您</span><i>（低温保鲜冷藏，建议当天食用）</i></li>
        </ul>
    </div>
</div>
<div class="space" style="height:26px;"></div>
<?php endforeach;?>
</div>
<script language="javascript" src="<?php echo dy::getWebUrl();?>/public/admin/js/jquery-1.7.2.min.js"></script> 
<script language="javascript" src="<?php echo dy::getWebUrl();?>/public/admin/js/jquery.PrintArea.js"></script>
<script type="text/javascript"> 
	$(document).ready(function(){
		$("#print").click(function(){
			$(".print_div").printArea();
			
			$.ajax({
				"type" : "post" ,
				"url"  : 'printbill',	  	
				"data" : {},
				"success" : function ( data ) {	
					location.reload();
				} 
			});
		}) 
	}); 
</script>

	
