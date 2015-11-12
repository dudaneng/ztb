<?php
/**
 * 文章类型管理
 * @package admin\controllers
 * @author: dudanfeng [254444444@qq.com]
 */
namespace app\modules\admin\controllers;

use Yii;
use components\BaseBackController;
use components\dy;
use app\models\News;
use app\models\NewsType;

class NewstypeController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	/**
	 * 20150409 add by dudanfeng 1 文章类型列表
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		//分页初始化
		$num = 10;
		$page = 1;
		$start = 0;
		
		//获取点击页面
		$page = dy::getPage($num);
		
		//获取每页的初始条数
		$start = dy::getStart($num);
		
		//获取广告总的数量
		$pages = NewsType::getPages($num);
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'index');
		
		//获取广告数据
		$list = NewsType::getNews($start, $num);
		
		return $this->render('index',['row'=>$list, 'page'=>$pageList]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 数据添加
	**/
	/******************** 1 ********************/
	public function actionAdd(){
		$data = Yii::$app->request->post();//获取表单数据
		
		if ($data) {
			$list = NewsType::find()->where(['type_name' => $data['type_name'], 'status'=>[0,1]])->one();

			if($list){
				dy::execError('标题重复');
			}else{
				if($data['type_name']){
					$rst = dy::execAdd('news_type', $data);//新闻类型添加
					dy::execSuccess('index', '添加成功');//页面跳转
				}else{
					dy::execError('标题不能为空');
				}
			}
		} else {
			return $this->render('add');
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 数据修改
	**/
	/******************** 1 ********************/
	public function actionUpdate(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		if (Yii::$app->request->post()) {
			$data = Yii::$app->request->post();
			
			$id = isset($data['id']) ? $data['id'] : '';
					
			$rst = dy::execUpdate('news_type', $data, $id);//修改数据
			
			if($rst){
				dy::execSuccess('index', '编辑成功');//页面跳转
			}else{
				dy::execError('编辑未成功');
			}
			
		}else{
			
			$list = NewsType::getNewsone($id); //获取数据
			
			return $this->render('update', ['list'=>$list]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 数据删除
	**/
	/******************** 1 ********************/
	public function actionDelete(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('news_type', $id, -1);//改变状态
		
		if($rst){
			$rst = dy::execStatusUp('news', $id, -1, 'news_type_id');//改变新闻状态
			
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 数据启用
	**/
	/******************** 1 ********************/
	public function actionResume(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('news_type', $id, 1);//改变类型状态
		if($rst){
			$rst = dy::execStatusUp('news', $id, 1, $field = 'news_type_id');//改变新闻状态
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 数据禁用
	**/
	/******************** 1 ********************/
	public function actionForbid(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('news_type', $id, 0);//改变类型状态
		if($rst){
			$rst = dy::execStatusUp('news', $id, 0, $field = 'news_type_id');//改变新闻状态
			
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 修改排列顺序
	**/
	/******************** 1 ********************/
	public function actionSortedit(){
		$data = Yii::$app->request->get();
		$id = !empty($data['id']) ? $data['id'] : '';
		
		if(is_numeric($data['sort'])){
			$sort = $data['sort'];
			
			$rst = dy::execStatusUp('news_type', $id, $sort, 'id', 'sort');
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
	 * 20150409 add by dudanfeng 1 修改排列顺序
	**/
	/******************** 1 ********************/
	public function actionTitleedit(){
		
		$id = Yii::$app->request->post('id');
		$name = Yii::$app->request->post('name');
		
		$data = array(
			'type_name' => $name,
		);
		
		$rst = dy::execUpdate('news_type', $data, $id);
		if($rst){
			echo 1;
		}else{
			echo 0;
		}	
	}
	/******************** 1 ********************/ 
	
}	

	

