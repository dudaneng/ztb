<?php

namespace app\controllers;

use Yii;
use components\BaseBackController;
use components\dy;

use app\models\Order;
use app\models\AreaBig;
use app\models\AreaMiddle;
use app\models\AreaSmall;

use app\models\User;
use app\models\Address;
use app\models\Restaurant;
use app\models\Cabinet;
use app\models\CabinetBox;
use app\models\Test1;

header("Content-type: text/html; charset=utf-8");

class BoxController extends BaseBackController
{
    //取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	/**
	 * 20150703 add by dudanfeng 1 盒子开关
	**/
	/******************** 1 ********************/
	public function actionIndex(){
		$this->layout=false;
		
		$cab_name = Yii::$app->request->post('code');
		$box_name = Yii::$app->request->post('number');
		$user_code = Yii::$app->request->post('user_code');
		
		$str = "打开".$cab_name."柜子".$box_name."柜门";//打开柜子命令
		
		if($cab_name && $box_name){
			dy::execAdd('test1', array('name'=>$str));
		}
		
		$string = Test1::find()->one();
		echo $string['name'];
	}	
	/******************** 1 ********************/
	
	
	/**
	 * 20150703 add by dudanfeng 1 盒子状态改变
	**/
	/******************** 1 ********************/
	public function actionOkbox(){
		
		$ret = Yii::$app->request->get('params');
		if($ret){
			$srt = dy::msubstr($ret, 2, -13, "utf-8", false);//截取字符串
			
			$srt = '打开'.$srt;
			
			dy::execDelete('test1', $srt, 'name');
		}
		
		$code = '878244954';
		
		$connection = Yii::$app->db;
		$command = $connection->createCommand("SELECT b.number,c.code FROM {{%order}} as a left join {{%cabinet_box}} as b on b.id=a.cbox_id left join {{%cabinet}} as c on c.id=b.cab_id WHERE a.user_code='$code' and a.status=:a;");
		$command->bindValue(':a', 6);
		$activity = $command->query();//活动列表
		
		$data = array();
		foreach($activity as $v){
			$data = $v;
		}
		
		$str = "打开".$data['code']."柜子".$data['number']."柜门";//打开柜子命令
		dy::execAdd('test2', array('name'=>$str));//调试数据
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150703 add by dudanfeng 1 盒子状态改变
	**/
	/******************** 1 ********************/
	public function actionClosebox(){
		
		$id = Yii::$app->request->post('id');
		$order_id = Yii::$app->request->post('order_id');
		
		dy::execUpdate('cabinet_box', array('contact'=>3), $id);//改变状态
		dy::execUpdate('order', array('cbox_id'=>$id, 'status'=>6), $order_id);
		
		echo 1;
	}
	/******************** 1 ********************/
}
