<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 20px;
    }

    .jumbotron {
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
  </style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="select.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="container">
  <div class="jumbotron">
    <form method="post" action="insert.php">
      <fieldset>
        <legend>書籍データベース</legend>
        <div class="form-group">
          <label for="bookname">書籍名：</label>
          <input type="text" id="bookname" name="bookname" class="form-control">
        </div>
        <div class="form-group">
          <label for="bookurl">書籍URL：</label>
          <input type="text" id="bookurl" name="bookurl" class="form-control">
        </div>
        <div class="form-group">
          <label for="bookcomment">コメント：</label>
          <textarea id="bookcomment" name="bookcomment" rows="4" class="form-control"></textarea>
        </div>
        <input type="submit" value="送信" class="btn btn-primary">
      </fieldset>
    </form>
  </div>
</div>
<!-- Main[End] -->

</body>
</html>
