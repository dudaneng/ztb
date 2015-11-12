<?php
use yii\helpers\Html;
use components\dy;
?>

<title>快递管理-<?php echo $session = Yii::$app->session->get('setting');?></title>

<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/modules/express/public/css/pintuer.css">
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/modules/express/public/css/admin.css">
<script src="<?php echo dy::getWebUrl();?>/modules/express/public/js/jquery.js"></script>
<script src="<?php echo dy::getWebUrl();?>/modules/express/public/js/pintuer.js"></script>
<script src="<?php echo dy::getWebUrl();?>/modules/express/public/js/respond.js"></script>
<script src="<?php echo dy::getWebUrl();?>/modules/express/public/js/admin.js"></script>

<link rel="shortcut icon" href="<?php echo dy::getWebUrl();?>/themes/default/public/favicon.ico" />
<link rel="bookmark" href="<?php echo dy::getWebUrl();?>/themes/default/public/favicon.ico" type="image/x-icon"　/>

<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog.css">
<link rel="stylesheet" href="<?php echo dy::getWebUrl();?>/plug/artdialog/default.css">
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-min.js"></script>
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/artDialog.min.js"></script>
<script src="<?php echo dy::getWebUrl();?>/plug/artdialog/dialog-plus-min.js"></script>

<div class="admin">
	<div class="pane1 admin-pane1">
    	<div class="panel-head"><strong>订单列表</strong></div>
        <div class="padding border-bottom" style="height:60px;">
			<form style="float:left;">
				<input type="checkbox" class="button checkbox button-small check-all" name="checkall" checkfor="id" value="全选" />
			</form>
			<form style="display:none; float:left; margin-left:10px;">
				<?=Html::a('刷新', ['index'], ['class' => 'button button-small border-green']) ?>
			</form>
		</div>
		
        <table class="table table-hover">
        	<tr>
				<th style="font-size:2.0em;" width="32%">订单号</th>
				<th style="font-size:2.0em;" width="32%">自提时间</th>
				<th style="font-size:2.0em;" width="20%">操作</th>
			</tr>
            <?php foreach($row as $v):?>
			<tr>
				<td style="font-size:2.0em;"><?=$v['order_sn']?></td>
				<td style="font-size:2.0em;"><?=date('Y-m-d H:s:i',$v['put_time'])?></td>
				<td style="font-size:2.0em;">
					<?php if($v['delivery'] == 0){?>
					<a href="<?php echo dy::getWebUrl();?>/express/default/boxselect?id=<?=$v['id']?>" class="button border-blue button-big"  style="font-size:1.0em;">发货</a>
					<?php };?>
					<a href="<?php echo dy::getWebUrl();?>/express/default/address?id=<?=$v['id']?>" class="button border-yellow button-big"  style="font-size:1.0em;">地址</a>
				</td>
			</tr>
			<?php endforeach;?>
        </table>
        <div class="panel-foot text-center">
           
		</div>
    </div>
    <br />
    <p class="text-right text-gray" id="notice_box">
	</p>
</div>
