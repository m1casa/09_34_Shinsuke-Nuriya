<?php
$id = $_GET["id"];

//1.  DB接続
include("bm_functions.php");
$pdo = db_dev10();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id"); 
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
  <title>ユーザー情報更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="bm_user_select.php">ユーザー情報更新</a></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_user_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー情報入力</legend>
     <label>ユーザー名：<input type="text" name="name" value="<?=$result["name"]?>"></label><br>
     <label>ID：<input type="text" name="lid" value="<?=$result["lid"]?>"></label><br>
     <label>PW：<input type="text" name="lpw" value="<?=$result["lpw"]?>"></label><br>
     <label>管理者フラグ：<input type="text" name="kanri_flg" value="<?=$result["kanri_flg"]?>"></label><br>
     <label>有効性：<input type="text" name="life_flg" value="<?=$result["life_flg"]?>"></label><br>
     <input type="submit" value="送信">
     <input type="hidden" name="id" value="<?=$result["id"]?>"> 
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>