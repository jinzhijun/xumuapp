-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 08 月 23 日 13:30
-- 服务器版本: 5.6.15-log
-- PHP 版本: 5.5.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `shijiao`
--

-- --------------------------------------------------------

--
-- 表的结构 `tp_accompany`
--

CREATE TABLE IF NOT EXISTS `tp_accompany` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `head` varchar(300) DEFAULT NULL COMMENT '头像',
  `sex` tinyint(2) unsigned DEFAULT '0' COMMENT '陪护人员性别 0：未知  1：男  2：女',
  `orders` int(11) unsigned DEFAULT '0' COMMENT '接单量',
  `complaintsnum` int(11) unsigned DEFAULT '0' COMMENT '客户投诉量',
  `state` int(2) unsigned DEFAULT '0' COMMENT '陪护人员状态 1上班空闲 2上班繁忙 0下班',
  `addtime` varchar(20) DEFAULT NULL COMMENT '陪护创建时间',
  `updatetime` varchar(20) DEFAULT NULL COMMENT '更改日期',
  `acc_id` varchar(20) DEFAULT NULL COMMENT '陪诊人员唯一标识',
  `responsivity` varchar(5) DEFAULT '0' COMMENT '响应率',
  `online` varchar(20) DEFAULT '0' COMMENT '在线时长',
  `evaluation` varchar(20) DEFAULT '0' COMMENT '评价',
  `name` varchar(20) NOT NULL COMMENT '陪护人姓名',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机号',
  `birthtime` varchar(20) DEFAULT NULL COMMENT '出生年月',
  `pwd` varchar(50) DEFAULT NULL COMMENT '陪诊人员登录密码',
  `time` varchar(20) DEFAULT NULL COMMENT '临时统计在线时间',
  `machine_id` varchar(50) DEFAULT NULL COMMENT '设备channalid',
  `machine_type` varchar(10) DEFAULT NULL COMMENT '设备类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='陪护人员表' AUTO_INCREMENT=53 ;

--
-- 转存表中的数据 `tp_accompany`
--

INSERT INTO `tp_accompany` (`id`, `head`, `sex`, `orders`, `complaintsnum`, `state`, `addtime`, `updatetime`, `acc_id`, `responsivity`, `online`, `evaluation`, `name`, `mobile`, `birthtime`, `pwd`, `time`, `machine_id`, `machine_type`) VALUES
(39, '/Uploads/2016-01-14/56970cbf42099.jpg', 1, 7, 0, 1, '1448939729', '1452476334', 'ceshi', '0', '57494', '0', '测试1', '18853813072', '1026489600', 'c3284d0f94606de1fd2af172aba15bf3', NULL, '5031161681953903209', 'ios'),
(49, '/Uploads/2016-01-19/569deb124019b.jpg', 2, 0, 0, 1, '1453096378', '1453104651', '15866898306', '0', '5', '0', '花花', '15866898306', '114883200', '14e1b600b1fd579f47433b88e8d85291', NULL, '4988999915320260783', 'ios'),
(50, '/Uploads/2016-01-20/569f29c100739.jpg', 0, 0, 0, 1, '1453096423', '1453096753', '14768906513', '0', '0', '0', '牛牛', '14768906513', '1453046400', '14e1b600b1fd579f47433b88e8d85291', NULL, '4306396571321180222', 'ios');

-- --------------------------------------------------------

--
-- 表的结构 `tp_accoperation`
--

CREATE TABLE IF NOT EXISTS `tp_accoperation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '陪诊服务操作id',
  `state` tinyint(2) unsigned DEFAULT '1' COMMENT '此方案是否有效 0无效 1有效',
  `order_id` int(11) unsigned DEFAULT NULL COMMENT '关联订单的id',
  `info_visit` varchar(255) DEFAULT NULL COMMENT '就诊信息',
  `info_diagnosis` varchar(255) DEFAULT NULL COMMENT '诊断信息',
  `illness` varchar(255) DEFAULT NULL COMMENT '基本病情',
  `memo` text COMMENT '备注',
  `price` text COMMENT '费用相关',
  `t_imgs` text COMMENT '文字图片',
  `p_imgs` text COMMENT '费用图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='实时陪诊详细操作表' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `tp_accoperation`
--

INSERT INTO `tp_accoperation` (`id`, `state`, `order_id`, `info_visit`, `info_diagnosis`, `illness`, `memo`, `price`, `t_imgs`, `p_imgs`) VALUES
(1, 1, 20, NULL, NULL, NULL, 'dfdsf', 'a:3:{i:4;i:30;i:5;i:40;i:6;i:50;}', '', ''),
(7, 1, 51, NULL, NULL, NULL, 'wwww', 'a:1:{i:4;s:2:"11";}', '/Uploads/2016-01-19/569deb9442720.jpg,/Uploads/2016-01-19/569deb9441d23.jpg,/Uploads/2016-01-19/569deb94415e3.jpg,/Uploads/2016-01-19/569deb94401bf.jpg,/Uploads/2016-01-19/569ded080fa41.jpg,/Uploads/2016-01-19/569ded0810e19.jpg,', 'a:1:{i:4;s:190:"/Uploads/2016-01-19/569decbb4ac07.jpg,/Uploads/2016-01-19/569decbb4a6e6.jpg,/Uploads/2016-01-19/569decbb49e5a.jpg,/Uploads/2016-01-19/569decbb48235.jpg,/Uploads/2016-01-19/569decef095c7.jpg,";}'),
(2, 1, 8, NULL, NULL, NULL, '1111111111', 'a:1:{i:4;s:3:"1.0";}', '/Uploads/2016-01-14/569745b5a4939.jpg,/Uploads/2016-01-13/5695da678aac9.jpg,/Uploads/2016-01-13/5695da27b6b7c.jpg,/Uploads/2016-01-13/5695c8141faa2.jpg,/Uploads/2016-01-13/5696085091616.jpg,/Uploads/2016-01-14/569714948ea5e.jpg,', 'a:3:{i:4;s:76:"/Uploads/2016-01-08/568f5602061b1.jpg,/Uploads/2016-01-08/568f560204ea3.jpg,";i:5;s:75:"/Uploads/2016-01-08/568f560207397.jpg,/Uploads/2016-01-08/568f560208651.jpg";i:6;s:0:"";}'),
(3, 1, 5, NULL, NULL, NULL, 'dfdsf', 'a:3:{i:4;s:2:"30";i:5;i:40;i:6;i:50;}', '/Uploads/2016-01-13/5695bbfc75fc8.jpg,/Uploads/2016-01-13/5695e266cd9c2.png,', 'a:3:{i:4;s:151:"/Uploads/2016-01-08/568f560204ea3.jpg,/Uploads/2016-01-08/568f5602061b1.jpg/Uploads/2016-01-13/5695bc1bd749c.jpg,/Uploads/2016-01-13/5695bc1bd795c.jpg,";i:5;s:75:"/Uploads/2016-01-08/568f560207397.jpg,/Uploads/2016-01-08/568f560208651.jpg";i:6;s:0:"";}'),
(4, 1, 9, NULL, NULL, NULL, 'dfdsf', '', '/Uploads/2016-01-13/5695c9f4213ab.jpg,/Uploads/2016-01-13/5695c79b35075.jpg,/Uploads/2016-01-13/5695c79b34955.jpg,/Uploads/2016-01-13/5695c77e4dfdc.jpg,/Uploads/2016-01-14/56972d840d666.jpg,', ''),
(5, 1, 10, NULL, NULL, NULL, 'dfdsf', NULL, '', 'a:3:{i:4;s:75:"/Uploads/2016-01-08/568f560204ea3.jpg,/Uploads/2016-01-08/568f5602061b1.jpg";i:5;s:75:"/Uploads/2016-01-08/568f560207397.jpg,/Uploads/2016-01-08/568f560208651.jpg";i:6;s:0:"";}'),
(6, 1, NULL, NULL, NULL, NULL, NULL, 'a:1:{i:4;s:3:"2.0";}', NULL, 'a:1:{i:4;s:0:"";}'),
(8, 1, 57, NULL, NULL, NULL, '阿斯顿噶AWEG', 'a:1:{i:4;s:10:"aergawegV ";}', '/Uploads/2016-01-19/569e06b9abf6c.png,/Uploads/2016-01-19/569e06b9ac660.png,/Uploads/2016-01-19/569e06b9acc74.png,/Uploads/2016-01-19/569e06b9ad26d.png,/Uploads/2016-01-19/569e06b9ad811.png,/Uploads/2016-01-20/569ee0a7ccb47.png,/Uploads/2016-01-20/569ee0a7cdd9c.png,', 'a:1:{i:4;s:304:"/Uploads/2016-01-19/569e06cb1c4bd.png,/Uploads/2016-01-19/569e06cb1cb00.png,/Uploads/2016-01-19/569e06cb1cfdc.png,/Uploads/2016-01-19/569e06cb1d46e.png,/Uploads/2016-01-19/569e06cb1d971.png,/Uploads/2016-01-19/569e06cb1ee42.png,/Uploads/2016-01-20/569ee0b5b2c8b.png,/Uploads/2016-01-20/569ee0b5b4b69.png,";}'),
(9, 1, 55, NULL, NULL, NULL, 'you bing ', 'a:1:{i:4;s:2:"22";}', '/Uploads/2016-01-20/569f2908df28f.jpg,/Uploads/2016-01-20/569f2908dff00.jpg,', 'a:1:{i:4;s:76:"/Uploads/2016-01-20/569f29174763e.jpg,/Uploads/2016-01-20/569f29174911f.jpg,";}'),
(10, 1, 58, NULL, NULL, NULL, '', NULL, '/Uploads/2016-01-21/56a09da91ac1c.jpg,/Uploads/2016-01-21/56a09da91d94d.jpg,/Uploads/2016-01-21/56a09da91e452.jpg,/Uploads/2016-01-21/56a09da91f32f.jpg,', NULL),
(11, 1, 53, NULL, NULL, NULL, 'dfghjkl', 'a:1:{i:4;s:2:"22";}', '/Uploads/2016-01-21/56a09e4409f63.jpg,/Uploads/2016-01-21/56a09e4407373.jpg,/Uploads/2016-01-21/56a09e44065d3.jpg,/Uploads/2016-01-21/56a09e44056f2.jpg,', 'a:1:{i:4;s:152:"/Uploads/2016-01-21/56a09e5abb46e.jpg,/Uploads/2016-01-21/56a09e5abaee3.jpg,/Uploads/2016-01-21/56a09e5aba8a1.jpg,/Uploads/2016-01-21/56a09e5aba2b0.jpg,";}');

-- --------------------------------------------------------

--
-- 表的结构 `tp_accorder`
--

CREATE TABLE IF NOT EXISTS `tp_accorder` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `type` int(2) unsigned DEFAULT NULL COMMENT '订单类型：0初诊',
  `is_evaluation` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '是否已评价0：未评价 1：已评价',
  `is_time` int(2) unsigned DEFAULT NULL COMMENT '是否及时响应0：不及时 1：及时',
  `is_read` int(2) unsigned DEFAULT '0' COMMENT '在服务提醒页面是否已读0未读、1已读',
  `user_id` varchar(20) NOT NULL COMMENT '患者标识',
  `state` varchar(10) DEFAULT NULL COMMENT '订单状态-1:已取消0:未确定 1:已确定方案未设置 2：已设置未开始  3:已设置已开始 3.1:挂号 3.2：看诊 3.3：开始就诊 3.4：接受就诊资料 4：已结束',
  `user_name` varchar(20) DEFAULT NULL COMMENT '患者姓名',
  `acc_id` varchar(20) DEFAULT NULL COMMENT '陪诊人员唯一标识',
  `acc_start_time` varchar(20) DEFAULT NULL COMMENT '陪护陪诊开始时间',
  `acc_end_time` varchar(20) DEFAULT NULL COMMENT '陪护结束时间',
  `create_time` varchar(20) DEFAULT NULL COMMENT '订单创建时间',
  `hospital` varchar(20) DEFAULT NULL COMMENT '看诊医院',
  `expert` varchar(20) DEFAULT NULL COMMENT '预约的专家',
  `place` varchar(20) DEFAULT NULL COMMENT '会面地址',
  `time` varchar(20) DEFAULT NULL COMMENT '看诊时间',
  `note` varchar(255) DEFAULT NULL COMMENT '备注',
  `live_number` varchar(50) DEFAULT NULL COMMENT '住院号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='陪诊订单表' AUTO_INCREMENT=100 ;

--
-- 转存表中的数据 `tp_accorder`
--

INSERT INTO `tp_accorder` (`id`, `type`, `is_evaluation`, `is_time`, `is_read`, `user_id`, `state`, `user_name`, `acc_id`, `acc_start_time`, `acc_end_time`, `create_time`, `hospital`, `expert`, `place`, `time`, `note`, `live_number`) VALUES
(1, 4, 1, 0, 0, 'vv', '4', '2', 'ceshi', '1452675660', '1452675720', '5555', '3', 'sadfghjk', 'wdsfghjkl', '1452614400', 'ewrtyuihop', NULL),
(2, 4, 1, 0, 0, 'vv', '1', '5', 'ceshi', '1452663420', '1452749820', '5', '1', 'e2wd', 'wfw3', '1451923200', 'ddfghjgkhl;', NULL),
(3, 5, 0, 0, 0, 'admin', '1', NULL, 'ceshi', '1454846340', '1454849940', NULL, '2', 'Fhhhhgh', 'victim', '1454774400', '', NULL),
(4, 1, 0, 0, 0, 'admin', '1', NULL, 'ceshi', '1450195209', NULL, '1449651139', '1', 'ddf', '', '1450195209', 'dfdf', NULL),
(5, NULL, 0, NULL, 1, 'admin', '3', NULL, 'ceshi', '1450195206', NULL, '1450075555', NULL, NULL, NULL, '1450195206', NULL, NULL),
(6, NULL, 1, 0, 1, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450075621', NULL, NULL, NULL, '1430755200', NULL, NULL),
(7, NULL, 0, NULL, 1, 'admin', '4', NULL, 'ceshi', '1430755200', NULL, '1450075622', NULL, NULL, NULL, '1430755200', NULL, NULL),
(8, NULL, 0, NULL, 0, 'admin', '3', NULL, 'ceshi', '1430755200', NULL, '1450075622', '1', NULL, NULL, '1425398300 ', NULL, NULL),
(9, NULL, 0, NULL, 0, '132', '3', NULL, 'ceshi', '1451836801', '1451923100', '1450076590', NULL, NULL, NULL, '1451922100', NULL, NULL),
(10, NULL, 3, NULL, 0, 'admin', '3', NULL, 'ceshi', NULL, NULL, '1450146143', NULL, NULL, NULL, '1450425605', NULL, NULL),
(11, NULL, 3, NULL, 0, 'admin', '3', NULL, 'ceshi', NULL, NULL, '1450147257', NULL, NULL, NULL, '1450425605', NULL, NULL),
(12, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450339866', NULL, NULL, NULL, NULL, NULL, NULL),
(13, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450669663', NULL, NULL, NULL, NULL, NULL, NULL),
(14, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450669876', NULL, NULL, NULL, NULL, NULL, NULL),
(15, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450669895', NULL, NULL, NULL, NULL, NULL, NULL),
(16, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450669902', NULL, NULL, NULL, NULL, NULL, NULL),
(17, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450669989', NULL, NULL, NULL, NULL, NULL, NULL),
(18, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450670117', NULL, NULL, NULL, NULL, NULL, NULL),
(19, NULL, 0, NULL, 0, 'admin', '3', NULL, 'ceshi', NULL, NULL, '1450670335', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 2, 0, NULL, 0, 'admin', '3', NULL, 'ceshi', '1425340800', '1425344400', '1450670481', '1', 'dfd', 'dfdfd', '1425312000', '', NULL),
(21, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450755757', NULL, NULL, NULL, NULL, NULL, NULL),
(22, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450761976', NULL, NULL, NULL, NULL, NULL, NULL),
(23, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450765215', NULL, NULL, NULL, NULL, NULL, NULL),
(24, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450766938', NULL, NULL, NULL, NULL, NULL, NULL),
(25, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450834771', NULL, NULL, NULL, NULL, NULL, NULL),
(26, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450856118', NULL, NULL, NULL, NULL, NULL, NULL),
(27, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450856660', NULL, NULL, NULL, NULL, NULL, NULL),
(28, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450856670', NULL, NULL, NULL, NULL, NULL, NULL),
(29, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450856675', NULL, NULL, NULL, NULL, NULL, NULL),
(30, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450856687', NULL, NULL, NULL, NULL, NULL, NULL),
(31, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1450860179', NULL, NULL, NULL, NULL, NULL, NULL),
(32, NULL, 0, 1, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1452043950', NULL, NULL, NULL, NULL, NULL, NULL),
(33, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1452130765', NULL, NULL, NULL, NULL, NULL, NULL),
(34, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1452130769', NULL, NULL, NULL, NULL, NULL, NULL),
(35, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1452131134', NULL, NULL, NULL, NULL, NULL, NULL),
(36, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1452133581', NULL, NULL, NULL, NULL, NULL, NULL),
(37, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1452496250', NULL, NULL, NULL, NULL, NULL, NULL),
(38, NULL, 0, 1, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1452498246', NULL, NULL, NULL, NULL, NULL, NULL),
(39, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1452500739', NULL, NULL, NULL, NULL, NULL, NULL),
(40, NULL, 0, 0, 0, 'admin', '1', NULL, 'ceshi', NULL, NULL, '1452503745', NULL, NULL, NULL, NULL, NULL, NULL),
(41, NULL, 0, NULL, 0, 'admin', '4', NULL, 'ceshi', '1430755200', NULL, '1450075622', NULL, NULL, NULL, '1430755200', NULL, NULL),
(42, NULL, 0, NULL, 0, 'admin', '0', NULL, 'ceshi', NULL, NULL, '1452849086', NULL, NULL, NULL, NULL, NULL, NULL),
(43, NULL, 0, NULL, 0, 'admin', '0', NULL, 'ceshi', NULL, NULL, '1452849236', NULL, NULL, NULL, NULL, NULL, NULL),
(44, NULL, 0, NULL, 0, 'admin', '0', NULL, 'ceshi', NULL, NULL, '1452849264', NULL, NULL, NULL, NULL, NULL, NULL),
(45, NULL, 0, NULL, 0, 'admin', '0', NULL, 'ceshi', NULL, NULL, '1452849506', NULL, NULL, NULL, NULL, NULL, NULL),
(46, NULL, 0, NULL, 0, 'admin', '0', NULL, 'ceshi', NULL, NULL, '1453095758', NULL, NULL, NULL, NULL, NULL, NULL),
(47, NULL, 0, NULL, 0, 'admin', '0', NULL, 'ceshi', NULL, NULL, '1453096163', NULL, NULL, NULL, NULL, NULL, NULL),
(48, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453099852', NULL, NULL, NULL, NULL, NULL, NULL),
(49, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453101996', NULL, NULL, NULL, NULL, NULL, NULL),
(50, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453103110', NULL, NULL, NULL, NULL, NULL, NULL),
(51, 5, 1, 1, 1, '15866898306', '4', '花花', '15866898306', '1453226400', '1453230000', '1453183834', '3', 'sdfghjkl;', 'sdfghijuop', '1453219200', 'awesrdtyuio', NULL),
(52, 4, 0, 1, 1, '15866898306', '4', '花花', '15866898306', '1453192500', '1453368840', '1453185475', '3', 'efhgjvklj', 'etrdyfyuigil', '1453305600', 'sdyfiugilhk', NULL),
(53, 4, 0, 0, 0, '15866898306', '3', '花花', '15866898306', '1453680060', '1453690860', '1453185693', '3', 'ytruyurkyulyukry', 'Cobb', '1453651200', '', NULL),
(54, NULL, 0, NULL, 0, 'admin', '0', NULL, 'ceshi', NULL, NULL, '1453190280', NULL, NULL, NULL, NULL, NULL, NULL),
(55, 5, 0, 1, 0, '15866898306', '3', '花花', '15866898306', '1453438800', '1453453200', '1453191996', '3', '111', '222', '1453392000', 'kong fu', NULL),
(56, NULL, 0, NULL, 0, 'admin', '0', NULL, 'ceshi', NULL, NULL, '1453196514', NULL, NULL, NULL, NULL, NULL, NULL),
(57, 4, 1, 1, 1, '14768906513', '4', '牛牛', '14768906513', '1453196940', '1453283340', '1453196757', '3', '牛爷爷', '青岛崂山', '1453132800', '阿斯顿发文', NULL),
(58, 4, 0, 1, 0, '14768906513', '3', '牛牛', '14768906513', '1453174200', '1453174500', '1453197050', '3', '啥地方刚萨热', ' 他', '1453132800', '杜绝看地图', NULL),
(59, NULL, 0, 0, 0, '14768906513', '1', '牛牛', '14768906513', NULL, NULL, '1453260627', NULL, NULL, NULL, NULL, NULL, NULL),
(60, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453269728', NULL, NULL, NULL, NULL, NULL, NULL),
(61, NULL, 0, 0, 0, '15866898306', '1', '花花', '14768906513', NULL, NULL, '1453278749', NULL, NULL, NULL, NULL, NULL, NULL),
(62, NULL, 0, 0, 0, '15866898306', '1', '花花', '15866898306', NULL, NULL, '1453279320', NULL, NULL, NULL, NULL, NULL, NULL),
(63, 4, 0, 0, 0, '15866898306', '2', '花花', '15866898306', '1453440720', '1453455120', '1453279326', '3', '2retrydfyg', 'esrytdf', '1453392000', 'esrdtfygj', NULL),
(64, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453279387', NULL, NULL, NULL, NULL, NULL, NULL),
(65, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453279514', NULL, NULL, NULL, NULL, NULL, NULL),
(66, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453343404', NULL, NULL, NULL, NULL, NULL, NULL),
(67, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453343961', NULL, NULL, NULL, NULL, NULL, NULL),
(68, NULL, 0, 0, 0, '15866898306', '1', '花花', '15866898306', NULL, NULL, '1453344039', NULL, NULL, NULL, NULL, NULL, NULL),
(69, NULL, 0, 1, 0, '15866898306', '1', '花花', '15866898306', NULL, NULL, '1453344094', NULL, NULL, NULL, NULL, NULL, NULL),
(70, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453361768', NULL, NULL, NULL, NULL, NULL, NULL),
(71, 4, 0, 1, 0, '15866898306', '3', '花花', '15866898306', '1453528740', '1453543140', '1453361771', '3', 'sdfghjknl', 'asdgfhgyjiuo90-', '1453478400', 'erh56i78o79oryrtki6', NULL),
(72, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453361782', NULL, NULL, NULL, NULL, NULL, NULL),
(73, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453361785', NULL, NULL, NULL, NULL, NULL, NULL),
(74, NULL, 0, 1, 0, '15866898306', '1', '花花', '15866898306', NULL, NULL, '1453361800', NULL, NULL, NULL, NULL, NULL, NULL),
(75, NULL, 0, 1, 0, '15866898306', '1', '花花', '15866898306', NULL, NULL, '1453361806', NULL, NULL, NULL, NULL, NULL, NULL),
(76, NULL, 0, NULL, 0, '15866898306', '0', '花花', '14768906513', NULL, NULL, '1453364658', NULL, NULL, NULL, NULL, NULL, NULL),
(77, NULL, 0, NULL, 0, '15866898306', '0', '花花', '14768906513', NULL, NULL, '1453364673', NULL, NULL, NULL, NULL, NULL, NULL),
(78, 4, 0, 1, 0, '15866898306', '2', '花花', '15866898306', '1453364700', '1453368360', '1453364687', '3', 'DFRGTHYJUI(O)P_{', 'T%S^YUIK*OLY()PU_I{', '1453305600', '', NULL),
(79, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453364825', NULL, NULL, NULL, NULL, NULL, NULL),
(80, NULL, 0, NULL, 0, '15866898306', '0', '花花', '14768906513', NULL, NULL, '1453364909', NULL, NULL, NULL, NULL, NULL, NULL),
(81, 4, 0, 1, 0, '15866898306', '2', '花花', '15866898306', '1453682640', '1453682640', '1453365713', '3', 'jgfdghfjgkytu', 'figure', '1453651200', '', NULL),
(82, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453366245', NULL, NULL, NULL, NULL, NULL, NULL),
(83, NULL, 0, NULL, 0, '15866898306', '0', '花花', '14768906513', NULL, NULL, '1453366259', NULL, NULL, NULL, NULL, NULL, NULL),
(84, NULL, 0, NULL, 0, '15866898306', '0', '花花', 'ceshi', NULL, NULL, '1453366272', NULL, NULL, NULL, NULL, NULL, NULL),
(85, 4, 0, 1, 0, '15866898306', '2', '花花', '15866898306', '1453507200', '1453518000', '1453366368', '3', 'rghrdts', 'ewretrewrtr', '1453478400', 'ertrht', NULL),
(86, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366475', NULL, NULL, NULL, NULL, NULL, NULL),
(87, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366477', NULL, NULL, NULL, NULL, NULL, NULL),
(88, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366477', NULL, NULL, NULL, NULL, NULL, NULL),
(89, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366477', NULL, NULL, NULL, NULL, NULL, NULL),
(90, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366478', NULL, NULL, NULL, NULL, NULL, NULL),
(91, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366478', NULL, NULL, NULL, NULL, NULL, NULL),
(92, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366478', NULL, NULL, NULL, NULL, NULL, NULL),
(93, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366478', NULL, NULL, NULL, NULL, NULL, NULL),
(94, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366478', NULL, NULL, NULL, NULL, NULL, NULL),
(95, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366478', NULL, NULL, NULL, NULL, NULL, NULL),
(96, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366479', NULL, NULL, NULL, NULL, NULL, NULL),
(97, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366480', NULL, NULL, NULL, NULL, NULL, NULL),
(98, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366480', NULL, NULL, NULL, NULL, NULL, NULL),
(99, NULL, 0, NULL, 0, '15866898306', '0', '花花', '15866898306', NULL, NULL, '1453366717', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_admin`
--

