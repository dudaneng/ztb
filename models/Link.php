<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_link".
 *
 * @property string $id
 * @property string $link_name
 * @property string $link_url
 * @property string $link_logo
 * @property integer $status
 * @property string $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Link extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link_name', 'status', 'sort', 'create_time', 'update_time'], 'integer'],
            [['link_url'], 'string', 'max' => 300],
            [['link_logo'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_name' => 'Link Name',
            'link_url' => 'Link Url',
            'link_logo' => 'Link Logo',
            'status' => 'Status',
            'sort' => 'Sort',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
	
	/**
	 * 20150422 add by xiaozhu 1 获取多条数据
	 * @param string $start        初始数据
	 * @param string $num          每页条数
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getAll($start, $num){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'link';
		
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM $table WHERE status in (:a,:b) order by sort asc limit $start,$num;");
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
	public static function getPages($num){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'link';
		
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
	 * 20150422 add by xiaozhu 1 获取一条数据
	 * @param string $id           数据ID
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getOne($id){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'link';
		
		//抽取数据
		$command = $connection->createCommand("SELECT * FROM $table WHERE id = :id");
		$command->bindValue(':id', $id);
		$list = $command->query();
		
		return $list;
	}
	/******************** 1 ********************/
}
