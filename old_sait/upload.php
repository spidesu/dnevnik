<?
	header("Content-Type: text/html; charset=utf-8");//установка кодировки
	$link=mysqli_connect("localhost","user4","user4","user4_1") or die (mysqli_error($link));//подключение к базе данных
	if($_SERVER['REQUEST_METHOD']=='POST'){
			$dir=__DIR__;
			$rt=time();
			$f=0;
			$sql="SELECT id FROM news ORDER BY id DESC LIMIT 0, 1";
			$res=mysqli_query($link,$sql);
			$row = mysqli_fetch_assoc($res);
			$id_new=$row['id']+1;
			while($_FILES['photo']['name'][$f]){
				if($_FILES['photo']['name'][$f]!=''){
					if($_FILES['photo']['type'][$f]=="image/jpg"){
						$file_t="jpg";
					}
					elseif($_FILES['photo']['type'][$f]=="image/jpeg"){
						$file_t="jpeg";
					} 
					elseif($_FILES['photo']['type'][$f]=="image/png"){
						$file_t="png";
					}
					elseif($_FILES['photo']['type'][$f]=="image/gif"){
						$file_t="gif";
					}
					
					
					$ms="3";
					$dir=__DIR__;
					
					$dir=''.$rt.'.'.$file_t;
					
					
					move_uploaded_file($_FILES['photo']['tmp_name'][$f],$dir);

					$sql="INSERT INTO images(url_img, id_new) VALUES ('$dir','$id_new')";
					mysqli_query($link, $sql);
					$f++;
					$rt++;
					$uploadede_images = $uploadede_images."<img src='$dir' width='20px' height='20px'><br>";
				}
			}
	}
?>
<script>
	parent.uploaded_images.innerHTML="<?=$uploadede_images?>";
	parent.id_new.value="<?=$id_new?>";
</script>