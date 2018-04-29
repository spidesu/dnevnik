<div class="col-xs-6">
	<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
	<h2>Добавить школу</h2>
	<form method="POST">
		Название школы:<br><input type="text" name="name_school" class="form-control"><br>
		Адрес школы:<br><input type="text" name="address_school" class="form-control"><br>
		Фамилия директора школы:<br><input type="text" name="surname_dir_school" class="form-control"><br>
		E_mail школы:<br><input type="text" name="email_school" class="form-control"><br>
		Номер телефона школы:<br><input type="text" name="phone_school" class="form-control"><br>
		<input type="submit" class="btn btn-primary">
	</form>
</div>