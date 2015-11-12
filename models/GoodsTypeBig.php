<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%goods_type_big}}".
 *
 * @property string $id
 * @property string $type_name
 * @property string $sort
 * @property integer $status
 */
class GoodsTypeBig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_type_big}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort', 'status'], 'integer'],
            [['type_name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_name' => 'Type Name',
            'sort' => 'Sort',
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
	public static function getGoodsType($start, $num){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'goods_type_big';
		
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM $table WHERE status in (:a,:b) order by sort desc limit $start,$num;");
		
		$command->bindValue(':a', 0);
		$command->bindValue(':b', 1);
		$list = $command->query();  
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150417 add by dudanfeng 1 获取数据总量
	 * @param string $num          每页条数
	 * @return $pages  			   返回总的数量
	**/
	/******************** 1 ********************/
	public static function getPages($num){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'goods_type_big';
		
		//获取总页面
		$command = $connection->createCommand("SELECT id FROM $table WHERE status in (:a,:b)");
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
	public static function getGoodsTypeOne($id){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'goods_type_big';
		
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM $table WHERE id=:id");
		$command->bindValue(':id', $id);
		$list = $command->query(); 
		
		return $list;
	}
	/******************** 1 ********************/
}
