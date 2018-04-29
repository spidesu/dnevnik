<script>
	function submit_form(){
		user();
		form.submit();
	}
</script>
<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<script>
	var json;
	var	number_students=1;
	var str="";
	function user(){
		a=1;
		while(a<=number_students){
			parent=document.getElementById("user_id_"+a);
			str=str+"\""+a+"\": [{\"name\": \""+parent.children[0].value+"\",\"login\": \""+parent.children[2].value+"\",\"password\": \""+parent.children[4].value+"\"}],";
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
			div.innerHTML="Имя: <input type='text' name='name_student' class=\"form-control\"><br>Логин: <input type='text' name='login_student[]' class=\"form-control\"><br>Пароль: <input type='text' name='password_student[]' class=\"form-control\"><hr>";
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
<div class="col-xs-6">
<h3>Добавить учеников</h3>
<button onclick="add_student()" class="btn btn-primary">Добавить ученика</button>
<button onclick="del_student()" class="btn btn-default">Удалить</button>
<div id="students_list">
<hr>
	<div id="user_id_1">
		Имя: <input type="text" name="name_student[]" class="form-control"><br>
		Логин: <input type="text" name="login_student[]" class="form-control"><br>
		Пароль: <input type="text" name="password_student[]" class="form-control">
		<hr>
		
		
	</div>
</div>
<input type="button" onclick="submit_form()" value="Готово!" class="btn btn-primary">
<form method="POST" id="form">
	<input type="text" name="json_students" hidden id="json_students"><br>
</form>
</div>