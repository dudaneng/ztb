<?php
/**
 * 用户管理
 * 20150422 add by xiaozhu
**/
namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
use app\models\Order;
use components\BaseBackController;
use components\dy;

class UserController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	/**
	 * 20150422 add by xiaozhu 1 用户列表
	**/
	/******************** 1 ********************/
    public function actionIndex()
    {
		$keyword = Yii::$app->request->get('keyword');
		$type = Yii::$app->request->get('type');
		
		$str = "type=$type&keyword=$keyword";//分页属性
		
		//分页初始化
		$num = 10;
		$page = 1;
		$start = 0;
		
		//获取点击页面
		$page = dy::getPage($num);
		
		//获取每页的初始条数
		$start = dy::getStart($num);
		
		//获取总的数量
		$pages = User::getPages($num, $keyword, $type);
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'index', $str);
		
		//获取数据
		$list = User::getAll($start, $num, $keyword, $type); 
		
		return $this->render('index',['row'=>$list, 'page'=>$pageList, 'type'=>$type]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150422 add by dudanfeng 1 用户查看
	**/
	/******************** 1 ********************/
	public function actionDetail(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$order_list = Order::find()->where(['express_id'=>$id])->all();//快递数量统计
		$numbers = count($order_list);
		
		$order_list1 = Order::find()->where(['express_id'=>$id, 'status'=>[4,6]])->all();//进行中 快递数量统计
		$numbers1 = count($order_list1);
		
		$list = User::getOne($id);//获取数据
		
		return $this->render('detail', ['list'=>$list, 'numbers'=>$numbers, 'numbers1'=>$numbers1]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150422 add by xiaozhu 1 用户删除
	**/
	/******************** 1 ********************/
	public function actionDelete(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('user', $id, -1);//改变状态
		
		if($rst){
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150422 add by xiaozhu 1 启用用户 	  
	**/
	/******************** 1 ********************/
	public function actionResume(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('user', $id, 1);//改变状态
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150422 add by xiaozhu 1 禁用用户
	**/
	/******************** 1 ********************/
	public function actionForbid(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('user', $id, 0);//改变状态
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150422 add by xiaozhu 1 添加用户检测
	**/
	/******************** 1 ********************/
	public function actionAddsubmit(){
		
		$data = Yii::$app->request->post();
		
		$list = User::find()->where(['user_account' => $data['user_account']])->one();

		if($list){
			echo 0;
		}else{
			echo 1;
		}
		
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150624 add by ddf 1 快递授权
	**/
	/******************** 1 ********************/
	public function actionGroup(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('user', $id, 2, 'id', 'group_id');//改变状态
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150624 add by ddf 1 授权取消
	**/
	/******************** 1 ********************/
	public function actionSetgroup(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('user', $id, 1, 'id', 'group_id');//改变状态
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
}	

	

