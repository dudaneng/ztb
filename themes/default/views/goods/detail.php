<?php
/* @var $this yii\web\View */
$this->title = '美食网';

use yii\helpers\Url;
use components\dy;
?>

<link href="<?php echo dy::getWebUrl();?>/themes/default/public/default/css/content.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/goodsBanner.js"></script>

<script type="text/javascript" src="<?php echo dy::getWebUrl();?>/themes/default/public/default/js/jquery.Spinner.js"></script>

<!--content start-->
<div class="con">
	<div class="goodsInfo">
       <?php foreach($row as $v):?>
	   <p>当前位置：<a href="<?php echo dy::getWebUrl();?>/default/index">首页</a>&gt;&gt;<a href="javascript:;"><?=$v['type_name']?></a>&gt;&gt;<span><?=$v['goods_name']?></span></p>
        <ul>
        	<li class="goodsInfoImg">
            	<img src="<?=dy::getImgOne($v['goods_show'])?>" width="485" height="405" />
         	</li>
            <li class="goodsInfoWord">
                <h3><?=$v['goods_name']?></h3>
                <p>编号：<?=$v['hs_code']?></p>
                <p><span>规格：<?=$v['spec']?></span><span style="padding-left:15px;">产地：<?=$v['origin']?></span></p>
                <p>配送方式：<?=$v['carry']?></p>
                <p>储存方式：<?=$v['storage']?></p>
                <b>¥<?=$v['price_vip']?></b>
                <p><u>数量：</U><a style="padding:3px 8px; border:1px solid #ccc; border-right:0; color:#333;" href="javascript:" onclick="return ChangeNumberDetail(1)">-</a><input onblur="ChangeNumberDetail(3)" id="DetailGoods" style="border:1px solid #ccc; width:45px; text-align:center; height:26px;" value="1"><a onclick="return ChangeNumberDetail(2)" href="javascrip:" style="padding:3px 7px; border:1px solid #ccc; border-left:0; color:#333;">+</a></p>
                <i><a href="javascript:;" onclick="addToCartDetail('<?php echo dy::getWebUrl();?>', <?=$v['id']?>)">加入购物车</a>
				<a href="<?php echo dy::getWebUrl();?>/goods/cart">查看购物车</a></i>
            </li>
		</ul>
		<input type="hidden" id="BuyAllNumber" value="<?=$v['goods_num']?>">
        <div class="goodsInfoCon">
        	<h4><span>商品介绍</span></h4>
            <div>
				<?=$v['goods_content']?>
			</div>
        </div>
        <div class="goodsInfoCon">
        	<h4><span>食材保证</span></h4>
            <div>
				<?=$v['sel_food']?>
			</div>
        </div>
        <?php endforeach;?>
		
		 <!--商品滚动图-->
        <div class="plan_tg">
        	<h4><span>商品介绍</span></h4>
        	<div class="blk_18">
            	<a class="LeftBotton" onmousedown="ISL_GoUp_1()" onmouseup="ISL_StopUp_1()" onmouseout="ISL_StopUp_1()" href="javascript:void(0);" target="_self"></a>
            	<div class="pcont" id="ISL_Cont_1">
              		<div class="ScrCont">
                		<div id="List1_1">
                  		<!-- piclist begin -->
                        	<?php foreach($list as $vo):?>
							<div class="playerdetail">
                            	<a href="<?php echo dy::getWebUrl();?>/goods/detail?id=<?=$vo['id']?>" class="detailimg"><img src="<?=dy::getImgOne($vo['goods_show'])?>" /></a>
                                <div class="teadetail">
                                	<p><?=$vo['goods_name']?></p>
                                    <i><span>¥<?=$vo['price_vip']?></span><a onclick="return addToCart1(<?=$vo['id']?>, '<?php echo dy::getWebUrl();?>')">加入购物车</a></i>
                                </div>
                            </div>
							<?php endforeach;?>
                        </div>
                		<div id="List2_1"></div>
              		</div>
            	</div>
            	<a class="RightBotton" onmousedown="ISL_GoDown_1()" onmouseup="ISL_StopDown_1()" onmouseout="ISL_StopDown_1()" href="javascript:void(0);" target="_self"></a>
            </div>
          	<div class="c"></div>
        	<script type="text/javascript">
            	picrun_ini()
        	</script>
        </div>

    </div>
</div>
<!--content end-->
<script>
/**							
 * 20150608 add by dudanfeng 1  购物车添加	
 **/
/******************** 1 ********************/
function addToCart1(id, url_1){
	var number = document.getElementById('CartNumbers').innerHTML;
	var aa = parseFloat(number)+1;
	
	$.ajax( {
		"type" : "post",
		"url"  : url_1+"/goods/cartadd",
		"dataType" : "json",
		"data" : {
			id  : id,
		},
		"success" : function ( data ){
			if(data > 0){
				dialogCue("加入成功!");
				
				document.getElementById('CartNumbers').innerHTML = aa;
			}else if(data == 0){
				window.location.href=url_1+"/login/index";
			}else if(data == -1){
				dialogCue("已加入!");
			}
		}
	});	
}
/******************** 1 ********************/

</script>