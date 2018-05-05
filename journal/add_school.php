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
<div class="col-xs-6">
	<h2>Список учителей</h2>
	<table class="table">
		<thead>
			<tr>
				<th>ФИО</th>
			</tr>
		</thead>
		<tbody>
			<?
				$sql="SELECT name_school FROM schools";
				$res=$link->query($sql);
				while($row=$res->fetch(PDO::FETCH_ASSOC)){
					echo "
					<tr>
						<td>{$row['name_school']}</td>
					</tr>";
				}
			?>
		</tbody>
	</table>
</div>