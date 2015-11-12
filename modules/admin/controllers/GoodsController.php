<?php
/**
 * 商品管理
 * 20150410 add by dudanfeng
**/
namespace app\modules\admin\controllers;

use Yii;
use components\BaseBackController;
use components\dy;
use app\models\Goods;
use app\models\GoodsTypeBig;
use app\models\GoodsTypeSmall;
use app\models\Shop;
use app\models\GoodsColor;

class GoodsController extends BaseBackController
{
	//取消前端数据验证
	public $enableCsrfValidation = false;

	public $layout = "admin";
	
	
	/**
	 * 20150410 add by dudanfeng 1 商品列表
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
		
		//获取商品总的数量
		$pages = Goods::getPages($num, $keyword, $type);
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'index', $str);
		
		//获取商品数据
		$list = Goods::getGoods($start, $num, $keyword, $type);
		
		$goods_type = GoodsTypeBig::find()->where(['status'=>1])->all();//获取类型
		
		$select_type = GoodsTypeBig::find()->where(['status'=>1, 'id'=>$type])->one();//获取当前类型
		
		return $this->render('index',['row'=>$list, 'page'=>$pageList, 'goods_type' => $goods_type, 'select_type' => $select_type]); 
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 商品添加
	**/
	/******************** 1 ********************/
	public function actionAdd(){
		
		$data = Yii::$app->request->post();//获取表单数据
		
		if ($data) {
			
			$list = Goods::find()->where(['hs_code' => $data['hs_code']])->one();
			
			if($list){
				dy::execError("此商品编号已存在");
			}else{
				//创建时间
				$data['create_time'] = time();
				$data['update_time'] = time();
				$data['shop_id'] = 1;
				//商品添加
				$src = dy::getImgAll($data['goods_show']);
				
				$data['index_pic'] = dy::getImgOne($data['goods_show']);
				
				//商品添加
				$rst = dy::execAdd('goods', $data);
				
				dy::execSuccess('index', '添加成功');//页面跳转
			}			
		} else {
			$type_big = GoodsTypeBig::find()->where(['status'=>1])->all();
			$shop = Shop::find()->where(['status'=>1])->all();
			$color = GoodsColor::find()->where(['status'=>1])->all();
			
			return $this->render('add',['type_big'=>$type_big, 'shop'=>$shop, 'color' =>$color]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 商品修改
	**/
	/******************** 1 ********************/
	public function actionUpdate(){
		
		$id = Yii::$app->request->get('id');//获取表单数据
		
		if (Yii::$app->request->post()) {
			$data = Yii::$app->request->post();
			$id = !empty($data['id']) ? $data['id'] : '';
			
			$data['update_time'] = time();//数据修改时间
			
			$src = dy::getImgAll($data['goods_show']);
			
			$data['index_pic'] = dy::getImgOne($data['goods_show']);
			
			$rst = dy::execUpdate('goods', $data, $id);//修改数据
			
			if($rst){
				dy::execSuccess('index', '编辑成功');//页面跳转
			}else{
				dy::execError("编辑未成功！");
			}
			
		}else{
			//获取商品数据
			$list = Goods::getGoodsOne($id);
			
			//获取商品数据
			$type_big = GoodsTypeBig::find()->where(['status'=>1])->all();
			$shop = Shop::find()->where(['status'=>1])->all();
			$color = GoodsColor::find()->where(['status'=>1])->all();
			
			return $this->render('update', ['list'=>$list, 'type_big'=>$type_big, 'shop'=>$shop, 'color'=>$color]);
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 商品删除
	**/
	/******************** 1 ********************/
	public function actionDelete(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		//改变状态
		$rst = dy::execStatusUp('goods', $id, -1);
		
		if($rst){
			echo 2;
		}else{
			echo 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150410 add by dudanfeng 1 启用商品 	  
	**/
	/******************** 1 ********************/
	public function actionResume(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		//获取文章数据
		$list = dy::execGetRow('goods', $id, 'type_big');
		
		//获取类型数据
		$data = dy::execGetRow('goods_type_big', $list[0]['type_big']);
		
		if($data[0]['status'] == 1){
			//改变状态
			$rst = dy::execStatusUp('goods', $id, 1);
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
	 * 20150410 add by dudanfeng 1 禁用商品
	**/
	/******************** 1 ********************/
	public function actionForbid(){
		$id = Yii::$app->request->get('id');//获取表单数据
		
		//改变状态
		$rst = dy::execStatusUp('goods', $id, 0);
		
		if($rst){
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
			
			$rst = dy::execStatusUp('goods', $id, $sort, 'id', 'sort');
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
	 * 20150410 add by dudanfeng 1 修改商品热门
	**/
	/******************** 1 ********************/
	public function actionHotedit(){
		$data = Yii::$app->request->get();
		$id = !empty($data['id']) ? $data['id'] : '';
		$is_hot = $data['is_hot'];
		
		if(is_numeric($id) && !empty($id)){
			if($is_hot == 0){
				$rst = dy::execStatusUp('goods', $id, 1, 'id', 'is_hot');
			}else if($is_hot == 1){
				$rst = dy::execStatusUp('goods', $id, 0, 'id', 'is_hot');
			}
			
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
	 * 20150410 add by dudanfeng 1 修改商品推荐
	**/
	/******************** 1 ********************/
	public function actionRecommendedit(){
		$data = Yii::$app->request->get();
		$id = !empty($data['id']) ? $data['id'] : '';
		$is_recommend = $data['is_recommend'];
		
		if(is_numeric($id) && !empty($id)){
			if($is_recommend == 0){
				$rst = dy::execStatusUp('goods', $id, 1, 'id', 'is_recommend');
			}else if($is_recommend == 1){
				$rst = dy::execStatusUp('goods', $id, 0, 'id', 'is_recommend');
			}
			
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
	 * 20150413 add by dudanfeng 1 商品类型选择
	**/
	/******************** 1 ********************/
	
	public function actionSetselect(){
		
		$data = Yii::$app->request->post();
		$id = !empty($data['id']) ? $data['id'] : '';
		
		if(is_numeric($id)){
			
			$list = GoodsTypeSmall::getGoodsSmall($id);//获取商品类型数据
			
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
	 * 20150410 add by dudanfeng 1 修改商品排列顺序
	**/
	/******************** 1 ********************/
	public function actionPriceedit(){
		
		$id = Yii::$app->request->post('id');
		$price = Yii::$app->request->post('price');
		$type = Yii::$app->request->post('type');
		 
		if($type == 1){
			$rst = dy::execStatusUp('goods', $id, $price, 'id', 'price_market');
			
			if($rst){
				echo 1;
			}else{
				echo 0;
			}	
		}else if($type == 2){
			$rst = dy::execStatusUp('goods', $id, $price, 'id', 'price_vip');
			
			if($rst){
				echo 2;
			}else{
				echo 0;
			}
		}
		
		
	}
	/******************** 1 ********************/ 
	
	
}	

	

