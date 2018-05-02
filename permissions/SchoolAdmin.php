<?
switch($form){
	case 1: break;
	case 2: //добавление класса

		$number_class=$_POST['number_class'];
		$letter_class=$_POST['letter_class'];
		$classroom_teacher=$_POST['classroom_teacher'];
		if($number_class && $letter_class && $classroom_teacher){
			$schoolAdminClass->add_class($number_class, $letter_class, $classroom_teacher);
			header('location: ?module=1&form=2');
			exit;
		}
	break;
	case 3: //добавление учителя
		$name_teacher=$_POST['name_teacher'];
		$lesson_teacher=$_POST['lesson_teacher'];
		$date_teacher=$_POST['date_teacher'];
		$email_teacher=$_POST['email_teacher'];
		$phone_teacher=$_POST['phone_teacher'];
		$login_teacher_text=$_POST['login_teacher'];
		$password_teacher_text=$_POST['password_teacher'];
		$repassword_teacher=$_POST['repassword_teacher'];
		if($name_teacher && $lesson_teacher && $date_teacher && $email_teacher && $phone_teacher && $login_teacher_text && $password_teacher_text && $password_teacher_text==$repassword_teacher){

			$schoolAdminClass->add_teacher($name_teacher, $lesson_teacher, $date_teacher,  $email_teacher, $phone_teacher, $login_teacher_text, $password_teacher_text, $repassword_teacher);

			header('location: ?module=1&form=3');
			exit;
		}
	break;
	case 4:
		
	break;
	/*case 5: //добавление родителей (по-моему не работают)
	
		$name_parent=$_POST['name_parent'];
		$job_parent=$_POST['job_parent'];
		$adress_parent=$_POST['adress_parent'];
		$date_parent=$_POST['date_parent'];
		$email_parent=$_POST['email_parent'];
		$phone_parent=$_POST['phone_parent'];
		$login_parent=$_POST['login_parent'];
		$password_parent=$_POST['password_parent'];
		$children_parent=$_POST['children_parent'];
		if($name_parent and $job_parent and $adress_parent and $date_parent and $email_parent and $phone_parent and $login_parent and $password_parent){
			$name_parent=$link->quote($name_parent);
			$job_parent=$link->quote($job_parent);
			$adress_parent=$link->quote($adress_parent);
			$date_parent=$link->quote($date_parent);
			$email_parent=$link->quote($email_parent);
			$phone_parent=$link->quote($phone_parent);
			$login_parent=$link->quote($login_parent);
			$password_parent=$link->quote($password_parent);
			$children_parent=$link->quote($children_parent);
			$id_school=$link->quote($_SESSION['id_school']);
			$sql="INSERT INTO users_parents(email, name, phone, id_school) VALUES ($email_parent,$name_parent,$phone_parent,$id_school)";
			$link->exec($sql);
			$id_parent=$link->lastInsertId('users_parents');
			$id_parent=$link->quote($id_parent);
			$sql="
			
			INSERT INTO users(login, password, id_user, permission) VALUES ($login_parent, $password_parent, $id_parent, 5);
			UPDATE users_students SET id_parent=$id_parent WHERE id=$children_parent
			
			";
			$link->exec($sql);
			$_SESSION['msg']="<font color='green'>Родитель успешно добавлен!</font>";
			header('location: ?module=1&form=5');
			exit;
		}
	
	break;*/
}
?>