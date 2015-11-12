<?php

namespace app\controllers;

use Yii;
use components\BaseFrontController;
use components\dy;
use yii\web\Session;
use app\models\News;
use app\models\NewsType;

class HelperController extends BaseFrontController
{
	
	//取消前端数据验证
	public $enableCsrfValidation = false;
	
	public $menu = '';
	public $numbers = '';
	public $setting = '';
	
	
	/**
	 * 20150703 add by dudanfng 1 权限判断
	**/
	/******************** 1 ********************/
	public function beforeAction($action){
		$mobile_browser = dy::getPcorwap();//手机和pc端判定
		
		if($mobile_browser > 0){
			return $this->redirect(['myweb/default/index']);
		}  
		return parent::beforeAction($action);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150611 add by dudanfng 1 帮助中心
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		$keyword = '';
		$type_id = Yii::$app->request->get('typeid');
		
		$type = empty($type_id) ? '' : $type_id;
		$str = "type=$type";//分页属性
		
		//分页初始化
		$num = 10;
		$page = 1;
		$start = 0;
		
		//获取点击页面
		$page = dy::getPage($num);
		
		//获取每页的初始条数
		$start = dy::getStart($num);
		
		//获取广告总的数量
		$pages = News::getPages($num, $keyword, $type);
		
		//调用分页样式
		$pageList = dy::getPageList($page, $pages, 'helper', $str);
		
		//获取广告数据
		$news = News::getNews($start, $num, $keyword, $type);
		
		
		$newstype = NewsType::find()->where(['status'=>1])->all();
		
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('index', ['news'=>$news, 'newstype'=>$newstype, 'pages'=>$pageList]);
	}
	/******************** 1 ********************/

	
	/**
	 * 201501104 add by dudanfng 1 文章详情页面
	**/
	/******************** 1 ********************/
	public function actionDetail(){
		$id = Yii::$app->request->get('id');
		
		$news = News::find()->where(['id'=>$id])->one();
		
		$num = News::execGetNum($id);
		
		$newstype = NewsType::find()->where(['status'=>1])->all();
		
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('detail', ['news'=>$news, 'newstype'=>$newstype]);
	}
}
