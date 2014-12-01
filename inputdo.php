<?php
ini_set('display_errors', 'on');
?>


<?php

//ファイルのアップロードの処理をする
$file = $_FILES['my_img'];

$ext = substr($file['name'], -4);
if ($ext == '.gif' || $ext == '.jpg' || $ext == '.png') {
	$filePath = './user_img/' . $file['name'];
	move_uploaded_file($file['tmp_name'], $filePath);
} else {
	print('※拡張子が.gif, .jpg, .pngのいずれかのファイルをアップロードしてください');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>PhotoPoster</title>
</head>

<body>

<header>
<h1>PhotoPoster</h1>
</header>

<div id="content">
<!--投稿した写真を表示する-->
<?php print('<img src="' . $filePath . '" />'); ?>
</div>

<footer>
		<h4>&copy;YESLab,Nagoya University</h4>
</footer>

</div>
</body>
</html>