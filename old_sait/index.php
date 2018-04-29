<?	
//для того, что бы картинки добавлялись вместе с новостью, нужно создать доп. таблицу, которая связывает картинки с новостью - это была первая мысль, которая пришла мне на ум.
	header("Content-Type: text/html; charset=utf-8");//установка кодировки
	$link=mysqli_connect("localhost","user4","user4","user4_1") or die (mysqli_error($link));//подключение к базе данных
	$id_new=$_POST['id_new'];
	$name_new=$_POST['name_new'];
	$new=$_POST['new'];
	$short_new=$_POST['short_new'];
	if($id_new){
		if($name_new and $new and $short_new){
			$sql="INSERT INTO news(id, name_new, new, short_new) VALUES ('$id_new','$name_new','$new','$short_new')";
			mysqli_query($link,$sql);
		}
	}
	else{
		if($name_new and $new and $short_new){
			$sql="INSERT INTO news(name_new, new, short_new) VALUES ('$name_new','$new','$short_new')";
			mysqli_query($link,$sql);
		}
	}

?>
<form enctype="multipart/form-data" method="post" target="upload_frame" action="upload.php">
   <input type="file" name="photo[]" accept="image/jpg,image/jpeg,image/png,image/gif" required multiple>
   <input type="submit" value="Отправить"></p>
</form> 
<iframe name="upload_frame">
	
</iframe>
<div id="uploaded_images">

</div>
<form method="POST">
	<input type="text" name="name_new">
	<input type="text" name="id_new" id="id_new" hidden>
	<textarea name="new"></textarea>
	<textarea name="short_new"></textarea>
	<input type="submit">
</form>
<?
$sql="SELECT id, name_new, new, short_new FROM news";
$res=mysqli_query($link,$sql);
while($row=mysqli_fetch_assoc($res)){
	echo "Название: ".$row['name_new']."<br>";
	echo "Новость: ".$row['new']."<br>";
	echo "Краткое описание: ".$row['short_new']."<br>";
	$sql="SELECT url_img FROM images WHERE id_new={$row['id']}";
	$res=mysqli_query($link,$sql);
	while($row=mysqli_fetch_assoc($res)){
		echo "<img src='{$row['url_img']}' width='20px' height='20px'>"."<br>";
	}
}
?>