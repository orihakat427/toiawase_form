<?php

//フォームからPOST送信で受け取った情報をサニタイズして変数に代入
  $nickname = htmlspecialchars($_POST['nickname']);
  $email = htmlspecialchars($_POST['email']);
  $content = htmlspecialchars($_POST['content']);

// 1. データベース接続（スペースを空けて書かない）
  $dsn = 'mysql:dbname=phpkiso;host=localhost';
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');

// ２．SQL文を実行する
  $sql = "INSERT INTO `phpkiso` (`id`, `nickname`, `email`, `content`) VALUES (NULL, 'test', 'test@yahoo.co.jp', 'テスト');";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

// ３．データベースを切断する（メモリを食うのでメモリリークになる）
  $dbh = null;

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>送信完了</title>
</head>
<body>
  <h1>お問い合わせありがとうございました！</h1>
  <div>
    <h3>お問い合わせ詳細内容</h3>
    <p>ニックネーム：<?php echo $nickname; ?></p>
    <p>メールアドレス：<?php echo $email; ?></p>
    <p>お問い合わせ内容：<?php echo $content; ?></p>
  </div>
</body>
</html>