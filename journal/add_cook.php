<div class="col-xs-6">
	<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
	<h2>Добавить повара</h2>
	<form method="POST"> 
		ФИО повара:<br><input type="text" name="name_cook" class="form-control"><br>
		Номер телефона повара:<br><input type="text" name="phone_cook" class="form-control"><br>
		Логин:<br><input type="text" name="login_cook" class="form-control"><br>
		Пароль:<br><input type="password" name="password_cook" class="form-control"><br>
		Повторите пароль:<br><input type="password" name="repassword_cook" class="form-control"><br>
		<input type="submit" class="btn btn-primary"> 
	</form>
	<br>
</div>
<div class="col-xs-6">
	<h2>Список поваров</h2>
	<table class="table">
		<thead>
			<tr>
				<th>ФИО</th>
			</tr>
		</thead>
		<tbody>
			<?
				$sql="SELECT name FROM users_cooks WHERE id_school={$_SESSION['id_school']}";
				$res=$link->query($sql);
				while($row=$res->fetch(PDO::FETCH_ASSOC)){
					echo "
					<tr>
						<td>{$row['name']}</td>
					</tr>";
				}
			?>
		</tbody>
	</table>
</div>