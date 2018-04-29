<?=$_SESSION['msg']; $_SESSION['msg']="";?>
<h2>Добавить родителя</h2>
<form method="POST">
	ФИО: <br><input type="text" name="name_parent"><br>
	Место работы: <br><input type="text" name="job_parent"><br>
	Адрес: <br><input type="text" name="adress_parent"><br>
	Дата рождения: <br><input type="date" name="date_parent"><br>
	E_mail: <br><input type="text" name="email_parent"><br>
	Номер телефона: <br><input type="text" name="phone_parent"><br>
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
	Логин: <br><input type="text" name="login_parent"><br>
	Пароль: <br><input type="text" name="password_parent"><br>
	<br>
	<input type="submit">
</form>