<?php
/**
 * 友情链接管理
 * 20150409 add by xiaozhu
**/
namespace app\modules\admin\controllers;

use Yii;
use components\BaseBackController;
use app\models\Link;
use components\dy;

class LinkController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	
	/**
	 * 20150409 add by xiaozhu 1 友情链接列表
	**/
	/******************** 1 ********************/
    public function actionIndex()
    {
		//分页初始化
		$num = 10;
		$page = 1;
		$start = 0;
		
		//获取点击页面
		$page = dy::getPage($num);
		
		//获取每页的初始条数
		$start = dy::getStart($num);
		
		//获取广告总的数量
		$pages = Link::getPages($num);
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'index');
		
		//获取广告数据
		$list = Link::getAll($start, $num); 
		
		return $this->render('index',['row'=>$list, 'page'=>$pageList]); 
	}
	/******************** 1 ********************/
	
	
	
	/**
	 * 20150409 add by xiaozhu 1 友情链接添加
	**/
	/******************** 1 ********************/
	public function actionAdd(){
		$connection = Yii::$app->db;
		$data = Yii::$app->request->post();//获取表单数据
		
		if ($data) {
			$list = Link::find()->where(['link_name' => $data['link_name']])->one();

			if($list){
				dy::execError("标题已存在");
			}else{
				//创建时间
				$data['create_time'] = time();
				
				//添加数据
				$rst = dy::execAdd('link', $data);
				
				dy::execSuccess('index', '添加成功');//页面跳转
			}
		} else {
			return $this->render('add');
		}
	}
	/******************** 1 ********************/
	
	
	
	/**
	 * 20150409 add by xiaozhu 1 友情链接修改
	**/
	/******************** 1 ********************/
	public function actionUpdate(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		if (Yii::$app->request->post()) {
			$data = Yii::$app->request->post();
			
			$id = !empty($data['id']) ? $data['id'] : '';
			
			//数据修改时间
			$data['update_time'] = time();
			
			//修改数据
			$rst = dy::execUpdate('link', $data, $id);
			
			if($rst){
				dy::execSuccess('index', '编辑成功');//页面跳转
			}else{
				dy::execError("操作有误!");
			}
			
		}else{
			//获取数据
			$list = Link::getOne($id);			
			
			return $this->render('update', ['list'=>$list]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by xiaozhu 1 友情链接删除
	**/
	/******************** 1 ********************/
	public function actionDelete(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('link', $id, -1);//改变状态
		
		if($rst){
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	
	/**
	 * 20150409 add by xiaozhu 1 启用友情链接 	  
	**/
	/******************** 1 ********************/
	public function actionResume(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('link', $id, 1);//改变状态
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	
	/**
	 * 20150409 add by xiaozhu 1 禁用友情链接
	**/
	/******************** 1 ********************/
	public function actionForbid(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('link', $id, 0);//改变状态
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	
	/**
	 * 20150409 add by xiaozhu 1 添加友情链接检测
	**/
	/******************** 1 ********************/
	public function actionAddsubmit(){
		
		$data = Yii::$app->request->post();
		
		$list = Link::find()->where(['link_url' => $data['link_url']])->one();

		if($list){
			echo 0;
		}else{
			echo 1;
		}
		
	}
	/******************** 1 ********************/
	
	
	
	/**
	 * 20150409 add by xiaozhu 1 修改友情链接排列顺序
	**/
	/******************** 1 ********************/
	public function actionSortedit(){
		$data = Yii::$app->request->get();
		
		$id = !empty($data['id']) ? $data['id'] : '';
		
		if(is_numeric($data['sort'])){
			$sort = $data['sort'];
			
			$rst = dy::execStatusUp('link', $id, $sort, 'id', 'sort');//获取表名
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
}	

	

