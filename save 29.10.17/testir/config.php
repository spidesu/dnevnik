<?
header("Content-Type: text/html; charset=utf-8");//установка кодировки
//$link=mysqli_connect("localhost","user2","123456","2") or die (mysqli_error($link));//подключение к базе данных
$link = new PDO('mysql:host=localhost;dbname=user4_3', 'user4', 'user4');
session_start();
?>