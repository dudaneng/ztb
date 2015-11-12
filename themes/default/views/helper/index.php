<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<link href="/themes/default/public/default/css/help.css" rel="stylesheet" media="all">

<div class="container szt_help ">
<div class="row">
    <div class="col-md-2">
        <!--帮助分类导航-->
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
             <div class="panel panel-default">
				<li role="tab" id="headingOne">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapseOne" class=" title top_dashed">
					试客帮助</a>
				</li>
				<div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					<?php foreach($newstype as $v):?>
					<?php if($v['type'] == 1):?>
					<li><a href="/helper/index?typeid=<?=$v['id']?>" target="_self" class="active"><?=$v['type_name']?></a></li>
					<?php endif;?>
					<?php endforeach;?>
				</div>
			</div>
			
			<div class="panel panel-default">
                <li role="tab" id="headingOne">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapseOne" class="  collapsed title top_dashed">
                    商家帮助</a>
				</li>
                <div id="collapse2" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
					<?php foreach($newstype as $v):?>
					<?php if($v['type'] == 2):?>
					<li><a href="/helper/index?typeid=<?=$v['id']?>" target="_self"><?=$v['type_name']?></a></li>
				    <?php endif;?>
					<?php endforeach;?>                  
				</div>
            </div>
			<div class="panel panel-default">
                <li role="tab" id="headingOne">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapseOne" class="  collapsed title top_dashed">
                    网站公告</a>
				</li>
                <div id="collapse3" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
					<?php foreach($newstype as $v):?>
					<?php if($v['type'] == 3):?>
					<li><a href="/helper/index?typeid=<?=$v['id']?>" target="_self"><?=$v['type_name']?></a></li>
				    <?php endif;?>
					<?php endforeach;?>                 
				</div>
            </div>
		</div>
    </div>

    <div class="col-md-10">
		<h2 class="page-header marginTop10">帮助系统</h2>
			<?php foreach($news as $v):?>
			<div class="row marginTop10 marginBottom10 article_list">
                <a class="col-md-9" target="_blank" href="/helper/detail?id=<?=$v['id']?>"><?=$v['news_title']?></a>
                <span class="col-md-3 text-right"><?=date('Y年m月d日 H:i', $v['create_time'])?></span>
            </div>
            <div class="hr-line-dashed"></div>
			<?php endforeach;?>
        <div class="pages">
            <?=$pages?>
		</div>
    </div>

</div>
<!--E-主体-->
</div>
