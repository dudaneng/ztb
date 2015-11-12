<?php
/**
 * 活动管理
 * 20150612 add by dudanfeng
**/
namespace app\modules\admin\controllers;

use Yii;
use components\BaseBackController;
use components\dy;
use app\models\Activity;

class ActivityController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	/**
	 * 20150612 add by dudanfeng 1 活动列表
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		
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
		
		//获取活动总的数量
		$pages = Activity::getPages($num, $keyword, $type);
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'index', $str);
		
		//获取活动数据
		$list = Activity::getData($start, $num, $keyword, $type);
		
		return $this->render('index',['row'=>$list, 'page'=>$pageList, 'type' => $type]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150612 add by dudanfeng 1 活动添加
	**/
	/******************** 1 ********************/
	public function actionAdd(){
		
		$type = Yii::$app->request->get('type');//获取数据类型
		$data = Yii::$app->request->post();//获取表单数据
		
		if ($data) {
			
			$list = Activity::find()->where(['ac_name' => $data['ac_name']])->one();
			
			if($list){
				dy::execError("标题已存在");
			}else{
				$data['start_time'] = strtotime($data['start_time']);
				$data['end_time'] = strtotime($data['end_time'].'23:59:59');
				$data['update_time'] = time();
				
				$rst = dy::execAdd('activity', $data);//活动添加
				
				dy::execSuccess('index?type='.$data['type'], '添加成功');//页面跳转
			}
		} else {
			return $this->render('add', ['type'=>$type]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150612 add by dudanfeng 1 活动修改
	**/
	/******************** 1 ********************/
	public function actionUpdate(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		if (Yii::$app->request->post()) {
			$data = Yii::$app->request->post();
			$id = !empty($data['id']) ? $data['id'] : '';
			
			$data['update_time'] = time();//数据修改时间
			$data['start_time'] = strtotime($data['start_time']);//开始时间
			$data['end_time'] = strtotime($data['end_time'].'23:59:59');//结束时间
			
			$rst = dy::execUpdate('activity', $data, $id);//修改数据
			
			if($rst){
				dy::execSuccess('index?type='.$data['type'], '编辑成功');//页面跳转
			}else{
				dy::execError("编辑未成功！");
			}
			
		}else{
			$list = Activity::getDataOne($id);//获取活动数据
			
			return $this->render('update', ['list'=>$list]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 活动删除
	**/
	/******************** 1 ********************/
	public function actionDelete(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('activity', $id, -1);//改变状态
		
		if($rst){
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 启用活动 	  
	**/
	/******************** 1 ********************/
	public function actionResume(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('activity', $id, 1);//改变状态
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 禁用活动
	**/
	/******************** 1 ********************/
	public function actionForbid(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		//改变状态
		$rst = dy::execStatusUp('activity', $id, 0);
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
}	

	

