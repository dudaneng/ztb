<?php
/**
 * 订单管理
 * 20150529 add by dudanfeng
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

class OrderController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	/**
	 * 20150529 add by dudanfeng 1 订单列表
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		
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
		
		$set = dy::getSetting();
		$time_set = $set['company_time'];//自提时间点
		
		return $this->render('index',['row'=>$list, 'page'=>$pageList, 'set_time'=>$time_set, 'pages'=>$page]); 
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
	 * 20150529 add by dudanfeng 1 订单发货 	  
	**/
	/******************** 1 ********************/
	public function actionResume(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		$page = Yii::$app->request->get('page');
		
		$rst = dy::execStatusUp('order', $id, 6);//改变状态
		
		return $this->redirect(['index', 'type'=>2, 'page'=>$page]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150529 add by dudanfeng 1 用户地址
	**/
	/******************** 1 ********************/
	public function actionAddress(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$order = Order::find()->where(['id'=>$id])->one(); //订单信息
		
		$user = User::find()->where(['id' => $order['user_id']])->one();//用户信息
		
		$rest = Restaurant::find()->where(['id' => $order['put_address']])->one();//自提点信息
		
		$area = AreaSmall::find()->where(['id' => $rest['area_small']])->one();//商圈信息
		
		return $this->render('address',['rest'=>$rest, 'user'=>$user, 'area'=>$area]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150529 add by dudanfeng 1 订单详情
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
		return $this->render('detail',['row'=>$orderlist, 'goods'=>$goods]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150630 add by dudanfeng 1 快递详情
	**/
	/******************** 1 ********************/
	public function actionExpress(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->get('id');
		
		$order = Order::find()->where(['id' => $id])->one();//订单信息
		
		$express = User::find()->where(['id'=>$order['express_id'], 'status'=>1,'group_id'=>2])->one();//当前快递员信息
		
		$address = Restaurant:: find()->where(['id'=>$order['put_address'], 'status'=>1])->one();//自提点信息
		
		$arr = explode(',', $address['express']);
		
		$user_list = array();
		foreach($arr as $k => $v){
			$user_list[$k] = User::find()->where(['id'=>$v, 'status'=>1,'group_id'=>2])->one();//可选快递员信息
		}
		
		return $this->render('express',['row'=>$user_list, 'express'=>$express]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150804 add by dudanfeng 1 商品打印
	**/
	/******************** 1 ********************/
	public function actionPrintgoods(){
		$this->layout = false;
		
		$allorder = Order::getOrderAll();
		
		$arr = array();
		$num = 0;
		
		foreach($allorder as $k => $v){
			foreach($v['goods_id'] as $key => $vol){
				$row = Goods::find()->where(['id'=>$vol])->one();
				$arr[$num]['goods_name'] = $row['goods_name'];
				$arr[$num]['goods_price'] = $row['price_vip'];
				$num++;
			}
			$order_arr[] = $v['order_id'];
		}
		Yii::$app->session->set('order_arr', $order_arr);
		
		return $this->render('print',['ordergoods'=>$arr]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150804 add by dudanfeng 1 商品打印
	**/
	/******************** 1 ********************/
	public function actionPrintbill(){
		$order_id = Yii::$app->session->get('order_arr');
		
		foreach($order_id as $v){
			$row = dy::execStatusUp('order', $v, 1, 'id', 'bill_flag');
		}
		
		if($row){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
}	

	

