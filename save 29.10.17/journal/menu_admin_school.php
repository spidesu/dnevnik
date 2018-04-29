<hr>
<a href="?module=1&form=1">Главная</a><br>
<a href="?module=1&form=2">Добавить класс</a><br>
<a href="?module=1&form=3">Добавить учителя</a><br>
<hr>
<?
switch($form){
	case 2: include('journal/add_class.php'); break;
	case 3: include('journal/add_teacher.php'); break;
}
?>