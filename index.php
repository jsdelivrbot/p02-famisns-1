<?php
include ('inc/header_inc.php');
require_once('inc/db_inc.php');
if(!isset($_SESSION['UTID'])){
	header('Location:login.php');
	exit(); //処理中止
}else{
require_once('function.php');
$query = "SELECT * FROM `tb_user`  WHERE `HOME_ID`='{$hid}'";
$rs = mysql_query($query);
if(!$rs){
	die('エラー: ' . h(mysql_error()));
}

$emergency = 0;
if(isset($_SESSION['AID'])){
	$aid = $_SESSION['AID'];
	$sql = "SELECT * FROM tb_area WHERE AREA_ID='$aid'";
	//echo $sql;
	$rs = mysql_query($sql);
	if(!$rs) die('エラー: ' . h(mysql_error()));
	$row = mysql_fetch_array($rs);
	if($row){
		$emergency = $row['EMERGENCY'];
	}
}
//echo $emergency;

$query2 = "SELECT * FROM `tb_user` NATURAL JOIN tb_state NATURAL JOIN tb_condition WHERE `HOME_ID`='{$hid}' ORDER BY `USER_ID` ASC ";
$rs2 = mysql_query($query2);
if(!$rs2){
  die('エラー: ' . h(mysql_error()));
}

$query3 = "SELECT USER_ID FROM `tb_user` NATURAL JOIN tb_state NATURAL JOIN tb_condition WHERE `HOME_ID`='{$hid}'";
$rs3 = mysql_query($query3);
if(!$rs3){
	die('エラー: ' . h(mysql_error()));
}
while($row3 = mysql_fetch_array($rs3)){
	$uid3[]=$row3['USER_ID'];
}
$uidsql="";
for($i=0;$i<count($uid3);$i++){
	if($i==count($uid3)-1){
		$uidsql .= $uid3[$i];
	}else{
		$uidsql .= $uid3[$i];
	}
}

$query5 = "SELECT COUNT(*)AS COUNT FROM `tb_user`  WHERE `HOME_ID`='{$hid}'";
$rs5 = mysql_query($query5);
if(!$rs5){
	die('エラー: ' . h(mysql_error()));
}
$row5 = mysql_fetch_array($rs5);
$cnt2=$row5['COUNT'];
if($cnt2<=3){
	$offmd="col-md-offset-3";
	$md="col-md-6";
	$mdd="col-md-4";
	$smd="col-sm-4";
}else if($cnt2==4){
	$offmd="col-md-offset-2";
	$md="col-md-8";
	$mdd="col-md-3";
	$smd="col-sm-3";
}else{
	$offmd="col-md-offset-0";
	$md="col-md-12";
	$mdd="col-md-2";
	$smd="col-sm-2";
}
?>

	<div class="page-header text-center">
    <h1>家族トップ</h1>
    </div>

	<div class="<?= $offmd." ".$md ?>">
	<div class="panel panel-primary">
	<div class="panel-heading text-center">家族メンバーの現在状況</div>
		<div class="row">
			<?php
			$cnt=0;
			while($row2 = mysql_fetch_array($rs2)){
			?>
			  <div class="col-xs-12 <?= $smd." ".$mdd ?>">
			    <div class="thumbnail">
			      <div class="text-center">
			      	<h4><img src="img/<?= $row2['KIBUN_ID'] ?>.png" class="img-thumbnail">
			      	<?php echo $row2['NAME']; ?></h4>
			      </div>

			       <div class="text-center">
			       <?php
			        $u = $row2['USER_ID']; 
			        if($emergency>0) echo '<a href="safe_report.php?u='.$u.'&r=1" class="btn btn-danger">SOS</a>  ';
					if($emergency>0) echo '<a href="safe_report.php?u='.$u.'&r=2" class="btn btn-success">無 事</a>';
			       ?>  
			       </div>
			       <br>
			       <div class="col-xs-4 col-sm-12 col-md-12"><?php uimg($row2['HOME_ID'],$row2['USER_ID']); ?></div>
			    
			      <div class="caption">
			        <p>現在地：
			        <?php
			        if($row2['LOCATION']==""){
			        	echo"登録なし";
			        }else{
			        	echo $row2['LOCATION'];
			        }
			        ?>
			        </p>
			        <p>体調：
			        <?php
			        if($row2['CONDITIONNAME']==""){
			        	echo"登録なし";
			        }else{
			        	echo $row2['CONDITIONNAME'];
			        }
			        ?>
			        </p>
			        <p class="text-center"><?php echo $row2['COMMENT']; ?></p>
			        <?php
			        //安否確認機能
			        $icons=array('envelope','ambulance','heart');//アイコンの配列
					$colors=array('gray','red','green');//色の配列
					$safe=array('不明','SOS','無事');
					$report=$row2['REPORT'];
			        $i=$row2['SAFE'];
			        //echo $safe; 
			        
			        echo "<p>安否状況:". $safe[$i]. "<br>";
			        
			        $time=$row2['UPDATE'];
			        //echo $time;
					echo '<i class="fa fa-'.$icons[$i].'" style="font-size:60px;color:'.$colors[$i].'"></i>';//安否アイコン
			        ?>
			        <p class="well well-sm"><?php echo $report;?></p>
			       
			      </div>
			    </div>
			  </div>
			<?php
			if($cnt==5 || $cnt==8 || $cnt==11){
			?>
				</div>
				<div class="row">
			<?php
			}
			$cnt++;
			}

			if($cnt==0){
				while($row = mysql_fetch_array($rs)){
			?>
			<div class="col-xs-12 <?= $smd." ".$mdd ?>">
			<div class="thumbnail">
			<div class="text-center"><h4><?php echo $row['NAME'] ?></h4></div>
				<div class="col-xs-4 col-sm-12 col-md-12"><img src="img/sample1.png" class="img-thumbnail"></div>


				<div class="caption">
				<p>現在地：登録なし</p>
				<p>体調：登録なし</p>
				</div>
				</div>
				</div>
			<?php
			if($cnt==5 || $cnt==8 || $cnt==11){
			?>
				</div>
				<div class="row">
			<?php
			}
			$cnt++;
				}
			}

//}
			if($cnt2!=$cnt){
				$query4 = "SELECT NAME,USER_ID FROM tb_user WHERE `HOME_ID`='{$hid}' AND `USER_ID` NOT IN('{$uidsql}')";
				$rs4 = mysql_query($query4);
			while($row4 = mysql_fetch_array($rs4)){
			?>
			  <div class="col-xs-12 <?= $smd." ".$mdd ?>">
			    <div class="thumbnail">
			      <div class="text-center"><h4><?php echo $row4['NAME']; ?></h4></div>
			      <div class="col-xs-4 col-sm-12 col-md-12"><?php uimg($row4['HOME_ID'],$row4['USER_ID']); ?></div>

			      <div class="caption">
			        <p>現在地：
			        <?php
			        if($row4['LOCATION']==""){
			        	echo"登録なし";
			        }else{
			        	echo $row4['LOCATION'];
			        }
			        ?>
			        </p>
			        <p>体調：
			        <?php
			        if($row4['CONDITIONNAME']==""){
			        	echo"登録なし";
			        }else{
			        	echo $row4['CONDITIONNAME'];
			        }
			        ?>
			        </p>
			        <p class="text-center"><?php echo $row4['COMMENT']; ?></p>

			      </div>
			    </div>
			  </div>
			<?php
			if($cnt==5 || $cnt==8 || $cnt==11){
			?>
				</div>

				<div class="row">
			<?php
			}
			$cnt++;
			}}
			?>
		</div>
    </div>
    </div>


    <div class="col-sm-offset-3 col-sm-6 well well-sm">
    <div class="text-center"><strong>家族チャット</strong></div>
    <textarea class="form-control text-left"; id="textarea_log" style="width:100%; height:100px; overflow:auto; background-image:url('');" readonly></textarea>
		<div class="input-group">
		  <input type="hidden" id="input_name" value="<?= $uname ?>">
		  <input id="input_remark" type="text" class="form-control">
		  <span class="input-group-btn">
			<input type="button" id="button_send" class="btn btn-default" value="送信">
			<input type="button" id="button_update" class="btn btn-default" value="更新">
		  </span>
		</div>
    </div>

<?php } ?>


<?php include('inc/footer_inc.php'); ?>