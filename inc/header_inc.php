<?php
session_start();
if (!defined('FAMISNS_ROOT')) define('FAMISNS_ROOT','/benkyou/pbs/p02-famisns');
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Eonasdan/bootstrap-datetimepicker@v4.0.0/build/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="xmlhttprequestcreate.js" type="text/javascript"></script>
<script src="main.js" type="text/javascript"></script>
<!-- Not_flat_design
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" media="screen">
-->
  </head>
  <body>

<?php
if(!isset($_SESSION['UTID'])){
?>

<div class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">ナビゲーションの切替</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">絆を深めるSNS</a>
    </div><!-- /.navbar-header -->
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</div><!-- /.navbar -->

<?php
}else{
  $uid = $_SESSION['UID'];
  $uname = $_SESSION['UNAME'];
  $utid = $_SESSION['UTID'];
  $hid = $_SESSION['HID'];
  $aid = $_SESSION['AID'];
 // echo $aid;

require_once('db_inc.php');

$query2 = "SELECT COUNT(*)AS COUNT FROM  `tb_demand`,`tb_user` NATURAL JOIN tb_home WHERE (`FROM_ID`=`HOME_ID`) AND (`TO_ID`='{$hid}') AND `REPRESENTATIVE_ID`=`USER_ID` AND `STATE`='0'";
$rs2 = mysql_query($query2);
if(!$rs2){
  die('エラー: ' . h(mysql_error()));
}
$row2 = mysql_fetch_array($rs2);

$query3 = "SELECT COUNT(*)AS COUNT FROM `tb_fdemand` NATURAL JOIN tb_user WHERE (`FROM_UID`=`USER_ID` OR `TO_UID`=`USER_ID`) AND `STATE`='0' AND `USER_ID`=`FROM_UID` AND `TO_UID`='{$uid}'";
$rs3 = mysql_query($query3);
if(!$rs3){
  die('エラー: ' . h(mysql_error()));
}
$row3 = mysql_fetch_array($rs3);
?>



<?php
//家族代表者と家族メンバーのみのメニューを表示
if($utid==1||$utid==2){
?>

<div class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">ナビゲーションの切替</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">絆を深めるSNS</a>
    </div>
    <!-- /.navbar-header -->
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">

		<!-- 地域 -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">地域<span class="badge"><?php if($row2['COUNT']!=0){ echo $row2['COUNT'];} ?></span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
			<li><a href="<?= FAMISNS_ROOT ?>/area/areatop.php">地域トップ</a></li>
			<li><a href="<?= FAMISNS_ROOT ?>/area/matching_list.php">ご近所さん<span class="badge"><?php if($row2['COUNT']!=0){ echo $row2['COUNT'];} ?></span></a></li>
          </ul>
        </li>

		<!-- 家族 -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">家族<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?= FAMISNS_ROOT ?>/index.php">家族トップ</a></li>
			<li><a href="<?= FAMISNS_ROOT ?>/family/familypage.php">家族詳細</a></li>
			<li><a href="<?= FAMISNS_ROOT ?>/family/album.php">お茶の間</a></li>
			<?php
			//代表者と管理者のみ表示する「家族メンバー追加」
			if($utid==0||$utid==9){
			?>
				<li><a href="<?= FAMISNS_ROOT ?>/family/family_prof_edit.php">家庭プロフ編集</a></li>
				<li><a href="<?= FAMISNS_ROOT ?>/mypage/member_signup.php">メンバー追加</a></li>
			<?php
			}
			?>
          </ul>
        </li>

		<!-- マイページ -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">マイページ<span class="badge"><?php if($row3['COUNT']!=0){ echo $row3['COUNT'];} ?></span><span class="caret"></span></a>
          <ul class="dropdown-menu">
			<li><a href="<?= FAMISNS_ROOT ?>/mypage/mypage.php">個人トップ</a></li>
			<li><a href="<?= FAMISNS_ROOT ?>/mypage/user_prof.php">個人プロフ編集</a></li>
			<li><a href="<?= FAMISNS_ROOT ?>/mypage/friend_list.php">フレンドリスト<span class="badge"><?php if($row3['COUNT']!=0){ echo $row3['COUNT'];} ?></span></a></li>
          </ul>
        </li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a>ようこそ！<?php echo $uname;?>さん</a></li>
        <li><a href="<?= FAMISNS_ROOT ?>/logout.php">ログアウト</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</div><!-- /.navbar -->

<div class="container">



<?php
//地域管理者のメニューを表示
}else if($utid==0){
?>

<div class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">ナビゲーションの切替</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">絆を深めるSNS</a>
    </div>
    <!-- /.navbar-header -->
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">


    <!-- ホーム -->
    <li><a href="<?= FAMISNS_ROOT ?>/area/safe_count.php">
    <span class="glyphicon glyphicon-home"></span> Home</a></li>

    <!-- 地域一覧 -->
    <li><a href="<?= FAMISNS_ROOT ?>/area/arealist.php">
    <span class="glyphicon glyphicon-th-list"></span> 地域一覧</a></li>

    <!-- 記事投稿 -->
    <li><a href="#"><span class="glyphicon glyphicon-picture"></span> 記事投稿</a></li>

    <!-- メニュー右側 -->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a>ようこそ！<?php echo $uname;?>さん</a></li>
        <li><a href="<?= FAMISNS_ROOT ?>/logout.php">ログアウト</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</div><!-- /.navbar -->

<div class="container">


<?php
}
?>

<?php
}
?>