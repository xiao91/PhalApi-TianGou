-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-01-14 13:33:48
-- 服务器版本： 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tg`
--

-- --------------------------------------------------------

--
-- 表的结构 `tg_apkinfo`
--

CREATE TABLE `tg_apkinfo` (
  `apkId` int(11) NOT NULL COMMENT 'apk版本id',
  `versionCode` tinyint(5) DEFAULT '1' COMMENT 'apk版本号',
  `versionName` varchar(50) DEFAULT '' COMMENT 'apk版本名称',
  `downloadUrl` varchar(150) DEFAULT '' COMMENT 'apk下载地址',
  `versionDesc` text COMMENT 'apk描述'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tg_comments`
--

CREATE TABLE `tg_comments` (
  `commentId` int(11) NOT NULL COMMENT '评论id',
  `contentsId` int(11) NOT NULL COMMENT '对应的内容id',
  `userId` int(11) NOT NULL COMMENT '评论人id',
  `commentDetail` varchar(255) NOT NULL DEFAULT '' COMMENT '评论详情',
  `userGoodCount` int(11) DEFAULT '0' COMMENT '该条内容对应该用户评论被点赞次数',
  `createTime` datetime DEFAULT NULL COMMENT '评论时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tg_comments`
--

INSERT INTO `tg_comments` (`commentId`, `contentsId`, `userId`, `commentDetail`, `userGoodCount`, `createTime`) VALUES
(1, 1, 1, '好看啊！', 1, '2017-01-10 04:40:34'),
(3, 1, 2, '我评价的是第1条！', 0, '2017-01-11 04:36:08'),
(4, 1, 2, '测试评论', 0, '2017-01-11 20:46:19'),
(5, 1, 1, '13日评论', 0, '2017-01-13 13:38:36'),
(31, 9, 1, '哈哈', 0, '2017-01-14 10:41:32'),
(32, 2, 1, '哈！评论段子', 0, '2017-01-14 11:52:29'),
(33, 3, 1, '哈哈，我要评论', 0, '2017-01-14 12:54:01'),
(36, 1, 1, '测试评论', 0, '2017-01-14 17:03:50'),
(38, 1, 1, '我的评论', 0, '2017-01-14 17:39:26');

-- --------------------------------------------------------

--
-- 表的结构 `tg_contents`
--

CREATE TABLE `tg_contents` (
  `contentsId` int(11) NOT NULL COMMENT '笑话内容id',
  `userId` int(11) DEFAULT NULL COMMENT '该内容是哪个用户id',
  `imgUrlOrContent` text COMMENT '图片链接或者是内容',
  `contentDesc` text COMMENT '仅是内容描述',
  `title` varchar(255) DEFAULT '' COMMENT '内容标题',
  `type` tinyint(1) DEFAULT NULL COMMENT '内容类型',
  `goodCount` int(11) DEFAULT '0' COMMENT '被赞次数',
  `badCount` int(11) DEFAULT '0' COMMENT '被踩次数',
  `commentCount` int(11) DEFAULT '0' COMMENT '评论次数',
  `shareCount` int(11) DEFAULT '0' COMMENT '转发或分享次数',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tg_contents`
--

INSERT INTO `tg_contents` (`contentsId`, `userId`, `imgUrlOrContent`, `contentDesc`, `title`, `type`, `goodCount`, `badCount`, `commentCount`, `shareCount`, `createTime`) VALUES
(1, 2, 'http://sc3.hao123img.com/data/4c6a238dcea1d1baf171c2fbe3976625_430', '', '改名后运气都变好了', 2, 5, 0, 0, 0, '2017-01-08 21:55:08'),
(2, 1, '', '老婆在家试穿一件新衣服，问我和儿子漂不漂亮。我回:“嗯，衣服蛮漂亮的。”<br/><br/>　　老婆扭头问儿子:“麻麻漂亮？还是衣服漂亮。”儿子回她:“麻麻漂亮！”<br/><br/>　　老婆撇嘴感叹:“别人生的和自己生的就是不一样！”', '别人生的和自己生的就是不一样', 1, 1, 2, 0, 0, '2017-01-07 14:18:12'),
(3, 1, '', '刚才那老外（谷歌董事长施密特）一坐下就说：“我来过中国许多次，还从来没有那次像这次这么心情愉快，因为这次我是先去逛了北朝鲜再过来。” 看来幸福感真是比较出来的-_-!', '谷歌董事长说中国很幸福', 1, 0, 0, 0, 0, '2017-01-08 18:15:24'),
(4, 1, '', '最近女儿期末摸底考试一直不错，今天拿回一张试卷，才考78分，我一看火了：咋这么点分？是不是骄傲了？<br/><br/>　　她还觉得挺委屈的，说：最后让写一篇短文，占了20分，题目是《勤劳的妈妈》，实在不知道怎么写。', '勤劳的妈妈', 1, 0, 0, 0, 0, '2017-01-08 18:17:13'),
(5, 1, 'http://image.tianjimedia.com/uploadImages/2016/341/57/A72328NXRD35.jpg;http://image.tianjimedia.com/uploadImages/2016/341/15/Q11961Y9Z23Y.jpg;http://image.tianjimedia.com/uploadImages/2016/341/04/5AAK264W4P04.jpg;http://image.tianjimedia.com/uploadImages/2016/341/04/URE6EDXB0V7Q.jpg;http://image.tianjimedia.com/uploadImages/2016/341/06/GNJ22QJ6IJ07.jpg;http://image.tianjimedia.com/uploadImages/2016/341/07/HNWIPUV113D8.jpg;http://image.tianjimedia.com/uploadImages/2016/341/08/4MF020Z6B1WC.jpg;http://image.tianjimedia.com/uploadImages/2016/341/09/E2UL3NS8W077.jpg;http://image.tianjimedia.com/uploadImages/2016/341/11/OB0W28613OMJ.jpg;http://image.tianjimedia.com/uploadImages/2016/341/12/414YV9X3P5E1.jpg;http://image.tianjimedia.com/uploadImages/2016/341/14/6B019OY30I29.jpg;http://image.tianjimedia.com/uploadImages/2016/341/26/07SZKQZRF225.jpg;http://image.tianjimedia.com/uploadImages/2016/341/18/Y07IC51X67HG.jpg;http://image.tianjimedia.com/uploadImages/2016/341/19/1F4GVF6ZC791.jpg;http://image.tianjimedia.com/uploadImages/2016/341/21/L0U419ZMF1K7.jpg;http://image.tianjimedia.com/uploadImages/2016/341/24/IGQ7SISW6216.jpg;', '0', '迷人气质名模姐妹花温泉写真 美图极致诱人', 3, 0, 0, 0, 0, '2017-01-08 18:48:22'),
(6, 1, 'http://image.tianjimedia.com/uploadImages/2016/340/35/8X931QG5U461.jpg;http://image.tianjimedia.com/uploadImages/2016/340/37/XHH8RZSI8LV9.jpg;http://image.tianjimedia.com/uploadImages/2016/340/38/96687X99AW9J.jpg;http://image.tianjimedia.com/uploadImages/2016/340/41/638ZE6U60N2E.jpg;http://image.tianjimedia.com/uploadImages/2016/340/44/QNWUAN06Y3X2.jpg;', '0', '气质女神非主流写真', 3, 0, 0, 0, 0, '2017-01-08 18:51:07'),
(7, 1, '\\n    马上就要回家过年了，可是华子却没钱，一年拼死拼活存下来的钱还不到两万块，看着面前驶过的豪车，以及车里骚首弄姿的美女，华子觉得包里那两万块钱真是讽刺。\\n    华子心里堵着一口气，他灵机一动，决定去赌场走一趟，到了晚上回家，华子真是想死的心都有了，两万块钱变成200块钱了，就在他万念俱灰之时，接到了老同学的电话。\\n    挂完电话，华子心里直打鼓，打电话给他的是高中最要好的兄弟，阿平。阿平是个小混混，但对华子这样会写诗，成绩好的同学很佩服，华子和阿平曾做过同桌，华子不嫌弃阿平这样的差等生，还把自己的笔记本借给他，这样两人的交情就不一般了。\\n    阿平高中毕业就出去混日子了，干过不少事，没挣到什么钱，如今找了一个古怪的活估计能挣大钱，但他需要信得过的人，所以找了华子。\\n    第二天华子和阿平碰了面，两人一合计，决定接下这个活，去盗墓，他们要盗的这个墓不是电视上讲的那些什么帝王墓、将军墓，危机四伏的。\\n    就是一个现代墓，而且前几天刚埋的。因为老太太死活不肯火葬，不要变成一把灰，正好这老太太的儿子儿媳，女儿女婿要么是高官，要么是老总，有权有势的，倒也期上瞒下，给老太太找了一块风水宝地，埋了，上好的楠木棺材里也给了老太太生前爱戴的一些首饰之类的，能换两个钱。\\n    这一次的雇主是个风水师，当初老太太埋得的风水宝地就是他给找的，事后他一琢磨，雇了阿平，让阿平找一个信得过的人，三个人一起干，钱平分。\\n    晚上三人坐了面包车来到了山上，找的那块地，由华子在上面接应，风水师和阿平挖了个盗洞，到洞下去开棺拿东西。c1();\\n    他们在几米外挖了盗洞，为了不让老太太的家人知道盗墓贼一开始就知道老太太埋得具体位置，免得他们怀疑到风水师。\\n    花了不少时间才挖到了棺材，打开了棺盖，果然见一个老太太躺在那儿，身体已经有些腐烂了，里面的陪葬品不说多，也不少，有几件好东西一看就是有点价值的，不过不是什么特别有价值的古董，想来古董级别的宝贝这老太太的儿子女儿也舍不得让老太太待到地府去。\\n    将里面的陪葬品全偷了，这棺材里有十几样首饰品，那风水师一估价，这些东西七七八八的有几十万，若是都脱手了，那就有不少钱了。\\n    东西都交由风水师去买卖，华子回家等消息，结果一觉睡到下午，被阿平的电话打醒，阿平告诉华子，那个风水师的电话打不通了，不知是不是带着东西跑了，他要去看看。\\n    华子和阿平来到了风水师的家，却被眼前的一幕给吓傻了，只见那风水师躺在血泊里，脸上血肉模糊，左眼的眼球都掉了出来，滚在了一旁，衣服也被撕扯的跟一条条领带死的，一片一片的。\\n    身上散落着昨夜盗出来的首饰，华子和阿平搞不清楚情况，两人大眼瞪小眼，最后一合计，急匆匆的把散落在地的首饰都卷进了包里，急急忙忙的离开了风水师的家。c2();\\n    两人各自分了点东西，回到了自己的家中，分别前两人约定，各自找买家，谁先找到买家，就通知对方一声。\\n    回到家后，华子心里总是觉得不舒服，好像有什么事情就要发生了，可是面对金钱的诱惑，他又安慰自己，没事的，他马上也要做一回有钱人了，虽然只有几十万，那也是他这辈子最富有的时刻了。\\n    这样想着，华子把首饰品藏好，自己一个人喝了点酒，在电脑前玩了会游戏，就在他累了准备睡觉的时候，突然传来了敲门声，华子骂骂咧咧的打开了门，却看见阿平站在自己面前。\\n    将阿平迎进门，华子奇怪的问道：阿平，是不是找到买家了，你怎么这么快就找到了？\\n    阿平脸色难看的点点头，说是买家是找到了，可是有点不对劲，不知道是真的有问题还是有人装神弄鬼，所以他来找华子商量一番再做决定。\\n    阿平告诉华子，有个人发信息说要买他们手上的东西，一开始阿平很兴奋，所以他又看了一眼那个短信，这一看吓一跳，这短信的手机号码是那个已经死了的风水师的，他觉得这事不对劲，所以想要问问华子，现在怎么办？\\n    听阿平这么说，华子也觉得有点诡异，那个风水师死了，他是个有点名气的大忙人，没理由死了一天没人发现，现在没听到任何关于那个风水师死亡的新闻，也不知道具体怎么回事？\\n    华子提议打个电话过去听听对方的声音，阿平就拨了过去，对面传来了那个风水师的声音：说好了三人平分？你们却想要撇下我，哼，我不会放过你们的。\\n    听到这声音，阿平吓得把手机给扔了，这时敲门声又响起了，阿平来到门口，打开门一看，那个之前在棺材里的老太太就站在他面前。\\n    又过了一天人们发现有两个人横死在华子家中，躺在血泊里，身边散落着不少价值不菲的首饰品。\\n    事后警方调查后得出结论：这三人一起去盗墓，后来华子和阿平联手干掉了风水师，最后这两人也分赃不均，互相杀死了对方！', '马上就要回家过年了，可是华子却没钱，一年拼死拼活存下来的钱还不到两万块，看着面前驶过的豪车，以及车里骚首弄姿的美女，华子觉得包里那两万块钱真是讽刺。华子心里堵着一口气，他灵机一动，决定去赌场走一趟，到...', '盗墓的后果', 4, 0, 0, 0, 0, '2017-01-08 19:03:55'),
(9, 1, 'http://www.hanhande.com/upload/160105/4182594_174332_1.jpg', '', '情人节礼物', 5, 0, 0, 0, 0, '2017-01-08 19:11:03'),
(10, 1, 'http://www.hanhande.com/upload/160105/4182594_174230_1.jpg', '', '正确的穿衣方式', 5, 0, 0, 0, 0, '2017-01-08 19:11:06'),
(11, 1, 'http://mvideo.spriteapp.cn/video/2017/0105/586dbc6595f15_wpc.mp4', '', '相亲女条件直接明了，疯癫男回应简单粗爆', 6, 0, 0, 0, 0, '2017-01-08 19:14:18'),
(12, 1, 'http://mvideo.spriteapp.cn/video/2017/0103/586b43c42cbb4_wpc.mp4 ', '', '为什么我们为人越来越小心，为什么我们处事越来越谨慎', 6, 0, 0, 0, 0, '2017-01-08 19:17:24');

-- --------------------------------------------------------

--
-- 表的结构 `tg_followers`
--

CREATE TABLE `tg_followers` (
  `followerId` int(11) NOT NULL COMMENT '粉丝id',
  `userId` int(11) NOT NULL COMMENT '用户id',
  `uid` int(11) NOT NULL COMMENT '关注的粉丝id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tg_followers`
--

INSERT INTO `tg_followers` (`followerId`, `userId`, `uid`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- 表的结构 `tg_user`
--

CREATE TABLE `tg_user` (
  `userId` int(11) NOT NULL COMMENT '用户id主键',
  `username` varchar(20) DEFAULT '' COMMENT '用户名',
  `userTruthName` varchar(100) DEFAULT '' COMMENT '用户真实名字',
  `password` char(32) DEFAULT '' COMMENT '用户密码',
  `userAge` varchar(3) DEFAULT '' COMMENT '用户年龄',
  `userPhone` char(11) DEFAULT '' COMMENT '用户手机号码',
  `userEmail` varchar(50) DEFAULT '' COMMENT '用户邮箱',
  `userSex` varchar(6) DEFAULT '' COMMENT '用户性别',
  `userQQ` varchar(20) DEFAULT '' COMMENT '用户QQ',
  `userPhoto` varchar(150) DEFAULT '' COMMENT '用户头像',
  `createTime` datetime DEFAULT NULL COMMENT '用户创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `tg_user`
--

INSERT INTO `tg_user` (`userId`, `username`, `userTruthName`, `password`, `userAge`, `userPhone`, `userEmail`, `userSex`, `userQQ`, `userPhoto`, `createTime`) VALUES
(1, 'tiangou', '', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', 'tiangou/image/20170110/05373639401792492.jpg', '2017-01-03 07:25:23'),
(2, 'test', '', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', 'tiangou/image/20170110/05373639401792492.jpg', '2017-01-04 06:47:35');

-- --------------------------------------------------------

--
-- 表的结构 `tg_user_login`
--

CREATE TABLE `tg_user_login` (
  `loginId` int(11) NOT NULL COMMENT '用户登录历史主键id',
  `userId` int(11) DEFAULT '0' COMMENT '用户id',
  `loginCity` varchar(30) DEFAULT '' COMMENT '用户登陆历史城市'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tg_apkinfo`
--
ALTER TABLE `tg_apkinfo`
  ADD PRIMARY KEY (`apkId`);

--
-- Indexes for table `tg_comments`
--
ALTER TABLE `tg_comments`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `tg_contents`
--
ALTER TABLE `tg_contents`
  ADD PRIMARY KEY (`contentsId`);

--
-- Indexes for table `tg_followers`
--
ALTER TABLE `tg_followers`
  ADD PRIMARY KEY (`followerId`);

--
-- Indexes for table `tg_user`
--
ALTER TABLE `tg_user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tg_user_login`
--
ALTER TABLE `tg_user_login`
  ADD PRIMARY KEY (`loginId`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tg_apkinfo`
--
ALTER TABLE `tg_apkinfo`
  MODIFY `apkId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'apk版本id';
--
-- 使用表AUTO_INCREMENT `tg_comments`
--
ALTER TABLE `tg_comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论id', AUTO_INCREMENT=39;
--
-- 使用表AUTO_INCREMENT `tg_contents`
--
ALTER TABLE `tg_contents`
  MODIFY `contentsId` int(11) NOT NULL AUTO_INCREMENT COMMENT '笑话内容id', AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `tg_followers`
--
ALTER TABLE `tg_followers`
  MODIFY `followerId` int(11) NOT NULL AUTO_INCREMENT COMMENT '粉丝id', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `tg_user`
--
ALTER TABLE `tg_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id主键', AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `tg_user_login`
--
ALTER TABLE `tg_user_login`
  MODIFY `loginId` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户登录历史主键id';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
