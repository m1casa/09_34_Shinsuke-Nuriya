<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["lid"]) || $_POST["lid"]=="" ||
  !isset($_POST["lpw"]) || $_POST["lpw"]=="" ||
  !isset($_POST["kanri_flg"]) || $_POST["kanri_flg"]=="" ||
  !isset($_POST["life_flg"]) || $_POST["life_flg"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$name = $_POST["name"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];

//2. DB接続
include("bm_functions.php");
$pdo = db_dev10(); 

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table(id, name, lid, lpw, kanri_flg, life_flg, indate)VALUES(NULL,:a1,:a2,:a3,:a4,:a5,sysdate())");
$stmt->bindValue(':a1',$name);
$stmt->bindValue(':a2',$lid);
$stmt->bindValue(':a3',$lpw);
$stmt->bindValue(':a4',$kanri_flg);
$stmt->bindValue(':a5',$life_flg);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  errorMsg($stmt);
}else{
  //５．user_index.phpへリダイレクト
  header("Location: bm_user_select.php");
  exit;
}
?>