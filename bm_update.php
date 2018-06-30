<?php
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["url"]) || $_POST["url"]=="" ||
  !isset($_POST["cmts"]) || $_POST["cmts"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$id = $_POST["id"];
$name = $_POST["name"];
$url = $_POST["url"];
$cmts = $_POST["cmts"];

//2. DB接続します(エラー処理追加)
include("bm_functions.php");
$pdo = db_conn();

//３．データ登録SQL作成
$update = $pdo->prepare("UPDATE gs_bm_table SET name=:name, url=:url, cmts=:cmts WHERE id=:id");
$update->bindValue(':name',$name,PDO::PARAM_STR);
$update->bindValue(':url',$url,PDO::PARAM_STR);
$update->bindValue(':cmts',$cmts,PDO::PARAM_STR);
$update->bindValue(':id',$id,PDO::PARAM_INT);
$status = $update->execute();

//４．データ登録処理後
if($status==false){
  errorMsg($stmt);
}else{
//５．select_SN.phpへリダイレクト
  header("Location: bm_select.php");
  exit;
}
?>