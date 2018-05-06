<?=$_SESSION['msg']; $_SESSION['msg']="";?>
<h2>Добавить родителя</h2>
<hr>
<form method="POST" style="width: 30vw;">
	ФИО: <br><input type="text" name="name_parent" class="form-control"><br>
	Место работы: <br><input type="text" name="job_parent" class="form-control"><br>
	Адрес: <br><input type="text" name="adress_parent" class="form-control"><br>
	Дата рождения: <br><input type="date" name="date_parent" class="form-control"><br>
	E_mail: <br><input type="text" name="email_parent" class="form-control"><br>
	Номер телефона: <br><input type="text" name="phone_parent" class="form-control"><br>
	<!--
	Дети: <br>
	<select name="children_parent">
		<?
		$sql="SELECT id, name FROM users_students WHERE id_school={$_SESSION['id_school']}";
		$res=$link->query($sql);
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='{$row['id']}'>{$row['name']}</option>";
		}
		?>
	</select><br>
	-->
	Логин: <br><input type="text" name="login_parent" class="form-control"><br>
	Пароль: <br><input type="text" name="password_parent" class="form-control"><br>
	<br>
	<hr>
	<input type="submit" class="btn btn-primary">
</form>