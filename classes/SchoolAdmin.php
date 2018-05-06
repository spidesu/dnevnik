<?
class SchoolAdmin{

	function add_class($number_class, $letter_class, $classroom_teacher){//добавление класса

		Global $link;

		if($number_class && $letter_class && $classroom_teacher){
			$number_class=$link->quote($number_class);
			$letter_class=$link->quote($letter_class);
			$classroom_teacher=$link->quote($classroom_teacher);
			$sql="INSERT INTO classes(id_teacher, id_school, number_class, leter_class) VALUES ($classroom_teacher,'{$_SESSION['id_school']}', $number_class, $letter_class)";
			$link->exec($sql);
			$id_class=$link->lastInsertId('classes');
			$id_class=$link->quote($id_class);
			$_SESSION['msg']="<font color='green'>Класс успешно добавлен!</font>";
			return true;
		}
		else{
			return false;
		}
	}
	function add_teacher($name_teacher, $lesson_teacher, $date_teacher,  $email_teacher, $phone_teacher, $login_teacher_text, $password_teacher_text, $repassword_teacher){//добавление учителя

		Global $link;
		Global $userClass;

		if($name_teacher && $lesson_teacher && $date_teacher && $email_teacher && $phone_teacher && $login_teacher_text && $password_teacher_text && $password_teacher_text==$repassword_teacher){
			$name_teacher=$link->quote($name_teacher);
			$lesson_teacher=$link->quote($lesson_teacher);
			$date_teacher=$link->quote($date_teacher);
			$email_teacher=$link->quote($email_teacher);
			$phone_teacher=$link->quote($phone_teacher);
			$login_teacher=$link->quote($login_teacher_text);
			$password_teacher=$link->quote($password_teacher_text);
			$id_school=$link->quote($_SESSION['id_school']);
			if($userClass->checkLogin($login_teacher)==true){
				$sql="INSERT INTO users_teachers(name, email, phone, id_school, id_base_lesson, employment) VALUES ($name_teacher, $email_teacher, $phone_teacher, $id_school, $lesson_teacher, 0)";
				$link->exec($sql);
				$id_teacher=$link->lastInsertId(users_teachers);
				$id_teacher=$link->quote($id_teacher);
				$sql="INSERT INTO users(login, password, id_user, permission) VALUES ($login_teacher, $password_teacher, $id_teacher, 3);";
				$link->exec($sql);
				$_SESSION['msg']="<font color='green'>Учитель успешно добавлен!<br>Данные для входа:<br>Логин: $login_teacher_text<br>Пароль: $password_teacher_text</font>";
			}
			else{
				$_SESSION['msg']="<font color='red'>Ошибка! Логин уже зарегистрирован!</font>";
				return false;
			}
		}
		else{
			return false;
		}
	}
	
	function add_cook($name_cook, $phone_cook, $login_cook_text, $password_cook_text){//добавление учителя
		
		Global $link;
		Global $userClass;
		$name_cook=$link->quote($name_cook);
		$phone_cook=$link->quote($phone_cook);
		$login_cook=$link->quote($login_cook_text);
		$password_cook=$link->quote($password_cook_text);
		$id_school=$link->quote($_SESSION['id_school']);
		if($userClass->checkLogin($login_cook)==true){
			$sql="INSERT INTO users_cooks(name, phone, id_school) VALUES ($name_cook,$phone_cook,$id_school)";
			$link->exec($sql);
			$id_cook=$link->lastInsertId(users_cooks);
			$id_cook=$link->quote($id_cook);
			$sql="INSERT INTO users(login, password, id_user, permission) VALUES ($login_cook, $password_cook, $id_cook, 6);";
			$link->exec($sql);
			$_SESSION['msg']="<font color='green'>Повар успешно добавлен!<br>Данные для входа:<br>Логин: $login_cook<br>Пароль: $password_cook</font>";
		}
		else{
			$_SESSION['msg']="<font color='red'>Ошибка! Логин уже зарегистрирован!</font>";
			return false;
		}
	}
}
?>