<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_cart".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $goods_id
 * @property integer $goods_number
 * @property integer $create_time
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'goods_id', 'goods_number', 'create_time'], 'required'],
            [['user_id', 'goods_id', 'goods_number', 'create_time'], 'integer']
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
            'goods_number' => 'Goods Number',
            'create_time' => 'Create Time',
        ];
    }
	
	
	/**
	  * 20150812 add by dudanfeng 1 改变购物车商品数量
	  * @param string $id           购物车id
	  * @param string $type         1-减法 2-加法 3-数量改变
	  * @return $list			    返回数据
	 **/
	/******************** 1 ********************/
	public static function execUpCartNum($id, $type, $numbers = ''){
		$connection = Yii::$app->db;
		
		$table = Yii::$app->db->tablePrefix.'cart';//获取表名
		
		if ($type == 1){
			$command = $connection->createCommand("update $table set goods_number=goods_number-1 where id=:a;");
			$command->bindValue(':a', $id);
			$list = $command->query();
		}else if ($type == 2){
			$command = $connection->createCommand("update $table set goods_number=goods_number+1 where id=:a;");
			$command->bindValue(':a', $id);
			$list = $command->query();
		}else if ($type == 3){
			$command = $connection->createCommand("update $table set goods_number=$numbers where id=:a;");
			$command->bindValue(':a', $id);
			$list = $command->query();
		}
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	  * 20150812 add by dudanfeng 1 计算购物车某商品总价格
	  * @param string $id           购物车id
	  * @return $list			    返回数据
	 **/
	/******************** 1 ********************/
	public static function getCartPrice($id){
		$connection = Yii::$app->db;
		
		$list = Cart::find()->where(['id' => $id])->one();
		$goods_list = Goods::find()->where(['id' => $list['goods_id']])->one();
		$price = $list['goods_number'] * $goods_list['price_vip']; //该商品当前价格
		
		$aa = array(
			'price' => $price,
			'goods_number' => $list['goods_number'],
		);
		
		return $aa;
	}
	/******************** 1 ********************/
	
	
	/**
	  * 20150812 add by dudanfeng 1 读取购物陈商品详情
	  * @param string $id           购物车id
	  * @param string $type         1-减法 2-加法 3-数量改变
	  * @return $list			    返回数据
	 **/
	/******************** 1 ********************/
	public static function getCart($user_id){
		$connection = Yii::$app->db;
		
		$table1 = Yii::$app->db->tablePrefix.'cart';//获取表名
		$table2 = Yii::$app->db->tablePrefix.'goods';//获取表名
		
		$command = $connection->createCommand("SELECT a.*,b.hs_code,b.goods_show,b.price_vip,b.goods_name,b.goods_num FROM $table1 as a left join $table2 as b on b.id=a.goods_id WHERE a.user_id=:a");
		$command->bindValue(':a', $user_id);
		$list = $command->query();//购物车商品
		
		$price = '';
		$data = array();
		foreach($list as $k => $v){
			$price += $v['goods_number'] * $v['price_vip']; //商品总价
			$data[$k] = $v;
		}
		
		$row = array(
			'list' => $data,
			'price' => $price,
		);
		
		return $row;
	}
	/******************** 1 ********************/
	
	
	/**
	  * 20150812 add by dudanfeng 1 购物车商品添加
	  * @param string $id           购物车id
	  * @param string $number       商品数量
	  * @return $list			    返回数据
	 **/
	/******************** 1 ********************/
	public static function execAddCart($user_id, $id = '', $number = ''){
		$connection = Yii::$app->db;
		
		$table = Yii::$app->db->tablePrefix.'cart';//获取表名
		
		$row = Cart::find()->where(['user_id'=>$user_id, 'goods_id' => $id])->one();
		$time = time();
		
		if(!$row){
			if($number){
				$num = $number;
			}else{
				$num = 1;
			}	
			
			$sql = "insert into $table (`user_id`,`goods_id`,`create_time`,`update_time`,`goods_number`) values ($user_id, $id, $time, $time, $num)";
			$command = $connection->createCommand($sql);
			$rst = $command->execute();
			
		}else{
			if($number){
				$num = $number;
			}else{
				$num = $row['goods_number'] + 1;
			}	
				
			$sql = "update $table set `goods_number`=$num where id = :id";
			$command = $connection->createCommand($sql);
			$command->bindValue(':id', $row['id']);
			$rst = $command->execute();
		}
		
		return $rst;
	}
	/******************** 1 ********************/
}
