<?
include("../config.php");


if($_SESSION['permission']==2){ 
	$sql="SELECT  id, name FROM users_teachers WHERE id_school={$_SESSION['id_school']}";
	$res=$link->query($sql);
	while($row=$res->fetch(PDO::FETCH_ASSOC)){
		echo "<option value='{$row['id']}'>{$row['name']}</option>";
	}
}
?>