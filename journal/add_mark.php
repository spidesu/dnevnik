<h2>Добавить оценку</h2>
<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<form method="post">
	<input name="desc" class="form-control" placeholder="Введите тему урока"><br>
	<input name="date" class="form-control" type="date"><br>
	<table class="table">
		<tr>
			<th>ФИО</th>
			<th>Оценка</th>
		</tr>
		<?
		$id_class=$link->quote($_GET['id_class']);
		$id_school=$link->quote($_SESSION['id_school']);
		$sql="SELECT id, name FROM users_students WHERE id_class=$id_class and id_school=$id_school";
		$res=$link->query($sql);
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo "<tr><td>{$row['name']} </td><td><input name=\"id_student[]\" hidden value=\"{$row['id']}\"><input name=\"mark[{$row['id']}]\" class=\"form-control\" placeholder=\"Введите отметку\"></td></tr>";
		}
		?>
	</table><br>
	<input name="lesson" hidden value="<?=$_GET['id_lesson']?>"><br>
	<input type="submit" value="Готово!" class="btn btn-primary">
</form>
