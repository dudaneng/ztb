<?php

namespace app\controllers;

use Yii;
use components\BaseFrontController;
use components\wx;
use components\dy;
use yii\web\Session;

use app\models\Goods;
use app\models\GoodsTypeSmall;
use app\models\AreaBig;
use app\models\AreaMiddle;
use app\models\AreaSmall;
use app\models\WxApi;
use app\models\User;

class WeixinController extends BaseFrontController
{
	
	//取消前端数据验证
	public $enableCsrfValidation = false;
	
	
	/**
	 * 20150519 add by ygd 1 微信接口入口
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		
		if (!isset($_GET['echostr'])){
			wx::responseMsg();
		}else{
			wx::valid();
		}
		
		//return $this->render('index', ['banner' => $banner, 'goods_type'=>$goods_type, 'goods'=>$goods]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150519 add by ygd 1 微信接口入口
	**/
	/******************** 1 ********************/
	public function actionOauth()
	{
		//获取微信密钥
		$rst = WxApi::find()->one();
		if($rst){
			$appid = $rst['appid'];
			$appsecret = $rst['appsecret'];
		}else{
			$content = "微信API未设置，请设置好!";
			exit;
		}
		
		$code = isset($_GET['code']) ? trim($_GET['code']) : '';
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
		$rst = wx::https_request($url);
		$json = json_decode($rst, true);
		$openid = $json['openid'];
		
		$openid1 = wx::encrypt($openid,"jdf92jkdfo30HHH899Lks");
		
		$cookies = Yii::$app->response->cookies;
		$cookies->add(new \yii\web\Cookie([
			'name' => 'openid',
			'value' => $openid1,//微信openid
			'expire' => time()+60*60*24*180,
		]));
		
		$openid = (string)$openid;
		$list = User::find()->where(['openid'=>$openid, 'status'=>1])->one();
		
		if($list){
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
			
			dy::execUpdate('user', array('last_time'=>time()), $list['id']);
		}
		
		return $this->redirect(['default/index']);
	}
	/******************** 1 ********************/

	
}
