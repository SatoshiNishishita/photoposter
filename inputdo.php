<?php
ini_set('display_errors', 'on');
?>

<?php

//photoposterのトップ画面で投稿された情報をDBに保存して、画面に表示するphpファイル

//DBに接続
require('dbconnect.php');

// MySQLとの接続をオープンにする
$db = mysql_connect($DBSERVER, $DBUSER, $DBPASSWORD) or die(mysql_error());

// データをUTF8で受け取る
mysql_query("SET NAMES UTF8");

// データベースを選択する
$selectdb = mysql_select_db($DBNAME, $db);

?>

<?php

//DBのphotoposter_postテーブルから一番数の大きいプライマリーキーの情報を取り出す。
//この数字に+1を足してファイルパスに付け足して撮影された写真のファイル名の差別化をする
$recordSet = mysql_query("SELECT id FROM photoposter_post ORDER BY id DESC LIMIT 1",$db);
$data = mysql_fetch_assoc($recordSet);
//テーブル内のプライマリーキーの一番大きい値を変数に代入して1足す
$insert_data = $data['id'];
$path_data = $insert_data + 1;



//ファイルのアップロードの処理をする
//ファイル名はimage
$file = $_FILES['my_img'];

$ext = substr($file['name'], -4);
if ($ext == '.gif' || $ext == '.jpg' || $ext == '.png') {
	$filePath = './user_img/' . $path_data.$file['name'];
	move_uploaded_file($file['tmp_name'], $filePath);
} else {
	print('※拡張子が.gif, .jpg, .pngのいずれかのファイルをアップロードしてください');
}

//index.phpのフォームから送られて来た情報を変数に代入する
$comment = $_POST['comment'];

//送信されたコメントと写真の情報をデータベースに保存する
$data_insert = ("INSERT INTO photoposter_post(photo_id,comment) VALUES('$filePath', '$comment')");
mysql_query($data_insert,$db);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>PhotoPoster</title>

<!--Bootstrap-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">





</head>

<body>

<header>
<h1 class="text-center">PhotoPoster</h1>
</header>

<div id="container">

	<ul class="nav nav-tabs nav-justified">
		<li><a href="../photoposter/">Home</a></li>
		<li><a href="javascript:location.reload(true);" data-role="button" data-icon="refresh">更新</a></li>
	</ul>

	<!--投稿した写真を表示する-->
	<p>以下の情報を送信しました</p>
	<img src="<?php echo $filePath;?>" width="100%" class="img-responsive">
	<?php print $comment; ?>
	<li><a href="../photoposter/">Homeへ戻る</a></li>
</div>

<footer>
	<h4 class="text-center">&copy;YESLab,Nagoya University</h4>
</footer>

</body>
</html>