<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_area_small".
 *
 * @property string $id
 * @property string $area_big
 * @property string $area_middle
 * @property string $area_name
 * @property integer $status
 */
class AreaSmall extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_area_small';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_big', 'area_middle', 'status'], 'integer'],
            [['area_name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area_big' => 'Area Big',
            'area_middle' => 'Area Middle',
            'area_name' => 'Area Name',
            'status' => 'Status',
        ];
    }
	
	/**
	 * 20150417 add by dudanfeng 1 获取多条数据
	 * @param string $start        初始数据
	 * @param string $num          每页条数
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getAreaSmall($start, $num){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'area_small';
		
		//获取数据
		$command = $connection->createCommand("SELECT * FROM $table WHERE status in (:a,:b) order by sort desc limit $start,$num;");
		$command->bindValue(':a', 0);
		$command->bindValue(':b', 1);
		$list = $command->query();   
		
		return $list;
	}
	/******************** 1 ********************/
	
	/**
	 * 20150612 add by dudanfeng 1 获取特定数据
	 * @param string $start        初始数据
	 * @param string $num          每页条数
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getAreaData($id){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'area_small';
		
		//获取数据
		$command = $connection->createCommand("SELECT * FROM $table WHERE status=1 and area_middle=:a order by sort desc;");
		$command->bindValue(':a',$id);
		$list = $command->query();   
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150623 add by dudanfeng 1 获取地区筛选数据
	 * @param string $start        初始数据
	 * @param string $num          每页条数
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getAreaDataSelect($id){
		$connection = Yii::$app->db;
		
		//获取表名
		$table1 = Yii::$app->db->tablePrefix.'area_small';
		$table2 = Yii::$app->db->tablePrefix.'restaurant';
		
		//获取数据
		$command = $connection->createCommand("select * from  $table1 as a where a.status =1 and a.area_middle=:a and (select count(1) as num from $table2 as b where b.area_small = a.id) = 0;");
		$command->bindValue(':a',$id);
		$list = $command->query(); 
		
		return $list;
	}
	/******************** 1 ********************/
}
