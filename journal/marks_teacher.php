<?
$id_class_orig=$_GET['id_class'];
$id_school_orig=$_SESSION['id_school'];
$id_lesson_orig=$_GET['id_lesson'];
?>
<h2>Оценки</h2>
<a href="?module=1&form=10&id_lesson=<?=$id_lesson_orig?>,&id_class=<?=$id_class_orig?>">Добавить</a>
<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<table class="table">
	<tr>
		<th>ФИО</th>
		<th>Оценки</th>
	</tr>
	<?
	$id_class=$link->quote($_GET['id_class']);
	$id_school=$link->quote($_SESSION['id_school']);
	$id_lesson=$link->quote($_GET['id_lesson']);
	$sql="SELECT id, name FROM users_students WHERE id_class=$id_class and id_school=$id_school";
	$res=$link->query($sql);
	while($row=$res->fetch(PDO::FETCH_ASSOC)){
		$sql_marks="SELECT id, mark FROM marks WHERE id_lesson=$id_lesson and id_student='{$row['id']}'";
		$res_marks=$link->query($sql_marks);
		
		echo "<tr><td>{$row['name']} </td><td>";
		while($row_marks=$res_marks->fetch(PDO::FETCH_ASSOC)){
			echo " | ".$row_marks['mark']." <a href=?module=1&form=14&id_lesson=$id_lesson_orig&id_class=$id_class_orig&id_del={$row_marks['id']}>X</a>";
		}
		echo "</td></tr>";
	}
	?>
</table><br>
