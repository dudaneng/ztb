<?php

namespace app\modules\myweb\controllers;

use Yii;
use components\BaseFrontController;
use components\dy;
use yii\web\Session;

use app\models\Goods;
use app\models\GoodsTypeSmall;
use app\models\AreaBig;
use app\models\AreaMiddle;
use app\models\AreaSmall;
use app\models\User;
use app\models\Order;
use app\models\Setting;
use app\models\Activity;
use app\models\ActNumber;
use app\models\Restaurant;

class PersonController extends BaseFrontController
{
	
	//取消前端数据验证
	public $enableCsrfValidation = false;
	
	public $layout = 'main';
	
	public $menu = '';
	public $numbers = '';
	public $setting = '';
	
	/**
	 * 20150610 add by dudanfng 1 首页
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		$connection = Yii::$app->db;
		
		$user_id = dy::getLoginOn();//用户id
		
		if($user_id){
			$user = User::find()->where(['id'=>$user_id])->one();
			
			$command = $connection->createCommand("SELECT id,status FROM {{%order}} WHERE user_id=:a");
			$command->bindValue(':a', $user_id);
			$order = $command->query();//订单数据
			
			$num1 = '';
			$num2 = '';
			$num3 = '';
			$num4 = '';
			foreach($order as $v){
				if($v['status'] == 1){//未付款订单
					$num1++;
				}else if($v['status'] >=4 && $v['status'] <9){//进行中订单
					$num2++;
				}else if($v['status'] == 9){//已完成订单
					$num3++;
				}
			}
			
			$command_1 = $connection->createCommand("SELECT id FROM {{%act_number}} WHERE user_id=:a and numbers>0");
			$command_1->bindValue(':a', $user_id);
			$act = $command_1->query();//订单数据
			
			$num4 = count($act);
			
			$this->menu= dy::getGoodsTypeSelect();//获取区域
			$this->numbers= dy::getCartNumbers();//获取数量
			$this->setting= dy::getSetting();//版权信息
			
			return $this->render('index', ['row'=>$user, 'num1'=>$num1, 'num2'=>$num2, 'num3'=>$num3, 'num4'=>$num4]);
		}else{
			return $this->redirect(['login/index']);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150701 add by dudanfng 1 订单列表
	**/
	/******************** 1 ********************/
    public function actionOrder(){
		$connection = Yii::$app->db;
		
		$user_id = dy::getLoginOn();//用户id
		$type = Yii::$app->request->get('type');
		
		if($user_id){
			
			$str = "type=$type";
			
			//分页初始化
			$num = 2;
			$page = 1;
			$start = 0;
			
			//获取点击页面
			$page = dy::getPage($num);
			
			//获取每页的初始条数
			$start = dy::getStart($num);
			
			//获取商品类型总的数量
			$pages = Order::getPagesHome($num, $type, $user_id);
			
			//调用分页样式
			$pageList = dy::getPageList($page, $pages, 'order', $str);
			
			//获取商品类型数据
			$list = Order::getOrderHome($start, $num, $user_id, $type);
			
			$data = array();
			foreach($list as $k => $v){
				$data[$k] = $v;
			}
			
			foreach($data as $k =>$v){
				$data[$k]['goods_id'] = explode(',', $v['goods_id']);
				
				foreach($data[$k]['goods_id'] as $ke => $vo){
					$goods[$ke] = Goods::find()->where(['id' => $vo])->one();
					
					$arr[$ke] = array(
						'id' => $goods[$ke]['id'],
						'goods_show' => $goods[$ke]['goods_show'],
						'goods_name' => $goods[$ke]['goods_name'],
					);
					
					$data[$k]['goods_id'][$ke] = $arr[$ke];
				}
			}
			
			$set = dy::getSetting();
			$time_set = $set['company_time'];//自提时间点
			
			$this->menu= dy::getGoodsTypeSelect();//获取区域
			$this->numbers= dy::getCartNumbers();//获取数量
			$this->setting= dy::getSetting();//版权信息
			
			return $this->render('order', ['row'=>$data, 'page'=>$pageList, 'type'=>$type, 'time_set'=>$time_set]);
		}else{
			return $this->redirect(['login/index']);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150610 add by dudanfng 1 订单详情
	**/
	/******************** 1 ********************/
    public function actionOrderinfo(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->get('id');
		
		$orderlist = Order::find()->where(['id' => $id])->all(); //获取订单信息
		
		foreach($orderlist as $k => $v){
			$user_list = User::find()->where(['id' => $v['user_id']])->one();//获取用户信息
			
			$orderlist[$k]['goods_id'] = explode(',', $v['goods_id']);//解析字符串为数组
			$orderlist[$k]['goods_num'] = explode(',', $v['goods_num']);//解析字符串为数组
			$orderlist[$k]['user_id'] = $user_list['user_name'];
			
			foreach($orderlist[$k]['goods_id'] as $ke => $vo){
				$goods[$v['order_sn']][$ke] = Goods::find()->where(['id' => $vo])->one();
			}
			
			foreach($orderlist[$k]['goods_num'] as $ke => $vo){
				$goods[$v['order_sn']][$ke]['goods_num'] = $vo;
			}
			
			$res = '';
			$area = '';
			if($v['put_address'] != ''){
				$res = Restaurant::find()->where(['id'=>$v['put_address']])->one();//自提点信息
				
				$area = AreaSmall::find()->where(['id'=>$res['area_small']])->one();//自提点信息
			}
		}
		
		$set = dy::getSetting();
		$time_set = $set['company_time'];//自提时间点
		
		$this->menu= dy::getGoodsTypeSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('orderinfo', ['row'=>$orderlist, 'goods'=>$goods, 'res'=>$res, 'area'=>$area, 'time_set'=>$time_set]);
	
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150610 add by dudanfeng 1 订单状态改变
	**/
	/******************** 1 ********************/
	public function actionForbid(){
		
		$type = Yii::$app->request->get('type');//获取表单数据
		$id = Yii::$app->request->get('id');//获取表单数据
		
		if($type == 1){
			$data = array(
				'status' => 2,
				'update_time' => time(),
			);
			
			$rst = dy::execUpdate('order', $data, $id);//改变状态
		}else if($type == 2){
			$data = array(
				'status' => 9,
				'update_time' => time(),
			);
			
			$rst = dy::execUpdate('order', $data, $id);//改变状态
		}else{
			$rst = '';
		}
		
		if($rst){
			return $this->redirect(['index']);
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150610 add by dudanfeng 1 个人信息  修改个人信息
	**/
	/******************** 1 ********************/
	public function actionUser(){
		$user_id = dy::getLoginOn();//用户id
		
		$user = User::find()->where(['id' => $user_id])->one();//获取用户信息
		
		$this->menu= dy::getGoodsTypeSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		if($user_id){
			return $this->render('user', ['row'=>$user]);
		}else{
			return $this->redirect(['login/index']);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150610 add by dudanfeng 1 个人信息  修改个人信息  提交
	**/
	/******************** 1 ********************/
	public function actionUsersubmit(){
		$user_id = dy::getLoginOn();//用户id
		$user_name = Yii::$app->request->post('user_name');
		
		$data = array(
			'user_name' => Yii::$app->request->post('user_name'),
			'user_email' => Yii::$app->request->post('email'),
			'update_time' => time(),
		);
		
		$rst = dy::execUpdate('user', $data, $user_id);//用户信息修改
		
		if($rst){
			$session = Yii::$app->session;
			$session->set('user_name', $user_name);//session保存
			
			$cookies = Yii::$app->response->cookies;//cookie保存
			$cookies->add(new \yii\web\Cookie([
				'name' => 'user_name',
				'value' => $user_name,
			]));
			
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	
	/**
	 * 20150610 add by dudanfeng 1 个人信息  修改密码
	**/
	/******************** 1 ********************/
	public function actionPassword(){
		$id = Yii::$app->request->get('id');//获取表单数据
		$user_id = dy::getLoginOn();//用户id
		
		$this->menu= dy::getGoodsTypeSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		if($user_id){
			return $this->render('password');
		}else{
			return $this->redirect(['login/index']);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150610 add by dudanfeng 1 个人信息  修改密码  提交
	**/
	/******************** 1 ********************/
	public function actionPasswordsub(){
		$user_id = dy::getLoginOn();//用户id
		
		$password = Yii::$app->request->post('re_password'); //旧密码
		$ne_password = Yii::$app->request->post('ne_password');//新密码
		
		$row = User::find()->where(['id' => $user_id, 'user_password'=>md5($password)])->one();//用户查询
		
		if($row){
			$data = array(
				'user_password' => md5($ne_password),
				'set_password' => $ne_password,
				'update_time' => time(),
			);
			
			$rst = dy::execUpdate('user', $data, $user_id);
			
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150610 add by dudanfeng 1 个人信息  修改手机号
	**/
	/******************** 1 ********************/
	public function actionPhone(){
		$user_id = dy::getLoginOn();//用户id
		
		$user = User::find()->where(['id' => $user_id])->one(); //获取用户信息
		
		$this->menu= dy::getGoodsTypeSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		if($user_id){//登陆判断
			return $this->render('phone', ['row'=>$user]);
		}else{
			return $this->redirect(['login/index']);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150610 add by dudanfeng 1 个人信息  修改手机号 原手机获取验证码
	**/
	/******************** 1 ********************/
	public function actionPhonerecode(){
		$user_id = dy::getLoginOn();//用户id
		
		$phone = Yii::$app->request->post('phone');
		
		$list = Setting::find()->where(['scope' => 'sms'])->all(); //获取手机设置
		
		foreach($list as $k => $v){
			if($v['variable'] == 'sms_set'){
				$sms_set = $v['value'];
			}else if($v['variable'] == 'sms_account'){
				$sms_account = $v['value']; //账号
			}else if($v['variable'] == 'sms_password'){
				$sms_password = $v['value']; // 密码
			}
		}
		
		$code = dy::getRandPW(4, 'NUMBER');
		
		$result = dy::sendCode ( $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit",$sms_account, $sms_password, $phone, $code);
		
		if($result){
			$session = Yii::$app->session;
			$session->set('re_code', $code);
			
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150610 add by dudanfeng 1 个人信息  修改手机号 验证手机码
	**/
	/******************** 1 ********************/
	public function actionVerecode(){
		$user_id = dy::getLoginOn();//用户id
		
		$code = Yii::$app->request->post('code');
		
		$code_right = $session = Yii::$app->session->get('re_code');
		
		if($code == $code_right){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150610 add by dudanfeng 1 个人信息  修改手机号 原手机获取验证码
	**/
	/******************** 1 ********************/
	public function actionPhonecodenew(){
		$user_id = dy::getLoginOn();//用户id
		
		$phone = Yii::$app->request->post('phone');
		
		$user = User::find()->where(['user_phone'=>$phone])->all();
		
		$list = Setting::find()->where(['scope' => 'sms'])->all(); //获取手机设置
		
		foreach($list as $k => $v){
			if($v['variable'] == 'sms_set'){
				$sms_set = $v['value'];
			}else if($v['variable'] == 'sms_account'){
				$sms_account = $v['value']; //账号
			}else if($v['variable'] == 'sms_password'){
				$sms_password = $v['value']; // 密码
			}
		}
		
		$code = dy::getRandPW(4, 'NUMBER');
		
		if(!$user){
			$result = dy::sendCode ( $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit",$sms_account, $sms_password, $phone, $code);
			
			if($result){
				$session = Yii::$app->session;
				$session->set('new_code', $code);
				$session->set('new_phone', $phone);
				
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
	 * 20150610 add by dudanfeng 1 个人信息  修改手机号 验证手机码
	**/
	/******************** 1 ********************/
	public function actionVerecodenew(){
		$user_id = dy::getLoginOn();//用户id
		
		$code = Yii::$app->request->post('code');
		
		$code_right = Yii::$app->session->get('new_code');
		
		if($code == $code_right){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150610 add by dudanfeng 1 个人信息  修改手机号  提交
	**/
	/******************** 1 ********************/
	public function actionPhonesubmit(){
		$user_id = dy::getLoginOn();//用户id
		
		$phone = Yii::$app->request->post('phone');
		$code = Yii::$app->request->post('code');
		$phone_right = Yii::$app->session->get('new_phone');
		$code_right = Yii::$app->session->get('new_code');
		
		if($phone == $phone_right && $code == $code_right){
			
			$row = User::find()->where(['user_phone'=>$phone])->one();
			
			if($row){
				echo 2;
			}else{
				$data = array(
					'user_phone' => $phone,
					'update_time' => time(),
				);
				
				$rst = dy::execUpdate('user', $data, $user_id);
				
				echo 1;
			}
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150616 add by dudanfng 1 优惠券列表
	**/
	/******************** 1 ********************/
    public function actionActivity(){
		$connection = Yii::$app->db;
		
		$user_id = dy::getLoginOn();//用户id
		
		$act_list = User::find()->where(['activity'=>$user_id])->one();
		
		$command = $connection->createCommand("SELECT a.*,b.*,b.id as act_id FROM {{%act_number}} as a left join {{%activity}} as b on b.id=a.act_id WHERE a.user_id=$user_id and a.status=:a and a.numbers > 0;");
		$command->bindValue(':a', 1);
		$activity = $command->query();//活动列表
		
		$myact = User::find()->where(['id'=>$user_id])->one();
		
		$money = Activity::find()->where(['type'=>3,  'status'=>1])->one();
		
		$this->menu= dy::getGoodsTypeSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('activity', ['row'=>$activity, 'act'=>$myact, 'money'=>$money]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150613 add by dudanfng 1 领取注册优惠券
	**/
	/******************** 1 ********************/
    public function actionActivitysub(){
		$connection = Yii::$app->db;
		
		$user_id = dy::getLoginOn();//用户id
		$reccode = Yii::$app->request->post('reccode');//推荐码
		
		$actime = time();
		$command = $connection->createCommand("SELECT * FROM {{%activity}} WHERE status=:a and type=3 and end_time >$actime limit 1;");
		$command->bindValue(':a', 1);
		$activity = $command->query();//活动列表
		
		$user = User::find()->where(['id'=>$user_id])->one();//用户信息
		
		if($activity){
			if(!$user['activity_id']){
				$myact = User::find()->where(['activity'=>$reccode])->one();//推荐人信息
				
				if($myact != '' && $user['activity'] != $reccode && $user_id != $myact['activity_id']){
					foreach($activity as $v){
						$act_id  = $v['id'];
						$numbers  = $v['ac_numbers'];
						$value2 = $v['value2'];
					}
					
					$money = $user['money'] + $value2; //用户余额
					$money_ac = $myact['money'] + $value2;//推荐用户余额
					
					$ac_data = array(//用户信息
						'activity_id'   => $myact['id'],
						'money'  => $money,
						
					);
					
					dy::execUpdate('user', $ac_data, $user_id);
					
					/* $ac_data1 = array(
						'money'  => $money_ac,
					);
					
					dy::execUpdate('user', $ac_data1, $myact['id']);
					 */
					echo 1;
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
}
