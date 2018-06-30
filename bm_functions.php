<?php

//DB接続関数（PDO）
function db_conn(){
  try {
    return new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
}

function db_dev10(){
  $dbname='gs_db_dev10';
  try {
    $pdo = new PDO('mysql:dbname='.$dbname.';charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
  return $pdo; //追記2018.6.9.
}

//SQL処理エラー
function errorMsg($stmt){
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);      
}

function queryError($stmt){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

function h($str){
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

//SESSIONチェック&レジェネレイト（ログインしないと見れないページにする）
function chk_ssid(){
  if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){ 
    exit("Login Error.");  
  }else{
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
  }
}

?>