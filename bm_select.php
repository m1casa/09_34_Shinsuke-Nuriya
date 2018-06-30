<?php
session_start();

//0.外部ファイル読み込み
include("bm_functions.php");

//1.  DB接続
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  errorMsg($stmt);
}else{
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>';
    $view .= '<a href="bm_detail.php?id='.$result["id"].'">';
    $view .= $result["name"]." [".$result["indate"]."]<br>";
    $view .= '</a>';
    $view .= ' ';    
    $view .= '<a href="bm_delete.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .= '</p>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <?php echo $_SESSION["name"]; ?> さん、こんにちは。
      <?php if($_SESSION["kanri_flg"]==1){ ?>
      <a class="navbar-brand" href="bm_user_regist.php">ユーザー登録</a>
      <a class="navbar-brand" href="bm_user_select.php">ユーザー表示</a>
      <?php } ?>
      <a class="navbar-brand" href="bm_index.php">ブックマーク登録</a>
      <a class="navbar-brand" href="bm_select.php">ブックマーク一覧</a>
      <a class="navbar-brand" href="bm_logout.php">LOGOUT</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
  </div>
</div>
<!-- Main[End] -->

</body>
</html>