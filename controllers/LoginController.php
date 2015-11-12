<?php
namespace app\controllers;

use Yii;
use components\BaseFrontController;
use components\dy;
use yii\web\Session;
use app\models\User;
use app\models\Setting;
use app\models\ActNumber;

class LoginController extends BaseFrontController
{
	
	//取消前端数据验证
	public $enableCsrfValidation = false;
	
	public $menu = '';
	public $numbers = '';
	public $setting = '';
	
	
	/**
	 * 20150703 add by dudanfng 1 权限判断
	**/
	/******************** 1 ********************/
	public function beforeAction($action){
		$mobile_browser = dy::getPcorwap();//手机和pc端判定
		
		if($mobile_browser > 0){
			return $this->redirect(['myweb/default/index']);
		}  
		return parent::beforeAction($action);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150519 add by dudanfeng 1 登陆界面
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		$session = Yii::$app->session;
		$user_id = $session->get('user_id');
		
		$user = '';
		if(Yii::$app->request->cookies->get('user_phone') != ''){
			$user = Yii::$app->request->cookies->get('user_phone')->value;//获取用户账户
		}
		
		$this->menu= dy::getAreaSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		if($user_id){
			return $this->redirect(['person/index']);
		}else{
			return $this->render('index', ['user'=>$user]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150519 add by dudanfeng 1 用户登陆
	**/
	/******************** 1 ********************/
    public function actionLogin(){
		$connection = Yii::$app->db;
		
		$data = Yii::$app->request->post();
		
		$list = User::find()->where(['user_phone' => $data['user'], 'user_password' => md5($data['user_password'])])->one();
		if($list){
			if($list['status'] == 1){
				$session = Yii::$app->session;
				$session->set('user_id', $list['id']);
				$session->set('user_account', $list['user_account']);
				$session->set('user_name', $list['user_name']);//session存储用户信息
				
				if(Yii::$app->request->post('checked')){//创建cookie存储信息
					$cookies = Yii::$app->response->cookies;
					
					$cookies->add(new \yii\web\Cookie([
						'name' => 'user_phone',
						'value' => $list['user_phone'],//手机号
					]));
					$cookies->add(new \yii\web\Cookie([
						'name' => 'user_name',
						'value' => $list['user_name'],//用户名
					]));
					$cookies->add(new \yii\web\Cookie([
						'name' => 'user_id',
						'value' => $list['id'],//用户id
					]));
				}
				
				dy::execUpdate('user', array('last_time'=>time()), $list['id']);//记录用户登录的时间
				
				$ac_time = time();
				$command = $connection->createCommand("SELECT * FROM {{%activity}} WHERE status=:a and type=2 and end_time >= $ac_time and start_time <= $ac_time;");
				$command->bindValue(':a', 1);
				$activity = $command->query();//活动类型2 数据列表 满多少减多少
				
				foreach($activity as $v){
					$ac_numbers = ActNumber::find()->where(['user_id' => $list['id'], 'act_id'=>$v['id']])->one();//活动数据
					
					if(!$ac_numbers){
						$ac_data = array(
							'user_id'  => $list['id'],
							'act_id'   => $v['id'],
							'numbers'  => $v['ac_numbers'],
							'status'   => 1,
							'update_time' =>time(),
						);
						
						dy::execAdd('act_number', $ac_data);
						
						$content = "您获得了".$v['ac_numbers']."张，满".$v['value1']."送".$v['value2']."活动券";
						dy::getWeixinInfo($list['openid'], $content);//微信通知消息
					}
				}
				
				$actime = time();
				$command1 = $connection->createCommand("SELECT * FROM {{%activity}} WHERE status=:a and type=3 and end_time >$actime limit 1;");
				$command1->bindValue(':a', 1);
				$activity1 = $command1->query();//活动列表 推荐注册送优惠
				
				if($activity1){
					$act_user_list = User::find()->where(['activity_id'=>$list['id']])->all();//使用推荐码的用户信息
					
					foreach($activity1 as $v){//活动优惠值
						$act_id  = $v['id'];
						$numbers  = $v['ac_numbers'];
						$value2 = $v['value2'];
					}
					
					$all_value = '';
					foreach($act_user_list as $v){//使用推荐码的用户信息
						if($v['act_status'] == 1){
							$all_value += $value2;
							
							dy::execUpdate('user', array('act_status' => 3), $v['id']);
						}
					}
					$all_value += $list['money'];
					
					dy::execUpdate('user', array('money'=>$all_value), $list['id']);
				}
				echo 1;
			}else if($list['status'] == 0){
				echo 0;
			}
		}else{
			echo 2;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150520 add by dudanfeng 1 退出登陆
	**/
	/******************** 1 ********************/
    public function actionLogout(){
		
		$session = Yii::$app->session;
		$session->set('user_id', '');
		$session->set('user_account', '');
			
		return $this->redirect(['login/index']);
	}
	/******************** 1 ********************/
	
	/**
	 * 20150605 add by dudanfeng 1 用户注册
	**/
	/******************** 1 ********************/
	public function actionRegister(){
		$list = Setting::find()->where(['scope' => 'sms'])->all(); //获取手机设置
		
		foreach($list as $k => $v){
			if($v['variable'] == 'sms_set'){
				$sms_set = $v['value'];
			}
		}
		
		$this->menu= dy::getAreaSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('register', ['sms_set' => $sms_set]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150604 add by dudanfeng 1 用户注册 数据提交
	**/
	/******************** 1 ********************/
	public function actionRegistersubmit(){
		$data = Yii::$app->request->post();
		$phone_session = Yii::$app->session->get('phone');
		
		if($phone_session == $data['user_phone']){
			$list = User::find()->where(['user_phone' => $data['user_phone']])->one();
			if($list){
				echo 0;
			}else{
				$rec_act = dy::getRandPW(8); //推荐码
				$row = array(
					'user_name' => $data['user_account'],
					'user_phone' => $data['user_phone'],
					'user_password' => md5($data['user_password']),
					'set_password' => $data['user_password'],
					'create_time' => time(),
					'update_time' => time(),
					'activity'     => $rec_act,
					'check_phone' => 1,
					
				);
				$rst = dy::execAdd('user', $row);//添加用户
				if($rst){
					$list = User::find()->where(['user_phone' => $data['user_phone']])->one();
					echo 1;
				}else{
					echo 2;
				}
			}
		}else{
			echo 3;
		}
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 20150605 add by dudanfeng 1 用户注册 发送手机验证码
	**/
	/******************** 1 ********************/
	public function actionSendcode() {
		$phone = Yii::$app->request->post('phone');
		
		$list = Setting::find()->where(['scope' => 'sms'])->all(); //获取手机设置
		$rst = User::find()->where(['user_phone' => $phone])->one();
		
		if($rst){
			echo 2;
		}else{
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
				$session->set('code', $code);
				$session->set('phone', $phone);
				
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 20150605 add by xiaozhu 1 用户注册 手机验证码验证
	**/
	/******************** 1 ********************/
	public function actionSendcodenaber() {
		$code = Yii::$app->request->post('code');
		
		$code_session = Yii::$app->session->get('code');
		if ($code == $code_session){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 20150623 add by dudanfeng 1 忘记密码 发送手机验证码
	**/
	/******************** 1 ********************/
	public function actionSendcodere() {
		$phone = Yii::$app->request->post('phone');
		
		$list = Setting::find()->where(['scope' => 'sms'])->all(); //获取手机设置
		$rst = User::find()->where(['user_phone' => $phone])->one();
		
		if($rst){
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
				$session->set('code', $code);
				$session->set('phone', $phone);
				
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
	 * 20150610 add by dudanfeng 1 忘记密码 重设密码
	**/
	/******************** 1 ********************/
	public function actionForget() {
		
		$this->menu= dy::getAreaSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('forget');
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 20150610 add by ddf 1 忘记密码 手机验证提交
	**/
	/******************** 1 ********************/
	public function actionForgetcodebtn(){
		$phone = Yii::$app->request->post('phone');
		$code = Yii::$app->request->post('code');
		$code_session = Yii::$app->session->get('code');
		$phone_session = Yii::$app->session->get('phone');
		
		$list = User::find()->where(['user_phone' => $phone])->one(); //获取用户信息
		if($code == $code_session && $phone == $phone_session){
			if ($list){
				echo 1;
			}else{
				echo 2;
			}
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 20150610 add by dudanfeng 1 忘记密码 重设密码
	**/
	/******************** 1 ********************/
	public function actionForgetpassword() {
		
		$this->menu= dy::getAreaSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('fpassword');
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 20150610 add by dudanfeng 1 忘记密码 重设密码
	**/
	/******************** 1 ********************/
	public function actionForgetpasswordbtn() {
		$password = Yii::$app->request->post('password');
		
		$phone = Yii::$app->session->get('phone');
		
		$user = User::find()->where(['user_phone' => $phone])->one(); //获取用户信息
		
		if($user){
			$data = array(
				'user_password' => md5($password),
				'set_password' => $password,
				'update_time'   => time(),
			);
			
			$rst = dy::execUpdate('user', $data, $user['id']);
			
			if($rst){
				echo 1;
			}else{
				echo 2;
			}
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 20150610 add by dudanfeng 1 忘记密码 重设密码
	**/
	/******************** 1 ********************/
	public function actionForgetover() {
		
		$this->menu= dy::getAreaSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('forgetover');
	}
	/******************** 1 ********************/
	
}
