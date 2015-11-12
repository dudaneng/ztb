<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_activity".
 *
 * @property integer $id
 * @property string $ac_name
 * @property integer $type
 * @property integer $value1
 * @property integer $value2
 * @property string $ac_content
 * @property integer $status
 * @property string $ac_time
 * @property integer $update_time
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ac_name', 'type', 'ac_content', 'status', 'ac_time', 'update_time'], 'required'],
            [['type', 'value1', 'value2', 'status', 'update_time'], 'integer'],
            [['ac_content'], 'string'],
            [['ac_name'], 'string', 'max' => 255],
            [['ac_time'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ac_name' => 'Ac Name',
            'type' => 'Type',
            'value1' => 'Value1',
            'value2' => 'Value2',
            'ac_content' => 'Ac Content',
            'status' => 'Status',
            'ac_time' => 'Ac Time',
            'update_time' => 'Update Time',
        ];
    }
	
	
	/**
	 * 20150612 add by dudanfeng 1 获取多条数据
	 * @param string $start        初始数据
	 * @param string $num          每页条数
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getData($start, $num, $keyword = '', $type = ''){
		$connection = Yii::$app->db;
		
		if($keyword == ''){
			$sql = '';
		}else{
			$sql = "and ac_name like '%$keyword'";
		}
		
		if($type == ''){
			$sql .= '';
		}else{
			$sql .= "and type=$type";
		}
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'activity';
		
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM $table WHERE status in (:a,:b) $sql order by update_time desc limit $start,$num;");
		
		$command->bindValue(':a', 0);
		$command->bindValue(':b', 1);
		$list = $command->query();
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150612 add by dudanfeng 1 获取数据总量
	 * @param string $num          每页条数
	 * @return $pages  			   返回总的数量
	**/
	/******************** 1 ********************/
	public static function getPages($num , $keyword = '', $type = ''){
		$connection = Yii::$app->db;
		
		if($keyword == ''){
			$sql = '';
		}else{
			$sql = "and ac_name like '%$keyword'";
		}
		
		if($type == ''){
			$sql .= '';
		}else{
			$sql .= "and type=$type";
		}
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'activity';
		
		//获取总页面
		$command = $connection->createCommand("SELECT id FROM $table WHERE status in (:a,:b) $sql order by update_time desc ");
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
	 * 20150417 add by dudanfeng 1 获取一条数据
	 * @param string $id           返回ID
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getDataOne($id){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'activity';
		
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM $table WHERE id=:a");
		
		$command->bindValue(':a', $id);
		$list = $command->query(); 
		
		return $list;
	}
	/******************** 1 ********************/
	
}
