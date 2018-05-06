<?
switch($_SESSION['permission']){
	case 4: include('kitchen/menu_student.php'); break;
	case 3: include('kitchen/menu_teacher.php'); break;
	case 6: include('kitchen/menu_cook.php'); break;
	case 5: include('kitchen/menu_parent.php'); break;
}
?>