CREATE TABLE IF NOT EXISTS `tp_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(20) NOT NULL COMMENT '登录账号',
  `password` varchar(100) DEFAULT NULL COMMENT '密码',
  `real_name` varchar(100) DEFAULT NULL COMMENT '姓名',
  `nav` text COMMENT '权限导航菜单',
  `role_id` int(11) DEFAULT NULL COMMENT '角色名称',
  `create_date` varchar(50) DEFAULT NULL COMMENT '创建时间',
  `creater` varchar(12) DEFAULT NULL COMMENT '创建人',
  `status` int(4) DEFAULT NULL COMMENT '1,正常 2,冻结 3，删除',
  `head` varchar(255) NOT NULL COMMENT '头像',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=34 ;

--
-- 转存表中的数据 `tp_admin`
--

INSERT INTO `tp_admin` (`id`, `account`, `password`, `real_name`, `nav`, `role_id`, `create_date`, `creater`, `status`, `head`) VALUES
(21, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', 'Admin', '73,76,78,86,88,91,70,72,75,79,80,81,85,87,89,90,92', 0, NULL, NULL, 1, '/Uploads/2016-01-06/568ccc4c2d725.jpg'),
(22, '777', '698d51a19d8a121ce581499d7b701668', '777', NULL, NULL, NULL, NULL, 1, '/Uploads/2016-01-07/568e1ac899c6c.jpg'),
(28, '2', 'c81e728d9d4c2f636f067f89cc14862c', '2', '67,68,94,74,71,73,76,78,86,88,91,79,80,81,95,96,87,89,90,93,92', NULL, NULL, NULL, 1, ''),
(29, '11', '28c8edde3d61a0411511d3b1866f0636', '133', NULL, NULL, NULL, NULL, 1, ''),
(30, '3', '28c8edde3d61a0411511d3b1866f0636', '1212', NULL, NULL, NULL, NULL, 1, ''),
(31, '4', 'c4ca4238a0b923820dcc509a6f75849b', '21', NULL, NULL, NULL, NULL, 1, ''),
(32, '田蜜', 'c8b2f17833a4c73bb20f88876219ddcd', '田斐', '67,68,94,71,78,109,97,111,112,107,76,108,110,79,96,87,80,81,89,90,93,92,95,98,134,149,104,105,106,131,132,133,113,114,115,116,117,119,120,121,122,123,126,127,128,143,144,124,125,129,135,136,137,138,139,140,141,142,147,148,145,146', NULL, NULL, NULL, 1, '/Uploads/2016-08-09/57a9834502d0b.JPG');

-- --------------------------------------------------------

--
-- 表的结构 `tp_admin_login_log`
--

CREATE TABLE IF NOT EXISTS `tp_admin_login_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_id` varchar(50) DEFAULT NULL COMMENT '用户id',
  `login_time` varchar(50) DEFAULT NULL COMMENT '登录时间',
  `login_ip` varchar(50) CHARACTER SET gbk DEFAULT NULL COMMENT '登录ip',
  `status` varchar(100) DEFAULT NULL COMMENT '状态',
  `module` varchar(100) DEFAULT NULL COMMENT '模块',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户登录记录表' AUTO_INCREMENT=2999 ;

--
-- 转存表中的数据 `tp_admin_login_log`
--

INSERT INTO `tp_admin_login_log` (`id`, `user_id`, `login_time`, `login_ip`, `status`, `module`) VALUES
(2771, '21', '1451013057', '::1', '用户登录', NULL),
(2772, '21', '1451013583', '::1', '用户登录', NULL),
(2773, '21', '1451020568', '192.168.0.66', NULL, NULL),
(2774, '21', '1451022545', '192.168.0.66', NULL, NULL),
(2775, '21', '1451023173', '192.168.0.66', NULL, NULL),
(2776, '21', '1451023752', '::1', '登录超时', NULL),
(2777, '21', '1451023759', '::1', '用户登录', NULL),
(2778, '21', '1451034140', '192.168.0.66', NULL, NULL),
(2779, '21', '1451267820', '::1', '用户登录', NULL),
(2780, '21', '1451282947', '192.168.0.66', NULL, NULL),
(2781, '21', '1451289070', '192.168.0.66', NULL, NULL),
(2782, '21', '1451290485', '192.168.0.66', NULL, NULL),
(2783, '21', '1451290604', '192.168.0.66', NULL, NULL),
(2784, '21', '1451875456', '192.168.0.66', NULL, NULL),
(2785, '21', '1451883739', '192.168.0.66', NULL, NULL),
(2786, '21', '1451883755', '192.168.0.66', NULL, NULL),
(2787, '21', '1451888541', '192.168.0.66', NULL, NULL),
(2788, '21', '1451888549', '192.168.0.66', NULL, NULL),
(2789, '21', '1451888989', '192.168.0.66', NULL, NULL),
(2790, '21', '1451889036', '192.168.0.66', NULL, NULL),
(2791, '21', '1451889192', '192.168.0.66', NULL, NULL),
(2792, '21', '1451889583', '192.168.0.66', NULL, NULL),
(2793, '21', '1451889738', '192.168.0.66', '登录超时', NULL),
(2794, '21', '1451889760', '192.168.0.66', NULL, NULL),
(2795, '21', '1451889783', '192.168.0.66', '登录超时', NULL),
(2796, '21', '1451890072', '192.168.0.66', NULL, NULL),
(2797, '21', '1451890089', '192.168.0.66', NULL, NULL),
(2798, '21', '1451890102', '192.168.0.66', NULL, NULL),
(2799, '21', '1451890116', '192.168.0.66', NULL, NULL),
(2800, '21', '1451890146', '192.168.0.66', NULL, NULL),
(2801, '21', '1451890172', '192.168.0.66', NULL, NULL),
(2802, '21', '1451890577', '192.168.0.66', NULL, NULL),
(2803, '21', '1451890713', '192.168.0.66', NULL, NULL),
(2804, '21', '1451890732', '192.168.0.66', NULL, NULL),
(2805, '21', '1451890764', '192.168.0.66', NULL, NULL),
(2806, '21', '1451890778', '192.168.0.66', NULL, NULL),
(2807, '21', '1451890798', '192.168.0.66', NULL, NULL),
(2808, '21', '1451890855', '192.168.0.66', NULL, NULL),
(2809, '21', '1451890883', '192.168.0.66', NULL, NULL),
(2810, '21', '1451890915', '192.168.0.66', NULL, NULL),
(2811, '21', '1451890937', '192.168.0.66', NULL, NULL),
(2812, '21', '1451890974', '192.168.0.66', NULL, NULL),
(2813, '21', '1451891011', '192.168.0.66', NULL, NULL),
(2814, '21', '1451891016', '192.168.0.66', NULL, NULL),
(2815, '21', '1451891100', '192.168.0.66', NULL, NULL),
(2816, '21', '1451891380', '192.168.0.66', NULL, NULL),
(2817, '21', '1451891493', '192.168.0.66', NULL, NULL),
(2818, '21', '1451891811', '192.168.0.66', NULL, NULL),
(2819, '21', '1451892279', '192.168.0.66', '用户登录', NULL),
(2820, '21', '1451892309', '192.168.0.66', '用户退出', NULL),
(2821, '21', '1451893576', '192.168.0.66', '用户登录', NULL),
(2822, '21', '1451894768', '192.168.0.66', '用户登录', NULL),
(2823, '21', '1451894770', '192.168.0.66', '登录超时', NULL),
(2824, '21', '1451894783', '192.168.0.66', '用户登录', NULL),
(2825, '21', '1451894785', '192.168.0.66', '登录超时', NULL),
(2826, '21', '1451894834', '192.168.0.66', '用户登录', NULL),
(2827, '21', '1451894836', '192.168.0.66', '登录超时', NULL),
(2828, '21', '1451895177', '192.168.0.66', '用户登录', NULL),
(2829, '21', '1451895181', '192.168.0.66', '登录超时', NULL),
(2830, '21', '1451895337', '192.168.0.66', '用户登录', NULL),
(2831, '21', '1451895339', '192.168.0.66', '登录超时', NULL),
(2832, '21', '1451895834', '192.168.0.66', '用户登录', NULL),
(2833, '21', '1451895837', '192.168.0.66', '登录超时', NULL),
(2834, '21', '1451895871', '192.168.0.66', '用户登录', NULL),
(2835, '21', '1451895873', '192.168.0.66', '登录超时', NULL),
(2836, '21', '1451895923', '192.168.0.66', '用户登录', NULL),
(2837, '21', '1451895925', '192.168.0.66', '登录超时', NULL),
(2838, '21', '1451896776', '192.168.0.66', '用户登录', NULL),
(2839, '21', '1451901571', '192.168.0.136', '用户登录', NULL),
(2840, '21', '1451955641', '192.168.0.66', '用户登录', NULL),
(2841, '21', '1451984819', '192.168.0.66', '用户登录', NULL),
(2842, '21', '1452040963', '192.168.0.66', '用户登录', NULL),
(2843, '21', '1452067899', '192.168.0.66', '用户登录', NULL),
(2844, '21', '1452068071', '192.168.0.66', '用户登录', NULL),
(2845, '21', '1452129715', '192.168.0.66', '用户登录', NULL),
(2846, '21', '1452129636', '::1', '用户登录', NULL),
(2847, '21', '1452130184', '192.168.0.32', '用户登录', NULL),
(2848, '21', '1452135902', '192.168.0.66', '用户退出', NULL),
(2849, '21', '1452135913', '192.168.0.66', '用户登录', NULL),
(2850, '21', '1452135937', '192.168.0.66', '用户退出', NULL),
(2851, '21', '1452136514', '192.168.0.32', '用户退出', NULL),
(2852, '22', '1452136557', '192.168.0.66', '用户登录', NULL),
(2853, '22', '1452136563', '192.168.0.66', '用户退出', NULL),
(2854, '21', '1452137321', '192.168.0.66', '用户登录', NULL),
(2855, '21', '1452143095', '192.168.0.66', '用户退出', NULL),
(2856, '22', '1452143100', '192.168.0.66', '用户登录', NULL),
(2857, '22', '1452143721', '192.168.0.66', '用户退出', NULL),
(2858, '21', '1452143727', '192.168.0.66', '用户登录', NULL),
(2859, '21', '1452143968', '::1', '用户登录', NULL),
(2860, '21', '1452144751', '::1', '用户登录', NULL),
(2861, '21', '1452149308', '192.168.0.66', '用户登录', NULL),
(2862, '21', '1452151369', '192.168.0.66', '用户登录', NULL),
(2863, '21', '1452151396', '::1', '用户登录', NULL),
(2864, '21', '1452151446', '::1', '用户登录', NULL),
(2865, '21', '1452218542', '::1', '用户登录', NULL),
(2866, '21', '1452232560', '::1', '用户登录', NULL),
(2867, '21', '1452235852', '192.168.0.66', '用户登录', NULL),
(2868, '21', '1452242247', '::1', '用户登录', NULL),
(2869, '21', '1452474386', '192.168.0.66', '用户登录', NULL),
(2870, '21', '1452475105', '::1', '用户登录', NULL),
(2871, '21', '1452475283', '192.168.0.66', '用户登录', NULL),
(2872, '21', '1452476559', '::1', '用户退出', NULL),
(2873, '21', '1452476570', '::1', '用户登录', NULL),
(2874, '21', '1452477170', '192.168.0.66', '用户登录', NULL),
(2875, '21', '1452483898', '192.168.0.66', '用户登录', NULL),
(2876, '21', '1452574899', '192.168.0.66', '用户登录', NULL),
(2877, '21', '1453096127', '192.168.0.66', '用户登录', NULL),
(2878, '21', '1453684197', '::1', '用户登录', NULL),
(2879, '21', '1453684351', '::1', '用户退出', NULL),
(2880, '21', '1453684362', '::1', '用户登录', NULL),
(2881, '21', '1453693609', '::1', '用户登录', NULL),
(2882, '21', '1453770075', '::1', '用户登录', NULL),
(2883, '21', '1453770092', '::1', '用户退出', NULL),
(2884, '21', '1453770122', '::1', '用户登录', NULL),
(2885, '21', '1453787556', '::1', '用户登录', NULL),
(2886, '21', '1453856707', '::1', '用户登录', NULL),
(2887, '21', '1453945085', '::1', '用户登录', NULL),
(2888, '21', '1453945817', '::1', '用户退出', NULL),
(2889, '21', '1453945875', '::1', '用户登录', NULL),
(2890, '21', '1454031242', '::1', '用户登录', NULL),
(2891, '21', '1454036284', '::1', '用户登录', NULL),
(2892, '21', '1454290184', '::1', '用户登录', NULL),
(2893, '21', '1454391970', '::1', '用户登录', NULL),
(2894, '21', '1454461910', '::1', '用户登录', NULL),
(2895, '21', '1455586201', '::1', '用户登录', NULL),
(2896, '21', '1462327102', '127.0.0.1', '用户退出', NULL),
(2897, '21', '1462327112', '127.0.0.1', '用户登录', NULL),
(2898, '21', '1462330933', '127.0.0.1', '用户退出', NULL),
(2899, '21', '1462330943', '127.0.0.1', '用户登录', NULL),
(2900, '21', '1462345664', '::1', '用户登录', NULL),
(2901, '21', '1462345710', '127.0.0.1', '用户登录', NULL),
(2902, '21', '1462346002', '127.0.0.1', '用户登录', NULL),
(2903, '21', '1462410085', '127.0.0.1', '用户登录', NULL),
(2904, '21', '1462496419', '127.0.0.1', '用户登录', NULL),
(2905, '21', '1462496837', '127.0.0.1', '用户登录', NULL),
(2906, '21', '1462755302', '127.0.0.1', '用户登录', NULL),
(2907, '21', '1462773895', '127.0.0.1', '用户登录', NULL),
(2908, '21', '1462787147', '127.0.0.1', '用户退出', NULL),
(2909, '21', '1462844870', '127.0.0.1', '用户登录', NULL),
(2910, '21', '1462845390', '127.0.0.1', '用户退出', NULL),
(2911, '21', '1462851818', '127.0.0.1', '用户退出', NULL),
(2912, '21', '1462851867', '127.0.0.1', '用户登录', NULL),
(2913, '21', '1462851967', '127.0.0.1', '用户退出', NULL),
(2914, '21', '1462851974', '127.0.0.1', '用户登录', NULL),
(2915, '21', '1462860964', '127.0.0.1', '用户登录', NULL),
(2916, '21', '1462860966', '127.0.0.1', '用户登录', NULL),
(2917, '21', '1462874922', '127.0.0.1', '用户登录', NULL),
(2918, '21', '1462944033', '127.0.0.1', '用户登录', NULL),
(2919, '21', '1463014763', '127.0.0.1', '用户登录', NULL),
(2920, '21', '1463102173', '127.0.0.1', '用户登录', NULL),
(2921, '21', '1463102175', '127.0.0.1', '用户登录', NULL),
(2922, '21', '1463361430', '127.0.0.1', '用户登录', NULL),
(2923, '21', '1463533164', '127.0.0.1', '用户登录', NULL),
(2924, '21', '1463551408', '127.0.0.1', '用户退出', NULL),
(2925, '21', '1463556055', '127.0.0.1', '用户登录', NULL),
(2926, '21', '1463556056', '127.0.0.1', '用户登录', NULL),
(2927, '21', '1463618935', '127.0.0.1', '用户登录', NULL),
(2928, '21', '1463636805', '127.0.0.1', '用户登录', NULL),
(2929, '21', '1463708501', '127.0.0.1', '用户登录', NULL),
(2930, '21', '1463708588', '127.0.0.1', '用户登录', NULL),
(2931, '21', '1463708589', '127.0.0.1', '用户登录', NULL),
(2932, '21', '1463965761', '127.0.0.1', '用户登录', NULL),
(2933, '21', '1463995283', '127.0.0.1', '用户登录', NULL),
(2934, '21', '1464058917', '127.0.0.1', '用户登录', NULL),
(2935, '21', '1464060370', '127.0.0.1', '用户登录', NULL),
(2936, '21', '1464163171', '127.0.0.1', '用户登录', NULL),
(2937, '21', '1464224506', '127.0.0.1', '用户登录', NULL),
(2938, '21', '1464224507', '127.0.0.1', '用户登录', NULL),
(2939, '21', '1464598720', '127.0.0.1', '用户登录', NULL),
(2940, '21', '1464831872', '127.0.0.1', '用户登录', NULL),
(2941, '21', '1464915554', '127.0.0.1', '用户登录', NULL),
(2942, '21', '1465175175', '127.0.0.1', '用户登录', NULL),
(2943, '21', '1465268405', '127.0.0.1', '用户登录', NULL),
(2944, '21', '1465353097', '127.0.0.1', '用户登录', NULL),
(2945, '21', '1465695705', '127.0.0.1', '用户登录', NULL),
(2946, '21', '1465700916', '127.0.0.1', '用户登录', NULL),
(2947, '21', '1465779969', '127.0.0.1', '用户登录', NULL),
(2948, '21', '1465867210', '127.0.0.1', '用户登录', NULL),
(2949, '21', '1465966799', '127.0.0.1', '用户登录', NULL),
(2950, '21', '1466060083', '127.0.0.1', '用户登录', NULL),
(2951, '21', '1466128790', '127.0.0.1', '用户登录', NULL),
(2952, '21', '1466385472', '127.0.0.1', '用户登录', NULL),
(2953, '21', '1466487083', '127.0.0.1', '用户登录', NULL),
(2954, '21', '1466557529', '127.0.0.1', '用户登录', NULL),
(2955, '21', '1466644040', '127.0.0.1', '用户登录', NULL),
(2956, '21', '1466757991', '58.56.179.142', '用户登录', NULL),
(2957, '21', '1466762619', '58.56.179.142', '用户登录', NULL),
(2958, '21', '1466762635', '58.56.179.142', '用户登录', NULL),
(2959, '21', '1466763287', '58.56.179.142', '用户登录', NULL),
(2960, '21', '1466863935', '27.210.93.123', '用户登录', NULL),
(2961, '', '1466863966', '180.153.201.66', '用户退出', NULL),
(2962, '21', '1466863966', '27.210.93.123', '用户退出', NULL),
(2963, '', '1466863966', '112.64.235.251', '用户退出', NULL),
(2964, '', '1466863967', '112.90.82.218', '用户退出', NULL),
(2965, '21', '1466899713', '27.193.8.3', '用户登录', NULL),
(2966, '21', '1466987632', '112.225.123.94', '用户登录', NULL),
(2967, '21', '1466989307', '58.56.179.142', '用户登录', NULL),
(2968, '21', '1467084331', '58.56.179.142', '用户登录', NULL),
(2969, '21', '1467164793', '58.56.179.142', '用户登录', NULL),
(2970, '21', '1467270643', '58.56.179.142', '用户登录', NULL),
(2971, '21', '1467352555', '58.56.179.142', '用户登录', NULL),
(2972, '21', '1467597712', '58.56.179.142', '用户登录', NULL),
(2973, '21', '1467619458', '58.56.179.142', '用户登录', NULL),
(2974, '21', '1467621663', '58.56.179.142', '用户退出', NULL),
(2975, '21', '1467621746', '58.56.179.142', '用户登录', NULL),
(2976, '21', '1468312107', '58.56.179.142', '用户登录', NULL),
(2977, '21', '1468376809', '58.56.179.142', '用户登录', NULL),
(2978, '21', '1468459487', '58.56.179.142', '用户登录', NULL),
(2979, '21', '1470124420', '58.56.179.142', '用户登录', NULL),
(2980, '21', '1470126291', '58.56.179.142', '用户退出', NULL),
(2981, '21', '1470126428', '58.56.179.142', '用户登录', NULL),
(2982, '21', '1470190098', '58.56.179.142', '用户登录', NULL),
(2983, '21', '1470723133', '123.233.50.130', '用户登录', NULL),
(2984, '21', '1470724929', '58.56.179.142', '用户登录', NULL),
(2985, '21', '1470724981', '58.56.179.142', '用户登录', NULL),
(2986, '21', '1470725131', '58.56.179.142', '用户登录', NULL),
(2987, '21', '1470725455', '58.56.179.142', '用户登录', NULL),
(2988, '21', '1470725530', '58.56.179.142', '用户登录', NULL),
(2989, '21', '1470735508', '123.233.50.130', '用户登录', NULL),
(2990, '21', '1470880995', '58.56.179.142', '用户登录', NULL),
(2991, '21', '1470883446', '58.56.179.142', '用户退出', NULL),
(2992, '21', '1470883449', '58.56.179.142', '用户登录', NULL),
(2993, '21', '1470884892', '58.56.179.142', '用户退出', NULL),
(2994, '21', '1470962199', '27.210.93.13', '用户登录', NULL),
(2995, '21', '1471310139', '58.56.179.142', '用户登录', NULL),
(2996, '21', '1471612613', '27.219.112.255', '用户登录', NULL),
(2997, '21', '1471921223', '218.57.80.212', '用户登录', NULL),
(2998, '21', '1471924368', '58.56.179.142', '用户登录', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_advert`
--

CREATE TABLE IF NOT EXISTS `tp_advert` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL COMMENT '1是头条2是此条3搞笑头条4搞笑次条',
  `strdate` varchar(20) NOT NULL COMMENT '开始日期',
  `enddate` varchar(20) NOT NULL COMMENT '结束日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `tp_advert`
--

INSERT INTO `tp_advert` (`id`, `status`, `strdate`, `enddate`) VALUES
(9, 2, '1465574400', '1466611200'),
(7, 4, '1465660800', '1467216000'),
(8, 1, '1464710400', '1466006400');

-- --------------------------------------------------------

--
-- 表的结构 `tp_agree`
--

CREATE TABLE IF NOT EXISTS `tp_agree` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(4) NOT NULL DEFAULT '1' COMMENT '3好4很好5非常好2差',
  `text` text,
  `class_id` int(4) unsigned DEFAULT NULL,
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `tp_agree`
--

