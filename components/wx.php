<?php

namespace components;

use yii\helpers\VarDumper;
use Yii;
use yii\helpers\Url;
use yii\data\Pagination;
use components\Smtp;
use components\dy;

use app\models\WxApi;
use app\models\User;

define('TOKEN',         "sxxfxxt20150705");

class wx
{
	//验证签名
    public static function valid()
    {
        $echoStr = $_GET["echostr"];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;//访问TOKEN验证
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if($tmpStr == $signature){
            echo $echoStr;
            exit;
        }
    }
	
    //响应消息
    public static function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            wx::logger("R \r\n".$postStr);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            /* if (($postObj->MsgType == "event") && ($postObj->Event == "subscribe" || $postObj->Event == "unsubscribe")){
                //过滤关注和取消关注事件
				
            }else{
                
            } */
            
            //消息类型分离
            switch ($RX_TYPE)
            {
                case "event":
                    $result = wx::receiveEvent($postObj);
                    break;
                case "text":
                   if (strstr($postObj->Content, "第三方")){
                        $result = wx::relayPart3("http://www.fangbei.org/test.php".'?'.$_SERVER['QUERY_STRING'], $postStr);
                    }else{
                        $result = wx::receiveText($postObj);
                    }
                    break;
                case "image":
                    $result = wx::receiveImage($postObj);
                    break;
                case "location":
                    $result = wx::receiveLocation($postObj);
                    break;
                case "voice":
                    $result = wx::receiveVoice($postObj);
                    break;
                case "video":
                    $result = wx::receiveVideo($postObj);
                    break;
                case "link":
                    $result = wx::receiveLink($postObj);
                    break;
                default:
                    $result = "unknown msg type: ".$RX_TYPE;
                    break;
            }
            wx::logger("T \r\n".$result);
            echo $result;
        }else {
            echo "";
            exit;
        }
    }

    //接收事件消息
    public static function receiveEvent($object)
    {
        $content = "";
		$openid = $object->FromUserName;
        switch ($object->Event)
        {
            case "subscribe":
				/* //根据token获取微信密钥
				$rst = WxApi::find()->one();
				if($rst){
					$appid = $rst['appid'];
					$appsecret = $rst['appsecret'];
				}else{
					$content = "微信API未设置，请设置好!";
					break;
				}
				//获取访问token
				$access_token = wx::getAccessToken($appid,$appsecret);
				if(!$access_token){
					$content = "获取访问token出错!";
					break;
				}
				//得到微信用户的个人资料
				$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid";
				$rst = wx::https_request($url);
				if(strpos($rst,'48001')>0){//不是高级接口
					//是否成为会员，不是的话插入
					$rst = User::find()->where(['openid' => $openid])->one();$content = "欢迎关注方倍工作室22 ---".$access_token;break;
					if(empty($rst)){
						$name = "我的昵称";
						$time = time();
						$sql = "insert into {{user}} (user_wx,wx_token,user_name,attention_time)
								values('$user_wx','$wx_token','$name','$time')";
						$rst = $database->execInDeUp($sql);
					}else{
						if($rst['user_status']== 0)
						{
							$sql = "update {{user}} set user_status = '1' where wx_token = '$wx_token' and user_wx = '$user_wx'"; 	
							$rst = $database->execInDeUp($sql);
						}
					}
				}else{	//高级接口
					$jsoninfo = json_decode($rst, true);
					$openid = $jsoninfo['openid'];
					$nickname = $jsoninfo['nickname'];
					$user_sex = $jsoninfo['sex'];
					$user_city = $jsoninfo['city'];
					$user_country = $jsoninfo['country'];
					$user_province = $jsoninfo['province'];
					$headimgurl = $jsoninfo['headimgurl'];
					$attention_time = $jsoninfo['subscribe_time'];
					//$unionid = '';//$jsoninfo['unionid'];
					//是否成为会员，不是的话插入
					$rst = User::find()->where(['openid' => $openid])->one();
					
					if(empty($rst)){
						$data = array(
							'openid'			=> $openid,
							'user_nickname' 	=> $nickname,
							'user_sex'			=> $user_sex,
							'user_logo' 		=> $headimgurl,
							'create_time' 		=> $attention_time,
							'update_time' 		=> time(),
							'set_password' 		=> '1',
							'attention_status' 	=> '1'
						);
						$rst = dy::execAdd('user', $data);
					}else{
						if($rst['attention_status'] == 0){
							$data = array(
								'attention_status' => 1
							);								
							dy::execUpdate('user', $data, $openid);
						}
					}
				} */
				
				
                $content = "欢迎关注方倍工作室 ---".$access_token;break;
				
				
                //$content .= (!empty($object->EventKey))?("\n来自二维码场景 ".str_replace("qrscene_","",$object->EventKey)):"";
                break;
            case "unsubscribe":
                $data = array(
					'attention_status' => 0
				);								
				dy::execUpdate('user', $data, $openid);
                break;
            case "CLICK":
                switch ($object->EventKey)
                {
                    case "COMPANY":
                        $content = array();
                        $content[] = array("Title"=>"方倍工作室", "Description"=>"", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
                        break;
                    default:
                        $content = "点击菜单：".$object->EventKey;
                        break;
                }
                break;
            case "VIEW":
                $content = "跳转链接 ".$object->EventKey;
                break;
            case "SCAN":
                $content = "扫描场景 ".$object->EventKey;
                break;
            case "LOCATION":
                $content = "上传位置：纬度 ".$object->Latitude.";经度 ".$object->Longitude;
                break;
            case "scancode_waitmsg":
                if ($object->ScanCodeInfo->ScanType == "qrcode"){
                    $content = "扫码带提示：类型 二维码 结果：".$object->ScanCodeInfo->ScanResult;
                }else if ($object->ScanCodeInfo->ScanType == "barcode"){
                    $codeinfo = explode(",",strval($object->ScanCodeInfo->ScanResult));
                    $codeValue = $codeinfo[1];
                    $content = "扫码带提示：类型 条形码 结果：".$codeValue;
                }else{
                    $content = "扫码带提示：类型 ".$object->ScanCodeInfo->ScanType." 结果：".$object->ScanCodeInfo->ScanResult;
                }
                break;
            case "scancode_push":
                $content = "扫码推事件";
                break;
            case "pic_sysphoto":
                $content = "系统拍照";
                break;
            case "pic_weixin":
                $content = "相册发图：数量 ".$object->SendPicsInfo->Count;
                break;
            case "pic_photo_or_album":
                $content = "拍照或者相册：数量 ".$object->SendPicsInfo->Count;
                break;
            case "location_select":
                $content = "发送位置：标签 ".$object->SendLocationInfo->Label;
                break;
            default:
                $content = "receive a new event: ".$object->Event;
                break;
        }

        if(is_array($content)){
            if (isset($content[0]['PicUrl'])){
                $result = wx::transmitNews($object, $content);
            }else if (isset($content['MusicUrl'])){
                $result = wx::transmitMusic($object, $content);
            }
        }else{
            $result = wx::transmitText($object, $content);
        }
        return $result;
    }

    //接收文本消息
    public static function receiveText($object)
    {
        $keyword = trim($object->Content);
        //多客服人工回复模式
        if (strstr($keyword, "请问在吗") || strstr($keyword, "在线客服")){
            $result = wx::transmitService($object);
            return $result;
        }

        //自动回复模式
        if (strstr($keyword, "文本")){
            $content = "这是个文本消息";
        }else if (strstr($keyword, "表情")){
            $content = "中国：".wx::bytes_to_emoji(0x1F1E8).wx::bytes_to_emoji(0x1F1F3)."\n仙人掌：".wx::bytes_to_emoji(0x1F335);
        }else if (strstr($keyword, "单图文")){
            $content = array();
            $content[] = array("Title"=>"单图文标题",  "Description"=>"单图文内容", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
        }else if (strstr($keyword, "图文") || strstr($keyword, "多图文")){
            $content = array();
            $content[] = array("Title"=>"多图文1标题", "Description"=>"", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
            $content[] = array("Title"=>"多图文2标题", "Description"=>"", "PicUrl"=>"http://d.hiphotos.bdimg.com/wisegame/pic/item/f3529822720e0cf3ac9f1ada0846f21fbe09aaa3.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
            $content[] = array("Title"=>"多图文3标题", "Description"=>"", "PicUrl"=>"http://g.hiphotos.bdimg.com/wisegame/pic/item/18cb0a46f21fbe090d338acc6a600c338644adfd.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
        }else if (strstr($keyword, "音乐")){
            $content = array();
            $content = array("Title"=>"最炫民族风", "Description"=>"歌手：凤凰传奇", "MusicUrl"=>"http://121.199.4.61/music/zxmzf.mp3", "HQMusicUrl"=>"http://121.199.4.61/music/zxmzf.mp3"); 
        }else{
            $content = date("Y-m-d H:i:s",time())."\nOpenID：".$object->FromUserName."\n技术支持 方倍工作室";
        }

        if(is_array($content)){
            if (isset($content[0])){
                $result = wx::transmitNews($object, $content);
            }else if (isset($content['MusicUrl'])){
                $result = wx::transmitMusic($object, $content);
            }
        }else{
            $result = wx::transmitText($object, $content);
        }
        return $result;
    }

    //接收图片消息
    public static function receiveImage($object)
    {
        $content = array("MediaId"=>$object->MediaId);
        $result = wx::transmitImage($object, $content);
        return $result;
    }

    //接收位置消息
    public static function receiveLocation($object)
    {
        $content = "你发送的是位置，经度为：".$object->Location_Y."；纬度为：".$object->Location_X."；缩放级别为：".$object->Scale."；位置为：".$object->Label;
        $result = wx::transmitText($object, $content);
        return $result;
    }

    //接收语音消息
    public static function receiveVoice($object)
    {
        if (isset($object->Recognition) && !empty($object->Recognition)){
            $content = "你刚才说的是：".$object->Recognition;
            $result = wx::transmitText($object, $content);
        }else{
            $content = array("MediaId"=>$object->MediaId);
            $result = wx::transmitVoice($object, $content);
        }
        return $result;
    }

    //接收视频消息
    public static function receiveVideo($object)
    {
        $content = array("MediaId"=>$object->MediaId, "ThumbMediaId"=>$object->ThumbMediaId, "Title"=>"", "Description"=>"");
        $result = wx::transmitVideo($object, $content);
        return $result;
    }

    //接收链接消息
    public static function receiveLink($object)
    {
        $content = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
        $result = wx::transmitText($object, $content);
        return $result;
    }

    //回复文本消息
    public static function transmitText($object, $content)
    {
        if (!isset($content) || empty($content)){
            return "";
        }

        $xmlTpl = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[text]]></MsgType>
			<Content><![CDATA[%s]]></Content>
		</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);

        return $result;
    }

    //回复图文消息
    public static function transmitNews($object, $newsArray)
    {
        if(!is_array($newsArray)){
            return "";
        }
        $itemTpl = "        <item>
            <Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <Url><![CDATA[%s]]></Url>
        </item>
";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[news]]></MsgType>
			<ArticleCount>%s</ArticleCount>
			<Articles>
		$item_str    </Articles>
		</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }

    //回复音乐消息
    public static function transmitMusic($object, $musicArray)
    {
        if(!is_array($musicArray)){
            return "";
        }
        $itemTpl = "<Music>
			<Title><![CDATA[%s]]></Title>
			<Description><![CDATA[%s]]></Description>
			<MusicUrl><![CDATA[%s]]></MusicUrl>
			<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
		</Music>";

        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);

        $xmlTpl = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[music]]></MsgType>
			$item_str
		</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复图片消息
    public static function transmitImage($object, $imageArray)
    {
        $itemTpl = "<Image>
				<MediaId><![CDATA[%s]]></MediaId>
			</Image>";

        $item_str = sprintf($itemTpl, $imageArray['MediaId']);

        $xmlTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[image]]></MsgType>
				$item_str
			</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复语音消息
    public static function transmitVoice($object, $voiceArray)
    {
        $itemTpl = "<Voice>
				<MediaId><![CDATA[%s]]></MediaId>
			</Voice>";

        $item_str = sprintf($itemTpl, $voiceArray['MediaId']);
        $xmlTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[voice]]></MsgType>
				$item_str
			</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复视频消息
    public static function transmitVideo($object, $videoArray)
    {
        $itemTpl = "<Video>
					<MediaId><![CDATA[%s]]></MediaId>
					<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
					<Title><![CDATA[%s]]></Title>
					<Description><![CDATA[%s]]></Description>
				</Video>";

        $item_str = sprintf($itemTpl, $videoArray['MediaId'], $videoArray['ThumbMediaId'], $videoArray['Title'], $videoArray['Description']);

        $xmlTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[video]]></MsgType>
					$item_str
				</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复多客服消息
    public static function transmitService($object)
    {
        $xmlTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[transfer_customer_service]]></MsgType>
				</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复第三方接口消息
    public static function relayPart3($url, $rawData)
    {
        $headers = array("Content-Type: text/xml; charset=utf-8");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $rawData);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    //字节转Emoji表情
    function bytes_to_emoji($cp)
    {
        if ($cp > 0x10000){       # 4 bytes
            return chr(0xF0 | (($cp & 0x1C0000) >> 18)).chr(0x80 | (($cp & 0x3F000) >> 12)).chr(0x80 | (($cp & 0xFC0) >> 6)).chr(0x80 | ($cp & 0x3F));
        }else if ($cp > 0x800){   # 3 bytes
            return chr(0xE0 | (($cp & 0xF000) >> 12)).chr(0x80 | (($cp & 0xFC0) >> 6)).chr(0x80 | ($cp & 0x3F));
        }else if ($cp > 0x80){    # 2 bytes
            return chr(0xC0 | (($cp & 0x7C0) >> 6)).chr(0x80 | ($cp & 0x3F));
        }else{                    # 1 byte
            return chr($cp);
        }
    }

    //日志记录
    public static function logger($log_content)
    {
        if(isset($_SERVER['HTTP_APPNAME'])){   //SAE
            sae_set_display_errors(false);
            sae_debug($log_content);
            sae_set_display_errors(true);
        }else if($_SERVER['REMOTE_ADDR'] != "127.0.0.1"){ //LOCAL
            $max_size = 1000000;
            $log_filename = "log.xml";
            if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);}
            file_put_contents($log_filename, date('Y-m-d H:i:s')." ".$log_content."\r\n", FILE_APPEND);
        }
    }
	
	//http请求
	public static function https_request($url,$data = null)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		//curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
	
	//获取访问token
	public static function getAccessToken()
	{
		$rst = WxApi::find()->one();
		if($rst){
			$appid = $rst['appid'];
			$appsecret = $rst['appsecret'];
		}else{
			$content = "微信API未设置，请设置好!";
			break;
		}
		
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
		$result = wx::https_request($url);
		if(strpos($result,'access_token')>0){
			$jsoninfo = json_decode($result, true);
			$access_token = $jsoninfo["access_token"];
			return $access_token;
		}else{
			return false;
		}
	}
	
	//加密
	public static function encrypt($encrypt,$key="") {
		$iv = mcrypt_create_iv ( mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB ), MCRYPT_RAND );
		$passcrypt = mcrypt_encrypt ( MCRYPT_RIJNDAEL_256, $key, $encrypt, MCRYPT_MODE_ECB, $iv );
		$encode = base64_encode ( $passcrypt );
		return $encode;
	}

	//解密
	public static function decrypt($decrypt,$key="") {
		$decoded = base64_decode ( $decrypt );
		$iv = mcrypt_create_iv ( mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB ), MCRYPT_RAND );
		$decrypted = mcrypt_decrypt ( MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_ECB, $iv );
		return $decrypted;
	}

}



