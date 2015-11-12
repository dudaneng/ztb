-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-08-14 03:55:12
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_dy`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_activity`
--

CREATE TABLE IF NOT EXISTS `tbl_activity` (
  `id` int(60) NOT NULL AUTO_INCREMENT,
  `ac_name` varchar(255) NOT NULL COMMENT '活动名称',
  `type` tinyint(2) NOT NULL COMMENT '1面值券 2满值券 3、注册送钱',
  `value1` varchar(10) NOT NULL DEFAULT '0' COMMENT '满值',
  `value2` varchar(10) NOT NULL DEFAULT '0' COMMENT '优惠值',
  `ac_numbers` int(10) NOT NULL DEFAULT '1' COMMENT '活动次数',
  `peoples` int(60) NOT NULL DEFAULT '0' COMMENT '人数限制',
  `ac_images` varchar(255) NOT NULL COMMENT '活动展示图片',
  `ac_content` text NOT NULL COMMENT '活动说明',
  `status` tinyint(2) NOT NULL COMMENT '活动状态3可分享 ',
  `start_time` int(10) NOT NULL COMMENT '开始时间',
  `end_time` int(10) NOT NULL COMMENT '截止时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `tbl_activity`
--

INSERT INTO `tbl_activity` (`id`, `ac_name`, `type`, `value1`, `value2`, `ac_numbers`, `peoples`, `ac_images`, `ac_content`, `status`, `start_time`, `end_time`, `update_time`) VALUES
(1, '满13元送5元', 1, '13', '5', 1, 100, '', '全场任意菜品适用', -1, 1435096800, 1435615200, 1435050147),
(2, '满28减10元', 2, '28', '10', 1, 100, '', '活动大方送', -1, 0, 1434664800, 1434361617),
(3, '满39减15元', 2, '39', '15', 1, 100, '', '全场任意菜品适用', -1, 0, 0, 1434349479),
(4, '注册即送30元代购券', 3, '30', '15', 2, -1, '<p><img alt="eventsImg.jpg" src="/ueditor/php/upload/image/20150619/1434693782970237.jpg" title="1434693782970237.jpg"/></p>', '适用于所有商品', 1, 1435010400, 1469051999, 1435220685),
(5, '满100减10', 2, '100', '10', 1, 0, '<p><img src="/ueditor/php/upload/image/20150522/1432258033473392.jpg" alt="1432258033473392.jpg"/></p>', '阿萨德发斯蒂芬', 1, 1434837600, 1435701599, 1435633573),
(6, '满70送20', 1, '70', '20', 1, 0, '<p><img alt="eventsImg.jpg" src="/ueditor/php/upload/image/20150623/1435028445203841.jpg" title="1435028445203841.jpg"/></p>', '使用所有商品', -1, 1435096800, 1435356000, 1435028448),
(7, '满100减20', 2, '100', '20', 1, 0, '<p><img alt="eventsImg.jpg" src="/ueditor/php/upload/image/20150623/1435050469874362.jpg" title="1435050469874362.jpg"/></p>', '适用本店所有商品', -1, 1434924000, 1435356000, 1435050472),
(8, '123', 1, '12', '12', 12, 0, '<p>啊啊啊啊啊啊啊啊啊啊啊啊啊啊</p>', 'asdf', -1, 1433800800, 1435615199, 1435136074),
(9, '满1分送10元优惠券', 1, '0.01', '10', 1, 0, '<p><img alt="cuxiao.jpg" src="/ueditor/php/upload/image/20150701/1435716853519049.jpg" title="1435716853519049.jpg"/></p>', 'qw', 1, 1435528800, 1438207199, 1435718554),
(10, '满150减30', 2, '150', '30', 2, 0, '<p>满150减30</p>', '活动期间有效活动期间有效活动期间有效活动期间有效活动期间有效活动期间有', 1, 1435615200, 1438293599, 1437986672),
(11, '满70减20', 2, '70', '20', 2, 0, '<p>全场通用</p>', '全场通用', 1, 1435701600, 1438466399, 1435720696),
(12, '满1送10', 1, '1', '10', 2, 0, '', '可任意使用', 1, 1436220000, 1438379999, 1436752215);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_act_number`
--

CREATE TABLE IF NOT EXISTS `tbl_act_number` (
  `id` int(60) NOT NULL AUTO_INCREMENT,
  `user_id` int(60) NOT NULL COMMENT '用户id',
  `act_id` int(60) NOT NULL COMMENT '活动id',
  `numbers` int(60) NOT NULL DEFAULT '0' COMMENT '剩余活动次数',
  `status` tinyint(10) NOT NULL COMMENT '-1删除 0禁用 1启用',
  `update_time` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- 转存表中的数据 `tbl_act_number`
--

INSERT INTO `tbl_act_number` (`id`, `user_id`, `act_id`, `numbers`, `status`, `update_time`) VALUES
(1, 3, 1, 2, 1, 0),
(2, 3, 2, 2, 1, 1434420374),
(3, 3, 4, 2, 1, 1434420379),
(10, 3, 4, 1, 1, 1434426516),
(11, 4, 4, 6, 1, 1434426516),
(12, 3, 5, 1, 0, 1435050525),
(13, 3, 7, 1, 0, 1435050527),
(14, 3, 0, 0, 0, 1435125081),
(15, 6, 5, 1, 1, 1435126269),
(16, 6, 7, 1, 1, 1435126269),
(17, 10, 5, 1, 1, 1435128143),
(18, 10, 7, 1, 1, 1435128143),
(19, 9, 5, 1, 1, 1435128257),
(20, 9, 7, 1, 1, 1435128258),
(21, 10, 4, 6, 1, 1435128326),
(22, 10, 4, 6, 1, 1435128326),
(23, 10, 4, 6, 1, 1435128403),
(24, 9, 4, 6, 1, 1435128403),
(25, 9, 0, 0, 0, 1435130096),
(26, 10, 0, 0, 0, 1435130243),
(27, 11, 5, 1, 1, 1435212133),
(28, 11, 7, 1, 1, 1435212133),
(29, 11, 4, 1, 1, 1435217291),
(30, 11, 4, 1, 1, 1435217291),
(31, 12, 5, 1, 1, 1435223649),
(32, 12, 7, 1, 1, 1435223649),
(33, 12, 4, 2, 1, 1435223657),
(34, 12, 4, 2, 1, 1435223657),
(35, 15, 5, 1, 1, 1435625479),
(36, 16, 5, 1, 1, 1435625494),
(37, 17, 5, 1, 1, 1435632829),
(38, 18, 5, 1, 1, 1435633028),
(39, 18, 10, 1, 1, 1435634581),
(40, 17, 10, 1, 1, 1435635808),
(41, 19, 10, 1, 1, 1435718240),
(42, 19, 11, 0, 1, 1435721028),
(43, 21, 10, 0, 1, 1435731982),
(44, 21, 11, 0, 1, 1435731982),
(45, 22, 10, 1, 1, 1435805482),
(46, 22, 11, 2, 1, 1435805482),
(47, 21, 9, 1, 1, 0),
(48, 21, 12, 1, 1, 0),
(49, 21, 12, 1, 1, 0),
(50, 23, 10, 2, 1, 1436773540),
(51, 23, 11, 0, 1, 1436773540),
(52, 23, 12, 0, 1, 0),
(53, 23, 12, 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_ad`
--

CREATE TABLE IF NOT EXISTS `tbl_ad` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `position_id` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '广告位ID',
  `ad_name` varchar(30) NOT NULL DEFAULT '' COMMENT '广告名称',
  `ad_describe` varchar(100) NOT NULL DEFAULT '' COMMENT '广告描述',
  `ad_url` varchar(300) NOT NULL DEFAULT '' COMMENT '广告链接',
  `ad_image` varchar(1000) NOT NULL DEFAULT '' COMMENT '广告图片',
  `index_pic` varchar(300) NOT NULL COMMENT '图片路径',
  `click_count` int(6) NOT NULL DEFAULT '0' COMMENT '点击数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1正常、0停止、-1删除',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序、后置',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='广告表' AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `tbl_ad`
--

INSERT INTO `tbl_ad` (`id`, `position_id`, `ad_name`, `ad_describe`, `ad_url`, `ad_image`, `index_pic`, `click_count`, `status`, `sort`, `create_time`, `update_time`) VALUES
(14, 15, '图1', '<p>weqweqwe<br/></p>', 'http://www.91wan.com', '<p><img alt="banner.jpg" src="/ueditor/php/upload/image/20150604/1433393397998552.jpg" title="1433393397998552.jpg"/></p>', '/ueditor/php/upload/image/20150604/1433393397998552.jpg', 1, -1, 1, 1433393404, 1434692437),
(15, 15, '图2', '<p>sdfasdf<br/></p>', 'http://www.37wan.com', '<p><img alt="banner2.jpg" src="/ueditor/php/upload/image/20150611/1434014465197515.jpg" title="1434014465197515.jpg"/></p>', '/ueditor/php/upload/image/20150611/1434014465197515.jpg', 3, -1, 3, 1433393433, 1434692422),
(16, 15, '图3', '<p>asdf<br/></p>', 'http://www.baidu.com', '<p><img alt="banner1.jpg" src="/ueditor/php/upload/image/20150611/1434014485320672.jpg" title="1434014485320672.jpg"/></p>', '/ueditor/php/upload/image/20150611/1434014485320672.jpg', 3, -1, 3, 1433393455, 1434692429),
(17, 15, '图4', '<p>asdf<br/></p>', 'http://www.baidu.com', '<p><img alt="banner3.jpg" src="/ueditor/php/upload/image/20150611/1434014412902634.jpg" title="1434014412902634.jpg"/></p>', '/ueditor/php/upload/image/20150611/1434014412902634.jpg', 4, -1, 4, 1433393502, 1434692412),
(18, 15, '图5', '<p>asdf<br/></p>', 'http://localhost/shiping/default/activity?id=4', '<p><img alt="banner4.jpg" src="/ueditor/php/upload/image/20150611/1434014384678955.jpg" title="1434014384678955.jpg"/></p>', '/ueditor/php/upload/image/20150611/1434014384678955.jpg', 2, -1, 5, 1433393523, 1434694023),
(19, 15, '白灼芥兰', '', 'http://localhost/shiping/default/activity?id=8', '<p><img src="/ueditor/php/upload/image/20150625/1435213459347266.jpg" title="1435213459347266.jpg" alt="b1.jpg"/></p>', '/ueditor/php/upload/image/20150625/1435213459347266.jpg', 0, 1, 0, 1435213544, 1435716662),
(20, 2, '白芍芥蓝', '', 'http://localhost/shiping/myweb/default/activity?id=9', '<p><img alt="banner01.png" src="/ueditor/php/upload/image/20150701/1435713973933746.png" title="1435713973933746.png"/></p>', '/ueditor/php/upload/image/20150701/1435713973933746.png', 0, 1, 0, 1435713977, 1435716896),
(21, 15, '清热去火', '', '', '<p><img src="/ueditor/php/upload/image/20150701/1435733703150008.jpg" title="1435733703150008.jpg" alt="86.jpg"/></p>', '/ueditor/php/upload/image/20150701/1435733703150008.jpg', 0, 1, 0, 1435733705, 1435733705);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_address`
--

CREATE TABLE IF NOT EXISTS `tbl_address` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL COMMENT '用户id',
  `area_small` int(255) NOT NULL COMMENT '区域id',
  `order_sn` varchar(255) DEFAULT NULL COMMENT '订单id',
  `sort` int(255) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '-1删除 0禁用 1启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- 转存表中的数据 `tbl_address`
--

INSERT INTO `tbl_address` (`id`, `user_id`, `area_small`, `order_sn`, `sort`, `status`) VALUES
(1, 12, 3, 'E6268583903452', 0, 1),
(2, 12, 1, 'E6268607743414', 0, 1),
(3, 12, 1, 'E6261032521591', 0, 1),
(4, 14, 1, 'E6296058609184', 0, 1),
(5, 14, 1, 'E6296073402430', 0, 1),
(6, 14, 1, 'E6296144526699', 0, 1),
(7, 14, 1, 'E6296171197124', 0, 1),
(8, 14, 3, 'E6296282885012', 0, 1),
(9, 12, 1, 'E6296445892636', 0, 1),
(10, 12, 1, 'E6296459168295', 0, 1),
(11, 12, 1, 'E6296504483387', 0, 1),
(12, 12, 1, 'E6296559729147', 0, 1),
(13, 12, 1, 'E6296637266582', 0, 1),
(14, 12, 1, 'E6296651210079', 0, 1),
(15, 12, 1, 'E6296703841289', 0, 1),
(16, 12, 1, 'E6296709844133', 0, 1),
(17, 14, 3, 'E6297084269049', 0, 1),
(18, 15, 1, 'E6303238942612', 0, 1),
(19, 17, 1, 'E6303338258893', 0, 1),
(20, 18, 1, 'E6303342654344', 0, 1),
(21, 18, 1, 'E6303345016079', 0, 1),
(22, 18, 1, 'E6303358847270', 0, 1),
(23, 18, 1, 'E6303366924632', 0, 1),
(24, 18, 1, 'E6303380199191', 0, 1),
(25, 18, 1, 'E6303460356276', 0, 1),
(26, 18, 1, 'E6303461904965', 0, 1),
(27, 18, 1, 'E6303484492457', 0, 1),
(28, 17, 1, 'E6303632086799', 0, 1),
(29, 19, 1, 'E7011880520336', 0, 1),
(30, 19, 1, 'E7011942704893', 0, 1),
(31, 19, 1, 'E7012227628090', 0, 1),
(32, 19, 1, 'E7012236683808', 0, 1),
(33, 21, 1, 'E7013914907997', 0, 1),
(34, 21, 1, 'E7013916864508', 0, 1),
(35, 21, 1, 'E7020094541694', 0, 1),
(36, 21, 1, 'E7020170877660', 0, 1),
(37, 21, 1, 'E7020200312244', 0, 1),
(38, 21, 1, 'E7020210093804', 0, 1),
(39, 22, 2, 'E7020707538656', 0, 1),
(40, 21, 1, 'E7020770819275', 0, 1),
(41, 21, 1, 'E7020777960484', 0, 1),
(42, 22, 2, 'E7020800403967', 0, 1),
(43, 22, 1, 'E7021657175070', 0, 1),
(44, 21, 1, 'E7031243281604', 0, 1),
(45, 21, 1, 'E7031444414208', 0, 1),
(46, 21, 1, 'E7073533116815', 0, 1),
(47, 21, 1, 'E7073536720822', 0, 1),
(48, 21, 1, 'E7073554062813', 0, 1),
(49, 21, 1, 'E7084417249057', 0, 1),
(50, 21, 1, 'E7084426026559', 0, 1),
(51, 21, 1, 'E7108869592223', 0, 1),
(52, 21, 1, 'E7101521267938', 0, 1),
(53, 23, 1, 'E7137884889761', 0, 1),
(54, 23, 1, 'E7137889132604', 0, 1),
(55, 23, 1, 'E7137925242269', 0, 1),
(56, 23, 1, 'E7154838607014', 0, 1),
(57, 23, 1, 'E7154843177876', 0, 1),
(58, 23, 1, 'E7188397917099', 0, 1),
(59, 23, 1, 'E7188527879432', 0, 1),
(60, 23, 1, 'E7188659888982', 0, 1),
(61, 23, 1, 'E7188693014477', 0, 1),
(62, 23, 3, 'E7188719377485', 0, 1),
(63, 23, 1, 'E7180020946230', 0, 1),
(64, 23, 1, 'E7180803049164', 0, 1),
(65, 23, 1, 'E7180857413474', 0, 1),
(66, 23, 1, 'E7205770201379', 0, 1),
(67, 23, 1, 'E7206042920005', 0, 1),
(68, 23, 1, 'E7206048012916', 0, 1),
(69, 23, 1, 'E7206055013996', 0, 1),
(70, 23, 1, 'E7206059321566', 0, 1),
(71, 23, 1, 'E7206111035204', 0, 1),
(72, 23, 1, 'E7206112354966', 0, 1),
(73, 23, 1, 'E7208410096975', 0, 1),
(74, 23, 1, 'E7214601169148', 0, 1),
(75, 23, 1, 'E7214620997682', 0, 1),
(76, 23, 1, 'E7214630739539', 0, 1),
(77, 23, 1, 'E7214633045471', 0, 1),
(78, 23, 1, 'E7214697860478', 0, 1),
(79, 23, 1, 'E7214705665424', 0, 1),
(80, 23, 1, 'E7214709976071', 0, 1),
(81, 23, 1, 'E7216418264379', 0, 1),
(82, 23, 1, 'E7216599174727', 0, 1),
(83, 23, 1, 'E7216784406822', 0, 1),
(84, 23, 1, 'E7223652378171', 0, 1),
(85, 23, 1, 'E7232988764516', 0, 1),
(86, 23, 1, 'E7276651925919', 0, 1),
(87, 23, 1, 'E7279006563597', 0, 1),
(88, 23, 1, 'E7279007737464', 0, 1),
(89, 23, 1, 'E7279009687075', 0, 1),
(90, 23, 1, 'E7279010699533', 0, 1),
(91, 23, 1, 'E7285022501473', 0, 1),
(92, 23, 1, 'E7285185506296', 0, 1),
(93, 23, 1, 'E8126267786336', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `admin_acount` varchar(30) NOT NULL DEFAULT '' COMMENT '管理员账号',
  `admin_password` varchar(64) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `group_id` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '权限分组',
  `last_time` int(10) NOT NULL DEFAULT '0' COMMENT '上一次登陆时间',
  `last_ip` varchar(20) NOT NULL DEFAULT '0.0.0.0' COMMENT '上一次登陆IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `admin_acount`, `admin_password`, `group_id`, `last_time`, `last_ip`) VALUES
(1, 'admin', '4297f44b13955235245b2497399d7a93', 1, 0, '0.0.0.0'),
(2, 'admin1', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '0.0.0.0');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_ad_position`
--

CREATE TABLE IF NOT EXISTS `tbl_ad_position` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `position_name` varchar(20) DEFAULT '' COMMENT '位置名称',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序、后置',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1正常、0停止',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='广告位表' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `tbl_ad_position`
--

INSERT INTO `tbl_ad_position` (`id`, `position_name`, `sort`, `status`) VALUES
(1, '顶部广告', 2, -1),
(2, '手机站轮播图', 0, 1),
(3, '底部广告', 0, 1),
(4, '右侧广告', 0, 1),
(7, '左侧广告', 0, 1),
(15, '首页轮播图', 1, 1),
(16, '火锅', 0, -1);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_area_big`
--

CREATE TABLE IF NOT EXISTS `tbl_area_big` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `area_name` varchar(20) DEFAULT '' COMMENT '城市',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序 越大越靠前',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1正常、0停止',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='城市表' AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `tbl_area_big`
--

INSERT INTO `tbl_area_big` (`id`, `area_name`, `sort`, `status`) VALUES
(1, '武侯区', 100, 1),
(2, '成华区', 96, 1),
(3, '金牛区', 97, 1),
(4, '高新区', 95, 0),
(5, '锦江区', 99, 0),
(6, '红1区', 0, -1),
(7, '双流县', 0, 0),
(8, '红3区', 0, -1),
(9, '红4区', 0, -1),
(10, '温江区', 1, 1),
(11, '红5区', 0, -1),
(12, '红6区', 0, -1),
(13, '红7区', 0, -1),
(14, '阿斯顿', 0, -1),
(15, '电饭锅电饭锅', 0, -1),
(16, ' 风格萨阿德', 0, -1),
(17, '红8区', 0, -1),
(18, '青羊区', 98, 1),
(19, '德阳', 0, -1),
(20, '德阳1', 0, -1),
(21, '德阳', 0, -1),
(22, '德阳1', 0, -1);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_area_middle`
--

CREATE TABLE IF NOT EXISTS `tbl_area_middle` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `area_big` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '城市表ID',
  `area_name` varchar(20) DEFAULT '' COMMENT '城市分区',
  `sort` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1正常、0停止',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='城市分区表' AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `tbl_area_middle`
--

INSERT INTO `tbl_area_middle` (`id`, `area_big`, `area_name`, `sort`, `status`) VALUES
(1, 1, '红牌广场', 3, 1),
(2, 1, '桐梓林', 2, 1),
(3, 2, '高新区', 1, -1),
(4, 3, '天府大道', 0, -1),
(5, 10, '创业街', 0, 1),
(6, 1, '玉林', 1, 1),
(7, 10, '温江3区', 0, 1),
(8, 1, '火车南站', 0, 1),
(9, 1, '神仙树', 0, 1),
(10, 1, '红瓦寺', 0, 1),
(11, 1, '开发4区', 0, -1),
(12, 1, '开发6区', 0, -1),
(13, 13, '红小1区', 0, -1),
(14, 5, '春熙路', 0, 1),
(15, 13, '小红2区', 0, 1),
(16, 5, '东方广场', 0, 1),
(17, 18, '顺城大街', 0, 1),
(18, 3, '麦加广场', 0, 1),
(19, 5, '东方广场1号', 0, -1),
(20, 2, '成华1区', 0, 1),
(21, 2, '成华2区', 0, 1),
(22, 4, '世纪城', 0, 1),
(23, 10, '温江4区', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_area_small`
--

CREATE TABLE IF NOT EXISTS `tbl_area_small` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `area_big` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '城市表ID',
  `area_middle` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '城市分区表ID',
  `area_name` varchar(20) DEFAULT '' COMMENT '城市分区',
  `sort` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1正常、0停止',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='城市分区分区表' AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `tbl_area_small`
--

INSERT INTO `tbl_area_small` (`id`, `area_big`, `area_middle`, `area_name`, `sort`, `status`) VALUES
(1, 1, 1, '九峰大厦商圈', 3, 1),
(2, 1, 1, '太平园', 1, 1),
(3, 1, 1, '佳灵路商圈', 2, 1),
(4, 2, 3, '武阳大道公交站', 1, -1),
(5, 1, 2, '武侯大道口', 1, -1),
(6, 10, 5, '是对方通过', 0, 1),
(7, 1, 1, '十多个', 0, -1),
(8, 1, 1, '风格化', 0, -1),
(9, 1, 1, '各环节', 0, -1),
(10, 1, 1, '各环节人', 0, -1),
(11, 1, 1, '就看见', 0, -1),
(12, 1, 1, '123', 0, -1),
(13, 1, 1, '爱上大声地', 0, -1),
(14, 10, 7, '和谐路', 0, -1),
(15, 1, 2, '桐梓林南路', 2, 1),
(16, 1, 1, '789', 0, -1),
(17, 1, 1, '798', 0, -1),
(18, 1, 1, '670', 0, -1),
(19, 0, 0, '645', 0, 1),
(20, 0, 0, '2324', 0, 1),
(21, 1, 2, '桐梓林北路', 3, 1),
(22, 1, 6, '玉林东路', 1, 1),
(23, 1, 1, 'fsdfsf', 0, -1),
(24, 1, 8, '火车南站南路', 0, 1),
(25, 1, 8, '火车南站东路', 0, 1),
(26, 1, 6, '玉林西路', 0, 1),
(27, 1, 6, '玉林北路', 0, 1),
(28, 1, 9, '神仙树一号', 0, 1),
(29, 1, 9, '神仙树二号', 0, 1),
(30, 1, 10, '红瓦寺', 0, 1),
(31, 17, 0, '一号店', 0, 1),
(32, 17, 0, '大区1号', 0, 1),
(33, 18, 17, '小红3区', 0, 1),
(34, 18, 17, '小红4区', 0, 1),
(35, 18, 17, '小红5区', 0, 1),
(36, 18, 17, '小红6区', 0, 1),
(37, 5, 16, '东方广场1号', 0, -1),
(38, 10, 7, '温江广场', 0, 1),
(39, 18, 17, '小红旗', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_cabinet`
--

CREATE TABLE IF NOT EXISTS `tbl_cabinet` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL COMMENT '编号',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '-1删除 0禁用 1启用',
  `creat_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='自提点 柜子' AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `tbl_cabinet`
--

INSERT INTO `tbl_cabinet` (`id`, `code`, `status`, `creat_time`, `update_time`) VALUES
(1, 'A号', 0, 0, 0),
(2, 'B号', 1, 0, 0),
(3, 'C号', 1, 1435821800, 1435821800),
(4, 'D号', 1, 1435825502, 1435825502),
(21, 'E号', 1, 1435828311, 1435828311);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_cabinet_box`
--

CREATE TABLE IF NOT EXISTS `tbl_cabinet_box` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `cab_id` int(255) NOT NULL COMMENT '柜子id',
  `number` varchar(255) NOT NULL COMMENT '箱子编号',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '-1删除 0禁用 1空闲',
  `contact` tinyint(104) NOT NULL DEFAULT '1' COMMENT '1空闲 2有货 3发货',
  `update_time` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `tbl_cabinet_box`
--

INSERT INTO `tbl_cabinet_box` (`id`, `cab_id`, `number`, `status`, `contact`, `update_time`) VALUES
(24, 1, '1', 1, 1, 1435902008),
(25, 1, '2', 1, 1, 1435902013),
(26, 2, '1', 1, 3, 1435902017),
(27, 2, '2', 1, 3, 1435902021),
(28, 3, '1', 1, 3, 1435902023),
(29, 3, '2', 1, 3, 1435902027),
(30, 3, '3', 1, 3, 1435902030),
(31, 1, '3', 1, 1, 1436172183),
(32, 1, '4', 1, 1, 1436172187),
(33, 1, '5', 1, 1, 1436172191),
(34, 1, '6', 1, 1, 1436172194);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL COMMENT '用户id',
  `goods_id` int(255) NOT NULL COMMENT '商品id',
  `goods_number` int(60) unsigned NOT NULL DEFAULT '1' COMMENT '商品数量',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=165 ;

--
-- 转存表中的数据 `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `user_id`, `goods_id`, `goods_number`, `create_time`, `update_time`) VALUES
(10, 0, 9, 3, 1435033854, 1435033854),
(19, 9, 31, 10, 1437625352, 1437625352),
(20, 9, 30, 3, 1437625171, 1437625171),
(27, 9, 33, 7, 1435818994, 1435818994),
(71, 12, 30, 3, 1437625171, 1437625171),
(72, 12, 33, 7, 1435818994, 1435818994),
(73, 12, 32, 1, 1437627266, 1437627266),
(74, 12, 31, 10, 1437625352, 1437625352),
(75, 12, 35, 1, 1435568061, 1435568061),
(98, 17, 30, 3, 1437625171, 1437625171),
(99, 17, 32, 1, 1437627266, 1437627266),
(100, 17, 36, 1, 1436780221, 1436780221),
(101, 17, 35, 1, 1435715153, 1435715153),
(102, 17, 31, 10, 1437625352, 1437625352),
(103, 17, 33, 7, 1435818994, 1435818994),
(115, 19, 31, 10, 1437625352, 1437625352),
(138, 0, 35, 1, 1435806922, 1435806922),
(160, 22, 32, 1, 1437627266, 1437627266),
(161, 22, 33, 2, 1435828884, 1435830968),
(162, 22, 30, 3, 1437625171, 1437625171),
(163, 22, 31, 10, 1437625352, 1437625352),
(164, 0, 30, 3, 1437625171, 1437625171);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_goods`
--

CREATE TABLE IF NOT EXISTS `tbl_goods` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `hs_code` varchar(60) NOT NULL COMMENT '商品编号',
  `shop_id` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '所属商店',
  `goods_name` varchar(300) NOT NULL DEFAULT '' COMMENT '商品名称描述',
  `goods_info` varchar(255) NOT NULL COMMENT '商品描述',
  `type_big` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类大类ID',
  `type_small` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类小类ID',
  `goods_show` varchar(2000) NOT NULL DEFAULT '' COMMENT '商品展示图',
  `index_pic` varchar(1500) NOT NULL COMMENT '图片路径',
  `goods_content` text NOT NULL COMMENT '商品详细内容',
  `sel_food` text NOT NULL COMMENT '食材选择',
  `goods_num` int(60) NOT NULL DEFAULT '0' COMMENT '商品数量',
  `price_market` float unsigned NOT NULL DEFAULT '0' COMMENT '市场价',
  `price_vip` float unsigned NOT NULL DEFAULT '0' COMMENT '会员价',
  `spec` varchar(255) NOT NULL COMMENT '商品规格',
  `origin` varchar(60) NOT NULL COMMENT '产地',
  `storage` varchar(60) NOT NULL COMMENT '储存方式',
  `carry` varchar(60) NOT NULL COMMENT '配送方式',
  `sort` int(5) NOT NULL DEFAULT '0' COMMENT '排序大小',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1正常、0停止 删除-1',
  `is_hot` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态：1热门、0不热门',
  `is_recommend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态：1推荐、0不推荐',
  `sold` int(6) NOT NULL DEFAULT '0' COMMENT '已售数量',
  `color` tinyint(5) NOT NULL COMMENT '颜色id',
  `pc_url` varchar(60) NOT NULL COMMENT '电脑站演示url',
  `phone_url` varchar(60) NOT NULL COMMENT '手机站演示',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品表' AUTO_INCREMENT=37 ;

--
-- 转存表中的数据 `tbl_goods`
--

INSERT INTO `tbl_goods` (`id`, `hs_code`, `shop_id`, `goods_name`, `goods_info`, `type_big`, `type_small`, `goods_show`, `index_pic`, `goods_content`, `sel_food`, `goods_num`, `price_market`, `price_vip`, `spec`, `origin`, `storage`, `carry`, `sort`, `status`, `is_hot`, `is_recommend`, `sold`, `color`, `pc_url`, `phone_url`, `create_time`, `update_time`) VALUES
(30, 'MSB001', 1, '蟹味菇烧冬瓜', '鲜香味美不长肉', 8, 0, '<p><img src="/ueditor/php/upload/image/20150624/1435137614759941.jpg" title="1435137614759941.jpg" alt="dg.jpg"/></p>', '|/ueditor/php/upload/image/20150624/1435137614759941.jpg', '<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);">据说冬瓜含有一种预防肥胖的元素，很适合瘦身中的妹子享用，但是单纯的冬瓜，却难免寡淡，于是配上好吃的蟹味菇，口感立即变得丰富起来。而且这道不长肉的全素菜吃起来竟然有肉菜般大快朵颐的赶脚。</p><p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);"><span style="box-sizing: inherit; color: rgb(255, 0, 0);"><strong style="box-sizing: inherit;">菜君曰：祈求上帝，如果实在不能瘦，那就请让我好吃好喝不长肉~</strong></span></p><p><br/></p>', '<p><img src="/ueditor/php/upload/image/20150624/1435137271772764.jpg" title="1435137271772764.jpg" alt="shicaibaozheng.jpg"/></p>', 100, 15, 12, '430g', '成都', '冷藏', '自提', 0, 1, 0, 1, 100, 0, '', '', 1435137469, 1435137618),
(31, 'MSB002', 1, '白灼芥兰', '盛夏去火小鲜菜', 9, 0, '<p><img alt="C191cp-250x250.jpg" src="/ueditor/php/upload/image/20150624/1435138610102174.jpg" title="1435138610102174.jpg"/></p>', '|/ueditor/php/upload/image/20150624/1435138610102174.jpg', '<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);">芥兰，花叶肥嫩，口感清爽，咀嚼起来爽而不硬，脆而不韧，而白灼的制法，更是将其鲜嫩感做了最好的保留。经常食用，可润肠去火，降低血糖，是最佳的夏季家常小鲜菜。</p><p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);"><span style="box-sizing: inherit; color: rgb(255, 0, 0);"><strong style="box-sizing: inherit;">菜君曰：对于天生丽质来说，化妆神马都是浮云；对于清新爽口来说，爆油调料那也是多余，天生好吃，就是这么骄傲。</strong></span></p><p><br/></p>', '<p><img src="/ueditor/php/upload/image/20150624/1435138155132133.jpg" title="1435138155132133.jpg" alt="shicaibaozheng.jpg"/></p>', 100, 15, 12, '415g', '成都', '冷藏', '自提', 0, 1, 0, 1, 0, 0, '', '', 1435138315, 1435138613),
(32, 'MSB003', 1, '海米烧蒲瓜 ', '夏日鲜甜小炒', 9, 0, '<p><img alt="C179cp-250x250.jpg" src="/ueditor/php/upload/image/20150624/1435138751366200.jpg" title="1435138751366200.jpg"/></p>', '|/ueditor/php/upload/image/20150624/1435138751366200.jpg', '<p>\r\n	我国自古有夏食蒲瓜的传统，其能清心热、润<a href="http://baike.sogou.com/lemma/ShowInnerLink.htm?lemmaId=69645149&ss_c=ssc.citiao.link" target="http://baike.sogou.com/_blank">心肺</a>、除烦渴，极具食用价值，而与新鲜海米并炒，清淡中便从此带了些许鲜甜之感，令人食之不厌。</p><p><br/></p><p><br/></p>', '<p>\r\n	我国自古有夏食蒲瓜的传统，其能清心热、润<a href="http://baike.sogou.com/lemma/ShowInnerLink.htm?lemmaId=69645149&ss_c=ssc.citiao.link" target="http://baike.sogou.com/_blank">心肺</a>、除烦渴，极具食用价值，而与新鲜海米并炒，清淡中便从此带了些许鲜甜之感，令人食之不厌。</p><p><br/></p><br/><p><br/></p>', 100, 16, 14, '455g', '北京', '冷藏', '自提', 0, 1, 0, 1, 100, 0, '', '', 1435138798, 1435138798),
(33, 'MSB004', 1, '私房板栗三杯鸡', '传统名菜 滋补升级版', 10, 0, '<p><img src="/ueditor/php/upload/image/20150624/1435139412299501.jpg" alt="1435139412299501.jpg"/></p>', '|/ueditor/php/upload/image/20150624/1435139412299501.jpg', '<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);">三杯鸡本是江西传统名菜，以其制作过程不加水，而用三杯特殊调料烹饪而得名。这道私房菜品，额外加入优质燕山板栗，酱汁深情拥抱鸡肉和栗仁，入口醇香软糯，滋补功效也不容小觑哦~~</p><p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);"><span style="box-sizing: inherit; color: rgb(105, 105, 105);">肉类原料已经预先腌制。调料有：东古一品鲜、美极鲜、白糖、陈醋、鸡精。</span></p><p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);"><strong style="box-sizing: inherit;"><span style="box-sizing: inherit; color: rgb(165, 42, 42);">菜君曰：“生活中不缺少美，而是缺少发现美的嘴巴。”</span></strong></p><p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);"><span style="box-sizing: inherit; color: rgb(221, 75, 57); font-size: 14px;"><span style="box-sizing: inherit; color: rgb(0, 100, 0);">烹饪方式获取方法：微信关注青年菜君，在对话框中直接回复想要烹饪的菜品名，如松仁玉米您直接回复srym(小写)或者菜品名（松仁玉米）即可！</span></span></p><p><br/></p>', '<p><img src="/ueditor/php/upload/image/20150624/1435137271772764.jpg" alt="1435137271772764.jpg"/></p>', 100, 25, 18, '370g', '成都', '冷藏', '自提', 0, 1, 0, 1, 100, 0, '', '', 1435139348, 1435139544),
(34, '234', 1, '阿斯蒂芬', '', 7, 0, '<p><img src="/ueditor/php/upload/image/20150624/1435139412299501.jpg" title="1435139412299501.jpg" alt="blj.jpg"/></p>', '|/ueditor/php/upload/image/20150624/1435139412299501.jpg', '<p>实得分</p>', '<p><img src="/ueditor/php/upload/image/20150624/1435138155132133.jpg" alt="1435138155132133.jpg"/></p>', 100, 23, 12, '12', '12', '', '', 0, 0, 0, 0, 100, 0, '', '', 1435139437, 1435139437),
(35, 'MSB005', 1, '肉末酸豆角', '酸爽下饭菜', 7, 0, '<p><img src="/ueditor/php/upload/image/20150625/1435212906878881.jpg" title="1435212906878881.jpg" alt="dj.jpg"/></p>', '|/ueditor/php/upload/image/20150625/1435212906878881.jpg', '<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);">经腌制过的豆角，其味鲜、香、嫩、脆，既可以单独食用，又是炒、煮、烤、炖的上佳配菜。尤其和肉末混炒，食之酸辣适口，爽脆滑嫩，是湘菜系中超级能下饭的一道。</p><p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);">&nbsp;</p><p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);"><span style="box-sizing: inherit; color: rgb(255, 0, 0);"><strong style="box-sizing: inherit;">菜君曰：上帝说”人孤独不好“，妈说”光吃米饭不好“，得吃点酸爽下饭菜。</strong></span></p><p><br/></p>', '<p><img src="/ueditor/php/upload/image/20150624/1435137271772764.jpg"/><br/></p><p><br/></p>', 100, 15, 12, '410g', '成都', '冷藏', '自提', 0, 1, 0, 1, 100, 0, '', '', 1435212934, 1435212934),
(36, 'MSB006', 1, '穿心莲冬瓜汤', '居家消夏推荐汤', 15, 0, '<p><img src="/ueditor/php/upload/image/20150625/1435213166599863.jpg" title="1435213166599863.jpg" alt="dgt.jpg"/></p>', '|/ueditor/php/upload/image/20150625/1435213166599863.jpg', '<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);">冬瓜味淡，熬汤能去暑。穿心莲味苦，熬汤能解毒凉血，亦能去热，与苦瓜有异曲同工之妙。然二者并而煮之，珠联璧合，得兼二美，其清凉之功能胜绿豆，其口感之效果亦远胜之。</p><p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 15px; color: rgb(34, 24, 21); font-family: &#39;microsoft yahei&#39;, 宋体, Arial, Helvetica, sans-serif; line-height: 20px; white-space: normal; background-color: rgb(255, 255, 255);"><br style="box-sizing: inherit;"/><span style="box-sizing: inherit; color: rgb(255, 0, 0);"><strong style="box-sizing: inherit;">菜君曰：冬瓜和穿心莲的相爱，只是一场意外，经过小火熬煮，这道清口汤味道当真不坏。</strong></span></p><p><br/></p>', '<p><img alt="foodGuarantee.png" src="/ueditor/php/upload/image/20150702/1435804118109016.png" title="1435804118109016.png"/></p>', 100, 1, 0.01, '360g', '成都', '冷藏', '自提', 0, 1, 0, 1, 100, 0, '', '', 1435213190, 1435804126);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_goods_color`
--

CREATE TABLE IF NOT EXISTS `tbl_goods_color` (
  `id` int(60) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `sort` tinyint(2) NOT NULL COMMENT '排列顺序',
  `status` tinyint(2) DEFAULT '1' COMMENT '-1删除 0禁用 1启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `tbl_goods_color`
--

INSERT INTO `tbl_goods_color` (`id`, `name`, `sort`, `status`) VALUES
(1, '无', 0, 1),
(2, '红色系', 0, 1),
(3, '紫色系', 0, 1),
(4, '黄色系', 0, 1),
(5, '绿色系', 0, 1),
(6, '蓝色系', 0, 1),
(7, '黑白灰色系', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_goods_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_goods_comment` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL COMMENT '用户id',
  `goods_id` int(255) NOT NULL,
  `content` varchar(500) CHARACTER SET utf8mb4 NOT NULL COMMENT '评论内容',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '评论时间',
  `sort` int(255) NOT NULL COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '-1删除 0禁用 1启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `tbl_goods_comment`
--

INSERT INTO `tbl_goods_comment` (`id`, `user_id`, `goods_id`, `content`, `update_time`, `sort`, `status`) VALUES
(1, 1, 1, 'sdfsdfsdf', 0, 0, 0),
(2, 1, 2, 'dfgdfg', 1, 1, 0),
(3, 1, 2, 'ertert', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_goods_type_big`
--

CREATE TABLE IF NOT EXISTS `tbl_goods_type_big` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `type_name` varchar(20) DEFAULT '' COMMENT '分类名称',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序、后置',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1正常、0停止',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品分类大类表' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `tbl_goods_type_big`
--

INSERT INTO `tbl_goods_type_big` (`id`, `type_name`, `sort`, `status`) VALUES
(7, '荤素', 2, 1),
(8, '清热去火', 5, 1),
(9, '素菜', 4, 1),
(10, '肉菜', 1, 1),
(11, 'sd', 0, -1),
(12, '汤类', 0, -1),
(13, '粥类', 0, -1),
(14, '素菜', 0, -1),
(15, '汤羹', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_goods_type_small`
--

CREATE TABLE IF NOT EXISTS `tbl_goods_type_small` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `type_small` bigint(15) unsigned NOT NULL COMMENT '商品分类大类ID',
  `type_name` varchar(20) DEFAULT '' COMMENT '分类名称',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序、后置',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1正常、0停止、-1删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品分类小类表' AUTO_INCREMENT=46 ;

--
-- 转存表中的数据 `tbl_goods_type_small`
--

INSERT INTO `tbl_goods_type_small` (`id`, `type_small`, `type_name`, `sort`, `status`) VALUES
(45, 5, '干锅', 1, -1);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_link`
--

CREATE TABLE IF NOT EXISTS `tbl_link` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `link_name` varchar(60) NOT NULL DEFAULT '0' COMMENT '链接名称',
  `link_url` varchar(300) NOT NULL DEFAULT '' COMMENT '链接url',
  `link_logo` varchar(1000) NOT NULL DEFAULT '' COMMENT '链接图片',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1正常、0停止',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序、后置',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='友情链接表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `tbl_link`
--

INSERT INTO `tbl_link` (`id`, `link_name`, `link_url`, `link_logo`, `status`, `sort`, `create_time`, `update_time`) VALUES
(1, '全友家私', 'http://www.baidu.com', '<p><img alt="flag.png" src="/ueditor/php/upload/image/20150518/1431918610103616.png" title="1431918610103616.png"/></p>', 1, 2, 1431918695, 1431919857),
(2, '百度', 'http://www.baidu.com', '<p><img style="width: 119px; height: 98px;" alt="common1.png" src="/ueditor/php/upload/image/20150518/1431919939129224.png" title="1431919939129224.png" height="98" width="119"/></p>', 1, 4, 1431919949, 0),
(3, '阿士大夫', 'http://www.baidu.com', '<p><img style="width: 125px; height: 96px;" alt="common2.png" src="/ueditor/php/upload/image/20150518/1431920166505623.png" title="1431920166505623.png" height="96" width="125"/></p>', 1, 5, 1431920739, 0),
(4, '百度123re', 'http://www.123.com', '<p><img alt="logo.png" src="/ueditor/php/upload/image/20150602/1433214637731497.png" title="1433214637731497.png"/></p>', 1, 3, 1433214642, 1433214678),
(5, '百度12354607', 'http://www.123.com', '<p><img alt="logo.png" src="/ueditor/php/upload/image/20150602/1433214637731497.png" title="1433214637731497.png"/></p>', 1, 3, 1433214650, 1433217727),
(6, '2334234', 'http://www.baidu.com', '<p><img style="width: 768px; height: 511px;" alt="bg-header-blue.png" src="/ueditor/php/upload/image/20150602/1433214803801294.png" title="1433214803801294.png" height="511" width="768"/></p>', 1, 4, 1433214825, 0),
(7, '567567', 'http://www.baidu.com', '<p><img alt="logo.png" src="/ueditor/php/upload/image/20150602/1433214898138515.png" title="1433214898138515.png"/></p>', 1, 7, 1433214902, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_news`
--

CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `news_title` varchar(30) NOT NULL DEFAULT '' COMMENT '文章标题',
  `news_type_id` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '文章分类',
  `news_summary` varchar(500) NOT NULL DEFAULT '' COMMENT '文章概要',
  `news_author` varchar(10) NOT NULL DEFAULT '' COMMENT '文章作者',
  `news_content` text NOT NULL COMMENT '文章内容',
  `index_pic` varchar(300) NOT NULL COMMENT '图片路径',
  `news_image` varchar(500) NOT NULL,
  `read_count` int(8) NOT NULL DEFAULT '0' COMMENT '点击数',
  `is_top` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态：1置顶、0普通',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序、后置',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示、0隐藏、-1删除',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '建立时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文章表' AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `news_title`, `news_type_id`, `news_summary`, `news_author`, `news_content`, `index_pic`, `news_image`, `read_count`, `is_top`, `sort`, `status`, `create_time`, `update_time`) VALUES
(24, '网站订购流程', 4, '夏季葱茏斑驳', 'admin', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	<img style="width: 908px; height: 452px;" src="/ueditor/php/upload/image/20150602/1433214803801294.png" height="452" width="908" alt="1433214803801294.png"/>\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;夏季葱茏斑驳，满眼的绿色覆盖尘世的纷扰，一场夏日里猝不及防的夜雨，会洗涤所有的疲惫与无奈。夏日里的烦躁和不安，会伴着一场夜雨的降临，烟消云散。每\n个季节都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适\n的理由，来抚慰自己，怕伤心，更怕对一切失去信心。\n\n这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动\n墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安\n然，抛开生活的压力，允许我享受此刻这般的惬意。\n\n在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着\n还是悲伤着，都喜欢用她来表达内心的那份情感。时间长了，偶尔读来，都是一种无言的享受。\n &nbsp; &nbsp;夏季葱茏斑驳，满眼的绿色覆盖尘世的纷扰，一场夏日里猝不及防的夜雨，会洗涤所有的疲惫与无奈。夏日里的烦躁和不安，会伴着一场夜雨的降临，烟消云散。每\n个季节都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适\n的理由，来抚慰自己，怕伤心，更怕对一切失去信心。\n\n这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动\n墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安\n然，抛开生活的压力，允许我享受此刻这般的惬意。\n\n在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着\n还是悲伤着，都喜欢用她来表达内心的那份情感。时间长了，偶尔读来，都是一种无言的享受。&nbsp; <br/>夏季葱茏斑驳，满眼的绿色覆盖尘世的纷扰，一场夏日里猝不及防的夜雨，会洗涤所有的疲惫与无奈。夏日里的烦躁和不安，会伴着一场夜雨的降临，烟消云散。每\n个季节都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适\n的理由，来抚慰自己，怕伤心，更怕对一切失去信心。\n\n这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动\n墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安\n然，抛开生活的压力，允许我享受此刻这般的惬意。\n\n在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着\n还是悲伤着，都喜欢用她来表达内心的那份情感。时间长了，偶尔读来，都是一种无言的享受。&nbsp; <br/> &nbsp; &nbsp; &nbsp;&nbsp; <br/></p><p><br/></p>', '/ueditor/php/upload/image/20150602/1433214803801294.png', '', 0, 0, 1, 1, 1433991856, 1434523560),
(25, '支付方式', 2, '都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适的理由，来抚慰自己，怕伤心，更怕对一切失去信心。 这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安然，抛开生活的压力，允许我享受此刻这般的惬意。 在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着还是悲伤着，都喜欢', 'admin', '<p>都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适的理\r\n由，来抚慰自己，怕伤心，更怕对一切失去信心。\r\n\r\n这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动\r\n墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安\r\n然，抛开生活的压力，允许我享受此刻这般的惬意。\r\n\r\n在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着\r\n还是悲伤着，都喜欢</p>', '', '', 0, 0, 2, 1, 1433991911, 1433991911),
(26, '退订退款', 2, '都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适的理由，来抚慰自己，怕伤心，更怕对一切失去信心。 这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安然，抛开生活的压力，允许我享受此刻这般的惬意。 在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着还是悲伤着，都喜欢', 'admin', '<p>都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适的理\r\n由，来抚慰自己，怕伤心，更怕对一切失去信心。\r\n\r\n这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动\r\n墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安\r\n然，抛开生活的压力，允许我享受此刻这般的惬意。\r\n\r\n在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着\r\n还是悲伤着，都喜欢</p>', '', '', 0, 0, 0, 1, 1433991935, 1433991935),
(27, '配送时间/配送方式', 19, '都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适的理由，来抚慰自己，怕伤心，更怕对一切失去信心。 这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安然，抛开生活的压力，允许我享受此刻这般的惬意。 在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着还是悲伤着，都喜欢', 'admin', '<p>都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适的理\r\n由，来抚慰自己，怕伤心，更怕对一切失去信心。\r\n\r\n这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动\r\n墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安\r\n然，抛开生活的压力，允许我享受此刻这般的惬意。\r\n\r\n在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着\r\n还是悲伤着，都喜欢</p>', '', '', 0, 0, 0, 1, 1433991966, 1433991966),
(28, '取货自提地址', 19, '都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适的理由，来抚慰自己，怕伤心，更怕对一切失去信心。 这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安然，抛开生活的压力，允许我享受此刻这般的惬意。 在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着还是悲伤着，都喜欢', 'admin', '<p>都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适的理\r\n由，来抚慰自己，怕伤心，更怕对一切失去信心。\r\n\r\n这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动\r\n墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安\r\n然，抛开生活的压力，允许我享受此刻这般的惬意。\r\n\r\n在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着\r\n还是悲伤着，都喜欢</p>', '', '', 0, 0, 0, 1, 1433991988, 1433992061),
(29, '关于美食帮', 3, '都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适的理由，来抚慰自己，怕伤心，更怕对一切失去信心。 这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安然，抛开生活的压力，允许我享受此刻这般的惬意。 在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着还是悲伤着，都喜欢', 'admin', '<p>2都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适的理\r\n由，来抚慰自己，怕伤心，更怕对一切失去信心。\r\n\r\n这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动\r\n墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安\r\n然，抛开生活的压力，允许我享受此刻这般的惬意。\r\n\r\n在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着\r\n还是悲伤着，都喜欢<img src="/ueditor/php/upload/image/20150604/1433400997776121.jpg" alt="1433400997776121.jpg"/></p>', '/ueditor/php/upload/image/20150604/1433400997776121.jpg', '', 0, 0, 0, 1, 1433992012, 1434523388),
(30, '联系我们', 21, '都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适的理由，来抚慰自己，怕伤心，更怕对一切失去信心。 这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安然，抛开生活的压力，允许我享受此刻这般的惬意。 在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着还是悲伤着，都喜欢', 'admin', '<p>1都不是十全十美的好，春有春的缺点，夏有夏的瑕疵，秋有秋的不足，冬有冬的不好，像人一样，没有十全十美的。我总是喜欢把所有的遗憾，找一个最合适的理\r\n由，来抚慰自己，怕伤心，更怕对一切失去信心。\r\n\r\n这个夏季是寂静的。今年的夏日没有往年的燥热，更没有往年的令人烦躁不安。喜欢这样的寂静，躺在床上，闭上眼睛养神，打开窗户，让清风吹拂进来，听她吹动\r\n墙上挂画的声音，听她吹动书页刷刷的声音。如此这般的美好，如此这般的惬意，打开音乐，优美的旋律伴着清风在这份寂静里袅袅升起。人生，难得这般舒适安\r\n然，抛开生活的压力，允许我享受此刻这般的惬意。\r\n\r\n在脑海里组织我要的话语，生怕这样的舒适会让我忘记文字的魔力，然而我想错了，文字不会随着一份安然离去。笔下的文字也好像成了我唯一的乐趣，不管快乐着\r\n还是悲伤着，都喜欢</p>', '', '', 0, 0, 0, 1, 1433992028, 1434523342),
(31, '娃儿', 21, '阿斯蒂芬', '', '<p>阿斯蒂芬</p>', '', '', 0, 0, 0, -1, 1434522869, 1434522869),
(32, '的施工方', 2, '', '', '<p>阿斯蒂芬</p>', '', '', 0, 0, 0, -1, 1434523141, 1434523141),
(33, '符合', 2, '', '', '<p>的规划</p>', '', '', 0, 0, 0, -1, 1434523159, 1434523159),
(34, '大发光火', 2, '', '', '<p>大发光火</p>', '', '', 0, 0, 0, -1, 1434523168, 1434523168),
(35, '酱香回锅肉做法', 27, '川菜里的回锅肉，是我比较喜欢的一个菜，去十家菜馆，有十种做法，味道各有特色。据说四川人家家都得会做回锅肉，作为一道传统的川菜，可见它的地位非同一般。今天我也来做一下这道经典的川菜，用的是传统的做法。', 'admin', '<ul class=" list-paddingleft-2" style="list-style-type: none;"><li><p>原料：五花肉，也可以用猪后臀肉俗称二刀肉。</p></li><li><p><img src="http://i3.meishichina.com/attachment/recipe/201106/p320_201106141053103.jpg" alt="回锅肉的做法步骤：2" style="margin: 0px; padding: 0px; border: 0px; vertical-align: middle; width: 220px; background: url(http://static.meishichina.com/v6/img/placeholder-88-31.png) 50% 50% no-repeat scroll rgb(242, 242, 242);"/></p><p><span class="Apple-converted-space">&nbsp;</span></p></li><li><p>原料：青红椒，青蒜，豆豉，郫县豆瓣酱。</p></li><li><p><img src="http://i3.meishichina.com/attachment/recipe/201106/p320_201106141054512.jpg" alt="回锅肉的做法步骤：3" style="margin: 0px; padding: 0px; border: 0px; vertical-align: middle; width: 220px; background: url(http://static.meishichina.com/v6/img/placeholder-88-31.png) 50% 50% no-repeat scroll rgb(242, 242, 242);"/></p><p><span class="Apple-converted-space">&nbsp;</span></p></li><li><p>冷水下肉，大火烧开，煮至肉刚熟即可，待肉凉后切成薄片。</p></li><li><p><img src="http://i3.meishichina.com/attachment/recipe/201106/p320_201106141055476.jpg" alt="回锅肉的做法步骤：4" style="margin: 0px; padding: 0px; border: 0px; vertical-align: middle; width: 220px; background: url(http://static.meishichina.com/v6/img/placeholder-88-31.png) 50% 50% no-repeat scroll rgb(242, 242, 242);"/></p><p><span class="Apple-converted-space">&nbsp;</span></p></li><li><p>冷水下肉，大火烧开，煮至肉刚熟即可（用筷子可以穿透不渗血水），待肉凉后切成薄片。</p></li><li><p><img src="http://i3.meishichina.com/attachment/recipe/201106/p320_201106141100148.jpg" alt="回锅肉的做法步骤：5" style="margin: 0px; padding: 0px; border: 0px; vertical-align: middle; width: 220px; background: url(http://static.meishichina.com/v6/img/placeholder-88-31.png) 50% 50% no-repeat scroll rgb(242, 242, 242);"/></p><p><span class="Apple-converted-space">&nbsp;</span></p></li><li><p>起油锅，下肉片煸炒。</p></li><li><p><img src="http://i3.meishichina.com/attachment/recipe/201106/p320_201106141100433.jpg" alt="回锅肉的做法步骤：6" style="margin: 0px; padding: 0px; border: 0px; vertical-align: middle; width: 220px; background: url(http://static.meishichina.com/v6/img/placeholder-88-31.png) 50% 50% no-repeat scroll rgb(242, 242, 242);"/></p><p><span class="Apple-converted-space">&nbsp;</span></p></li><li><p>待肉片出油有点卷的时候，下郫县豆瓣酱炒匀</p></li><li><p><img src="http://i3.meishichina.com/attachment/recipe/201106/p320_201106141101110.jpg" alt="回锅肉的做法步骤：7" style="margin: 0px; padding: 0px; border: 0px; vertical-align: middle; width: 220px; background: url(http://static.meishichina.com/v6/img/placeholder-88-31.png) 50% 50% no-repeat scroll rgb(242, 242, 242);"/></p><p><span class="Apple-converted-space">&nbsp;</span></p></li><li><p>再加入切碎的豆豉炒香。</p></li><li><p><img src="http://i3.meishichina.com/attachment/recipe/201106/p320_201106141101470.jpg" alt="回锅肉的做法步骤：8" style="margin: 0px; padding: 0px; border: 0px; vertical-align: middle; width: 220px; background: url(http://static.meishichina.com/v6/img/placeholder-88-31.png) 50% 50% no-repeat scroll rgb(242, 242, 242);"/></p><p><span class="Apple-converted-space">&nbsp;</span></p></li><li><p>加入青红椒，炒至断青</p></li><li><p><img src="http://i3.meishichina.com/attachment/recipe/201106/p320_201106141102387.jpg" alt="回锅肉的做法步骤：9" style="margin: 0px; padding: 0px; border: 0px; vertical-align: middle; width: 220px; background: url(http://static.meishichina.com/v6/img/placeholder-88-31.png) 50% 50% no-repeat scroll rgb(242, 242, 242);"/></p><p><span class="Apple-converted-space">&nbsp;</span></p></li><li><p>最后，加入青蒜炒出香味。</p></li><li><p><img src="http://i3.meishichina.com/attachment/recipe/201106/p320_201106141103067.jpg" alt="回锅肉的做法步骤：10" style="margin: 0px; padding: 0px; border: 0px; vertical-align: middle; width: 220px; background: url(http://static.meishichina.com/v6/img/placeholder-88-31.png) 50% 50% no-repeat scroll rgb(242, 242, 242);"/></p><p><span class="Apple-converted-space">&nbsp;</span></p></li><li><p>最后，再加入糖，鸡精调味就可以出锅了。</p></li></ul><p><br/></p>', 'http://i3.meishichina.com/attachment/recipe/201106/p320_201106141053103.jpg', '', 0, 0, 3, 1, 1437203633, 1437719941);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_news_type`
--

CREATE TABLE IF NOT EXISTS `tbl_news_type` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `type_name` varchar(20) DEFAULT '' COMMENT '分类名称',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序、后置',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1正常、0停止、-1删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文章分类表' AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `tbl_news_type`
--

INSERT INTO `tbl_news_type` (`id`, `type_name`, `sort`, `status`) VALUES
(2, '支付说明', 5, 1),
(3, '关于我们', 3, 1),
(4, '操作指南', 6, 1),
(19, '配送取货', 4, 1),
(21, '联系我们', 2, 1),
(26, '未支付', 0, -1),
(27, '新闻资讯', 0, 1),
(29, '热点新闻', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `shop_id` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '所属商店',
  `user_id` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `order_sn` varchar(60) NOT NULL DEFAULT '0' COMMENT '订单编号',
  `user_code` int(10) NOT NULL COMMENT '用户验证码',
  `exp_code` int(10) NOT NULL COMMENT '快递验证码',
  `express_id` int(60) NOT NULL COMMENT '快递员id',
  `cbox_id` varchar(225) NOT NULL COMMENT '箱子id',
  `put_time` int(10) NOT NULL COMMENT '自提时间',
  `put_address` int(60) NOT NULL COMMENT '自提点id',
  `express_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '快递编号',
  `goods_id` varchar(60) NOT NULL COMMENT '商品ID',
  `goods_num` varchar(60) NOT NULL COMMENT '商品数量',
  `price_vip` varchar(60) NOT NULL COMMENT '商品单价',
  `price_all` float unsigned NOT NULL DEFAULT '0' COMMENT '订单总价',
  `price_discount` float unsigned NOT NULL DEFAULT '0' COMMENT '订单优惠价',
  `points` int(9) NOT NULL DEFAULT '0' COMMENT '消费积分',
  `remark` varchar(500) NOT NULL DEFAULT '' COMMENT '备注',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1下单、2用户取消、3商家取消、4已支付、5申请退款、6已发货、7到自提点、8已取货、9完成',
  `pay_type` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '1余额、2支付宝、',
  `trade_no` varchar(50) NOT NULL DEFAULT '' COMMENT '支付宝交易号',
  `bill_flag` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已结账、0待结账',
  `bill_order` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '每次账单记录',
  `delivery` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 未发货 1已发货',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '建立时间',
  `create_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '建立IP',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '建立时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单表' AUTO_INCREMENT=178 ;

--
-- 转存表中的数据 `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `shop_id`, `user_id`, `order_sn`, `user_code`, `exp_code`, `express_id`, `cbox_id`, `put_time`, `put_address`, `express_sn`, `goods_id`, `goods_num`, `price_vip`, `price_all`, `price_discount`, `points`, `remark`, `status`, `pay_type`, `trade_no`, `bill_flag`, `bill_order`, `delivery`, `create_time`, `create_ip`, `update_time`) VALUES
(122, 0, 22, 'E7020783524702', 814434104, 247775599, 0, '0', 1435894230, 2, '', '35,32,33,31', '1,1,2,1', '12,14,18,12', 74, 74, 0, '', 3, 0, '', 0, 0, 0, 1435807835, '', 1435807835),
(123, 0, 21, 'E7020789076219', 510428360, 762396174, 21, '0', 1435894287, 1, '', '35,36', '1,1', '12,0.01', 12.01, 12.01, 0, '', 3, 0, '', 0, 0, 0, 1435807890, '', 1435914851),
(124, 0, 21, 'E7020791109136', 878244954, 91332702, 21, '26', 1435894287, 1, '', '35,36', '1,1', '12,0.01', 12.01, 12.01, 0, '', 1, 0, '', 0, 0, 0, 1435807911, '', 1435807911),
(125, 0, 22, 'E7020800403967', 719276093, 39184862, 21, '0', 1435894230, 2, '', '35,32,33,31', '1,1,2,1', '12,14,18,12', 74, 74, 0, '', 1, 0, '', 0, 0, 0, 1435808004, '', 1435808004),
(126, 0, 22, 'E7021657175070', 704933576, 749344167, 21, '28', 1435902967, 1, '', '36', '1', '0.01', 0.01, 0.01, 0, '', 1, 0, '', 0, 0, 0, 1435816571, '', 1435816571),
(127, 0, 21, 'E7031243281604', 298759979, 814525176, 0, '0', 1435998818, 1, '', '36,32,33,35,30,31', '1,1,6,4,1,1', '0.01,14,18,12,12,12', 194.01, 164.01, 0, '', 3, 0, '', 0, 0, 0, 1435912432, '', 1435914354),
(128, 0, 21, 'E7031444414208', 711170226, 142704554, 0, '0', 0, 1, '', '35', '7', '12', 0, 0, 0, '', 6, 0, '', 1, 0, 0, 1435914444, '', 1435914444),
(129, 0, 21, 'E7073533116815', 198149400, 168327225, 0, '0', 1436321726, 1, '', '31,30', '1,1', '12,12', 24, 24, 0, '', 3, 0, '', 0, 0, 0, 1436235331, '', 1436235331),
(130, 0, 21, 'E7073536720822', 132137948, 208235293, 0, '0', 1436321763, 1, '', '31', '1', '12', 12, 12, 0, '', 3, 0, '', 0, 0, 0, 1436235367, '', 1436235367),
(131, 0, 21, 'E7073554062813', 465426015, 628828634, 0, '0', 1436321936, 1, '', '30,32', '1,1', '12,14', 26, 26, 0, '', 3, 0, '', 0, 0, 0, 1436235540, '', 1436235540),
(132, 0, 21, 'E7084417249057', 348535416, 490470069, 0, '0', 1436430568, 1, '', '36', '1', '0.01', 0.01, 0.01, 0, '', 3, 0, '', 0, 0, 0, 1436344172, '', 1436344172),
(133, 0, 21, 'E7084426026559', 125225876, 265860172, 0, '0', 1436430656, 1, '', '35', '1', '12', 12, 12, 0, '', 3, 0, '', 0, 0, 0, 1436344260, '', 1436344260),
(134, 0, 21, 'E7108869592223', 930282127, 922944762, 19, '0', 1436575093, 1, '', '31', '1', '12', 12, 12, 0, '', 6, 0, '', 1, 0, 0, 1436488695, '', 1437034751),
(135, 0, 21, 'E7101521267938', 65437031, 674959738, 19, '0', 1436601609, 1, '', '31', '1', '12', 12, 12, 0, '', 6, 0, '', 1, 0, 1, 1436515212, '', 1436519894),
(136, 0, 23, 'E7137884889761', 448227282, 881457446, 0, '0', 1436865245, 1, '', '33,32', '1,1', '18,14', 32, 32, 0, '', 6, 0, '', 0, 0, 0, 1436778848, '', 1436778861),
(137, 0, 23, 'E7137889132604', 409036228, 326220278, 0, '0', 1436865287, 1, '', '31,33', '1,1', '12,18', 30, 30, 0, '', 3, 0, '', 0, 0, 0, 1436778891, '', 1436778891),
(140, 0, 23, 'E7154843177876', 618066698, 778967538, 19, '0', 1437034804, 1, '', '31,30', '11,7', '12,12', 216, 216, 0, '', 6, 0, '', 0, 0, 0, 1436948431, '', 1437035717),
(143, 0, 23, 'E7188659888982', 881517388, 889121450, 0, '0', 1437272698, 1, '', '31,30,32', '1,5,7', '12,12,14', 170, 170, 0, '', 6, 0, '', 0, 0, 0, 1437186598, '', 1437186598),
(144, 0, 23, 'E7188693014477', 184170956, 144846917, 0, '0', 1437273326, 1, '', '30', '1', '12', 12, 12, 0, '', 6, 0, '', 0, 0, 0, 1437186930, '', 1437186930),
(145, 0, 23, 'E7188719377485', 354774890, 773186370, 0, '0', 1437273551, 3, '', '30', '1', '12', 12, 2, 0, '', 6, 0, '', 0, 0, 0, 1437187193, '', 1437187193),
(146, 0, 23, 'E7180020946230', 238758725, 462572719, 0, '0', 1437286603, 1, '', '31,30', '1,1', '12,12', 24, 24, 0, '', 6, 0, '', 0, 0, 0, 1437200209, '', 1437200209),
(147, 0, 23, 'E7180803049164', 582417, 491359853, 19, '0', 1437294427, 1, '', '31,33', '1,1', '12,18', 30, 30, 0, '', 6, 0, '', 0, 0, 0, 1437208030, '', 1437208030),
(148, 0, 23, 'E7180857413474', 453410, 134285975, 19, '0', 1437294971, 1, '', '31', '1', '12', 12, 12, 0, '', 4, 0, '', 0, 0, 0, 1437208574, '', 1437208574),
(149, 0, 23, 'E7205770201379', 26385, 13966990, 23, '0', 1437444096, 1, '', '31,30', '1,1', '12,12', 24, 0, 0, '', 9, 0, '', 0, 0, 0, 1437357702, '', 1437555640),
(150, 0, 23, 'E7206042920005', 702892, 200652044, 0, '0', 1437446824, 1, '', '36', '1', '0.01', 0.01, 0.01, 0, '', 3, 0, '', 0, 0, 0, 1437360429, '', 1437360429),
(151, 0, 23, 'E7206048012916', 683778, 128839368, 0, '0', 1437446876, 1, '', '35', '1', '12', 12, 12, 0, '', 3, 0, '', 0, 0, 0, 1437360480, '', 1437360480),
(152, 0, 23, 'E7206055013996', 648467, 139984626, 0, '0', 1437446946, 1, '', '31', '1', '12', 12, 12, 0, '', 3, 0, '', 0, 0, 0, 1437360550, '', 1437360550),
(153, 0, 23, 'E7206059321566', 417156, 215208203, 0, '0', 1437446990, 1, '', '32', '1', '14', 14, 14, 0, '', 3, 0, '', 0, 0, 0, 1437360593, '', 1437360593),
(154, 0, 23, 'E7206102518900', 745078, 189711997, 0, '0', 1437447421, 1, '', '31', '1', '12', 12, 12, 0, '', 3, 0, '', 0, 0, 0, 1437361025, '', 1437361025),
(155, 0, 23, 'E7206111035204', 255229, 352459860, 0, '0', 1437447421, 1, '', '31', '1', '12', 12, 12, 0, '', 3, 0, '', 0, 0, 0, 1437361110, '', 1437361110),
(156, 0, 23, 'E7206112354966', 24859, 549738271, 0, '0', 1437447520, 1, '', '32', '1', '14', 14, 14, 0, '', 3, 0, '', 0, 0, 0, 1437361123, '', 1437361123),
(157, 0, 23, 'E7208410096975', 164804, 959251023, 0, '', 1437470487, 1, '', '31', '4', '12', 48, 48, 0, '', 3, 0, '', 0, 0, 0, 1437384101, '', 1437384101),
(158, 0, 23, 'E7214601169148', 919983, 690835658, 0, '', 1437532158, 1, '', '31', '1', '12', 12, 12, 0, '', 3, 0, '', 0, 0, 0, 1437446011, '', 1437446011),
(159, 0, 23, 'E7214620997682', 161891, 976218731, 0, '', 1437532605, 1, '', '33', '1', '18', 18, 18, 0, '', 3, 0, '', 0, 0, 0, 1437446210, '', 1437446210),
(160, 0, 23, 'E7214630739539', 65829, 395713361, 0, '', 1437532703, 1, '', '33', '1', '18', 18, 18, 0, '', 3, 0, '', 0, 0, 0, 1437446307, '', 1437446307),
(161, 0, 23, 'E7214633045471', 686742, 454595154, 0, '', 1437532727, 1, '', '31', '1', '12', 12, 12, 0, '', 3, 0, '', 0, 0, 0, 1437446330, '', 1437446330),
(162, 0, 23, 'E7214697860478', 300419, 604736573, 0, '', 1437533375, 1, '', '31', '1', '12', 12, 12, 0, '', 3, 0, '', 0, 0, 0, 1437446978, '', 1437446978),
(163, 0, 23, 'E7214705665424', 443034, 654744731, 0, '', 1437533453, 1, '', '30', '1', '12', 12, 12, 0, '', 3, 0, '', 0, 0, 0, 1437447056, '', 1437447056),
(164, 0, 23, 'E7214709976071', 887789, 760269725, 0, '', 1437533496, 1, '', '30', '1', '12', 12, 12, 0, '', 3, 0, '', 0, 0, 0, 1437447099, '', 1437447099),
(165, 0, 23, 'E7216418264379', 380373, 605118137, 0, '', 1437550568, 1, '', '30', '1', '12', 12, 12, 0, '', 3, 0, '', 0, 0, 0, 1437464182, '', 1437464182),
(166, 0, 23, 'E7216599174727', 443148, 747141684, 0, '', 1437552376, 1, '', '31,30,32', '1,1,1', '12,12,14', 38, 38, 0, '', 3, 0, '', 0, 0, 0, 1437465991, '', 1437465991),
(167, 0, 23, 'E7216784406822', 248602, 68249324, 23, '', 1437554239, 1, '', '30,31,32,35,36,33', '1,1,1,1,1,1', '12,12,14,12,0.01,18', 68.01, 68.01, 0, '', 6, 0, '', 0, 0, 0, 1437467844, '', 1437467844),
(168, 0, 23, 'E7223652378171', 962265, 765708851, 0, '', 1437622919, 1, '', '31,30', '1,5', '12,12', 72, 72, 0, '', 2, 0, '', 0, 0, 0, 1437536523, '', 1437623225),
(169, 0, 23, 'E7232988764516', 326776, 619748989, 0, '', 1437713689, 1, '', '30,31', '1,10', '12,12', 132, 132, 0, '', 2, 0, '', 0, 0, 0, 1437629887, '', 1437984434),
(170, 0, 23, 'E7276651925919', 19532, 258179179, 0, '', 1438052913, 1, '', '31', '4', '12', 48, 48, 0, '', 2, 0, '', 0, 0, 0, 1437966519, '', 1437984431),
(171, 0, 23, 'E7279006563597', 77015, 634131956, 0, '', 1438076462, 1, '', '30', '1', '12', 12, 12, 0, '', 1, 0, '', 0, 0, 0, 1437990065, '', 1437990065),
(172, 0, 23, 'E7279007737464', 921492, 373972718, 0, '', 1438076473, 1, '', '30', '1', '12', 12, 12, 0, '', 1, 0, '', 0, 0, 0, 1437990077, '', 1437990077),
(173, 0, 23, 'E7279009687075', 110927, 870408736, 0, '', 1438076493, 1, '', '32', '1', '14', 14, 14, 0, '', 1, 0, '', 0, 0, 0, 1437990096, '', 1437990096),
(174, 0, 23, 'E7279010699533', 344041, 995733030, 0, '', 1438076504, 1, '', '31', '1', '12', 12, 12, 0, '', 1, 0, '', 0, 0, 0, 1437990107, '', 1437990107),
(175, 0, 23, 'E7285022501473', 228158, 14417123, 0, '', 1438136248, 1, '', '33', '1', '18', 18, 18, 0, '', 1, 0, '', 0, 0, 0, 1438050225, '', 1438050225),
(176, 0, 23, 'E7285185506296', 624306, 62590332, 19, '', 1438136635, 1, '', '36', '1', '0.01', 0.01, 0, 0, '', 6, 0, '', 0, 0, 0, 1438051855, '', 1438051855),
(177, 0, 23, 'E8126267786336', 135364, 862725526, 21, '', 1439449050, 1, '', '30,36', '1,7', '12,0.01', 12.07, 0, 0, '', 4, 0, '', 0, 0, 0, 1439362677, '', 1439362678);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_restaurant`
--

CREATE TABLE IF NOT EXISTS `tbl_restaurant` (
  `id` int(60) NOT NULL AUTO_INCREMENT,
  `area_small` int(60) NOT NULL COMMENT '商圈id',
  `address` varchar(255) NOT NULL COMMENT '详细地址',
  `express` varchar(255) NOT NULL COMMENT '快递员id',
  `express_id` int(60) NOT NULL COMMENT '当前快递员id',
  `cab_id` varchar(225) NOT NULL COMMENT '柜子id',
  `shop_time` varchar(255) NOT NULL COMMENT '营业时间',
  `contact` varchar(255) NOT NULL COMMENT '联系电话',
  `sort` int(60) NOT NULL COMMENT '排列顺序',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '-1删除 0禁用 1启用',
  `update_time` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `tbl_restaurant`
--

INSERT INTO `tbl_restaurant` (`id`, `area_small`, `address`, `express`, `express_id`, `cab_id`, `shop_time`, `contact`, `sort`, `status`, `update_time`) VALUES
(1, 1, '朝阳区建国路98号盛世嘉园B座地下一层 嘉嘉便利店', '19,21', 21, '1,2,3,4,21', '16:00 - 20:00', '400-882-1551', 3, 1, 1434695696),
(2, 2, '朝阳区建国路98号盛世嘉园B座地下一层久久便利店', '19', 0, '1,2', '8:00 - 19:00', '13695241528', 2, 1, 1435048206),
(3, 3, '成都市武侯区佳灵路红牌楼广场 黄焖鸡点', '19', 0, '1,2', '8：00 - 19:00', '13695241528', 4, 1, 1434079208),
(4, 13, '朝阳区建国路98号盛世嘉园B座地下一层 嘉嘉便利店', '19', 0, '1,2', '8：00 - 19:00', '13695241528', 2, 1, 1435048394),
(5, 15, '成都市武侯区佳灵路红牌楼广场 黄焖鸡点', '19', 0, '1,2', '12:00 - 15:00', '13212121212', 0, 1, 1437612877),
(6, 39, '四川省成都市青羊区清江东路12号', '19', 0, '1,2', '12-24', '13212121212', 0, 1, 1435734792);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_setting`
--

CREATE TABLE IF NOT EXISTS `tbl_setting` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `scope` varchar(30) NOT NULL DEFAULT '' COMMENT '范围',
  `variable` varchar(50) NOT NULL COMMENT '变量',
  `value` text COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统设置' AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `scope`, `variable`, `value`) VALUES
(1, 'web', 'web_status', '1'),
(2, 'web', 'web_close_say', '网站维护中，请耐心等待...'),
(3, 'web', 'web_icp', '京ICP证030173号'),
(4, 'web', 'web_copyright', 'Copyright @ 2014-20157'),
(5, 'seo', 'seo_title', '美食帮'),
(6, 'seo', 'seo_keywords', '网站建设,网站开发,网络推广'),
(7, 'seo', 'seo_describe', '成都大业互动是一家网络公司'),
(8, 'email', 'email_set', '0'),
(9, 'email', 'email_server', ''),
(10, 'email', 'email_port', ''),
(11, 'email', 'email_send_person', ''),
(12, 'email', 'email_account', ''),
(13, 'email', 'email_password', ''),
(14, 'sms', 'sms_set', '1'),
(15, 'sms', 'sms_account', 'cf_msb2015'),
(16, 'sms', 'sms_password', '123456678'),
(17, 'company', 'company_name', '成都大业互动网络科技有限公司'),
(18, 'company', 'company_address', ''),
(19, 'company', 'company_phone', ''),
(20, 'company', 'company_tel', ''),
(21, 'company', 'company_qq', ''),
(22, 'company', 'company_email', '123@qq.com'),
(23, 'company', 'company_time', '请用户在取菜时间的次日早上11点以前取走菜品，否则将会被回收，谢谢合作！'),
(24, 'company', 'company_notice1', '菜品暂时不支持退款退货，请谅解，后期将会提供此功能！'),
(25, 'company', 'company_notice2', '满200可及时配送上门');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_shop`
--

CREATE TABLE IF NOT EXISTS `tbl_shop` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `shop_code` int(9) NOT NULL DEFAULT '0' COMMENT '商家唯一码',
  `shop_account` varchar(20) DEFAULT '' COMMENT '登陆账号',
  `shop_password` varchar(50) DEFAULT '' COMMENT '登陆密码',
  `shop_name` varchar(50) NOT NULL DEFAULT '' COMMENT '商家名称',
  `group_rate` double unsigned NOT NULL DEFAULT '0' COMMENT '团购费率',
  `user_name` varchar(45) NOT NULL DEFAULT '' COMMENT '商家姓名(和身份证一致)',
  `type_big` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类大类ID',
  `type_small` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类小类ID',
  `area_big` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '城市表ID',
  `area_middle` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '城市分区表ID',
  `area_small` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT '城市分区分区表ID',
  `shop_x` varchar(10) DEFAULT '' COMMENT '商店纬度',
  `shop_y` varchar(10) DEFAULT '' COMMENT '商店经度',
  `shop_address` varchar(50) NOT NULL DEFAULT '' COMMENT '地址',
  `shop_logo` varchar(300) NOT NULL DEFAULT '' COMMENT '店标',
  `shop_about` varchar(500) DEFAULT '' COMMENT '店铺简介',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1正常、0停止',
  `shop_tel` varchar(100) DEFAULT '' COMMENT '联系电话1',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商家信息表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tbl_shop`
--

INSERT INTO `tbl_shop` (`id`, `shop_code`, `shop_account`, `shop_password`, `shop_name`, `group_rate`, `user_name`, `type_big`, `type_small`, `area_big`, `area_middle`, `area_small`, `shop_x`, `shop_y`, `shop_address`, `shop_logo`, `shop_about`, `status`, `shop_tel`, `create_time`, `update_time`) VALUES
(1, 0, '', '', '哈药六厂', 0, '', 0, 0, 0, 0, 0, '', '', '', '', '', 1, '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_account` varchar(30) NOT NULL DEFAULT '' COMMENT '用户账户',
  `user_password` varchar(64) NOT NULL DEFAULT '' COMMENT '用户密码',
  `set_password` varchar(60) NOT NULL,
  `group_id` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '权限分组 1为普通会员 2为邮递员',
  `user_nickname` varchar(20) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `user_phone` varchar(12) NOT NULL DEFAULT '' COMMENT '用户手机',
  `check_phone` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '手机号验证：0未验证、1已验证',
  `user_email` varchar(60) NOT NULL DEFAULT '' COMMENT '用户EMAIL',
  `check_email` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '邮箱验证：0未验证、1已验证',
  `user_name` varchar(10) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `activity` varchar(10) DEFAULT NULL COMMENT '推荐码',
  `activity_id` varchar(255) NOT NULL COMMENT '推荐id',
  `restaurant_id` varchar(255) NOT NULL COMMENT '快递员所属自提点id',
  `act_status` int(2) NOT NULL DEFAULT '0' COMMENT '0未买 1已买 3已领取',
  `user_sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '用户性别：0女、1男',
  `user_birthday` int(10) NOT NULL DEFAULT '0' COMMENT '用户生日',
  `user_qq` varchar(15) DEFAULT '' COMMENT '用户QQ',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户状态：0禁用、1正常',
  `user_country` varchar(20) NOT NULL DEFAULT '' COMMENT '用户国籍',
  `user_province` varchar(20) NOT NULL DEFAULT '' COMMENT '用户省份',
  `user_city` varchar(20) NOT NULL DEFAULT '' COMMENT '用户城市',
  `user_address` varchar(80) NOT NULL DEFAULT '' COMMENT '用户地址',
  `money` float unsigned NOT NULL DEFAULT '0' COMMENT '余额',
  `points` int(9) NOT NULL DEFAULT '0' COMMENT '积分',
  `user_logo` varchar(300) NOT NULL DEFAULT '' COMMENT '用户头像',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `create_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '注册IP',
  `last_time` int(10) NOT NULL DEFAULT '0' COMMENT '上一次登陆时间',
  `last_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '上一次登陆IP',
  `login_num` int(9) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `update_time` int(10) NOT NULL COMMENT '修改时间',
  `openid` varchar(64) NOT NULL DEFAULT '' COMMENT '微信openid',
  `attention_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '关注状态：1关注、0取消',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user_account`, `user_password`, `set_password`, `group_id`, `user_nickname`, `user_phone`, `check_phone`, `user_email`, `check_email`, `user_name`, `activity`, `activity_id`, `restaurant_id`, `act_status`, `user_sex`, `user_birthday`, `user_qq`, `status`, `user_country`, `user_province`, `user_city`, `user_address`, `money`, `points`, `user_logo`, `create_time`, `create_ip`, `last_time`, `last_ip`, `login_num`, `update_time`, `openid`, `attention_status`) VALUES
(19, '', '4297f44b13955235245b2497399d7a93', '123123', 2, '', '13281881250', 1, '', 0, '易中天', '95qhjaiz', '', ',1,2,5,6,4,3', 1, 0, 0, '', 1, '', '', '', '', 0, 0, '', 1435718118, '', 1435735543, '', 0, 1435718118, '', 1),
(21, '', '202cb962ac59075b964b07152d234b70', '123', 2, '', '13693412085', 1, '32424@qq.com', 0, 'xiaoxiao1', '2nj6fh9v', '', ',1', 1, 0, 0, '', 1, '', '', '', '', 0, 0, '', 1435729092, '', 1436751059, '', 0, 1435743888, '', 1),
(22, '', 'e10adc3949ba59abbe56e057f20f883e', '123456', 1, '', '13281881252', 1, '', 0, '刘德华', 'wgjxp3y2', '', '', 1, 0, 0, '', 1, '', '', '', '', 0, 0, '', 1435805439, '', 1435828873, '', 0, 1435828854, 'oNjFUs324-869v9qs0c8sleNr_40', 1),
(23, '', '202cb962ac59075b964b07152d234b70', '123', 2, '', '13693412081', 1, '', 0, 'dudan', '4wa88d4l', '', '', 1, 0, 0, '', 1, '', '', '', '', 27.92, 0, '', 1436772191, '', 1439343291, '', 0, 1437622323, 'oNjFUs324-869v9qs0c8sleNr_40', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_wx_api`
--

CREATE TABLE IF NOT EXISTS `tbl_wx_api` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `api_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是高级接口，1是，0不是',
  `appid` varchar(100) NOT NULL DEFAULT '' COMMENT '微信appid',
  `appsecret` varchar(100) NOT NULL DEFAULT '' COMMENT '微信AppSecret',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='微信api' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tbl_wx_api`
--

INSERT INTO `tbl_wx_api` (`id`, `api_type`, `appid`, `appsecret`) VALUES
(1, 0, 'wx31e39f2e9599239d', '151d4ce82018439802a9bebf2cf61adb');

DELIMITER $$
--
-- 事件
--
CREATE DEFINER=`root`@`localhost` EVENT `test` ON SCHEDULE EVERY 3 SECOND STARTS '2015-06-30 15:57:12' ON COMPLETION PRESERVE ENABLE DO INSERT INTO shop(id,update_time) VALUES('',NOW())$$

CREATE DEFINER=`root`@`localhost` EVENT `order_up` ON SCHEDULE EVERY 5 SECOND STARTS '2015-01-01 00:00:00' ENDS '2018-12-31 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO update tbl_order set status=3 where status=1 and create_time<unix_timestamp(now())-30*60$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
