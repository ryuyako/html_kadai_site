    <!-- <?php
    $file = fopen('data/data.txt', 'r'); // ファイルを開く

    // ファイル内容を1行ずつ読み込んで出力
    while ($str = fgets($file)) {
        echo nl2br($str); // nl2br() ... 改行文字を追加
    }
    fclose($file); // ファイルを閉じる
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>POST（受信）</title>
</head>
<body>
<ul>
<li><a href="index.php">index.php</a></li>
</ul>
</body>
</html> -->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>データ表示</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h1>好きな言語・苦手な言語</h1>
  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th>日時</th>
        <th>お名前</th>
        <th>メールアドレス</th>
        <th>好きな言語</th>
        <th>苦手な言語</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $file = fopen('data/data.txt', 'r');
      while ($str = fgets($file)) {
          $data = explode(',', $str);
          echo '<tr>';
          echo '<td>' . $data[0] . '</td>';
          echo '<td>' . $data[1] . '</td>';
          echo '<td>' . $data[2] . '</td>';
          echo '<td>' . $data[3] . '</td>';
          echo '<td>' . $data[4] . '</td>';
          echo '</tr>';
      }
      fclose($file);
      
      ?>
    </tbody>
  </table>
</div>
<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
