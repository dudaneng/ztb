<?php
/**
 * 评论管理
 * 20150529 add by dudanfeng
**/
namespace app\modules\admin\controllers;

use Yii;
use components\BaseBackController;
use components\dy;

use app\models\Goods
use app\models\GoodsComment;
use app\models\User;

class CommentController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	/**
	 * 20150409 add by dudanfeng 1 评论列表
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		
		$keyword = Yii::$app->request->get('keyword');
		
		$str = "keyword=$keyword";//分页属性
		
		//分页初始化
		$num = 2;
		$page = 1;
		$start = 0;
		
		//获取点击页面
		$page = dy::getPage($num);
		
		//获取每页的初始条数
		$start = dy::getStart($num);
		
		//获取广告总的数量
		$pages = News::getPages($num, $keyword, $type);
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'index', $str);
		
		//获取广告数据
		$list = News::getNews($start, $num, $keyword, $type);
		//var_dump($list);exit;
		
		$news_type = NewsType::find()->where(['status'=>[0,1]])->all();//获取评论类型
		
		return $this->render('index',['row'=>$list, 'page'=>$pageList, 'news_type'=>$news_type]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 评论添加
	**/
	/******************** 1 ********************/
	public function actionAdd(){
		
		//获取表单数据
		$data = Yii::$app->request->post();
		
		if ($data) {
			
			$list = News::find()->where(['news_title' => $data['news_title']])->one();

			if($list){
				dy::execError("标题已存在");
			}else{
				//创建时间
				$data['create_time'] = time();
				$data['update_time'] = time();
				$data['index_pic'] = dy::getImgOne($data['ad_image']);//图片的路径
				
				$rst = dy::execAdd('news', $data);//新闻添加
				
				dy::execSuccess('index', '添加成功');//页面跳转
			}
		} else {
			$type = NewsType::find()->where(['status'=>[0,1]])->all();
			
			return $this->render('add',['type'=>$type]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 评论修改
	**/
	/******************** 1 ********************/
	public function actionUpdate(){
		
		//获取表单数据
		$id = Yii::$app->request->get('id');
		
		if (Yii::$app->request->post()) {
			$data = Yii::$app->request->post();
			
			$id = !empty($data['id']) ? $data['id'] : '';
			
			$data['update_time'] = time();//数据修改时间
			$data['index_pic'] = dy::getImgOne($data['ad_image']);//图片的路径
			
			//修改数据
			$rst = dy::execUpdate('news', $data, $id);
			
			if($rst){
				dy::execSuccess('index', '编辑成功');//页面跳转
			}else{
				dy::execError("编辑未成功！");
			}
		}else{
			//获取数据
			$list = News::getNewsOne($id);
			
			//获取评论类型
			$type = NewsType::find()->where(['status'=>[0,1]])->all();
			
			return $this->render('update', ['list'=>$list, 'type'=>$type]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 评论删除
	**/
	/******************** 1 ********************/
	public function actionDelete(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('news', $id, -1);//改变状态
		
		if($rst){
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 启用评论 	  
	**/
	/******************** 1 ********************/
	public function actionResume(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		//获取评论数据
		$list = dy::execGetRow('news', $id, 'news_type_id');
		
		//获取评论类型数据
		$data = dy::execGetRow('news_type', $list[0]['news_type_id']);
		
		if($data[0]['status'] == 1){
			$rst = dy::execStatusUp('news', $id, 1);//改变状态
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
	 * 20150409 add by dudanfeng 1 禁用评论
	**/
	/******************** 1 ********************/
	public function actionForbid(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('news', $id, 0);//改变状态
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 修改评论排列顺序
	**/
	/******************** 1 ********************/
	public function actionSortedit(){
		$data = Yii::$app->request->get();
		
		$id = !empty($data['id']) ? $data['id'] : '';
		
		if(is_numeric($data['sort'])){
			$sort = $data['sort'];
			
			$rst = dy::execStatusUp('news', $id, $sort, 'id', 'sort');//获取表名
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

	

