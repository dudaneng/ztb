<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_order".
 *
 * @property string $id
 * @property string $shop_id
 * @property string $user_id
 * @property string $order_sn
 * @property string $express_sn
 * @property string $goods_id
 * @property integer $goods_num
 * @property double $price_vip
 * @property double $price_all
 * @property double $price_discount
 * @property integer $points
 * @property string $remark
 * @property integer $status
 * @property integer $pay_type
 * @property string $trade_no
 * @property integer $bill_flag
 * @property string $bill_order
 * @property integer $delivery
 * @property integer $create_time
 * @property string $create_ip
 * @property integer $update_time
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'user_id', 'goods_id', 'goods_num', 'points', 'status', 'pay_type', 'bill_flag', 'bill_order', 'delivery', 'create_time', 'update_time'], 'integer'],
            [['price_vip', 'price_all', 'price_discount'], 'number'],
            [['order_sn'], 'string', 'max' => 15],
            [['express_sn'], 'string', 'max' => 30],
            [['remark'], 'string', 'max' => 10],
            [['trade_no'], 'string', 'max' => 50],
            [['create_ip'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_id' => 'Shop ID',
            'user_id' => 'User ID',
            'order_sn' => 'Order Sn',
            'express_sn' => 'Express Sn',
            'goods_id' => 'Goods ID',
            'goods_num' => 'Goods Num',
            'price_vip' => 'Price Vip',
            'price_all' => 'Price All',
            'price_discount' => 'Price Discount',
            'points' => 'Points',
            'remark' => 'Remark',
            'status' => 'Status',
            'pay_type' => 'Pay Type',
            'trade_no' => 'Trade No',
            'bill_flag' => 'Bill Flag',
            'bill_order' => 'Bill Order',
            'delivery' => 'Delivery',
            'create_time' => 'Create Time',
            'create_ip' => 'Create Ip',
            'update_time' => 'Update Time',
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
			$sql = "and order_sn = '{$keywords}'";
		}
		
		if($type == '' || $type == 1){
			$sql .= " and status=1";
		}else if($type == 2){
			$sql .= " and status in (4,6)";
		}else if($type == 3){
			$sql .= " and status=9";
		}else if($type == 4){
			$sql .= " and status in (2,3)";
		}
		
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'order';
		
		//抽取数据
		$command = $connection->createCommand("
		SELECT * FROM
		$table WHERE
		status > :a $sql order by create_time desc limit $start,$num;");
		
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
			$sql = "and order_sn = '{$keywords}'";
		}
		
		if($type == '' || $type == 1){
			$sql .= " and status=1";
		}else if($type == 2){
			$sql .= " and status in (4,6)";
		}else if($type == 3){
			$sql .= " and status=9";
		}else if($type == 4){
			$sql .= " and status in (2,3)";
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
	
	
	/**
	 * 20150417 add by dudanfeng 1 获取多条数据
	 * @param string $start        初始数据
	 * @param string $num          每页条数
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getOrderHome($start, $num, $id, $type = ''){
		$connection = Yii::$app->db;
		
		$sql = "";
		
		if($type == '' || $type == 1){
			$sql .= " and status>=1";
		}else if($type == 2){
			$sql .= " and status=1";
		}else if($type == 3){
			$sql .= " and status<9 and status>=4";
		}else if($type == 4){
			$sql .= " and status=9";
		}
		
		//获取表名
		$table1 = Yii::$app->db->tablePrefix.'order';
		
		//抽取数据
		$command = $connection->createCommand("
		SELECT * FROM
		$table1 WHERE
		user_id = :a $sql order by create_time desc limit $start,$num;");
		
		$command->bindValue(':a', $id);
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
	public static function getPagesHome($num , $type = '', $id){
		$connection = Yii::$app->db;
		
		$sql = "";
		
		if($type == '' || $type == 1){
			$sql .= " and status>=1";
		}else if($type == 2){
			$sql .= " and status=1";
		}else if($type == 3){
			$sql .= " and status<9 and status>=4";
		}else if($type == 4){
			$sql .= " and status=9";
		}
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'order';
		
		//获取总页面
		$command = $connection->createCommand("SELECT id FROM $table WHERE user_id=:a $sql");
		$command->bindValue(':a', $id);
		$list = $command->query();
		
		$counts = count($list);
		$pages = $counts / $num;
		$pages = ceil($pages);
		
		return $pages;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150417 add by dudanfeng 1 获取数据总量
	 * @param string $num          每页条数
	 * @return $pages  			   返回总的数量
	**/
	/******************** 1 ********************/
	public static function getOrderAll(){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'order';
		
		//获取总页面
		$command = $connection->createCommand("SELECT id,goods_id FROM $table WHERE status in (4,6) and bill_flag=:b limit 1");
		$command->bindValue(':b', 0);
		$list = $command->query();
		
		$data = array();
		foreach($list as $k => $v){
			$data[$k]['goods_id'] = explode(',', $v['goods_id']);
			$data[$k]['order_id'] = $v['id'];
		}
		
		return $data;
	}
	/******************** 1 ********************/
}
