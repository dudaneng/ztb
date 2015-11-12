<?php
/**
 * 商品类型管理
 * 20150421 add by dudanfeng
**/
namespace app\modules\admin\controllers;

use Yii;
use components\BaseBackController;
use components\dy;
use app\models\Goods;
use app\models\GoodsTypeBig;
use app\models\GoodsTypeSmall;
use app\models\Shop;

class GoodstypeController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	/**
	 * 20150421 add by dudanfeng 1 商品类型列表
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		//分页初始化
		$num = 12;
		$page = 1;
		$start = 0;
		
		//获取点击页面
		$page = dy::getPage($num);
		
		//获取每页的初始条数
		$start = dy::getStart($num);
		
		//获取商品类型总的数量
		$pages = GoodsTypeBig::getPages($num);
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'index');
		
		//获取商品类型数据
		$list = GoodsTypeBig::getGoodsType($start, $num);
		
		return $this->render('index',['row'=>$list, 'page'=>$pageList]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150421 add by dudanfeng 1 商品类型添加
	**/
	/******************** 1 ********************/
	public function actionAdd(){
		
		$data = Yii::$app->request->post();//获取表单数据
		
		if ($data) {
			
			$list = GoodsTypeBig::find()->where(['type_name' => $data['type_name']])->one();

			if($list){
				dy::execError("标题已存在");
			}else{
				//商品类型添加
				$rst = dy::execAdd('goods_type_big', $data);
			
				dy::execSuccess('index', '添加成功');//页面跳转
			}			
		} else {
			return $this->render('add');
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150421 add by dudanfeng 1 商品类型修改
	**/
	/******************** 1 ********************/
	public function actionUpdate(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		if (Yii::$app->request->post()) {
			//获取修改的数据
			$data = Yii::$app->request->post();
			$id = !empty($data['id']) ? $data['id'] : '';
			
			$rst = dy::execUpdate('goods_type_big', $data, $id);//修改数据
			
			if($rst){
				dy::execSuccess('index', '编辑成功');//页面跳转
			}else{
				dy::execError("编辑未成功！");
			}
			
		}else{
			//获取商品数据
			$list = GoodsTypeBig::getGoodsTypeOne($id); 
			
			return $this->render('update', ['list'=>$list]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 数据假删除
	**/
	/******************** 1 ********************/
	public function actionDelete(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		//改变状态
		$rst = dy::execStatusUp('goods_type_big', $id, -1);
		
		if($rst){
			//删除下级类型
			$rst = dy::execStatusUp('goods_type_small', $id, -1, 'type_small');
			
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 启用数据  
	**/
	/******************** 1 ********************/
	public function actionResume(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		//改变状态
		$rst = dy::execStatusUp('goods_type_big', $id, 1);
		
		if($rst){
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 禁用数据
	**/
	/******************** 1 ********************/
	public function actionForbid(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		//改变状态
		$rst = dy::execStatusUp('goods_type_big', $id, 0);
		
		if($rst){
			$rst = dy::execStatusUp('goods_type_small', $id, 0, 'type_small');//改变下级分类状态
			$rst = dy::execStatusUp('goods', $id, 0, 'type_big');//改变商品状态
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 修改商品排列顺序
	**/
	/******************** 1 ********************/
	public function actionSortedit(){
		$data = Yii::$app->request->get();
		$id = !empty($data['id']) ? $data['id'] : '';
		
		if(is_numeric($data['sort'])){
			$sort = $data['sort'];
			
			$rst = dy::execStatusUp('goods_type_big', $id, $sort, 'id', 'sort');
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
	 * 20150421 add by dudanfeng 1 商品类型列表
	**/
	/******************** 1 ********************/
    public function actionSmalltype(){
		
		//获取上级类型的ID
		$data = Yii::$app->request->get();
		if(isset($data['id'])){
			$id = $data['id'];
			$session = Yii::$app->session;
			$session->set('type_small', $id);
		}else{
			$id = Yii::$app->session->get('type_small');
		}
		
		//分页初始化
		$num = 12;
		$page = 1;
		$start = 0;
		
		//获取点击页面
		$page = dy::getPage($num);
		
		//获取每页的初始条数
		$start = dy::getStart($num);
		
		//获取商品总的页数
		$pages = GoodsTypeSmall::getPages($num, $id);
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'smalltype');
		
		//获取商品数据
		$list = GoodsTypeSmall::getGoodsType($start, $num, $id);
		
		return $this->render('smalltype',['row'=>$list, 'page'=>$pageList, 'type_small'=>$id]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150421 add by dudanfeng 1 商品下级类型添加
	**/
	/******************** 1 ********************/
	public function actionSmalladd(){
		
		$data = Yii::$app->request->post();//获取表单数据
		
		if ($data) {
			
			$list = GoodsTypeSmall::find()->where(['type_name' => $data['type_name']])->one();

			if($list){
				dy::execError("标题已存在");
			}else{
				//商品次级类型添加
				$rst = dy::execAdd('goods_type_small', $data);
				
				dy::execSuccess('index', '添加成功');//页面跳转
			}
		} else {
			$type_small = Yii::$app->request->get('type_small');//获取上级类型的ID
			
			return $this->render('smalladd', ['type_small'=> $type_small]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150421 add by dudanfeng 1 商品类型修改
	**/
	/******************** 1 ********************/
	public function actionSmallupdate(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		if (Yii::$app->request->post()) {
			//获取修改的数据
			$data = Yii::$app->request->post();
			$id = !empty($data['id']) ? $data['id'] : '';
			
			$rst = dy::execUpdate('goods_type_small', $data, $id);//修改数据
			
			if($rst){
				dy::execSuccess('index', '编辑成功');//页面跳转
			}else{
				dy::execError("编辑未成功！");
			}
			
		}else{
			//获取商品数据
			$list = GoodsTypeSmall::getGoodsTypeOne($id); 
			
			return $this->render('smallupdate', ['list'=>$list]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 数据假删除
	**/
	/******************** 1 ********************/
	public function actionDeletesmall(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		$rst = dy::execStatusUp('goods_type_small', $id, -1);//改变状态
		
		if($rst){
			$rst = dy::execStatusUp('goods', $id, -1, 'type_small');//改变商品状态
			
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 启用数据  
	**/
	/******************** 1 ********************/
	public function actionResumesmall(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		//获取文章数据
		$list = dy::execGetRow('goods_type_small', $id, 'type_small');
		
		//获取文章类型数据
		$data = dy::execGetRow('goods_type_big', $list[0]['type_small']);
		
		if($data[0]['status'] == 1){
			
			$rst = dy::execStatusUp('goods_type_small', $id, 1);//改变类型状态
			
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
	 * 20150410 add by dudanfeng 1 禁用数据
	**/
	/******************** 1 ********************/
	public function actionForbidsmall(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		//改变状态
		$rst = dy::execStatusUp('goods_type_small', $id, 0);
		
		if($rst){
			$rst = dy::execStatusUp('goods', $id, 0, 'type_small');//改变商品状态
			echo 1;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 修改商品排列顺序
	**/
	/******************** 1 ********************/
	public function actionSmallsortedit(){
		$data = Yii::$app->request->get();
		$id = !empty($data['id']) ? $data['id'] : '';
		
		if(is_numeric($data['sort'])){
			$sort = $data['sort'];
			
			$rst = dy::execStatusUp('goods_type_small', $id, $sort, 'id', 'sort');
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

	

