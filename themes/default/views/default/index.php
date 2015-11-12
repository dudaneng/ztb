<?php
/* @var $this yii\web\View */
//$this->title = '淘淘网';

use yii\helpers\Url;
use components\dy;
?>

<!--content start-->
<link href="/themes/default/public/default/css/index.css" rel="stylesheet">

	<!--轮播 wp-->
    <div class="slider" style="position:absolute;left:0;top:30px;z-index: 1;height: 500px;">
        <ul class="slider-content">
            <?php foreach ($banner as $v):?>
			<li style="left: -1349px;" class="slider-item">
				<a class="a-img-bg" href="<?php if($v['ad_url']){echo ($v['ad_url']);}else{echo ('javascript:');}?>" title="<?=$v['ad_name']?>" target="_blank" style="background: url(<?=$v['index_pic']?>) no-repeat center 0;height: 500px"></a>
            </li>
			<?php endforeach;?>
		</ul>
        <ol class="slider-indicator">
			<li class=""></li>
			<li class="active"></li>
		</ol>
        <a class="slider-left-control" href="javascript:void(0)"><i></i></a>
        <a class="slider-right-control" href="javascript:void(0)"><i></i></a>
    </div>
    
	<div class="szt_index">
		<!-- 新手教程 -->
        <div class="container szt_index_warp ">
			<div class="row newSellerHelp margin0" style="position: relative">
				<!-- 帮助 -->
                <div class="col-md-3 help_warp_s">
                    <h5 class="index_h40_title">新闻公告</h5>
                    <div class="index_news_list">
                        <?php foreach($news as $v):?>
						<p class="index_h35_list">
                            <a href="/help/detail?id=<?=$v['id']?>" target="_blank" title="<?=$v['news_title']?>">
                                <span title="发布时间：<?=date('Y-m-d H:i:s', $v['create_time'])?>">[<?=date('m-d', $v['create_time'])?>]</span><?=$v['news_title']?> 
							</a>
                        </p>
                        <?php endforeach;?>
					</div>
                    <div class="more_help">
                        <a title="查看更多帮助" href="/help" class="more_help_icon ">更多</a>
                    </div>
                </div>

                <div class="col-md-3 step_warp">
                    <div class="step step1">
                        <a title="免费注册账号" href="/register">免费注册</a>
                        <br>
                        <a title="联系客服" href="javascript:">联系客服</a>
                    </div>
                    <div class="step arrowRight"></div>
                </div>
                <div class="col-md-3 step_warp">
                    <a title="发布商品和快速上传" href="javascript:" class="step step2">发布商品<br>快速上传</a>
                    <div class="step arrowRight"></div>
                </div>
                <div class="col-md-3 step_warp">
                    <a title="发放资格和快速发货" href="javascript:" class="step step3">发放资格<br>快速发货</a>
                    <div class="step arrowRight"></div>
                </div>
                <div class="col-md-3 step_warp end">
                    <a title="验证订单和审核报告" href="javascript:" class="step step4">验证订单<br>审核报告</a>
                </div>
            </div>


			<!-- 最新推荐-->
            <div class="szt_index_itemList">
				<div class="icon_line"></div>
                <div class="icon_btn_warp">
                    <a href="/goods/list" class="icon_btn">最新推荐</a>
                </div>

                <!--商品列表-->
                <div class="row">
					<?php foreach($rec_goods as $v):?>
					<div class="col-md-3 ">
                        <div class="detailInfo">
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
									<a href="/goods/detail?id=<?=$v['id']?>" title="<?=$v['goods_name']?>" target="_blank">¥<?=$v['price_market']?></a>
								</h5>
								<div class="appBtn ">
									<a class="btn btn-info" href="/goods/detail?id=<?=$v['id']?>" title="<?=$v['goods_name']?>" target="_blank">免费申请</a>
								</div>
							</div>
						</div>
					</div>
                    <?php endforeach;?>
				</div><!--end row-->
				
				<!--广告图片-->
                <div class="szt_ad marginBottom10" style="height: 90px">
                    <p style="background: url(/themes/default/public/default/images/index_bin.png) center center;height: 90px"></p>
                </div>

                <!-- 分类列表-->
                <div class=" szt_index_itemList">
					<div class="icon_line"></div>
                    <div class="icon_btn_warp active_item_btn">
                        <button class="icon_btn  active" data-type="3">
                            <span class="glyphicon glyphicon-star none" aria-hidden="true"></span>
                            红包
                        </button>
                        <button class="icon_btn" data-type="1">
                            <span class="glyphicon glyphicon-star none" aria-hidden="true"></span>
                            实货
                        </button>
                        <button class="icon_btn" data-type="2">
                            <span class="glyphicon glyphicon-star none" aria-hidden="true"></span>
                            礼物
                        </button>
                    </div>

                    <!--分类列表--->
                    <div class="row szt_index_itemList_inner">    
						<?php foreach($goods as $v):?>
						<div class="col-md-3 ">
							<div class="detailInfo">
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
										<a href="/goods/detail?id=<?=$v['id']?>" title="<?=$v['goods_name']?>" target="_blank">￥<?=$v['price_market']?>  </a>
									</h5>
									<div class="appBtn ">
										<a class="btn btn-info" href="/goods/detail?id=<?=$v['id']?>" title="<?=$v['goods_name']?>" target="_blank">免费申请</a>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach;?>
					</div>
                </div>
			</div>
		</div>
	</div>

<script src="/themes/default/public/default/js/jquery-slider.js"></script>
<script type="text/javascript">
  $(function(){
	  $('img').imglazyload();

	  //产品列表鼠标经过
	  $('.detailInfo').hover(function(){
		  $(this).addClass('active');
	  },function(){
		  $(this).removeClass('active');
	  });
	  //产品列表 分类筛选
	  var _width = $(window).width();
	  if(_width<768){
		  $('.active_item_btn .icon_btn').click(function(){
			  $(this).siblings('.icon_btn').removeClass('active')
			  $(this).addClass('active');
			  active_item_type($(this).data('type'));
		  });
	  }
	  else{
		  $('.active_item_btn .icon_btn').mouseenter(function(){
			  $(this).siblings('.icon_btn').removeClass('active');
			  $(this).addClass('active');
			  active_item_type($(this).data('type'))
		  });
	  }
	  $(window).resize(function(){
		  _width = $(window).width();
	  })
	  function active_item_type(_type){
		  $('.szt_index_itemList_inner').load('/default/szt_index_itemList_inner?type='+_type,function(data){
				  $('.szt_index_itemList_inner img').imglazyload();
				  //产品列表鼠标经过
				  $('.detailInfo').hover(function(){
					  $(this).addClass('active');
				  },function(){
					  $(this).removeClass('active');
				  });
			  }
		  )
	  }

  });

</script>

	
	