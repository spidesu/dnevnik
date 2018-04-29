<h2>Выберите класс для выставления оценки</h2>
<hr>
<?if($_SESSION['msg']){echo $_SESSION['msg']; $_SESSION['msg']="";}?>
<?
$sql="SELECT ltc.id_lesson, ltc.id_class, c.number_class, c.leter_class, l.name name_lesson FROM lesson_teacher_class ltc 
JOIN classes c ON c.id=ltc.id_class 
JOIN lessons l ON l.id=ltc.id_lesson 
WHERE ltc.id_teacher={$_SESSION['id_teacher']}";
$res=$link->query($sql);
while($row=$res->fetch(PDO::FETCH_ASSOC)){
	echo "<h4><a href='?module=1&form=14&id_lesson={$row['id_lesson']}&id_class={$row['id_class']}'>".$row['name_lesson']." ".$row['number_class']."<sup>".$row['leter_class']."</sup><br></a></h4><hr>";
}
?>