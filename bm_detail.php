<?php
$id = $_GET["id"];

//1.  DB接続
include("bm_functions.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id"); 
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  errorMsg($stmt);
}else{
  $result = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ブックマーク詳細</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="bm_select.php">ブックマーク詳細</a></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ブックマーク情報入力</legend>
     <label>書籍名：<input type="text" name="name" value="<?=$result["name"]?>"></label><br>
     <label>書籍URL：<textarea name="url" rows="1" cols="30"><?=$result["url"]?></textArea></label><br>
     <label>書籍コメント：<textArea name="cmts" rows="4" cols="40"><?=$result["cmts"]?></textArea></label><br>
     <input type="submit" value="更新">
     <input type="hidden" name="id" value="<?=$result["id"]?>"> 
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>