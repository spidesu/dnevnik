<?

$count_questions=$_POST['count_questions'];
$name_test=$link->quote($_POST['name_test']);
echo $count_questions;
$a=1;
$b=1;var_dump($_POST);
if($count_questions){
	$sql="INSERT INTO tests(name_test, count_questions, status_test, id_teacher) VALUES ($name_test,$count_questions,1, {$_SESSION['id_teacher']})";
	echo $sql;
	$link->exec($sql);
	$id_test=$link->lastInsertId('tests');
	while($count_questions>=$a){
		$question_text=$link->quote($_POST['question_text_'.$a]);
		$count_answers=$_POST['count_answers_'.$a];
		$type_question=$_POST['type_question'.$a];
		$sql="INSERT INTO questions(id_test, text_question, type_answer, base_question, acces) VALUES ($id_test, $question_text,$type_question,1,1)";
		echo $sql;
		$link->exec($sql);
		$id_question=$link->lastInsertId('questions');
			while($count_answers>=$b){
				$right=0;
				if($_POST['type_question'.$a]==3){//свой вариант ответа
					echo "1<br>";
					$answer=$link->quote($_POST['text_answer_'.$a.'_'.$b]);
					$right_answer=$_POST['text_answer_'.$a.'_'.$b];
					$sql="INSERT INTO answers(id_question, text, correct, acces) VALUES ($id_question,$answer,1,1)";
					echo $sql;
					$link->exec($sql);
				}
				elseif($_POST['type_question'.$a]==2){//выбор нескольких вариантов ответов
					echo "2<br>";
					$answer=$link->quote($_POST['answer_checkbox_text_'.$a.'_'.$b]);
					$right_answer=$_POST['answer_checkbox_'.$a.'_'.$b];
					if($right_answer){$right=1;}
					$sql="INSERT INTO answers(id_question, text, correct, acces) VALUES ($id_question,$answer,$right,1)";
					echo $sql;
					$link->exec($sql);
				}
				else{//выбор одного варианта ответа
					echo "3<br>";
					$answer=$link->quote($_POST['answer_radio_text_'.$a.'_'.$b]);
					$right_answer=$_POST['answer_radio_'.$a];
					if($right_answer==$b){$right=1;}
					$sql="INSERT INTO answers(id_question, text, correct, acces) VALUES ($id_question,$answer,$right,1)";
					$link->exec($sql);
				}
				
				
				$b++;
			}
		
		
		$a++;
		$b=1;
	}
}
$a=0

?>
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
			case 1: answers.innerHTML="<input type='button' value='Добавить' onclick=\"add_answer("+number_question+",1)\"><input type='button' value='Удалить' onclick=\"del_answer("+number_question+")\"><br><div><input type=\"radio\" value=\"1\" name=\"answer_radio_"+number_question+"\" checked><input type=\"text\" name=\"answer_radio_text_"+number_question+"_1\"></div>"; break;
			case 2: answers.innerHTML="<input type='button' value='Добавить' onclick=\"add_answer("+number_question+",2)\"><input type='button' value='Удалить' onclick=\"del_answer("+number_question+")\"><br><div><input type=\"checkbox\" value=\"1\" name=\"answer_checkbox_"+number_question+"_"+count_answers+"\"checked><input type=\"text\" name=\"answer_checkbox_text_"+number_question+"_1\"></div>"; break;
			case 3: answers.innerHTML="<input type=\"text\" name=\"text_answer_"+number_question+"_1\">"; break;
		}
	}
	
	
	function add_answer(number_question,type){
		
		count_answers_input=document.getElementById("count_answers_"+number_question)
		count_answers=count_answers_input.value;
		count_answers++
		count_answers_input.value++;
		question_div=document.getElementById("question"+number_question)
		answers=document.getElementById("answers"+number_question)
		div=document.createElement('div');
		div.id="text_answer_"+count_answers
		switch(type){
			case 1: div.innerHTML="<input type=\"radio\" value=\""+count_answers+"\" name=\"answer_radio_"+number_question+"\"><input type=\"text\" name=\"answer_radio_text_"+number_question+"_"+count_answers+"\"><br>"; answers.appendChild(div); break;
			case 2: div.innerHTML="<input type=\"checkbox\" value=\"1\" name=\"answer_checkbox_"+number_question+"_"+count_answers+"\"><input type=\"text\" name=\"answer_checkbox_text_"+number_question+"_"+count_answers+"\">"; answers.appendChild(div); break;
		}
	}
	function del_answer(number_question){
		question_div=document.getElementById("question"+number_question)
		answers=document.getElementById("answers"+number_question)
		count_answers_input=document.getElementById("count_answers_"+number_question)
		if(count_answers>1){
			count_answers_input.value--;
			answers.lastElementChild.remove()
			count_answers--;
		}
	}
	function add_question(){
		count_questions++
		div=document.createElement('div');
		div.innerHTML="<div id=\"question"+count_questions+"\"><input value=\"1\" type=\"text\" name=\"count_answers_"+count_questions+"\" hidden id=\"count_answers_"+count_questions+"\"><textarea placeholder=\"Вопрос\" name=\"question_text_"+count_questions+"\"></textarea><br><input type=\"radio\" value=\"1\" name=\"type_question"+count_questions+"\" onclick=\"select_type_question(1,"+count_questions+")\">Выбор одного варианта ответа<br><input type=\"radio\" value=\"2\" name=\"type_question"+count_questions+"\" onclick=\"select_type_question(2,"+count_questions+")\">Выбор нескольких варинтов ответа<br><input type=\"radio\" value=\"3\" name=\"type_question"+count_questions+"\" onclick=\"select_type_question(3,"+count_questions+")\" checked>Текстовый вариант ответа<br><hr>ответы<div id=\"answers"+count_questions+"\"><div><input type=\"text\" name=\"text_answer_"+count_questions+"_1\"><br></div></div></div><hr>"; questions.appendChild(div);
	}
	function del_question(number_question){
		if(count_questions>1){
			questions.lastElementChild.remove()
			count_questions--;
		}
	}
</script>
<script>
	function submit_form(){
		count_question.value=count_questions
		form.submit();
	}
</script>
<form method="POST" id="form">
<h4 onclick="add_student()">Добавить тест</h4>
<div id="questions">
	<input type="text" value="1" name="count_answers_1" hidden id="count_answers_1">
	<input placeholder="Название теста" type="text" name="name_test"><br>
	<input type="button" onclick="add_question()" value="Добавить"><input type="button" onclick="del_question()" value="Удалить"><br>
	<div id="question1">
		<textarea placeholder="Вопрос" name="question_text_1"></textarea><br>
		<input type="radio" name="type_question1" value="1" onclick="select_type_question(1,1)">Выбор одного варианта ответа<br>
		<input type="radio" name="type_question1" value="2" onclick="select_type_question(2,1)">Выбор нескольких варинтов ответа<br>
		<input type="radio" name="type_question1" value="3" onclick="select_type_question(3,1)" checked>Текстовый вариант ответа<br>
		<hr>
		ответы
		<div id="answers1">
			<input type="text" name="text_answer_1_1"><br>
		</div>
		
	</div>
	<hr>
</div>
<input type="text" value="1" name="count_questions" hidden id="count_question">

<input type="button" onclick="submit_form()" value="ДАВАЙ СДЕЛАЕМ ЭТО ВМЕСТЕ!">
</form>