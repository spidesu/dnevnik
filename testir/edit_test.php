<?
	$id_test=$_GET['id'];
	$sql="SELECT id, name_test, count_questions, count_active_questions, count_base_questions, status_test FROM tests";
	$res=$link->query($sql);
	
	while($row=$res->fetch(PDO::FETCH_ASSOC)){
		echo "<a href='?form=3&id=$id_test'>Изменить информацию о тесте</a><br>";
		echo "<a href='?form=4&id=$id_test'>Добавить вопросы</a><br>";
		echo "<a href='?form=5&id=$id_test'>Редактировать вопросы</a>";
	}
?>