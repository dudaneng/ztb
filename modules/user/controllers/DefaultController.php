<?php

namespace app\modules\user\controllers;

use Yii;
use components\BaseBackController;
use components\dy;

use app\models\Order;
use app\models\Goods;
use app\models\GoodsTypeSmall;
use app\models\GoodsTypeBig;
use app\models\Shop;

use app\models\AreaBig;
use app\models\AreaMiddle;
use app\models\AreaSmall;

use app\models\User;
use app\models\Address;
use app\models\Restaurant;

class DefaultController extends BaseBackController
{
    //取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	/**
	 * 20150529 add by dudanfeng 1 订单列表
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		//$this->layout = false;//禁止layout
		
		$express_id = dy::getLoginOne('express_id');
		//print_r($express_id);exit;
		if($express_id){
			$keyword = Yii::$app->request->get('keyword');
			$type = Yii::$app->request->get('type');
			
			$str = "type=$type&keyword=$keyword";//分页属性
			
			//分页初始化
			$num = 10;
			$page = 1;
			$start = 0;
			
			//获取点击页面
			$page = dy::getPage($num);
			
			//获取每页的初始条数
			$start = dy::getStart($num);
			
			//获取数据总的数量
			$pages = Order::getPages($num, $keyword, $type);
			
			//调用分页样式
			$pageList = dy::getPageList($page, $pages, 'index', $str);
			
			//获取广告数据
			$list = Order::getOrder($start, $num, $keyword, $type);
			//print_r(4);exit;
			return $this->render('index',['row'=>$list, 'page'=>$pageList]); 
		}else{
			return $this->redirect(['site/user']);
		}
	}
	/******************** 1 ********************/
	
}
