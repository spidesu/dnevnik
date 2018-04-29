<h2>Добавить оценку</h2>
<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<form method="post">
	<select name="id_student">
		<option value="0" selected disabled>Выберите ученика</option>
		<?
		$id_class=$link->quote($_GET['id_class']);
		$id_school=$link->quote($_SESSION['id_school']);
		$sql="SELECT id, name FROM users_students WHERE id_class=$id_class and id_school=$id_school";
		$res=$link->query($sql);
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='{$row['id']}'>{$row['name']}</option>";
		}
		?>
	</select><br>
	<input name="mark" placeholder="Введите отметку"><br>
	<input name="desc" placeholder="Введите тему урока"><br>
	<input name="date" type="date"><br>
	<input name="lesson" hidden value="<?=$_GET['id_lesson']?>"><br>
	<input type="submit">
</form>