<?
	$sql="SELECT id, name_test, count_questions, count_active_questions, count_base_questions, status_test FROM tests";
	$res=$link->query($sql);
	while($row=$res->fetch(PDO::FETCH_ASSOC)){
		echo "Назание теста: {$row['name_test']}<br>Количество вопросов: {$row['count_questions']}<br>Количество задаваемых вопросов: {$row['count_active_questions']}<br>Количество обязательных вопросов: {$row['count_base_questions']}<br>Статус теста: {$row['status_test']}<br><a href='?form=2&id={$row['id']}'>Править</a>";
	}
?>