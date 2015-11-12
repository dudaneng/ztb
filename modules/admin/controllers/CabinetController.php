<?php
/**
 * 柜子管理
 * 20150702 add by dudanfeng
**/
namespace app\modules\admin\controllers;

use Yii;
use components\BaseBackController;
use components\dy;
use app\models\Restaurant;
use app\models\AreaBig;
use app\models\User;
use app\models\AreaMiddle;
use app\models\AreaSmall;

use app\models\Cabinet;
use app\models\CabinetBox;

class CabinetController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	/**
	 * 20150702 add by dudanfeng 1 柜子列表
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->get('id');//自提点id
		
		$area = Restaurant::find()->where(['id'=>$id])->one();
		$cab_id = explode(',', $area['cab_id']);//转化为数组
		
		foreach($cab_id as $k => $v){
			$command = $connection->createCommand("SELECT * FROM {{%cabinet}} WHERE status in (:a,:b) and id=$v");
			$command->bindValue(':a', 1);
			$command->bindValue(':b', 0);
			$list[$k] = $command->query();
		}
		
		foreach($list as $k => $v){
			foreach($v as $ke => $vo){
				$data[$k] = $vo;
			}
		}
		
		foreach($data as $k => $v){
			//获取盒子数据
			$command_m = $connection->createCommand("SELECT * FROM {{%cabinet_box}} WHERE status in (:a,:b) and cab_id={$v['id']}");
			$command_m->bindValue(':a', 1);
			$command_m->bindValue(':b', 0);
			$list_m[$k] = $command_m->query();
			
			foreach($list_m[$k] as $ke => $vo){
				$data[$k]['box'][$ke] = $vo;
			}
		}
		
		$res = Restaurant::find()->where(['id'=>$id])->one();//读取自提点信息
		
		return $this->render('index',['row'=>$data, 'id'=>$id, 'res'=>$res]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150702 add by dudanfeng 1 柜子添加
	**/
	/******************** 1 ********************/
	public function actionAdd(){
		
		$res_id = Yii::$app->request->post('res_id');
		$code = Yii::$app->request->post('code');
		$code1 = Yii::$app->request->post('code1');
		$code2 = Yii::$app->request->post('code2');
		
		if ($code){
			$cab = Cabinet::find()->where(['code'=>$code])->one();//读取柜子信息	
			
			if(!$cab){
				$data = array(
					'code' => $code,
					'status' => 1,
					'creat_time' => time(),
					'update_time' => time(),
				);
				
				$rst = dy::execAdd('cabinet', $data);//数据添加
				
				$cab = Cabinet::find()->where(['code'=>$code])->one();//读取柜子信息
				
				$res = Restaurant::find()->where(['id'=>$res_id])->one();//读取自提点信息
				
				$str = $res['cab_id'].','.$cab['id'];
				
				dy::execUpdate('restaurant', array('cab_id'=>$str), $res['id']);//修改自提点柜子数据
				
				if(is_numeric($code1) && is_numeric($code2)){
					$i = 0;
					for($i = $code1; $i <= $code2; $i++){
						
						if($i>0 && $i <=9){
							$i = '0'.$i;
						}//0-9 为其添加前缀
						
						$rst = dy::execAdd('cabinet_box', array('number'=>$i, 'update_time'=>time(), 'cab_id'=>$cab['id']));//数据添加
					}
					
					dy::execSuccess('index', '添加成功', 0);
					
				}else{
					dy::execError("盒子的编号不合法");
				}
			}else{
				dy::execError("此柜子已存在");
			}
		}else{
			dy::execError("柜子名不能为空");
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150528 add by dudanfeng 1 柜子名修改
	**/
	/******************** 1 ********************/
	public function actionCedit(){
		
		//获取表单数据
		$id = Yii::$app->request->get('id');
		$code = Yii::$app->request->get('code');
		
		$list = Cabinet::find()->where(['code'=>$code])->all();
		
		if(!$list){
			$data = array(
				'code' => $code,
			);
			
			$rst = dy::execUpdate('cabinet', $data, $id);//修改数据
			
			if($rst){
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
	 * 20150528 add by dudanfeng 1 箱子名修改
	**/
	/******************** 1 ********************/
	public function actionBoxedit(){
		
		//获取表单数据
		$id = Yii::$app->request->get('id');
		$code = Yii::$app->request->get('code');
		
		$data = array(
			'number' => $code,
		);
		
		$rst = dy::execUpdate('cabinet_box', $data, $id);//修改数据
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150702 add by dudanfeng 1 柜子状态 	  
	**/
	/******************** 1 ********************/
	public function actionStatusup(){
		
		$id = Yii::$app->request->get('id');
		$type = Yii::$app->request->get('type');
		$status = Yii::$app->request->get('status');
		
		if($status == 1){
			if($type == 2){
				$rst = dy::execStatusUp('cabinet', $id, 0);//改变状态
			}else if($type == 3){
				$rst = dy::execStatusUp('cabinet_box', $id, 0);//改变状态
			}
		}else if($status == 0){
			if($type == 2){
				$rst = dy::execStatusUp('cabinet', $id, 1);//改变状态
			}else if($type == 3){
				$rst = dy::execStatusUp('cabinet_box', $id, 1);//改变状态
			}
		}
		
		if($rst){
			$arr[0] = array(
				'id' => $id,
				'type' => $type,
				'status' => $status,
			);
		
			echo json_encode($arr);
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150702 add by dudanfeng 1 箱子添加
	**/
	/******************** 1 ********************/
	public function actionAddbox(){
		
		$cab_id = Yii::$app->request->post('id');
		$res_id = Yii::$app->request->post('res_id');
		$number = Yii::$app->request->post('number');
		
		$data = array(
			'number' => $number,
			'cab_id' => $cab_id,
			'update_time' => time(),
		);
		
		dy::execAdd('cabinet_box', $data);
		
		return $this->redirect(['index', 'id'=>$res_id]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150703 add by dudanfeng 1 区域删除
	**/
	/******************** 1 ********************/
	public function actionDeleteup(){
		
		$id = Yii::$app->request->get('id');
		$type = Yii::$app->request->get('type');
		
		if($type == 2){
			$rst = dy::execStatusUp('cabinet', $id, -1);//改变状态
		}else if($type == 3){
			$rst = dy::execStatusUp('cabinet_box', $id, -1);//改变状态
		}
		
		if($rst){
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150703 add by dudanfeng 1 箱子状态 //功能待定
	**/
	/******************** 1 ********************/
	
	public function actionQuickbox(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->post('id');
		
		$command = $connection->createCommand("SELECT * FROM {{%cabinet_box}} WHERE id=:a");
		$command->bindValue(':a', $id);
		$list = $command->query();//自提点数据
		
		$arr = array();
		foreach($list as $k=>$v){
			$arr[$k] = $v;
		}
		
		if($arr){
			echo json_encode($arr);
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
}	

	

