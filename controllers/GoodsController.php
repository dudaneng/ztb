<?php

namespace app\controllers;

use Yii;
use components\BaseFrontController;
use components\dy;
use yii\web\Session;

use app\models\Goods;
use app\models\GoodsTypeBig;
use app\models\GoodsColor;
use app\models\Cart;
use app\models\Activity;
use app\models\User;
use app\models\ActNumber;
use app\models\Order;
use app\models\Restaurant;

class GoodsController extends BaseFrontController
{
	
	//取消前端数据验证
	public $enableCsrfValidation = false;
	
	public $menu = '';
	public $numbers = '';
	public $setting = '';
	
	
	/**
	 * 20150703 add by dudanfng 1 手机和pc端判断
	**/
	/******************** 1 ********************/
	public function beforeAction($action){
		$mobile_browser = dy::getPcorwap();//手机和pc端判定
		
		$id = Yii::$app->request->get('id'); //获取商品id
		
		if($mobile_browser > 0){
			return $this->redirect(['myweb/goods/detail', 'id'=>$id]);
		}  
		return parent::beforeAction($action);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20151106 add by dudanfng 1 商品列表
	**/
	/******************** 1 ********************/
	public function actionIndex(){
		//分页初始化
		$num = 10;
		$start = 0;
		
		$send_id = Yii::$app->request->get('send_id');
		$order = Yii::$app->request->get('order');  //1最新 2红包  3下单价 4数量
		$goods_type_id = Yii::$app->request->get('goods_type');
		
		$str = "send_id=$send_id&order=$order&goods_type=$goods_type_id";//分页属性
		
		if(Yii::$app->request->get('page')){
			$page = Yii::$app->request->get('page');
		}else{
			$page =1;
		}
		
		//获取点击页面
		$page = dy::getPage($num);
		
		//获取每页的初始条数
		$start = dy::getStart($num);
		
		//获取商品总的数量
		$pages = Goods::getPages($num, '', $goods_type_id);
		
		$limit = "limit $start, $num";
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'goods/index', $str);
		
		//获取商品数据
		$list = Goods::getGoodsSelectZbt($start, $num, $order, $send_id, $goods_type_id);
		
		$goods_type = GoodsTypeBig::find()->where(['status'=>1])->all();
		$send_type = GoodsColor::find()->where(['status'=>1])->all();
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('index', ['goods'=>$list, 'pages'=>$pageList, 'goods_type'=>$goods_type, 'send_type'=>$send_type, 'page'=>$page, 'send_id'=>$send_id, 'goods_type_id'=>$goods_type_id, 'order'=>$order]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150608 add by dudanfng 1 购物车
	**/
	/******************** 1 ********************/
    public function actionCart(){
		$connection = Yii::$app->db;
		
		$user_id = dy::getLoginOn();//获取用户id
		
		if($user_id){
			$time = dy::getTimeInfo();//时间选择设置
			
			$row = Cart::getCart($user_id);//读取购物车商品信息
			$list = $row['list'];
			$price = $row['price'];
			
			$this->menu= dy::getAreaSelect();//获取区域
			$this->numbers= dy::getCartNumbers();//获取数量
			$this->setting= dy::getSetting();//版权信息
			
			return $this->render('cart', ['row' => $list, 'time'=>$time, 'price'=>$price]);
		}else{
			return $this->redirect(['login/index']);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150605 add by dudanfng 1 商品详情
	**/
	/******************** 1 ********************/
    public function actionDetail(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->get('id'); //获取商品id
		
		$command = $connection->createCommand("SELECT a.*,b.type_name FROM {{%goods}} as a left join {{%goods_type_big}} as b on b.id=a.type_big WHERE a.status = :a and a.id=$id");
		$command->bindValue(':a', 1);
		$goods = $command->query();//商品数据
		
		$command_1 = $connection->createCommand("SELECT * FROM {{%goods}} WHERE status = :a and is_recommend=1 limit 10");
		$command_1->bindValue(':a', 1);
		$goodslist = $command_1->query();//推荐商品数据
		
		$this->menu= dy::getAreaSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('detail', ['row'=>$goods, 'list'=>$goodslist]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150605 add by dudanfng 1 购物车商品添加
	**/
	/******************** 1 ********************/
    public function actionCartadd(){
		$connection = Yii::$app->db;
		
		$user_id = dy::getLoginOn();//获取用户id
		$id = Yii::$app->request->post('id');
		
		if($user_id){
			$rst = Cart::execAddCart($user_id, $id);
			
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150608 add by dudanfng 1 购物车商品删除
	**/
	/******************** 1 ********************/
    public function actionCartdelete(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->get('id');
		if(!$id){
			$id = Yii::$app->request->post('id');
		}
		
		if($id){
			$data = dy::execDelete('cart', $id);
			
			if($data){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 2;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150608 add by dudanfng 1 购物车商品数量改变
	**/
	/******************** 1 ********************/
    public function actionChangenumbers(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->post('id');//购物车id
		$type = Yii::$app->request->post('type');//方法判断
		$number = Yii::$app->request->post('number');//当前商品数量
		$price1 = Yii::$app->request->post('price1');//当前商品价格
		$allprice = Yii::$app->request->post('allprice');//当前商品总价格
		
		Cart::execUpCartNum($id, $type, $number);//改变数量
		
		$list = Cart::getCartPrice($id);//计算此商品总价格
		$price = $list['price'];
		$goods_number = $list['goods_number'];
		
		$all = $allprice - $price1 + $price;//当前总价格
		
		echo json_encode(array('number'=>$goods_number, 'price'=>$price, 'all' => $all));
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150608 add by dudanfng 1 详情 购物车商品数量改变
	**/
	/******************** 1 ********************/
    public function actionChangedetail(){
		$connection = Yii::$app->db;
		
		$user_id = dy::getLoginOn();//用户id
		
		$id = Yii::$app->request->post('id');
		$number = Yii::$app->request->post('number');
		
		if($user_id){
			$rst = Cart::execAddCart($user_id, $id, $number);//数量改变
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150609 add by dudanfng 1 商品订单
	**/
	/******************** 1 ********************/
    public function actionOrder(){
		$connection = Yii::$app->db;
		
		$user_id = dy::getLoginOn();//用户id
		
		if($user_id){
			if(Yii::$app->request->cookies->get('area_id') != ''){
				$area_id = Yii::$app->request->cookies->get('area_id')->value;//所存商圈id
			}
			
			$time = Yii::$app->request->get('time');//取菜时间
			
			if($time){//自提时间判定
				$session = Yii::$app->session;
				$session->set('get_time', $time);
			}else{
				$session = Yii::$app->session;
				$time = $session->get('get_time');
			}
			
			$set = dy::getSetting();
			$time_set = $set['company_time'];//系统设置每天收菜时间
			$company_notice1 = $set['company_notice1'];//系统设置公司提示1
			
			$resta = array();
			if($area_id){
				$command_1 = $connection->createCommand("SELECT a.*,b.* FROM {{%area_small}} as a left join {{%restaurant}} as b on b.area_small=a.id WHERE a.id=$area_id and b.status=1");
				$command_1->bindValue(':a', 1);
				$area = $command_1->query();//自提点数据
				
				$data_area = '';
				foreach($area as $k => $v){//数据数组化
					$data_area[$k] = $v;
				}
				$resta = $data_area[0]['address'];
			}
			
			$command = $connection->createCommand("SELECT a.*,b.hs_code,b.goods_show,b.price_vip,b.goods_name,b.goods_num FROM {{%cart}} as a left join {{%goods}} as b on b.id=a.goods_id WHERE a.user_id=:a");
			$command->bindValue(':a', $user_id);
			$goodslist = $command->query();//购物车商品数据
			
			$price = '';
			$data = '';
			foreach($goodslist as $k => $v){//购物车商品数据处理
				$price += $v['goods_number'] * $v['price_vip'];
				$data[$k] = $v;
			}
			
			$ac_time = time();
			$command_2 = $connection->createCommand("SELECT a.*,b.* FROM {{%act_number}} as a left join {{%activity}} as b on b.id = a.act_id WHERE a.status=1 and b.type in (2,1) and a.numbers>0 and b.end_time > $ac_time and b.start_time < $ac_time and a.user_id = $user_id;");
			$command_2->bindValue(':a', 1);
			$activity = $command_2->query();//活动列表
			
			$row = array();
			foreach($activity as $k => $v){//数据数组化
				$row[$k] = $v; 
			} 
			
			$user = User::find()->where(['id'=>$user_id])->one();//用户信息
			
			$this->menu= dy::getAreaSelect();//获取区域
			$this->numbers= dy::getCartNumbers();//获取数量
			$this->setting= dy::getSetting();//版权信息
			
			Yii::$app->session->set('allprice', $price);
			
			if($data){
				return $this->render('order', ['area'=> $data_area, 'area_name'=>$resta, 'goodslist'=>$data, 'price'=>$price, 'time'=>$time, 'set_time'=>$time_set, 'activity'=>$row, 'user'=>$user, 'company_notice1'=>$company_notice1]);
			}else{
				return $this->redirect(['cart']);
			}
		}else{
			return $this->redirect(['login/index']);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150609 add by dudanfng 1 商品订单 优惠券选择
	**/
	/******************** 1 ********************/
    public function actionAllprice(){
		$connection = Yii::$app->db;
		
		$session = Yii::$app->session->set('act_id', '');//活动session初始化
		
		$user_id = dy::getLoginOn();//用户id
		
		$id = Yii::$app->request->post('id');//活动id
		
		$command = $connection->createCommand("SELECT a.*,b.hs_code,b.goods_show,b.price_vip,b.goods_name,b.goods_num FROM {{%cart}} as a left join {{%goods}} as b on b.id=a.goods_id WHERE a.user_id=:a");
		$command->bindValue(':a', $user_id);
		$goodslist = $command->query();//购物车商品数据
		
		$price = '';
		foreach($goodslist as $k => $v){
			$price += $v['goods_number'] * $v['price_vip'];
		}//计算商品总价格
		
		if($id == -1){//账号余额计算
			$user = User::find()->where(['id'=>$user_id])->one();
			
			if($price <= $user['money']){
				$allprice = 0;
				$money = $user['money'] - $price;
			}else{
				$allprice = $price - $user['money'];
				$money = 0;
			}
			
			$session = Yii::$app->session;
			$session->set('act_id', $id);
		}else if($id > 0){//其他活动
			$activity = Activity::find()->where(['id' => $id])->one();//活动数据
			
			$ac_numbers = ActNumber::find()->where(['user_id' => $user_id, 'act_id'=>$id])->one();//用户活动数据
		
			if($ac_numbers['numbers'] > 0 && $activity['value1'] <= $price){
				$allprice = $price - $activity['value2'];
				
				if($allprice < 0){
					$allprice = 0;
				}
				
				$session = Yii::$app->session;
				$session->set('act_id', $id);
			}else {
				$allprice = $price;
			}
		}else{
			$allprice = $price;
		}
		
		Yii::$app->session->set('allprice', $allprice);
		
		echo $allprice;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150609 add by dudanfng 1 商品订单 支付数据处理
	**/
	/******************** 1 ********************/
    public function actionPay(){
		$connection = Yii::$app->db;
		$url = dy::getWebUrl();
		
		$user_id = dy::getLoginOn();//用户id
		$area_small = Yii::$app->request->cookies->get('area_id')->value;//商圈id
		$res_id = Yii::$app->request->cookies->get('res_id')->value;//自提点id
		
		$code_user = dy::getRandPW(6,'NUMBER');//用户验证码
		$code_exp = substr(microtime(), 2, 3) . sprintf('%04d%02d', rand(1000, 9999),rand(0,99));//快递验证码
		//生成订单号
		$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
		$order_sn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5);
		
		$remark = Yii::$app->request->post('text');//用戶留言
		$price_all = Yii::$app->request->post('allprice');//商品总价
		$old_price_all = Yii::$app->request->post('oldallprice');//商品总价
		$time = Yii::$app->request->post('time');//提菜时间
		
		$price_all_session = Yii::$app->session->get('allprice');
		
		if($price_all == $price_all_session){
			Yii::$app->session->set('allprice', '');
		}else{
			echo "<script>alert('订单数据有误');window.location.href='$url/goods/order';</script>";
			die;
		}
		
		$goods_list = Cart::find()->where(['user_id' => $user_id])->all();
		
		if($goods_list){
			foreach ($goods_list as $k => $v){
				$arr[$k] = $v['goods_id']; 
				$num[$k] = $v['goods_number'];
				
				$goodscart = Goods::find()->where(['id' => $v['goods_id']])->one();
				$pri[$k] = $goodscart['price_vip'];
			}
			
			$str = implode(',', $arr);//商品id
			$numstr = implode(',', $num);//商品数量
			$pristr = implode(',', $pri);//商品价格
			
			$data = array(
				'user_id'   => $user_id,
				'order_sn'  => $order_sn,
				'user_code' => $code_user,
				'exp_code'  => $code_exp,
				'remark'    => $remark,
				'price_all' => $old_price_all,
				'price_discount' => $price_all,
				'put_address' => $res_id,
				'put_time'  => $time,
				'goods_id'  => $str,
				'goods_num' => $numstr,
				'price_vip' => $pristr,
				'status'    => 1,
				'create_time' => time(),
				'update_time' => time(),
			);
			
			$res = dy::execAdd('order', $data);
			
			$user = User::find()->where(['id'=>$user_id])->one(); 
			
			if($res){
				$act_id = Yii::$app->session->get('act_id');//获取使用优惠活动id
				
				if($act_id == -1){
					if($old_price_all <= $user['money']){
						$money = $user['money'] - $old_price_all;
					}else{
						$money = 0;
					}
					dy::execUpdate('user', array('money'=>$money), $user_id);
				}else if($act_id > 0){
					$command = $connection->createCommand("update  {{%act_number}} set numbers=numbers-1 where act_id=$act_id and user_id=$user_id");
					$command->bindValue(':a', $user_id);
					$command->execute();//修改活动数据
				}
				
				Yii::$app->session->set('act_id', '');//活动session初始化
				
				dy::execAdd('address', array('user_id'=>$user_id, 'area_small'=>$area_small, 'order_sn'=>$order_sn));
						
				dy::execDelete('cart', $user_id, 'user_id');//删除购物车商品
			}
			
			$this->menu= dy::getAreaSelect();//获取区域
			$this->numbers= dy::getCartNumbers();//获取数量
			$this->setting= dy::getSetting();//版权信息
			
			return $this->redirect(['goods/paysub','order_sn'=>$order_sn]);
		}else{
			$order = Order::findBySql("SELECT id FROM {{%order}} where user_id=$user_id order by id desc")->one();

			echo "<script>alert('订单已提交');window.location.href='$url/goods/paysub?id=$order[id]';</script>";
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150616 add by dudanfng 1 商品订单 支付页面
	**/
	/******************** 1 ********************/
    public function actionPaysub(){
		$connection = Yii::$app->db;
		
		$user_id = dy::getLoginOn();//用户id
		
		$id = Yii::$app->request->get('id');//订单id
		$order_sn = Yii::$app->request->get('order_sn');//订单号
		
		if($id){
			$goods_list = Order::find()->where(['id' => $id])->one();
		}else if($order_sn){
			$goods_list = Order::find()->where(['order_sn' => $order_sn])->one();
		}
		
		$this->menu= dy::getAreaSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		if($goods_list['price_discount'] == 0){//余额支付
			if($id){
				dy::execUpdate('order', array('status'=>4), $id);//改变订单支付状态
			}else if($order_sn){
				dy::execStatusUp('order', $order_sn, 4, 'order_sn', 'status');//改变订单支付状态
			}
			dy::execUpdate('user', array('act_status'=>1), $user_id);
			
			$order = Order::find()->where(['order_sn'=>$order_sn])->one();//获取订单信息
				
			$restaurant = Restaurant::find()->where(['id'=>$order['put_address']])->one();//获取自提点信息
			
			$express_s = explode(',', $restaurant['express']);//转化为数组 该区域的快递员id
			
			sort($express_s, SORT_NUMERIC );//进行排序
			
			$express_id = '';
			foreach($express_s as $k =>$v){
				if($v > $restaurant['express_id']){
					$express_id = $v;
					break;
				}
			}
			
			if(empty($express_id)){
				$express_id = $express_s[0];
			}
			
			if($order){
				$data = array(
					'update_time' => time(),
					'status'      => 4,
					'express_id'  => $express_id,
				);
				
				dy::execUpdate('order', $data, $order['id']);//修改订单
				dy::execUpdate('restaurant', array('express_id'=>$express_id), $restaurant['id']);//修改自提点 快递员状态
			}
			
			return $this->redirect(['pay/paysuccess', 'order_sn'=>$order_sn]);
		}else{
			return $this->render('pay', ['order_sn'=> $goods_list['order_sn'], 'user_code'=>$goods_list['user_code'], 'price'=>$goods_list['price_discount']]);
		}
	}
	/******************** 1 ********************/
	
}
