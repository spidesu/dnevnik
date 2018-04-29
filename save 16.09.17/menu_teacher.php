<?
	$form=$_GET['form'];
?>
<h1>Поздравляем! Вы успешно вошли в систему, <?=$_SESSION['name']?>!</h1>
<a href="?exit=1">Выйти</a><br>
<hr>
<a href="?form=1">Главная</a><br>
<a href="?form=2">Мой класс</a><br>
<a href="?form=3">Учителя по предметам</a><br>
<a href="?form=4">Добавить ученика</a><br>
<a href="?form=5">Добавить родителя</a><br>
<a href="?form=6">Добавить оценку</a><br>
<a href="?form=7">Добавить тест</a><br>
<hr>
<?
switch($form){
	case 1: include('home.php'); break;
	case 2: include('my_class.php'); break;
	case 3: include('classes_lesson_teachers.php'); break;
	case 4: include('add_student.php'); break;
	case 5: include('add_parent.php'); break;
	case 6: include('add_mark_select.php'); break;
	case 7: include('add_test.php'); break;
	default: include('home.php'); break;
}
?>