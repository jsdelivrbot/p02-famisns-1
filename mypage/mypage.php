<?php
include ('../inc/header_inc.php');
require_once('../inc/db_inc.php');

$query = "SELECT * FROM tb_state NATURAL JOIN tb_condition WHERE USER_ID='{$uid}'";
$rs = mysql_query($query);
if(!$rs){
  die('エラー: ' . h(mysql_error()));
}
while($row = mysql_fetch_array($rs)){
	$location = $row['LOCATION'];
	$cid = $row['CONDITION_ID'];
	$kid = $row['KIBUN_ID'];
	$comment = $row['COMMENT'];
	$report = $row['REPORT'];
}

$query2 = "SELECT * FROM tb_condition";
$rs2 = mysql_query($query2);
if(!$rs2){
  die('エラー: ' . h(mysql_error()));
}

$query3 = "SELECT * FROM tb_todo WHERE USER_ID='{$uid}'";
$rs3 = mysql_query($query3);
if(!$rs3){
  die('エラー: ' . h(mysql_error()));
}

$query4 = "SELECT * FROM tb_kibun";
$rs4 = mysql_query($query4);
if(!$rs4){
  die('エラー: ' . h(mysql_error()));
}

if(!isset($_SESSION['UTID'])){
	header("Location: login.php") ;
	exit(); //処理中止
}else{
?>

	<div class="page-header text-center">
	<?php
	if($_SESSION['UTID']==0){
		echo "<h1>マイページ（代表者）</h1>";
	}else{
		echo "<h1>マイページ</h1>";
	}
	?>
    </div>



    <div class="col-sm-offset-3 col-sm-6 well well-sm">
    	<div class="panel panel-primary">
		  <div class="panel-heading">現在の状況</div>
		  <div class="panel-body">
			<form class="form-horizontal" action="nowedit.php" method="post">
			  <div class="form-group">
			    <label class="col-sm-3 control-label" for="name">名前：</label>
			    <div class="col-sm-9">
			    <p class="form-control-static"><?php echo $uname;?></p>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-3 control-label" for="comment">現在地：</label>
			    <div class="col-sm-7">
			      <input type="text" class="form-control" name="location" value="<?php echo $location ;?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-3 control-label" for="comment">一言コメント：</label>
			    <div class="col-sm-7">
			      <input type="text" class="form-control" name="comment" value="<?php echo $comment ;?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-3 control-label"  for="state">健康状態：</label>
			    <div class="col-sm-3">
				<select class="form-control" name="condition">
					<?php
					while($row2 = mysql_fetch_array($rs2)){
						$cid2=$row2['CONDITION_ID'];
						if($cid==$row2['CONDITION_ID']){
							echo "<option value='{$cid2}' selected>".$row2['CONDITIONNAME']."</option>";
						}else{
							echo "<option value='{$cid2}'>".$row2['CONDITIONNAME']."</option>";
						}
					}
					?>
				</select>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-3 control-label"  for="kibun">気分：</label>
			    <div class="col-sm-3">
				<select class="form-control" name="kibun">
					<?php
					while($row4 = mysql_fetch_array($rs4)){
						$kid4=$row4['KIBUN_ID'];
						if($kid==$row4['KIBUN_ID']){
							echo "<option value='{$kid4}' selected>".$row4['KIBUNNAME']."</option>";
						}else{
							echo "<option value='{$kid4}'>".$row4['KIBUNNAME']."</option>";
						}
					}
					?>
				</select>
			    </div>
			  </div>
			  <div class="form-group">
			  <label class="col-sm-3 control-label"  for="report">安否報告：</label>
			  <div class="col-sm-7">
			  <label class="radio-inline"><input type="radio" name="safe" value="2">無事</label>
			  <label class="radio-inline"><input type="radio" name="safe" value="1">SOS</label>
			  <input type="text" class="form-control" name="report" value="<?php echo $report ;?>">
			  </div>
			  </div>
			  <br>

			  <div class="text-center"><button type="submit" class="btn btn-default">更新</button></div>
			</form>
		  </div>
		</div>
    </div>

 
    <div class="col-sm-offset-3 col-sm-6 well well-sm">
		<div class="panel panel-primary">
		  <div class="panel-heading">TODOリスト<div class="text-right">完了数：１　未完了数：２　総合ポイント:１００Ｐｔ</div></div>
<?php
include('../function.php');
?>
		<ul class="list-group">
			<?php
			while($row3 = mysql_fetch_array($rs3)){
				echo '<li class="list-group-item">'.$row3['T_NAME'];
				dispFinish($row3['TODO_ID'],$row3['T_NAME'],$row3['T_FINISH'],0);
			}
			?>
		</ul>
		  <div class="panel-footer text-center">編集</div>
		</div>
    </div>
<?php }?>

<?php include('../inc/footer_inc.php'); ?>