<?php

namespace app\modules\myweb\controllers;

use yii\web\Controller;
use Yii;
use components\BaseBackController;
use components\dy;
use yii\web\Session;

use app\models\Goods;
use app\models\GoodsTypeBig;
use app\models\AreaBig;
use app\models\AreaMiddle;
use app\models\AreaSmall;
use app\models\Restaurant;

class DefaultController extends BaseBackController
{
	
	//取消前端数据验证
	public $enableCsrfValidation = false;
	
	public $layout = "main";
	
	public $menu = '';//自提点数据
	public $numbers = '';//购物车数量
	public $setting = '';//系统设置
	
	/**
	 * 20150519 add by dudanfng 1 首页
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		
		$connection = Yii::$app->db;
		
		$command = $connection->createCommand("SELECT * FROM {{%ad}} WHERE status = :a and position_id=2 order by sort desc limit 3");
		$command->bindValue(':a', 1);
		$banner = $command->query();//轮播图片
		
		$type_id = Yii::$app->request->get('id');//商品类型id
		
		if($type_id > 0){
			$sql = "and type_big={$type_id}";
		}else if($type_id == -1){
			$sql = "and is_recommend=1";
		}else{
			$sql = "";
		}
		
		$command_1 = $connection->createCommand("SELECT * FROM {{%goods}} WHERE status=:a $sql order by sort desc;");
		$command_1->bindValue(':a', 1);
		$goods = $command_1->query();//商品数据
		
		$goods_type_name ='';
		if($type_id){
			$goods_type = GoodsTypeBig::find()->where(['id'=>$type_id])->one();
			if($type_id > 0){
				$goods_type_name = $goods_type['type_name'];
			}else if($type_id == -1){
				$goods_type_name ='推荐产品';
			}
		}
		
		$time = date('Y-m', time());
		$week = dy::get_weekinfo($time);//本周时间
		
		$this->menu= dy::getGoodsTypeSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('index', ['banner' => $banner, 'goods'=>$goods, 'week'=>$week, 'goods_type_name'=>$goods_type_name]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150630 add by dudanfng 1 区域选择
	**/
	/******************** 1 ********************/
    public function actionArea(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->get('id');
		$type = Yii::$app->request->get('type');
		
		if($type == ''){
			$command = $connection->createCommand("SELECT * FROM {{%area_big}} WHERE status=:a order by sort desc");
			$command->bindValue(':a', 1);
			$area = $command->query();//大区域数据
		}else if($type == 1){
			$command = $connection->createCommand("SELECT * FROM {{%area_middle}} WHERE status=:a and area_big=$id order by sort desc");
			$command->bindValue(':a', 1);
			$area = $command->query();//中区域数据
		}else if($type == 2){
			$command = $connection->createCommand("SELECT * FROM {{%area_small}} WHERE status=:a and area_middle=$id order by sort desc");
			$command->bindValue(':a', 1);
			$area = $command->query();//小区域数据
		}else if($type == 3){
			$command = $connection->createCommand("SELECT a.area_name,b.* FROM {{%area_small}} as a left join {{%restaurant}} as b on b.area_small=a.id WHERE b.status=:a and a.id=$id order by b.sort desc");
			$command->bindValue(':a', 1);
			$area = $command->query();//自提点数据
			
			
		}
		
		$type = $type + 1;
		
		$this->menu= dy::getGoodsTypeSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		if($type != 4){
			return $this->render('area', ['area'=>$area, 'type'=>$type]);
		}else{
			return $this->render('rest', ['area'=>$area]);
		}
		
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150701 add by ddf 1 区域确定
	**/
	/******************** 1 ********************/
    public function actionAreaselect(){
       
	    $connection = Yii::$app->db;
		
		$id = Yii::$app->request->post('id');//自提点id
		$area_name = Yii::$app->request->post('data');//商圈名
		
		$address = Restaurant::find()->where(['id' => $id])->one();
		
		if($address){
			$cookies = Yii::$app->response->cookies;//创建cookie
			$cookies->add(new \yii\web\Cookie([
				'name' => 'area',
				'value' => $area_name,
				'expire' => time()+60*60*24*30,
			]));
			
			$cookies->add(new \yii\web\Cookie([
				'name' => 'area_id',
				'value' => $address['area_small'],
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
			
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150619 add by dudanfng 1 活动页面
	**/
	/******************** 1 ********************/
    public function actionActivity(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->get('id');
		
		$command = $connection->createCommand("SELECT * FROM {{%activity}} WHERE id=:a");
		$command->bindValue(':a', $id);
		$list = $command->query();//活动数据
		
		
		$this->menu= dy::getGoodsTypeSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('activity', ['row' => $list]);
	}
	/******************** 1 ********************/
}


