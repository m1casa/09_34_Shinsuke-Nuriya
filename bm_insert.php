<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["url"]) || $_POST["url"]=="" ||
  !isset($_POST["cmts"]) || $_POST["cmts"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$name = $_POST["name"];
$url = $_POST["url"];
$cmts = $_POST["cmts"];

//2. DB接続します(エラー処理追加)
include("bm_functions.php");
$pdo = db_conn(); 

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id,name,url,cmts,indate)VALUES(NULL,:a1,:a2,:a3,sysdate())");
$stmt->bindValue(':a1',$name);
$stmt->bindValue(':a2',$url);
$stmt->bindValue(':a3',$cmts);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  errorMsg($stmt);
}else{
//５．bm_index.phpへリダイレクト
  header("Location: bm_select.php");
  exit;
}
?>