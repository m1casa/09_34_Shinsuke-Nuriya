<?php

//1. GETデータ取得
$id   = $_GET["id"];

//2. DB接続
include("bm_functions.php");
$pdo = db_dev10();

//３．データ登録SQL作成
$delete = $pdo->prepare("DELETE FROM gs_user_table WHERE id=:id");
$delete->bindValue(':id', $id);
$status = $delete->execute();

//４．データ登録処理後
if($status==false){
  errorMsg($stmt);
}else{
  //５．user_select.phpへリダイレクト
  header("Location: bm_user_select.php");
  exit;
}
?>