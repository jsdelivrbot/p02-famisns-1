-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成時間: 2016 年 7 月 20 日 07:08
-- サーバのバージョン: 5.5.8
-- PHP のバージョン: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `p02famisns`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_album`
--

CREATE TABLE IF NOT EXISTS `tb_album` (
  `ALBUM_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USER_ID` varchar(16) NOT NULL,
  `AL_TITLE` varchar(32) DEFAULT NULL,
  `AL_DETAIL` text,
  `IMAGE` varchar(32) DEFAULT NULL,
  `AL_POSTTIME` datetime DEFAULT NULL,
  PRIMARY KEY (`ALBUM_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- テーブルのデータをダンプしています `tb_album`
--

INSERT INTO `tb_album` (`ALBUM_ID`, `USER_ID`, `AL_TITLE`, `AL_DETAIL`, `IMAGE`, `AL_POSTTIME`) VALUES
(5, 'tnk000', 'テスト', 'テストです。\r\nあいうえお', 'files/20151130-200800.JPG', '2015-11-30 20:08:00'),
(8, 'mtk001', 'お花みてきた！', 'とてもたくさん咲いてたよ！！\r\n結構広かった。', 'files/20151213-192042.JPG', '2015-12-13 19:20:42'),
(10, 'mtk002', '道中で', '飛行機がめっちゃ近くを飛んでった！！', 'files/20151213-192430.JPG', '2015-12-12 19:24:30');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_answernote`
--

CREATE TABLE IF NOT EXISTS `tb_answernote` (
  `NOTE_ID` bigint(20) NOT NULL,
  `ANOTE_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `AN_TITLE` text,
  `AN_DETAIL` text,
  `AN_POSTTIME` datetime DEFAULT NULL,
  `ANONYMITY` int(11) DEFAULT NULL,
  PRIMARY KEY (`ANOTE_ID`),
  KEY `NOTE_ID` (`NOTE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- テーブルのデータをダンプしています `tb_answernote`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `tb_area`
--

CREATE TABLE IF NOT EXISTS `tb_area` (
  `AREA_ID` varchar(16) NOT NULL,
  `AREA_NAME` varchar(32) DEFAULT NULL,
  `USER_ID` varchar(32) NOT NULL,
  `EMERGENCY` int(11) NOT NULL,
  PRIMARY KEY (`AREA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_area`
--

INSERT INTO `tb_area` (`AREA_ID`, `AREA_NAME`, `USER_ID`, `EMERGENCY`) VALUES
('admin', 'admin', '', 0),
('area1', '福岡市東区松香台', 'matuka', 1),
('area10', '群馬県', '', 0),
('area11', '埼玉県', '', 0),
('area12', '千葉県', '', 0),
('area13', '東京都', '', 0),
('area14', '神奈川県', '', 0),
('area15', '新潟県', '', 0),
('area16', '富山県', '', 0),
('area17', '石川県', '', 0),
('area18', '福井県', '', 0),
('area19', '山梨県', '', 0),
('area2', '青森県', '', 0),
('area20', '長野県', '', 0),
('area21', '岐阜県', '', 0),
('area22', '静岡県', '', 0),
('area23', '愛知県', '', 0),
('area24', '三重県', '', 0),
('area25', '滋賀県', '', 0),
('area26', '京都府', '', 0),
('area27', '大阪府', '', 0),
('area28', '兵庫県', '', 0),
('area29', '奈良県', '', 0),
('area3', '岩手県', '', 0),
('area30', '和歌山県', '', 0),
('area31', '鳥取県', '', 0),
('area32', '島根県', '', 0),
('area33', '岡山県', '', 0),
('area34', '広島県', '', 0),
('area35', '山口県', '', 0),
('area36', '徳島県', '', 0),
('area37', '香川県', '', 0),
('area38', '愛媛県', '', 0),
('area39', '高知県', '', 0),
('area4', '宮城県', '', 0),
('area40', '福岡県', '', 0),
('area41', '佐賀県', '', 0),
('area42', '長崎県', '', 0),
('area43', '熊本県', '', 0),
('area44', '大分県', '', 0),
('area45', '宮崎県', '', 0),
('area46', '鹿児島県', '', 0),
('area47', '沖縄県', '', 0),
('area5', '秋田県', '', 0),
('area6', '山形県', '', 0),
('area7', '福島県', '', 0),
('area8', '茨城県', '', 0),
('area9', '栃木県', '', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_areaivent`
--

CREATE TABLE IF NOT EXISTS `tb_areaivent` (
  `AREA_ID` varchar(16) NOT NULL,
  `USER_ID` varchar(20) NOT NULL,
  `AIVENT_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `AI_TITLE` text,
  `AI_PLACE` text,
  `AI_DATETIME` datetime DEFAULT NULL,
  `AI_DETAIL` text,
  `AI_POSTTIME` datetime DEFAULT NULL,
  PRIMARY KEY (`AIVENT_ID`),
  KEY `AREA_ID` (`AREA_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- テーブルのデータをダンプしています `tb_areaivent`
--

INSERT INTO `tb_areaivent` (`AREA_ID`, `USER_ID`, `AIVENT_ID`, `AI_TITLE`, `AI_PLACE`, `AI_DATETIME`, `AI_DETAIL`, `AI_POSTTIME`) VALUES
('area40', 'mtk000', 1, '九産大オープンキャンパス', '九州産業大学', '2016-07-28 09:00:00', '九州産業大学のオープンキャンパスの内容等、説明。', '2015-10-22 10:30:00'),
('area40', 'mtk000', 6, '九産大香椎祭', '九州産業大学', '2016-11-01 10:00:00', 'テスト。11/3まで開催される。', '2015-10-28 14:53:22'),
('area40', 'mtk000', 10, '九州発北欧展2015 in FUKUOKA', 'ロバーツコーヒー福岡大名店', '2016-12-20 08:00:00', ' ＜ワークショップ＞８時00分?（※所要時間、参加費などは、詳細をご覧ください）\r\n11月29日（日）　和紙と北欧のコラボレーション\r\n                            （吉村 祐樹  工学部住居・インテリア設計学科 助教）\r\n12月６日（日）    星型ペーパー照明作り\r\n　　　　　　　　（川崎 英彦　有限会社ライトニック）\r\n12月13日（日）　木のテープを使った北欧風オーナメントづくり\r\n　　　　　　　　（中谷 昭子　九州造形短期大学　講師）\r\n12月20日（日）　非常食になる堅パンで作るクリスマスオーナメント\r\n　　　　　　　 （三浦 長弘　ミウラパン）\r\n＜トークショー＞18時30分?（所要時間、参加費などは、詳細をご覧ください）\r\n11月21日（土）　北欧から学ぶ これからの日本の暮らしとデザイン\r\n　　　　　　　　（島崎 信　武蔵野美術大学　名誉教授、島崎信事務所）\r\n12月12日（土）　フィンランドの魅力と楽しみ方?サウナからオーロラまで?\r\n　　　　　　　   （小泉 隆　工学部住居・インテリア設計学科 教授）\r\n12月19日（土）　幸福度世界一のデンマークとは\r\n 　　　　　　　 （長阿彌 幹生　教育文化研究所 代表、福岡デンマーク協会 理事長', '2015-11-30 23:57:07'),
('area40', 'mtk000', 11, '東日本大震災ボランティア隊「報告会」', '九州産業大学　本館３階大会議室', '2016-11-26 18:30:00', ' 　今年９月に、「九産大ボランティア愛好会ひまわり」の学生17人が東北へ行き、東日本大震災の復興支援を行いました。\r\n　震災から４年半が経過した被災地で、学生たちが目にしたもの、感じたことを伝えます。\r\nどなたでも参加いただけますので、ぜひお越しください。\r\n日時：平成27年11月26日（木）18時30分?20時00分　（※18時受付開始）\r\n場所：九州産業大学本館３階大会議室\r\n問い合わせ先：TEL 092-673-5571　学生部学生課', '2015-11-30 23:59:39'),
('area40', 'mtk000', 12, '九州産業大学情報科学部ミニ・オープンキャンパス', '九州産業大学情報科学部', '2016-01-09 00:00:00', '情報科学部では、土曜日に、ミニ・オープンキャンパスを開催しています。\r\n・12月５日（土）\r\n・12月12日（土）\r\n・１月９日（土）\r\n　情報科学部の充実した設備、大学のスケール感を実際にキャンパスで体感してください!! 　 　\r\n「施設見学」「進学相談」「教育内容の説明」など、担当教員が個別対応も行います。 　\r\n　お一人から、友達や高校の先生、ご家族と一緒の参加もOK！\r\n　先生方や保護者の方のみの参加も歓迎します。 　\r\n　開催日前日の午後５時までに、事前予約を行ってください。\r\n\r\n　お問い合わせ（予約）：情報科学部事務室 　', '2015-12-01 00:01:43'),
('area40', 'mtk000', 16, 'マリンワールド海のクリスマス2016', 'マリンワールド海の中道', '2016-12-25 00:00:00', '海の生き物ランタンが登場。\r\nサンタダイバーのアクアライブショーやアシカイルカショー他楽しいイベント満載。\r\n23日から25日の3日間は夜21時まで営業する。\r\n3日間限定で面白い似顔絵を描くことでおなじみ「モンドくん」の似顔絵屋さん、父でミュージシャンの「ボギー」ライブも開催。', '2015-12-13 19:43:27');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_comment`
--

CREATE TABLE IF NOT EXISTS `tb_comment` (
  `USER_ID` varchar(20) NOT NULL,
  `CTARGET_ID` bigint(16) NOT NULL,
  `COMMMENT_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `C_DETAIL` text,
  `C_POSTTIME` datetime DEFAULT NULL,
  `TARGETNUM_ID` bigint(20) NOT NULL,
  PRIMARY KEY (`COMMMENT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- テーブルのデータをダンプしています `tb_comment`
--

INSERT INTO `tb_comment` (`USER_ID`, `CTARGET_ID`, `COMMMENT_ID`, `C_DETAIL`, `C_POSTTIME`, `TARGETNUM_ID`) VALUES
('mtk001', 2, 19, 'キレイだねー！', '2015-12-13 19:16:47', 25),
('tnk000', 2, 21, 'お、いいですね！', '2015-12-13 19:17:44', 26),
('tnk000', 2, 22, 'どこに行ったの～？', '2015-12-13 19:18:09', 25),
('ymd000', 2, 23, '私もこの前見に行きました～！', '2015-12-13 19:19:06', 26),
('mtk002', 3, 24, 'きれいだね！！', '2015-12-13 19:24:45', 8),
('mtk000', 3, 25, 'おー、いっぱい咲いてるね！！', '2015-12-13 19:25:34', 8),
('mtk000', 3, 26, 'スゴイ近いね！！', '2015-12-13 19:26:08', 10),
('mtk000', 2, 27, '別府！', '2015-12-13 19:30:39', 25),
('ymd000', 2, 28, 'Good!!', '2015-12-13 19:31:17', 25),
('mtk000', 3, 29, 'あいうえお', '2015-12-16 23:55:28', 11);

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_commenttarget`
--

CREATE TABLE IF NOT EXISTS `tb_commenttarget` (
  `CTARGET_ID` bigint(20) NOT NULL,
  `CT_NAME` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`CTARGET_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_commenttarget`
--

INSERT INTO `tb_commenttarget` (`CTARGET_ID`, `CT_NAME`) VALUES
(0, '日記'),
(1, 'イベント'),
(2, '地域記事'),
(3, '家庭アルバム');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_condition`
--

CREATE TABLE IF NOT EXISTS `tb_condition` (
  `CONDITION_ID` int(11) NOT NULL,
  `CONDITIONNAME` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`CONDITION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_condition`
--

INSERT INTO `tb_condition` (`CONDITION_ID`, `CONDITIONNAME`) VALUES
(0, '良好'),
(1, 'けが'),
(2, '病気'),
(3, '風邪気味');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_demand`
--

CREATE TABLE IF NOT EXISTS `tb_demand` (
  `DEMAND_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `FROM_ID` varchar(10) DEFAULT NULL,
  `TO_ID` varchar(10) DEFAULT NULL,
  `STATE` int(11) DEFAULT NULL,
  PRIMARY KEY (`DEMAND_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- テーブルのデータをダンプしています `tb_demand`
--

INSERT INTO `tb_demand` (`DEMAND_ID`, `FROM_ID`, `TO_ID`, `STATE`) VALUES
(19, 'home1', 'home2', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_diary`
--

CREATE TABLE IF NOT EXISTS `tb_diary` (
  `USER_ID` varchar(16) NOT NULL,
  `DIARY_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `D_TITLE` text,
  `D_DETAIL` text,
  `D_POSTTIME` datetime DEFAULT NULL,
  PRIMARY KEY (`DIARY_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- テーブルのデータをダンプしています `tb_diary`
--

INSERT INTO `tb_diary` (`USER_ID`, `DIARY_ID`, `D_TITLE`, `D_DETAIL`, `D_POSTTIME`) VALUES
('mtk000', 1, 'てすと', '投稿のテストです。', '0000-00-00 00:00:00'),
('mtk000', 2, 'てすと', '２回目のテストです。', '2015-10-15 09:07:52'),
('mtk001', 3, 'てすと２', '他のユーザーのテスト。', '2015-10-29 10:28:49'),
('tnk000', 4, '投稿テスト', 'あいうえお。', '2015-12-02 18:03:52');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_familychat`
--

CREATE TABLE IF NOT EXISTS `tb_familychat` (
  `USER_ID` varchar(20) NOT NULL,
  `FCHAT_ID` bigint(20) NOT NULL,
  `FC_DETAIL` text,
  `FC_POSTTIME` datetime DEFAULT NULL,
  PRIMARY KEY (`FCHAT_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_familychat`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `tb_familyivent`
--

CREATE TABLE IF NOT EXISTS `tb_familyivent` (
  `HOME_ID` varchar(16) NOT NULL,
  `FIVENT_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `FI_TITLE` text,
  `FI_DATETIME` datetime DEFAULT NULL,
  `FI_DETAIL` text,
  `FI_PLACE` text,
  PRIMARY KEY (`FIVENT_ID`),
  KEY `HOME_ID` (`HOME_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- テーブルのデータをダンプしています `tb_familyivent`
--

INSERT INTO `tb_familyivent` (`HOME_ID`, `FIVENT_ID`, `FI_TITLE`, `FI_DATETIME`, `FI_DETAIL`, `FI_PLACE`) VALUES
('home1', 1, '太郎の誕生日', '2016-12-20 00:00:00', '太郎の誕生日です。みんなでケーキを食べよう！', '家'),
('home1', 2, 'おばあちゃんの家へ', '2016-12-30 12:00:00', '昼からおばあちゃんの家にいくよ！', 'おばあちゃんの家');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_fdemand`
--

CREATE TABLE IF NOT EXISTS `tb_fdemand` (
  `FDEMAND_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `FROM_UID` varchar(10) DEFAULT NULL,
  `TO_UID` varchar(16) DEFAULT NULL,
  `STATE` int(11) DEFAULT NULL,
  PRIMARY KEY (`FDEMAND_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- テーブルのデータをダンプしています `tb_fdemand`
--

INSERT INTO `tb_fdemand` (`FDEMAND_ID`, `FROM_UID`, `TO_UID`, `STATE`) VALUES
(4, 'ymd000', 'mtk000', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_home`
--

CREATE TABLE IF NOT EXISTS `tb_home` (
  `AREA_ID` varchar(16) NOT NULL,
  `HOME_ID` varchar(16) NOT NULL,
  `H_NAME` varchar(32) DEFAULT NULL,
  `REPRESENTATIVE_ID` varchar(16) DEFAULT NULL,
  `POSTALCODE` char(7) DEFAULT NULL,
  `PREFECTURES` varchar(4) DEFAULT NULL,
  `MUNICIPALITY` varchar(64) DEFAULT NULL,
  `ADDRESS` varchar(32) DEFAULT NULL,
  `UNIVERSITY` varchar(32) DEFAULT NULL,
  `HIGHSCHOOL` varchar(32) DEFAULT NULL,
  `MIDDLESCHOOL` varchar(32) DEFAULT NULL,
  `ELEMENTARYSCHOOL` varchar(32) DEFAULT NULL,
  `PRESCHOOL` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`HOME_ID`),
  KEY `AREA_ID` (`AREA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_home`
--

INSERT INTO `tb_home` (`AREA_ID`, `HOME_ID`, `H_NAME`, `REPRESENTATIVE_ID`, `POSTALCODE`, `PREFECTURES`, `MUNICIPALITY`, `ADDRESS`, `UNIVERSITY`, `HIGHSCHOOL`, `MIDDLESCHOOL`, `ELEMENTARYSCHOOL`, `PRESCHOOL`) VALUES
('admin', 'admi0', 'admin', 'admin', '', '', '', NULL, NULL, NULL, NULL, NULL, ''),
('area1', 'home1', '松香家', 'mtk000', '8130004', '福岡県', '福岡市東区松香台', NULL, '九州産業大学', '松香高校', '松香中学校', '松香小学校', '松香台保育園'),
('area1', 'home2', '田中家', 'tnk000', '8130004', '福岡県', '福岡市東区松香台', NULL, '九州産業大学', '松香高校', '松香中学校', '松香小学校', '松香台保育園'),
('area40', 'home3', '九産家', 'kyusan000', '8140180', '福岡県', '福岡市城南区七隈', NULL, '福岡大学', '福岡高校', '福岡中学校', '福岡小学校', '福岡幼稚園'),
('area1', 'home4', '山田家', 'ymd000', '8130004', '福岡県', '福岡市東区松香台', NULL, '九州産業大学', '九州産業大学付属高校', '松香中学校', '松香小学校', '松香幼稚園'),
('area1', 'home5', '伊藤家', 'ito000', '8130004', '福岡県', '福岡市東区松香台', '', '松香大学', '', '', '', '松香幼稚園'),
('area1', 'home6', '松香台', 'matuka', '8191123', '福岡県', '糸島市神在374-20', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_homeprof`
--

CREATE TABLE IF NOT EXISTS `tb_homeprof` (
  `HOMEPROF_ID` bigint(16) NOT NULL AUTO_INCREMENT,
  `HOME_ID` varchar(16) NOT NULL,
  `IMAGE` varchar(32) DEFAULT NULL,
  `COMMENT` text,
  PRIMARY KEY (`HOMEPROF_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- テーブルのデータをダンプしています `tb_homeprof`
--

INSERT INTO `tb_homeprof` (`HOMEPROF_ID`, `HOME_ID`, `IMAGE`, `COMMENT`) VALUES
(1, 'home1', 'homeimg/20151216-224122.JPG', '昨日、家族で旅行にいってきました！！\r\nとても景色がよかったです。\r\n次はどこに行こうかな？\r\nおすすめの場所教えてください！\r\n'),
(2, 'home2', 'homeimg/20151216-224148.JPG', '気軽に声掛けてくださいね。\r\nよろしくお願いします～！'),
(3, 'home4', 'homeimg/20151216-224310.JPG', 'よろしくお願いします！'),
(4, 'home5', 'homeimg/20151216-230658.JPG', 'よろしく！！');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_housework`
--

CREATE TABLE IF NOT EXISTS `tb_housework` (
  `HOME_ID` varchar(16) NOT NULL,
  `HWORK_ID` bigint(16) NOT NULL AUTO_INCREMENT,
  `HW_NAME` varchar(32) DEFAULT NULL,
  `HW_FINISH` int(11) DEFAULT NULL,
  `UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`HWORK_ID`),
  KEY `HOME_ID` (`HOME_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- テーブルのデータをダンプしています `tb_housework`
--

INSERT INTO `tb_housework` (`HOME_ID`, `HWORK_ID`, `HW_NAME`, `HW_FINISH`, `UPDATE`) VALUES
('home1', 1, '掃除', 0, '2015-12-13 03:15:31'),
('home1', 2, '洗濯', 0, '2015-12-17 07:53:28'),
('home1', 3, '風呂掃除', 0, '2015-12-13 03:15:31');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_kibun`
--

CREATE TABLE IF NOT EXISTS `tb_kibun` (
  `KIBUN_ID` int(11) NOT NULL AUTO_INCREMENT,
  `KIBUNNAME` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`KIBUN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- テーブルのデータをダンプしています `tb_kibun`
--

INSERT INTO `tb_kibun` (`KIBUN_ID`, `KIBUNNAME`) VALUES
(0, '好調'),
(1, '普通'),
(2, '不調'),
(3, '絶不調');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_note`
--

CREATE TABLE IF NOT EXISTS `tb_note` (
  `AREA_ID` varchar(16) NOT NULL,
  `USER_ID` varchar(20) NOT NULL,
  `NOTE_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `N_ID` text,
  `N_POSTTIME` datetime DEFAULT NULL,
  `RESOLVED` int(11) DEFAULT NULL,
  `ANONYMITY` int(11) DEFAULT NULL,
  PRIMARY KEY (`NOTE_ID`),
  KEY `AREA_ID` (`AREA_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- テーブルのデータをダンプしています `tb_note`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `tb_post`
--

CREATE TABLE IF NOT EXISTS `tb_post` (
  `AREA_ID` varchar(16) NOT NULL,
  `USER_ID` varchar(16) NOT NULL,
  `POST_ID` bigint(16) NOT NULL AUTO_INCREMENT,
  `P_TITLE` text,
  `P_DETAIL` text,
  `P_POSTTIME` datetime DEFAULT NULL,
  `IMAGE` varchar(32) DEFAULT NULL,
  `SHARE` int(11) DEFAULT NULL,
  PRIMARY KEY (`POST_ID`),
  KEY `AREA_ID` (`AREA_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- テーブルのデータをダンプしています `tb_post`
--

INSERT INTO `tb_post` (`AREA_ID`, `USER_ID`, `POST_ID`, `P_TITLE`, `P_DETAIL`, `P_POSTTIME`, `IMAGE`, `SHARE`) VALUES
('area40', 'mtk000', 25, '旅行', 'ホテルからの夜景！', '2015-12-13 19:13:58', 'files/20151213-191358.JPG', 0),
('area40', 'mtk000', 26, '紅葉', '紅葉見に行ってきたよ！\r\nまだ始まったばかりで、\r\n赤くないのも結構あった。\r\nでも、きれいだったよ！', '2015-12-13 19:15:18', 'files/20151213-191518.JPG', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_safetype`
--

CREATE TABLE IF NOT EXISTS `tb_safetype` (
  `SAFE_ID` int(11) DEFAULT NULL,
  `SAFETYPE` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_safetype`
--

INSERT INTO `tb_safetype` (`SAFE_ID`, `SAFETYPE`) VALUES
(2, '無事'),
(1, 'SOS'),
(0, '未確認');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_state`
--

CREATE TABLE IF NOT EXISTS `tb_state` (
  `USER_ID` varchar(16) NOT NULL,
  `CONDITION_ID` int(11) NOT NULL,
  `LOCATION` varchar(32) DEFAULT NULL,
  `COMMENT` varchar(32) DEFAULT NULL,
  `KIBUN_ID` int(11) DEFAULT NULL,
  `SAFE` int(11) NOT NULL,
  `REPORT` text NOT NULL,
  `UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `CONDITION_ID` (`CONDITION_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_state`
--

INSERT INTO `tb_state` (`USER_ID`, `CONDITION_ID`, `LOCATION`, `COMMENT`, `KIBUN_ID`, `SAFE`, `REPORT`, `UPDATE`) VALUES
('mtk000', 3, '九産大', '帰宅中です', 2, 2, '怪我をした', '2016-07-20 13:51:53'),
('mtk001', 0, '家の近く', '買い物してます', 1, 2, '', '2016-07-20 13:51:55'),
('mtk002', 0, '家', '勉強してる', 0, 1, '', '2016-07-20 14:05:25'),
('admin', 1, 'admin', 'システム管理者です。', 0, 0, '', '2015-12-13 23:52:41'),
('tnk000', 0, '博多', '帰宅中', 0, 0, '', '2015-12-13 23:53:12'),
('ymd000', 0, '家', 'あいうえお', 1, 0, '', '2015-12-13 23:52:53'),
('tnk001', 0, '学校', '今、学校です', 0, 0, '', '2016-01-26 14:20:56'),
('tnk002', 3, '学校', '', 1, 0, '', '2016-01-26 14:16:51');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_todo`
--

CREATE TABLE IF NOT EXISTS `tb_todo` (
  `USER_ID` varchar(16) NOT NULL,
  `TODO_ID` bigint(16) NOT NULL AUTO_INCREMENT,
  `T_NAME` varchar(32) DEFAULT NULL,
  `T_FINISH` int(11) DEFAULT NULL,
  PRIMARY KEY (`TODO_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- テーブルのデータをダンプしています `tb_todo`
--

INSERT INTO `tb_todo` (`USER_ID`, `TODO_ID`, `T_NAME`, `T_FINISH`) VALUES
('mtk000', 1, '課題', 1),
('mtk000', 2, '資格試験の勉強', 1),
('mtk000', 3, '田中さんに電話', 0),
('mtk001', 4, '買い物に行く', 1),
('mtk001', 5, '洗濯', 0),
('mtk001', 6, 'お金をおろしにいく', 0),
('mtk002', 7, '学校の課題を終わらせる', 0),
('mtk002', 8, '試験勉強', 0),
('mtk002', 9, '筋トレ', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `HOME_ID` varchar(16) NOT NULL,
  `UT_ID` bigint(16) NOT NULL,
  `USER_ID` varchar(16) NOT NULL,
  `PASSWORD` varchar(16) NOT NULL,
  `NAME` varchar(32) NOT NULL,
  `SEX` int(11) NOT NULL,
  `BIRTHDAY` date NOT NULL,
  `EMAIL` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`USER_ID`),
  KEY `HOME_ID` (`HOME_ID`),
  KEY `UT_ID` (`UT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_user`
--

INSERT INTO `tb_user` (`HOME_ID`, `UT_ID`, `USER_ID`, `PASSWORD`, `NAME`, `SEX`, `BIRTHDAY`, `EMAIL`) VALUES
('admi0', 9, 'admin', 'admin', 'admin', 1, '0000-00-00', ''),
('home5', 1, 'ito000', 'ito000', '伊藤太郎', 1, '1980-10-10', ''),
('home3', 1, 'kyusan000', 'kyusan000', '九産太郎', 1, '1960-11-11', ''),
('home6', 0, 'matuka', 'abcd', '東区松香台管理者', 1, '1994-12-14', ''),
('home1', 1, 'mtk000', 'mtk000', '松香太郎', 1, '1958-12-20', ''),
('home1', 2, 'mtk001', 'mtk001', '松香花子', 0, '1960-11-11', ''),
('home1', 2, 'mtk002', 'mtk002', '松香ダイスケ', 1, '1993-11-01', ''),
('home2', 1, 'tnk000', 'tnk000', '田中太郎', 1, '1980-10-10', ''),
('home2', 2, 'tnk001', 'tnk001', '田中次郎', 1, '1999-10-10', ' '),
('home2', 2, 'tnk002', 'tnk002', '田中三郎', 1, '1995-12-12', ' '),
('home4', 1, 'ymd000', 'ymd000', '山田太郎', 1, '1965-12-10', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_userprof`
--

CREATE TABLE IF NOT EXISTS `tb_userprof` (
  `UPROF_ID` bigint(16) NOT NULL AUTO_INCREMENT,
  `USER_ID` varchar(16) NOT NULL,
  `U_IMAGE` varchar(32) DEFAULT NULL,
  `COMMENT` text,
  `HOBBY` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`UPROF_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- テーブルのデータをダンプしています `tb_userprof`
--

INSERT INTO `tb_userprof` (`UPROF_ID`, `USER_ID`, `U_IMAGE`, `COMMENT`, `HOBBY`) VALUES
(1, 'mtk000', 'userimg/20151204-011411.png', '宜しくお願いします', '読書・旅行'),
(2, 'tnk000', 'userimg/20151204-003604.png', '田中です。よろしく！', '旅行'),
(3, 'mtk001', 'userimg/20151202-224126.png', 'よろしく♪', 'ショッピング'),
(4, 'mtk002', 'userimg/20151202-224224.png', 'よろしく！！', 'サッカー'),
(5, 'ymd000', 'userimg/20151204-011411.png', 'よろしく', '映画鑑賞'),
(6, 'tnk001', 'userimg/20160126-061745.png', '未登録', '未登録'),
(7, 'tnk002', 'userimg/20151204-011411.png', 'よろしく', '未登録');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_usertype`
--

CREATE TABLE IF NOT EXISTS `tb_usertype` (
  `UT_ID` bigint(16) NOT NULL,
  `USERTYPE` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`UT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_usertype`
--

INSERT INTO `tb_usertype` (`UT_ID`, `USERTYPE`) VALUES
(0, '地域代表者'),
(1, '家族代表者'),
(2, '家族メンバー'),
(9, 'システム管理者');

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `tb_answernote`
--
ALTER TABLE `tb_answernote`
  ADD CONSTRAINT `tb_answernote_ibfk_1` FOREIGN KEY (`NOTE_ID`) REFERENCES `tb_note` (`NOTE_ID`);

--
-- テーブルの制約 `tb_areaivent`
--
ALTER TABLE `tb_areaivent`
  ADD CONSTRAINT `tb_areaivent_ibfk_1` FOREIGN KEY (`AREA_ID`) REFERENCES `tb_area` (`AREA_ID`),
  ADD CONSTRAINT `tb_areaivent_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `tb_user` (`USER_ID`);

--
-- テーブルの制約 `tb_diary`
--
ALTER TABLE `tb_diary`
  ADD CONSTRAINT `tb_diary_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `tb_user` (`USER_ID`);

--
-- テーブルの制約 `tb_familychat`
--
ALTER TABLE `tb_familychat`
  ADD CONSTRAINT `tb_familychat_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `tb_user` (`USER_ID`);

--
-- テーブルの制約 `tb_familyivent`
--
ALTER TABLE `tb_familyivent`
  ADD CONSTRAINT `tb_familyivent_ibfk_1` FOREIGN KEY (`HOME_ID`) REFERENCES `tb_home` (`HOME_ID`);

--
-- テーブルの制約 `tb_home`
--
ALTER TABLE `tb_home`
  ADD CONSTRAINT `tb_home_ibfk_1` FOREIGN KEY (`AREA_ID`) REFERENCES `tb_area` (`AREA_ID`);

--
-- テーブルの制約 `tb_housework`
--
ALTER TABLE `tb_housework`
  ADD CONSTRAINT `tb_housework_ibfk_1` FOREIGN KEY (`HOME_ID`) REFERENCES `tb_home` (`HOME_ID`);

--
-- テーブルの制約 `tb_note`
--
ALTER TABLE `tb_note`
  ADD CONSTRAINT `tb_note_ibfk_1` FOREIGN KEY (`AREA_ID`) REFERENCES `tb_area` (`AREA_ID`),
  ADD CONSTRAINT `tb_note_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `tb_user` (`USER_ID`);

--
-- テーブルの制約 `tb_post`
--
ALTER TABLE `tb_post`
  ADD CONSTRAINT `tb_post_ibfk_1` FOREIGN KEY (`AREA_ID`) REFERENCES `tb_area` (`AREA_ID`),
  ADD CONSTRAINT `tb_post_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `tb_user` (`USER_ID`);

--
-- テーブルの制約 `tb_state`
--
ALTER TABLE `tb_state`
  ADD CONSTRAINT `tb_state_ibfk_1` FOREIGN KEY (`CONDITION_ID`) REFERENCES `tb_condition` (`CONDITION_ID`),
  ADD CONSTRAINT `tb_state_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `tb_user` (`USER_ID`);

--
-- テーブルの制約 `tb_todo`
--
ALTER TABLE `tb_todo`
  ADD CONSTRAINT `tb_todo_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `tb_user` (`USER_ID`);

--
-- テーブルの制約 `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`HOME_ID`) REFERENCES `tb_home` (`HOME_ID`),
  ADD CONSTRAINT `tb_user_ibfk_2` FOREIGN KEY (`UT_ID`) REFERENCES `tb_usertype` (`UT_ID`);
