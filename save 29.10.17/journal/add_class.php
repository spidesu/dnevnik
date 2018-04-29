<script>
	function submit_form(){
		user();
		number_class.value=number_class_2.value;
		letter_class.value=letter_class_2.value;
		classroom_teacher.value=classroom_teacher_2.value;
		form.submit();
	}
</script>
<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<h2>Добавить класс</h2>
Номер класса:<br>
<select name="number_class" id="number_class_2">
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
Буква класса(или цифра):<br>
<input name="letter_class" type="text" id="letter_class_2">
<br>

Классный руководитель:<br>
<select name="classroom_teacher" id="classroom_teacher_2">
	<?
	$sql="SELECT  id, name FROM users_teachers WHERE id_school={$_SESSION['id_school']}";
	$res=$link->query($sql);
	while($row=$res->fetch(PDO::FETCH_ASSOC)){
		echo "<option value='{$row['id']}'>{$row['name']}</option>";
	}
	?>
</select>
<br>
<script>
	var json;
	var	number_students=1;
	var str="";
	function user(){
		a=1;
		while(a<=number_students){
			parent=document.getElementById("user_id_"+a);
			str=str+"\""+a+"\": [{\"name\": \""+parent.children[1].value+"\",\"login\": \""+parent.children[3].value+"\",\"password\": \""+parent.children[5].value+"\"}],";
			a++;
		}
		str=str.substr(0,str.length-1);
		json='{'+str+'}';
		console.log(json);
		json_students.value=json;
	}
	function add_student(){
		number_students++;
			div=document.createElement('div');
			div.id="user_id_"+number_students;
			div.innerHTML="<br>Имя: <input type='text' name='name_student'><br>Логин: <input type='text' name='login_student'><br>Пароль: <input type='text' name='password_student'><hr>";
			students_list.appendChild(div);
	}
	function del_student(){
		id_div="user_id_"+number_students;
		div_user=document.getElementById(id_div)
		if(number_students>1){
			div_user.remove();
			number_students--;
		}
	}
</script>
<h4 onclick="add_student()">Добавить ученика</h4>
<h4 onclick="del_student()">Удалить</h4>
<input type="button" onclick="user()">
<div id="students_list">
	Ученики:<br>
	<div id="user_id_1">
		<br>
		Имя: <input type="text" name="name_student"><br>
		Логин: <input type="text" name="login_student"><br>
		Пароль: <input type="text" name="password_student">
		<hr>
		
		
	</div>
</div>
<input type="button" onclick="submit_form()" value="ДАВАЙ СДЕЛАЕМ ЭТО ВМЕСТЕ!">
<form method="POST" id="form">
	<input type="text" name="number_class" hidden id="number_class"><br>
	<input type="text" name="letter_class" hidden id="letter_class"><br>
	<input type="text" name="classroom_teacher" hidden id="classroom_teacher"><br>
	<input type="text" name="json_students" hidden id="json_students"><br>
</form>