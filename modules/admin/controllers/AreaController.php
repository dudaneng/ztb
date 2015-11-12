<?php
/**
 * 区域管理
 * 20150527 add by dudanfeng
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

class AreaController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	/**
	 * 20150527 add by dudanfeng 1 区域列表
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		$connection = Yii::$app->db;
		
		//获取大区域数据
		$command = $connection->createCommand("SELECT * FROM {{%area_big}} WHERE status in (:a,:b) order by sort desc");
		$command->bindValue(':a', 1);
		$command->bindValue(':b', 0);
		$list = $command->query();
		
		foreach($list as $k => $v){
			$data[$k] = $v;
		}
		
		foreach($data as $k => $v){
			//获取中区域数据
			$command_m = $connection->createCommand("SELECT * FROM {{%area_middle}} WHERE status in (:a,:b) and area_big={$v['id']} order by sort desc");
			$command_m->bindValue(':a', 1);
			$command_m->bindValue(':b', 0);
			$list_m[$k] = $command_m->query();
			
			foreach($list_m[$k] as $ke => $vo){
				$data[$k]['middle'][$ke] = $vo;
			
				//获取小区域数据
				$command_s = $connection->createCommand("SELECT * FROM {{%area_small}} WHERE status in (:a,:b) and area_middle={$vo['id']} order by sort desc");
				$command_s->bindValue(':a', 1);
				$command_s->bindValue(':b', 0);
				$list_s[$ke] = $command_s->query();
				
				foreach($list_s[$ke] as $key => $vol){
					$data[$k]['middle'][$ke]['small'][$key] = $vol;
				}
			}
		}
		
		$command_mid = $connection->createCommand("SELECT * FROM {{%area_middle}} WHERE status in (:a,:b) order by sort desc");
		$command_mid->bindValue(':a', 1);
		$command_mid->bindValue(':b', 0);
		$list_md = $command_mid->query();
		
		return $this->render('index',['row'=>$data, 'row_m'=> $list_md]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150528 add by dudanfeng 1 区域添加ajax判断
	**/
	/******************** 1 ********************/
	public function actionAddarea(){
		
		//获取表单数据
		$area_big = Yii::$app->request->get('area_big');
		$area_middle = Yii::$app->request->get('area_middle');
		$type = Yii::$app->request->get('type');
		
		$arr = array(
			'type' => $type,
			'big'    => $area_big,
			'middle'   => $area_middle,
		);
		
		echo json_encode($arr);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150528 add by dudanfeng 1 区域添加
	**/
	/******************** 1 ********************/
	public function actionAdd(){
		
		//获取表单数据
		$data = Yii::$app->request->post();
		$type = Yii::$app->request->get('type');
		
		if ($data['area_name']){
			
			if($type == 1){//大区域
				$list = AreaBig::find()->where(['area_name' => $data['area_name'], 'status'=>[0,1]])->one();
			}else if($type == 2){//中区域
				$list = AreaMiddle::find()->where(['area_name' => $data['area_name'], 'status'=>[0,1]])->one();
			}else if($type == 3){//小区域
				$list = AreaSmall::find()->where(['area_name' => $data['area_name'], 'status'=>[0,1]])->one();
			}
			
			if($list){
				$this -> redirect(['index']);//页面跳转
			}else{
				//筛选数据
				foreach($data as $k =>$v){
					if($v != 'null' && $v != ''){
						$data_area[$k] = $v;
					}
				}
				
				if($type == 1){
					$rst = dy::execAdd('area_big', $data_area);//数据添加
				}else if($type == 2){
					$rst = dy::execAdd('area_middle', $data_area);//数据添加
				}else if($type == 3){
					$rst = dy::execAdd('area_small', $data_area);//数据添加
				}
			}
			$this -> redirect(['index']);//页面跳转
		}else{
			$this -> redirect(['index']);//页面跳转
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150528 add by dudanfeng 1 大区域修改
	**/
	/******************** 1 ********************/
	public function actionBigedit(){
		
		//获取表单数据
		$id = Yii::$app->request->get('id');
		$area_name = Yii::$app->request->get('name');
		$type = Yii::$app->request->get('type');
		
		$data = array(
			'area_name' => $area_name,
		);
		
		if($type == 1){
			$rst = dy::execUpdate('area_big', $data, $id);//修改数据
		}else if($type == 2){
			$rst = dy::execUpdate('area_middle', $data, $id);//修改数据
		}else if($type == 3){
			$rst = dy::execUpdate('area_small', $data, $id);//修改数据
		}
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150528 add by dudanfeng 1 区域排名修改
	**/
	/******************** 1 ********************/
	public function actionSortedit(){
		
		//获取表单数据
		$id = Yii::$app->request->get('id');
		$sort = Yii::$app->request->get('sort');
		$type = Yii::$app->request->get('type');
		
		$data = array(
			'sort' => $sort,
		);
		
		if(is_numeric($data['sort'])){
			//修改数据
			if($type == 1){
				$rst = dy::execUpdate('area_big', $data, $id);
			}else if($type == 2){
				$rst = dy::execUpdate('area_middle', $data, $id);
			}else if($type == 3){
				$rst = dy::execUpdate('area_small', $data, $id);
			}
			
			
			if($rst){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150529 add by dudanfeng 1 区域选择
	**/
	/******************** 1 ********************/
	public function actionAreaselect(){
		$connection = Yii::$app->db;
		
		//获取表单数据
		$id = Yii::$app->request->post('id');
		
		$command_m = $connection->createCommand("SELECT * FROM {{%area_middle}} WHERE status in (:a,:b) and area_big=$id order by sort desc");
		$command_m->bindValue(':a', 1);
		$command_m->bindValue(':b', 0);
		$list_m = $command_m->query();
		
		foreach($list_m as $k => $v){
			$data[$k] = $v;
		}
		
		echo json_encode($data);
		
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 区域删除
	**/
	/******************** 1 ********************/
	public function actionDeleteup(){
		
		$id = Yii::$app->request->get('id');
		$type = Yii::$app->request->get('type');
		
		if($type == 1){
			$rst = dy::execStatusUp('area_big', $id, -1);//改变状态
		}else if($type == 2){
			$rst = dy::execStatusUp('area_middle', $id, -1);//改变状态
		}else if($type == 3){
			$rst = dy::execStatusUp('area_small', $id, -1);//改变状态
		}
		
		if($rst){
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 区域状态 	  
	**/
	/******************** 1 ********************/
	public function actionStatusup(){
		
		$id = Yii::$app->request->get('id');
		$type = Yii::$app->request->get('type');
		$status = Yii::$app->request->get('status');
		
		if($status == 1){
			if($type == 1){
				$rst = dy::execStatusUp('area_big', $id, 0);//改变状态
			}else if($type == 2){
				$rst = dy::execStatusUp('area_middle', $id, 0);//改变状态
			}else if($type == 3){
				$rst = dy::execStatusUp('area_small', $id, 0);//改变状态
			}
		}else if($status == 0){
			if($type == 1){
				$rst = dy::execStatusUp('area_big', $id, 1);//改变状态
			}else if($type == 2){
				$rst = dy::execStatusUp('area_middle', $id, 1);//改变状态
			}else if($type == 3){
				$rst = dy::execStatusUp('area_small', $id, 1);//改变状态
			}
		}
		
		if($rst){
			$arr[0] = array(
				'id' => $id,
				'type' => $type,
				'status' => $status,
			);
		
			//echo json_encode($arr);
			echo json_encode($arr);
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150612 add by dudanfeng 1 自提点 列表
	**/
	/******************** 1 ********************/
    public function actionRestaurant(){
		
		$keyword = Yii::$app->request->get('keyword');
		$type = Yii::$app->request->get('type');
		
		$str = "keyword=$keyword&type=$type";//分页属性
		
		//分页初始化
		$num = 5;
		$page = 1;
		$start = 0;
		
		//获取点击页面
		$page = dy::getPage($num);
		
		//获取每页的初始条数
		$start = dy::getStart($num);
		
		//获取商品总的数量
		$pages = Restaurant::getPages($num, $keyword, $type);
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'restaurant', $str);
		
		//获取商品数据
		$list = Restaurant::getDate($start, $num, $keyword, $type);
		
		return $this->render('restaurant',['row'=>$list, 'page'=>$pageList]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 自提点 添加
	**/
	/******************** 1 ********************/
	public function actionAddrest(){
		
		$data = Yii::$app->request->post();//获取表单数据
		
		if ($data) {
			//创建时间
			$data['update_time'] = time();
			//数据添加
			$rst = dy::execAdd('restaurant', $data);
			
			dy::execSuccess('restaurant', '添加成功');//页面跳转
		} else {
			$type = AreaBig::find()->where(['status'=>1])->all();
			
			return $this->render('addrest',['type'=>$type]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 自提点 修改
	**/
	/******************** 1 ********************/
	public function actionUpdaterest(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		if (Yii::$app->request->post()){
			$data = Yii::$app->request->post();
			$id = !empty($data['id']) ? $data['id'] : '';
			
			$data['update_time'] = time();//数据修改时间
			
			$rst = dy::execUpdate('restaurant', $data, $id);//修改数据
			
			if($rst){
				dy::execSuccess('restaurant', '编辑成功');//页面跳转
			}else{
				dy::execError("编辑未成功！");
			}
			
		}else{
			//获取自提点数据
			$list = Restaurant::getRestOne($id);
			
			//获取区域数据
			$type = AreaBig::find()->where(['status'=>1])->all();
			
			return $this->render('updaterest', ['list'=>$list, 'type'=>$type]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 自提点 删除
	**/
	/******************** 1 ********************/
	public function actionDeleterest(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		//改变状态
		//$rst = dy::execStatusUp('restaurant', $id, -1);
		$rst = dy::execDelete('restaurant', $id);
		
		if($rst){
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 自提点 改变状态 
	**/
	/******************** 1 ********************/
	public function actionResumerest(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		//获取文章数据
		$list = dy::execGetRow('restaurant', $id);
		
		//获取类型数据
		$data = dy::execGetRow('area_small', $list[0]['area_small']);
		
		if($data[0]['status'] == 1){
			//改变状态
			$rst = dy::execStatusUp('restaurant', $id, 1);
			if($rst){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 3;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 禁用
	**/
	/******************** 1 ********************/
	public function actionForbidrest(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		//改变状态
		$rst = dy::execStatusUp('restaurant', $id, 0);
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 修改排列顺序
	**/
	/******************** 1 ********************/
	public function actionSorteditrest(){
		$data = Yii::$app->request->get();
		$id = !empty($data['id']) ? $data['id'] : '';
		
		if(is_numeric($data['sort'])){
			$sort = $data['sort'];
			
			$rst = dy::execStatusUp('restaurant', $id, $sort, 'id', 'sort');
			if($rst){
				echo 1;
			}else{
				echo 0;
			}	
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/ 
	
	
	/**
	 * 20150413 add by dudanfeng 1 地点选择
	**/
	/******************** 1 ********************/
	
	public function actionSetselect(){
		
		$id = Yii::$app->request->post('id');
		$type = Yii::$app->request->post('type');
		
		if(is_numeric($id)){
			if($type == 1){
				$list = AreaMiddle::getAreaData($id); 
			}else {
				$list = AreaSmall::getAreaDataSelect($id);
			}
			
			foreach($list as $k=>$v){
				$arr[$k] = $v;
			}
			if($arr){
				echo json_encode($arr);
			}else{
				echo 1;
			}
		}else{
			echo 0;
		} 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150618 add by dudanfeng 1 快捷显示自提点
	**/
	/******************** 1 ********************/
	
	public function actionQuickrestaurant(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->post('id');
		
		$command = $connection->createCommand("SELECT * FROM {{%restaurant}} WHERE area_small=:a");
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
	
	
	/**
	 * 20150625 add by dudanfeng 1 修改快递员配置
	**/
	/******************** 1 ********************/
	public function actionExpressedit(){
		$data = Yii::$app->request->post();
		$id = !empty($data['id']) ? $data['id'] : ''; //自提点id
		
		$express = $data['express']; //快递id串
		
		$express_s = explode(',', $express);//转化为数组
		$express_a = implode(',', array_unique($express_s));//转化为字符串 不重复
		
		$express_arr = array();
		foreach($express_s as $k => $v){//对用户id进行判别
			
			if(User::find()->where(['id'=>$v,'group_id'=>2])->one()){
				$express_arr[$k] = $v;
			}
		}
		
		$express_str = implode(',', array_unique($express_arr));//转化为字符串 不重复
		
		$rst = dy::execUpdate('restaurant', array('express'=>$express_str), $id);//改变快递id
		
		if($rst){
			$list = Restaurant::find()->where(['id'=>$id])->one();//读取自提点信息
			
			$express_id = $list['express'];
			$express_id = explode(',', $express_id);//转化为数组
			
			foreach($express_id as $v){
				$user = User::find()->where(['id'=>$v])->one();
				
				$restaurant_id = $user['restaurant_id'].','.$id;
				
				$express_ss = explode(',', $restaurant_id);//转化为数组
		
				$express_aa = implode(',', array_unique($express_ss));//转化为字符串
				
				dy::execUpdate('user', array('restaurant_id'=>$express_aa), $v);
			}
			
			if(count($express_s) == count($express_arr)){
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
	 * 20150625 add by dudanfeng 1 快递员配置查看
	**/
	/******************** 1 ********************/
	public function actionResdetail(){
		$id = Yii::$app->request->get('id');

		$rst = Restaurant::find()->where(['id'=>$id])->one();
		
		$user_id = explode(',', $rst['express']);//转化为数组
		
		foreach($user_id as $k => $v){
			$user[$k] = User::find()->where(['id'=>$v])->one();
		}
		
		return $this->render('detail', ['row'=>$user]);
	}
	/******************** 1 ********************/
	
}	

	

