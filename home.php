<?
switch($module){
	case 1: include('journal/home.php'); break;
	case 2: include('kitchen/home.php'); break;
	default: include('info.php'); break;
}
?>