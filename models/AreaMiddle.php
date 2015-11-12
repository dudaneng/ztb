<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_area_middle".
 *
 * @property string $id
 * @property string $area_big
 * @property string $area_name
 * @property integer $status
 */
class AreaMiddle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_area_middle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_big', 'status'], 'integer'],
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
	public static function getAreaMiddle($start, $num){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'area_middle';
		
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
		$table = Yii::$app->db->tablePrefix.'area_middle';
		
		//获取数据
		$command = $connection->createCommand("SELECT * FROM $table WHERE status=1 and area_big=:a order by sort desc;");
		$command->bindValue(':a',$id);
		$list = $command->query();   
		
		return $list;
	}
	/******************** 1 ********************/
	
}
