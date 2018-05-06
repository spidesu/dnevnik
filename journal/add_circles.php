<h3>Добавление кружков</h3>
<form method="POST" style="width: 30vw;">
	Название кружка: <br>
	<input type="text" name="name" class="form-control"><br>
	Время проведения: <br>
	<input type="time" value="12:00" min="00:00" max="23:59" name="time" class="form-control"><br>
	Дата проведения(удерживайте ctrl для выбора нескольких дней): <br>
	<select name="days[]" class="form-control"  multiple>
		<option value="Понедельник">Понедельник</option>
		<option value="Вторник">Вторник</option>
		<option value="Среда">Среда</option>
		<option value="Четверг">Четверг</option>
		<option value="Пятница">Пятница</option>
		<option value="Суббота">Суббота</option>
		<option value="Воскресенье">Воскресенье</option>
	</select>
	Место проведения: <br>
	<input type="text" name="adress" class="form-control"><br>
	<hr>
	<input type="submit" class="btn btn-primary">
</form>