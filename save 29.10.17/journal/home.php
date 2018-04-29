<?
switch($_SESSION['permission']){
	case 1: include('journal/menu.php'); break;
	case 2: include('journal/menu_admin_school.php'); break;
	case 3: include('journal/menu_teacher.php'); break;
	case 4: include('journal/menu_student.php'); break;
}
?>