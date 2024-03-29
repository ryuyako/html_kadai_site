<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$id = $_POST['id'];
$bookname = $_POST['bookname'];
$bookurl = $_POST['bookurl'];
$bookcomment = $_POST['bookcomment'];

//2. DB接続します
// YAKO1行追加
include("funcs.php");
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=ryuyako_bookmark;charset=utf8;host=mysql57.ryuyako.sakura.ne.jp','ryuyako','php02-bookmark');
  // $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DB Connection Error:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id,bookname,bookurl,bookcomment,indate)VALUES(:id, :bookname, :bookurl, :bookcomment, sysdate());");
$stmt->bindValue(':id', $id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookcomment', $bookcomment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
?>
