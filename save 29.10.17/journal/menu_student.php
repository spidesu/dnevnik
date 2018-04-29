<hr>
<a href="?module=1&form=1">Главная</a><br>
<a href="?module=1&form=2">Мой класс</a><br>
<a href="?module=1&form=3">Мои оценки</a><br>
<hr>
<?
switch($form){
	case 2: include('journal/my_class.php'); break;
	case 3: include('journal/my_marks.php'); break;
}
?>