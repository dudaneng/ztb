<?php
/**							
 * 2015-04-03 add by xiaozhu 1 系统设置
**/
namespace app\modules\admin\controllers;

use Yii;
use components\BaseBackController;
use components\dy;
use app\models\Admin;
use app\models\Setting;
use app\models\WxApi;

class SettingController extends BaseBackController
{
	public $layout = "admin";
	
	//取消前端数据验证
	public $enableCsrfValidation = false;
	
	/**							
	 * 2015-04-03 add by xiaozhu 1 系统设置视图控制器
	**/
	/******************** 1 ********************/
    public function actionIndex(){
		$list = Setting::getScope(); //读取系统配置信息
			
		$weixin = WxApi::find()->one();
		
        return $this->render('index', array('l' => $list, 'weixin'=>$weixin));
    }
	/******************** 1 ********************/
	
	
	/**							
	 * 20150403 add by xiaozhu 1 网站设置更新
	 * 20150529 update by dudanfeng 2 功能优化
	**/
	/******************** 1 ********************/
    public function actionWebup(){
		
		$web_status = Yii::$app->request->post('web_status');
		$web_close_say = Yii::$app->request->post('web_close_say');
		$web_icp = Yii::$app->request->post('web_icp');
		$web_copyright = Yii::$app->request->post('web_copyright');
		
		$rst = Setting::updateWeb($web_status, $web_close_say, $web_icp, $web_copyright);//数据修改
		if($rst){
			/******************** 2 ********************/
			dy::execSuccess('index', '修改成功', 3);
			/******************** 2 ********************/
			
			//return $this->redirect(dy::getWebUrl().'/admin/default/index');
		}else{
			/******************** 2 ********************/
			dy::execError('修改未成功');
			/******************** 2 ********************/
			
			//return $this->redirect(dy::getWebUrl().'/admin/setting/index');
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150528 add by dudanfeng 1 管理员设置
	**/
	/******************** 1 ********************/
    public function actionSetuser(){
		
		$user_id = Yii::$app->session->get('admin_id');
		
		$user_password = Yii::$app->request->post('user_password'); //原始密码
		$password = Yii::$app->request->post('password');//新密码
		$r_password = Yii::$app->request->post('r_password');//新密码
		$formtype = Yii::$app->request->post('formtype');//表单类型
		
		$list = Admin::find()->where(['id' => $user_id, 'admin_password'=>md5($user_password)])->one();

		if($password != $r_password){
			dy::execError('两次密码不一致！');
		}else if(!$list){
			dy::execError('旧密码错误！ ');
		}else if($password == ''){
			dy::execError('新密码不能为空！ ');
		}else{
			$data = array(
				'admin_password' => md5($password),
			);
				
			$rst = dy::execUpdate('admin', $data, $user_id);
			
			if($rst){
				dy::execSuccess('index', '修改成功', 3, $formtype);
			}else{
				dy::execError('操作错误!');
			}
		}
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 2015-04-03 add by xiaozhu 1 SEO设置更新
	 * 20150529 update by dudanfeng 2 功能优化
	**/
	/******************** 1 ********************/
    public function actionSeoup()
    {
		$seo_title = Yii::$app->request->post('seo_title');
		$seo_keywords = Yii::$app->request->post('seo_keywords');
		$seo_describe = Yii::$app->request->post('seo_describe');
		
		/* $session = Yii::$app->session;
		$session->set('setting', $seo_title); */
		
		$rst = Setting::updateSeo($seo_title, $seo_keywords, $seo_describe);
		if($rst){
			/******************** 2 ********************/
			dy::execSuccess('index', '修改成功', 3);
			/******************** 2 ********************/
			
			//return $this->redirect(dy::getWebUrl().'/admin/default/index');
		}else{
			/******************** 2 ********************/
			dy::execError('修改未成功');
			/******************** 2 ********************/
			
			//return $this->redirect(dy::getWebUrl().'/admin/setting/index');
		}
    }
	/******************** 1 ********************/
	
	
	/**							
	 * 2015-04-03 add by xiaozhu 1 邮箱设置更新
	 * 20150529 update by dudanfeng 2 功能优化
	**/	
	/******************** 1 ********************/
    public function actionEmailup()
    {
		$email_set = Yii::$app->request->post('email_set');
		$email_server = Yii::$app->request->post('email_server');
		$email_port = Yii::$app->request->post('email_port');
		$email_send_person = Yii::$app->request->post('email_send_person');
		$email_account = Yii::$app->request->post('email_account');
		$email_password = Yii::$app->request->post('email_password');
			
		$rst = Setting::updateEmail($email_set, $email_server, $email_port, $email_send_person, $email_account, $email_password);
		if($rst){
			return $this->redirect(dy::getWebUrl().'/admin/default/index');
		}else{
			return $this->redirect(dy::getWebUrl().'/admin/setting/index');
		}	
    }
	/******************** 1 ********************/
	
	
	/**							
	 * 2015-04-03 add by xiaozhu 1 短信设置更新
	**/
	/******************** 1 ********************/
    public function actionMessageup()
    {
		$sms_set = Yii::$app->request->post('sms_set');
		$sms_account = Yii::$app->request->post('sms_account');
		$sms_password = Yii::$app->request->post('sms_password');
			
		$rst = Setting::updateMessage($sms_set, $sms_account, $sms_password);
		if($rst){
			return $this->redirect(dy::getWebUrl().'/admin/default/index');
		}else{
			return $this->redirect(dy::getWebUrl().'/admin/setting/index');
		}	
    }
	/******************** 1 ********************/
	
	
	/**							
	 * 2015-04-03 add by xiaozhu 1 公司设置更新
	 * 20150529 update by dudanfeng 2 功能优化
	**/
	/******************** 1 ********************/
    public function actionCompanyup()
    {
		$company_name = Yii::$app->request->post('company_name');
		$company_address = Yii::$app->request->post('company_address');
		$company_phone = Yii::$app->request->post('company_phone');
		$company_tel = Yii::$app->request->post('company_tel');
		$company_qq = Yii::$app->request->post('company_qq');
		$company_email = Yii::$app->request->post('company_email');
		$company_time = Yii::$app->request->post('company_time');
		$company_notice1 = Yii::$app->request->post('company_notice1');
		$company_notice2 = Yii::$app->request->post('company_notice2');
			
		$rst = Setting::updateCompany($company_name, $company_address, $company_phone, $company_tel, $company_qq, $company_email, $company_time, $company_notice1, $company_notice2);
		if($rst){
			/******************** 2 ********************/
			dy::execSuccess('index', '修改成功', 3);
			/******************** 2 ********************/
			
			//return $this->redirect(dy::getWebUrl().'/admin/default/index');
		}else{
			/******************** 2 ********************/
			dy::execError('修改未成功');
			/******************** 2 ********************/
			
			//return $this->redirect(dy::getWebUrl().'/admin/setting/index');
		}	
    }
	/******************** 1 ********************/
	

	/**							
	 * 2015-04-08 add by xiaozhu 1 发送测试验证码
	**/
	/******************** 1 ********************/
	public function actionSendcode() {
		$sms_account = Yii::$app->request->post ( 'sms_account' );
		$sms_password = Yii::$app->request->post ( 'sms_password' );
		$sms_mobile = Yii::$app->request->post ( 'sms_test' );
	
		$result = dy::sendCode ( $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit",$sms_account, $sms_password, $sms_mobile, $sms_content='AAAAAA' );

		echo $result ['SubmitResult'] ['msg'];
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 2015-04-08 add by xiaozhu 1 发送测试邮件
	**/
	/******************** 1 ********************/
	public function actionSendemail() {
		
		$test_email = Yii::$app->request->post ( 'test_email' );
		
		// 邮箱配置
		$mail= Yii::$app->mailer->compose();
		
		$mail->setTo($test_email);  
		$mail->setSubject("大业互动邮件测试");
		$mail->setTextBody('xiaozhu');  
		$mail->setHtmlBody("我是周小猪，你好！");  
		
		if($mail->send())  
			echo "success";  
		else  
			echo "failse";   
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 20150724 add by dudanfeng 1 微信设置
	**/
	/******************** 1 ********************/
	public function actionWeixinup() {
		$id = Yii::$app->request->post('id');
		$appid = Yii::$app->request->post('appid');
		$api_type = Yii::$app->request->post('api_type');
		$appsecret = Yii::$app->request->post('appsecret');
		
		dy::execUpdate('wx_api', array('api_type'=>$api_type, 'appid'=>$appid, 'appsecret'=>$appsecret), $id);
		
		dy::execSuccess('index', '修改成功', 3);
	}
	/******************** 1 ********************/
	
}
