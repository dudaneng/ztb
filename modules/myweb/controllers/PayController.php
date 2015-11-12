<?php

namespace app\modules\myweb\controllers;

use Yii;
use components\BaseFrontController;
use components\dy;
use yii\web\Session;

use app\models\Goods;
use app\models\Cart;
use app\models\Activity;
use app\models\User;
use app\models\ActNumber;
use app\models\Order;
use app\models\Setting;
use app\models\Restaurant;

use components\alipay\alipayconfig;
use components\alipay\lib\alipaynotify;

class PayController extends BaseFrontController
{
	
	//取消前端数据验证
	public $enableCsrfValidation = false;
	
	public $layout = 'main';
	
	public $menu = '';
	public $numbers = '';
	public $setting = '';
	
	/**
	 * 20150608 add by dudanfng 1 购物车
	**/
	/******************** 1 ********************/
    public function actionPaysuccess(){
		$user_id = dy::getLoginOn();//用户id
		
		$order_sn = Yii::$app->request->get('order_sn');//订单号
		
		$order = Order::find()->where(['order_sn' => $order_sn])->one();
		
		$this->menu= dy::getGoodsTypeSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('paysuccess', ['row'=>$order]);
		
	}
	/******************** 1 ********************/
	
	
	/**
	 * 服务器异步通知页面路径
	 */
	public function actionNotify()
	{
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代

			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			
			//获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
			
			//商户订单号

			$out_trade_no = $_POST['out_trade_no'];

			//支付宝交易号

			$trade_no = $_POST['trade_no'];

			//交易状态
			$trade_status = $_POST['trade_status'];


			if($_POST['trade_status'] == 'TRADE_FINISHED') {
				//退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知

				$connection = Yii::$app->db;
				
				$order = Order::find()->where(['order_sn'=>$out_trade_no])->one();
				
				$restaurant = Restaurant::find()->where(['id'=>$order['put_address']])->one();
				
				$express_s = sort(explode(',', $restaurant['express']));//转化为数组 该区域的快递员id
				
				$express_id = '';
				foreach($express_s as $k =>$v){
					if($v > $restaurant['express_id']){
						$express_id = $v;
						break;
					}
				}
				
				if(!empty($express_id)){
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
				
				if($order['price_all'] == $order['price_discount']){
					$actime = time();
					$command = $connection->createCommand("SELECT * FROM {{%activity}} WHERE status=:a and type=1 and start_time <$actime and end_time >$actime;");
					$command->bindValue(':a', 1);
					$activity = $command->query();//活动列表
					
					foreach($activity as $k => $v){
						$act_id[$k]   = !empty($v['id']) ? $v['id'] : '';//活动id
						$numbers[$k]  = !empty($v['ac_numbers']) ? $v['ac_numbers'] : '';//活动次数
						$value2[$k]   = !empty($v['value2']) ? $v['value2'] : '';//优惠值
						$value1[$k]   = !empty($v['value1']) ? $v['value1'] : '';//满值
					}
					
					$value = arsort($value1);
					foreach($value as $k => $v){
						if($order['price_all'] >= $v){
							$key = $k;
							break;
						}
					}
					
					$ac_numbers = ActNumber::find()->andWhere(['act_id'=>$act_id[$key]])->count();//此活动已参加次数
					
					if($ac_numbers < $numbers[$key]){//使用次数少于规定次数
						dy::execAdd('ac_number', array('user_id'=>$order['user_id'], 'act_id'=>$act_id[$key], 'numbers'=>1, 'status'=>1));
					}
				}
				
				$user = User::find()->where(['id'=>$order['user_id']])->one();//获取用户信息
				dy::execUpdate('user', array('act_status'=>1), $user['id']);//改变用户的支付状态
				
				$phone = $user('phone');
				
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
			
			}
			else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
				//付款完成后，支付宝系统发送该交易状态通知
				$connection = Yii::$app->db;
				
				$order = Order::find()->where(['order_sn'=>$out_trade_no])->one();
				
				$restaurant = Restaurant::find()->where(['id'=>$order['put_address']])->one();
				
				$express_s = sort(explode(',', $restaurant['express']));//转化为数组 该区域的快递员id
				
				$express_id = '';
				foreach($express_s as $k =>$v){
					if($v > $restaurant['express_id']){
						$express_id = $v;
						break;
					}
				}
				
				if(!empty($express_id)){
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
				
				if($order['price_all'] == $order['price_discount']){
					$actime = time();
					$command = $connection->createCommand("SELECT * FROM {{%activity}} WHERE status=:a and type=1 and start_time <$actime and end_time >$actime;");
					$command->bindValue(':a', 1);
					$activity = $command->query();//活动列表
					
					foreach($activity as $k => $v){
						$act_id[$k]   = !empty($v['id']) ? $v['id'] : '';//活动id
						$numbers[$k]  = !empty($v['ac_numbers']) ? $v['ac_numbers'] : '';//活动次数
						$value2[$k]   = !empty($v['value2']) ? $v['value2'] : '';//优惠值
						$value1[$k]   = !empty($v['value1']) ? $v['value1'] : '';//满值
					}
					
					$value = arsort($value1);
					foreach($value as $k => $v){
						if($order['price_all'] >= $v){
							$key = $k;
							break;
						}
					}
					
					$ac_numbers = ActNumber::find()->andWhere(['act_id'=>$act_id[$key]])->count();//此活动已参加次数
					
					if($ac_numbers < $numbers[$key]){//使用次数少于规定次数
						dy::execAdd('ac_number', array('user_id'=>$order['user_id'], 'act_id'=>$act_id[$key], 'numbers'=>1, 'status'=>1));
					}
				}
				
				$user = User::find()->where(['id'=>$order['user_id']])->one();//获取用户信息
				
				$phone = $user('phone');
				
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
			}

				
			echo "success";		//请不要修改或删除
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
			//验证失败
			echo "fail";

			//调试用，写文本函数记录程序运行情况是否正常
			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		}
	}
	
	
	/**
	 * 页面跳转同步通知页面路径	 
	 */
	public function actionReturn(){
		
		$alipay_config = 1;
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		
		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码
			
			$out_trade_no = $_GET['out_trade_no'];//商户订单号

			$trade_no = $_GET['trade_no'];//支付宝交易号

			$trade_status = $_GET['trade_status'];//交易状态

			//判断该笔订单是否在商户网站中已经做过处理
			if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
				/**
				$connection = Yii::$app->db;
				
				$order = Order::find()->where(['order_sn'=>$out_trade_no])->one;
				if($order){
					dy::execStatusUp('order',$out_trade_no,4,'order_sn','status');//修改订单状态
				}
				
				$user = User::find()->where(['id'=>$order['user_id']])->one();//获取用户信息
				
				$phone = $user('phone');
				
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
				**/
				return $this->render('paysuccess');
			}
			else {
			  echo "trade_status=".$_GET['trade_status'];
			}
				
			echo "验证成功<br />";

			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
			//验证失败
			//如要调试，请看alipay_notify.php页面的verifyReturn函数
			echo "验证失败";
		}		
	}
}
