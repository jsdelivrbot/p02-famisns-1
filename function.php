<?php
//require_once('inc/header_inc.php');
$loginid = $_SESSION['UID'];
//完了or未完了の表示
function dispFinish($id,$hwname,$num,$sww){//[0:TODO 1:家事管理]
	if($num==0){
		if($sww==0){
			$act="todo_update.php";
		}else{
			$act="housework_update.php";
		}
?>
	<!-- ここから -->
	<!-- 切り替えボタンの設定 -->
	<a data-toggle="modal" href="#<?= $id ?>"class="btn btn-danger btn-xs pull-right">未完了</a>
	<!-- モーダルの設定 -->
	<div class="modal fade" id="<?= $id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">閉じる</span></button>
	<h4 class="modal-title" id="myModalLabel">「<?= $hwname ?>」の完了</h4>
	</div>
	<div class="modal-body">
	<p>本当に「<?= $hwname ?>」を完了しますか？</p>
	</div>
	<div class="modal-footer">
	<form action="<?= $act ?>" method="post">
		<input type="hidden" name="id" value="<?= $id ?>" />
		<input type="hidden" name="sww" value="<?= $sww ?>" />
		<button type="submit" class="btn btn-primary">完了</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
	</form>
	</div>
	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<br>
	<!-- ここまで -->


<?php
	}else{
		echo '<input type="button" class="btn btn-success btn-xs pull-right" value="完了">';
	}
}



function modal($hid,$name,$hname,$school,$preschool,$sw2){//$sw[0:申請 1:承認 2:申請取消  3:なし]
	if($sw2==0){
		$action="matching_add.php";
	}else if($sw2==1){
		$action="matching_ok.php";
	}else if($sw2==2){
		$action="matching_cancel.php";
	}

$query5 = "SELECT COUNT(*) AS COUNT, HOME_ID, IMAGE, COMMENT FROM  `tb_homeprof` WHERE `HOME_ID`='{$hid}'";
$rs5 = mysql_query($query5);
if(!$rs5){
	die('エラー: ' . h(mysql_error()));
}
$row5 = mysql_fetch_array($rs5);
/*
	$himgname=$_SERVER['DOCUMENT_ROOT']."/~k12jk082/pbs-deploy/family/".$row5['IMAGE'];
	$noimg=$_SERVER['DOCUMENT_ROOT']."/~k12jk082/pbs-deploy/family/homeimg/nohome.png";
*/


?>
	<!-- ここから -->
	<!-- 切り替えボタンの設定 -->
	<a data-toggle="modal" href="#<?= $hid ?>"class="center-block btn btn-default"><?= $hname ?>（代表者：<?= $name ?>）</a>
	<!-- モーダルの設定 -->
	<div class="modal fade" id="<?= $hid?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">閉じる</span></button>
	<h4 class="modal-title" id="myModalLabel"><?= $hname ?>（代表者：<?= $name ?>）</h4>
	</div>
	<div class="modal-body">
	   	<div class="media">
    	<!-- 1.画像の配置 -->
    	<div class="col-md-3">
    	<?php
    	if($row5['COUNT']==0){
    	?>
    		<a href="<?=FAMISNS_ROOT ?>/family/homeimg/nohome.png" class="thumbnail"><img src="<?=FAMISNS_ROOT ?>/family/homeimg/nohome.png"></a>
    	<?php
    	}else{
    	?>
    		<a href="<?=FAMISNS_ROOT ?>/family/<?= $row5['IMAGE'] ?>" class="thumbnail"><img src="<?=FAMISNS_ROOT ?>/family/<?= $row5['IMAGE'] ?>"></a>
    	<?php } ?>
    	</div>
    	<!-- 2.画像の説明 -->
    	<div class="media-body">
    	<?php
    	if($row5['COMMENT']!=NULL){
    		echo nl2br($row5['COMMENT']);
    	}else{
    		echo "コメントなし";
    	}
    	?>
    	</div>
	</div>
	<p>関係のある学校名：<?= $school ?></p>
	<p>関係のある保育園：<?= $preschool ?></p>
	</div>
	<div class="modal-footer">
	<form action="<?php echo $action; ?>" method="post">
		<input type="hidden" name="to_hid" value="<?= $hid ?>" />
		<?php
		if($sw2==0){
		?>
			<button type="submit" class="btn btn-primary">申請</button>
		<?php
		}else if($sw2==1){
		?>
			<button type="submit" class="btn btn-primary">承認</button>
		<?php
		}else if($sw2==2){
		?>
			<button type="submit" class="btn btn-primary">申請取消</button>
		<?php
		}
		?>
		<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
	</form>
	</div>
	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<br>
	<!-- ここまで -->
<?php
}
?>

