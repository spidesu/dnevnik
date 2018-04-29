<?
	$id_test=$_GET['id'];
	$check=$_GET['check'];
	if($check==1){
		$text_question=$_POST['text_question'];
		$type_answer=$_POST['type_answer'];
		if($text_question and $type_answer){
			$sql="INSERT INTO questions(id_test, text_question, type_answer, base_question, acces) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])";
			$res=$link->exec($sql);
		}
	}
?>
<script>
var type_answer=1;
var num_answer=1;
var w="";
function answer_add_type_question(type_answer_add){
	type_answer=type_answer_add;
	num_answer++;
	switch(type_answer){
		case 1: add_answer_button.innerHTML="<a onclick='add_answer()'>Добавить+</a><br>"; answer_elements.innerHTML="<li id='el_answer"+num_answer+"'><input type='radio' name='option' value='1'><input type='text' name='element[]' onclick=''><a onclick='del_answer("+num_answer+")'>Удалить к чертям</a><br></li>"; break;
		case 2: add_answer_button.innerHTML="<a onclick='add_answer()'>Добавить+</a><br>"; answer_elements.innerHTML="<li id='el_answer"+num_answer+"'><input type='checkbox' name='checkbox[]' value='1'><input type='text' name='element[]' onclick=''><a onclick='del_answer("+num_answer+")'>Удалить к чертям</a><br></li>"; break;
		case 3: add_answer_button.innerHTML=""; answer_elements.innerHTML="<li id='el_answer"+num_answer+"'><input type='text' name='element[]' onclick=''><br></li>"; break;
	}
}
function add_answer(){
	num_answer++;
	switch(type_answer){
		case 1: answer_elements.innerHTML=answer_elements.innerHTML+"<li id='el_answer"+num_answer+"'><input type='radio' name='option'><input type='text' name='element[]'><a onclick='del_answer("+num_answer+")'>Удалить к чертям</a><br></li>"; break;
		case 2: answer_elements.innerHTML="<li id='el_answer"+num_answer+"'><input type='checkbox' name='checkbox'><input type='text' name='element[]'><a onclick='del_answer("+num_answer+")'>Удалить к чертям</a><br>"+answer_elements.innerHTML+"</li>"; break;
	}
}
function del_answer(number_answer){
	w=document.getElementById('el_answer'+number_answer);
	answer_elements.removeChild(w);
}
</script>
<form method="post">
	<input placeholder="Текст вопроса" type="text" name="text_question"><br>
	Тип ответа:<br>
	<input type="radio" checked onclick="answer_add_type_question(1)" name="type_answer">Только один из всех<br>
	<input type="radio" onclick="answer_add_type_question(2)" name="type_answer">Несколько вариантов ответа<br>
	<input type="radio" onclick="answer_add_type_question(3)" name="type_answer">Ввод ответа вручную<br>
	Добавить ответы:<br>
	<div id="add_answer_button"><a onclick="add_answer()">Добавить+</a><br></div>
	<a action="add_answer_add_question()"></a>
	<ol id="answer_elements">
		<li id="el_answer1"><input type="radio" name="option"><input type='text' name='element[]'><a onclick="del_answer('1')">Удалить к чертям</a></li>
	</ol>
</form>