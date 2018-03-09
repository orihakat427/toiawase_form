<?php
// １．データベースに接続する
$dsn = 'mysql:dbname=gs_db;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

// ２．SQL文を実行する
$sql = 'SELECT * FROM `phpkiso`';
$stmt = $dbh->prepare($sql);
$stmt->execute();

//データ取得(fetch処理でデータを取得)
$survey_line = array();
while(1){
	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	if($rec == false){
		break;
	}
	$survey_line[] = $rec;
}

// ３．データベースを切断する
$dbh = null;

 ?>

 <?php
 	// var_dump($survey_line);
 foreach ($survey_line as $value) {
  ?>
  <?php echo $value["id"]; ?><br>
  <?php echo $value["nickname"]; ?><br>
  <?php echo $value["email"]; ?><br>
  <?php echo $value["content"]; ?><br>
  <hr>
 <?php
 }
  ?>