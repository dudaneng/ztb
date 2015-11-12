<?php
/**
 * 广告管理
 * 20150409 add by dudanfeng
**/
namespace app\modules\admin\controllers;

use Yii;
use components\BaseBackController;
use components\dy;
use app\models\AdPosition;
use app\models\Ad;

class AdController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	/**
	 * 20150409 add by dudanfeng 1 广告列表
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		//分页初始化
		$num = 5;
		$page = 1;
		$start = 0;
		
		//获取点击页面
		$page = dy::getPage($num);
		
		//获取每页的初始条数
		$start = dy::getStart($num);
		
		//获取广告总的数量
		$pages = Ad::getPages($num);
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'index');
		
		//获取广告数据
		$list = Ad::getAd($start, $num);
		
		return $this->render('index',['row'=>$list, 'page'=>$pageList]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 广告添加
	**/
	/******************** 1 ********************/
	public function actionAdd(){
		
		//获取表单数据
		$data = Yii::$app->request->post();
		
		if ($data) {
			
			$list = Ad::find()->where(['ad_name' => $data['ad_name']])->one();

			if($list){
				dy::execError('标题重复');
			}else{
				
				//广告创建时间
				$data['create_time'] = time();
				$data['update_time'] = time();
				$data['index_pic'] = dy::getImgOne($data['ad_image']);
				
				//广告添加
				$rst = dy::execAdd('ad', $data);
				
				dy::execSuccess('index', '添加成功');//页面跳转
			}
		} else {
			$type = AdPosition::find()->where(['status'=>[0,1]])->all();
			
			return $this->render('add',['type'=>$type]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 广告修改
	**/
	/******************** 1 ********************/
	public function actionUpdate(){
		
		//获取表单数据
		$id = Yii::$app->request->get('id');
		
		if (Yii::$app->request->post()) {
			$data = Yii::$app->request->post();
			
			$id = !empty($data['id']) ? $data['id'] : '';
			
			//数据修改时间
			$data['update_time'] = time();
			$data['index_pic'] = dy::getImgOne($data['ad_image']);
			
			//修改数据
			$rst = dy::execUpdate('ad', $data, $id);
			
			if($rst){
				dy::execSuccess('index', '编辑成功');//页面跳转
			}else{
				dy::execError('编辑未成功！');
			}
		}else{
			//获取广告数据
			$list = ad::getAdOne($id);
			
			//获取广告类型
			$type = AdPosition::find()->where(['status'=>[0,1]])->all();
			
			return $this->render('update', ['list'=>$list, 'type'=>$type]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 广告删除
	**/
	/******************** 1 ********************/
	public function actionDelete(){
		
		//获取表单数据
		$id = Yii::$app->request->get('id');
		
		//改变状态
		$rst = dy::execStatusUp('ad', $id, -1);
		
		if($rst){
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 启用广告 	  
	**/
	/******************** 1 ********************/
	public function actionResume(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$list = dy::execGetRow('ad', $id);//获取广告数据
		
		$data = dy::execGetRow('ad_position', $list[0]['position_id']);//获取广告类型数据
		
		$row = dy::execStatusUp('ad_position', $list[0]['position_id'], 1);//改变类型状态
		
		$rst = dy::execStatusUp('ad', $id, 1);//改变状态
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 禁用广告
	**/
	/******************** 1 ********************/
	public function actionForbid(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('ad',$id, 0);//改变状态
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 修改广告排列顺序
	**/
	/******************** 1 ********************/
	public function actionSortedit(){
		$data = Yii::$app->request->get();
		
		$id = !empty($data['id']) ? $data['id'] : '';
		
		if(is_numeric($data['sort'])){
			$sort = $data['sort'];
			
			//改变状态
			$rst = dy::execStatusUp('ad', $id, $sort, 'id', 'sort');
			
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
	 * 20150409 add by dudanfeng 1 类型列表
	**/
	/******************** 1 ********************/
    public function actionAdtype(){
		//分页初始化
		$num = 10;
		$page = 1;
		$start = 0;
		
		//获取点击页面
		$page = dy::getPage($num);
		
		//获取每页的初始条数
		$start = dy::getStart($num);
		
		//获取总的页数
		$pages = AdPosition::getPages($num);
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'adtype');
		
		//获取广告类型数据
		$list = AdPosition::getAdType($start, $num);
		
		return $this->render('adtype',['row'=>$list, 'page'=>$pageList]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 广告添加
	**/
	/******************** 1 ********************/
	public function actionAddtype(){
		//获取表单数据
		$data = Yii::$app->request->post();
		
		if ($data) {
			
			$list = AdPosition::find()->where(['position_name' => $data['position_name']])->one();

			if($list){
				dy::execError("标题已存在");
			}else{
				//广告类型添加
				$rst = dy::execAdd('ad_position', $data);
				
				dy::execSuccess('adtype', '添加成功');//页面跳转
			}
		} else {
			return $this->render('addtype');
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 广告修改
	**/
	/******************** 1 ********************/
	public function actionUpdatetype(){
		//获取表单数据
		$id = Yii::$app->request->get('id');
		
		if (Yii::$app->request->post()) {
			$data = Yii::$app->request->post();
			
			$id = !empty($data['id']) ? $data['id'] : '';
			
			//修改数据
			$rst = dy::execUpdate('ad_position', $data, $id);
			
			if($rst){
				dy::execSuccess('adtype', '编辑成功');//页面跳转
			}else{
				dy::execError("编辑未成功！");
			}
			
		}else{
			//获取广告数据
			$list = dy::execGetRow('ad_position', $id);
			
			return $this->render('updatetype', ['list'=>$list]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 广告类型删除
	**/
	/******************** 1 ********************/
	public function actionDeletetype(){
		//获取表单数据
		$id = Yii::$app->request->get('id');
		
		//改变状态
		$rst = dy::execStatusUp('ad_position', $id, -1);
		
		if($rst){
			$rst = dy::execStatusUp('ad', $id, -1, 'position_id');
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 启用类型广告 	  
	**/
	/******************** 1 ********************/
	public function actionResumetype(){
		//获取表单数据
		$id = Yii::$app->request->get('id');
		
		//改变状态
		$rst = dy::execStatusUp('ad_position', $id, 1);
		
		if($rst){
			$rst = dy::execStatusUp('ad', $id, 1, 'position_id');
			
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 禁用类型广告
	**/
	/******************** 1 ********************/
	public function actionForbidtype(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('ad_position',$id, 0);//改变状态
		
		if($rst){
			$rst = dy::execStatusUp('ad', $id, 0, 'position_id');
			
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 修改广告排列顺序
	**/
	/******************** 1 ********************/
	public function actionTypesortedit(){
		$data = Yii::$app->request->get();
		
		$id = !empty($data['id']) ? $data['id'] : '';
		
		if(is_numeric($data['sort'])){
			$sort = $data['sort'];
			
			//改变状态
			$rst = dy::execStatusUp('ad_position', $id, $sort, 'id', 'sort');
			
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

	