<?php
function article_comment($sql_post,$sql_comment,$sw,$loginuid,$loginhid){//$sw[0:post 1:album]
	if($sw==0){
		$action2="areatop_p_comment.php";
	}else if($sw==1){
		$action2="album_comment.php";
	}
?>

<?php

$query = "{$sql_post}";
$rs = mysql_query($query);
if(!$rs){
	die('エラー: ' . h(mysql_error()));
}


$query3 = "{$sql_comment}";
$rs3 = mysql_query($query3);
if(!$rs3){
	die('エラー: ' . h(mysql_error()));
}

//コメントを配列にいれる
while($row3 = mysql_fetch_array($rs3)){
	$tnumid[]=$row3['TARGETNUM_ID'];
	$pname[]=$row3['NAME'];
	$cpid[]=$row3['USER_ID'];
	$cdetail[]=$row3['C_DETAIL'];
	$cptime[]=$row3['C_POSTTIME'];
}
?>
<!-- 記事の表示 -->
<?php
while($row = mysql_fetch_array($rs)){
	$uid10=$row['USER_ID'];
	$hid9=$row['HOME_ID'];
if($sw==0){
	$ok=0;
	if($row['SHARE']==0){//全員に公開
		$ok=1;
	}else if($row['SHARE']==1){//ご近所さんのみ公開
		$query9 = "SELECT COUNT(*)AS COUNT FROM `tb_demand` WHERE
					((`FROM_ID`='{$loginhid}' AND `TO_ID`='{$hid9}')OR
					(`FROM_ID`='{$hid9}' AND `TO_ID`='{$loginhid}'))AND
					`STATE`='1'";
		$rs9 = mysql_query($query9);
		if(!$rs9){
			die('エラー: ' . h(mysql_error()));
		}
		$row9 = mysql_fetch_array($rs9);
		if($row9['COUNT']!=0 || $hid9==$loginhid){
			$ok=1;
		}
	}else if($row['SHARE']==2){//フレンドのみ公開
		$query10 = "SELECT COUNT(*)AS COUNT FROM `tb_fdemand` WHERE
					((`FROM_UID`='{$loginuid}' AND `TO_UID`='{$uid10}')OR
					(`FROM_UID`='{$uid10}' AND `TO_UID`='{$loginuid}'))AND
					`STATE`='1'";
		$rs10 = mysql_query($query10);
		if(!$rs10){
			die('エラー: ' . h(mysql_error()));
		}
		$row10 = mysql_fetch_array($rs10);
		if($row10['COUNT']!=0 || $loginuid==$uid10){
			$ok=1;
		}
	}else if($row['SHARE']==3){//ご近所とフレンドのみ公開
		$query9 = "SELECT COUNT(*)AS COUNT FROM `tb_demand` WHERE
					((`FROM_ID`='{$loginhid}' AND `TO_ID`='{$hid9}')OR
					(`FROM_ID`='{$hid9}' AND `TO_ID`='{$loginhid}'))AND
					`STATE`='1'";
		$rs9 = mysql_query($query9);
		if(!$rs9){
			die('エラー: ' . h(mysql_error()));
		}
		$row9 = mysql_fetch_array($rs9);
		$query10 = "SELECT COUNT(*)AS COUNT FROM `tb_fdemand` WHERE
					((`FROM_UID`='{$loginuid}' AND `TO_UID`='{$uid10}')OR
					(`FROM_UID`='{$uid10}' AND `TO_UID`='{$loginuid}'))AND
					`STATE`='1'";
		$rs10 = mysql_query($query10);
		if(!$rs10){
			die('エラー: ' . h(mysql_error()));
		}
		$row10 = mysql_fetch_array($rs10);

		if(($row10['COUNT']!=0 || $row9['COUNT']!=0) || $hid9==$loginhid){
			$ok=1;
		}
	}
}else if($sw==1){
	$ok=1;
}



if($ok==1){
?>
<div class="panel panel-info">
  <div class="panel-heading">
  	<?php $loginid = $_SESSION['UID']; userprof($loginid,$row['USER_ID'],0);?>：
  	<?php if($sw==0){ echo "<strong>".$row['P_TITLE']."</strong>";}else if($sw==1){ echo "<strong>".$row['AL_TITLE']."</strong>";} ?>
  </div>
  <div class="panel-body">
    <?php
    if($row['IMAGE']==""){
    	if($sw==0){ echo nl2br($row['P_DETAIL']);}else if($sw==1){ echo nl2br($row['AL_DETAIL']);}
    }else{
	?>
   	<div class="media">
    	<!-- 1.画像の配置 -->
    	<div class="col-md-4">
    		<a href="<?php echo $row['IMAGE'];?>" class="thumbnail"><img src="<?php echo $row['IMAGE'];?>"></a>
    	</div>
    	<!-- 2.画像の説明 -->
    	<div class="media-body">
	    	<?php
	    	if($sw==0){ echo  "<h4>".nl2br($row['P_DETAIL'])."</h4>";}else if($sw==1){ echo "<h4>".nl2br($row['AL_DETAIL'])."</h4>";}
	    	?>
    	</div>
   </div>
    <?php
    }
    ?>
  <div class="pull-right"><?php if($sw==0){ echo "<small>[".$row['P_POSTTIME']."]</small>";}else if($sw==1){ echo "<small>[".$row['AL_POSTTIME']."]</small>";} ?></div>
  </div>


<div class="panel-footer">
<?php
$date=date( "Y-m-d H:i:s", time() );//現在日時の取得
//コメントの表示
for($i=0;$i<count($tnumid);$i++){
	if($sw==0){
		$id=$row['POST_ID'];
	}else if($sw==1){
		$id=$row['ALBUM_ID'];
	}

	if($tnumid[$i]==$id){
		if(((strtotime($date) - strtotime($cptime[$i])) / ( 60 * 60 * 24))>=1){
			$t=floor(((strtotime($date) - strtotime($cptime[$i])) / ( 60 * 60 * 24)))."日前";
		}else{
			$t= floor((strtotime($date) - strtotime($cptime[$i])) / ( 60 ));
			if($t<60){
				$t.="分前";
			}else{
				$t = floor(($t / 60))."時間前";
			}
		}
		echo /*$pname[$i]*/ userprof($loginid,$cpid[$i],0) ."：".$cdetail[$i]."　(".$t.")"."<br>";
	}

}
?>
<!-- モーダルのボタン -->
<div class="text-right">
<?php
$d="del";
if($loginuid==$row['USER_ID']){ ?>
<a data-toggle="modal" href="<?php if($sw==0){ echo "#".$row['POST_ID'].$d;}else if($sw==1){ echo "#".$row['ALBUM_ID'].$d;} ?>" class="btn btn-danger btn-xs">記事削除</a>
<?php } ?>
<a data-toggle="modal" href="<?php if($sw==0){ echo "#".$row['POST_ID'];}else if($sw==1){ echo "#".$row['ALBUM_ID'];} ?>" class="btn btn-primary btn-xs">コメントする</a>
</div>
<!-- モーダルのボタン -->
<!-- モーダルここから --><!-- モーダルここから --><!-- モーダルここから -->
<!-- モーダルの設定 -->
<div class="modal fade" id="<?php if($sw==0){ echo $row['POST_ID'].$d;}else if($sw==1){ echo $row['ALBUM_ID'].$d;} ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">閉じる</span></button>
<h4 class="modal-title" id="myModalLabel"><?php echo $row['NAME']?>：「<?php if($sw==0){ echo $row['P_TITLE'];}else if($sw==1){ echo $row['AL_TITLE'];} ?>」の削除</h4>
</div>
<div class="modal-body">
本当に削除してよろしいですか？
<form class="form-horizontal" action="../article_deleate.php" method="post" >
	<div class="text-center">
		<input type="hidden" name="did" value="<?php if($sw==0){ echo $row['POST_ID'];}else if($sw==1){ echo $row['ALBUM_ID'];} ?>" />
		<input type="hidden" name="sw" value="<?php echo $sw; ?>" />
		<button type="submit" class="btn btn-danger">削除</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
	</div>
</form>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- モーダルここまで --><!-- モーダルここまで --><!-- モーダルここまで -->


<!-- モーダルここから --><!-- モーダルここから --><!-- モーダルここから -->
<!-- モーダルの設定 -->
<div class="modal fade" id="<?php if($sw==0){ echo $row['POST_ID'];}else if($sw==1){ echo $row['ALBUM_ID'];} ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">閉じる</span></button>
<h4 class="modal-title" id="myModalLabel"><?php echo $row['NAME']?>：「<?php if($sw==0){ echo $row['P_TITLE'];}else if($sw==1){ echo $row['AL_TITLE'];} ?>」へのコメント</h4>
</div>
<div class="modal-body">

<form class="form-horizontal" action="<?php  echo $action2; ?>" method="post" >
  <div class="form-group">
    <label class="col-sm-3 control-label" for="title">コメント：</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="comment">
    </div>
  </div>
	<div class="text-center">
		<input type="hidden" name="did" value="<?php if($sw==0){ echo $row['POST_ID'];}else if($sw==1){ echo $row['ALBUM_ID'];} ?>" />
		<button type="submit" class="btn btn-primary">投稿</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
	</div>
</form>
</div>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- モーダルここまで --><!-- モーダルここまで --><!-- モーダルここまで -->
</div>
<?php
}
//<!-- 記事の表示　ここまで -->
}
}
?>







