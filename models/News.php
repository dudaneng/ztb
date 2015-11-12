<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property string $id
 * @property string $news_title
 * @property integer $news_type_id
 * @property string $news_summary
 * @property string $news_author
 * @property string $news_content
 * @property integer $read_count
 * @property integer $is_top
 * @property string $sort
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_type_id', 'read_count', 'is_top', 'sort', 'status', 'create_time', 'update_time'], 'integer'],
            [['news_content'], 'required'],
            [['news_content'], 'string'],
            [['news_title'], 'string', 'max' => 30],
            [['news_summary'], 'string', 'max' => 500],
            [['news_author'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'news_title' => 'News Title',
            'news_type_id' => 'News Type ID',
            'news_summary' => 'News Summary',
            'news_author' => 'News Author',
            'news_content' => 'News Content',
            'read_count' => 'Read Count',
            'is_top' => 'Is Top',
            'sort' => 'Sort',
            'status' => 'Status',
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
	public static function getNews($start, $num, $keyword = '', $type = ''){
		$connection = Yii::$app->db;
		
		if(!empty($keyword)){
			$sql = "and a.news_title like '%$keyword%'";
		}else{
			$sql = '';
		}
		
		if(!empty($type)){
			$sql = $sql."and b.id=$type";
		}else{
			$sql = $sql.'';
		}
		
		//获取表名
		$table1 = Yii::$app->db->tablePrefix.'news';
		$table2 = Yii::$app->db->tablePrefix.'news_type';
		
		//抽取数据
		$command = $connection->createCommand("SELECT a.*,b.type_name FROM $table1 as a left join $table2 as b on b.id = a.news_type_id WHERE a.status in (:a,:b) $sql order by a.sort desc,a.update_time desc limit $start,$num;");
		$command->bindValue(':a', 0);
		$command->bindValue(':b', 1);
		$list = $command->query();  
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150417 add by dudanfeng 1 获取数据总量
	 * @param string $num          每页条数
	 * @return $pages  			   总的数量
	**/
	/******************** 1 ********************/
	public static function getPages($num,  $keyword = '', $type = ''){
		$connection = Yii::$app->db;
		
		if(!empty($keyword)){
			$sql = "and a.news_title like '%$keyword%'";
		}else{
			$sql = '';
		}
		
		if(!empty($type)){
			$sql = $sql."and b.id=$type";
		}else{
			$sql = $sql.'';
		}
		
		//获取表名
		//获取表名
		$table1 = Yii::$app->db->tablePrefix.'news';
		$table2 = Yii::$app->db->tablePrefix.'news_type';
		
		//抽取数据
		$command = $connection->createCommand("SELECT a.*,b.type_name FROM $table1 as a left join $table2 as b on b.id = a.news_type_id WHERE a.status in (:a,:b) $sql;");
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
	 * @param string $id           数据ID
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getNewsOne($id){
		$connection = Yii::$app->db;
		
		//获取表名
		$table1 = Yii::$app->db->tablePrefix.'news';
		$table2 = Yii::$app->db->tablePrefix.'news_type';
		
		//抽取数据
		$command = $connection->createCommand("SELECT a.*,b.type_name FROM $table1 as a ,$table2 as b WHERE a.id = :id and b.id = a.news_type_id");
		$command->bindValue(':id', $id);
		$list = $command->query();
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150421 add by dudanfeng 1 获取回收站数据
	 * @param string $start        初始数据
	 * @param string $num          每页条数
	 * @return $list			   返回数据
	**/
	/******************** 1 ********************/
	public static function getRecoveryNews($start, $num){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'news';
		
		//抽取数据
		$command = $connection->createCommand("SELECT a.*,b.type_name FROM tbl_news as a ,tbl_news_type as b WHERE a.status = :a and b.id = a.news_type_id order by a.sort desc limit $start,$num;");
		$command->bindValue(':a', -1);
		$list = $command->query(); 
		
		return $list;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150421 add by dudanfeng 1 获取回收站数据总量
	 * @param string $num          每页条数
	 * @return $pages  			   总的数量
	**/
	/******************** 1 ********************/
	public static function getRecoveryPages($num){
		$connection = Yii::$app->db;
		
		//获取表名
		$table = Yii::$app->db->tablePrefix.'news';
		
		//获取总页面
		$command = $connection->createCommand("SELECT id FROM $table WHERE status=:a");
		$command->bindValue(':a', -1);
		$list = $command->query();
		
		$counts = count($list);
		$pages = $counts / $num;
		$pages = ceil($pages);
		
		return $pages;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20151106 add by dudanfeng 1 文章的浏览次数
	 * @return $num  			   浏览次数
	**/
	/******************** 1 ********************/
	public static function execGetNum($id = ''){
		$connection = Yii::$app->db;
		
		$command = $connection->createCommand("update {{%news}} set `read_count`=`read_count`+1 WHERE id=:a;");
		$command->bindValue(':a', $id);
		$list = $command->execute();//改变数量
		
		$num = News::find()->where(['id'=>$id])->one();
		
		return $num['read_count'];
	}
	/******************** 1 ********************/
}
