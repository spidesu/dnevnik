<script type="text/javascript">
	function reloadTeachers(){
		$.ajax({  
			url: "ajaxQueries/reloadTeachers.php",
			cache: false,  
			success: function(html){
				classroom_teacher_2.innerHTML=html; 
			}  
		});
	}
</script>
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
		Буква класса или цифра:<br>
		<input name="letter_class" type="text" id="letter_class_2" class="form-control">
		<br>

		Классный руководитель:<br>
		<a href="?module=1&form=3&type=1" onclick="window.open(this.href, '', 'scrollbars=1,height='+Math.min(700, screen.availHeight)+',width='+Math.min(500, screen.availWidth)); return false;">Добавить учителя</a><br>
		<a href="#" onclick="reloadTeachers()">Обновить список</a>
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
		<input type="submit" value="Сохранить" class="btn btn-primary">
	</form>
	<br>
</div>
<div class="col-xs-6">
	<h2>Список классов</h2>
	<table class="table">
		<thead>
			<tr>
				<th>Класс</th>
				<th>Преподаватель</th>
			</tr>
		</thead>
		<tbody>
			<?
				$sql="SELECT cl.number_class, cl.leter_class, ut.name FROM classes cl JOIN users_teachers ut ON ut.id=cl.id_teacher WHERE cl.id_school={$_SESSION['id_school']}";
				$res=$link->query($sql);
				while($row=$res->fetch(PDO::FETCH_ASSOC)){
					echo "
					<tr>
						<th scope='row'>{$row['number_class']}-{$row['leter_class']}</th>
						<td>{$row['name']}</td>
					</tr>";
				}
			?>
		</tbody>
	</table>
</div>