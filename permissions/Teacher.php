<?
switch($form){
	case 1: break;
	case 2: //удаление учителя по предмету и удаление новостей

		$id_del_ltc=$_GET['del'];
		if($id_del_ltc){
			$classRoomClass->delLTC($id_del_ltc);
			header('location: ?module=1&form=2');
			exit;
		}
		$id_del=$_GET['del_new'];
		if($id_del){
			$classRoomClass->delNew($id_del);
			header('location: ?module=1&form=2');
			exit;
		}

	break;

	case 3: //добавление учителя по предмету

		$teacher_lesson_conduct=$_POST['teacher_lesson_conduct'];
		$lesson_teacher=$_POST['lesson_teacher'];
		if($teacher_lesson_conduct && $lesson_teacher){
			$classRoomClass->addLTC($teacher_lesson_conduct,$lesson_teacher);
			header('location: ?module=1&form=3');
			exit;
		}
	break;
	case 4: //добавление учеников
		$json_student=$_POST['json_students'];
		if($json_student){
			$classRoomClass->addStudents($json_student);
		}
	break;
	/*case 7: //не дописано (тесты)
		$count_questions=$_POST['count_questions_send'];
		if($count_questions){
			$a=1;
			$b=1;
			while($count_qustions>=$a){
				
				$data[$a]['question_text_name']=$_POST['question_text_name'][$a];
				$data[$a]['question_text']=$_POST['question_text'][$a];
				$count_answers=$_POST['count_answers_send'.$a];
					while($count_answers>=$b){
						$data[$a]['answer'.$b]=$_POST['text_answer_'.$a.'_'.$b];
						$b++;
					}
				
				
				$a++;
				$b=1;
			}
			$a=0;
			$sql="
			INSERT INTO tests(name_test, count_questions, count_active_questions, count_base_questions, status_test) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
			
			";
		}
	break;*/
	case 8: //добавление расписания
	
		$schedule_json=$_POST['schedule_json'];

		if($schedule_json){
			$classRoomClass->createSchedule($schedule_json);
			header('location:?module=1&form=2');
			exit;
		}
	
	break;
	case 9: //редактирование расписания
	
		$schedule_json=$_POST['schedule_json'];

		if($schedule_json){
			$classRoomClass->editSchedule($schedule_json);
			header('location:?module=1&form=2');
			exit;
		}
	
	break;
	case 10: //добавление оценок
	
		$marks=$_POST['mark'];
		$desc=$_POST['desc'];
		$date=$_POST['date'];
		$lesson=$_POST['lesson'];
		$id_student=$_POST['id_student'];
		if($id_student && $marks && $desc && $date && $lesson){
			$teacherClass->addMark($id_student, $marks, $desc, $date, $lesson);
		}
	break;
	case 11: //добавление новостей класса
		$header=$_POST['header'];
		$new=$_POST['new'];
		if($header && $new){
			$classRoomClass->addNew($header, $new);
		}
	
	
	break;
	case 14: //удаление оценок
		$id_del=$_GET['id_del'];
		$id_class_orig=$_GET['id_class'];
		$id_lesson_orig=$_GET['id_lesson'];
		if($id_del){
			$teacherClass->delMark($id_del);
			header("location:?module=1&form=14&id_lesson=$id_lesson_orig&id_class=$id_class_orig");
			exit;
		}
	
	
	break;
	case 15:
		$id = $_GET['id'];
		if($id){
			$sql = "DELETE FROM circles WHERE id={$id}";
			$link->exec($sql);
			header('location: ?module=1&form=15');
		}
	break;
	case 16:
		$name = $_POST['name'];
		$time = $_POST['time'];
		$days = $_POST['days'];
		$adress = $_POST['adress'];
		$id_student = $_GET['id_student'];
		if($name != "" && $time && $id_student){
			$name = $link->quote($name);
			$time = $link->quote($time);
			$adress = $link->quote($adress);
			foreach($days as $day){
				$str_days .= $day.", ";
			}
			$str_days = $link->quote(substr($str_days, 0 , -2));
			$id_student = $link->quote($id_student);
			$sql = "INSERT INTO circles(name, times, id_student, days, adress) VALUES ($name, $time, $id_student, $str_days, $adress)";
			$link->exec($sql);
			header('location: ?module=1&form=15&id_student='.$id_student);
		}
	break;
}
?>