<?php

namespace components;

use Yii;
use components\BaseController;
use components\dy;

/**
 * 基础控制器，前端的一些初始化任务
**/
class BaseFrontController extends BaseController
{
	public function init()
	{
		parent::init();
		
		$list = dy::getSetting();
		
		if($list['web_status'] == 0){
			echo ("<meta http-equiv='Content-Type' content='text/html; charset=utf-8'><div style='margin-top:100px;' align='center'><span style='color:red;  font-size:20px;'>".$list['web_close_say']."</span></div>");
			exit;
		}
	}
}