<?php
function post($button_name,$title,$action,$s){//[0:記事用 1:アルバム用]
?>



<!-- 切り替えボタンの設定 -->
<a data-toggle="modal" href="#myModal" class="center-block btn btn-primary"><?= $button_name ?></a>
<!-- モーダルの設定 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">閉じる</span></button>
        <h4 class="modal-title" id="myModalLabel"><?= $title ?></h4>
      </div>
      <div class="modal-body">

		<form class="form-horizontal" action="<?= $action ?>" method="post" enctype="multipart/form-data">
		  <fieldset>

		    <!-- ラベルとコントロールの表示 -->
		    <div class="form-group">
		      <label for="name" class="col-sm-3 control-label text-right">タイトル：</label>
		      <div class="col-sm-4">
		      	<input type="text" class="form-control" name="title">
		      </div>
		    </div>


			  <div class="form-group">
			    <label class="col-sm-3 control-label" for="text">内容：</label>
			    <div class="col-sm-5">
			      <textarea class="form-control" name="detail"></textarea>
			    </div>
			  </div>


		    <div class="form-group">
		      <label for="name" class="col-sm-3 control-label text-right">画像(JPG)：</label>
		      <div class="col-sm-4">
		      	<input type="file" name="upfile" size="30" />
		      </div>
		    </div>

<?php if($s==0){ ?>
			  <div class="form-group">
			    <label class="col-sm-3 control-label"  for="share">公開範囲：</label>
			    <div class="col-sm-4">
				<select class="form-control" name="share">
					<option value='0' selected>全員</option>
					<option value='1'>ご近所さんのみ</option>
					<option value='2'>フレンドのみ</option>
					<option value='3'>ご近所さんとフレンド</option>
				</select>
			    </div>
			  </div>
<?php } ?>
		    <!-- 登録ボタンの表示 -->
		    <div class="text-center">
		    <button type="submit" class="btn btn-primary">投稿</button>
		    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
		    </div>
		  </fieldset>
		</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php
}
?>


