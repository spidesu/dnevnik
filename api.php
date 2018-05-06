<?
include('config.php');
$school = $_GET['id_school'];
$classes=$link->query("SELECT * FROM classes WHERE id_school={$school}");
$users_students=$link->query("SELECT * FROM users_students WHERE id_school={$school}");
$users_teachers=$link->query("SELECT * FROM users_teachers WHERE id_school={$school}");
$schedule=$link->query("SELECT s.id, s.id_lesson, s.number_lesson, s.day, s.id_class FROM schedule s JOIN classes c ON s.id_class=c.id WHERE c.id_school={$school}");
$marks=$link->query("SELECT m.id, m.id_student, m.id_teacher, m.id_lesson, m.description, m.date, m.mark FROM marks m JOIN users_students us ON m.id_student=us.id WHERE us.id_school={$school}");
$news_classes=$link->query("SELECT m.id, m.header, m.new, m.autor, m.id_class FROM news_classes m JOIN classes us ON m.id_class=us.id WHERE us.id_school={$school}");
$lesson_teacher_class=$link->query("SELECT ltc.id, ltc.id_teacher, ltc.id_lesson, ltc.id_class FROM lesson_teacher_class ltc JOIN classes us ON ltc.id_class=us.id WHERE us.id_school={$school}");
$users=$link->query("SELECT * FROM users  WHERE permission>=2");
$records_arr=array();
$records_arr["users"]=array();
while($row = $users->fetch(PDO::FETCH_ASSOC)) {
switch($row['permission']){
					case 2:
					$sql="SELECT u.id, u.login, u.password, u.id_user, u.permission FROM users u JOIN users_school_admins usa WHERE id_school=$school AND u.permission=2";
						$res=$link->query($sql);
						$row2=$res->fetch(PDO::FETCH_ASSOC);
						break;
					case 3:
					$sql="SELECT u.id, u.login, u.password, u.id_user, u.permission FROM users u JOIN users_teachers usa WHERE id_school=$school AND u.permission=3";
						$res=$link->query($sql);
						$row2=$res->fetch(PDO::FETCH_ASSOC);
						break;
					case 4:
					$sql="SELECT u.id, u.login, u.password, u.id_user, u.permission FROM users u JOIN users_students usa WHERE id_school=$school AND u.permission=4";
						$res=$link->query($sql);
						$row2=$res->fetch(PDO::FETCH_ASSOC);
						break;
					}
		$user_item=array(
			"id" => $row2['id'],
            "login" => $row2['login'],
            "password" => $row2['password'],
            "id_user" => $row2['id_user'],
        	"permission" => $row2['permission']);

	array_push($records_arr["users"], $user_item);				
}

//$records_arr=array();
$records_arr["classes"]=array();
$records_arr["users_students"]=array();
$records_arr["users_teachers"]=array();
$records_arr["schedule"]=array();
$records_arr["marks"]=array();
$records_arr["news_classes"]=array();
$records_arr["lesson_teacher_class"]=array();
while($row = $classes->fetch(PDO::FETCH_ASSOC)) {

	$class_item=array(
			"id" => $row['id'],
            "id_teacher" => $row['id_teacher'],
            "number_class" => $row['number_class'],
            "leter_class" => $row['leter_class']);

	array_push($records_arr["classes"], $class_item);
}

while($row = $users_students->fetch(PDO::FETCH_ASSOC)) {

	$users_students_item=array(
			"id" => $row['id'],
            "email" => $row['email'],
            "name" => $row['name'],
            "phone" => $row['phone'],
            "id_class" => $row['id_class'],
            "id_parent" => $row['id_parent'],
            "id_class" => $row['id_class']);

	array_push($records_arr["users_students"], $users_students_item);
}

while($row = $users_teachers->fetch(PDO::FETCH_ASSOC)) {

	$users_teachers_item=array(
			"id" => $row['id'],
            "email" => $row['email'],
            "name" => $row['name'],
            "phone" => $row['phone']);

	array_push($records_arr["users_teachers"], $users_teachers_item);
}

while($row = $schedule->fetch(PDO::FETCH_ASSOC)) {

	$schedule_item=array(
			"id" => $row['id'],
            "id_lesson" => $row['id_lesson'],
            "number_lesson" => $row['number_lesson'],
            "day" => $row['day'],
            "id_class" => $row['id_class']);

	array_push($records_arr["schedule"], $schedule_item);
}

while($row = $marks->fetch(PDO::FETCH_ASSOC)) {

	$marks_item=array(
			"id" => $row['id'],
            "id_student" => $row['id_student'],
            "id_teacher" => $row['id_teacher'],
            "id_lesson" => $row['id_lesson'],
            "mark" => $row['mark'],
            "description" => $row['description'],
            "date" => $row['date']);

	array_push($records_arr["marks"], $marks_item);
}

while($row = $news_classes->fetch(PDO::FETCH_ASSOC)) {

	$news_classes_item=array(
			"id" => $row['id'],
            "header" => $row['header'],
            "new" => $row['new'],
            "author" => $row['author'],
            "date" => $row['date'],
            "id_class" => $row['id_class']);

	array_push($records_arr["news_classes"], $news_classes_item);
}

while($row = $lesson_teacher_class->fetch(PDO::FETCH_ASSOC)) {

	$lesson_teacher_class_item=array(
			"id" => $row['id'],
            "id_teacher" => $row['id_teacher'],
            "id_lesson" => $row['id_lesson'],
            "id_class" => $row['id_class']);

	array_push($records_arr["lesson_teacher_class"], $lesson_teacher_class_item);
}

echo json_encode($records_arr, JSON_UNESCAPED_UNICODE);


?>