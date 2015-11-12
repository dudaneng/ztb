<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%ad_position}}".
 *
 * @property string $id
 * @property string $position_name
 * @property string $sort
 * @property integer $status
 */
class AdPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad_position}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort', 'status'], 'integer'],
            [['position_name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position_name' => 'Position Name',
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }
	
	
	/**
	 * 20150417 add by dudanfeng 1 获取多条数据
	 * @param string $start        初始数据
	 * @param string $num          每页条数
	 * @return $list			   广告数据
	**/
	/******************** 1 ********************/
	public static function getAdType($start, $num){
		$connection = Yii::$app->db;
		
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM {{%ad_position}} WHERE status in (:a,:b) order by sort desc limit $start,$num;");
		$command->bindValue(':a', 0);
		$command->bindValue(':b', 1);
		$list = $command->query(); 
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150417 add by dudanfeng 1 获取数据总量
	 * @param string $num          每页条数
	 * @return $pages  			   广告总的数量
	**/
	/******************** 1 ********************/
	public static function getPages($num){
		$connection = Yii::$app->db;
		
		//获取总页面
		$command = $connection->createCommand("SELECT id FROM {{%ad_position}} WHERE status in (:a,:b)");
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
	 * @param string $id           广告ID
	 * @return $list			   广告数据
	**/
	/******************** 1 ********************/
	public static function getAdTypeOne($id){
		$connection = Yii::$app->db;
		
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM {{%ad_position}} WHERE id=:id");
		$command->bindValue(':id', $id);
		$list = $command->query();
		
		return $list;
	}
	/******************** 1 ********************/
}
