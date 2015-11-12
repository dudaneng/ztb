<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property string $id
 * @property string $scope
 * @property string $variable
 * @property string $value
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['variable'], 'required'],
            [['value'], 'string'],
            [['scope'], 'string', 'max' => 30],
            [['variable'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scope' => 'Scope',
            'variable' => 'Variable',
            'value' => 'Value',
        ];
    }
	
	/**							
	 * 2015-04-03 add by xiaozhu 1		
	 * 更新系统设置						更新键值对
	 * @param string $scope				系统设置的范围 
	 * @param string $variable			系统设置的变量
	 * @param string $value				系统设置的值	 
	 * @return boolean					1：执行成功，0：执行失败
	 */							
	/****************************** 1 ******************************/	
	// 
	public static function updateSetting($scope, $variable, $value)
	{
		$connection = Yii::$app->db;
		
		$command = $connection->createCommand("update {{%setting}}  set value=:value WHERE scope='$scope' and variable='$variable'");
		$command->bindParam(':value', $value);
		$rst = $command->execute();// 更新操作
		
		return $rst;// 返回值（1：执行成功，0：执行失败）
	}
	/****************************** 1 ******************************/
	
	/**							
	 * 2015-04-03 add by xiaozhu 1		
	 * 获得同范围的数组					例如：获得网站设置的值
	 * @param string $scope				范围 	 
	 * @return array					返回同范围的数组
	 */							
	/****************************** 1 ******************************/	
	public static function getScope()
	{
		$rstall = Setting::find()->all(); 
		foreach($rstall as $r){
			$rst[$r['variable']] = $r['value'];
		}
		
		return $rst;
	}
	/****************************** 1 ******************************/
	
	
	/**
	 * 20150608 add by dudanfeng 1 系统设置读取
	 * @return array              返回值
	**/
	/******************** 1 ********************/
	public static function getSetting($value = ''){
		$list = Setting::find()->where(['scope'=>$value])->all(); 
		
		$result = array();
		foreach($list as $k => $v){
			$result[$v['variable']] = $v['value'];
		}
		
		return $result;
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 2015-04-03 add by xiaozhu 1		
	 * 更新网站设置						
	 * @param string $web_status		网站维护状态
	 * @param string $web_close_say		维护说明
	 * @param string $web_icp			网站备案号
	 * @param string $web_copyright		版权信息
	 * @return boolean					1：执行成功，0：执行失败
	 */							
	/****************************** 1 ******************************/	
	// 
	public static function updateWeb($web_status, $web_close_say, $web_icp, $web_copyright)
	{
		$connection = Yii::$app->db;
		$transaction = $connection->beginTransaction();//开启事务处理
		try {
			Setting::updateSetting('web','web_status',$web_status);
			Setting::updateSetting('web','web_close_say',$web_close_say);
			Setting::updateSetting('web','web_icp',$web_icp);
			Setting::updateSetting('web','web_copyright',$web_copyright);
			
			$transaction->commit();//提交
			return true;
			
		} catch(Exception $e) {//如有一条执行错误
			$transaction->rollBack();//回滚
			return false;
		}
	}
	/****************************** 1 ******************************/
	
	
	/**							
	 * 2015-04-03 add by xiaozhu 1		
	 * 更新SEO设置						
	 * @param string $seo_title			网站标题
	 * @param string $seo_keywords		网站关键词
	 * @param string $seo_describe		网站描述
	 * @return boolean					1：执行成功，0：执行失败
	 */							
	/****************************** 1 ******************************/	
	// 
	public static function updateSeo($seo_title, $seo_keywords, $seo_describe)
	{
		$connection = Yii::$app->db;
		$transaction = $connection->beginTransaction();
		try {
			Setting::updateSetting('seo','seo_title',$seo_title);
			Setting::updateSetting('seo','seo_keywords',$seo_keywords);
			Setting::updateSetting('seo','seo_describe',$seo_describe);
			
			$transaction->commit();
			return true; // 执行成功
			
		} catch(Exception $e) {
			$transaction->rollBack();
			return false; // 执行失败
		}
	}
	/****************************** 1 ******************************/
	
	
	/**							
	 * 2015-04-03 add by xiaozhu 1		
	 * 更新邮箱设置						
	 * @param string $email_set			邮箱状态
	 * @param string $email_server		邮箱服务器
	 * @param string $email_port		邮箱端口号
	 * @param string $email_send_person	发件人姓名
	 * @param string $email_account		邮箱用户名
	 * @param string $email_password	邮箱密码
	 * @return boolean					1：执行成功，0：执行失败
	 */							
	/****************************** 1 ******************************/	
	// 
	public static function updateEmail($email_set, $email_server, $email_port, $email_send_person, $email_account, $email_password)
	{
		$connection = Yii::$app->db;
		$transaction = $connection->beginTransaction();
		try {
			Setting::updateSetting('email','email_set',$email_set);
			Setting::updateSetting('email','email_server',$email_server);
			Setting::updateSetting('email','email_port',$email_port);
			Setting::updateSetting('email','email_send_person',$email_send_person);
			Setting::updateSetting('email','email_account',$email_account);
			Setting::updateSetting('email','email_password',$email_password);
			
			$transaction->commit();
			return true; // 执行成功
			
		} catch(Exception $e) {
			$transaction->rollBack();
			return false; // 执行失败
		}
	}
	/****************************** 1 ******************************/
	
	
	/**							
	 * 2015-04-03 add by xiaozhu 1		
	 * 更新短信设置						
	 * @param string $sms_set			接口状态
	 * @param string $sms_account		接口账号
	 * @param string $sms_password		接口密码
	 * @return boolean					1：执行成功，0：执行失败
	 */							
	/****************************** 1 ******************************/	
	// 
	public static function updateMessage($sms_set, $sms_account, $sms_password)
	{
		$connection = Yii::$app->db;
		$transaction = $connection->beginTransaction();
		try {
			Setting::updateSetting('sms','sms_set',$sms_set);
			Setting::updateSetting('sms','sms_account',$sms_account);
			Setting::updateSetting('sms','sms_password',$sms_password);
			
			$transaction->commit();
			return true; // 执行成功
			
		} catch(Exception $e) {
			$transaction->rollBack();
			return false; // 执行失败
		}
	}
	/****************************** 1 ******************************/
	
	
	/**							
	 * 2015-04-03 add by xiaozhu 1		
	 * 更新邮箱设置						
	 * @param string $company_name		公司名称
	 * @param string $company_address	公司名称
	 * @param string $company_phone		公司手机
	 * @param string $company_tel		公司座机
	 * @param string $company_qq		公司qq
	 * @param string $company_em		公司Email
	 * @return boolean					1：执行成功，0：执行失败
	 */							
	/****************************** 1 ******************************/	
	// 
	public static function updateCompany($company_name, $company_address, $company_phone, $company_tel, $company_qq, $company_em, $company_time, $company_notice1, $company_notice2)
	{
		$connection = Yii::$app->db;
		$transaction = $connection->beginTransaction();
		try {
			Setting::updateSetting('company','company_name',$company_name);
			Setting::updateSetting('company','company_address',$company_address);
			Setting::updateSetting('company','company_phone',$company_phone);
			Setting::updateSetting('company','company_tel',$company_tel);
			Setting::updateSetting('company','company_qq',$company_qq);
			Setting::updateSetting('company','company_email',$company_em);
			Setting::updateSetting('company','company_time',$company_time);
			Setting::updateSetting('company','company_notice1',$company_notice1);
			Setting::updateSetting('company','company_notice2',$company_notice2);
			
			$transaction->commit();
			return true; // 执行成功
			
		} catch(Exception $e) {
			$transaction->rollBack();
			return false; // 执行失败
		}
	}
	/****************************** 1 ******************************/
	
	
}
