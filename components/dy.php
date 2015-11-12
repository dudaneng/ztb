<?php
/**							
 * 2015-04-17 add by dudanfeng 1 函数类库
 **/							
/****************************** 1 ******************************/
namespace components;

use yii\helpers\VarDumper;
use Yii;
use yii\helpers\Url;
use yii\data\Pagination;
use components\Smtp;
use components\wx;

header("content-Type: text/html; charset=Utf-8");

class dy
{		
	
	/**							
	 * 2015-04-17 add by xiaozhu 1 获取表的前缀		
	**/							
	/****************************** 1 ******************************/	
	public static function getTablePrefix(){
		return Yii::$app->db->tablePrefix;
	}
	/****************************** 1 ******************************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 数据添加
	 * @param string $table        表名
	 * @param string $data		   提交的数据:表单数据name值与数据库字段一致
	 * @return array()
	**/
	/******************** 1 ********************/
	public static function execAdd($table = '', $data = ''){
		$connection = Yii::$app->db;
		$key_str = "";
		$value_str = "";
		
		if($table == '' || $data == ''){
			echo "<script>alert('提交数据有误！');history.go(-1); </script>";
			exit;
		}
		
		foreach($data as $k => $v)
		{
			$key_str .= $k.',';
			$value_str .= "'".$v."',";
		}
		$key_str = substr($key_str,0,-1);
		$value_str = substr($value_str,0,-1);
		
		$sql = "insert into {{%$table}} ({$key_str}) values ({$value_str})";
		$command = $connection->createCommand($sql);
		$rst = $command->execute();
		
		return $rst;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 数据修改
	 * @param string $table        表名
	 * @param string $data		   提交的数据:表单数据name值与数据库字段一致
	 * @return array()
	**/
	/******************** 1 ********************/
	public static function execUpdate($table = '', $data = '', $id = '', $file = 'id'){
		$connection = Yii::$app->db;
		$key_value_str = "";
		
		if($table == '' || $data == ''){
			echo "<script>alert('提交数据有误！');history.go(-1); </script>";
			exit;
		}
		
		foreach($data as $k => $v)
		{
			$key_value_str .= $k.'='."'" .$v."',";
		}
		$key_value_str = substr($key_value_str,0,-1);
		
		if($id){
			$sql = "update {{%$table}} set {$key_value_str} where {$file} = :id";
			$command = $connection->createCommand($sql);
			$command->bindValue(':id', $id);
			$rst = $command->execute();
			
			return $rst;
		}else{
			return 0;
		}
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 状态改变
	 * @param string $table        表名
	 * @param string $value        改变的值
	 * @param string $value        状态字段
	 * @param string $field        字段名
	 * @return array()
	**/
	/******************** 1 ********************/
	public static function execStatusUp($table, $id, $value, $field = 'id', $status = 'status'){
		$connection = Yii::$app->db;
		
		if(is_array($id)){
			foreach($id as $v){
				$command = $connection->createCommand("update {{%$table}} set {$status}={$value} where {$field}=:id");
				$command->bindParam(':id', $v);
				$rst = $command->execute();
			}
		}else{
			$command = $connection->createCommand("update {{%$table}} set {$status}={$value} where {$field}=:id");
			$command->bindParam(':id', $id);
			$rst = $command->execute();
		}
		return $rst;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150409 add by dudanfeng 1 数据删除
	 * @param string $table        表名
	 * @param string $field        字段名
	 * @return array()
	**/
	/******************** 1 ********************/
	public static function execDelete($table, $id, $field = 'id'){
		$connection = Yii::$app->db;
		
		if(is_array($id)){
			foreach($id as $v){
				$command = $connection->createCommand("delete FROM {{%$table}}where $field=:id");
				$command->bindParam(':id', $v);
				$rst = $command->execute();
			}
		}else{
			$command = $connection->createCommand("delete FROM {{%$table}}where $field=:id");
			$command->bindParam(':id', $id);
			$rst = $command->execute();
		}
			
		return $rst;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150424 add by dudanfeng 1 获取一条数据
	 * @param string $table        操作数据的表
	 * @param string $id           数据ID
	 * @param string $field        数据字段
	 * @return $data			   数据数组
	**/
	/******************** 1 ********************/
	public static function execGetRow($table, $id, $field = '*'){
		$connection = Yii::$app->db;
		
		//抽取数据
		$command = $connection->createCommand("SELECT $field FROM {{%$table}} WHERE id=:id");
		$command->bindValue(':id', $id);
		$list = $command->query();
		
		foreach($list as $k =>$v){
			$data[$k] = $v;
		}
		
		return $data;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150424 add by dudanfeng 1 操作成功的提示
	 * @param string $action       跳转页面
	 * @param string $msg          跳转说明
	 * @return $arr			       数据数组
	**/
	/******************** 1 ********************/
	public static function execSuccess($action, $msg, $cue = '1', $type = ''){
		$arr = array(
			'action' => $action,
			'msg'    => $msg,
			'data'   => 1,
			'cue'    => $cue,
			'type' => $type,
		);
		
		echo json_encode($arr);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150424 add by dudanfeng 1 操作未成功的提示
	 * @param string $msg          跳转说明
	 * @return $arr			       数据数组
	**/
	/******************** 1 ********************/
	public static function execError($msg, $action = '', $cue = '0'){
		$arr = array(
			'action' => $action,
			'msg'    => $msg,
			'data'   => -1,
			'cue'    => $cue,
		);
		
		echo json_encode($arr);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150417 add by dudanfeng 1 获取当前点击页码
	 * @param string $num          每页条数
	 * @return $pages  			   数据总数量
	**/
	/******************** 1 ********************/
	public static function getPage($num){
		$page = Yii::$app->request->get('page');
		
		if($page){
			$page  = $page;
		}else{
			$page  = 1;
		}
		
		return $page;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150417 add by dudanfeng 1 获取每页的第一条数据
	 * @param string $num          每页条数
	 * @return $pages  			   数据总数量
	**/
	/******************** 1 ********************/
	public static function getStart($num){
		$page = Yii::$app->request->get('page');
		
		if($page){
			$start = ($page-1)*$num;
		}else{
			$start = 0;
		}
		
		return $start;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150421 add by dudanfeng 1 分页功能
	 * @param string $action       跳转的目标页面
	 * @param string $page         当前点击页数
	 * @return $pages  			   总页数
	**/
	/******************** 1 ********************/
	public static function getPageList($page, $pages, $action='index', $string = ''){
		$str = "";
		
		if(!empty($pages) ){
			$str="<ul class='pagination'>";
			$str.="<li><a href='$action?page=1&$string'>首页</a></li>";
			if($page-1 > 0){
				$pre = $page-1;
				$str.="<li><a href='$action?page=$pre&$string'>上一页</a></li>";
			}else{
				$str.="<li><a href='$action?page=1&$string'>上一页</a></li>";
			}
			
			for($i=0; $i<$pages; $i++){
				if(isset($page) && $page == $i+1 || !isset($page) && $i==0){
				$k = $i + 1;
				$str.="<li><a class='current' href='$action?page=$k&$string'>$k</a></li>";
				}else if($i >= $page-3 && $i <= $page+1){
				$p = $i + 1;
				$str.="<li><a href='$action?page=$p&$string'>$p</a></li>";
				 }
			}
			
			if($page+1 <= $pages){
				$next = $page + 1;
				$str.="<li><a href='$action?page=$next&$string'>下一页</a></li>";
			}else{
				$str.="<li><a href='$action?page=$page&$string'>下一页</a></li>";
			}
			$str.="<li><a href='$action?page=$i&$string'>尾页</a></li>";
			$str .="</ul>"	;
		}
		
		return $str;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150428 add by dudanfeng 1 将数组转化为字符串
	 * @param string $arr          数组
	 * @return $str  			   字符串
	**/
	/******************** 1 ********************/
	public static function arrayToStr($arr, $char){
		$str = '';
		foreach($arr as $v){
			$str .="$char".$v;
		}
		return $str;
	}
	/******************** 1 ********************/
	
	
	/**							
	 * 2015-04-21 add by xiaozhu 1 获得网站相对路径					
	 * @param string $url url路径 	 
	 * @return string 
	**/							
	/****************************** 1 ******************************/
	public static function getWebUrl($url = null)
	{
		$webUrl = \Yii::getAlias('@web');
		if($url !== null)
		{
			$webUrl .= $url;
		}
		return $webUrl;
	}
	/****************************** 1 ******************************/
	

	/**							
	 * 2015-04-21 add by xiaozhu 1 获得网站绝对路径					
	 * @param string $path url路径 	 
	 * @return string 
	**/							
	/****************************** 1 ******************************/
	public static function getWebPath($path = null)
	{
		$webPath = \Yii::getAlias('@webroot');
		if($path !== null)
		{
			$webPath .= $path;
		}
		return $webPath;
	}
	/****************************** 1 ******************************/
	
	
	/**							
	 * 2015-04-03 add by xiaozhu 1 更新系统设置（键值对更新）					
	 * @param string $scope 系统设置的范围 
	 * @param string $variable 系统设置的变量
	 * @param string $value 系统设置的值	 
	 * @return boolean 1：执行成功，0：执行失败
	**/							
	/****************************** 1 ******************************/	
	public static function updateSetting($scope, $variable, $value)
	{
		// 数据库
		$connection = Yii::$app->db;
			
		// 更新操作
		$command = $connection->createCommand("update {{tbl_setting}}  set value=:value WHERE scope='$scope' and variable='$variable'");
		$command->bindParam(':value', $value);
		$rst = $command->execute();
		
		// 返回值（1：执行成功，0：执行失败）
		return $rst;
	}
	/****************************** 1 ******************************/
	
	
	/**							
	 * 2015-04-08 add by xiaozhu 1 字符串截取，支持中文和其他编码				
	 * @param string $str 需要转换的字符串
	 * @param string $start 开始位置
	 * @param string $length 截取长度
	 * @param string $charset 编码格式
	 * @param string $suffix 截断显示字符
	 * @return string 返回截取后的字符串
	**/	
	/****************************** 1 ******************************/
	public static function msubstr($str, $start = 0, $length, $suffix = true, $charset = "utf-8") {
		if (function_exists ( "mb_substr" )) {
			if ($suffix && strlen ( $str ) > $length)
				return mb_substr ( $str, $start, $length, $charset ) . "...";
			else
				return mb_substr ( $str, $start, $length, $charset );
		} elseif (function_exists ( 'iconv_substr' )) {
			if ($suffix && strlen ( $str ) > $length)
				return iconv_substr ( $str, $start, $length, $charset ) . "...";
			else
				return iconv_substr ( $str, $start, $length, $charset );
		}
		$re ['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re ['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re ['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re ['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all ( $re [$charset], $str, $match );
		$slice = join ( "", array_slice ( $match [0], $start, $length ) );
		if ($suffix)
			return $slice . "…";
		return $slice;
	}
	/****************************** 1 ******************************/
	
	
	/**							
	 * 2015-04-08 add by xiaozhu 1 发送短信核心代码(互亿无线)			
	 * @param string $curlPost 短信内容 
	 * @param string $url 互亿无线短信接口 
	 * @return string 返回值结果字符串
	**/							
	/****************************** 1 ******************************/
	public static function postCode($curlPost, $url) {
		$curl = curl_init ();
		curl_setopt ( $curl, CURLOPT_URL, $url );
		curl_setopt ( $curl, CURLOPT_HEADER, false );
		curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $curl, CURLOPT_NOBODY, true );
		curl_setopt ( $curl, CURLOPT_POST, true );
		curl_setopt ( $curl, CURLOPT_POSTFIELDS, $curlPost );
		$return_str = curl_exec ( $curl );
		curl_close ( $curl );
		return $return_str;
	}
	/****************************** 1 ******************************/
	
	
	/**							
	 * 2015-04-08 add by xiaozhu 1 xml转化为数组		
	 * @param string $xml		   xml  
	 * @return array			   返回值数组
	**/							
	/****************************** 1 ******************************/
	public static function xmlToArray($xml) {
		$reg = '/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/';
		if (preg_match_all ( $reg, $xml, $matches )) {
			$count = count ( $matches [0] );
			for($i = 0; $i < $count; $i ++) {
				$subxml = $matches [2] [$i];
				$key = $matches [1] [$i];
				if (preg_match ( $reg, $subxml )) {
					$arr [$key] = dy::xmlToArray ( $subxml );
				} else {
					$arr [$key] = $subxml;
				}
			}
		}
		return $arr;
	}
	/****************************** 1 ******************************/
	
	
	/**							
	 * 2015-04-08 add by xiaozhu 1 发送短信（互亿无线）
	 * @param string $target 互亿无线短信接口 
	 * @param string $account 互亿无线账号
	 * @param string $password 互亿无线密码
	 * @param string $mobile 手机号码
	 * @param string $content 短信内容	 
	 * @return array 返回值数组（结果提示）
	**/							
	/****************************** 1 ******************************/
	public static function sendCode($target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit", $account, $password, $mobile, $content='手机验证吗') {
		
		$post_data = "account=" . $account . "&password=" . $password . "&mobile=" . $mobile . "&content=" . rawurlencode ( "您的验证码是：" . $content . "。请不要把验证码泄露给其他人。如非本人操作，可不用理会！");
						
		//$post_data = "account=" . $account . "&password=" . $password . "&mobile=" . $mobile . "&content=" . rawurlencode ( "您的验证码是：" . $content . "。请不要把验证码泄露给其他人。" );
		
		$gets = dy::xmlToArray(dy::postCode ( $post_data, $target ));
		return $gets;
	}
	/****************************** 1 ******************************/
	
	
	
	/**
	 * 20150417 add by xiaozhu 1 获取一张图片(ueditor)
	 * @param string $str ueditor保存的一张图片路径
	 * @return string 返回一张图片路径
	**/
	/******************** 1 ********************/
	public static function getImgOne($str)
	{
		$reg = '/(http|https).*?(\.jpg|\.png|\.gif|\.JPG|\.PNG|\.GIF)/';
		$reg1 = '/\/ueditor.*?(\.jpg|\.png|\.gif|\.JPG|\.PNG|\.GIF)/';
		$matches = array();
		$data='';
		preg_match_all($reg, $str, $matches);
		foreach ($matches[0] as $value) {
			$data =  $value;
			if(!empty($data)){break;}
		}
		if($data == ''){
			preg_match_all($reg1, $str, $matches);
			foreach ($matches[0] as $value) {
				$data =  $value;
				if(!empty($data)){break;}
			}
		}
		return $data;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150417 add by xiaozhu 1 获取多张图片(ueditor)
	 * @param string $str ueditor保存的多张图片路径
	 * @return string 返回多张图片路径
	**/
	/******************** 1 ********************/
	public static function getImgAll($str)
	{
		$reg = '/(http|https).*?(\.jpg|\.png|\.gif|\.JPG|\.PNG|\.GIF)/';
		$reg1 = '/\/ueditor.*?(\.jpg|\.png|\.gif|\.JPG|\.PNG|\.GIF)/';
		$matches = array();
		$data='';
		$i = 0;
		preg_match_all($reg, $str, $matches);
		foreach ($matches[0] as $value) {
			$data[$i] =  $value;
			$i++;
		}
		$i = 0;
		if($data == ''){
			preg_match_all($reg1, $str, $matches);
			foreach ($matches[0] as $value) {
				$data[$i] =  $value;
				$i++;
			}
		}
		return $data;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150520 add by dudanfeng 1 获取随机码
	 * @param string $len          长度
	 * @param string $format       类型
	 * @return string  $result     返回值
	**/
	/******************** 1 ********************/
	public static function getRandPW($len = '8', $format = 'ALL'){
		$is_abc = $is_numer = 0;
		$password = $tmp ='';  
		
		switch($format){
		case 'ALL':
			$chars='abcdefghijklmnpqrstuvwxyz123456789';
			break;
		case 'CHAR':
			$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			break;
		case 'NUMBER':
			$chars='0123456789';
			break;
		default :
			$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			break;
		} 
		
		mt_srand((double)microtime()*1000000*getmypid());
		while(strlen($password)<$len){
			$tmp =substr($chars,(mt_rand()%strlen($chars)),1);
			
			if(($is_numer <> 1 && is_numeric($tmp) && $tmp > 0 )|| $format == 'CHAR'){
				$is_numer = 1;
			}
			if(($is_abc <> 1 && preg_match('/[a-zA-Z]/',$tmp)) || $format == 'NUMBER'){
				$is_abc = 1;
			}
			$password.= $tmp;
		}
		return $password;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150603 add by dudanfeng 1 抽取地点 大区域数据
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function getAreaSelect(){
		$connection = Yii::$app->db;
		
		$command = $connection->createCommand("SELECT * FROM {{%area_big}} WHERE status=:a order by sort desc");
		$command->bindValue(':a', 1);
		$list = $command->query();//获取大区域数据
		
		foreach($list as $k => $v){
			$data[$k] = $v;
		}
		
		return $data;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150701 add by dudanfeng 1 抽取类型 商品类型
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function getGoodsTypeSelect(){
		$connection = Yii::$app->db;
		
		$command = $connection->createCommand("SELECT * FROM {{%goods_type_big}} WHERE status=:a order by sort desc");
		$command->bindValue(':a', 1);
		$list = $command->query();//获取商品类型数据
		
		foreach($list as $k => $v){
			$data[$k] = $v;
		}
		
		return $data;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150605 add by dudanfeng 1 获取Cookie值
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function getAreaCookie($str){
		$cookies = Yii::$app->request->cookies;

		$cookies->getValue($str, '');
		
		return $area;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150608 add by dudanfeng 1 登陆判断 读取session值 管理员
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function getLoginOn(){
		$session = Yii::$app->session;
		$user_id = $session->get('user_id');
		
		return $user_id;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150608 add by dudanfeng 1 登陆判断 读取session值
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function getLoginOne($file = 'user_id'){
		$session = Yii::$app->session;
		$user_id = $session->get("$file");
		
		return $user_id;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150608 add by dudanfeng 1 购物车商品数量
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function getCartNumbers(){
		$connection = Yii::$app->db;
		
		$session = Yii::$app->session;
		$user_id = $session->get('user_id');
		
		if($user_id){
			$command = $connection->createCommand("SELECT * FROM {{%cart}} WHERE user_id=:a");
			$command->bindValue(':a', $user_id);
			$list = $command->query();
			
			$numbers = '';
			foreach($list as $v){
				$numbers += $v['goods_number'];
			}
			//$numbers = count($list);
		}else{
			$numbers = 0;
		}
		
		return $numbers;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150723 add by dudanfeng 1 订单数量统计
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function getOrdersNumbers(){
		$user_id = dy::getLoginOn();
		
		$connection = Yii::$app->db;
		
		$command = $connection->createCommand("SELECT * FROM {{%order}} WHERE user_id=:a");
		$command->bindValue(':a', $user_id);
		$order_list = $command->query();
		
		$num1 = '';
		$num2 = '';
		$num3 = '';
		$num4 = '';
		foreach($order_list as $v){
			if($v['status'] == 1){//未付款订单
				$num1++;
			}else if($v['status'] >=4 && $v['status'] <9){//进行中订单
				$num2++;
			}else if($v['status'] == 9){//已完成订单
				$num3++;
			}
		}
		$num4 = count($order_list);
		$counts = array($num1, $num2, $num3, $num4);//数量统计
		
		return $counts;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150608 add by dudanfeng 1 系统设置读取
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function getSetting(){
		$connection = Yii::$app->db;
		
		$session = Yii::$app->session;
		$user_id = $session->get('user_id');
		
		$command = $connection->createCommand("SELECT * FROM {{%setting}}");
		$command->bindValue(':a', $user_id);
		$list = $command->query();
		
		$data = '';
		$aa = '';
		
		foreach($list as $k => $v){
			$data[$k] = $v;
		}
		
		foreach($data as $k => $v){
			$aa[$v['variable']] = $v['value'];
		}
		
		return $aa;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150702 add by dudanfeng 1 判读pc端和手机端
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function getPcorwap(){
		//判断PC和WAP
		$_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';  
		$mobile_browser = '0';  
		if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))  
			$mobile_browser++;  
		if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))  
			$mobile_browser++;  
		if(isset($_SERVER['HTTP_X_WAP_PROFILE']))  
			$mobile_browser++;  
		if(isset($_SERVER['HTTP_PROFILE']))  
			$mobile_browser++;  
			$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));  
			$mobile_agents = array(  
				'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',  
				'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',  
				'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',  
				'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',  
				'newt','noki','oper','palm','pana','pant','phil','play','port','prox',  
				'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',  
				'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',  
				'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',  
				'wapr','webc','winw','winw','xda','xda-' 
			);  
		if(in_array($mobile_ua, $mobile_agents))  
			$mobile_browser++;  
		if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)  
			$mobile_browser++;  
		 // Pre-final check to reset everything if the user is on Windows  
		if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)  
			$mobile_browser=0;  
		 // But WP7 is also Windows, with a slightly different characteristic  
		if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)  
			$mobile_browser++;  
		 
		
		return $mobile_browser;
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150718 add by dudanfeng 1 本周时间
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function get_weekinfo($month){
		$weekinfo = array();
		$end_date = date('d',strtotime($month.' +1 month -1 day'));
		for ($i=1; $i <$end_date ; $i=$i+7) { 
			$w = date('N',strtotime($month.'-'.$i));
	 
			//$weekinfo[] = array(date('Y-m-d',strtotime($month.'-'.$i.' -'.($w-1).' days')),date('Y-m-d',strtotime($month.'-'.$i.' +'.(7-$w).' days')));
			$weekinfo[] = array(strtotime($month.'-'.$i.' -'.($w-1).' days'),strtotime($month.'-'.$i.' +'.(7-$w).' days'));
		}
		
		foreach($weekinfo as $k => $v){
			if($v[0] < time() && $v[1] > time()){
				$week = $weekinfo[$k];
				break;
			}
		}
		return $week;
	}
	/******************** 1 ********************/	
	
	
	/**
	 * 20150718 add by dudanfeng 1 时间选择
	 * @return $day                天数
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function getTimeInfo($day = 7){
		$time = array();
		for ($i = 0; $i < $day; $i++){
			$time[$i] = time()+24*3600*($i+1);
		}
		
		return $time;
	}
	/******************** 1 ********************/	
	
	
	/**
	 * 20150720 add by dudanfeng 1 微信提醒
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function getWeixinInfo($openid, $content){
		$txt = '{
			"touser" : "'.$openid.'",
			"msgtype" : "text",
			"text" : {
				"content" : "'.$content.'"
			}
		}';
		
		$access_token = wx::getAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
		$result = wx::https_request($url, $txt);
	}
	/******************** 1 ********************/
	
	
	/**
	 * 20150723 add by dudanfeng 1 微信分享
	 * @return string              返回值
	**/
	/******************** 1 ********************/
	public static function getWeixinSign(){
		$user_id = dy::getLoginOn();
		
		$connection = Yii::$app->db;
		$command = $connection->createCommand("SELECT id,activity FROM {{%user}} where id=:a and status=1;");
		$command->bindValue(':a', $user_id);
		$user = $command->query();//个人信息
		
		$id = $number = $ac_name = $pic = $money ='';
		foreach($user as $v){
			$id = $v['id'];
			$number = $v['activity'];
		}
		
		$command1 = $connection->createCommand("SELECT id,ac_name,ac_images FROM {{%activity}} where status_sign=1;");
		$command1->bindValue(':a', $user_id);
		$act = $command1->query();//活动信息
		
		foreach($act as $v){
			$ac_name = $v['ac_name'];
			$pic = dy::getImgOne($v['ac_images']);
			$act_id = $v['id'];
		}
		
		$command2 = $connection->createCommand("SELECT * FROM {{%activity}} where status=1 and type=3;");
		$command2->bindValue(':a', $user_id);
		$act2 = $command2->query();//注册活动信息
		
		foreach($act2 as $v){
			$money = $v['value2'];
		}
		
		$arr = array();
		if($act2){
			$arr['title'] = $ac_name."  使用此推荐码，立即可获得".$money."元,推荐码：".$number;
		}else{
			$arr['title'] = $ac_name;
		}
		
		$arr['pic'] = "http://".$_SERVER['HTTP_HOST'].$pic;
		$arr['url'] = "http://".$_SERVER['HTTP_HOST']."/default/activity?id=$act_id";
		
		return $arr;
	}
	/******************** 1 ********************/
	
	
}



