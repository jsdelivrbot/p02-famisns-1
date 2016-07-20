<?php
include ("inc/db_inc.php");

$u = $_POST['uid'];  //ログイン画面より送信されたユーザID、例えば,'k12jk230';
$p = $_POST['pass'];  //ログイン画面より送信されたパスワード、例えば,'ar37';
$sql = "SELECT * FROM tb_user WHERE USER_ID='$u' AND PASSWORD='$p'";
$rs = mysql_query($sql, $conn);
if (!$rs)  die('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs);
if ($row){ 
  session_start();
  $_SESSION['UID']  = $row['USER_ID'];
  $_SESSION['UNAME'] = $row['NAME'];
  $_SESSION['UTID'] = $row['UT_ID'];
  $_SESSION['HID'] = $row['HOME_ID'];
  $utid = $row['UT_ID'];
  $h = $row['HOME_ID'];

  $sql = "SELECT * FROM tb_home NATURAL JOIN tb_area WHERE HOME_ID='$h'";
  //die ($sql);

  $rs = mysql_query($sql, $conn);
  if (!$rs)  die('エラー: ' . mysql_error());
  $row = mysql_fetch_array($rs);
  if ($row) $_SESSION['AID'] = $row['AREA_ID'];

  if ($utid == 0){
    header('Location:area/safe_count.php');
  } else if ($utid == 9){
   
  }else{
    header('Location:index.php');
  }
    

 }else{
  include('inc/header_inc.php'); 
  echo '<h2>ログイン失敗！</h2>';
  echo '<h2>ユーザー名もしくはパスワードが違います！</h2>';
  include('inc/footer_inc.php'); 
 }

?>