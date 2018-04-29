<?
//testing
include('config.php');
$form=$_GET['form'];
$module=$_GET['module'];
$login=$_POST['login'];
$password=$_POST['password'];
$exit=$_GET['exit'];
if(!$form){
	$form=1;
}
if($exit==1 and $_SESSION['permission']){
	session_destroy();
	header('location: ?module=0');
	exit;
}
if($login and $password){
	$login=$link->quote($login);
	$password=$link->quote($password);
	$sql="SELECT permission, id_user FROM users WHERE login=$login and password=$password";
	$res=$link->query($sql);
	$row=$res->fetch(PDO::FETCH_ASSOC);
	if($row['permission']){
		$_SESSION['permission']=$row['permission'];
		$id_user=$row['id_user'];
		$id_user=$link->quote($id_user);
		$_SESSION['url_avatar']=$row['url_avatar'];
		switch($row['permission']){
			case 1:
				$sql="SELECT name, email, phone FROM users_global_admins WHERE id=$id_user";
				$res=$link->query($sql);
				$row=$res->fetch(PDO::FETCH_ASSOC);
			break;
			case 2: 
				$sql="SELECT name, email, phone, id_school FROM users_school_admins WHERE id=$id_user";
				$res=$link->query($sql);
				$row=$res->fetch(PDO::FETCH_ASSOC);
				$_SESSION['id_school']=$row['id_school'];
			break;
			case 3: 
				$sql="SELECT id, name, email, phone, id_school, id_base_lesson, employment FROM users_teachers WHERE id=$id_user";
				$res=$link->query($sql);
				$row=$res->fetch(PDO::FETCH_ASSOC);
				$_SESSION['id_teacher']=$row['id'];
				$_SESSION['id_school']=$row['id_school'];
				$_SESSION['id_base_lesson']=$row['id_base_lesson'];
				$_SESSION['employment']=$row['employment'];
			break;
			case 4: 
			
				$sql="SELECT id, email, name, phone, id_class, id_parent, id_school FROM users_students WHERE id=$id_user";
				$res=$link->query($sql);
				$row=$res->fetch(PDO::FETCH_ASSOC);
				$_SESSION['id_student']=$row['id'];
				$_SESSION['id_school']=$row['id_school'];
				$_SESSION['name']=$row['name'];
				if($row['email']){
					$_SESSION['email']=$row['email'];
				}
				if($row['phone']){
					$_SESSION['phone']=$row['phone'];
				}
				$_SESSION['id_class']=$row['id_class'];
				if($row['id_parent']>0){
					$_SESSION['id_parent']=$row['id_parent'];
				}
			
			break;
		}
		$_SESSION['email']=$row['email'];
		$_SESSION['name']=$row['name'];
		$_SESSION['phone']=$row['phone'];
		$_SESSION['msg']="<font color='green'>Поздравляем! Вы успешно вошли в систему, {$row['name']}!</font>";
		$_SESSION['msg_status']="success";
	}
	else{
		$_SESSION['msg']="<font color='red'>Неверно введен логин или пароль!</font>";
		$_SESSION['msg_status']="danger";
	}
}
function check_login($login){//проверка пользователя на валидность
	GLOBAL $link;
	if($login!="''"){
		$sql="SELECT id FROM users WHERE login=$login";
		$res=$link->query($sql);
		$row=$res->fetch(PDO::FETCH_ASSOC);
		if($row['id']){
			return false;
		}
		else{
			return true;
		}
	}
	else{
		return false;
	}
}
function add_school($name_school_text, $address_school, $surname_dir_school,  $email_school_text, $phone_school){//добавление школы
	Global $link;
	if($name_school_text and $address_school and $surname_dir_school and $email_school_text and $phone_school){
		$name_school=$link->quote($name_school_text);
		$address_school=$link->quote($address_school);
		$surname_dir_school=$link->quote($surname_dir_school);
		$email_school=$link->quote($email_school_text);
		$phone_school=$link->quote($phone_school);
		$sql="INSERT INTO schools(name_school, address_school, surname_dir_school, email_school, phone_school) 
		VALUES ($name_school,$address_school,$surname_dir_school,$email_school,$phone_school)";
		$link->exec($sql);
		$password_text=md5(uniqid(rand(),true));
		$password=$link->quote($password_text);
		$name_admin="Администратор школы $name_school_text";
		$name_admin=$link->quote($name_admin);
		$sql="SELECT id id_school FROM schools order by id desc limit 0, 1";
		$res=$link->query($sql);
		$row=$res->fetch(PDO::FETCH_ASSOC);
		$id_school=$row['id_school'];
		$id_school=$link->quote($id_school);
		$sql="
		INSERT INTO users_school_admins(email, name, phone, id_school) VALUES ($email_school, $name_admin, $phone_school, $id_school)
		";
		$link->exec($sql);
		$sql="SELECT id id_user_table FROM users_school_admins order by id desc limit 0, 1";
		$res=$link->query($sql);
		$row=$res->fetch(PDO::FETCH_ASSOC);
		$id_user_table=$row['id_user_table'];
		$id_user_table=$link->quote($id_user_table);
		$sql="
		INSERT INTO users(login, password, id_user, permission) VALUES ($email_school, $password, $id_user_table, 2)";
		$link->exec($sql);
		$_SESSION['msg']="<font color='green'>Школа успешно добавлена!<br>Данные глобального администратора:<br>Логин: $email_school_text<br>Пароль: $password_text</font>";
	}
}
function add_class($number_class, $letter_class, $classroom_teacher){//добавление класса
	Global $link;
	if($number_class and $letter_class and $classroom_teacher){
		$number_class=$link->quote($number_class);
		$letter_class=$link->quote($letter_class);
		$classroom_teacher=$link->quote($classroom_teacher);
		$sql="INSERT INTO classes(id_teacher, id_school, number_class, leter_class) VALUES ($classroom_teacher,'{$_SESSION['id_school']}', $number_class, $letter_class)";
		$link->exec($sql);
		$id_class=$link->lastInsertId('classes');
		$id_class=$link->quote($id_class);
		$_SESSION['msg']="<font color='green'>Класс успешно добавлен!</font>";
	}
}
function add_teacher($name_teacher, $lesson_teacher, $date_teacher,  $email_teacher, $phone_teacher, $login_teacher_text, $password_teacher_text, $repassword_teacher){//добавление учителя
	Global $link;
	if($name_teacher and $lesson_teacher and $date_teacher and $email_teacher and $phone_teacher and $login_teacher_text and $password_teacher_text and $password_teacher_text==$repassword_teacher){
		$name_teacher=$link->quote($name_teacher);
		$lesson_teacher=$link->quote($lesson_teacher);
		$date_teacher=$link->quote($date_teacher);
		$email_teacher=$link->quote($email_teacher);
		$phone_teacher=$link->quote($phone_teacher);
		$login_teacher=$link->quote($login_teacher_text);
		$password_teacher=$link->quote($password_teacher_text);
		$id_school=$link->quote($_SESSION['id_school']);
		if(check_login($login_teacher)==true){
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
		}
	}
}
function add_student($json_students, $id_class, $id_school){//добавление ученика
	Global $link;
	$id_school=$link->quote($id_school);
	foreach($json_students as $student){
		if($student[0]['name'] and $student[0]['login'] and $student[0]['password']){
			$name_student=$link->quote($student[0]['name']);
			$login_student=$link->quote($student[0]['login']);
			$password_student=$link->quote($student[0]['password']);
			if(check_login($login_student)==true){
				$sql="INSERT INTO users_students(name, id_school, id_class) VALUES ($name_student, $id_school, $id_class)";
				$link->exec($sql);
				$id_student=$link->lastInsertId(users_students);
				$id_student=$link->quote($id_student);
				$sql="INSERT INTO users(login, password, id_user, permission) VALUES ($login_student, $password_student, $id_student, 4)";
				$link->exec($sql);
				$_SESSION['msg']="<font color='green'>Ученик(и) успешно добавлен(ы)!</font>";
			}
			else{
				$_SESSION['msg']="<font color='red'>Ошибка! Один из логинов уже зарегистрирован!</font>";
			}
		}
		
	}

}
switch($_SESSION['permission']){//отображение контента
	case 1: //пользователь глобальный администратор
		switch($form){
			case 1: break;
			case 2: //добавление школы
			$name_school_text=$_POST['name_school'];
			$address_school=$_POST['address_school'];
			$surname_dir_school=$_POST['surname_dir_school'];
			$email_school_text=$_POST['email_school'];
			$phone_school=$_POST['phone_school'];
			if($name_school_text and $address_school and $surname_dir_school and $email_school_text and $phone_school){
				add_school($name_school_text, $address_school, $surname_dir_school,  $email_school_text, $phone_school);
				header('location: ?module=1&form=2');
				exit;
			}
			break;
			
		}
	break;
	case 2: //пользователь администратор школы
		switch($form){
			case 1: break;
			case 2: //добавление класса
				$number_class=$_POST['number_class'];
				$letter_class=$_POST['letter_class'];
				$classroom_teacher=$_POST['classroom_teacher'];
				if($number_class and $letter_class and $classroom_teacher){
					add_class($number_class, $letter_class, $classroom_teacher);
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
				if($name_teacher and $lesson_teacher and $date_teacher and $email_teacher and $phone_teacher and $login_teacher_text and $password_teacher_text and $password_teacher_text==$repassword_teacher){
					add_teacher($name_teacher, $lesson_teacher, $date_teacher,  $email_teacher, $phone_teacher, $login_teacher_text, $password_teacher_text, $repassword_teacher);
					header('location: ?module=1&form=3');
					exit;
				}
			break;
			case 4:
				
			break;
			case 5: //добавление родителей (по-моему не работают)
			
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
			
			break;
		}
	break;
	case 3: //пользователь классный руководитель учитель
		switch($form){
			case 1: break;
			case 2: //удаление учителя по предмету
				$id_del_ltc=$_GET['del'];
				if($id_del_ltc){
					$id_del_ltc=$link->quote($id_del_ltc);
					$sql="SELECT id FROM classes WHERE id_teacher={$_SESSION['id_teacher']}";
					$res=$link->query($sql);
					$row=$res->fetch(PDO::FETCH_ASSOC);
					$sql="DELETE FROM lesson_teacher_class WHERE id=$id_del_ltc and id_class='{$row['id']}'";
					$link->exec($sql);
					header('location: ?module=1&form=2');
					exit;
				}
				$id_del=$_GET['del_new'];
				if($id_del){
					$id_del=$link->quote($id_del);
					$sql="SELECT id FROM classes WHERE id_teacher={$_SESSION['id_teacher']}";
					$res=$link->query($sql);
					$row=$res->fetch(PDO::FETCH_ASSOC);
					$sql="DELETE FROM news_classes WHERE id=$id_del and id_class='{$row['id']}'";
					$link->exec($sql);
					header('location: ?module=1&form=2');
					exit;
				}
			break;
			case 3: //добавление учителя по предмету
		
			$teacher_lesson_conduct=$_POST['teacher_lesson_conduct'];
			$lesson_teacher=$_POST['lesson_teacher'];
			if($teacher_lesson_conduct and $lesson_teacher){
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
				header('location: ?module=1&form=3');
				exit;
			}
			break;
			case 4: //добавление учеников
				$json_student=$_POST['json_students'];
				if($json_student){
					$sql="SELECT id FROM classes WHERE id_teacher={$_SESSION['id_teacher']}";
					$res=$link->query($sql);
					$row=$res->fetch(PDO::FETCH_ASSOC);
					$json_student=json_decode($json_student, true);
					add_student($json_student, $row['id'], $_SESSION['id_school']);
				}
			break;
			case 7: //не дописано (тесты)
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
			break;
			case 8: //добавление расписания
			
			$schedule_json=$_POST['schedule_json'];

			if($schedule_json){
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
				header('location:?module=1&form=2');
				exit;
			}
			
			break;
			case 9: //редактирование расписания
			
			$schedule_json=$_POST['schedule_json'];

			if($schedule_json){
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
				$str_sql="";
				$a=0;
				if($id_student and $marks and $desc and $date and $lesson){
					$desc=$link->quote($desc);
					$date=$link->quote($date);
					$lesson=$link->quote($lesson);
					$id_teacher=$link->quote($_SESSION['id_teacher']);
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
			break;
			case 11: //добавление новостей класса
				$header=$_POST['header'];
				$new=$_POST['new'];
				if($header and $new){
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
			
			
			break;
		}
	break;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Моя школа</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	<div class="center-block">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Моя школа</a>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li<?if(!$module){echo " class=\"active\"";}?>><a href="?module=0">Главная <span class="sr-only">(current)</span></a></li>
							<li<?if($module==1){echo " class=\"active\"";}?>><a href="?module=1">Журнал</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
						<?if($_SESSION['permission']){?>
							<li class="pull-right"><a href="?exit=1">Выйти</a></li>
						<?}?>
						</ul>
					</div>
				</div>
			</nav>
			<?if($_SESSION['msg']){?>
			<div class="alert alert-dismissible alert-<?=$_SESSION['msg_status']?>">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?=$_SESSION['msg']; $_SESSION['msg']="";?>
			</div>
			<?}?>
			<?
			if(!$_SESSION['permission']){
				include('autoriz.php');
			}
			else{
				include('home.php');
			}
			?>
		</div>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>