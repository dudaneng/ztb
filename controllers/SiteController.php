<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Admin;
use app\models\User;
use app\models\Setting;
use app\models\Restaurant;
use components\BaseFrontController;
use yii\web\Session;
use yii\web\Cookie;
use components\dy;

class SiteController extends BaseFrontController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

	/**
	 * 20150409 add by ygd 1 网站首页入口
	**/
	/******************** 1 ********************/
    public function actionIndex()
    {
        $list = Setting::getScope();//网站的基本设置
		
		if($list['web_status'] == 0){
			echo ("<div style='margin-top:100px;' align='center'><span style='color:red;  font-size:20px;'>".$list[0]['web_close_say']."</span></div>");
		}else{
			if(Yii::$app->request->cookies->get('user_id') != ''){//记住密码的用户 直接登录
				$user_id = Yii::$app->request->cookies->get('user_id')->value;
				$user_name = Yii::$app->request->cookies->get('user_name')->value;
				
				$session = Yii::$app->session;
				$session->set('user_id', $user_id);
				$session->set('user_name', $user_name);
			}
			
			$mobile_browser = dy::getPcorwap();//手机和pc端判定
			
			if($mobile_browser>0){
				return $this->redirect(['myweb/default/index']);//手机端
			}else{
				return $this->redirect(['default/index']);//pc端
			}
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by ygd 1 管理员登陆
	**/
	/******************** 1 ********************/
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by ygd 1 管理员登陆
	**/
	/******************** 1 ********************/
	public function actionAdmin()
    {        
		$this->layout = false;//禁止加载layout
		
		if (Yii::$app->request->post()) {
			return $this->redirect(['admin/default/index']);
		}else{
			return $this->render('admin');
		}
    }
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by ygd 1 用户和密码验证
	**/
	/******************** 1 ********************/
	public function actionAdminsubmit(){
		
		$admin_name = Yii::$app->request->post('admin');//获取表单传值
		$admin_password = md5(Yii::$app->request->post('password'));//获取表单传值
		
		$rst = Admin::find()->where(['admin_acount' => $admin_name,'admin_password' => $admin_password])->one();
		
		if($rst){//验证管理员信息
			$session = Yii::$app->session;
			$session->set('admin_id', $rst['id']);
			
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by ygd 1 管理员退出
	**/
	/******************** 1 ********************/
	public function actionLogoutadmin()
    {
        Yii::$app->session->set("admin_id",'');

        return $this->redirect(['admin/default/index']);
    }
	/******************** 1 ********************/

	
	/**
	 * 20150625 add by ddf 1 快递员登陆
	**/
	/******************** 1 ********************/
	public function actionUser(){        
		
		$this->layout = false;//禁止layout
		
		if (Yii::$app->request->post()){
			return $this->redirect(['express/default/index']);
		}else{
			$model = new LoginForm;
			
			if ($model->load(Yii::$app->request->post()) && $model->validate()){
				// 验证 $model 收到的数据

				// 做些有意义的事 ...

				return $this->render('entry-confirm', ['model' => $model]);
			} else {
				return $this->render('login', ['model' => $model]);
			}
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150625 add by ddf 1 快递员登陆提交
	**/
	/******************** 1 ********************/
	public function actionExpresssubmit(){        
		$data = Yii::$app->request->post();
		
		$admin_name = $data['admin'];
		$admin_password = md5($data['password']);
		
		$rst = User::find()->where(['user_phone' => $admin_name,'user_password' => $admin_password, 'group_id' => 2])->one();
		if($rst){
			$session = Yii::$app->session;
			$session->set('express_id', $rst['id']);
			
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by ygd 1 快递员退出
	**/
	/******************** 1 ********************/
	public function actionLogoutuser()
    {
        Yii::$app->session->set("express_id",'');

        return $this->redirect(['express/default/index']);
    }
	/******************** 1 ********************/

	
	
	/**
	 * 20150604 add by ddf 1 区域选择
	**/
	/******************** 1 ********************/
    public function actionAreaselect(){
       
	    $connection = Yii::$app->db;
		
		$area = Yii::$app->request->post('id');
		$type = Yii::$app->request->post('type');
		
		if($type == 1){
			$command_mid = $connection->createCommand("SELECT * FROM {{%area_middle}} WHERE status=:a and area_big=$area order by sort desc");
			$command_mid->bindValue(':a', 1);
			$list = $command_mid->query(); //中区域值
		}else if($type == 2){
			$command_mid = $connection->createCommand("SELECT * FROM {{%area_small}} WHERE status=:a and area_middle=$area order by sort desc");
			$command_mid->bindValue(':a', 1);
			$list = $command_mid->query();//小区域值
		}else if($type == 3){
			$command_mid = $connection->createCommand("SELECT * FROM {{%restaurant}} WHERE status=:a and area_small=$area order by sort desc");
			$command_mid->bindValue(':a', 1);//商店值
			$list = $command_mid->query();
		}else if($type == 4){
			$command_mid = $connection->createCommand("SELECT * FROM {{%area_small}} WHERE status=:a and id=$area");
			$command_mid->bindValue(':a', 1);
			$list = $command_mid->query();
			
			$address = Restaurant::find()->where(['area_small' => $area])->one();
			
			$name = Yii::$app->request->post('name');
			
			$cookies = Yii::$app->response->cookies;
			
			$cookies->add(new \yii\web\Cookie([
				'name' => 'area',
				'value' => $name,
				'expire' => time()+60*60*24*30,
			]));
			
			$cookies->add(new \yii\web\Cookie([
				'name' => 'area_id',
				'value' => $area,
				'expire' => time()+60*60*24*30,
			]));
			
			$cookies->add(new \yii\web\Cookie([
				'name' => 'address',
				'value' => $address['address'],
				'expire' => time()+60*60*24*30,
			]));
			
			$cookies->add(new \yii\web\Cookie([
				'name' => 'res_id',
				'value' => $address['id'],
				'expire' => time()+60*60*24*30,
			]));
		}
		
		$data = '';
		if($list){
			foreach($list as $k => $v){
				$data[$k] = $v;
			}
		}
		
		echo json_encode($data);
	}
	/******************** 1 ********************/
}
