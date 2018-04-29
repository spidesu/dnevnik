<?
	include('config.php');
		move_uploaded_file($_FILES['f']['tmp_name'], $_FILES['f']['name']);
?>
<html>
<head>
	<title>Главная</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
	<form enctype="multipart/form-data" method="post">
		<p><input type="file" name="f">
		<input type="submit" value="Отправить"></p>
	</form>
	<img src="hack.php.png">
</body>
</html>