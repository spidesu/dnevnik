<?
	$form=$_GET['form'];
?>
<h1>Поздравляем! Вы успешно вошли в систему, <?=$_SESSION['name']?>!</h1>
<a href="?exit=1">Выйти</a><br>
<hr>
<a href="?form=1">Главная</a><br>
<a href="?form=2">Мой класс</a><br>
<a href="?form=3">Мои оценки</a><br>
<hr>
<?
switch($form){
	case 1: include('home.php'); break;
	case 2: include('my_class.php'); break;
	case 3: include('my_marks.php'); break;
	default: include('home.php'); break;
}
?>