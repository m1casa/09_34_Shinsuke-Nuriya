<?php
//最初にSESSIONを開始！！
session_start();

//0.外部ファイル読み込み
include("bm_functions.php");

//1.  DB接続します
$pdo = db_dev10();
$lid = $_POST["lid"]; //追記
$lpw = $_POST["lpw"]; //追記

//2. データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid=:lid AND lpw=:lpw AND life_flg=0");
$stmt->bindValue(':lid',$lid);
$stmt->bindValue(':lpw',$lpw);
$res = $stmt->execute();

//3. SQL実行時にエラーがある場合
if($res==false){
  // $error = $stmt->errorInfo();
  // exit("QueryError:".$error[2]); //関数化↓
  queryError($stmt); //functions.phpにて関数化
}

//4. 抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法→通常ログインする場合には同じ人がいない為1レコード。

//5. 該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){
  $_SESSION["chk_ssid"]  = session_id(); //chk_ssidは、
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name']; //「●●さんこんにちは」等に使えて便利。
  header("Location: bm_select.php"); //表示先の場所の指定。半角スペース必須。
}else{
  //logout処理を経由して全画面へ
  header("Location: bm_login.php"); //エラーの場合、ログイン画面に戻す。半角スペース必須。
}

exit();
?>
