<?php
/**							
 * 20150715 add by dudanfeng 1 后台首页
**/
namespace app\modules\admin\controllers;

use Yii;
use components\BaseBackController;
use yii\web\Session;
use app\models\Admin;

class DefaultController extends BaseBackController
{
	public $layout = "admin";
	
	
	/**
	 * 20150715 add by dudanfeg 1 后台首页
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		$user_id = Yii::$app->session->get('admin_id');
		
		$data = Admin::find()->where(['id'=>$user_id])->one();//获取管理员信息
		
		return $this->render('index', ['list'=>$data]);
    }
}
