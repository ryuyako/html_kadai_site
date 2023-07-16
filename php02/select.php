<?php
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=ryuyako_bookmark;charset=utf8;host=mysql57.ryuyako.sakura.ne.jp','ryuyako','php02-bookmark');
} catch (PDOException $e) {
  exit('DB Connection Error:'.$e->getMessage());
}

//２．データ登録SQL作成
// $stmt = $pdo->prepare("INSERT INTO gs_bm_table(id,bookname,bookurl,bookcomment,indate)VALUES(:id, :bookname, :bookurl, :bookcomment, sysdate());");
// $status = $stmt->execute();
$sql = "SELECT * FROM gs_bm_table;";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


//３．データ表示
$table = "<table id='bookTable'>\n";
$table .= "<tr><th>ID</th><th>書籍名</th><th>URL</th><th>コメント</th><th>投稿日時</th></tr>\n";

if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $table .= "<tr>";
    $table .= "<td>" . $res['id'] . "</td>";
    $table .= "<td>" . $res['bookname'] . "</td>";
    $table .= "<td>" . $res['bookurl'] . "</td>";
    $table .= "<td>" . $res['bookcomment'] . "</td>";
    $table .= "<td>" . $res['indate'] . "</td>";
    $table .= "</tr>\n";
  }
}

$table .= "</table>";
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>本bookmark表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
 div {
      padding: 10px;
      font-size: 16px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .sortable {
      cursor: pointer;
    }

    .sorted-asc::after {
      content: ' ▲';
    }

    .sorted-desc::after {
      content: ' ▼';
    }

    #searchInput {
      margin-bottom: 10px;
    }
  </style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">登録書籍一覧</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
      <input type="text" id="searchInput" placeholder="検索キーワードを入力">
      <?=$table?>
    </div>
  </div>
<!-- Main[End] -->

<script>
    window.onload = function() {
      const table = document.getElementById('bookTable');
      const headers = table.getElementsByTagName('th');
      const searchInput = document.getElementById('searchInput');

      for (let i = 0; i < headers.length; i++) {
        headers[i].classList.add('sortable');
        headers[i].addEventListener('click', sortTable);
      }

      searchInput.addEventListener('input', function(event) {
        const filterValue = event.target.value.toLowerCase();
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
          const cells = rows[i].getElementsByTagName('td');
          let match = false;

          for (let j = 1; j < cells.length; j++) {
            const cellValue = cells[j].innerText.toLowerCase();

            if (cellValue.includes(filterValue)) {
              match = true;
              break;
            }
          }

          if (match) {
            rows[i].style.display = '';
          } else {
            rows[i].style.display = 'none';
          }
        }
      });

      function sortTable(event) {
        const header = event.target;
        const index = Array.prototype.indexOf.call(header.parentNode.children, header);
        const rows = Array.from(table.getElementsByTagName('tr')).slice(1);

        rows.sort(function(a, b) {
          const aValue = a.getElementsByTagName('td')[index].innerText.toLowerCase();
          const bValue = b.getElementsByTagName('td')[index].innerText.toLowerCase();

          if (header.classList.contains('sorted-asc')) {
            return aValue.localeCompare(bValue);
          } else {
            return bValue.localeCompare(aValue);
          }
        });

        if (header.classList.contains('sorted-asc')) {
          header.classList.remove('sorted-asc');
          header.classList.add('sorted-desc');
        } else {
          header.classList.remove('sorted-desc');
          header.classList.add('sorted-asc');
        }

        for (let i = 0; i < rows.length; i++) {
          table.appendChild(rows[i]);
        }
      }
    };
  </script>

</body>
</html>
