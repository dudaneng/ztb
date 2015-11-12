<?php

namespace app\modules\admin;

use Yii;
use app\models\Setting;

class admin extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();
		
		/**							
		 * 2015-04-03 add by ygd 1 后台入口判断
		 */
		if(!empty(Yii::$app->session->get("admin_id"))){
			$setting= Setting::getSetting('seo');//版权信息
			Yii::$app->session->set('setting', $setting['seo_title']);//seo信息获取
			
			return true;
		}else{
			$webroot = Yii::$app->getUrlManager()->getBaseUrl();
			$url = $webroot.'/site/admin';
			Header("Location:".$url);
			exit;
		}
	}
}
