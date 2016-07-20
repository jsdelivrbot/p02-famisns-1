<?php 
include ('../inc/header_inc.php');
require_once('../inc/db_inc.php');

echo '<div class="page-header text-center"><h1>地域一覧</h1></div>';

$sql = "SELECT * FROM tb_user NATURAL JOIN tb_state ";//検索条件を適用したSQL文を作成

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

?>