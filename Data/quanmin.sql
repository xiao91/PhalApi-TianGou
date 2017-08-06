/*
Navicat MySQL Data Transfer

Source Server         : XIAO
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : quanmin

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-24 18:10:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `qm_android`
-- ----------------------------
DROP TABLE IF EXISTS `qm_android`;
CREATE TABLE `qm_android` (
  `and_id` int(11) NOT NULL COMMENT 'Android版本id',
  `and_version_code` char(20) NOT NULL DEFAULT '' COMMENT 'Android版本号',
  `and_version_name` varchar(255) DEFAULT '' COMMENT 'Android版本名称',
  `and_download_url` varchar(255) DEFAULT '' COMMENT '下载地址',
  `and_version_desc` text COMMENT '版本描述',
  PRIMARY KEY (`and_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qm_android
-- ----------------------------

-- ----------------------------
-- Table structure for `qm_comment`
-- ----------------------------
DROP TABLE IF EXISTS `qm_comment`;
CREATE TABLE `qm_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `content_id` int(11) NOT NULL DEFAULT '0' COMMENT '内容id',
  `comment_detail` varchar(255) NOT NULL DEFAULT '' COMMENT '评论详情',
  `from_uid` int(11) DEFAULT '0' COMMENT '评论用户的id',
  `to_uid` int(11) DEFAULT '0' COMMENT '评论目标用户的id',
  `username` varchar(255) DEFAULT '' COMMENT '评论人或回复评论人的用户名称',
  `user_head` varchar(255) DEFAULT '' COMMENT '评论人或回复人的头像地址',
  `good_count` int(11) DEFAULT '0' COMMENT '该条评论被点赞的次数',
  `create_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '评论时间',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qm_comment
-- ----------------------------
INSERT INTO `qm_comment` VALUES ('1', '4', '我评价的是第4条！', '1', '0', '全民段子', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '3', '2017-06-21 14:19:03');
INSERT INTO `qm_comment` VALUES ('2', '4', '我评价的是第4条！', '1', '0', '全民段子', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '2', '2017-06-21 14:19:04');
INSERT INTO `qm_comment` VALUES ('16', '4', '我评价的是第4条333！', '1', '0', '全民段子', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '0', '2017-06-26 10:20:21');
INSERT INTO `qm_comment` VALUES ('17', '22', '我在评论', '1', '0', '全民段子', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '0', '2017-06-27 17:57:02');
INSERT INTO `qm_comment` VALUES ('18', '22', '我在评论2', '1', '0', '全民段子', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '0', '2017-06-27 17:59:47');
INSERT INTO `qm_comment` VALUES ('19', '22', '我在评论3', '1', '0', '全民段子', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '0', '2017-06-27 18:01:36');
INSERT INTO `qm_comment` VALUES ('20', '22', '咯OK了咯Ella额', '1', '0', '全民段子', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '0', '2017-06-27 18:02:25');
INSERT INTO `qm_comment` VALUES ('21', '22', '咯饿了来了来咯的啦', '1', '0', '全民段子', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '0', '2017-06-27 18:03:05');
INSERT INTO `qm_comment` VALUES ('22', '4', '我评价的是第4条333！', '1', '0', '全民段子', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '0', '2017-06-27 18:06:54');
INSERT INTO `qm_comment` VALUES ('23', '22', 'leakKKK了呃呃呃', '1', '0', '全民段子', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '0', '2017-06-27 18:13:18');
INSERT INTO `qm_comment` VALUES ('24', '10', '可发啊knee', '1', '0', '全民段子', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '0', '2017-06-27 18:13:49');
INSERT INTO `qm_comment` VALUES ('25', '21', '可怜咯么才把', '1', '0', '全民段子', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '0', '2017-06-27 18:14:56');

-- ----------------------------
-- Table structure for `qm_content`
-- ----------------------------
DROP TABLE IF EXISTS `qm_content`;
CREATE TABLE `qm_content` (
  `content_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '内容id',
  `user_id` int(11) unsigned NOT NULL,
  `content_detail` text COMMENT '内容详情',
  `content_desc` text COMMENT '内容描述摘要',
  `content_source_url` varchar(255) DEFAULT '' COMMENT '内容来源',
  `content_title` varchar(255) DEFAULT '' COMMENT '内容标题',
  `content_type` char(255) DEFAULT '' COMMENT '内容的类型，1文本笑话，2搞笑图，3美女，4视频',
  `create_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`content_id`),
  KEY `user_id` (`user_id`) USING BTREE,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `qm_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qm_content
-- ----------------------------
INSERT INTO `qm_content` VALUES ('4', '1', 'http://ww3.sinaimg.cn/large/e4e2bea6jw1f51rfkskmyj20cu0pcq4c.jpg', '', 'http://www.laifudao.com/tupian/58686.htm', '有点想自投罗网', '2', '2017-06-16 17:07:48');
INSERT INTO `qm_content` VALUES ('5', '1', 'http://ww3.sinaimg.cn/large/e4e2bea6jw1f51rfkskmyj20cu0pcq4c.jpg', '', 'http://www.laifudao.com/tupian/58686.htm', '有点想自投罗网', '2', '2017-06-21 15:13:02');
INSERT INTO `qm_content` VALUES ('10', '1', '深夜无聊，我拿手机摇啊摇，摇了一会摇到一美女，还在我100米内，赶紧加了好友问她：“美女，大半夜不睡觉寂寞不？”<br/><br/>　　美女道：“给我倒杯水”<br/><br/>　　我说：“你发错了吧？”<br/><br/>　　然后隔墙老妈大喊：“臭小子，还不快点给我倒杯水！”', '', 'http://www.laifudao.com/wangwen/90226.htm\"', '不要乱摇', '1', '2017-06-26 16:08:21');
INSERT INTO `qm_content` VALUES ('12', '1', '老婆在家试穿一件新衣服，问我和儿子漂不漂亮。我回:“嗯，衣服蛮漂亮的。”<br/><br/>　　老婆扭头问儿子:“麻麻漂亮？还是衣服漂亮。”儿子回她:“麻麻漂亮！”<br/><br/>　　老婆撇嘴感叹:“别人生的和自己生的就是不一样！”', null, '', '别人生的和自己生的就是不一样', '1', '2017-06-26 13:47:42');
INSERT INTO `qm_content` VALUES ('13', '1', '刚才那老外（谷歌董事长施密特）一坐下就说：“我来过中国许多次，还从来没有那次像这次这么心情愉快，因为这次我是先去逛了北朝鲜再过来。” 看来幸福感真是比较出来的-_-!', null, '', '谷歌董事长说中国很幸福', '1', '2017-06-26 13:48:22');
INSERT INTO `qm_content` VALUES ('14', '1', '最近女儿期末摸底考试一直不错，今天拿回一张试卷，才考78分，我一看火了：咋这么点分？是不是骄傲了？<br/><br/>　　她还觉得挺委屈的，说：最后让写一篇短文，占了20分，题目是《勤劳的妈妈》，实在不知道怎么写。', null, '', '勤劳的妈妈', '1', '2017-06-26 13:48:55');
INSERT INTO `qm_content` VALUES ('15', '1', 'http://image.tianjimedia.com/uploadImages/2016/341/57/A72328NXRD35.jpg;http://image.tianjimedia.com/uploadImages/2016/341/15/Q11961Y9Z23Y.jpg;http://image.tianjimedia.com/uploadImages/2016/341/04/5AAK264W4P04.jpg;http://image.tianjimedia.com/uploadImages/2016/341/04/URE6EDXB0V7Q.jpg;http://image.tianjimedia.com/uploadImages/2016/341/06/GNJ22QJ6IJ07.jpg;http://image.tianjimedia.com/uploadImages/2016/341/07/HNWIPUV113D8.jpg;http://image.tianjimedia.com/uploadImages/2016/341/08/4MF020Z6B1WC.jpg;http://image.tianjimedia.com/uploadImages/2016/341/09/E2UL3NS8W077.jpg;http://image.tianjimedia.com/uploadImages/2016/341/11/OB0W28613OMJ.jpg;http://image.tianjimedia.com/uploadImages/2016/341/12/414YV9X3P5E1.jpg;http://image.tianjimedia.com/uploadImages/2016/341/14/6B019OY30I29.jpg;http://image.tianjimedia.com/uploadImages/2016/341/26/07SZKQZRF225.jpg;http://image.tianjimedia.com/uploadImages/2016/341/18/Y07IC51X67HG.jpg;http://image.tianjimedia.com/uploadImages/2016/341/19/1F4GVF6ZC791.jpg;http://image.tianjimedia.com/uploadImages/2016/341/21/L0U419ZMF1K7.jpg;http://image.tianjimedia.com/uploadImages/2016/341/24/IGQ7SISW6216.jpg;', null, '', '迷人气质名模姐妹花温泉写真 美图极致诱人', '3', '2017-06-26 13:49:30');
INSERT INTO `qm_content` VALUES ('16', '1', 'http://image.tianjimedia.com/uploadImages/2016/340/35/8X931QG5U461.jpg;http://image.tianjimedia.com/uploadImages/2016/340/37/XHH8RZSI8LV9.jpg;http://image.tianjimedia.com/uploadImages/2016/340/38/96687X99AW9J.jpg;http://image.tianjimedia.com/uploadImages/2016/340/41/638ZE6U60N2E.jpg;http://image.tianjimedia.com/uploadImages/2016/340/44/QNWUAN06Y3X2.jpg;', null, '', '气质女神非主流写真', '3', '2017-06-26 13:53:38');
INSERT INTO `qm_content` VALUES ('17', '1', '阿平来到了风水师的家，却被眼前的一幕给吓傻了，只见那风水师躺在血泊里，脸上血肉模糊，左眼的眼球都掉了出来，滚在了一旁，衣服也被撕扯的跟一条条领带死的，一片一片的。\\n    身上散落着昨夜盗出来的首饰，华子和阿平搞不清楚情况，两人大眼瞪小眼，最后一合计，急匆匆的把散落在地的首饰都卷进了包里，急急忙忙的离开了风水师的家。c2();\\n    两人各自分了点东西，回到了自己的家中，分别前两人约定，各自找买家，谁先找到买家，就通知对方一声。\\n    回到家后，华子心里总是觉得不舒服，好像有什么事情就要发生了，可是面对金钱的诱惑，他又安慰自己，没事的，他马上也要做一回有钱人了，虽然只有几十万，那也是他这辈子最富有的时刻了。\\n    这样想着，华子把首饰品藏好，自己一个人喝了点酒，在电脑前玩了会游戏，就在他累了准备睡觉的时候，突然传来了敲门声，华子骂骂咧咧的打开了门，却看见阿平站在自己面前。\\n    将阿平迎进门，华子奇怪的问道：阿平，是不是找到买家了，你怎么这么快就找到了？\\n    阿平脸色难看的点点头，说是买家是找到了，可是有点不对劲，不知道是真的有问题还是有人装神弄鬼，所以他来找华子商量一番再做决定。\\n    阿平告诉华子，有个人发信息说要买他们手上的东西，一开始阿平很兴奋，所以他又看了一眼那个短信，这一看吓一跳，这短信的手机号码是那个已经死了的风水师的，他觉得这事不对劲，所以想要问问华子，现在怎么办？\\n    听阿平这么说，华子也觉得有点诡异，那个风水师死了，他是个有点名气的大忙人，没理由死了一天没人发现，现在没听到任何关于那个风水师死亡的新闻，也不知道具体怎么回事？\\n    华子提议打个电话过去听听对方的声音，阿平就拨了过去，对面传来了那个风水师的声音：说好了三人平分？你们却想要撇下我，哼，我不会放过你们的。\\n    听到这声音，阿平吓得把手机给扔了，这时敲门声又响起了，阿平来到门口，打开门一看，那个之前在棺材里的老太太就站在他面前。\\n    又过了一天人们发现有两个人横死在华子家中，躺在血泊里，身边散落着不少价值不菲的首饰品。\\n    事后警方调查后得出结论：这三人一起去盗墓，后来华子和阿平联手干掉了风水师，最后这两人也分赃不均，互相杀死了对方！', '马上就要回家过年了，可是华子却没钱，一年拼死拼活存下来的钱还不到两万块，看着面前驶过的豪车，以及车里骚首弄姿的美女，华子觉得包里那两万块钱真是讽刺。华子心里堵着一口气，他灵机一动，决定去赌场走一趟，到...', '', '盗墓的后果', '4', '2017-06-26 13:51:11');
INSERT INTO `qm_content` VALUES ('18', '1', 'http://www.hanhande.com/upload/160105/4182594_174332_1.jpg', null, '', '情人节礼物', '5', '2017-06-26 13:51:41');
INSERT INTO `qm_content` VALUES ('19', '1', 'http://www.hanhande.com/upload/160105/4182594_174230_1.jpg', null, '', '正确的穿衣方式', '5', '2017-06-26 13:52:09');
INSERT INTO `qm_content` VALUES ('20', '1', 'http://mvideo.spriteapp.cn/video/2017/0105/586dbc6595f15_wpc.mp4', null, '', '相亲女条件直接明了，疯癫男回应简单粗爆', '6', '2017-06-26 13:52:35');
INSERT INTO `qm_content` VALUES ('21', '1', 'http://mvideo.spriteapp.cn/video/2017/0103/586b43c42cbb4_wpc.mp4 ', null, '', '为什么我们为人越来越小心，为什么我们处事越来越谨慎', '6', '2017-06-26 13:52:58');
INSERT INTO `qm_content` VALUES ('22', '8', 'http://mvideo.spriteapp.cn/video/2017/0625/9c61523a-5988-11e7-82d2-1866daeb0df1_wpc.mp4', 'http://wimg.spriteapp.cn/profile/large/2016/10/05/57f503aa488e1_mini.jpg', '', '孩子胃口好是怎样的一种体验？简直太萌了！！', '6', '2017-06-27 14:37:07');

-- ----------------------------
-- Table structure for `qm_focus`
-- ----------------------------
DROP TABLE IF EXISTS `qm_focus`;
CREATE TABLE `qm_focus` (
  `focus_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_id` int(11) NOT NULL COMMENT '关注人的id，第一人',
  `uid` int(11) NOT NULL COMMENT '关注人的id，第二人',
  PRIMARY KEY (`focus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qm_focus
-- ----------------------------

-- ----------------------------
-- Table structure for `qm_good`
-- ----------------------------
DROP TABLE IF EXISTS `qm_good`;
CREATE TABLE `qm_good` (
  `count_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `content_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '内容id',
  `g_uids` varchar(255) DEFAULT '' COMMENT '所有点过赞的用户id，以逗号分隔',
  `g_dids` varchar(255) DEFAULT '' COMMENT '所有未登录点过赞手机设备号id，以逗号分隔',
  `good_count` int(11) NOT NULL DEFAULT '0' COMMENT '被赞次数',
  `b_uids` varchar(255) DEFAULT '' COMMENT '所有点过踩的用户id，以逗号分隔',
  `b_dids` varchar(255) DEFAULT '' COMMENT '所有未登录点过踩手机设备号id，以逗号分隔',
  `bad_count` int(11) NOT NULL DEFAULT '0' COMMENT '被踩个数',
  `comment_count` int(11) NOT NULL DEFAULT '0' COMMENT '评论次数',
  `share_count` int(11) NOT NULL DEFAULT '0' COMMENT '分享次数',
  PRIMARY KEY (`count_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qm_good
-- ----------------------------
INSERT INTO `qm_good` VALUES ('1', '4', ';1', '', '9', '', '', '0', '0', '0');
INSERT INTO `qm_good` VALUES ('2', '5', ';1', '', '10', '', '', '3', '0', '0');
INSERT INTO `qm_good` VALUES ('3', '10', ';1', ';860716035815570', '21', '', '', '0', '0', '0');
INSERT INTO `qm_good` VALUES ('4', '12', '', '', '0', '', '', '0', '0', '0');
INSERT INTO `qm_good` VALUES ('5', '13', '', '', '0', '', '', '0', '0', '0');
INSERT INTO `qm_good` VALUES ('6', '14', '', '', '0', '', '', '0', '0', '0');
INSERT INTO `qm_good` VALUES ('7', '15', '', '', '0', '', '', '0', '0', '0');
INSERT INTO `qm_good` VALUES ('8', '16', '', '', '0', '', ';860716035815570', '1', '0', '0');
INSERT INTO `qm_good` VALUES ('9', '17', '', '', '0', '', '', '0', '0', '0');
INSERT INTO `qm_good` VALUES ('10', '18', '', '', '0', '', '', '0', '0', '0');
INSERT INTO `qm_good` VALUES ('11', '19', '', '', '0', '', '', '0', '0', '0');
INSERT INTO `qm_good` VALUES ('12', '20', '', '', '0', '', '', '0', '0', '0');
INSERT INTO `qm_good` VALUES ('13', '21', '', '', '0', '', '', '0', '0', '0');
INSERT INTO `qm_good` VALUES ('14', '22', ';1', '', '1', '', '', '0', '0', '0');

-- ----------------------------
-- Table structure for `qm_token`
-- ----------------------------
DROP TABLE IF EXISTS `qm_token`;
CREATE TABLE `qm_token` (
  `token_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'token的id',
  `token` varchar(255) NOT NULL DEFAULT '' COMMENT 'md5加密的token值',
  `device_code` varchar(255) DEFAULT '' COMMENT '设备地址',
  `mobile_type` varchar(10) DEFAULT '' COMMENT '手机类别',
  PRIMARY KEY (`token_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qm_token
-- ----------------------------
INSERT INTO `qm_token` VALUES ('29', '4055de18377863bc7789b2671bf37280', '860716035815570', 'Android');

-- ----------------------------
-- Table structure for `qm_user`
-- ----------------------------
DROP TABLE IF EXISTS `qm_user`;
CREATE TABLE `qm_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(255) DEFAULT '' COMMENT '用户名称',
  `password` varchar(255) DEFAULT '' COMMENT '用户密码',
  `user_age` tinyint(3) unsigned zerofill DEFAULT '000' COMMENT '用户年龄',
  `user_phone` char(11) DEFAULT '' COMMENT '用户手机号',
  `user_email` varchar(50) DEFAULT '' COMMENT '用户邮箱',
  `user_sex` varchar(4) DEFAULT '' COMMENT '男或女',
  `user_qq` varchar(20) DEFAULT '' COMMENT 'qq',
  `user_head` varchar(255) DEFAULT '' COMMENT '用户头像地址',
  `user_type` char(4) DEFAULT '' COMMENT '用户类型，微信，QQ登录',
  `user_interest` varchar(255) DEFAULT '' COMMENT '用户兴趣',
  `user_address` varchar(255) DEFAULT '' COMMENT '用户地址',
  `user_register_time` timestamp NULL DEFAULT NULL COMMENT '用户注册时间',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_phone` (`user_phone`) USING HASH,
  KEY `password` (`password`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qm_user
-- ----------------------------
INSERT INTO `qm_user` VALUES ('1', '全民段子', 'e10adc3949ba59abbe56e057f20f883e', '000', '15000000000', '', '', '', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '', '', '', '2017-06-14 17:42:57');
INSERT INTO `qm_user` VALUES ('8', '全民段子', 'e10adc3949ba59abbe56e057f20f883e', '000', '15900000002', '', '', '', 'upload/quanmin/image/2017/04/02/05444680386578567.jpg', '', '', '', '2017-06-15 10:33:48');
INSERT INTO `qm_user` VALUES ('9', '全民段子', 'e10adc3949ba59abbe56e057f20f883e', '000', '15000000001', '', '', '', '', '', '', '', '2017-06-15 11:25:04');