<?php
function userprof($loginid2,$uid,$sw2){//$sw[0:申請 1:承認 2:申請取消  3:なし 4:フレンドリスト用]
	if($sw2==0){
		$action="../mypage/friend_add.php";
	}else if($sw2==1){
		$action="friend_ok.php";
	}else if($sw2==2){
		$action="friend_cancel.php";
	}


$query6 = "SELECT COUNT(*)AS COUNT,USER_ID,NAME,U_IMAGE,COMMENT,HOBBY FROM `tb_userprof` NATURAL JOIN tb_user WHERE `USER_ID`='{$uid}'";
$rs6 = mysql_query($query6);
if(!$rs6){
	die('エラー: ' . h(mysql_error()));
}
$row6 = mysql_fetch_array($rs6);

$query8 = "SELECT COUNT(*)AS COUNT FROM `tb_fdemand` WHERE (`FROM_UID`='{$loginid2}' AND `TO_UID`='{$uid}') OR (`FROM_UID`='{$uid}' AND `TO_UID`='{$loginid2}')";
$rs8 = mysql_query($query8);
if(!$rs8){
	die('エラー: ' . h(mysql_error()));
}
$row8 = mysql_fetch_array($rs8);

//$uimgname=$_SERVER['DOCUMENT_ROOT']."/~k12jk082/pbs-deploy/mypage/".$row6['U_IMAGE'];
//$noimg=$_SERVER['DOCUMENT_ROOT']."/~k12jk082/pbs-deploy/img/sample1.png";
if($sw2!=0){
	$btn = "center-block btn btn-default";
}else{
	$btn = "btn btn-link btn-xs";
}


?>
	<!-- ここから -->
	<!-- 切り替えボタンの設定 -->
	<a data-toggle="modal" href="#<?= $uid ?>"class="<?= $btn ?>"><?= $row6['NAME'] ?></a>
	<!-- モーダルの設定 -->
	<div class="modal fade" id="<?= $uid?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">閉じる</span></button>
	<h4 class="modal-title" id="myModalLabel"><?= $row6['NAME'] ?></h4>
	</div>
	<div class="modal-body">
	   	<div class="media">
    	<!-- 1.画像の配置 -->
    	<div class="col-md-3">
    	<?php
    	if($row6['COUNT']==0){
    	?>
    		<a href="<?=FAMISNS_ROOT ?>/img/sample1.png" class="thumbnail"><img src="<?=FAMISNS_ROOT ?>/img/sample1.png"></a>
    	<?php
    	}else{
    		if($row6['U_IMAGE']==""){
    	?>
    		<a href="<?=FAMISNS_ROOT ?>/img/sample1.png" class="thumbnail"><img src="<?=FAMISNS_ROOT ?>/img/sample1.png"></a>
    	<?php
    		}else{
    	?>

    			<a href="<?=FAMISNS_ROOT ?>/mypage/<?= $row6['U_IMAGE'] ?>" class="thumbnail"><img src="<?=FAMISNS_ROOT ?>/mypage/<?= $row6['U_IMAGE'] ?>"></a>
    	<?php
    		}
    	?>
    	<?php } ?>
    	</div>
    	<!-- 2.画像の説明 -->
    	<div class="media-body">
    	<?php
    	if($row6['COMMENT']!=NULL){
    		echo nl2br($row6['COMMENT']);
    	}else{
    		echo "コメントなし";
    	}
    	?>
    	</div>
	</div>
	<p>趣味：<?php if($row6['HOBBY']!=NULL){echo $row6['HOBBY'];}else{echo "未登録";} ?></p>
	</div>
	<div class="modal-footer">
	<form action="<?php echo $action; ?>" method="post">
		<input type="hidden" name="to_uid" value="<?= $uid ?>" />
		<input type="hidden" name="from_uid" value="<?= $loginid2 ?>" />
		<?php
		if($sw2==0){
			if($row8['COUNT']!=0){
		?>
			<button type="submit" class="btn btn-primary" disabled>申請済み</button>
		<?php
			}else if($loginid2==$uid){
				//自分のプロフならボタンを表示しない
			}else{
		?>
			<button type="submit" class="btn btn-primary">申請</button>
		<?php
			}
		}else if($sw2==1){
		?>
			<button type="submit" class="btn btn-primary">承認</button>
		<?php
		}else if($sw2==2){
		?>
			<button type="submit" class="btn btn-primary">申請取消</button>
		<?php
		}
		?>
		<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
	</form>
	</div>
	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- ここまで -->
<?php
}
?>





<?php
function uimg($hid,$uid){
$query7 = "SELECT COUNT(*)AS COUNT,HOME_ID,USER_ID,U_IMAGE FROM `tb_userprof` NATURAL JOIN tb_user WHERE `HOME_ID`='{$hid}' AND `USER_ID`='{$uid}'";
$rs7 = mysql_query($query7);
if(!$rs7){
	die('エラー: ' . h(mysql_error()));
}
$row7 = mysql_fetch_array($rs7);
if($row7['COUNT']!=0 && $row7['U_IMAGE']!=NULL){
?>
	<a href="<?=FAMISNS_ROOT ?>/mypage/<?= $row7['U_IMAGE'] ?>" class="thumbnail"><img src="<?=FAMISNS_ROOT ?>/mypage/<?= $row7['U_IMAGE']?>" height=100></a>
<?php
}else{
?>
	<a href="<?=FAMISNS_ROOT ?>img/sample1.png" class="thumbnail"><img src="<?=FAMISNS_ROOT ?>/img/sample1.png" height=100></a>
<?php
}
}

?>
