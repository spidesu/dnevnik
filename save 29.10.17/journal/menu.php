<hr>
<a href="?form=1">Главная</a><br>
<a href="?form=2">Добавить школу</a><br>
<hr>
<?
switch($form){
	case 2: include('journal/add_school.php'); break;
}
?>