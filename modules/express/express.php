<?php

namespace app\modules\express;

use Yii;

class express extends \yii\base\Module{
    
	public $controllerNamespace = 'app\modules\express\controllers';

    public function init()
    {
        parent::init();

        /**							
		 * 2015-04-03 add by ygd 1		
		 */
		if(!empty(Yii::$app->session->get("express_id"))){
			return true;
		}else{
			$webroot = Yii::$app->getUrlManager()->getBaseUrl();
			$url = $webroot.'/site/user';
			Header("Location:".$url);
			exit;
		}
    }
}
