<?
include('config.php');
?>
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
		json='"{'+str+'}"';
		console.log(json);
		
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


<?
$sql="INSERT INTO `users`(`name`, `login`, `password`, `id_user`, `permission`) VALUES ('nagibatel','123456','123456',1,2)";
$res=$link->exec($sql);
print $link->lastInsertId('users').'<br />';

?>