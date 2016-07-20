<?php 
include ('../inc/header_inc.php');
require_once('../inc/db_inc.php');

$uid=$_SESSION['UID'];
$sql = "SELECT * FROM tb_area WHERE USER_ID='$uid'";//

$rs = mysql_query($sql, $conn);
if (!$rs) {
	die ('エラー: ' . mysql_error());
}
$row = mysql_fetch_array($rs) ;

echo '<div class="page-header text-center"><h1>地域安否状況【'.$row['AREA_NAME'].'】</h1></div>';
?>

<!--平常時・緊急時ボタン-->
<div class="form-group">
<div class="col-sm-offset-3 col-sm-9" text-right>
<button class="btn btn-danger"><span class="glyphicon glyphicon-warning"></span>緊急時</button>
<button class="btn btn-default">解除</button>
<br>
</div>
</div>

<?php
$sql = "SELECT SAFE, COUNT( * ) as people FROM tb_state GROUP BY SAFE";//検索条件を適用したSQL文を作成

$rs = mysql_query($sql, $conn);
if (!$rs) {
	die ('エラー: ' . mysql_error());
}
$row = mysql_fetch_array($rs) ;

$icons=array('fire','user-plus','heart');//アイコンの配列
$colors=array('gray','red','green');//色の配列
$count=array(0,0,0);
while ($row) {
	$i=$row['SAFE'];
	$count[$i]= $row['people'];
	$row = mysql_fetch_array($rs) ;
}

for ($i=0; $i<sizeof($count);$i++) {
	echo '<a href="safe_count.php?id='.$i.'">';
	echo '<i class="fa fa-'.$icons[$i].'" style="font-size:150px;color:'.$colors[$i].'">';//安否アイコン
	echo  $count[$i]. '　</i></a>';//安否アイコン
	
	$row = mysql_fetch_array($rs) ;
}

//安否詳細
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = "SELECT * FROM tb_user NATURAL JOIN tb_state WHERE SAFE=$id";

$rs = mysql_query($sql, $conn);
if (!$rs) {
	die ('エラー: ' . mysql_error());
}
$row = mysql_fetch_array($rs) ;

echo '<table class="table table-hover">';
echo '<tr><th>名前</th><th>コメント</th><th>履歴</th></tr>';
while ($row) {
	echo '<tr>';
	//echo '<td>''</td>';
	echo '<td>' . $row['NAME'] . '</td>';
	echo '<td>' . $row['REPORT'] . '</td>';
	echo '<td>' . $row['SAFE'] . '</td>';
	echo '</tr>';

	$row = mysql_fetch_array($rs) ;

}
echo '<table>';
}
?>





