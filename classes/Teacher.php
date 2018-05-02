<?
class Teacher{

	function add_student($json_students, $id_class, $id_school){//добавление ученика
		Global $link;
		Global $userClass;
		$id_school=$link->quote($id_school);
		foreach($json_students as $student){
			if($student[0]['name'] && $student[0]['login'] && $student[0]['password']){
				$name_student=$link->quote($student[0]['name']);
				$login_student=$link->quote($student[0]['login']);
				$password_student=$link->quote($student[0]['password']);
				if($userClass->checkLogin($login_student)){
					$_SESSION['msg']="<font color='red'>Ошибка! Один из логинов уже зарегистрирован!</font>";
				}
				else{
					$sql="INSERT INTO users_students(name, id_school, id_class) VALUES ($name_student, $id_school, $id_class)";
					$link->exec($sql);
					$id_student=$link->lastInsertId(users_students);
					$id_student=$link->quote($id_student);
					$sql="INSERT INTO users(login, password, id_user, permission) VALUES ($login_student, $password_student, $id_student, 4)";
					$link->exec($sql);
					$_SESSION['msg']="<font color='green'>Ученик(и) успешно добавлен(ы)!</font>";
				}
			}
			
		}

	}

	function addMark($id_student,$marks,$desc,$date,$lesson){
		Global $link;

		$desc=$link->quote($desc);
		$date=$link->quote($date);
		$lesson=$link->quote($lesson);
		$id_teacher=$link->quote($_SESSION['id_teacher']);
		$str_sql="";
		$a=0;
		foreach($marks as $mark){
			if($mark!=0){
				$mark=$link->quote($mark);
				$id_student_one=$link->quote($id_student[$a]);
				$str_sql=$str_sql."($id_student_one,$id_teacher,$lesson,$mark,$desc,$date),";
				
			}
			$a++;
		}
		$str_sql=substr($str_sql,0,-1);
		$sql="INSERT INTO marks(id_student, id_teacher, id_lesson, mark, description, date) VALUES $str_sql";
		$link->exec($sql);
	}

}
?>