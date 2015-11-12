<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%ad}}".
 *
 * @property string $id
 * @property string $position_id
 * @property string $ad_name
 * @property string $ad_describe
 * @property string $ad_url
 * @property string $ad_image
 * @property integer $click_count
 * @property integer $status
 * @property string $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Ad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_id', 'click_count', 'status', 'sort', 'create_time', 'update_time'], 'integer'],
            [['ad_name'], 'string', 'max' => 30],
            [['ad_describe'], 'string', 'max' => 100],
            [['ad_url'], 'string', 'max' => 300],
            [['ad_image'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position_id' => 'Position ID',
            'ad_name' => 'Ad Name',
            'ad_describe' => 'Ad Describe',
            'ad_url' => 'Ad Url',
            'ad_image' => 'Ad Image',
            'click_count' => 'Click Count',
            'status' => 'Status',
            'sort' => 'Sort',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
	
	
	/**
	 * 20150417 add by dudanfeng 1 获取多条数据
	 * @param string $start        初始数据
	 * @param string $num          每页条数
	 * @return $list			   广告数据
	**/
	/******************** 1 ********************/
	public static function getAd($start, $num){
		$connection = Yii::$app->db;
		
		//抽取数据
		$command = $connection->createCommand("SELECT a.*,b.position_name FROM {{%ad}} as a ,{{%ad_position}} as b WHERE a.status in (:a,:b) and b.id = a.position_id order by a.sort desc limit $start,$num;");
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
		$command = $connection->createCommand("SELECT id FROM {{%ad}} WHERE status in (:a,:b)");
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
	public static function getAdOne($id){
		$connection = Yii::$app->db;
		
		//抽取数据
		$command = $connection->createCommand("SELECT a.*,b.position_name FROM {{%ad}} as a ,{{%ad_position}} as b WHERE a.id = :id and b.id = a.position_id");
		$command->bindValue(':id', $id);
		$list = $command->query();
		
		return $list;
	}
	/******************** 1 ********************/
}
