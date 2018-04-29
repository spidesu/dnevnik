<?

$count_questions=$_POST['count_questions'];
$a=1;
$b=1;
$name_test=$link->quote($_POST['name_test']);
if($count_questions){
	while($count_questions>=$a){
		$data[$a]['type_question']=$_POST['type_question'][$a];
		$data[$a]['question_text']=$_POST['question_text'][$a];
		$count_answers=$_POST['count_answers'][$a];
		$data[$a]['count_answers']=$count_answers;
			while($count_answers>=$b){
				$data[$a]['answers'][$b]=$_POST['text_answer'][$a][$b];
				if($data[$a]['type_question']==2){
					if($_POST['answer_checkbox'][$a][$b]=="on"){
						$data[$a]['right'][$b]="true";
					}
					else{
						$data[$a]['right'][$b]="false";
					}
				}
				elseif($data[$a]['type_question']==3){
					$data[$a]['right'][$b]='true';
				}
				elseif($data[$a]['type_question']==1){
					if($_POST['answer_radio'][$a]==$b){
						$data[$a]['right'][$b]="true";
					}
					else{
						$data[$a]['right'][$b]="false";
					}
				}
				$b++;
			}
		$a++;
		$b=1;
	}
	$a=0;
	$count_questions=$link->quote($count_questions);
	$data=$link->quote(json_encode($data,JSON_UNESCAPED_UNICODE));
	$sql="INSERT INTO tests(name_test, count_question, json_text) VALUES ($name_test,$count_questions,$data)";
	$link->exec($sql);
}

?>
<script>
	function submit_form(){
		form.submit();
	}
</script>
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
			case 1: answers.innerHTML="<input type='button' value='Добавить ответ' onclick=\"add_answer("+number_question+",1)\" class=\"btn btn-primary\"><input type='button' value='Удалить ответ' onclick=\"del_answer("+number_question+")\" class=\"btn btn-default\"><br><div><input type=\"radio\" name=\"answer_radio["+number_question+"]\" checked value=\"1\"><input type=\"text\" name=\"text_answer["+number_question+"][1]\" class=\"form-control\"></div>"; break;
			case 2: answers.innerHTML="<input type='button' value='Добавить ответ' onclick=\"add_answer("+number_question+",2)\" class=\"btn btn-primary\"><input type='button' value='Удалить ответ' onclick=\"del_answer("+number_question+")\" class=\"btn btn-default\"><br><div><input type=\"checkbox\" name=\"answer_checkbox["+number_question+"][1]\" checked><input type=\"text\" name=\"text_answer["+number_question+"][1]\" class=\"form-control\"></div>"; break;
			case 3: answers.innerHTML="<input type=\"text\" name=\"text_answer["+number_question+"][1]\" id=\"answer_text_1_"+number_question+"\">"; break;
		}
	}
	function add_answer(number_question,type){
		count_answers++
		question_div=document.getElementById("question"+number_question)
		answers=document.getElementById("answers"+number_question)
		div=document.createElement('div');
		count_answers=document.getElementById("count_answers_send"+number_question)
		count_answers.value++
		div.id="text_answer_"+count_answers.value
		switch(type){
			case 1: div.innerHTML="<input type=\"radio\" name=\"answer_radio["+number_question+"]\" value=\""+count_answers.value+"\"><input type=\"text\" name=\"text_answer["+number_question+"]["+count_answers.value+"]\" class=\"form-control\"><br>"; answers.appendChild(div); break;
			case 2: div.innerHTML="<input type=\"checkbox\" name=\"answer_checkbox["+number_question+"]["+count_answers.value+"]\"><input type=\"text\" name=\"text_answer["+number_question+"]["+count_answers.value+"]\" class=\"form-control\">"; answers.appendChild(div); break;
		}
	}
	function del_answer(number_question){
		question_div=document.getElementById("question"+number_question)
		answers=document.getElementById("answers"+number_question)
		if(count_answers.value>1){
			answers.lastElementChild.remove()
			count_answers_div=document.getElementById("count_answers_send"+number_question)
			count_answers_div.value--
		}
	}
	function add_question(){
		count_questions++
		div=document.createElement('div');
		div.innerHTML="<div id=\"question"+count_questions+"\"><textarea placeholder=\"Вопрос\" name=\"question_text["+count_questions+"]\"></textarea><br><input type=\"radio\" name=\"type_question["+count_questions+"]\" onclick=\"select_type_question(1,"+count_questions+")\" value=\"1\">Выбор одного варианта ответа<br><input type=\"radio\" name=\"type_question["+count_questions+"]\" onclick=\"select_type_question(2,"+count_questions+")\" value=\"2\">Выбор нескольких варинтов ответа<br><input type=\"radio\" name=\"type_question["+count_questions+"]\" onclick=\"select_type_question(3,"+count_questions+")\" checked value=\"3\">Текстовый вариант ответа<br><hr>ответы<div id=\"answers"+count_questions+"\"><div><input type=\"text\" name=\"text_answer["+count_questions+"][1]\"><br></div></div><input type=\"text\" value=\"1\" name=\"count_answers["+count_questions+"]\" hidden id=\"count_answers_send"+count_questions+"\"></div><hr>"; questions.appendChild(div);
		count_questions_send=document.getElementById("count_questions_send")
		count_questions_send.value++
	}
	function del_question(number_question){
		if(count_questions>1){
			questions.lastElementChild.remove()
			count_questions--;
			count_questions_send=document.getElementById("count_questions_send")
			count_questions_send.value--
		}
	}
</script>
<div class="col-xs-6">
<form method="POST" id="form">
<h4>Добавить тест</h4>
<input type="text" name="name_test" placeholder="тема теста" class="form-control">
<hr>
<div id="questions">
	<p><input type="button" class="btn btn-primary" onclick="add_question()" value="Добавить вопрос"><input type="button" onclick="del_question()" value="Удалить вопрос" class="btn btn-default"></p>
	<div id="question1">
		<textarea placeholder="Вопрос" name="question_text[1]" class="form-control"></textarea><br>
		<input type="radio" name="type_question[1]" onclick="select_type_question(1,1)" value="1">Выбор одного варианта ответа<br>
		<input type="radio" name="type_question[1]" onclick="select_type_question(2,1)" value="2">Выбор нескольких варинтов ответа<br>
		<input type="radio" name="type_question[1]" onclick="select_type_question(3,1)" value="3" checked>Текстовый вариант ответа<br>
		<hr>
		ответы
		<div id="answers1">
			<div id="text_answer[1][1]"><input type="text" name="text_answer[1][1]" class="form-control"><br></div>
		</div>
		<input type="text" value="1" name="count_answers[1]" hidden id="count_answers_send1">
	</div>
	<hr>
</div>
<input type="button" onclick="submit_form()" value="Готово!" class="btn btn-primary">

<input type="text" value="1" name="count_questions" hidden id="count_questions_send"><br>

</form>
</div>