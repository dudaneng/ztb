<?php
namespace app\controllers;

use Yii;
use components\BaseFrontController;
use components\dy;
use yii\web\Session;
use app\models\Goods;

class DefaultController extends BaseFrontController
{
	
	//取消前端数据验证
	public $enableCsrfValidation = false;
	
	public $menu = '';//自提点数据
	public $numbers = '';//购物车数量
	public $setting = '';//系统设置
	
	/**
	 * 20150703 add by dudanfng 1 手机和pc端判断
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
	 * 20150519 add by dudanfng 1 首页
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		$connection = Yii::$app->db;
		
		$command = $connection->createCommand("SELECT * FROM {{%ad}} WHERE status = :a and position_id=15 order by sort desc limit 2");
		$command->bindValue(':a', 1);
		$banner = $command->query();//轮播图片
		
		$command_1 = $connection->createCommand("SELECT * FROM {{%goods_type_big}} WHERE status = :a order by sort desc");
		$command_1->bindValue(':a', 1);
		$goods_type = $command_1->query();//商品类型
		
		$command_3 = $connection->createCommand("SELECT * FROM {{%news}} where status=1 order by create_time desc limit 5;");
		$news = $command_3->query();//活动数据
		
		$type_id = Yii::$app->request->get('type_id');
		
		if($type_id){
			$sql = "and type_big={$type_id}";
		}else{
			$sql = "";
		}
		
		$command_2 = $connection->createCommand("SELECT * FROM {{%goods}} WHERE status=:a $sql order by sort desc limit 12");
		$command_2->bindValue(':a', 1);
		$goods = $command_2->query();//商品数据
		
		$rec_goods = Goods::find()->where(['status'=>1, 'is_recommend'=>1])->limit('4')->all();
		
		$time = date('Y-m', time());
		$week = dy::get_weekinfo($time);//本周时间
		
		$this->menu= dy::getAreaSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('index', ['banner' => $banner, 'goods_type'=>$goods_type, 'goods'=>$goods, 'week'=>$week, 'news'=>$news, 'rec_goods'=>$rec_goods]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150605 add by dudanfng 1 菜品选择
	**/
	/******************** 1 ********************/
    public function actionSelectgoods(){
		$connection = Yii::$app->db;
		
		$type_id = Yii::$app->request->post('id');
		$type = Yii::$app->request->post('type');
		
		if($type == 2){
			if($type_id){
				$sql = "and type_big={$type_id}";
			}else{
				$sql = "";
			}
		}else if($type == 1){
			$sql = "and is_recommend=1";
		}else{
			$sql = '';
		}
		
		$command_2 = $connection->createCommand("SELECT * FROM {{%goods}} WHERE status=:a $sql order by sort desc");
		$command_2->bindValue(':a', 1);
		$goods = $command_2->query();//商品数据
		
		$data = '';
		if($goods){//数据转化
			foreach($goods as $k => $v){
				$data[$k] = $v;
			}
		}
		if($data){
			foreach($data as $k => $v){
				$data[$k]['index_pic'] = dy::getImgOne($v['goods_show']);//获取商品展示图
			}
		}
		
		echo json_encode($data);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150519 add by dudanfng 1 搜索
	**/
	/******************** 1 ********************/
    public function actionSelect(){
		$connection = Yii::$app->db;
		
		$goods_name = Yii::$app->request->post('goods_name');
		
		$command = $connection->createCommand("SELECT * FROM {{%goods}} WHERE status=:a and goods_name like '%$goods_name%' order by sort desc");
		$command->bindValue(':a', 1);
		$goods = $command->query();//商品数据
		
		$data = '';
		if($goods){//数据转化
			foreach($goods as $k => $v){
				$data[$k] = $v;
			}
		}
		if($data){
			foreach($data as $k => $v){
				$data[$k]['index_pic'] = dy::getImgOne($v['goods_show']);//获取商品展示图
			}
		}
		echo json_encode($data);
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
		
		$this->menu= dy::getAreaSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('activity', ['row' => $list]);
	}
	/******************** 1 ********************/
	
	
}
