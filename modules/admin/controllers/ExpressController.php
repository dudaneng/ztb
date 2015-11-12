<?php
/**
 * 订单管理 快递员管理
 * 20150629 add by dudanfeng
**/
namespace app\modules\admin\controllers;

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

class ExpressController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	/**
	 * 20150529 add by dudanfeng 1 订单列表
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		$this->layout = false;//禁止layout
		
		$express_id = dy::getLoginOne('express_id');
		
		if($express_id){
			$keyword = Yii::$app->request->get('keyword');
			$type = Yii::$app->request->get('type');
			
			$str = "type=$type&keyword=$keyword";//分页属性
			
			//分页初始化
			$num = 2;
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
			
			return $this->render('index',['row'=>$list, 'page'=>$pageList]); 
		}else{
			return $this->redirect(['site/express']);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 订单删除
	**/
	/******************** 1 ********************/
	public function actionDelete(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('order', $id, 0);//改变状态
		
		if($rst){
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150529 add by dudanfeng 1 启用订单 	  
	**/
	/******************** 1 ********************/
	public function actionResume(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('order', $id, 1, 'id', 'delivery');//改变状态
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
		
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150529 add by dudanfeng 1 用户地址
	**/
	/******************** 1 ********************/
	public function actionAddress(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$user = User::find()->where(['id' => $id])->one();
		
		$address = Address::find()->where(['user_id' => $id])->one();
		
		$area_big = AreaBig::find()->where(['id' => $address['area_big']])->one();

		$area_middle = AreaMiddle::find()->where(['id' => $address['area_middle']])->one();
		
		$area_small = AreaSmall::find()->where(['id' => $address['area_small']])->one();
		
		$rest = Restaurant::find()->where(['id' => $area_small['id']])->one();
		
		return $this->render('address',['area_big'=>$area_big, 'rest'=>$rest, 'user'=>$user, 'area_middle'=>$area_middle, 'area_small'=>$area_small]); 
	}
	/******************** 1 ********************/
	
	/**
	 * 20150529 add by dudanfeng 1 用户地址
	**/
	/******************** 1 ********************/
	public function actionDetail(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->get('id');
		
		$orderlist = Order::find()->where(['id' => $id])->all();
		
		foreach($orderlist as $k => $v){
			$user_list = User::find()->where(['id' => $v['user_id']])->one();
			$orderlist[$k]['goods_id'] = explode(',', $v['goods_id']);
			$orderlist[$k]['goods_num'] = explode(',', $v['goods_num']);
			$orderlist[$k]['user_id'] = $user_list['user_name'];
			foreach($orderlist[$k]['goods_id'] as $ke => $vo){
				$goods[$v['order_sn']][$ke] = Goods::find()->where(['id' => $vo])->one();
			}
			
			foreach($orderlist[$k]['goods_num'] as $ke => $vo){
				$goods[$v['order_sn']][$ke]['goods_num'] = $vo;
			}
		}
		//print_r($goods);exit;
		return $this->render('detail',['row'=>$orderlist, 'goods'=>$goods]); 
	}
	/******************** 1 ********************/
}	

	

