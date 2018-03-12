<?php

  //POST送信が行われたらDB接続、データ取得
  if (isset($_POST) && !empty($_POST['content'])) {
  // １．データベースに接続する
  $content = $_POST["content"];
  $dsn = 'mysql:dbname=gs_db;host=localhost';
  $user = 'root';
  $password = '';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');

  // ２．SQL文を実行する
  $word = $_POST['content'];
  $sql = "SELECT * FROM `phpkiso`
          WHERE `content`
          LIKE '%{$word}%'";
  // var_dump($sql);

  // SQLを実行
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $survey_line = array();

  //データ取得
  while(1){
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  if($rec == false){
    break;
  }
  $survey_line[] = $rec;
  }

  // ３．データベースを切断する
  $dbh = null;
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>検索ページ</title>
  <meta charset="utf-8">
</head>
<body>
  <form action="" method="post">
    <p>検索したい言葉を入力してください。</p>
    <input type="text" name="content">
    <input type="submit" value="検索">
  </form>

  <!-- <?php if (isset($rec)){ ?>
	 <hr>
	  <?php echo $rec["id"]; ?><br>
	  <?php echo $rec["nickname"]; ?><br>
	  <?php echo $rec["email"]; ?><br>
	  <?php echo $rec["content"]; ?><br>
	  <?php echo $rec["created"]; ?><br>
  <?php } ?> -->

  <?php
  if (isset($survey_line)){
    foreach ($survey_line as $value) {
      echo "<hr>";
      echo $value["id"]."<br>";
      echo $value["nickname"]."<br>";
      echo $value["email"]."<br>";
      echo $value["content"]."<br>";
      echo $value["created"]."<br>";
    }
    echo "<hr>";
  }
   ?>

</body>
</html>
