<?

$count_questions=$_POST['count_questions'];
$a=1;
$b=1;
while($count_qustions>=$a){
	
	$data[$a]['question_text_name']=$_POST['question_text_name_'.$a];
	$data[$a]['question_text']=$_POST['question_text_'.$a];
	$count_answers=$_POST['count_answers_1'];
		while($count_answers>=$b){
			$data[$a]['answer'.$b]=$_POST['text_answer_'.$a.'_'.$b];
			$b++;
		}
	
	
	$a++;
	$b=1;
}
$a=0

?>



<script>
	function submit_form(){
		form.submit();
	}
</script>
<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<script>
	var	number_students=1;
	var type_question=3
	var count_questions=1
	var count_answers=1
	var number_question=1;
	function select_type_question(type_question, number_question){
		type=type_question
		count_answers=1
		question_div=document.getElementById("question"+number_question)
		answers=document.getElementById("answers"+number_question)
		switch(type_question){
			case 1: answers.innerHTML="<input type='button' value='Добавить' onclick=\"add_answer("+number_question+")\"><input type='button' value='Удалить' onclick=\"del_answer("+number_question+")\"><br><div><input type=\"radio\" name=\"answer_radio_"+number_question+"\" checked><input type=\"text\"></div>"; break;
			case 2: answers.innerHTML="<input type='button' value='Добавить' onclick=\"add_answer("+number_question+")\"><input type='button' value='Удалить' onclick=\"del_answer("+number_question+")\"><br><div><input type=\"checkbox\" name=\"answer_checkbox_"+number_question+"\" checked><input type=\"text\"></div>"; break;
			case 3: answers.innerHTML="<input type=\"text\" id=\"answer_text_1_"+number_question+"\">"; break;
		}
	}
	
	
	function add_answer(number_question){
		count_answers++
		question_div=document.getElementById("question"+number_question)
		answers=document.getElementById("answers"+number_question)
		div=document.createElement('div');
		div.id="text_answer_"+count_answers
		switch(type){
			case 1: div.innerHTML="<input type=\"radio\" name=\"answer_radio_"+number_question+"\"><input type=\"text\"><br>"; answers.appendChild(div); break;
			case 2: div.innerHTML="<input type=\"checkbox\"><input tepe=\"text\">"; answers.appendChild(div); break;
		}
	}
	function del_answer(number_question){
		question_div=document.getElementById("question"+number_question)
		answers=document.getElementById("answers"+number_question)
		if(count_answers>1){
			answers.lastElementChild.remove()
			count_answers--;
		}
	}
	function add_question(){
		count_questions++
		div=document.createElement('div');
		div.innerHTML="<div id=\"question"+count_questions+"\"><input type=\"text\" id=\"question_text_"+count_questions+"\" placeholder=\"Название вопроса\"><br><textarea placeholder=\"Вопрос\"></textarea><br><input type=\"radio\" name=\"type_question"+count_questions+"\" onclick=\"select_type_question(1,"+count_questions+")\">Выбор одного варианта ответа<br><input type=\"radio\" name=\"type_question"+count_questions+"\" onclick=\"select_type_question(2,"+count_questions+")\">Выбор нескольких варинтов ответа<br><input type=\"radio\" name=\"type_question"+count_questions+"\" onclick=\"select_type_question(3,"+count_questions+")\" checked>Текстовый вариант ответа<br><hr>ответы<div id=\"answers"+count_questions+"\"><div><input type=\"text\" name=\"text_answer_1\"><br></div></div></div><hr>"; questions.appendChild(div);
	}
	function del_question(number_question){
		if(count_questions>1){
			questions.lastElementChild.remove()
			count_questions--;
		}
	}
</script>
<form method="POST" id="form">
<h4 onclick="add_student()">Добавить тест</h4>
<div id="questions">
	<input type="button" onclick="add_question()" value="Добавить"><input type="button" onclick="del_question()" value="Удалить"><br>
	<div id="question1">
		<input type="text" name="question_text_name_1" placeholder="Название вопроса"><br>
		<textarea placeholder="Вопрос" name="question_text_1">
		</textarea><br>
		<input type="radio" name="type_question1" onclick="select_type_question(1,1)">Выбор одного варианта ответа<br>
		<input type="radio" name="type_question1" onclick="select_type_question(2,1)">Выбор нескольких варинтов ответа<br>
		<input type="radio" name="type_question1" onclick="select_type_question(3,1)" checked>Текстовый вариант ответа<br>
		<hr>
		ответы
		<div id="answers1">
			<div id="text_answer_1"><input type="text" name="answer_text_1_1"><br></div>
		</div>
		
	</div>
	<hr>
</div>
<input type="button" onclick="submit_form()" value="ДАВАЙ СДЕЛАЕМ ЭТО ВМЕСТЕ!">

<input type="text" name="json_students" hidden id="json_students"><br>

</form>