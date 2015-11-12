<?php

namespace app\modules\myweb\controllers;

use yii\web\Controller;
use Yii;
use components\BaseBackController;
use components\dy;
use yii\web\Session;

use app\models\News;
use app\models\NewsType;

class NewsController extends BaseBackController
{
	
	//取消前端数据验证
	public $enableCsrfValidation = false;
	
	public $layout = "main";
	
	public $menu = '';//自提点数据
	public $numbers = '';//购物车数量
	public $setting = '';//系统设置
	
	/**
	 * 20150519 add by dudanfng 1 首页
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		
		$type_list = NewsType::findBySql('SELECT * FROM {{%news_type}} where status=1 and id>21')->one();
		$type = $type_list['id'];//获取文章类型
		
		$keyword = Yii::$app->request->post('keyword');
		$str = "keyword=$keyword&type=$type";//分页属性
		
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
		$pageList = dy::getPageList($page, $pages, 'index', $str);
		
		//获取广告数据
		$list = News::getNews($start, $num, $keyword, $type);
		
		$this->menu= dy::getGoodsTypeSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('index', ['row'=>$list, 'page'=>$pageList]);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150724 add by dudanfng 1 文章详情
	**/
	/******************** 1 ********************/
    public function actionDetail(){
		$connection = Yii::$app->db;
		
		$id = Yii::$app->request->get('id');
		
		$command = $connection->createCommand("SELECT * FROM {{%news}} WHERE id=:a");
		$command->bindValue(':a', $id);
		$news = $command->query();//大区域数据
		
		$this->menu= dy::getGoodsTypeSelect();//获取区域
		$this->numbers= dy::getCartNumbers();//获取数量
		$this->setting= dy::getSetting();//版权信息
		
		return $this->render('detail', ['news'=>$news]);
	}
	/******************** 1 ********************/
	
}


