<?
class ClassRoom{
	function addNew($header,$new){

		Global $link;

		$header=$link->quote($header);
		$new=$link->quote($new);
		$date=$link->quote($date);
		$id_teacher=$link->quote($_SESSION['id_teacher']);
		$sql="SELECT id FROM classes WHERE id_teacher=$id_teacher";
		$res=$link->query($sql);
		$row=$res->fetch(PDO::FETCH_ASSOC);
		$sql="INSERT INTO news_classes(header, new, autor, id_class) VALUES ($header, $new, $id_teacher, {$row['id']})";
		$link->exec($sql);
		$_SESSION['msg']="<font color='green'>Новость успешно добавлена!</font>";
		$_SESSION['msg_status']="success";
	}

	function delNew($delNew){//удаление новости

		Global $link; 

		$delNew=$link->quote($delNew);
		$sql="SELECT id FROM classes WHERE id_teacher={$_SESSION['id_teacher']}";
		$res=$link->query($sql);
		$row=$res->fetch(PDO::FETCH_ASSOC);
		$sql="DELETE FROM news_classes WHERE id=$delNew and id_class='{$row['id']}'";
		$link->exec($sql);
	}
	function delLTC($delLTC){//удаление учителя по предмету

		Global $link;

		$delLTC=$link->quote($delLTC);
		$sql="SELECT id FROM classes WHERE id_teacher={$_SESSION['id_teacher']}";
		$res=$link->query($sql);
		$row=$res->fetch(PDO::FETCH_ASSOC);
		$sql="DELETE FROM lesson_teacher_class WHERE id=$delLTC and id_class='{$row['id']}'";
		$link->exec($sql);
	}

	function addLTC($teacher_lesson_conduct,$lesson_teacher){

		Global $link;

		$teacher_lesson_conduct=$link->quote($teacher_lesson_conduct);
		$sql="SELECT id FROM classes WHERE id_teacher={$_SESSION['id_teacher']}";
		$res=$link->query($sql);
		$row=$res->fetch(PDO::FETCH_ASSOC);
		$id_class=$row['id'];
		foreach($lesson_teacher as $var_lesson){
			$login_student=$link->quote($login_student);
			$password_student=$link->quote($password_student);
			$sql_lessons=$sql_lessons."($teacher_lesson_conduct,$var_lesson,$id_class),";
		}
		$sql_lessons=substr($sql_lessons, 0, -1);
		$sql="INSERT INTO lesson_teacher_class(id_teacher, id_lesson, id_class) VALUES ".$sql_lessons;
		$link->exec($sql);
		$_SESSION['msg']="<font color='green'>Успешно!</font>";
	}

	function addStudents($json_student){
		Global $link;
		Global $teacherClass;
		$sql="SELECT id FROM classes WHERE id_teacher={$_SESSION['id_teacher']}";
		$res=$link->query($sql);
		$row=$res->fetch(PDO::FETCH_ASSOC);
		$json_student=json_decode($json_student, true);
		$teacherClass->add_student($json_student, $row['id'], $_SESSION['id_school']);
	}


	function createSchedule($schedule_json){
		Global $link;
		$id_teacher=$link->quote($_SESSION['id_teacher']);
		$sql="SELECT id FROM classes WHERE id_teacher=$id_teacher";
		$res=$link->query($sql);
		$row=$res->fetch(PDO::FETCH_ASSOC);
		$id_class=$link->quote($row['id']);
		$schedule_json=json_decode($schedule_json, true);
		for ($d = 1; $d <= 7; $d++) {
			for ($l = 1; $l <= 6; $l++) {
				$id_lesson=$link->quote($schedule_json[$d][$l-1][$l][0]['lesson_id']);
				$number_lesson=$link->quote($l);
				$day=$link->quote($d);
				$insert_schedule.="($id_lesson,$number_lesson,$day,$id_class),";
				
			}
		}
		$insert_schedule=substr($insert_schedule, 0, -1);
		$sql="INSERT INTO schedule(id_lesson, number_lesson, day, id_class) VALUES ".$insert_schedule;
		$link->exec($sql);
	}

	function editSchedule($schedule_json){
		Global $link;
		$id_teacher=$link->quote($_SESSION['id_teacher']);
		$sql="SELECT id FROM classes WHERE id_teacher=$id_teacher";
		$res=$link->query($sql);
		$row=$res->fetch(PDO::FETCH_ASSOC);
		$id_class=$link->quote($row['id']);
		$schedule_json=json_decode($schedule_json, true);
		for ($d = 1; $d <= 7; $d++) {
			for ($l = 1; $l <= 6; $l++) {
				$id_lesson=$link->quote($schedule_json[$d][$l-1][$l][0]['lesson_id']);
				$number_lesson=$link->quote($l);
				$day=$link->quote($d);
				$insert_schedule.="($id_lesson,$number_lesson,$day,$id_class),";
				
			}
		}
		$insert_schedule=substr($insert_schedule, 0, -1);
		$sql="DELETE FROM schedule WHERE id_class=$id_class";
		$link->exec($sql);
		$sql="INSERT INTO schedule(id_lesson, number_lesson, day, id_class) VALUES ".$insert_schedule;
		$link->exec($sql);
	}

}
?>