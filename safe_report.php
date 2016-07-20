<?php
include ("inc/db_inc.php");

$u = $_GET['u'];  
$r = $_GET['r'];  
$sql = "UPDATE tb_state SET SAFE=$r WHERE USER_ID='$u'";
$rs = mysql_query($sql, $conn);
if (!$rs)  die('エラー: ' . mysql_error());
//$row = mysql_fetch_array($rs);

header('Location:index.php');

?>