<?php
use yii\helpers\Html;
use components\dy;

?>

<link href="<?php echo dy::getWebUrl();?>/modules/myweb/public/css/common.css" rel="stylesheet" type="text/css" />

<!--content start-->
<div class="newListBox">
	<div class="newListInfo">
		<form id="Newsid" action="<?php echo dy::getWebUrl();?>/myweb/news/index" method="post">
			<input type="text" name="keyword" placeholder="请输入关键词">
			<input type="button" onclick="NewsSelect()" value="搜索" />
		</form>
		<ul>
			<?php foreach($row as $v){?>
			<li><a href="<?php echo dy::getWebUrl();?>/myweb/news/detail?id=<?=$v['id']?>"><b><?=$v['news_title']?></b><img src="<?=$v['index_pic']?>"/></a></li>
			<?php }?>
		</ul>
		<div class="pages">
			<?=$page;?>
			<!--
			<a href="#">首页</a>
			<a href="#">1</a>
			<a href="#">2</a>
			<a href="#">3</a>
			<span>...</span>
			<a href="#">9</a>
			<a href="#">下一页</a> -->
		</div>
	</div>
</div>
<script>
	function NewsSelect(){
		document.getElementById('Newsid').submit();
	}
</script>		
