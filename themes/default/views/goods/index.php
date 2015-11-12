<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<link href="/themes/default/public/default/css/stry_list.css" rel="stylesheet">

<div class="szt_stry_list">
<!--发货类型 pc -->
<div class="container category_list_pc">
	<div class="category_all">
		<div class="row marginBottom10">
			<div class="col-md-12">
				<a href="/goods?send_id=0" class="btn btn-danger">全部</a>
				
				<?php foreach($send_type as $v):?>
				<a href="/goods?page=<?=$page?>&goods_type=<?=$goods_type_id?>&send_id=<?=$v['id']?>&order=<?=$order?>" class="btn btn-link"><?=$v['name']?></a>
				<?php endforeach;?>
			</div>
		</div>
		
		<div class="orderBy row marginBottom10">
			<div class="col-md-12">
				<a href="/goods?order=1&page=<?=$page?>&goods_type=<?=$goods_type_id?>&send_id=<?=$send_id?>" class="btn  btn-danger">最新</a>
				
				<a href="/goods?order=2&page=<?=$page?>&goods_type=<?=$goods_type_id?>&send_id=<?=$send_id?>" class="btn btn-link">红包</a>
				
				<a href="/goods?order=3&page=<?=$page?>&goods_type=<?=$goods_type_id?>&send_id=<?=$send_id?>" class="btn btn-link">下单价</a>
				
				<a href="/goods?order=4&page=<?=$page?>&goods_type=<?=$goods_type_id?>&send_id=<?=$send_id?>" class="btn btn-link">份数</a>
			</div>
		</div>
		
		<div class="category row marginBottom10">
			<div class="col-md-12">
				<a href="/goods?goods_type=0" class="btn btn btn-danger">全部</a>
				<?php foreach($goods_type as $v):?>
				<a href="/goods?page=<?=$page?>&send_id=<?=$send_id?>&order=<?=$order?>&goods_type=<?=$v['id']?>" class="btn btn-link"><?=$v['type_name']?></a>
				<?php endforeach;?>
			</div>
		</div>
		
		<!--
		<div class="row marginBottom0" style="border-top: 1px solid #eee;padding-top: 10px ">
			<span class="btn ">已选择分类</span>                        
			<span class="badge">
					实物+红包 &nbsp;
			<span class="glyphicon glyphicon-remove" onclick="resetSearchFilter('sendType')" aria-hidden="true" style="cursor: pointer"></span>
			</span>
		</div>
		-->		
	</div>
</div>

<div class="container">
    <div class="row">
		<?php foreach($goods as $v):?>
		<div class="col-md-3 ">
			<div class="detailInfo">
				<div class="show_new">
					<button class="btn btn-xs btn-info">新品</button>                                                                        
					<button class="btn btn-xs btn-success">电脑单</button>
					<?php if($v['red_packet']):?>
					<button class="btn btn-xs btn-danger">红包￥<?=$v['red_packet']?></button>
					<?php endif;?>
				</div>
				
				<div class="itemImg">
					<a href="/goods/detail?id=<?=$v['id']?>" title="<?=$v['goods_name']?>" target="_blank">
						<img lazy-src="<?=$v['index_pic']?>" src="<?=$v['index_pic']?>" height="210" width="210">
					</a>
				</div>
				
				<div class="itemInfo">
					<h4 class="title">
						<a href="/goods/detail?id=<?=$v['id']?>" title="<?=$v['goods_name']?>" target="_blank"><?=$v['goods_name']?></a>
					</h4>
					<h5 class="price">
						<a href="/goods/detail?id=<?=$v['id']?>" title="<?=$v['goods_name']?>" target="_blank">￥<?=$v['price_market']?></a>
					</h5>
					<div class="appBtn">
						<button class="btn btn-info" onclick="application(<?=$v['id']?>)" title="<?=$v['goods_name']?>">免费申请</button>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach;?>				
	</div>
	
	<div class="mod_pager">
		<div class="pages"><?=$pages;?></div>
	</div>
</div>

</div>

<script type="text/javascript">
    var args2 = "/stry/free/?field=0&desc=&goodsType=0&sendType=1";
    //自定义翻页
    function gotopage(page) {
        var url = args2+"&page="+page;
        window.location = url;
    }
    //重置搜索标签
    function resetSearchFilter(filterName){
        var url = {
            field:0,
            goodsType:0,
            sendType:1        };
        if(filterName=='field'){
            url.field = 0
        }
        if(filterName=='goodsType'){
            url.goodsType = 0
        }
        if(filterName=='sendType'){
            url.sendType = 0
        }
        window.location.href = '/stry/free/'+($.param(url))
    }

    $(function(){
        $('img').imglazyload();

        $('.detailInfo').hover(function(){
            $(this).addClass('active');
        },function(){
            $(this).removeClass('active');
        });
    });

    $('.category_list_sm_bg').click(function(){
        hide_category();
    });
    function hide_category(){
        $('.category_list_sm_bg').hide();
        $('.category_list_sm_warp').animate({
            left:'-70%'
        },function(){
            $(this).removeClass('active').hide();
        })
    }
    function show_category(){
        $('.category_list_sm_bg').show();
        $('.category_list_sm_warp').show().addClass('active').animate({
            left:'0'
        })
    }
    function show_my_nav(){
        show_category();
    }

    //点击申请
    function application(a_id){
        //获取公共变量 产品id
        if(!a_id){
			msg('没有获取到产品id', 1);
		}
		
        messageWait('','提交中请稍等...');
	}
</script>
