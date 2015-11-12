<?php
/**
 * 回收站管理
 * 20150409 add by dudanfeng
 */
namespace app\modules\admin\controllers;

use Yii;
use components\BaseBackController;
use components\dy;
use app\models\News;
use app\models\NewsType;

class RecoveryController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	
	/**
	 * 20150409 add by dudanfeng 1 回收站管理
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		$connection = Yii::$app->db;
		//分页初始化
		$num = 5;
		$page = 1;
		$start = 0;
		
		//获取点击页面
		$page = common::getPage($num);
		
		//获取每页的初始条数
		$start = common::getStart($num);
		
		//获取广告总的数量
		$pages = News::getRecoveryPages($num);
		
		//调用分页样式
		$pageList = common::getPageList($page, $pages, 'index');
		
		//获取数据
		$list = News::getRecoveryNews($start, $num);
		
		return $this->render('index',['row'=>$list, 'page'=>$pageList]); 
	}
	/******************** 1 ********************/
	
	
	
	/**
	 * 20150409 add by dudanfeng 1 数据还原
	**/
	/******************** 1 ********************/
	public function actionReduction(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = common::execStatusUp('news', $id, 1);
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	
	/**
	 * 20150409 add by dudanfeng 1 数据删除
	**/
	/******************** 1 ********************/
	public function actionDelete(){
		$connection = Yii::$app->db;
		$id = Yii::$app->request->get('id');
		
		$rst = common::execDelete('news', $id);
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
}	

	

