<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<h2>Добавить школу</h2>
<form method="POST">
	Название школы:<br><input type="text" name="name_school"><br>
	Адрес школы:<br><input type="text" name="address_school"><br>
	Фамилия директора школы:<br><input type="text" name="surname_dir_school"><br>
	E_mail школы:<br><input type="text" name="email_school"><br>
	Номер телефона школы:<br><input type="text" name="phone_school"><br>
	<input type="submit">
</form>