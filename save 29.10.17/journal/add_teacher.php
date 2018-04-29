<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<h2>Добавить учителя</h2>
<form method="POST">
	ФИО учителя:<br><input type="text" name="name_teacher"><br>
	Основной предмет:<br>
	<select name="lesson_teacher">
		<?
		$sql="SELECT id, name FROM lessons";
		$res=$link->query($sql);
		while($row=$res->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='{$row['id']}'>{$row['name']}</option>";
		}
		?>
		
	</select>
	<br>
	Дата рождения:<br><input type="date"  name="date_teacher"><br>
	E_mail учителя:<br><input type="text" name="email_teacher"><br>
	Номер телефона учителя:<br><input type="text" name="phone_teacher"><br>
	Логин:<br><input type="text" name="login_teacher"><br>
	Пароль:<br><input type="password" name="password_teacher"><br>
	Повторите пароль:<br><input type="password" name="repassword_teacher"><br>
	<input type="submit">
</form>