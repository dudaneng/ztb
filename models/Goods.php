<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property string $id
 * @property string $shop_id
 * @property string $goods_name
 * @property string $type_big
 * @property string $type_small
 * @property string $goods_show
 * @property string $goods_content
 * @property integer $goods_num
 * @property double $price_market
 * @property double $price_vip
 * @property integer $sort
 * @property integer $status
 * @property integer $is_hot
 * @property integer $is_recommend
 * @property integer $sold
 * @property integer $create_time
 * @property integer $update_time
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'type_big', 'type_small', 'goods_num', 'sort', 'status', 'is_hot', 'is_recommend', 'sold', 'create_time', 'update_time'], 'integer'],
            [['goods_content'], 'required'],
            [['goods_content'], 'string'],
            [['price_market', 'price_vip'], 'number'],
            [['goods_name'], 'string', 'max' => 300],
            [['goods_show'], 'string', 'max' => 2000]
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
            'goods_name' => 'Goods Name',
            'type_big' => 'Type Big',
            'type_small' => 'Type Small',
            'goods_show' => 'Goods Show',
            'goods_content' => 'Goods Content',
            'goods_num' => 'Goods Num',
            'price_market' => 'Price Market',
            'price_vip' => 'Price Vip',
            'sort' => 'Sort',
            'status' => 'Status',
            'is_hot' => 'Is Hot',
            'is_recommend' => 'Is Recommend',
            'sold' => 'Sold',
            'create_time' => 'Create Time',
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
	public static function getGoods($start, $num, $keyword = '', $type = ''){
		$connection = Yii::$app->db;
		
		if($keyword == ''){
			$sql = '';
		}else{
			$sql = "and a.goods_name like '%$keyword%' or a.hs_code like '%$keyword%'";
		}
		
		if($type == ''){
			$sql .= '';
		}else{
			$sql .= "and a.type_big = $type";
		}
		
		//获取表名
		$table1 = Yii::$app->db->tablePrefix.'goods';
		$table2 = Yii::$app->db->tablePrefix.'goods_type_big';
		$table3 = Yii::$app->db->tablePrefix.'shop';
		
		//抽取数据
		$command = $connection->createCommand("
		SELECT a.*,b.type_name as type_big_name,c.shop_name FROM
		{{%goods}} as a left join {{%goods_type_big}} as b on b.id = a.type_big left join {{%shop}} as c on c.id = a.shop_id WHERE
		a.status in (:a,:b) $sql order by a.sort desc,a.update_time desc limit $start,$num;");
		
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
	public static function getPages($num , $keyword = '', $type = ''){
		$connection = Yii::$app->db;
		
		if($keyword == ''){
			$sql = '';
		}else{
			$sql = "and goods_name like '%$keyword%' or hs_code like '%$keyword%'";
		}
		
		if($type == ''){
			$sql .= '';
		}else{
			$sql .= "and type_big = $type";
		}
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'goods';
		
		//获取总页面
		$command = $connection->createCommand("SELECT id FROM $table WHERE status in (:a,:b) $sql");
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
	public static function getGoodsOne($id){
		$connection = Yii::$app->db;
		
		//获取表名
		$table1 = Yii::$app->db->tablePrefix.'goods';
		$table2 = Yii::$app->db->tablePrefix.'goods_type_big';
		$table3 = Yii::$app->db->tablePrefix.'goods_type_small';
		$table4 = Yii::$app->db->tablePrefix.'shop';
		$table5 = Yii::$app->db->tablePrefix.'goods_color';
		
		//抽取数据
		$command = $connection->createCommand("
		SELECT a.*,b.type_name as type_big_name,c.type_name,d.shop_name,e.name as color_name FROM
		$table1 as a left join $table2 as b on b.id = a.type_big left join $table3 as c on c.id = a.type_small left join $table4 as d on d.id = a.shop_id left join $table5 as e on e.id = a.color WHERE
		a.status in (0,1) and a.id=$id");
		
		$command->bindValue(':a', 0);
		$command->bindValue(':b', 1);
		$list = $command->query(); 
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150519 add by dudanfeng 1 获取筛选数据
	 * @param string $start        初始数据
	 * @param string $num          每页条数
	 * @param string $color        商品颜色 
	 * @param string $goods_name   商品名 
	 * @param string $type_small   商品类型
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getGoodsSelect($start, $num, $goods_name, $color, $type_small){
		$connection = Yii::$app->db;
		
		if($goods_name == ''){
			$sql1 = "";
		}else if( is_numeric($goods_name)){
			$sql1 = "and a.hs_code = $goods_name";
		}else{
			$sql1 = "and a.goods_name like '%$goods_name%'";
		}
		
		if($color == '-1' || $color == ''){
			$sql2 = "";
		}else{
			$sql2 = "and a.color=$color";
		}
		
		if($type_small == '-1' || $type_small == ''){
			$sql3 = "";
		}else{
			$sql3 = "and a.type_small=$type_small";
		}
		
		//获取表名
		$table1 = Yii::$app->db->tablePrefix.'goods';
		$table2 = Yii::$app->db->tablePrefix.'goods_type_big';
		$table3 = Yii::$app->db->tablePrefix.'goods_type_small';
		$table4 = Yii::$app->db->tablePrefix.'shop';
		$table5 = Yii::$app->db->tablePrefix.'goods_color';
		
		//抽取数据
		$command = $connection->createCommand("
		SELECT a.*,b.type_name as type_big_name,c.type_name,d.shop_name,e.name as color_name FROM
		$table1 as a left join $table2 as b on b.id = a.type_big left join $table3 as c on c.id = a.type_small left join $table4 as d on d.id = a.shop_id left join $table5 as e on e.id = a.color WHERE
		a.status in (:a,:b) $sql1 $sql2 $sql3 order by a.sort desc limit $start,$num;");
		
		$command->bindValue(':a', 0);
		$command->bindValue(':b', 1);
		$list = $command->query();
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20151109 add by dudanfeng 1 获取筛选数据
	 * @param string $where        筛选条件
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getGoodsSelectZbt($start, $num, $order, $send_id, $goods_type){
		$connection = Yii::$app->db;
		
		//排序 : 1最新 2红包  3下单价 4数量
		if($order == 1){
			$order = 'a.create_time';
		}else if($order == 2){
			$order = 'a.red_packet';
		}else if($order == 3){
			$order = 'a.price_market';
		}else if($order == 4){
			$order = 'a.goods_num';
		}else{
			$order = 'a.id';
		}
		
		$sql = '';
		if($goods_type){
			$sql .= " and a.type_big=$goods_type";
		}
		
		if($send_id){
			$sql .= " and a.color=$send_id";
		}
		
		//抽取数据
		$command = $connection->createCommand("
		SELECT a.*,b.type_name as type_big_name,c.type_name,d.shop_name,e.name as color_name FROM
		{{%goods}} as a left join {{%goods_type_big}} as b on b.id = a.type_big left join {{%goods_type_small}} as c on c.id = a.type_small left join {{%shop}} as d on d.id = a.shop_id left join {{%goods_color}} as e on e.id = a.color WHERE
		a.status=1 $sql order by $order desc limit :a,:b;");
		
		$command->bindValue(':a', $start);
		$command->bindValue(':b', $num);
		$list = $command->query();
		
		return $list;
	}
	/******************** 1 ********************/
	
	
}
