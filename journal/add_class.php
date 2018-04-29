<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<div class="col-xs-6">
<h2>Добавить класс</h2>
Номер класса:<br>
<form method="POST">
	<select name="number_class" id="number_class_2" class="form-control">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
	</select><br>
	Буква класса(или цифра):<br>
	<input name="letter_class" type="text" id="letter_class_2" class="form-control">
	<br>

	Классный руководитель:<br>
	<select name="classroom_teacher" id="classroom_teacher_2" class="form-control">
		<?
		$sql="SELECT  id, name FROM users_teachers WHERE id_school={$_SESSION['id_school']}";
		$res=$link->query($sql);
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='{$row['id']}'>{$row['name']}</option>";
		}
		?>
	</select>
	<br>
	<input type="submit" class="btn btn-primary">
</form>
<br>
</div>