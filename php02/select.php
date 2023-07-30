<?php
// YAKO追加
//0. SESSION開始！！
session_start();

// 1. 関数読み込み
include("funcs.php");  //funcs.phpを読み込む（関数群）

// YAKO追加
//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

$pdo = db_conn();      //DB接続関数

//２．データ登録SQL作成
$stmt   = $pdo->prepare("SELECT * FROM gs_bm_table"); //SQLをセット
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

//３．データ表示
$view=""; //HTML文字列作り、入れる変数
if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  //SQL成功の場合
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ //データ取得数分繰り返す
    //以下でリンクの文字列を作成, $r["id"]でidをdetail.phpに渡しています
    $view .= '<a href="bm_update_view.php?id='.h($r["id"]).'">';
    $view .= h($r["id"])."|".h($r["bookname"])."|".h($r["bookurl"]);
    $view .= '</a>';
    $view .= '<a href="delete.php?id='.h($r["id"]).'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .= '<br>';

  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
      padding-top: 20px;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
    }

    legend {
      font-size: 18px;
      font-weight: bold;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 5px;
    }

    input[type="submit"] {
      margin-top: 10px;
    }

    .container.jumbotron {
      margin-top: 50px;
    }

    .container.jumbotron a {
      margin-right: 10px;
    }
  </style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      <a class="navbar-brand" href="login.php">ログイン</a>
      <a class="navbar-brand" href="logout.php">ログアウト</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>