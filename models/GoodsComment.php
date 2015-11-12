<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_goods_comment".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $goods_id
 * @property string $content
 * @property integer $update_time
 * @property integer $sort
 * @property integer $status
 */
class GoodsComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_goods_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'goods_id', 'content', 'sort'], 'required'],
            [['user_id', 'goods_id', 'update_time', 'sort', 'status'], 'integer'],
            [['content'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'goods_id' => 'Goods ID',
            'content' => 'Content',
            'update_time' => 'Update Time',
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
	public static function getOrder($start, $num, $keywords = '', $type = ''){
		$connection = Yii::$app->db;
		
		if($keywords == ''){
			$sql = "";
		}else{
			$sql = "and a.order_sn = $keywords";
		}
		
		if($type == '' || $type == 1){
			$sql .= "and a.bill_flag=0";
		}else if($type == 2){
			$sql .= "and a.bill_flag=1";
		}else if($type == 3){
			$sql .= "and a.status=9";
		}else if($type == 4){
			$sql .= "and a.status=4";
		}
		
		
		//获取表名
		$table1 = Yii::$app->db->tablePrefix.'order';
		$table2 = Yii::$app->db->tablePrefix.'goods';
		$table3 = Yii::$app->db->tablePrefix.'shop';
		
		//抽取数据
		$command = $connection->createCommand("
		SELECT a.*,b.goods_name,c.shop_name FROM
		$table1 as a left join $table2 as b on b.id = a.goods_id left join $table3 as c on c.id = a.shop_id WHERE
		a.status > :a $sql order by a.create_time desc limit $start,$num;");
		
		$command->bindValue(':a', 0);
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
	public static function getPages($num , $keywords = '', $type = ''){
		$connection = Yii::$app->db;
		
		if($keywords == ''){
			$sql = "";
		}else{
			$sql = "and order_sn = $keywords";
		}
		
		if($type == '' || $type == 1){
			$sql .= "and bill_flag=0";
		}else if($type == 2){
			$sql .= "and bill_flag=1";
		}else if($type == 3){
			$sql .= "and status=9";
		}else if($type == 4){
			$sql .= "and status=4";
		}
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'order';
		
		//获取总页面
		$command = $connection->createCommand("SELECT id FROM $table WHERE status > :a $sql");
		$command->bindValue(':a', 0);
		$list = $command->query();
		
		$counts = count($list);
		$pages = $counts / $num;
		$pages = ceil($pages);
		
		return $pages;
	}
	/******************** 1 ********************/
	
}
