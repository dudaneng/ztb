<?php

namespace app\modules\myweb;

use Yii;

class myweb extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\myweb\controllers';

    public function init()
    {
        parent::init();

        /**							
		 * 2015-04-03 add by ygd 1		
		 */
		if(!empty(Yii::$app->session->get("express_id"))){
			return true;
		}else{
			return true;
		}
    }
}
