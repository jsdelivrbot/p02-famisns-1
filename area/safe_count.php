<?php 
include ('../inc/header_inc.php');
require_once('../inc/db_inc.php');

$uid=$_SESSION['UID'];

if(isset($_GET['s'])){
	$s = $_GET['s'];
	$sql = "UPDATE tb_area SET EMERGENCY=$s WHERE USER_ID='$uid'"; 
	//echo $sql;
	$rs = mysql_query($sql, $conn);
}


$sql = "SELECT * FROM tb_area WHERE USER_ID='$uid'";//

$rs = mysql_query($sql, $conn);
if (!$rs) {
	die ('エラー: ' . mysql_error());
}
$row = mysql_fetch_array($rs) ;
$emergency=0;
if($row){
	$emergency=$row['EMERGENCY'];
	$area_name=$row['AREA_NAME'];
}



echo '<div class="form-group">';
echo '<div class="col-sm-offset-5 col-sm-12" text-right>';
if($emergency>0){
	echo '<a href="?s=1" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-warning"></span>緊急時</a>';
	echo '<a href="?s=0" class="btn btn-default btn-lg">平常時</a>';
}else{
	echo '<a href="?s=1" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-warning"></span>緊急時</a>';
	echo '<a href="?s=0" class="btn btn-success btn-lg">平常時</a>';
}
echo '<br></div></div><br>';




echo '<div class="page-header text-center"><h1>地域安否状況【'.$area_name.'】</h1></div>';
?>



<?php
$sql = "SELECT SAFE, COUNT( * ) as people FROM tb_state GROUP BY SAFE";//検索条件を適用したSQL文を作成

$rs = mysql_query($sql, $conn);
if (!$rs) {
	die ('エラー: ' . mysql_error());
}
$row = mysql_fetch_array($rs) ;

$icons=array('envelope','ambulance','heart');//アイコンの配列
$colors=array('gray','red','green');//色の配列
$count=array(0,0,0);
while ($row) {
	$i=$row['SAFE'];
	$count[$i]= $row['people'];
	$row = mysql_fetch_array($rs) ;
}

for ($i=0; $i<sizeof($count);$i++) {
	echo '<div class="col-sm-offset-1 col-sm-2">';
	echo '<a href="safe_count.php?id='.$i.'">';
	echo '<i class="fa fa-'.$icons[$i].'" style="font-size:150px;color:'.$colors[$i].'">';//安否アイコン
	echo  $count[$i]. '　</i></a></div>';//安否アイコン
	
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

</div>




