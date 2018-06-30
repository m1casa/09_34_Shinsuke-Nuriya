<?php
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
$id = $_POST["id"];
$name = $_POST["name"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];

//2. DB接続
include("bm_functions.php");
$pdo = db_dev10();

//３．データ登録SQL作成
$update = $pdo->prepare("UPDATE gs_user_table SET name=:name, lid=:lid, lpw=:lpw, kanri_flg=:kanri_flg, life_flg=:life_flg WHERE id=:id");
$update->bindValue(':name',$name,PDO::PARAM_STR);
$update->bindValue(':lid',$lid,PDO::PARAM_STR);
$update->bindValue(':lpw',$lpw,PDO::PARAM_STR);
$update->bindValue(':kanri_flg',$kanri_flg,PDO::PARAM_STR);
$update->bindValue(':life_flg',$life_flg,PDO::PARAM_STR);
$update->bindValue(':id',$id,PDO::PARAM_INT);
$status = $update->execute();

//４．データ登録処理後
if($status==false){
  errorMsg($stmt);
}else{
  //５．user_select.phpへリダイレクト
  header("Location: bm_user_select.php");
  exit;
}
?>