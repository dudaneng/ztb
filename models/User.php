<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_user".
 *
 * @property string $id
 * @property string $user_account
 * @property string $user_password
 * @property integer $group_id
 * @property string $user_nickname
 * @property string $user_phone
 * @property integer $check_phone
 * @property string $user_email
 * @property integer $check_email
 * @property string $user_name
 * @property integer $user_sex
 * @property integer $user_birthday
 * @property string $user_qq
 * @property integer $status
 * @property string $user_country
 * @property string $user_province
 * @property string $user_city
 * @property string $user_address
 * @property double $money
 * @property integer $points
 * @property string $user_logo
 * @property integer $create_time
 * @property string $create_ip
 * @property integer $last_time
 * @property string $last_ip
 * @property integer $login_num
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'check_phone', 'check_email', 'user_sex', 'user_birthday', 'status', 'points', 'create_time', 'last_time', 'login_num'], 'integer'],
            [['money'], 'number'],
            [['user_account'], 'string', 'max' => 30],
            [['user_password'], 'string', 'max' => 64],
            [['user_nickname', 'user_country', 'user_province', 'user_city', 'create_ip', 'last_ip'], 'string', 'max' => 20],
            [['user_phone'], 'string', 'max' => 12],
            [['user_email'], 'string', 'max' => 60],
            [['user_name'], 'string', 'max' => 10],
            [['user_qq'], 'string', 'max' => 15],
            [['user_address'], 'string', 'max' => 80],
            [['user_logo'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_account' => 'User Account',
            'user_password' => 'User Password',
            'group_id' => 'Group ID',
            'user_nickname' => 'User Nickname',
            'user_phone' => 'User Phone',
            'check_phone' => 'Check Phone',
            'user_email' => 'User Email',
            'check_email' => 'Check Email',
            'user_name' => 'User Name',
            'user_sex' => 'User Sex',
            'user_birthday' => 'User Birthday',
            'user_qq' => 'User Qq',
            'status' => 'Status',
            'user_country' => 'User Country',
            'user_province' => 'User Province',
            'user_city' => 'User City',
            'user_address' => 'User Address',
            'money' => 'Money',
            'points' => 'Points',
            'user_logo' => 'User Logo',
            'create_time' => 'Create Time',
            'create_ip' => 'Create Ip',
            'last_time' => 'Last Time',
            'last_ip' => 'Last Ip',
            'login_num' => 'Login Num',
        ];
    }
	
	/**
	 * 20150422 add by xiaozhu 1 获取多条数据
	 * @param string $start        初始数据
	 * @param string $num          每页条数
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getAll($start, $num, $keywords = '', $type = ''){
		$connection = Yii::$app->db;
		
		if($type == ''){
			$sql = '';
		}else{
			$sql = "and group_id=$type";
		}
		
		if($keywords == ''){
			$sql = $sql."";
		}else{
			$sql = $sql."and user_name like '%$keywords%' or user_phone like '%$keywords%'";
		}
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'user';
		
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM $table WHERE status in (:a,:b) $sql order by create_time desc limit $start,$num;");
		$command->bindValue(':a', 0);
		$command->bindValue(':b', 1);
		$list = $command->query();  
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150422 add by xiaozhu 1 获取数据总量
	 * @param string $num          每页条数
	 * @return $pages  			   总的数量
	**/
	/******************** 1 ********************/
	public static function getPages($num, $keywords = '', $type = ''){
		
		$connection = Yii::$app->db;
		
		if($type == ''){
			$sql = '';
		}else{
			$sql = "and group_id=$type";
		}
		
		if($keywords == ''){
			$sql = $sql."";
		}else{
			$sql = $sql."and user_name like '%$keywords%' or user_phone like '%$keywords%'";
		}
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'user';
		
		//获取总页面
		$command = $connection->createCommand("SELECT id FROM $table WHERE status in (:a,:b) $sql");
		$command->bindValue(':a', 0);
		$command->bindValue(':b', 1);
		$list = $command->query();
		
		$counts = count($list);
		$pages = $counts / $num;
		$pages = ceil($pages);
		
		return $pages;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150422 add by xiaozhu 1 获取一条数据
	 * @param string $id           数据ID
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getOne($id){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'user';
		
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM $table WHERE id = :id");
		$command->bindValue(':id', $id);
		$list = $command->query();
		
		return $list;
	}
	/******************** 1 ********************/
}
