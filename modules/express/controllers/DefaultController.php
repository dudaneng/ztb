<?php

namespace app\modules\express\controllers;

use Yii;
use components\BaseBackController;
use components\dy;

use app\models\Order;
use app\models\AreaBig;
use app\models\AreaMiddle;
use app\models\AreaSmall;
use app\models\Setting;
use app\models\User;
use app\models\Address;
use app\models\Restaurant;
use app\models\Cabinet;
use app\models\CabinetBox;
use app\models\Goods;

header("Content-type: text/html; charset=utf-8");

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
		$this->layout = false;
		
		$express_id = dy::getLoginOne('express_id');//获取快递员id
		
		if($express_id){
			$order_list = Order::find()->where(['express_id'=>$express_id, 'status'=>[4,6]])->all();//特定订单
			
			return $this->render('index',['row'=>$order_list]); 
		}else{
			return $this->redirect(['site/express']);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150529 add by dudanfeng 1 用户地址
	**/
	/******************** 1 ********************/
	public function actionAddress(){
		$this->layout = false;
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$order = Order::find()->where(['id'=>$id])->one(); //订单信息
		
		$user = User::find()->where(['id' => $order['user_id']])->one();//用户信息
		
		$rest = Restaurant::find()->where(['id' => $order['put_address']])->one();//自提点信息
		
		$area = AreaSmall::find()->where(['id' => $rest['area_small']])->one();//商圈信息
		
		return $this->render('address',['rest'=>$rest, 'user'=>$user, 'area'=>$area]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150703 add by dudanfeng 1 盒子确认
	**/
	/******************** 1 ********************/
	public function actionBoxselect(){
		$this->layout = false;
		
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$order = Order::find()->where(['id'=>$id])->one(); //订单信息
		
		$rest = Restaurant::find()->where(['id' => $order['put_address']])->one();//自提点信息
		
		$cab_id = explode(',', $rest['cab_id']);//转化为数组
		
		foreach($cab_id as $k => $v){
			$command = $connection->createCommand("SELECT * FROM {{%cabinet}} WHERE status>-1 and id=:a");
			$command->bindValue(':a', $v);
			$list[$k] = $command->query();
		}
		
		foreach($list as $k => $v){
			foreach($v as $ke => $vo){
				$data[$k] = $vo;
			}
		}
		
		foreach($data as $k => $v){
			//获取盒子数据
			$command_m = $connection->createCommand("SELECT * FROM {{%cabinet_box}} WHERE status>=0 and cab_id={$v['id']}");
			$command_m->bindValue(':a', 1);
			$command_m->bindValue(':b', 0);
			$list_m[$k] = $command_m->query();
			
			foreach($list_m[$k] as $ke => $vo){
				$data[$k]['box'][$ke] = $vo;
			}
		}
		
		$goods_info = array();//商品信息
		$goods_id = explode(',', $order['goods_id']);
		foreach($goods_id as $k => $v){
			$goods = Goods::find()->where(['id' => $v])->one();
			
			$arr = array(
				'id' => $v,
				'goods_show' => dy::getImgOne($goods['goods_show']),
				'goods_name' => $goods['goods_name'],
			);
			
			$goods_info[$k] = $arr;
		}
		
		if($order['cbox_id']){//订单已分配箱子信息
			$box_id = $order['cbox_id'];
			
			$command_box = $connection->createCommand("SELECT a.*,b.* FROM {{%cabinet_box}} as a left join {{%cabinet}} as b on b.id=a.cab_id  WHERE a.id=$box_id");
			$command_box->bindValue(':a', 1);
			$command_box->bindValue(':b', 0);
			$list_box = $command_box->query();//获取盒子数据
			
			$area = AreaSmall::find()->where(['id' => $rest['area_small']])->one();//商圈信息
			
			return $this->render('boxdetail',['row'=>$list_box, 'rest'=>$rest, 'area'=>$area]); 
		}else{
			return $this->render('boxselect',['row'=>$data, 'order_id'=>$id, 'user_code'=>$order['user_code'], 'goods_info'=>$goods_info]); 
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150703 add by dudanfeng 1 盒子开关
	**/
	/******************** 1 ********************/
	public function actionOpenbox(){
		$cab_name = Yii::$app->request->get('cab_name');
		$box_name = Yii::$app->request->get('box_name');
		
		echo "打开".$cab_name."柜子".$box_name."柜门";//打开柜子命令
	}	
	/******************** 1 ********************/
	
	
	/**
	 * 20150703 add by dudanfeng 1 盒子状态改变
	**/
	/******************** 1 ********************/
	public function actionOkbox(){
		
		$aa = '返回testtesttest柜子01柜门true门开false探物';
		if($aa){
			$id = Yii::$app->request->get('id');
			$order_id = Yii::$app->request->get('order_id');
			
			$rst1 = dy::execUpdate('cabinet_box', array('contact'=>3), $id);//改变状态
			
			$rst = dy::execUpdate('order', array('cbox_id'=>$id), $order_id);
			
			$order = Order::find()->where(['id' => $order_id])->one();
			
			$user = User::find()->where(['id' => $order['user_id']])->one();
			
			$phone = $user['user_phone'];
				
			$list = Setting::find()->where(['scope' => 'sms'])->all(); //获取系统手机设置
			
			foreach($list as $k => $v){
				if($v['variable'] == 'sms_set'){
					$sms_set = $v['value'];
				}else if($v['variable'] == 'sms_account'){
					$sms_account = $v['value']; //账号
				}else if($v['variable'] == 'sms_password'){
					$sms_password = $v['value']; // 密码
				}
			}
			
			$code = $order['user_code'];
			
			$result = dy::sendCode ( $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit",$sms_account, $sms_password, $phone, $code);
			
			if($rst && $rst1){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 2;
		}
	}
	/******************** 1 ********************/
}