INSERT INTO `tp_agree` (`id`, `status`, `text`, `class_id`, `edit_date`) VALUES
(17, 4, '', 8, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_agree_class`
--

CREATE TABLE IF NOT EXISTS `tp_agree_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(100) DEFAULT NULL COMMENT '看诊类型名称',
  `status` int(4) unsigned DEFAULT NULL COMMENT '状态',
  `sort` int(11) unsigned DEFAULT NULL COMMENT '排序',
  `date` varchar(15) DEFAULT NULL COMMENT '写入时间',
  `edit_date` varchar(15) DEFAULT NULL COMMENT '编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='看诊类型表' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `tp_agree_class`
--

INSERT INTO `tp_agree_class` (`id`, `name`, `status`, `sort`, `date`, `edit_date`) VALUES
(2, '导师001', 1, 1, '1462442467', '1470726471'),
(8, '导师002', 1, 2, '1463380485', '1470726485'),
(10, '设计师AAA', 1, 0, '1463380694', '1470726517'),
(11, '设计师BBB', 1, 0, '1463380707', '1470726530'),
(12, '财务01', 1, 1, '1463380747', '1470726548'),
(13, '财务02', 1, 2, '1463380786', '1470726558');

-- --------------------------------------------------------

--
-- 表的结构 `tp_attention`
--

CREATE TABLE IF NOT EXISTS `tp_attention` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL COMMENT '产品id',
  `usid` int(4) DEFAULT NULL COMMENT '用户id',
  `date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `tp_attention`
--

INSERT INTO `tp_attention` (`id`, `pid`, `usid`, `date`) VALUES
(25, 11, 1, '1454032066'),
(24, 9, 1, '1454031950'),
(23, 8, 1, '1454031940'),
(26, 13, 1361, '1462345541');

-- --------------------------------------------------------

--
-- 表的结构 `tp_basic`
--

CREATE TABLE IF NOT EXISTS `tp_basic` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `main_img` varchar(500) NOT NULL COMMENT '图片',
  `text` text,
  `date` varchar(15) DEFAULT NULL,
  `class_id` int(4) unsigned DEFAULT NULL,
  `status` int(4) unsigned DEFAULT '1',
  `sort` int(4) unsigned DEFAULT '1',
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tp_basic`
--

INSERT INTO `tp_basic` (`id`, `title`, `main_img`, `text`, `date`, `class_id`, `status`, `sort`, `edit_date`) VALUES
(3, '【微姐朋友圈收费与不收费区别】', '', '<p>						</p><p><br/></p><p><br/></p><p><span style="font-family:宋体">收费的标准：所有通过九万微传媒挣钱的商家，如：卖衣服、卖鞋、卖减肥药、实体店商家、微商招代理、信用卡、贷款有盈利性的招聘等等；</span></p><p><span style="font-family:宋体">免费的标准：招聘（没有盈利性的）、求职、生活求助、顺风车、出兑、售房、售车【蹭信息的除外】</span></p><p><span style="font-family:宋体">交友，打听事等等！不能够留微信的联系方式！</span></p><p><span style="font-family:宋体">【同一个便民信息免费发布一次。每天发收米</span> <span style="font-family:宋体">】</span></p><p><span style="text-indent: 2em;"></span><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p>						</p>', '1462441638', 4, 1, 111, '1470734369'),
(4, '报单格式', '', '<p>						</p><p><span style="font-family:宋体">我是：青岛城阳卓越微生活</span></p><p><span style="font-family:宋体">团队</span>:<span style="font-family:宋体">青岛五月风团队</span></p><p><span style="font-family:宋体">打入公司哪个（</span>zhang<span style="font-family:宋体">）户</span>:<span style="font-family: 宋体">阿宝</span></p><p><span style="font-family:宋体">打（</span>mi<span style="font-family:宋体">）时间：</span>2016.5.11</p><p><span style="font-family:宋体">客户打（</span>mi<span style="font-family:宋体">）姓名：王鸿飞</span></p><p><span style="font-family:宋体">（</span>jin<span style="font-family:宋体">）额：</span>200<span style="font-family: 宋体">米</span></p><p>&nbsp;</p><p><span style="font-family:宋体">推荐地区</span>:<span style="font-family:宋体">田蜜</span> <span style="font-family:宋体">青岛微生活</span></p><p><span style="font-family:宋体">广告到期时间：</span>5.12-6.10</p><p><span style="font-family:宋体">广告类型：大门推广</span></p><p>						</p>', '1462496587', 4, 1, 333, '1470734512');

-- --------------------------------------------------------

--
-- 表的结构 `tp_basic_class`
--

CREATE TABLE IF NOT EXISTS `tp_basic_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(100) DEFAULT NULL COMMENT '看诊类型名称',
  `status` int(4) unsigned DEFAULT NULL COMMENT '状态',
  `sort` int(11) unsigned DEFAULT NULL COMMENT '排序',
  `date` varchar(15) DEFAULT NULL COMMENT '写入时间',
  `edit_date` varchar(15) DEFAULT NULL COMMENT '编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='看诊类型表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tp_basic_class`
--

INSERT INTO `tp_basic_class` (`id`, `name`, `status`, `sort`, `date`, `edit_date`) VALUES
(3, '九万干货！', 1, 3, '1462441622', '1471922821');

-- --------------------------------------------------------

--
-- 表的结构 `tp_birthday`
--

CREATE TABLE IF NOT EXISTS `tp_birthday` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `text` text,
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tp_birthday`
--

INSERT INTO `tp_birthday` (`id`, `title`, `text`, `edit_date`) VALUES
(1, '水电费粉红色丢分都随风hiUSD覅速度发货ID苏防护四地发挥', '', '1466995968');

-- --------------------------------------------------------

--
-- 表的结构 `tp_choujiang`
--

CREATE TABLE IF NOT EXISTS `tp_choujiang` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `fist` varchar(500) NOT NULL COMMENT '一等奖奖品名称',
  `fistnums` int(4) NOT NULL COMMENT '一等奖品数量',
  `fistlucknums` int(4) NOT NULL COMMENT '一等奖中奖个数',
  `second` varchar(500) NOT NULL COMMENT '二等奖名称',
  `secondnums` int(11) NOT NULL COMMENT '二等奖数量',
  `secondlucknums` int(11) NOT NULL COMMENT '二等奖中奖数量',
  `third` varchar(500) NOT NULL COMMENT '三等奖名称',
  `thirdnums` int(11) NOT NULL COMMENT '三等奖数量',
  `thirdlucknums` int(11) NOT NULL COMMENT '三等奖中奖数量',
  `four` varchar(500) NOT NULL COMMENT '四等奖名称',
  `fournums` int(11) NOT NULL COMMENT '四等奖数量',
  `fourlucknums` int(11) NOT NULL COMMENT '四等奖中数量',
  `five` varchar(500) NOT NULL COMMENT '五等奖名称',
  `fivenums` int(11) NOT NULL COMMENT '五等奖数量',
  `fivelucknums` int(11) NOT NULL COMMENT '五等奖中奖数量',
  `num` int(11) NOT NULL COMMENT '预计抽奖次数',
  `strdate` varchar(15) NOT NULL COMMENT '开始时间',
  `enddate` varchar(11) NOT NULL COMMENT '结束时间',
  `title` varchar(200) NOT NULL,
  `sign` int(11) NOT NULL COMMENT '抽奖积分',
  `text` text,
  `date` varchar(20) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tp_choujiang`
--

INSERT INTO `tp_choujiang` (`id`, `fist`, `fistnums`, `fistlucknums`, `second`, `secondnums`, `secondlucknums`, `third`, `thirdnums`, `thirdlucknums`, `four`, `fournums`, `fourlucknums`, `five`, `fivenums`, `fivelucknums`, `num`, `strdate`, `enddate`, `title`, `sign`, `text`, `date`) VALUES
(3, '是电风扇的', 11, 11, '第三方第三方', 11, 7, '沙发上', 11, 10, '梵蒂冈的', 11, 5, '的鬼地方个', 11, 6, 550, '1466006400', '1471536000', '发送到发送到', 50, '&lt;p&gt;						&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;发的说法是否&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;						&lt;/p&gt;', '1466069562');

-- --------------------------------------------------------

--
-- 表的结构 `tp_choujiang_win`
--

CREATE TABLE IF NOT EXISTS `tp_choujiang_win` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '活动id',
  `username` varchar(200) NOT NULL,
  `prize` varchar(200) NOT NULL COMMENT '奖品',
  `date` varchar(20) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `tp_choujiang_win`
--

INSERT INTO `tp_choujiang_win` (`id`, `pid`, `username`, `prize`, `date`) VALUES
(1, 3, '123', '四等奖', '1467097932'),
(2, 3, '123', '四等奖', '1467163699'),
(3, 3, '123', '五等奖', '1467163735'),
(4, 3, '123', '二等奖', '1467163747'),
(5, 3, '123', '三等奖', '1467177355'),
(6, 3, '123', '一等奖', '1467180806'),
(7, 3, '123', '的鬼地方个', '1467191095'),
(8, 3, '123', '沙发上', '1468308590');

-- --------------------------------------------------------

--
-- 表的结构 `tp_code`
--

CREATE TABLE IF NOT EXISTS `tp_code` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name_id` varchar(20) NOT NULL COMMENT '用户名',
  `code` varchar(10) NOT NULL COMMENT '验证码',
  `time` varchar(50) DEFAULT NULL COMMENT '时间戳',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='验证码记录表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `tp_code`
--

INSERT INTO `tp_code` (`id`, `name_id`, `code`, `time`) VALUES
(1, '18765218752', '957164', '1451007238'),
(2, '14768906513', '821957', '1453165529'),
(3, '15866898306', '494141', '1453105117');

-- --------------------------------------------------------

--
-- 表的结构 `tp_company`
--

CREATE TABLE IF NOT EXISTS `tp_company` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `main_img` varchar(500) NOT NULL COMMENT '图片',
  `text` text,
  `date` varchar(15) DEFAULT NULL,
  `class_id` int(4) unsigned DEFAULT NULL,
  `status` int(4) unsigned DEFAULT '1',
  `sort` int(4) unsigned DEFAULT '1',
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- 转存表中的数据 `tp_company`
--

INSERT INTO `tp_company` (`id`, `title`, `main_img`, `text`, `date`, `class_id`, `status`, `sort`, `edit_date`) VALUES
(26, '九万愿景', '/Uploads/2016-08-23/57bbbd313dd6b.PNG', '<p>						</p><p><span style="color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 12px; background-color: rgb(255, 255, 255);">山东九万文化传媒有限公司从2015年12月开始运作，公司主要业务，便民信息免费发布，商业信息收费宣传，还有公司提供的几款一件代发产品，无需进货，利润丰厚。经过公司代理的运营发展，市场效果反应极好，公司于2016年3月，由山东省工商局审核正式注册成立，注册资金500万元。从最初几位代理，发展到现在全国100多个工作群1000多位代理，每天都在增加，我们的代理人分布北京、山东、上海、南京、深圳、江苏等省市，覆盖全国400多个城市和地区。公司战略目标是打造全球自媒体推广平台航母。</span></p><p>						</p>', '1467179671', NULL, 1, 0, '1471921457'),
(28, '九万微传媒加盟事宜', '/Uploads/2016-08-09/57a97cb14230b.png', '&lt;p style=&quot;text-align:center;text-autospace:none&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;适合人群：&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;80&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;后创业&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;,&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;二次创业&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;,&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;小本创业&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;,&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;大学生创业&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;,&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;兼职创业&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;,&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;农民致富&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;,&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;详情请＋微信咨询。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;一、加盟条件&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;1&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、适合人群：大学生、全职妈妈、上班族做兼职、时间自由安排者&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;2&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、准备软件：微信、&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;QQ&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;3&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、加盟费用：&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;800&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;元&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;二、准备工作&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;1&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、准备好手机、手机卡（开通流量包）、下载好微信。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;2&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、注册一个新的微信号（工作生活分离开）。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;3&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、身份证扫描件或拍照（入档）&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;4&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、根据自己的活动范围定一个区域。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;比如：住青岛市崂山区，代理区域为：崂山微视角&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;三、鉴定推广平台代管人协议。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;方法一、公司根据推广平台代管人的区域制定合同，微信回复，鉴定。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;方法二、当面签订合同。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;方法三、邮寄&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;四、工作内容&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;概述：工作工具&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;“&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;微信&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;”&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;，把我们微信的朋友圈比作一个平台，通过平台帮助我们当地的人发布一写便民信息（免费）和商业信息（收费），收费标准跟负责人索取。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;1&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、便民信息内容：拼车、交友、招聘、求职、二手买卖、吃喝玩乐、衣食住行&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;2&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、商业信息：商家在加盟商朋友圈以销售为目的的推广和以宣传微目的的推广都定义为商业信息。便民信息也可以转化为商业信息，比如：好友的招聘信息需要长期性，工作的性质为临时工，那么他的信息就可以在我们的朋友圈长期有效，那么这样的信息也可以定义为商业信息。总结：只要好友的信息能够长期推广，并且长期有效，就可以定义为商业信息。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;3&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、便民信息发布：客户要求发布时发布一次&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;4&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、商业信息发布：自付费起按照规定的时间按照规定的标准发布信息到朋友圈。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;例：一月&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;3&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;图：一个月内每天发布一条文字信息附带&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;3&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;张图片。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;5&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、其他商业信息：微店推广、品牌宣传、投资理财信息、办卡业务、长期拼车业务，长期招聘业务。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;五、统一管理&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;1&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、统一昵称&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;2&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、统一设置微信&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;3&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、统一头像&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;4 &lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、统一管理&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;5&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、统一朋友圈背景图&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;六、平台代管人提成&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;1&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、广告费提成：根据加盟商谈来广告费用提取&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;60%---80%&lt;/span&gt;&lt;span style=&quot;font-size: 17px;font-family:宋体;color:#0E0E0E&quot;&gt;一次性返给加盟商。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;2&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:宋体;color:#0E0E0E&quot;&gt;、推荐代管人：推荐一个客户成功代管平台微视角一次性给付提成。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;3&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family: 宋体;color:#0E0E0E&quot;&gt;、网站、公众号：根据费用的&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family:Arial;color:#0E0E0E&quot;&gt;60%&lt;/span&gt;&lt;span style=&quot;font-size:17px;font-family: 宋体;color:#0E0E0E&quot;&gt;提成给平台代管人。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1470725297', NULL, 1, 0, NULL),
(23, '九万传媒简介', '/Uploads/2016-08-09/57a97f64b23ae.PNG', '<p>						</p><p><br/></p><p><br style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;"/><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;">&nbsp; &nbsp; &nbsp; 山东九万文化传媒有限公司从</strong><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;">201</strong><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;">5</strong><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;">年12月开始运作，公司主要业务，便民信息免费发布，商业信息收费宣传，还有公司提供的几款一件代发产品，无需进货，利润丰厚。经过公司代理的运营发展，市场效果反应极好，公司于</strong><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;">2016</strong><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;">年3月，由山东省工商局审核正式注册成立，注册资金5</strong><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;">00</strong><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;">万元。从最初几位代理，发展到现在全国100多个工作群1</strong><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;">000</strong><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;">多位代理，每天都在增加，我们的代理人分布北京、山东、上海、南京、深圳、江苏等省市，覆盖全国</strong><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;">400</strong><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;">多个城市和地区。公司战略目标是打造全球自媒体推广平台航母。</strong></p><p><strong style="padding: 0px; margin: 0px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;"><img src="/ueditor/php/upload/image/20160809/1470725971527276.png" title="1470725971527276.png" alt="IMG_8706.PNG"/></strong></p><p><br/></p><p>						</p>', '1465695754', NULL, 1, 1, '1470725988'),
(27, '九万微传媒团队活动＆公益爱心满天下', '/Uploads/2016-08-09/57a9763fd70e7.jpg', '<p>						</p><p><br/></p><h2 style="padding: 0px; margin: 0px 3px 15px; white-space: normal; font-family: 宋体; font-size: 14px; line-height: 23.799999237060547px; text-indent: 30px;"><span style="padding: 0px; margin: 0px; font-size: 18px; font-family: &#39;trebuchet ms&#39;, helvetica, sans-serif;">&nbsp;</span><span style="font-size: 14px;"><span style="padding: 0px; margin: 0px; font-family: &#39;trebuchet ms&#39;, helvetica, sans-serif;">山东九万文化传媒有限公司精英团队赴贫困村义务帮助蒜农打蒜薹，并进村看望慰问空巢老人，</span><span style="padding: 0px; margin: 0px; font-family: &#39;trebuchet ms&#39;, helvetica, sans-serif;">在慰问活动现场，我们捐赠多克自热炎痛贴100贴，海尔洗衣机一台，老人们深受感动。</span></span></h2><h2 style="padding: 0px; margin: 0px 3px 15px; white-space: normal; font-family: 宋体; font-size: 14px; line-height: 23.799999237060547px; text-indent: 30px;"><span style="padding: 0px; margin: 0px; font-family: &#39;trebuchet ms&#39;, helvetica, sans-serif; font-size: 14px;">爱老敬老助老是全社会的共同责任。今后，山东九万文化传媒有限公司将一如既往地认真贯彻落实五中全会提出的“积极开展应对人口老龄化的行动”精神，继续以“关爱失能老人”为重点，努力让更多老人特别是失能、失独等特殊群体的困难老人共享发展成果，安享幸福晚年，为实现全面建成小康社会的目标，实现中华民族伟大复兴的“中国梦”做出积极贡献！<br style="padding: 0px; margin: 0px;"/><img src="/ueditor/php/upload/image/20160809/1470725883617127.jpg" title="1470725883617127.jpg" alt="1-160602142520524.jpg"/><span style="padding: 0px; margin: 0px; font-family: &#39;trebuchet ms&#39;, helvetica, sans-serif; font-size: 14px; color: rgb(68, 68, 68); line-height: 18px;">&nbsp; &nbsp; &nbsp; &nbsp;</span></span></h2><h2 style="padding: 0px; margin: 0px 3px 15px; white-space: normal; font-family: 宋体; font-size: 14px; line-height: 23.799999237060547px; text-indent: 30px;"><span style="padding: 0px; margin: 0px; font-family: &#39;trebuchet ms&#39;, helvetica, sans-serif; font-size: 14px;"><span style="padding: 0px; margin: 0px; font-family: &#39;trebuchet ms&#39;, helvetica, sans-serif; font-size: 14px; color: rgb(68, 68, 68); line-height: 18px;">山东九万文化传媒有限公司一直通过细微但有意义的方式不断美化现在和未来的生活，积极致力于社会公益事业，不仅仅体现在九万公司的产品品牌和服务上，更体现在九万公司作为一个有高度责任感的企业所承担的社会责任上。</span></span></h2><p><br/></p><p><br/></p><p>						</p>', '1470723648', NULL, 1, 0, '1470725893'),
(29, '济南大观园团队', '/Uploads/2016-08-23/57bbbdfb36c79.JPG', '&lt;p style=&quot;padding: 0px; margin-top: 0px; margin-bottom: 0px; line-height: 24px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;&quot;&gt;济南大观园团队&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-top: 0px; margin-bottom: 0px; line-height: 24px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;&quot;&gt;　　大家好，我们是济南大观园团队!&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-top: 0px; margin-bottom: 0px; line-height: 24px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;&quot;&gt;　　我们是一个有朝气，有梦想的新兴团队!是微视角把我们这一群梦想的人聚集到了一起!从而使我们团结有爱共同在九万微传媒这个大舞台创造美好的未来!&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-top: 0px; margin-bottom: 0px; line-height: 24px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;&quot;&gt;　　我们要做到：每天传递正能量，心怀感恩!遵守一切的规章制度!用心维护好每一个客户，共建我们的大家庭!&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-top: 0px; margin-bottom: 0px; line-height: 24px; color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; white-space: normal;&quot;&gt;　 &amp;nbsp; &amp;nbsp;九万大观园团队宣言：没有做不到的，只有不去做的!&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1471921659', NULL, 1, 0, NULL),
(30, '九万传媒免费手机福利！', '/Uploads/2016-08-23/57bbc23e045fb.jpg', '&lt;p&gt;&lt;span style=&quot;color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; background-color: rgb(255, 255, 255);&quot;&gt;为响应号召，支持国产，倡导理智爱国以及增加员工福利（我们不抵制苹果手机，但我们支持国产手机）本公司于7月23号为公司员工免费发放国产手机一部，手机分别有两个型号VivoX7和华为荣耀8，员工可根据自身需要选择型号。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; background-color: rgb(255, 255, 255);&quot;&gt;&lt;img src=&quot;/ueditor/php/upload/image/20160823/1471922747586635.jpg&quot; title=&quot;1471922747586635.jpg&quot; alt=&quot;1-160Q5161QX40.jpg&quot;/&gt;&lt;/span&gt;&lt;/p&gt;', '1471922750', NULL, 1, 0, NULL),
(31, '又一波福利--麻将机', '/Uploads/2016-08-23/57bbc2682d58b.jpg', '&lt;p&gt;&lt;span style=&quot;color: rgb(68, 68, 68); font-family: Verdana, Arial, Tahoma; font-size: 14px; background-color: rgb(255, 255, 255);&quot;&gt;继发手机的福利后，7月27日，公司为大家带来的是价值3500的雀友麻将机，并且公司老板表示，鼓励大家打麻将，增进员工感情，锻炼头脑，培养遇事沉着的性格，锻炼灵活应对事件的策略 。&lt;/span&gt;&lt;/p&gt;', '1471922792', NULL, 1, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_company_class`
--

CREATE TABLE IF NOT EXISTS `tp_company_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(100) DEFAULT NULL COMMENT '看诊类型名称',
  `status` int(4) unsigned DEFAULT NULL COMMENT '状态',
  `sort` int(11) unsigned DEFAULT NULL COMMENT '排序',
  `date` varchar(15) DEFAULT NULL COMMENT '写入时间',
  `edit_date` varchar(15) DEFAULT NULL COMMENT '编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='看诊类型表' AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `tp_company_class`
--

INSERT INTO `tp_company_class` (`id`, `name`, `status`, `sort`, `date`, `edit_date`) VALUES
(21, '会长简介', 1, 2211, '1453874902', '1454477401'),
(5, '公司介绍', 1, 122, '1453874683', '1454477377'),
(20, '目的宣言', 1, 0, '1453874794', '1454477390'),
(22, '全球网络', 1, 0, '1453874811', '1454477411'),
(23, '企业荣誉', 1, 0, '1453874821', '1454477425'),
(24, '联系方式', 1, 0, '1453874829', '1454477437');

-- --------------------------------------------------------

--
-- 表的结构 `tp_daynews`
--

CREATE TABLE IF NOT EXISTS `tp_daynews` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `text` text,
  `date` varchar(15) DEFAULT NULL,
  `class_id` int(4) unsigned DEFAULT NULL,
  `status` int(4) unsigned DEFAULT '1',
  `sort` int(4) unsigned DEFAULT '1',
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tp_daynews`
--

INSERT INTO `tp_daynews` (`id`, `title`, `text`, `date`, `class_id`, `status`, `sort`, `edit_date`) VALUES
(1, '', '', '1462511493', NULL, 0, 222, '1470726713');

-- --------------------------------------------------------

--
-- 表的结构 `tp_daything`
--

CREATE TABLE IF NOT EXISTS `tp_daything` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `tp_daything`
--

INSERT INTO `tp_daything` (`id`, `name`, `text`, `edit_date`) VALUES
(5, '11', 'dsfsdfsdfsfdsfdsfdsfs', '1463370629');

-- --------------------------------------------------------

--
-- 表的结构 `tp_daything_reply`
--

CREATE TABLE IF NOT EXISTS `tp_daything_reply` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `thing_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tp_daything_reply`
--

INSERT INTO `tp_daything_reply` (`id`, `name`, `thing_id`, `text`, `edit_date`) VALUES
(1, '123', 3, '啊哈哈', '1466996861'),
(2, '0', 0, '发斯蒂芬是否是', '1463377087'),
(3, '123', 7, '离家近', '1466576334'),
(4, '11', 10, 'fdsfdsf', '1463377859'),
(5, '123', 8, 'fsdfsdf', '1466567663');

-- --------------------------------------------------------

--
-- 表的结构 `tp_evaluation`
--

CREATE TABLE IF NOT EXISTS `tp_evaluation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `score` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '分数',
  `order_id` int(11) unsigned NOT NULL COMMENT '订单id',
  `user_id` varchar(20) DEFAULT NULL COMMENT '用户标识',
  `acc_id` varchar(20) DEFAULT NULL COMMENT '陪诊人员标识',
  `memo` text COMMENT '投诉内容',
  `type` int(2) unsigned DEFAULT '1' COMMENT '1好评2差评',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='评价表' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `tp_evaluation`
--

INSERT INTO `tp_evaluation` (`id`, `score`, `order_id`, `user_id`, `acc_id`, `memo`, `type`) VALUES
(1, 3, 3, NULL, 'ceshi', '打发打发dfdf666', 1),
(2, 4, 1, 'ff', 'ceshi', '打发打发dfdf666', 1),
(3, 5, 2, 'ff', 'ceshi', '打发打发dfdf666', 1),
(4, 0, 2, '3', 'ceshi', '打发打发dfdf666', 1),
(5, 0, 2, '3', 'ceshi', '打发打发dfdf666', 1),
(6, 0, 10, '3', 'ceshi', '打发打发dfdf666', 1),
(7, 0, 2, '3', 'ceshi', '打发打发dfdf666', 1),
(8, 0, 2, '3', 'ceshi', '打发打发dfdf666', 1),
(9, 0, 11, '3', '1111', '打发打发dfdf666', 1),
(10, 0, 2, 'vv', 'ceshi', '打发打发dfdf666', 1),
(11, 0, 2, 'vv', 'ceshi', '打发打发dfdf666', 1),
(12, 4, 1, 'vv', 'ceshi', '技能专业,衣着干净,态度和蔼,服务热情', 1),
(13, 0, 6, 'admin', 'ceshi', 'fdfdff', 1),
(14, 0, 6, 'admin', 'ceshi', 'fdfdff', 1),
(15, 0, 57, '14768906513', '14768906513', '', 1),
(16, 0, 51, '15866898306', '15866898306', '多收费,态度恶劣,不准时到岗,业务不熟悉ehiooerjhlkertlhjlktrhiohj', 2);

-- --------------------------------------------------------

--
-- 表的结构 `tp_expert`
--

CREATE TABLE IF NOT EXISTS `tp_expert` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(50) NOT NULL COMMENT '用户名称',
  `truename` varchar(20) DEFAULT NULL COMMENT '真实姓名',
  `head` varchar(300) DEFAULT NULL COMMENT '用户头像',
  `mobile` varchar(20) DEFAULT NULL COMMENT '用户手机号',
  `sex` tinyint(1) unsigned DEFAULT NULL COMMENT '用户性别',
  `birthday` varchar(50) DEFAULT NULL COMMENT '用户生日',
  `pass_text` varchar(50) DEFAULT NULL,
  `pass_initialize` int(2) unsigned DEFAULT '0' COMMENT '0为未修改，1为已修改',
  `password` varchar(50) NOT NULL COMMENT '用户密码',
  `email` varchar(100) NOT NULL COMMENT '用户邮箱',
  `edit_date` varchar(20) DEFAULT NULL,
  `date` varchar(20) NOT NULL COMMENT '用户注册时间',
  `login_time` varchar(10) NOT NULL COMMENT '当前登录时间',
  `old_login_time` varchar(10) NOT NULL COMMENT '上次登录时间',
  `login_ip` varchar(20) DEFAULT NULL COMMENT '当前登录ip',
  `old_login_ip` varchar(20) DEFAULT NULL COMMENT '上次登录ip',
  `status` int(2) unsigned DEFAULT NULL COMMENT '用户状态 0为禁用，1为可用',
  `sort` int(4) unsigned DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `member_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='专家表' AUTO_INCREMENT=71 ;

--
-- 转存表中的数据 `tp_expert`
--

INSERT INTO `tp_expert` (`id`, `name`, `truename`, `head`, `mobile`, `sex`, `birthday`, `pass_text`, `pass_initialize`, `password`, `email`, `edit_date`, `date`, `login_time`, `old_login_time`, `login_ip`, `old_login_ip`, `status`, `sort`) VALUES
(16, '徐慎凯11', '徐慎凯11', '/Public/Uploads/2015-12-07/56654b14c67fb.jpg', '136986603391', 0, '', '954101', 1, 'e3ceb5881a0a1fdaad01296d7554868d', '', '1448955330', '1448957309', '', '', NULL, NULL, 1, 1),
(19, '11', '11', NULL, '11', NULL, NULL, '108157', 0, 'd5e8e44b64114da668cc4f56debdd3b2', '', NULL, '1448873165', '', '', NULL, NULL, 1, 1),
(20, '222', '2', NULL, '22', NULL, NULL, '291076', 1, 'e3ceb5881a0a1fdaad01296d7554868d', '', '1448873876', '1448873811', '', '', NULL, NULL, 1, 2),
(24, 'ff1', 'ff1', NULL, 'ff1', NULL, NULL, '192764', 0, 'a5408661ac80d05c35324f1c00b5a03f', '', NULL, '1448956553', '', '', NULL, NULL, 1, 1),
(25, 'vv', 'vv', NULL, 'vv', NULL, NULL, '931105', 0, 'c3284d0f94606de1fd2af172aba15bf3', '', NULL, '1448956592', '', '', NULL, NULL, 1, 0),
(26, 'wwww', 'ww', 'Uploads/2015-12-07/5665232d686f5.jpg', 'ww', 0, '', '697481', 0, '760cd18d3ff09991260b15e4844597cd', '', NULL, '1449469348', '', '', NULL, NULL, 1, 0),
(27, 'fffrr', 'rr', 'Uploads/', '11rrr', NULL, NULL, '107259', 0, '98ad5fd2c787eb91c5d5ceafbaf1ff51', '', NULL, '1449469370', '', '', NULL, NULL, 1, 0),
(28, 'bbb', 'bb', 'Uploads/', 'bb', NULL, NULL, '748109', 0, '046b760186f4e9c32e157baf55a2880e', '', NULL, '1449469435', '', '', NULL, NULL, 1, 0),
(29, '11111', '2121', NULL, '11212121', NULL, NULL, '910687', 0, 'f6b837cc7e34fb79136288c92c1aed21', '', NULL, '1449469505', '', '', NULL, NULL, 1, 21),
(30, '11', '1', NULL, '1', NULL, NULL, '110246', 0, '40dd173c71c8ecd0d9c9ace4b27dc69a', '', NULL, '1449469539', '', '', NULL, NULL, 1, 1),
(31, '11', '1', NULL, '11', NULL, NULL, '810614', 0, 'e6cbc8e40a55a6101cf57b18c19da3f7', '', NULL, '1449469572', '', '', NULL, NULL, 1, 1),
(32, '11', '1', NULL, '1', NULL, NULL, '410167', 0, 'fe5e24741ad590bae29fbecc43e8c2d7', '', NULL, '1449469635', '', '', NULL, NULL, 1, 1),
(33, '11', '1', 'Uploads/', '1', NULL, NULL, '310965', 0, '72bedcf2fe51f2836cb23ce4dfbc5a31', '', NULL, '1449469671', '', '', NULL, NULL, 1, 1),
(34, '1121', '2', 'Uploads/', '12', NULL, NULL, '510726', 0, '891d6c27e309338638a8c5bc7f8fa273', '', NULL, '1449469689', '', '', NULL, NULL, 1, 2),
(35, '12', '1', 'Uploads/', '11', NULL, NULL, '105491', 0, '8db6195fda56efeb7458e3b9efd2761d', '', NULL, '1449469952', '', '', NULL, NULL, 1, 1),
(36, '12', '1', 'Uploads/', '11', NULL, NULL, '023867', 0, '57d05faa0798d09878d4fa8cc8e7047b', '', NULL, '1449470480', '', '', NULL, NULL, 1, 1),
(37, '', '', 'Uploads/', '', NULL, NULL, '375269', 0, '74be16979710d4c4e7c6647856088456', '', NULL, '1449471090', '', '', NULL, NULL, 0, 0),
(38, '', '', 'Uploads/', '', NULL, NULL, '356491', 0, '74be16979710d4c4e7c6647856088456', '', NULL, '1449471171', '', '', NULL, NULL, 0, 0),
(39, '', '', 'Uploads/2015-12-07/56652cf9753d9.jpg', '', NULL, NULL, '489125', 0, '74be16979710d4c4e7c6647856088456', '', NULL, '1449471225', '', '', NULL, NULL, 0, 0),
(40, '', '', 'Uploads/2015-12-07/56652d1eed261.jpg', '', NULL, NULL, '171058', 0, '74be16979710d4c4e7c6647856088456', '', NULL, '1449471262', '', '', NULL, NULL, 0, 0),
(41, '', '', 'Uploads/2015-12-07/56652d2b7a16e.jpg', '', NULL, NULL, '893514', 0, '74be16979710d4c4e7c6647856088456', '', NULL, '1449471275', '', '', NULL, NULL, 0, 0),
(42, '', '', 'Uploads/2015-12-07/56652d792d899.jpg', '', NULL, NULL, '829431', 0, '74be16979710d4c4e7c6647856088456', '', NULL, '1449471353', '', '', NULL, NULL, 0, 0),
(43, 'hhh', '1hhh', 'Uploads/2015-12-07/56652d8bd779f.jpg', 'hh', NULL, NULL, '104731', 0, 'a0f7c1cfa96808f66fe13ccf2ef53e8f', '', NULL, '1449471371', '', '', NULL, NULL, 0, 1),
(44, 'ee', 'e', 'Uploads/2015-12-07/56652d9bc13cd.jpg', 'e', NULL, NULL, '157108', 0, '5218ae2bb3c9961913d52c31c7b2084b', '', NULL, '1449471387', '', '', NULL, NULL, 0, 0),
(45, 'ww', 'w', 'Uploads/2015-12-07/56652da9a78d7.jpg', 'ww', NULL, NULL, '513109', 0, 'be017fda8ff6b6926d5e29bdb4fbea49', '', NULL, '1449471401', '', '', NULL, NULL, 0, 0),
(46, 'ww', 'w', 'Uploads/2015-12-07/56652de12383c.jpg', 'ww', NULL, NULL, '238197', 0, '4e3dc338f0645d7cc7cfec96d491ffef', '', NULL, '1449471457', '', '', NULL, NULL, 0, 0),
(47, '1', '11', 'Uploads/2015-12-07/56652de8c676a.jpg', '11', NULL, NULL, '952631', 0, '36f622466842011770321699980c93da', '', NULL, '1449471464', '', '', NULL, NULL, 0, 11),
(48, '11', '1hhh', 'Uploads/2015-12-07/56652fee19ffe.jpg', '1', NULL, NULL, '831956', 0, '38fc7a5a2fc64015aadb1dc259dacf94', '', NULL, '1449471982', '', '', NULL, NULL, 0, 11),
(49, '1', '1hhh1', 'Uploads/2015-12-07/56653407cb417.jpg', '111', NULL, NULL, '453261', 0, '10391d13f91605ce418bc4ced39eb209', '', NULL, '1449473031', '', '', NULL, NULL, 0, 1),
(50, '', '', 'Uploads/', '', NULL, NULL, '943582', 0, '4f418469f4d271b3fb24732f05724ea7', '', NULL, '1449473250', '', '', NULL, NULL, 0, 0),
(51, '', '', 'Uploads/', '', NULL, NULL, '156410', 0, '52461d160f95cae579abd9281c227711', '', NULL, '1449473419', '', '', NULL, NULL, 0, 0),
(52, '', '', 'Uploads/', '', NULL, NULL, '845297', 0, '863a54a6231f1a5265d8613489cf8bfc', '', NULL, '1449473440', '', '', NULL, NULL, 0, 0),
(53, '', '', 'Uploads/', '', NULL, NULL, '653781', 0, '68b8ccf435f36ca88de39c3e432468b7', '', NULL, '1449473514', '', '', NULL, NULL, 0, 0),
(54, '', '', 'Uploads/', '', NULL, NULL, '810546', 0, '6a2cb2eb09c008a47f25eb80ff717b96', '', NULL, '1449473529', '', '', NULL, NULL, 0, 0),
(55, '', '', 'Uploads/', '', NULL, NULL, '321057', 0, 'dae9c244d0ead5657913d1d15b3fef99', '', NULL, '1449473592', '', '', NULL, NULL, 0, 0),
(56, '', '', 'Uploads/', '', NULL, NULL, '489357', 0, '53f625c3dfb3b524e42f8aa5b4c74b94', '', NULL, '1449473630', '', '', NULL, NULL, 0, 0),
(57, '', '', 'Uploads/', '', NULL, NULL, '419786', 0, 'c43f64b113cfc6baa993bab88c22f95e', '', NULL, '1449473638', '', '', NULL, NULL, 0, 0),
(58, '', '', 'Uploads/', '', NULL, NULL, '913268', 0, '7a2e9c68b97e6aa98c9f5146cbe2d4d1', '', NULL, '1449473716', '', '', NULL, NULL, 0, 0),
(59, '', '', 'Uploads/', '', NULL, NULL, '451031', 0, 'da1e9ce6571d0f4e0f44cef30ae41261', '', NULL, '1449473733', '', '', NULL, NULL, 0, 0),
(60, '', '', 'Uploads/2015-12-07/566537cfd3e3f.jpg', '', NULL, NULL, '310648', 0, '46637b99a44abaa5a735e28357977891', '', NULL, '1449473999', '', '', NULL, NULL, 0, 0),
(61, '', '', 'Uploads/2015-12-07/566538043ef6b.jpg', '', NULL, NULL, '146328', 0, 'e2622ef84c2798ee18eec084fb2fe544', '', NULL, '1449474052', '', '', NULL, NULL, 0, 0),
(62, '', '', 'Uploads/', '', NULL, NULL, '971045', 0, '9d077171a410e59c3f2941610b96e64f', '', NULL, '1449474133', '', '', NULL, NULL, 0, 0),
(63, '', '', 'Uploads/', '', NULL, NULL, '679834', 0, 'cf24902b2679c788ad91a5dafe63a310', '', NULL, '1449474133', '', '', NULL, NULL, 0, 0),
(64, '', '', 'Uploads/', '', NULL, NULL, '108157', 0, 'd5e8e44b64114da668cc4f56debdd3b2', '', NULL, '1449474134', '', '', NULL, NULL, 0, 0),
(65, '11', '1', 'Uploads/', '1', NULL, NULL, '109832', 0, '8f09b075f4d87191d15890436cb2a4a5', '', NULL, '1449474532', '', '', NULL, NULL, 1, 0),
(66, '11', '1', 'Uploads/', '1', NULL, NULL, '865791', 0, 'ebad7f70860a9c9fc4d9bd3d970a1c4a', '', NULL, '1449474534', '', '', NULL, NULL, 1, 0),
(67, '11', '1', 'Uploads/', '1', NULL, NULL, '854110', 0, 'ed1cc37c9ba8fdb99a17aaac045ebf9d', '', NULL, '1449474535', '', '', NULL, NULL, 1, 0),
(68, '111', '111', NULL, '11', NULL, NULL, '576392', 0, 'e2c80552ed486c3a4031e731224b2660', '', NULL, '1449474615', '', '', NULL, NULL, 1, 11),
(69, '111', '1hhh1', NULL, '111', NULL, NULL, '965321', 0, 'def77128642e4903af25b46f800cf5ec', '', NULL, '1449475385', '', '', NULL, NULL, 1, 1),
(70, '111', '1hhh1', NULL, '111', NULL, NULL, '219310', 0, '5639f2655529a8eda764a61d180a3714', '', NULL, '1449475388', '', '', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_forward`
--

CREATE TABLE IF NOT EXISTS `tp_forward` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `text` text,
  `status` int(4) unsigned DEFAULT '1',
  `sort` int(4) unsigned DEFAULT '1',
  `url` varchar(500) NOT NULL COMMENT '分享地址',
  `money` double NOT NULL COMMENT '访问一次金额',
  `date` int(11) NOT NULL COMMENT '日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `tp_forward`
--

INSERT INTO `tp_forward` (`id`, `title`, `text`, `status`, `sort`, `url`, `money`, `date`) VALUES
(4, '《多克保健书册》多克自热炎痛贴可以解决什么问题', '<p>						</p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"><iframe class="video_iframe" height="502.5" width="670" frameborder="0" data-src="https://v.qq.com/iframe/preview.html?vid=v1300j0hh0i&amp;width=500&amp;height=375&amp;auto=0" allowfullscreen="" src="https://v.qq.com/iframe/player.html?vid=v1300j0hh0i&width=670&height=502.5&auto=0" scrolling="no" style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; display: block; z-index: 1; width: 670px !important; height: 502.5px !important; overflow: hidden;"></iframe><br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/><strong style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 16px; line-height: 22px; background-color: rgb(115, 252, 214); color: rgb(255, 76, 0);">&nbsp;多克自热炎痛贴的适用范围</span></strong></span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"><strong style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 16px; line-height: 22px; color: rgb(255, 76, 0);"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span></strong></span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><strong style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; color: rgb(255, 76, 0); background-color: rgb(115, 252, 214); max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;">1、多克自热炎痛贴的适用范围有哪些</span></strong></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"> &nbsp; &nbsp; &nbsp; &nbsp;<span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;">多克自热炎痛贴适用于对软组织损伤、风湿关节炎、骨质增生、颈椎病、腰肌劳损、腰椎间盘突出等引起的疼痛、肩周炎、慢性前列腺炎、慢性盆腔炎、慢性胃肠炎等炎症、痛症。<br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/><br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/><strong style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 16px; color: rgb(255, 76, 0); background-color: rgb(115, 252, 214);">2、软组织损伤</span></strong></span></span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; text-align: center; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><br/></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"> &nbsp; &nbsp; &nbsp; &nbsp;<span style="margin: 0px; padding: 0px; color: rgb(255, 76, 0); max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;">什么叫软组织损伤：</span>软组织损伤是指各种急性外伤或慢性劳损以及自己疾病病理等原因造成人体的皮肤、皮下浅深筋膜、肌肉、肌腱、腱鞘、韧带、关节囊、滑膜囊、椎间盘、周围神经血管等组织的病理损害，称为软组织损伤。<br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/> &nbsp; &nbsp; &nbsp;<span style="margin: 0px; padding: 0px; color: rgb(255, 76, 0); max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"> &nbsp;软组织损伤有哪些症状：</span>主要症状为局部充血、发红、淤血、血肿、肿胀、疼痛、活动受限。其疼痛一是由于局部肿胀产生的张力性疼痛，二是血管破裂、渗透压改变致痛性化学介质、乳酸等的堆积均可导致剧烈的疼痛，三是活动时会进一步刺激损伤组织而致痛.。</span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"> &nbsp; &nbsp; &nbsp; &nbsp;<span style="margin: 0px; padding: 0px; color: rgb(255, 76, 0); max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;">多克怎样治疗软组织损伤：</span>急性软组织损伤初期不贴多克，也不宜进行其他热疗，更不能做局部推拿按摩，以免使局部损伤面扩大，出血增多，渗出物增多，肿胀淤血加重。刚受伤后宜做局部冷敷或冰袋，使损伤局限，出血与渗出尽量减少。24小时后即可将多克自热炎痛贴贴在受伤部位。如果是膝盖、踝、肘等活动度大的关节，则需另加固定带辅助固定。但不宜用绷带多层紧密包扎，以免使热量过于集中发生烫伤。慢性软组织损伤不存在急性期，不需做冷敷，可直接贴多克自热炎痛贴。但因病期久，需较长时间治疗。 <br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/> &nbsp; &nbsp; &nbsp; &nbsp;多克自热炎痛贴对软组织损伤的疗效十份显著，急性软组织损伤病情轻者1-3贴即可治愈或收到显著效果。一般6-8贴即可。多克自热炎痛贴并不排除进行其他合理的治疗。<br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 16px; color: rgb(255, 76, 0); background-color: rgb(115, 252, 214);"><strong style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;">3、风湿关节炎</strong></span></span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; color: rgb(255, 76, 0);"><strong style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/></strong></span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"> &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px; color: rgb(255, 76, 0);">什么是风湿关节炎：</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;">风湿关节炎是风湿热在关节局部的一种临床表现。它是由风湿热引起的，心脏病变不明确的、以关节炎为主要表现的全身慢性炎症。祖国医学将本病称为痹症。为一种慢性、反复发作的疾病。 </span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px; line-height: 22px;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/></span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"> &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px; color: rgb(255, 76, 0);">风湿关节炎有哪些症状：</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;">急性期可出现典型的红、肿、热、痛的的炎性症状但不化脓，且呈多关节性，游走性，常不对称累及膝，踝、肩、肘、腕等大关节，亦有累及手、足小关节者。可伴有关节运动障碍。少数人可有皮下风湿结节：血沉及抗“O”均显著增高。慢性风湿性关节炎往往只表现为反复发作的、游走的关节酸痛，且可随天气之变化加重或减轻，寒冷、下雨、潮湿加重。但关节功能完全正常， 无关节强直和畸形。 </span><br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"> &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px; color: rgb(255, 76, 0);">风湿性关节炎如何应用多克自热炎痛贴治疗：</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;">温热疗法尤其适用于风湿性关节炎的治疗。 急性风湿性关节炎宜卧床休息，住医院治疗。多克自热炎痛贴在急、慢性期均适宜应用。即使在急性期，为缓解关节的肿胀、炎症和疼痛，均可贴敷。但不要用厚的棉毡物品包扎，防止温度过高。贴时有意留一些间隙，贴得松一些，增加热的散逸，减低温度，因为急性期适宜用低温。</span><br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"> &nbsp; &nbsp; &nbsp; </span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px; color: rgb(255, 76, 0);"> 慢性期则更适宜贴多克。</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;">但由于本病的特点就是反复发作， 游走性。因此 ，在心理上一定不要抱过高的期望值。有效是肯定的，根治是困难的。贴敷对风湿关节痛的疗效较好。</span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"><br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 16px; color: rgb(255, 76, 0); background-color: rgb(115, 252, 214);"><strong style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;">4、骨质增生症（又叫退行性关节炎）</strong></span></span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; color: rgb(255, 76, 0);"><strong style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/></strong></span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"> &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px; color: rgb(255, 76, 0);"> 什么叫骨质增生症：</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;">“骨质增生”只是一种现象，并不是一个疾病的诊断名称。数十年来，人们主诉这痛那痛，多种治疗效果很差。一照X光，发现骨质增生，于是大家都习惯称它为“骨质增生”。实际上它应该叫“退行性关节炎”，是人体的关节及软骨的一种慢性退行性疾病。病名五花八门，如：老年性关节炎、增生性关节炎、肥大性关节炎、骨关节炎、骨关节病等。其实，骨质增生可以完全没有症状，只有在骨质增生由于受凉、劳累、姿势不当等诱因导致了无菌性炎症或引起疼痛等症状时，才能称为“骨质增生症”。</span><br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px; color: rgb(255, 76, 0);"> &nbsp; &nbsp; &nbsp; &nbsp;骨质增生症有哪些症状：</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;">主要症状是关节疼痛，多于晨间发生，活动后减轻，但如活动过多，可因关节摩擦而使疼痛加重。 另一症状是关节活动不灵便，长时间保持一定体位后感觉关节僵硬， 经过一定时间的活动才缓解。 有时疼痛会与气候变化有关。关节局部有时会有轻度肿胀，活动时有麻擦声或喀喇声，严重时可出现肌肉萎缩及关节畸形。 </span><br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"> &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px; color: rgb(255, 76, 0);">怎样使用多克自热炎痛贴治疗骨质增生：</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;">骨质增生引起的疼痛是一种闭合性软组织损伤。治疗的方法主要以消炎、镇痛，促使局部炎症恢复，使损伤的组织修复。多克自热炎痛贴连续十几小时的温热加TDP作用，使局部血液循环持续加速，把局部的炎性产物、致痛化学介质等经血液循环带走。同时将修补物质经血液循环运达损伤局部，加速局部损伤的修复， 以达到消炎镇痛之目的。因此而收到显著的治疗效果，疼痛可以显著减轻甚至消失，但增生的骨刺、骨赘依然存在。</span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"><br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/></span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"></span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><strong style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; color: rgb(255, 76, 0); background-color: rgb(115, 252, 214);">5、肩周炎</span></strong></span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/> &nbsp; &nbsp; &nbsp; </span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px; color: rgb(255, 76, 0);"> &nbsp;</span></p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; clear: both; min-height: 1em; white-space: pre-wrap; color: rgb(62, 62, 62); font-family: &#39;Helvetica Neue&#39;, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, Arial, sans-serif; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px; color: rgb(255, 76, 0);"> &nbsp; &nbsp; &nbsp; &nbsp;什么是肩周炎：</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;">肩周炎是关节周围的肌肉、肌腱、滑囊等软组织的一种无菌慢性炎症，故名“肩关节周围炎”。简称“肩周炎”，又称“凝肩”、“冻结肩”、“肩关节粘连”、“粘连性关节炎”。又由于它多见于50岁以上的中老年人， 故又有“五十肩”之名。中医称为“漏肩风”。其实， 肩周炎是一个“大家族”，包括粘连性肩关节囊炎、肩峰下滑囊炎、</span><span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;">冈<span style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important; font-size: 14px;">上肌腱炎、肱二头肌长头肌腱炎等许多种疾患。<br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/> &nbsp; &nbsp; &nbsp; <span style="margin: 0px; padding: 0px; color: rgb(255, 76, 0); max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;">肩周炎有那些症状：</span>主要症状为肩痛。自觉肩及上臂疼痛，常为单侧，多为钝痛，严重时肩部肌肉抽搐痛、刀割样痛，并伴有酸、胀、无力感，稍一活动、碰触即感疼痛难忍，甚至夜间痛醒。肩部僵硬、活动受限。尤以外展、外旋时明显，自己不能穿衣、脱衣、梳头、插口袋、拧门把等动作。病程长时可出现肩、上臂肌肉萎缩。<br style="margin: 0px; padding: 0px; max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"/> &nbsp; &nbsp; &nbsp; &nbsp;<span style="margin: 0px; padding: 0px; color: rgb(255, 76, 0); max-width: 100% !important; box-sizing: border-box !important; word-wrap: break-word !important;"> 肩周炎的物理治疗：</span>理疗的目的在于改善局部血液循环，加强局部组织营养，消除局部无菌性炎症，止痛，加强肌张力，增进活动范围，防治肌萎缩，恢复肩关节功能。为此，几乎所有的物理疗法均能应用。各种温热疗法（短波、超短波、微波、红外线、TDP、石蜡疗法—），各种低中频治疗以及超声波、推拿按摩、医疗体育、水中运动等。多克自热炎痛贴集远红外热疗、TDP、灸疗于一身，长时间贴敷，对改善肩部组织营养、消炎、镇痛等甚有助益。贴的部位主要是肩部。</span></span></p><p><img src="/ueditor/php/upload/image/20160823/1471923250357066.jpg" title="1471923250357066.jpg" alt="IMG_9130.JPG" width="535" height="698" style="width: 535px; height: 698px;"/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p>						</p>', 1, 7777, 'http://mp.weixin.qq.com/s?__biz=MzA3MDkzNTM2Mg==&mid=2652246850&idx=2&sn=87a22479fbb65c0cb3308f5ec8258458&scene=23&srcid=0627cGHiR0PiRcN7txCXlPDN#rd', 0.12, 1465809093),
(5, '济南九码--打标机中的战斗机！', '<p>						</p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p>&nbsp;济南九码电子有限公司坐落于“泉城美丽的济南”,公司以打码机为主导、集设计、开发、生产、销售于一体。雄厚的科技实力，使我公司在多年的行业竞争中奠定了结实的基础。公司产品以激光打标机、气动打标机为主,不断在激光及工业自动化领域研发和扩充新的产品,致力于为各行业提供工业自动化系统解决方案。九码品质-质量第一！&nbsp;</p><p><img src="/ueditor/php/upload/image/20160823/1471923633309173.jpg" style="width: 405px; height: 500px;" title="1471923633309173.jpg" width="405" height="500"/></p><p><br/></p><p><img src="/ueditor/php/upload/image/20160823/1471923633999828.jpg" style="width: 434px; height: 1280px;" title="1471923633999828.jpg" width="434" height="1280"/></p><p><br/></p><p><br/></p><p><br/></p><p>地址：济南市济洛路61号</p><p>&nbsp;邮编：250000</p><p>&nbsp;电话：0531-88398588</p><p>&nbsp;技术：15562697582</p><p>&nbsp;邮箱：jnjmdz@163.com</p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p>						</p>', 1, 33, '', 0.18, 1465809190);

-- --------------------------------------------------------

--
-- 表的结构 `tp_forward_sign`
--

CREATE TABLE IF NOT EXISTS `tp_forward_sign` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '文章id',
  `username` varchar(500) NOT NULL COMMENT '代理',
  `money` double NOT NULL COMMENT '代理商获取的金钱',
  `ip` varchar(500) NOT NULL COMMENT '访问ip',
  `date` int(11) NOT NULL COMMENT '日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- 转存表中的数据 `tp_forward_sign`
--

INSERT INTO `tp_forward_sign` (`id`, `fid`, `username`, `money`, `ip`, `date`) VALUES
(2, 4, '123', 2, '127.0.0.1', 1465883903),
(3, 6, '123', 2, '127.0.0.1', 1465884455),
(4, 3333, '123', 1, '127.0.0.1', 1465884457),
(5, 4, '123', 555, '192.168.0.216', 1466494277),
(6, 5, '123', 33, '192.168.0.216', 1466496792),
(7, 6, '123', 4545, '192.168.0.216', 1466496798),
(8, 4, '123', 555, '192.168.0.187', 1466558879),
(9, 6, '123', 4545, '192.168.0.187', 1466561678),
(10, 5, '123', 33, '192.168.0.187', 1466561743),
(11, 4, '123', 555, '192.168.0.232', 1466647899),
(12, 4, '123', 555, '192.168.0.200', 1466736725),
(13, 5, '123', 33, '192.168.0.200', 1466738087),
(14, 4, '123', 555, '58.56.179.142', 1466992931),
(15, 5, '123', 33, '58.56.179.142', 1466992952),
(16, 6, '123', 0.12, '58.56.179.142', 1466993176),
(17, 4, '123', 0.12, '123.168.94.93', 1467035579),
(18, 4, '123', 0.12, '27.193.43.238', 1467163130),
(19, 6, '123', 0.12, '27.193.43.238', 1467181922),
(20, 6, '123', 0.12, '112.65.193.16', 1467181947),
(21, 6, '123', 0.12, '101.226.103.70', 1467181947),
(22, 6, '123', 0.12, '101.226.65.102', 1467181956),
(23, 6, '123', 0.12, '180.153.201.216', 1467181960),
(24, 6, '123', 0.12, '101.226.51.227', 1467181967),
(25, 4, '123', 0.12, '180.153.214.182', 1467183484),
(26, 4, '123', 0.12, '101.226.103.69', 1467183485),
(27, 4, '123', 0.12, '180.153.206.37', 1467183489),
(28, 4, '123', 0.12, '101.226.103.70', 1467187017),
(29, 4, '123', 0.12, '180.153.163.186', 1467187162),
(30, 4, '123', 0.12, '101.226.65.102', 1467187162),
(31, 4, '123', 0.12, '101.226.125.19', 1467187163),
(32, 4, '123', 0.12, '123.151.42.46', 1467187380),
(33, 4, '123', 0.12, '112.225.129.94', 1467187392),
(34, 4, '123', 0.12, '14.17.43.104', 1467191982),
(35, 4, '123', 0.12, '101.226.125.121', 1467192782),
(36, 4, '123', 0.12, '218.58.87.231', 1467853990),
(37, 4, '123', 0.12, '123.234.56.248', 1468308507),
(38, 4, '456', 0.12, '180.153.214.176', 1468381365),
(39, 4, '456', 0.12, '101.226.103.73', 1468381365),
(40, 4, '456', 0.12, '180.153.206.24', 1468381370),
(41, 4, '456', 0.12, '180.153.201.217', 1468381376),
(42, 4, '456', 0.12, '101.226.33.224', 1468381378),
(43, 4, '123', 0.12, '113.129.167.151', 1468559136),
(44, 4, '123', 0.12, '180.153.206.32', 1468559148),
(45, 4, '123', 0.12, '180.153.201.216', 1468559157),
(46, 4, '123', 0.12, '121.42.0.86', 1468688526),
(47, 4, '123', 0.12, '121.42.0.85', 1468688632),
(48, 4, '123', 0.12, '121.42.0.62', 1468689580),
(49, 4, '123', 0.12, '121.42.0.55', 1468689585),
(50, 4, '123', 0.12, '121.42.0.64', 1468689633),
(51, 4, '123', 0.12, '121.42.0.67', 1468690160),
(52, 4, '123', 0.12, '121.42.0.36', 1468690424),
(53, 4, '123', 0.12, '121.42.0.60', 1468691384),
(54, 4, '123', 0.12, '121.42.0.73', 1468692468),
(55, 4, '123', 0.12, '121.42.0.14', 1468775744),
(56, 4, '623491789', 0.12, '218.57.80.212', 1471923839),
(57, 5, '623491789', 0.18, '218.57.80.212', 1471923855),
(58, 4, '123', 0.12, '101.226.103.71', 1471924828),
(59, 4, '123', 0.12, '101.226.33.217', 1471925016),
(60, 4, '123', 0.12, '101.226.66.172', 1471925021);

-- --------------------------------------------------------

--
-- 表的结构 `tp_group_hx`
--

CREATE TABLE IF NOT EXISTS `tp_group_hx` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `market_id` varchar(20) NOT NULL COMMENT '群组标识',
  `market_name` varchar(50) DEFAULT NULL COMMENT '群组名称',
  `create_user` varchar(20) NOT NULL COMMENT '创建人',
  `create_time` varchar(50) NOT NULL COMMENT '创建时间',
  `group_id` varchar(50) NOT NULL COMMENT '群组id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='环信群组表' AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `tp_group_hx`
--

INSERT INTO `tp_group_hx` (`id`, `market_id`, `market_name`, `create_user`, `create_time`, `group_id`) VALUES
(11, 'SDQDSLCQ', '山东青岛市李沧区', '361212739', '1466587067', '210549051492401604'),
(12, 'SDQDSSQ', '山东青岛市崂山区', '321', '1467618153', '214977516400542160'),
(13, 'SHSHSHPQ', '上海上海市黄浦区', '111', '1467619999', '214985445799363020'),
(14, 'SDQDSSBQ', '山东青岛市市北区', '623491789', '1470733576', '228358154209984956'),
(15, 'SDJNSHYQ', '山东济南市槐荫区', '125941800', '1470733802', '228359126076359100'),
(16, 'SDJNSTQQ', '山东济南市天桥区', '932582936', '1470734412', '228361744743924140'),
(17, 'SDQDSPDS', '山东青岛市平度市', '535667261', '1470738616', '228379804016050620'),
(18, 'SDJNSSZQ', '山东济南市市中区', '923144374', '1470962520', '229341463446553016'),
(19, 'SDQDSSNQ', '山东青岛市市南区', '123', '1471924720', '233474081192673728');

-- --------------------------------------------------------

--
-- 表的结构 `tp_learning`
--

CREATE TABLE IF NOT EXISTS `tp_learning` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `main_img` varchar(500) NOT NULL COMMENT '图片',
  `text` text,
  `date` varchar(15) DEFAULT NULL,
  `class_id` int(4) unsigned DEFAULT NULL,
  `status` int(4) unsigned DEFAULT '1',
  `sort` int(4) unsigned DEFAULT '1',
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `tp_learning`
--

INSERT INTO `tp_learning` (`id`, `title`, `main_img`, `text`, `date`, `class_id`, `status`, `sort`, `edit_date`) VALUES
(14, '九万微传媒加盟合作协议', '/Uploads/2016-08-09/57a98104e3d62.jpg', '<p style="text-align:center;text-indent:59px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 黑体;">合 作 协 议</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 黑体;">甲方：山东九万文化传媒有限公司</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 黑体;">乙方：</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">甲乙双方本着互惠互利、共同发展的原则，依据《中华人民共和国民法通则》、《中华人民共和国合同法》、《中华人民共和国广告法》等有关法律法规的规定，经双方协商一致，签订本协议，以供遵照执行。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">一、合作建立</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">1、甲方系依法成立的具备广告发布及其他业务资质的公司，甲方已经独立自主地设立“九万传媒”广告宣传平台，并积极整合资源以实现经济与社会的目标。乙方愿意按照本协议及其他文件的约定，诚实守信，心态平和，与甲方进行持续、稳固、真诚的合作。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">2、甲方与广告需求人建立广告发布服务关系，再由乙方通过微信等合法途径发布相关广告信息；乙方愿意发布甲方制作、转发的广告信息，同时乙方通过自有渠道获得的广告信息，也可以与甲方的平台建立合作，双方按照本协议约定取得相应的报酬。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">3、乙方应当在甲方备案注册完整、详实、真实的信息，并按照规定与流程确认签署网上协议。本协议期限为一年，自乙方注册，签署网上协议，并经甲方审核通过之日起起算。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">4、合作区域：甲方经与乙方协商，同意乙方在特定区域负责（以下简称“特定区域”）发送甲方提供给乙方的信息（以下简称“甲方提供的信息”）以及乙方在甲方提供的信息基础上再行加工并发送的信息（以下简称“乙方定制的信息”），如乙方向特定区域外发送，应当经过甲方同意，否则甲方有权要求乙方承担赔偿损失、不予退回合作费用、解除协议等违约责任。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">5、进行网上注册登记的，乙方应当向甲方提供证明其身份的相关证件供甲方查验，具体方式为：乙方自拍照两份，要求应当清楚的体现乙方面部、手部以及持有的身份证（正反面均要拍照），并在拍照完毕后将图片文件发送给甲方。乙方承诺并保证所提交的一切证件原件与图片的真实性，若出现任何虚假或不实的情况，由乙方自行承担一切责任，甲方有权要求乙方承担赔偿损失、不予退回合作费用、解除协议等违约责任。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">二、合作方式</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">1、双方合作方式为：乙方在符合甲方要求的前提下，以微信等方式向特定区域的微信好友等发送甲方提供的信息或者乙方定制的信息；乙方自有渠道获得的广告信息，应当独一性的向甲方的平台发送，并按照规定享受提成收益。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">2、当乙方按照甲方要求向特定区域的微信好友等发送甲方提供的信息或者乙方定制的信息后，则甲方按照已收取的第三人款项的50%支付给乙方，如乙方发送的信息达不到甲方的要求，则甲方有权拒绝支付上述费用，费用已支付的，则甲方有权要求乙方返还。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">3、如乙方自有渠道获得广告信息，应当独一性的向甲方的平台发送，即首先通经甲方同意才能在特定区域发布，此时乙方自有渠道中第三人支付的款项应当全部汇入甲方指定的账户，然后由甲方按照乙方汇款额的60%返还给乙方。乙方不得私自收取费用，如乙方私自收取第三人的费用三日内没有汇入甲方指定的账户，则甲方与乙方的协议自动解除，乙方所缴纳的合作费用不予退还，乙方还应当承担合作费用总额的50%作为违约金。<span style="font-size: 14px; line-height: 150%; font-family: 宋体; color: red;">双方签署协议后，甲方有权与乙方单独达成一致以按照乙方推荐业务额业绩继续提高提成比例，具体协议文件另行发布。</span></span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">4、乙方向特定区域的微信好友等发送甲方提供的信息或者乙方定制的信息的要求：乙方必须向其负责的特定区域内所有微信好友发送，最低不得少于1000个微信好友。乙方同意由甲方按照具体的业务标准进行考核和监督。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">5、甲方有权通过电话回访、微信回访等方式验收乙方的微信发布情况，测试乙方发布信息的达到率及成功率，作为乙方在负责的特点区域是否合格的一个重要指标。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">6、甲方欢迎乙方推荐诚实守信的第三方与甲方进行业务合作。甲、乙双方承诺，乙方与第三方之间不存在业务合作关系，甲方与乙方及第三方之间直接建立平行的合作关系，乙方与第三方的各项业务款项均应当直接与甲方财务账户关联，并按照双方合作协议等文件约定享有权利并及承担义务。有关推荐第三方与甲方进行合作的奖励机制另行制作并发布。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">7、乙方不得无故单方解除或者怠于履行协议，否则乙方缴纳的合作费用甲方不予退还，给甲方造成损失的，乙方还应赔偿甲方全部损失。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">8、乙方按照本协议约定进行业务的，应当按照<span style="font-size: 14px; line-height: 150%; font-family: 宋体; color: red;">什么流程，背景墙，logo还是什么名字的，在微信上注册，</span>向特定区域进行发送。乙方转发的广告应当不得超出甲方的经营范围，不得从事国家限制性、禁止性的商品与服务的买卖行为，也不得从事相关领域的广告业务。否则产生相关争议由乙方自行承担，否则甲方有权要求乙方承担赔偿损失、不予退回合作费用、解除协议等违约责任。</span></p><p style="line-height:150%"><img width="393" height="137" src="http://jiuwan.dg0123.cn/Public/Components/ueditor1_4_3-utf8-php/themes/default/images/spacer.gif" word_img="file://localhost/Users/dendenden/Library/Caches/TemporaryItems/msoclip/0/clip_image002.gif" style="background:url(http://jiuwan.dg0123.cn/Public/Components/ueditor1_4_3-utf8-php/lang/zh-cn/images/localimage.png) no-repeat center center;border:1px solid #ddd"/></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">三、合作费用及付款方式</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">1、甲乙双方的合作期限为一年，费用为两仟陆佰元整，由乙方向甲方在注册协议并签署网上协议时支付。合作期满后每年的合作费用为壹佰元整，乙方续费后后视为双方同意仍然按照本协议及其他相关协议约定的内容续签协议，双方不再另行签订新的协议。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">2、乙方应当把合作费用（包括乙方代理第三人发布信息所收取的费用）汇入甲方指定的账户中，甲方指定的账户为：甲方主页上登记</span></p><p style="line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;"><img width="194" height="194" src="http://jiuwan.dg0123.cn/Public/Components/ueditor1_4_3-utf8-php/themes/default/images/spacer.gif" word_img="file://localhost/Users/dendenden/Library/Caches/TemporaryItems/msoclip/0/clip_image004.gif" style="background:url(http://jiuwan.dg0123.cn/Public/Components/ueditor1_4_3-utf8-php/lang/zh-cn/images/localimage.png) no-repeat center center;border:1px solid #ddd"/></span></p><p style="line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">&nbsp;</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">3、如甲方改变账户信息，则应当提前以合理方式通知乙方，否则由此发生的损失均由甲方承担。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">4、如无特殊事宜，甲方将在工作日统一、及时地向乙方及其他合作者计算并支付合作报酬。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">四、双方权利义务</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">1、甲方有权决定微信息的发布与否、发布时间、形式、内容等权利。乙方并非甲方唯一信息接收方，在本协议约定的合作期限内，甲方有权选择其他第三方进行相同的或者类似的信息接收及发布，对此甲方无需承担责任。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">2、乙方应当通过甲方平台发布信息，甲方有权获得乙方发布信息所获得报酬的20%-40%。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">3、乙方享有一次合作，多从获利的权利。乙方按照自身能力大小，可以利用甲方的资源平台进行推广，并按照约定获得报酬。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">4、甲方可以对乙方进行全程培训、进行经验辅导。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">5、乙方有权对甲方提供的信息内容进行合法性审查，对甲方提供信息内容不符合法律、行政法规等法律规定的，或者违反社会公共道德的内容有权提出修改，但是乙方对甲方信息内容的审查应该在信息收到2个小时内完成并且通知甲方。不得影响甲方信息的发布。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">6、乙方接收第三人的委托发布信息，则应当对信息的合法性及是否有违反社会公共道德的内容进行审查，如因此造成的后果全部由乙方承担。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">7、 在乙方如约履行协议项下的全部义务的前提下，乙方有权要求甲方及时支付约定的款项。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">8、乙方发布的信息如遭到第三方投诉要求采取撤销、删除、更正、赔偿损失等行为的，乙方自行负责解决。如导致甲方或客户产生法律责任或者被相关部门处罚等情形的，由乙方负责解决并承担相关责任及费用，如甲方因此遭受损失，乙方应当全额赔偿。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">9、甲方发现乙方发布的信息有侵害他人权利的可能，或者第三方向甲方要求撤销信息的，甲方有权停止信息的发布，乙方有权与该第三方就权利是否被侵害等是由进行磋商、谈判、诉讼等，情况解决的，乙方有权书面申请甲方恢复信息的发布。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">10、本协议内容、乙方为履行本协议从甲方处获取的商业秘密、技术秘密及其它甲方需保密的信息或者事项，乙方不得向第三方披露或者公开。如乙方违反前述约定，甲方有权解除协议，同时，乙方应该赔偿甲方因此所遭受的一切经济损失。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">11、合作中严令禁止的行为</span></p><p style="text-indent:40px;line-height:150%"><span style="font-size: 14px;"><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;">（1）严禁转发有污蔑国家、政党、社会的行为；</span></strong><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;"></span></strong></span></p><p style="text-indent:40px;line-height:150%"><span style="font-size: 14px;"><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;">（2）严禁转发色情、暴力渲染；</span></strong><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;"></span></strong></span></p><p style="text-indent:40px;line-height:150%"><span style="font-size: 14px;"><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;">（3）严禁转发与甲方业务或客户第三方无关的公众信息和视频；</span></strong><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;"></span></strong></span></p><p style="text-indent:40px;line-height:150%"><span style="font-size: 14px;"><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;">（4）严禁转发的便民信息中含有微信联系方式<span style="font-size: 14px; color: red;"> ；</span></span></strong><strong><span style="font-size: 14px; line-height: 150%; font-family: 宋体; color: red;"></span></strong></span></p><p style="text-indent:40px;line-height:150%"><span style="font-size: 14px;"><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;">（5）严禁转发有明显盈利方式的招聘，求助，交友<span style="font-size: 14px; color: red;"> ；</span></span></strong><strong><span style="font-size: 14px; line-height: 150%; font-family: 宋体; color: red;"></span></strong></span></p><p style="text-indent:40px;line-height:150%"><span style="font-size: 14px;"><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;">（6）严禁虚拟夸大宣传方式和效果；</span></strong><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;"></span></strong></span></p><p style="text-indent:40px;line-height:150%"><span style="font-size: 14px;"><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;">（7）严禁私自修改微信名称，图片，背景信息；</span></strong><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;"></span></strong></span></p><p style="text-indent:40px;line-height:150%"><span style="font-size: 14px;"><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;">（8）严禁私自降价更改，私自接单，私自收取客户贿赂；</span></strong><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;"></span></strong></span></p><p style="text-indent:40px;line-height:150%"><span style="font-size: 14px;"><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;">（9）严禁侵犯他人的知识产权的行为的行为；</span></strong><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;"></span></strong></span></p><p style="text-indent:40px;line-height:150%"><span style="font-size: 14px;"><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;">（10）严禁带走甲方客户、挖掘甲方资源的不诚信行为</span></strong><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;"></span></strong></span></p><p style="text-indent:40px;line-height:150%"><span style="font-size: 14px;"><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;">（11）严禁使用虚假的或者近似的称谓、图像、商标、网址、公司名称等侵害甲方利益的不正当竞争、违反公序良俗的行为。</span></strong><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;"></span></strong></span></p><p style="text-indent:40px;line-height:150%"><span style="font-size: 14px;"><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;">（12）其他侵犯甲方及双方与客户合作利益的行为。</span></strong><strong><span style="font-size: 19px; line-height: 150%; font-family: 宋体;"></span></strong></span></p><p style="margin-top:auto;margin-bottom:auto;text-indent:37px"><span style="font-size: 14px; font-family: 宋体;">12、合同有效期内，甲方不得以乙方名义进行任何本协议没有规定的宣传或商业活动，且必须经过乙方审核备案后才可以自行发布。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">&nbsp;</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">五、违约责任</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">1、本协议约定的违约责任包括但不限于赔偿损失、扣除合作费用、支付违约金、以及支付诉讼、仲裁、保全、鉴定、评估、公证、翻译、邮寄、复印、差旅、执行、律师费等各类费用。”</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">2、如甲方发现乙方未履行及时、足量、准确、依法发送信息的义务，乙方应当承担违约责任，包括但不限于补发信息、返还已支付的费用等，并有权要求乙方承担甲方未按照宣传计划达到推广目的而导致的所有直接间接损失。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">3、乙方如违反本协议在特定区域外发布信息且未经过甲方同意的，则乙方应当每违约发送一次向甲方支付违约金1000元，甲方有权要求乙方承担其他违约责任。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">4、乙方应当保证所发布的信息内容不得违背本协议尤其是第四条第11款的规定，否则造成甲方损失的，甲方除按照本协议的约定追究违约责任，还将通过一切法律手段追究民事、行政甚至刑事责任。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">&nbsp;</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">六、协议的解除</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">1、本协议不可抗力是指由于地震、水灾、战争、政府行为以及其他不能预见并对后果不能合理避免或者预防的各类事件。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">2、因不可抗力而导致任何一方全部或者部分不能履行协议，则该方不承担违约责任，但该方应采取一切必要和适当的措施减少可能给对方造成的损失。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">3、发生不可抗力，双方应依据不可抗力对本协议的影响程度，协商决定变更或者终止本协议。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">4、乙方超过20日不与甲方联系，视为自动解除合作关系，已交合作费用不予退还，并且应当返还甲方相应已支付的费用。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">5、乙方出现本协议第四条第11款规定的，甲方有权直接解除协议。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">七、其他事项</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">1、本协议履行地为济南市天桥区，甲乙双方在履行本协议过程中发生的所有争议均应以友好方式协商解决，如协商不成，任何一方均有权向济南市天桥区人民法院起诉。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">2、协议中所涉及的税费支付由双方各自负担。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">3、本协议未尽事宜，乙方同意由甲方在公司网站上（http://www.jwwhcm.com/index.html）制定网络的补充协议、合作协议修订案、合作协议细则等文件供乙方签署。甲方将在公司网站上（http://www.jwwhcm.com/index.html）进行公开，公开后五日内乙方有权考虑是否继续合作，五日后乙方未有明确书面拒绝意思表示的，视为双方同意按照上述文件的约定履行。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">4、自甲方审核通过乙方注册并签署网上协议之日起生效。</span></p><p style="text-indent:37px;line-height:150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">5、本协议一式两份，甲乙双方各执一份，具有同等法律效力。</span></p><p style="text-indent:28px;line-height:150%"><span style="line-height: 150%; font-family: 宋体; font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p><span style="font-size: 14px;">&nbsp;</span></p><p style="text-indent: 37px;line-height: 150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">&nbsp;</span></p><p style="line-height: 150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">甲方:(盖章)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;乙方: (盖章) </span></p><p style="line-height: 150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">代表:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;代表:</span></p><p style="line-height: 150%"><span style="font-size: 14px; line-height: 150%; font-family: 宋体;">日期:&nbsp;&nbsp;&nbsp;&nbsp; 年 &nbsp;&nbsp;&nbsp;月 &nbsp;&nbsp;&nbsp;日&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;日期:&nbsp;&nbsp;&nbsp;&nbsp; 年&nbsp;&nbsp;&nbsp;&nbsp; 月&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 日&nbsp; &nbsp; &nbsp;&nbsp;</span></p><p><br/></p>', '1467004196', NULL, 1, 0, '1470726405'),
(15, '干货！九万微传媒导师总结加人方法', '/Uploads/2016-08-09/57a97ad362f05.jpg', '&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;1. 加人的方法：除了培训部教的加qq群以外，还可以利用百度贴吧，陌陌，米聊，派派，漂流瓶等诸多工具，同样是注册女号，这些工具都可以进行定位，也可以发留言板，具体使用方法，你们一看便知。贴吧可以搜比较火的帖子，仿照人家的样子来发，同时可以进行评论，留微信号，但要注意不要直接发广告语，那样很容易被封。米聊，陌陌加群比qq容易。简单说就是在各种人多的地方放炸弹。&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;2. 朋友圈效应不可小觑，要保证信息量，这点不用再说。朋友圈就是咱们的店铺，试想一个空空荡荡的商店怎么会吸引商家来做广告，一定要给商家欣欣向荣的感觉。朋友圈里的成交记录，工资图每天必须宣传，这是招加盟的利器。商家反馈建议最好是自己的头像，不行就找人做。因为你的好友是冲着你的朋友圈来关注的。 &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;3. 沟通问题。因为我是女性，所以我个人建议女同事尽量用语聊，因为声音的魅力很强大，声音能传达真实的感受，语气，喜怒哀乐，更容易拉近与客户的关系。当然有的人擅长打字，但不要懒，可以插入一些表情符号作为辅助。我们在发朋友圈的时候，要把这个微信当成自己的私人微信来经营，什么意思呢？就是语言要俏皮，亲民化，不要生硬，朋友圈本身就是一个分享心情的地方，甚至可以发一些你自己的生活记录，人生感悟，我的经验里，大家转发我的一些理智，正能量的生活感悟比转发笑话概率更高。&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;4.对咨询加盟的顾客，或做广告的客户，他们经常说考虑考虑，我们不要追的太紧，过几天再问候一下，婉转的切入主题&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;5,经营微生活，不能一口吃个胖子，而是要循序渐进，日积月累，坚持不懈的来做，我的人数并不多，但每月也能保证1万以上，只有这样才能从量变到质变的转化。我甚至和一些微友成了朋友，不但赚了广告费，你也可以得到生活上的帮助。遇到不开心的，找师傅找导师诉苦，排解一下就过去了，我一直认为咱们微生活是传递正能量的平台，大家一定会有属于自己的收获。&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun; min-height: 14px;&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;6.送大家几条简单的总结：&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;1耐心等待，坚持不懈&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;2切中客户焦虑要害，让顾客吃定心丸&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;3专业果断 不拖泥带水&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;4刚柔话语兼并&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;5灵活变通 见人说人话，见鬼说鬼话&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;6感情营销，培养与顾客的感情&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;7以退为进&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; font-size: 12px; line-height: normal; font-family: SimSun;&quot;&gt;8数字收入说话&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1470724819', NULL, 1, 0, NULL),
(16, '朋友圈应该如何发?', '/Uploads/2016-08-12/57ad5759ac5b4.jpg', '&lt;p&gt;&lt;span style=&quot;font-size:24px;font-family:宋体&quot;&gt;朋友圈如何发&lt;/span&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;&lt;br/&gt; &lt;/span&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;【两条纯文字插一条图片】&lt;br/&gt; 早上（7:00-9:00）&lt;br/&gt; 早安&lt;br/&gt; 便民（求职，招聘，二手转让，拼车顺风车）&lt;br/&gt; 客户反馈★&lt;br/&gt; 心语&lt;br/&gt; 早餐&lt;br/&gt; 公众文章★&lt;br/&gt; 幽默笑话&lt;br/&gt; 天气预报&lt;br/&gt; 早间新闻&lt;br/&gt; 广告&amp;nbsp; （没有可以不发）&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 16px;font-family: 宋体&quot;&gt;中午前（10:00-11:00）&lt;br/&gt; 便民信息&lt;br/&gt; 便民信息&lt;br/&gt; 小伙伴开单信息★&lt;br/&gt; 本地路况&lt;br/&gt; 求助信息&lt;br/&gt; 便民信息&lt;br/&gt; 便民信息&lt;br/&gt; 中午（11:30-1:00）&lt;br/&gt; 时实报道&lt;br/&gt; 笑话图&lt;br/&gt; 正能量传播&lt;br/&gt; 下午（2:00-4:00）&lt;br/&gt; 便民信息&lt;br/&gt; 公众文章★&lt;br/&gt; 交友&lt;br/&gt; 下午茶&lt;br/&gt; 晚上（6:00-9:00）&lt;br/&gt; 便民信息&lt;br/&gt; 招商★&lt;br/&gt; 合作图★&lt;br/&gt; 反馈截图&lt;br/&gt; 头条★&lt;br/&gt; 上午互动 评论截图&lt;br/&gt; 睡前（10:00）&lt;br/&gt; 便民信息&lt;br/&gt; 广告&lt;br/&gt; 推广效果反馈★&lt;br/&gt; 晚安心语&lt;br/&gt; &amp;nbsp;&lt;br/&gt; 【切记同类信息连着发，要穿插发布信息，★标注的属于引领公司思路，每天必发内容，只有发布才会让微友了解咱们平台】&lt;br/&gt; 圈子必须整洁美观&lt;br/&gt; &lt;br/&gt; &lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1470977881', NULL, 1, 0, NULL),
(17, '合作报单和广告报单流程', '/Uploads/2016-08-12/57ad57d1a9f3e.PNG', '&lt;p style=&quot;text-align:center&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-size:21px;font-family: 宋体;color:red&quot;&gt;合作的报单流程&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family:宋体&quot;&gt;合作的报单流程是第一步，转米给公司，去审核部审核通过后，找档案部确认代理地区名字可以做，跟财务报单，报单完毕后去&lt;/span&gt;APP&lt;span style=&quot;font-family:宋体&quot;&gt;自助报单填写清楚要合作的代理的姓名，代理地区，手机号，微信号。报单成功后等待公司安排即可。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:19px;font-family:宋体&quot;&gt;接广告流程：&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;代理接广告后，第一时间按照标准格式报单给导师，转米给财务，带财务收到截图找设计部负责设计广告图片。设计完毕后，将分配部和客户拉进广告群，按照要求发广告。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1470978001', NULL, 1, 0, NULL),
(18, '公众号头条制作流程', '/Uploads/2016-08-12/57ad5870c429d.jpg', '&lt;p style=&quot;text-align:center;text-autospace:none&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;text-align:center;text-autospace:none&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-size:21px;font-family:宋体;color:#FD991B&quot;&gt;公众号头条制作流程&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;;font-family:宋体&quot;&gt;公&lt;/span&gt;&lt;span style=&quot;font-family:宋体&quot;&gt;众号头条制作前&lt;/span&gt;&lt;/p&gt;&lt;p&gt;1.&lt;span style=&quot;font-family: 宋体&quot;&gt;公众头条，图片文字要求（&lt;/span&gt;20&lt;span style=&quot;font-family:宋体&quot;&gt;张图以内，文字可以分为一至三段插入图片的相应位置&lt;/span&gt; &amp;nbsp;&lt;span style=&quot;font-family:宋体&quot;&gt;，每段文字限制&lt;/span&gt;200&lt;span style=&quot;font-family:宋体&quot;&gt;字以内）字数可增加，过于大量文字，肯定会影响广告效果&lt;/span&gt;&lt;/p&gt;&lt;p&gt;2.&lt;span style=&quot;font-family:宋体&quot;&gt;同一个链接只能制作一款产品进行广告推广&lt;/span&gt;.&lt;/p&gt;&lt;p&gt;3.&lt;span style=&quot;font-family:宋体&quot;&gt;上传文字不要有表情符号，因为后台不显示，并且把您的文字内容，用标点符号标&lt;/span&gt; &lt;span style=&quot;font-family:宋体&quot;&gt;注好。设计会按照您发的文字之间排版。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;4.&lt;span style=&quot;font-family:宋体&quot;&gt;按照您想要呈现的图片和文字顺序进行上传，设计人员会按照您上传图片的顺序给&lt;/span&gt; &lt;span style=&quot;font-family:宋体&quot;&gt;您进行排版（一定跟客户确认好）这样节省您和客户的时间。&lt;/span&gt;&lt;/p&gt;&lt;table cellspacing=&quot;0&quot; cellpadding=&quot;0&quot;&gt;&lt;tbody&gt;&lt;tr class=&quot;firstRow&quot;&gt;&lt;td width=&quot;192&quot; style=&quot;border: none; padding: 0px 7px;&quot;&gt;&lt;br/&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;&lt;p&gt;&lt;span style=&quot;font-family:宋体&quot;&gt;设计人员会再次跟您确定一下，您上传的图片和文字顺序是否正确，如果确定正确之后，设计人员会按照您上传的图片和文字顺序进行制作。&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:21px;font-family:Times;color:#2F2F2F&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&lt;span style=&quot;;font-family:宋体&quot;&gt;公众号头条制作后&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family:宋体&quot;&gt;链接制作好之后图片和文字是不予修改。（注：微信号、二维码、标题可以更换一次）&lt;/span&gt;&lt;/p&gt;&lt;p&gt;· &amp;nbsp; &amp;nbsp;&lt;span style=&quot;font-family:宋体&quot;&gt;注&lt;/span&gt; &amp;nbsp; &lt;span style=&quot;font-family:宋体&quot;&gt;意&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family:宋体&quot;&gt;填写完需要制作的资料后，&lt;/span&gt;APP&lt;span style=&quot;font-family:宋体&quot;&gt;自助报单系统会自动显示给您制作公众号头条的设计及微信号。&lt;/span&gt; &lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size:21px;font-family:&amp;#39;Helvetica Neue&amp;#39;;color:#2F2F2F&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1470978160', NULL, 1, 0, NULL),
(19, '九万微传媒标准报单格式', '/Uploads/2016-08-12/57ad58c0708d9.jpg', '&lt;p&gt;&lt;strong&gt;&lt;span style=&quot;font-size:21px;font-family: 宋体&quot;&gt;报单格式：&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;九万微传媒报单格式&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;我是：青岛城阳卓越微生活&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;团队&lt;/span&gt;:&lt;span style=&quot;font-family:宋体&quot;&gt;青岛五月风团队&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;打入公司哪个（&lt;/span&gt;zhang&lt;span style=&quot;font-family:宋体&quot;&gt;）户&lt;/span&gt;:&lt;span style=&quot;font-family:宋体&quot;&gt;支付宝&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;打（&lt;/span&gt;mi&lt;span style=&quot;font-family:宋体&quot;&gt;）时间：&lt;/span&gt;XX&lt;span style=&quot;font-family:宋体&quot;&gt;年&lt;/span&gt;XX&lt;span style=&quot;font-family:宋体&quot;&gt;月&lt;/span&gt;XX&lt;span style=&quot;font-family:宋体&quot;&gt;日&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;客户打（&lt;/span&gt;mi&lt;span style=&quot;font-family:宋体&quot;&gt;）姓名：&lt;/span&gt;XX&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;（&lt;/span&gt;jin&lt;span style=&quot;font-family:宋体&quot;&gt;）额：&lt;/span&gt;XXX&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;推荐地区&lt;/span&gt;:&lt;span style=&quot;font-family:宋体&quot;&gt;青岛栈桥爱生活&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;广告时间：&lt;/span&gt;5.12-6.10&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 宋体&quot;&gt;广告类型：大门推广&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1470978240', NULL, 1, 0, NULL),
(20, '199元！给你一份事业！', '/Uploads/2016-08-23/57bbc1e182800.PNG', '&lt;p&gt;&amp;nbsp; &amp;nbsp; 九万微传媒是干什么的？&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 亲爱的微友们我们公司是以微信圈平台为基础，广告宣传产品推广微信和公众号推广及手机网站同步的传媒公司&lt;/p&gt;&lt;p&gt;让所有商家花最少得到更大的 收益是我们的目标。 我们公司在全国100个城市有1000多家代理为你的产品宣传推广和网站同步，我们的费用是最低的效果也是最好的，全国8亿微信玩家都可以看到的平台，选择我们就是选择成功，这是新时代的产物期待你们的加盟和商家的合作。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 加盟代理是199元费用，一次投资，终生收益，加盟之后公司专门培训，有导师专门手把手教你：如何利用微信，微博，公众，网站，人人挣米， 这些技术都是公司出。更重要的是你享受这些“资源”。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 如果你不想花这加盟的费用，我想告诉你的是做什么不需要投资，微生活不同于微商，不需要卖货，囤货。只是一个发布平台，你只需要每天帮大家发布信息就ok了 。什么工作能如此简单，自己做主当老板，不能只看眼前，不付出怎能有回报。微传媒时代，机会不容错失。请亲斟酌。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 如果你不知道怎么赚米，那我告诉你，加盟之后每个代理都很努力的维护自己的朋友圈，这就好比种下梧桐树，引来金凤凰，公司有广告单可以推给你做，你也可以 自己谈客户，推给公司的公众号，也可以推给其他任何一位或几位代理，当然任何代理接单之后也可以推给你，我们是团结的坚强的战斗集体，你不 是一个人在战斗，绝对不是一个人。最重要的是你的收入是广告提成都在30％—90％不等，你卖任何产品都不会有这么高的提成，月入上万都是小儿科。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 1998年马化腾开QQ，让你们注册你们不注。现在一个5位数的QQ几万；2003年马云说开淘宝店不要钱，让你们开店你们不开，10年淘宝造就了无数个亿万富翁；2009 年曹国伟开微博，让你们开通你们不开，如今一个微博搞笑排行榜年净赚1500万 ……今天，让你们加盟九万微传媒，自己好好想想，你们会再错过什么？？&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 把握机会才能创造未来，自己想清楚：别让自己的人生有太多的错过！&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1471922657', NULL, 1, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_local`
--

CREATE TABLE IF NOT EXISTS `tp_local` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(500) NOT NULL COMMENT '用户账号',
  `name` varchar(500) NOT NULL COMMENT '推荐人',
  `title` varchar(500) NOT NULL COMMENT '宣传语',
  `idr_img` varchar(500) NOT NULL COMMENT '身份证照',
  `idl_img` varchar(500) NOT NULL COMMENT '身份证反面',
  `main_img` varchar(500) NOT NULL COMMENT '图片',
  `storer1_img` varchar(500) NOT NULL COMMENT '门店外观',
  `storer2_img` varchar(500) NOT NULL,
  `storel1_img` varchar(500) NOT NULL COMMENT '店内照片1',
  `storel2_img` varchar(500) NOT NULL COMMENT '店内照片2',
  `storel3_img` varchar(500) NOT NULL COMMENT '店内照片3',
  `tel` varchar(15) DEFAULT NULL,
  `status` int(4) unsigned DEFAULT '1',
  `sort` int(4) unsigned DEFAULT '1',
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `tp_local`
--

INSERT INTO `tp_local` (`id`, `username`, `name`, `title`, `idr_img`, `idl_img`, `main_img`, `storer1_img`, `storer2_img`, `storel1_img`, `storel2_img`, `storel3_img`, `tel`, `status`, `sort`, `edit_date`) VALUES
(1, '123', '11', 'dsadsad', '/Uploads/2016-06-07/57568cb477d8e.png', '/Uploads/2016-06-07/57568cb478588.png', '/Uploads/2016-06-07/57568cb477473.png', '/Uploads/2016-06-07/57568cb478da0.png', '/Uploads/2016-06-07/57568cb4794a1.png', '/Uploads/2016-06-07/57568cb47f1a4.png', '/Uploads/2016-06-07/57568cb47f927.png', '/Uploads/2016-06-07/57568cb480064.png', '18560619695', 2, 1, '1465289908'),
(2, '123', '123', '大大大1111', '/Uploads/2016-06-22/576a1f0a9fe70.jpg', '/Uploads/2016-06-22/576a1f0aa3a98.jpg', '/Uploads/2016-06-22/576a1f0a8fdbb.jpg', '/Uploads/2016-06-22/576a1f0aa74f2.jpg', '/Uploads/2016-06-22/576a1f0aab252.jpg', '/Uploads/2016-06-22/576a1f0aaee24.jpg', '/Uploads/2016-06-22/576a1f0ab2837.png', '/Uploads/2016-06-22/576a1f0ab330a.jpg', '18560619695', 1, 1, '1466572554'),
(3, '123', '123', 'ewqeqe', '/Uploads/2016-06-22/576a1fdf62d82.jpg', '/Uploads/2016-06-22/576a1fdf6b413.gif', '/Uploads/2016-06-22/576a1fdf59984.jpg', '/Uploads/2016-06-22/576a1fdf6d7a0.jpg', '/Uploads/2016-06-22/576a1fdf72b32.jpg', '/Uploads/2016-06-22/576a1fdf77de3.jpg', '/Uploads/2016-06-22/576a1fdf7bdb6.jpg', '/Uploads/2016-06-22/576a1fdf808df.jpg', 'ewqeq', 1, 1, '1466572767'),
(4, '123', '', 'kl;kl;lk', '/Uploads/', '/Uploads/', '/Uploads/2016-06-22/576a269062429.jpg', '/Uploads/', '/Uploads/', '/Uploads/', '/Uploads/', '/Uploads/', ';lk;lk', 1, 1, '1466574480'),
(5, '123', 'dsadsa', 'dsadad', '/Uploads/2016-06-27/5770a139dc942.png', '/Uploads/2016-06-27/5770a139dd775.png', '/Uploads/2016-06-27/5770a139dbb05.png', '/Uploads/2016-06-27/5770a139de512.png', '/Uploads/2016-06-27/5770a139df2ba.png', '/Uploads/2016-06-27/5770a139e0077.png', '/Uploads/2016-06-27/5770a139e0e2a.png', '/Uploads/2016-06-27/5770a139e1d13.png', '18560619695', 1, 1, '1466999097'),
(6, '123', '急急急', '54545', '/Uploads/2016-06-27/5770a1a78645b.jpg', '/Uploads/2016-06-27/5770a1a78c95e.png', '/Uploads/2016-06-27/5770a1a781f13.png', '/Uploads/2016-06-27/5770a1a792676.png', '/Uploads/2016-06-27/5770a1a797fd0.png', '/Uploads/2016-06-27/5770a1a79beaf.jpg', '/Uploads/2016-06-27/5770a1a7a1508.png', '/Uploads/2016-06-27/5770a1a7a6e3e.png', '18560619695', 1, 1, '1466999207'),
(7, '123', 'Ffghk', 'Ytjj', '/Uploads/', '/Uploads/', '/Uploads/2016-07-01/577619a7977d4.jpeg', '/Uploads/', '/Uploads/', '/Uploads/', '/Uploads/', '/Uploads/', 'Fflhh', 1, 1, '1467357607'),
(8, '456', '积极', '545454', '/Uploads/', '/Uploads/', '/Uploads/2016-07-13/5785a5b224c69.png', '/Uploads/', '/Uploads/', '/Uploads/', '/Uploads/', '/Uploads/', '18560619695', 1, 1, '1468376498');

-- --------------------------------------------------------

--
-- 表的结构 `tp_menu_admin`
--

CREATE TABLE IF NOT EXISTS `tp_menu_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL COMMENT '路径',
  `parent` int(11) unsigned DEFAULT NULL COMMENT '父辈',
  `sort` int(11) unsigned DEFAULT NULL COMMENT '排序',
  `status` int(4) unsigned DEFAULT '0' COMMENT '状态',
  `is_menu` int(2) unsigned DEFAULT NULL COMMENT '是否是菜单',
  `icon` varchar(200) DEFAULT NULL COMMENT '图标',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='菜单列表' AUTO_INCREMENT=150 ;

--
-- 转存表中的数据 `tp_menu_admin`
--

INSERT INTO `tp_menu_admin` (`id`, `name`, `path`, `parent`, `sort`, `status`, `is_menu`, `icon`) VALUES
(67, '会员管理', '', 0, 1, 1, 1, ' icon-user'),
(68, '已注册会员', 'User/index', 67, 1, 1, 1, ''),
(69, '既往史', '', 2, 1, 1, 0, 'icon-hospital'),
(107, '公司主页', '', 0, 0, 1, 1, ' icon-tags'),
(71, '产品分类1', 'Hosp/index', 67, 1, 0, 1, ''),
(77, '到底', NULL, 69, 1, 1, 1, NULL),
(94, '测试客户111', '111', 68, 1, 1, 1, ''),
(76, '主页分类', 'Company/index', 107, 2, 0, 1, ''),
(78, '看诊订单列表', 'Accorder/index', 67, 1, 0, 1, ''),
(79, '后台管理', '', 0, 4, 2, 1, ' icon-cogs'),
(80, '导航菜单', 'Menu/index', 87, 1, 1, 1, ''),
(81, '账户管理', 'Setting/index', 87, 1, 1, 1, ''),
(93, '测试三1', '测试三1', 90, 1, 1, 1, '测试三1'),
(87, '系统设置', '', 0, 3, 1, 1, 'icon-lock'),
(109, '添加会员', 'User/add', 67, 0, 0, 1, ''),
(89, '服务时间', 'Eval/date', 87, 1, 0, 1, NULL),
(90, '电话', 'Eval/tel', 87, 2, 0, 1, ''),
(110, 'cesssss', NULL, 108, 1, 1, 1, NULL),
(92, '测试三级', 'dfd/fdf', 90, 0, 1, 1, ''),
(95, '登录日志', 'eval/log', 87, 3, 0, 1, '2'),
(96, '测试', 'eval/index1', 79, 1, 0, 1, NULL),
(97, '费用类型', 'Cost/index', 67, 1, 0, 1, '1'),
(98, '使用指南', 'Eval/introduce', 87, 0, 0, 1, '3'),
(108, '公司动态', 'Company/gindex', 107, 1, 1, 1, ''),
(104, '积分商城', 'Product/index', 0, 2, 1, 1, ' icon-bar-chart'),
(105, '产品分类', 'ProClass/index', 104, 0, 1, 1, ''),
(106, '产品展示', 'Product/index', 104, 0, 1, 1, ''),
(111, '会员关注产品', 'Attention/index', 67, 0, 0, 1, ' icon-star-empty'),
(112, '会员等级', 'UserGrade/index', 67, 0, 1, 1, ''),
(113, '学习资料', '', 0, 0, 1, 1, 'icon-book'),
(114, '学习资料', 'Learning/gindex', 113, 1, 1, 1, 'icon-edit'),
(115, '广告备案', '', 0, 0, 1, 1, 'icon-edit'),
(116, '备案审核', 'Record/gindex', 115, 1, 1, 1, ''),
(117, '福利资料', '', 0, 0, 1, 1, 'icon-gift'),
(143, '广告排期', '', 0, 0, 1, 1, 'icon-barcode'),
(119, '基础学习', 'Basic/gindex', 117, 3, 1, 1, ''),
(120, '满意度评论', 'Agree/gindex', 117, 5, 1, 1, ''),
(121, '今天生日', 'Birthday/gadd', 117, 6, 1, 1, ''),
(122, '当日事当日毕', 'Daything/gindex', 117, 7, 1, 1, ''),
(123, '实物中奖快递列表', 'Record/gindex', 117, 8, 1, 1, ''),
(124, '自助报单', '', 0, 0, 1, 1, ' icon-exchange'),
(125, '报单管理', 'Reports/gadd', 124, 1, 1, 1, ''),
(126, '基础学些分类', 'Basic/index', 117, 2, 1, 1, ''),
(127, '满意度分类', 'Agree/index', 117, 4, 1, 1, ''),
(128, '每日新闻', 'Daynews/gindex', 117, 9, 1, 1, ''),
(129, '财务管理', '', 0, 0, 1, 1, 'icon-group'),
(131, '订单管理', 'ProOrder/gindex', 104, 9, 1, 1, ''),
(132, '积分兑换审核', 'Daynews/gindex', 104, 9, 0, 1, ''),
(133, '资金审核', 'Daynews/gindex', 104, 9, 0, 1, ''),
(134, '建议反馈', 'Sugg/gindex', 87, 1, 1, 1, ''),
(135, '今日提成明细', 'Sign/index', 129, 0, 1, 1, ''),
(136, '今日积分收支', 'Sign/expend', 129, 0, 1, 1, ''),
(137, '资金兑换积分审核', 'Sign/budget', 129, 0, 0, 1, ''),
(138, '每日签到', 'Qiandao/gindex', 129, 0, 1, 1, ''),
(139, '朋友圈评论', 'Win/index', 129, 0, 0, 1, ''),
(140, '积分记录', 'Sign/gindex', 129, 0, 1, 1, ''),
(141, '本地免费广告', 'Local/gindex', 129, 0, 1, 1, ''),
(142, '转发福利', 'Forward/gindex', 129, 0, 1, 1, ''),
(144, '广告排期', 'Advert/gindex', 143, 5, 1, 1, ''),
(145, '大转盘', 'Choujiang/gindex', 0, 0, 1, 1, 'icon-hospital'),
(146, '大转盘', 'Choujiang/gindex', 145, 1, 1, 1, 'icon-globe'),
(147, '资金提现申请', 'Money/push', 129, 0, 1, 1, ''),
(148, '资金充值申请', 'Money/recharge', 129, 0, 1, 1, ''),
(149, '用户协议', 'Xieyi/gadd', 87, 1, 1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `tp_message`
--

CREATE TABLE IF NOT EXISTS `tp_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `from_user` varchar(50) NOT NULL COMMENT '发送者',
  `create_time` varchar(50) NOT NULL COMMENT '发送时间',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='信息基础表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `tp_message`
--

INSERT INTO `tp_message` (`id`, `from_user`, `create_time`, `title`, `content`) VALUES
(1, 'yxf', '1466736599', 'ceshi', 'this is a ceshi'),
(2, 'yxf', '1466736677', 'ceshi', 'hahahah'),
(3, 'aa', '1466745532', 'ceshi', 'enenen'),
(4, 'bb', '1466745618', 'ceshi', 'eeeee'),
(5, 'cc', '1466745713', 'ceshi', 'hahahhahahah'),
(6, '123', '1466994954', 'Df', 'Df'),
(7, '110', '1467624015', '123 能收到吗', '啦咯啦咯啦咯啦'),
(8, '456', '1468312651', 'hhg', 'mohong\n');

-- --------------------------------------------------------

--
-- 表的结构 `tp_message_detail`
--

CREATE TABLE IF NOT EXISTS `tp_message_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `message_id` int(11) unsigned NOT NULL COMMENT '消息公共表id',
  `is_read` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '0未签阅 1 签阅',
  `from_user` varchar(50) NOT NULL COMMENT '发送者',
  `to_user` varchar(50) NOT NULL COMMENT '接收者',
  `create_time` varchar(50) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='信息详情表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `tp_message_detail`
--

INSERT INTO `tp_message_detail` (`id`, `message_id`, `is_read`, `from_user`, `to_user`, `create_time`) VALUES
(1, 1, 0, 'yxf', 'aa', '1466736599'),
(2, 1, 0, 'yxf', 'bb', '1466736599'),
(3, 1, 0, 'yxf', 'cc', '1466736599'),
(4, 2, 0, 'yxf', 'aa', '1466736677'),
(5, 2, 0, 'yxf', 'bb', '1466736677'),
(6, 2, 0, 'yxf', 'cc', '1466736677'),
(7, 3, 0, 'aa', 'yxf', '1466745532'),
(8, 4, 0, 'bb', 'yxf', '1466745618'),
(9, 5, 0, 'cc', 'yxf', '1466745713'),
(10, 6, 0, '123', '123361212739', '1466994954'),
(11, 7, 0, '110', '123', '1467624015'),
(12, 8, 0, '456', '111456', '1468312651');

-- --------------------------------------------------------

--
-- 表的结构 `tp_money`
--

CREATE TABLE IF NOT EXISTS `tp_money` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(100) DEFAULT NULL COMMENT '用户账号',
  `money` varchar(500) NOT NULL COMMENT '资金',
  `type` int(4) unsigned DEFAULT NULL COMMENT '1是提现2是充值',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '1是审核通过2是审核未通过0是未审核',
  `text` text NOT NULL COMMENT '备注',
  `date` varchar(15) DEFAULT NULL COMMENT '写入时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='资金充值资金提现' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `tp_money`
--

INSERT INTO `tp_money` (`id`, `username`, `money`, `type`, `status`, `text`, `date`) VALUES
(3, '123', '1111111111', 1, 0, '', '1466660025'),
(2, '123', '111', 1, 1, '', '1466660002'),
(4, '123', '1111', 1, 0, '', '1466660271'),
(5, '123', '1111', 1, 1, '1111', '1466660316'),
(6, '123', '500', 1, 1, '500', '1466660327'),
(7, '123', '222', 1, 0, '打的是的撒', '1466660348'),
(8, '123', '222', 1, 1, '', '1466660486'),
(9, '123', '111', 1, 1, '', '1466660634'),
(10, '123', '1111', 1, 0, '', '1466660798'),
(11, '123', '111', 1, 1, '', '1466660828'),
(12, '123', '111', 1, 0, '', '1466661131'),
(13, '123', '11', 1, 0, '', '1466661495'),
(14, '123', '5601', 1, 0, '', '1466661910'),
(15, '123', '222', 2, 1, '22223232323', '1466662475'),
(16, '123', '2222', 2, 1, '', '1466665790');

-- --------------------------------------------------------

--
-- 表的结构 `tp_price_type`
--

CREATE TABLE IF NOT EXISTS `tp_price_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(100) NOT NULL COMMENT '看诊类型名称',
  `status` int(4) unsigned DEFAULT NULL COMMENT '状态',
  `sort` int(11) unsigned DEFAULT NULL COMMENT '排序',
  `date` varchar(15) DEFAULT NULL COMMENT '写入时间',
  `price_member` varchar(20) DEFAULT NULL COMMENT '费用编码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='费用类型' AUTO_INCREMENT=32 ;

--
-- 转存表中的数据 `tp_price_type`
--

INSERT INTO `tp_price_type` (`id`, `name`, `status`, `sort`, `date`, `price_member`) VALUES
(4, '挂号费', 1, 0, '1452478008', NULL),
(5, '门诊费', 1, 0, '1452477725', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_product`
--

CREATE TABLE IF NOT EXISTS `tp_product` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `goods_total` int(11) NOT NULL COMMENT '商品总价',
  `shop_price` int(11) NOT NULL COMMENT '商品售价',
  `main_img` varchar(255) DEFAULT NULL,
  `sale` int(11) NOT NULL COMMENT '销量',
  `class` int(4) unsigned DEFAULT NULL COMMENT '分类',
  `likes` int(11) NOT NULL COMMENT '多少人喜欢',
  `text` text COMMENT '详情',
  `sort` int(4) unsigned DEFAULT '0' COMMENT '排序',
  `status` int(4) unsigned DEFAULT '1' COMMENT '状态',
  `date` varchar(15) DEFAULT NULL COMMENT '时间',
  `intro` varchar(255) DEFAULT NULL COMMENT '简介',
  `grade_id` int(4) DEFAULT NULL COMMENT '可查看级别',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `tp_product`
--

INSERT INTO `tp_product` (`id`, `name`, `goods_total`, `shop_price`, `main_img`, `sale`, `class`, `likes`, `text`, `sort`, `status`, `date`, `intro`, `grade_id`) VALUES
(14, 'NIKE耐克2016年新款男子AS NIKE', 33, 7, '/Uploads/2016-01-28/56a9c490d06b4.jpg', 2, 23, 0, '<p>						</p><p><br/></p><p><br/></p><p><br/></p><p>测试1测试1</p><p><br/></p><p><br/></p><p><br/></p><p>						</p>', 0, 1, '1467014691', '测试12', NULL),
(13, 'NIKE耐克2016年新款男子AS NIKE', 111, 0, '/Uploads/2016-01-28/56a9c483c108c.jpg', 1, 23, 0, '<p>						</p><p>测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1测试1</p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p>						</p>', 0, 0, '1466993769', '测试1', NULL),
(12, 'NIKE耐克2016年新款男子AS NIKE', 33, 12, '/Uploads/2016-06-27/57708c23d9778.png', 9, 23, 7, '<p>						</p><p><br/></p><p><br/></p><p>对方给大哥大哥大范甘迪发鬼地方个地方<br/></p><p><img src="/ueditor/php/upload/image/20160603/1464930486662517.png" title="1464930486662517.png" alt="QQ截图20160601151947.png"/></p><p>发斯蒂芬是否好搜你的废话手动阀胡搜的话费送</p><p>收到货佛is的活佛圣地</p><h2 style="margin: 0px; padding: 0px; border: 0px; font-family: 微软雅黑; font-size: 14px;">提示和注释</h2><p class="tip" style="margin-top: 12px; margin-bottom: 0px; padding: 0px; border: 0px; line-height: 18px;"><span style="margin: 0px; padding: 0px; border: 0px; font-weight: bold; color: rgb(255, 153, 85);">提示：</span>如果 elements[] 数组具有名称（input 标签的 id 或 name 属性），那么该元素的名称就是 formObject 的一个属性，因此可以使用名称而不是数字来引用 input 对象。</p><p style="margin-top: 12px; margin-bottom: 0px; padding: 0px; border: 0px; line-height: 18px;">举例，假设 x 是一个 form 对象，其中的一个 input 对象的名称是 fname，则可以使用 x.fname 来引用该对象。</p><h2 style="margin: 0px; padding: 0px; border: 0px; font-family: 微软雅黑; font-size: 14px;">实例</h2><p style="margin-top: 12px; margin-bottom: 0px; padding: 0px; border: 0px; line-height: 18px;">下面的例子输出了所有表单元素的值和类型：</p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p>						</p>', 222, 1, '1466993699', '1212', NULL),
(15, 'NIKE耐克2016年新款男子AS NIKE', 2222, 33333, '/Uploads/2016-02-03/56b15ead1dad8.jpg', 0, 35, 3, '<p>						</p><p><br/></p><p><br/></p><p>121</p><p><br/></p><p><br/></p><p>						</p>', 0, 1, '1466993814', '12121', 35);

-- --------------------------------------------------------

--
-- 表的结构 `tp_pro_class`
--

CREATE TABLE IF NOT EXISTS `tp_pro_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `sort` int(11) unsigned DEFAULT NULL,
  `main_img` varchar(500) NOT NULL COMMENT '图片',
  `date` varchar(15) DEFAULT NULL,
  `status` int(2) unsigned DEFAULT '1' COMMENT '0:未启用 1：启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='病名称' AUTO_INCREMENT=42 ;

--
-- 转存表中的数据 `tp_pro_class`
--

INSERT INTO `tp_pro_class` (`id`, `name`, `sort`, `main_img`, `date`, `status`) VALUES
(41, 'ffff', NULL, '', NULL, 1),
(23, '2323232323', 3, '/Uploads/2016-06-27/57708a580a584.png', '1466993240', 1),
(24, '11', 4, '/Uploads/2016-05-12/57341c76c6770.png', '1463032950', 0),
(34, '产品分类4', 0, '', '1453698415', 0),
(35, '产品分类6', 0, '', '1453698524', 1),
(36, '产品分类7', 0, '', '1453698534', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tp_pro_img`
--

CREATE TABLE IF NOT EXISTS `tp_pro_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(1) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `date` varchar(15) DEFAULT NULL,
  `sort` int(4) DEFAULT '1',
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=170 ;

--
-- 转存表中的数据 `tp_pro_img`
--

INSERT INTO `tp_pro_img` (`id`, `p_id`, `url`, `date`, `sort`, `status`) VALUES
(142, 10, '/Uploads/2016-01-27/56a82f9029ce5.jpg', '1453862800', 1, 1),
(141, 10, '/Uploads/2016-01-27/56a82f883fc67.jpg', '1453862792', 1, 1),
(140, 10, '/Uploads/2016-01-27/56a82f8736a38.jpg', '1453862791', 1, 1),
(133, 11, '/Uploads/2016-01-27/56a825fd9c7fd.jpg', '1453860349', 1, 1),
(134, 11, '/Uploads/2016-01-27/56a825fea3fd7.jpg', '1453860350', 1, 1),
(139, 7, '/Uploads/2016-01-27/56a82efc62bef.jpg', '1453862652', 1, 1),
(137, 6, '/Uploads/2016-01-27/56a82e42aeff5.jpg', '1453862466', 1, 1),
(138, 6, '/Uploads/2016-01-27/56a82e43bae78.jpg', '1453862467', 1, 1),
(105, 5, '/Uploads/2016-01-26/56a73bed93080.jpg', '1453800429', 1, 2),
(103, 5, '/Uploads/2016-01-26/56a737f15bb3c.jpg', '1453799409', 1, 2),
(100, 5, '/Uploads/2016-01-26/56a737a23d5f6.jpg', '1453799330', 1, 2),
(101, 5, '/Uploads/2016-01-26/56a737aa966f8.jpg', '1453799338', 1, 1),
(106, 9, '/Uploads/2016-01-26/56a742387f9bb.jpg', '1453802040', 1, 1),
(95, 3, '/Uploads/2016-01-26/56a73459a7541.jpg', '1453798489', 1, 1),
(102, 5, '/Uploads/2016-01-26/56a737b602b36.jpg', '1453799350', 1, 1),
(144, 8, '/Uploads/2016-01-27/56a82fb325c7e.jpg', '1453862835', 1, 1),
(118, 4, '/Uploads/2016-01-26/56a74468a7e3e.jpg', '1453802600', 1, 1),
(119, 4, '/Uploads/2016-01-26/56a74469b1a43.jpg', '1453802601', 1, 1),
(120, 4, '/Uploads/2016-01-26/56a7446ab98c1.jpg', '1453802602', 1, 1),
(121, 4, '/Uploads/2016-01-26/56a7446bca66f.jpg', '1453802603', 1, 1),
(122, 4, '/Uploads/2016-01-26/56a7446cd7aad.jpg', '1453802604', 1, 1),
(168, 13, '/Uploads/2016-06-27/57708c530d9c1.png', '1466993747', 1, 1),
(166, 13, '/Uploads/2016-06-27/57708c4d812ec.png', '1466993741', 1, 1),
(163, 12, '/Uploads/2016-06-27/57708bf471357.png', '1466993652', 1, 1),
(162, 12, '/Uploads/2016-06-27/57708bee84735.png', '1466993646', 1, 1),
(167, 13, '/Uploads/2016-06-27/57708c5068915.png', '1466993744', 1, 1),
(164, 12, '/Uploads/2016-06-27/57708bf7a78a1.png', '1466993655', 1, 1),
(165, 12, '/Uploads/2016-06-27/57708bfa9016c.png', '1466993658', 1, 1),
(169, 13, '/Uploads/2016-06-27/57708c55c7704.png', '1466993749', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_pro_likes`
--

CREATE TABLE IF NOT EXISTS `tp_pro_likes` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(500) NOT NULL COMMENT '用户名',
  `pid` int(11) NOT NULL COMMENT '商品id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `tp_pro_likes`
--

INSERT INTO `tp_pro_likes` (`id`, `username`, `pid`) VALUES
(34, '11', 15),
(33, '11', 15),
(32, '11', 15),
(31, '11', 12);

-- --------------------------------------------------------

--
-- 表的结构 `tp_pro_order`
--

CREATE TABLE IF NOT EXISTS `tp_pro_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL COMMENT '商品id',
  `order_id` varchar(500) NOT NULL COMMENT '订单id',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1表示已付款2未付款',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1表示未发货2表示已发货3收货',
  `note` varchar(5000) NOT NULL DEFAULT 'null' COMMENT '快递公司加编号',
  `tel` varchar(20) NOT NULL COMMENT '电话',
  `username` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(500) NOT NULL COMMENT '收货地址',
  `total` int(11) NOT NULL COMMENT '总价格',
  `count` int(11) NOT NULL COMMENT '数量',
  `text` text NOT NULL,
  `date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='病名称' AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `tp_pro_order`
--

INSERT INTO `tp_pro_order` (`id`, `pro_id`, `order_id`, `status`, `type`, `note`, `tel`, `username`, `province`, `city`, `area`, `name`, `address`, `total`, `count`, `text`, `date`) VALUES
(39, 12, '5785db6b032de', 1, 1, 'null', '18560619695', '123', '北京', '北京市', '朝阳区', '111', '1111', 12, 1, '', '1468390251'),
(38, 12, '5785db534b295', 1, 1, 'null', '18560619695', '123', '北京', '北京市', '朝阳区', '111', '1111', 12, 1, '', '1468390227'),
(36, 12, '5775dfc310606', 1, 1, '', '18560619695', '123', '北京', '北京市', '朝阳区', '57级', '笔记本', 12, 1, '', '1467342787'),
(37, 14, '5775e08a121e6', 1, 2, '申通快递：232323232232', '18560619695', '123', '北京', '北京市', '朝阳区', '姜还是', '差比较', 7, 1, '', '1467342986');

-- --------------------------------------------------------

--
-- 表的结构 `tp_qiandao`
--

CREATE TABLE IF NOT EXISTS `tp_qiandao` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL COMMENT '注册的账号唯一表示',
  `date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- 转存表中的数据 `tp_qiandao`
--

INSERT INTO `tp_qiandao` (`id`, `username`, `date`) VALUES
(26, '123', '1467129600'),
(25, '123', '1467043200'),
(24, '123', '1466956800'),
(27, '123', '1467216000'),
(28, '123', '1467302400'),
(29, '123', '1467820800'),
(30, '123', '1468252800'),
(31, '456', '1468339200'),
(32, '456', '1469116800'),
(33, '123', '1470067200'),
(34, '123', '1470153600'),
(35, '623491789', '1471017600'),
(36, '535667261', '1471017600'),
(37, '935372654', '1471536000'),
(38, '623491789', '1471881600');

-- --------------------------------------------------------

--
-- 表的结构 `tp_record`
--

CREATE TABLE IF NOT EXISTS `tp_record` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL COMMENT '注册的账号唯一表示',
  `title` varchar(500) NOT NULL COMMENT '姓名或者公司备案添加的',
  `id_img` varchar(500) NOT NULL COMMENT '身份证照',
  `main_img` varchar(500) NOT NULL COMMENT '图片',
  `tel` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `status` int(4) unsigned DEFAULT '1',
  `sort` int(4) unsigned DEFAULT '1',
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `tp_record`
--

INSERT INTO `tp_record` (`id`, `username`, `title`, `id_img`, `main_img`, `tel`, `email`, `address`, `status`, `sort`, `edit_date`) VALUES
(13, '123', '积极', '/Uploads/2016-06-29/577361d43ed79.jpg', '/Uploads/2016-08-02/57a054b7dde52.jpeg', '18560619695', '5454554', '54545454', 1, 1, '1470125249');

-- --------------------------------------------------------

--
-- 表的结构 `tp_record_xieyi`
--

CREATE TABLE IF NOT EXISTS `tp_record_xieyi` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `text` text,
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tp_record_xieyi`
--

INSERT INTO `tp_record_xieyi` (`id`, `text`, `edit_date`) VALUES
(1, '<p>						</p><p><br/></p><p><br/></p><p><br/></p><p style="text-align: center"><strong>山东九万文化传媒有限公司在线广告合作协议</strong></p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp; &nbsp;2.2&nbsp; 本协议项下发布的广告内容由甲方提供。甲方应在广告开始刊登1日前，将已确定的告内容提供给乙方，该广告内容文件的规格、大小应严格符合乙方的广告规范要求。</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp; 2.3&nbsp; 甲方委托乙方对其广告进行技术处理，使广告适合在乙方广告平台发布，乙方将按乙方自有的技术标准处理甲方广告或者按照要求发送。</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp; 2.4&nbsp; 乙方有权审查甲方提供的广告内容，对不符合法律、法规或乙方有理由相信如果发布将给乙方带来不利影响的广告，乙方有权要求甲方在收到乙方的书面修改通知书后3日内将广告内容修改完毕；在甲方按照乙方要求进行修改前，乙方有权拒绝发布该广告，对由此导致的广告发布延误，乙方不承担任何责任。若甲方拒不修改广告内容或逾期修改广告内容而影响乙方广告业务的正常开展，乙方有权单方解除协议，或要求甲方支付广告延误发布期间的相应广告费用并继续履行协议。</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp; 2.5&nbsp; 甲方保证乙方使用甲方提供的广告内容不违反任何法律法规并且不构成对第三方任何权利的侵犯，包括但不限于侵犯第三方的著作权、名誉权、肖像权和/或其他知识产权，亦不会使乙方对任何第三方承担任何责任。若甲方违反此保证导致任何争议，甲方应负责解决，并赔偿乙方由此所遭受的一切损失。</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp; 2.6&nbsp; 甲方保证为履行本协议而向乙方出示的相关资质文件真实、合法、充分并持续有效。若甲方违反此保证导致任何争议，甲方应负责解决，并赔偿乙方由此所遭受的一切损失。</p><p style="font-family: Simsun;text-indent: 0;white-space: normal;margin-left: 0;background-color: rgb(243, 239, 239)">&nbsp; 2.7 &nbsp;甲方委托的朋友圈广告未在约定时间，约定范围内，发送约定次数的，乙方补发双倍次数。若广告累计3日未发送的，则乙方指定其他人发送</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp; 3.保密条款</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp; 3.1未经对方许可，任何一方不得向第三方（有关法律、法规、政府部门、证券交易所或其他监管机构要求和双方的法律、会计、商业及其他顾问、雇员除外）泄露本协议的条款的任何内容以及本协议的签订及履行情况，以及通过签订和履行本协议而获知的对方及对方关联公司的任何信息。</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp; 3.2&nbsp; 本协议有效期内及终止后两年内，本保密条款仍具有法律效力。</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp; 4.违约责任</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp; 4.1本协议签订后，除法律规定或本协议约定之条款外，甲方不得以任何理由单方提前终止本协议，否则视为甲方违约，除应向乙方全额支付本协议约定的广告费用及广告费总额千分之三的违约金外，还应赔偿乙方因此遭受的一切损失。</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp;4.2 &nbsp;除上述规定外，如任何一方严重违反本协议的任何条款而给对方造成损失，守约方均有权要求违约方承担违约责任，并赔偿守约方之损失。</p><p style="font-family: Simsun;text-indent: 0;white-space: normal;margin-left: 0;background-color: rgb(243, 239, 239)"><br/></p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp;5.不可抗力</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp;5.1 “不可抗力”是指协议双方不能合理控制、不可预见或即使预见亦无法避免的事件，该事件妨碍、影响或延误任何一方根据协议履行其全部或部分义务。该事件包括但不限于政府行为、自然灾害、战争、黑客攻击或任何其它类似事件。</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp;5.2&nbsp; 出现不可抗力事件时，知情方应及时、充分地向对方以书面形式发通知，并告知对方该类事件对本协议可能产生的影响，并应当在15天内提供相关证明。</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp;5.3&nbsp; 由于以上所述不可抗力事件致使协议的部分或全部不能履行或延迟履行，则双方于彼此间不承担任何违约责任。</p><p style="font-family: Simsun;text-indent: 0;white-space: normal;margin-left: 0;background-color: rgb(243, 239, 239)"><br/></p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp;6.特殊免责</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp;6.1 基于市场整体利益考虑及经营需要，乙方可能不定期对广告产品的服务内容、版面布局、页面设计等有关方面进行调整，如因上述调整而影响本协议项下广告的发布(包括发布位置和/或发布期间等)，甲方将给予充分的谅解，乙方则应尽可能将上述影响减少到最低程度。</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp;6.2&nbsp; 乙方需要定期或不定期地对产品进行维护，如因此类情况而造成本协议项下的广告不能按计划进行发布，甲方将予以谅解，乙方则有义务尽力避免服务中断或将中断时间限制在最短时间内。</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp;6.3&nbsp; 甲方同意，乙方因上述两种情形而不能按计划发布广告的，不视为乙方违约。但乙方应在影响广告发布的情形结束之后，尽可能按照原计划规定的位置发布原广告，并顺延因上述原因而中断的时间，或与甲方协商确定其他合理的解决方案。</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp;6.4&nbsp; 乙方同意，如甲方因乙方可以理解和接受的理由要求改变广告发布计划，不视为甲方违约；并且，在保证乙方其他广告客户的广告正常发布的前提下，乙方将根据实际情况尽可能为甲方提供方便。</p><p style="font-family: Simsun;text-indent: 0;white-space: normal;margin-left: 0;background-color: rgb(243, 239, 239)"><br/></p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp;7.争议的解决及适用法律</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">&nbsp;7.1 如双方就本协议内容或其执行发生任何争议，双方应进行友好协商；协商不成时，任何一方均可向乙方所在地法院起诉</p><p style="font-family: Simsun;white-space: normal;background-color: rgb(243, 239, 239)">书面函件。<br/></p><p><span style="font-family: Simsun;background-color: rgb(243, 239, 239)">本协议未尽事宜，由双方友好协商</span></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p>						</p>', '1470962336'),
(2, '&lt;p&gt;dasdsadasda&lt;/p&gt;', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_reports`
--

CREATE TABLE IF NOT EXISTS `tp_reports` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `text` text,
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tp_reports`
--

INSERT INTO `tp_reports` (`id`, `text`, `edit_date`) VALUES
(1, '<p>						</p><p style="white-space: normal;">自助报单当日提交成功后12小时内完成，如有12时内未完成情况，请第一时间联系导师。</p><p style="max-width: 97vw; text-align: left;"><br style="max-width: 97vw;"/></p><p style="max-width: 97vw; text-align: left;"><img src="/ueditor/php/upload/image/20160701/1467356075419579.jpg" title="1467356075419579.jpg" alt="bdlc_1.jpg"/></p><p style="max-width: 97vw; text-align: left;"><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p>						</p>', '1467356077'),
(2, '&lt;p&gt;dfsfsfsfsfsdfsd&lt;/p&gt;', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_request`
--

CREATE TABLE IF NOT EXISTS `tp_request` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '服务请求id',
  `user_id` varchar(50) DEFAULT NULL COMMENT '申请人（患者）id',
  `user_name` varchar(20) DEFAULT NULL COMMENT '用户名',
  `sex` tinyint(2) unsigned DEFAULT '0' COMMENT '请求人性别 0未知 1男 2女',
  `age` tinyint(2) unsigned DEFAULT NULL COMMENT '请求人年龄',
  `acc_id` varchar(20) DEFAULT NULL COMMENT '陪护唯一标识',
  `mobile` varchar(20) DEFAULT NULL COMMENT '患者电话',
  `acc_name` varchar(20) DEFAULT NULL COMMENT '陪护姓名',
  `createtime` varchar(20) DEFAULT NULL COMMENT '请求时间',
  `state` int(2) unsigned DEFAULT NULL COMMENT '0：失效 1：新建立未响应 ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='服务请求记录表' AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `tp_request`
--

INSERT INTO `tp_request` (`id`, `user_id`, `user_name`, `sex`, `age`, `acc_id`, `mobile`, `acc_name`, `createtime`, `state`) VALUES
(1, '0', NULL, NULL, NULL, '0', NULL, NULL, '1449563608', 1),
(2, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449563675', 1),
(3, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449639681', 1),
(4, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449639684', 1),
(5, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449639743', 1),
(6, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449639788', 1),
(7, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449639789', 1),
(8, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640075', 1),
(9, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640225', 1),
(10, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640226', 1),
(11, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640226', 1),
(12, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640227', 1),
(13, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640227', 1),
(14, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640227', 1),
(15, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640228', 1),
(16, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640280', 1),
(17, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640285', 1),
(18, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640286', 1),
(19, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640341', 1),
(20, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640389', 1),
(21, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640390', 1),
(22, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640441', 1),
(23, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640489', 1),
(24, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640490', 1),
(25, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640505', 1),
(26, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640506', 1),
(27, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640513', 1),
(28, '0', NULL, NULL, NULL, 'ceshi', NULL, NULL, '1449640519', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_setting`
--

CREATE TABLE IF NOT EXISTS `tp_setting` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(20) DEFAULT NULL COMMENT '键值名称',
  `value` text COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='基本设置表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tp_setting`
--

INSERT INTO `tp_setting` (`id`, `name`, `value`) VALUES
(1, 'custom_phone', '0532-88881987,110,120,112 '),
(2, 'good_reputation', '会面准时,衣着干净,态度和蔼,熟悉流程,技能专业,服务热情'),
(3, 'negative_comment', '多收费,态度恶劣,不准时到岗,业务不熟悉'),
(4, 'server_date', '1'),
(5, 'introduce_info', '等发达省份试点&lt;span&gt;&lt;/span&gt;');

-- --------------------------------------------------------

--
-- 表的结构 `tp_sign`
--

CREATE TABLE IF NOT EXISTS `tp_sign` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(100) DEFAULT NULL COMMENT '用户账号',
  `sign` varchar(500) NOT NULL COMMENT '积分',
  `type` int(4) unsigned DEFAULT NULL COMMENT '积分类型',
  `date` varchar(15) DEFAULT NULL COMMENT '写入时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='看诊类型表' AUTO_INCREMENT=146 ;

--
-- 转存表中的数据 `tp_sign`
--

INSERT INTO `tp_sign` (`id`, `username`, `sign`, `type`, `date`) VALUES
(145, '123', '-50', 3, '1470206670'),
(144, '123', '-50', 3, '1470206660'),
(143, '123', '-50', 3, '1469093654'),
(142, '123', '-50', 3, '1469093642'),
(141, '123', '-50', 3, '1469093616'),
(140, '123', '-50', 3, '1469093602'),
(139, '123', '-12', 4, '1468390251'),
(138, '123', '-12', 4, '1468390227'),
(137, '456', '-56', 5, '1468388858'),
(136, '456', '33', 1, '1468388555'),
(135, '456', '11', 1, '1468388552'),
(134, '456', '11', 1, '1468388548'),
(133, '222', '11', 1, '1468388503'),
(132, '456', '11', 1, '1468386941'),
(131, '110', '11', 1, '1468386934'),
(130, '456', '11', 1, '1468386905'),
(129, '456', '11', 1, '1468386831'),
(128, '456', '11', 1, '1468386541'),
(127, '456', '11', 1, '1468386538'),
(126, '110', '11', 1, '1468386473'),
(125, '110', '111', 1, '1468386469'),
(124, '110', '11', 1, '1468386463'),
(123, '456', '1', 1, '1468386063'),
(122, 'anzhuo', '11', 1, '1468380150'),
(121, '123', '11', 1, '1468380147'),
(120, '123', '11', 1, '1468380142'),
(119, '123', '111', 1, '1468380138'),
(118, '456', '11', 1, '1468380078'),
(117, '456', '10', 1, '1468379827'),
(116, '456', '50', 1, '1468379816'),
(115, '123', '-50', 3, '1468315133'),
(114, '123', '-50', 3, '1468315105'),
(113, '123', '-50', 3, '1468315093'),
(112, '123', '-50', 3, '1468315081'),
(111, '123', '-1', 5, '1468314414'),
(110, '123', '-50', 3, '1468308602'),
(109, '123', '-50', 3, '1468308590'),
(70, '123', '-1', 3, '1467163699'),
(71, '123', '-1', 3, '1467163735'),
(72, '123', '-1', 3, '1467163747'),
(73, '123', '-1', 3, '1467177355'),
(74, '123', '-1', 3, '1467180806'),
(75, '123', '-50', 3, '1467188736'),
(76, '123', '-50', 3, '1467188767'),
(77, '123', '-50', 3, '1467188779'),
(78, '123', '-50', 3, '1467188789'),
(79, '123', '-50', 3, '1467188797'),
(99, '123', '-500', 5, '1467270690'),
(100, '123', '-60', 6, '1467271454'),
(101, '徐慎凯', '11', 2, '1467273541'),
(102, '徐慎凯', '22', 6, '1467273558'),
(103, '123', '-22', 5, '1467273665'),
(104, '123', '-12', 4, '1467278901'),
(105, '123', '-13', 5, '1467342730'),
(106, '123', '-12', 4, '1467342787'),
(107, '123', '-7', 4, '1467342986'),
(108, '123', '-50', 3, '1467356978');

-- --------------------------------------------------------

--
-- 表的结构 `tp_sign_exchange`
--

CREATE TABLE IF NOT EXISTS `tp_sign_exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `click` double NOT NULL COMMENT '点击给代理费用',
  `signed` int(11) NOT NULL COMMENT '签到积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tp_sign_exchange`
--

INSERT INTO `tp_sign_exchange` (`id`, `click`, `signed`) VALUES
(1, 12, 3);

-- --------------------------------------------------------

--
-- 表的结构 `tp_sign_xieyi`
--

CREATE TABLE IF NOT EXISTS `tp_sign_xieyi` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `text` text,
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tp_sign_xieyi`
--

INSERT INTO `tp_sign_xieyi` (`id`, `text`, `edit_date`) VALUES
(1, '&lt;p&gt;dadsadasdsadas&lt;/p&gt;', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_sugg`
--

CREATE TABLE IF NOT EXISTS `tp_sugg` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL COMMENT '注册的账号唯一表示',
  `info` varchar(5000) NOT NULL COMMENT '建议',
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `tp_sugg`
--

INSERT INTO `tp_sugg` (`id`, `name`, `info`, `edit_date`) VALUES
(13, '123', 'Hahn\n', '1468311806'),
(14, '123', '68678', '1468993985');

-- --------------------------------------------------------

--
-- 表的结构 `tp_user`
--

CREATE TABLE IF NOT EXISTS `tp_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(50) NOT NULL COMMENT '用户名称',
  `truename` varchar(500) NOT NULL COMMENT '真实姓名',
  `company` varchar(500) DEFAULT NULL,
  `total_score` int(11) DEFAULT '0' COMMENT '业绩总积分',
  `total_money` double DEFAULT NULL COMMENT '总金额',
  `shop_sign` int(11) DEFAULT NULL COMMENT '商城积分',
  `expend_score` int(11) DEFAULT NULL COMMENT '消费积分',
  `job` varchar(500) DEFAULT NULL COMMENT '职位',
  `pay` varchar(500) DEFAULT NULL COMMENT '支付宝账号',
  `payname` varchar(500) DEFAULT NULL COMMENT '支付宝姓名',
  `card` varchar(20) DEFAULT NULL COMMENT '身份证',
  `head` varchar(300) DEFAULT NULL COMMENT '用户头像',
  `province` varchar(200) DEFAULT NULL COMMENT '省份',
  `city` varchar(500) DEFAULT NULL COMMENT '市',
  `area` varchar(500) DEFAULT NULL COMMENT '地区',
  `mobile` varchar(20) DEFAULT NULL COMMENT '用户手机号',
  `tel` varchar(20) DEFAULT NULL COMMENT '电话',
  `address` varchar(500) DEFAULT NULL COMMENT '地址',
  `sex` tinyint(1) DEFAULT '0' COMMENT '0未知1男2女',
  `group_mark` varchar(20) DEFAULT NULL,
  `birthday` varchar(20) DEFAULT NULL COMMENT '用户生日',
  `pass_text` varchar(50) DEFAULT NULL COMMENT '随机生成6位数密码',
  `pass_initialize` int(4) unsigned DEFAULT '0' COMMENT '0为未修改，1为已修改',
  `age` int(4) unsigned DEFAULT NULL COMMENT '年龄',
  `password` varchar(50) DEFAULT NULL COMMENT '用户密码',
  `email` varchar(100) DEFAULT NULL COMMENT '用户邮箱',
  `edit_date` varchar(20) DEFAULT NULL COMMENT '编辑时间',
  `date` varchar(20) DEFAULT NULL COMMENT '用户注册时间',
  `login_time` varchar(10) DEFAULT NULL COMMENT '当前登录时间',
  `old_login_time` varchar(10) DEFAULT NULL COMMENT '上次登录时间',
  `login_ip` varchar(20) DEFAULT NULL COMMENT '当前登录ip',
  `old_login_ip` varchar(20) DEFAULT NULL COMMENT '上次登录ip',
  `status` int(2) unsigned DEFAULT NULL COMMENT '用户状态 0为禁用，1为可用',
  `sort` int(2) unsigned DEFAULT NULL COMMENT '排序',
  `friends` varchar(20) DEFAULT NULL COMMENT '亲友id，多个用“，”连接',
  `ill` varchar(50) DEFAULT NULL COMMENT '病史记录用“，”隔开',
  `encry` varchar(500) DEFAULT NULL COMMENT 'url加密参数',
  `machine_id` varchar(50) DEFAULT NULL COMMENT '机器码',
  `machine_type` varchar(10) DEFAULT NULL COMMENT '机器类型 android  ios',
  `grade_id` int(10) DEFAULT NULL COMMENT '用户等级id',
  PRIMARY KEY (`id`),
  KEY `member_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=203 ;

--
-- 转存表中的数据 `tp_user`
--

INSERT INTO `tp_user` (`id`, `name`, `truename`, `company`, `total_score`, `total_money`, `shop_sign`, `expend_score`, `job`, `pay`, `payname`, `card`, `head`, `province`, `city`, `area`, `mobile`, `tel`, `address`, `sex`, `group_mark`, `birthday`, `pass_text`, `pass_initialize`, `age`, `password`, `email`, `edit_date`, `date`, `login_time`, `old_login_time`, `login_ip`, `old_login_ip`, `status`, `sort`, `friends`, `ill`, `encry`, `machine_id`, `machine_type`, `grade_id`) VALUES
(192, '623491789', '田斐', NULL, 0, NULL, NULL, NULL, NULL, 'tflovefgb@163.com', '田斐', '370283198809031242', NULL, '山东', '青岛市', '市北区', NULL, '15263031172', '四季景园42号楼一单元402', 0, 'SDQDSSBQ', NULL, NULL, 1, NULL, '15164c91df9113b0f27353784e13af4c', NULL, NULL, '1470733574', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '639cb91e9a064526c7550432e6f8a612', NULL, NULL, 1),
(193, '125941800', '尹燕铎', NULL, 0, NULL, NULL, NULL, NULL, 'yinyanduo@qq.com', '尹燕铎', '370921198404190017', NULL, '山东', '济南市', '槐荫区', NULL, '18615566967', '纬十二路9号路劲御景城二区10号楼1单元1602', 0, 'SDJNSHYQ', NULL, NULL, 1, NULL, 'a61136eca221cf81f14927fe1837420f', NULL, NULL, '1470733801', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '29c15e67a62745111e0c474ff5d0a8cb', NULL, NULL, 1),
(194, '932582936', '聂安琪', NULL, 0, NULL, NULL, NULL, NULL, '13276414704', '聂安琪', '370304199609186228', NULL, '山东', '济南市', '天桥区', NULL, '17862969466', '山东省济南市天桥区济泺路61号泺安广场809', 0, 'SDJNSTQQ', NULL, NULL, 1, NULL, '386c6dabd4b2ae933efd44c821e99c95', NULL, NULL, '1470734411', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(195, '447541919', '于梦娇', NULL, 0, NULL, NULL, NULL, NULL, '15288858482', '于梦娇', '371523199104120048', NULL, '山东', '济南市', '天桥区', NULL, '15288858482', '济南市天桥区济泺路61号', 0, 'SDJNSTQQ', NULL, NULL, 1, NULL, '5e31260bb6d990f373743c7c12425268', NULL, NULL, '1470735651', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(196, '1009760519', '穆肖荣', NULL, 0, NULL, NULL, NULL, NULL, '18265526928', '穆肖荣', '37150219950212312x', NULL, '山东', '济南市', '天桥区', NULL, '13287735853', '工业新村', 0, 'SDJNSTQQ', NULL, NULL, 1, NULL, '612c43934704dc24cb573853d728642a', NULL, NULL, '1470736243', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(197, '535667261', '左佳', NULL, 0, NULL, NULL, NULL, NULL, '535667261@qq.com', '左佳', '370283199206061260', NULL, '山东', '青岛市', '平度市', NULL, '15610572797', '长江西路36号', 0, 'SDQDSPDS', NULL, NULL, 1, NULL, '842fa30868f496cdbf0cff066d0b8e33', NULL, NULL, '1470738615', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2661138dcabb048520a77aa2ac8bfc34', NULL, NULL, 1),
(198, '287365827', '牛可', NULL, 0, NULL, NULL, NULL, NULL, '18769090063', '牛可', '372925199701262728', NULL, '山东', '济南市', '天桥区', NULL, '18769090063', '泺安广场', 0, 'SDJNSTQQ', NULL, NULL, 1, NULL, '16277c25e4366654085f3f398341f7f2', NULL, NULL, '1470962495', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(199, '923144374', '王英飞', NULL, 0, NULL, NULL, NULL, NULL, '17862918099', '王英飞', '37068519960328602X', NULL, '山东', '济南市', '市中区', NULL, '17862918099', '王官庄街道济南大学', 0, 'SDJNSSZQ', NULL, NULL, 1, NULL, '86182557c3ec027e174dd786dff6d5c0', NULL, NULL, '1470962520', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '5407b50e27a1a834f5a228dfe65b46c0', NULL, NULL, 1),
(200, '935372654', '张石林', NULL, 0, NULL, NULL, NULL, NULL, '6226191602316434', '张石林', '372925199104224715', NULL, '山东', '济南市', '天桥区', NULL, '13249338006', '山东省济南市天桥区七巧公寓三号楼东508号', 0, 'SDJNSTQQ', NULL, NULL, 1, NULL, 'ffdf9868e48d76d56df5115ec5ed5b85', NULL, NULL, '1471612976', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '32eaf162a42720a5ecf007b6ac471734', NULL, NULL, 1),
(201, '1693275792', '于玲', NULL, 0, NULL, NULL, NULL, NULL, '17865123345', '于同学', '220723199403171627', NULL, '山东', '济南市', '天桥区', NULL, '13275413484', '丰泽家园2单元3号楼402', 0, 'SDJNSTQQ', NULL, NULL, 1, NULL, '62aa4dcfa7100ef909185289f6600308', NULL, NULL, '1471839041', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(202, '123', '123', NULL, 0, NULL, NULL, NULL, NULL, '18560619695', '发送到', '3729261980703222', NULL, '山东', '青岛市', '市南区', NULL, '18560619695', '测试地址', 0, 'SDQDSSNQ', NULL, NULL, 1, NULL, 'd9b1d7db4cd6e70935368a1efb10e377', NULL, NULL, '1471924720', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '202cb962ac59075b964b07152d234b70', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_user_grade`
--

CREATE TABLE IF NOT EXISTS `tp_user_grade` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) DEFAULT NULL COMMENT '医院名称',
  `status` int(2) unsigned DEFAULT '1' COMMENT '状态',
  `sort` int(4) unsigned DEFAULT '1' COMMENT '排序',
  `date` varchar(15) DEFAULT NULL COMMENT '写入时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='医院表' AUTO_INCREMENT=182 ;

--
-- 转存表中的数据 `tp_user_grade`
--

INSERT INTO `tp_user_grade` (`id`, `name`, `status`, `sort`, `date`) VALUES
(3, '高级用户', 1, 4, '1454395561'),
(4, 'VIP用户', 1, 3, '1454395575'),
(2, '中级用户', 1, 2, '1454404812'),
(1, '普通会员', 1, 1, '1454493709');

-- --------------------------------------------------------

--
-- 表的结构 `tp_work_log`
--

CREATE TABLE IF NOT EXISTS `tp_work_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `acc_id` varchar(20) NOT NULL COMMENT '陪护人员标识',
  `login_time` varchar(20) NOT NULL COMMENT '上班时间',
  `out_time` varchar(20) DEFAULT NULL COMMENT '下班时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='上班时间表' AUTO_INCREMENT=1288 ;

--
-- 转存表中的数据 `tp_work_log`
--

INSERT INTO `tp_work_log` (`id`, `acc_id`, `login_time`, `out_time`) VALUES
(1, 'ceshi', '1430776800', '1430805600'),
(9, 'ceshi', '1430776800', NULL),
(10, 'ceshi', '1451875476', NULL),
(11, 'ceshi', '1451875583', NULL),
(12, 'ceshi', '1451875588', NULL),
(13, 'ceshi', '1451875595', NULL),
(14, 'ceshi', '1451875736', NULL),
(15, 'ceshi', '1451875758', NULL),
(16, 'ceshi', '1451875887', NULL),
(17, 'ceshi', '1451875961', NULL),
(18, 'ceshi', '1451876234', NULL),
(19, 'ceshi', '1451876359', NULL),
(20, 'ceshi', '1451876404', NULL),
(21, 'ceshi', '1451876431', NULL),
(22, 'ceshi', '1451876486', NULL),
(23, 'ceshi', '1451876556', NULL),
(24, 'ceshi', '1451876803', NULL),
(25, 'ceshi', '1451876867', NULL),
(26, 'ceshi', '1451876881', NULL),
(27, 'ceshi', '1451876903', NULL),
(28, 'ceshi', '1451877124', NULL),
(29, 'ceshi', '1451877173', NULL),
(30, 'ceshi', '1451877204', NULL),
(31, 'ceshi', '1451877227', NULL),
(32, 'ceshi', '1451877412', NULL),
(33, 'ceshi', '1451889620', NULL),
(34, 'ceshi', '1451889711', NULL),
(35, 'ceshi', '1451889764', NULL),
(36, 'ceshi', '1451889864', NULL),
(37, 'ceshi', '1451889969', NULL),
(38, 'ceshi', '1451890049', NULL),
(39, 'ceshi', '1451890162', NULL),
(40, 'ceshi', '1451890238', NULL),
(41, 'ceshi', '1451890297', NULL),
(42, 'ceshi', '1451891245', NULL),
(43, 'ceshi', '1451891408', NULL),
(44, 'ceshi', '1451891740', NULL),
(45, 'ceshi', '1451891790', NULL),
(46, 'ceshi', '1451891968', NULL),
(47, 'ceshi', '1451892020', NULL),
(48, 'ceshi', '1451892065', NULL),
(49, 'ceshi', '1451892204', NULL),
(50, 'ceshi', '1451892220', NULL),
(51, 'ceshi', '1451892237', NULL),
(52, 'ceshi', '1451892312', NULL),
(53, 'ceshi', '1451892325', NULL),
(54, 'ceshi', '1451892328', NULL),
(55, 'ceshi', '1451892379', NULL),
(56, 'ceshi', '1451892502', NULL),
(57, 'ceshi', '1451892540', NULL),
(58, 'ceshi', '1451892561', NULL),
(59, 'ceshi', '1451892670', NULL),
(60, 'ceshi', '1451892732', NULL),
(61, 'ceshi', '1451893346', NULL),
(62, 'ceshi', '1451893405', NULL),
(63, 'ceshi', '1451894591', NULL),
(64, 'ceshi', '1451894613', NULL),
(65, 'ceshi', '1451894858', NULL),
(66, 'ceshi', '1451894868', NULL),
(67, 'ceshi', '1451894918', NULL),
(68, 'ceshi', '1451895210', NULL),
(69, 'ceshi', '1451896083', NULL),
(70, 'ceshi', '1451896548', NULL),
(71, 'ceshi', '1451897196', NULL),
(72, 'ceshi', '1451897199', NULL),
(73, 'ceshi', '1451898160', NULL),
(74, 'ceshi', '1451898163', NULL),
(75, 'ceshi', '1451898208', NULL),
(76, 'ceshi', '1451898260', NULL),
(77, 'ceshi', '1451898423', NULL),
(78, 'ceshi', '1451898466', NULL),
(79, 'ceshi', '1451898514', NULL),
(80, 'ceshi', '1451898619', NULL),
(81, 'ceshi', '1451898661', NULL),
(82, 'ceshi', '1451898801', NULL),
(83, 'ceshi', '1451898849', NULL),
(84, 'ceshi', '1451898971', NULL),
(85, 'ceshi', '1451899179', NULL),
(86, 'ceshi', '1451899182', NULL),
(87, 'ceshi', '1451899905', NULL),
(88, 'ceshi', '1451900135', NULL),
(89, 'ceshi', '1451900285', NULL),
(90, 'ceshi', '1451900804', NULL),
(91, 'ceshi', '1451901005', NULL),
(92, 'ceshi', '1451901019', NULL),
(93, 'ceshi', '1451901058', NULL),
(94, 'ceshi', '1451901060', NULL),
(95, 'ceshi', '1451901084', NULL),
(96, 'ceshi', '1451901106', NULL),
(97, 'ceshi', '1451901175', NULL),
(98, 'ceshi', '1451960433', NULL),
(99, 'ceshi', '1451962518', NULL),
(100, 'ceshi', '1451962651', NULL),
(101, 'ceshi', '1451963153', NULL),
(102, 'ceshi', '1451963242', NULL),
(103, 'ceshi', '1451963253', NULL),
(104, 'ceshi', '1451963257', NULL),
(105, 'ceshi', '1451963261', NULL),
(106, 'ceshi', '1451966140', NULL),
(107, 'ceshi', '1451966199', NULL),
(108, 'ceshi', '1451966311', NULL),
(109, 'ceshi', '1451966363', NULL),
(110, 'ceshi', '1451966416', NULL),
(111, 'ceshi', '1451966452', NULL),
(112, 'ceshi', '1451970138', NULL),
(113, 'ceshi', '1451970389', NULL),
(114, 'ceshi', '1451970572', NULL),
(115, 'ceshi', '1451970737', NULL),
(116, 'ceshi', '1451970810', NULL),
(117, 'ceshi', '1451970883', NULL),
(118, 'ceshi', '1451970919', NULL),
(119, 'ceshi', '1451971102', NULL),
(120, 'ceshi', '1451971475', NULL),
(121, 'ceshi', '1451972270', NULL),
(122, 'ceshi', '1451972354', NULL),
(123, 'ceshi', '1451972389', NULL),
(124, 'ceshi', '1451972425', NULL),
(125, 'ceshi', '1451972457', NULL),
(126, 'ceshi', '1451972476', NULL),
(127, 'ceshi', '1451972495', NULL),
(128, 'ceshi', '1451972518', NULL),
(129, 'ceshi', '1451972582', NULL),
(130, 'ceshi', '1451972653', NULL),
(131, 'ceshi', '1451972729', NULL),
(132, 'ceshi', '1451972770', NULL),
(133, 'ceshi', '1451973260', NULL),
(134, 'ceshi', '1451973328', NULL),
(135, 'ceshi', '1451973368', NULL),
(136, 'ceshi', '1451973384', NULL),
(137, 'ceshi', '1451973669', NULL),
(138, 'ceshi', '1451973748', NULL),
(139, 'ceshi', '1451973752', NULL),
(140, 'ceshi', '1451974338', NULL),
(141, 'ceshi', '1451974463', NULL),
(142, 'ceshi', '1451975167', NULL),
(143, 'ceshi', '1451975362', NULL),
(144, 'ceshi', '1451975427', NULL),
(145, 'ceshi', '1451976887', NULL),
(146, 'ceshi', '1451976922', NULL),
(147, 'ceshi', '1451976925', NULL),
(148, 'ceshi', '1451976963', NULL),
(149, 'ceshi', '1451976985', NULL),
(150, 'ceshi', '1451977307', NULL),
(151, 'ceshi', '1451977325', NULL),
(152, 'ceshi', '1451978813', NULL),
(153, 'ceshi', '1451978908', NULL),
(154, 'ceshi', '1451979408', NULL),
(155, 'ceshi', '1451979769', NULL),
(156, 'ceshi', '1451979770', NULL),
(157, 'ceshi', '1451979781', NULL),
(158, 'ceshi', '1451979785', NULL),
(159, 'ceshi', '1451979801', NULL),
(160, 'ceshi', '1451979807', NULL),
(161, 'ceshi', '1451979810', NULL),
(162, 'ceshi', '1451979813', NULL),
(163, 'ceshi', '1451982037', NULL),
(164, 'ceshi', '1451982041', NULL),
(165, 'ceshi', '1451982044', NULL),
(166, 'ceshi', '1451982051', NULL),
(167, 'ceshi', '1451982055', NULL),
(168, 'ceshi', '1451982062', NULL),
(169, 'ceshi', '1451982072', NULL),
(170, 'ceshi', '1451982079', NULL),
(171, 'ceshi', '1451982087', NULL),
(172, 'ceshi', '1451984588', NULL),
(173, 'ceshi', '1451985331', NULL),
(174, 'ceshi', '1451985554', NULL),
(175, 'ceshi', '1451986045', NULL),
(176, 'ceshi', '1451986126', NULL),
(177, 'ceshi', '1451986217', NULL),
(178, 'ceshi', '1451986253', NULL),
(179, 'ceshi', '1451986293', NULL),
(180, 'ceshi', '1451986383', NULL),
(181, 'ceshi', '1451986397', NULL),
(182, 'ceshi', '1451986417', NULL),
(183, 'ceshi', '1451988007', NULL),
(184, 'ceshi', '1451988204', NULL),
(185, 'ceshi', '1452044791', NULL),
(186, 'ceshi', '1452044804', NULL),
(187, 'ceshi', '1452044831', NULL),
(188, 'ceshi', '1452044853', NULL),
(189, 'ceshi', '1452045108', NULL),
(190, 'ceshi', '1452045331', NULL),
(191, 'ceshi', '1452045870', NULL),
(192, 'ceshi', '1452045964', NULL),
(193, 'ceshi', '1452046193', NULL),
(194, 'ceshi', '1452046225', NULL),
(195, 'ceshi', '1452046709', NULL),
(196, 'ceshi', '1452046721', NULL),
(197, 'ceshi', '1452046785', NULL),
(198, 'ceshi', '1452046887', NULL),
(199, 'ceshi', '1452047029', NULL),
(200, 'ceshi', '1452047133', NULL),
(201, 'ceshi', '1452047447', NULL),
(202, 'ceshi', '1452047456', NULL),
(203, 'ceshi', '1452047644', NULL),
(204, 'ceshi', '1452048321', NULL),
(205, 'ceshi', '1452048337', NULL),
(206, 'ceshi', '1452049092', NULL),
(207, 'ceshi', '1452049371', NULL),
(208, 'ceshi', '1452049406', NULL),
(209, 'ceshi', '1452050108', NULL),
(210, 'ceshi', '1452050746', NULL),
(211, 'ceshi', '1452051010', NULL),
(212, 'ceshi', '1452051145', NULL),
(213, 'ceshi', '1452051170', NULL),
(214, 'ceshi', '1452051203', NULL),
(215, 'ceshi', '1452051245', NULL),
(216, 'ceshi', '1452051324', NULL),
(217, 'ceshi', '1452051339', NULL),
(218, 'ceshi', '1452051614', NULL),
(219, 'ceshi', '1452051645', NULL),
(220, 'ceshi', '1452051793', NULL),
(221, 'ceshi', '1452051811', NULL),
(222, 'ceshi', '1452051864', NULL),
(223, 'ceshi', '1452051885', NULL),
(224, 'ceshi', '1452051988', NULL),
(225, 'ceshi', '1452052043', NULL),
(226, 'ceshi', '1452052089', NULL),
(227, 'ceshi', '1452052134', NULL),
(228, 'ceshi', '1452052199', NULL),
(229, 'ceshi', '1452052382', NULL),
(230, 'ceshi', '1452052669', NULL),
(231, 'ceshi', '1452056539', NULL),
(232, 'ceshi', '1452056567', NULL),
(233, 'ceshi', '1452056587', NULL),
(234, 'ceshi', '1452056961', NULL),
(235, 'ceshi', '1452057053', NULL),
(236, 'ceshi', '1452057085', NULL),
(237, 'ceshi', '1452057224', NULL),
(238, 'ceshi', '1452057235', NULL),
(239, 'ceshi', '1452057507', NULL),
(240, 'ceshi', '1452059016', NULL),
(241, 'ceshi', '1452059067', NULL),
(242, 'ceshi', '1452059068', NULL),
(243, 'ceshi', '1452059070', NULL),
(244, 'ceshi', '1452059071', NULL),
(245, 'ceshi', '1452059145', NULL),
(246, 'ceshi', '1452059345', NULL),
(247, 'ceshi', '1452059419', NULL),
(248, 'ceshi', '1452059443', NULL),
(249, 'ceshi', '1452059491', NULL),
(250, 'ceshi', '1452059509', NULL),
(251, 'ceshi', '1452059669', NULL),
(252, 'ceshi', '1452059716', NULL),
(253, 'ceshi', '1452059759', NULL),
(254, 'ceshi', '1452059877', NULL),
(255, 'ceshi', '1452059896', NULL),
(256, 'ceshi', '1452059925', NULL),
(257, 'ceshi', '1452059969', NULL),
(258, 'ceshi', '1452060479', NULL),
(259, 'ceshi', '1452060484', NULL),
(260, 'ceshi', '1452061008', NULL),
(261, 'ceshi', '1452062007', NULL),
(262, 'ceshi', '1452062488', NULL),
(263, 'ceshi', '1452062675', NULL),
(264, 'ceshi', '1452062683', NULL),
(265, 'ceshi', '1452062955', NULL),
(266, 'ceshi', '1452063265', NULL),
(267, 'ceshi', '1452063432', NULL),
(268, 'ceshi', '1452066035', NULL),
(269, 'ceshi', '1452066068', NULL),
(270, 'ceshi', '1452066461', NULL),
(271, 'ceshi', '1452067145', NULL),
(272, 'ceshi', '1452067835', NULL),
(273, 'ceshi', '1452067881', NULL),
(274, 'ceshi', '1452068137', NULL),
(275, 'ceshi', '1452068217', NULL),
(276, 'ceshi', '1452068325', NULL),
(277, 'ceshi', '1452068361', NULL),
(278, 'ceshi', '1452068434', NULL),
(279, 'ceshi', '1452068490', NULL),
(280, 'ceshi', '1452068749', NULL),
(281, 'ceshi', '1452068821', NULL),
(282, 'ceshi', '1452069029', NULL),
(283, 'ceshi', '1452069254', NULL),
(284, 'ceshi', '1452069313', NULL),
(285, 'ceshi', '1452069332', NULL),
(286, 'ceshi', '1452069340', NULL),
(287, 'ceshi', '1452069385', NULL),
(288, 'ceshi', '1452069398', NULL),
(289, 'ceshi', '1452069438', NULL),
(290, 'ceshi', '1452069771', NULL),
(291, 'ceshi', '1452069773', NULL),
(292, 'ceshi', '1452069774', NULL),
(293, 'ceshi', '1452070220', NULL),
(294, 'ceshi', '1452070523', NULL),
(295, 'ceshi', '1452071513', NULL),
(296, 'ceshi', '1452072041', NULL),
(297, 'ceshi', '1452072146', NULL),
(298, 'ceshi', '1452072286', NULL),
(299, 'ceshi', '1452072379', NULL),
(300, 'ceshi', '1452072605', NULL),
(301, 'ceshi', '1452072701', NULL),
(302, 'ceshi', '1452072943', NULL),
(303, 'ceshi', '1452130859', NULL),
(304, 'ceshi', '1452130873', NULL),
(305, 'ceshi', '1452130942', NULL),
(306, 'ceshi', '1452130974', NULL),
(307, 'ceshi', '1452130986', NULL),
(308, 'ceshi', '1452130987', NULL),
(309, 'ceshi', '1452131002', NULL),
(310, 'ceshi', '1452131008', NULL),
(311, 'ceshi', '1452131069', NULL),
(312, 'ceshi', '1452131109', NULL),
(313, 'ceshi', '1452131408', NULL),
(314, 'ceshi', '1452131420', NULL),
(315, 'ceshi', '1452131421', NULL),
(316, 'ceshi', '1452131432', NULL),
(317, 'ceshi', '1452131467', NULL),
(318, 'ceshi', '1452131469', NULL),
(319, 'ceshi', '1452131474', NULL),
(320, 'ceshi', '1452131485', NULL),
(321, 'ceshi', '1452131634', NULL),
(322, 'ceshi', '1452131650', NULL),
(323, 'ceshi', '1452131677', NULL),
(324, 'ceshi', '1452131928', NULL),
(325, 'ceshi', '1452132289', NULL),
(326, 'ceshi', '1452132295', NULL),
(327, 'ceshi', '1452132298', NULL),
(328, 'ceshi', '1452132301', NULL),
(329, 'ceshi', '1452132434', NULL),
(330, 'ceshi', '1452132466', NULL),
(331, 'ceshi', '1452132489', NULL),
(332, 'ceshi', '1452132663', NULL),
(333, 'ceshi', '1452132667', NULL),
(334, 'ceshi', '1452132670', NULL),
(335, 'ceshi', '1452132673', NULL),
(336, 'ceshi', '1452132774', NULL),
(337, 'ceshi', '1452133365', NULL),
(338, 'ceshi', '1452133791', NULL),
(339, 'ceshi', '1452133805', NULL),
(340, 'ceshi', '1452133853', NULL),
(341, 'ceshi', '1452133876', NULL),
(342, 'ceshi', '1452134437', NULL),
(343, 'ceshi', '1452134633', NULL),
(344, 'ceshi', '1452135496', NULL),
(345, 'ceshi', '1452136030', NULL),
(346, 'ceshi', '1452136689', NULL),
(347, 'ceshi', '1452138978', NULL),
(348, 'ceshi', '1452143219', NULL),
(349, 'ceshi', '1452144168', NULL),
(350, 'ceshi', '1452144285', NULL),
(351, 'ceshi', '1452145303', NULL),
(352, 'ceshi', '1452145770', NULL),
(353, 'ceshi', '1452146033', NULL),
(354, 'ceshi', '1452146037', NULL),
(355, 'ceshi', '1452146134', NULL),
(356, 'ceshi', '1452146290', NULL),
(357, 'ceshi', '1452146345', NULL),
(358, 'ceshi', '1452146437', NULL),
(359, 'ceshi', '1452146482', NULL),
(360, 'ceshi', '1452146499', NULL),
(361, 'ceshi', '1452146707', NULL),
(362, 'ceshi', '1452146809', NULL),
(363, 'ceshi', '1452146842', NULL),
(364, 'ceshi', '1452146877', NULL),
(365, 'ceshi', '1452146978', NULL),
(366, 'ceshi', '1452148661', NULL),
(367, 'ceshi', '1452148788', NULL),
(368, 'ceshi', '1452150157', NULL),
(369, 'ceshi', '1452153830', NULL),
(370, 'ceshi', '1452153976', NULL),
(371, 'ceshi', '1452154113', NULL),
(372, 'ceshi', '1452154253', NULL),
(373, 'ceshi', '1452157764', NULL),
(374, 'ceshi', '1452157879', NULL),
(375, 'ceshi', '1452220740', NULL),
(376, 'ceshi', '1452220786', NULL),
(377, 'ceshi', '1452220834', NULL),
(378, 'ceshi', '1452224146', NULL),
(379, 'ceshi', '1452227606', NULL),
(380, 'ceshi', '1452227851', NULL),
(381, 'ceshi', '1452230979', NULL),
(382, 'ceshi', '1452231162', NULL),
(383, 'ceshi', '1452231299', NULL),
(384, 'ceshi', '1452233068', NULL),
(385, 'ceshi', '1452233167', NULL),
(386, 'ceshi', '1452233206', NULL),
(387, 'ceshi', '1452233280', NULL),
(388, 'ceshi', '1452233354', NULL),
(389, 'ceshi', '1452233437', NULL),
(390, 'ceshi', '1452233463', NULL),
(391, 'ceshi', '1452233536', NULL),
(392, 'ceshi', '1452233574', NULL),
(393, 'ceshi', '1452233653', NULL),
(394, 'ceshi', '1452233734', NULL),
(395, 'ceshi', '1452233754', NULL),
(396, 'ceshi', '1452233775', NULL),
(397, 'ceshi', '1452233843', NULL),
(398, 'ceshi', '1452233887', NULL),
(399, 'ceshi', '1452233906', NULL),
(400, 'ceshi', '1452233966', NULL),
(401, 'ceshi', '1452234101', NULL),
(402, 'ceshi', '1452234339', NULL),
(403, 'ceshi', '1452234407', NULL),
(404, 'ceshi', '1452234506', NULL),
(405, 'ceshi', '1452234577', NULL),
(406, 'ceshi', '1452234689', NULL),
(407, 'ceshi', '1452234716', NULL),
(408, 'ceshi', '1452234981', NULL),
(409, 'ceshi', '1452235118', NULL),
(410, 'ceshi', '1452235890', NULL),
(411, 'ceshi', '1452235969', NULL),
(412, 'ceshi', '1452236002', NULL),
(413, 'ceshi', '1452236055', NULL),
(414, 'ceshi', '1452236097', NULL),
(415, 'ceshi', '1452236116', NULL),
(416, 'ceshi', '1452236141', NULL),
(417, 'ceshi', '1452236176', NULL),
(418, 'ceshi', '1452237154', NULL),
(419, 'ceshi', '1452237246', NULL),
(420, 'ceshi', '1452237455', NULL),
(421, 'ceshi', '1452237483', NULL),
(422, 'ceshi', '1452237559', NULL),
(423, 'ceshi', '1452237591', NULL),
(424, 'ceshi', '1452237622', NULL),
(425, 'ceshi', '1452237666', NULL),
(426, 'ceshi', '1452240178', NULL),
(427, 'ceshi', '1452240180', NULL),
(428, 'ceshi', '1452240387', NULL),
(429, 'ceshi', '1452240494', NULL),
(430, 'ceshi', '1452240690', NULL),
(431, 'ceshi', '1452240717', NULL),
(432, 'ceshi', '1452240757', NULL),
(433, 'ceshi', '1452240798', NULL),
(434, 'ceshi', '1452240855', NULL),
(435, 'ceshi', '1452240947', NULL),
(436, 'ceshi', '1452240971', NULL),
(437, 'ceshi', '1452241075', NULL),
(438, 'ceshi', '1452241077', NULL),
(439, 'ceshi', '1452241213', NULL),
(440, 'ceshi', '1452241397', NULL),
(441, 'ceshi', '1452241791', NULL),
(442, 'ceshi', '1452241886', NULL),
(443, 'ceshi', '1452242953', NULL),
(444, 'ceshi', '1452242982', NULL),
(445, 'ceshi', '1452243049', NULL),
(446, 'ceshi', '1452243196', NULL),
(447, 'ceshi', '1452243432', NULL),
(448, 'ceshi', '1452243607', NULL),
(449, 'ceshi', '1452244416', NULL),
(450, 'ceshi', '1452244548', NULL),
(451, 'ceshi', '1452244798', NULL),
(452, 'ceshi', '1452245020', NULL),
(453, 'ceshi', '1452245103', NULL),
(454, 'ceshi', '1452245235', NULL),
(455, 'ceshi', '1452246329', NULL),
(456, 'ceshi', '1452246441', NULL),
(457, 'ceshi', '1452246446', NULL),
(458, 'ceshi', '1452246510', NULL),
(459, 'ceshi', '1452246578', NULL),
(460, 'ceshi', '1452246650', NULL),
(461, 'ceshi', '1452246783', NULL),
(462, 'ceshi', '1452246845', NULL),
(463, 'ceshi', '1452246918', NULL),
(464, 'ceshi', '1452474864', NULL),
(465, 'ceshi', '1452476183', NULL),
(466, 'ceshi', '1452477117', NULL),
(467, 'ceshi', '1452477440', NULL),
(468, 'ceshi', '1452477646', NULL),
(469, 'ceshi', '1452477723', NULL),
(470, 'ceshi', '1452477765', NULL),
(471, 'ceshi', '1452477862', NULL),
(472, 'ceshi', '1452478584', NULL),
(473, 'ceshi', '1452479707', NULL),
(474, 'ceshi', '1452479968', NULL),
(475, 'ceshi', '1452480166', NULL),
(476, 'ceshi', '1452480250', NULL),
(477, 'ceshi', '1452480290', NULL),
(478, 'ceshi', '1452482143', NULL),
(479, 'ceshi', '1452482230', NULL),
(480, 'ceshi', '1452482336', NULL),
(481, 'ceshi', '1452482631', NULL),
(482, 'ceshi', '1452483712', NULL),
(483, 'ceshi', '1452483840', NULL),
(484, 'ceshi', '1452490089', NULL),
(485, 'ceshi', '1452490092', NULL),
(486, 'ceshi', '1452491980', NULL),
(487, 'ceshi', '1452495952', NULL),
(488, 'ceshi', '1452497067', NULL),
(489, 'ceshi', '1452497159', NULL),
(490, 'ceshi', '1452497417', NULL),
(491, 'ceshi', '1452497704', NULL),
(492, 'ceshi', '1452497742', NULL),
(493, 'ceshi', '1452497782', NULL),
(494, 'ceshi', '1452497832', NULL),
(495, 'ceshi', '1452497891', NULL),
(496, 'ceshi', '1452497983', NULL),
(497, 'ceshi', '1452498103', NULL),
(498, 'ceshi', '1452498146', NULL),
(499, 'ceshi', '1452498212', NULL),
(500, 'ceshi', '1452498288', NULL),
(501, 'ceshi', '1452498647', NULL),
(502, 'ceshi', '1452498885', NULL),
(503, 'ceshi', '1452499140', NULL),
(504, 'ceshi', '1452499658', NULL),
(505, 'ceshi', '1452501936', NULL),
(506, 'ceshi', '1452502645', NULL),
(507, 'ceshi', '1452502648', NULL),
(508, 'ceshi', '1452503194', NULL),
(509, 'ceshi', '1452503353', NULL),
(510, 'ceshi', '1452503924', NULL),
(511, 'ceshi', '1452504220', NULL),
(512, 'ceshi', '1452504229', NULL),
(513, 'ceshi', '1452504234', NULL),
(514, 'ceshi', '1452504741', NULL),
(515, 'ceshi', '1452504929', NULL),
(516, 'ceshi', '1452505085', NULL),
(517, 'ceshi', '1452505514', NULL),
(518, 'ceshi', '1452505556', NULL),
(519, 'ceshi', '1452505702', NULL),
(520, 'ceshi', '1452505767', NULL),
(521, 'ceshi', '1452505875', NULL),
(522, 'ceshi', '1452505949', NULL),
(523, 'ceshi', '1452506110', NULL),
(524, 'ceshi', '1452506193', NULL),
(525, 'ceshi', '1452506377', NULL),
(526, 'ceshi', '1452506471', NULL),
(527, 'ceshi', '1452506620', NULL),
(528, 'ceshi', '1452506841', NULL),
(529, 'ceshi', '1452561051', NULL),
(530, 'ceshi', '1452561141', NULL),
(531, 'ceshi', '1452561288', NULL),
(532, 'ceshi', '1452561708', NULL),
(533, 'ceshi', '1452561819', NULL),
(534, 'ceshi', '1452562459', NULL),
(535, 'ceshi', '1452562572', NULL),
(536, 'ceshi', '1452562845', NULL),
(537, 'ceshi', '1452562963', NULL),
(538, 'ceshi', '1452563219', NULL),
(539, 'ceshi', '1452563323', NULL),
(540, 'ceshi', '1452563435', NULL),
(541, 'ceshi', '1452563554', NULL),
(542, 'ceshi', '1452566898', NULL),
(543, 'ceshi', '1452567086', NULL),
(544, 'ceshi', '1452567420', NULL),
(545, 'ceshi', '1452567456', NULL),
(546, 'ceshi', '1452567695', NULL),
(547, 'ceshi', '1452567780', NULL),
(548, 'ceshi', '1452567969', NULL),
(549, 'ceshi', '1452568091', NULL),
(550, 'ceshi', '1452568183', NULL),
(551, 'ceshi', '1452568215', NULL),
(552, 'ceshi', '1452568390', NULL),
(553, 'ceshi', '1452568441', NULL),
(554, 'ceshi', '1452568464', NULL),
(555, 'ceshi', '1452568496', NULL),
(556, 'ceshi', '1452568548', NULL),
(557, 'ceshi', '1452568638', NULL),
(558, 'ceshi', '1452568694', NULL),
(559, 'ceshi', '1452569071', NULL),
(560, 'ceshi', '1452569199', NULL),
(561, 'ceshi', '1452569228', NULL),
(562, 'ceshi', '1452569229', NULL),
(563, 'ceshi', '1452569545', NULL),
(564, 'ceshi', '1452569550', NULL),
(565, 'ceshi', '1452569955', NULL),
(566, 'ceshi', '1452570052', NULL),
(567, 'ceshi', '1452570119', NULL),
(568, 'ceshi', '1452570300', NULL),
(569, 'ceshi', '1452570368', NULL),
(570, 'ceshi', '1452570574', NULL),
(571, 'ceshi', '1452570635', NULL),
(572, 'ceshi', '1452570697', NULL),
(573, 'ceshi', '1452570736', NULL),
(574, 'ceshi', '1452570969', NULL),
(575, 'ceshi', '1452571082', NULL),
(576, 'ceshi', '1452571219', NULL),
(577, 'ceshi', '1452571246', NULL),
(578, 'ceshi', '1452571324', NULL),
(579, 'ceshi', '1452575005', NULL),
(580, 'ceshi', '1452575485', NULL),
(581, 'ceshi', '1452575933', NULL),
(582, 'ceshi', '1452576623', NULL),
(583, 'ceshi', '1452576699', NULL),
(584, 'ceshi', '1452578165', NULL),
(585, 'ceshi', '1452578556', NULL),
(586, 'ceshi', '1452578562', NULL),
(587, 'ceshi', '1452578913', NULL),
(588, 'ceshi', '1452579061', NULL),
(589, 'ceshi', '1452579340', NULL),
(590, 'ceshi', '1452579383', NULL),
(591, 'ceshi', '1452579567', NULL),
(592, 'ceshi', '1452579570', NULL),
(593, 'ceshi', '1452579625', NULL),
(594, 'ceshi', '1452579730', NULL),
(595, 'ceshi', '1452579755', NULL),
(596, 'ceshi', '1452579933', NULL),
(597, 'ceshi', '1452580287', NULL),
(598, 'ceshi', '1452580374', NULL),
(599, 'ceshi', '1452580453', NULL),
(600, 'ceshi', '1452580462', NULL),
(601, 'ceshi', '1452580531', NULL),
(602, 'ceshi', '1452580621', NULL),
(603, 'ceshi', '1452580667', NULL),
(604, 'ceshi', '1452581044', NULL),
(605, 'ceshi', '1452581483', NULL),
(606, 'ceshi', '1452581694', NULL),
(607, 'ceshi', '1452581841', NULL),
(608, 'ceshi', '1452582245', NULL),
(609, 'ceshi', '1452583013', NULL),
(610, 'ceshi', '1452583696', NULL),
(611, 'ceshi', '1452584968', NULL),
(612, 'ceshi', '1452585007', NULL),
(613, 'ceshi', '1452585061', NULL),
(614, 'ceshi', '1452585163', NULL),
(615, 'ceshi', '1452585446', NULL),
(616, 'ceshi', '1452585500', NULL),
(617, 'ceshi', '1452585589', NULL),
(618, 'ceshi', '1452585664', NULL),
(619, 'ceshi', '1452585729', NULL),
(620, 'ceshi', '1452585824', NULL),
(621, 'ceshi', '1452585856', NULL),
(622, 'ceshi', '1452585948', NULL),
(623, 'ceshi', '1452586012', NULL),
(624, 'ceshi', '1452586014', NULL),
(625, 'ceshi', '1452586052', NULL),
(626, 'ceshi', '1452586155', NULL),
(627, 'ceshi', '1452586543', NULL),
(628, 'ceshi', '1452586589', NULL),
(629, 'ceshi', '1452587041', NULL),
(630, 'ceshi', '1452587177', NULL),
(631, 'ceshi', '1452587275', NULL),
(632, 'ceshi', '1452587323', NULL),
(633, 'ceshi', '1452587412', NULL),
(634, 'ceshi', '1452587441', NULL),
(635, 'ceshi', '1452587599', NULL),
(636, 'ceshi', '1452587645', NULL),
(637, 'ceshi', '1452587797', NULL),
(638, 'ceshi', '1452587850', NULL),
(639, 'ceshi', '1452587896', NULL),
(640, 'ceshi', '1452588408', NULL),
(641, 'ceshi', '1452588588', NULL),
(642, 'ceshi', '1452588803', NULL),
(643, 'ceshi', '1452588894', NULL),
(644, 'ceshi', '1452588956', NULL),
(645, 'ceshi', '1452589107', NULL),
(646, 'ceshi', '1452589220', NULL),
(647, 'ceshi', '1452589258', NULL),
(648, 'ceshi', '1452590064', NULL),
(649, 'ceshi', '1452590099', NULL),
(650, 'ceshi', '1452590218', NULL),
(651, 'ceshi', '1452590266', NULL),
(652, 'ceshi', '1452591178', NULL),
(653, 'ceshi', '1452591216', NULL),
(654, 'ceshi', '1452591263', NULL),
(655, 'ceshi', '1452591298', NULL),
(656, 'ceshi', '1452591660', NULL),
(657, 'ceshi', '1452591741', NULL),
(658, 'ceshi', '1452591888', NULL),
(659, 'ceshi', '1452592162', NULL),
(660, 'ceshi', '1452592424', NULL),
(661, 'ceshi', '1452592466', NULL),
(662, 'ceshi', '1452592581', NULL),
(663, 'ceshi', '1452592642', NULL),
(664, 'ceshi', '1452592709', NULL),
(665, 'ceshi', '1452592743', NULL),
(666, 'ceshi', '1452647584', NULL),
(667, 'ceshi', '1452648023', NULL),
(668, 'ceshi', '1452650519', NULL),
(669, 'ceshi', '1452650991', NULL),
(670, 'ceshi', '1452651288', NULL),
(671, 'ceshi', '1452651341', NULL),
(672, 'ceshi', '1452651385', NULL),
(673, 'ceshi', '1452651913', NULL),
(674, 'ceshi', '1452652206', NULL),
(675, 'ceshi', '1452652383', NULL),
(676, 'ceshi', '1452652435', NULL),
(677, 'ceshi', '1452652483', NULL),
(678, 'ceshi', '1452652568', NULL),
(679, 'ceshi', '1452652619', NULL),
(680, 'ceshi', '1452652914', NULL),
(681, 'ceshi', '1452652963', NULL),
(682, 'ceshi', '1452653031', NULL),
(683, 'ceshi', '1452653034', NULL),
(684, 'ceshi', '1452653240', NULL),
(685, 'ceshi', '1452653285', NULL),
(686, 'ceshi', '1452653296', NULL),
(687, 'ceshi', '1452653298', NULL),
(688, 'ceshi', '1452653303', NULL),
(689, 'ceshi', '1452653323', NULL),
(690, 'ceshi', '1452653626', NULL),
(691, 'ceshi', '1452653746', NULL),
(692, 'ceshi', '1452654077', NULL),
(693, 'ceshi', '1452654124', NULL),
(694, 'ceshi', '1452654256', NULL),
(695, 'ceshi', '1452654502', NULL),
(696, 'ceshi', '1452655009', NULL),
(697, 'ceshi', '1452655360', NULL),
(698, 'ceshi', '1452655622', NULL),
(699, 'ceshi', '1452655741', NULL),
(700, 'ceshi', '1452655855', NULL),
(701, 'ceshi', '1452655912', NULL),
(702, 'ceshi', '1452656293', NULL),
(703, 'ceshi', '1452656496', NULL),
(704, 'ceshi', '1452656649', NULL),
(705, 'ceshi', '1452656847', NULL),
(706, 'ceshi', '1452657079', NULL),
(707, 'ceshi', '1452657684', NULL),
(708, 'ceshi', '1452661247', NULL),
(709, 'ceshi', '1452661534', NULL),
(710, 'ceshi', '1452661614', NULL),
(711, 'ceshi', '1452661709', NULL),
(712, 'ceshi', '1452661755', NULL),
(713, 'ceshi', '1452661809', NULL),
(714, 'ceshi', '1452663353', NULL),
(715, 'ceshi', '1452663609', NULL),
(716, 'ceshi', '1452663671', NULL),
(717, 'ceshi', '1452663780', NULL),
(718, 'ceshi', '1452664871', NULL),
(719, 'ceshi', '1452664873', NULL),
(720, 'ceshi', '1452665115', NULL),
(721, 'ceshi', '1452665138', NULL),
(722, 'ceshi', '1452665264', NULL),
(723, 'ceshi', '1452670661', NULL),
(724, 'ceshi', '1452670945', NULL),
(725, 'ceshi', '1452670989', '1452671243'),
(726, 'ceshi', '1452671580', NULL),
(727, 'ceshi', '1452671663', NULL),
(728, 'ceshi', '1452671936', '1452671951'),
(729, 'ceshi', '1452672048', NULL),
(730, 'ceshi', '1452672095', NULL),
(731, 'ceshi', '1452672117', NULL),
(732, 'ceshi', '1452672160', NULL),
(733, 'ceshi', '1452672690', NULL),
(734, 'ceshi', '1452672695', NULL),
(735, 'ceshi', '1452672698', NULL),
(736, 'ceshi', '1452672707', NULL),
(737, 'ceshi', '1452672714', NULL),
(738, 'ceshi', '1452672718', NULL),
(739, 'ceshi', '1452672789', NULL),
(740, 'ceshi', '1452672813', NULL),
(741, 'ceshi', '1452672816', NULL),
(742, 'ceshi', '1452672874', NULL),
(743, 'ceshi', '1452672877', NULL),
(744, 'ceshi', '1452672954', NULL),
(745, 'ceshi', '1452672976', NULL),
(746, 'ceshi', '1452673015', NULL),
(747, 'ceshi', '1452673063', NULL),
(748, 'ceshi', '1452673072', NULL),
(749, 'ceshi', '1452673123', NULL),
(750, 'ceshi', '1452673183', NULL),
(751, 'ceshi', '1452673233', NULL),
(752, 'ceshi', '1452673439', NULL),
(753, 'ceshi', '1452673495', NULL),
(754, 'ceshi', '1452673514', NULL),
(755, 'ceshi', '1452673824', NULL),
(756, 'ceshi', '1452673975', NULL),
(757, 'ceshi', '1452675158', NULL),
(758, 'ceshi', '1452675343', NULL),
(759, 'ceshi', '1452675355', NULL),
(760, 'ceshi', '1452675418', NULL),
(761, 'ceshi', '1452675426', NULL),
(762, 'ceshi', '1452675459', NULL),
(763, 'ceshi', '1452675481', NULL),
(764, 'ceshi', '1452675496', NULL),
(765, 'ceshi', '1452675536', NULL),
(766, 'ceshi', '1452675652', NULL),
(767, 'ceshi', '1452675671', NULL),
(768, 'ceshi', '1452675681', NULL),
(769, 'ceshi', '1452675691', NULL),
(770, 'ceshi', '1452675720', NULL),
(771, 'ceshi', '1452675738', NULL),
(772, 'ceshi', '1452675742', NULL),
(773, 'ceshi', '1452675992', NULL),
(774, 'ceshi', '1452676004', NULL),
(775, 'ceshi', '1452676062', NULL),
(776, 'ceshi', '1452676304', NULL),
(777, 'ceshi', '1452676320', NULL),
(778, 'ceshi', '1452676338', NULL),
(779, 'ceshi', '1452676356', NULL),
(780, 'ceshi', '1452676377', NULL),
(781, 'ceshi', '1452676385', NULL),
(782, 'ceshi', '1452676526', NULL),
(783, 'ceshi', '1452676542', NULL),
(784, 'ceshi', '1452676700', NULL),
(785, 'ceshi', '1452676704', NULL),
(786, 'ceshi', '1452676832', NULL),
(787, 'ceshi', '1452676861', NULL),
(788, 'ceshi', '1452676909', NULL),
(789, 'ceshi', '1452676914', NULL),
(790, 'ceshi', '1452676921', NULL),
(791, 'ceshi', '1452676924', NULL),
(792, 'ceshi', '1452676942', NULL),
(793, 'ceshi', '1452676969', NULL),
(794, 'ceshi', '1452676982', NULL),
(795, 'ceshi', '1452676993', NULL),
(796, 'ceshi', '1452677051', NULL),
(797, 'ceshi', '1452677057', NULL),
(798, 'ceshi', '1452677064', NULL),
(799, 'ceshi', '1452679497', NULL),
(800, 'ceshi', '1452733679', NULL),
(801, 'ceshi', '1452733751', NULL),
(802, 'ceshi', '1452733774', NULL),
(803, 'ceshi', '1452733777', NULL),
(804, 'ceshi', '1452733787', NULL),
(805, 'ceshi', '1452733822', NULL),
(806, 'ceshi', '1452733840', NULL),
(807, 'ceshi', '1452733847', NULL),
(808, 'ceshi', '1452733855', NULL),
(809, 'ceshi', '1452733858', NULL),
(810, 'ceshi', '1452733871', NULL),
(811, 'ceshi', '1452733943', NULL),
(812, 'ceshi', '1452733952', NULL),
(813, 'ceshi', '1452734750', NULL),
(814, 'ceshi', '1452734945', NULL),
(815, 'ceshi', '1452736572', NULL),
(816, 'ceshi', '1452736607', NULL),
(817, 'ceshi', '1452736636', NULL),
(818, 'ceshi', '1452736813', NULL),
(819, 'ceshi', '1452736820', NULL),
(820, 'ceshi', '1452736830', NULL),
(821, 'ceshi', '1452736906', NULL),
(822, 'ceshi', '1452736946', '1452736964'),
(823, 'ceshi', '1452737107', NULL),
(824, 'ceshi', '1452737110', NULL),
(825, 'ceshi', '1452737112', NULL),
(826, 'ceshi', '1452737167', NULL),
(827, 'ceshi', '1452737198', NULL),
(828, 'ceshi', '1452737326', NULL),
(829, 'ceshi', '1452737412', NULL),
(830, 'ceshi', '1452737413', NULL),
(831, 'ceshi', '1452737425', NULL),
(832, 'ceshi', '1452737427', NULL),
(833, 'ceshi', '1452737433', NULL),
(834, 'ceshi', '1452737439', NULL),
(835, 'ceshi', '1452737460', NULL),
(836, 'ceshi', '1452737469', NULL),
(837, 'ceshi', '1452737471', NULL),
(838, 'ceshi', '1452737476', NULL),
(839, 'ceshi', '1452737494', NULL),
(840, 'ceshi', '1452738341', NULL),
(841, 'ceshi', '1452738399', NULL),
(842, 'ceshi', '1452738515', NULL),
(843, 'ceshi', '1452739703', NULL),
(844, 'ceshi', '1452739734', NULL),
(845, 'ceshi', '1452740019', NULL),
(846, 'ceshi', '1452740206', NULL),
(847, 'ceshi', '1452740563', NULL),
(848, 'ceshi', '1452740861', NULL),
(849, 'ceshi', '1452741273', NULL),
(850, 'ceshi', '1452741319', NULL),
(851, 'ceshi', '1452741523', NULL),
(852, 'ceshi', '1452741560', NULL),
(853, 'ceshi', '1452741733', NULL),
(854, 'ceshi', '1452742546', NULL),
(855, 'ceshi', '1452743962', NULL),
(856, 'ceshi', '1452744021', NULL),
(857, 'ceshi', '1452747841', NULL),
(858, 'ceshi', '1452748101', NULL),
(859, 'ceshi', '1452748108', NULL),
(860, 'ceshi', '1452748181', NULL),
(861, 'ceshi', '1452754336', NULL),
(862, 'ceshi', '1452754956', NULL),
(863, 'ceshi', '1452756118', NULL),
(864, 'ceshi', '1452756513', NULL),
(865, 'ceshi', '1452756515', NULL),
(866, 'ceshi', '1452757966', NULL),
(867, 'ceshi', '1452759107', NULL),
(868, 'ceshi', '1452761164', NULL),
(869, 'ceshi', '1452821591', NULL),
(870, 'ceshi', '1452822638', NULL),
(871, 'ceshi', '1452822721', NULL),
(872, 'ceshi', '1452827125', NULL),
(873, 'ceshi', '1452835472', NULL),
(874, 'ceshi', '1452839277', NULL),
(875, 'ceshi', '1452845026', NULL),
(876, 'ceshi', '1452845407', NULL),
(877, 'ceshi', '1452845470', NULL),
(878, 'ceshi', '1452845559', NULL),
(879, 'ceshi', '1452845685', NULL),
(880, 'ceshi', '1452846310', NULL),
(881, 'ceshi', '1452846414', NULL),
(882, 'ceshi', '1452846756', NULL),
(883, 'ceshi', '1452846899', NULL),
(884, 'ceshi', '1452847760', NULL),
(885, 'ceshi', '1452847809', NULL),
(886, 'ceshi', '1452849551', NULL),
(887, 'ceshi', '1452849559', '1452849572'),
(888, 'ceshi', '1453081595', NULL),
(889, 'ceshi', '1453081625', NULL),
(890, 'ceshi', '1453082078', NULL),
(891, 'ceshi', '1453082103', NULL),
(892, 'ceshi', '1453082126', NULL),
(893, 'ceshi', '1453082145', NULL),
(894, 'ceshi', '1453082161', NULL),
(895, 'ceshi', '1453083045', NULL),
(896, 'ceshi', '1453083325', NULL),
(897, 'ceshi', '1453083352', NULL),
(898, 'ceshi', '1453083368', NULL),
(899, 'ceshi', '1453083465', NULL),
(900, 'ceshi', '1453083604', NULL),
(901, 'ceshi', '1453083607', NULL),
(902, 'ceshi', '1453083628', NULL),
(903, 'ceshi', '1453083695', NULL),
(904, 'ceshi', '1453083730', NULL),
(905, 'ceshi', '1453083939', NULL),
(906, 'ceshi', '1453084379', NULL),
(907, 'ceshi', '1453084615', NULL),
(908, 'ceshi', '1453084722', NULL),
(909, 'ceshi', '1453084822', NULL),
(910, 'ceshi', '1453084900', NULL),
(911, 'ceshi', '1453085019', NULL),
(912, 'ceshi', '1453085034', NULL),
(913, 'ceshi', '1453085048', NULL),
(914, 'ceshi', '1453085081', NULL),
(915, 'ceshi', '1453085145', NULL),
(916, 'ceshi', '1453085157', NULL),
(917, 'ceshi', '1453085170', NULL),
(918, 'ceshi', '1453085189', NULL),
(919, 'ceshi', '1453085211', NULL),
(920, 'ceshi', '1453085262', NULL),
(921, 'ceshi', '1453085284', NULL),
(922, 'ceshi', '1453085304', NULL),
(923, 'ceshi', '1453085320', NULL),
(924, 'ceshi', '1453085323', NULL),
(925, 'ceshi', '1453085337', NULL),
(926, 'ceshi', '1453085369', NULL),
(927, 'ceshi', '1453085683', NULL),
(928, 'ceshi', '1453085707', NULL),
(929, 'ceshi', '1453085747', NULL),
(930, 'ceshi', '1453085758', NULL),
(931, 'ceshi', '1453085777', NULL),
(932, 'ceshi', '1453085815', NULL),
(933, 'ceshi', '1453085841', NULL),
(934, 'ceshi', '1453085862', NULL),
(935, 'ceshi', '1453085913', NULL),
(936, 'ceshi', '1453085971', NULL),
(937, 'ceshi', '1453086264', NULL),
(938, 'ceshi', '1453086308', NULL),
(939, 'ceshi', '1453086326', NULL),
(940, 'ceshi', '1453086416', NULL),
(941, 'ceshi', '1453086424', NULL),
(942, 'ceshi', '1453086439', NULL),
(943, 'ceshi', '1453086569', NULL),
(944, 'ceshi', '1453087108', NULL),
(945, 'ceshi', '1453087320', NULL),
(946, 'ceshi', '1453087544', '1453087551'),
(947, 'ceshi', '1453087902', NULL),
(948, 'ceshi', '1453087992', NULL),
(949, 'ceshi', '1453088013', NULL),
(950, 'ceshi', '1453088018', NULL),
(951, 'ceshi', '1453088088', NULL),
(952, 'ceshi', '1453088109', NULL),
(953, 'ceshi', '1453088111', NULL),
(954, 'ceshi', '1453088254', NULL),
(955, 'ceshi', '1453088262', NULL),
(956, 'ceshi', '1453088273', NULL),
(957, 'ceshi', '1453088277', NULL),
(958, 'ceshi', '1453088398', NULL),
(959, 'ceshi', '1453088424', NULL),
(960, 'ceshi', '1453088611', NULL),
(961, 'ceshi', '1453088670', NULL),
(962, 'ceshi', '1453088677', NULL),
(963, 'ceshi', '1453095734', NULL),
(964, 'ceshi', '1453095738', NULL),
(965, 'ceshi', '1453095741', NULL),
(966, 'ceshi', '1453102928', NULL),
(967, 'ceshi', '1453102965', NULL),
(968, 'ceshi', '1453103228', NULL),
(969, 'ceshi', '1453103233', NULL),
(970, '15866898306', '1453104345', NULL),
(971, '15866898306', '1453104354', NULL),
(972, '15866898306', '1453104357', NULL),
(973, '15866898306', '1453104363', NULL),
(974, 'ceshi', '1453104385', NULL),
(975, 'ceshi', '1453104389', NULL),
(976, '15866898306', '1453104440', NULL),
(977, '15866898306', '1453104485', NULL),
(978, '15866898306', '1453104492', NULL),
(979, '15866898306', '1453104494', NULL),
(980, '15866898306', '1453104495', NULL),
(981, '15866898306', '1453105166', NULL),
(982, '15866898306', '1453105324', NULL),
(983, '15866898306', '1453105344', NULL),
(984, '15866898306', '1453105346', NULL),
(985, '15866898306', '1453106384', NULL),
(986, '15866898306', '1453106424', NULL),
(987, '15866898306', '1453106427', NULL),
(988, '15866898306', '1453106429', NULL),
(989, '15866898306', '1453106432', NULL),
(990, '15866898306', '1453174982', NULL),
(991, '15866898306', '1453174988', NULL),
(992, '15866898306', '1453174994', NULL),
(993, 'ceshi', '1453184303', NULL),
(994, 'ceshi', '1453184311', NULL),
(995, 'ceshi', '1453184315', NULL),
(996, 'ceshi', '1453184323', NULL),
(997, 'ceshi', '1453184409', NULL),
(998, 'ceshi', '1453184476', NULL),
(999, 'ceshi', '1453184512', NULL),
(1000, 'ceshi', '1453184576', NULL),
(1001, '15866898306', '1453184591', NULL),
(1002, '15866898306', '1453184611', NULL),
(1003, 'ceshi', '1453184624', NULL),
(1004, 'ceshi', '1453184636', NULL),
(1005, 'ceshi', '1453184723', NULL),
(1006, 'ceshi', '1453185792', NULL),
(1007, 'ceshi', '1453185915', NULL),
(1008, '15866898306', '1453185952', NULL),
(1009, '15866898306', '1453185961', NULL),
(1010, '15866898306', '1453186238', NULL),
(1011, '15866898306', '1453186330', NULL),
(1012, '15866898306', '1453186334', NULL),
(1013, '15866898306', '1453186419', NULL),
(1014, '15866898306', '1453186422', NULL),
(1015, '15866898306', '1453186425', NULL),
(1016, '15866898306', '1453186508', NULL),
(1017, '15866898306', '1453186557', NULL),
(1018, '15866898306', '1453186601', NULL),
(1019, '15866898306', '1453186656', NULL),
(1020, '15866898306', '1453186673', NULL),
(1021, '15866898306', '1453186714', NULL),
(1022, '15866898306', '1453186717', NULL),
(1023, '15866898306', '1453188221', NULL),
(1024, '15866898306', '1453188232', NULL),
(1025, '15866898306', '1453188234', NULL),
(1026, '15866898306', '1453188236', NULL),
(1027, '15866898306', '1453188237', NULL),
(1028, '15866898306', '1453188257', NULL),
(1029, '15866898306', '1453188287', NULL),
(1030, '15866898306', '1453188327', NULL),
(1031, '15866898306', '1453188420', NULL),
(1032, '15866898306', '1453189665', NULL),
(1033, '15866898306', '1453189683', NULL),
(1034, '15866898306', '1453189887', NULL),
(1035, '15866898306', '1453189934', NULL),
(1036, '15866898306', '1453189996', NULL),
(1037, '15866898306', '1453190007', NULL),
(1038, '15866898306', '1453190185', NULL),
(1039, '15866898306', '1453190205', NULL),
(1040, '15866898306', '1453190236', NULL),
(1041, '15866898306', '1453190298', NULL),
(1042, '15866898306', '1453190474', NULL),
(1043, '15866898306', '1453192039', NULL),
(1044, '15866898306', '1453192048', NULL),
(1045, '15866898306', '1453192092', NULL),
(1046, '15866898306', '1453192108', NULL),
(1047, '15866898306', '1453192446', NULL),
(1048, '15866898306', '1453192515', NULL),
(1049, '14768906513', '1453196314', NULL),
(1050, '14768906513', '1453196532', NULL),
(1051, '14768906513', '1453196932', NULL),
(1052, '14768906513', '1453252489', NULL),
(1053, '14768906513', '1453252751', NULL),
(1054, '15866898306', '1453269848', NULL),
(1055, '15866898306', '1453269884', NULL),
(1056, '15866898306', '1453269889', NULL),
(1057, '15866898306', '1453269953', NULL),
(1058, '15866898306', '1453269958', NULL),
(1059, '15866898306', '1453269982', NULL),
(1060, '15866898306', '1453270031', NULL),
(1061, '15866898306', '1453270096', NULL),
(1062, '15866898306', '1453270115', NULL),
(1063, '15866898306', '1453270120', NULL),
(1064, '15866898306', '1453270123', NULL),
(1065, '15866898306', '1453270233', NULL),
(1066, '15866898306', '1453270238', NULL),
(1067, '15866898306', '1453270249', NULL),
(1068, '15866898306', '1453270271', NULL),
(1069, '15866898306', '1453270276', NULL),
(1070, '15866898306', '1453270279', NULL),
(1071, '15866898306', '1453270357', NULL),
(1072, '14768906513', '1453270488', NULL),
(1073, '14768906513', '1453270674', NULL),
(1074, '14768906513', '1453270676', NULL),
(1075, '14768906513', '1453270687', NULL),
(1076, '15866898306', '1453270732', NULL),
(1077, '15866898306', '1453270790', NULL),
(1078, '15866898306', '1453270794', NULL),
(1079, '15866898306', '1453270797', NULL),
(1080, '15866898306', '1453270799', NULL),
(1081, '15866898306', '1453270811', NULL),
(1082, '15866898306', '1453271213', NULL),
(1083, '15866898306', '1453271275', NULL),
(1084, '15866898306', '1453271332', NULL),
(1085, '14768906513', '1453271383', NULL),
(1086, '14768906513', '1453271454', NULL),
(1087, '14768906513', '1453271494', NULL),
(1088, '14768906513', '1453271500', NULL),
(1089, '14768906513', '1453271605', NULL),
(1090, '14768906513', '1453271878', NULL),
(1091, '14768906513', '1453271889', NULL),
(1092, '14768906513', '1453272325', NULL),
(1093, '14768906513', '1453272422', NULL),
(1094, '14768906513', '1453272434', NULL),
(1095, '14768906513', '1453272438', NULL),
(1096, '14768906513', '1453272442', NULL),
(1097, '14768906513', '1453272635', NULL),
(1098, '14768906513', '1453272640', NULL),
(1099, '14768906513', '1453272643', NULL),
(1100, '14768906513', '1453272646', NULL),
(1101, '14768906513', '1453272648', NULL),
(1102, '14768906513', '1453274157', NULL),
(1103, '14768906513', '1453274446', NULL),
(1104, '14768906513', '1453274449', NULL),
(1105, '14768906513', '1453274532', NULL),
(1106, '14768906513', '1453274562', NULL),
(1107, '14768906513', '1453274566', NULL),
(1108, '14768906513', '1453274573', NULL),
(1109, '14768906513', '1453274576', NULL),
(1110, '14768906513', '1453275073', NULL),
(1111, '14768906513', '1453275199', NULL),
(1112, '14768906513', '1453275223', NULL),
(1113, '14768906513', '1453275228', NULL),
(1114, '14768906513', '1453275231', NULL),
(1115, '14768906513', '1453275235', NULL),
(1116, '14768906513', '1453275285', NULL),
(1117, '14768906513', '1453275296', NULL),
(1118, '14768906513', '1453275299', NULL),
(1119, '14768906513', '1453275302', NULL),
(1120, '15866898306', '1453283305', NULL),
(1121, '15866898306', '1453283336', NULL),
(1122, '15866898306', '1453283336', NULL),
(1123, '15866898306', '1453340874', NULL),
(1124, '15866898306', '1453340875', NULL),
(1125, '15866898306', '1453344969', NULL),
(1126, '15866898306', '1453344989', NULL),
(1127, '15866898306', '1453344997', NULL),
(1128, '15866898306', '1453345004', NULL),
(1129, '15866898306', '1453345018', NULL),
(1130, '15866898306', '1453345023', NULL),
(1131, '15866898306', '1453345033', NULL),
(1132, '15866898306', '1453345050', '1453345055'),
(1133, '15866898306', '1453345115', NULL),
(1134, '15866898306', '1453345178', NULL),
(1135, '15866898306', '1453345183', NULL),
(1136, '15866898306', '1453345187', NULL),
(1137, '15866898306', '1453345210', NULL),
(1138, 'ceshi', '1453345241', NULL),
(1139, '15866898306', '1453345261', NULL),
(1140, '15866898306', '1453345264', NULL),
(1141, '15866898306', '1453345286', NULL),
(1142, '15866898306', '1453345288', NULL),
(1143, '15866898306', '1453345297', NULL),
(1144, '15866898306', '1453345304', NULL),
(1145, '15866898306', '1453345315', NULL),
(1146, '15866898306', '1453345326', NULL),
(1147, '15866898306', '1453345337', NULL),
(1148, '15866898306', '1453345340', NULL),
(1149, '15866898306', '1453345342', NULL),
(1150, '15866898306', '1453345343', NULL),
(1151, '15866898306', '1453345351', NULL),
(1152, '15866898306', '1453345354', NULL),
(1153, '15866898306', '1453345356', NULL),
(1154, '15866898306', '1453345596', NULL),
(1155, '15866898306', '1453345704', NULL),
(1156, '15866898306', '1453345712', NULL),
(1157, '15866898306', '1453345715', NULL),
(1158, '15866898306', '1453345719', NULL),
(1159, '15866898306', '1453345722', NULL),
(1160, '15866898306', '1453345768', NULL),
(1161, '15866898306', '1453345772', NULL),
(1162, '15866898306', '1453345775', NULL),
(1163, '15866898306', '1453345778', NULL),
(1164, '15866898306', '1453345780', NULL),
(1165, '15866898306', '1453345800', NULL),
(1166, '15866898306', '1453345844', NULL),
(1167, '15866898306', '1453346042', NULL),
(1168, '15866898306', '1453346083', NULL),
(1169, '15866898306', '1453346106', NULL),
(1170, '15866898306', '1453346309', NULL),
(1171, '15866898306', '1453346444', NULL),
(1172, '14768906513', '1453346454', NULL),
(1173, '14768906513', '1453346476', NULL),
(1174, '14768906513', '1453346485', NULL),
(1175, '14768906513', '1453346516', NULL),
(1176, '14768906513', '1453346529', NULL),
(1177, '14768906513', '1453346533', NULL),
(1178, '14768906513', '1453346538', NULL),
(1179, '14768906513', '1453346540', NULL),
(1180, '14768906513', '1453346555', NULL),
(1181, '14768906513', '1453346567', NULL),
(1182, '14768906513', '1453346571', NULL),
(1183, '15866898306', '1453346625', NULL),
(1184, '14768906513', '1453346810', NULL),
(1185, '14768906513', '1453346927', NULL),
(1186, '14768906513', '1453346944', NULL),
(1187, '14768906513', '1453346949', NULL),
(1188, '14768906513', '1453346965', NULL),
(1189, '14768906513', '1453346969', NULL),
(1190, '14768906513', '1453346974', NULL),
(1191, '14768906513', '1453346976', NULL),
(1192, '14768906513', '1453356392', NULL),
(1193, '14768906513', '1453356578', NULL),
(1194, '14768906513', '1453356591', NULL),
(1195, '14768906513', '1453356598', NULL),
(1196, '14768906513', '1453356601', NULL),
(1197, '14768906513', '1453356604', NULL),
(1198, '14768906513', '1453356607', NULL),
(1199, '14768906513', '1453356746', NULL),
(1200, '14768906513', '1453357254', NULL),
(1201, '14768906513', '1453357258', NULL),
(1202, '14768906513', '1453357260', NULL),
(1203, '14768906513', '1453357263', NULL),
(1204, '14768906513', '1453357276', NULL),
(1205, '14768906513', '1453357491', NULL),
(1206, '14768906513', '1453357496', NULL),
(1207, '14768906513', '1453357847', NULL),
(1208, '14768906513', '1453357855', NULL),
(1209, '14768906513', '1453357879', NULL),
(1210, '14768906513', '1453357885', NULL),
(1211, '14768906513', '1453357987', NULL),
(1212, '14768906513', '1453357987', NULL),
(1213, '14768906513', '1453357995', NULL),
(1214, '14768906513', '1453357998', NULL),
(1215, '14768906513', '1453358014', NULL),
(1216, '14768906513', '1453358017', NULL),
(1217, '14768906513', '1453358150', NULL),
(1218, '14768906513', '1453358173', NULL),
(1219, '14768906513', '1453358626', NULL),
(1220, '14768906513', '1453358706', NULL),
(1221, '15866898306', '1453360663', NULL),
(1222, '15866898306', '1453361290', NULL),
(1223, '15866898306', '1453361295', NULL),
(1224, '15866898306', '1453361495', NULL),
(1225, '15866898306', '1453361497', NULL),
(1226, '15866898306', '1453361500', NULL),
(1227, '15866898306', '1453361504', NULL),
(1228, '15866898306', '1453361540', NULL),
(1229, '15866898306', '1453361555', NULL),
(1230, '15866898306', '1453361659', NULL),
(1231, '15866898306', '1453361749', NULL),
(1232, '14768906513', '1453362654', NULL),
(1233, '15866898306', '1453362756', NULL),
(1234, '15866898306', '1453363167', NULL),
(1235, '15866898306', '1453363277', NULL),
(1236, '15866898306', '1453364615', NULL),
(1237, '15866898306', '1453364629', NULL),
(1238, '15866898306', '1453364633', NULL),
(1239, '15866898306', '1453364704', NULL),
(1240, '15866898306', '1453364800', NULL),
(1241, '15866898306', '1453364803', NULL),
(1242, '15866898306', '1453364819', NULL),
(1243, '15866898306', '1453365703', NULL),
(1244, '14768906513', '1453365831', NULL),
(1245, '15866898306', '1453366233', NULL),
(1246, '15866898306', '1453366289', NULL),
(1247, '15866898306', '1453366316', NULL),
(1248, '15866898306', '1453366486', NULL),
(1249, '15866898306', '1453366547', NULL),
(1250, '15866898306', '1453366557', NULL),
(1251, '15866898306', '1453366616', NULL),
(1252, '15866898306', '1453366658', NULL),
(1253, '15866898306', '1453366662', NULL),
(1254, '15866898306', '1453366664', NULL),
(1255, '15866898306', '1453366770', NULL),
(1256, '15866898306', '1453366830', NULL),
(1257, '15866898306', '1453366925', NULL),
(1258, '15866898306', '1453367060', NULL),
(1259, '14768906513', '1453367555', NULL),
(1260, '14768906513', '1453367568', NULL),
(1261, '14768906513', '1453367572', NULL),
(1262, '14768906513', '1453367652', NULL),
(1263, '15866898306', '1453367695', NULL),
(1264, '15866898306', '1453367731', NULL),
(1265, '14768906513', '1453367749', NULL),
(1266, '14768906513', '1453367752', NULL),
(1267, '14768906513', '1453367772', NULL),
(1268, '14768906513', '1453367780', NULL),
(1269, '14768906513', '1453367783', NULL),
(1270, '14768906513', '1453368157', NULL),
(1271, '14768906513', '1453368164', NULL),
(1272, '14768906513', '1453368299', NULL),
(1273, '14768906513', '1453368306', NULL),
(1274, '14768906513', '1453368374', NULL),
(1275, '14768906513', '1453368381', NULL),
(1276, '14768906513', '1453368384', NULL),
(1277, '14768906513', '1453368801', NULL),
(1278, '14768906513', '1453368806', NULL),
(1279, '14768906513', '1453368872', NULL),
(1280, '14768906513', '1453368885', NULL),
(1281, '14768906513', '1453369085', NULL),
(1282, '14768906513', '1453369117', NULL),
(1283, '14768906513', '1453425370', NULL),
(1284, '14768906513', '1453425422', NULL),
(1285, '14768906513', '1453430063', NULL),
(1286, '14768906513', '1453430143', NULL),
(1287, '14768906513', '1453430147', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_xieyi`
--

CREATE TABLE IF NOT EXISTS `tp_xieyi` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `text` text,
  `edit_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tp_xieyi`
--

INSERT INTO `tp_xieyi` (`id`, `text`, `edit_date`) VALUES
(1, '', '1470735530');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
