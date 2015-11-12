<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%goods_type_small}}".
 *
 * @property string $id
 * @property string $type_small
 * @property string $type_name
 * @property string $sort
 * @property integer $status
 */
class GoodsTypeSmall extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_type_small}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_small'], 'required'],
            [['type_small', 'sort', 'status'], 'integer'],
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
            'type_small' => 'Type Small',
            'type_name' => 'Type Name',
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }
	
	
	/**
	 * 20150421 add by dudanfeng 1 获取数据
	 * @param string $id           返回ID
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getGoodsType($start, $num, $id){
		$connection = Yii::$app->db;
		
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM {{%goods_type_small}} WHERE status in (:a,:b) and type_small=:id order by sort desc limit $start,$num;");
		$command->bindValue(':id', $id);
		$command->bindValue(':a', 0);
		$command->bindValue(':b', 1);
		
		$list = $command->query();
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150417 add by dudanfeng 1 获取数据总量
	 * @param string $num          每页条数
	 * @param string $id           上级ID
	 * @return $pages  			   返回总的数量
	**/
	/******************** 1 ********************/
	public static function getPages($num, $id){
		$connection = Yii::$app->db;
		
		//获取总页面
		$command = $connection->createCommand("SELECT id FROM {{%goods_type_small}} WHERE status in (:a,:b) and type_small=:id");
		$command->bindValue(':id', $id);
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
				
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM {{%goods_type_small}} WHERE id=:id");
		$command->bindValue(':id', $id);
		$list = $command->query(); 
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150417 add by dudanfeng 1 获取商品的小类
	 * @param string $id           返回ID
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getGoodsSmall($id){
		$connection = Yii::$app->db;
				
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM {{%goods_type_small}} WHERE type_small=:id");
		$command->bindValue(':id', $id);
		$list = $command->query(); 
		
		return $list;
	}
	/******************** 1 ********************/
}
