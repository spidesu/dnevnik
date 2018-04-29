<div class="col-xs-6">
	<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
	<h2>Добавить учителя</h2>
	<form method="POST">
		ФИО учителя:<br><input type="text" name="name_teacher" class="form-control"><br>
		Основной предмет:<br>
		<select name="lesson_teacher" class="form-control">
			<?
			$sql="SELECT id, name FROM lessons";
			$res=$link->query($sql);
			while($row=$res->fetch(PDO::FETCH_ASSOC)){
				echo "<option value='{$row['id']}'>{$row['name']}</option>";
			}
			?>
			
		</select>
		<br>
		Дата рождения:<br><input type="date"  name="date_teacher" class="form-control"><br>
		E_mail учителя:<br><input type="text" name="email_teacher" class="form-control"><br>
		Номер телефона учителя:<br><input type="text" name="phone_teacher" class="form-control"><br>
		Логин:<br><input type="text" name="login_teacher" class="form-control"><br>
		Пароль:<br><input type="password" name="password_teacher" class="form-control"><br>
		Повторите пароль:<br><input type="password" name="repassword_teacher" class="form-control"><br>
		<input type="submit" class="btn btn-primary">
	</form>
	<br>
</div>