<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_restaurant".
 *
 * @property integer $id
 * @property integer $area_small
 * @property string $address
 * @property string $shop_time
 * @property string $contact
 * @property integer $sort
 * @property integer $status
 * @property integer $update_time
 */
class Restaurant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_restaurant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_small', 'address', 'shop_time', 'contact', 'sort', 'update_time'], 'required'],
            [['area_small', 'sort', 'status', 'update_time'], 'integer'],
            [['address', 'shop_time', 'contact'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area_small' => 'Area Small',
            'address' => 'Address',
            'shop_time' => 'Shop Time',
            'contact' => 'Contact',
            'sort' => 'Sort',
            'status' => 'Status',
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
	public static function getDate($start, $num, $keyword = '', $type = ''){
		$connection = Yii::$app->db;
		
		if($keyword == ''){
			$sql = '';
		}else{
			$sql = "and b.area_name like '%$keyword%'";
		}
		
		if($type == ''){
			$sql .= '';
		}else{
			$sql .= "and a.small = $type";
		}
		
		//获取表名
		$table1 = Yii::$app->db->tablePrefix.'restaurant';
		$table2 = Yii::$app->db->tablePrefix.'area_small';
		
		//抽取数据
		$command = $connection->createCommand("
		SELECT a.*,b.area_name FROM
		$table1 as a left join $table2 as b on b.id = a.area_small WHERE
		a.status in (:a,:b) $sql order by a.sort desc limit $start,$num;");
		
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
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'restaurant';
		
		//获取总页面
		$command = $connection->createCommand("SELECT id FROM $table WHERE status in (:a,:b)");
		$command->bindValue(':a', 0);
		$command->bindValue(':b', 1);
		$list = $command->query();
		
		$counts = count($list);
		$pages = $counts / $num;
		$pages = ceil($pages);
		if($keyword == ''){
			return $pages;
		}else{
			return 1;
		}
		
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150417 add by dudanfeng 1 获取一条数据
	 * @param string $id           返回ID
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getRestOne($id){
		$connection = Yii::$app->db;
		
		//获取表名
		$table1 = Yii::$app->db->tablePrefix.'restaurant';
		$table2 = Yii::$app->db->tablePrefix.'area_small';
		
		//抽取数据
		$command = $connection->createCommand("SELECT a.*,b.area_name FROM $table1 as a left join $table2 as b on b.id = a.area_small WHERE a.id=:a");
		
		$command->bindValue(':a', $id);
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
}
