<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<h2>Добавить учителя</h2>
<form method="POST">
	ФИО учителя:<br>
	<select name="teacher_lesson_conduct">
	<?
		$sql="SELECT  id, name FROM users_teachers WHERE id_school={$_SESSION['id_school']}";
		$res=$link->query($sql);
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='{$row['id']}'>{$row['name']}</option>";
		}
	?>
	</select><br>
	
	Предмет:<br>
	<select name="lesson_teacher[]" multiple>
		<?
		$sql="SELECT id, name FROM lessons";
		$res=$link->query($sql);
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='{$row['id']}'>{$row['name']}</option>";
		}
		?>
		
	</select><br>
	<input type="submit">
</form>