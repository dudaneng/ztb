<?php

namespace components;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use  yii\web\Session;


/**
 * 基础控制器，实现后台和前台的一些基础配置
**/
class BaseController extends Controller
{	
	//网站设置
	public $_setting = array();
		
	public  $_baseUrl = '';
	protected  $_webRoot = '';  //网站根目录
	protected  $_ssVersion = 'dy.0';
	protected  $_ssRelease = '20150331';
		

	public function init()
	{
		$this->_baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
		$this->_webRoot = Yii::getAlias("@webroot");
		
		
		/*parent::init();
		
		if($this->channels == null)
		{
			$this->channels = CommonUtility::getCachedChannel();
		}
		if($this->rootChannels == null)
		{
			$this->rootChannels = CommonUtility::getRootChannels();
		}*/
	}

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => ['delete' => ['post']]
			]
		];
	}
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}	
	public function getChannel($chnid)
	{
		if(! isset($this->channels[$chnid]))
		{
			LuLu::info('channel id:' . $chnid . ' does not exist');
			throw new InvalidParamException('channel id:' . $chnid . ' does not exist');
		}
		return $this->channels[$chnid];
	}

	public function getChildChannels($chnid)
	{
		$ret = [];
		
		$currentChannel = $this->getChannel($chnid);
		$childIds = explode(',', $currentChannel['child_ids']);
		foreach($childIds as $id)
		{
			if(empty($id))
			{
				continue;
			}
			$ret[$id] = $this->getChannel($id);
		}
		return $ret;
	}
	
	private $_cachedRoles;

	public function getCachedRoles($roleName = null)
	{
		// if($this->_cachedRoles == null)
		// {
		// $this->_cachedRoles = YiiForum::getAppParam('cachedRoles');
		// }
		// if($roleName !== null)
		// {
		// return $this->_cachedRoles[$roleName];
		// }
		// return $this->_cachedRoles;
	}

	public function getCachedRolesByGroup($groupName)
	{
		$groups = $this->getCachedRoleGroups();
		if($groupName != null && isset($groups[$groupName]))
		{
			$items = [];
			$roles = $groups[$groupName]['roles'];
			foreach($roles as $role)
			{
				$items[$role] = $this->getCachedRoles($role);
			}
			return $items;
		}
		return false;
	}

	private $_cachedRoleGroups;

	public function getCachedRoleGroups($groupName = null)
	{
		// if($this->_cachedRoleGroups == null)
		// {
		// $this->_cachedRoleGroups = YiiForum::getAppParam('cachedRoleGroups');
		// }
		// if($groupName !== null)
		// {
		// return $this->_cachedRoleGroups[$groupName];
		// }
		// return $this->_cachedRoleGroups;
	}

	private $_cachedPermissions;

	public function getCachedPermissions($permissionName = null)
	{
		// if($this->_cachedPermissions == null)
		// {
		// $this->_cachedPermissions = YiiForum::getAppParam('cachedPermissions');
		// }
		// if($permissionName != null)
		// {
		// return $this->_cachedPermissions[$permissionName];
		// }
		// return $this->_cachedPermissions;
	}

	public function getCachedPermissionsByCategory($categoryName = null)
	{
		$categories = $this->getCachedPermissionCategories();
		if($categoryName != null && isset($categories[$categoryName]))
		{
			$items = [];
			$permissions = $categories[$categoryName]['permissions'];
			foreach($permissions as $permission)
			{
				$items[$permission] = $this->getCachedPermissions($permission);
			}
			return $items;
		}
		return false;
	}

	private $_cachedPermissionCategories;

	public function getCachedPermissionCategories()
	{
		// if($this->_cachedPermissionCategories == null)
		// {
		// $this->_cachedPermissionCategories = YiiForum::getAppParam('cachedPermissionCategories');
		// }
		// return $this->_cachedPermissionCategories;
	}

	public function noPermission()
	{
		return 'no permission';
	}

	public function actionView($id)
	{
		$locals = [];
		$locals['model'] = $this->findModel($id);
		
		return $this->render('view', $locals);
	}

	protected function findModel($id)
	{
		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
