<?php

//photoposterのトップ画面のphpファイル


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
//データベースのphotoposter_postテーブルから全ての情報を取り出す。
$recordSet = mysql_query("SELECT * FROM photoposter_post ORDER BY id DESC", $db);

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
<header>

<div class="container">

	<ul class="nav nav-tabs nav-justified">
		<li class="active"><a href="#">Home</a></li>
		<li><a href="#">更新</a></li>
		<li><a href="#">マップ</a></li>
	</ul>

	<ui class="slider">
			<?php $data = mysql_fetch_assoc($recordSet);?>
			<li><img src="<?php echo $data['photo_id'];?>" width="100%" class="img-responsive"></li>
	</ui>
	
	<br />
	
	<form action="inputdo.php" method="post" enctype="multipart/form-data">
		
		<div class="form-group">	
			<label for="name">写真を投稿する</label>
			<input name="my_img" type="file" id="my_img" class="form-control" />
		</div>
		
		<div class="form-group">
			<label for="comment">コメントを投稿する</label>
			<textarea name="comment" cols="50" rows="5" class="form-control"></textarea>
		</div>
		
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block" >写真を投稿する</button>
		</div>
	
	</form>

</div>

<footer class="text-center">
<h4>&copy;YESLab,Nagoya University</h4>
</footer>

</div>


<!--javascript-->




</body>
</html>